<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubInformasiPublikSetiapSaat extends Model
{
    protected $table = 'sub_informasi_publik_setiap_saat';

    protected $fillable = [
        'informasi_publik_setiap_saat_id',
        'judul',
        'deskripsi'
    ];
}
