<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Mengambil statistik vaksinasi dari API SIKEREN (server ke server, kunci tidak sampai ke browser).
 * Hasil di-cache singkat; bila SIKEREN sedang tidak bisa dihubungi, data terakhir yang berhasil
 * (maksimal 1 hari) tetap ditampilkan dengan penanda 'basi' => true.
 */
class SikerenStatistik
{
    public const PERIODE = ['hari_ini' => 'Hari Ini', 'bulan_ini' => 'Bulan Ini', 'tahun_ini' => 'Tahun Ini'];

    public function ambil(string $periode = 'hari_ini', ?string $wilker = null): array
    {
        $periode = array_key_exists($periode, self::PERIODE) ? $periode : 'hari_ini';
        $kunciCache = "sikeren.statistik.{$periode}.".($wilker ?: 'semua');
        $ttl = (int) config('services.sikeren.cache_detik', 60);

        if ($segar = Cache::get($kunciCache)) {
            return $segar;
        }

        try {
            $res = Http::baseUrl(rtrim((string) config('services.sikeren.url'), '/'))
                ->withToken((string) config('services.sikeren.key'))
                ->acceptJson()->timeout(5)->retry(1, 200, throw: false)
                ->get('/api/v1/statistik', array_filter(['periode' => $periode, 'wilker' => $wilker]));

            if ($res->successful() && is_array($res->json())) {
                $data = $res->json() + ['basi' => false];
                Cache::put($kunciCache, $data, $ttl);
                Cache::put($kunciCache.'.terakhir', $data, now()->addDay());

                return $data;
            }
            Log::warning('API SIKEREN gagal', ['status' => $res->status()]);
        } catch (\Throwable $e) {
            Log::warning('API SIKEREN tidak terhubung: '.$e->getMessage());
        }

        $terakhir = Cache::get($kunciCache.'.terakhir');

        return $terakhir ? ['basi' => true] + $terakhir : $this->kosong($periode);
    }

    /** Bentuk data bila belum pernah berhasil mengambil dari SIKEREN. */
    private function kosong(string $periode): array
    {
        return ['periode' => $periode, 'total_pasien' => 0, 'total_dosis' => 0, 'vaksin' => [], 'diperbarui' => null, 'basi' => true, 'kosong' => true];
    }
}
