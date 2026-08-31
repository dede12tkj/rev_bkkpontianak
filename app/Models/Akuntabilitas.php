<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Akuntabilitas extends Model
{
    use HasFactory;

    protected $table = 'akuntabilitas';

    protected $fillable = [
        'tahun',
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
}
