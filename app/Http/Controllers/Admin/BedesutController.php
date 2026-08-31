<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bedesut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BedesutController extends Controller
{
    public function index()
    {
        $data = Bedesut::latest()->get();
        return view('pages.backend.informasi-publik.bedesut.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'text' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $thumbnail = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('bedesut', 'public');
        }

        Bedesut::create([
            'nama' => $request->nama,
            'text' => $request->text,
            'thumbnail' => $thumbnail,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $bedesut = Bedesut::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'text' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($bedesut->thumbnail) {
                Storage::disk('public')->delete($bedesut->thumbnail);
            }
            $bedesut->thumbnail = $request->file('thumbnail')->store('bedesut', 'public');
        }

        $bedesut->update([
            'nama' => $request->nama,
            'text' => $request->text,
            'thumbnail' => $bedesut->thumbnail,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $bedesut = Bedesut::findOrFail($id);

        if ($bedesut->thumbnail) {
            Storage::disk('public')->delete($bedesut->thumbnail);
        }

        $bedesut->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

        public function show(Bedesut $bedesut)
    {
        $bedesut->load(['infografis', 'dashboard', 'sunmore']);

        return view('pages.frontend.informasi-publik.bedesut-detail', compact('bedesut'));
    }


}
