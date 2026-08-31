<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananPengaduan extends Model
{
    use HasFactory;
    protected $table = 'layanan_pengaduan';
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'umur',
        'permasalahan',
        'status_pengaduan',
    ];
}
