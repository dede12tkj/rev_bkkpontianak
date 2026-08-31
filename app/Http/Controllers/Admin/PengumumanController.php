<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    /**
     * List data
     */
    public function index()
    {
        $data = Pengumuman::latest()->get();

        return view('pages.backend.informasi-publik.pengumuman.index', compact('data'));
    }

    /**
     * Simpan data
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:4096',
            'tanggal' => 'required|date',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->judul);
        $count = \App\Models\Pengumuman::where('slug', 'like', "$slug%")->count();

        $data['slug'] = $count ? $slug.'-'.($count + 1) : $slug;

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengumuman/gambar', 'public');
        }

        // Upload file
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('pengumuman/file', 'public');
        }

        // Status publish
        if ($request->status == 'published') {
            $data['published_at'] = now();
        }

        Pengumuman::create($data);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan');
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $item = Pengumuman::findOrFail($id);

        return view('pengumuman.edit', compact('item'));
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $item = Pengumuman::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:4096',
            'tanggal' => 'required|date',
        ]);

        $data = $request->all();

        // Update gambar
        if ($request->hasFile('gambar')) {
            if ($item->gambar) {
                Storage::disk('public')->delete($item->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('pengumuman/gambar', 'public');
        }

        // Update file
        if ($request->hasFile('file')) {
            if ($item->file) {
                Storage::disk('public')->delete($item->file);
            }
            $data['file'] = $request->file('file')->store('pengumuman/file', 'public');
        }

        // Update status publish
        if ($request->status == 'published' && ! $item->published_at) {
            $data['published_at'] = now();
        }

        $item->update($data);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diupdate');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $item = Pengumuman::findOrFail($id);

        if ($item->gambar) {
            Storage::disk('public')->delete($item->gambar);
        }

        if ($item->file) {
            Storage::disk('public')->delete($item->file);
        }

        $item->delete();

        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus');
    }

    /**
     * Detail (frontend)
     */
    public function show($id)
    {
        $item = Pengumuman::where('status', 'published')->findOrFail($id);

        return view('pages.frontend.informasi-publik.detail-pengumuman', compact('item'));
    }
}
