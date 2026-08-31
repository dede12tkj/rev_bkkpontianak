<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UPG;
use Illuminate\Http\Request;

class UPGController extends Controller
{
    public function index()
    {
        $data = UPG::all();
        return view('pages.backend.pengaduan.upg.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        UPG::create([
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $item = UPG::findOrFail($id);
        $item->update([
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        UPG::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    // upload gambar Summernote
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('upg', 'public');
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }
    }
}
