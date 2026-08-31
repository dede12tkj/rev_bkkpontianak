<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SKDanSOP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SKDanSOPController extends Controller
{
    public function index()
    {
        $data = SKDanSOP::orderBy('tahun', 'desc')
                ->latest()
                ->get();

        return view('pages.backend.ski.skdansop.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'tahun' => 'required|digits:4',
            'file_pdf' => 'required|mimes:pdf|max:5120',
        ]);

        $path = $request->file('file_pdf')->store('sk-dan-sop', 'public');

        SKDanSOP::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'tahun' => $request->tahun,
            'file_pdf' => $path,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'tahun' => 'required|digits:4',
            'file_pdf' => 'nullable|mimes:pdf|max:5120',
        ]);

        $data = SKDanSOP::findOrFail($id);

        // HANDLE FILE
        if ($request->hasFile('file_pdf')) {
            // hapus file lama
            if ($data->file_pdf && Storage::disk('public')->exists($data->file_pdf)) {
                Storage::disk('public')->delete($data->file_pdf);
            }

            $data->file_pdf = $request->file('file_pdf')->store('sk-dan-sop', 'public');
        }

        // UPDATE DATA
        $data->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'tahun' => $request->tahun,
            'file_pdf' => $data->file_pdf,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = SKDanSOP::findOrFail($id);

        if ($data->file_pdf && Storage::disk('public')->exists($data->file_pdf)) {
            Storage::disk('public')->delete($data->file_pdf);
        }

        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function show($id)
    {
        $data = SKDanSOP::findOrFail($id);

        return view('pages.frontend.SKI.sk-dan-sop-show', compact('data'));
    }
}
