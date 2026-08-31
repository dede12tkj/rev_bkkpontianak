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
            {{-- FORM PERMOHONAN INFORMASI --}}
            <div class="text-center shadow">
                <a href="{{ $form?->form_permohonan_informasi ?? '#' }}" target="_blank"
                    class="btn btn-kemenkes btn-lg text-white w-100">

                    Formulir Permohonan Informasi
                </a>
            </div>

            {{-- FORM KEBERATAN --}}
            <div class="text-center mt-3 shadow">
                <a href="{{ $form?->form_keberatan ?? '#' }}" target="_blank"
                    class="btn btn-kemenkes btn-lg text-white w-100">

                    Formulir Keberatan
                </a>
            </div>

            {{-- DAFTAR INFORMASI PUBLIK --}}
            <div class="text-center mt-3 shadow">
                <a href="{{ $form && $form->file_daftar_informasi_publik ? asset('storage/' . $form->file_daftar_informasi_publik) : '#' }}"
                    target="_blank" class="btn btn-kemenkes btn-lg text-white w-100">

                    Daftar Informasi Publik (E-DIP)
                </a>
            </div>
            <hr>
            <h2 class="text-center mt-3">Frequently Asked Question</h2>

            <div class="accordion shadow mt-3" id="kemenkesAccordion">

                @foreach ($faq as $item)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $item->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $item->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $item->id }}">
                                {{ $item->judul }}
                            </button>
                        </h2>

                        <div id="collapse{{ $item->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $item->id }}" data-bs-parent="#kemenkesAccordion">

                            <div class="accordion-body">
                                {!! $item->deskripsi !!}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
