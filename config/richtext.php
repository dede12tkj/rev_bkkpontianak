<?php

use App\Models\Artikel;
use App\Models\Berita;
use App\Models\BenturanKepentingan;
use App\Models\FaqWbk;
use App\Models\GolKPK;
use App\Models\LaporSpan;
use App\Models\Pengumuman;
use App\Models\Posein;
use App\Models\ProfilSKI;
use App\Models\SejarahDanLatarBelakang;
use App\Models\StandarPelayanan;
use App\Models\StrukturOrganisasi;
use App\Models\Survey;
use App\Models\TugasDanFungsi;
use App\Models\UPG;
use App\Models\VisiMisi;

return [

    /*
    | Saring HTML dari editor setiap kali data disimpan (script, onclick, javascript: dst dibuang).
    | Matikan sementara bila perlu dengan RICHTEXT_SANITIZE=false di .env
    */
    'enabled' => env('RICHTEXT_SANITIZE', true),

    /*
    | Model => kolom yang berisi HTML dari editor.
    | Tambahkan baris baru di sini bila ada halaman admin baru dengan editor.
    */
    'fields' => [
        Artikel::class => ['konten'],
        Berita::class => ['konten'],
        BenturanKepentingan::class => ['text'],
        FaqWbk::class => ['deskripsi'],
        GolKPK::class => ['text'],
        LaporSpan::class => ['text'],
        Pengumuman::class => ['isi'],
        Posein::class => ['content'],
        ProfilSKI::class => ['text'],
        SejarahDanLatarBelakang::class => ['text'],
        StandarPelayanan::class => ['text'],
        StrukturOrganisasi::class => ['text'],
        Survey::class => ['isi'],
        TugasDanFungsi::class => ['text'],
        UPG::class => ['text'],
        VisiMisi::class => ['visi', 'misi', 'tujuan'],
    ],
];
