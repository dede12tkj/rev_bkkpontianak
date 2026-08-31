@extends('layouts.detail')
@section('title')
    Formulir Permohonan Layanan
@endsection
@section('title-navbar')
    Formulir Permohonan Layanan
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class=" text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h1 class="fw-bold text-primary text-uppercase">Formulir Permohonan Layanan</h1>
            </div>

            <div class="row g-4 mt-3">
                <!-- 1 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-card shadow">
                        <i class="fa fa-plus-square service-icon"></i>
                        <h5>Permohonan Izin Angkut Orang Sakit</h5>
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSfvJyb5zX-C_eCTY8SBrWpORYfQmQZDiz8q18jobcrr90kBCQ/viewform" target="blank"
                            class="btn btn-kemenkes btn-sm mt-3 text-white">Detail</a>
                    </div>
                </div>

                <!-- 2 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-card shadow">
                        <i class="fa fa-ambulance service-icon "></i>
                        <h5>Permohonan Layanan Evakuasi Medik</h5>
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLScQkYRLf8MnyG-zCwPo65ZSok7ToQ6gmmahc07tgMbNfRHd5Q/viewform"
                            class="btn btn-kemenkes btn-sm mt-3 text-white">Detail</a>
                    </div>
                </div>

                <!-- 3 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-card shadow">
                        <i class="fa fa-notes-medical service-icon"></i>
                        <h5>Permohonan Surat Keterangan Pengujian Sehat</h5>
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLScQkYRLf8MnyG-zCwPo65ZSok7ToQ6gmmahc07tgMbNfRHd5Q/viewform"
                            class="btn btn-kemenkes btn-sm mt-3 text-white">Detail</a>
                    </div>
                </div>
            </div>

            {{-- <div class="text-center mt-5 shadow">
                <a href="https://www.bkkpontianak.id/layanan/sinkarkes/formulir-permohonan-vaksinasi" target="_blank"
                    class="btn btn-kemenkes btn-lg text-white w-100" style="max-width: 100%; display: inline-block;">
                    Formulir Permohonan Dan Persetujuan Vaksinasi
                </a>
            </div>

            <div class="accordion shadow mt-3" id="kemenkesAccordion">

                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading1">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                            <i class="fa fa-scale me-2"></i> Data Pelayanan Vaksinasi
                        </button>
                    </h2>
                    <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1"
                        data-bs-parent="#kemenkesAccordion">
                        <div class="accordion-body">
                            <ol>
                                <a href="">
                                    <li>DATA PELAYANAN VAKSINASI MENINGITIS MENINGOKOKUS & YELLOW FEVER</li>
                                </a>
                                <a href="">
                                    <li>DATA PELAYANAN VAKSINASI COVID 19</li>
                                </a>

                            </ol>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
