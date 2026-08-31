@extends('layouts.detail')
@section('title')
    Detail
@endsection
@section('title-navbar')
    Detail Pelayanan
@endsection
@section('content')
    <div class="container-fluid">
        <a href="{{ route('standar-pelayanan') }}" class="btn btn-secondary btn-sm mt-4 mb-4">
                ← Kembali
            </a>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3" class="text-center">{{ $data->nama }}</h1>

        </div>

        <div class="card shadow">
            <div class="card-body d-flex justify-content-center align-items-center text-center">
                {!! $data->text !!}
            </div>
        </div>
    </div>
@endsection
