@extends('layouts.detail')
@section('title')
    Kontak Kami
@endsection
@section('title-navbar')
    Kontak Kami
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-3">
                        <h1 class="fw-bold text-primary text-uppercase">Informasi Kontak</h1>
                        <h5 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h5>
                    </div>
                    <p>Direktorat Jenderal Pencegahan dan Pengendalian Penyakit Kementerian Kesehatan Republik Indonesia</p>
                    <div class="d-flex mb-2">
                        <i class="bi bi-geo-alt text-primary me-2"></i>
                        <p class="mb-0">Jl. Soekarno Hatta/Arteri Supadio Km. 18 Kubu Raya 78391
                        </p>
                    </div>
                    <div class="d-flex mb-2">
                        <i class="bi bi-envelope-open text-primary me-2"></i>
                        <p class="mb-0">layananpengaduan.balaikarkespontianak@kemkes.go.id</p>
                    </div>
                    <div class="d-flex mb-2">
                        <i class="bi bi-whatsapp text-primary me-2"></i>
                        <p class="mb-0">+62 811-5672-778
                        </p>
                    </div>
                    <div class="d-flex mb-2">
                        <i class="bi bi-telephone text-primary me-2"></i>
                        <p class="mb-0"> (0561) 6729032</p>
                    </div>
                    <div class="d-flex">
                        <a class="btn btn-primary btn-square me-2" href="https://www.instagram.com/bkk.pontianak/"
                            target="blank"><i class="fab fa-instagram fw-normal"></i></a>
                        <a class="btn btn-primary btn-square me-2"
                            href="https://www.tiktok.com/@bkkpontianak?is_from_webapp=1&sender_device=pc" target="blank"><i
                                class="fab fa-tiktok fw-normal"></i></a>
                        <a class="btn btn-primary btn-square me-2" href="https://x.com/kkp_pontianak" target="blank"><i
                                class="fab fa-twitter fw-normal"></i></a>
                        <a class="btn btn-primary btn-square me-2" href="https://www.facebook.com/Admin.KKP.Pontianak"
                            target="blank"><i class="fab fa-facebook-f fw-normal"></i></a>
                    </div>
                </div>
                <div class="col-lg-5" style="min-height: 400px;">
                    <div class="position-relative h-100 shadow">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s"
                            src="{{ asset('frontend/img/image.png') }}" style="object-fit: cover;">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h3 class="fw-bold text-primary text-uppercase">Jika ada pertanyaan anda bisa menghubungi kami dengan cara
                    mengisi form dibawah ini</h3>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                    <form action="{{ route('kontak.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">

                            {{-- Nama --}}
                            <div class="col-md-6">
                                <input type="text" name="nama"
                                    class="form-control border-0 bg-light px-4 @error('nama') is-invalid @enderror"
                                    placeholder="Masukan Nama" style="height: 55px;" value="{{ old('nama') }}" required>

                                @error('nama')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <input type="email" name="email"
                                    class="form-control border-0 bg-light px-4 @error('email') is-invalid @enderror"
                                    placeholder="Masukan Email" style="height: 55px;" value="{{ old('email') }}" required>

                                @error('email')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Pesan --}}
                            <div class="col-12">
                                <textarea name="pesan" class="form-control border-0 bg-light px-4 py-3 @error('pesan') is-invalid @enderror"
                                    rows="4" placeholder="Masukan Pertanyaan" required>{{ old('pesan') }}</textarea>

                                @error('pesan')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Button --}}
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">
                                    Kirim Pertanyaan
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
                    <iframe class="position-relative rounded w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7979.615126851328!2d109.39814519357907!3d-0.1330469999999918!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d50235e926d8f%3A0xb360d28cf24e43ac!2sBalai%20Kekarantinaan%20Kesehatan%20Kelas%20I%20Pontianak!5e0!3m2!1sid!2sid!4v1764179846444!5m2!1sid!2sid"
                        frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h3 class="fw-bold text-primary text-uppercase">
                    Jika ada pertanyaan anda bisa menghubungi kami dengan cara
                    mengisi form dibawah ini
                </h3>
            </div>

            <div class="row g-5">

                <!-- GOOGLE FORM -->
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">

                    <div class="card shadow h-100">
                        <div class="card-body p-2">

                            <form action="{{ route('kontak.store') }}" method="POST">
                                @csrf

                                <div class="mb-3 ">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control ">
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Pesan</label>
                                    <textarea name="pesan" class="form-control"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Kirim
                                </button>
                            </form>

                        </div>
                    </div>

                </div>

                <!-- GOOGLE MAP -->
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
                    <iframe class="position-relative rounded w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7979.615126851328!2d109.39814519357907!3d-0.1330469999999918!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d50235e926d8f%3A0xb360d28cf24e43ac!2sBalai%20Kekarantinaan%20Kesehatan%20Kelas%20I%20Pontianak!5e0!3m2!1sid!2sid!4v1764179846444!5m2!1sid!2sid"
                        frameborder="0" style="min-height: 600px; border:0;" allowfullscreen="">
                    </iframe>
                </div>

            </div>
        </div>
    </div> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Pertanyaan berhasil dikirim. Kami akan segera menindaklanjutinya melalui email Anda.',
                text: 'Kami akan segera menindaklanjutinya melalui email Anda.',
                confirmButtonColor: '#0d6efd',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
