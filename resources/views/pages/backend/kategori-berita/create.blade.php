@extends('layouts.back')

@section('content')
<div class="container mt-4">

    <div class="card">
        <div class="card-header">
            <h4>Tambah Kategori Berita</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('kategori-berita.store') }}" method="POST">
                @csrf

                <!-- Nama Kategori -->
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kategori-berita.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

</div>
@endsection
