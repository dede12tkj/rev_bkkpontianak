@extends('layouts.detail')
@section('title')
    Maklumat Pelayanan
@endsection
@section('title-navbar')
    Maklumat Pelayanan
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $gambar->path) }}" alt="Maklumat Pelayanan"
                            style="max-width: 100%; border-radius: 5px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
