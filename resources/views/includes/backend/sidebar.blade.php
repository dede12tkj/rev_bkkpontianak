<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative text-center">
            <div class="align-items-center">
                <div class="logo">
                    <a href="index.html"><img src="{{ asset('frontend/img/logokemenkes.png') }}" alt="Logo"
                            srcset="" /></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin-wilker.index') ? 'active' : '' }}">
                    <a href="{{ route('admin-wilker.index') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Wilayah Kerja</span>
                    </a>
                </li>
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-three-dots"></i>
                        <span>Homepage</span>
                    </a>

                    <ul class="submenu">
                        <li class="submenu-item has-sub">
                            <a href="#" class="submenu-link">Beranda</a>

                            <ul class="submenu submenu-level-2">
                                <li class="submenu-item {{ request()->routeIs('carousel.index') ? 'active' : '' }}">
                                    <a href="{{ route('carousel.index') }}" class="submenu-link">Carousel</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('tentang-kami.index') ? 'active' : '' }}">
                                    <a href="{{ route('tentang-kami.index') }}" class="submenu-link">Tentang Kami</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('form-survey-kepuasan-masyarakat.index') ? 'active' : '' }}">
                                    <a href="{{ route('form-survey-kepuasan-masyarakat.index') }}"
                                        class="submenu-link">Form Survey Kepuasan Masyarakat</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('admin-skm-survey.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin-skm-survey.index') }}"
                                        class="submenu-link">Builder Survei IKM</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('admin-skm-survey.responses') ? 'active' : '' }}">
                                    <a href="{{ route('admin-skm-survey.responses') }}"
                                        class="submenu-link">Rekap Hasil Survei IKM</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('sosmed.index') ? 'active' : '' }}">
                                    <a href="{{ route('sosmed.index') }}" class="submenu-link">Sosial Media</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('footer.index') ? 'active' : '' }}">
                                    <a href="{{ route('footer.index') }}" class="submenu-link">Footer</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu-item has-sub">
                            <a href="#" class="submenu-link">Profil</a>

                            <ul class="submenu submenu-level-2">
                                <li class="submenu-item {{ request()->routeIs('sejarah-dan-latar-belakang.index') ? 'active' : '' }}">
                                    <a href="{{ route('sejarah-dan-latar-belakang.index') }}"
                                        class="submenu-link">Sejarah dan Latar
                                        Belakang</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('visi-misi.index') ? 'active' : '' }}">
                                    <a href="{{ route('visi-misi.index') }}" class="submenu-link">Visi dan Misi</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('tugas-fungsi.index') ? 'active' : '' }}">
                                    <a href="{{ route('tugas-fungsi.index') }}" class="submenu-link">Tugas Pokok dan
                                        Fungsi</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('admin-struktur-organisasi.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin-struktur-organisasi.index') }}"
                                        class="submenu-link">Struktur Organisasi</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('admin-infografis.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin-infografis.index') }}" class="submenu-link">Infografis
                                        SDM</a>
                                </li>

                            </ul>
                        </li>
                        <li class="submenu-item has-sub">
                            <a href="#" class="submenu-link">SKI</a>

                            <ul class="submenu submenu-level-2">
                                <li class="submenu-item {{ request()->routeIs('admin-profil-ski.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin-profil-ski.index') }}" class="submenu-link">Profil SKI</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('admin-panduan-ski.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin-panduan-ski.index') }}" class="submenu-link">Panduan
                                        SKI</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('admin-laporan-ski.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin-laporan-ski.index') }}" class="submenu-link">Laporan
                                        SKI</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('admin-sk-dan-sop.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin-sk-dan-sop.index') }}" class="submenu-link">SK & SOP</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu-item has-sub">
                            <a href="#" class="submenu-link">Layanan</a>

                            <ul class="submenu submenu-level-2">
                                <li
                                    class="submenu-item {{ request()->routeIs('gambarmaklumatpelayanan.index') ? 'active' : '' }}">
                                    <a href="{{ route('gambarmaklumatpelayanan.index') }}"
                                        class="submenu-link">Maklumat Pelayanan</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('admin-sk-dan-sop.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin-standar-pelayanan.index') }}" class="submenu-link">Standar
                                        Pelayanan</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('admin-sk-dan-sop.index') ? 'active' : '' }}">
                                    <a href="#" class="submenu-link">Sinkarkes</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('admin-sk-dan-sop.index') ? 'active' : '' }}">
                                    <a href="#" class="submenu-link">Formulir Permohonan Layanan</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('admin-sk-dan-sop.index') ? 'active' : '' }}">
                                    <a href="{{ route('posein.index') }}" class="submenu-link">PoseIn</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu-item has-sub">
                            <a href="#" class="submenu-link">Pengaduan</a>

                            <ul class="submenu submenu-level-2">
                                <li class="submenu-item {{ request()->routeIs('admin-faq-wbk.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin-faq-wbk.index') }}" class="submenu-link">Tentang WBK &
                                        WBBM</a>
                                </li>
                                {{-- <li class="submenu-item {{ request()->routeIs('admin-sk-dan-sop.index') ? 'active' : '' }}">
                                    <a href="#" class="submenu-link">Whistleblowing</a>
                                </li> --}}
                                <li class="submenu-item {{ request()->routeIs('admin-benturan-kepentingan.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin-benturan-kepentingan.index') }}"
                                        class="submenu-link">Benturan Kepentingan</a>
                                </li>
                                {{-- <li class="submenu-item {{ request()->routeIs('admin-sk-dan-sop.index') ? 'active' : '' }}">
                                    <a href="#" class="submenu-link">Pengaduan Layanan Masyarakat</a>
                                </li> --}}
                                <li class="submenu-item {{ request()->routeIs('lapor-span.index') ? 'active' : '' }}">
                                    <a href="{{ route('lapor-span.index') }}" class="submenu-link">Lapor SP4N</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('admin-gol-kpk.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin-gol-kpk.index') }}" class="submenu-link">Gol KPK</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('upg.index') ? 'active' : '' }}">
                                    <a href="{{ route('upg.index') }}" class="submenu-link">Unit Pengendalian
                                        Gratifikasi</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>Informasi Publik</span>
                    </a>

                    <ul class="submenu">

                        <li class="submenu-item {{ request()->routeIs('admin-artikel.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-artikel.index') }}" class="submenu-link">Artikel</a>
                        </li>

                        <li class="submenu-item {{ request()->routeIs('pengumuman.index') ? 'active' : '' }}">
                            <a href="{{ route('pengumuman.index') }}" class="submenu-link">Pengumuman</a>
                        </li>

                        <li class="submenu-item {{ request()->routeIs('survey-admin.index') ? 'active' : '' }}">
                            <a href="{{ route('survey-admin.index') }}" class="submenu-link">Survey Kepuasan
                                Masyarakat</a>
                        </li>

                        <li class="submenu-item {{ request()->routeIs('admin-sop.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-sop.index') }}" class="submenu-link">SOP</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('admin-elibrary.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-elibrary.index') }}" class="submenu-link">E-Library</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('admin-akuntabilitas.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-akuntabilitas.index') }}" class="submenu-link">Akuntabilitas</a>
                        </li>


                    </ul>
                </li>
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>Bedesut</span>
                    </a>

                    <ul class="submenu">

                        <li class="submenu-item {{ request()->routeIs('admin.judul-bedesut.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.judul-bedesut.index') }}" class="submenu-link">Judul Bedesut</a>
                        </li>

                        <li class="submenu-item {{ request()->routeIs('admin.sub-judul.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.sub-judul.index') }}" class="submenu-link">Sub Judul Bedesut</a>
                        </li>


                    </ul>
                </li>

                {{-- PPID --}}
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-collection-fill"></i>
                        <span>PPID</span>
                    </a>

                    <ul class="submenu">
                        <li class="submenu-item {{ request()->routeIs('admin-ppid-form.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-ppid-form.index') }}" class="submenu-link">Formulir</a>
                        </li>

                        <li class="submenu-item {{ request()->routeIs('admin-ppid-faq.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-ppid-faq.index') }}" class="submenu-link">Frequently Asked
                                Question</a>
                        </li>

                        <li class="submenu-item {{ request()->routeIs('admin-ppid-profil.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-ppid-profil.index') }}" class="submenu-link">Profil Singkat</a>
                        </li>

                        <li class="submenu-item {{ request()->routeIs('admin-ppid-tugas-fungsi.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-ppid-tugas-fungsi.index') }}" class="submenu-link">Tugas
                                Fungsi</a>
                        </li>

                        <li class="submenu-item {{ request()->routeIs('admin-ppid-struktur-organisasi.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-ppid-struktur-organisasi.index') }}"
                                class="submenu-link">Struktur Organisasi</a>
                        </li>

                        <li class="submenu-item {{ request()->routeIs('admin-ppid-visi-misi.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-ppid-visi-misi.index') }}" class="submenu-link">Visi Misi</a>
                        </li>

                        <li class="submenu-item {{ request()->routeIs('admin-ppid-standar-layanan.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-ppid-standar-layanan.index') }}" class="submenu-link">Standar
                                Layanan</a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-collection-fill"></i>
                        <span>PPID Regulasi</span>
                    </a>

                    <ul class="submenu">
                        <li class="submenu-item {{ request()->routeIs('admin-ppid-regulasi-kip.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-ppid-regulasi-kip.index') }}" class="submenu-link">Regulasi
                                KIP</a>
                        </li>

                        <li class="submenu-item {{ request()->routeIs('admin-ppid-regulasi-kemenkes.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-ppid-regulasi-kemenkes.index') }}" class="submenu-link">Regulasi
                                Kemenkes</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('admin-ppid-regulasi-sop-ki.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-ppid-regulasi-sop-ki.index') }}" class="submenu-link">SOP
                                Keterbukaan Informasi</a>
                        </li>

                    </ul>
                </li>




                {{-- PPID Informasi Publik --}}
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-collection-fill"></i>
                        <span>PPID Informasi Publik</span>
                    </a>

                    <ul class="submenu">
                        <li class="submenu-item {{ request()->routeIs('admin-ppid-laporan.index') ? 'active' : '' }}">
                            <a href="{{ route('admin-ppid-laporan.index') }}" class="submenu-link">Laporan PPID</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('informasi-berkala.index') ? 'active' : '' }}">
                            <a href="{{ route('informasi-berkala.index') }}" class="submenu-link">Informasi
                                Berkala</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('informasi-setiap-saat.index') ? 'active' : '' }}">
                            <a href="{{ route('informasi-setiap-saat.index') }}" class="submenu-link">Informasi
                                Setiap Saat</a>
                        </li>

                    </ul>
                </li>

                {{-- Berita --}}
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-collection-fill"></i>
                        <span>Berita</span>
                    </a>

                    <ul class="submenu">
                        <li class="submenu-item {{ request()->routeIs('berita.index') ? 'active' : '' }}">
                            <a href="{{ route('berita.index') }}" class="submenu-link">Berita</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('kategori-berita.index') ? 'active' : '' }}">
                            <a href="{{ route('kategori-berita.index') }}" class="submenu-link">Kategori Berita</a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-item {{ request()->routeIs('kontak.index') ? 'active' : '' }}">
                    <a href="{{ route('kontak.index') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Kontak Kami</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('benturan-kepentingan-user') ? 'active' : '' }}">
                    <a href="{{ route('benturan-kepentingan-user') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Data Benturan Kepentingan</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('layanan-pengaduan-masyarakat-user') ? 'active' : '' }}">
                    <a href="{{ route('layanan-pengaduan-masyarakat-user') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Data Pengaduan Masyarakat</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>


            </ul>

        </div>
    </div>
</div>
