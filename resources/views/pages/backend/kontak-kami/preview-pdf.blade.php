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
        <div class="kop">
            <img src="{{ asset('logokemenkes.png') }}" alt="Logo Kemenkes">

            <div class="kop-text">

                <div style="font-size: 26px; color: #61c0d0 ">
                    Kementerian Kesehatan
                </div>

                <div style="font-size: 20px; color: #d98f2e; margin-top: -10px">
                    BKK Pontianak
                </div>

                <div style="font-size: 12px; font-weight: normal; margin-top: 8px; line-height: 1.6;">
                    Jl. Adi Sucipto KM. 14, Sungai Raya, Kabupaten Kubu Raya, Kalimantan Barat
                </div>

                <div style="font-size: 12px; font-weight: normal;">
                    Telp: (0561) 721703
                </div>

                <div style="font-size: 12px; font-weight: normal;">
                    Website:
                    <a href="https://bkkpontianak.id" target="_blank"
                        style="color: black; text-decoration: none;">
                        www.bkkpontianak.id
                    </a>
                </div>

            </div>
        </div>

        <div class="judul" style="">
            Form Kontak Kami
        </div>

        {{-- CONTENT --}}
        {{-- CONTENT --}}
        <div class="content">

            <div class="item">
                <span class="label">Nama</span>
                : {{ $kontak->nama }}
            </div>

            <div class="item">
                <span class="label">Email</span>
                : {{ $kontak->email }}
            </div>

            <div class="item">
                <span class="label">Tanggal</span>
                : {{ $kontak->created_at->format('d F Y H:i') }}
            </div>

            <div class="item">
                <span class="label">Pesan</span>
                : {{ $kontak->pesan }}
            </div>

            {{-- Sumber --}}
            <div style="margin-top: 40px; font-size: 13px; line-height: 1.8;">

                Saluran kontak kami bersumber dari website Balai Kekarantinaan Kesehatan Kelas I Pontianak :
                https://sites.google.com/view/kkppontianak/kontak-kami

            </div>

        </div>

        {{-- FOOTER --}}


    </div>

</body>

</html>
