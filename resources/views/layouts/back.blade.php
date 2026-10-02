<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>

    @include('includes.backend.style')

    {{-- jQuery + Summernote + perilaku editor dimuat SEKALI di sini; view tidak perlu memuatnya lagi --}}
    <script>
        window.ADMIN_CONFIG = {
            csrf: @json(csrf_token()),
            uploadUrl: @json(route('summernote.upload'))
        };
    </script>
    <script src="{{ asset('backend/assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/admin-editor.js') }}?v={{ is_file($__ae = public_path('backend/assets/js/admin-editor.js')) ? filemtime($__ae) : 1 }}"></script>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        @include('includes.backend.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')

            @include('includes.backend.sidebar')
        </div>
    </div>
    @include('includes.backend.script')
    @stack('scripts')
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: @json(session('success')),
                timer: 2500,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: @json(session('error')),
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                html: @json(implode('<br>', array_map('e', $errors->all()))),
            });
        @endif
    </script>

</body>

</html>
