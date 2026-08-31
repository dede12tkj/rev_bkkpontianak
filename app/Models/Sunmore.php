<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sunmore extends Model
{
    protected $table = 'sunmore';

    protected $fillable = [
        'judul',
        'deskripsi',
        'file'
    ];

    public function subJudul()
    {
        return $this->morphOne(SubJudulBedesut::class, 'konten');
    }
}
