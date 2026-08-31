@extends('layouts.detail')
@section('title')
    Profil SKI
@endsection
@section('title-navbar')
    Profil Satuan Kepatuhan Internal
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class=" text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Profil Satuan Kepatuhan Internal</h5>
                <h1 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h1>
            </div>
            <div class="mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <img class="d-block mx-auto mb-3" style="width: 40%;"
                            src="{{ asset('frontend/img/logokemenkes.png') }}" alt="Logo Kemenkes">
                        <p class="card-text">BKK Pontianak sebagai Unit Pelaksana Teknis Kementerian Kesehatan membentuk
                            Satuan Kepatuhan Internal (SKI) sejak tahun 2020. Pembentukan ini dilandasi Permenkes Nomor 84
                            Tahun 2019 tentang Tata Kelola Pengawasan Intern dan Surat Keputusan Kepala BKK Pontianak Nomor
                            HK.02.02/1/994/2020 tanggal 3 Februari 2020.</p>
                        <p class="card-text">SKI bertugas sebagai pengendali internal dalam perencanaan, pelaksanaan,
                            pelaporan, monitoring, dan evaluasi kegiatan di lingkungan BKK Pontianak.</p>
                        <p>Pada tahun 2022, SKI diperkuat kembali melalui Surat Keputusan Kepala BKK Pontianak Nomor
                            PS.08.01/1/1993/2022 tanggal 19 Juni 2022, dengan tugas utama:</p>
                        <ol>
                            <li>Melaksanakan pemantauan dan evaluasi tata kelola unit kerja serta reformasi birokrasi
                                WBK/WBBM.</li>
                            <li>
                                Melaksanakan pemantauan dan evaluasi pengendalian intern.
                            </li>
                            <li>
                                Melaksanakan penugasan lain di bidang kepatuhan sesuai arahan pimpinan.
                            </li>
                            <li>
                                Menyusun laporan hasil pemantauan bulanan serta laporan rekapitulasi triwulanan.
                            </li>
                        </ol>
                        <p>
                            Dalam pelaksanaannya, SKI menjunjung tinggi prinsip independensi, objektivitas, integritas,
                            profesionalisme, dan kerahasiaan, serta bebas dari intervensi pihak manapun.
                        </p>
                        <p>
                            Kegiatan SKI diharapkan memastikan setiap program kerja BKK Pontianak berjalan efektif, efisien,
                            akuntabel, dan patuh pada peraturan perundang-undangan. Selain itu, SKI berperan sebagai soft
                            control dalam penguatan budaya kerja, mendorong pegawai untuk bekerja cerdas dan ikhlas,
                            berintegritas, prima dalam pelayanan, serta konsisten menerapkan 5 Budaya Kerja Kementerian
                            Kesehatan.
                        </p>
                        <p>
                            Bagi masyarakat, keberadaan SKI menjadi jaminan bahwa layanan publik di BKK Pontianak
                            dilaksanakan secara transparan, profesional, dan berorientasi pada kualitas pelayanan kesehatan
                            di pintu masuk negara.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
