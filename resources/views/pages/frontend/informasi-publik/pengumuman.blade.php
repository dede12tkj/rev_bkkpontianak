@extends('layouts.detail')
@section('title')
    Pengumuman
@endsection
@section('title-navbar')
    Pengumuman
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            {{-- <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h1 class="mb-0">Artikel</h1>
            </div> --}}
            <div class="row">

                @forelse ($pengumuman as $item)
                    <div class="col-lg-3 mb-4">

                        <a href="{{ route('pengumuman.show', $item->id) }}" class="text-decoration-none text-dark">
                            <div class="service-card haji-card shadow h-100 position-relative">

                                <div class="haji-card-img">
                                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('frontend/img/default.png') }}"
                                        alt="Pengumuman">
                                </div>

                                <small class="text-muted d-block text-center mt-2">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </small>
                                <div class="card-body">
                                    <h6 class="text-center">
                                        {{ $item->judul }}
                                    </h6>
                                </div>

                            </div>
                        </a>

                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada pengumuman</p>
                    </div>
                @endforelse

            </div>

        </div>
    </div>
@endsection
