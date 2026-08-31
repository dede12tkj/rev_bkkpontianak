@extends('layouts.back')

@section('title', 'Data SOP')

@section('content')
<div class="container-fluid">

    <h4 class="mb-3">Data SOP</h4>

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        + Tambah SOP
    </button>

    <!-- Tabel -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="tableSop">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge bg-info">
                                {{ $item->kategori_label }}
                            </span>
                        </td>
                        <td>{{ $item->judul }}</td>
                        <td>
                            @if($item->pdf)
                                <a href="{{ asset('storage/'.$item->pdf) }}" target="_blank"
                                   class="btn btn-sm btn-success">
                                    Download
                                </a>
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning btn-edit"
                                data-id="{{ $item->id }}"
                                data-judul="{{ $item->judul }}"
                                data-kategori="{{ $item->kategori }}">
                                Edit
                            </button>

                            <form action="{{ route('admin-sop.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus data?')" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <form action="{{ route('admin-sop.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah SOP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control">
                            <option value="proses1">Proses 1</option>
                            <option value="proses2">Proses 2</option>
                            <option value="proses3">Proses 3</option>
                            <option value="proses4">Proses 4</option>
                            <option value="proses5">Proses 5</option>
                            <option value="proses6">Proses 6</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>File PDF</label>
                        <input type="file" name="pdf" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
        <form method="POST" id="formEdit" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit SOP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori" id="editKategori" class="form-control">
                            <option value="proses1">Proses 1</option>
                            <option value="proses2">Proses 2</option>
                            <option value="proses3">Proses 3</option>
                            <option value="proses4">Proses 4</option>
                            <option value="proses5">Proses 5</option>
                            <option value="proses6">Proses 6</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" id="editJudul" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>File PDF (opsional)</label>
                        <input type="file" name="pdf" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
<script>
$(document).ready(function(){

    $('.btn-edit').click(function(){
        let id = $(this).data('id');

        $('#formEdit').attr('action', '/admin-sop/' + id);
        $('#editJudul').val($(this).data('judul'));
        $('#editKategori').val($(this).data('kategori'));

        let modal = new bootstrap.Modal(document.getElementById('modalEdit'));
        modal.show();
    });

});
</script>
@endsection

