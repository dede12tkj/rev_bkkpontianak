@extends('layouts.detail')

@section('title')
    Panduan SKI
@endsection

@section('title-navbar')
    Panduan Satuan Kepatuhan Internal
@endsection

@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">

            <!-- HEADER -->
            <div class="text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 700px;">
                <h5 class="fw-bold text-primary text-uppercase">Panduan Satuan Kepatuhan Internal</h5>
                <h1 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h1>
            </div>

            <!-- LIST FILE -->
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">

                    <ul class="list-group list-group-flush">

                        @forelse ($data as $index => $item)
                            <li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-file-pdf text-danger me-3 fs-4"></i>

                                <a href="{{ $item->link_drive }}" target="_blank" class="text-decoration-none">

                                    {{ $index + 1 }}. {{ strtoupper($item->nama) }}
                                </a>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">
                                Data belum tersedia
                            </li>
                        @endforelse

                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
