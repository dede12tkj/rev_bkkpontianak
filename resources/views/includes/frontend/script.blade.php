<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('frontend/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/lib/splide/splide.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('frontend/js/main.js') }}"></script>


<script>
    // Ambil semua elemen gambar dengan class "zoom-image"
    const zoomImages = document.querySelectorAll(".zoom-image");

    // Menambahkan event listener untuk mousemove pada setiap gambar
    zoomImages.forEach(function(zoomImage) {
        zoomImage.addEventListener("mousemove", function(e) {
            const image = e.target;

            // Dapatkan posisi gambar dan ukuran kontainer
            const bounds = image.getBoundingClientRect();
            const offsetX = e.clientX - bounds.left;
            const offsetY = e.clientY - bounds.top;

            // Hitung persentase posisi kursor relatif terhadap gambar
            const xPercent = (offsetX / bounds.width) * 100;
            const yPercent = (offsetY / bounds.height) * 100;

            // Perbesar gambar dan atur posisi zoom berdasarkan kursor
            image.style.transformOrigin = `${xPercent}% ${yPercent}%`;
            image.style.transform = "scale(1.5)"; // Perbesar gambar
        });

        // Mengembalikan gambar ke ukuran normal saat kursor meninggalkan gambar
        zoomImage.addEventListener("mouseleave", function() {
            zoomImage.style.transform = "scale(1)"; // Ukuran normal
            zoomImage.style.transformOrigin = "center center"; // Reset posisi zoom
        });
    });

    // // Tombol untuk membuka media sosial
    // const socialBtn = document.getElementById('socialBtn');
    // const socialIcons = document.querySelector('.social-media-icons');

    // // Menambahkan event listener untuk klik tombol
    // socialBtn.addEventListener('click', () => {
    //     // Toggle kelas 'active' pada tombol dan ikon
    //     socialBtn.classList.toggle('active');
    //     socialIcons.classList.toggle('active');
    // });

    var myCarousel = document.querySelector('#customNewsCarousel');
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 2000, // Waktu untuk interval antar slide dalam milidetik
        ride: 'carousel' // Menambahkan autoplay carousel
    });
</script>
<script type="text/javascript">
    /* curator-feed-default-feed-layout */
    (function() {
        var i, e, d = document,
            s = "script";
        i = d.createElement("script");
        i.async = 1;
        i.charset = "UTF-8";
        i.src = "https://cdn.curator.io/published/a39ac412-2454-437d-b5f6-c00577ed26bb.js";
        e = d.getElementsByTagName(s)[0];
        e.parentNode.insertBefore(i, e);
    })();
</script>
