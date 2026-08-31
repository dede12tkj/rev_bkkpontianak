<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\SubInformasiPublikBerkala;

class SubInformasiPublikBerkalaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'informasi_publik_berkala_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'nullable'
        ]);

        SubInformasiPublikBerkala::create([
            'informasi_publik_berkala_id' => $request->informasi_publik_berkala_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ]);

        return back()->with('success', 'Sub data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = SubInformasiPublikBerkala::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable'
        ]);

        $data->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ]);

        return back()->with('success', 'Sub data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = SubInformasiPublikBerkala::findOrFail($id);

        $data->delete();

        return back()->with('success', 'Sub data berhasil dihapus');
    }
}
