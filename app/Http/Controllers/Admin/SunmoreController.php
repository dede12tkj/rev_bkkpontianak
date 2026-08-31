<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bedesut;
use App\Models\Sunmore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SunmoreController extends Controller
{
    public function index()
    {
        $data = Sunmore::with('bedesut')->latest()->get();
        $bedesut = Bedesut::all();

        return view('pages.backend.informasi-publik.sunmore.index', compact('data', 'bedesut'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'path_pdf' => 'required|mimes:pdf|max:5120',
            'thumbnail' => 'nullable|image|max:2048',
            'bedesut_id' => 'nullable|exists:bedesut,id',
        ]);

        $pdfPath = $request->file('path_pdf')->store('sunmore/pdf', 'public');

        $thumbPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbPath = $request->file('thumbnail')->store('sunmore/thumbnail', 'public');
        }

        Sunmore::create([
            'nama' => $request->nama,
            'path_pdf' => $pdfPath,
            'thumbnail' => $thumbPath,
            'bedesut_id' => $request->bedesut_id,
        ]);

        return back()->with('success', 'Data Sunmore berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $item = Sunmore::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'path_pdf' => 'nullable|mimes:pdf|max:5120',
            'thumbnail' => 'nullable|image|max:2048',
            'bedesut_id' => 'nullable|exists:bedesut,id',
        ]);

        if ($request->hasFile('path_pdf')) {
            Storage::disk('public')->delete($item->path_pdf);
            $item->path_pdf = $request->file('path_pdf')->store('sunmore/pdf', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            Storage::disk('public')->delete($item->thumbnail);
            $item->thumbnail = $request->file('thumbnail')->store('sunmore/thumbnail', 'public');
        }

        $item->update([
            'nama' => $request->nama,
            'bedesut_id' => $request->bedesut_id,
        ]);

        return back()->with('success', 'Data Sunmore berhasil diupdate');
    }

    public function destroy($id)
    {
        $item = Sunmore::findOrFail($id);

        Storage::disk('public')->delete([$item->path_pdf, $item->thumbnail]);
        $item->delete();

        return back()->with('success', 'Data Sunmore berhasil dihapus');
    }

        public function flipbook($id)
    {
        $data = Sunmore::findOrFail($id);

        return view('pages.frontend.informasi-publik.flipbook', compact('data'));
    }
}
