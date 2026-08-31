<div class="accordion-item">
    <h2 class="accordion-header" id="gHeading1">
        <button class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#gCollapse1">
            Regulasi Kementrian Kesehatan
        </button>
    </h2>

    <div id="gCollapse1"
         class="accordion-collapse collapse"
         data-bs-parent="#accordionGabungan">

        <div class="accordion-body">

            @forelse($data as $item)
                <div class="mb-2 d-flex justify-content-between align-items-center">

                    <span>{{ $item->nama }}</span>

                    <a href="{{ asset('storage/' . $item->path) }}"
                       target="_blank"
                       class="btn btn-sm btn-primary">
                        Lihat
                    </a>

                </div>
                <hr>
            @empty
                <p>Belum ada data regulasi.</p>
            @endforelse

        </div>
    </div>
</div>
