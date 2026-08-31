<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

{{-- Bootstrap JS: sebelumnya nangkring di <head> lewat file style, bikin render-blocking.
     Sekarang ditaruh di sini (akhir body) supaya HTML/gambar tampil duluan. --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('frontend/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('frontend/js/main.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Zoom gambar saat kursor mouse di atasnya (class "zoom-image")
        const zoomImages = document.querySelectorAll(".zoom-image");

        zoomImages.forEach(function (zoomImage) {
            zoomImage.addEventListener("mousemove", function (e) {
                const image = e.target;
                const bounds = image.getBoundingClientRect();
                const offsetX = e.clientX - bounds.left;
                const offsetY = e.clientY - bounds.top;
                const xPercent = (offsetX / bounds.width) * 100;
                const yPercent = (offsetY / bounds.height) * 100;

                image.style.transformOrigin = `${xPercent}% ${yPercent}%`;
                image.style.transform = "scale(1.5)";
            });

            zoomImage.addEventListener("mouseleave", function () {
                zoomImage.style.transform = "scale(1)";
                zoomImage.style.transformOrigin = "center center";
            });
        });

        // Carousel berita di beranda (autoplay)
        const newsCarouselEl = document.querySelector('#customNewsCarousel');
        if (newsCarouselEl) {
            new bootstrap.Carousel(newsCarouselEl, {
                interval: 2000,
                ride: 'carousel'
            });
        }
    });
</script>

<script type="text/javascript">
    /* curator-feed-default-feed-layout
       Widget pihak ketiga (galeri sosial media) — sengaja ditunda sampai
       window "load" selesai, biar tidak ikut menghambat waktu render awal. */
    window.addEventListener('load', function () {
        var i, e, d = document,
            s = "script";
        i = d.createElement(s);
        i.async = 1;
        i.charset = "UTF-8";
        i.src = "https://cdn.curator.io/published/a39ac412-2454-437d-b5f6-c00577ed26bb.js";
        e = d.getElementsByTagName(s)[0];
        e.parentNode.insertBefore(i, e);
    });
</script>
