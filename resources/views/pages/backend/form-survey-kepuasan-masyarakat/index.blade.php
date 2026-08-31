@extends('layouts.back')

@section('title', 'Survey Kepuasan Masyarakat')

@section('content')

    <link rel="stylesheet" href="{{ asset('backend/assets/extensions/quill/quill.snow.css') }}">

    <div class="container-fluid">

        <h1 class="h3 mb-3 text-gray-800">Survey Kepuasan Masyarakat</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="font-weight-bold text-primary">Data Survey</h6>
                @if ($data->count() < 1)
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        Tambah Data
                    </button>
                @endif
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="60%">Teks</th>
                            <th>Link</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{!! Str::limit(strip_tags($item->text), 150) !!}</td>
                                <td>
                                    @if ($item->link)
                                        <a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>

                                    <form action="{{ route('form-survey-kepuasan-masyarakat.destroy', $item->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Hapus data?')" class="btn btn-danger btn-sm">
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
                                            action="{{ route('form-survey-kepuasan-masyarakat.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5>Edit Survey</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <label class="form-label">Teks</label>
                                                <div id="editor-edit-{{ $item->id }}" style="height:200px;">
                                                    {!! $item->text !!}
                                                </div>
                                                <input type="hidden" name="text" id="text-edit-{{ $item->id }}">

                                                <label class="form-label mt-3">Link</label>
                                                <input type="url" name="link" class="form-control"
                                                    value="{{ $item->link }}">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">
                                                    Batal
                                                    </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Update
                                                    </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    Belum ada data
                                </td>
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
                <form method="POST" action="{{ route('form-survey-kepuasan-masyarakat.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5>Tambah Survey</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <label class="form-label">Teks</label>
                        <div id="editor-create" style="height:200px;"></div>
                        <input type="hidden" name="text" id="text-create">

                        <label class="form-label mt-3">Link</label>
                        <input type="url" name="link" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/assets/extensions/quill/quill.min.js') }}"></script>

    <script>
        // CREATE
        const quillCreate = new Quill('#editor-create', {
            theme: 'snow'
        });
        document.querySelector('#createModal form').onsubmit = () => {
            document.getElementById('text-create').value = quillCreate.root.innerHTML;
        };

        // EDIT
        @foreach ($data as $item)
            const quillEdit{{ $item->id }} = new Quill('#editor-edit-{{ $item->id }}', {
                theme: 'snow'
            });
            document.querySelector('#editModal{{ $item->id }} form').onsubmit = () => {
                document.getElementById('text-edit-{{ $item->id }}').value =
                    quillEdit{{ $item->id }}.root.innerHTML;
            };
        @endforeach
    </script>

@endsection
