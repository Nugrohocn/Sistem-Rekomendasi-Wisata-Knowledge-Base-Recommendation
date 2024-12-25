<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RekomendasiController extends Controller
{

    public function index()
    {
        return view('rekomendasi.index');
    }

    // Set Bobot setiap atribut menjadi 0,2
    private const ATTRIBUTE_WEIGHT = 0.2;

    // METHOD UTAMA
    public function getRekomendasi(Request $request)
    {
        // Validasi
        $request->validate([
            'kategori' => 'required',
            'lokasi' => 'required',
            'rating' => 'required',
            'harga' => 'required',
            'fasilitas' => 'required'
        ]);

        // 1. Mengambil data dari form
        $preferensiPengguna = [
            'kategori' => $request->input('kategori'),
            'lokasi' => $request->input('lokasi'),
            'rating' => $request->input('rating'),
            'harga' => $request->input('harga'),
            'fasilitas' => $request->input('fasilitas')
        ];


        // 2. Mengambil semua data wisata dari database
        $allWisata = Place::all();

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

        // 7. kirim ke view
        return view('rekomendasi.hasil', [
            'rekomendasi' => $topRekomendasi
        ]);
    }


    private function hitungSimilarity($preferensiPengguna, $wisata)
    {
        $similarity = 0;

        if ($preferensiPengguna['kategori'] == $wisata->kategori) {
            $similarity += self::ATTRIBUTE_WEIGHT;
        }

        if ($preferensiPengguna['lokasi'] == $wisata->lokasi) {
            $similarity += self::ATTRIBUTE_WEIGHT;
        }

        $perbandinganRating = 1 - (abs($preferensiPengguna['rating'] - $wisata->rating->rate) / 5);
        $similarity += $perbandinganRating * self::ATTRIBUTE_WEIGHT;

        $similarity += $this->hitungTiketSimilarity($preferensiPengguna['harga'], $wisata->harga) * self::ATTRIBUTE_WEIGHT;
        $similarity += $this->hitungFasilitasSimilarity($preferensiPengguna['fasilitas'], $wisata->fasilitas) * self::ATTRIBUTE_WEIGHT;

        return $similarity;
    }


    // METHOD PERHITUNGAN SIMILARITY TIKET
    private function hitungTiketSimilarity($preferensiPengguna, $kategoriHarga)
    {
        // Rentang harga tiket yang sudah ditentukan
        $rentangTiket = [
            'murah' => ['min' => 5000, 'max' => 10000],
            'sedang' => ['min' => 10000, 'max' => 15000],
            'mahal' => ['min' => 15000, 'max' => 25000],
        ];

        // Pastikan preferensi pengguna dan kategori harga wisata ada
        if (!isset($preferensiPengguna) || !isset($kategoriHarga)) {
            return 0;  // Tidak ada kesesuaian jika data tidak lengkap
        }

        // Cek apakah kategori harga wisata tersedia dalam rentang
        if (isset($rentangTiket[$preferensiPengguna])) {
            $rentangPilihan = $rentangTiket[$preferensiPengguna];

            // Jika kategori harga wisata sesuai dengan rentang pilihan pengguna
            if ($kategoriHarga >= $rentangPilihan['min'] && $kategoriHarga <= $rentangPilihan['max']) {
                return 1;  // Similarity penuh
            }

            // Jika tidak sesuai, hitung kedekatannya
            $midPoint = ($rentangPilihan['min'] + $rentangPilihan['max']) / 2;
            $maxDiff = 20000; // Maksimum selisih harga yang mungkin
            return 1 - (abs($kategoriHarga - $midPoint) / $maxDiff);
        }

        // Jika tidak ada kesesuaian harga kategori, kembalikan nilai default 0
        return 0;
    }




    // Untuk fasilitas similarity
    private function hitungFasilitasSimilarity($preferensiPengguna, $wisataFasilitas)
    {
        $wisataFasilitasArray = explode(',', $wisataFasilitas);

        // Jika fasilitas yang dipilih user ada di wisata
        if (in_array($preferensiPengguna, $wisataFasilitasArray)) {
            return 1;
        }

        return 0;
    }
}
