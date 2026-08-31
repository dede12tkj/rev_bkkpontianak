@extends('layouts.back')
{{-- Sesuaikan dengan layout SB Admin 2 milik kamu --}}
@section('title')
    Tentang Kami
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('backend/assets/extensions/quill/quill.snow.css') }}">

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tentang Kami</h1>
        <p class="mb-4"></p>

        <!-- Alert Sukses -->
                @if (session('success'))
                    <div class="toast-success">
                        {{ session('success') }}
                    </div>
                @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">



                <h6 class="m-0 font-weight-bold text-primary">Tabel Tentang Kami</h6>

                @if ($tentang_kami->count() < 1)
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah Tentang Kami
                </button>
                @endif

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table2" width="100%" cellspacing="0">
                        <thead class="text-white">
                            <tr>
                                <th width="85%">Teks</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($tentang_kami as $item)
                                <tr>
                                    <td>
                                        {{ $item->text }}
                                    </td>

                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id }}">
                                            Edit
                                        </button>

                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $item->id }}">
                                            Hapus
                                        </button>
                                    </td>

                                </tr>
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('tentang-kami.update', $item->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Tentang Kami</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label class="form-label">Teks</label>

                                                        <div id="snow-edit-{{ $item->id }}" style="height: 250px;">
                                                            {!! $item->text !!}
                                                        </div>

                                                        <input type="hidden" name="text"
                                                            id="text-edit-{{ $item->id }}">

                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Tidak ada data Tentang Kami
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('tentang-kami.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Tentang Kami</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Teks</label>
                            <div id="snow" style="height: 250px;"></div>

                            <input type="hidden" name="text" id="text-create">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('backend/assets/extensions/quill/quill.min.js') }}"></script>
    <script src="{{ asset('backend/assets/static/js/pages/quill.js') }}"></script>
    <script>
    // CREATE
    const quillCreate = new Quill('#quill-create', {
        theme: 'snow',
        placeholder: 'Tulis tentang kami...'
    });

    document.querySelector('#createModal form').onsubmit = function () {
        document.getElementById('text-create').value = quillCreate.root.innerHTML;
    };

    // EDIT (multiple modal)
    @foreach ($tentang_kami as $item)
        const quillEdit{{ $item->id }} = new Quill('#snow-edit-{{ $item->id }}', {
            theme: 'snow'
        });

        document.querySelector('#editModal{{ $item->id }} form').onsubmit = function () {
            document.getElementById('text-edit-{{ $item->id }}').value =
                quillEdit{{ $item->id }}.root.innerHTML;
        };
    @endforeach
</script>

@endsection
