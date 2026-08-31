<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TentangKami;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
        public function index()
    {
        $tentang_kami = TentangKami::all();
        return view('pages.backend.tentang-kami.index', compact('tentang_kami'));
    }

     public function store(Request $request)
{
    TentangKami::create([
        'text' => $request->text
    ]);

    return back()->with('success', 'Tentang Kami berhasil ditambahkan');
}

    /**
     * UPDATE (Edit data)
     */
    public function update(Request $request, $id)
{
    $data = TentangKami::findOrFail($id);
    $data->update([
        'text' => $request->text
    ]);

    return back()->with('success', 'Tentang Kami berhasil diperbarui');
}

    /**
     * DELETE (Hapus data)
     */
    public function destroy($id)
    {
        $tentangKami = TentangKami::findOrFail($id);
        $tentangKami->delete();

        return redirect()->back()->with('success', 'Data Tentang Kami berhasil dihapus');
    }
}
