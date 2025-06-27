<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riumk extends Model
{
    protected $fillable = [
        'nama_pengantar',
        'nomor_surat',
        'alamat_pengantar',
        'file_riumk_before',
        'file_riumk_after',
        'file_riumk_after_uploaded_at',
    ];
}
