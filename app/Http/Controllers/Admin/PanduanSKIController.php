<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PanduanSKI;
use Illuminate\Http\Request;

class PanduanSKIController extends Controller
{
    public function index()
    {
        $data = PanduanSKI::orderBy('id', 'desc')->get();
        return view('pages.backend.ski.panduan-ski.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'link_drive' => 'required|string',
        ]);

        PanduanSKI::create([
            'nama' => $request->nama,
            'link_drive' => $request->link_drive,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'link_drive' => 'required|string',
        ]);

        $data = PanduanSKI::findOrFail($id);
        $data->update([
            'nama' => $request->nama,
            'link_drive' => $request->link_drive,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        PanduanSKI::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
