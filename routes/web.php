<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\DispensasiNikahController;

/*
|--------------------------------------------------------------------------
| RUTE PUBLIK (TIDAK PERLU LOGIN)
|--------------------------------------------------------------------------
|
| Rute-rute ini bisa diakses oleh siapa saja.
|
*/

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// Rute untuk menampilkan & mengirim form dispensasi nikah dari halaman publik
Route::get('/dispensasi-nikah/create', [DispensasiNikahController::class, 'create'])->name('dispensasi.create');
Route::post('/dispensasi-nikah', [DispensasiNikahController::class, 'store'])->name('dispensasi.store');


/*
|--------------------------------------------------------------------------
| RUTE YANG MEMERLUKAN LOGIN
|--------------------------------------------------------------------------
|
| Semua rute di dalam grup ini akan otomatis dilindungi oleh middleware
| 'auth' (harus login) dan 'verified' (jika verifikasi email diaktifkan).
|
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // --- Rute Dashboard & Profile (Bawaan Breeze) ---
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dispensasi/{id}/generate-pdf', [DispensasiNikahController::class, 'generateSuratPDF'])->name('dispensasi.generatePDF');


    // --- Grup untuk Fitur Arsip Umum ---
    // URL akan menjadi /arsip, /arsip/upload, dst.
    Route::prefix('arsip')->name('arsip.')->group(function () {

        // Rute yang bisa diakses Keduanya (Staff & Kepala Bidang)
        Route::middleware('role:staff,kepala_bidang')->group(function () {
            Route::get('/', [ArsipController::class, 'index'])->name('index');
            Route::get('/{id}/download', [ArsipController::class, 'download'])->name('download');
        });

        // Rute yang hanya bisa diakses Staff
        Route::middleware('role:staff')->group(function () {
            Route::get('/upload', [ArsipController::class, 'create'])->name('create');
            Route::post('/', [ArsipController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ArsipController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ArsipController::class, 'update'])->name('update');
            Route::delete('/{id}', [ArsipController::class, 'destroy'])->name('destroy');
        });
    });


    // --- Grup untuk Fitur Admin (Bisa ditambahkan fitur lain nanti) ---
    // URL akan menjadi /admin/dispensasi-nikah, dst.
    Route::prefix('admin')->name('admin.')->group(function () {

        // Rute untuk menampilkan tabel data dispensasi nikah
        Route::get('/dispensasi-nikah', [DispensasiNikahController::class, 'index'])
            ->middleware('role:staff,kepala_bidang') // Hanya staff & kabid
            ->name('dispensasi.index');

        // Tambahkan rute admin lain di sini...
    });
});




/*
|--------------------------------------------------------------------------
| Rute Autentikasi (Bawaan Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
