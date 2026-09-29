<?php

namespace App\Models;

use App\Models\Concerns\FlushesHomeCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use FlushesHomeCache;
    use HasFactory;

    protected $table = 'carousel_table';

    protected $fillable = [
        'path',
        'text',
        'subtitle',
        'show_text',
    ];

    protected $casts = [
        'show_text' => 'boolean',
    ];

    /** Dipakai di tampilan depan bila admin belum mengisi subtitle sendiri. */
    public const DEFAULT_SUBTITLE = 'TANGGUH - TANGGUH - RESPONSIF.';

    /** Teks & subtitle hanya tampil kalau show_text aktif DAN judulnya memang diisi. */
    public function getShouldShowTextAttribute(): bool
    {
        return $this->show_text && filled($this->text);
    }

    public function getSubtitleOrDefaultAttribute(): string
    {
        return $this->subtitle !== null && trim($this->subtitle) !== ''
            ? $this->subtitle
            : self::DEFAULT_SUBTITLE;
    }
}
