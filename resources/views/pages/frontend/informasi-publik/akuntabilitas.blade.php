@extends('layouts.detail')

@section('title', 'Akuntabilitas')
@section('title-navbar', 'Akuntabilitas')

@section('content')
<style>
.accordion-button {
    font-weight: 600;
}

.accordion-item {
    border-radius: 10px;
    overflow: hidden;
}

.accordion-body li {
    border-bottom: 1px solid #eee;
    padding-bottom: 8px;
}

.accordion-body li:last-child {
    border-bottom: none;
}
</style>
<div class="container py-5">

    <div class="text-center mb-4">
        <h2 class="fw-bold">Akuntabilitas</h2>
        <p class="text-muted">Laporan Akuntabilitas per Tahun</p>
    </div>

    <div class="accordion shadow" id="accordionAkuntabilitas">

        @forelse ($data as $tahun => $items)

        <div class="accordion-item mb-2">

            <h2 class="accordion-header" id="heading-{{ $tahun }}">
                <button class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse-{{ $tahun }}"
                    aria-expanded="false">

                    Tahun {{ $tahun }}
                </button>
            </h2>

            <div id="collapse-{{ $tahun }}"
                class="accordion-collapse collapse"
                data-bs-parent="#accordionAkuntabilitas">

                <div class="accordion-body">

                    <ol class="mb-0">
                        @foreach ($items as $item)
                        <li class="mb-2">

                            <div class="d-flex justify-content-between align-items-center flex-wrap">

                                <span>
                                    {{ $item->judul }}
                                </span>

                                <div class="mt-1">

                                    {{-- Preview --}}
                                    <button class="btn btn-sm btn-outline-primary btn-preview"
                                        data-pdf="{{ $item->pdf_url }}">
                                        <i class="fa fa-eye"></i> Lihat
                                    </button>

                                    {{-- Download --}}
                                    <a href="{{ $item->pdf_url }}" target="_blank"
    class="btn btn-success"
    style="color:white !important;">
    <i class="fa fa-download"></i>
</a>

                                </div>

                            </div>

                        </li>
                        @endforeach
                    </ol>

                </div>
            </div>

        </div>

        @empty
            <div class="text-center text-muted">
                Belum ada data akuntabilitas
            </div>
        @endforelse

    </div>

</div>

<!-- ================= MODAL PREVIEW ================= -->
<div class="modal fade" id="modalPreview">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Preview Dokumen</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-0">
                <iframe id="pdfFrame" src="" width="100%" height="600px"></iframe>
            </div>

        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.btn-preview').forEach(btn => {
        btn.addEventListener('click', function () {

            let pdf = this.dataset.pdf;
            document.getElementById('pdfFrame').src = pdf;

            let modal = new bootstrap.Modal(document.getElementById('modalPreview'));
            modal.show();
        });
    });

});
</script>
@endsection




