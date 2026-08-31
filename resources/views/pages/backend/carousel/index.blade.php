@extends('layouts.back')
{{-- Sesuaikan dengan layout SB Admin 2 milik kamu --}}
@section('title')
    Carousel
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Carousel</h1>
        <p class="mb-4"></p>
        @if (session('success'))
            <div class="toast-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">

                <!-- Alert Sukses -->


                <h6 class="m-0 font-weight-bold text-primary">Tabel Carousel</h6>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah Carousel
                </button>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table2" width="100%" cellspacing="0">
                        <thead class="text-white">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Foto</th>
                                <th>Teks</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($carousel as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>

                                    <td class="text-center">
                                        <img src="{{ asset('storage/' . $item->path) }}" class="img-thumbnail"
                                            style="max-width: 120px;">
                                    </td>

                                    <td>
                                        {{ $item->text }}
                                    </td>

                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id }}">
                                            Edit
                                        </button>

                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $item->id }}">
                                            Hapus
                                        </button>
                                    </td>

                                </tr>
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('carousel.update', $item->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Carousel</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label class="form-label">Gambar Saat Ini</label><br>
                                                        <img src="{{ asset('storage/' . $item->path) }}"
                                                            class="img-thumbnail mb-2" style="max-width: 200px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Ganti Gambar (Opsional)</label>
                                                        <input type="file" name="path" class="form-control">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Teks</label>
                                                        <textarea name="text" class="form-control" rows="4" required>{{ $item->text }}</textarea>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('carousel.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger">Hapus Carousel</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body text-center">
                                                    <p>Apakah Anda yakin ingin menghapus carousel ini?</p>
                                                    <img src="{{ asset('storage/' . $item->path) }}" class="img-thumbnail"
                                                        style="max-width: 200px;">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Tidak ada data carousel
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Carousel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" name="path" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teks</label>
                            <textarea name="text" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
