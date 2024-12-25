{{-- Tahap Pengumpulan Data

Kumpulkan data tempat wisata dengan 5 atribut:

Jenis Wisata (contoh: alam, budaya, sejarah)
Harga Tiket (murah, sedang, mahal)
Lokasi (Kecamatan)
Fasilitas (parkir, toilet, musholla, dll)
Rating (1-5 bintang)




Tahap Input Preferensi Pengguna

Buat form untuk user memasukkan preferensi mereka:

Pilih jenis wisata yang diinginkan
Pilih range harga yang diinginkan
Pilih jarak yang diinginkan
Centang fasilitas yang diinginkan
Pilih rating minimal




Tahap Perhitungan Kemiripan (Similarity)

Setiap atribut diberi bobot 0.2 (total 1.0)
Hitung kemiripan untuk setiap atribut:

Jenis Wisata:

Jika sama persis = 1
Jika berbeda = 0


Harga:

Jika kategori sama = 1
Jika beda 1 tingkat = 0.5
Jika beda 2 tingkat = 0


Jarak:

Sama seperti harga


Fasilitas:

Hitung berapa fasilitas yang cocok dibagi total fasilitas yang diminta


Rating:

Semakin dekat dengan keinginan user, semakin tinggi nilainya






Tahap Penghitungan Total

Untuk setiap tempat wisata:

Kalikan nilai kemiripan tiap atribut dengan bobotnya (0.2)
Jumlahkan semua hasilnya
Contoh: (1 × 0.2) + (0.5 × 0.2) + (1 × 0.2) + (0.7 × 0.2) + (0.8 × 0.2) = 0.8




Tahap Pengurutan

Urutkan tempat wisata berdasarkan nilai total tertinggi
Ambil 5 tempat teratas sebagai rekomendasi --}}


Preferensi User:
- Kategori: Wisata Alam, Wisata Budaya, Wisata Buatan
- Harga: Murah (5.000 - 10.000), Sedang (10.000 - 15.000), Mahal (15.000 - 25.000)
- Lokasi: Kecamatan
- Fasilitas: Parkir, Toilet, Mushola
- Rating: 4

Tempat Wisata A:
- Jenis: Alam (sama = 1 × 0.2 = 0.2)
- Harga: Murah (sama = 1 × 0.2 = 0.2)
- Lokasi: Kecamatan (beda 1 tingkat = 0.5 × 0.2 = 0.1)
- Fasilitas: Parkir, Toilet, Musholla (2 dari 2 cocok = 1 × 0.2 = 0.2)
- Rating: 4.5 (hampir sama = 0.9 × 0.2 = 0.18)
Total: 0.88 (88% cocok)

Tempat Wisata B:
- Jenis: Budaya (beda = 0 × 0.2 = 0)
- Harga: Mahal (beda 2 tingkat = 0 × 0.2 = 0)
- Jarak: Jauh (beda 2 tingkat = 0 × 0.2 = 0)
- Fasilitas: Parkir (1 dari 2 cocok = 0.5 × 0.2 = 0.1)
- Rating: 3 (agak beda = 0.5 × 0.2 = 0.1)
Total: 0.2 (20% cocok)

{{-- Hasil Akhir:

Tampilkan 5 tempat dengan persentase kecocokan tertinggi
Untuk setiap tempat, tampilkan:

Nama tempat
Persentase kecocokan
Detail tempat (jenis, harga, Lokasi, fasilitas, rating)
Gambar tempat (opsional)
Link untuk detail lebih lanjut



Dengan sistem ini, user akan mendapatkan rekomendasi tempat wisata yang paling sesuai dengan preferensi mereka, diurutkan dari yang paling cocok ke yang kurang cocok. --}}
