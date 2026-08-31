<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akuntabilitas;
use App\Models\Artikel;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\LaporanPPID;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Admin - tampilkan data
     */
    public function index()
    {
        // ======================
        // TOTAL DATA
        // ======================
        $totalArtikel = Artikel::count();
        $totalBerita = Berita::count();
        $totalKategori = KategoriBerita::count();
        $totalLaporan = LaporanPPID::count();

        // ======================
        // STATUS ARTIKEL
        // ======================
        $artikelPublished = Artikel::where('status', 'published')->count();
        $artikelDraft = Artikel::where('status', 'draft')->count();

        // ======================
        // STATISTIK
        // ======================
        $totalViews = Artikel::sum('views');

        $artikelBulanIni = Artikel::whereMonth('created_at', Carbon::now()->month)
            ->count();

        // ======================
        // DATA LIST
        // ======================
        $artikelTerbaru = Artikel::latest()->take(5)->get();
        $artikelPopuler = Artikel::orderBy('views', 'desc')->take(5)->get();
        $beritaTerbaru = Berita::latest()->take(5)->get();

        return view('pages.backend.dashboard', compact(
            'totalArtikel',
            'totalBerita',
            'totalKategori',
            'totalLaporan',
            'artikelPublished',
            'artikelDraft',
            'totalViews',
            'artikelBulanIni',
            'artikelTerbaru',
            'artikelPopuler',
            'beritaTerbaru'
        ));
    }



}
