@extends('layouts.detail')

@section('title')
    {{ $item->judul }}
@endsection

@section('title-navbar')
    {{ $item->judul }}
@endsection

@section('content')
<div class="container py-5">

    <div class="text-center mb-4">
        <h6 class="text-primary">
            {{ $item->kategori_label }} - {{ $item->tahun }}
        </h6>

        <h2>{{ $item->judul }}</h2>
    </div>

    <div class="card shadow">
        <div class="card-body">

            {{-- STYLE SUMMERNOTE --}}
            <style>
                .konten-survey img {
                    max-width: 100%;
                    height: auto;
                    display: block;
                    margin: 10px auto;
                }
            </style>

            {{-- ISI --}}
            <div class="konten-survey">
                {!! $item->isi !!}
            </div>

            {{-- DOWNLOAD PDF --}}
            @if($item->laporan)
                <div class="text-center mt-4">
                    <a href="{{ asset('storage/'.$item->laporan) }}" target="_blank"
                        class="btn btn-primary">
                        <i class="fa fa-download"></i> Download Laporan
                    </a>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection
