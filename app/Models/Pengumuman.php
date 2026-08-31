<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'file',
        'status',
        'tanggal',
        'published_at',
        'is_penting',
        'slug'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'published_at' => 'datetime',
        'is_penting' => 'boolean',
    ];

    /**
     * Scope: hanya yang publish
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope: urutan terbaru + penting dulu
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('is_penting', 'desc')
                     ->orderBy('tanggal', 'desc');
    }
}
