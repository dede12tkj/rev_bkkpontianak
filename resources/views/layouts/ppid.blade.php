<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    @include('includes.frontend.style')
</head>

<body>

    <!-- Topbar Start -->
    @include('includes.frontend.topbar')
    <!-- Topbar End -->

    <!-- Navbar & Carousel Start -->
    @include('includes.frontend.navbar-detail')
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
        <a href="https://www.facebook.com/Admin.KKP.Pontianak" target="_blank"
            class="social-icon facebook btn-lg-square">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://x.com/kkp_pontianak" target="_blank" class="social-icon twitter btn-lg-square">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="https://www.instagram.com/bkk.pontianak/" target="_blank"
            class="social-icon instagram btn-lg-square">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.youtube.com/channel/UCXBSuR2BWc9FQ0xRa8G-1rQ/featured" target="_blank"
            class="social-icon youtube btn-lg-square">
            <i class="fab fa-youtube"></i>
        </a>
        <a href="https://api.whatsapp.com/message/4ZTOZITFRHX5G1?autoload=1&app_absent=0" target="_blank"
            class="social-icon whatsapp btn-lg-square">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>


    <!-- Full Screen Search End -->
    @include('includes.frontend.ppid')
    @yield('content')


    <!-- Footer Start -->
    @include('includes.frontend.footer')
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
        // Menampilkan modal saat halaman selesai dimuat
        $(document).ready(function() {
            // Ganti dengan path gambar yang sesuai
            var modalImageSrc = "frontend/img/maklumatpelayanan.png";
            $('#announcementModal img').attr('src', modalImageSrc);
            $('#announcementModal').modal('show');
        });
    </script>

</body>

</html>
