@extends('layouts.detail')

@section('title', strtoupper($tipe))

@section('content')
    <div class="container py-5">

        <h3 class="text-center mb-4">
            {{ strtoupper($tipe) }}
        </h3>

        <div class="row">
            @foreach ($data as $item)
                <div class="col-lg-3 mb-4">
                    <a href="{{ route('bedesut.detail', $item->id) }}" class="text-decoration-none">
                        <div class="haji-card shadow h-100">

                            <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('frontend/img/default.png') }}"
                                class="card-img-top">

                            <div class="card-body text-center">
                                <h6>{{ $item->nama }}</h6>
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
@endsection
