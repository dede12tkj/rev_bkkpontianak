<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sop;
use Illuminate\Support\Facades\Storage;

class SopController extends Controller
{
    /**
     * List data
     */
    public function index()
    {
        $data = Sop::latest()->get();
        return view('pages.backend.informasi-publik.sop.index', compact('data'));
    }

    /**
     * Simpan data
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:proses1,proses2,proses3,proses4,proses5,proses6',
            'judul' => 'required|string|max:255',
            'pdf' => 'required|file|mimes:pdf|max:5120',
        ]);

        $data = $request->all();

        // Upload PDF
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('sop/pdf', 'public');
        }

        Sop::create($data);

        return redirect()->back()->with('success', 'SOP berhasil ditambahkan');
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $item = Sop::findOrFail($id);

        $request->validate([
            'kategori' => 'required|in:proses1,proses2,proses3,proses4,proses5,proses6',
            'judul' => 'required|string|max:255',
            'pdf' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = $request->all();

        // Update PDF
        if ($request->hasFile('pdf')) {

            // Hapus file lama
            if ($item->pdf) {
                Storage::disk('public')->delete($item->pdf);
            }

            $data['pdf'] = $request->file('pdf')->store('sop/pdf', 'public');
        }

        $item->update($data);

        return redirect()->back()->with('success', 'SOP berhasil diupdate');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $item = Sop::findOrFail($id);

        if ($item->pdf) {
            Storage::disk('public')->delete($item->pdf);
        }

        $item->delete();

        return redirect()->back()->with('success', 'SOP berhasil dihapus');
    }

    /**
     * Detail (optional frontend)
     */
    public function show($id)
    {
        $item = Sop::findOrFail($id);
        return view('sop.show', compact('item'));
    }
}
