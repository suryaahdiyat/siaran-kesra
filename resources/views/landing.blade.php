<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIARAN KESRA - Arsip Kesejahteraan Rakyat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    {{-- <div class="bg-hero">
        <div class="hero-text">
            <div class="container">
                <h1 class="display-4">Selamat Datang di SIARAN KESRA</h1>
                <p class="lead">Sistem Informasi Arsip untuk Pelayanan Kesejahteraan Rakyat.</p>
                <hr class="my-4" style="border-color: white;">
                <div>
                    <a href="{{ route('dispensasi.create') }}" class="btn btn-primary btn-lg btn-action">
                        Buat Dispensasi Nikah Online
                    </a>

                    <a href="{{ route('login') }}" class="btn btn-success btn-lg btn-action">
                        Login Aparatur
                    </a>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="py-5 text-center text-white bg-hero"
        style="background: url('/path-to-hero-image.jpg') no-repeat center center; background-size: cover;">
        <div class="hero-text d-flex align-items-center justify-content-center h-100">
            <div class="container">
                <h1 class="display-4 fw-bold text-success">Selamat Datang di SIARAN KESRA</h1>
                <p class="mt-3 lead text-success">Sistem Informasi Arsip untuk Pelayanan Kesejahteraan Rakyat.</p>
                <div class="gap-3 mt-3 d-flex flex-column flex-md-row justify-content-center">
                    <a href="{{ route('dispensasi.create') }}" class="btn btn-primary btn-lg">
                        Buat Dispensasi Nikah Online
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg">
                        Login Aparatur
                    </a>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="text-center text-white bg-hero"
        style="background: url({{ asset('images/Kantor_Kecamatan_Mandastana,_Barito_Kuala.JPG') }}) no-repeat center center; background-size: cover;">
        <div class="d-flex align-items-center justify-content-center vh-100 ">
            <div class="">
                <h1 class="display-4 fw-bold text-success">Selamat Datang di SIARAN KESRA</h1>
                <p class="mt-3 lead text-success">Sistem Informasi Arsip untuk Pelayanan Kesejahteraan Rakyat.</p>
                <div class="gap-3 mt-4 d-flex flex-column flex-md-row justify-content-center">
                    <a href="{{ route('dispensasi.create') }}" class="btn btn-primary btn-lg">
                        Buat Dispensasi Nikah Online
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg">
                        Login Aparatur
                    </a>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="text-center text-white position-relative" style="min-height: 100vh;">

        <!-- Background Image -->
        <div class="top-0 position-absolute start-0 w-100 h-100"
            style="background: url('{{ asset('images/Kantor_Kecamatan_Mandastana,_Barito_Kuala.JPG') }}') no-repeat center center;
               background-size: cover; z-index: 0;">
        </div>

        <!-- Overlay Gelap -->
        <div class="top-0 position-absolute start-0 w-100 h-100"
            style="background-color: rgba(0, 0, 0, 0.8); z-index: 1;">
        </div>

        <!-- Konten -->
        <div class="d-flex align-items-center justify-content-center vh-100 position-relative" style="z-index: 2;">
            <div>
                <h1 class="display-4 fw-bold text-success">Selamat Datang di SIARAN KESRA</h1>
                <p class="mt-3 lead text-success fw-semibold">Sistem Informasi Arsip untuk Pelayanan Kesejahteraan
                    Rakyat.</p>
                <div class="gap-3 mt-4 d-flex flex-column flex-md-row justify-content-center">
                    <a href="{{ route('dispensasi.create') }}" class="btn btn-primary btn-lg">
                        Buat Dispensasi Nikah Online
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg">
                        Login Aparatur
                    </a>
                </div>
            </div>
        </div>
    </div>




    {{-- Anda tidak perlu lagi menyertakan script Bootstrap di sini,
         karena sudah diurus oleh Vite melalui resources/js/app.js --}}
</body>

</html>
