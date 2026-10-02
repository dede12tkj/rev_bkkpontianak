<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Upload gambar dari editor (Summernote) dengan validasi yang sama untuk semua halaman admin.
 * Hanya gambar JPG/PNG/GIF/WebP maksimal 4 MB; SVG dan file lain ditolak.
 */
class EditorUpload
{
    public static function store(Request $request, string $directory = 'summernote'): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:4096'],
        ], [
            'file.required' => 'Pilih gambar terlebih dahulu.',
            'file.image' => 'File harus berupa gambar.',
            'file.mimes' => 'Format gambar harus JPG, PNG, GIF, atau WebP.',
            'file.max' => 'Ukuran gambar maksimal 4 MB.',
        ]);

        $path = $request->file('file')->store($directory, 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }
}
