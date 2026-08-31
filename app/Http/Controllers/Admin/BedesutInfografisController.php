<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bedesut;
use App\Models\BedesutInfografis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BedesutInfografisController extends Controller
{
    public function index()
    {
        $data = BedesutInfografis::with('bedesut')->latest()->get();
        $bedesut = Bedesut::all();

        return view('pages.backend.informasi-publik.bedesut-infografis.index', compact('data', 'bedesut'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'text' => 'required',
            'link_looker' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bedesut_id' => 'nullable|exists:bedesut,id',
        ]);

        $thumbPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbPath = $request->file('thumbnail')->store('infografis', 'public');
        }

        BedesutInfografis::create([
            'nama' => $request->nama,
            'text' => $request->text,
            'link_looker' => $request->link_looker,
            'thumbnail' => $thumbPath,
            'bedesut_id' => $request->bedesut_id,
        ]);

        return redirect()->back()->with('success', 'Infografis berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = BedesutInfografis::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'text' => 'required',
            'link_looker' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bedesut_id' => 'nullable|exists:bedesut,id',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($data->thumbnail) {
                Storage::disk('public')->delete($data->thumbnail);
            }
            $data->thumbnail = $request->file('thumbnail')->store('infografis', 'public');
        }

        $data->update([
            'nama' => $request->nama,
            'text' => $request->text,
            'link_looker' => $request->link_looker,
            'bedesut_id' => $request->bedesut_id,
        ]);

        return redirect()->back()->with('success', 'Infografis berhasil diperbarui');
    }

    public function show(BedesutInfografis $infografis)
    {
        return view('pages.frontend.informasi-publik.bedesut-infografis-show', compact('infografis'));
    }

    public function destroy($id)
{
    $data = BedesutInfografis::findOrFail($id);

    // Hapus thumbnail jika ada
    if ($data->thumbnail) {
        Storage::disk('public')->delete($data->thumbnail);
    }

    // Hapus data
    $data->delete();

    return redirect()->back()->with('success', 'Infografis berhasil dihapus');
}
}
