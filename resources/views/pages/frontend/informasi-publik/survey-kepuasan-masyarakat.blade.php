@extends('layouts.detail')
@section('title')
    Survey Kepuasan Masyarakat
@endsection
@section('title-navbar')
    Survey Kepuasan Masyarakat
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            {{-- <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h1 class="mb-0">Artikel</h1>
            </div> --}}
            <div class="row">
                <!-- SKM -->
                <div class="col-lg-6 mb-4">
                    <h2>Survey Kepuasan Masyarakat</h2>
                    <div class="accordion shadow mt-3" id="accordionSKM">
                        
                        @foreach ($skm as $tahun => $items)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-skm-{{ $tahun }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-skm-{{ $tahun }}">

                                        <i class="fa fa-scale me-2"></i> {{ $tahun }}
                                    </button>
                                </h2>

                                <div id="collapse-skm-{{ $tahun }}" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionSKM">

                                    <div class="accordion-body">
                                        <ol>
                                            @foreach ($items as $item)
                                                <li class="mb-2">
                                                    <div>
                                                        <a href="{{ route('survey-admin.show', $item->id) }}"
                                                            class="fw-bold">
                                                            {{ $item->judul }}
                                                        </a>
                                                    </div>

                                                    @if ($item->laporan)
                                                        <small>
                                                            <a href="{{ asset('storage/' . $item->laporan) }}" target="_blank"
                                                                class="text-success">
                                                                <i class="fa fa-download me-1"></i>
                                                                Laporan kegiatan hasil survey unduh di sini!
                                                            </a>
                                                        </small>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <!-- SPAK -->
                <div class="col-lg-6 mb-4">
                    <h2>Survey Persepsi Anti Korupsi</h2>
                    <div class="accordion shadow mt-3" id="accordionSPAK">

                        @foreach ($spak as $tahun => $items)
                            <div class="accordion-item">

                                <h2 class="accordion-header" id="heading-spak-{{ $tahun }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-spak-{{ $tahun }}">

                                        <i class="fa fa-scale me-2"></i> {{ $tahun }}
                                    </button>
                                </h2>

                                <div id="collapse-spak-{{ $tahun }}" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionSPAK">

                                    <div class="accordion-body">
                                        <ol>
                                            @foreach ($items as $item)
                                                <li class="mb-2">
                                                    <div>
                                                        <a href="{{ route('survey-admin.show', $item->id) }}"
                                                            class="fw-bold">
                                                            {{ $item->judul }}
                                                        </a>
                                                    </div>

                                                    @if ($item->laporan)
                                                        <small>
                                                            <a href="{{ asset('storage/' . $item->laporan) }}"
                                                                target="_blank" class="text-success">
                                                                <i class="fa fa-download me-1"></i>
                                                                Laporan kegiatan hasil survey unduh di sini!
                                                            </a>
                                                        </small>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
