<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rimd extends Model
{
    protected $fillable = [
        'nama_pengantar',
        'nomor_surat',
        'alamat_pengantar',
        'file_rimd_before',
        'file_rimd_after',
        'file_rimd_after_uploaded_at',
    ];
}
