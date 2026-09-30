<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Balai Kekarantinaan Kelas I Pontianak" name="keywords">
    <meta content="Balai Kekarantinaan Kelas 1 Pontianak" name="description">

    {{-- CRITICAL CSS (anti-CLS): harus paling awal di <head>, SEBELUM stylesheet eksternal apa pun.
         Base rule Bootstrap: .carousel-item { display:none } dan .modal { display:none }.
         Kalau baru aktif setelah bootstrap.min.css selesai dimuat, semua slide carousel (15 buah,
         masing-masing min-height 70-85vh) sempat tampil bertumpuk lalu menciut -> CLS besar.
         Dengan aturan inline ini, hanya slide .active yang tampil sejak paint pertama. --}}
    <style>
        .carousel-item { display: none; }
        .carousel-item.active,
        .carousel-item-next,
        .carousel-item-prev { display: block; }
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; }
    </style>

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
            background: linear-gradient(135deg, #007C85, #0B2B27);
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
            <div class="modal-content" style="background: rgba(6, 22, 20, .88);">
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
                        <img src="{{ asset('frontend/img/maklumatpelayanan.jpg') }}" alt="Maklumat Pelayanan"
                            style="max-width: 100%; border-radius: 5px;" loading="lazy" decoding="async">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('includes.frontend.script')

    @include('includes.frontend.script-footer', ['accessibility' => true])

</body>

</html>
