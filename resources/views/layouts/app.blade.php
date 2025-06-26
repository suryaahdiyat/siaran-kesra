<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIARAN KESRA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: row;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 280px;
            min-height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #c2c7d0;
            font-size: 1rem;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background-color: #495057;
        }
        .sidebar .nav-link .bi {
            margin-right: 10px;
        }
        .sidebar .nav-item .collapse .nav-link, .sidebar .nav-item .collapsing .nav-link {
            padding-left: 40px;
            font-size: 0.9rem;
        }
        .sidebar-header {
            color: #fff;
            padding: 0 1.5rem 1rem 1.5rem;
            text-align: center;
        }
        .main-content {
            flex-grow: 1;
            padding: 30px;
            overflow-x: auto;
        }
    </style>
</head>
<body>

<div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white bg-dark">
    <div class="sidebar-header">
        <h4>SIARAN KESRA</h4>
        <hr>
    </div>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">
                <i class="bi bi-house-door-fill"></i>Beranda
            </a>
        </li>
        <li>
            <a href="#suratMasukSubmenu" data-bs-toggle="collapse" class="nav-link">
                <i class="bi bi-arrow-down-square-fill"></i>Surat Masuk
            </a>
            <ul class="collapse list-unstyled nav flex-column" id="suratMasukSubmenu">
                <li><a href="{{ route('admin.dispensasi.index') }}" class="nav-link text-white">Dispensasi Nikah</a></li>
                <li><a href="#" class="nav-link">Surat Keterangan Tidak Mampu</a></li>
                <li><a href="#" class="nav-link">Rekomendasi Izin Mencari Dana</a></li>
                <li><a href="#" class="nav-link">Legalisasi Izin Orang Banyak</a></li>
                <li><a href="#" class="nav-link">Rekomendasi Izin UMK</a></li>
                <li><a href="#" class="nav-link">Legalisasi & Rekomendasi Proposal</a></li>
                <li><a href="#" class="nav-link">Rekomendasi SKU</a></li>
                <li><a href="#" class="nav-link">Rekomendasi Bantuan Keagamaan</a></li>
            </ul>
        </li>
        <li>
            <a href="#suratKeluarSubmenu" data-bs-toggle="collapse" class="nav-link">
                <i class="bi bi-arrow-up-square-fill"></i>Surat Keluar
            </a>
            <ul class="collapse list-unstyled nav flex-column" id="suratKeluarSubmenu">
                <li><a href="#" class="nav-link">Dispensasi Nikah</a></li>
                <li><a href="#" class="nav-link">Surat Keterangan Tidak Mampu</a></li>
                <li><a href="#" class="nav-link">Rekomendasi Izin Mencari Dana</a></li>
                <li><a href="#" class="nav-link">Legalisasi Izin Orang Banyak</a></li>
                <li><a href="#" class="nav-link">Rekomendasi Izin UMK</a></li>
                <li><a href="#" class="nav-link">Legalisasi & Rekomendasi Proposal</a></li>
                <li><a href="#" class="nav-link">Rekomendasi SKU</a></li>
                <li><a href="#" class="nav-link">Rekomendasi Bantuan Keagamaan</a></li>
            </ul>
        </li>
        <hr>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link text-white"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="bi bi-box-arrow-left"></i>Logout
                </a>
            </form>
        </li>
    </ul>
</div>

<div class="main-content">
    @yield('content')
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>