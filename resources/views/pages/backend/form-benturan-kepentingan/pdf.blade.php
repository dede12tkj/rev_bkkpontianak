<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Kontak Kami</title>

    <style>
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
            background: #f9f9f9;
            padding: 20px;
        }

        .container {
            max-width: 720px;
            margin: auto;
            background: #fff;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border: 1px solid #ddd;
        }

        /* ======================
           KOP
        ====================== */

        .kop {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .kop img {
            width: 300px;
            height: auto;
        }

        .kop-text {
            margin-left: 20px;
        }

        .kop-text div {
            font-weight: bold;
            line-height: 1.5;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
            font-size: 16px;
        }

        /* ======================
           CONTENT
        ====================== */

        .content {
            margin-top: 30px;
        }

        .item {
            margin-bottom: 18px;
            line-height: 1.8;
        }

        .label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        }

        .pesan-box {
            border: 1px solid #000;
            padding: 15px;
            margin-top: 10px;
            min-height: 150px;
            border-radius: 5px;
        }

        /* ======================
           FOOTER
        ====================== */

        .footer {
            margin-top: 60px;
        }

        .ttd {
            width: 250px;
            float: right;
            text-align: center;
        }

        .ttd .nama {
            margin-top: 80px;
            font-weight: bold;
            text-decoration: underline;
        }

        /* ======================
           BUTTON
        ====================== */

        .action {
            margin-bottom: 20px;
            text-align: right;
        }

        .btn-print {
            background: #dc3545;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* ======================
           PRINT
        ====================== */

        @media print {

            body {
                background: #fff;
                padding: 0;
            }

            .container {
                border: none;
                border-radius: 0;
                box-shadow: none;
                padding: 0;
                width: 100%;
                margin: 0;
            }

            .action {
                display: none;
            }

        }
    </style>

</head>

<body>

    <div class="container">

        {{-- BUTTON PRINT --}}
        <div class="action">
            <button onclick="window.print()" class="btn-print">
                Print / Download PDF
            </button>
        </div>

        <!-- KOP SURAT -->
        

        <div class="judul" style="">
            LAPORAN KONFLIK KEPENTINGAN DI LINGKUNGAN
            BALAI KEKARANTINAAN KESEHATAN KELAS I PONTIANAK

        </div>

        {{-- CONTENT --}}
        {{-- CONTENT --}}
        <div class="content">

            <p>
                Yth.<br>
                <strong>Kepala Balai Kekarantinaan Kesehatan Kelas I Pontianak</strong><br>
                di Tempat
            </p>

            <p style="text-align: justify; margin-top: 25px;">

                Berdasarkan Peraturan Menteri Kesehatan Nomor 24 Tahun 2019 tentang
                Pedoman Penanganan Konflik Kepentingan di Lingkungan Kementerian Kesehatan,
                bersama ini saya menyampaikan adanya potensi benturan kepentingan
                dengan rincian sebagai berikut:

            </p>

            <div style="margin-top: 30px; line-height: 2;">

                <div class="item">
                    <span class="label">Nama Lengkap</span>
                    : {{ $data->nama_lengkap }}
                </div>

                <div class="item">
                    <span class="label">Jabatan</span>
                    : {{ $data->jabatan }}
                </div>

                <div class="item">
                    <span class="label">Unit Kerja</span>
                    : {{ $data->unit_kerja }}
                </div>

                <div class="item">
                    <span class="label">Email</span>
                    : {{ $data->email }}
                </div>

                <div class="item">
                    <span class="label">Uraian Konflik</span>
                    : {{ $data->uraian_konflik }}
                </div>

                <div class="item">
                    <span class="label">Kepentingan</span>
                    : {{ $data->kepentingan }}
                </div>

                <div class="item">
                    <span class="label">Penyebab</span>
                    : {{ $data->penyebab }}
                </div>

            </div>

            <p style="text-align: justify; margin-top: 30px;">

                Demikian laporan benturan kepentingan ini disampaikan.
                Atas perhatian dan tindak lanjutnya diucapkan terima kasih.

            </p>

            {{-- TTD --}}
            <div class="footer">

                <div class="ttd">

                    <p>
                        {{ $data->tempat_laporan }},
                        {{ $data->created_at->format('d F Y') }}
                    </p>

                    <p>
                        Pelapor,
                    </p>

                    <div class="nama">
                        {{ $data->nama_lengkap }}
                    </div>

                </div>

                <div style="clear: both;"></div>

            </div>

        </div>


        {{-- FOOTER --}}


    </div>

</body>

</html>
