<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RekomendasiController extends Controller
{

    // Atur Bobot
    private $bobot = [
        'kategori' => 0,
        2,
        'lokasi' => 0,
        2,
        'rating' => 0,
        2,
        'harga' => 0,
        2,
        'fasilitas' => 0,
        2
    ];

    // Ambil semua tempat dari database 


    public function getRekomendasi(Request $request)
    {
        // Validasi Data
        $request->validate([
            'kategori' => 'required',
            'lokasi' => 'required',
            'rating' => 'required',
            'harga' => 'required',
            'fasilitas' => 'required'
        ]);

        // Mengambil data dari dropdown
        // Pastikan data yang diambil sudah tervalidasi
        // Simpan dalam variabel yang sesuai untuk pemrosesan selanjutnya
        $kategori = $request->input('kategori');
        $lokasi = $request->input('lokasi');
        $rating = $request->input('rating');
        $harga = $request->input('harga');
        $fasilitas = $request->input('fasilitas');


        // Mencocokkan dengan database ✓

        // Pastikan query yang digunakan efisien
        // Pertimbangkan menggunakan indexing untuk optimasi



        // Atur Bobot 0,2 setiap atribut ✓

        // Bobot total harus 1 (5 atribut × 0,2 = 1), ini sudah benar
        // Namun pertimbangkan juga:
        // Apakah semua atribut benar-benar sama pentingnya?
        // Mungkin ada atribut yang lebih penting dari yang lain?


        // Hitung Similarity ✓

        // Pastikan menggunakan rumus similarity yang tepat
        // Beberapa opsi rumus:

        // Cosine similarity
        // Euclidean distance
        // Jaccard similarity
        // Simple matching coefficient


        // Urutkan ✓

        // Urutkan berdasarkan nilai similarity tertinggi
        // Tentukan berapa banyak rekomendasi yang akan ditampilkan



        // Tampilkan ✓

        // Tampilkan hasil dengan format yang mudah dibaca
        // Pertimbangkan untuk menampilkan score similarity
    }
}
