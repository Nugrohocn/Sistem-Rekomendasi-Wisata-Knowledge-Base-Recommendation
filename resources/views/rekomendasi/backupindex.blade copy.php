@extends('layouts.app')

@section('content')
    <form class="container mt-3">
        <fieldset>
            <legend>Kami Akan Membantu Kamu Untuk Menemukan Tempat Wisata Yang Cocok Untukmu</legend>
            <div class="row">
                <!-- Kategori -->
                <div class="col-md-4 mb-3">
                    <label for="kategoriSelect" class="form-label ">Kategori</label>
                    <select id="kategoriSelect" class="form-select">
                        @foreach ($categories as $item)
                            <option>{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Lokasi -->
                <div class="col-md-4 mb-3">
                    <label for="lokasiSelect" class="form-label">Lokasi</label>
                    <select id="lokasiSelect" class="form-select">
                        @foreach ($locations as $item)
                            <option>{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Rating -->
                <div class="col-md-4 mb-3">
                    <label for="ratingSelect" class="form-label">Rating</label>
                    <select id="ratingSelect" class="form-select">
                        @foreach ($ratings as $item)
                            <option>{{ $item->rate }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <!-- Harga Tiket -->
                <div class="col-md-4 mb-3">
                    <label for="hargaSelect" class="form-label">Harga Tiket</label>
                    <select id="hargaSelect" class="form-select">
                        @foreach ($places as $item)
                            <option>{{ $item->harga_tiket }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Fasilitas -->
                <div class="col-md-4 mb-3">
                        <label for="waktuSelect" class="form-label">Fasilitas</label>
                        <select id="waktuSelect" class="form-select">
                            <option>Parkir</option>
                            <option>Mushola</option>
                            <option>Toilet</option>
                        </select>
                </div>
            </div>

            <button type="submit" style="color: white" class="btn btn-gradient">Rekomendasikan</button>
        </fieldset>
    </form>

    {{-- Modal --}}
    <!-- Scrollable modal -->
    {{-- <div class="modal-dialog modal-dialog-scrollable">
        <p>Halo</p>
    </div> --}}

    {{-- Jquery --}}
@endsection
