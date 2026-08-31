<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GolKPK extends Model
{
    use HasFactory;
    protected $table = 'gol_kpk';
    protected $fillable = [
        'text'
    ];
}
