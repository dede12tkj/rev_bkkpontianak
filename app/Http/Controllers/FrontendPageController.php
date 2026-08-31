<?php

namespace App\Http\Controllers;

use App\Models\Akuntabilitas;
use App\Models\Artikel;
use App\Models\BenturanKepentingan;
use App\Models\Berita;
use App\Models\Buletin;
use App\Models\Carousel;
use App\Models\DashboardInteraktif;
use App\Models\ELibrary;
use App\Models\FaqWbk;
use App\Models\Footer;
use App\Models\FormSurveyKepuasanMasyarakat;
use App\Models\GambarMaklumatPelayanan;
use App\Models\Infografis;
use App\Models\InformasiPublikBerkala;
use App\Models\InformasiPublikSetiapSaat;
use App\Models\KategoriBerita;
use App\Models\LaporanPPID;
use App\Models\LaporanSKI;
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
use App\Models\Wilker;
use App\Models\WilkerText;
use App\Models\VisiMisi;

/**
 * Kumpulan halaman statis / publik di frontend.
 *
 * Sebelumnya semua method di bawah ini adalah closure yang ditulis
 * langsung di routes/web.php. Dipindahkan ke sini supaya:
 * - routes/web.php jadi ringkas & gampang dibaca
 * - php artisan route:cache bisa dipakai (closure bikin route:cache gagal)
 * - logic query gampang di-test / di-reuse
 */
class FrontendPageController extends Controller
{
    public function beranda()
    {
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
        $ikm = Survey::skm()->latest()->take(3)->get();
        $layanan = StandarPelayanan::orderBy('id')->get();

        return view('pages.frontend.welcome', compact(
            'berita', 'gambar', 'carousel', 'tentang_kami', 'fskm', 'footer', 'sosmed', 'ikm', 'layanan'
        ));
    }

    public function detail()
    {
        return view('pages.frontend.detail');
    }

    // ===== PROFIL =====

    public function sejarah()
    {
        $sejarah = SejarahDanLatarBelakang::first();

        return view('pages.frontend.profil.sejarah', compact('sejarah'));
    }

    public function visiDanMisi()
    {
        $visi = VisiMisi::first();

        return view('pages.frontend.profil.visi-dan-misi', compact('visi'));
    }

    public function tugasPokokDanFungsi()
    {
        $tugas = TugasDanFungsi::first();

        return view('pages.frontend.profil.tugas-pokok-dan-fungsi', compact('tugas'));
    }

    public function strukturOrganisasi()
    {
        $item = StrukturOrganisasi::first();

        return view('pages.frontend.profil.struktur-organisasi', compact('item'));
    }

    public function wilayahKerja()
    {
        $wilkers = Wilker::orderBy('id')->get();
        $wilkerText = WilkerText::first();

        return view('pages.frontend.profil.wilayah-kerja', compact('wilkers', 'wilkerText'));
    }

    public function infografis()
    {
        return view('pages.frontend.profil.infografis');
    }

    // ===== SKI =====

    public function profilSki()
    {
        return view('pages.frontend.SKI.profil-ski');
    }

    public function panduanSki()
    {
        $data = PanduanSKI::orderBy('id', 'asc')->get();

        return view('pages.frontend.SKI.panduan-ski', compact('data'));
    }

    public function laporanSki()
    {
        $data = LaporanSKI::orderBy('tahun', 'desc')
            ->orderBy('semester', 'asc')
            ->get()
            ->groupBy('tahun');

        return view('pages.frontend.SKI.laporan-ski', compact('data'));
    }

    public function skDanSop()
    {
        $dataSOP = SKDanSOP::where('kategori', 'SOP')->get();

        $sk = SKDanSOP::where('kategori', 'SK')->get();

        $dataSK = $sk->groupBy('nama')->map(function ($items) {
            return [
                'nama' => $items->first()->nama,
                'data' => $items->keyBy('tahun'),
            ];
        });

        $tahunAwal = $sk->min('tahun') ?? date('Y');
        $tahunAkhir = date('Y');
        $tahuns = range($tahunAwal, $tahunAkhir);

        return view('pages.frontend.SKI.sk-dan-sop', compact('dataSK', 'dataSOP', 'tahuns'));
    }

    // ===== LAYANAN =====

    public function pengaduanLayananMasyarakat()
    {
        return view('pages.frontend.layanan.pengaduan-layanan-masyarakat');
    }

    public function maklumatPelayanan()
    {
        $gambar = GambarMaklumatPelayanan::first();

        return view('pages.frontend.layanan.maklumat-pelayanan', compact('gambar'));
    }

    public function standarPelayanan()
    {
        $data = StandarPelayanan::all();

        return view('pages.frontend.layanan.standar-pelayanan', compact('data'));
    }

    public function sinkarkes()
    {
        return view('pages.frontend.layanan.sinkarkes');
    }

    public function formulirPermohonanLayanan()
    {
        return view('pages.frontend.layanan.formulir-permohonan-layanan');
    }

    public function poseinAza()
    {
        $poseins = Posein::latest()->get();

        return view('pages.frontend.layanan.poseinaza', compact('poseins'));
    }

    // ===== PENGADUAN =====

    public function tentangWbkWbbm()
    {
        $data = FaqWbk::all();

        return view('pages.frontend.pengaduan.tentang-wbk-wbbm', compact('data'));
    }

    public function wbs()
    {
        return view('pages.frontend.pengaduan.wbs');
    }

    public function benturanKepentingan()
    {
        $data = BenturanKepentingan::all();

        return view('pages.frontend.pengaduan.benturan-kepentingan', compact('data'));
    }

    public function spanLapor()
    {
        return view('pages.frontend.pengaduan.spanlapor');
    }

    public function golKpk()
    {
        return view('pages.frontend.pengaduan.golkpk');
    }

    public function unitPengendalianGratifikasi()
    {
        return view('pages.frontend.pengaduan.unit-pengendalian-gratifikasi');
    }

    // ===== INFORMASI PUBLIK =====

    public function bedesut()
    {
        $data = SubJudulBedesut::with('konten')->get()
            ->groupBy(function ($item) {
                return class_basename($item->konten_type);
            });

        return view('pages.frontend.informasi-publik.bedesut', compact('data'));
    }

    public function bedesutTipe($tipe)
    {
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
    }

    public function bedesutDetail($id)
    {
        $data = SubJudulBedesut::with('konten')->findOrFail($id);

        return view('pages.frontend.informasi-publik.bedesut-detail', compact('data'));
    }

    public function berita()
    {
        $beritas = Berita::with('kategori', 'penulis')
            ->orderBy('tanggal', 'DESC')
            ->paginate(6);

        $kategoriList = KategoriBerita::orderBy('nama_kategori', 'ASC')->get();

        $recentPost = Berita::orderBy('tanggal', 'DESC')->take(10)->get();

        return view('pages.frontend.informasi-publik.berita', compact('beritas', 'kategoriList', 'recentPost'));
    }

    public function artikel()
    {
        $data = Artikel::where('status', 'published')
            ->latest()
            ->get();

        return view('pages.frontend.informasi-publik.artikel', compact('data'));
    }

    public function artikelDetail($slug)
    {
        $artikel = Artikel::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $artikel->increment('views');

        return view('pages.frontend.informasi-publik.detail', compact('artikel'));
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::where('status', 'published')
            ->orderBy('is_penting', 'desc')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.frontend.informasi-publik.pengumuman', compact('pengumuman'));
    }

    public function sop()
    {
        $sop = Sop::orderBy('kategori')
            ->orderBy('judul')
            ->get()
            ->groupBy('kategori');

        return view('pages.frontend.informasi-publik.sop', compact('sop'));
    }

    public function elibrary()
    {
        $data = ELibrary::latest()->get();

        return view('pages.frontend.informasi-publik.elibrary', compact('data'));
    }

    public function akuntabilitas()
    {
        $data = Akuntabilitas::orderBy('tahun', 'desc')
            ->get()
            ->groupBy('tahun');

        return view('pages.frontend.informasi-publik.akuntabilitas', compact('data'));
    }

    public function surveyKepuasanMasyarakat()
    {
        $skm = Survey::where('kategori', 'SKM')
            ->orderBy('tahun', 'desc')
            ->get()
            ->groupBy('tahun');

        $spak = Survey::where('kategori', 'SPAK')
            ->orderBy('tahun', 'desc')
            ->get()
            ->groupBy('tahun');

        return view('pages.frontend.informasi-publik.survey-kepuasan-masyarakat', compact('skm', 'spak'));
    }

    public function ppid()
    {
        $faq = PPIDFaq::latest()->get();
        $form = PPIDForm::latest()->first();

        return view('pages.frontend.informasi-publik.ppid', compact('faq', 'form'));
    }

    // ===== PPID =====

    public function ppidProfil()
    {
        return view('pages.frontend.ppid.profil');
    }

    public function ppidProfilSingkat()
    {
        $profil = PPIDProfil::latest()->first();

        return view('components.ppid.profil-singkat', compact('profil'));
    }

    public function ppidTugasFungsi()
    {
        $profil = PPIDTugasFungsi::latest()->first();

        return view('components.ppid.tugas-fungsi', compact('profil'));
    }

    public function ppidStrukturOrganisasi()
    {
        $struktur = PPIDStrukturOrganisasi::latest()->get();

        return view('components.ppid.struktur-organisasi', compact('struktur'));
    }

    public function ppidVisiMisi()
    {
        $data = PPIDVisiMisi::latest()->first();

        return view('components.ppid.visi-misi', compact('data'));
    }

    public function ppidRegulasi()
    {
        return view('pages.frontend.ppid.regulasi');
    }

    public function ppidRegulasiKip()
    {
        $data = RegulasiKIP::latest()->get();

        return view('components.ppid.regulasi.kip', compact('data'));
    }

    public function ppidRegulasiKemenkes()
    {
        $data = RegulasiKemenkes::latest()->get();

        return view('components.ppid.regulasi.kemenkes', compact('data'));
    }

    public function ppidRegulasiSop()
    {
        $data = RegulasiSopKI::latest()->get();

        return view('components.ppid.regulasi.sop', compact('data'));
    }

    public function ppidStandarLayanan()
    {
        $standarLayanan = PPIDStandarLayanan::all();

        return view('pages.frontend.ppid.standar-layanan', compact('standarLayanan'));
    }

    public function ppidStandarLayananDetail($id)
    {
        $data = PPIDStandarLayanan::findOrFail($id);

        return view('components.ppid.standar-layanan.detail', compact('data'));
    }

    public function ppidInformasiPublik()
    {
        return view('pages.frontend.ppid.informasi-publik');
    }

    public function ppidLaporan()
    {
        return view('pages.frontend.ppid.laporan');
    }

    public function ppidProsedurPermintaanInformasi()
    {
        return view('components.ppid.standar-layanan.prosedur-permintaan-informasi');
    }

    public function ppidProsedurPengajuanKeberatan()
    {
        return view('components.ppid.standar-layanan.prosedur-pengajuan-keberatan');
    }

    public function ppidProsedurSengketaInformasi()
    {
        return view('components.ppid.standar-layanan.prosedur-pemohonan-penyelesaian-sengketa-informasi-publik');
    }

    public function ppidWaktuLayananInformasi()
    {
        return view('components.ppid.standar-layanan.waktu-layanan-informasi');
    }

    public function ppidStandarBiayaInformasi()
    {
        return view('components.ppid.standar-layanan.standar-biaya-perolehan-informasi');
    }

    public function ppidInformasiPublikBerkala()
    {
        $data = InformasiPublikBerkala::with('sub')->get();

        return view('components.ppid.informasi-publik.ipb', compact('data'));
    }

    public function ppidInformasiPublikSetiapSaat()
    {
        $data = InformasiPublikSetiapSaat::with('sub')->get();

        return view('components.ppid.informasi-publik.iptss', compact('data'));
    }

    public function ppidInformasiPublikSertaMerta()
    {
        return view('components.ppid.informasi-publik.ipsm');
    }

    public function ppidLaporanTahunan()
    {
        $data = LaporanPPID::orderBy('tahun', 'desc')
            ->orderBy('semester', 'desc')
            ->get();

        return view('components.ppid.laporan.ltlp', compact('data'));
    }

    public function ppidRingkasanAksesInformasi()
    {
        return view('components.ppid.laporan.raip');
    }

    // ===== LAIN-LAIN =====

    public function kontakKami()
    {
        return view('pages.frontend.kontak-kami');
    }
}
