@extends('layouts.detail')
@section('title')
    Benturan Kepentingan
@endsection
@section('title-navbar')
    Benturan Kepentingan
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h1 class="mb-0">Benturan Kepentingan</h1>
            </div>
            @forelse ($data as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $item->id }}" aria-expanded="false"
                            aria-controls="collapse{{ $item->id }}">
                            {{ $item->nama }}
                        </button>
                    </h2>

                    <div id="collapse{{ $item->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $item->id }}" data-bs-parent="#accordionGabungan">

                        <div class="accordion-body">
                            {!! $item->text !!}
                        </div>

                    </div>
                </div>
            @empty
                <div class="text-center text-muted">
                    Data Benturan Kepentingan belum tersedia
                </div>
            @endforelse

            {{-- Alert Success --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    {{ session('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                    </button>

                </div>
            @endif

            {{-- @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '{{ session('success') }}',
                        confirmButtonColor: '#007C85',
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif --}}

            {{-- Form --}}
            <div class="card border-0 shadow-sm mt-8">
                <div class="p-4">
                    <h3>FORMULIR LAPORAN BENTURAN KEPENTINGAN</h3>
                    <p>Benturan kepentingan adalah situasi dimana terdapat konflik kepentingan seseorang yang memanfaatkan
                        kedudukan dan wewenang yang dimilikinya (baik dengan sengaja maupun tidak sengaja) untuk kepentingan
                        pribadi, keluarga, atau golongannya sehingga tugas yang diamanatkan tidak dapat dilaksanakan dengan
                        obyektif dan berpotensi menimbulkan kerugian.</p>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('benturan-kepentingan-user.store') }}" method="POST">

                        @csrf

                        <div class="row g-4">

                            {{-- Nama Lengkap --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Nama Lengkap
                                </label>

                                <input type="text" name="nama_lengkap"
                                    class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    value="{{ old('nama_lengkap') }}" required>

                                @error('nama_lengkap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Jabatan --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Jabatan
                                </label>

                                <input type="text" name="jabatan"
                                    class="form-control @error('jabatan') is-invalid @enderror"
                                    value="{{ old('jabatan') }}" required>

                                @error('jabatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Unit Kerja --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Unit Kerja
                                </label>

                                <input type="text" name="unit_kerja"
                                    class="form-control @error('unit_kerja') is-invalid @enderror"
                                    value="{{ old('unit_kerja') }}" required>

                                @error('unit_kerja')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Email
                                </label>

                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    required>

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Uraian Konflik --}}
                            <div class="col-12">

                                <label class="form-label">
                                    Uraian Konflik
                                </label>

                                <textarea name="uraian_konflik" rows="4" class="form-control @error('uraian_konflik') is-invalid @enderror"
                                    required>{{ old('uraian_konflik') }}</textarea>

                                @error('uraian_konflik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Kepentingan --}}
                            <div class="col-12">

                                <label class="form-label">
                                    Kepentingan
                                </label>

                                <textarea name="kepentingan" rows="4" class="form-control @error('kepentingan') is-invalid @enderror" required>{{ old('kepentingan') }}</textarea>

                                @error('kepentingan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Penyebab --}}
                            <div class="col-12">

                                <label class="form-label">
                                    Penyebab
                                </label>

                                <textarea name="penyebab" rows="4" class="form-control @error('penyebab') is-invalid @enderror" required>{{ old('penyebab') }}</textarea>

                                @error('penyebab')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Tempat Laporan --}}
                            <div class="col-12">

                                <label class="form-label">
                                    Tempat Laporan
                                </label>

                                <input type="text" name="tempat_laporan"
                                    class="form-control @error('tempat_laporan') is-invalid @enderror"
                                    value="{{ old('tempat_laporan') }}" required>

                                @error('tempat_laporan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Button --}}
                            <div class="col-12 text-center">

                                <button type="submit" class="btn btn-primary px-5 py-3">

                                    Kirim Laporan

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
