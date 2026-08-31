<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPIDStrukturOrganisasi extends Model
{
    use HasFactory;
    protected $table = 'struktur_organisasi_ppid';
    protected $fillable = [
        'judul',
        'path'
    ];
}
