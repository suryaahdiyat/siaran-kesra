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
use App\Models\Sl;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Li;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     */
    public function index()
    {
        $bulan = request('bulan');
        $tahun = request('tahun');

        $queryFilter = function ($q) use ($bulan, $tahun) {
            if ($bulan) {
                $q->whereMonth('created_at', $bulan);
            }
            if ($tahun) {
                $q->whereYear('created_at', $tahun);
            }
        };


        $masukModels = [
            DispensasiNikah::class => 'file_surat_kua',
            Sktm::class => 'file_sktm_before',
            Rimd::class => 'file_rimd_before',
            Liob::class => 'file_liob_before',
            Riumk::class => 'file_riumk_before',
            Lrp::class => 'file_lrp_before',
            Rsku::class => 'file_rsku_before',
            Rbk::class => 'file_rbk_before',
            Sl::class => 'file_sl_before',
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
            SL::class => 'file_sl_after',
        ];

        $jumlahSuratMasuk = 0;
        foreach ($masukModels as $model => $field) {
            $jumlahSuratMasuk += $model::whereNotNull($field)->where($queryFilter)->count();
        }

        $jumlahSuratKeluar = 0;
        foreach ($keluarModels as $model => $field) {
            $jumlahSuratKeluar += $model::whereNotNull($field)->where($queryFilter)->count();
        }

        // $dMPria = DB::table('dispensasi_nikahs')
        //     ->whereNotNull('file_surat_kua')
        //     ->select('desa_pria', DB::raw('count(*) as total'))
        //     ->groupBy('desa_pria')
        //     ->pluck('total', 'desa_pria');

        // $dMWanita = DB::table('dispensasi_nikahs')
        //     ->whereNotNull('file_surat_kua')
        //     ->select('desa_wanita', DB::raw('count(*) as total'))
        //     ->groupBy('desa_wanita')
        //     ->pluck('total', 'desa_wanita');

        $dMPria = $this->getPerDesaDNCount('dispensasi_nikahs', 'file_surat_kua', $bulan, $tahun, 'desa_pria');
        $dMWanita = $this->getPerDesaDNCount('dispensasi_nikahs', 'file_surat_kua', $bulan, $tahun, 'desa_wanita');

        $dKPria = $this->getPerDesaDNCount('dispensasi_nikahs', 'file_dn_selesai', $bulan, $tahun, 'desa_pria');
        $dKWanita = $this->getPerDesaDNCount('dispensasi_nikahs', 'file_dn_selesai', $bulan, $tahun, 'desa_wanita');

        // $sktmMasuk = DB::table('sktms')
        //     ->whereNotNull('file_sktm_before')
        //     ->select('nama_desa', DB::raw('count(*) as total'))
        //     ->groupBy('nama_desa')
        //     ->pluck('total', 'nama_desa');

        // $sktmKeluar = DB::table('sktms')
        //     ->whereNotNull('file_sktm_after')
        //     ->select('nama_desa', DB::raw('count(*) as total'))
        //     ->groupBy('nama_desa')
        //     ->pluck('total', 'nama_desa');

        $sktmMasuk = $this->getPerDesaCount('sktms', 'file_sktm_before', $bulan, $tahun);
        $sktmKeluar = $this->getPerDesaCount('sktms', 'file_sktm_after', $bulan, $tahun);

        $rimdMasuk = $this->getPerDesaCount('rimds', 'file_rimd_before', $bulan, $tahun);
        $rimdKeluar = $this->getPerDesaCount('rimds', 'file_rimd_after', $bulan, $tahun);

        $liobMasuk = $this->getPerDesaCount('liobs', 'file_liob_before', $bulan, $tahun);
        $liobKeluar = $this->getPerDesaCount('liobs', 'file_liob_after', $bulan, $tahun);

        $riumkMasuk = $this->getPerDesaCount('riumks', 'file_riumk_before', $bulan, $tahun);
        $riumkKeluar = $this->getPerDesaCount('riumks', 'file_riumk_after', $bulan, $tahun);

        $lrpMasuk = $this->getPerDesaCount('lrps', 'file_lrp_before', $bulan, $tahun);
        $lrpKeluar = $this->getPerDesaCount('lrps', 'file_lrp_after', $bulan, $tahun);

        $rskuMasuk = $this->getPerDesaCount('rskus', 'file_rsku_before', $bulan, $tahun);
        $rskuKeluar = $this->getPerDesaCount('rskus', 'file_rsku_after', $bulan, $tahun);

        $rbkMasuk = $this->getPerDesaCount('rbks', 'file_rbk_before', $bulan, $tahun);
        $rbkKeluar = $this->getPerDesaCount('rbks', 'file_rbk_after', $bulan, $tahun);

        $slMasuk = $this->getPerDesaCount('sls', 'file_sl_before', $bulan, $tahun);
        $slKeluar = $this->getPerDesaCount('sls', 'file_sl_after', $bulan, $tahun);

        return view('dashboard', compact('jumlahSuratMasuk', 'jumlahSuratKeluar', 'dMPria', 'dMWanita',  'dKPria', 'dKWanita', 'sktmMasuk', 'sktmKeluar', 'rimdMasuk', 'rimdKeluar', 'liobMasuk', 'liobKeluar', 'riumkMasuk', 'riumkKeluar', 'lrpMasuk', 'lrpKeluar', 'rskuMasuk', 'rskuKeluar', 'rbkMasuk', 'rbkKeluar', 'slMasuk', 'slKeluar'));
    }

    function getPerDesaCount($table, $field, $bulan, $tahun)
    {
        return DB::table($table)
            ->whereNotNull($field)
            ->when($bulan, fn($q) => $q->whereMonth('created_at', $bulan))
            ->when($tahun, fn($q) => $q->whereYear('created_at', $tahun))
            ->select('nama_desa', DB::raw('count(*) as total'))
            ->groupBy('nama_desa')
            ->pluck('total', 'nama_desa');
    }
    function getPerDesaDNCount($table, $field, $bulan, $tahun, $desaField)
    {
        return DB::table($table)
            ->whereNotNull($field)
            ->when($bulan, fn($q) => $q->whereMonth('created_at', $bulan))
            ->when($tahun, fn($q) => $q->whereYear('created_at', $tahun))
            ->select($desaField, DB::raw('count(*) as total'))
            ->groupBy($desaField)
            ->pluck('total', $desaField);
    }
}
