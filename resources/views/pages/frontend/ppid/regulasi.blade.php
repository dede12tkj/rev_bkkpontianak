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

                <div class="col-lg-4 col-md-7 mb-3">
                    <a id="btn-kip" href="javascript:void(0)"
                        class="btn btn-kemenkes btn-lg text-white w-100 shadow menu-btn">
                        Regulasi KIP
                    </a>
                </div>

                <div class="col-lg-4 col-md-7 mb-3">
                    <a id="btn-kemenkes" href="javascript:void(0)"
                        class="btn btn-kemenkes btn-lg text-white w-100 shadow menu-btn">
                        Regulasi Kemenkes
                    </a>
                </div>

                <div class="col-lg-4 col-md-7 mb-3">
                    <a id="btn-sop" href="javascript:void(0)"
                        class="btn btn-kemenkes btn-lg text-white w-100 shadow menu-btn">
                        SOP Keterbukaan Informasi
                    </a>
                </div>

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
        document.getElementById("btn-kip").addEventListener("click", function() {
            setActive('btn-kip');
            fetch("{{ route('ppid.regulasi.kip') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById("konten-dinamis").innerHTML = html;
                });
        });

        document.getElementById("btn-kemenkes").addEventListener("click", function() {
            setActive('btn-kemenkes');
            fetch("{{ route('ppid.regulasi.kemenkes') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById("konten-dinamis").innerHTML = html;
                });
        });

        document.getElementById("btn-sop").addEventListener("click", function() {
            setActive('btn-sop');
            fetch("{{ route('ppid.regulasi.sop') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById("konten-dinamis").innerHTML = html;
                });
        });

    </script>
@endsection
