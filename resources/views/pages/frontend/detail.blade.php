@extends('layouts.detail')
@section('title')
    Detail
@endsection
@section('title-navbar')
    Detail Pelayanan
@endsection
@section('content')
    <div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="col">
                <!-- Blog Detail Start -->
                <div class="mb-5">
                    <img class="img-fluid w-100 rounded mb-5" src="" alt="">
                    <h1 class="mb-4">STANDAR PELAYANAN VAKSINASI INTERNASIONAL</h1>
                    
                    <div class="accordion" id="kemenkesAccordion">
                        <!-- Dasar Hukum -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                    <i class="fa fa-scale me-2"></i> Dasar Hukum
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1"
                                data-bs-parent="#kemenkesAccordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Undang-Undang Nomor 25 Tahun 2009 tentang Pelayanan Publik</li>
                                        <li>Undang-Undang Nomor 17 Tahun 2023 tentang Kesehatan</li>
                                        <li>Peraturan Pemerintah RI Nomor 64 Tahun 2019 tentang Jenis dan Tarif atas Jenis
                                            Penerimaan
                                            Negara Bukan Pajak (PNBP) yang berlaku pada Kementerian Kesehatan</li>
                                        <li>Peraturan Menteri PAN & RB Nomor 15 Tahun 2014 tentang Standar Pelayanan Publik
                                        </li>
                                        <li>Peraturan Menteri Kesehatan RI Nomor 23 Tahun 2018 tentang Pelayanan dan
                                            Penerbitan
                                            Sertifikat Vaksinasi Internasional</li>
                                        <li>Peraturan Menteri Kesehatan RI Nomor 9 Tahun 2023 tentang Klasifikasi Unit
                                            Pelaksana Teknis
                                            Bidang Kekarantinaan Kesehatan</li>
                                        <li>Peraturan Menteri Kesehatan RI Nomor 10 Tahun 2023 tentang Organisasi dan Tata
                                            Kerja Unit
                                            Pelaksana Teknis Bidang Kekarantinaan Kesehatan</li>
                                        <li>Peraturan Menteri Keuangan RI Nomor 45 Tahun 2024 tentang Jenis dan Tarif Atas
                                            Jenis
                                            Penerimaan Negara Bukan Pajak Yang Bersifat Volatil dan Kebutuhan Mendesak Yang
                                            Berlaku Pada
                                            Kementerian Kesehatan</li>
                                        <li>Peraturan Direktorat Jenderal P2P Nomor SR.03.04/II/2745/2018 tentang Tata Cara
                                            Penerbitan
                                            Sertifikat Vaksinasi Internasional</li>
                                        <li>SE Kepala Pusat Kesehatan Haji Nomor HK.02.03/A.X.1/231/2025 tentang Pelaksanaan
                                            Vaksinasi
                                            Bagi Jamaah Haji dan Umrah</li>
                                        <li>SE Plt Direktur Jenderal Penanggulangan Penyakit Nomor SR.02.04/C/173/2025
                                            tentang Penerapan
                                            electronic Certificate of Vaccination or Prophylaxis (eICV) atau Sertifikat
                                            Vaksinasi
                                            Internasional atau Profilaksis secara Elektronik</li>
                                        <li>Standar Operasional Prosedur Nasional Kegiatan Kantor Kesehatan Pelabuhan di
                                            Pintu Masuk
                                            Negara Tahun 2009 Direktorat Jenderal PP & PL Departemen Kesehatan Republik
                                            Indonesia</li>
                                        <li>International Health Regulations (IHR) Tahun 2005</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Persyaratan -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    <i class="fa fa-list-check me-2"></i> Persyaratan
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2"
                                data-bs-parent="#kemenkesAccordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Scan paspor dan melakukan registrasi online melalui alamat website:
                                            <a href="https://sinkarkes.kemkes.go.id"
                                                target="_blank">https://sinkarkes.kemkes.go.id</a>
                                            melalui komputer atau smartphone.
                                        </li>
                                        <li>Apabila hasil scan paspor kurang jelas, membawa fotokopi paspor (Minimal nama 2
                                            suku kata).</li>
                                        <li>Menunjukkan KTP asli.</li>
                                        <li>Nomor handphone/WA dan alamat email yang aktif.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Sistem, Mekanisme, Prosedur -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    <i class="fa fa-diagram-project me-2"></i> Sistem, Mekanisme, dan Prosedur
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3"
                                data-bs-parent="#kemenkesAccordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Permohonan online yang sudah di-print diserahkan ke petugas administrasi untuk
                                            diverifikasi.
                                        </li>
                                        <li>Mengisi formulir Informed Consent (Surat persetujuan dilakukan tindakan medis).
                                        </li>
                                        <li>Petugas paramedis menggunakan Alat Pelindung Diri (APD) memeriksa kesehatan
                                            pasien dan
                                            menginformasikan tentang vaksinasi serta petugas Ahli Teknologi Laboratorium
                                            Medik (ATLM)
                                            melakukan pemeriksaan urin pada Wanita Usia Subur (WUS).</li>
                                        <li>Jika tidak terdapat kontraindikasi, pasien dapat membayar PNBP vaksinasi,
                                            selanjutnya jika ada
                                            kondisi khusus/kontraindikasi pasien dikonsulkan ke dokter.</li>
                                        <li>Jika dalam pemeriksaan yang dilakukan oleh dokter terdapat kontraindikasi,
                                            pasien diberikan
                                            rujukan ke dokter ahli sesuai jenis penyakitnya.</li>
                                        <li>Petugas PNBP memproses pembayaran biaya PNBP vaksinasi internasional.</li>
                                        <li>Dokter mengecek bukti pembayaran biaya pelayanan dan melaksanakan penyuntikan
                                            vaksin.</li>
                                        <li>Petugas paramedis menerima berkas surat keterangan vaksinasi dan bukti
                                            pembayaran pelayanan
                                            untuk penerbitan International Certificate Vaccine (ICV) / Electronic
                                            International Certificate
                                            Vaccine (e-ICV).</li>
                                        <li>Petugas Paramedis/Administrasi memastikan data pemohon sudah benar dan
                                            menerbitkan ICV/e-ICV
                                            serta diverifikasi oleh Dokter.</li>
                                        <li>Petugas menyerahkan ICV ke pasien/mengirim e-ICV ke alamat email aktif pasien,
                                            serta
                                            mendokumentasikan laporannya.</li>
                                        <li>Petugas memastikan e-ICV sudah terkirim ke email pemohon dan memastikan data
                                            pemohon sudah
                                            sesuai.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Tambahkan item lain dengan ikon sesuai kebutuhan -->
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
