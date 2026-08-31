<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanPPID;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PPIDLaporanController extends Controller
{
        public function index()
    {
        $data = LaporanPPID::orderBy('tahun','desc')
                ->orderBy('semester','desc')
                ->get();

        return view('pages.backend.informasi-publik.ppid.laporan.index', compact('data'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'semester' => 'required',
            'tahun' => 'required',
            'file_pdf' => 'required|mimes:pdf|max:2048'
        ]);

        $file = null;

        if($request->hasFile('file_pdf')){
            $file = $request->file('file_pdf')->store('laporan-ppid','public');
        }

        LaporanPPID::create([
            'nama' => $request->nama,
            'semester' => $request->semester,
            'tahun' => $request->tahun,
            'file_pdf' => $file
        ]);

        return redirect()->back()->with('success','Data berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $data = LaporanPPID::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'semester' => 'required',
            'tahun' => 'required',
            'file_pdf' => 'nullable|mimes:pdf|max:2048'
        ]);

        $file = $data->file_pdf;

        if($request->hasFile('file_pdf')){

            if($data->file_pdf){
                Storage::disk('public')->delete($data->file_pdf);
            }

            $file = $request->file('file_pdf')->store('laporan-ppid','public');
        }

        $data->update([
            'nama' => $request->nama,
            'semester' => $request->semester,
            'tahun' => $request->tahun,
            'file_pdf' => $file
        ]);

        return redirect()->back()->with('success','Data berhasil diupdate');
    }


    public function destroy($id)
    {
        $data = LaporanPPID::findOrFail($id);

        if($data->file_pdf){
            Storage::disk('public')->delete($data->file_pdf);
        }

        $data->delete();

        return redirect()->back()->with('success','Data berhasil dihapus');
    }

}
