@extends('layouts.back')
@section('title', 'Visi & Misi PPID')

@section('content')

<link href="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.css') }}" rel="stylesheet">

<div class="container-fluid">
    <h1 class="h3 mb-3">Visi & Misi PPID</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">

            <form method="POST"
                  action="{{ $data ? route('admin-ppid-visi-misi.update', $data->id) : route('admin-ppid-visi-misi.store') }}">
                @csrf
                @if($data)
                    @method('PUT')
                @endif

                {{-- VISI --}}
                <div class="mb-4">
                    <label class="fw-bold">Visi</label>
                    <textarea name="visi"
                              class="form-control summernote"
                              required>{{ $data->visi ?? '' }}</textarea>
                </div>

                {{-- MISI --}}
                <div class="mb-4">
                    <label class="fw-bold">Misi</label>
                    <textarea name="misi"
                              class="form-control summernote"
                              required>{{ $data->misi ?? '' }}</textarea>
                </div>

                <button class="btn btn-primary">
                    {{ $data ? 'Update' : 'Simpan' }}
                </button>

            </form>

        </div>
    </div>
</div>

<script src="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.summernote').summernote({
            height: 250
        });
    });
</script>

@endsection
