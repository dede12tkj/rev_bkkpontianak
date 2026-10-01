@extends('layouts.app')
@section('title')
    BKK Kelas I Pontianak
@endsection
@section('content')
    <style>
        .logo-wrapper {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 15px;
        }

        .logo-card {
            flex: 1;
            border-radius: 25px;
        }

        .logo-side {
            width: 100%;
            max-width: 280px;
            max-height: 220px;
            object-fit: contain;
            transition: 0.3s ease;
        }

        .logo-side:hover {
            transform: scale(1.05);
        }

        .ikm-content {
            font-size: 16px;
            line-height: 1.8;
        }

        /* Mobile */
        @media (max-width: 991px) {

            .logo-wrapper {
                margin-top: 20px;
            }

            .logo-card {
                margin-bottom: 15px;
            }

            .logo-side {
                max-width: 120px;
            }

        }
        /* Custom Speed Ramp Fade Animation */
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
    /* Cubic-bezier 'speed ramp': Mendorong awal dengan cepat lalu smooth deceleration di akhir */
    animation: speedRampFadeIn 1.1s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
    will-change: transform, opacity, filter;
}

/* Staggered Delay untuk Elemen Teks */
.delay-1 { animation-delay: 0.1s !important; }
.delay-2 { animation-delay: 0.35s !important; }
.delay-3 { animation-delay: 0.55s !important; }      
    </style>
    
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">

                {{-- Tentang Kami --}}
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-3">
                        <h5 class="fw-bold text-primary text-uppercase">Tentang Kami</h5>
                        <h1 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h1>
                    </div>

                    {!! $tentang_kami->text !!}
                </div>


                {{-- Berita --}}
                <div class="col-lg-5">
                    <div class="card shadow wow zoomIn" data-wow-delay="0.9s">

                        <div id="beritaCarousel" class="carousel slide berita-carousel" data-bs-ride="carousel"
                            data-bs-interval="5000">
                            <!-- Isi -->
                            <div class="carousel-inner">
                                @foreach ($berita as $key => $item)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <div class="card-body berita-body">

                                            <img loading="lazy" decoding="async" src="{{ asset('storage/' . $item->thumbnail) }}" class="berita-img">

                                            <h6 class="fw-bold">{{ $item->judul }}</h6>

                                            <p class="small text-muted">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                            </p>

                                            <p class="berita-text">
                                                {{ Str::limit(strip_tags($item->konten), 200) }}
                                            </p>

                                            <a href="{{ route('user-berita.show', $item->slug) }}"
                                                class="btn btn-sm btn-primary">
                                                Baca Selengkapnya
                                            </a>

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Tombol -->
                            <button class="berita-prev" type="button" data-bs-target="#beritaCarousel"
                                data-bs-slide="prev">
                                ‹
                            </button>

                            <button class="berita-next" type="button" data-bs-target="#beritaCarousel"
                                data-bs-slide="next">
                                ›
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    <div class="layanan-section wow fadeInUp" data-wow-delay="0.1s">
        <div class="layanan-glow"></div>
        <div class="container position-relative">
            <div class="text-center position-relative mx-auto mb-3" style="max-width: 700px; z-index: 2;">
                <h5 class="fw-bold text-uppercase layanan-kicker">Layanan Kami</h5>
                <h1 class="text-white mb-0">Pelayanan Balai Kekarantinaan Kesehatan Kelas I Pontianak</h1>
            </div>

            <section class="splide layanan-splide position-relative mt-4" style="z-index: 2;"
                aria-label="Layanan Kami">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($layanan as $item)
                            <li class="splide__slide">
                                <div class="layanan-card text-center h-100">
                                    <div class="layanan-icon-wrap">
                                        <i class="{{ $item->icon }}"></i>
                                    </div>
                                    <h5>{{ $item->nama_tampilan ?? $item->nama }}</h5>
                                    <a href="{{ route('standar-pelayanan.show', $item->id) }}"
                                        class="btn btn-layanan-detail btn-sm mt-3">
                                        Detail
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </div>
    <!-- Service End -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Splide('.layanan-splide', {
                type: 'loop',
                perPage: 5,
                focus: 'center',
                gap: '1rem',
                autoplay: true,
                interval: 3500,
                pagination: false,
                arrows: true,
                breakpoints: {
                    992: { perPage: 3 },
                    768: { perPage: 2 },
                    576: { perPage: 1 },
                }
            }).mount();
        });
    </script>


    <!-- IKM Start -->
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                {{-- <h5 class="fw-bold text-primary text-uppercase">Testimonial</h5> --}}
                <h1 class="mb-0">Indeks Kepuasan Masyarakat</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">

                @foreach ($ikm as $item)
                    <a href="{{ route('survey-admin.show', $item->id) }}" class="text-decoration-none text-dark">

                        <div class="testimonial-item bg-light my-4 text-center p-4 h-100">

                            <!-- Gambar -->
                            <div class="ikm-img mb-3">
                                <img loading="lazy" decoding="async" src="{{ $item->gambar_url }}" class="img-fluid rounded">
                            </div>

                            <!-- Judul -->
                            <h5 class="text-primary mb-2">
                                {{ $item->judul }}
                            </h5>

                            <!-- Tahun -->
                            <small class="text-muted d-block mb-3">
                                Tahun {{ $item->tahun }}
                            </small>

                            <!-- Deskripsi -->
                            <p class="mb-0">
                                {!! \Illuminate\Support\Str::limit(strip_tags($item->isi), 100) !!}
                            </p>

                        </div>

                    </a>
                @endforeach

            </div>
            <div class="container my-5">

                <div class="container my-5">

                    <div class="row justify-content-center align-items-stretch">

                        <!-- Form Survey -->
                        <div class="col-lg-8 mb-4 mb-lg-0">

                            <div class="card rounded-5 shadow-lg overflow-hidden border-0 h-100">

                                <div class="card-header bg-primary text-white border-0 py-4">
                                    <h5 class="mb-0 fw-semibold text-white text-center">
                                        Form Survey Kepuasan Masyarakat
                                    </h5>
                                </div>

                                <div class="card-body ikm-content p-4">
                                    {!! $fskm->text !!}
                                </div>

                                <div class="card-footer bg-white border-0 text-center pb-4">
                                    <a href="{{ route('skm-survey.show') }}"
                                        class="btn btn-primary btn-lg px-5 rounded-pill">
                                        Isi Survey IKM
                                    </a>
                                </div>

                            </div>

                        </div>

                        <!-- Logo Section -->
                        <div class="col-lg-3">

                            <div class="logo-wrapper h-100">

                                <!-- Logo 1 -->
                                <a href="https://wbs.kemkes.go.id/" target="_blank" class="text-decoration-none">

                                    <div class="card logo-card shadow-sm border-0">
                                        <div class="card-body p-3 d-flex justify-content-center align-items-center">
                                            <img loading="lazy" decoding="async" src="{{ asset('frontend/img/logowbs.png') }}" class="logo-side"
                                                alt="Logo 1">
                                        </div>
                                    </div>

                                </a>

                                <!-- Logo 2 -->
                                <a href="https://gol.kpk.go.id/login/" target="_blank" class="text-decoration-none">

                                    <div class="card logo-card shadow-sm border-0">
                                        <div class="card-body p-3 d-flex justify-content-center align-items-center">
                                            <img loading="lazy" decoding="async" src="{{ asset('frontend/img/logogolkpk.png') }}" class="logo-side"
                                                alt="Logo 2">
                                        </div>
                                    </div>

                                </a>

                                <!-- Logo 3 -->
                                <a href="https://www.lapor.go.id/tentang" target="_blank" class="text-decoration-none">

                                    <div class="card logo-card shadow-sm border-0">
                                        <div class="card-body p-3 d-flex justify-content-center align-items-center">
                                            <img loading="lazy" decoding="async" src="{{ asset('frontend/img/lapor.jpg') }}" class="logo-side"
                                                alt="Logo 3">
                                        </div>
                                    </div>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


    </div>

    </div>
    <!-- IKM End -->


    <!-- Statistik / Wilayah Kerja Start -->
    
    <!-- Live Statistics Section Start -->

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="background: #f4f8f8;">
    <div class="container">
        <!-- Header & Title -->
        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 700px;">
            <h5 class="fw-bold text-primary text-uppercase">
                <i class="fa fa-chart-line me-2"></i>Statistik & Capaian Realtime
            </h5>
            <h1 class="mb-0">Data Operasional BKK Kelas I Pontianak</h1>
        </div>

        <!-- Filter Tab Tim Kerja -->
        <div class="d-flex justify-content-center mb-4">
            <ul class="nav nav-pills custom-stat-tabs p-1 bg-white shadow-sm rounded-3" id="statTeamTabs" role="tablist" style="border: 1px solid rgba(0, 124, 133, 0.2);">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-2 px-4" id="tab-vaksin-tab" data-bs-toggle="pill" data-bs-target="#tab-vaksin" type="button" role="tab">
                        <i class="fa fa-syringe me-2"></i>Layanan Vaksinasi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-2 px-4" id="tab-angkut-tab" data-bs-toggle="pill" data-bs-target="#tab-angkut" type="button" role="tab">
                        <i class="fa fa-ship me-2"></i>Pengawasan Alat Angkut
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-2 px-4" id="tab-lingkungan-tab" data-bs-toggle="pill" data-bs-target="#tab-lingkungan" type="button" role="tab">
                        <i class="fa fa-pump-soap me-2"></i>Sanitasi & Lingkungan
                    </button>
                </li>
            </ul>
        </div>

        <!-- Filter Periode Waktu Global -->
        <div class="d-flex justify-content-end align-items-center mb-4 me-2">
            <span class="small text-muted me-2 font-weight-bold"><i class="fa fa-filter me-1"></i>Periode Data:</span>
            <div class="btn-group btn-group-sm bg-white shadow-sm rounded" role="group" id="periodFilter">
                <button type="button" class="btn btn-outline-primary active" data-period="today">Hari Ini</button>
                <button type="button" class="btn btn-outline-primary" data-period="month">Bulan Ini</button>
                <button type="button" class="btn btn-outline-primary" data-period="year">Tahun Ini</button>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="tab-content" id="statTeamTabsContent">

            <!-- TIM 1: LAYANAN VAKSINASI INTERNASIONAL -->
            <div class="tab-pane fade show active" id="tab-vaksin" role="tabpanel">
                <div class="row g-4">
                    <!-- Total Vaksinasi -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-0 shadow-sm p-4 text-center h-100 bg-primary text-white rounded-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-white text-primary">Total Layanan</span>
                                <i class="fa fa-users-cog fa-2x opacity-75"></i>
                            </div>
                            <h2 class="display-5 fw-bold text-white mb-0" id="stat-vaksin-total">0</h2>
                            <p class="small text-white-50 mb-0">Total Dosis Diberikan</p>
                        </div>
                    </div>

                    <!-- Yellow Fever -->
                    <div class="col-lg-2 col-md-6 col-6">
                        <div class="card border-0 shadow-sm p-3 text-center h-100 rounded-4 stat-card">
                            <div class="icon-wrap mx-auto mb-2 text-warning">
                                <i class="fa fa-vial fa-2x"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-1" id="stat-yellow-fever">0</h3>
                            <p class="small text-muted mb-0">Yellow Fever</p>
                        </div>
                    </div>

                    <!-- Meningitis -->
                    <div class="col-lg-2 col-md-6 col-6">
                        <div class="card border-0 shadow-sm p-3 text-center h-100 rounded-4 stat-card">
                            <div class="icon-wrap mx-auto mb-2 text-info">
                                <i class="fa fa-capsules fa-2x"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-1" id="stat-meningitis">0</h3>
                            <p class="small text-muted mb-0">Meningitis</p>
                        </div>
                    </div>

                    <!-- Influenza -->
                    <div class="col-lg-2 col-md-6 col-6">
                        <div class="card border-0 shadow-sm p-3 text-center h-100 rounded-4 stat-card">
                            <div class="icon-wrap mx-auto mb-2 text-danger">
                                <i class="fa fa-head-side-cough fa-2x"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-1" id="stat-influenza">0</h3>
                            <p class="small text-muted mb-0">Influenza</p>
                        </div>
                    </div>

                    <!-- Tifoid -->
                    <div class="col-lg-2 col-md-6 col-6">
                        <div class="card border-0 shadow-sm p-3 text-center h-100 rounded-4 stat-card">
                            <div class="icon-wrap mx-auto mb-2 text-success">
                                <i class="fa fa-shield-virus fa-2x"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-1" id="stat-tifoid">0</h3>
                            <p class="small text-muted mb-0">Tifoid</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TIM 2: PENGAWASAN ALAT ANGKUT (Kapal, Pesawat, Peserta/Penumpang) -->
            <div class="tab-pane fade" id="tab-angkut" role="tabpanel">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm p-4 text-center h-100 rounded-4 stat-card">
                            <i class="fa fa-plane-arrival fa-2x text-primary mb-2"></i>
                            <h3 class="fw-bold text-dark mb-1" id="stat-pesawat-diperiksa">0</h3>
                            <p class="small text-muted mb-0">Pesawat Diperiksa</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm p-4 text-center h-100 rounded-4 stat-card">
                            <i class="fa fa-ship fa-2x text-primary mb-2"></i>
                            <h3 class="fw-bold text-dark mb-1" id="stat-kapal-diperiksa">0</h3>
                            <p class="small text-muted mb-0">Kapal Laut Diperiksa</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm p-4 text-center h-100 rounded-4 stat-card">
                            <i class="fa fa-file-contract fa-2x text-primary mb-2"></i>
                            <h3 class="fw-bold text-dark mb-1" id="stat-penerbitan-cop">0</h3>
                            <p class="small text-muted mb-0">Penerbitan COP / PHQC</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm p-4 text-center h-100 rounded-4 stat-card">
                            <i class="fa fa-user-check fa-2x text-primary mb-2"></i>
                            <h3 class="fw-bold text-dark mb-1" id="stat-skrd-skrining">0</h3>
                            <p class="small text-muted mb-0">Skrining Kesehatan Pelintas</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TIM 3: SANITASI & FAKTOR RISIKO LINGKUNGAN -->
            <div class="tab-pane fade" id="tab-lingkungan" role="tabpanel">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-0 shadow-sm p-4 text-center h-100 rounded-4 stat-card">
                            <i class="fa fa-utensils fa-2x text-success mb-2"></i>
                            <h3 class="fw-bold text-dark mb-1" id="stat-sampel-makanan">0</h3>
                            <p class="small text-muted mb-0">Pemeriksaan Sampel Makanan</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-0 shadow-sm p-4 text-center h-100 rounded-4 stat-card">
                            <i class="fa fa-water fa-2x text-info mb-2"></i>
                            <h3 class="fw-bold text-dark mb-1" id="stat-sampel-air">0</h3>
                            <p class="small text-muted mb-0">Pemeriksaan Kualitas Air</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-0 shadow-sm p-4 text-center h-100 rounded-4 stat-card">
                            <i class="fa fa-bug fa-2x text-warning mb-2"></i>
                            <h3 class="fw-bold text-dark mb-1" id="stat-pengendalian-vektor">0</h3>
                            <p class="small text-muted mb-0">Pengawasan Vektor & Hama</p>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- End Tab Content -->

        <!-- Sync Footer Info -->
        <div class="text-center mt-4">
            <span class="badge bg-light text-muted border py-2 px-3" style="white-space: normal; line-height: 1.5;">
                <i class="fa fa-sync-alt me-1 text-primary"></i> Data terhubung secara otomatis via API | Terakhir diperbarui: <span id="stat-last-updated">-</span>
            </span>
        </div>
    </div>
</div>
<!-- Live Statistics Section End -->

<!-- CSS Tambahan Khusus Statistik -->
<style>
    .custom-stat-tabs .nav-link {
        color: #555;
        font-weight: 500;
        transition: 0.3s;
    }
    .custom-stat-tabs .nav-link.active {
        background-color: var(--bs-primary, #007C85) !important;
        color: #fff !important;
        box-shadow: 0 4px 12px rgba(0, 124, 133, 0.3);
    }
    .stat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08) !important;
    }
</style>

<!-- JS Mockup Integrasi API -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    let currentPeriod = 'today'; // default filter

    // Handler Switcher Periode (Hari Ini, Bulan Ini, Tahun Ini)
    const periodButtons = document.querySelectorAll('#periodFilter button');
    periodButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            periodButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentPeriod = this.getAttribute('data-period');
            
            // Panggil ulang data API dengan parameter periode baru
            fetchStatisticsData(currentPeriod);
        });
    });

    // Fungsi Utama Fetch Data dari API
    function fetchStatisticsData(period) {
        /* 
           GANTI DENGAN ENDPOINT API KAMU NANTI:
           const API_URL = `https://api.bkkpontianak.com/v1/stats?period=${period}`;
        */
        
        // Simulasi respon data API (Mock Data)
        const mockApiResponse = {
            today: {
                yellow_fever: 12,
                meningitis: 25,
                influenza: 8,
                tifoid: 5,
                pesawat: 14,
                kapal: 9,
                cop: 6,
                skrining: 320,
                sampel_makanan: 4,
                sampel_air: 2,
                vektor: 3
            },
            month: {
                yellow_fever: 140,
                meningitis: 380,
                influenza: 95,
                tifoid: 60,
                pesawat: 310,
                kapal: 180,
                cop: 120,
                skrining: 8400,
                sampel_makanan: 45,
                sampel_air: 30,
                vektor: 15
            },
            year: {
                yellow_fever: 1520,
                meningitis: 4200,
                influenza: 1100,
                tifoid: 750,
                pesawat: 3400,
                kapal: 2100,
                cop: 1450,
                skrining: 95000,
                sampel_makanan: 480,
                sampel_air: 320,
                vektor: 180
            }
        };

        // Ambil data sesuai periode
        const data = mockApiResponse[period];

        // 1. Hitung & pasang data Tim Vaksinasi
        const totalVaksin = data.yellow_fever + data.meningitis + data.influenza + data.tifoid;
        document.getElementById('stat-vaksin-total').innerText = totalVaksin.toLocaleString('id-ID');
        document.getElementById('stat-yellow-fever').innerText = data.yellow_fever.toLocaleString('id-ID');
        document.getElementById('stat-meningitis').innerText = data.meningitis.toLocaleString('id-ID');
        document.getElementById('stat-influenza').innerText = data.influenza.toLocaleString('id-ID');
        document.getElementById('stat-tifoid').innerText = data.tifoid.toLocaleString('id-ID');

        // 2. Pasang data Tim Pengawasan Alat Angkut
        document.getElementById('stat-pesawat-diperiksa').innerText = data.pesawat.toLocaleString('id-ID');
        document.getElementById('stat-kapal-diperiksa').innerText = data.kapal.toLocaleString('id-ID');
        document.getElementById('stat-penerbitan-cop').innerText = data.cop.toLocaleString('id-ID');
        document.getElementById('stat-skrd-skrining').innerText = data.skrining.toLocaleString('id-ID');

        // 3. Pasang data Tim Sanitasi & Vektor
        document.getElementById('stat-sampel-makanan').innerText = data.sampel_makanan.toLocaleString('id-ID');
        document.getElementById('stat-sampel-air').innerText = data.sampel_air.toLocaleString('id-ID');
        document.getElementById('stat-pengendalian-vektor').innerText = data.vektor.toLocaleString('id-ID');

        // Timestamp
        const now = new Date();
        document.getElementById('stat-last-updated').innerText = now.toLocaleTimeString('id-ID') + ' WIB';
    }

    // First Load
    fetchStatisticsData(currentPeriod);
});
</script>
<!-- Statistik End -->
            <div class="mt-5">
                <div class="row">
                   <!-- Social Media Slider Section Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="background: #f8fafb;">
    <div class="container">
        <!-- Header Section -->
        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase"><i class="fa fa-photo-video me-2"></i>Media Informasi</h5>
            <h1 class="mb-0">Kabar & Informasi Terkini Media Sosial</h1>
        </div>

        <!-- Splide Slider Wrapper -->
        <section class="splide social-splide position-relative p-2" aria-label="Social Media Feed">
            <div class="splide__track">
                <ul class="splide__list">

                    <!-- SLIDE 1: INSTAGRAM -->
                    <li class="splide__slide">
                        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-white">
                            <div class="card-header bg-white border-bottom p-3 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="fab fa-instagram text-danger fa-lg me-2"></i>
                                    <span class="fw-bold small text-dark">@bkkpontianak</span>
                                </div>
                                <span class="badge bg-danger-subtle text-danger rounded-pill px-2 py-1 small">Instagram</span>
                            </div>
                            <div class="card-body p-2 d-flex align-items-center justify-content-center bg-light overflow-auto position-relative social-embed-card" data-network="instagram" style="height: 480px;">
                                <blockquote class="instagram-media w-100" data-instgrm-permalink="https://www.instagram.com/bkkpontianak/?utm_source=ig_embed&utm_campaign=loading" data-instgrm-version="14" style="background:#FFF; border:0; border-radius:8px; box-shadow:none; margin: 0 auto; max-width:100%; width:100%;">
                                    <div style="padding:16px; text-align:center;">
                                        <a href="https://www.instagram.com/bkkpontianak/" style="color:#3897f0; font-family:Poppins,sans-serif; font-size:13px; font-weight:600; text-decoration:none;" target="_blank">
                                            Memuat Instagram...
                                        </a>
                                    </div>
                                </blockquote>

                                {{-- Postingan baru dimuat setelah tombol ini diklik, supaya script Instagram
                                     (berat + memanggil analitik sendiri) tidak ikut membebani load awal halaman. --}}
                                <div class="social-embed-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center bg-light">
                                    <i class="fab fa-instagram fa-2x text-danger mb-2"></i>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill social-embed-load-btn">
                                        Tampilkan Postingan Instagram
                                    </button>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top p-3 text-center">
                                <a href="https://www.instagram.com/bkkpontianak/" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill w-100">
                                    Lihat di Instagram <i class="fa fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </li>

                    <!-- SLIDE 2: TIKTOK -->
                    <li class="splide__slide">
                        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-white">
                            <div class="card-header bg-white border-bottom p-3 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="fab fa-tiktok text-dark fa-lg me-2"></i>
                                    <span class="fw-bold small text-dark">@bkkpontianak</span>
                                </div>
                                <span class="badge bg-dark-subtle text-dark rounded-pill px-2 py-1 small">TikTok</span>
                            </div>
                            <div class="card-body p-2 d-flex align-items-center justify-content-center bg-light overflow-auto position-relative social-embed-card" data-network="tiktok" style="height: 480px;">
                                <blockquote class="tiktok-embed w-100" cite="https://www.tiktok.com/@bkkpontianak" data-unique-id="bkkpontianak" data-embed-type="creator" style="max-width: 100%; margin: 0 auto;">
                                    <section>
                                        <a target="_blank" href="https://www.tiktok.com/@bkkpontianak?refer=creator_embed">@bkkpontianak</a>
                                    </section>
                                </blockquote>

                                {{-- Sama seperti Instagram: baru dimuat setelah diklik. TikTok memanggil
                                     analitiknya sendiri (sering di-block adblocker) begitu script-nya jalan,
                                     jadi paling aman kalau script itu tidak otomatis jalan di semua pengunjung. --}}
                                <div class="social-embed-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center bg-light">
                                    <i class="fab fa-tiktok fa-2x text-dark mb-2"></i>
                                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill social-embed-load-btn">
                                        Tampilkan Video TikTok
                                    </button>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top p-3 text-center">
                                <a href="https://www.tiktok.com/@bkkpontianak" target="_blank" class="btn btn-sm btn-outline-dark rounded-pill w-100">
                                    Lihat di TikTok <i class="fa fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </li>

                    <!-- SLIDE 3: YOUTUBE -->
                    <!-- SLIDE 3: YOUTUBE (THUMBNAIL MANUAL GRID) -->
<li class="splide__slide">
    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-white">
        <div class="card-header bg-white border-bottom p-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="fab fa-youtube text-danger fa-lg me-2"></i>
                <span class="fw-bold small text-dark">YouTube Video</span>
            </div>
            <span class="badge bg-danger-subtle text-danger rounded-pill px-2 py-1 small">Terbaru</span>
        </div>
        
        <!-- Container List Video (Scrollable jika video banyak) -->
        <div class="card-body p-3 bg-light overflow-auto d-flex flex-column gap-3" style="height: 480px;">
            
            <!-- Item Video 1 -->
            <a href="https://youtu.be/ctvpbPE26Xw" target="_blank" class="card border-0 shadow-sm overflow-hidden text-decoration-none group-yt-item rounded-3">
                <div class="position-relative overflow-hidden" style="aspect-ratio: 16/9; background: #000;">
                    <!-- Thumbnail YouTube Manual -->
                    <img loading="lazy" decoding="async" src="https://i.ytimg.com/vi/ctvpbPE26Xw/mqdefault.jpg" alt="Takdir Milea Berubah di Pesawat! Tips Mudik Sehat & Nyaman ✈️💙" class="w-100 h-100 object-fit-cover opacity-90 transition-zoom">
                    
                    <!-- Overlay Icon Play -->
                    <div class="position-absolute top-50 start-50 translate-middle bg-danger text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 42px; height: 42px;">
                        <i class="fa fa-play ms-1" style="font-size: 14px;"></i>
                    </div>
                </div>
                <div class="p-2 bg-white">
                    <h6 class="text-dark fw-bold mb-1 text-truncate-2" style="font-size: 13px; line-height: 1.4;">
                        Takdir Milea Berubah di Pesawat! Tips Mudik Sehat & Nyaman ✈️💙
                    </h6>
                    <span class="small text-muted" style="font-size: 11px;">
                        <i class="fab fa-youtube text-danger me-1"></i>Tonton di YouTube
                    </span>
                </div>
            </a>

            <!-- Item Video 2 -->
            <a href="https://youtu.be/hDjwqIbx-qk" target="_blank" class="card border-0 shadow-sm overflow-hidden text-decoration-none group-yt-item rounded-3">
                <div class="position-relative overflow-hidden" style="aspect-ratio: 16/9; background: #000;">
                    <img loading="lazy" decoding="async" src="https://i.ytimg.com/vi/hDjwqIbx-qk/mqdefault.jpg" alt="
Pelayanan Tanpa Batas: BKK Pontianak Prioritaskan Kelompok Rentan & Lansia 🤝💙" class="w-100 h-100 object-fit-cover opacity-90 transition-zoom">
                    <div class="position-absolute top-50 start-50 translate-middle bg-danger text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 42px; height: 42px;">
                        <i class="fa fa-play ms-1" style="font-size: 14px;"></i>
                    </div>
                </div>
                <div class="p-2 bg-white">
                    <h6 class="text-dark fw-bold mb-1 text-truncate-2" style="font-size: 13px; line-height: 1.4;">
                    Pelayanan Tanpa Batas: BKK Pontianak Prioritaskan Kelompok Rentan & Lansia 🤝💙
                    </h6>
                    <span class="small text-muted" style="font-size: 11px;">
                        <i class="fab fa-youtube text-danger me-1"></i>Tonton di YouTube
                    </span>
                </div>
            </a>

        </div>

        <div class="card-footer bg-white border-top p-3 text-center">
            <a href="https://www.youtube.com/channel/UCXBSuR2BWc9FQ0xRa8G-1rQ/featured" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill w-100">
                Lihat Channel YouTube <i class="fa fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</li>

<!-- CSS Kustom untuk Efek Hover -->
<style>
    .group-yt-item {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .group-yt-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.12) !important;
    }
    .group-yt-item:hover .transition-zoom {
        transform: scale(1.06);
    }
    .transition-zoom {
        transition: transform 0.3s ease;
    }
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

                </ul>
            </div>
        </section>
    </div>
</div>
<!-- Social Media Slider Section End -->

<!-- Inisialisasi Script Slider Splide -->
<script>
     document.addEventListener('DOMContentLoaded', function () {
        var layananSplide = new Splide('.layanan-splide', {
            type: 'loop',
            perPage: 5,
            focus: 'center',
            autoplay: true,
            interval: 3500,
            pagination: false,
            arrows: true,
            breakpoints: {
                992: { perPage: 3 },
                768: { perPage: 2 },
                576: { perPage: 1 },
            }
        }).mount();

        // Hitung ulang ukuran setelah font, gambar, dan layout selesai dimuat
        window.addEventListener('load', function () {
            layananSplide.refresh();
        });
    });
</script>

<!-- Script External Platform Embeds -->
<script>
    // Embed Instagram & TikTok sengaja TIDAK dimuat otomatis sama sekali — script bawaan mereka
    // berat (bundle JS besar + memanggil analitik/beacon sendiri ke server TikTok/Meta) dan bisa
    // membuat halaman terasa "masih memuat" walau konten utama sudah selesai. Baru dimuat kalau
    // pengunjung klik tombol "Tampilkan..." di kartu masing-masing.
    (function() {
        var loadedScripts = {};

        function loadNetworkScript(network) {
            if (loadedScripts[network]) {
                // Sudah pernah dimuat (mis. ada 2 kartu jaringan yang sama): cukup proses ulang.
                if (network === 'instagram' && window.instgrm) {
                    window.instgrm.Embeds.process();
                }
                return;
            }
            loadedScripts[network] = true;

            var src = network === 'instagram'
                ? 'https://platform.instagram.com/en_US/embeds.js'
                : 'https://www.tiktok.com/embed.js';

            var s = document.createElement('script');
            s.async = true;
            s.src = src;
            document.body.appendChild(s);
        }

        document.querySelectorAll('.social-embed-load-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var card = btn.closest('.social-embed-card');
                if (!card) return;

                loadNetworkScript(card.dataset.network);

                var overlay = card.querySelector('.social-embed-overlay');
                if (overlay) overlay.remove();
            });
        });
    })();
</script>
@endsection
