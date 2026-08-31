@extends('layouts.detail')
@section('title')
    Artikel
@endsection
@section('title-navbar')
    Artikel
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            {{-- <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h1 class="mb-0">Artikel</h1>
            </div> --}}
            <div class="row">
                @foreach ($data as $item)
                    <div class="col-lg-3 mb-4">
                        <a href="{{ route('artikel-detail.show', $item->slug) }}" style="text-decoration:none; color:inherit;">
                            <div class="service-card haji-card shadow">
                                <div class="haji-card-img">
                                    <img
                                        src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('frontend/img/default.png') }}">
                                </div>

                                <div class="haji-card-body">
                                    <h6 class="text-center">
                                        {{ $item->judul }}
                                    </h6>
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
