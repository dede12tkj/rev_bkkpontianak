<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    /**
     * INDEX
     */
    public function index()
    {
        $data = Artikel::latest()->get();

        return view('pages.backend.informasi-publik.artikel.index', compact('data'));
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'oleh' => 'required',
            'konten' => 'required',
            'tanggal' => 'required|date',
            'thumbnail' => 'nullable|image',
        ]);

        $thumbnail = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('artikel', 'public');
        }

        Artikel::create([
            'judul' => $request->judul,
            'oleh' => $request->oleh,
            'slug' => Str::slug($request->judul.'-'.time()),
            'konten' => $request->konten,
            'thumbnail' => $thumbnail,
            'status' => $request->status ?? 'draft',
            'views' => 0,
            'published_at' => $request->status == 'published' ? now() : null,
            'tanggal' => $request->tanggal,
        ]);

        return back()->with('success', 'Artikel berhasil ditambahkan');
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'oleh' => 'required',
            'konten' => 'required',
            'tanggal' => 'required|date',
            'thumbnail' => 'nullable|image',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('artikel', 'public');
            $artikel->thumbnail = $thumbnail;
        }

        $artikel->update([
            'judul' => $request->judul,
            'oleh' => $request->oleh,
            'slug' => Str::slug($request->judul.'-'.time()),
            'konten' => $request->konten,
            'status' => $request->status,
            'published_at' => $request->status == 'published' ? now() : null,
            'tanggal' => $request->tanggal,
        ]);

        return back()->with('success', 'Artikel berhasil diupdate');
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        Artikel::findOrFail($id)->delete();

        return back()->with('success', 'Artikel berhasil dihapus');
    }

    /**
     * DETAIL (Frontend)
     */
    

    public function uploadImage(Request $request)
    {
        $file = $request->file('file');
        $path = $file->store('summernote', 'public');

        return response()->json([
            'url' => asset('storage/'.$path),
        ]);
    }
}
