@extends('layouts.detail')

@section('title')
    {{ $item->judul }}
@endsection

@section('title-navbar')
    {{ $item->judul }}
@endsection

@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">

            {{-- HEADER --}}
            <div class="text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 700px;">

                {{-- TANGGAL --}}
                <h6 class="fw-bold text-primary text-uppercase">
                    {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') : '-' }}
                </h6>

                {{-- JUDUL --}}
                <h1 class="mb-2">{{ $item->judul }}</h1>

                {{-- STATUS & PENTING --}}
                {{-- <p class="text-muted">
                    @if($item->is_penting)
                        <span class="badge bg-danger">Pengumuman Penting</span>
                    @endif

                    &nbsp;

                    @if($item->status == 'published')
                        <span class="badge bg-success">Published</span>
                    @else
                        <span class="badge bg-secondary">Draft</span>
                    @endif
                </p> --}}

            </div>

            {{-- KONTEN --}}
            <div class="mb-4">
                <div class="card shadow">
                    <div class="card-body" style="overflow:hidden;">

                        {{-- GAMBAR --}}
                        @if ($item->gambar)
                            <img class="d-block mx-auto mb-4"
                                style="max-width:40%; height:auto; border-radius:10px;"
                                src="{{ asset('storage/' . $item->gambar) }}">
                        @endif

                        {{-- STYLE SUMMERNOTE --}}
                        <style>
                            .konten-pengumuman img {
                                max-width: 100%;
                                height: auto;
                                display: block;
                                margin: 10px auto;
                            }
                        </style>

                        {{-- ISI --}}
                        <div class="konten-pengumuman">
                            {!! $item->isi !!}
                        </div>

                        {{-- FILE DOWNLOAD --}}
                        @if ($item->file)
                            <div class="mt-4 text-center">
                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                    class="btn btn-primary">
                                    <i class="fa fa-download me-1"></i> Download Lampiran
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
