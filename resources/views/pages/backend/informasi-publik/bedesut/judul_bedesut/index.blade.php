@extends('layouts.back')

@section('title', 'Judul Bedesut')

@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-3">Judul Bedesut</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <h6 class="fw-bold">Data Judul</h6>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                Tambah
            </button>
        </div>

        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Thumbnail</th>
                        <th>Nama Judul</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            {{-- THUMBNAIL --}}
                            <td>
                                @if ($item->thumbnail)
                                    <img src="{{ asset('storage/'.$item->thumbnail) }}"
                                        width="70"
                                        style="border-radius:6px; object-fit:cover;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>{{ $item->nama }}</td>

                            <td>
                                {{-- EDIT --}}
                                <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">
                                    Edit
                                </button>

                                {{-- DELETE --}}
                                <form action="{{ route('admin.judul-bedesut.destroy', $item->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- MODAL EDIT --}}
                        <div class="modal fade" id="editModal{{ $item->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form method="POST"
                                        action="{{ route('admin.judul-bedesut.update', $item->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5>Edit Judul</h5>
                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <input type="text"
                                                name="nama"
                                                class="form-control mb-3"
                                                value="{{ $item->nama }}"
                                                required>

                                            {{-- THUMBNAIL --}}
                                            <input type="file" name="thumbnail" class="form-control">

                                            @if ($item->thumbnail)
                                                <img src="{{ asset('storage/'.$item->thumbnail) }}"
                                                    width="80"
                                                    class="mt-2">
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
                            <td colspan="4">Belum ada data</td>
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
        <div class="modal-content">

            <form method="POST"
                action="{{ route('admin.judul-bedesut.store') }}"
                enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5>Tambah Judul</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="text"
                        name="nama"
                        class="form-control mb-3"
                        placeholder="Nama Judul"
                        required>

                    {{-- THUMBNAIL --}}
                    <input type="file" name="thumbnail" class="form-control">

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
