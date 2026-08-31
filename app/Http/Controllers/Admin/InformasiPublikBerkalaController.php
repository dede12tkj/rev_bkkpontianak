<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\InformasiPublikBerkala;

class InformasiPublikBerkalaController extends Controller
{
    public function index()
    {
        $data = InformasiPublikBerkala::with('sub')->get();

        return view('pages.backend.informasi-publik.ppid.informasi-berkala.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required'
        ]);

        InformasiPublikBerkala::create([
            'judul' => $request->judul
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = InformasiPublikBerkala::findOrFail($id);

        $request->validate([
            'judul' => 'required'
        ]);

        $data->update([
            'judul' => $request->judul
        ]);

        return back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = InformasiPublikBerkala::findOrFail($id);

        $data->delete(); // otomatis hapus sub karena cascade

        return back()->with('success', 'Data berhasil dihapus');
    }
}
