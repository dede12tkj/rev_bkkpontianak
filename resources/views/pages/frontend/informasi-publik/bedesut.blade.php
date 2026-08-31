@extends('layouts.detail')
@section('title')
    BEDESUT
@endsection
@section('title-navbar')
    BEDESUT
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h1 class="mb-0">BEDESUT</h1>
                <h5 class="fw-bold text-primary text-uppercase">Berita dan Diseminasi Surveilans di Pintu Masuk</h5>
            </div>
            <div class="row">

                @foreach ($data as $tipe => $items)
                    @php
                        $first = $items->first();

                        $thumb = match ($tipe) {
                            'Infografis' => $first && $first->thumbnail
                                ? asset('storage/' . $first->thumbnail)
                                : asset('frontend/img/infografis.jpg'),

                            'DashboardInteraktif' => asset('frontend/img/dashboard.jpg'),

                            'Sunmore' => asset('frontend/img/sunmore21.png'),

                            'Buletin' => asset('frontend/img/buletincuy.png'),

                            default => asset('frontend/img/default.png'),
                        };

                        $judul = match ($tipe) {
                            'DashboardInteraktif' => 'DASHBOARD INTERAKTIF',
                            default => strtoupper($tipe),
                        };
                    @endphp

                    <div class="col-lg-3 col-md-6 mb-4">
                        <a href="{{ route('bedesut.tipe', strtolower($tipe)) }}" class="text-decoration-none">
                            <div class="service-card haji-card shadow h-100 text-center">

                                {{-- GAMBAR --}}
                                <div class="haji-card-img">
                                    <img src="{{ $thumb }}" class="img-fluid">
                                </div>

                                {{-- JUDUL --}}
                                <div class="haji-card-body d-flex flex-column">
                                    <h5 class="text-dark">{{ $judul }}</h5>

                                    <small class="text-muted">
                                        {{ $items->count() }} Data
                                    </small>
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
@endsection
