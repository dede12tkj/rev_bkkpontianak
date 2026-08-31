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
                    <a id="btn-ipb" href="javascript:void(0)"
                        class="btn btn-kemenkes btn-lg text-white w-100 shadow menu-btn">

                        Informasi Publik Berkala
                    </a>
                </div>

                <div class="col-lg-4 col-md-7 mb-3">
                    <a id="btn-iptss" href="javascript:void(0)"
                        class="btn btn-kemenkes btn-lg text-white w-100 shadow menu-btn">
                        Informasi Publik Tersedia Setiap Saat
                    </a>
                </div>

                <div class="col-lg-4 col-md-7 mb-3">
                    <a id="btn-ipsm" href="javascript:void(0)"
                        class="btn btn-kemenkes btn-lg text-white w-100 shadow menu-btn">
                        Informasi Publik Serta Merta
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
        document.getElementById("btn-ipb").addEventListener("click", function() {
            setActive('btn-ipb');
            fetch("{{ route('ppid.informasi-publik.ipb') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById("konten-dinamis").innerHTML = html;
                });
        });

        document.getElementById("btn-iptss").addEventListener("click", function() {
            setActive('btn-iptss');
            fetch("{{ route('ppid.informasi-publik.iptss') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById("konten-dinamis").innerHTML = html;
                });
        });

        document.getElementById("btn-ipsm").addEventListener("click", function() {
            setActive('btn-ipsm');
            fetch("{{ route('ppid.informasi-publik.ipsm') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById("konten-dinamis").innerHTML = html;
                });
        });
    </script>
    <script>
        window.addEventListener('load', function() {

            document.body.addEventListener('click', function(e) {
                var trigger = e.target.closest('[data-universal-modal]');
                if (!trigger) return;

                e.preventDefault();
                e.stopPropagation();

                var title = trigger.getAttribute('data-title') || '';
                var src = trigger.getAttribute('data-src') || '';
                var type = trigger.getAttribute('data-type') || 'pdf';

                document.getElementById('universalModalLabel').textContent = title;

                var body = document.getElementById('universalModalBody');
                body.innerHTML = '';

                if (type === 'image') {
                    body.innerHTML = '<img src="' + src + '" class="img-fluid rounded" alt="' + title +
                    '">';
                } else {
                    body.innerHTML = '<iframe src="' + src +
                        '" width="100%" height="500px" style="border:none;"></iframe>';
                }

                bootstrap.Modal.getOrCreateInstance(document.getElementById('universalModal')).show();
            });

            document.getElementById('universalModal').addEventListener('hidden.bs.modal', function() {
                document.getElementById('universalModalBody').innerHTML = '';
            });

        });
    </script>

    <div class="modal fade" id="universalModal" tabindex="-1" aria-labelledby="universalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="universalModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" id="universalModalBody"></div>
            </div>
        </div>
    </div>
@endsection
