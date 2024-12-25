@extends('layouts.app')

@section('content')
    {{-- ----- Hasil ------ --}}
    <div class="container mt-4">
        <h2 class="mb-4">Hasil Rekomendasi</h2>
        <div class="row">
            @foreach ($rekomendasi as $item)
                <div class="col-md-4 mb-4"> <!-- Membagi baris menjadi 3 kolom -->
                    <div class="card text-white shadow-lg border-0" style="cursor: pointer; border-radius: 15px;"
                        data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item['wisata']->id }}">
                        <!-- Gambar -->
                        <img src="{{ asset('storage/' . $item['wisata']->foto) }}" class="card-img"
                            style="height: 450px; object-fit: cover; border-radius: 15px;">

                        <!-- Overlay -->
                        <div class="card-img-overlay d-flex flex-column justify-content-between"
                            style="background: rgba(0, 0, 0, 0.6); border-radius: 15px;">
                            <!-- Bagian Atas (Nama Tempat) -->
                            <div class="mt-auto">
                                <h5 class="card-title mb-2 fw-bold" style="font-size: 1.2rem;">{{ $item['wisata']->nama }}
                                </h5>
                            </div>

                            <!-- Bagian Bawah (Detail Lokasi, Harga, dan Rating) -->
                            <div>
                                <!-- Kotak untuk Alamat -->
                                <p class="card-text small mb-1 bg-gradient"
                                    style=" color: #ffffff; padding: 5px 10px; border-radius: 10px; display: inline-block;">
                                    {{ ucwords($item['wisata']->location->nama) }}
                                </p>
                                <p class="card-text small mb-2"><i class="bi bi-cash"></i> Harga Tiket: Rp.
                                    {{ number_format($item['wisata']->tiket->harga, 0, ',', '.') }} </p>
                                {{-- <span>Similarity :{{ number_format($item['similarity'], 2) }}</span> --}}

                                <div class="d-flex align-items-center">
                                    <span class="text-warning me-1">
                                        <i class="fas fa-star"></i> <!-- Bintang Penuh -->
                                        <i class="fas fa-star"></i> <!-- Bintang Penuh -->
                                        <i class="fas fa-star"></i> <!-- Bintang Penuh -->
                                        <i class="fas fa-star"></i> <!-- Bintang Penuh -->
                                        <i class="fas fa-star-half-alt"></i> <!-- Bintang Setengah -->
                                    </span>
                                    <span>{{ $item['wisata']->rating->rate }}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail Wisata -->
                {{-- <div class="modal fade" id="modalDetail{{ $item['wisata']->id }}" tabindex="-1"
                    aria-labelledby="modalLabel{{ $item['wisata']->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content" style="border-radius: 20px; overflow: hidden;">
                            <div class="modal-header border-0 position-relative">
                                <button type="button" class="btn-close position-absolute top-0 end-0 m-3 bg-white p-2"
                                    data-bs-dismiss="modal" aria-label="Close" style="border-radius: 50%;"></button>
                                <img src="{{ asset('storage/' . $item['wisata']->foto) }}" alt="Foto Wisata"
                                    class="img-fluid w-100" style="max-height: 300px; object-fit: cover;">
                            </div>
                            <div class="modal-body text-center">
                                <h4 class="fw-bold text-primary">{{ $item['wisata']->nama }}</h4>
                                <p class="card-text">{{ ucwords($item['wisata']->location->nama) }}</p>
                                <p class="card-text">{{ ucwords($item['wisata']->alamat) }}</p>
                                <p class="card-text small">Tiket Masuk : {{ ucwords($item['wisata']->tiket->harga) }}</p>
                                <p class="text-muted mb-3">⭐ {{ $item['wisata']->rating->rate }} / 5</p>
                                <p class="text-muted">{{ $item['wisata']->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- End of Modal --}}
                {{-- Modal Baru --}}
                <div class="modal fade" id="modalDetail{{ $item['wisata']->id }}" tabindex="-1"
                    aria-labelledby="modalLabel{{ $item['wisata']->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: 1px solid #ddd;">
                            <!-- Modal Header with image -->
                            <div class="modal-header border-0 position-relative p-0">
                                <button type="button" class="btn-close position-absolute top-0 end-0 m-3 bg-white p-2"
                                    data-bs-dismiss="modal" aria-label="Close" style="border-radius: 50%;"></button>
                                <img src="{{ asset('storage/' . $item['wisata']->foto) }}" alt="Foto Wisata"
                                    class="img-fluid w-100"
                                    style="max-height: 300px; object-fit: cover; border-radius: 15px;">
                            </div>
                            <!-- Modal Body with content -->
                            <div class="modal-body p-4">
                                <!-- Title Section with a little space from top -->
                                <h4 class="fw-bold mb-3 d-flex justify-content-between align-items-center"
                                    style="font-size: 1.75rem; line-height: 1.3;">
                                    {{ $item['wisata']->nama }}
                                    <p class="mb-0 d-flex align-items-center" style="font-size: 1.2rem;">
                                        <i class="bi bi-star-fill text-warning me-2"></i>
                                        {{ $item['wisata']->rating->rate }} / 5
                                    </p>
                                </h4>

                                <div class="row mb-3">
                                    <!-- Location Icon + Location -->
                                    <div class="col-12">
                                        <p class="card-text text-muted d-flex align-items-center" style="font-size: 1rem;">
                                            <i
                                                class="bi bi-geo-alt text-warning me-2"></i>{{ ucwords($item['wisata']->alamat) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Category with Icon -->
                                    <div class="col-12">
                                        <p class="card-text" style="font-size: 1rem;">
                                            <i class="bi bi-tags text-warning me-2"></i> Kategori: Wisata
                                            {{ ucwords($item['wisata']->category->nama) }}
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
                                                class="ms-1">{{ number_format($item['wisata']->tiket->harga, 0, ',', '.') }}
                                                IDR</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Description Section with text alignment and font style -->
                                    <div class="col-12">
                                        <p class="text-muted" style="font-size: 1.05rem; line-height: 1.6; color: #555;">
                                            {{ $item['wisata']->deskripsi }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End of Modal Baru --}}
            @endforeach
        </div>
        <a href="{{ route('rekomendasi') }}" class="btn btn-primary btn-gradient mb-5">Cari Rekomendasi Lain</a>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
