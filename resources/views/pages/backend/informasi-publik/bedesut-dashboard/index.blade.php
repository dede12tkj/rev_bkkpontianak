@extends('layouts.back')
@section('title', 'Dashboard Interaktif')

@section('content')
    <link href="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.css') }}" rel="stylesheet">

    <div class="container-fluid">
        <h1 class="h3 mb-3">Dashboard Interaktif</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="fw-bold">Dashboard Interaktif</h6>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah Data
                </button>

            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>BEDESUT</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->bedesut->nama ?? '-' }}</td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">Edit</button>
                                    <form action="{{ route('admin-dashboard-interaktif.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>


                            </tr>
                            <div class="modal fade" id="editModal{{ $item->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('admin-dashboard-interaktif.update', $item->id) }}"
                                        enctype="multipart/form-data" class="modal-content">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5>Edit Dashboard Interaktif</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            {{-- Nama --}}
                                            <input name="nama" class="form-control mb-3" value="{{ $item->nama }}"
                                                placeholder="Nama">

                                            {{-- BEDESUT --}}
                                            <select name="bedesut_id" class="form-control mb-3">
                                                <option value="">-- Pilih BEDESUT --</option>
                                                @foreach ($bedesut as $b)
                                                    <option value="{{ $b->id }}"
                                                        {{ $item->bedesut_id == $b->id ? 'selected' : '' }}>
                                                        {{ $b->nama }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- Link Looker --}}
                                            <input name="link_looker" class="form-control mb-3"
                                                value="{{ $item->link_looker }}" placeholder="Link Looker (opsional)">

                                            {{-- Thumbnail --}}
                                            <input type="file" name="thumbnail" class="form-control mb-3">

                                            @if ($item->thumbnail)
                                                <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                                    class="img-fluid mb-3" style="max-height:150px">
                                            @endif

                                            {{-- Summernote --}}
                                            <textarea name="text" class="form-control summernote">
                                                {!! $item->text !!}
                                                </textarea>
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
                                <td colspan="4" class="text-center">Belum ada data</td>
                            </tr>

                            {{-- MODAL EDIT --}}

                        @endforelse



                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE --}}
    <div class="modal fade" id="createModal">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5>Tambah Dashboard</h5>
                </div>
                <div class="modal-body">
                    <input name="nama" class="form-control mb-3" placeholder="Nama">

                    <select name="bedesut_id" class="form-control mb-3">
                        <option value="">-- Pilih BEDESUT --</option>
                        @foreach ($bedesut as $b)
                            <option value="{{ $b->id }}">{{ $b->nama }}</option>
                        @endforeach
                    </select>

                    <input name="link_looker" class="form-control mb-3" placeholder="Link Looker (opsional)">
                    <input type="file" name="thumbnail" class="form-control mb-3">

                    <textarea name="text" class="form-control summernote"></textarea>
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
                height: 250,
                callbacks: {
                    onImageUpload: function(files) {
                        uploadImage(files[0], this);
                    }
                }
            });
        });


        function uploadImage(file, editor) {
            let data = new FormData();
            data.append("file", file);
            data.append("_token", "{{ csrf_token() }}");

            $.ajax({
                url: "{{ route('dashboard-interaktif.upload-image') }}",
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
