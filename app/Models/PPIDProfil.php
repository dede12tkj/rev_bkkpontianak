<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPIDProfil extends Model
{
    use HasFactory;
    protected $table = 'profil_singkat_ppid';
    protected $fillable = [
        'text'
    ];
}
