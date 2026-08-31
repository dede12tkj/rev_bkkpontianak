<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infografis;
use Illuminate\Http\Request;

class InfografisController extends Controller
{
    public function index()
    {
        $data = Infografis::latest()->get();
        return view('pages.backend.profil.infografis.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'link_infografis' => 'required|url',
        ]);

        Infografis::create([
            'link_infografis' => $request->link_infografis,
        ]);

        return redirect()->back()->with('success', 'Infografis berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'link_infografis' => 'required|url',
        ]);

        $data = Infografis::findOrFail($id);
        $data->update([
            'link_infografis' => $request->link_infografis,
        ]);

        return redirect()->back()->with('success', 'Infografis berhasil diperbarui');
    }

    public function destroy($id)
    {
        Infografis::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Infografis berhasil dihapus');
    }
}
