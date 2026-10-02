@extends('layouts.back')

@section('title', 'Standar Pelayanan')

@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-3">Standar Pelayanan</h1>

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Data Standar Pelayanan</h6>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                Tambah Data
            </button>
        </div>

        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead class="text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Nama Tampilan</th>
                        <th width="22%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nama_tampilan }}</td>
                            <td class="text-center">
                                <a href="{{ route('standar-pelayanan.show', $item->id) }}" target="_blank"
                                    class="btn btn-info btn-sm">Lihat</a>

                                {{-- Isi disimpan di textarea tersembunyi: di-escape SEKALI oleh Blade,
                                     dan .val() mengembalikan HTML aslinya. Jangan pakai htmlentities(). --}}
                                <textarea id="text-{{ $item->id }}" class="d-none" hidden>{{ $item->text }}</textarea>

                                <button type="button" class="btn btn-warning btn-sm btn-edit"
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}"
                                    data-nama_tampilan="{{ $item->nama_tampilan }}">
                                    Edit
                                </button>

                                <form action="{{ route('admin-standar-pelayanan.destroy', $item->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
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
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form method="POST" action="{{ route('admin-standar-pelayanan.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Nama (judul halaman)</label>
                    <input type="text" name="nama" class="form-control mb-3" value="{{ old('nama') }}" required>

                    <label class="form-label">Nama Tampilan (judul di kartu beranda, opsional)</label>
                    <input type="text" name="nama_tampilan" class="form-control mb-3" value="{{ old('nama_tampilan') }}">

                    <label class="form-label">Isi</label>
                    <textarea class="form-control summernote" name="text">{{ old('text') }}</textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ================= EDIT MODAL ================= --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form method="POST" id="formEdit">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Nama (judul halaman)</label>
                    <input type="text" name="nama" id="editNama" class="form-control mb-3" required>

                    <label class="form-label">Nama Tampilan (judul di kartu beranda, opsional)</label>
                    <input type="text" name="nama_tampilan" id="editNamaTampilan" class="form-control mb-3">

                    <label class="form-label">Isi</label>
                    <textarea id="summernoteEdit" name="text"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ================= SCRIPT ================= --}}
{{-- jQuery, Summernote, upload gambar, konfirmasi hapus: dikelola layouts/back + admin-editor.js --}}
<script>
$(function () {
    // Editor dibuat SEKALI saat halaman dimuat
    $('.summernote, #summernoteEdit').summernote({ height: 350 });

    // Tombol Edit: isi form dari textarea tersembunyi
    $('.btn-edit').on('click', function () {
        const id = $(this).data('id');

        $('#formEdit').attr('action', '{{ url('admin-standar-pelayanan') }}/' + id);
        $('#editNama').val($(this).attr('data-nama'));
        $('#editNamaTampilan').val($(this).attr('data-nama_tampilan'));
        $('#summernoteEdit').summernote('code', $('#text-' + id).val());

        bootstrap.Modal.getOrCreateInstance(document.getElementById('editModal')).show();
    });

    // Kosongkan form tambah setelah ditutup
    $('#createModal').on('hidden.bs.modal', function () {
        $(this).find('input[name=nama], input[name=nama_tampilan]').val('');
        $('.summernote').summernote('code', '');
    });
});
</script>

@endsection
