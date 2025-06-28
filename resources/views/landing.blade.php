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

    @if (session('berhasil'))
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                const toastLive = document.getElementById('mainToast');
                const toast = new bootstrap.Toast(toastLive);
                toast.show();
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Toast Container --}}
    <div class="bottom-0 p-3 position-fixed end-0" style="z-index: 1100">
        <div id="mainToast" class="border-0 toast align-items-center text-bg-success" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('berhasil') }}
                </div>
                <button type="button" class="m-auto btn-close btn-close-white me-2" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>


    {{-- Anda tidak perlu lagi menyertakan script Bootstrap di sini,
         karena sudah diurus oleh Vite melalui resources/js/app.js --}}
</body>

</html>
