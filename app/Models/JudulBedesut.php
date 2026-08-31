<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JudulBedesut extends Model
{
    protected $table = 'judul_bedesut';

    protected $fillable = [
        'nama',
        'thumbnail',
    ];

    public function subJudul()
    {
        return $this->hasMany(SubJudulBedesut::class);
    }
}
