@extends('layouts.detail')
@section('title')
    Visi dan Misi
@endsection
@section('title-navbar')
    Visi dan Misi
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Visi dan Misi</h5>
                <h1 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h1>
            </div>
            <div class="mb-4">
                <!-- Visi Card -->
                <div class="card shadow">
                    <div class="card-body text-center">
                        <img class="m-auto" style="width: 40%;" src="{{ asset('frontend/img/logokemenkes.png') }}"
                            alt="Logo Kemenkes">
                        <h5 class="card-title">Visi Kementerian Kesehatan</h5>
                        {!! $visi->visi !!}
                    </div>
                </div>

            </div>

            <div class="row">
                <!-- Misi Card -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow">
                        <div style="height: 350px" class="card-body">
                            <img class="d-block mx-auto mb-3" style="width: 20%;" src="{{ asset('frontend/img/goal.png') }}">
                            <h5 class="card-title text-center">Misi Kementerian Kesehatan</h5>
                             {!! $visi->misi !!}
                        </div>
                    </div>
                </div>

                <!-- Tujuan Strategis Card -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow">
                        <div style="height: 350px" class="card-body">
                            <img class="d-block mx-auto mb-3" style="width: 20%;" src="{{ asset('frontend/img/leadership.png') }}">
                            <h5 class="card-title text-center">Tujuan Strategis Kementerian Kesehatan</h5>
                             {!! $visi->tujuan !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
