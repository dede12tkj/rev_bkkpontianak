@extends('layouts.back')

@section('title', 'Survey')

@section('content')
    <div class="container-fluid">

        <h4 class="mb-3">Data Survey</h4>

        <!-- Tombol Tambah -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Survey
        </button>

        <!-- Tabel -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered" id="tableSurvey">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Laporan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <img src="{{ $item->gambar_url }}" width="80" class="rounded">
                                </td>

                                <td>{{ $item->judul }}</td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ $item->kategori_label }}
                                    </span>
                                </td>

                                <td>
                                    @if ($item->laporan)
                                        <a href="{{ $item->laporan_url }}" target="_blank"
                                            class="btn btn-success text-white">
                                            <i class="fa fa-download">Download</i>
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>

                                <td>
                                    <button class="btn btn-sm btn-warning btn-edit" data-id="{{ $item->id }}"
                                        data-judul="{{ $item->judul }}" data-isi="{{ e($item->isi) }}"
                                        data-kategori="{{ $item->kategori }}" data-tahun="{{ $item->tahun }}">
                                        Edit
                                    </button>

                                    <form action="{{ route('survey-admin.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
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
        <div class="modal-dialog modal-lg">
            <form action="{{ route('survey-admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Tambah Survey</h5>
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
                            <label>Isi</label>
                            <textarea name="isi" class="summernote"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control">
                                <option value="SKM">Survey Kepuasan Masyarakat</option>
                                <option value="SPAK">Survey Persepsi Anti Korupsi</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Laporan (PDF)</label>
                            <input type="file" name="laporan" class="form-control">
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
                        <h5>Edit Survey</h5>
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
                            <label>Isi</label>
                            <textarea name="isi" id="summernoteEdit" class="summernote"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="kategori" id="editKategori" class="form-control">
                                <option value="SKM">Survey Kepuasan Masyarakat</option>
                                <option value="SPAK">Survey Persepsi Anti Korupsi</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Laporan (PDF)</label>
                            <input type="file" name="laporan" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


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

            // INIT SUMMERNOTE
            $('.summernote').summernote({
                height: 300
            });

            // EDIT MODAL
            $('.btn-edit').click(function() {

                let id = $(this).data('id');

                $('#formEdit').attr('action', '/survey-admin/' + id);
                $('#editJudul').val($(this).data('judul'));
                $('#editKategori').val($(this).data('kategori'));
                $('#editTahun').val($(this).data('tahun'));

                // SET ISI KE SUMMERNOTE
                $('#summernoteEdit').summernote('code', $(this).data('isi'));

                let modal = new bootstrap.Modal(document.getElementById('modalEdit'));
                modal.show();
            });

        });
    </script>

@endsection
