@extends('layouts.back')

@section('title')
    Data Pengaduan Masyarakat
@endsection

@section('content')
    <div class="container py-5">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="fw-bold mb-0">
                Data Pengaduan Masyarakat
            </h3>

        </div>

        {{-- Table --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table id="tablePengaduan" class="table table-bordered table-hover align-middle">

                        <thead class="table-primary">

                            <tr>

                                <th>No</th>

                                <th>Nama</th>

                                <th>Jenis Kelamin</th>

                                <th>Usia</th>

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
                                        {{ $item->nama }}
                                    </td>

                                    <td>
                                        {{ $item->jenis_kelamin }}
                                    </td>

                                    <td>
                                        {{ $item->usia }} Tahun
                                    </td>

                                    <td>
                                        {{ $item->created_at->format('d M Y H:i') }}
                                    </td>

                                    <td>

                                        <div class="d-flex gap-1">
                                            <a href="{{ route('layanan-pengaduan-masyarakat.pdf', $item->id) }}"
                                                target="_blank" class="btn btn-danger btn-sm">

                                                PDF

                                            </a>
                                            {{-- Detail --}}
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $item->id }}">

                                                Detail

                                            </button>

                                            {{-- Hapus --}}
                                            <form
                                                action="{{ route('layanan-pengaduan-masyarakat-user.delete', $item->id) }}"
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

    {{-- Modal Detail --}}
    @foreach ($data as $item)
        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-lg modal-dialog-scrollable">

                <div class="modal-content border-0 shadow">

                    {{-- Header --}}
                    <div class="modal-header bg-primary text-white">

                        <h5 class="modal-title">
                            Detail Pengaduan Masyarakat
                        </h5>

                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                        </button>

                    </div>

                    {{-- Body --}}
                    <div class="modal-body">

                        <table class="table table-bordered">

                            <tr>
                                <th width="30%">Nama</th>
                                <td>{{ $item->nama }}</td>
                            </tr>

                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $item->jenis_kelamin }}</td>
                            </tr>

                            <tr>
                                <th>Usia</th>
                                <td>{{ $item->usia }} Tahun</td>
                            </tr>

                            <tr>
                                <th>Permasalahan / Pengaduan</th>
                                <td>{{ $item->permasalahan_pengaduan }}</td>
                            </tr>

                            <tr>
                                <th>Tanggal Pengaduan</th>
                                <td>
                                    {{ $item->created_at->format('d F Y H:i') }}
                                </td>
                            </tr>

                        </table>

                    </div>

                    {{-- Footer --}}
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                            Tutup

                        </button>

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
            $('#tablePengaduan').DataTable({
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
