<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rbk extends Model
{
    protected $fillable = [
        'nama_pengantar',
        'nomor_surat',
        'alamat_pengantar',
        'file_rbk_before',
        'file_rbk_after',
        'file_rbk_after_uploaded_at',
    ];
}
