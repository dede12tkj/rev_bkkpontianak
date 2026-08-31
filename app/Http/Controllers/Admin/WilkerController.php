<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wilker;
use App\Models\WilkerText;
use Illuminate\Http\Request;

class WilkerController extends Controller
{
    public function index()
    {
         $wilker = Wilker::all();              // banyak data
    $wilkerText = WilkerText::first();    // teks saja (1 data)

    return view(
        'pages.backend.profil.wilker.index',
        compact('wilker', 'wilkerText')
    );

    }

    public function updateText(Request $request, $id)
{
    $request->validate([
        'text' => 'required',
    ]);

    WilkerText::findOrFail($id)->update([
        'text' => $request->text,
    ]);

    return redirect()->back()->with('success', 'Teks berhasil diperbarui');
}


    public function store(Request $request)
    {
        $request->validate([
            'tempat' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nama_kepala' => 'required|string|max:255',
        ]);

        Wilker::create([
            'tempat' => $request->tempat,
            'alamat' => $request->alamat,
            'nama_kepala' => $request->nama_kepala,
        ]);

        return redirect()->back()->with('success', 'Data Wilayah Kerja berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tempat' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nama_kepala' => 'required|string|max:255',
        ]);

        $data = Wilker::findOrFail($id);
        $data->update([
            'tempat' => $request->tempat,
            'alamat' => $request->alamat,
            'nama_kepala' => $request->nama_kepala,
        ]);

        return redirect()->back()->with('success', 'Data Wilayah Kerja berhasil diperbarui');
    }

    public function destroy($id)
    {
        Wilker::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data Wilayah Kerja berhasil dihapus');
    }

        public function saveText(Request $request)
    {
        $request->validate([
            'text' => 'required'
        ]);

        WilkerText::updateOrCreate(
            ['id' => 1],
            ['text' => $request->text]
        );

        return back()->with('success', 'Teks Wilayah Kerja diperbarui');
    }
}
