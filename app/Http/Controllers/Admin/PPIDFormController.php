<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PPIDForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PPIDFormController extends Controller
{
    public function index()
    {
        $data = PPIDForm::latest()->get();
        return view('pages.backend.informasi-publik.ppid.form.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'form_permohonan_informasi' => 'required|string',
            'form_keberatan' => 'required|string',
            'file_daftar_informasi_publik' => 'nullable|file|mimes:pdf,doc,docx'
        ]);

        $filePath = null;
        if ($request->hasFile('file_daftar_informasi_publik')) {
            $filePath = $request->file('file_daftar_informasi_publik')
                ->store('ppid', 'public');
        }

        PPIDForm::create([
            'form_permohonan_informasi' => $request->form_permohonan_informasi,
            'form_keberatan' => $request->form_keberatan,
            'file_daftar_informasi_publik' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $item = PPIDForm::findOrFail($id);

        $request->validate([
            'form_permohonan_informasi' => 'required|string',
            'form_keberatan' => 'required|string',
            'file_daftar_informasi_publik' => 'nullable|file|mimes:pdf,doc,docx'
        ]);

        if ($request->hasFile('file_daftar_informasi_publik')) {
            if ($item->file_daftar_informasi_publik) {
                Storage::disk('public')->delete($item->file_daftar_informasi_publik);
            }

            $item->file_daftar_informasi_publik = $request->file('file_daftar_informasi_publik')
                ->store('ppid', 'public');
        }

        $item->update([
            'form_permohonan_informasi' => $request->form_permohonan_informasi,
            'form_keberatan' => $request->form_keberatan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }
}
