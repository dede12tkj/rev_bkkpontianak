@extends('layouts.back')
@section('title', 'Laporan PPID')

@section('content')

    <div class="container-fluid">

        <h1 class="h3 mb-3">Laporan PPID</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">

            <div class="card-header d-flex justify-content-between">
                <h6 class="fw-bold">Data Laporan PPID</h6>

                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah Data
                </button>
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead class="text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Laporan</th>
                            <th width="10%">Semester</th>
                            <th width="10%">Tahun</th>
                            <th width="15%">File</th>
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
                                        <a href="{{ asset('storage/' . $item->file_pdf) }}" target="_blank"
                                            class="btn btn-info btn-sm">
                                            Lihat File
                                        </a>
                                    @else
                                        -
                                    @endif

                                </td>

                                <td class="text-center">

                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $item->id }}">
                                        Edit
                                    </button>

                                </td>
                            </tr>

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">

                                    <form action="{{ route('admin-ppid-laporan.update', $item->id) }}" method="POST"
                                        enctype="multipart/form-data" class="modal-content">

                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5>Edit Laporan PPID</h5>
                                        </div>

                                        <div class="modal-body">

                                            <label>Nama Laporan</label>
                                            <input type="text" name="nama" class="form-control mb-3"
                                                value="{{ $item->nama }}" required>

                                            <label>Semester</label>
                                            <select name="semester" class="form-control mb-3" required>

                                                <option value="1" {{ $item->semester == 1 ? 'selected' : '' }}>1
                                                </option>
                                                <option value="2" {{ $item->semester == 2 ? 'selected' : '' }}>2
                                                </option>
                                                <option value="-" {{ $item->semester == '-' ? 'selected' : '' }}>-
                                                </option>

                                            </select>

                                            <label>Tahun</label>
                                            <input type="number" name="tahun" class="form-control mb-3"
                                                value="{{ $item->tahun }}" required>

                                            <label>File PDF</label>
                                            <input type="file" name="file_pdf" class="form-control mb-3"
                                                accept="application/pdf">

                                            @if ($item->file_pdf)
                                                <a href="{{ asset('storage/' . $item->file_pdf) }}" target="_blank"
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

                        @empty

                            <tr>
                                <td colspan="6" class="text-center">Belum ada data</td>
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

            <form method="POST" action="{{ route('admin-ppid-laporan.store') }}" enctype="multipart/form-data"
                class="modal-content">

                @csrf

                <div class="modal-header">
                    <h5>Tambah Laporan PPID</h5>
                </div>

                <div class="modal-body">

                    <label>Nama Laporan</label>
                    <input type="text" name="nama" class="form-control mb-3" required>

                    <label>Semester</label>
                    <select name="semester" class="form-control mb-3" required>

                        <option value="">Pilih Semester</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="-">-</option>

                    </select>

                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control mb-3" required>

                    <label>File PDF</label>
                    <input type="file" name="file_pdf" class="form-control" accept="application/pdf" required>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>

@endsection
