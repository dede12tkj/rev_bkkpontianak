<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'survey';

    protected $fillable = [
        'judul',
        'isi',
        'laporan',
        'kategori',
        'tahun',
        'gambar'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope: Survey Kepuasan Masyarakat
     */
    public function scopeSkm($query)
    {
        return $query->where('kategori', 'SKM');
    }

    /**
     * Scope: Survey Persepsi Anti Korupsi
     */
    public function scopeSpak($query)
    {
        return $query->where('kategori', 'SPAK');
    }

    /**
     * Accessor: Label kategori
     */
    public function getKategoriLabelAttribute()
    {
        return match ($this->kategori) {
            'SKM' => 'Survey Kepuasan Masyarakat',
            'SPAK' => 'Survey Persepsi Anti Korupsi',
            default => '-',
        };
    }

    /**
     * Accessor: URL laporan PDF
     */
    public function getLaporanUrlAttribute()
    {
        return $this->laporan
            ? asset('storage/' . $this->laporan)
            : null;
    }
    public function getGambarUrlAttribute()
{
    return $this->gambar
        ? asset('storage/' . $this->gambar)
        : asset('frontend/img/default.png');
}
}
