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

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #495057;
        }

        .sidebar .nav-link .bi {
            margin-right: 10px;
        }

        .sidebar .nav-item .collapse .nav-link,
        .sidebar .nav-item .collapsing .nav-link {
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

    <div class="flex-shrink-0 p-3 text-white sidebar d-flex flex-column bg-dark">
        <div class="sidebar-header">
            <h4>SIARAN KESRA</h4>
            <hr>
        </div>
        <ul class="mb-auto nav nav-pills flex-column ">
            <li class="nav-item">
                <a href="/dashboard" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}"
                    aria-current="page">
                    <i class="bi bi-house-door-fill"></i>Beranda
                </a>
            </li>
            <li>
                <a href="#suratMasukSubmenu" data-bs-toggle="collapse" class="nav-link">
                    <i class="bi bi-arrow-down-square-fill"></i> Surat Masuk
                </a>
                <ul class="collapse list-unstyled nav flex-column {{ Request::routeIs(
                    'admin.dispensasi.*',
                    'admin.sktm.*',
                    'admin.rimd.*',
                    'admin.liob.*',
                    'admin.riumk.*',
                    'admin.lrp.*',
                    'admin.rsku.*',
                    'admin.rbk.*',
                )
                    ? 'show'
                    : '' }}"
                    id="suratMasukSubmenu">
                    <li>
                        <a href="{{ route('admin.dispensasi.index') }}"
                            class="nav-link {{ Request::routeIs('admin.dispensasi.*') ? 'active text-white' : '' }}">
                            Dispensasi Nikah
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sktm.index') }}"
                            class="nav-link {{ Request::routeIs('admin.sktm.*') ? 'active text-white' : '' }}">
                            Surat Keterangan Tidak Mampu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.rimd.index') }}"
                            class="nav-link {{ Request::routeIs('admin.rimd.*') ? 'active text-white' : '' }}">
                            Rekomendasi Izin Mencari Dana
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.liob.index') }}"
                            class="nav-link {{ Request::routeIs('admin.liob.*') ? 'active text-white' : '' }}">
                            Legalisasi Izin Orang Banyak
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.riumk.index') }}"
                            class="nav-link {{ Request::routeIs('admin.riumk.*') ? 'active text-white' : '' }}">
                            Rekomendasi Izin UMK
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.lrp.index') }}"
                            class="nav-link {{ Request::routeIs('admin.lrp.*') ? 'active text-white' : '' }}">
                            Legalisasi & Rekomendasi Proposal
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.rsku.index') }}"
                            class="nav-link {{ Request::routeIs('admin.rsku.*') ? 'active text-white' : '' }}">
                            Rekomendasi SKU
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.rbk.index') }}"
                            class="nav-link {{ Request::routeIs('admin.rbk.*') ? 'active text-white' : '' }}">
                            Rekomendasi Bantuan Keagamaan
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#suratKeluarSubmenu" data-bs-toggle="collapse" class="nav-link">
                    <i class="bi bi-arrow-up-square-fill"></i> Surat Keluar
                </a>
                <ul class="collapse list-unstyled nav flex-column {{ Request::routeIs(
                    'admin.dispensasi2.*',
                    'admin.sktm2.*',
                    'admin.rimd2.*',
                    'admin.liob2.*',
                    'admin.riumk2.*',
                    'admin.lrp2.*',
                    'admin.rsku2.*',
                    'admin.rbk2.*',
                )
                    ? 'show'
                    : '' }}"
                    id="suratKeluarSubmenu">
                    <li>
                        <a href="{{ route('admin.dispensasi2.index') }}"
                            class="nav-link {{ Request::routeIs('admin.dispensasi2.*') ? 'active text-white' : '' }}">
                            Dispensasi Nikah
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sktm2.index') }}"
                            class="nav-link {{ Request::routeIs('admin.sktm2.*') ? 'active text-white' : '' }}">
                            Surat Keterangan Tidak Mampu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.rimd2.index') }}"
                            class="nav-link {{ Request::routeIs('admin.rimd2.*') ? 'active text-white' : '' }}">
                            Rekomendasi Izin Mencari Dana
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.liob2.index') }}"
                            class="nav-link {{ Request::routeIs('admin.liob2.*') ? 'active text-white' : '' }}">
                            Legalisasi Izin Orang Banyak
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.riumk2.index') }}"
                            class="nav-link {{ Request::routeIs('admin.riumk2.*') ? 'active text-white' : '' }}">
                            Rekomendasi Izin UMK
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.lrp2.index') }}"
                            class="nav-link {{ Request::routeIs('admin.lrp2.*') ? 'active text-white' : '' }}">
                            Legalisasi & Rekomendasi Proposal
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.rsku2.index') }}"
                            class="nav-link {{ Request::routeIs('admin.rsku2.*') ? 'active text-white' : '' }}">
                            Rekomendasi SKU
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.rbk2.index') }}"
                            class="nav-link {{ Request::routeIs('admin.rbk2.*') ? 'active text-white' : '' }}">
                            Rekomendasi Bantuan Keagamaan
                        </a>
                    </li>
                </ul>

            </li>
            <hr>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="text-white nav-link"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="bi bi-box-arrow-left"></i>Logout
                    </a>
                </form>
            </li>
        </ul>
    </div>

    <div class="main-content">
        @yield('content')
        @if (session('berhasil'))
            <script>
                window.addEventListener('DOMContentLoaded', (event) => {
                    const toastLive = document.getElementById('mainToast');
                    const toast = new bootstrap.Toast(toastLive);
                    toast.show();
                });
            </script>
        @endif

    </div>


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

</body>

</html>
