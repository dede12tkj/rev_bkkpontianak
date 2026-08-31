<?php

namespace App\Http\Controllers;

use App\Models\KontakKami;
use Illuminate\Http\Request;

class KontakKamiController extends Controller
{
    public function index()
    {
        $kontaks = KontakKami::latest()->get();

        return view('pages.backend.kontak-kami.index', compact('kontaks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
        ]);

        KontakKami::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan,
        ]);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim');
    }

    /**
     * Hapus pesan
     */
    public function destroy($id)
    {
        $kontak = KontakKami::findOrFail($id);

        $kontak->delete();

        return redirect()->back()->with('success', 'Pesan berhasil dihapus');
    }

    public function previewPdf($id)
    {
        $kontak = KontakKami::findOrFail($id);

        return view('pages.backend.kontak-kami.preview-pdf', compact('kontak'));
    }
}
