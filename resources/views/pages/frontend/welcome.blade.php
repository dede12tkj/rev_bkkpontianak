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
    </style>
    {{-- <script>
        (function() {

            const today = new Date();
            const month = today.getMonth() + 1;
            const day = today.getDate();

            let forceTheme = "ramadhan";

            let theme = null;

            // 🔥 PRIORITAS: pakai forceTheme dulu
            if (forceTheme) {
                theme = forceTheme;
            } else {

                const today = new Date();
                const month = today.getMonth() + 1;
                const day = today.getDate();

                if (month === 12 && day >= 20) theme = "natal";
                else if (month === 1 && day === 1) theme = "tahun_baru";
                else if (month === 2) theme = "imlek";
                else if (month === 3 || month === 4) theme = "ramadhan";
            }

            // ================= CANVAS =================
            const canvas = document.createElement("canvas");
            const ctx = canvas.getContext("2d");

            canvas.style.position = "fixed";
            canvas.style.top = 0;
            canvas.style.left = 0;
            canvas.style.width = "100%";
            canvas.style.height = "100%";
            canvas.style.zIndex = 9999;
            canvas.style.pointerEvents = "none";

            document.body.appendChild(canvas);

            function resize() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }
            resize();
            window.addEventListener("resize", resize);

            // =====================================================
            // 🎆 FIREWORKS REALISTIC (PHYSICS + TRAIL)
            // =====================================================
            if (theme === "tahun_baru") {

                const particles = [];

                function explode(x, y) {
                    for (let i = 0; i < 80; i++) {
                        particles.push({
                            x,
                            y,
                            angle: Math.random() * Math.PI * 2,
                            speed: Math.random() * 6 + 2,
                            gravity: 0.05,
                            alpha: 1
                        });
                    }
                }

                function animate() {
                    ctx.fillStyle = "rgba(0,0,0,0.2)";
                    ctx.fillRect(0, 0, canvas.width, canvas.height);

                    particles.forEach((p, i) => {
                        p.x += Math.cos(p.angle) * p.speed;
                        p.y += Math.sin(p.angle) * p.speed + p.gravity;
                        p.alpha -= 0.01;

                        ctx.globalAlpha = p.alpha;
                        ctx.fillStyle = `hsl(${Math.random()*360},100%,60%)`;
                        ctx.fillRect(p.x, p.y, 2, 2);

                        if (p.alpha <= 0) particles.splice(i, 1);
                    });

                    ctx.globalAlpha = 1;
                    requestAnimationFrame(animate);
                }

                setInterval(() => {
                    explode(Math.random() * canvas.width, Math.random() * canvas.height / 2);
                }, 700);

                animate();
            }

            // =====================================================
            // 🌙 RAMADHAN (LIGHT + KETUPAT + SABIT)
            // =====================================================
            if (theme === "ramadhan") {

                // background terang
                document.body.style.background = "linear-gradient(to bottom, #e0f7ff, #ffffff)";

                const stars = [];

                for (let i = 0; i < 50; i++) {
                    stars.push({
                        x: Math.random() * canvas.width,
                        y: Math.random() * canvas.height / 2,
                        size: Math.random() * 1.5,
                        opacity: Math.random()
                    });
                }

                function drawMoon() {
                    // bulan utama
                    ctx.beginPath();
                    ctx.arc(canvas.width - 120, 100, 30, 0, Math.PI * 2);
                    ctx.fillStyle = "#fff5cc";
                    ctx.fill();

                    // potong jadi sabit
                    ctx.globalCompositeOperation = "destination-out";
                    ctx.beginPath();
                    ctx.arc(canvas.width - 100, 90, 30, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.globalCompositeOperation = "source-over";
                }

                function animate() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);

                    // bintang halus
                    stars.forEach(s => {
                        ctx.beginPath();
                        ctx.arc(s.x, s.y, s.size, 0, Math.PI * 2);
                        ctx.fillStyle = "rgba(255,255,255," + s.opacity + ")";
                        ctx.fill();
                    });

                    // drawMoon();

                    requestAnimationFrame(animate);
                }

                animate();

                // ================= KETUPAT FLOATING =================
                // ================= MULTI KETUPAT =================
                // ================= KETUPAT GOYANG RANDOM =================
                // ================= KETUPAT LURUS KE BAWAH =================
                function createKetupat() {

                    const ketupatImages = [
                        "/frontend/img/ketupat.png",
                        "/frontend/img/mosque.png",
                        "/frontend/img/lantern.png",
                    ];

                    const randomImage = ketupatImages[Math.floor(Math.random() * ketupatImages.length)];

                    const el = document.createElement("img");
                    el.src = randomImage;

                    // ukuran random biar natural
                    const size = Math.random() * 20 + 55;

                    el.style.width = size + "px";
                    el.style.position = "fixed";
                    el.style.top = "-50px";
                    el.style.left = Math.random() * window.innerWidth + "px";
                    el.style.zIndex = 9999;
                    el.style.pointerEvents = "none";

                    const duration = Math.random() * 4 + 4;

                    // ⬇️ jatuh lurus + sedikit rotasi halus
                    const rotate = Math.random() * 60 - 30;

                    el.animate([{
                            transform: "translateY(0px) rotate(0deg)"
                        },
                        {
                            transform: `translateY(110vh) rotate(${rotate}deg)`
                        }
                    ], {
                        duration: duration * 1000,
                        easing: "linear"
                    });

                    document.body.appendChild(el);

                    setTimeout(() => el.remove(), duration * 1000);
                }

                setInterval(createKetupat, 1200);

                // ================= CURSOR SABIT =================
                const cursor = document.createElement("div");
                // cursor.innerHTML = "🌙";
                cursor.style.position = "fixed";
                cursor.style.pointerEvents = "none";
                cursor.style.fontSize = "18px";
                cursor.style.zIndex = 9999;

                document.body.appendChild(cursor);

                document.addEventListener("mousemove", (e) => {
                    cursor.style.left = e.clientX + "px";
                    cursor.style.top = e.clientY + "px";
                });
            }

            // =====================================================
            // 🎄 SALJU (DEPTH + PARALLAX + BLUR)
            // =====================================================
            if (theme === "natal") {

                const snow = [];

                for (let i = 0; i < 200; i++) {
                    snow.push({
                        x: Math.random() * canvas.width,
                        y: Math.random() * canvas.height,
                        r: Math.random() * 4,
                        speed: Math.random() * 1 + 0.5
                    });
                }

                function animate() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);

                    snow.forEach(s => {
                        ctx.beginPath();
                        ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
                        ctx.fillStyle = "rgba(255,255,255,0.8)";
                        ctx.fill();

                        s.y += s.speed;
                        s.x += Math.sin(s.y * 0.01);

                        if (s.y > canvas.height) {
                            s.y = 0;
                            s.x = Math.random() * canvas.width;
                        }
                    });

                    requestAnimationFrame(animate);
                }

                animate();
            }

            // =====================================================
            // 🧧 LAMPION PNG (GANTUNG)
            // =====================================================
            if (theme === "imlek") {

                const container = document.createElement("div");
                container.style.position = "fixed";
                container.style.top = 0;
                container.style.left = 0;
                container.style.width = "100%";
                container.style.zIndex = 9999;
                container.style.pointerEvents = "none";

                document.body.appendChild(container);

                for (let i = 0; i < 8; i++) {

                    const lampion = document.createElement("img");
                    lampion.src = "/assets/lampion.png"; // GANTI GAMBAR
                    lampion.style.width = "50px";
                    lampion.style.position = "absolute";
                    lampion.style.left = (i * 12 + 5) + "%";
                    lampion.style.top = "0px";

                    lampion.animate([{
                            transform: "rotate(-6deg)"
                        },
                        {
                            transform: "rotate(6deg)"
                        }
                    ], {
                        duration: 2000 + Math.random() * 1000,
                        iterations: Infinity,
                        direction: "alternate",
                        easing: "ease-in-out"
                    });

                    container.appendChild(lampion);
                }
            }

        })();
    </script> --}}
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

                                            <img src="{{ asset('storage/' . $item->thumbnail) }}" class="berita-img">

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

            {{-- <div class="col-lg-5" style="; border-radius: 8px;">
                <div class="card shadow wow zoomIn" data-wow-delay="0.9s">
                    <div class="card-body">
                        <!-- Carousel -->
                        <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel" style="">
                            <div class="carousel-inner">

                                @foreach ($berita as $index => $b)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <div class="news-box">
                                            <div class="thumbnail-container text-center">
                                                <img class="thumbnail-img" src="{{ asset('storage/' . $b->thumbnail) }}"
                                                    alt="{{ $b->judul }}">
                                            </div>

                                            <div class="news-content">
                                                <h5 class="fw-bold">{{ Str::limit(strip_tags($b->judul), 100) }}</h5>

                                                <p class="text-muted">
                                                    {{ Str::limit(strip_tags($b->konten), 130) }}
                                                </p>

                                                <div class="row d-flex justify-content-between align-items-center">
                                                    <span class="text-muted" style="font-size: 12px">
                                                        <i class="fa fa-calendar"
                                                            style="margin-right: 8px; font-size: 12px"></i>
                                                        {{ $b->tanggal?->translatedFormat('d F Y') ?? '-' }}

                                                    </span>

                                                    <a href="{{ route('user-berita.show', $b->slug) }}"
                                                        class="btn btn-link">
                                                        Baca selengkapnya →
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <!-- Controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>



                    </div>

                </div>
            </div> --}}
        </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    {{-- <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Layanan Kami</h5>
                <h1 class="mb-0">STANDAR PELAYANAN BALAI KEKARANTINAAN KESEHATAN KELAS I PONTIANAK</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-shield-alt text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN VAKSINASI INTERNASIONAL DAN PENERBITAN INTERNATIONAL
                            CERTIFICATE VACCINATION (ICV)</h4>
                        <a class="btn btn-lg btn-primary rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">STANDAR PELAYANAN VAKSINASI INTERNASIONAL
                                    DAN PENERBITAN INTERNATIONAL CERTIFICATE VACCINATION (ICV)</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="image-container">
                                    <h5>Dasar Hukum</h5>
                                    <ul>
                                        <li>Undang-Undang Nomor 25 Tahun 2009 tentang Pelayanan Publik</li>
                                        <li>Undang-Undang Nomor 17 Tahun 2023 tentang Kesehatan</li>
                                        <li>Peraturan Pemerintah RI Nomor 64 Tahun 2019 tentang Jenis dan Tarif atas Jenis
                                            Penerimaan Negara Bukan Pajak (PNBP) yang berlaku pada Kementerian Kesehatan
                                        </li>
                                        <li>Peraturan Menteri PAN & RB Nomor 15 Tahun 2014 tentang Standar Pelayanan Publik
                                        </li>
                                        <li>Peraturan Menteri Kesehatan RI Nomor 23 Tahun 2018 tentang Pelayanan dan
                                            Penerbitan Sertifikat Vaksinasi Internasional</li>
                                        <li>Peraturan Menteri Kesehatan RI Nomor 9 Tahun 2023 tentang Klasifikasi Unit
                                            Pelaksana Teknis Bidang Kekarantinaan Kesehatan</li>
                                        <li>Peraturan Menteri Kesehatan RI Nomor 10 Tahun 2023 tentang Organisasi dan Tata
                                            Kerja Unit Pelaksana Teknis Bidang Kekarantinaan Kesehatan</li>
                                        <li>Peraturan Menteri Keuangan RI Nomor 45 Tahun 2024 tentang Jenis dan Tarif Atas
                                            Jenis Penerimaan Negara Bukan Pajak Yang Bersifat Volatil dan Kebutuhan Mendesak
                                            Yang Berlaku Pada Kementerian Kesehatan</li>
                                        <li>Peraturan Direktorat Jenderal P2P Nomor SR.03.04/II/2745/2018 tentang Tata Cara
                                            Penerbitan Sertifikat Vaksinasi Internasional</li>
                                        <li>SE Kepala Pusat Kesehatan Haji Nomor HK.02.03/A.X.1/231/2025 tentang Pelaksanaan
                                            Vaksinasi Bagi Jamaah Haji dan Umrah</li>
                                        <li>SE Plt Direktur Jenderal Penanggulangan Penyakit Nomor SR.02.04/C/173/2025
                                            tentang Penerapan electronic Certificate of Vaccination or Prophylaxis (eICV)
                                            atau Sertifikat Vaksinasi Internasional atau Profilaksis secara Elektronik</li>
                                        <li>Standar Operasional Prosedur Nasional Kegiatan Kantor Kesehatan Pelabuhan di
                                            Pintu Masuk Negara Tahun 2009 Direktorat Jenderal PP & PL Departemen Kesehatan
                                            Republik Indonesia</li>
                                        <li>International Health Regulations (IHR) Tahun 2005</li>
                                    </ul>
                                    <h5>Persyaratan</h5>
                                    <ul>
                                        <li>Scan paspor dan melakukan registrasi online melalui alamat website:
                                            <a href="https://sinkarkes.kemkes.go.id"
                                                target="_blank">https://sinkarkes.kemkes.go.id</a> melalui komputer atau
                                            smartphone
                                        </li>
                                        <li>Apabila hasil scan paspor kurang jelas, membawa fotokopi paspor (Minimal
                                            nama 2 suku kata)</li>
                                        <li>Menunjukkan KTP asli</li>
                                        <li>Nomor handphone/WA dan alamat email yang aktif</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-chart-pie text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN IZIN LAIK TERBANG/LAYAR</h4>
                        <p class="m-0">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed
                        </p>
                        <a class="btn btn-lg btn-primary rounded" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">STANDAR PELAYANAN IZIN LAIK TERBANG/LAYAR
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Gambar yang akan ditampilkan dengan zoom -->
                                <div class="image-container">
                                    <img src="{{ asset('frontend/img/spvaksininternasional.png') }}"
                                        alt="Image Description" class="img-fluid">
                                    <img class="zoom-image" src="{{ asset('frontend/img/.png') }}" alt="Image Description"
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-code text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN SURAT KETERANGAN PENGUJIAN SEHAT</h4>
                        <p class="m-0">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fab fa-android text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN PENERBITAN SHIP SANITATION CONTROL EXEMPTION CERTIFICATE/ SHIP
                            SANITATION CONTROL CERTIFICATE (SSCEC/SSCC)</h4>
                        <p class="m-0">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-search text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN PENERBITAN CERTIFICATE OF PRATIQUE (COP)</h4>
                        <p class="m-0">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-search text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN PENERBITAN BUKU KESEHATAN KAPAL (HEALTH BOOK)</h4>
                        <p class="m-0">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-search text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN PENGAWASAN OBAT DAN ALAT KESEHATAN DI KAPAL</h4>
                        <p class="m-0">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-search text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN EVAKUASI MEDIK DARI BANDARA/PELBUHAN KE RUMAH SAKIT RUJUKAN
                        </h4>
                        <p class="m-0">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-search text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN IZIN ANGKUT ORANG SAKIT</h4>
                        <p class="m-0">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-search text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN PENGAWASAN LALU LINTAS JENAZAH</h4>
                        <p class="m-0">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-search text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN PENGAWASAN TEMPAT PENGOLAHAN PANGAN DALAM RANGKA PENERBITAN
                            LABEL PENGAWASAN MELALUI ONLINE SINGLE SUBMISSION (OSS)</h4>
                        <p class="m-0">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-search text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN PENGAWASAN TEMPAT PENGOLAHAN PANGAN DALAM RANGKA PENERBITAN
                            SLHS MELALUI ONLINE SINGLE SUBMISSION (OSS)</h4>
                        <p class="m-0">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-search text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN PENGAWASAN LALU LINTAS OMKABA (OBAT, MAKANAN, KOSMETIK, ALAT
                            KESEHATAN, DAN BAHAN ADIKTIF) EKSPORT</h4>
                        <p class="m-0">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-search text-white"></i>
                        </div>
                        <h4 class="mb-3">STANDAR PELAYANAN PENGAWASAN PENYEDIAAN AIR BERSIH DALAM RANGKA PENERBITAN
                            SETIFIKAT AIR BERSIH
                        </h4>
                        <p class="m-0">Amet justo dolor lorem kasd amet magna sea stet eos vero lorem ipsum dolore sed
                        </p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                    <div
                        class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-5">
                        <h3 class="text-white mb-3">STANDAR PELAYANAN PENERBITAN PORT HEALTH QUARANTINE CLEARANCE (PHQC)</h3>
                        <p class="text-white mb-3">Clita ipsum magna kasd rebum at ipsum amet dolor justo dolor est magna
                            stet eirmod</p>
                        <h2 class="text-white mb-0">+012 345 6789</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Layanan Kami</h5>
                <h1 class="mb-0">STANDAR PELAYANAN BALAI KEKARANTINAAN KESEHATAN KELAS I PONTIANAK</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">

                    </div>
                </div>

            </div>
        </div>
    </div> --}}
    {{-- <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="section-title text-center position-relative pb-3 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Layanan Kami</h5>
                <h1 class="mb-0">STANDAR PELAYANAN BALAI KEKARANTINAAN KESEHATAN KELAS I PONTIANAK</h1>
            </div>
            <div class="service-item rounded align-items-center justify-content-center text-center p-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Standar Pelayanan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>STANDAR PELAYANAN VAKSINASI INTERNASIONAL DAN PENERBITAN INTERNATIONAL CERTIFICATE
                                VACCINATION (ICV)</td>
                            <td class="action-btns">
                                <a href="{{ route('detail') }}" class="btn btn-warning btn-sm">Detail</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>STANDAR PELAYANAN IZIN LAIK TERBANG/LAYAR</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>STANDAR PELAYANAN SURAT KETERANGAN PENGUJIAN SEHAT</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>STANDAR PELAYANAN PENERBITAN SHIP SANITATION CONTROL EXEMPTION CERTIFICATE (SSCEC)/ SHIP
                                SANITATION CONTROL CERTIFICATE (SSCC)</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>STANDAR PELAYANAN PENERBITAN CERTIFICATE OF PRATIQUE (COP)</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>STANDAR PELAYANAN PENERBITAN BUKU KESEHATAN KAPAL (HEALTH BOOK)</td>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>STANDAR PELAYANAN PENGAWASAN OBAT DAN ALAT KESEHATAN DI KAPAL</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>STANDAR PELAYANAN EVAKUASI MEDIK DARI BANDARA/PELBUHAN KE RUMAH SAKIT RUJUKAN</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>STANDAR PELAYANAN IZIN ANGKUT ORANG SAKIT</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>STANDAR PELAYANAN PENGAWASAN LALU LINTAS JENAZAH</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>STANDAR PELAYANAN PENGAWASAN TEMPAT PENGOLAHAN PANGAN DALAM RANGKA PENERBITAN LABEL
                                PENGAWASAN MELALUI ONLINE SINGLE SUBMISSION (OSS)</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>STANDAR PELAYANAN PENGAWASAN TEMPAT PENGOLAHAN PANGAN DALAM RANGKA PENERBITAN SLHS
                                MELALUI ONLINE SINGLE SUBMISSION (OSS)</td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>STANDAR PELAYANAN PENGAWASAN LALU LINTAS OMKABA (OBAT, MAKANAN, KOSMETIK, ALAT
                                KESEHATAN, DAN BAHAN ADIKTIF) EKSPORT</td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>STANDAR PELAYANAN PENGAWASAN PENYEDIAAN AIR BERSIH DALAM RANGKA PENERBITAN SETIFIKAT AIR
                                BERSIH</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>STANDAR PELAYANAN PENERBITAN PORT HEALTH QUARANTINE CLEARANCE (PHQC)</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div> --}}

    <div class="layanan-section wow fadeInUp" data-wow-delay="0.1s">
        <div class="layanan-glow"></div>
        <div class="container position-relative">
            <div class="text-center position-relative mx-auto mb-3" style="max-width: 700px; z-index: 2;">
                <h5 class="fw-bold text-uppercase layanan-kicker">Layanan Kami</h5>
                <h1 class="text-white mb-0">Pelayanan Balai Kekarantinaan Kesehatan Kelas I Pontianak</h1>
            </div>

            <div class="owl-carousel layanan-carousel position-relative mt-4" style="z-index: 2;">
                @foreach ($layanan as $item)
                    <div class="item">
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Service End -->


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
                                <img src="{{ $item->gambar_url }}" class="img-fluid rounded">
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
                                    <a href="{{ $fskm->link }}" target="_blank"
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
                                            <img src="{{ asset('frontend/img/logowbs.png') }}" class="logo-side"
                                                alt="Logo 1">
                                        </div>
                                    </div>

                                </a>

                                <!-- Logo 2 -->
                                <a href="https://gol.kpk.go.id/login/" target="_blank" class="text-decoration-none">

                                    <div class="card logo-card shadow-sm border-0">
                                        <div class="card-body p-3 d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('frontend/img/logogolkpk.png') }}" class="logo-side"
                                                alt="Logo 2">
                                        </div>
                                    </div>

                                </a>

                                <!-- Logo 3 -->
                                <a href="https://www.lapor.go.id/tentang" target="_blank" class="text-decoration-none">

                                    <div class="card logo-card shadow-sm border-0">
                                        <div class="card-body p-3 d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('frontend/img/lapor.jpg') }}" class="logo-side"
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


    <!-- Team Start -->
    {{-- <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Team Members</h5>
                <h1 class="mb-0">Professional Stuffs Ready to Help Your Business</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img/team-1.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i
                                        class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i
                                        class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i
                                        class="fab fa-instagram fw-normal"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i
                                        class="fab fa-linkedin-in fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">Full Name</h4>
                            <p class="text-uppercase m-0">Designation</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img/team-2.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i
                                        class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i
                                        class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i
                                        class="fab fa-instagram fw-normal"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i
                                        class="fab fa-linkedin-in fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">Full Name</h4>
                            <p class="text-uppercase m-0">Designation</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                    <div class="team-item bg-light rounded overflow-hidden">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img/team-3.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i
                                        class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i
                                        class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i
                                        class="fab fa-instagram fw-normal"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square rounded" href=""><i
                                        class="fab fa-linkedin-in fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <h4 class="text-primary">Full Name</h4>
                            <p class="text-uppercase m-0">Designation</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Team End -->


    <!-- Blog Start -->
    {{-- <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Latest Blog</h5>
                <h1 class="mb-0">Read The Latest Articles from Our Blog Post</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="blog-item bg-light rounded overflow-hidden">
                        <div class="blog-img position-relative overflow-hidden">
                            <img class="img-fluid" src="img/blog-1.jpg" alt="">
                            <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4"
                                href="">Web Design</a>
                        </div>
                        <div class="p-4">
                            <div class="d-flex mb-3">
                                <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                            </div>
                            <h4 class="mb-3">How to build a website</h4>
                            <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                            <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="blog-item bg-light rounded overflow-hidden">
                        <div class="blog-img position-relative overflow-hidden">
                            <img class="img-fluid" src="img/blog-2.jpg" alt="">
                            <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4"
                                href="">Web Design</a>
                        </div>
                        <div class="p-4">
                            <div class="d-flex mb-3">
                                <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                            </div>
                            <h4 class="mb-3">How to build a website</h4>
                            <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                            <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                    <div class="blog-item bg-light rounded overflow-hidden">
                        <div class="blog-img position-relative overflow-hidden">
                            <img class="img-fluid" src="img/blog-3.jpg" alt="">
                            <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4"
                                href="">Web Design</a>
                        </div>
                        <div class="p-4">
                            <div class="d-flex mb-3">
                                <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                            </div>
                            <h4 class="mb-3">How to build a website</h4>
                            <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                            <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Blog Start -->

    <!-- Features Start -->
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Media Informasi</h5>
                <h1 class="mb-0">Terhubung dengan sosial media kami.</h1>
            </div>
            <div class="row g-5 justify-content-center">
                <!-- Instagram Card -->
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="https://www.instagram.com/bkk.pontianak/" target="_blank"
                        class="card-sosmed shadow text-center instagram-card">
                        <i class="fab fa-instagram fa-3x"></i>
                        <p>Instagram</p>
                    </a>
                </div>

                <!-- Tiktok Card -->
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="https://www.tiktok.com/@bkkpontianak?is_from_webapp=1&sender_device=pc" target="_blank"
                        class="card-sosmed shadow text-center tiktok-card">
                        <i class="fab fa-tiktok fa-3x"></i>
                        <p>Tiktok</p>
                    </a>
                </div>

                <!-- Whatsapp Card -->
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="https://www.youtube.com/channel/UCXBSuR2BWc9FQ0xRa8G-1rQ/featured" target="_blank"
                        class="card-sosmed shadow text-center youtube-card">
                        <i class="fab fa-youtube fa-3x"></i>
                        <p>Youtube</p>
                    </a>
                </div>
                <!-- Facebook Card -->
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="https://www.facebook.com/Admin.KKP.Pontianak" target="_blank"
                        class="card-sosmed shadow text-center facebook-card">
                        <i class="fab fa-facebook fa-3x"></i>
                        <p>Facebook</p>
                    </a>
                </div>

                <!-- Twitter Card -->
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="https://x.com/kkp_pontianak target="_blank"
                        class="card-sosmed shadow text-center twitter-card">
                        <i class="fab fa-twitter fa-3x"></i>
                        <p>Twitter</p>
                    </a>
                </div>
            </div>
            <div class="mt-5">
                <div class="row">
                    <!-- Instagram Section -->
                    <div class="col-lg-6">
                        <h5 class="mb-3">Postingan Instagram Terbaru</h5>
                        <blockquote class="instagram-media"
                            data-instgrm-permalink="https://www.instagram.com/bkkpontianak/?utm_source=ig_embed&utm_campaign=loading"
                            data-instgrm-version="14"
                            style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:658px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                            <div style="padding:16px;">
                                <a href="https://www.instagram.com/bkkpontianak/?utm_source=ig_embed&utm_campaign=loading"
                                    style="background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;"
                                    target="_blank">
                                    <div style="display: flex; flex-direction: row; align-items: center;">
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;">
                                        </div>
                                        <div
                                            style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                                            <div
                                                style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;">
                                            </div>
                                            <div
                                                style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding: 19% 0;"></div>
                                    <div style="display:block; margin:0 auto 12px; width:50px;">
                                        <svg width="50px" height="50px" viewBox="0 0 60 60"
                                            xmlns="https://www.w3.org/2000/svg"
                                            xmlns:xlink="https://www.w3.org/1999/xlink">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                                                    <g>
                                                        <path
                                                            d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div style="padding-top: 8px;">
                                        <div
                                            style="color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">
                                            View this profile on Instagram
                                        </div>
                                    </div>
                                    <div style="padding: 12.5% 0;"></div>
                                    <div
                                        style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                                        <div>
                                            <div
                                                style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);">
                                            </div>
                                            <div
                                                style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;">
                                            </div>
                                            <div
                                                style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);">
                                            </div>
                                        </div>
                                        <div style="margin-left: 8px;">
                                            <div
                                                style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;">
                                            </div>
                                            <div
                                                style="width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)">
                                            </div>
                                        </div>
                                        <div style="margin-left: auto;">
                                            <div
                                                style="width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);">
                                            </div>
                                            <div
                                                style="background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);">
                                            </div>
                                            <div
                                                style="width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);">
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;">
                                        </div>
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </blockquote>
                        <script async src="//platform.instagram.com/en_US/embeds.js"></script>
                    </div>
                    <!-- TikTok Section -->
                    <div class="col-lg-6">
                        <h5>Postingan Tiktok Terbaru</h5>
                        <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@bkkpontianak"
                            data-unique-id="bkkpontianak" data-embed-type="creator"
                            style="max-width: 780px; min-width: 288px;">
                            <section>
                                <a target="_blank"
                                    href="https://www.tiktok.com/@bkkpontianak?refer=creator_embed">@bkkpontianak</a>
                            </section>
                        </blockquote>
                        <script async src="https://www.tiktok.com/embed.js"></script>
                    </div>


                </div>
            </div>
            <div class="mt-2">
                <div class="col-lg-5">
                    <h5 class="mb-3">Video Youtube Terbaru</h5>
                </div>

                <!-- Elfsight YouTube Gallery | Untitled YouTube Gallery -->
                {{-- <script src="https://elfsightcdn.com/platform.js" async></script>
                <div class="elfsight-app-a3e212bf-c9c3-4df6-aca2-75c5f0cee8ca" data-elfsight-app-lazy></div> --}}

                <!-- Place <div> tag where you want the feed to appear -->
                <!-- Place <div> tag where you want the feed to appear -->
                <div id="curator-feed-default-feed-layout"><a href="https://curator.io" target="_blank"
                        class="crt-logo crt-tag"></a></div>

                <!-- The Javascript can be moved to the end of the html page before the </body> tag -->



                {{-- <div class="row mt-3">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="card-youtube-container">
                            <iframe class="card-youtube"
                                src="https://www.youtube.com/embed/rx_MKOQgl2E?si=VDu5UxthbtdsJp6t"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="card-youtube-container">
                            <iframe class="card-youtube"
                                src="https://www.youtube.com/embed/rx_MKOQgl2E?si=VDu5UxthbtdsJp6t"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="card-youtube-container">
                            <iframe class="card-youtube"
                                src="https://www.youtube.com/embed/rx_MKOQgl2E?si=VDu5UxthbtdsJp6t"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
@endsection
