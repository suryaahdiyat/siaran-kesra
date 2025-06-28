<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liob extends Model
{
    protected $fillable = [
        'nama_pengantar',
        'nomor_surat',
        'alamat_pengantar',
        'nama_desa',
        'file_liob_before',
        'file_liob_after',
        'file_liob_after_uploaded_at',
    ];
}
