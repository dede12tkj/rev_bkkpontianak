@extends('layouts.back')

@section('title', 'Wilayah Kerja')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-3">Wilayah Kerja</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($wilkerText)
            <div class="card mb-4">
                <div class="card-header">
                    <h6>Deskripsi Wilayah Kerja</h6>
                </div>
                <div class="card-body">
                    {!! $wilkerText->text !!}
                </div>
            </div>
        @endif

        <div class="card mb-3">
            <div class="card-header">Teks Wilayah Kerja</div>
            <div class="card-body">
                <form method="POST" action="{{ route('wilker.text') }}">
                    @csrf
                    <textarea name="text" class="form-control" rows="5">
{{ $wilkerText->text ?? '' }}
            </textarea>
                    <button class="btn btn-primary mt-2">Simpan</button>
                </form>
            </div>
        </div>


        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6>Data Wilayah Kerja</h6>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah Data
                </button>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tempat</th>
                            <th>Alamat</th>
                            <th>Kepala</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wilker as $item)
                            <tr>
                                <td>{{ $item->tempat }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->nama_kepala }}</td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal" data-id="{{ $item->id }}"
                                        data-tempat="{{ $item->tempat }}" data-alamat="{{ $item->alamat }}"
                                        data-nama="{{ $item->nama_kepala }}" onclick="setEditData(this)">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin-wilker.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
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
                                <td colspan="4" class="text-center text-muted">
                                    Belum ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- MODAL EDIT --}}
<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" id="editForm">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5>Edit Wilayah Kerja</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label>Tempat</label>
            <input type="text" class="form-control" name="tempat" id="editTempat" required>
          </div>

          <div class="mb-3">
            <label>Alamat</label>
            <textarea class="form-control" name="alamat" id="editAlamat" rows="3" required></textarea>
          </div>

          <div class="mb-3">
            <label>Nama Kepala</label>
            <input type="text" class="form-control" name="nama_kepala" id="editNama" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

    {{-- MODAL CREATE --}}
    <div class="modal fade" id="createModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin-wilker.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h5>Tambah Wilayah Kerja</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Tempat</label>
                            <input type="text" class="form-control" name="tempat" required>
                        </div>

                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Nama Kepala</label>
                            <input type="text" class="form-control" name="nama_kepala" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
function setEditData(button) {
  const id = button.getAttribute('data-id');
  const tempat = button.getAttribute('data-tempat');
  const alamat = button.getAttribute('data-alamat');
  const nama = button.getAttribute('data-nama');

  document.getElementById('editTempat').value = tempat;
  document.getElementById('editAlamat').value = alamat;
  document.getElementById('editNama').value = nama;

  // set action form dinamis
  document.getElementById('editForm').action = `/admin-wilker/${id}`;
}
</script>
@endsection
