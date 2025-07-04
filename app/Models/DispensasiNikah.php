<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispensasiNikah extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_surat_kua',
        'nomor_surat', // <-- Tambahkan ini untuk nomor surat dispensasi nikah
        'tanggal_nikah',
        'file_surat_kua',
        'nama_pria',
        'jenis_kelamin_pria',
        'tempat_lahir_pria',
        'tanggal_lahir_pria',
        'agama_pria',
        'pekerjaan_pria',
        'desa_pria',
        'desa_pria_lainnya', // Input tambahan jika pilih "Lainnya"
        'alamat_pria',
        'pernah_nikah_pria', // <-- Kunci masalahnya ada di sini
        'file_bukti_cerai_pria',
        'nama_wanita',
        'jenis_kelamin_wanita',
        'tempat_lahir_wanita',
        'tanggal_lahir_wanita',
        'agama_wanita',
        'pekerjaan_wanita',
        'desa_wanita',
        'desa_wanita_lainnya', // Input tambahan jika pilih "Lainnya
        'alamat_wanita',
        'pernah_nikah_wanita', // <-- Dan di sini
        'file_bukti_cerai_wanita',
        'status',
        'file_dn_selesai', // Path ke file lampiran surat dispensasi nikah selesai
        'file_dn_selesai_uploaded_at', // Path ke file lampiran surat dispensasi
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_nikah' => 'date',
        'tanggal_lahir_pria' => 'date',
        'tanggal_lahir_wanita' => 'date',
        'pernah_menikah_pria' => 'boolean',
        'pernah_menikah_wanita' => 'boolean',
    ];
}
