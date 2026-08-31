<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPIDFaq extends Model
{
    use HasFactory;

    protected $table = 'faq_ppid';

    protected $fillable = [
        'judul',
        'deskripsi',
    ];
}
