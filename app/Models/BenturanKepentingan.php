<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenturanKepentingan extends Model
{
    use HasFactory;
    protected $table = 'benturan_kepentingan';
    protected $fillable = [
        'nama',
        'text',
    ];
}
