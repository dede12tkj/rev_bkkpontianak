@extends('layouts.back')

@section('title', 'Bedesut')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-3">Data Bedesut</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <h6 class="font-weight-bold">Daftar Bedesut</h6>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                Tambah Data
            </button>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Thumbnail</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td class="text-center">
                                @if ($item->thumbnail)
                                    <img src="{{ asset('storage/'.$item->thumbnail) }}" width="80">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">
                                    Edit
                                </button>
                                <form action="{{ route('admin-bedesut.destroy', $item->id) }}"
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin hapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        {{-- MODAL EDIT --}}
                        <div class="modal fade" id="editModal{{ $item->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form method="POST"
                                        action="{{ route('admin-bedesut.update', $item->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5>Edit Bedesut</h5>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Nama</label>
                                                <input type="text" name="nama"
                                                    value="{{ $item->nama }}"
                                                    class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Thumbnail</label>
                                                <input type="file" name="thumbnail"
                                                    class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label>Deskripsi</label>
                                                <textarea name="text" rows="5"
                                                    class="form-control" required>{{ $item->text }}</textarea>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button class="btn btn-primary">Update</button>
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
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST"
                action="{{ route('admin-bedesut.store') }}"
                enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5>Tambah Bedesut</h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Thumbnail</label>
                        <input type="file" name="thumbnail"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="text" rows="5"
                            class="form-control" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary"
                        data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
