<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SejarahDanLatarBelakang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SejarahDanLatarBelakangController extends Controller
{
    public function index()
    {
        $data = SejarahDanLatarBelakang::all();
        return view('pages.backend.profil.sejarah-dan-latar-belakang.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'path' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('path')->store('sejarah', 'public');

        SejarahDanLatarBelakang::create([
            'text' => $request->text,
            'path' => $path
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $data = SejarahDanLatarBelakang::findOrFail($id);

        $request->validate([
            'text' => 'required',
            'path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('path')) {
            if ($data->path) {
                Storage::disk('public')->delete($data->path);
            }
            $data->path = $request->file('path')->store('sejarah', 'public');
        }

        $data->text = $request->text;
        $data->save();

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }
}
