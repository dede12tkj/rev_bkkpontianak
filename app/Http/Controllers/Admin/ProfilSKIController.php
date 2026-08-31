<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilSKI;
use Illuminate\Http\Request;

class ProfilSKIController extends Controller
{
    public function index()
    {
        $data = ProfilSKI::all();
        return view('pages.backend.ski.profil-ski.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        ProfilSki::create([
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $data = ProfilSki::findOrFail($id);
        $data->update([
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    // upload gambar summernote
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('file')->store('summernote', 'public');

        return response()->json([
            'url' => asset('storage/'.$path),
        ]);
    }
}
