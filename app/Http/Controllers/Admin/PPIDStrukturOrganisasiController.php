<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PPIDStrukturOrganisasi;
use Illuminate\Http\Request;

class PPIDStrukturOrganisasiController extends Controller
{
    public function index()
    {
        $data = PPIDStrukturOrganisasi::latest()->get();

        return view('pages.backend.informasi-publik.ppid.struktur-organisasi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'path' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $filePath = $request->file('path')->store('struktur-ppid', 'public');

        PPIDStrukturOrganisasi::create([
            'judul' => $request->judul,
            'path' => $filePath,
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = PPIDStrukturOrganisasi::findOrFail($id);

        $request->validate([
            'judul' => 'required',
        ]);

        if ($request->hasFile('path')) {
            $filePath = $request->file('path')->store('struktur-ppid', 'public');
            $data->path = $filePath;
        }

        $data->judul = $request->judul;
        $data->save();

        return back()->with('success', 'Data berhasil diupdate');
    }
}
