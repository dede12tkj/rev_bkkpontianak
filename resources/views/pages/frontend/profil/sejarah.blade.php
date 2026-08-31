@extends('layouts.detail')
@section('title')
    Sejarah dan Latar Belakang
@endsection
@section('title-navbar')
    Sejarah dan Latar Belakang
@endsection
@section('content')
    {{-- <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-3">
                        <h5 class="fw-bold text-primary text-uppercase">Sejarah dan Latar Belakang</h5>
                        <h1 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h1>
                    </div>
                    <p class="mb-2">Balai Kekarantinaan Kesehatan (BKK) Kelas I Pontianak merupakan institusi yang berada
                        di bawah naungan Kementerian Kesehatan Republik Indonesia, yang bertanggung jawab dalam pengawasan
                        dan pengendalian risiko kesehatan masyarakat di wilayah pintu masuk negara. Berawal dari nomenklatur
                        Kantor Kesehatan Pelabuhan Kelas II Pontianak, institusi ini mengalami perubahan nama menjadi Balai
                        Kekarantinaan Kesehatan Kelas I Pontianak sebagai bagian dari upaya penguatan fungsi dan peran
                        strategis dalam menghadapi tantangan kesehatan global.</p>
                    <p class="mb-4">Struktur organisasi Balai Kekarantinaan Kesehatan Kelas I Pontianak saat ini telah
                        disesuaikan dengan
                        perkembangan hukum dan regulasi yang berlaku, khususnya setelah terbitnya Peraturan Menteri
                        Kesehatan Nomor 10 Tahun 2023. Peraturan ini menggantikan peraturan sebelumnya, yaitu Peraturan
                        Menteri Kesehatan Nomor 356/MENKES/PER/IV/2008 sebagaimana diubah dengan Peraturan Menteri Kesehatan
                        Nomor 2348/MENKES/PER/XI/2011, yang dinilai sudah tidak sesuai dengan dinamika perkembangan
                        kesehatan dan tuntutan pelayanan yang semakin kompleks.</p>
                </div>
                <div class="col-lg-5" style="min-height: 500px; border-radius: 8px;">
                    <div class="card shadow wow zoomIn" data-wow-delay="0.9s">
                        <div class="card-body">
                            <img src="{{ asset('frontend/img/image.png') }}" alt="">


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
        <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-3">
                        <h5 class="fw-bold text-primary text-uppercase">Sejarah dan Latar Belakang</h5>
                        <h1 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h1>
                    </div>
                    {!! $sejarah->text !!}
                </div>
                <div class="col-lg-5" style="min-height: 400px;">
                    <div class="position-relative h-100 shadow">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('storage/' . $sejarah->path) }}" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
