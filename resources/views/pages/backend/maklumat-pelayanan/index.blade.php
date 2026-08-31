@extends('layouts.back')
@section('title')
    Gambar Maklumat Pelayanan
@endsection

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Gambar Maklumat Pelayanan</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">

                <h6 class="m-0 font-weight-bold text-primary">Tabel Gambar Maklumat Pelayanan</h6>

                @if ($gambar->count() < 1)
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        Tambah Gambar
                    </button>
                @endif

            </div>


            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive datatable-minimal">
                    <table class="table table-bordered" id="table2">
                        <thead class="text-white">
                            <tr>
                                <th width="5%">No</th>
                                <th>Gambar</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($gambar as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <img src="{{ asset('storage/' . $item->path) }}"
                                            style="max-width: 120px; border-radius: 5px;">
                                    </td>

                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id }}">
                                            Edit
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('gambarmaklumatpelayanan.update', $item->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $item->id }}">
                                                        Edit Gambar
                                                    </h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label>Gambar Sekarang</label><br>
                                                        <img src="{{ asset('storage/' . $item->path) }}"
                                                            style="max-width: 100%; border-radius: 5px;">
                                                    </div>

                                                    <div class="form-group mt-2">
                                                        <label>Ganti Gambar (opsional)</label>
                                                        <input type="file" name="path" class="form-control">
                                                        <small class="text-muted">
                                                            Kosongkan jika tidak ingin mengganti gambar.
                                                        </small>
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

                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Tidak ada Maklumat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    {{-- Modal Create --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('gambarmaklumatpelayanan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Gambar Maklumat Pelayanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Upload Gambar</label>
                            <input type="file" name="path" class="form-control" required>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
