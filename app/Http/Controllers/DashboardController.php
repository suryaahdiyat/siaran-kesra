<?php

namespace App\Http\Controllers;

// use App\Models\Liob;

use App\Models\DispensasiNikah;
use App\Models\Liob;
use App\Models\Lrp;
use App\Models\Rbk;
use App\Models\Rimd;
use App\Models\Riumk;
use App\Models\Rsku;
use App\Models\Sktm;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Li;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     */
    public function index()
    {
        // dd('Selamat datang di dashboard!');
        // $jumlahSuratMasuk = 0; // Ganti dengan logika untuk menghitung jumlah surat masuk
        // $jumlahSuratKeluar = 0; // Ganti dengan logika untuk menghitung jumlah surat keluar

        // $jumlahSuratMasuk = DispensasiNikah::where('file_surat_kua', '!=', null)->count();
        // $jumlahSuratMasuk += Sktm::where('file_sktm_before', '!=', null)->count();
        // $jumlahSuratMasuk += Rimd::where('file_rimd_before', '!=', null)->count();
        // $jumlahSuratMasuk += Liob::where('file_liob_before', '!=', null)->count();
        // $jumlahSuratMasuk += Riumk::where('file_riumk_before', '!=', null)->count();
        // $jumlahSuratMasuk += Lrp::where('file_lrp_before', '!=', null)->count();
        // $jumlahSuratMasuk += Rsku::where('file_rsku_before', '!=', null)->count();
        // $jumlahSuratMasuk += Rbk::where('file_rbk_before', '!=', null)->count();

        // $jumlahSuratKeluar = DispensasiNikah::where('file_dn_selesai', '!=', null)->count();
        // $jumlahSuratKeluar += Sktm::where('file_sktm_after', '!=', null)->count();
        // $jumlahSuratKeluar += Rimd::where('file_rimd_after', '!=', null)->count();
        // $jumlahSuratKeluar += Liob::where('file_liob_after', '!=', null)->count();
        // $jumlahSuratKeluar += Riumk::where('file_riumk_after', '!=', null)->count();
        // $jumlahSuratKeluar += Lrp::where('file_lrp_after', '!=', null)->count();
        // $jumlahSuratKeluar += Rsku::where('file_rsku_after', '!=', null)->count();
        // $jumlahSuratKeluar += Rbk::where('file_rbk_after', '!=', null)->count();
        $masukModels = [
            DispensasiNikah::class => 'file_surat_kua',
            Sktm::class => 'file_sktm_before',
            Rimd::class => 'file_rimd_before',
            Liob::class => 'file_liob_before',
            Riumk::class => 'file_riumk_before',
            Lrp::class => 'file_lrp_before',
            Rsku::class => 'file_rsku_before',
            Rbk::class => 'file_rbk_before',
        ];

        $keluarModels = [
            DispensasiNikah::class => 'file_dn_selesai',
            Sktm::class => 'file_sktm_after',
            Rimd::class => 'file_rimd_after',
            Liob::class => 'file_liob_after',
            Riumk::class => 'file_riumk_after',
            Lrp::class => 'file_lrp_after',
            Rsku::class => 'file_rsku_after',
            Rbk::class => 'file_rbk_after',
        ];

        $jumlahSuratMasuk = 0;
        foreach ($masukModels as $model => $field) {
            $jumlahSuratMasuk += $model::whereNotNull($field)->count();
        }

        $jumlahSuratKeluar = 0;
        foreach ($keluarModels as $model => $field) {
            $jumlahSuratKeluar += $model::whereNotNull($field)->count();
        }

        $dMPria = DB::table('dispensasi_nikahs')
            ->whereNotNull('file_surat_kua')
            ->select('desa_pria', DB::raw('count(*) as total'))
            ->groupBy('desa_pria')
            ->pluck('total', 'desa_pria');

        $dMWanita = DB::table('dispensasi_nikahs')
            ->whereNotNull('file_surat_kua')
            ->select('desa_wanita', DB::raw('count(*) as total'))
            ->groupBy('desa_wanita')
            ->pluck('total', 'desa_wanita');

        $dKPria = DB::table('dispensasi_nikahs')
            ->whereNotNull('file_dn_selesai')
            ->select('desa_pria', DB::raw('count(*) as total'))
            ->groupBy('desa_pria')
            ->pluck('total', 'desa_pria');

        $dKWanita = DB::table('dispensasi_nikahs')
            ->whereNotNull('file_dn_selesai')
            ->select('desa_wanita', DB::raw('count(*) as total'))
            ->groupBy('desa_wanita')
            ->pluck('total', 'desa_wanita');

        $sktmMasuk = DB::table('sktms')
            ->whereNotNull('file_sktm_before')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $sktmKeluar = DB::table('sktms')
            ->whereNotNull('file_sktm_after')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $rimdMasuk = DB::table('rimds')
            ->whereNotNull('file_rimd_before')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $rimdKeluar = DB::table('rimds')
            ->whereNotNull('file_rimd_after')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $liobMasuk = DB::table('liobs')
            ->whereNotNull('file_liob_before')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $liobKeluar = DB::table('liobs')
            ->whereNotNull('file_liob_after')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $riumkMasuk = DB::table('riumks')
            ->whereNotNull('file_riumk_before')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $riumkKeluar = DB::table('riumks')
            ->whereNotNull('file_riumk_after')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $lrpMasuk = DB::table('lrps')
            ->whereNotNull('file_lrp_before')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $lrpKeluar = DB::table('lrps')
            ->whereNotNull('file_lrp_after')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $rskuMasuk = DB::table('rskus')
            ->whereNotNull('file_rsku_before')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $rskuKeluar = DB::table('rskus')
            ->whereNotNull('file_rsku_after')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $rbkMasuk = DB::table('rbks')
            ->whereNotNull('file_rbk_before')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $rbkKeluar = DB::table('rbks')
            ->whereNotNull('file_rbk_after')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $slMasuk = DB::table('sls')
            ->whereNotNull('file_sl_before')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        $slKeluar = DB::table('sls')
            ->whereNotNull('file_sl_after')
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');

        return view('dashboard', compact('jumlahSuratMasuk', 'jumlahSuratKeluar', 'dMPria', 'dMWanita',  'dKPria', 'dKWanita', 'sktmMasuk', 'sktmKeluar', 'rimdMasuk', 'rimdKeluar', 'liobMasuk', 'liobKeluar', 'riumkMasuk', 'riumkKeluar', 'lrpMasuk', 'lrpKeluar', 'rskuMasuk', 'rskuKeluar', 'rbkMasuk', 'rbkKeluar', 'slMasuk', 'slKeluar'));
    }
}
