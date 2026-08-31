<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananPengaduanMasyarakatUser extends Model
{
    protected $table = 'layanan_pengaduan_masyarakats';

    protected $fillable = [

        'nama',

        'jenis_kelamin',

        'usia',

        'permasalahan_pengaduan'

    ];
}
