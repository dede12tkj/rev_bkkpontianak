@extends('layouts.back')
@section('title', 'Sunmore')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-3">Sunmore</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="fw-bold">Data Sunmore</h6>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah Data
                </button>
            </div>

            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>BEDESUT</th>
                            <th>PDF</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->bedesut->nama ?? '-' }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $item->path_pdf) }}" target="_blank"
                                        class="btn btn-success btn-sm">Lihat</a>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $item->id }}">Edit</button>

                                    <form action="{{ route('sunmore.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" id="edit{{ $item->id }}">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('sunmore.update', $item->id) }}"
                                        enctype="multipart/form-data" class="modal-content">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5>Edit Sunmore</h5>
                                        </div>

                                        <div class="modal-body">
                                            <input name="nama" class="form-control mb-3" value="{{ $item->nama }}">

                                            <select name="bedesut_id" class="form-control mb-3">
                                                <option value="">-- Pilih BEDESUT --</option>
                                                @foreach ($bedesut as $b)
                                                    <option value="{{ $b->id }}"
                                                        {{ $item->bedesut_id == $b->id ? 'selected' : '' }}>
                                                        {{ $b->nama }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <label>PDF (opsional)</label>
                                            <input type="file" name="path_pdf" class="form-control mb-3">

                                            <label>Thumbnail (opsional)</label>
                                            <input type="file" name="thumbnail" class="form-control">
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5">Belum ada data</td>
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
            <form method="POST" action="{{ route('sunmore.store') }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5>Tambah Sunmore</h5>
                </div>

                <div class="modal-body">
                    <input name="nama" class="form-control mb-3" placeholder="Nama">

                    <select name="bedesut_id" class="form-control mb-3">
                        <option value="">-- Pilih BEDESUT --</option>
                        @foreach ($bedesut as $b)
                            <option value="{{ $b->id }}">{{ $b->nama }}</option>
                        @endforeach
                    </select>

                    <label>File PDF</label>
                    <input type="file" name="path_pdf" class="form-control mb-3" required>

                    <label>Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
