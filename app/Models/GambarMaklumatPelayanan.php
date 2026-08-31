<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarMaklumatPelayanan extends Model
{
    use HasFactory;
    protected $table = 'gambarmaklumatpelayanan';
    protected $fillable = [
        'path',
    ];
}
