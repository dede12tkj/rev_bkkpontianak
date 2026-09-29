<!-- Favicon -->
<link href="{{ asset('frontend/img/favicon.ico') }}" rel="icon">

<!-- Percepat koneksi ke CDN yang dipakai halaman -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="preconnect" href="https://code.jquery.com" crossorigin>

<!-- Google Web Fonts: hanya bobot yang dipakai (sebelumnya 18 varian termasuk italic) -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet (Font Awesome cukup dimuat satu versi) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/lib/splide/splide.min.css') }}" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="{{ asset('frontend/css/bootstrap.min.css') }}?v={{ @filemtime(public_path('frontend/css/bootstrap.min.css')) }}" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="{{ asset('frontend/css/style.css') }}?v={{ @filemtime(public_path('frontend/css/style.css')) }}" rel="stylesheet">

{{-- CSS & JS DataTables tidak lagi dimuat di <head>: dimuat otomatis hanya jika halaman punya #dataTable
     (lihat includes/frontend/script-footer.blade.php). Bootstrap JS dipindah ke akhir <body> supaya tidak
     memblokir render halaman. --}}
