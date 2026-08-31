<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\InformasiPublikSetiapSaat;
use App\Models\SubInformasiPublikSetiapSaat;
use Illuminate\Http\Request;

class InformasiPublikSetiapSaatController extends Controller
{
    // =========================
    // INDEX
    // =========================
    public function index()
    {
        $data = InformasiPublikSetiapSaat::with('sub')->get();
        return view('pages.backend.informasi-publik.ppid.informasi-setiap-saat.index', compact('data'));
    }

    // =========================
    // STORE PARENT
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required'
        ]);

        InformasiPublikSetiapSaat::create([
            'judul' => $request->judul
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    // =========================
    // UPDATE PARENT
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required'
        ]);

        $data = InformasiPublikSetiapSaat::findOrFail($id);

        $data->update([
            'judul' => $request->judul
        ]);

        return back()->with('success', 'Data berhasil diupdate');
    }

    // =========================
    // DELETE PARENT
    // =========================
    public function destroy($id)
    {
        $data = InformasiPublikSetiapSaat::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    // =========================
    // STORE SUB
    // =========================
    public function storeSub(Request $request)
    {
        $request->validate([
            'informasi_publik_setiap_saat_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required'
        ]);

        SubInformasiPublikSetiapSaat::create([
            'informasi_publik_setiap_saat_id' => $request->informasi_publik_setiap_saat_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ]);

        return back()->with('success', 'Sub data berhasil ditambahkan');
    }

    // =========================
    // UPDATE SUB
    // =========================
    public function updateSub(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required'
        ]);

        $data = SubInformasiPublikSetiapSaat::findOrFail($id);

        $data->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ]);

        return back()->with('success', 'Sub data berhasil diupdate');
    }

    // =========================
    // DELETE SUB
    // =========================
    public function destroySub($id)
    {
        $data = SubInformasiPublikSetiapSaat::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Sub data berhasil dihapus');
    }
}
