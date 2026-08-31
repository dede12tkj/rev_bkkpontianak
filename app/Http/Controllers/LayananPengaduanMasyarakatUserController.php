<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananPengaduanMasyarakatUser;

class LayananPengaduanMasyarakatUserController extends Controller
{
    /**
     * Halaman Form
     */
    public function index()
    {
        $data = LayananPengaduanMasyarakatUser::latest()->get();

        return view(
            'pages.backend.form-layanan-pengaduan-masyarakat.index',
            compact('data')
        );
    }

    /**
     * Simpan Data
     */
    public function store(Request $request)
    {
        $request->validate([

            'nama' => 'required',

            'jenis_kelamin' => 'required',

            'usia' => 'required|numeric',

            'permasalahan_pengaduan' => 'required',

        ]);

        LayananPengaduanMasyarakatUser::create([

            'nama' => $request->nama,

            'jenis_kelamin' => $request->jenis_kelamin,

            'usia' => $request->usia,

            'permasalahan_pengaduan' => $request->permasalahan_pengaduan,

        ]);

        return redirect()->back()->with(
            'success',
            'Pengaduan berhasil dikirim'
        );
    }

    /**
     * Update Data
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'nama' => 'required',

            'jenis_kelamin' => 'required',

            'usia' => 'required|numeric',

            'permasalahan_pengaduan' => 'required',

        ]);

        $data = LayananPengaduanMasyarakatUser::findOrFail($id);

        $data->update([

            'nama' => $request->nama,

            'jenis_kelamin' => $request->jenis_kelamin,

            'usia' => $request->usia,

            'permasalahan_pengaduan' => $request->permasalahan_pengaduan,

        ]);

        return redirect()->back()->with(
            'success',
            'Data berhasil diupdate'
        );
    }

    /**
     * Hapus Data
     */
    public function destroy($id)
    {
        $data = LayananPengaduanMasyarakatUser::findOrFail($id);

        $data->delete();

        return redirect()->back()->with(
            'success',
            'Data berhasil dihapus'
        );
    }

    public function previewPdf($id)
{
    $data = LayananPengaduanMasyarakatUser::findOrFail($id);

    return view(
        'pages.backend.form-layanan-pengaduan-masyarakat.pdf',
        compact('data')
    );
}
}
