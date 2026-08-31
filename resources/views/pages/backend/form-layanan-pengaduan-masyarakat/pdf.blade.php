<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Preview PDF Pengaduan Masyarakat</title>

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
            border: 1px solid #ddd;
        }

        /* KOP */
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

        /* TITLE */
        .judul {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
            font-size: 16px;
        }

        /* CONTENT */
        .content {
            margin-top: 30px;
        }

        .item {
            margin-bottom: 18px;
            line-height: 1.8;
        }

        .label {
            display: inline-block;
            width: 180px;
            font-weight: bold;
            vertical-align: top;
        }

        /* BUTTON */
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

        /* FOOTER */
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

        @media print {

            body {
                background: #fff;
                padding: 0;
            }

            .container {
                border: none;
                border-radius: 0;
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

        {{-- BUTTON --}}
        <div class="action">

            <button onclick="window.print()"
                    class="btn-print">

                Print / Download PDF

            </button>

        </div>

        

        {{-- TITLE --}}
        <div class="judul">
            Form Layanan Pengaduan Masyarakat
        </div>

        {{-- CONTENT --}}
        <div class="content">

            <p>
                Kepada Yth.<br>
                Kepala Balai Kekarantinaan Kesehatan Kelas I Pontianak
            </p>

            <p style="text-align: justify; margin-top: 25px;">

                Bersama ini saya menyampaikan laporan pengaduan masyarakat
                dengan rincian sebagai berikut:

            </p>

            <div style="margin-top: 30px;">

                <div class="item">
                    <span class="label">Nama</span>
                    : {{ $data->nama }}
                </div>

                <div class="item">
                    <span class="label">Jenis Kelamin</span>
                    : {{ $data->jenis_kelamin }}
                </div>

                <div class="item">
                    <span class="label">Usia</span>
                    : {{ $data->usia }} Tahun
                </div>

                <div class="item">
                    <span class="label">Permasalahan / Pengaduan</span>
                    : {{ $data->permasalahan_pengaduan }}
                </div>

            </div>

            <p style="text-align: justify; margin-top: 30px;">

                Demikian laporan pengaduan ini saya sampaikan.
                Atas perhatian dan tindak lanjutnya saya ucapkan terima kasih.

            </p>

        </div>

        {{-- FOOTER --}}
        <div class="footer">

            <div class="ttd">

                <p>
                    Pontianak,
                    {{ $data->created_at->format('d F Y') }}
                </p>

                <p>
                    Pelapor,
                </p>

                <div class="nama">
                    {{ $data->nama }}
                </div>

            </div>

            <div style="clear: both;"></div>

        </div>

    </div>

</body>

</html>
