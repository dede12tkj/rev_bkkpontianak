@extends('layouts.back')

@section('title', 'Standar Pelayanan')

@section('content')

<link href="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.css') }}" rel="stylesheet">

<div class="container-fluid">
    <h1 class="h3 mb-3">Standar Pelayanan</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <h6>Data Standar Pelayanan</h6>
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
                        <th>Nama Tampilan</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nama_tampilan }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm btn-edit"
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}"
                                    data-nama_tampilan="{{ $item->nama_tampilan }}"
                                    data-text="{{ htmlentities($item->text) }}">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ================= CREATE MODAL ================= --}}
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('admin-standar-pelayanan.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="text" name="nama" class="form-control mb-3" placeholder="Nama" required>
                    <input type="text" name="nama_tampilan" class="form-control mb-3" placeholder="Nama Tampilan">

                    <textarea class="form-control summernote" name="text"></textarea>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ================= EDIT MODAL ================= --}}
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="formEdit">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="text" name="nama" id="editNama" class="form-control mb-3">
                    <input type="text" name="nama_tampilan" id="editNamaTampilan" class="form-control mb-3">

                    <textarea id="summernoteEdit" name="text"></textarea>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.js') }}"></script>

<script>
$(document).ready(function() {

    // INIT SUMMERNOTE CREATE
    $('.summernote').summernote({
        height: 250,
        callbacks: {
            onImageUpload: function(files) {
                uploadImage(files[0], this);
            }
        }
    });

    // INIT EDIT (IMPORTANT)
    $('#editModal').on('shown.bs.modal', function () {
        $('#summernoteEdit').summernote({
            height: 250,
            callbacks: {
                onImageUpload: function(files) {
                    uploadImage(files[0], this);
                }
            }
        });
    });

    // BUTTON EDIT
    $('.btn-edit').click(function() {

        let id = $(this).data('id');

        $('#formEdit').attr('action', '/admin-standar-pelayanan/' + id);
        $('#editNama').val($(this).data('nama'));
        $('#editNamaTampilan').val($(this).data('nama_tampilan'));

        // SET ISI
        $('#editModal').modal('show');

        setTimeout(() => {
            $('#summernoteEdit').summernote('code', $(this).data('text'));
        }, 300);

    });

});

// UPLOAD IMAGE
function uploadImage(file, editor) {
    let data = new FormData();
    data.append("file", file);
    data.append("_token", "{{ csrf_token() }}");

    $.ajax({
        url: "{{ route('standar-pelayanan.upload-image') }}",
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        success: function(res) {
            $(editor).summernote('insertImage', res.url);
        }
    });
}
</script>

@endsection
