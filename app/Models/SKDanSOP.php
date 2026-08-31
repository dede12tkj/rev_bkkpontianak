<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKDanSOP extends Model
{
    use HasFactory;
    protected $table = 'sk_dan_sop';
    protected $fillable = [
        'nama',
        'kategori',
        'tahun',    
        'file_pdf'
    ];
}
