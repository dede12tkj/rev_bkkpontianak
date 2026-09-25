@extends('layouts.detail')

@section('title')
    {{ $survey->title }}
@endsection

@section('title-navbar')
    Survei Kepuasan Masyarakat
@endsection

@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">

            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 700px;">
                <h5 class="fw-bold text-primary text-uppercase">Survei Kepuasan Masyarakat</h5>
                <h1 class="mb-0">{{ $survey->title }}</h1>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">

                    @if ($survey->description)
                        <p class="text-muted text-center mb-5">{{ $survey->description }}</p>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Mohon periksa kembali isian Anda:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('skm-survey.store', $survey->id) }}">
                        @csrf

                        @foreach ($survey->sections as $section)
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-header bg-primary text-white py-3">
                                    <h5 class="mb-0 fw-semibold">
                                        {{ $loop->iteration }}. {{ $section->title }}
                                    </h5>
                                </div>
                                <div class="card-body p-4">
                                    @if ($section->description)
                                        <p class="text-muted">{{ $section->description }}</p>
                                    @endif

                                    @foreach ($section->questions as $question)
                                        <div class="mb-4 pb-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                                            <label class="form-label fw-semibold d-block mb-1">
                                                {{ $loop->parent->iteration }}.{{ $loop->iteration }}
                                                {{ $question->label }}
                                                @if ($question->is_required)
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>

                                            @if ($question->help_text)
                                                <p class="text-muted small mb-2">{{ $question->help_text }}</p>
                                            @endif

                                            @include('pages.frontend.skm-survey.types._' . $question->type, ['question' => $question])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill">
                                Kirim Survei
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
