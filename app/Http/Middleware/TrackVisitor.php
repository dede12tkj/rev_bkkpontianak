<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

/**
 * Mencatat pengunjung unik per hari (IP + user agent).
 *
 * Pencatatan dilakukan di terminate(), yaitu SETELAH response dikirim ke browser,
 * sehingga tidak menambah waktu tunggu halaman. Pengecekan "sudah tercatat hari ini"
 * memakai cache, jadi database hanya disentuh pada kunjungan pertama seorang
 * pengunjung dalam sehari, bukan di setiap request.
 */
class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        if (! $this->shouldTrack($request, $response)) {
            return;
        }

        try {
            $ip = (string) $request->ip();
            $userAgent = substr((string) $request->userAgent(), 0, 255);
            $today = now()->toDateString();

            // Cache::add atomik: hanya request pertama hari ini yang lolos.
            $key = 'visitor:'.$today.':'.md5($ip.'|'.$userAgent);
            if (! Cache::add($key, 1, now()->endOfDay())) {
                return;
            }

            // Cadangan bila cache dibersihkan di tengah hari: pastikan tidak tercatat ganda.
            $exists = Visitor::where('visit_date', $today)
                ->where('ip_address', $ip)
                ->where('user_agent', $userAgent)
                ->exists();

            if (! $exists) {
                Visitor::create([
                    'ip_address' => $ip,
                    'user_agent' => $userAgent,
                    'visit_date' => $today,
                ]);
            }
        } catch (\Throwable $e) {
            // Gagal mencatat statistik tidak boleh mengganggu pengunjung.
            report($e);
        }
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (! $request->isMethod('GET')) {
            return false;
        }

        if ($request->ajax() || $request->expectsJson() || $request->is('up')) {
            return false;
        }

        if ($response->getStatusCode() >= 400) {
            return false;
        }

        $userAgent = strtolower((string) $request->userAgent());

        // Tanpa user agent, atau bot/crawler/monitor: tidak dihitung sebagai pengunjung.
        if ($userAgent === '' || preg_match(
            '/bot|crawl|spider|slurp|preview|monitor|uptime|headless|curl|wget|python-requests|facebookexternalhit/',
            $userAgent
        )) {
            return false;
        }

        return true;
    }
}
