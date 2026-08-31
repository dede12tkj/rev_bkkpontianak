@extends('layouts.back')

@section('title', 'Sosial Media')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-3 text-gray-800">Sosial Media</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="font-weight-bold text-primary mb-0">Data Sosial Media</h6>

            @if ($data->count() < 1)
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah Sosmed
                </button>
            @endif
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead class="text-white">
                    <tr>
                        <th>Platform</th>
                        <th>Link</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>Twitter</td>
                            <td>{{ $item->twitter ?? '-' }}</td>
                            <td rowspan="7" class="text-center align-middle">
                                <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">
                                    Edit
                                </button>
                            </td>
                        </tr>
                        <tr><td>Facebook</td><td>{{ $item->fb ?? '-' }}</td></tr>
                        <tr><td>WhatsApp</td><td>{{ $item->wa ?? '-' }}</td></tr>
                        <tr><td>Instagram</td><td>{{ $item->ig ?? '-' }}</td></tr>
                        <tr><td>YouTube</td><td>{{ $item->yt ?? '-' }}</td></tr>
                        <tr><td>TikTok</td><td>{{ $item->tiktok ?? '-' }}</td></tr>
                        <tr><td>Google Maps</td><td>{{ $item->maps ?? '-' }}</td></tr>

                        {{-- MODAL EDIT --}}
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('sosmed.update', $item->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Sosial Media</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Twitter</label>
                                                <input type="url" name="twitter" class="form-control"
                                                    value="{{ $item->twitter }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Facebook</label>
                                                <input type="url" name="fb" class="form-control"
                                                    value="{{ $item->fb }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">WhatsApp</label>
                                                <input type="text" name="wa" class="form-control"
                                                    value="{{ $item->wa }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Instagram</label>
                                                <input type="url" name="ig" class="form-control"
                                                    value="{{ $item->ig }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">YouTube</label>
                                                <input type="url" name="yt" class="form-control"
                                                    value="{{ $item->yt }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">TikTok</label>
                                                <input type="url" name="tiktok" class="form-control"
                                                    value="{{ $item->tiktok }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Google Maps</label>
                                                <input type="url" name="maps" class="form-control"
                                                    value="{{ $item->maps }}">
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
                            <td colspan="3" class="text-center text-muted">
                                Belum ada data sosmed
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
            <form method="POST" action="{{ route('sosmed.store') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sosial Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Twitter</label>
                        <input type="url" name="twitter" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Facebook</label>
                        <input type="url" name="fb" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">WhatsApp</label>
                        <input type="text" name="wa" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Instagram</label>
                        <input type="url" name="ig" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">YouTube</label>
                        <input type="url" name="yt" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">TikTok</label>
                        <input type="url" name="tiktok" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Google Maps</label>
                        <input type="url" name="maps" class="form-control">
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
