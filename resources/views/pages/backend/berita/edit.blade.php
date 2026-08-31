@extends('layouts.back')

@section('content')
    <div class="container mt-4">

        <div class="card">
            <div class="card-header">
                <h4>Edit Berita</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Judul -->
                    <div class="mb-3">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" value="{{ $berita->judul }}" required>
                    </div>

                    <!-- Kategori -->
                    <div class="form-group">
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-control">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}"
                                        {{ $berita->kategori_id == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 form-group">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal"
                            value="{{ old('tanggal', \Carbon\Carbon::parse($berita->tanggal)->format('Y-m-d')) }}"
                            class="form-control">

                    </div>


                    <!-- Thumbnail -->
                    <div class="mb-3">
                        <label class="form-label">Thumbnail Baru</label>
                        <input type="file" name="thumbnail" class="form-control">

                        @if ($berita->thumbnail)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $berita->thumbnail) }}" width="150"
                                    class="img-thumbnail">
                            </div>
                        @endif
                    </div>

                    <!-- Konten -->
                    <div class="mb-3">
                        <label class="form-label">Konten</label>
                        <textarea name="konten" id="summernote" rows="8" required>{{ $berita->konten }}</textarea>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="draft" {{ $berita->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ $berita->status == 'published' ? 'selected' : '' }}>Publish
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
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
