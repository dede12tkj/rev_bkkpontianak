@extends('layouts.back')
{{-- Sesuaikan dengan layout SB Admin 2 milik kamu --}}
@section('title')
    Kategori Berita
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Kategori Berita</h1>
        <p class="mb-4"></p>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">

                <!-- Alert Sukses -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <h6 class="m-0 font-weight-bold text-primary">List Kategori Berita</h6>
                <a href="{{ route('kategori-berita.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Kategori</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kategori_berita as $key => $row)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $row->nama_kategori }}</td>
                                    <td>{{ $row->slug }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('kategori-berita.edit', $row->id) }}" class="btn btn-warning">
                                            <i class="fa fa-pencil-alt mr-2"></i>Edit
                                        </a>

                                        <!-- Tombol Delete -->
                                        <form action="{{ route('kategori-berita.destroy', $row->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Hapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">
                                                <i class="fa fa-trash mr-2"></i>Hapus
                                            </button>
                                        </form>



                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Tidak ada data kategori.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
