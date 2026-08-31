@extends('layouts.back')

@section('title', 'Pengumuman')

@section('content')
    <div class="container-fluid">

        <h4 class="mb-3">Data Pengumuman</h4>

        <!-- Tombol Tambah -->


        <!-- Tabel -->
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
            <h6 class="fw-bold">Data Pengumuman</h6>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Pengumuman
        </button>
        </div>
            <div class="card-body">
                <table class="table table-bordered" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Penting</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                    @if ($item->status == 'published')
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>{{ $item->tanggal }}</td>
                                <td>
                                    @if ($item->is_penting)
                                        <span class="badge bg-warning">Ya</span>
                                    @else
                                        <span class="badge bg-light text-dark">Tidak</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning btn-edit" data-id="{{ $item->id }}"
                                        data-judul="{{ $item->judul }}" data-isi="{{ $item->isi }}"
                                        data-status="{{ $item->status }}" data-tanggal="{{ $item->tanggal }}"
                                        data-penting="{{ $item->is_penting }}">
                                        Edit
                                    </button>

                                    <form action="{{ route('pengumuman.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Hapus data?')"
                                            class="btn btn-sm btn-danger">Hapus</button>
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
        <div class="modal-dialog modal-lg">
            <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Tambah Pengumuman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Isi</label>
                            <textarea name="isi" id="summernoteTambah"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Penting</label>
                            <select name="is_penting" class="form-control">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>File</label>
                            <input type="file" name="file" class="form-control">
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
        <div class="modal-dialog modal-lg">
            <form method="POST" id="formEdit" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Edit Pengumuman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" id="editJudul" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Isi</label>
                            <textarea name="isi" id="summernoteEdit"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" id="editTanggal" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" id="editStatus" class="form-control">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Penting</label>
                            <select name="is_penting" id="editPenting" class="form-control">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>File</label>
                            <input type="file" name="file" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- SUMMERNOTE --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.css') }}" rel="stylesheet">
<script src="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.js') }}"></script>

<script>
    $(document).ready(function() {
    $('.summernote').summernote({
        height: 300
    });
});
</script>

    <script>
        $(document).ready(function() {

            $('#summernoteTambah').summernote({
                height: 200
            });
            $('#summernoteEdit').summernote({
                height: 200
            });

            // Klik tombol edit
            $('.btn-edit').click(function() {
                let id = $(this).data('id');

                $('#formEdit').attr('action', '/pengumuman/' + id);
                $('#editJudul').val($(this).data('judul'));
                $('#editTanggal').val($(this).data('tanggal'));
                $('#editStatus').val($(this).data('status'));
                $('#editPenting').val($(this).data('penting'));

                $('#summernoteEdit').summernote('code', $(this).data('isi'));

                $('#modalEdit').modal('show');
            });

        });
    </script>

@endsection


