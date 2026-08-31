@extends('layouts.back')
@section('title', 'Informasi Publik Berkala')

@section('content')

    <link href="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.css') }}" rel="stylesheet">

    <div class="container-fluid">

        <h1 class="h3 mb-3">Informasi Publik Berkala</h1>

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

                        @forelse($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>

                                <td>

                                    <strong>{{ $item->judul }}</strong>

                                    <ul class="mt-2">

                                        @foreach ($item->sub as $sub)
                                            <li class="mb-3">

                                                <strong>{{ $sub->judul }}</strong>

                                                <div class="mt-1">
                                                    {!! $sub->deskripsi !!}
                                                </div>

                                                <div class="mt-2">

                                                    <button class="btn btn-warning btn-sm btnEditSub"
                                                        data-id="{{ $sub->id }}" data-judul="{{ $sub->judul }}"
                                                        data-deskripsi="{{ $sub->deskripsi }}" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditSub">
                                                        Edit
                                                    </button>

                                                    <form action="{{ route('informasi-berkala.sub.destroy', $sub->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>

                                                </div>

                                            </li>
                                        @endforeach

                                    </ul>

                                </td>

                                <td class="text-center">

                                    <button class="btn btn-warning btn-sm btnEditParent"
                                                        data-id="{{ $item->id }}" data-judul="{{ $item->judul }}"
                                                        data-bs-toggle="modal" data-bs-target="#modalEditParent">
                                                        Edit
                                                    </button>

                                    <button class="btn btn-success btn-sm btnTambahSub" data-id="{{ $item->id }}"
                                        data-bs-toggle="modal" data-bs-target="#modalSub">
                                        + Sub
                                    </button>

                                    <form action="{{ route('informasi-berkala.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>

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

    <div class="modal fade" id="modalEditParent">
    <div class="modal-dialog">

        <form method="POST" id="formEditParent" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5>Edit Judul</h5>
            </div>

            <div class="modal-body">
                <input type="text"
                       name="judul"
                       id="edit_parent_judul"
                       class="form-control"
                       required>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Update</button>
            </div>

        </form>

    </div>
</div>

    {{-- MODAL CREATE PARENT --}}
    <div class="modal fade" id="createModal">
        <div class="modal-dialog">

            <form action="{{ route('informasi-berkala.store') }}" method="POST" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5>Tambah Informasi</h5>
                </div>

                <div class="modal-body">
                    <input type="text" name="judul" class="form-control" placeholder="Judul" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>


    {{-- MODAL TAMBAH SUB --}}
    <div class="modal fade" id="modalSub">
        <div class="modal-dialog">

            <form action="{{ route('informasi-berkala.sub.store') }}" method="POST" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5>Tambah Sub</h5>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="informasi_publik_berkala_id" id="sub_id">

                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control mb-3" required>

                    <label>Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control summernote"></textarea>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>


    {{-- MODAL EDIT SUB --}}
    <div class="modal fade" id="modalEditSub">
        <div class="modal-dialog">

            <form method="POST" id="formEditSub" class="modal-content">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5>Edit Sub</h5>
                </div>

                <div class="modal-body">

                    <label>Judul</label>
                    <input type="text" name="judul" id="edit_judul" class="form-control mb-3" required>

                    <label>Deskripsi</label>
                    <textarea name="deskripsi" id="edit_deskripsi" class="form-control summernote"></textarea>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    </div>

    <script>
document.querySelectorAll('.btnEditParent').forEach(btn => {

    btn.addEventListener('click', function () {

        let id = this.dataset.id;
        let judul = this.dataset.judul;

        // isi input
        document.getElementById('edit_parent_judul').value = judul;

        // set action form
        document.getElementById('formEditParent').action =
            `/informasi-berkala/${id}`;

    });

});
</script>
    <script src="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.js') }}"></script>

    <script>
        // isi ID parent ke modal sub
        document.querySelectorAll('.btnTambahSub').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('sub_id').value = this.dataset.id;
            });
        });

        // isi data edit sub
        document.querySelectorAll('.btnEditSub').forEach(btn => {
            btn.addEventListener('click', function() {

                let id = this.dataset.id;

                document.getElementById('edit_judul').value = this.dataset.judul;

                document.getElementById('formEditSub').action =
                    `/informasi-berkala/sub/${id}`;

                setTimeout(() => {
                    $('#edit_deskripsi').summernote('code', this.dataset.deskripsi);
                }, 200);

            });
        });

        // SUMMERNOTE INIT
        $('#modalSub').on('shown.bs.modal', function() {
            $('#deskripsi').summernote({
                height: 200
            });
        }).on('hidden.bs.modal', function() {
            $('#deskripsi').summernote('destroy');
        });

        $('#modalEditSub').on('shown.bs.modal', function() {
            $('#edit_deskripsi').summernote({
                height: 200
            });
        }).on('hidden.bs.modal', function() {
            $('#edit_deskripsi').summernote('destroy');
        });
    </script>

@endsection
