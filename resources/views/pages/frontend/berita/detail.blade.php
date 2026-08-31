@extends('layouts.detail')

@section('title', $berita->judul)
@section('title-navbar', $berita->judul)

@section('content')
    <div class="container py-5">
        <div class="row g-4">

            <!-- ================= KONTEN ================= -->
            <div class="col-lg-8">

                <!-- HEADER -->
                <div class="mb-4">
                    <h1 class="fw-bold">{{ $berita->judul }}</h1>

                    <div class="text-muted mb-2">
                        <i class="fa fa-calendar"></i>
                        {{ \Carbon\Carbon::parse($berita->published_at)->translatedFormat('d F Y') }}

                        &nbsp; | &nbsp;

                        <i class="fa fa-eye"></i>
                        {{ $berita->views }} views
                    </div>
                </div>

                <!-- THUMBNAIL -->
                @if ($berita->thumbnail)
                    <img src="{{ asset('storage/' . $berita->thumbnail) }}" class="d-block mx-auto rounded mb-4 shadow-sm"
                        style="max-width:100%; height:auto;">
                @endif

                <!-- ISI -->
                <div class="konten-berita mb-5">
                    {!! $berita->konten !!}
                </div>

                <!-- ================= TERKAIT ================= -->
                <div class="mt-5">
                    <h4 class="mb-3 fw-bold border-bottom pb-2">Berita Terkait</h4>

                    <div class="row g-3">
                        @forelse ($terkait as $item)
                            <div class="col-md-6">
                                <div class="card shadow border-0 h-100">

                                    @if ($item->thumbnail)
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ asset('storage/' . $item->thumbnail) }}" class="card-img-top"
                                                style="height:150px; object-fit:cover;">
                                        </div>
                                    @endif

                                    <div class="card-body">
                                        <a href="{{ route('berita.show', $item->slug) }}"
                                            class="fw-semibold text-dark text-decoration-none">
                                            {{ \Str::limit($item->judul, 70) }}
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Tidak ada berita terkait</p>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- ================= SIDEBAR ================= -->
            <div class="col-lg-4">

                <!-- 🔥 POPULER -->
                <div class="card shadow mb-4">
                    <div class="card-header bg-danger text-white">
                        🔥 Berita Populer
                    </div>
                    <div class="card-body">

                        @foreach ($populer as $item)
                            <div class="d-flex mb-3">
                                @if ($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                        style="width:70px;height:60px;object-fit:cover;border-radius:5px;">
                                @endif

                                <div class="ms-2">
                                    <a href="{{ route('user-berita.show', $item->slug) }}"
                                        class="text-dark fw-semibold text-decoration-none">
                                        {{ \Str::limit($item->judul, 50) }}
                                    </a>

                                    <small class="text-muted d-block">
                                        👁 {{ $item->views }}
                                    </small>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- 🆕 TERBARU -->
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        🆕 Berita Terbaru
                    </div>
                    <div class="card-body">

                        @foreach ($terbaru as $item)
                            <div class="mb-3 border-bottom pb-2">
                                <a href="{{ route('berita.show', $item->slug) }}"
                                    class="text-dark fw-semibold text-decoration-none">
                                    {{ \Str::limit($item->judul, 60) }}
                                </a>

                                <small class="text-muted d-block">
                                    {{ \Carbon\Carbon::parse($item->published_at)->translatedFormat('d M Y') }}
                                </small>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>

        </div>
    </div>

    <style>
        .konten-berita img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
        }

        .card:hover {
            transform: translateY(-3px);
            transition: 0.2s;
        }
    </style>
@endsection
