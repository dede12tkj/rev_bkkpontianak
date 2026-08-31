@extends('layouts.back')
@section('title', 'Profil Singkat PPID')

@section('content')

    <link href="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.css') }}" rel="stylesheet">

    <div class="container-fluid">
        <h1 class="h3 mb-3">Profil Singkat PPID</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="fw-bold">Data Profil Singkat</h6>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah Data
                </button>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Isi Profil</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{!! Str::limit(strip_tags($item->text), 150) !!}</td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>

                            {{-- MODAL EDIT --}}


                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('admin-ppid-profil.update', $item->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5>Edit Profil Singkat</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <textarea name="text" class="form-control summernote" required>{!! $item->text !!}</textarea>
                                        </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-primary">Update</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Belum ada data</td>
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
            <form method="POST" action="{{ route('admin-ppid-profil.store') }}" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5>Tambah Profil Singkat</h5>
                </div>

                <div class="modal-body">
                    <textarea name="text" class="form-control summernote" required></textarea>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.summernote').summernote({
                height: 300
            });
        });
    </script>

@endsection
