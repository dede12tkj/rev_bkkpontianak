@extends('layouts.detail')
@section('title')
    SINKARKES
@endsection
@section('title-navbar')
    Sistem Informasi Karantina Kesehatan
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class=" text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h1 class="fw-bold text-primary text-uppercase">Sistem Informasi Karantina Kesehatan</h1>
            </div>

            <div class="row g-4 mt-3">
                <!-- 1 -->
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-card shadow">
                        <i class="fa fa-syringe service-icon"></i>
                        <h5>Vaksinasi Internasional & ICV</h5>
                        <a href="https://sinkarkes.kemkes.go.id/vaksinasi_int/vaksinasi_int_public/add" target="blank"
                            class="btn btn-kemenkes btn-sm mt-3 text-white">Detail</a>
                    </div>
                </div>

                <!-- 2 -->
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-card shadow">
                        <i class="fa fa-ship service-icon"></i>
                        <h5>Dokumen Kesehatan Kapal</h5>
                        <a href="https://sinkarkes.kemkes.go.id/portal/welcome/pelayanan_kapal"
                            class="btn btn-kemenkes btn-sm mt-3 text-white">Detail</a>
                    </div>
                </div>

                <!-- 3 -->
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-card shadow">
                        <i class="fa fa-notes-medical service-icon"></i>
                        <h5>Dokumen Kesehatan Lintas Batas Darat</h5>
                        <a href="https://sinkarkes.kemkes.go.id/portal/welcome/pelayanan_plbdn"
                            class="btn btn-kemenkes btn-sm mt-3 text-white">Detail</a>
                    </div>
                </div>

                <!-- 4 -->
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="service-card shadow">
                        <i class="fa fa-plane-departure service-icon"></i>
                        <h5>Dokumen Kesehatan Pesawat</h5>
                        <a href="https://sinkarkes.kemkes.go.id/portal/pelayanan_pesawat"
                            class="btn btn-kemenkes btn-sm mt-3 text-white">Detail</a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 shadow">
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
            </div>
        </div>
    </div>
@endsection
