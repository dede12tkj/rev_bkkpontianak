@extends('layouts.detail')
@section('title')
    Pengaduan Layanan Masyarakat
@endsection
@section('title-navbar')
    Pengaduan Layanan Masyarakat
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Pengaduan Layanan Masyarakat</h5>
                <h1 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h1>
            </div>

            <div class="row">
                <!-- Misi Card -->
                <div class="col-lg-6 mb-4">
                    <img class="d-block mx-auto mb-3" style="width: 40%;"
                        src="{{ asset('frontend/img/customer-service.png') }}">
                    <h5 class="card-title text-center">Prosedur Pengaduan Masyarakat Balai Kekarantinaan Kesehatan
                        Kelas I Pontianak</h5>
                    <ol>
                        <li>Pengaduan dapat diajukan oleh Masyarakat secara Perorangan atau Kelompok Masyarakat.
                        </li>

                        <li>Setiap Pelapor wajib mengisikan Registrasi Pengaduan yang disediakan melalui Portal
                            Website
                            Balai Kekarantinaan Kesehatan Kelas I Pontianak atau dapat langsung mengunjungi Balai
                            Kekarantinaan Kesehatan Kelas I Pontianak.</li>

                        <li>Setiap pengaduan yang telah diregistrasikan akan diterima oleh Unit Pelayanan untuk
                            diverifikasi sesuai dengan substansi pada unit kerja di lingkup Balai Kekarantinaan
                            Kesehatan Kelas I Pontianak.</li>

                        <li>Laporan atas pengaduan tersebut akan ditindak lanjuti secara langsung oleh Unit Kerja
                            Balai
                            Kekarantinaan Kesehatan Kelas I Pontianak terkait dengan substansi permasalahan yang
                            diadukan tersebut.</li>

                        <li>Laporan pengaduan yang diajukan akan ditindak lanjuti dalam jangka waktu penyelesaian
                            selama
                            30 hari kerja dengan memperhatikan kembali kelengkapan berkas yang ada.</li>

                        <li>Setiap laporan pengaduan tidak dikenakan biaya.</li>
                    </ol>
                </div>


                {{-- Form --}}
                <div class="col-lg-6 mb-4">

                    <div class="card shadow border-0">

                        <div class="card-body p-4">

                            <h3 class="card-title text-center mt-3 mb-3">
                                Form Layanan Pengaduan Masyarakat
                            </h3>

                            <p class="text-muted">
                                Pengaduan Anda akan membantu kami dalam meningkatkan kualitas pelayanan.
                                Jika terdapat pertanyaan lain, silakan hubungi kami melalui halaman Kontak Kami.
                            </p>

                            {{-- Alert Validation --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">

                                    <ul class="mb-0">

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach

                                    </ul>

                                </div>
                            @endif

                            {{-- Form --}}
                            <form action="{{ route('layanan-pengaduan-masyarakat-user.store') }}" method="POST">

                                @csrf

                                <div class="row g-3">

                                    {{-- Nama --}}
                                    <div class="col-12">

                                        <label class="form-label">
                                            Nama / Inisial
                                        </label>

                                        <input type="text" name="nama" class="form-control"
                                            value="{{ old('nama') }}" required>

                                    </div>

                                    {{-- Jenis Kelamin --}}
                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Jenis Kelamin
                                        </label>

                                        <select name="jenis_kelamin" class="form-select" required>

                                            <option value="">
                                                -- Pilih --
                                            </option>

                                            <option value="Laki-laki"
                                                {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                                Laki-laki
                                            </option>

                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan
                                            </option>

                                        </select>

                                    </div>

                                    {{-- Usia --}}
                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Usia
                                        </label>

                                        <input type="number" name="usia" class="form-control"
                                            value="{{ old('usia') }}" required>

                                    </div>

                                    {{-- Pengaduan --}}
                                    <div class="col-12">

                                        <label class="form-label">
                                            Permasalahan / Pengaduan
                                        </label>

                                        <textarea name="permasalahan_pengaduan" rows="5" class="form-control" required>{{ old('permasalahan_pengaduan') }}</textarea>

                                    </div>

                                    {{-- Button --}}
                                    <div class="col-12">

                                        <button type="submit" class="btn btn-primary w-100 py-2">

                                            Kirim Pengaduan

                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonColor: "#007C85",
                confirmButtonText: "OK"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonColor: "#d33",
                confirmButtonText: "OK"
            });
        </script>
    @endif
@endsection
