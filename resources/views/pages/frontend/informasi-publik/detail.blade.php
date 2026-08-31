@extends('layouts.detail')

@section('title')
    {{ $artikel->judul }}
@endsection

@section('title-navbar')
    {{ $artikel->judul }}
@endsection

@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">

            {{-- HEADER --}}
            <div class="text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 700px;">

                {{-- TANGGAL --}}
                <h6 class="fw-bold text-primary text-uppercase">
                    {{ $artikel->tanggal ? \Carbon\Carbon::parse($artikel->tanggal)->translatedFormat('d F Y') : '-' }}
                </h6>

                {{-- JUDUL --}}
                <h1 class="mb-2">{{ $artikel->judul }}</h1>

                {{-- PENULIS --}}
                <p class="text-muted">
                    <i class="fa fa-user me-1"></i> {{ $artikel->oleh }}
                    &nbsp; | &nbsp;
                    <i class="fa fa-eye me-1"></i> {{ $artikel->views }}
                </p>

            </div>

            {{-- KONTEN --}}
            <div class="mb-4">
                <div class="card shadow">
                    <div class="card-body" style="overflow:hidden;">

                        {{-- THUMBNAIL --}}
                        @if ($artikel->thumbnail)
                            <img class="d-block mx-auto mb-4" style="max-width:30%; height:auto; border-radius:10px;"
                                src="{{ asset('storage/' . $artikel->thumbnail) }}">
                        @endif

                        {{-- STYLE AGAR GAMBAR SUMMERNOTE RAPI --}}
                        <style>
                            .konten-artikel img {
                                max-width: 100%;
                                height: auto;
                                display: block;
                                margin: 10px auto;
                            }
                        </style>

                        {{-- ISI ARTIKEL --}}
                        <div class="konten-artikel">
                            {!! $artikel->konten !!}
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
