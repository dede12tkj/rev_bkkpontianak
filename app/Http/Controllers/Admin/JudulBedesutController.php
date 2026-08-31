<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JudulBedesut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JudulBedesutController extends Controller
{
    // 🔹 INDEX
    public function index()
    {
        $data = JudulBedesut::latest()->get();

        return view('pages.backend.informasi-publik.bedesut.judul_bedesut.index', compact('data'));
    }

    // 🔹 STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $thumb = null;

        if ($request->hasFile('thumbnail')) {
            $thumb = $request->file('thumbnail')->store('judul_bedesut', 'public');
        }

        JudulBedesut::create([
            'nama' => $request->nama,
            'thumbnail' => $thumb,
        ]);

        return redirect()->back()->with('success', 'Judul berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $data = JudulBedesut::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {

            // hapus lama
            if ($data->thumbnail) {
                Storage::disk('public')->delete($data->thumbnail);
            }

            $data->thumbnail = $request->file('thumbnail')->store('judul_bedesut', 'public');
        }

        $data->update([
            'nama' => $request->nama,
        ]);

        return redirect()->back()->with('success', 'Judul berhasil diperbarui');
    }

    // 🔹 DESTROY
    public function destroy($id)
    {
        $data = JudulBedesut::findOrFail($id);

        if ($data->thumbnail) {
            Storage::disk('public')->delete($data->thumbnail);
        }

        $data->delete();

        return redirect()->back()->with('success', 'Judul berhasil dihapus');
    }
}
