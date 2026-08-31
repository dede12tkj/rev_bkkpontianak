@extends('layouts.back')

@section('title')
    Data Benturan Kepentingan
@endsection

@section('content')
    <div class="container py-5">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="fw-bold mb-0">
                Data Benturan Kepentingan
            </h3>

        </div>

        {{-- Table --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table id="tableBenturan" class="table table-bordered table-hover align-middle">

                        <thead class="table-primary">

                            <tr>

                                <th>No</th>

                                <th>Nama Lengkap</th>

                                <th>Jabatan</th>

                                <th>Unit Kerja</th>

                                <th>Email</th>

                                <th>Tempat Laporan</th>

                                <th>Tanggal</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($data as $item)
                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $item->nama_lengkap }}
                                    </td>

                                    <td>
                                        {{ $item->jabatan }}
                                    </td>

                                    <td>
                                        {{ $item->unit_kerja }}
                                    </td>

                                    <td>
                                        {{ $item->email }}
                                    </td>

                                    <td>
                                        {{ $item->tempat_laporan }}
                                    </td>

                                    <td>
                                        {{ $item->created_at->format('d M Y H:i') }}
                                    </td>

                                    <td>

                                        <div class="d-flex gap-1">

                                            {{-- PDF --}}
                                            <a href="{{ route('benturan-kepentingan.pdf', $item->id) }}" target="_blank"
                                                class="btn btn-danger btn-sm">

                                                PDF

                                            </a>

                                            {{-- Detail --}}
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $item->id }}">

                                                Detail

                                            </button>

                                            {{-- Hapus --}}
                                            <form action="{{ route('benturan-kepentingan.delete', $item->id) }}"
                                                method="POST" class="form-delete">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm">

                                                    Hapus

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    @foreach ($data as $item)
        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-lg modal-dialog-scrollable">

                <div class="modal-content">

                    <div class="modal-header bg-primary text-white">

                        <h5 class="modal-title">
                            Detail Benturan Kepentingan
                        </h5>

                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <table class="table table-bordered">

                            <tr>
                                <th width="30%">Nama Lengkap</th>
                                <td>{{ $item->nama_lengkap }}</td>
                            </tr>

                            <tr>
                                <th>Jabatan</th>
                                <td>{{ $item->jabatan }}</td>
                            </tr>

                            <tr>
                                <th>Unit Kerja</th>
                                <td>{{ $item->unit_kerja }}</td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td>{{ $item->email }}</td>
                            </tr>

                            <tr>
                                <th>Uraian Konflik</th>
                                <td>{{ $item->uraian_konflik }}</td>
                            </tr>

                            <tr>
                                <th>Kepentingan</th>
                                <td>{{ $item->kepentingan }}</td>
                            </tr>

                            <tr>
                                <th>Penyebab</th>
                                <td>{{ $item->penyebab }}</td>
                            </tr>

                            <tr>
                                <th>Tempat Laporan</th>
                                <td>{{ $item->tempat_laporan }}</td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>
    @endforeach



    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            // DataTable
            $('#tableBenturan').DataTable({
                responsive: true,
                autoWidth: false
            });

            // Success Alert
            @if (session('success'))

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#0d6efd'
                });
            @endif

            // Delete Confirmation
            $('.form-delete').submit(function(e) {

                e.preventDefault();

                let form = this;

                Swal.fire({
                    title: 'Hapus Data?',
                    text: 'Data yang dihapus tidak dapat dikembalikan',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {

                    if (result.isConfirmed) {
                        form.submit();
                    }

                });

            });

        });
    </script>
@endsection
