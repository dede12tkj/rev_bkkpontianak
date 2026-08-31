@extends('layouts.back')

@section('title', 'Footer')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Footer Website</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="font-weight-bold text-primary mb-0">Data Footer</h6>

                @if ($footer->count() < 1)
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        Tambah Footer
                    </button>
                @endif


            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Teks</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>No Telp</th>
                            <th>Lokasi</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($footer as $item)
                            <tr>
                                <td>{!! Str::limit(strip_tags($item->text), 100) !!}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_telp }}</td>
                                <td>
                                    <a href="{{ $item->lokasi }}" target="_blank">Maps</a>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>

                            {{-- MODAL EDIT --}}
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('footer.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Footer</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="mb-3">
                        <label class="form-label">
                            Teks <small class="text-muted">(maks. 260 karakter)</small>
                        </label>

                        <textarea
                            name="text"
                            id="text-edit-{{ $item->id }}"
                            class="form-control"
                            rows="4"
                            maxlength="260"
                            required
                            onkeyup="countCharEdit{{ $item->id }}()"
                        >{{ $item->text }}</textarea>

                        <small class="text-muted">
                            <span id="char-edit-{{ $item->id }}">
                                {{ strlen($item->text) }}
                            </span>/260 karakter
                        </small>
                    </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Alamat</label>
                                                        <input type="text" name="alamat" class="form-control"
                                                            value="{{ $item->alamat }}" required>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" name="email" class="form-control"
                                                            value="{{ $item->email }}" required>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">No Telp</label>
                                                        <input type="text" name="no_telp" class="form-control"
                                                            value="{{ $item->no_telp }}" required>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Link Lokasi (Maps)</label>
                                                        <input type="url" name="lokasi" class="form-control"
                                                            value="{{ $item->lokasi }}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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
                                <td colspan="6" class="text-center text-muted">
                                    Data footer belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE --}}
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('footer.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Footer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
    <label class="form-label">
        Teks <small class="text-muted">(maks. 260 karakter)</small>
    </label>

    <textarea
        name="text"
        class="form-control"
        rows="4"
        maxlength="260"
        required
        oninput="updateCounter(this)"
    >{{ old('text', $item->text ?? '') }}</textarea>

    <small class="text-muted">
        <span id="charCount">0</span>/260 karakter
    </small>
</div>

<script>
    function updateCounter(el) {
        document.getElementById('charCount').innerText = el.value.length;
    }

    // auto hitung saat edit
    document.addEventListener('DOMContentLoaded', () => {
        const textarea = document.querySelector('textarea[name="text"]');
        if (textarea) updateCounter(textarea);
    });
</script>


                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">No Telp</label>
                                <input type="text" name="no_telp" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Link Lokasi (Maps)</label>
                                <input type="url" name="lokasi" class="form-control" required>
                            </div>
                        </div>
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
@endsection
