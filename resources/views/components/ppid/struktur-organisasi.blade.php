<div class="accordion mt-3" id="accordionGabungan">

    @forelse($struktur as $item)

        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $item->id }}">
                <button class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $item->id }}">

                    {{ $item->judul }}
                </button>
            </h2>

            <div id="collapse{{ $item->id }}"
                 class="accordion-collapse collapse"
                 data-bs-parent="#accordionGabungan">

                <div class="accordion-body text-center">

                    @if($item->path)
                        <img src="{{ asset('storage/' . $item->path) }}"
                             class="img-fluid"
                             style="max-height:500px;">
                    @else
                        <p>Gambar belum tersedia.</p>
                    @endif

                </div>
            </div>
        </div>

    @empty
        <div class="text-center p-4">
            Data struktur organisasi belum tersedia.
        </div>
    @endforelse

</div>
