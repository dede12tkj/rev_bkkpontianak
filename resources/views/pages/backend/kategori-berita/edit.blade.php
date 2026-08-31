@extends('layouts.back')

@section('content')
<div class="container mt-4">

    <div class="card">
        <div class="card-header">
            <h4>Edit Kategori Berita</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('kategori-berita.update', $kategori_berita->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Kategori -->
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" value="{{ $kategori_berita->nama_kategori }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('kategori-berita.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

</div>
@endsection
