@extends('layouts.detail')
@section('title')
    Standar Pelayanan
@endsection
@section('title-navbar')
    Standar Pelayanan
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class=" text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h1 class="fw-bold text-primary text-uppercase">Standar Pelayanan</h1>
                <h5 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h5>
            </div>
            <div class="mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
                            <div class="container">
                                <div class="service-item rounded align-items-center justify-content-center text-center p-3">
                                    <table class="table table-bordered">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Nama Standar Pelayanan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('standar-pelayanan.show', $item->id) }}"
                                                            class="btn btn-primary btn-sm">
                                                            Lihat
                                                        </a>
                                                    </td>

                                                </tr>

                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">
                                                        Belum ada data
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
