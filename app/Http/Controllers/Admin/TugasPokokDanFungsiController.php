<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TugasDanFungsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasPokokDanFungsiController extends Controller
{
    public function index()
    {
        $data = TugasDanFungsi::all();
        return view('pages.backend.profil.tugas-dan-fungsi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        TugasDanFungsi::create([
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $item = TugasDanFungsi::findOrFail($id);
        $item->update([
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        TugasDanFungsi::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    // upload gambar Summernote
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('tugas-fungsi', 'public');
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }
    }
}
