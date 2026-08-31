<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $footer = Footer::all(); // biasanya footer cuma 1
        return view('pages.backend.footer.index', compact('footer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text'   => 'required|string|max:260',
            'alamat' => 'required',
            'email'  => 'required|email',
            'no_telp'=> 'required',
            'lokasi' => 'required',
        ]);

        Footer::create([
            'text'    => $request->text,
            'alamat'  => $request->alamat,
            'email'   => $request->email,
            'no-telp' => $request->no_telp, // jika kolom pakai dash
            'lokasi'  => $request->lokasi,
        ]);

        return redirect()->back()->with('success', 'Footer berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text'   => 'required|string|max:260',
            'alamat' => 'required',
            'email'  => 'required|email',
            'no_telp'=> 'required',
            'lokasi' => 'required',
        ]);

        $footer = Footer::findOrFail($id);

        $footer->update([
            'text'    => $request->text,
            'alamat'  => $request->alamat,
            'email'   => $request->email,
            'no-telp' => $request->no_telp,
            'lokasi'  => $request->lokasi,
        ]);

        return redirect()->back()->with('success', 'Footer berhasil diperbarui');
    }
}
