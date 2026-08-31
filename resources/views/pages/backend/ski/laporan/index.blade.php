@extends('layouts.back')

@section('title', 'Laporan SKI')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-3">Laporan SKI</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="font-weight-bold">Data Laporan SKI</h6>
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
                            <th>Semester</th>
                            <th>Tahun</th>
                            <th>File PDF</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td class="text-center">{{ $item->semester }}</td>
                                <td class="text-center">{{ $item->tahun }}</td>
                                <td class="text-center">
                                    @if ($item->file_pdf)
                                        <a href="{{ route('admin-laporan-ski.flipbook', $item->id) }}"
                                            class="btn btn-sm btn-success">
                                            Lihat Flipbook
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
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
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('admin-laporan-ski.update', $item->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5>Edit Laporan SKI</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Nama</label>
                                                    <input type="text" name="nama" value="{{ $item->nama }}"
                                                        class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Semester</label>
                                                    <input type="text" name="semester" value="{{ $item->semester }}"
                                                        class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Tahun</label>
                                                    <input type="number" name="tahun" value="{{ $item->tahun }}"
                                                        class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>File PDF (Opsional)</label>
                                                    <input type="file" name="file_pdf" class="form-control"
                                                        accept="application/pdf">
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
                                <td colspan="6" class="text-center text-muted">
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
                <form method="POST" action="{{ route('admin-laporan-ski.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5>Tambah Laporan SKI</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Semester</label>
                            <input type="text" name="semester" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Tahun</label>
                            <input type="number" name="tahun" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>File PDF</label>
                            <input type="file" name="file_pdf" class="form-control" accept="application/pdf" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
