<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPPID extends Model
{
    use HasFactory;
    protected $table = 'laporan_ppid';

    protected $fillable = [
        'nama',
        'semester',
        'tahun',
        'file_pdf',
    ];
}
