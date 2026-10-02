<?php

namespace App\Console\Commands;

use App\Models\StandarPelayanan;
use Illuminate\Console\Command;

class PerbaikiStandarPelayanan extends Command
{
    protected $signature = 'standar-pelayanan:perbaiki
                            {--id= : ID data yang diperbaiki (kosong = semua)}
                            {--file= : Isi data dari file HTML (wajib bersama --id)}
                            {--dry-run : Hanya tampilkan data yang akan diperbaiki}';

    protected $description = 'Perbaiki isi standar pelayanan yang tersimpan sebagai teks ter-escape (&lt;h3&gt;), atau isi dari file HTML';

    public function handle(): int
    {
        if ($file = $this->option('file')) {
            if (! $this->option('id') || ! is_file($file)) {
                $this->error('Gunakan --id=ID dan pastikan path --file benar.');
                return self::FAILURE;
            }

            $row = StandarPelayanan::findOrFail($this->option('id'));
            if (! $this->option('dry-run')) {
                $row->update(['text' => file_get_contents($file)]);
            }
            $this->info("ID {$row->id} ({$row->nama}) diisi dari file.");
            return self::SUCCESS;
        }

        $rows = $this->option('id')
            ? StandarPelayanan::where('id', $this->option('id'))->get()
            : StandarPelayanan::all();

        $fixed = 0;
        foreach ($rows as $row) {
            $text = (string) $row->text;

            // Ciri data rusak: ada &lt;tag&gt; ter-escape (satu atau dua lapis)
            if (! preg_match('/&(amp;)*lt;\s*\/?[a-z][a-z0-9]*/i', $text)) {
                continue;
            }

            $clean = $text;
            // Buka lapisan escape sampai tidak berubah lagi (maks 3 kali)
            for ($i = 0; $i < 3; $i++) {
                $decoded = html_entity_decode($clean, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                if ($decoded === $clean) {
                    break;
                }
                $clean = $decoded;
            }

            // Buang <br> sisipan editor yang memenuhi tiap baris
            $clean = preg_replace('/<br\s*\/?>\s*(\r?\n)?/i', "\n", $clean);

            $this->line("Perbaiki ID {$row->id}: {$row->nama}");
            if (! $this->option('dry-run')) {
                $row->update(['text' => $clean]);
            }
            $fixed++;
        }

        $this->info("Selesai. {$fixed} data " . ($this->option('dry-run') ? 'akan diperbaiki.' : 'diperbaiki.'));
        return self::SUCCESS;
    }
}
