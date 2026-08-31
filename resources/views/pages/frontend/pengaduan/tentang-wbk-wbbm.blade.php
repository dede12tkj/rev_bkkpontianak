    @extends('layouts.detail')
@section('title')
    Tentang WBK & WBBM
@endsection
@section('title-navbar')
    Tentang WBK & WBBM
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Wilayah Bebas dari Korupsi, Wilayah Birokrasi Bersih dan
                    Melayani</h5>
                <h1 class="mb-0">TANYA JAWAB TENTANG PEMBANGUNAN ZONA INTEGRITAS MENUJU WBK/WBBM</h1>
            </div>
            <div class="accordion mt-3" id="accordionGabungan">

                @forelse ($data as $item)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false"
                                aria-controls="collapse{{ $loop->iteration }}">
                                {{ $item->nama }}
                            </button>
                        </h2>

                        <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $loop->iteration }}" data-bs-parent="#accordionGabungan">

                            <div class="accordion-body">
                                {!! $item->deskripsi !!}
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted">
                        Data belum tersedia
                    </div>
                @endforelse

            </div>




        </div>
    </div>
@endsection
