<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StandarPelayanan;
use Illuminate\Http\Request;

class StandarPelayananController extends Controller
{
    /**
     * List data
     */
    public function index()
    {
        $data = StandarPelayanan::latest()->get();
        return view('pages.backend.layanan.standar-pelayanan.index', compact('data'));
    }

    /**
     * Simpan data
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nama_tampilan' => 'nullable|string|max:255',
            'text' => 'required',
        ]);

        StandarPelayanan::create([
            'nama' => $request->nama,
            'nama_tampilan' => $request->nama_tampilan,
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $data = StandarPelayanan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nama_tampilan' => 'nullable|string|max:255',
            'text' => 'required',
        ]);

        $data->update([
            'nama' => $request->nama,
            'nama_tampilan' => $request->nama_tampilan,
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $data = StandarPelayanan::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    /**
     * Upload image dari Summernote
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('file')->store('standar-pelayanan', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }

    /**
     * Detail frontend
     */
    public function show($id)
    {
        $data = StandarPelayanan::findOrFail($id);
        return view('pages.frontend.layanan.standar-pelayanan-show', compact('data'));
    }
}
