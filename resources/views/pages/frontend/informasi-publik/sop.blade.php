@extends('layouts.detail')
@section('title')
    SOP
@endsection
@section('title-navbar')
    STANDAR OPERASIONAL PROSEDUR
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            {{-- <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h1 class="mb-0">Artikel</h1>
            </div> --}}
            @php
                $prosesConfig = [
                    'proses1' => [
                        'nama' => 'Proses 1 Proses Penyelenggaraan Administrasi, Manajemen, dan Dukungan Umum',
                        'icon' => 'fa fa-building',
                        'color' => 'primary',
                    ],
                    'proses2' => [
                        'nama' => 'Proses 2 Proses Penyelenggaraan Sistem Kepatuhan Internal',
                        'icon' => 'fa fa-shield-alt',
                        'color' => 'success',
                    ],
                    'proses3' => [
                        'nama' => 'Proses 3 Pengawasan Karantina Kesehatan',
                        'icon' => 'fa fa-user-md',
                        'color' => 'danger',
                    ],
                    'proses4' => [
                        'nama' => 'Proses 4 Tindakan Penanggulangan',
                        'icon' => 'fa fa-ambulance',
                        'color' => 'warning',
                    ],
                    'proses5' => [
                        'nama' => 'Proses 5 Tindakan Pelanggaran Karantina',
                        'icon' => 'fa fa-gavel',
                        'color' => 'dark',
                    ],
                    'proses6' => [
                        'nama' => 'Proses 6 Pengelolaan Data dan Sistem Informasi',
                        'icon' => 'fa fa-database',
                        'color' => 'info',
                    ],
                ];
            @endphp
            <div class="row">

                @foreach (['proses1', 'proses2', 'proses3', 'proses4', 'proses5', 'proses6'] as $proses)
                    <div class="col-lg-6 mb-4">

                        <h5 class="fw-bold text-{{ $prosesConfig[$proses]['color'] }}">
                            <i class="{{ $prosesConfig[$proses]['icon'] }} me-2"></i>
                            {{ $prosesConfig[$proses]['nama'] }}
                        </h5>

                        <div class="accordion shadow mt-3" id="accordion-{{ $proses }}">

                            @if (isset($sop[$proses]))
                                <div class="accordion-item border-{{ $prosesConfig[$proses]['color'] }}">

                                    <h2 class="accordion-header">
                                        <button
                                            class="accordion-button collapsed bg-{{ $prosesConfig[$proses]['color'] }} text-white"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $proses }}">

                                            <i class="{{ $prosesConfig[$proses]['icon'] }} me-2"></i>
                                            Daftar SOP
                                        </button>
                                    </h2>

                                    <div id="collapse-{{ $proses }}" class="accordion-collapse collapse">
                                        <div class="accordion-body">

                                            <ol>
                                                @foreach ($sop[$proses] as $item)
                                                    <li class="mb-2">

                                                        <div>
                                                            {{ $item->judul }}
                                                        </div>

                                                        @if ($item->pdf)
                                                            <a href="{{ $item->pdf_url }}" target="_blank"
                                                                class="btn btn-sm btn-outline-{{ $prosesConfig[$proses]['color'] }} mt-1">
                                                                <i class="fa fa-download"></i> Unduh SOP
                                                            </a>
                                                        @endif

                                                    </li>
                                                @endforeach
                                            </ol>

                                        </div>
                                    </div>

                                </div>
                            @else
                                <div class="alert alert-light mt-3">
                                    Belum ada data
                                </div>
                            @endif

                        </div>

                    </div>
                @endforeach

            </div>

        </div>
    </div>
@endsection
