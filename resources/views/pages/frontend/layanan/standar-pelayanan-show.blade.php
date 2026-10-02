@extends('layouts.detail')
@section('title')
    Detail
@endsection
@section('title-navbar')
    Detail Pelayanan
@endsection
@section('content')
    <style>
        .konten-layanan { text-align: left; overflow-wrap: anywhere; }
        .konten-layanan img { max-width: 100%; height: auto; }
        .konten-layanan table { width: 100%; }
        .konten-layanan h3 { margin-top: 1.5rem; }
        .konten-layanan h4 { margin-top: 1.25rem; }
        .konten-layanan .table-responsive, .konten-layanan table { display: block; overflow-x: auto; }
    </style>
    <div class="container-fluid">
        <a href="{{ route('standar-pelayanan') }}" class="btn btn-secondary btn-sm mt-4 mb-4">
                ← Kembali
            </a>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">{{ $data->nama }}</h1>

        </div>

        <div class="card shadow">
            <div class="card-body konten-layanan">
                {!! $data->text !!}
            </div>
        </div>
    </div>
@endsection
