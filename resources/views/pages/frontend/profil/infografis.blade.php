@extends('layouts.detail')
@section('title')
    Infografis SDM
@endsection
@section('title-navbar')
    Infografis SDM
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class=" text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Infografis SDM</h5>
                <h1 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h1>
            </div>
            <div class="mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        {{-- <img class="d-block mx-auto mb-3" style="width: 40%;"
                            src="{{ asset('frontend/img/logokemenkes.png') }}" alt="Logo Kemenkes">
                        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto"
                            style="max-width: 600px;">
                            <h3>Wilayah Kerja</h3>
                        </div> --}}
                        <iframe  width="100%" height="580"
                            src="https://lookerstudio.google.com/embed/reporting/c37d60e5-8a67-4cf5-bd80-aecf694d71b5/page/vHZaD"
                            frameborder="0" style="border:0" allowfullscreen
                            sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>
                    </div>
                </div>
            </div>
            {{-- <div class="mb-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <iframe id="googleMap" src="https://www.google.com/maps/d/embed?mid=118NmmtW-hcRa1YNvFqeVD7zeqXvPmQKx&ehbc=2E312F"
                                width="100%" height="480"></iframe>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
