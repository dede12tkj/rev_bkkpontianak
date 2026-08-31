<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GolKPK;
use Illuminate\Http\Request;

class GolKPKController extends Controller
{
        public function index()
    {
        $data = GolKPK::all();
        return view('pages.backend.pengaduan.gol-kpk.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        GolKPK::create([
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $item = GolKPK::findOrFail($id);
        $item->update([
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        GolKPK::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    // upload gambar Summernote
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('gol-kpk', 'public');
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }
    }
}
