<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanSKI;
use Illuminate\Http\Request;

class LaporanSKIController extends Controller
{
    public function index()
    {
        $data = LaporanSKI::orderBy('tahun', 'desc')->get();

        return view('pages.backend.ski.laporan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'semester' => 'required',
            'tahun' => 'required',
            'file_pdf' => 'required|mimes:pdf|max:5120', // max 5MB
        ]);

        $filePath = null;

        if ($request->hasFile('file_pdf')) {
            $filePath = $request->file('file_pdf')->store('laporan_ski', 'public');
        }

        LaporanSKI::create([
            'nama' => $request->nama,
            'semester' => $request->semester,
            'tahun' => $request->tahun,
            'file_pdf' => $filePath,
        ]);

        return redirect()->back()->with('success', 'File PDF berhasil diupload');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'semester' => 'required|string|max:50',
            'tahun' => 'required|digits:4',
        ]);

        $data = LaporanSKI::findOrFail($id);
        $data->update($request->all());

        return redirect()->back()->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy($id)
    {
        LaporanSKI::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus');
    }

    public function flipbook($id)
    {
        $data = LaporanSki::findOrFail($id);

        return view('pages.backend.ski.laporan.flipbook', compact('data'));
    }

    public function show($id)
    {
        $data = LaporanSKI::findOrFail($id);

        return view('pages.frontend.SKI.laporan-ski-show', compact('data'));
    }
}
