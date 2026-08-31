<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BenturanKepentinganUser extends Model
{
    protected $table = 'benturan_kepentingans';

    protected $fillable = [

        'nama_lengkap',

        'jabatan',

        'unit_kerja',

        'email',

        'uraian_konflik',

        'kepentingan',

        'penyebab',

        'tempat_laporan'

    ];
}
