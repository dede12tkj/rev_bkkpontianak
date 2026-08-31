@extends('layouts.detail')

@section('title', 'Sunmore Detail')

@section('title-navbar')
    {{ $data->nama }}
@endsection

@section('content')
    <!-- JQUERY (WAJIB) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DEARFLIP CSS -->
    <link rel="stylesheet" href="{{ asset('dearflip/assets/css/dflip.min.css') }}">

    <!-- DEARFLIP JS -->
    <script src="{{ asset('dearflip/assets/js/dflip.min.js') }}"></script>

    <div class="container py-5">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3 mb-3">
                ← Kembali
            </a>
        <div class="d-flex align-items-center mb-3">

            <h1 class="h3 mb-0">{{ $data->nama }}</h1>


        </div>

        <div class="card shadow">
            <div class="card-body">
                <div class="_df_book" height="600" webgl="true" source="{{ asset('storage/' . $data->path_pdf) }}">
                </div>
            </div>
        </div>
    </div>

@endsection
