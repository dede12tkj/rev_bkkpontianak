<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPIDTugasFungsi extends Model
{
    use HasFactory;
    protected $table = 'tugas_fungsi_ppid';
    protected $fillable = [
        'text'
    ];
}
