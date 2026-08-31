@extends('layouts.detail')
@section('title')
    Wilayah Kerja
@endsection
@section('title-navbar')
    Wilayah Kerja
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class=" text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Wilayah Kerja</h5>
                <h1 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h1>
            </div>
            <div class="mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <img class="d-block mx-auto mb-3" style="width: 40%;"
                            src="{{ asset('frontend/img/logokemenkes.png') }}" alt="Logo Kemenkes">
                        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto"
                            style="max-width: 600px;">
                            <h3>Wilayah Kerja</h3>
                        </div>
                        @if ($wilkerText)
                            <p class="card-text">
                                {!! $wilkerText->text !!}
                            </p>
                        @endif
                        <div class="">
                            <table id="example" class="display table table-bordered">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Tempat Kedudukan</th>
                                        <th>Alamat</th>
                                        <th>Nama Kepala</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wilkers as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->tempat }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->nama_kepala }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>



                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <iframe id="googleMap"
                            src="https://www.google.com/maps/d/embed?mid=118NmmtW-hcRa1YNvFqeVD7zeqXvPmQKx&ehbc=2E312F"
                            width="100%" height="480"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
