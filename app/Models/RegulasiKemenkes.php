<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegulasiKemenkes extends Model
{
    protected $table = 'regulasi_kemenkes_ppid';

    protected $fillable = [
        'nama',
        'path'
    ];
}
