@extends('layouts.back')
@section('title', 'FAQ PPID')

@section('content')

    <div class="container-fluid">
        <h1 class="h3 mb-3">FAQ PPID</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="fw-bold">Data FAQ</h6>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah Data
                </button>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="30%">Judul</th>
                            <th>Deskripsi</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{!! $item->deskripsi !!}</td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $item->id }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>

                            {{-- MODAL EDIT --}}
                            {{-- <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('admin-ppid-faq.update', $item->id) }}"
                                    method="POST"
                                    class="modal-content">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">
                                        <h5>Edit FAQ</h5>
                                    </div>

                                    <div class="modal-body">
                                        <label>Judul</label>
                                        <input type="text"
                                            name="judul"
                                            class="form-control mb-3"
                                            value="{{ $item->judul }}"
                                            required>

                                        <label>Deskripsi</label>
                                        <textarea name="deskripsi"
                                            class="form-control"
                                            rows="5"
                                            required>{{ $item->deskripsi }}</textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div> --}}

                            <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin-ppid-faq.update', $item->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5>Edit FAQ</h5>
                                            </div>

                                            <div class="modal-body">
                                                <label>Judul</label>
                                                <input type="text" name="judul" class="form-control mb-3"
                                                    value="{{ $item->judul }}" required>

                                                <label>Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" rows="5" required>{{ $item->deskripsi }}</textarea>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-primary">Update</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE --}}
    <div class="modal fade" id="createModal">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin-ppid-faq.store') }}" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5>Tambah FAQ PPID</h5>
                </div>

                <div class="modal-body">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control mb-3" required>

                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="5" required></textarea>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection
