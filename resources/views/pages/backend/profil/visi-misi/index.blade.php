@extends('layouts.back')

@section('title', 'Visi & Misi')

@section('content')

    <link href="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.css') }}" rel="stylesheet">

    <div class="container-fluid">

        <h1 class="h3 mb-3 text-gray-800">Visi, Misi & Tujuan</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="font-weight-bold text-primary">Data Visi & Misi</h6>

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
                            <th width="30%">Visi</th>
                            <th width="30%">Misi</th>
                            <th width="30%">Tujuan</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                            <tr>
                                <td>{!! Str::limit(strip_tags($item->visi), 100) !!}</td>
                                <td>{!! Str::limit(strip_tags($item->misi), 100) !!}</td>
                                <td>{!! Str::limit(strip_tags($item->tujuan), 100) !!}</td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('visi-misi.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Visi & Misi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Visi</label>
                                                    <textarea class="summernote" name="visi">{!! $item->visi !!}</textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Misi</label>
                                                    <textarea class="summernote" name="misi">{!! $item->misi !!}</textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Tujuan</label>
                                                    <textarea class="summernote" name="tujuan">{!! $item->tujuan !!}</textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Update
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
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
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form method="POST" action="{{ route('visi-misi.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Visi & Misi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Visi</label>
                            <textarea class="form-control summernote" name="visi"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Misi</label>
                            <textarea class="form-control summernote" name="misi"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tujuan</label>
                            <textarea class="form-control summernote" name="tujuan"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.summernote').summernote({
                height: 250,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ]
            });
        });
    </script>

@endsection
