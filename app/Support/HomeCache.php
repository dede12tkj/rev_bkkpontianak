<?php

namespace App\Support;

use App\Models\Footer;
use App\Models\Sosmed;
use App\Models\Visitor;
use Illuminate\Support\Facades\Cache;

/**
 * Pusat cache untuk data yang dibaca di (hampir) setiap halaman publik.
 *
 * Cache dibersihkan otomatis lewat trait FlushesHomeCache setiap kali
 * model terkait disimpan/dihapus dari panel admin, dan punya TTL cadangan.
 */
class HomeCache
{
    /** TTL cadangan (detik). Cache tetap dibersihkan otomatis saat data berubah. */
    public const TTL = 3600;

    public const KEY_HOME = 'home:data:v1';
    public const KEY_FOOTER = 'layout:footer:v1';
    public const KEY_SOSMED = 'layout:sosmed:v1';
    public const KEY_VISITORS = 'layout:visitors:v1';

    /** Memo per-request supaya composer yang dipanggil berkali-kali tidak menyentuh cache store lagi. */
    private static array $memo = [];

    public static function footer(): ?Footer
    {
        return self::$memo['footer'] ??= Cache::remember(self::KEY_FOOTER, self::TTL, fn () => Footer::first());
    }

    public static function sosmed(): ?Sosmed
    {
        return self::$memo['sosmed'] ??= Cache::remember(self::KEY_SOSMED, self::TTL, fn () => Sosmed::first());
    }

    /**
     * Angka counter pengunjung. Di-cache 5 menit (kunci per hari) supaya tidak
     * menjalankan COUNT(*) ke tabel visitors di setiap request.
     */
    public static function visitorCounts(): array
    {
        $today = now()->toDateString();

        return self::$memo['visitors'] ??= Cache::remember(
            self::KEY_VISITORS.':'.$today,
            300,
            fn () => [
                'totalVisitors' => Visitor::count(),
                'todayVisitors' => Visitor::where('visit_date', $today)->count(),
            ]
        );
    }

    /**
     * Hapus cache konten (homepage, footer, sosmed).
     * Counter pengunjung sengaja tidak ikut dihapus.
     */
    public static function flush(): void
    {
        self::$memo = [];
        Cache::forget(self::KEY_HOME);
        Cache::forget(self::KEY_FOOTER);
        Cache::forget(self::KEY_SOSMED);
    }
}
