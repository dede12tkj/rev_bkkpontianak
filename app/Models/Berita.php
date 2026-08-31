<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $casts = [
    'tanggal' => 'datetime:Y-m-d H:i:s',
];

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'thumbnail',
        'kategori_id',
        'penulis_id',
        'status',
        'views',
        'tanggal',
        'published_at',
    ];

    // Auto generate slug from title
    public static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
        });
    }

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }

    // Relasi ke user sebagai penulis
    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }
}
