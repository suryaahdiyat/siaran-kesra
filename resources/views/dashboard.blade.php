{{-- Menggunakan master layout dari layouts/app.blade.php --}}
@extends('layouts.app')

{{-- Mengisi bagian konten --}}
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Beranda</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Selamat Datang!</h6>
            </div>
            <div class="card-body">
                <p>
                    Halo, **{{ Auth::user()->name }}**! Anda telah berhasil login ke dalam Sistem Informasi Arsip Kesejahteraan Rakyat (SIARAN KESRA).
                </p>
                <p>
                    Peran Anda saat ini adalah: <strong>{{ ucfirst(Auth::user()->role) }}</strong>
                </p>
                <p class="mb-0">
                    Silakan gunakan menu di sebelah kiri untuk menavigasi sistem.
                </p>
            </div>
        </div>

        {{-- Anda bisa menambahkan konten dashboard lain di sini, seperti statistik --}}
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Surat Masuk</h5>
                        <p class="card-text fs-3">150</p>
                    </div>
                </div>
            </div>
             <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Surat Keluar</h5>
                        <p class="card-text fs-3">89</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection