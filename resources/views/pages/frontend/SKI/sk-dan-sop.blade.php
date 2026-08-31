@extends('layouts.detail')
@section('title')
    SK & SOP
@endsection
@section('title-navbar')
    SK & SOP
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class=" text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Surat Keputusan & Standar Operasional Prosedur Satuan
                    Kepatuhan Internal</h5>
                <h1 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h1>
            </div>

            <div class="mb-4">
                <!-- Visi Card -->
                <div class="card shadow">
                    <div class="card-body text-center">
                        <img class="m-auto mb-3" style="width: 10%;" src="{{ asset('frontend/img/email.png') }}"
                            alt="Logo Kemenkes">
                        <h3 class="section-title text-center position-relative pb-3 mb-4 mx-auto">Surat Keputusan</h3>
                        <div class="card">
                            <table class="table table-bordered text-center align-middle">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Surat Keputusan</th>
                                        @foreach ($tahuns as $tahun)
                                            <th>{{ $tahun }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataSK as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-start">{{ strtoupper($item['nama']) }}</td>

                                            @foreach ($tahuns as $tahun)
                                                <td>
                                                    @if (isset($item['data'][$tahun]))
                                                        <a href="{{ route('sk-dan-sop.show', $item['data'][$tahun]->id) }}"
                                                            target="_blank">
                                                            <i class="fas fa-file-pdf text-danger"></i>
                                                        </a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            @endforeach

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">Data SK belum tersedia</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 card shadow">
                <div class="card-body text-center">
                    <img class="m-auto mb-3" style="width: 10%;" src="{{ asset('frontend/img/sop.png') }}"
                        alt="Logo Kemenkes">
                    <h3 class="section-title text-center position-relative pb-3 mb-4 mx-auto">Standar Operasional Prosedur
                    </h3>
                    <div class="card">
                        <table class="table-bordered text-center">
                            <thead class="bg-primary" style="color:white;">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Lihat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataSOP as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                            <a href="{{ route('sk-dan-sop.show', $item->id) }}"
                                                class="btn btn-success btn-sm">✔</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Data SOP belum tersedia</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
