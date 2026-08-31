@extends('layouts.back')
@section('title', 'Informasi Publik Setiap Saat')

@section('content')

<link href="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.css') }}" rel="stylesheet">

<div class="container-fluid">
    <h1 class="h3 mb-3">Informasi Publik Tersedia Setiap Saat</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <h6 class="fw-bold">Data Informasi</h6>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                Tambah Data
            </button>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Judul</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
@forelse ($data as $item)
    <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $item->judul }}</td>
        <td class="text-center">
            <button class="btn btn-warning btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#editMain{{ $item->id }}">
                Edit
            </button>

            <button class="btn btn-success btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#createSub{{ $item->id }}">
                + Sub
            </button>

            <form action="{{ route('informasi-setiap-saat.delete', $item->id) }}"
                method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"
                    onclick="return confirm('Hapus data ini?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>

    {{-- SUB --}}
    <tr>
        <td></td>
        <td colspan="2">
            <ul>
                @foreach ($item->sub as $sub)
                    <li>
                        <strong>{{ $sub->judul }}</strong><br>

                        {!! \Illuminate\Support\Str::limit(strip_tags($sub->deskripsi), 100) !!}

                        <button class="btn btn-sm btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#editSub{{ $sub->id }}">
                            Edit
                        </button>

                        <form action="{{ route('informasi-setiap-saat-sub.delete', $sub->id) }}"
                            method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus sub?')">
                                Hapus
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3" class="text-center">Belum ada data</td>
    </tr>
@endforelse
</tbody>
            </table>

        </div>
    </div>
</div>

@foreach ($data as $item)
<div class="modal fade" id="createSub{{ $item->id }}">
    <div class="modal-dialog modal-lg">
        <form method="POST"
            action="{{ route('informasi-setiap-saat-sub.store') }}"
            class="modal-content">
            @csrf

            <input type="hidden" name="informasi_publik_setiap_saat_id" value="{{ $item->id }}">

            <div class="modal-header">
                <h5>Tambah Sub</h5>
            </div>

            <div class="modal-body">
                <input name="judul" class="form-control mb-3" required>

                <textarea name="deskripsi"
                    class="form-control summernote"></textarea>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endforeach

@foreach ($data as $item)
    @foreach ($item->sub as $sub)
        <div class="modal fade" id="editSub{{ $sub->id }}">
            <div class="modal-dialog modal-lg">
                <form method="POST"
                    action="{{ route('informasi-setiap-saat-sub.update', $sub->id) }}"
                    class="modal-content">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5>Edit Sub</h5>
                    </div>

                    <div class="modal-body">
                        <input name="judul"
                            class="form-control mb-3"
                            value="{{ $sub->judul }}">

                        <textarea name="deskripsi"
                            class="form-control summernote">
                            {!! $sub->deskripsi !!}
                        </textarea>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endforeach

{{-- MODAL CREATE MAIN --}}
<div class="modal fade" id="createModal">
    <div class="modal-dialog">
        <form method="POST"
            action="{{ route('informasi-setiap-saat.store') }}"
            class="modal-content">
            @csrf

            <div class="modal-header">
                <h5>Tambah Data</h5>
            </div>

            <div class="modal-body">
                <input name="judul"
                    class="form-control"
                    placeholder="Judul"
                    required>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.summernote').summernote({
            height: 250
        });
    });
</script>

@endsection
