@extends('layouts.detail')
@section('title')
    PPID
@endsection
@section('title-navbar')
    PPID BALAI KEKARANTINAAN KESEHATAN KELAS I PONTIANAK
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto">
                <h1 class="mb-0">SELAMAT DATANG DI LAYANAN E-PPID BALAI KEKARANTINAAN KESEHATAN KELAS I PONTIANAK</h1>
                <p>Layanan ini merupakan sarana layanan online bagi pemohon informasi publik sebagai salah satu wujud
                    pelaksanaan keterbukaan informasi publik pada Balai Kekarantinaan Kesehatan Kelas I Pontianak </p>
            </div>
            @include('includes.frontend.ppid')
            <hr>
            <div class="row justify-content-center text-center">
                @foreach ($standarLayanan as $item)
                    <div class="col-lg-4 col-md-7 mb-3">

                        <a href="javascript:void(0)" class="btn btn-white btn-lg text-white w-100 shadow menu-btn btn-standar"
                            data-id="{{ $item->id }}">

                            <img style="width:100%" src="{{ asset('storage/' . $item->path_judul) }}"
                                alt="{{ $item->judul }}">

                        </a>

                    </div>
                @endforeach


            </div>

            <hr>
            <div id="konten-dinamis" class="mt-3"></div>
        </div>
    </div>
    <script>
        function setActive(id) {
            document.querySelectorAll('.menu-btn').forEach(btn => {
                btn.classList.remove('active');
            });

            document.getElementById(id).classList.add('active');
        }
        document.querySelectorAll('.btn-standar').forEach(function(btn) {

            btn.addEventListener('click', function() {

                let id = this.getAttribute('data-id');

                fetch(`/informasi-publik/ppid/standar-layanan/${id}`)
                    .then(res => res.text())
                    .then(html => {

                        document.getElementById('konten-dinamis').innerHTML = html;

                    });

            });

        });
    </script>
@endsection
