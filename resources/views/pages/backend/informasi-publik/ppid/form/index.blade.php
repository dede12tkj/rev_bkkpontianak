@extends('layouts.back')
@section('title', 'Form PPID')

@section('content')

    <div class="container-fluid">
        <h1 class="h3 mb-3">Form PPID</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h6 class="fw-bold">Data Form</h6>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah Data
                </button>
            </div>

            <div class="card-body">
                <table class="table table-bordered" id="ppidTable">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Permohonan Informasi</th>
                            <th>Keberatan</th>
                            <th>Daftar Informasi Publik</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td><a href="{{ $item->form_permohonan_informasi }}" target="_blank">Link</a></td>
                                <td><a href="{{ $item->form_keberatan }}" target="_blank">Link</a></td>
                                <td class="text-center">
                                    @if ($item->file_daftar_informasi_publik)
                                        <a href="{{ asset('storage/' . $item->file_daftar_informasi_publik) }}"
                                            target="_blank">
                                            Download
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $item->id }}">Edit</button>
                                </td>
                            </tr>


                            <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin-ppid-form.update', $item->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5>Edit Form Link</h5>
                                            </div>

                                            <div class="modal-body">
                                                <label>Link Form Permohonan Informasi</label>
                                                <input name="form_permohonan_informasi" class="form-control mb-3"
                                                    value="{{ $item->form_permohonan_informasi }}">

                                                <label>Link Form Keberatan</label>
                                                <input name="form_keberatan" class="form-control mb-3"
                                                    value="{{ $item->form_keberatan }}">

                                                <label>File Daftar Informasi Publik</label>
                                                <input type="file" name="file_daftar_informasi_publik"
                                                    class="form-control">
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-primary">Update</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE --}}
    <div class="modal fade" id="createModal">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin-ppid-form.store') }}" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5>Tambah Form PPID</h5>
                </div>
                <div class="modal-body">
                    <input name="form_permohonan_informasi" class="form-control mb-3"
                        placeholder="Link Form Permohonan Informasi">

                    <input name="form_keberatan" class="form-control mb-3" placeholder="Link Form Keberatan">

                    <input type="file" name="file_daftar_informasi_publik" class="form-control">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection
