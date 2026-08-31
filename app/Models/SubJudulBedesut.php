<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubJudulBedesut extends Model
{
    protected $table = 'sub_judul_bedesut';

    protected $fillable = [
        'judul_bedesut_id',
        'nama',
        'konten_id',
        'konten_type',
        'thumbnail',
    ];

    public function judul()
    {
        return $this->belongsTo(JudulBedesut::class, 'judul_bedesut_id');
    }

    // polymorphic relation
    public function konten()
    {
        return $this->morphTo();
    }
}
