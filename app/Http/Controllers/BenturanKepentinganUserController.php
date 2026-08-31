<?php

namespace App\Http\Controllers;

use App\Models\BenturanKepentingan;
use App\Models\BenturanKepentinganUser;
use Illuminate\Http\Request;

class BenturanKepentinganUserController extends Controller
{
    /**
     * List Data (dipindahkan dari closure di routes/web.php)
     */
    public function index()
    {
        $data = BenturanKepentinganUser::latest()->get();

        return view('pages.backend.form-benturan-kepentingan.index', compact('data'));
    }

    /**
     * Store Data
     */
    public function store(Request $request)
    {
        $request->validate([

            'nama_lengkap' => 'required',

            'jabatan' => 'required',

            'unit_kerja' => 'required',

            'email' => 'required|email',

            'uraian_konflik' => 'required',

            'kepentingan' => 'required',

            'penyebab' => 'required',

            'tempat_laporan' => 'required',

        ]);

        BenturanKepentinganUser::create([

            'nama_lengkap' => $request->nama_lengkap,

            'jabatan' => $request->jabatan,

            'unit_kerja' => $request->unit_kerja,

            'email' => $request->email,

            'uraian_konflik' => $request->uraian_konflik,

            'kepentingan' => $request->kepentingan,

            'penyebab' => $request->penyebab,

            'tempat_laporan' => $request->tempat_laporan,

        ]);

        return redirect()->back()->with(
            'success',
            'Data benturan kepentingan berhasil dikirim'
        );
    }

    /**
     * Update Data
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'nama_lengkap' => 'required',

            'jabatan' => 'required',

            'unit_kerja' => 'required',

            'email' => 'required|email',

            'uraian_konflik' => 'required',

            'kepentingan' => 'required',

            'penyebab' => 'required',

            'tempat_laporan' => 'required',

        ]);

        $data = BenturanKepentinganUser::findOrFail($id);

        $data->update([

            'nama_lengkap' => $request->nama_lengkap,

            'jabatan' => $request->jabatan,

            'unit_kerja' => $request->unit_kerja,

            'email' => $request->email,

            'uraian_konflik' => $request->uraian_konflik,

            'kepentingan' => $request->kepentingan,

            'penyebab' => $request->penyebab,

            'tempat_laporan' => $request->tempat_laporan,

        ]);

        return redirect()->back()->with(
            'success',
            'Data berhasil diupdate'
        );
    }

    /**
     * Delete Data
     */
    public function destroy($id)
    {
        $data = BenturanKepentinganUser::findOrFail($id);

        $data->delete();

        return redirect()->back()->with(
            'success',
            'Data berhasil dihapus'
        );
    }

    public function previewPdf($id)
    {
        $data = BenturanKepentinganUser::findOrFail($id);

        return view(
            'pages.backend.form-benturan-kepentingan.pdf',
            compact('data')
        );
    }
}
