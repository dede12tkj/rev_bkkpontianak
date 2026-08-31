<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriBerita extends Model
{
    use HasFactory;

    protected $table = 'kategori_berita';

    protected $fillable = [
        'nama_kategori',
        'slug'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($kategori) {
            if (empty($kategori->slug)) {
                $kategori->slug = Str::slug($kategori->nama_kategori);
            }
        });

        static::updating(function ($kategori) {
            $kategori->slug = Str::slug($kategori->nama_kategori);
        });
    }

    public function beritas()
    {
        return $this->hasMany(Berita::class, 'kategori_id');
    }
}
