@extends('layouts.back')

@section('content')
    <div class="container py-5">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">
                Data Kontak Kami
            </h3>
        </div>

        {{-- Table --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <div class="table-responsive">

                    <table id="tableKontak" class="table table-bordered table-hover align-middle">

                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($kontaks as $item)
                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $item->nama }}
                                    </td>

                                    <td>
                                        {{ $item->email }}
                                    </td>

                                    <td>
                                        {{ $item->pesan }}
                                    </td>

                                    <td>
                                        {{ $item->created_at->format('d M Y H:i') }}
                                    </td>

                                    <td>
                                        <form action="{{ route('kontak.delete', $item->id) }}" method="POST"
                                            class="form-delete">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>

                                        </form>

                                        <a href="{{ route('kontak.preview.pdf', $item->id) }}" target="_blank"
                                            class="btn btn-success btn-sm">
                                            PDF
                                        </a>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>

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
            $('#tableKontak').DataTable({
                responsive: true,
                autoWidth: false
            });

            // Alert Success
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#0d6efd'
                });
            @endif

            // Confirm Delete
            $('.form-delete').submit(function(e) {

                e.preventDefault();

                let form = this;

                Swal.fire({
                    title: 'Hapus Pesan?',
                    text: "Data yang dihapus tidak dapat dikembalikan",
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
