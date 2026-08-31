<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BenturanKepentingan;
use Illuminate\Http\Request;

class BenturanKepentinganController extends Controller
{
        public function index()
    {
        $data = BenturanKepentingan::all();
        return view('pages.backend.pengaduan.benturan-kepentingan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'text' => 'required',
        ]);

        BenturanKepentingan::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'text' => 'required',
        ]);

        $data = BenturanKepentingan::findOrFail($id);
        $data->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        BenturanKepentingan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

        public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('file')->store('summernote', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }
}
