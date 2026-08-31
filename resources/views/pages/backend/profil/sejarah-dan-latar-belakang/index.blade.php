@extends('layouts.back')

@section('title', 'Sejarah & Latar Belakang')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" rel="stylesheet">

    <div class="container-fluid">

        <h1 class="h3 mb-3 text-gray-800">Sejarah & Latar Belakang</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="font-weight-bold text-primary">Data</h6>

                @if ($data->count() < 1)
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        Tambah Data
                    </button>
                @endif
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="60%">Teks</th>
                            <th>Gambar</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{!! Str::limit(strip_tags($item->text), 200) !!}</td>
                                <td class="text-center">
                                    @if ($item->path)
                                        <img src="{{ asset('storage/' . $item->path) }}" width="120">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" id="editModal{{ $item->id }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form method="POST"
                                            action="{{ route('sejarah-dan-latar-belakang.update', $item->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5>Edit Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <label class="form-label">Teks</label>
                                                <textarea name="text" class="form-control summernote" required>
                                                {!! $item->text !!}
                                            </textarea>

                                                <label class="form-label mt-3">Gambar</label>
                                                <input type="file" name="path" class="form-control">

                                                @if ($item->path)
                                                    <small class="d-block mt-2">
                                                        <img src="{{ asset('storage/' . $item->path) }}" width="120">
                                                    </small>
                                                @endif
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    Belum ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE --}}
    <div class="modal fade" id="createModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('sejarah-dan-latar-belakang.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5>Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <label class="form-label">Teks</label>
                        <textarea name="text" class="form-control summernote" required></textarea>

                        <label class="form-label mt-3">Gambar</label>
                        <input type="file" name="path" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Summernote JS --}}
    <script src="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.summernote').summernote({
                height: 250,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                ]
            });
        });
    </script>

@endsection
