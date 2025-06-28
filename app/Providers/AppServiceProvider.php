<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Set locale Carbon ke bahasa Indonesia
        Carbon::setLocale('id');

        // Jika ingin semua tampilan format tanggal Laravel ikut terlokalisasi
        App::setLocale('id');
    }
}
