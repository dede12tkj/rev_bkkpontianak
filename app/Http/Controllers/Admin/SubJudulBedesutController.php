<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buletin;
use App\Models\DashboardInteraktif;
use App\Models\Infografis;
use App\Models\JudulBedesut;
use App\Models\SubJudulBedesut;
use App\Models\Sunmore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubJudulBedesutController extends Controller
{
    // 🔹 INDEX
    public function index()
    {
        $data = SubJudulBedesut::with('judul', 'konten')->latest()->get();
        $judul = JudulBedesut::all();

        return view('pages.backend.informasi-publik.bedesut.sub-judul.index', compact('data', 'judul'));
    }

    // 🔹 STORE
    public function store(Request $request)
    {
        $request->validate([
            'judul_bedesut_id' => 'required|exists:judul_bedesut,id',
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:infografis,sunmore,dashboard,buletin',
            'link_looker' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'file' => 'nullable|file',
        ]);

        $thumb = null;
        // 🔸 Buat konten sesuai tipe
        if ($request->tipe == 'infografis') {

            $thumb = null;
            if ($request->hasFile('thumbnail')) {
                $thumb = $request->file('thumbnail')->store('infografis', 'public');
            }

            $konten = Infografis::create([
                'nama' => $request->nama,
                'text' => $request->text,
                'thumbnail' => $thumb,
                'link_looker' => $request->link_looker,
            ]);

        } elseif ($request->tipe == 'sunmore') {

            $file = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file')->store('sunmore', 'public');
            }

            $konten = Sunmore::create([
                'judul' => $request->nama,
                'file' => $file,
            ]);

        } elseif ($request->tipe == 'dashboard') {

            $konten = DashboardInteraktif::create([
                'judul' => $request->nama,
                'link_looker' => $request->link_looker,
            ]);

        } else {

            $file = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file')->store('buletin', 'public');
            }

            $konten = Buletin::create([
                'judul' => $request->nama,
                'file' => $file,
            ]);
        }

        if ($request->hasFile('thumbnail')) {
    $thumb = $request->file('thumbnail')->store('sub_judul', 'public');
}
        SubJudulBedesut::create([
            'judul_bedesut_id' => $request->judul_bedesut_id,
            'nama' => $request->nama,
            'konten_id' => $konten->id,
            'konten_type' => get_class($konten),
            'thumbnail' => $thumb,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 UPDATE
    public function update(Request $request, $id)
{
    $data = SubJudulBedesut::with('konten')->findOrFail($id);

    // 🔹 update sub judul
    $data->update([
        'nama' => $request->nama,
    ]);

    // 🔹 update thumbnail (sub judul)
    if ($request->hasFile('thumbnail')) {
        if ($data->thumbnail) {
            \Storage::disk('public')->delete($data->thumbnail);
        }

        $data->thumbnail = $request->file('thumbnail')->store('subjudul', 'public');
        $data->save();
    }

    // 🔥 UPDATE KONTEN SESUAI TIPE
    if ($data->konten_type === \App\Models\Infografis::class) {

        $data->konten->update([
            'text' => $request->text
        ]);

    } elseif ($data->konten_type === \App\Models\DashboardInteraktif::class) {

        $data->konten->update([
            'link_looker' => $request->link_looker
        ]);

    } elseif (
        $data->konten_type === \App\Models\Sunmore::class ||
        $data->konten_type === \App\Models\Buletin::class
    ) {

        if ($request->hasFile('file')) {

            if ($data->konten->file ?? null) {
                \Storage::disk('public')->delete($data->konten->file);
            }

            $filePath = $request->file('file')->store('file', 'public');

            $data->konten->update([
                'file' => $filePath
            ]);
        }
    }

    return redirect()->back()->with('success', 'Data berhasil diperbarui');
}

    // 🔹 DESTROY
    public function destroy($id)
    {
        $data = SubJudulBedesut::with('konten')->findOrFail($id);

        // 🔥 hapus kontennya juga
        if ($data->konten) {

            // hapus file jika ada
            if (isset($data->konten->thumbnail)) {
                Storage::disk('public')->delete($data->konten->thumbnail);
            }

            if (isset($data->konten->file)) {
                Storage::disk('public')->delete($data->konten->file);
            }

            $data->konten->delete();
        }

        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
