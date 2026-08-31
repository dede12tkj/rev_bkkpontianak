@extends('layouts.detail')

@section('title', $dashboard->nama)
@section('title-navbar', $dashboard->nama)

@section('content')
    <div class="container py-5">

        <a href="{{ route('bedesut.show', $dashboard->id) }}" class="btn btn-secondary mb-4">
            ← Kembali
        </a>
        
        <h1>{{ $dashboard->nama }}</h1>

        @if ($dashboard->bedesut)
            <p class="text-muted">
                {{ $dashboard->bedesut->nama }}
            </p>
        @endif


        {{-- THUMBNAIL --}}
        {{-- @if ($dashboard->thumbnail)
        <div class="text-center mb-4">
            <img src="{{ asset('storage/'.$dashboard->thumbnail) }}"
                 class="img-fluid rounded shadow"
                 style="max-height:400px">
        </div>
    @endif --}}

        {{-- ISI KONTEN --}}
        <div class="content">
            {!! $dashboard->text !!}
        </div>

        {{-- LINK LOOKER --}}
        @if ($dashboard->link_looker)
            <div class="text-center mt-4">
                <a href="{{ $dashboard->link_looker }}" target="_blank" class="btn btn-success">
                    Buka Dashboard Interaktif
                </a>
            </div>
        @endif

    </div>
@endsection
