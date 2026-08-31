<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SejarahDanLatarBelakang extends Model
{
    use HasFactory;
    protected $table = 'sejarah_dan_latar_belakang';
    protected $fillable = [
        'text',
        'path'
    ];
}
