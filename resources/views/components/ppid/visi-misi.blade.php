<div class="accordion mt-3" id="accordionGabungan">

    {{-- VISI --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="gHeading1">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#gCollapse1">
                Visi
            </button>
        </h2>
        <div id="gCollapse1" class="accordion-collapse collapse show" data-bs-parent="#accordionGabungan">

            <div class="accordion-body">
                @if ($data && $data->visi)
                    {!! $data->visi !!}
                @else
                    <p>Data visi belum tersedia.</p>
                @endif
            </div>
        </div>
    </div>

    {{-- MISI --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="gHeading2">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#gCollapse2">
                Misi
            </button>
        </h2>
        <div id="gCollapse2" class="accordion-collapse collapse" data-bs-parent="#accordionGabungan">

            <div class="accordion-body">
                @if ($data && $data->misi)
                    {!! $data->misi !!}
                @else
                    <p>Data misi belum tersedia.</p>
                @endif
            </div>
        </div>
    </div>

</div>
