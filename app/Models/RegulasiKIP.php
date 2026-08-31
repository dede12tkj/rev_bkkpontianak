<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegulasiKIP extends Model
{
    protected $table = 'regulasi_kip_ppid';

    protected $fillable = [
        'nama',
        'path'
    ];
}
