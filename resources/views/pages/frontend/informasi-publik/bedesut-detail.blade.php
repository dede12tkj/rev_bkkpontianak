@extends('layouts.detail')

@section('title', $data->nama)

@section('content')
    <div class="container py-5">

        <h2 class="text-center mb-4">{{ $data->nama }}</h2>

        {{-- THUMBNAIL --}}
        @if (
    $data->thumbnail &&
    !in_array($data->konten_type, [
        'App\Models\Sunmore',
        'App\Models\Buletin'
    ])
)
    <div class="text-center mb-4">
        <img src="{{ asset('storage/' . $data->thumbnail) }}" class="img-fluid rounded">
    </div>
@endif

        {{-- KONTEN --}}
        <div class="mt-4">

            {{-- DASHBOARD --}}
            @if ($data->konten_type === 'App\Models\DashboardInteraktif')
                <iframe src="{{ $data->konten->link_looker }}" width="100%" height="600"></iframe>

                {{-- INFOGRAFIS --}}
            @elseif ($data->konten_type === 'App\Models\Infografis')
                <div>
                    {!! $data->konten->text !!}
                </div>

                {{-- SUNMORE / BULETIN --}}
            @elseif ($data->konten_type === 'App\Models\Sunmore' || $data->konten_type === 'App\Models\Buletin')
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DEARFLIP CSS -->
    <link rel="stylesheet" href="{{ asset('dearflip/assets/css/dflip.min.css') }}">

    <!-- DEARFLIP JS -->
    <script src="{{ asset('dearflip/assets/js/dflip.min.js') }}"></script>
            <div class="_df_book" source="{{ asset('storage/' . $data->konten->file) }}" style="height: 600px;">
                </div>
            @endif

        </div>

    </div>
@endsection
