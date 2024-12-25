@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4 text-center">Tentang REKTA</h1>
                <p class="mb-4 text-justify">
                    REKTA (Rekomendasi Wisata) adalah sebuah sistem rekomendasi tempat wisata di Kabupaten
                    Karanganyar.
                    Sistem ini menggunakan metode <strong>Knowledge-Based Recommendation</strong> yang memanfaatkan
                    pengetahuan tentang
                    tempat wisata dan preferensi pengguna untuk memberikan rekomendasi. Metode ini dipilih karena
                    kemampuannya dalam
                    memberikan rekomendasi berdasarkan kebutuhan spesifik pengguna tanpa memerlukan data historis interaksi
                    pengguna sebelumnya.
                </p>

                <p class="text-justify">
                    Sistem ini mengimplementasikan <strong>Case-Based Reasoning</strong>, di mana rekomendasi diberikan
                    berdasarkan
                    perhitungan kemiripan (similarity) antara kasus baru (preferensi pengguna) dengan basis pengetahuan yang
                    ada (data
                    tempat wisata). Dalam implementasinya, sistem menggunakan lima atribut utama yang masing-masing memiliki
                    bobot yang sama,
                    yaitu 0.2 atau 20%, sehingga total bobot keseluruhan adalah 1 atau 100%.
                </p>
            </div>
        </div>
    </div>
@endsection
