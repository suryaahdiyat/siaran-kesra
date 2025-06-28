<?php

use App\Http\Controllers\Liob2Controller;
use App\Http\Controllers\Lrp2Controller;
use App\Http\Controllers\Riumk2Controller;
use App\Http\Controllers\Rsku2Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\DispensasiNikahController;
use App\Http\Controllers\DispensasiNikah2Controller;
use App\Http\Controllers\LiobController;
use App\Http\Controllers\LrpController;
use App\Http\Controllers\Rbk2Controller;
use App\Http\Controllers\RbkController;
use App\Http\Controllers\Rimd2Controller;
use App\Http\Controllers\RimdController;
use App\Http\Controllers\RiumkController;
use App\Http\Controllers\RskuController;
use App\Http\Controllers\Sktm2Controller;
use App\Http\Controllers\SktmController;
use App\Models\DispensasiNikah;

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
    // Route::prefix('arsip')->name('arsip.')->group(function () {

    //     // Rute yang bisa diakses Keduanya (Staff & Kepala Bidang)
    //     Route::middleware('role:staff,kepala_bidang')->group(function () {
    //         Route::get('/', [ArsipController::class, 'index'])->name('index');
    //         Route::get('/{id}/download', [ArsipController::class, 'download'])->name('download');
    //     });

    //     // Rute yang hanya bisa diakses Staff
    //     Route::middleware('role:staff')->group(function () {
    //         Route::get('/upload', [ArsipController::class, 'create'])->name('create');
    //         Route::post('/', [ArsipController::class, 'store'])->name('store');
    //         Route::get('/{id}/edit', [ArsipController::class, 'edit'])->name('edit');
    //         Route::put('/{id}', [ArsipController::class, 'update'])->name('update');
    //         Route::delete('/{id}', [ArsipController::class, 'destroy'])->name('destroy');
    //     });
    // });


    // --- Grup untuk Fitur Admin (Bisa ditambahkan fitur lain nanti) ---
    // URL akan menjadi /admin/dispensasi-nikah, dst.
    Route::prefix('admin')->name('admin.')->group(function () {

        // Rute untuk menampilkan tabel data dispensasi nikah
        Route::get('/dispensasi-nikah', [DispensasiNikahController::class, 'index'])
            ->middleware('role:staff,kepala_bidang') // Hanya staff & kabid
            ->name('dispensasi.index');

        Route::get('/dispensasi-nikah/{id}/edit', [DispensasiNikahController::class, 'edit'])
            ->middleware('role:staff,kepala_bidang') // Hanya staff & kabid
            ->name('dispensasi.edit');
        Route::put('/dispensasi-nikah/{id}', [DispensasiNikahController::class, 'update'])
            ->middleware('role:staff,kepala_bidang') // Hanya staff & kabid
            ->name('dispensasi.update');
        Route::delete('/dispensasi-nikah/{id}', [DispensasiNikahController::class, 'destroy'])
            ->middleware('role:staff,kepala_bidang') // Hanya staff & kabid
            ->name('dispensasi.destroy');



        Route::resource('/dispensasi2', DispensasiNikah2Controller::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/sktm', SktmController::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/sktm2', Sktm2Controller::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/rimd', RimdController::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/rimd2', Rimd2Controller::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/liob', LiobController::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/liob2', Liob2Controller::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/riumk', RiumkController::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/riumk2', Riumk2Controller::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/lrp', LrpController::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/lrp2', Lrp2Controller::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/rsku', RskuController::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/rsku2', Rsku2Controller::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/rbk', RbkController::class)->middleware('role:staff,kepala_bidang');
        Route::resource('/rbk2', Rbk2Controller::class)->middleware('role:staff,kepala_bidang');
        // Tambahkan rute admin lain di sini...
    });
});




/*
|--------------------------------------------------------------------------
| Rute Autentikasi (Bawaan Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
