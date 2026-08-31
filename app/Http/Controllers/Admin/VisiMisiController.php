<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisiMisi;

class VisiMisiController extends Controller
{
    public function index()
    {
        // Ambil semua data (biasanya cuma 1)
        $data = VisiMisi::all();

        return view('pages.backend.profil.visi-misi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'visi'   => 'required',
            'misi'   => 'required',
            'tujuan' => 'required',
        ]);

        VisiMisi::create([
            'visi'   => $request->visi,
            'misi'   => $request->misi,
            'tujuan' => $request->tujuan,
        ]);

        return redirect()->back()->with('success', 'Visi Misi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'visi'   => 'required',
            'misi'   => 'required',
            'tujuan' => 'required',
        ]);

        $visiMisi = VisiMisi::findOrFail($id);

        $visiMisi->update([
            'visi'   => $request->visi,
            'misi'   => $request->misi,
            'tujuan' => $request->tujuan,
        ]);

        return redirect()->back()->with('success', 'Visi Misi berhasil diperbarui');
    }

    public function destroy($id)
    {
        VisiMisi::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Visi Misi berhasil dihapus');
    }
}
