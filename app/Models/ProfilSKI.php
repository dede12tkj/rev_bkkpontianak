<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSKI extends Model
{
    use HasFactory;
    protected $table = 'profil_ski';
    protected $fillable = [
        'text'
    ];
}
