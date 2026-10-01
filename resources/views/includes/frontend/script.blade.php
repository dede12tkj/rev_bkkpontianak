<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('frontend/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/lib/splide/splide.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('frontend/js/main.js') }}?v={{ @filemtime(public_path('frontend/js/main.js')) }}"></script>


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


    var myCarousel = document.querySelector('#customNewsCarousel');
    if (myCarousel && window.bootstrap) {
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 2000, // Waktu untuk interval antar slide dalam milidetik
            ride: 'carousel' // Menambahkan autoplay carousel
        });
    }
</script>
