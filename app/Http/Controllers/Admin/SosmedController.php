<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sosmed;
use Illuminate\Http\Request;

class SosmedController extends Controller
{
    public function index()
    {
        $data = Sosmed::all(); // hanya 1 data
        return view('pages.backend.sosmed.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'twitter' => 'nullable|url',
            'fb' => 'nullable|url',
            'wa' => 'nullable|string',
            'ig' => 'nullable|url',
            'yt' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'maps' => 'nullable|url',
        ]);

        Sosmed::create($request->all());

        return back()->with('success', 'Sosial media berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $sosmed = Sosmed::findOrFail($id);

        $request->validate([
            'twitter' => 'nullable|url',
            'fb' => 'nullable|url',
            'wa' => 'nullable|string',
            'ig' => 'nullable|url',
            'yt' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'maps' => 'nullable|url',
        ]);

        $sosmed->update($request->all());

        return back()->with('success', 'Sosial media berhasil diperbarui');
    }

    public function destroy($id)
    {
        Sosmed::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
