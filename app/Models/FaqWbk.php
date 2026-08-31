<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqWbk extends Model
{
    use HasFactory;
    protected $table = 'faq_wbk';
    protected $fillable = [
        'nama',
        'deskripsi',
    ];
}
