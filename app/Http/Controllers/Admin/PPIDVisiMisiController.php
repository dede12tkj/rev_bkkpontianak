<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PPIDVisiMisi;
use Illuminate\Http\Request;

class PPIDVisiMisiController extends Controller
{
    public function index()
    {
        $data = PPIDVisiMisi::first();

        return view('pages.backend.informasi-publik.ppid.visi-misi.index', compact('data'));
    }

    public function store(Request $request)
{
    $request->validate([
        'visi' => 'required',
        'misi' => 'required',
    ]);

    PPIDVisiMisi::create($request->only('visi', 'misi'));

    return back()->with('success', 'Data berhasil disimpan');
}

public function update(Request $request, $id)
{
    $request->validate([
        'visi' => 'required',
        'misi' => 'required',
    ]);

    $data = PPIDVisiMisi::findOrFail($id);
    $data->update($request->only('visi', 'misi'));

    return back()->with('success', 'Data berhasil diperbarui');
}
}
