<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasDanFungsi extends Model
{
    use HasFactory;
    protected $table = 'tugas_fungsi';
    protected $fillable = [
        'text'
    ];
}
