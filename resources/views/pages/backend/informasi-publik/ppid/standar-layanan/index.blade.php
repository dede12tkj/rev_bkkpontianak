@extends('layouts.back')
@section('title', 'Standar Layanan PPID')

@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-3">Standar Layanan PPID</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <h6 class="fw-bold">Data Standar Layanan</h6>
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
                        <th>File Judul</th>
                        <th>File Dokumen</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td>{{ $item->judul }}</td>

                            <td class="text-center">
                                @if ($item->path_judul)
                                    <a href="{{ asset('storage/'.$item->path_judul) }}"
                                       target="_blank"
                                       class="btn btn-info btn-sm">
                                        Lihat
                                    </a>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="text-center">
                                @if ($item->path)
                                    <a href="{{ asset('storage/'.$item->path) }}"
                                       target="_blank"
                                       class="btn btn-success btn-sm">
                                        Lihat
                                    </a>
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
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form action="{{ route('admin-ppid-standar-layanan.update',$item->id) }}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5>Edit Data</h5>
                                            <button class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <label>Judul</label>
                                            <input type="text"
                                                   name="judul"
                                                   class="form-control mb-3"
                                                   value="{{ $item->judul }}"
                                                   required>

                                            <label>File Judul Image</label>
                                            <input type="file"
                                                   name="path_judul"
                                                   class="form-control mb-3"
                                                   accept="application/jpg,jpeg,png">

                                            @if ($item->path_judul)
                                                <a href="{{ asset('storage/'.$item->path_judul) }}"
                                                   target="_blank"
                                                   class="btn btn-secondary btn-sm mb-3">
                                                   File Saat Ini
                                                </a>
                                            @endif
Image</label>
                                            <input type="file"
                                                   name="path"
                                                   class="form-control mb-3"
                                                   accept="application/jpg,jpeg,png">

                                            @if ($item->path)
                                                <a href="{{ asset('storage/'.$item->path) }}"
                                                   target="_blank"
                                                   class="btn btn-secondary btn-sm">
                                                   File Saat Ini
                                                </a>
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
                            <td colspan="5" class="text-center">
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
    <div class="modal-dialog">

        <form method="POST"
              action="{{ route('admin-ppid-standar-layanan.store') }}"
              enctype="multipart/form-data"
              class="modal-content">
            @csrf

            <div class="modal-header">
                <h5>Tambah Data</h5>
            </div>

            <div class="modal-body">

                <label>Judul</label>
                <input type="text"
                       name="judul"
                       class="form-control mb-3"
                       required>

                <label>File Image Judul</label>
                <input type="file"
                       name="path_judul"
                       class="form-control mb-3"
                       accept="application/jpg,jpeg,png">

                <label>File Image</label>
                <input type="file"
                       name="path"
                       class="form-control"
                       accept="application/jpg,jpeg,png"
                       required>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
            </div>

        </form>

    </div>
</div>

@endsection
