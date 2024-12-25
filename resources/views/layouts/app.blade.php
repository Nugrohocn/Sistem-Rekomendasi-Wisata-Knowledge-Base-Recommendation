<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Javascript Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>Rekta | Teman Wisatamu</title>
    <style>
        .navbar {
            z-index: 1000;
            /* Menentukan z-index yang lebih tinggi */
        }

        .btn-gradient {
            background-image: linear-gradient(to right, #007bff, #00c6ff);
            border: none;
            color: white;
        }

        .btn-gradient:hover {
            background-image: linear-gradient(to right, #0056b3, #0096c7);
            /* Warna saat di-hover */
            color: white;
        }

        #map {

            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('storage/image/rekta.png') }}" alt="Sobo" class="img-fluid me-2"
                    style="max-width: 70px;">
            </a>

            <!-- Toggler Button -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link {{ request()->is('/') ? 'active text-primary fw-bold' : 'text-dark' }}"
                        href="/">Dashboard</a>
                    <a class="nav-link {{ request()->is('rekomendasi') ? 'active text-primary fw-bold' : 'text-dark' }}"
                        href="/rekomendasi">Rekomendasi</a>
                    <a class="nav-link {{ request()->is('about') ? 'active text-primary fw-bold' : 'text-dark' }}"
                        href="/about">About</a>
                </div>
            </div>
        </div>
    </nav>


    @yield('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Tambahkan Link ke file places.js -->
    <script src="{{ asset('js/places.js') }}"></script>


</body>

</html>
