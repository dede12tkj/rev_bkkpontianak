<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SurveyController extends Controller
{
    /**
     * List data
     */
    public function index()
    {
        $data = Survey::latest()->get();
        return view('pages.backend.informasi-publik.survey.index', compact('data'));
    }

    /**
     * Simpan data
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'kategori' => 'required|in:SKM,SPAK',
            'tahun' => 'required|digits:4|integer',
            'laporan' => 'nullable|file|mimes:pdf|max:5120',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('judul', 'isi', 'kategori', 'tahun');

        // Upload PDF
        if ($request->hasFile('laporan')) {
            $data['laporan'] = $request->file('laporan')
                ->store('survey/laporan', 'public');
        }

        // Upload Gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('survey/gambar', 'public');
        }

        Survey::create($data);

        return redirect()->back()->with('success', 'Survey berhasil ditambahkan');
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $item = Survey::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'kategori' => 'required|in:SKM,SPAK',
            'tahun' => 'required|digits:4|integer',
            'laporan' => 'nullable|file|mimes:pdf|max:5120',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('judul', 'isi', 'kategori', 'tahun');

        // Update PDF
        if ($request->hasFile('laporan')) {

            if ($item->laporan) {
                Storage::disk('public')->delete($item->laporan);
            }

            $data['laporan'] = $request->file('laporan')
                ->store('survey/laporan', 'public');
        }

        // Update Gambar
        if ($request->hasFile('gambar')) {

            if ($item->gambar) {
                Storage::disk('public')->delete($item->gambar);
            }

            $data['gambar'] = $request->file('gambar')
                ->store('survey/gambar', 'public');
        }

        $item->update($data);

        return redirect()->back()->with('success', 'Survey berhasil diupdate');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $item = Survey::findOrFail($id);

        // hapus PDF
        if ($item->laporan) {
            Storage::disk('public')->delete($item->laporan);
        }

        // hapus gambar
        if ($item->gambar) {
            Storage::disk('public')->delete($item->gambar);
        }

        $item->delete();

        return redirect()->back()->with('success', 'Survey berhasil dihapus');
    }

    /**
     * Detail (frontend)
     */
    public function show($id)
    {
        $item = Survey::findOrFail($id);
        return view('pages.frontend.informasi-publik.detail-survey', compact('item'));
    }
}
