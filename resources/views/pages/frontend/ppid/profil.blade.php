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
            <div class="row text-center">

                <div class="col-lg-3 col-md-6 mb-3">
                    <a id="btn-profil-singkat" href="javascript:void(0)"
                        class="btn btn-kemenkes btn-lg text-white w-100 shadow menu-btn">
                        Profil Singkat
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <a id="btn-tugas-fungsi" href="javascript:void(0)"
                        class="btn btn-kemenkes btn-lg text-white w-100 shadow menu-btn">
                        Tugas & Fungsi
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <a id="btn-struktur-organisasi" href="javascript:void(0)"
                        class="btn btn-kemenkes btn-lg text-white w-100 shadow menu-btn">
                        Struktur Organisasi
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <a id="btn-visi-misi" href="javascript:void(0)" class="btn btn-kemenkes btn-lg text-white w-100 shadow menu-btn">
                        Visi & Misi
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
        document.getElementById("btn-profil-singkat").addEventListener("click", function() {
            setActive('btn-profil-singkat');
            fetch("{{ route('ppid.profil-singkat') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById("konten-dinamis").innerHTML = html;
                });
        });

        document.getElementById("btn-tugas-fungsi").addEventListener("click", function() {
            setActive('btn-tugas-fungsi');
            fetch("{{ route('ppid.tugas-fungsi') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById("konten-dinamis").innerHTML = html;
                });
        });

        document.getElementById("btn-struktur-organisasi").addEventListener("click", function() {
            setActive('btn-struktur-organisasi');
            fetch("{{ route('ppid.struktur-organisasi') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById("konten-dinamis").innerHTML = html;
                });
        });

        document.getElementById("btn-visi-misi").addEventListener("click", function() {
            setActive('btn-visi-misi');
            fetch("{{ route('ppid.visi-misi') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById("konten-dinamis").innerHTML = html;
                });
        });
    </script>
@endsection
