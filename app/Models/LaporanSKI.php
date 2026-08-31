<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanSKI extends Model
{
    use HasFactory;
    protected $table = 'laporan_ski';

    protected $fillable = [
        'nama',
        'semester',
        'tahun',
        'file_pdf',
    ];
}
