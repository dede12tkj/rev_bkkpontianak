<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infografis extends Model
{
    protected $table = 'infografis';

    protected $fillable = [
        'nama',
        'text',
        'thumbnail',
    ];

    public function subJudul()
    {
        return $this->morphOne(SubJudulBedesut::class, 'konten');
    }
}
