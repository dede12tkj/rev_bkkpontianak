<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananPengaduan;
use Illuminate\Http\Request;

class LayananPengaduanController extends Controller
{
public function index()
    {
        $layanan_pengaduan = LayananPengaduan::orderBy('nama')->get();
        return view('pages.backend.layanan-pengaduan-masyarakat.index', compact('layanan_pengaduan'));
    }

    public function store(Request $request)
{
    // Validasi input form
    $request->validate([
        'nama'           => 'required|string|max:255',
        'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
        'umur'           => 'required|integer|min:1|max:120',
        'permasalahan'   => 'required|string',
        'g-recaptcha-response' => 'required'
    ]);

    // ---------------------------
    // VALIDASI GOOGLE RECAPTCHA V2
    // ---------------------------
    $secret   = config('services.recaptcha.secret_key');
    $response = $request->input('g-recaptcha-response');

    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
    $captchaSuccess = json_decode($verify);

    if ($captchaSuccess->success == false) {
        return back()->withErrors(['captcha' => 'Verifikasi reCAPTCHA gagal.'])->withInput();
    }

    // ---------------------------
    // SIMPAN DATA KE DATABASE
    // ---------------------------
    LayananPengaduan::create([
        'nama'          => $request->nama,
        'jenis_kelamin' => $request->jenis_kelamin,
        'umur'          => $request->umur,
        'permasalahan'  => $request->permasalahan,
        'status_pengaduan'        => 'Menunggu',
    ]);

    return redirect()->back()->with('success', 'Pengaduan berhasil dikirim!');
}



}
