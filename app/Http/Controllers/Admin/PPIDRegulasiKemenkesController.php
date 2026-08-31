<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegulasiKemenkes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PPIDRegulasiKemenkesController extends Controller
{
    public function index()
    {
        $data = RegulasiKemenkes::latest()->get();
        return view('pages.backend.informasi-publik.ppid.regulasi-kemenkes.index', compact('data'));
    }

    /**
     * Store new data
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'path' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('path');
        $filePath = $file->store('regulasi_kip_ppid', 'public');

        RegulasiKemenkes::create([
            'nama' => $request->nama,
            'path' => $filePath,
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'path' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = RegulasiKemenkes::findOrFail($id);

        if ($request->hasFile('path')) {

            // Hapus file lama
            if ($data->path && Storage::disk('public')->exists($data->path)) {
                Storage::disk('public')->delete($data->path);
            }

            $file = $request->file('path');
            $filePath = $file->store('regulasi_kip_ppid', 'public');

            $data->path = $filePath;
        }

        $data->nama = $request->nama;
        $data->save();

        return back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Delete data
     */
    public function destroy($id)
    {
        $data = RegulasiKemenkes::findOrFail($id);

        // Hapus file dari storage
        if ($data->path && Storage::disk('public')->exists($data->path)) {
            Storage::disk('public')->delete($data->path);
        }

        $data->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
