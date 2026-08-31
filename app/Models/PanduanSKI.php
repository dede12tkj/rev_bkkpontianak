<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanduanSKI extends Model
{
    use HasFactory;
    protected $table = 'panduan_ski';
    protected $fillable = [
        'nama',
        'link_drive'
    ];
}
