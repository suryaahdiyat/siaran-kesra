<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lrp extends Model
{
    protected $fillable = [
        'nama_pengantar',
        'nomor_surat',
        'alamat_pengantar',
        'file_lrp_before',
        'file_lrp_after',
        'file_lrp_after_uploaded_at',
    ];
}
