<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    protected $table = 'artikel';

    protected $fillable = [
        'judul',
        'oleh',
        'slug',
        'konten',
        'thumbnail',
        'status',
        'views',
        'published_at',
        'tanggal'
    ];

    /**
     * Auto generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($artikel) {
            if (!$artikel->slug) {
                $artikel->slug = Str::slug($artikel->judul);
            }
        });
    }
}
