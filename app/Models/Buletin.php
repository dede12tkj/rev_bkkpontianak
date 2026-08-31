<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buletin extends Model
{
    protected $table = 'buletin';

    protected $fillable = [
        'judul',
        'file'
    ];

    public function subJudul()
    {
        return $this->morphOne(SubJudulBedesut::class, 'konten');
    }
}
