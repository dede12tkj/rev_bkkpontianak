<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Carousel;
use App\Models\FormSurveyKepuasanMasyarakat;
use App\Models\GambarMaklumatPelayanan;
use App\Models\StandarPelayanan;
use App\Models\Survey;
use App\Models\TentangKami;
use App\Support\HomeCache;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Halaman beranda.
     *
     * Semua data konten di-cache (dibersihkan otomatis saat admin mengubah data,
     * lihat trait FlushesHomeCache), sehingga kunjungan biasa tidak menyentuh database.
     */
    public function index()
    {
        $data = Cache::remember(HomeCache::KEY_HOME, HomeCache::TTL, function () {
            return [
                // konten berita hanya dipakai untuk cuplikan, jadi jangan tarik seluruh longText
                'berita' => Berita::query()
                    ->select(['id', 'judul', 'slug', 'thumbnail', 'tanggal', 'status'])
                    ->selectRaw('SUBSTR(konten, 1, 6000) as konten')
                    ->where('status', 'published')
                    ->orderBy('tanggal', 'desc')
                    ->take(5)
                    ->get(),
                'carousel' => Carousel::all(),
                'gambar' => GambarMaklumatPelayanan::first(),
                'tentang_kami' => TentangKami::first(),
                'fskm' => FormSurveyKepuasanMasyarakat::first(),
                'ikm' => Survey::skm()->latest()->take(3)->get(),
                'layanan' => StandarPelayanan::orderBy('id')->get(),
            ];
        });

        return view('pages.frontend.welcome', $data + [
            'footer' => HomeCache::footer(),
            'sosmed' => HomeCache::sosmed(),
        ]);
    }
}
