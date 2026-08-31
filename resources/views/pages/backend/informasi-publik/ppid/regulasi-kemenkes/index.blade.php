@extends('layouts.back')
@section('title', 'Regulasi Kemenkes PPID')

@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-3">Regulasi Kemenkes PPID</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <h6 class="fw-bold">Data Regulasi</h6>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                Tambah Data
            </button>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Regulasi</th>
                        <th>File</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td class="text-center">
                                @if ($item->path)
                                    <a href="{{ asset('storage/' . $item->path) }}"
                                       target="_blank"
                                       class="btn btn-info btn-sm">
                                        Lihat File
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
                                    <form action="{{ route('admin-ppid-regulasi-kemenkes.update', $item->id) }}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5>Edit Regulasi</h5>
                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <label>Nama Regulasi</label>
                                            <input type="text"
                                                   name="nama"
                                                   class="form-control mb-3"
                                                   value="{{ $item->nama }}"
                                                   required>

                                            <label>File (PDF)</label>
                                            <input type="file"
                                                   name="path"
                                                   class="form-control mb-3"
                                                   accept="application/pdf">

                                            @if ($item->path)
                                                <a href="{{ asset('storage/' . $item->path) }}"
                                                   target="_blank"
                                                   class="btn btn-sm btn-secondary">
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
              action="{{ route('admin-ppid-regulasi-kemenkes.store') }}"
              enctype="multipart/form-data"
              class="modal-content">
            @csrf

            <div class="modal-header">
                <h5>Tambah Regulasi</h5>
            </div>

            <div class="modal-body">

                <label>Nama Regulasi</label>
                <input type="text"
                       name="nama"
                       class="form-control mb-3"
                       required>

                <label>File (PDF)</label>
                <input type="file"
                       name="path"
                       class="form-control"
                       accept="application/pdf"
                       required>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
