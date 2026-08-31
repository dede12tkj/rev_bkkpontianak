@extends('layouts.back')

@section('title', 'Sub Judul Bedesut')

@section('content')

    <div class="container-fluid">
        <h1 class="h3 mb-3">Sub Judul Bedesut</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="fw-bold">Data Sub Judul</h6>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah
                </button>
            </div>

            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Sub Judul</th>
                            <th>Tipe</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->judul->nama ?? '-' }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ class_basename($item->konten_type) }}</td>

                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>

                                    <form action="{{ route('admin.sub-judul.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>




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
    @foreach ($data as $item)
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="{{ route('admin.sub-judul.update', $item->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5>Edit Sub Judul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <label>Sub Judul</label>
                    <input type="text" name="nama" class="form-control mb-3"
                        value="{{ $item->nama }}" required>

                    <label>Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control mb-2">

                    @if ($item->thumbnail)
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" width="80">
                    @endif

                    {{-- KONTEN --}}
                    @if ($item->konten_type === 'App\Models\DashboardInteraktif')
                        <label>Link Looker</label>

                        <input type="url" name="link_looker" class="form-control"
                            value="{{ $item->konten->link_looker ?? '' }}">
                    @elseif ($item->konten_type === 'App\Models\Infografis')
                        <label>Konten</label>

                        <textarea name="text" class="form-control summernote-edit">
{{ $item->konten->text ?? '' }}
                        </textarea>
                    @elseif ($item->konten_type === 'App\Models\Sunmore' || $item->konten_type === 'App\Models\Buletin')
                        <input type="file" name="file" class="form-control">
                    @endif

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endforeach


    {{-- MODAL CREATE --}}
    <div class="modal fade" id="createModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="{{ route('admin.sub-judul.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5>Tambah Sub Judul</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <label>Pilih Judul</label>
                        <select name="judul_bedesut_id" class="form-control mb-3" required>
                            <option value="">-- Pilih Judul --</option>
                            @foreach ($judul as $j)
                                <option value="{{ $j->id }}">{{ $j->nama }}</option>
                            @endforeach
                        </select>

                        <label>Nama Sub Judul</label>
                        <input type="text" name="nama" class="form-control mb-3" required>

                        <label>Thumbnail</label>
                        <input type="file" name="thumbnail" class="form-control mb-3">

                        <select name="tipe" id="tipeSelect" class="form-control mb-3" required>
                            <option value="">-- Pilih Tipe --</option>
                            <option value="infografis">Infografis</option>
                            <option value="sunmore">Sunmore</option>
                            <option value="dashboard">Dashboard</option>
                            <option value="buletin">Buletin</option>
                        </select>

                        <div id="extraField"></div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    console.log('jQuery:', typeof $);
    console.log('Summernote:', typeof $.fn.summernote);
</script>

<script>
    $(document).ready(function () {

        // 🔥 INIT SUMMERNOTE UNTUK CREATE (DEFAULT)
        $(document).on('focus', '.summernote', function () {
            if (!$(this).next('.note-editor').length) {
                $(this).summernote({
                    height: 200
                });
            }
        });

        // 🔥 INIT SUMMERNOTE SAAT MODAL EDIT DIBUKA
        $(document).on('shown.bs.modal', '.modal', function () {

            let textarea = $(this).find('.summernote-edit');

            textarea.each(function () {

                // destroy kalau sudah pernah init
                if ($(this).next('.note-editor').length) {
                    $(this).summernote('destroy');
                }

                $(this).summernote({
                    height: 200
                });

            });

        });

    });

    // 🔥 DYNAMIC FIELD CREATE
    const tipeSelect = document.getElementById('tipeSelect');
    const extraField = document.getElementById('extraField');

    tipeSelect.addEventListener('change', function () {

        let html = '';

        if (this.value === 'dashboard') {

            html = `<label>Link Looker</label>
            <input type="url" name="link_looker" placeholder="link looker" class="form-control">`;
        }

        if (this.value === 'infografis') {
            html = `<label>Konten Infografis</label>
            <textarea name="text" class="form-control summernote"></textarea>`;
        }

        if (this.value === 'sunmore') {
            html = `<label>File Sunmore</label>
            <input type="file" name="file" class="form-control">`;
        }
        if (this.value === 'buletin') {
            html = `<label>File Buletin</label>
            <input type="file" name="file" class="form-control">`;
        }

        extraField.innerHTML = html;

    });
</script>

@endsection
