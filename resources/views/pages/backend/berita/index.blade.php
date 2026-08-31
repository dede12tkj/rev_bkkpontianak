@extends('layouts.back')
@section('title')
    Berita
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Data Berita</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">List Berita</h6>
                <a href="{{ route('berita.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Berita
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-white">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Thumbnail</th>
                                <th width="10%">Tanggal</th>
                                <th>Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($beritas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td width= "30%" style="font-size: 12px;" >{{ $item->judul }}</td>
                                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                    <td>
                                        @if ($item->thumbnail)
                                            <img src="{{ asset('storage/' . $item->thumbnail) }}" width="80"
                                                class="img-thumbnail">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->tanggal->format('d M Y') }}</td>
                                    <td width= "10%">{{ $item->status }}</td>

                                    <td width= "18%" class="text-center p-4">
                                        <a href="{{ route('berita.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('berita.destroy', $item->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data berita.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
