<?php

namespace App\Console\Commands;

use App\Support\ImageOptimizer;
use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize
                            {--dir= : Folder yang diproses (default: storage/app/public)}
                            {--max-width=1600 : Lebar maksimum piksel}
                            {--quality=82 : Kualitas JPEG (1-100)}
                            {--dry-run : Hanya tampilkan perkiraan, tidak mengubah file}';

    protected $description = 'Perkecil & kompres gambar jpg/png yang sudah ada tanpa mengubah nama/format file';

    public function handle(): int
    {
        if (! function_exists('imagecreatefromstring')) {
            $this->error('Ekstensi PHP GD belum aktif di server ini.');

            return self::FAILURE;
        }

        $dir = $this->option('dir') ?: storage_path('app/public');
        if (! is_dir($dir)) {
            $this->error("Folder tidak ditemukan: {$dir}");

            return self::FAILURE;
        }

        $maxWidth = max(320, (int) $this->option('max-width'));
        $quality = min(100, max(40, (int) $this->option('quality')));
        $dry = (bool) $this->option('dry-run');

        $before = $after = $changed = 0;

        $files = (new Finder)->files()->in($dir)->name('/\.(jpe?g|png)$/i');

        foreach ($files as $file) {
            $path = $file->getRealPath();
            $bytes = @file_get_contents($path);
            if ($bytes === false) {
                continue;
            }

            $mime = preg_match('/\.png$/i', $path) ? 'image/png' : 'image/jpeg';
            $size = strlen($bytes);
            $before += $size;

            $data = ImageOptimizer::recompress($bytes, $mime, $maxWidth, $quality);

            if ($data === null) {
                $after += $size;

                continue;
            }

            $changed++;
            $after += strlen($data);
            $this->line(sprintf('%s  %s -> %s KB', $file->getRelativePathname(), round($size / 1024), round(strlen($data) / 1024)));

            if (! $dry) {
                file_put_contents($path, $data);
            }
        }

        $this->info(sprintf(
            '%s%d file dioptimasi. Total %.1f MB -> %.1f MB',
            $dry ? '[dry-run] ' : '',
            $changed,
            $before / 1048576,
            $after / 1048576
        ));

        return self::SUCCESS;
    }
}
