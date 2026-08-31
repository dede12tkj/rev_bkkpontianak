<?php

namespace App\Models;

use App\Models\SubInformasiPublikSetiapSaat;
use Illuminate\Database\Eloquent\Model;

class InformasiPublikSetiapSaat extends Model
{
    protected $table = 'informasi_publik_setiap_saat';

    protected $fillable = ['judul'];

    public function sub()
    {
        return $this->hasMany(SubInformasiPublikSetiapSaat::class);
    }
}
