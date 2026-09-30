<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300..800&display=swap" rel="stylesheet">

<style>
    /* ===== Navbar (kode asli, tidak diubah) ===== */
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

    /* ===== Hero banner di dalam carousel ===== */
    #header-carousel {
        --bkk-teal-accent: #008080;
        --bkk-gold-accent: #dfb259;
        --bkk-glass-border: rgba(255, 255, 255, 0.15);
        font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
    }

    .hero-banner-container {
        position: relative;
        width: 100%;
        min-height: 85vh;
        max-height: 920px;
        overflow: hidden;
        background-color: #061113;
        display: flex;
        align-items: center;
        isolation: isolate;
    }

    .hero-image-wrapper {
        position: absolute;
        inset: 0;
        z-index: 1;
        overflow: hidden;
    }

    .hero-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center right;
        filter: contrast(1.05) brightness(0.95) saturate(1.05);
        transform: scale(1.02);
        transition: transform 12s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .hero-banner-container:hover .hero-image-wrapper img {
        transform: scale(1.06);
    }

    /* ===== Mode "ada teks": overlay tebal supaya judul tetap terbaca ===== */
    .hero-banner-container.has-text .depth-mask-left {
        position: absolute;
        top: 0;
        left: 0;
        width: 70%;
        height: 100%;
        z-index: 2;
        background: linear-gradient(90deg, #061113 0%, rgba(6,17,19,.96) 35%, rgba(6,17,19,.8) 60%, rgba(6,17,19,.3) 82%, rgba(6,17,19,0) 100%);
        pointer-events: none;
    }

    .hero-banner-container.has-text .depth-mask-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 45%;
        z-index: 2;
        background: linear-gradient(0deg, #061113 0%, rgba(6,17,19,.85) 30%, rgba(6,17,19,0) 100%);
        pointer-events: none;
    }

    .hero-banner-container.has-text .depth-mask-top {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 25%;
        z-index: 2;
        background: linear-gradient(180deg, rgba(6,17,19,.6) 0%, rgba(6,17,19,0) 100%);
        pointer-events: none;
    }

    .hero-banner-container.has-text .depth-vignette-ambient {
        position: absolute;
        inset: 0;
        z-index: 2;
        background: radial-gradient(circle at 20% 50%, rgba(0,128,128,.22) 0%, rgba(0,80,82,.08) 45%, transparent 75%);
        pointer-events: none;
        mix-blend-mode: screen;
    }

    .hero-banner-container.has-text .ambient-glow-orb {
        position: absolute;
        left: -100px;
        top: 20%;
        width: 550px;
        height: 550px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(0,168,168,.28) 0%, rgba(0,60,65,0) 70%);
        z-index: 2;
        filter: blur(60px);
        pointer-events: none;
        animation: pulseGlow 8s infinite alternate cubic-bezier(0.4, 0, 0.6, 1);
    }

    @keyframes pulseGlow {
        0%   { opacity: .6; transform: scale(.95) translateY(0); }
        100% { opacity: 1;  transform: scale(1.1) translateY(-20px); }
    }

    /* ===== Mode "gambar saja": gambar tetap jelas, cuma frame gradient tipis di tepi ===== */
    .hero-banner-container.image-only .depth-frame {
        position: absolute;
        inset: 0;
        z-index: 2;
        pointer-events: none;
        box-shadow: inset 0 -70px 90px -60px rgba(6,17,19,.45),
                    inset 0 70px 90px -60px rgba(6,17,19,.25);
    }

    /* Matikan overlay gelap bawaan template */
    #header-carousel::before,
    #header-carousel::after,
    #header-carousel .carousel-inner::before,
    #header-carousel .carousel-inner::after,
    #header-carousel .carousel-item::before,
    #header-carousel .carousel-item::after {
        content: none !important;
        display: none !important;
    }

    .hero-banner-container > .container {
        position: relative;
        z-index: 20;
    }

    .hero-content-wrapper {
        position: relative;
        z-index: 20;
        padding: 8rem 0 2rem;
    }

    .hero-heading {
        font-weight: 400;
        font-size: clamp(2.2rem, 4.5vw, 3.8rem);
        line-height: 1.15;
        letter-spacing: -0.03em;
        color: #fff !important;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 20;
        opacity: 1 !important;
        text-shadow: 0 2px 4px rgba(0,0,0,.55), 0 6px 28px rgba(0,0,0,.75);
    }

    .hero-subtitle {
        font-size: clamp(1rem, 1.3vw, 1.25rem);
        line-height: 1.65;
        color: rgba(230,245,245,.88);
        max-width: 620px;
        margin-bottom: 0;
        text-shadow: 0 2px 10px rgba(0,0,0,.5);
        border-left: 2px solid rgba(0,168,168,.5);
        padding-left: 1.25rem;
    }

    .hero-accent-divider {
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, var(--bkk-teal-accent), transparent);
        margin-top: 2rem;
        border-radius: 2px;
    }

    /* ===== Custom Speed Ramp Fade Keyframes & Classes ===== */
    @keyframes speedRampFadeIn {
        0% {
            opacity: 0;
            transform: translateY(28px) scale(0.96);
            filter: blur(12px);
        }
        30% {
            opacity: 0.7;
            transform: translateY(8px) scale(0.99);
            filter: blur(3px);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
            filter: blur(0);
        }
    }

    .speed-ramp-fade {
        animation: speedRampFadeIn 1.1s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
        will-change: transform, opacity, filter;
    }

    .delay-1 { animation-delay: 0.1s !important; }
    .delay-2 { animation-delay: 0.35s !important; }
    .delay-3 { animation-delay: 0.55s !important; }

    /* Kontrol carousel */
    #header-carousel .carousel-control-prev,
    #header-carousel .carousel-control-next,
    #header-carousel .carousel-indicators {
        z-index: 10;
    }

    @media (max-width: 991.98px) {
        .hero-banner-container.has-text .depth-mask-left {
            width: 100%;
            background: linear-gradient(180deg, rgba(6,17,19,.92) 0%, rgba(6,17,19,.85) 60%, rgba(6,17,19,.4) 100%);
        }
        .hero-banner-container {
            min-height: 75vh;
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
        .hero-subtitle {
            border-left: none;
            padding-left: 0;
        }
    }

    @media (max-width: 575.98px) {
        .hero-heading { font-size: 1.5rem; }
        .hero-banner-container { min-height: 70vh; }
    }
    @media (max-width: 991.98px) {
    .hero-banner-container.image-only {
        min-height: 0;
        max-height: none;
        aspect-ratio: 16 / 9;
        padding-top: 0;
        padding-bottom: 0;
    }

    .hero-banner-container.image-only .hero-image-wrapper img {
        object-fit: contain;
        object-position: center;
        transform: none;
    }

    .hero-banner-container.has-text .hero-image-wrapper img {
        object-position: center;
    }
}
</style>



<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center p-0">
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
                            class="dropdown-item {{ request()->routeIs('struktur-organisasi') ? 'active' : '' }}">Struktur
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
                            class="dropdown-item {{ request()->routeIs('formulir-permohonan-layanan') ? 'active' : '' }}">Formulir Permohonan Layanan</a>
                        <a href="{{ route('posein-aza') }}"
                            class="dropdown-item {{ request()->routeIs('posein-aza') ? 'active' : '' }}">POSEin Aza</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pengaduan</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('tentang-wbk-wbbm') }}"
                            class="dropdown-item {{ request()->routeIs('tentang-wbk-wbbm') ? 'active' : '' }}">Tentang WBK & WBBM</a>
                        <a href="{{ route('wbs') }}"
                            class="dropdown-item {{ request()->routeIs('wbs') ? 'active' : '' }}">Whistleblowing</a>
                        <a href="{{ route('benturan-kepentingan') }}"
                            class="dropdown-item {{ request()->routeIs('benturan-kepentingan') ? 'active' : '' }}">Benturan Kepentingan</a>
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
            <button type="button" class="btn text-primary ms-3" data-bs-toggle="modal"
                data-bs-target="#searchModal"><i class="fa fa-search"></i></button>
        </div>
    </nav>

    <!-- Hero banner di dalam carousel -->
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

        @if ($carousel->count() > 1)
            <div class="carousel-indicators">
                @foreach ($carousel as $key => $item)
                    <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="{{ $key }}"
                        class="{{ $key == 0 ? 'active' : '' }}" aria-label="Slide {{ $key + 1 }}"></button>
                @endforeach
            </div>
        @endif

        <div class="carousel-inner">
            @foreach ($carousel as $key => $item)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <section class="hero-banner-container {{ $item->should_show_text ? 'has-text' : 'image-only' }}">

                        <!-- Layer gambar -->
                        <div class="hero-image-wrapper">
                            @if ($key == 0)
                                <img src="{{ asset('storage/' . $item->path) }}"
                                    alt="{{ $item->text ?: 'Balai Kekarantinaan Kesehatan Kelas I Pontianak' }}"
                                    decoding="async" fetchpriority="high">
                            @else
                                {{-- PENTING: pakai data-src, BUKAN src. Bootstrap carousel-fade menumpuk semua
                                     slide di posisi yang sama (cuma beda opacity, bukan display:none), jadi
                                     atribut loading="lazy" tidak mempan — browser tetap menganggap semua slide
                                     "kelihatan" dan men-download semuanya sekaligus. src baru diisi oleh JS
                                     tepat sebelum slide ini ditampilkan (lihat script di bawah). --}}
                                <img data-src="{{ asset('storage/' . $item->path) }}"
                                    alt="{{ $item->text ?: 'Balai Kekarantinaan Kesehatan Kelas I Pontianak' }}"
                                    decoding="async" loading="lazy">
                            @endif
                        </div>

                        @if ($item->should_show_text)
                            {{-- Overlay tebal: gambar digelapkan di sisi kiri/atas/bawah supaya teks tetap terbaca --}}
                            <div class="depth-mask-left"></div>
                            <div class="depth-mask-bottom"></div>
                            <div class="depth-mask-top"></div>
                            <div class="depth-vignette-ambient"></div>
                            <div class="ambient-glow-orb"></div>
                        @else
                            {{-- Gambar saja: tanpa overlay gelap, hanya frame gradient tipis di tepi --}}
                            <div class="depth-frame"></div>
                        @endif

                        @if ($item->should_show_text)
                        <!-- Konten -->
                        <div class="container px-4 px-lg-5">
                            <div class="row align-items-center">
                                <div class="col-lg-8 col-xl-7">
                                    <div class="hero-content-wrapper">

                                        <h1 class="hero-heading speed-ramp-fade delay-1" style="font-size: 55px; line-height: 1.3; max-width: 600px;">
                                            {{ $item->text }}
                                        </h1>

                                        <p class="hero-subtitle speed-ramp-fade delay-2">
                                            {{ $item->subtitle_or_default }}
                                        </p>

                                        <div class="hero-accent-divider speed-ramp-fade delay-3"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </section>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev d-none d-md-flex" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next d-none d-md-flex" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

<!-- Script Triggers Re-animation + lazy-load gambar tiap perpindahan slide -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var heroCarousel = document.getElementById('header-carousel');
        if (!heroCarousel) return;

        var items = heroCarousel.querySelectorAll('.carousel-item');

        // Isi src gambar dari data-src (dipanggil saat slide mau/lagi tampil).
        function loadSlideImage(item) {
            if (!item) return;
            var img = item.querySelector('img[data-src]');
            if (img) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            }
        }

        // Preload slide BERIKUTNYA di background, sedikit setelah slide sekarang tampil —
        // supaya gambarnya sudah siap sebelum gilirannya, bukan baru mulai download pas
        // transisi jalan (yang bisa kelihatan kosong sesaat kalau koneksi lambat).
        heroCarousel.addEventListener('slid.bs.carousel', function (e) {
            var nextIndex = (e.to + 1) % items.length;
            setTimeout(function () { loadSlideImage(items[nextIndex]); }, 800);
        });

        // Jaring pengaman: kalau slide yang mau tampil ternyata belum sempat di-preload
        // (mis. user klik panah "berikutnya" berkali-kali dengan cepat), muat saat itu juga.
        heroCarousel.addEventListener('slide.bs.carousel', function (e) {
            loadSlideImage(e.relatedTarget);

            var nextElements = e.relatedTarget.querySelectorAll('.speed-ramp-fade');
            nextElements.forEach(function (el) {
                el.style.animation = 'none';
                el.offsetHeight; /* Trigger reflow */
                el.style.animation = '';
            });
        });

        // Preload slide ke-2 lebih awal (di background, bukan blocking) supaya siap
        // sebelum giliran pertamanya tampil di kunjungan pertama.
        if (items[1]) {
            setTimeout(function () { loadSlideImage(items[1]); }, 1500);
        }
    });
</script>