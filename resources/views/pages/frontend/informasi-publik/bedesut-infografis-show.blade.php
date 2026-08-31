@extends('layouts.detail')

@section('title', $infografis->nama)
@section('title-navbar', $infografis->nama)

@section('content')
<div class="container py-5">

    <a href="{{ route('bedesut.show', $infografis->id) }}" class="btn btn-secondary mb-4">
        ← Kembali
    </a>

    <h1 class="mb-3">{{ $infografis->nama }}</h1>

    @if ($infografis->thumbnail)
        <img src="{{ asset('storage/'.$infografis->thumbnail) }}"
             class="img-fluid mb-4">
    @endif

    <div class="content">
        {!! $infografis->text !!}
    </div>


</div>
@endsection
