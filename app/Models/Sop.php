<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sop extends Model
{
    use HasFactory;

    protected $table = 'sop';

    protected $fillable = [
        'kategori',
        'judul',
        'pdf',
    ];

    /**
     * Accessor: URL PDF
     */
    public function getPdfUrlAttribute()
    {
        return $this->pdf
            ? asset('storage/' . $this->pdf)
            : null;
    }

    /**
     * Accessor: Label kategori (biar lebih manusiawi)
     */
    public function getKategoriLabelAttribute()
    {
        return match ($this->kategori) {
            'proses1' => 'Proses 1',
            'proses2' => 'Proses 2',
            'proses3' => 'Proses 3',
            'proses4' => 'Proses 4',
            'proses5' => 'Proses 5',
            'proses6' => 'Proses 6',
            default => '-',
        };
    }

    /**
     * Scope per kategori
     */
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}
