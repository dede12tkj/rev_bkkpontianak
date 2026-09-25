@extends('layouts.back')

@section('title', 'Rekap Hasil Survei IKM')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Rekap Hasil Survei Kepuasan Masyarakat</h1>
        @if ($survey)
            <a href="{{ route('admin-skm-survey.export', $survey->id) }}" class="btn btn-success btn-sm">
                <i class="bi bi-download"></i> Export CSV
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (!$survey)
        <div class="alert alert-warning">Belum ada survei yang dibuat. Silakan buat survei terlebih dahulu di halaman Builder.</div>
    @else

        <div class="card shadow mb-4">
            <div class="card-body">
                <h6 class="text-muted mb-1">Total Responden</h6>
                <h2 class="mb-0">{{ $totalResponses }}</h2>
            </div>
        </div>

        @foreach ($recap as $sec)
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">{{ $sec['section'] }} <small class="text-muted">(skala 1-{{ $sec['scale_max'] }})</small></h6>
                    @if (!is_null($sec['index']))
                        <span class="badge bg-primary fs-6">Indeks: {{ $sec['index'] }} / 100</span>
                    @endif
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                        <thead class="text-center">
                            <tr>
                                <th>Unsur</th>
                                <th width="15%">Rata-rata</th>
                                <th width="15%">Jumlah Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sec['items'] as $item)
                                <tr>
                                    <td>{{ $item['label'] }}</td>
                                    <td class="text-center">{{ $item['avg'] ?? '-' }}</td>
                                    <td class="text-center">{{ $item['count'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if (!is_null($sec['overall_avg']))
                    <div class="card-footer text-muted small">
                        Rata-rata keseluruhan unsur: <strong>{{ $sec['overall_avg'] }}</strong> &middot;
                        Indeks = rata-rata &times; (100 / {{ $sec['scale_max'] }})
                    </div>
                @endif
            </div>
        @endforeach

        <div class="card shadow mb-4">
            <div class="card-header"><h6 class="mb-0">Daftar Responden</h6></div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Waktu Submit</th>
                            <th>IP Address</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($responses as $response)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ optional($response->submitted_at)->format('d M Y, H:i') }}</td>
                                <td>{{ $response->ip_address }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin-skm-survey.response.show', $response->id) }}"
                                        class="btn btn-sm btn-outline-primary">Detail</a>
                                    <form method="POST" action="{{ route('admin-skm-survey.response.destroy', $response->id) }}"
                                        class="d-inline" onsubmit="return confirm('Hapus data response ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada responden.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $responses->links() }}
            </div>
        </div>

    @endif
</div>

@endsection
