@extends('layouts.back')

@section('title', 'Akuntabilitas')

@section('content')
<div class="container-fluid">

    <h4 class="mb-3">Data Akuntabilitas</h4>

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        + Tambah Data
    </button>

    <!-- Tabel -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="tableAkuntabilitas">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
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
                                {{ $item->tahun }}
                            </span>
                        </td>
                        <td>{{ $item->judul }}</td>
                        <td>
                            @if($item->pdf)
                                <a href="{{ $item->pdf_url }}" target="_blank"
                                   class="btn btn-sm btn-success">
                                    <i class="fa fa-download"></i> Download
                                </a>
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning btn-edit"
                                data-id="{{ $item->id }}"
                                data-tahun="{{ $item->tahun }}"
                                data-judul="{{ $item->judul }}">
                                Edit
                            </button>

                            <form action="{{ route('admin-akuntabilitas.destroy', $item->id) }}" method="POST" class="d-inline">
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
        <form action="{{ route('admin-akuntabilitas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Akuntabilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Tahun</label>
                        <input type="number" name="tahun" class="form-control" required>
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
                    <h5>Edit Akuntabilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Tahun</label>
                        <input type="number" name="tahun" id="editTahun" class="form-control">
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
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function () {

            let id = this.dataset.id;
            let tahun = this.dataset.tahun;
            let judul = this.dataset.judul;

            document.getElementById('formEdit').action = '/admin-akuntabilitas/' + id;
            document.getElementById('editTahun').value = tahun;
            document.getElementById('editJudul').value = judul;

            let modal = new bootstrap.Modal(document.getElementById('modalEdit'));
            modal.show();
        });
    });

});
</script>
@endsection

