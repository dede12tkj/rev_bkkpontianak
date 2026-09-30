<!-- Favicon -->
<link href="{{ asset('frontend/img/favicon.ico') }}" rel="icon">

<!-- Preconnect HANYA untuk 2 origin paling kritis (CSS+file font Google, dipakai untuk teks
     di seluruh halaman). PageSpeed Insights memperingatkan: lebih dari 4 preconnect itu
     kontraproduktif (browser boros buka koneksi TCP+TLS di awal untuk origin yang belum
     tentu langsung dipakai). Origin lain cukup dns-prefetch (cuma resolve DNS, jauh lebih
     murah, tanpa buka koneksi penuh). -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
<link rel="dns-prefetch" href="https://code.jquery.com">

<!-- Google Web Fonts: hanya bobot yang dipakai (sebelumnya 18 varian termasuk italic) -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet: WAJIB blocking, layout dasar (grid, navbar, hero)
     bergantung ini. Kalau ditunda, halaman kelihatan berantakan sesaat sebelum CSS masuk. -->
<link href="{{ asset('frontend/css/bootstrap.min.css') }}?v={{ @filemtime(public_path('frontend/css/bootstrap.min.css')) }}" rel="stylesheet">

<!-- Template Stylesheet: sama, WAJIB blocking (styling hero banner, navbar, dsb ada di sini). -->
<link href="{{ asset('frontend/css/style.css') }}?v={{ @filemtime(public_path('frontend/css/style.css')) }}" rel="stylesheet">

{{-- Sisanya (icon font, animasi scroll-reveal, carousel berita/splide) TIDAK dibutuhkan untuk
     tampilan pertama layar (di atas lipatan), jadi ditunda supaya tidak ikut memblokir render.
     Teknik preload+onload standar: browser tetap download dari awal (tidak lambat), tapi
     TIDAK menunggu file ini selesai sebelum menggambar halaman. <noscript> untuk browser yang
     matikan JS. PageSpeed Insights menandai render-blocking resources ini dengan estimasi
     hemat ~3,25 detik di koneksi lambat. --}}
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}"
    onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="{{ asset('frontend/lib/animate/animate.min.css') }}"
    onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" as="style" href="{{ asset('frontend/lib/splide/splide.min.css') }}"
    onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/lib/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/lib/splide/splide.min.css') }}">
</noscript>

{{-- CSS & JS DataTables tidak lagi dimuat di <head>: dimuat otomatis hanya jika halaman punya #dataTable
     (lihat includes/frontend/script-footer.blade.php). Bootstrap JS dipindah ke akhir <body> supaya tidak
     memblokir render halaman. --}}
