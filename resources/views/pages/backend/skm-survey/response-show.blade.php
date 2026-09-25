@extends('layouts.back')

@section('title', 'Detail Response Survei')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Detail Jawaban Responden</h1>
        <a href="{{ route('admin-skm-survey.responses') }}" class="btn btn-sm btn-outline-secondary">
            &larr; Kembali ke Rekap
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <p class="mb-1"><strong>Waktu Submit:</strong> {{ optional($response->submitted_at)->format('d M Y, H:i') }}</p>
            <p class="mb-0"><strong>IP Address:</strong> {{ $response->ip_address }}</p>
        </div>
    </div>

    @foreach ($grouped as $sectionTitle => $answers)
        <div class="card shadow mb-4">
            <div class="card-header"><h6 class="mb-0">{{ $sectionTitle }}</h6></div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <tbody>
                        @foreach ($answers as $answer)
                            <tr>
                                <td width="50%">{{ $answer->question_label_snapshot }}</td>
                                <td>{{ $answer->display_value ?: '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>

@endsection
