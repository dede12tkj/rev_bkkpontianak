@extends('layouts.back')

@section('content')

    <div class="container mt-4">

        <div class="card">
            <div class="card-header">
                <h4>Tambah Berita</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Judul -->
                    <div class="mb-3">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <!-- Kategori -->
                    <div class="form-group">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 form-group">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control">
                    </div>


                    <!-- Thumbnail -->
                    <div class="mb-3 form-group">
                        <label class="form-label">Thumbnail</label>
                        <input type="file" name="thumbnail" class="form-control">
                    </div>

                    <!-- Konten -->
                    <div class="form-group">
                        <label for="konten">Konten</label>
                        <textarea name="konten" id="summernote" class="form-control" rows="8">
                    </textarea>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="draft">Draft</option>
                            <option value="published">Publish</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('berita.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

<script>
    $('.summernote').summernote({
    height: 300,
    callbacks: {
        onImageUpload: function(files) {
            uploadImage(files[0]);
        }
    }
});

function uploadImage(file) {
    let data = new FormData();
    data.append("file", file);
    data.append("_token", "{{ csrf_token() }}");

    $.ajax({
        url: "{{ route('upload.image') }}",
        method: "POST",
        data: data,
        contentType: false,
        processData: false,
        success: function(res) {
            $('.summernote').summernote('insertImage', res.url);
        },
        error: function() {
            alert('Upload gambar gagal!');
        }
    });
}
</script>


@endsection
