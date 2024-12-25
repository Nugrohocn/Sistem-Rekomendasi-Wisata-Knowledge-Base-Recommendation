@extends('layouts.app')

@section('content')
    <form class="container mt-3" action="{{ route('rekomendasi') }}" method="POST">
        @csrf
        <fieldset>
            <legend>Kami Akan Membantumu Untuk Menemukan Tempat Wisata Yang Cocok Untukmu</legend>
            <div class="row">
                <!-- Kategori -->
                <div class="col-md-6 mb-3">
                    <label for="kategori" class="form-label ">Kategori</label>
                    <select id="kategori" name="kategori" class="form-select">
                        <option value=""> --Pilih Wisata-- </option>
                        <option value="alam">Wisata Alam</option>
                        <option value="buatan">Wisata Buatan</option>
                        <option value="budaya">Wisata Budaya</option>
                    </select>
                </div>

                <!-- Lokasi -->
                <div class="col-md-6 mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <select id="lokasi" name="lokasi" class="form-select">
                        <option value="">--Pilih Lokasi--</option>
                        <option value="tawangmangu">Tawangmangu</option>
                        <option value="tasikmadu">Tasikmadu</option>
                        <option value="ngargoyoso">Ngargoyoso</option>
                        <option value="kerjo">Kerjo</option>
                        <option value="karangpandan">Karangpandan</option>
                        <option value="jenawi">Jenawi</option>
                        <option value="matesih">Matesih</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <!-- Harga Tiket -->
                <div class="col-md-6 mb-3">
                    <label for="harga" class="form-label">Harga Tiket</label>
                    <select id="harga" class="form-select" name="harga">
                        <option value="">--Pilih Harga Tiket--</option>
                        <option value="murah">Murah (5.000 - 10.000)</option>
                        <option value="sedang">Sedang (10.000 - 15.000)</option>
                        <option value="mahal">Mahal (15.000 - 25.000)</option>
                    </select>
                </div>

                <!-- Rating -->
                <div class="col-md-6 mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <select id="rating" class="form-select" name="rating">
                        <option value="">--Pilih Rating--</option>
                        <option value="1.0">Bintang 1</option>
                        <option value="2.0">Bintang 2</option>
                        <option value="3.0">Bintang 3</option>
                        <option value="4.0">Bintang 4</option>
                        <option value="5.0">Bintang 5</option>
                    </select>
                </div>

                <!-- Fasilitas -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fasilitas</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="parkir"
                                id="parkir">
                            <label class="form-check-label" for="parkir">Parkir</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="toilet"
                                id="toilet">
                            <label class="form-check-label" for="toilet">Toilet</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="mushola"
                                id="mushola">
                            <label class="form-check-label" for="mushola">Mushola</label>
                        </div>
                    </div>
                </div>
                <button type="submit" style="color: white" class="btn btn-gradient">Rekomendasikan</button>
        </fieldset>
    </form>
@endsection
