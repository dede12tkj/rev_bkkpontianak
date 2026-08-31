@extends('layouts.back')
@section('title', 'Struktur Organisasi PPID')

@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-3">Struktur Organisasi PPID</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <h6 class="fw-bold">Data Struktur Organisasi</h6>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                Tambah Data
            </button>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->judul }}</td>
                            <td class="text-center">
                                @if ($item->path)
                                    <img src="{{ asset('storage/' . $item->path) }}"
                                         class="img-fluid"
                                         style="max-height:120px;">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">
                                    Edit
                                </button>
                            </td>
                        </tr>

                        {{-- MODAL EDIT --}}
                        <div class="modal fade"
                             id="editModal{{ $item->id }}"
                             tabindex="-1">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin-ppid-struktur-organisasi.update', $item->id) }}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5>Edit Struktur Organisasi</h5>
                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <label>Judul</label>
                                            <input type="text"
                                                   name="judul"
                                                   class="form-control mb-3"
                                                   value="{{ $item->judul }}"
                                                   required>

                                            <label>Gambar</label>
                                            <input type="file"
                                                   name="path"
                                                   class="form-control mb-3">

                                            @if ($item->path)
                                                <img src="{{ asset('storage/' . $item->path) }}"
                                                     class="img-fluid"
                                                     style="max-height:150px;">
                                            @endif
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
                            <td colspan="4" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL CREATE --}}
<div class="modal fade" id="createModal">
    <div class="modal-dialog">
        <form method="POST"
              action="{{ route('admin-ppid-struktur-organisasi.store') }}"
              enctype="multipart/form-data"
              class="modal-content">
            @csrf

            <div class="modal-header">
                <h5>Tambah Struktur Organisasi</h5>
            </div>

            <div class="modal-body">

                <label>Judul</label>
                <input type="text"
                       name="judul"
                       class="form-control mb-3"
                       required>

                <label>Gambar</label>
                <input type="file"
                       name="path"
                       class="form-control"
                       required>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
