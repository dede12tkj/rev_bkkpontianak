<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akuntabilitas;
use Illuminate\Support\Facades\Storage;

class AkuntabilitasController extends Controller
{
    /**
     * Admin - tampilkan data
     */
    public function index()
    {
        $data = Akuntabilitas::orderBy('tahun', 'desc')->latest()->get();
        return view('pages.backend.informasi-publik.akuntabilitas.index', compact('data'));
    }

    /**
     * Simpan data
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|digits:4',
            'judul' => 'required|string|max:255',
            'pdf'   => 'required|file|mimes:pdf|max:5120',
        ]);

        $data = $request->only('tahun', 'judul');

        // upload PDF
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('akuntabilitas/pdf', 'public');
        }

        Akuntabilitas::create($data);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $item = Akuntabilitas::findOrFail($id);

        $request->validate([
            'tahun' => 'required|digits:4',
            'judul' => 'required|string|max:255',
            'pdf'   => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = $request->only('tahun', 'judul');

        // update PDF jika ada
        if ($request->hasFile('pdf')) {

            // hapus file lama
            if ($item->pdf) {
                Storage::disk('public')->delete($item->pdf);
            }

            $data['pdf'] = $request->file('pdf')->store('akuntabilitas/pdf', 'public');
        }

        $item->update($data);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $item = Akuntabilitas::findOrFail($id);

        if ($item->pdf) {
            Storage::disk('public')->delete($item->pdf);
        }

        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }


}
