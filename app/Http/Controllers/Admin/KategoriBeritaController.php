<?php

namespace App\Http\Controllers\Admin;


use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriBeritaController extends Controller
{
    public function index()
    {
        $kategori_berita = KategoriBerita::orderBy('nama_kategori')->get();
        return view('pages.backend.kategori-berita.index', compact('kategori_berita'));
    }

    // FORM CREATE
    public function create()
    {
        return view('pages.backend.kategori-berita.create');
    }

    // STORE DATA
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_berita,nama_kategori',
        ]);

        KategoriBerita::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori-berita.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    // FORM EDIT
    public function edit($id)
    {
        $kategori_berita = KategoriBerita::findOrFail($id);
        return view('pages.backend.kategori-berita.edit', compact('kategori_berita'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $kategori = KategoriBerita::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_berita,nama_kategori,' . $kategori->id,
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori-berita.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    // DELETE DATA
    public function destroy($id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori-berita.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
