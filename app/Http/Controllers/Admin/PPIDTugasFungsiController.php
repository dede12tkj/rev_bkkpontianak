<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PPIDTugasFungsi;
use Illuminate\Http\Request;

class PPIDTugasFungsiController extends Controller
{
    public function index()
    {
        $data = PPIDTugasFungsi::latest()->get();

        return view('pages.backend.informasi-publik.ppid.tugas-fungsi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        PPIDTugasFungsi::create($request->only('text'));

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $data = PPIDTugasFungsi::findOrFail($id);
        $data->update($request->only('text'));

        return back()->with('success', 'Data berhasil diupdate');
    }
}
