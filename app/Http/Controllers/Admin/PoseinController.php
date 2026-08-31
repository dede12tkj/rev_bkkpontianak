<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Posein;

class PoseinController extends Controller
{
    public function index()
    {
        $poseins = Posein::latest()->get();
        return view('pages.backend.posein.index', compact('poseins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        Posein::create([
            'content' => $request->content
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $posein = Posein::findOrFail($id);
        $posein->update([
            'content' => $request->content
        ]);

        return back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Posein::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('summernote', 'public');

            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'Upload gagal'], 400);
    }
}
