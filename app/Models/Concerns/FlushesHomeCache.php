<?php

namespace App\Models\Concerns;

use App\Support\HomeCache;

/**
 * Pasang di model yang datanya tampil di homepage/footer supaya cache
 * otomatis dibersihkan ketika admin menyimpan atau menghapus data.
 */
trait FlushesHomeCache
{
    public static function bootFlushesHomeCache(): void
    {
        static::saved(fn () => HomeCache::flush());
        static::deleted(fn () => HomeCache::flush());
    }
}
