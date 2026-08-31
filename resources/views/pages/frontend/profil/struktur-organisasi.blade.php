@extends('layouts.detail')
@section('title')
    Struktur Organisasi
@endsection
@section('title-navbar')
    Struktur Organisasi
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class=" text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Struktur Organisasi</h5>
                <h1 class="mb-0">Balai Kekarantinaan Kesehatan Kelas I Pontianak</h1>
            </div>
            <div class="mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <img class="d-block mx-auto mb-3" style="width: 40%;"
                            src="{{ asset('frontend/img/logokemenkes.png') }}" alt="Logo Kemenkes">
                        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto"
                            style="max-width: 600px;">
                            <h3>Pengantar Struktur Organisasi </h3>
                        </div>
                        <p class="card-text">Balai Kekarantinaan Kesehatan Kelas I Pontianak merupakan unit pelaksana teknis
                            di bawah Kementerian Kesehatan Republik Indonesia yang memiliki tugas pokok melaksanakan upaya
                            pencegahan dan menangkal keluar atau masuknya penyakit dan/atau faktor risiko kesehatan
                            masyarakat di wilayah kerja pelabuhan, bandar udara, dan pos lintas batas darat 1 negara.</p>
                        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto"
                            style="max-width: 600px;">
                            <h3>Latar Belakang Perubahan</h3>
                        </div>
                        <p>Struktur organisasi Balai Kekarantinaan Kesehatan Kelas I Pontianak saat ini telah disesuaikan
                            dengan perkembangan hukum dan regulasi yang berlaku, khususnya setelah terbitnya Peraturan
                            Menteri Kesehatan Nomor 10 Tahun 2023. Peraturan ini menggantikan peraturan sebelumnya, yaitu
                            Peraturan Menteri Kesehatan Nomor 356/MENKES/PER/IV/2008 dan perubahannya, yang dinilai sudah
                            tidak sesuai dengan dinamika perkembangan kesehatan dan tuntutan pelayanan yang semakin
                            kompleks.
                        </p>
                        <p>
                            Perubahan struktur organisasi ini telah melalui proses kajian yang mendalam dan mendapatkan
                            persetujuan dari Kementerian Pendayagunaan Aparatur Negara dan Reformasi Birokrasi. Tujuan utama
                            dari perubahan ini adalah untuk meningkatkan efisiensi dan efektivitas pelaksanaan tugas dan
                            fungsi Balai, serta untuk menyelaraskan dengan kebijakan pemerintah dalam bidang kesehatan.
                        </p>
                        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto"
                            style="max-width: 600px;">
                            <h3>Struktur Organisasi</h3>
                        </div>

                        <p>Sesuai dengan Peraturan Menteri Kesehatan Nomor 10 Tahun 2023, struktur organisasi Balai
                            Kekarantinaan Kesehatan Kelas I Pontianak terdiri dari: </p>
                        <ol>
                            <li>
                                Subbagian Administrasi Umum: Bertanggung jawab dalam penyiapan dan koordinasi penyusunan
                                rencana, program, dan anggaran, pengelolaan keuangan dan barang milik negara, urusan sumber
                                daya manusia, organisasi dan tata laksana, dan hubungan masyarakat, pengelolaan data dan
                                informasi, pemantauan, evaluasi, laporan, kearsipan, persuratan, dan kerumahtanggaan.
                            </li>
                            <li>
                                Kelompok Jabatan Fungsional: Terdiri dari berbagai jenis dan jenjang jabatan fungsional
                                sesuai dengan bidang keahliannya yang bertugas memberikan pelayanan fungsional dalam
                                pelaksanaan tugas dan fungsi Balai, seperti pejabat karantina, petugas laboratorium, dan
                                lainnya.
                            </li>
                        </ol>
                        <img class="d-block mx-auto mb-3" style="width: 70%" src="{{ asset('frontend/img/foto2.png') }}" alt="">
                        <p>
                            Sebagai salah satu Balai Kekarantinaan Kesehatan Kelas I, klasifikasi BKK ditetapkan sesuai
                            Pasal 4 ayat (1) huruf b dalam peraturan ini dan mengacu pada evaluasi kriteria klasifikasi yang
                            diatur oleh peraturan perundang-undangan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
