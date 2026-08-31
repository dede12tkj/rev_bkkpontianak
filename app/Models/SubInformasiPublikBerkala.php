<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubInformasiPublikBerkala extends Model
{
    protected $table = 'sub_informasi_publik_berkala';

    protected $fillable = [
        'informasi_publik_berkala_id',
        'judul',
        'deskripsi'
    ];

    public function parent()
    {
        return $this->belongsTo(InformasiPublikBerkala::class, 'informasi_publik_berkala_id');
    }
}
