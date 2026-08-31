@extends('layouts.back')

@section('title', 'Panduan SKI')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-3">Panduan SKI</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <h6 class="font-weight-bold">Data Panduan SKI</h6>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                Tambah Data
            </button>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Panduan</th>
                        <th>Link Drive</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <a href="{{ $item->link_drive }}" target="_blank">
                                    {{ $item->link_drive }}
                                </a>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">
                                    Edit
                                </button>

                                <form action="{{ route('admin-panduan-ski.destroy', $item->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus data?')">
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
                                        action="{{ route('admin-panduan-ski.update', $item->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5>Edit Panduan SKI</h5>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Nama Panduan</label>
                                                <input type="text" name="nama" class="form-control"
                                                    value="{{ $item->nama }}">
                                            </div>

                                            <div class="mb-3">
                                                <label>Link Drive</label>
                                                <input type="text" name="link_drive" class="form-control"
                                                    value="{{ $item->link_drive }}">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin-panduan-ski.store') }}">
                @csrf

                <div class="modal-header">
                    <h5>Tambah Panduan SKI</h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Panduan</label>
                        <input type="text" name="nama" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Link Drive</label>
                        <input type="text" name="link_drive" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
