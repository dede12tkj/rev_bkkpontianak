<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Perkecil & kompres gambar unggahan admin memakai ekstensi GD (tanpa exec()).
 * Bila GD tidak tersedia atau ada masalah, file asli disimpan apa adanya.
 */
class ImageOptimizer
{
    /**
     * Simpan unggahan (jpg/png) ke disk, dikecilkan ke $maxWidth dan dikonversi ke WebP
     * bila didukung. Mengembalikan path relatif seperti UploadedFile::store().
     */
    public static function store(UploadedFile $file, string $dir, int $maxWidth = 1600, int $quality = 82, string $disk = 'public'): string
    {
        try {
            $mime = (string) $file->getMimeType();
            $bytes = @file_get_contents($file->getRealPath());

            if ($bytes === false || ! in_array($mime, ['image/jpeg', 'image/png'], true)) {
                return $file->store($dir, $disk);
            }

            $image = self::load($bytes);
            if ($image === null) {
                return $file->store($dir, $disk);
            }

            $image = self::orient($image, $file->getRealPath(), $mime);
            [$image, $resized] = self::resize($image, $maxWidth);

            [$data, $ext] = self::encode($image, $mime, $quality, true);

            // Jangan simpan hasil yang malah lebih besar dari file asli.
            if ($data === null || (! $resized && strlen($data) >= strlen($bytes))) {
                return $file->store($dir, $disk);
            }

            $path = trim($dir, '/').'/'.Str::random(40).'.'.$ext;
            Storage::disk($disk)->put($path, $data);

            return $path;
        } catch (\Throwable $e) {
            report($e);

            return $file->store($dir, $disk);
        }
    }

    /**
     * Kompres ulang isi file TANPA mengganti format/nama (untuk gambar lama).
     * Mengembalikan null bila tidak perlu/tidak bisa dioptimasi.
     */
    public static function recompress(string $bytes, string $mime, int $maxWidth = 1600, int $quality = 82): ?string
    {
        if (! in_array($mime, ['image/jpeg', 'image/png'], true)) {
            return null;
        }

        $image = self::load($bytes);
        if ($image === null) {
            return null;
        }

        [$image, $resized] = self::resize($image, $maxWidth);
        [$data] = self::encode($image, $mime, $quality, false);

        if ($data === null || (! $resized && strlen($data) >= strlen($bytes) * 0.95)) {
            return null;
        }

        return $data;
    }

    private static function load(string $bytes): ?\GdImage
    {
        if (! function_exists('imagecreatefromstring')) {
            return null;
        }

        $image = @imagecreatefromstring($bytes);

        return $image instanceof \GdImage ? $image : null;
    }

    private static function orient(\GdImage $image, string $path, string $mime): \GdImage
    {
        if ($mime !== 'image/jpeg' || ! function_exists('exif_read_data')) {
            return $image;
        }

        $exif = @exif_read_data($path);
        $angle = [3 => 180, 6 => -90, 8 => 90][$exif['Orientation'] ?? 1] ?? 0;

        if ($angle === 0) {
            return $image;
        }

        $rotated = imagerotate($image, $angle, 0);

        return $rotated instanceof \GdImage ? $rotated : $image;
    }

    /** @return array{0: \GdImage, 1: bool} */
    private static function resize(\GdImage $image, int $maxWidth): array
    {
        if (imagesx($image) <= $maxWidth) {
            return [$image, false];
        }

        $scaled = imagescale($image, $maxWidth, -1, IMG_BICUBIC);

        return $scaled instanceof \GdImage ? [$scaled, true] : [$image, false];
    }

    /** @return array{0: ?string, 1: ?string} [data, ekstensi] */
    private static function encode(\GdImage $image, string $mime, int $quality, bool $preferWebp): array
    {
        imagealphablending($image, false);
        imagesavealpha($image, true);

        ob_start();

        if ($preferWebp && function_exists('imagewebp')) {
            imagepalettetotruecolor($image);
            $ok = imagewebp($image, null, $quality);
            $ext = 'webp';
        } elseif ($mime === 'image/png') {
            $ok = imagepng($image, null, 9);
            $ext = 'png';
        } else {
            imageinterlace($image, true);
            $ok = imagejpeg($image, null, $quality);
            $ext = 'jpg';
        }

        $data = ob_get_clean();

        return ($ok && is_string($data) && $data !== '') ? [$data, $ext] : [null, null];
    }
}
