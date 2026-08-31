<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $data = StrukturOrganisasi::all();

        return view('pages.backend.profil.struktur-organisasi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        StrukturOrganisasi::create([
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $data = StrukturOrganisasi::findOrFail($id);
        $data->update([
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    // upload gambar dari summernote
    public function uploadImage(Request $request)
{
    try {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('file')->store('summernote', 'public');

        return response()->json([
            'url' => asset('storage/'.$path),
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'error' => $e->errors()['file'][0]
        ], 422);
    }
}

}
