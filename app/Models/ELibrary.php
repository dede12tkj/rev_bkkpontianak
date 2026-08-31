<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ELibrary extends Model
{
    use HasFactory;

    protected $table = 'e_library';

    protected $fillable = [
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
