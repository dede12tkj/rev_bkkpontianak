<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $carousel = Carousel::all();
        return view('pages.backend.carousel.index', compact('carousel'));
    }

    public function update(Request $request, $id)
{
    $carousel = Carousel::findOrFail($id);

    $data = $request->validate([
        'path' => 'nullable|image',
        'text' => 'nullable|string',
    ]);

    if ($request->hasFile('path')) {
        $data['path'] = $request->file('path')->store('carousel', 'public');
    }

    $carousel->update($data);

    return redirect()->back()->with('success', 'Carousel berhasil diperbarui');
}

public function store(Request $request)
    {
        $request->validate([
            'path' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'text' => 'required|string'
        ]);

        // Simpan gambar
        $path = $request->file('path')->store('carousel', 'public');

        Carousel::create([
            'path' => $path,
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Carousel berhasil ditambahkan');
    }
    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);

        // Hapus file gambar dari storage
        if ($carousel->path && Storage::disk('public')->exists($carousel->path)) {
            Storage::disk('public')->delete($carousel->path);
        }

        // Hapus data dari database
        $carousel->delete();

        return redirect()->back()->with('success', 'Carousel berhasil dihapus');
    }
}


