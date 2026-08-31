<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPIDStandarLayanan extends Model
{
    protected $table = 'standar_layanan_ppid';

    protected $fillable = [
        'judul',
        'path_judul',
        'path'
    ];
}
