<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GambarMaklumatPelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GambarMaklumatPelayananController extends Controller
{
    public function index()
    {
        $gambar = GambarMaklumatPelayanan::all();
        return view('pages.backend.maklumat-pelayanan.index', compact('gambar'));
    }

    public function store(Request $request)
    {
            if (GambarMaklumatPelayanan::count() >= 1) {
        return redirect()->back()->with('error', 'Data sudah ada! Anda hanya boleh mengedit data yang sudah ada.');
    }
        $request->validate([
        'path' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // upload file
    $file = $request->file('path');
    $filePath = $file->store('maklumat', 'public');

    // simpan ke database
    GambarMaklumatPelayanan::create([
        'path' => $filePath,
    ]);

    return redirect()->back()->with('success', 'Gambar berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
{
    // ambil data lama
    $gambar = GambarMaklumatPelayanan::findOrFail($id);

    // validasi (file boleh kosong)
    $request->validate([
        'path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4048',
    ]);

    // jika upload gambar baru
    if ($request->hasFile('path')) {

        // hapus file lama
        if ($gambar->path && Storage::disk('public')->exists($gambar->path)) {
            Storage::disk('public')->delete($gambar->path);
        }

        // upload file baru
        $file = $request->file('path');
        $filePath = $file->store('maklumat', 'public');

        // update path baru
        $gambar->path = $filePath;
    }

    $gambar->save();

    return redirect()->back()->with('success', 'Gambar berhasil diperbarui!');
}



}
