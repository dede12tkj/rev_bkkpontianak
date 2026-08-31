  <!-- 1. JQUERY HARUS PALING ATAS -->
<script src="{{ asset('backend/assets/extensions/jquery/jquery.min.js') }}"></script>

<!-- 2. BOOTSTRAP / CORE APP -->
<script src="{{ asset('backend/assets/static/js/components/dark.js') }}"></script>
<script src="{{ asset('backend/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('backend/assets/compiled/js/app.js') }}"></script>

<!-- 3. APEXCHARTS -->
<script src="{{ asset('backend/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/assets/static/js/pages/dashboard.js') }}"></script>

<!-- 4. DATATABLES -->
<script src="{{ asset('backend/assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('backend/assets/static/js/pages/datatables.js') }}"></script>

<!-- 5. SUMMERNOTE -->
<script src="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.js') }}"></script>



    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
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
                    url: "{{ route('summernote.upload') }}",
                    method: "POST",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#summernote').summernote('insertImage', response.url);
                    },
                    error: function(err) {
                        console.error(err);
                        alert('Upload gambar gagal');
                    }
                });
            }
        });
    </script>
