<!-- Favicon -->
<link href="{{ asset('frontend/img/favicon.ico') }}" rel="icon">

<!-- Google Web Fonts -->
{{-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap"
    rel="stylesheet"> --}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
{{-- Sebelumnya Font Awesome dimuat 2x (versi 5.10.0 & 5.15.4). Cukup 1 versi. --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
{{-- Catatan: script bootstrap.bundle.min.js SENGAJA dipindah ke includes.frontend.script
     (di akhir <body>), karena JS tidak boleh nangkring di <head> tanpa "defer" —
     itu yang bikin halaman kerasa lambat kebuka (render-blocking). --}}


