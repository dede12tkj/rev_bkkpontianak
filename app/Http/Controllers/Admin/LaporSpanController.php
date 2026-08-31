<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporSpan;
use Illuminate\Http\Request;

class LaporSpanController extends Controller
{
    public function index()
    {
        $data = LaporSpan::all();
        return view('pages.backend.pengaduan.lapor_span.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        LaporSpan::create([
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $item = LaporSpan::findOrFail($id);
        $item->update([
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        LaporSpan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    // upload gambar Summernote
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('lapor_span', 'public');
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }
    }
}
