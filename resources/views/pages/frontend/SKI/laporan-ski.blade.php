@extends('layouts.detail')

@section('title', 'Laporan SKI')

@section('title-navbar')
    Laporan Satuan Kepatuhan Internal
@endsection

@section('content')
<style>
    .list-group-item:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
    transition: 0.2s;
}
</style>
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">

            <div class="text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 700px;">
                <h5 class="fw-bold text-primary text-uppercase">
                    Laporan Satuan Kepatuhan Internal
                </h5>
                <h1 class="mb-0">
                    Balai Kekarantinaan Kesehatan Kelas I Pontianak
                </h1>
            </div>

            <div class="container">

    @forelse ($data as $tahun => $items)

        <div class="card shadow-lg border-0 mb-4">

            <!-- HEADER -->
            <div class="card-header bg-primary text-white fw-bold">
               📅 Tahun {{ $tahun }}
            </div>

            <!-- BODY -->
            <div class="card-body p-3">

                <div class="list-group list-group-flush">

                    @foreach ($items as $item)
                        <div class="list-group-item d-flex justify-content-between align-items-center">

                            <!-- KIRI -->
                            <div>
                                <div class="fw-semibold">
                                    Semester {{ $item->semester }}
                                </div>

                                <small class="text-muted">
                                    {{ $item->nama ?? 'Laporan SKI' }}
                                </small>
                            </div>

                            <!-- KANAN -->
                            <div>
                                @if ($item->file_pdf)
                                    <a href="{{ route('laporan-ski.show', $item->id) }}"
                                        class="btn btn-danger btn-sm">
                                        <i class="fas fa-file-pdf"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </div>

    @empty
        <div class="text-center text-muted">
            Data belum tersedia
        </div>
    @endforelse

</div>

        </div>
    </div>
@endsection
