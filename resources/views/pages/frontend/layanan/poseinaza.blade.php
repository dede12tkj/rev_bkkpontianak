@extends('layouts.detail')
@section('title')
    POSEin Aza
@endsection
@section('title-navbar')
    POSEin Aza
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class=" text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h1 class="fw-bold text-primary text-uppercase">Pojok Sertifikat Izin Angkut Jenazah</h1>
                <h5 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h5>
            </div>
            <div class="mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        @forelse($poseins as $item)
                            <div class="mb-4">
                                {!! $item->content !!}
                            </div>
                        @empty
                            <p>Tidak ada data</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
