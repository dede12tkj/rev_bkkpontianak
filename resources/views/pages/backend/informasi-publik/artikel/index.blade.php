@extends('layouts.back')
@section('title', 'Artikel')

@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-3">Data Artikel</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <h6 class="fw-bold">Daftar Artikel</h6>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                Tambah Artikel
            </button>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Thumbnail</th>
                        <th>Judul</th>
                        <th>Oleh</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td class="text-center">
                                @if ($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                         style="max-height:80px;">
                                @else
                                    -
                                @endif
                            </td>

                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->oleh }}</td>

                            <td class="text-center">
                                <span class="badge bg-{{ $item->status == 'published' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <td class="text-center">{{ $item->tanggal }}</td>

                            <td class="text-center">
                                <button class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $item->id }}">
                                    Edit
                                </button>

                                <form action="{{ route('admin-artikel.destroy', $item->id) }}"
                                      method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus data?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>



                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach ($data as $item)
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin-artikel.update', $item->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5>Edit Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input name="judul" class="form-control mb-3"
                       value="{{ $item->judul }}">

                <input name="oleh" class="form-control mb-3"
                       value="{{ $item->oleh }}">

                <input type="date" name="tanggal"
                       class="form-control mb-3"
                       value="{{ $item->tanggal }}">

                <select name="status" class="form-control mb-3">
                    <option value="draft" {{ $item->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ $item->status == 'published' ? 'selected' : '' }}>Published</option>
                </select>

                <input type="file" name="thumbnail" class="form-control mb-3">

                @if ($item->thumbnail)
                    <img src="{{ asset('storage/' . $item->thumbnail) }}"
                         style="max-height:120px;" class="mb-3">
                @endif

                <textarea name="konten"
                          class="form-control summernote">{!! $item->konten !!}</textarea>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Update</button>
            </div>

        </form>
    </div>
</div>
@endforeach

{{-- MODAL CREATE --}}
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-lg">
        <form method="POST"
              action="{{ route('admin-artikel.store') }}"
              enctype="multipart/form-data"
              class="modal-content">
            @csrf

            <div class="modal-header">
                <h5>Tambah Artikel</h5>
            </div>

            <div class="modal-body">

                <input name="judul" class="form-control mb-3" placeholder="Judul">

                <input name="oleh" class="form-control mb-3" placeholder="Oleh">

                <input type="date" name="tanggal" class="form-control mb-3">

                <select name="status" class="form-control mb-3">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>

                <input type="file" name="thumbnail" class="form-control mb-3">

                <textarea name="konten" class="form-control summernote"></textarea>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- SUMMERNOTE --}}
<link href="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.css') }}" rel="stylesheet">
<script src="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.summernote').summernote({
            height: 300
        });
    });
</script>

@endsection
