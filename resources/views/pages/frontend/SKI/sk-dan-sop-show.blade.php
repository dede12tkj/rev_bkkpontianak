@extends('layouts.detail')

@section('title', $data->nama)

@section('title-navbar')
    SK & SOP
@endsection

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DEARFLIP CSS -->
    <link rel="stylesheet" href="{{ asset('dearflip/assets/css/dflip.min.css') }}">

    <!-- DEARFLIP JS -->
    <script src="{{ asset('dearflip/assets/js/dflip.min.js') }}"></script>
    <div class="container-fluid">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3 mt-3">
            ← Kembali
        </a>
        <div class="d-flex align-items-center mb-3">

            <h1 class="h3 mb-0">{{ $data->nama }}</h1>


        </div>

        <div class="card-body">
                <div class="_df_book" height="600" webgl="true" source="{{ asset('storage/' . $data->file_pdf) }}">
                </div>
            </div>
    </div>
@endsection
