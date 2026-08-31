@extends('layouts.back')

@section('title', 'Infografis')

@section('content')
    <link href="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.css') }}" rel="stylesheet">

    <div class="container-fluid">
        <h1 class="h3 mb-3">Infografis</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="fw-bold">Data Infografis</h6>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah
                </button>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Bedesut</th>
                            <th>Thumbnail</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->bedesut->nama ?? '-' }}</td>
                                <td class="text-center">
                                    @if ($item->thumbnail)
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}" width="80">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>

                                    <form action="{{ route('admin-bedesut-infografis.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" id="editModal{{ $item->id }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form method="POST"
                                            action="{{ route('admin-bedesut-infografis.update', $item->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5>Edit Infografis</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <input type="text" name="nama" class="form-control mb-3"
                                                    value="{{ $item->nama }}" required>

                                                <select name="bedesut_id" class="form-control mb-3">
                                                    <option value="">-- Pilih Bedesut --</option>
                                                    @foreach ($bedesut as $b)
                                                        <option value="{{ $b->id }}"
                                                            {{ $item->bedesut_id == $b->id ? 'selected' : '' }}>
                                                            {{ $b->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <textarea class="form-control summernote-edit" name="text">{!! $item->text !!}</textarea>

                                                <input type="url" name="link_looker" class="form-control mt-3"
                                                    value="{{ $item->link_looker }}" placeholder="Link Looker">

                                                <input type="file" name="thumbnail" class="form-control mt-3">
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE --}}
    <div class="modal fade" id="createModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin-bedesut-infografis.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5>Tambah Infografis</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="text" name="nama" class="form-control mb-3" placeholder="Nama" required>

                        <select name="bedesut_id" class="form-control mb-3">
                            <option value="">-- Pilih Bedesut --</option>
                            @foreach ($bedesut as $b)
                                <option value="{{ $b->id }}">{{ $b->nama }}</option>
                            @endforeach
                        </select>

                        <textarea class="form-control summernote" name="text"></textarea>

                        <input type="url" name="link_looker" class="form-control mt-3" placeholder="Link Looker">
                        <input type="file" name="thumbnail" class="form-control mt-3">
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script>
        $('.summernote, .summernote-edit').summernote({
            height: 250
        });
    </script>
@endsection
