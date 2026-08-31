@extends('layouts.back')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4">Dashboard</h1>

    <div class="row">

        {{-- TOTAL ARTIKEL --}}
        <div class="col-md-3 mb-3">
            <div class="card shadow border-left-primary">
                <div class="card-body">
                    <h6><i class="fas fa-newspaper"></i> Total Artikel</h6>
                    <h3>{{ $totalArtikel }}</h3>
                </div>
            </div>
        </div>

        {{-- TOTAL BERITA --}}
        <div class="col-md-3 mb-3">
            <div class="card shadow border-left-info">
                <div class="card-body">
                    <h6><i class="fas fa-bullhorn"></i> Total Berita</h6>
                    <h3>{{ $totalBerita }}</h3>
                </div>
            </div>
        </div>

        {{-- KATEGORI --}}
        <div class="col-md-3 mb-3">
            <div class="card shadow border-left-success">
                <div class="card-body">
                    <h6><i class="fas fa-tags"></i> Kategori</h6>
                    <h3>{{ $totalKategori }}</h3>
                </div>
            </div>
        </div>

        {{-- LAPORAN --}}
        <div class="col-md-3 mb-3">
            <div class="card shadow border-left-warning">
                <div class="card-body">
                    <h6><i class="fas fa-file"></i> Laporan</h6>
                    <h3>{{ $totalLaporan }}</h3>
                </div>
            </div>
        </div>

        {{-- TOTAL VIEW --}}
        <div class="col-md-3 mb-3">
            <div class="card shadow border-left-dark">
                <div class="card-body">
                    <h6><i class="fas fa-eye"></i> Total Views Artikel</h6>
                    <h3>{{ $totalViews }}</h3>
                </div>
            </div>
        </div>

        {{-- ARTIKEL BULAN INI --}}
        <div class="col-md-3 mb-3">
            <div class="card shadow border-left-secondary">
                <div class="card-body">
                    <h6><i class="fas fa-calendar"></i> Artikel Bulan Ini</h6>
                    <h3>{{ $artikelBulanIni }}</h3>
                </div>
            </div>
        </div>

        {{-- STATUS --}}
        <div class="col-md-3 mb-3">
            <div class="card shadow border-left-danger">
                <div class="card-body">
                    <h6>Status Artikel</h6>
                    <small>✔ Published: {{ $artikelPublished }}</small><br>
                    <small>📝 Draft: {{ $artikelDraft }}</small>
                </div>
            </div>
        </div>

    </div>

    {{-- ARTIKEL TERBARU --}}
    <div class="card shadow mt-4">
        <div class="card-header">
            <h6 class="fw-bold">Artikel Terbaru</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Oleh</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($artikelTerbaru as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->oleh }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $item->status == 'published' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="text-center">{{ $item->tanggal }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ARTIKEL POPULER --}}
    <div class="card shadow mt-4">
        <div class="card-header">
            <h6 class="fw-bold">Artikel Terpopuler</h6>
        </div>
        <div class="card-body">
            <ul>
                @foreach ($artikelPopuler as $item)
                    <li>
                        {{ $item->judul }} ({{ $item->views }} views)
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- BERITA TERBARU --}}
    <div class="card shadow mt-4">
        <div class="card-header">
            <h6 class="fw-bold">Berita Terbaru</h6>
        </div>
        <div class="card-body">
            <ul>
                @foreach ($beritaTerbaru as $item)
                    <li>{{ $item->judul }}</li>
                @endforeach
            </ul>
        </div>
    </div>

</div>

@endsection
