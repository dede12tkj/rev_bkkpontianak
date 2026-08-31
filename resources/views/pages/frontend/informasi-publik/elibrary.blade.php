@extends('layouts.detail')

@section('title', 'E-Library')

@section('title-navbar', 'E-Library')

@section('content')
    <div class="container py-5">

        <div class="text-center mb-5">
            <h2 class="fw-bold">📚 E-Library</h2>
            <p class="text-muted">Kumpulan dokumen dan referensi digital</p>
        </div>

        <div class="row">

            @forelse ($data as $item)
                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="card shadow-sm h-100 border-0 e-library-card">

                        <div class="card-body d-flex flex-column">

                            <div class="text-center mb-3">
                                <i class="fa fa-file-pdf fa-3x text-danger"></i>
                            </div>

                            <h6 class="fw-bold text-center mb-3">
                                {{ $item->judul }}
                            </h6>

                            <div class="mt-auto text-center">

                                {{-- Preview --}}
                                <button class="btn btn-sm btn-outline-primary me-1 btn-preview"
                                    data-pdf="{{ $item->pdf_url }}">
                                    <i class="fa fa-eye"></i> Lihat
                                </button>

                                {{-- Download --}}
                                <a href="{{ $item->pdf_url }}" target="_blank" class="btn btn-success text-white">
                                    <i class="fa fa-download"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>
            @empty
                <div class="text-center text-muted">
                    Belum ada data E-Library
                </div>
            @endforelse

        </div>

    </div>

    <!-- ================= MODAL PREVIEW PDF ================= -->
    <div class="modal fade" id="modalPreview">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Preview Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-0">
                    <iframe id="pdfFrame" src="" width="100%" height="600px"></iframe>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.btn-preview').forEach(btn => {
                btn.addEventListener('click', function() {

                    let pdf = this.dataset.pdf;
                    document.getElementById('pdfFrame').src = pdf;

                    let modal = new bootstrap.Modal(document.getElementById('modalPreview'));
                    modal.show();
                });
            });

        });
    </script>

    <style>
        .e-library-card {
            transition: 0.3s;
            border-radius: 12px;
        }

        .e-library-card:hover {
            transform: translateY(-5px);
        }

        .card-body h6 {
            min-height: 50px;
        }
    </style>
@endsection
