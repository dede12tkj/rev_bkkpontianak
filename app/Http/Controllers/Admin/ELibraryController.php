<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ELibrary;
use Illuminate\Support\Facades\Storage;

class ELibraryController extends Controller
{
    /**
     * Tampilkan data
     */
    public function index()
    {
        $data = ELibrary::latest()->get();
        return view('pages.backend.informasi-publik.e-library.index', compact('data'));
    }

    /**
     * Simpan data
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pdf' => 'required|file|mimes:pdf|max:5120',
        ]);

        $data = $request->only('judul');

        // Upload PDF
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('e-library/pdf', 'public');
        }

        ELibrary::create($data);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $item = ELibrary::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'pdf' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = $request->only('judul');

        // Update PDF jika ada
        if ($request->hasFile('pdf')) {

            // Hapus file lama
            if ($item->pdf) {
                Storage::disk('public')->delete($item->pdf);
            }

            $data['pdf'] = $request->file('pdf')->store('e-library/pdf', 'public');
        }

        $item->update($data);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $item = ELibrary::findOrFail($id);

        if ($item->pdf) {
            Storage::disk('public')->delete($item->pdf);
        }

        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    /**
     * Detail (optional frontend)
     */
    public function show($id)
    {
        $item = ELibrary::findOrFail($id);
        return view('e-library.show', compact('item'));
    }
}
