<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rsku extends Model
{
    protected $fillable = [
        'nama_pengantar',
        'nomor_surat',
        'alamat_pengantar',
        'nama_desa',
        'file_rsku_before',
        'file_rsku_after',
        'file_rsku_after_uploaded_at',
    ];
}
