@extends('layouts.app')

@section('content')
    {{-- ------------------ Carousel -------------------- --}}
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active" style="height: 100vh;">
                <div style="position: relative; height: 100%; overflow: hidden;">
                    <img src="{{ asset('storage/image/w5.jpg') }}" class="d-block w-100"
                        style="height: 100%; object-fit: cover;" alt="...">
                    <div
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6);">
                    </div>
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Tawangmangu</h5>
                    <p>Sebuah destinasi di Karanganyar yang menawarkan udara sejuk, pemandangan pegunungan, dan wisata
                        alam yang memukau.</p>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item" style="height: 100vh;">
                <div style="position: relative; height: 100%; overflow: hidden;">
                    <img src="{{ asset('storage/image/w6.jpg') }}" class="d-block w-100"
                        style="height: 100%; object-fit: cover;" alt="...">
                    <div
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6);">
                    </div>
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Ngargoyoso</h5>
                    <p>Kawasan dengan kebun teh yang memukau dan wisata sejarah yang menarik.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    {{-- ------------------ Menampilkan Data Total Wisata -------------------- --}}
    <section>
        <div class="container">
            <div class="card text-center mt-5 mb-5">
                <div class="card-header">
                    Data Wisata Yang Ada di Karanganyar
                </div>
                <div class="card-body">
                    <h1 class="card-title"> {{ $placeCount }} </h1>
                    <p class="card-text">Objek Wisata</p>
                    <a href="/rekomendasi" class="btn btn-gradient">Tempat Yang Cocok Untukmu </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Menampilkan Tempat wisata Maksimal 3 --}}
    <section>
        <div class="container mt-4">
            <h2 class="mb-4">Tempat Wisata</h2>
            <div class="row">
                @foreach ($places as $place)
                    <div class="col-md-4 mb-4"> <!-- Membagi baris menjadi 3 kolom -->
                        <div class="card text-white shadow-lg border-0" style="cursor: pointer; border-radius: 15px;"
                            data-bs-toggle="modal" data-bs-target="#modalDetail{{ $place->id }}">
                            <!-- Gambar -->
                            <img src="{{ asset('storage/' . $place->foto) }}" class="card-img"
                                style="height: 450px; object-fit: cover; border-radius: 15px;">

                            <!-- Overlay -->
                            <div class="card-img-overlay d-flex flex-column justify-content-between"
                                style="background: rgba(0, 0, 0, 0.6); border-radius: 15px;">
                                <!-- Bagian Atas (Nama Tempat) -->
                                <div class="mt-auto">
                                    <h5 class="card-title mb-2 fw-bold" style="font-size: 1.2rem;">{{ $place->nama }}</h5>
                                </div>

                                <!-- Bagian Bawah (Detail Lokasi, Harga, dan Rating) -->
                                <div>
                                    <!-- Kotak untuk Alamat -->
                                    <p class="card-text small mb-1 bg-gradient"
                                        style=" color: #ffffff; padding: 5px 10px; border-radius: 10px; display: inline-block;">
                                        {{ ucwords($place->location->nama) }}
                                    </p>
                                    <p class="card-text small mb-2 justify-center"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24">
                                            <g fill="none">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5" d="M6 10h4" />
                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                                    d="M21.998 12.5c0-.077.002-.533 0-.565c-.036-.501-.465-.9-1.005-.933c-.035-.002-.076-.002-.16-.002h-2.602C16.446 11 15 12.343 15 14s1.447 3 3.23 3h2.603c.084 0 .125 0 .16-.002c.54-.033.97-.432 1.005-.933c.002-.032.002-.488.002-.565" />
                                                <circle cx="18" cy="14" r="1" fill="currentColor" />
                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                                    d="M10 22h3c3.771 0 5.657 0 6.828-1.172c.809-.808 1.06-1.956 1.137-3.828m0-6c-.078-1.872-.328-3.02-1.137-3.828C18.657 6 16.771 6 13 6h-3C6.229 6 4.343 6 3.172 7.172S2 10.229 2 14s0 5.657 1.172 6.828c.653.654 1.528.943 2.828 1.07M6 6l3.735-2.477a3.24 3.24 0 0 1 3.53 0L17 6" />
                                            </g>
                                        </svg> Harga Tiket: Rp.
                                        {{ number_format($place->tiket->harga, 0, ',', '.') }} </p>
                                    <div class="d-flex align-items-center">
                                        <span class="text-warning me-1">
                                            <i class="fas fa-star"></i> <!-- Bintang Penuh -->
                                            <i class="fas fa-star"></i> <!-- Bintang Penuh -->
                                            <i class="fas fa-star"></i> <!-- Bintang Penuh -->
                                            <i class="fas fa-star"></i> <!-- Bintang Penuh -->
                                            <i class="fas fa-star-half-alt"></i> <!-- Bintang Setengah -->
                                        </span>
                                        <span>{{ $place->rating->rate }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Detail Wisata -->
                    <div class="modal fade" id="modalDetail{{ $place->id }}" tabindex="-1"
                        aria-labelledby="modalLabel{{ $place->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content"
                                style="border-radius: 20px; overflow: hidden; border: 1px solid #ddd;">
                                <!-- Modal Header with image -->
                                <div class="modal-header border-0 position-relative p-0">
                                    <button type="button"
                                        class="btn-close position-absolute top-0 end-0 m-3 bg-white p-2"
                                        data-bs-dismiss="modal" aria-label="Close" style="border-radius: 50%;"></button>
                                    <img src="{{ asset('storage/' . $place->foto) }}" alt="Foto Wisata"
                                        class="img-fluid w-100"
                                        style="max-height: 300px; object-fit: cover; border-radius: 15px;">
                                </div>
                                <!-- Modal Body with content -->
                                <div class="modal-body p-4">
                                    <!-- Title Section with a little space from top -->
                                    <h4 class="fw-bold mb-3 d-flex justify-content-between align-items-center"
                                        style="font-size: 1.75rem; line-height: 1.3;">
                                        {{ $place->nama }}
                                        <p class="mb-0 d-flex align-items-center" style="font-size: 1.2rem;">
                                            <i class="bi bi-star-fill text-warning me-2"></i>
                                            {{ $place->rating->rate }} / 5
                                        </p>
                                    </h4>

                                    <div class="row mb-3">
                                        <!-- Location Icon + Location -->
                                        <div class="col-12">
                                            <p class="card-text text-muted d-flex align-items-center"
                                                style="font-size: 1rem;">
                                                <i
                                                    class="bi bi-geo-alt text-warning me-2"></i>{{ ucwords($place->location->nama) }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <!-- Category with Icon -->
                                        <div class="col-12">
                                            <p class="card-text" style="font-size: 1rem;">
                                                <i class="bi bi-tags text-warning me-2"></i> Kategori: Wisata
                                                {{ ucwords($place->category->nama) }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <!-- Ticket Price with Icon -->
                                        <div class="col-12">
                                            <p class="card-text small text-muted d-flex align-items-center"
                                                style="font-size: 1rem;">
                                                <i class="bi bi-currency-dollar text-warning me-2"></i>
                                                Harga Tiket:
                                                <span
                                                    class="ms-1">{{ number_format($place->tiket->harga, 0, ',', '.') }}
                                                    IDR</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Description Section with text alignment and font style -->
                                        <div class="col-12">
                                            <p class="text-muted"
                                                style="font-size: 1.05rem; line-height: 1.6; color: #555;">
                                                {{ $place->deskripsi }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center mt-4 mb-4">
                    <nav>
                        <ul class="pagination pagination-lg"> <!-- Tambahkan kelas Bootstrap tambahan -->
                            {{ $places->links('pagination::bootstrap-5') }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    {{-- Carousel
    <!-- Tempat Wisata Section -->
    <section>
        <div class="container mt-4">
            <h2 class="mb-4">Tempat Wisata</h2>
            <div id="placesCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" id="carouselItems">
                    <!-- Konten carousel akan dimuat di sini -->
                </div>
                <!-- Tombol navigasi ke kanan -->
                <button class="carousel-control-next" type="button" data-bs-target="#placesCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                <!-- Tombol navigasi ke kiri -->
                <button class="carousel-control-prev" type="button" data-bs-target="#placesCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
            </div>
        </div>
    </section>

    <script>
        // Mengirim URL ke JavaScript
        var placesUrl = @json(route('places.index'));
    </script> --}}
    </section>

    {{-- ------------------ Footer -------------------- --}}
    <footer class="bg-light py-4">
        <div class="container">
            <div class="row text-center text-md-start align-items-center">
                <!-- Logo dan Deskripsi -->
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5 class="fw-bold">Rekta (Rekomendasi Wisata)</h5>
                    <p class="text-muted small">Solusi terbaik untuk mencari tempat liburan anda. Kami hadir untuk
                        memberikan
                        layanan terbaik.</p>
                </div>

                <!-- Link Navigasi -->
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5 class="fw-bold">Navigasi</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#" class="text-muted text-decoration-none">Beranda</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Tentang Kami</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Layanan</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Kontak</a></li>
                    </ul>
                </div>

                <!-- Ikon Sosial Media -->
                <div class="col-md-4">
                    <h5 class="fw-bold">Ikuti Kami</h5>
                    <div class="d-flex justify-content-center justify-content-md-start gap-3">
                        <a href="#" class="text-muted text-decoration-none" title="Facebook">
                            <i class="bi bi-facebook fs-4"></i>
                        </a>
                        <a href="#" class="text-muted text-decoration-none" title="Twitter">
                            <i class="bi bi-twitter fs-4"></i>
                        </a>
                        <a href="#" class="text-muted text-decoration-none" title="Instagram">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>
                        <a href="#" class="text-muted text-decoration-none" title="LinkedIn">
                            <i class="bi bi-linkedin fs-4"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center mt-4 small text-muted">
                &copy; {{ date('Y') }} Rekta. Semua Hak Dilindungi.
            </div>
        </div>
    </footer>

    <!-- Include Font Awesome for icons (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
