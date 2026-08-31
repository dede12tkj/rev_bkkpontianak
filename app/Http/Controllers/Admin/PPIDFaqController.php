<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PPIDFaq;
use Illuminate\Http\Request;

class PPIDFaqController extends Controller
{
    public function index()
    {
        $data = PPIDFaq::latest()->get();

        return view('pages.backend.informasi-publik.ppid.faq.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        PPIDFaq::create($request->all());

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        $faq = PPIDFaq::findOrFail($id);
        $faq->update($request->all());

        return back()->with('success', 'Data berhasil diupdate');
    }
}
