<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class RekomendasiController extends Controller
{

    public function index()
    {
        return view('rekomendasi.index');
    }

    // Bobot untuk setiap atribut
    private const RATING_WEIGHT = 0.2;
    private const LOKASI_WEIGHT = 0.2;
    private const KATEGORI_WEIGHT = 0.2;
    private const HARGA_WEIGHT = 0.2;
    private const FASILITAS_WEIGHT = 0.2;

    // METHOD UTAMA
    public function getRekomendasi(Request $request)
    {
        // Validasi
        $request->validate([
            'kategori' => 'required',
            'lokasi' => 'required',
            'rating' => 'required',
            'harga' => 'required',
            'fasilitas' => 'array'
        ]);

        // 1. Mengambil data dari form
        $preferensiPengguna = [
            'kategori' => $request->input('kategori'),
            'lokasi' => $request->input('lokasi'),
            'rating' => $request->input('rating'),
            'harga' => $request->input('harga'),
            'fasilitas' => $request->input('fasilitas', [])
        ];

        // 2. Mengambil semua data wisata dari database dengan eager load untuk relasi
        $allWisata = Place::with('category', 'location', 'rating', 'tiket', 'fasilitas')->get();

        // Pilihan untuk melakukan filter awal untuk kategori 
        // $allWisata = Place::with('category', 'location', 'rating', 'tiket', 'fasilitas')
        //     ->whereHas('category', function ($query) use ($preferensiPengguna) {
        //         $query->where('nama', $preferensiPengguna['kategori']);
        //     })
        //     ->get();


        // 3. Array untuk menyimpan hasil perhitungan
        $rekomendasi = [];

        // 4. Loop setiap wisata untuk menghitung similarity
        foreach ($allWisata as $wisata) {
            $similarity = $this->hitungSimilarity($preferensiPengguna, $wisata);

            $rekomendasi[] = [
                'wisata' => $wisata,
                'similarity' => $similarity
            ];
        }

        // 5. Urutkan berdasarkan similarity tertinggi
        usort($rekomendasi, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        // 6. Ambil 5 rekomendasi teratas
        $topRekomendasi = array_slice($rekomendasi, 0, 5);

        // 7. Kirim ke view
        return view('rekomendasi.hasil', [
            'rekomendasi' => $topRekomendasi
        ]);
    }

    // Metode untuk menghitung similarity
    private function hitungSimilarity($preferensiPengguna, $wisata)
    {
        $similarity = 0;

        // Kategori
        if ($preferensiPengguna['kategori'] == $wisata->category->nama) {
            $similarity += self::KATEGORI_WEIGHT;
        }

        // Lokasi
        if ($preferensiPengguna['lokasi'] == $wisata->location->nama) {
            $similarity += self::LOKASI_WEIGHT;
        }

        // Rating - Perhitungan untuk rentang 4.0 hingga 4.7
        $userRating = $preferensiPengguna['rating'];
        $placeRating = $wisata->rating->rate;

        // Normalisasi Rating
        $ratingMin = 4.0;
        $ratingMax = 5.0;

        $normalizedUserRating = ($userRating - $ratingMin) / ($ratingMax - $ratingMin);
        $normalizedPlaceRating = ($placeRating - $ratingMin) / ($ratingMax - $ratingMin);

        // Similarity berdasarkan perbedaan rating
        $perbandinganRating = 1 - abs($normalizedUserRating - $normalizedPlaceRating);
        $similarity += $perbandinganRating * self::RATING_WEIGHT;

        // Harga Tiket
        $similarity += $this->hitungTiketSimilarity($preferensiPengguna['harga'], $wisata->tiket->harga) * self::HARGA_WEIGHT;

        // Fasilitas
        $similarity += $this->hitungFasilitasSimilarity($preferensiPengguna['fasilitas'], $wisata->fasilitas->pluck('nama')->toArray()) * self::FASILITAS_WEIGHT;
        return $similarity;
    }


    // Perhitungan similarity harga tiket
    // PERHITUNGAN LAMA
    // private function hitungTiketSimilarity($preferensiPengguna, $kategoriHarga)
    // {
    //     $rentangTiket = [
    //         'murah' => ['min' => 5000, 'max' => 10000],
    //         'sedang' => ['min' => 10001, 'max' => 15000],
    //         'mahal' => ['min' => 15001, 'max' => 25000],
    //     ];

    //     if (!isset($preferensiPengguna) || !isset($kategoriHarga)) {
    //         return 0;  // Tidak ada kesesuaian jika data tidak lengkap
    //     }

    //     if (isset($rentangTiket[$preferensiPengguna])) {
    //         $rentangPilihan = $rentangTiket[$preferensiPengguna];

    //         if ($kategoriHarga >= $rentangPilihan['min'] && $kategoriHarga <= $rentangPilihan['max']) {
    //             return 1;  // Similarity penuh
    //         }

    //         $midPoint = ($rentangPilihan['min'] + $rentangPilihan['max']) / 2;
    //         $maxDiff = 25000;
    //         return 1 - (abs($kategoriHarga - $midPoint) / $maxDiff);
    //     }

    //     return 0;
    // }

    // PERHITUNGAN BARU
    private function hitungTiketSimilarity($preferensiPengguna, $kategoriHarga)
    {
        $rentangTiket = [
            'murah' => ['min' => 5000, 'max' => 10000],
            'sedang' => ['min' => 10001, 'max' => 15000],
            'mahal' => ['min' => 15001, 'max' => 25000],
        ];

        if (!isset($preferensiPengguna) || !isset($kategoriHarga)) {
            return 0;  // Tidak ada kesesuaian jika data tidak lengkap
        }

        if (isset($rentangTiket[$preferensiPengguna])) {
            $rentangPilihan = $rentangTiket[$preferensiPengguna];

            // Jika harga berada dalam rentang
            if ($kategoriHarga >= $rentangPilihan['min'] && $kategoriHarga <= $rentangPilihan['max']) {
                return 1;  // Similarity penuh
            }

            // Jika harga berada di luar rentang
            if ($kategoriHarga < $rentangPilihan['min']) {
                $selisih = $rentangPilihan['min'] - $kategoriHarga; // Di bawah rentang
            } else {
                $selisih = $kategoriHarga - $rentangPilihan['max']; // Di atas rentang
            }

            // Panjang rentang preferensi
            $rangeMax = $rentangPilihan['max'] - $rentangPilihan['min'];

            // Hitung similarity berdasarkan selisih
            $similarity = 1 - ($selisih / $rangeMax);

            // Pastikan similarity berada dalam rentang 0-1
            // Misal nilai kurang dari 0 / Minus, maka ubah jadi 0
            return max(0, min(1, $similarity));
        }

        return 0;
    }


    // Perhitungan fasilitas similarity
    private function hitungFasilitasSimilarity($preferensiFasilitas, $wisataFasilitas)
    {
        // Jika user tidak memilih fasilitas apapun
        if (empty($preferensiFasilitas)) {
            return 1; // Berikan nilai maksimal
        }

        // Hitung berapa banyak fasilitas yang cocok
        $jumlahCocok = 0;
        foreach ($preferensiFasilitas as $fasilitas) {
            if (in_array($fasilitas, $wisataFasilitas)) {
                $jumlahCocok++;
            }
        }

        // Hitung similarity berdasarkan persentase kecocokan
        return $jumlahCocok / count($preferensiFasilitas);
    }
}
