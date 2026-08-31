<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    // LIST DATA
    public function index()
    {
        $beritas = Berita::with('kategori')->latest()->paginate(10);

        return view('pages.backend.berita.index', compact('beritas'));
    }

    // FORM CREATE
    public function create()
    {
        $kategori = KategoriBerita::all();

        return view('pages.backend.berita.create', compact('kategori'));
    }

    // STORE DATA
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'kategori_id' => 'nullable|exists:kategori_berita,id',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:draft,published',
            'tanggal' => 'required|date',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnail', 'public');
        }

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'konten' => $request->konten,
            'kategori_id' => $request->kategori_id,
            'penulis_id' => auth()->id(),
            'thumbnail' => $thumbnailPath,
            'status' => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dibuat!');
    }

    // FORM EDIT
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategori = KategoriBerita::all();

        return view('pages.backend.berita.edit', compact('berita', 'kategori'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'kategori_id' => 'nullable|exists:kategori_berita,id',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:draft,published',
            'tanggal' => 'required|date',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnail', 'public');
            $berita->thumbnail = $thumbnailPath;
        }

        $berita->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'konten' => $request->konten,
            'kategori_id' => $request->kategori_id,
            'status' => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    // DELETE DATA
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function show($slug)
{
    $berita = Berita::where('slug', $slug)->firstOrFail();

    // 🔥 Tambah view
    $berita->increment('views');

    // 🔥 Berita terbaru
    $terbaru = Berita::latest()->take(5)->get();

    // 🔥 Berita populer
    $populer = Berita::orderBy('views', 'desc')->take(5)->get();

    // 🔥 Berita terkait (kategori sama)
    $terkait = Berita::where('kategori_id', $berita->kategori_id)
        ->where('id', '!=', $berita->id)
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
}
