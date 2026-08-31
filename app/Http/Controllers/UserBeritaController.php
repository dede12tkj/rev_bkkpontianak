<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;

class UserBeritaController extends Controller
{
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();

        // tambah views
        $berita->increment('views');

        // terbaru
        $terbaru = Berita::where('id', '!=', $berita->id)
            ->latest()
            ->take(5)
            ->get();

        // populer (berdasarkan views)
        $populer = Berita::where('id', '!=', $berita->id)
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        // terkait (pakai kategori kalau ada)
        $terkait = Berita::where('id', '!=', $berita->id)
            ->when($berita->kategori_id, function ($q) use ($berita) {
                $q->where('kategori_id', $berita->kategori_id);
            })
            ->latest()
            ->take(4)
            ->get();

        return view('pages.frontend.berita.detail', compact(
            'berita',
            'terbaru',
            'populer',
            'terkait'
        ));
    }

    public function filterByCategory($id)
    {
        $kategori = KategoriBerita::findOrFail($id);

        // Ambil berita berdasarkan kategori
        $beritas = Berita::with('kategori', 'penulis')
            ->where('kategori_id', $id)
            ->where('status', 'published')
            ->orderBy('tanggal', 'desc')
            ->paginate(6);

        // Sidebar: Recent Post
        $recentPost = Berita::where('status', 'published')
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        // Sidebar: Semua Kategori
        $kategoriList = KategoriBerita::orderBy('nama_kategori', 'ASC')->get();

        return view('pages.frontend.informasi-publik.berita', compact(
            'beritas', 'kategori', 'kategoriList', 'recentPost'
        ));
    }
}
