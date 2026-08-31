<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPIDForm extends Model
{
    use HasFactory;
    protected $table = 'form_ppid';
    protected $fillable = [
        'form_permohonan_informasi',
        'form_keberatan',
        'file_daftar_informasi_publik',
    ];
}
