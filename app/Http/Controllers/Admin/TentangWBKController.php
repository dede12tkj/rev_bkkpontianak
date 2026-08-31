<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqWbk;
use Illuminate\Http\Request;

class TentangWBKController extends Controller
{
    public function index()
    {
        $data = FaqWbk::all();
        return view('pages.backend.pengaduan.tentang-wbk.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
        ]);

        FaqWbk::create($request->all());

        return redirect()->back()->with('success', 'FAQ berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
        ]);

        $data = FaqWbk::findOrFail($id);
        $data->update($request->all());

        return redirect()->back()->with('success', 'FAQ berhasil diperbarui');
    }

    public function destroy($id)
    {
        FaqWbk::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'FAQ berhasil dihapus');
    }
}
