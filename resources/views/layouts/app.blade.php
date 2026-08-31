<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'BKK Pontianak')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    {{-- Sebelumnya keywords & description masih bawaan template gratisan
         ("Free HTML Templates"). Sekarang defaultnya masuk akal, dan tiap
         halaman BISA override dengan @section('meta_description', '...')
         di atas @section('content') pada view masing-masing. --}}
    <meta content="Balai Kesehatan Kerja (BKK) Pontianak" name="keywords">
    <meta content="@yield('meta_description', 'Website resmi Balai Kesehatan Kerja (BKK) Pontianak — informasi layanan, PPID, dan publikasi resmi.')" name="description">
    @include('includes.frontend.style')
    <style>
        .visitor-counter {
            position: fixed;
            bottom: 105px;
            right: 20px;
            z-index: 9999;
        }

        .counter-card {
            display: flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            color: white;
            padding: 12px 15px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            font-size: 12px;
            transition: 0.3s;
        }

        .counter-card:hover {
            transform: scale(1.05);
        }

        .counter-card i {
            font-size: 22px;
        }

        .label {
            font-size: 12px;
            opacity: 0.8;
        }
    </style>
</head>

<body>

    <!-- Topbar Start -->
    @include('includes.frontend.topbar')
    <!-- Topbar End -->

    <!-- Navbar & Carousel Start -->
    @include('includes.frontend.navbar', ['carousel' => $carousel])
    <!-- Navbar & Carousel End -->

    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3"
                            placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ikon Media Sosial yang akan terbang dari sebelah kanan -->
    <div class="social-media-icons">
        <a href="{{ $sosmed->fb }}" target="_blank" class="social-icon facebook btn-lg-square">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="{{ $sosmed->twitter }}" target="_blank" class="social-icon twitter btn-lg-square">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="{{ $sosmed->instagram }}" target="_blank" class="social-icon instagram btn-lg-square">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="{{ $sosmed->tiktok }}" target="_blank" class="social-icon tiktok btn-lg-square">
            <i class="fab fa-tiktok"></i>
        </a>
        <a href="{{ $sosmed->yt }}" target="_blank" class="social-icon youtube btn-lg-square">
            <i class="fab fa-youtube"></i>
        </a>
        <a href="{{ $sosmed->wa }}" target="_blank" class="social-icon whatsapp btn-lg-square">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <div class="visitor-counter">
        <div class="counter-card">
            <i class="bi bi-people-fill"></i>
            <div>
                <div class="label">Pengunjung</div>
                <div>Total: {{ $totalVisitors }}</div>
                <div>Hari ini: {{ $todayVisitors }}</div>
            </div>
        </div>
    </div>

    <!-- Full Screen Search End -->
    @yield('content')

    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    @if ($gambar)
                        <img src="{{ asset('storage/' . $gambar->path) }}" alt="Maklumat Pelayanan"
                            style="max-width: 100%; border-radius: 5px;">
                    @else
                        <p class="text-muted text-center">Belum ada gambar maklumat pelayanan.</p>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Footer Start -->
    @include('includes.frontend.footer', ['footer' => $footer, 'sosmed' => $sosmed])
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    @include('includes.frontend.script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            var modalImageSrc = "frontend/img/maklumatpelayanan.png";
            $('#announcementModal img').attr('src', modalImageSrc);
            $('#announcementModal').modal('show');
        });
    </script>

    <script>
        (function(w, d, s, u, o) {
            w._cyA11yConfig = {
                "iconId": "default",
                "position": {
                    "mobile": "bottom-left",
                    "desktop": "bottom-left"
                },
                "language": {
                    "default": "id",
                    "selected": []
                }
            };
            var js = d.createElement(s),
                fjs = d.getElementsByTagName(s)[0];
            js.src = u;
            js.async = true;
            fjs.parentNode.insertBefore(js, fjs);
        })(window, document, "script",
            "https://cdn-cookieyes.com/widgets/accessibility.js?id=36f0a873-5bf8-489e-be57-93c20d7c392c");
    </script>




</body>

</html>
