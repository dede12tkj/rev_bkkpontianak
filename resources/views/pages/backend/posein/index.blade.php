@extends('layouts.back')

@section('title', 'Posein')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-3">Posein</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- BUTTON TAMBAH -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
            Tambah Data
        </button>

        <!-- TABLE -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Content</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($poseins as $item)
                            <tr>
                                <td>{!! Str::limit(strip_tags($item->content), 100) !!}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal"
                                        onclick="setEdit({{ $item->id }}, `{{ addslashes($item->content) }}`)">
                                        Edit
                                    </button>

                                    <form action="{{ route('posein.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">Belum ada data</td>
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
                <form method="POST" action="{{ route('posein.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h5>Tambah Posein</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <textarea name="content" class="summernote"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" id="editForm">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5>Edit Posein</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <textarea name="content" id="editContent" class="summernote"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- JQUERY (WAJIB PALING ATAS) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SUMMERNOTE -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.summernote').summernote({
                height: 300,
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
                url: "{{ route('posein.upload') }}",
                method: "POST",
                data: data,
                contentType: false,
                processData: false,
                success: function(res) {
                    $(editor).summernote('insertImage', res.url);
                },
                error: function() {
                    alert('Upload gagal');
                }
            });
        }

        // SET DATA EDIT
        function setEdit(id, content) {
            $('#editContent').summernote('code', content);
            $('#editForm').attr('action', '/admin-posein/update/' + id);
        }
    </script>
@endsection
