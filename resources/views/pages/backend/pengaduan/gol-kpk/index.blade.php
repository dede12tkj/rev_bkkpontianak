@extends('layouts.back')

@section('title', 'Gol KPK')

@section('content')
    <link href="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.css') }}" rel="stylesheet">


    <div class="container-fluid">
        <h1 class="h3 mb-3">Gol KPK</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="font-weight-bold">Data Gol KPK</h6>
                @if ($data->count() < 1)
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        Tambah Data
                    </button>
                @endif
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Isi</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                            <tr>
                                @if ($data->count() < 1)
                                <td>Data Belum Ada</td>
                                @endif
                                <td>Data Gol KPK</td>

                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" id="editModal{{ $item->id }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('admin-gol-kpk.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5>Edit Gol KPK</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <textarea class="form-control summernote-edit" name="text">{!! $item->text !!}</textarea>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted">Belum ada data</td>
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
                <form method="POST" action="{{ route('admin-gol-kpk.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5>Tambah Gol KPK</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <textarea class="form-control summernote" name="text"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.js') }}"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.summernote, .summernote-edit').summernote({
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
                url: "{{ route('admin-gol-kpk.upload-image') }}",
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
