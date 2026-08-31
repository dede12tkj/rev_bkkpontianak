<?php

namespace App\Models;

use App\Models\SubInformasiPublikBerkala;
use Illuminate\Database\Eloquent\Model;

class InformasiPublikBerkala extends Model
{
    protected $table = 'informasi_publik_berkala';

    protected $fillable = ['judul'];

    public function sub()
    {
        return $this->hasMany(SubInformasiPublikBerkala::class);
    }
}
