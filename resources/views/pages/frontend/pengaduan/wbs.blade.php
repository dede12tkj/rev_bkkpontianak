@extends('layouts.detail')
@section('title')
    Whistleblowing Systems
@endsection
@section('title-navbar')
    Whistleblowing Systems
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h1 class="mb-0">Wilayah Bebas dari Korupsi, Wilayah Birokrasi Bersih dan Melayani</h1>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <p>WBS merupakan bagian dari sistem penanganan pengaduan masyarakat terpadu yang memfokuskan pada
                        penanganan dugaan tindak pidana korupsi. Pengaduan masyarakat adalah salah satu bentuk peran serta
                        masyarakat dalam pengawasan terhadap pemerintahan yang perlu mendapatkan tanggapan dengan cepat,
                        tepat
                        dan dapat dipertanggungjawabkan oleh instansi.</p>
                    <p>
                        (Data, identitas dan laporan yang anda sampaikan kepada kami akan dijamin kerahasiaanya). Laporan
                        yang
                        anda berikan akan segera kami tindak lanjuti. Terima kasih atas informasi yang telah anda sampaikan.
                    </p>
                </div>
            </div>
            <div class="accordion mt-4" id="accordionGabungan">

                <!-- ZI -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="gHeading1">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#gCollapse1">
                            Kriteria Pengaduan
                        </button>
                    </h2>
                    <div id="gCollapse1" class="accordion-collapse collapse" data-bs-parent="#accordionGabungan">
                        <div class="accordion-body">
                            <p>Untuk melaporkan pengaduan, ada beberapa kriteria yang harus dipenuhi agar pengaduan anda
                                mudah ditindak lanjuti. Pastikan pengaduan anda memenuhi unsur berikut :

                                <ul>
                                <li>What (apa) : Perbuatan berindikasi pelanggaran/ perlakuan yang tidak menyenangkan yang
                                    diketahui dan atau dialami.</li>

                                <li>Where (dimana) : Dimana pelanggaran/perlakuan tersebut dilakukan/terjadi.</li>

                                <li>When (kapan) : Kapan pelanggaran/perlakuan tersebut dilakukan/terjadi.</li>

                                <li>Who (siapa) : Siapa saja yang terlibat dalam pelanggaran/perlakuan tersebut.</li>

                                <li>How (bagaimana) : Bagaimana pelanggaran/perlakuan tersebut dilakukan (modus, cara, dsb).
                                </li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>


            </div>

            <div class="text-center mt-4 mb-4 shadow">
                <a href="https://www.google.com/url?q=https%3A%2F%2Fwbs.kemkes.go.id%2F&sa=D&sntz=1&usg=AOvVaw2q61-u2aFtfTYFKZ7Y-8Xu"
                    target="_blank" class="btn btn-kemenkes btn-lg text-white w-100"
                    style="max-width: 100%; display: inline-block;">
                    WBS Kementerian Kesehatan RI
                </a>
            </div>

            <div class="row mt-3">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-card shadow">
                        <h5>WBS</h5>
                        <p>Whistle Blowing System</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-card shadow">
                        <h5>Gratifikasi</h5>
                        <p>Melaporkan Gratifikasi</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-card shadow">
                        <h5>Benturan Kepentingan</h5>
                        <p>Melaporkan Benturan Kepentingan Pejabat/Jajaran Pegawai</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-card shadow">
                        <h5>Budaya Keselamatan</h5>
                        <p>Melaporkan Perilaku Karyawan Lain Yang Tidak Sesuai</p>
                    </div>
                </div>

            </div>




        </div>
    </div>
@endsection
