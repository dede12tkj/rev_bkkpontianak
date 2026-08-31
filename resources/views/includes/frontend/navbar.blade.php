<style>
    /* Default (Desktop) */
.navbar-logo {
    height: 50px !important;
    width: auto;
    margin-right: 10px;
}

.navbar-title {
    font-size: 22px;
}

/* Mobile */
@media (max-width: 768px) {

    .navbar-logo {
        height: 30px !important;
    }

    .navbar-title {
        font-size: 15px;
    }

}
</style>
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center p-0">
            <img src="{{ asset('frontend/img/logokarantina.png') }}" alt="Logo BKK" class="navbar-logo">
            <h3 class="m-0 navbar-title">BKK Kelas I Pontianak</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('beranda') }}"
                    class="nav-item nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profil</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('sejarah') }}"
                            class="dropdown-item {{ request()->routeIs('sejarah') ? 'active' : '' }}">Sejarah dan Latar
                            Belakang</a>
                        <a href="{{ route('visi-dan-misi') }}"
                            class="dropdown-item {{ request()->routeIs('visi-dan-misi') ? 'active' : '' }}">Visi dan
                            Misi</a>
                        <a href="{{ route('tugas-pokok-dan-fungsi') }}"
                            class="dropdown-item {{ request()->routeIs('tugas-pokok-dan-fungsi') ? 'active' : '' }}">Tugas
                            Pokok dan Fungsi</a>
                        <a href="{{ route('struktur-organisasi') }}"
                            class="dropdown-item {{ request()->routeIs('struktur-organisasi') ? 'active' : '' }} ">Struktur
                            Organisasi</a>
                        <a href="{{ route('infografis') }}"
                            class="dropdown-item {{ request()->routeIs('infografis') ? 'active' : '' }}">Infografis
                            SDM</a>
                        <a href="{{ route('wilayah-kerja') }}"
                            class="dropdown-item {{ request()->routeIs('wilayah-kerja') ? 'active' : '' }}">Wilayah
                            Kerja</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">SKI</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('profil-ski') }}"
                            class="dropdown-item {{ request()->routeIs('profil-ski') ? 'active' : '' }}">Profil
                            SKI</a>
                        <a href="{{ route('panduan-ski') }}"
                            class="dropdown-item {{ request()->routeIs('panduan-ski') ? 'active' : '' }}">Panduan
                            SKI</a>
                        <a href="{{ route('laporan-ski') }}"
                            class="dropdown-item {{ request()->routeIs('laporan-ski') ? 'active' : '' }}">Laporan
                            SKI</a>
                        <a href="{{ route('sk-dan-sop') }}"
                            class="dropdown-item {{ request()->routeIs('sk-dan-sop') ? 'active' : '' }}">SK & SOP</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Layanan</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('maklumat-pelayanan') }}"
                            class="dropdown-item {{ request()->routeIs('maklumat-pelayanan') ? 'active' : '' }}">Maklumat
                            Pelayanan</a>
                        <a href="{{ route('standar-pelayanan') }}"
                            class="dropdown-item {{ request()->routeIs('standar-pelayanan') ? 'active' : '' }}">Standar
                            Pelayanan</a>
                        <a href="{{ route('sinkarkes') }}"
                            class="dropdown-item {{ request()->routeIs('sinkarkes') ? 'active' : '' }}">Sinkarkes</a>
                        <a href="{{ route('formulir-permohonan-layanan') }}"
                            class="dropdown-item {{ request()->routeIs('formulir-permohonan-layanan') ? 'active' : '' }}"
                            class="dropdown-item">Formulir Permohonan Layanan</a>
                        <a href="{{ route('posein-aza') }}"
                            class="dropdown-item {{ request()->routeIs('posein-aza') ? 'active' : '' }}"
                            class="dropdown-item">POSEin Aza</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pengaduan</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('tentang-wbk-wbbm') }}"
                            class="dropdown-item {{ request()->routeIs('tentang-wbk-wbbm') ? 'active' : '' }}"
                            class="dropdown-item">Tentang WBK & WBBM</a>
                        <a href="{{ route('wbs') }}"
                            class="dropdown-item {{ request()->routeIs('wbs') ? 'active' : '' }}"
                            class="dropdown-item">Whistleblowing</a>
                        <a href="{{ route('benturan-kepentingan') }}"
                            class="dropdown-item {{ request()->routeIs('benturan-kepentingan') ? 'active' : '' }}"
                            class="dropdown-item">Benturan Kepentingan</a>
                        <a href="{{ route('pengaduan-layanan-masyarakat') }}"
                            class="dropdown-item {{ request()->routeIs('pengaduan-layanan-masyarakat') ? 'active' : '' }}">Pengaduan
                            Layanan Masyarakat</a>
                        <a href="{{ route('span-lapor') }}"
                            class="dropdown-item {{ request()->routeIs('span-lapor') ? 'active' : '' }}">LAPOR SP4N</a>
                        <a href="{{ route('gol-kpk') }}"
                            class="dropdown-item {{ request()->routeIs('gol-kpk') ? 'active' : '' }}">Gol KPK</a>
                        <a href="{{ route('unit-pengendalian-gratifikasi') }}"
                            class="dropdown-item {{ request()->routeIs('unit-pengendalian-gratifikasi') ? 'active' : '' }}">Unit
                            Pengendalian Gratifikasi UPG</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Informasi Publik</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('bedesut') }}"
                            class="dropdown-item {{ request()->routeIs('bedesut') ? 'active' : '' }}">BEDESUT</a>
                        <a href="{{ route('berita') }}"
                            class="dropdown-item {{ request()->routeIs('berita') ? 'active' : '' }}">Berita</a>
                        <a href="{{ route('ppid') }}"
                            class="dropdown-item {{ request()->routeIs('ppid') ? 'active' : '' }}">PPID</a>
                        <a href="{{ route('artikel') }}"
                            class="dropdown-item {{ request()->routeIs('artikel') ? 'active' : '' }}">Artikel</a>
                        <a href="{{ route('pengumuman') }}"
                            class="dropdown-item {{ request()->routeIs('pengumuman') ? 'active' : '' }}">Pengumuman</a>
                        <a href="{{ route('survey-kepuasan-masyarakat') }}"
                            class="dropdown-item {{ request()->routeIs('survey-kepuasan-masyarakat') ? 'active' : '' }}">Survey
                            Kepuasan Masyarakat</a>
                        <a href="{{ route('sop') }}"
                            class="dropdown-item {{ request()->routeIs('sop') ? 'active' : '' }}">SOP</a>
                        <a href="{{ route('elibrary') }}"
                            class="dropdown-item {{ request()->routeIs('elibrary') ? 'active' : '' }}">E LIBRARY</a>
                        <a href="{{ route('akuntabilitas') }}"
                            class="dropdown-item {{ request()->routeIs('akuntabilitas') ? 'active' : '' }}">Akuntabilitas</a>
                    </div>
                </div>

                <a href="{{ route('kontak-kami') }}"
                    class="nav-item nav-link {{ request()->routeIs('kontak-kami') ? 'active' : '' }}">Kontak Kami</a>

                
            </div>
            <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal"
                data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton>
        </div>
    </nav>

    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">

            @foreach ($carousel as $key => $item)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img class="w-100" src="{{ asset('storage/' . $item->path) }}" alt="Image">

                    @if ($item->text)
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h1 class="display-1 text-white mb-md-4 animated zoomIn">
                                    {{ $item->text }}
                                </h1>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

</div>
