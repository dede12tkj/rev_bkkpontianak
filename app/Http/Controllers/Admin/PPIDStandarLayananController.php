<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PPIDStandarLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PPIDStandarLayananController extends Controller
{
    public function index()
    {
        $data = PPIDStandarLayanan::latest()->get();

        return view('pages.backend.informasi-publik.ppid.standar-layanan.index', compact('data'));
    }

    /**
     * Store new data
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'path_judul' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'path' => 'required|mimes:mimes:jpg,jpeg,png|max:2048',
        ]);

        $pathJudul = null;
        $pathFile = null;

        if ($request->hasFile('path_judul')) {
            $pathJudul = $request->file('path_judul')
                ->store('standar_layanan_ppid/judul', 'public');
        }

        if ($request->hasFile('path')) {
            $pathFile = $request->file('path')
                ->store('standar_layanan_ppid/dokumen', 'public');
        }

        PPIDStandarLayanan::create([
            'judul' => $request->judul,
            'path_judul' => $pathJudul,
            'path' => $pathFile,
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'path_judul' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'path' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = PPIDStandarLayanan::findOrFail($id);

        if ($request->hasFile('path_judul')) {

            if ($data->path_judul && Storage::disk('public')->exists($data->path_judul)) {
                Storage::disk('public')->delete($data->path_judul);
            }

            $data->path_judul = $request->file('path_judul')
                ->store('standar_layanan_ppid/judul', 'public');
        }

        if ($request->hasFile('path')) {

            if ($data->path && Storage::disk('public')->exists($data->path)) {
                Storage::disk('public')->delete($data->path);
            }

            $data->path = $request->file('path')
                ->store('standar_layanan_ppid/dokumen', 'public');
        }

        $data->judul = $request->judul;
        $data->save();

        return back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Delete data
     */
    public function destroy($id)
    {
        $data = PPIDStandarLayanan::findOrFail($id);

        if ($data->path_judul && Storage::disk('public')->exists($data->path_judul)) {
            Storage::disk('public')->delete($data->path_judul);
        }

        if ($data->path && Storage::disk('public')->exists($data->path)) {
            Storage::disk('public')->delete($data->path);
        }

        $data->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
