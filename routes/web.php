<?php

use App\Http\Controllers\Admin\AkuntabilitasController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\BedesutController;
use App\Http\Controllers\Admin\BedesutDashboardController;
use App\Http\Controllers\Admin\BedesutInfografisController;
use App\Http\Controllers\Admin\BenturanKepentinganController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ELibraryController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\FormSurveyKepuasanMasyarakatController;
use App\Http\Controllers\Admin\GambarMaklumatPelayananController;
use App\Http\Controllers\Admin\GolKPKController;
use App\Http\Controllers\Admin\InfografisController;
use App\Http\Controllers\Admin\InformasiPublikBerkalaController;
use App\Http\Controllers\Admin\InformasiPublikSetiapSaatController;
use App\Http\Controllers\Admin\JudulBedesutController;
use App\Http\Controllers\Admin\KategoriBeritaController;
use App\Http\Controllers\Admin\LaporanSKIController;
use App\Http\Controllers\Admin\LaporSpanController;
use App\Http\Controllers\Admin\LayananPengaduanController;
use App\Http\Controllers\Admin\PanduanSKIController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\PoseinController;
use App\Http\Controllers\Admin\PPIDFaqController;
use App\Http\Controllers\Admin\PPIDFormController;
use App\Http\Controllers\Admin\PPIDLaporanController;
use App\Http\Controllers\Admin\PPIDProfilController;
use App\Http\Controllers\Admin\PPIDRegulasiKemenkesController;
use App\Http\Controllers\Admin\PPIDRegulasiKIPController;
use App\Http\Controllers\Admin\PPIDSopKIController;
use App\Http\Controllers\Admin\PPIDStandarLayananController;
use App\Http\Controllers\Admin\PPIDStrukturOrganisasiController;
use App\Http\Controllers\Admin\PPIDTugasFungsiController;
use App\Http\Controllers\Admin\PPIDVisiMisiController;
use App\Http\Controllers\Admin\ProfilSKIController;
use App\Http\Controllers\Admin\SejarahDanLatarBelakangController;
use App\Http\Controllers\Admin\SkmSurveyController as AdminSkmSurveyController;
use App\Http\Controllers\Admin\SkmSectionController;
use App\Http\Controllers\Admin\SkmQuestionController;
use App\Http\Controllers\SkmSurveyController;
use App\Http\Controllers\Admin\SKDanSOPController;
use App\Http\Controllers\Admin\SopController;
use App\Http\Controllers\Admin\SosmedController;
use App\Http\Controllers\Admin\StandarPelayananController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\Admin\SubInformasiPublikBerkalaController;
use App\Http\Controllers\Admin\SubJudulBedesutController;
use App\Http\Controllers\Admin\SummernoteController;
use App\Http\Controllers\Admin\SunmoreController;
use App\Http\Controllers\Admin\SurveyController;
use App\Http\Controllers\Admin\TentangKamiController;
use App\Http\Controllers\Admin\TentangWBKController;
use App\Http\Controllers\Admin\TugasPokokDanFungsiController;
use App\Http\Controllers\Admin\UPGController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Admin\WilkerController;
use App\Http\Controllers\BenturanKepentinganUserController;
use App\Http\Controllers\KontakKamiController;
use App\Http\Controllers\LayananPengaduanMasyarakatUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserBeritaController;
use App\Models\Akuntabilitas;
use App\Models\Artikel;
use App\Models\Bedesut;
use App\Models\BenturanKepentingan;
use App\Models\BenturanKepentinganUser;
use App\Models\Berita;
use App\Models\Buletin;
use App\Models\Carousel;
use App\Models\DashboardInteraktif;
use App\Models\FaqWbk;
use App\Models\Footer;
use App\Models\FormSurveyKepuasanMasyarakat;
use App\Models\GambarMaklumatPelayanan;
use App\Models\Infografis;
use App\Models\InformasiPublikBerkala;
use App\Models\InformasiPublikSetiapSaat;
use App\Models\KategoriBerita;
use App\Models\LaporanPPID;
use App\Models\PanduanSKI;
use App\Models\Pengumuman;
use App\Models\Posein;
use App\Models\PPIDFaq;
use App\Models\PPIDForm;
use App\Models\PPIDProfil;
use App\Models\PPIDStandarLayanan;
use App\Models\PPIDStrukturOrganisasi;
use App\Models\PPIDTugasFungsi;
use App\Models\PPIDVisiMisi;
use App\Models\RegulasiKemenkes;
use App\Models\RegulasiKIP;
use App\Models\RegulasiSopKI;
use App\Models\SejarahDanLatarBelakang;
use App\Models\SKDanSOP;
use App\Models\Sop;
use App\Models\Sosmed;
use App\Models\StandarPelayanan;
use App\Models\StrukturOrganisasi;
use App\Models\SubJudulBedesut;
use App\Models\Sunmore;
use App\Models\Survey;
use App\Models\TentangKami;
use App\Models\TugasDanFungsi;
use App\Models\VisiMisi;
use App\Models\Wilker;
use App\Models\WilkerText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $berita = Berita::where('status', 'published')
        ->orderBy('tanggal', 'desc')
        ->take(5)
        ->get();
    $carousel = Carousel::all();
    $gambar = GambarMaklumatPelayanan::first();
    $sosmed = Sosmed::first();
    $tentang_kami = TentangKami::first();
    $fskm = FormSurveyKepuasanMasyarakat::first();
    $footer = Footer::first();
    $ikm = Survey::skm()
        ->latest()
        ->take(3)
        ->get();
    $layanan = StandarPelayanan::orderBy('id')->get();

    return view('pages.frontend.welcome', compact('berita', 'gambar', 'carousel', 'tentang_kami', 'fskm', 'footer', 'sosmed', 'ikm', 'layanan'));
})->name('beranda');

Route::get('/layanan/{id}', [StandarPelayananController::class, 'show'])
    ->name('standar-pelayanan.show');

Route::get('/detail', function () {
    return view('pages.frontend.detail');
})->name('detail');

// START PROFIL

Route::get('/sejarah', function () {
    $sejarah = SejarahDanLatarBelakang::first();

    return view('pages.frontend.profil.sejarah', compact('sejarah'));
})->name('sejarah');

Route::get('/visi-dan-misi', function () {
    $visi = VisiMisi::first();

    return view('pages.frontend.profil.visi-dan-misi', compact('visi'));
})->name('visi-dan-misi');

Route::get('/tugas-pokok-dan-fungsi', function () {
    $tugas = TugasDanFungsi::first();

    return view('pages.frontend.profil.tugas-pokok-dan-fungsi', compact('tugas'));
})->name('tugas-pokok-dan-fungsi');

Route::get('/struktur-organisasi', function () {
    $item = StrukturOrganisasi::first();

    return view('pages.frontend.profil.struktur-organisasi', compact('item'));
})->name('struktur-organisasi');

Route::get('/wilayah-kerja', function () {
    $wilkers = Wilker::orderBy('id')->get();
    $wilkerText = WilkerText::first();

    return view('pages.frontend.profil.wilayah-kerja', compact('wilkers', 'wilkerText'));
})->name('wilayah-kerja');

Route::get('/infografis', function () {
    return view('pages.frontend.profil.infografis');
})->name('infografis');

// END PROFIL

// START SKI

Route::get('/profil-ski', function () {
    return view('pages.frontend.SKI.profil-ski');
})->name('profil-ski');

Route::get('/panduan-ski', function () {
    $data = PanduanSKI::orderBy('id', 'asc')->get();

    return view('pages.frontend.SKI.panduan-ski', compact('data'));
})->name('panduan-ski');

Route::get('/laporan-ski', function () {
    $data = \App\Models\LaporanSKI::orderBy('tahun', 'desc')
        ->orderBy('semester', 'asc')
        ->get()
        ->groupBy('tahun');

    return view('pages.frontend.SKI.laporan-ski', compact('data'));
})->name('laporan-ski');

Route::get('/laporan-ski/{id}', [LaporanSKIController::class, 'show'])
    ->name('laporan-ski.show');

Route::get('/sk-dan-sop', function () {
    $dataSOP = SKDanSOP::where('kategori', 'SOP')->get();

    $sk = \App\Models\SKDanSOP::where('kategori', 'SK')->get();

    $dataSK = $sk->groupBy('nama')->map(function ($items) {
        return [
            'nama' => $items->first()->nama,
            'data' => $items->keyBy('tahun'), // kunci berdasarkan tahun
        ];
    });

    // ambil tahun terkecil dari data
    $tahunAwal = $sk->min('tahun') ?? date('Y');

    // pakai tahun sekarang
    $tahunAkhir = date('Y');

    // generate range tahun (contoh: 2022 - 2026)
    $tahuns = range($tahunAwal, $tahunAkhir);

    return view('pages.frontend.SKI.sk-dan-sop', compact('dataSK', 'dataSOP', 'tahuns'));
})->name('sk-dan-sop');

Route::get('/sk-dan-sop/{id}', [SKDanSOPController::class, 'show'])
    ->name('sk-dan-sop.show');

// END SKI

// START LAYANAN

Route::get('/pengaduan-layanan-masyarakat', function () {
    return view('pages.frontend.layanan.pengaduan-layanan-masyarakat');
})->name('pengaduan-layanan-masyarakat');

Route::get('/maklumat-pelayanan', function () {
    $gambar = GambarMaklumatPelayanan::first();

    return view('pages.frontend.layanan.maklumat-pelayanan', compact('gambar'));
})->name('maklumat-pelayanan');

Route::get('/standar-pelayanan', function () {
    $data = StandarPelayanan::all();

    return view('pages.frontend.layanan.standar-pelayanan', compact('data'));
})->name('standar-pelayanan');

Route::get('/standar-pelayanan/{id}', [StandarPelayananController::class, 'show'])
    ->name('standar-pelayanan.show');

Route::get('/sinkarkes', function () {
    return view('pages.frontend.layanan.sinkarkes');
})->name('sinkarkes');

Route::get('/formulir-permohonan-layanan', function () {
    return view('pages.frontend.layanan.formulir-permohonan-layanan');
})->name('formulir-permohonan-layanan');

Route::get('/posein-aza', function () {
    $poseins = Posein::latest()->get(); // ambil semua data

    return view('pages.frontend.layanan.poseinaza', compact('poseins'));
})->name('posein-aza');

// END LAYANAN

// START PENGADUAN

Route::get('/tentang-wbk-wbbm', function () {
    $data = FaqWbk::all();

    return view('pages.frontend.pengaduan.tentang-wbk-wbbm', compact('data'));
})->name('tentang-wbk-wbbm');

Route::get('/wbs', function () {
    return view('pages.frontend.pengaduan.wbs');
})->name('wbs');

Route::get('/benturan-kepentingan', function () {
    $data = BenturanKepentingan::all();

    return view('pages.frontend.pengaduan.benturan-kepentingan', compact('data'));
})->name('benturan-kepentingan');

Route::get('/span-lapor', function () {
    return view('pages.frontend.pengaduan.spanlapor');
})->name('span-lapor');

Route::get('/gol-kpk', function () {
    return view('pages.frontend.pengaduan.golkpk');
})->name('gol-kpk');

Route::get('/unit-pengendalian-gratifikasi', function () {
    return view('pages.frontend.pengaduan.unit-pengendalian-gratifikasi');
})->name('unit-pengendalian-gratifikasi');

// END PENGADUAN

// START INFORMASI PUBLIK

// 🔹 HALAMAN UTAMA
Route::get('/informasi-publik/bedesut', function () {
    $data = SubJudulBedesut::with('konten')->get()
        ->groupBy(function ($item) {
            return class_basename($item->konten_type);
        });

    return view('pages.frontend.informasi-publik.bedesut', compact('data'));
})->name('bedesut');

// 🔹 HALAMAN PER TIPE
Route::get('/informasi-publik/bedesut/{tipe}', function ($tipe) {

    $map = [
        'dashboardinteraktif' => DashboardInteraktif::class,
        'infografis' => Infografis::class,
        'sunmore' => Sunmore::class,
        'buletin' => Buletin::class,
    ];

    if (! isset($map[$tipe])) {
        abort(404);
    }

    $data = SubJudulBedesut::with('konten')
        ->where('konten_type', $map[$tipe])
        ->get();

    return view('pages.frontend.informasi-publik.bedesut-tipe', compact('data', 'tipe'));

})->name('bedesut.tipe');

Route::get('/informasi-publik/berita', function () {
    $beritas = Berita::with('kategori', 'penulis')
        ->orderBy('tanggal', 'DESC')
        ->paginate(6);

    // gunakan nama yang sama: kategoriList
    $kategoriList = KategoriBerita::orderBy('nama_kategori', 'ASC')->get();

    $recentPost = Berita::orderBy('tanggal', 'DESC')->take(10)->get();

    return view('pages.frontend.informasi-publik.berita', compact('beritas', 'kategoriList', 'recentPost'));
})->name('berita');

Route::get('/informasi-publik/bedesut/detail/{id}', function ($id) {

    $data = \App\Models\SubJudulBedesut::with('konten')->findOrFail($id);

    return view('pages.frontend.informasi-publik.bedesut-detail', compact('data'));

})->name('bedesut.detail');

Route::get('/informasi-publik/berita/kategori/{id}',
    [UserBeritaController::class, 'filterByCategory']
)->name('berita.kategori');

Route::get('/informasi-publik/artikel', function () {
    $data = Artikel::where('status', 'published')
        ->latest()
        ->get();

    return view('pages.frontend.informasi-publik.artikel', compact('data'));
})->name('artikel');

Route::get('/artikel/{slug}', function ($slug) {

    $artikel = Artikel::where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();

    // tambah view count
    $artikel->increment('views');

    return view('pages.frontend.informasi-publik.detail', compact('artikel'));

})->name('artikel-detail.show');

Route::get('/informasi-publik/pengumuman', function () {
    $pengumuman = Pengumuman::where('status', 'published')
        ->orderBy('is_penting', 'desc')
        ->orderBy('tanggal', 'desc')
        ->get();

    return view('pages.frontend.informasi-publik.pengumuman', compact('pengumuman'));
})->name('pengumuman');

Route::get('/informasi-publik/sop', function () {
    $sop = Sop::orderBy('kategori')
        ->orderBy('judul')
        ->get()
        ->groupBy('kategori');

    return view('pages.frontend.informasi-publik.sop', compact('sop'));
})->name('sop');

Route::get('/informasi-publik/e-library', function () {
    $data = \App\Models\ELibrary::latest()->get();

    return view('pages.frontend.informasi-publik.elibrary', compact('data'));
})->name('elibrary');

Route::get('/informasi-publik/akuntabilitas', function () {
    $data = Akuntabilitas::orderBy('tahun', 'desc')
        ->get()
        ->groupBy('tahun');

    return view('pages.frontend.informasi-publik.akuntabilitas', compact('data'));
})->name('akuntabilitas');

Route::get('/informasi-publik/survey-kepuasan-masyarakat', function () {
    $skm = Survey::where('kategori', 'SKM')
        ->orderBy('tahun', 'desc')
        ->get()
        ->groupBy('tahun');

    $spak = Survey::where('kategori', 'SPAK')
        ->orderBy('tahun', 'desc')
        ->get()
        ->groupBy('tahun');

    return view('pages.frontend.informasi-publik.survey-kepuasan-masyarakat', compact('skm', 'spak'));
})->name('survey-kepuasan-masyarakat');

Route::get('informasi-publik/survey-kepuasan-masyarakat/{id}', [SurveyController::class, 'show'])
    ->name('survey-admin.show');

Route::get('/informasi-publik/ppid', function () {
    $faq = PPIDFaq::latest()->get();
    $form = PPIDForm::latest()->first(); // ambil 1 data saja

    return view('pages.frontend.informasi-publik.ppid', compact('faq', 'form'));
})->name('ppid');

// END INFORMASI PUBLIK

// START PPID
Route::get('/informasi-publik/ppid/profil', function () {
    return view('pages.frontend.ppid.profil');
})->name('ppid.profil');

Route::get('/informasi-publik/ppid/profil-singkat', function () {

    $profil = PPIDProfil::latest()->first();
    // ambil 1 data terbaru

    return view('components.ppid.profil-singkat', compact('profil'));

})->name('ppid.profil-singkat');

Route::get('/informasi-publik/ppid/tugas-fungsi', function () {
    $profil = PPIDTugasFungsi::latest()->first();

    return view('components.ppid.tugas-fungsi', compact('profil'));
})->name('ppid.tugas-fungsi');

Route::get('/informasi-publik/ppid/struktur-organisasi', function () {
    $struktur = PPIDStrukturOrganisasi::latest()->get();

    return view('components.ppid.struktur-organisasi', compact('struktur'));
})->name('ppid.struktur-organisasi');

Route::get('/informasi-publik/ppid/visi-misi', function () {

    $data = PPIDVisiMisi::latest()->first();

    return view('components.ppid.visi-misi', compact('data'));

})->name('ppid.visi-misi');

Route::get('/informasi-publik/ppid/regulasi', function () {
    return view('pages.frontend.ppid.regulasi');
})->name('ppid.regulasi');

Route::get('/informasi-publik/ppid/regulasi/kip', function () {

    $data = RegulasiKIP::latest()->get();

    return view('components.ppid.regulasi.kip', compact('data'));

})->name('ppid.regulasi.kip');

Route::get('/informasi-publik/ppid/regulasi/kemenkes', function () {
    $data = RegulasiKemenkes::latest()->get();

    return view('components.ppid.regulasi.kemenkes', compact('data'));
})->name('ppid.regulasi.kemenkes');

Route::get('/informasi-publik/ppid/regulasi/ski', function () {
    $data = RegulasiSopKI::latest()->get();

    return view('components.ppid.regulasi.sop', compact('data'));
})->name('ppid.regulasi.sop');

Route::get('/informasi-publik/ppid/standar-layanan', function () {
    $standarLayanan = PPIDStandarLayanan::all();

    return view('pages.frontend.ppid.standar-layanan', compact('standarLayanan'));
})->name('ppid.standar-layanan');

Route::get('/informasi-publik/ppid/informasi-publik', function () {
    return view('pages.frontend.ppid.informasi-publik');
})->name('ppid.informasi-publik');

Route::get('/informasi-publik/ppid/laporan', function () {
    return view('pages.frontend.ppid.laporan');
})->name('ppid.laporan');

Route::get('/informasi-publik/ppid/standar-layanan/prosedur-permintaan-informasi', function () {
    return view('components.ppid.standar-layanan.prosedur-permintaan-informasi');
})->name('ppid.standar-layanan.prosedur-permintaan-informasi');

Route::get('informasi-publik/ppid/standar-layanan/{id}', function ($id) {

    $data = PPIDStandarLayanan::findOrFail($id);

    return view('components.ppid.standar-layanan.detail', compact('data'));

});

Route::get('/informasi-publik/ppid/standar-layanan/prosedur-pengajuan-keberatan', function () {
    return view('components.ppid.standar-layanan.prosedur-pengajuan-keberatan');
})->name('ppid.standar-layanan.prosedur-pengajuan-keberatan');

Route::get('/informasi-publik/ppid/standar-layanan/prosedur-pemohonan-penyelesaian-sengketa-informasi-publik', function () {
    return view('components.ppid.standar-layanan.prosedur-pemohonan-penyelesaian-sengketa-informasi-publik');
})->name('ppid.standar-layanan.prosedur-pemohonan-penyelesaian-sengketa-informasi-publik');

Route::get('/informasi-publik/ppid/standar-layanan/prosedur-waktu-layanan-informasi', function () {
    return view('components.ppid.standar-layanan.waktu-layanan-informasi');
})->name('ppid.standar-layanan.prosedur-waktu-layanan-informasi');

Route::get('/informasi-publik/ppid/standar-layanan/standar-biaya-perolehan-informasi', function () {
    return view('components.ppid.standar-layanan.standar-biaya-perolehan-informasi');
})->name('ppid.standar-layanan.standar-biaya-perolehan-informasi');

Route::get('/informasi-publik/ppid/informasi-publik/informasi-publik-berkala', function () {
    $data = InformasiPublikBerkala::with('sub')->get();

    return view('components.ppid.informasi-publik.ipb', compact('data'));

})->name('ppid.informasi-publik.ipb');

Route::get('/informasi-publik/ppid/informasi-publik/informasi-publik-tersedia-setiap-saat', function () {
    $data = InformasiPublikSetiapSaat::with('sub')->get();

    return view('components.ppid.informasi-publik.iptss', compact('data'));
})->name('ppid.informasi-publik.iptss');

Route::get('/informasi-publik/ppid/informasi-publik/informasi-publik-serta-merta', function () {
    return view('components.ppid.informasi-publik.ipsm');
})->name('ppid.informasi-publik.ipsm');

Route::get('/informasi-publik/ppid/laporan/laporan-tahunan-layanan-ppid', function () {
    $data = LaporanPPID::orderBy('tahun', 'desc')
        ->orderBy('semester', 'desc')
        ->get();

    return view('components.ppid.laporan.ltlp', compact('data'));
})->name('ppid.laporan.ltlp');

Route::get('/informasi-publik/ppid/laporan/ringkasan-akses-informasi-publik', function () {
    return view('components.ppid.laporan.raip');
})->name('ppid.laporan.raip');

// END PPID

Route::get('/kontak-kami', function () {
    return view('pages.frontend.kontak-kami');
})->name('kontak-kami');

// Route::get('/dashboard', function () {
//     return view('pages.backend.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('pengumuman', PengumumanController::class)
        ->except(['create', 'edit']);

    Route::resource('survey-admin', SurveyController::class)
        ->except(['create', 'edit']);
    // Berita
    Route::resource('admin/berita', BeritaController::class);
    Route::resource('kategori-berita', KategoriBeritaController::class);
    Route::resource('gambarmaklumatpelayanan', GambarMaklumatPelayananController::class);
    Route::resource('carousel', CarouselController::class);
    Route::resource('tentang-kami', TentangKamiController::class);
    Route::resource('sosmed', SosmedController::class);
    Route::resource('footer', FooterController::class);
    Route::resource('form-survey-kepuasan-masyarakat', FormSurveyKepuasanMasyarakatController::class);
    Route::resource('sejarah-dan-latar-belakang', SejarahDanLatarBelakangController::class);
    Route::resource('visi-misi', VisiMisiController::class);
    Route::resource('admin-infografis', InfografisController::class);
    Route::resource('admin-standar-pelayanan', StandarPelayananController::class);
    Route::post('admin-standar-pelayanan/upload-image', [StandarPelayananController::class, 'uploadImage'])->name('standar-pelayanan.upload-image');
    Route::resource('admin-benturan-kepentingan', BenturanKepentinganController::class);
    Route::post('admin-benturan-kepentingan/upload-image', [BenturanKepentinganController::class, 'uploadImage'])->name('benturan-kepentingan.upload-image');

    // ============================================================
    // Survei Kepuasan Masyarakat (IKM) - builder & rekap (admin)
    // ============================================================
    Route::get('admin-skm-survey', [AdminSkmSurveyController::class, 'index'])->name('admin-skm-survey.index');
    Route::post('admin-skm-survey', [AdminSkmSurveyController::class, 'store'])->name('admin-skm-survey.store');
    Route::put('admin-skm-survey/{skmSurvey}', [AdminSkmSurveyController::class, 'update'])->name('admin-skm-survey.update');
    Route::get('admin-skm-survey/{skmSurvey}/export', [AdminSkmSurveyController::class, 'exportResponses'])->name('admin-skm-survey.export');

    Route::get('admin-skm-survey-responses', [AdminSkmSurveyController::class, 'responses'])->name('admin-skm-survey.responses');
    Route::get('admin-skm-survey-responses/{skmResponse}', [AdminSkmSurveyController::class, 'showResponse'])->name('admin-skm-survey.response.show');
    Route::delete('admin-skm-survey-responses/{skmResponse}', [AdminSkmSurveyController::class, 'destroyResponse'])->name('admin-skm-survey.response.destroy');

    Route::post('admin-skm-section/{skmSurvey}', [SkmSectionController::class, 'store'])->name('admin-skm-section.store');
    Route::put('admin-skm-section/{skmSection}', [SkmSectionController::class, 'update'])->name('admin-skm-section.update');
    Route::delete('admin-skm-section/{skmSection}', [SkmSectionController::class, 'destroy'])->name('admin-skm-section.destroy');
    Route::post('admin-skm-section/{skmSection}/move', [SkmSectionController::class, 'move'])->name('admin-skm-section.move');

    Route::post('admin-skm-question/{skmSection}', [SkmQuestionController::class, 'store'])->name('admin-skm-question.store');
    Route::put('admin-skm-question/{skmQuestion}', [SkmQuestionController::class, 'update'])->name('admin-skm-question.update');
    Route::delete('admin-skm-question/{skmQuestion}', [SkmQuestionController::class, 'destroy'])->name('admin-skm-question.destroy');
    Route::post('admin-skm-question/{skmQuestion}/move', [SkmQuestionController::class, 'move'])->name('admin-skm-question.move');

    Route::resource('admin-profil-ski', ProfilSKIController::class)->only([
        'index', 'store', 'update',
    ]);

    Route::resource('admin-akuntabilitas', AkuntabilitasController::class)
        ->except(['create', 'edit']);

    Route::resource('admin-elibrary', ELibraryController::class)
        ->except(['create', 'edit']);

    Route::post('admin-profil-ski/upload-image', [ProfilSKIController::class, 'uploadImage'])
        ->name('profil-ski.upload-image');

    Route::resource('admin-panduan-ski', PanduanSKIController::class);
    Route::resource('admin-laporan-ski', LaporanSKIController::class);

    Route::resource('tugas-fungsi', TugasPokokDanFungsiController::class);
    Route::post('tugas-fungsi/upload-image', [TugasPokokDanFungsiController::class, 'uploadImage'])
        ->name('tugas-fungsi.upload-image');

    Route::resource('lapor-span', LaporSpanController::class);
    Route::post('lapor-span/upload-image', [LaporSpanController::class, 'uploadImage'])
        ->name('lapor-span.upload-image');

    Route::resource('admin-gol-kpk', GolKPKController::class);
    Route::post('admin-gol-kpk/upload-image', [GolKPKController::class, 'uploadImage'])
        ->name('admin-gol-kpk.upload-image');

    Route::resource('upg', UPGController::class);
    Route::post('upg/upload-image', [UPGController::class, 'uploadImage'])
        ->name('upg.upload-image');

    Route::resource('admin-faq-wbk', TentangWBKController::class);

    Route::resource('admin-bedesut', BedesutController::class);
    Route::resource('admin-bedesut-infografis', BedesutInfografisController::class);

    Route::resource('admin-dashboard-interaktif', BedesutDashboardController::class);

    Route::resource('admin-ppid-form', PPIDFormController::class);

    Route::resource('admin-ppid-faq', PPIDFaqController::class);

    Route::resource('admin-ppid-profil', PPIDProfilController::class);

    Route::resource('admin-ppid-tugas-fungsi', PPIDTugasFungsiController::class);

    Route::resource('admin-ppid-struktur-organisasi', PPIDStrukturOrganisasiController::class);

    Route::resource('admin-ppid-visi-misi', PPIDVisiMisiController::class);

    Route::resource('admin-ppid-regulasi-kip', PPIDRegulasiKIPController::class);

    Route::resource('admin-ppid-regulasi-kemenkes', PPIDRegulasiKemenkesController::class);

    Route::resource('admin-ppid-regulasi-sop-ki', PPIDSopKIController::class);

    Route::resource('admin-sop', SopController::class)
        ->except(['create', 'edit']);

    Route::post('admin-dashboard-interaktif/upload-image', [BedesutDashboardController::class, 'uploadImage'])->name('dashboard-interaktif.upload-image');

    Route::resource('admin-struktur-organisasi', StrukturOrganisasiController::class);
    Route::post('admin-struktur-organisasi/upload-image', [StrukturOrganisasiController::class, 'uploadImage'])
        ->name('struktur-organisasi.upload-image');

    // Layanan Pengaduan Masyarakat
    Route::get('/layanan-pengaduan-masyarakat', [LayananPengaduanController::class, 'index'])
        ->name('layanan-pengaduan-masyarakat.index');

    Route::post('/summernote/upload', [SummernoteController::class, 'upload'])
        ->name('summernote.upload');

    Route::resource('admin-wilker', WilkerController::class);
    Route::post('admin-wilker/text', [WilkerController::class, 'saveText'])
        ->name('wilker.text');

    Route::prefix('admin-posein')->group(function () {
        Route::get('/', [PoseinController::class, 'index'])->name('posein.index');
        Route::post('/store', [PoseinController::class, 'store'])->name('posein.store');
        Route::put('/update/{id}', [PoseinController::class, 'update'])->name('posein.update');
        Route::delete('/delete/{id}', [PoseinController::class, 'destroy'])->name('posein.destroy');

        Route::post('/upload-image', [PoseinController::class, 'uploadImage'])->name('posein.upload');
    });

    Route::get('admin-laporan-ski/{id}/flipbook',
        [LaporanSKIController::class, 'flipbook']
    )->name('admin-laporan-ski.flipbook');

    Route::resource('admin-sk-dan-sop', SKDanSOPController::class);

    Route::resource('admin-ppid-standar-layanan', PPIDStandarLayananController::class);

    // admin
    Route::resource('admin-artikel', ArtikelController::class);

    Route::resource('admin-ppid-laporan', PPIDLaporanController::class);

    Route::resource('sunmore', SunmoreController::class);

    // Parent
    Route::get('/admin/informasi-berkala', [InformasiPublikBerkalaController::class, 'index'])->name('informasi-berkala.index');
    Route::post('/admin/informasi-berkala/store', [InformasiPublikBerkalaController::class, 'store'])->name('informasi-berkala.store');
    Route::put('/admin/informasi-berkala/{id}', [InformasiPublikBerkalaController::class, 'update'])->name('informasi-berkala.update');
    Route::delete('/admin/informasi-berkala/{id}', [InformasiPublikBerkalaController::class, 'destroy'])->name('informasi-berkala.destroy');

    // Judul Bedesut
    Route::get('/judul-bedesut', [JudulBedesutController::class, 'index'])->name('admin.judul-bedesut.index');
    Route::post('/judul-bedesut', [JudulBedesutController::class, 'store'])->name('admin.judul-bedesut.store');
    Route::put('/judul-bedesut/{id}', [JudulBedesutController::class, 'update'])->name('admin.judul-bedesut.update');
    Route::delete('/judul-bedesut/{id}', [JudulBedesutController::class, 'destroy'])->name('admin.judul-bedesut.destroy');

    Route::get('/sub-judul', [SubJudulBedesutController::class, 'index'])->name('admin.sub-judul.index');
    Route::post('/sub-judul', [SubJudulBedesutController::class, 'store'])->name('admin.sub-judul.store');
    Route::put('/sub-judul/{id}', [SubJudulBedesutController::class, 'update'])->name('admin.sub-judul.update');
    Route::delete('/sub-judul/{id}', [SubJudulBedesutController::class, 'destroy'])->name('admin.sub-judul.destroy');

    // Sub
    Route::post('/admin/informasi-berkala/sub/store', [SubInformasiPublikBerkalaController::class, 'store'])->name('informasi-berkala.sub.store');
    Route::put('/admin/informasi-berkala/sub/{id}', [SubInformasiPublikBerkalaController::class, 'update'])->name('informasi-berkala.sub.update');
    Route::delete('/admin/informasi-berkala/sub/{id}', [SubInformasiPublikBerkalaController::class, 'destroy'])->name('informasi-berkala.sub.destroy');

    Route::get('/admin/informasi-setiap-saat', [InformasiPublikSetiapSaatController::class, 'index'])->name('informasi-setiap-saat.index');

    Route::post('/store', [InformasiPublikSetiapSaatController::class, 'store'])->name('informasi-setiap-saat.store');
    Route::put('/update/{id}', [InformasiPublikSetiapSaatController::class, 'update'])->name('informasi-setiap-saat.update');
    Route::delete('/delete/{id}', [InformasiPublikSetiapSaatController::class, 'destroy'])->name('informasi-setiap-saat.delete');

    // SUB
    Route::post('/sub/store', [InformasiPublikSetiapSaatController::class, 'storeSub'])->name('informasi-setiap-saat-sub.store');
    Route::put('/sub/update/{id}', [InformasiPublikSetiapSaatController::class, 'updateSub'])->name('informasi-setiap-saat-sub.update');
    Route::delete('/sub/delete/{id}', [InformasiPublikSetiapSaatController::class, 'destroySub'])->name('informasi-setiap-saat-sub.delete');

    Route::post('/upload-image', function (Request $request) {

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('summernote', 'public');

            return response()->json([
                'url' => asset('storage/'.$path),
            ]);
        }

        return response()->json(['error' => 'Upload gagal'], 400);
    })->name('upload.image');

    Route::delete('/kontak/delete/{id}', [KontakKamiController::class, 'destroy'])
        ->name('kontak.delete');

    Route::get('/kontak', [KontakKamiController::class, 'index'])
        ->name('kontak.index');

    Route::get('/kontak/preview-pdf/{id}', [KontakKamiController::class, 'previewPdf'])
        ->name('kontak.preview.pdf');

    Route::put(
        '/benturan-kepentingan-user/update/{id}',
        [BenturanKepentinganUserController::class, 'update']
    )->name('benturan-kepentingan.update');

    Route::delete(
        '/benturan-kepentingan-user/delete/{id}',
        [BenturanKepentinganUserController::class, 'destroy']
    )->name('benturan-kepentingan.delete');

    Route::get('/benturan-kepentingan-user', function () {

        $data = BenturanKepentinganUser::latest()->get();

        return view(
            'pages.backend.form-benturan-kepentingan.index',
            compact('data')
        );

    })->name('benturan-kepentingan-user');

    Route::get(
        '/benturan-kepentingan-user/pdf/{id}',
        [BenturanKepentinganUserController::class, 'previewPdf']
    )->name('benturan-kepentingan.pdf');

    Route::get(
        '/layanan-pengaduan-masyarakat-user',
        [LayananPengaduanMasyarakatUserController::class, 'index']
    )->name('layanan-pengaduan-masyarakat-user');

    Route::put(
        '/layanan-pengaduan-masyarakat-user/update/{id}',
        [LayananPengaduanMasyarakatUserController::class, 'update']
    )->name('layanan-pengaduan-masyarakat-user.update');

    Route::delete(
        '/layanan-pengaduan-masyarakat-user/delete/{id}',
        [LayananPengaduanMasyarakatUserController::class, 'destroy']
    )->name('layanan-pengaduan-masyarakat-user.delete');

    Route::get(
    '/layanan-pengaduan-masyarakat/pdf/{id}',
    [LayananPengaduanMasyarakatUserController::class, 'previewPdf']
)->name('layanan-pengaduan-masyarakat.pdf');

});
Route::get('sunmore/{id}/flipbook',
    [SunmoreController::class, 'flipbook']
)->name('sunmore.flipbook');

Route::get('/bedesut/{bedesut}', [BedesutController::class, 'show'])->name('bedesut.show');
Route::get('/dashboard-interaktif/{id}', [BedesutDashboardController::class, 'show'])->name('dashboard-interaktif.show');
Route::get('/infografis/{infografis}', [BedesutInfografisController::class, 'show'])->name('infografis.show');

// Layanan Pengaduan Masyarakat
Route::get('/berita/{slug}', [UserBeritaController::class, 'show'])->name('user-berita.show');

Route::post('/layanan-pengaduan-masyarakat', [LayananPengaduanController::class, 'store'])
    ->name('layanan-pengaduan-masyarakat.store');

Route::post('/kontak/store', [KontakKamiController::class, 'store'])
    ->name('kontak.store');

// Survei Kepuasan Masyarakat (IKM) - form publik
Route::get('/survei-ikm', [SkmSurveyController::class, 'show'])->name('skm-survey.show');
Route::post('/survei-ikm/{skmSurvey}', [SkmSurveyController::class, 'store'])->name('skm-survey.store');

require __DIR__.'/auth.php';

Route::post(
    '/benturan-kepentingan-user/store',
    [BenturanKepentinganUserController::class, 'store']
)->name('benturan-kepentingan-user.store');

Route::post(
    '/layanan-pengaduan-masyarakat-user/store',
    [LayananPengaduanMasyarakatUserController::class, 'store']
)->name('layanan-pengaduan-masyarakat-user.store');
