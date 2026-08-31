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
use App\Http\Controllers\FrontendPageController;
use App\Http\Controllers\KontakKamiController;
use App\Http\Controllers\LayananPengaduanMasyarakatUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserBeritaController;
use Illuminate\Support\Facades\Route;

// =========================================================
// HALAMAN PUBLIK (FRONTEND)
// Semua logic query untuk halaman-halaman ini ada di
// App\Http\Controllers\FrontendPageController, BUKAN di sini lagi.
// =========================================================

Route::get('/', [FrontendPageController::class, 'beranda'])->name('beranda');

Route::get('/layanan/{id}', [StandarPelayananController::class, 'show'])
    ->name('standar-pelayanan.show');

Route::get('/detail', [FrontendPageController::class, 'detail'])->name('detail');

// START PROFIL

Route::get('/sejarah', [FrontendPageController::class, 'sejarah'])->name('sejarah');
Route::get('/visi-dan-misi', [FrontendPageController::class, 'visiDanMisi'])->name('visi-dan-misi');
Route::get('/tugas-pokok-dan-fungsi', [FrontendPageController::class, 'tugasPokokDanFungsi'])->name('tugas-pokok-dan-fungsi');
Route::get('/struktur-organisasi', [FrontendPageController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
Route::get('/wilayah-kerja', [FrontendPageController::class, 'wilayahKerja'])->name('wilayah-kerja');
Route::get('/infografis', [FrontendPageController::class, 'infografis'])->name('infografis');

// END PROFIL

// START SKI

Route::get('/profil-ski', [FrontendPageController::class, 'profilSki'])->name('profil-ski');
Route::get('/panduan-ski', [FrontendPageController::class, 'panduanSki'])->name('panduan-ski');
Route::get('/laporan-ski', [FrontendPageController::class, 'laporanSki'])->name('laporan-ski');
Route::get('/laporan-ski/{id}', [LaporanSKIController::class, 'show'])->name('laporan-ski.show');
Route::get('/sk-dan-sop', [FrontendPageController::class, 'skDanSop'])->name('sk-dan-sop');
Route::get('/sk-dan-sop/{id}', [SKDanSOPController::class, 'show'])->name('sk-dan-sop.show');

// END SKI

// START LAYANAN

Route::get('/pengaduan-layanan-masyarakat', [FrontendPageController::class, 'pengaduanLayananMasyarakat'])->name('pengaduan-layanan-masyarakat');
Route::get('/maklumat-pelayanan', [FrontendPageController::class, 'maklumatPelayanan'])->name('maklumat-pelayanan');
Route::get('/standar-pelayanan', [FrontendPageController::class, 'standarPelayanan'])->name('standar-pelayanan');
Route::get('/standar-pelayanan/{id}', [StandarPelayananController::class, 'show'])->name('standar-pelayanan.show');
Route::get('/sinkarkes', [FrontendPageController::class, 'sinkarkes'])->name('sinkarkes');
Route::get('/formulir-permohonan-layanan', [FrontendPageController::class, 'formulirPermohonanLayanan'])->name('formulir-permohonan-layanan');
Route::get('/posein-aza', [FrontendPageController::class, 'poseinAza'])->name('posein-aza');

// END LAYANAN

// START PENGADUAN

Route::get('/tentang-wbk-wbbm', [FrontendPageController::class, 'tentangWbkWbbm'])->name('tentang-wbk-wbbm');
Route::get('/wbs', [FrontendPageController::class, 'wbs'])->name('wbs');
Route::get('/benturan-kepentingan', [FrontendPageController::class, 'benturanKepentingan'])->name('benturan-kepentingan');
Route::get('/span-lapor', [FrontendPageController::class, 'spanLapor'])->name('span-lapor');
Route::get('/gol-kpk', [FrontendPageController::class, 'golKpk'])->name('gol-kpk');
Route::get('/unit-pengendalian-gratifikasi', [FrontendPageController::class, 'unitPengendalianGratifikasi'])->name('unit-pengendalian-gratifikasi');

// END PENGADUAN

// START INFORMASI PUBLIK

Route::get('/informasi-publik/bedesut', [FrontendPageController::class, 'bedesut'])->name('bedesut');
Route::get('/informasi-publik/bedesut/{tipe}', [FrontendPageController::class, 'bedesutTipe'])->name('bedesut.tipe');
Route::get('/informasi-publik/berita', [FrontendPageController::class, 'berita'])->name('berita');
Route::get('/informasi-publik/bedesut/detail/{id}', [FrontendPageController::class, 'bedesutDetail'])->name('bedesut.detail');
Route::get('/informasi-publik/berita/kategori/{id}', [UserBeritaController::class, 'filterByCategory'])->name('berita.kategori');
Route::get('/informasi-publik/artikel', [FrontendPageController::class, 'artikel'])->name('artikel');
Route::get('/artikel/{slug}', [FrontendPageController::class, 'artikelDetail'])->name('artikel-detail.show');
Route::get('/informasi-publik/pengumuman', [FrontendPageController::class, 'pengumuman'])->name('pengumuman');
Route::get('/informasi-publik/sop', [FrontendPageController::class, 'sop'])->name('sop');
Route::get('/informasi-publik/e-library', [FrontendPageController::class, 'elibrary'])->name('elibrary');
Route::get('/informasi-publik/akuntabilitas', [FrontendPageController::class, 'akuntabilitas'])->name('akuntabilitas');
Route::get('/informasi-publik/survey-kepuasan-masyarakat', [FrontendPageController::class, 'surveyKepuasanMasyarakat'])->name('survey-kepuasan-masyarakat');
Route::get('informasi-publik/survey-kepuasan-masyarakat/{id}', [SurveyController::class, 'show'])->name('survey-admin.show');
Route::get('/informasi-publik/ppid', [FrontendPageController::class, 'ppid'])->name('ppid');

// END INFORMASI PUBLIK

// START PPID

Route::get('/informasi-publik/ppid/profil', [FrontendPageController::class, 'ppidProfil'])->name('ppid.profil');
Route::get('/informasi-publik/ppid/profil-singkat', [FrontendPageController::class, 'ppidProfilSingkat'])->name('ppid.profil-singkat');
Route::get('/informasi-publik/ppid/tugas-fungsi', [FrontendPageController::class, 'ppidTugasFungsi'])->name('ppid.tugas-fungsi');
Route::get('/informasi-publik/ppid/struktur-organisasi', [FrontendPageController::class, 'ppidStrukturOrganisasi'])->name('ppid.struktur-organisasi');
Route::get('/informasi-publik/ppid/visi-misi', [FrontendPageController::class, 'ppidVisiMisi'])->name('ppid.visi-misi');
Route::get('/informasi-publik/ppid/regulasi', [FrontendPageController::class, 'ppidRegulasi'])->name('ppid.regulasi');
Route::get('/informasi-publik/ppid/regulasi/kip', [FrontendPageController::class, 'ppidRegulasiKip'])->name('ppid.regulasi.kip');
Route::get('/informasi-publik/ppid/regulasi/kemenkes', [FrontendPageController::class, 'ppidRegulasiKemenkes'])->name('ppid.regulasi.kemenkes');
Route::get('/informasi-publik/ppid/regulasi/ski', [FrontendPageController::class, 'ppidRegulasiSop'])->name('ppid.regulasi.sop');
Route::get('/informasi-publik/ppid/standar-layanan', [FrontendPageController::class, 'ppidStandarLayanan'])->name('ppid.standar-layanan');
Route::get('/informasi-publik/ppid/informasi-publik', [FrontendPageController::class, 'ppidInformasiPublik'])->name('ppid.informasi-publik');
Route::get('/informasi-publik/ppid/laporan', [FrontendPageController::class, 'ppidLaporan'])->name('ppid.laporan');
Route::get('/informasi-publik/ppid/standar-layanan/prosedur-permintaan-informasi', [FrontendPageController::class, 'ppidProsedurPermintaanInformasi'])->name('ppid.standar-layanan.prosedur-permintaan-informasi');
Route::get('informasi-publik/ppid/standar-layanan/{id}', [FrontendPageController::class, 'ppidStandarLayananDetail'])->name('ppid.standar-layanan.show');
Route::get('/informasi-publik/ppid/standar-layanan/prosedur-pengajuan-keberatan', [FrontendPageController::class, 'ppidProsedurPengajuanKeberatan'])->name('ppid.standar-layanan.prosedur-pengajuan-keberatan');
Route::get('/informasi-publik/ppid/standar-layanan/prosedur-pemohonan-penyelesaian-sengketa-informasi-publik', [FrontendPageController::class, 'ppidProsedurSengketaInformasi'])->name('ppid.standar-layanan.prosedur-pemohonan-penyelesaian-sengketa-informasi-publik');
Route::get('/informasi-publik/ppid/standar-layanan/prosedur-waktu-layanan-informasi', [FrontendPageController::class, 'ppidWaktuLayananInformasi'])->name('ppid.standar-layanan.prosedur-waktu-layanan-informasi');
Route::get('/informasi-publik/ppid/standar-layanan/standar-biaya-perolehan-informasi', [FrontendPageController::class, 'ppidStandarBiayaInformasi'])->name('ppid.standar-layanan.standar-biaya-perolehan-informasi');
Route::get('/informasi-publik/ppid/informasi-publik/informasi-publik-berkala', [FrontendPageController::class, 'ppidInformasiPublikBerkala'])->name('ppid.informasi-publik.ipb');
Route::get('/informasi-publik/ppid/informasi-publik/informasi-publik-tersedia-setiap-saat', [FrontendPageController::class, 'ppidInformasiPublikSetiapSaat'])->name('ppid.informasi-publik.iptss');
Route::get('/informasi-publik/ppid/informasi-publik/informasi-publik-serta-merta', [FrontendPageController::class, 'ppidInformasiPublikSertaMerta'])->name('ppid.informasi-publik.ipsm');
Route::get('/informasi-publik/ppid/laporan/laporan-tahunan-layanan-ppid', [FrontendPageController::class, 'ppidLaporanTahunan'])->name('ppid.laporan.ltlp');
Route::get('/informasi-publik/ppid/laporan/ringkasan-akses-informasi-publik', [FrontendPageController::class, 'ppidRingkasanAksesInformasi'])->name('ppid.laporan.raip');

// END PPID

Route::get('/kontak-kami', [FrontendPageController::class, 'kontakKami'])->name('kontak-kami');

// =========================================================
// HALAMAN ADMIN (butuh login)
// =========================================================

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

    // Upload gambar generik dari editor Summernote (dipakai beberapa form admin).
    // Sebelumnya ini closure duplikat dari SummernoteController@upload -- sekarang
    // dipanggil langsung ke controller yang sama supaya tidak ada logic ganda.
    Route::post('/upload-image', [SummernoteController::class, 'upload'])->name('upload.image');

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

    Route::get('/benturan-kepentingan-user', [BenturanKepentinganUserController::class, 'index'])
        ->name('benturan-kepentingan-user');

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

require __DIR__.'/auth.php';

Route::post(
    '/benturan-kepentingan-user/store',
    [BenturanKepentinganUserController::class, 'store']
)->name('benturan-kepentingan-user.store');

Route::post(
    '/layanan-pengaduan-masyarakat-user/store',
    [LayananPengaduanMasyarakatUserController::class, 'store']
)->name('layanan-pengaduan-masyarakat-user.store');
