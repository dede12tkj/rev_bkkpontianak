@foreach ($data as $item)

    {{-- H3 = JUDUL PARENT --}}
    <h3 class="mt-4">{{ $item->judul }}</h3>

    <div class="accordion mt-3" id="accordion{{ $item->id }}">

        @foreach ($item->sub as $sub)
            <div class="accordion-item">

                <h2 class="accordion-header" id="heading{{ $sub->id }}">
                    <button class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $sub->id }}">

                        {{ $sub->judul }}
                    </button>
                </h2>

                <div id="collapse{{ $sub->id }}"
                    class="accordion-collapse collapse"
                    data-bs-parent="#accordion{{ $item->id }}">

                    <div class="accordion-body">
                        {!! $sub->deskripsi !!}
                    </div>
                </div>

            </div>
        @endforeach

    </div>

@endforeach
