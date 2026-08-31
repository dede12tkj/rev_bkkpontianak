<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PPIDProfil;
use Illuminate\Http\Request;

class PPIDProfilController extends Controller
{
    public function index()
    {
        $data = PPIDProfil::latest()->get();

        return view('pages.backend.informasi-publik.ppid.profil-singkat.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        PPIDProfil::create($request->only('text'));

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $data = PPIDProfil::findOrFail($id);
        $data->update($request->only('text'));

        return back()->with('success', 'Data berhasil diupdate');
    }
}
