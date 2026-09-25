<?php

namespace Database\Seeders;

use App\Models\SkmQuestion;
use App\Models\SkmQuestionOption;
use App\Models\SkmSection;
use App\Models\SkmSurvey;
use Illuminate\Database\Seeder;

class SkmSurveySeeder extends Seeder
{
    /**
     * Seed struktur Survei Kepuasan Masyarakat (IKM) sesuai dokumen kuesioner
     * BKK Kelas I Pontianak. Aman dijalankan ulang (idempotent) - tidak akan
     * membuat duplikat jika survey dengan slug yang sama sudah ada.
     */
    public function run(): void
    {
        if (SkmSurvey::where('slug', 'ikm-bkk-pontianak')->exists()) {
            return;
        }

        $survey = SkmSurvey::create([
            'title'       => 'Survei Kepuasan Masyarakat (IKM) BKK Kelas I Pontianak',
            'slug'        => 'ikm-bkk-pontianak',
            'description' => 'Sebagai wujud komitmen terhadap peningkatan kualitas pelayanan, '
                . 'kami mengundang Anda untuk berpartisipasi dalam Survei Indeks Kepuasan '
                . 'Masyarakat (IKM) Balai Kekarantinaan Kesehatan Kelas I Pontianak. '
                . 'Jawaban Anda akan digunakan sebagai bahan evaluasi dan perbaikan pelayanan.',
            'is_active'   => true,
        ]);

        // ============================================================
        // SECTION 1 - DATA RESPONDEN
        // ============================================================
        $section1 = $survey->sections()->create([
            'title' => 'Data Responden',
            'order' => 1,
        ]);

        $this->question($section1, 1, 'select', 'Wilayah Kerja', true, null, [
            'BKK Pontianak Induk [ Meningitis/Yellow Fever ]',
            'BKK Pontianak Pos Bandara Supadio',
            'BKK Pontianak Wilker Pelabuhan Dwikora',
            'BKK Pontianak Wilker Ketapang',
            'BKK Pontianak Wilker Padang Tikar',
            'BKK Pontianak Pos Teluk Batang',
            'BKK Pontianak Wilker Kendawangan',
            'BKK Pontianak Wilker Kijing',
        ]);

        $this->question($section1, 2, 'number', 'Usia', true);

        $this->question($section1, 3, 'radio', 'Jenis Kelamin', true, null, [
            'Laki-laki',
            'Perempuan',
        ]);

        $this->question($section1, 4, 'radio', 'Pekerjaan Utama', true, null, [
            'PNS',
            'TNI',
            'POLRI',
            'Karyawan Swasta',
            'Wiraswasta',
            'Mengurus Rumah Tangga',
            'Pelajar / Mahasiswa',
            'Belum / Tidak Bekerja',
            'Pensiunan',
            'Tidak Ingin Menyebutkan',
            ['label' => 'Other', 'allow_other' => true],
        ]);

        $this->question($section1, 5, 'radio', 'Pendidikan Terakhir', true, null, [
            'Tidak Sekolah',
            'SD',
            'SMP',
            'SMA',
            'D1 / D2',
            'D3',
            'D4 / S1',
            'Profesi',
            'S2',
            'S3',
            'Tidak Ingin Menyebutkan',
        ]);

        $this->question(
            $section1,
            6,
            'radio',
            'Maksud dan Tujuan Kunjungan Anda Ke Balai Kekarantinaan Kesehatan Kelas I Pontianak Sebagai?',
            true,
            null,
            [
                'Agen Kapal',
                'Jamaah Haji / Umroh',
                'Pasien',
                'Keluarga Pasien',
                'Pengunjung',
                'Pengguna Jasa Surat Ijin Angkut Jenazah',
            ]
        );

        $this->question(
            $section1,
            7,
            'radio',
            'Kunjungan Anda Ke Balai Kekarantinaan Kesehatan Kelas I Pontianak Dalam Rangka?',
            true,
            null,
            [
                'Vaksinasi internasional (Vaksin Meningitis dan Yellow Fever, penerbitan International Certificate Vaksin)',
                'Penerbitan Dokumen PHQC (Izin Berlayar)',
                'Penerbitan Dokumen SSCEC (Sanitasi Kapal)',
                'Penerbitan P3K Kapal',
                'Penerbitan Dokumen COP (Free Pratique)',
                'Penerbitan Buku Kesehatan (Health Book)',
                'Rujukan Orang Sakit / Kegawatdaruratan',
                'Penerbitan Dokumen Izin Angkut Orang Sakit',
                'Penerbitan Dokumen Izin Angkut Jenazah',
                'Penerbitan Dokumen Layak Terbang',
                'Informasi dan Pengaduan',
                ['label' => 'Other', 'allow_other' => true],
            ]
        );

        // ============================================================
        // SECTION 2 - KESAN PELAYANAN (SKALA 1-4)
        // ============================================================
        $section2 = $survey->sections()->create([
            'title'       => 'Kesan Pelayanan',
            'description' => 'Silahkan berikan kesan Anda selama dilayani di Balai Kekarantinaan '
                . 'Kesehatan Kelas I Pontianak, untuk setiap unsur pelayanan di bawah ini.',
            'order'       => 2,
        ]);

        $unsurPelayanan = [
            'Persyaratan',
            'Prosedur',
            'Waktu Penyelesaian',
            'Biaya/Tarif',
            'Jenis Pelayanan',
            'Kompetensi Petugas',
            'Perilaku Pelaksana',
            'Penanganan dan Pengaduan',
            'Sarana dan Prasarana',
        ];

        foreach ($unsurPelayanan as $i => $label) {
            $this->likert(
                $section2,
                $i + 1,
                $label,
                1,
                4,
                'Sangat Tidak Puas',
                'Sangat Puas'
            );
        }

        // ============================================================
        // SECTION 3 - SURVEI PERSEPSI ANTI KORUPSI (SKALA 1-6)
        // ============================================================
        $section3 = $survey->sections()->create([
            'title'       => 'Survei Persepsi Anti Korupsi',
            'description' => 'Pada bagian ini, kami meminta pendapat Anda mengenai beberapa hal '
                . 'terkait perilaku menyimpang petugas pelayanan pada unit layanan ini. '
                . 'Semakin besar nilai yang Anda berikan menunjukkan bahwa unit layanan ini '
                . 'bersih dan bebas dari penyimpangan.',
            'order'       => 3,
        ]);

        $antiKorupsi = [
            [
                'Diskriminasi Pelayanan',
                'Petugas pelayanan/sistem pelayanan online pada unit layanan ini memberikan '
                    . 'pelayanan tanpa diskriminasi dalam bentuk apapun? (pertanyaan ini disampaikan '
                    . 'untuk mengetahui apakah ada pelayanan secara khusus atau membeda-bedakan '
                    . 'pelayanan karena faktor suku, agama, kekerabatan, almamater, dan sejenisnya '
                    . 'di BKK Kelas I Pontianak)',
            ],
            [
                'Pelayanan diluar prosedur / kecurangan Prosedur',
                'Petugas pelayanan online pada unit layanan ini memberikan pelayanan sesuai '
                    . 'dengan prosedur dan tidak melakukan kecurangan pelayanan? (pertanyaan ini '
                    . 'disampaikan untuk mengetahui apakah ada pelayanan yang tidak sesuai ketentuan '
                    . 'sehingga mengindikasikan kecurangan seperti penyerobotan antrian, mempersingkat '
                    . 'waktu tunggu layanan diluar prosedur, pengurangan syarat/prosedur, pengurangan '
                    . 'denda, dll)',
            ],
            [
                'Imbalan / Hadiah',
                'Petugas pelayanan sistem pelayanan online pada unit layanan ini tidak pernah '
                    . 'meminta imbalan dalam bentuk uang/barang/fasilitas? (pertanyaan ini disampaikan '
                    . 'untuk mengetahui apakah ada petugas yang menerima atau bahkan meminta imbalan '
                    . 'berupa: 1) uang untuk alasan administrasi, transport, rokok, kopi, dll diluar '
                    . 'ketentuan, 2) barang (makanan jadi, rokok, parsel, perhiasan, elektronik, '
                    . 'pakaian, bahan pangan, dll) diluar ketentuan, 3) fasilitas akomodasi (hotel, '
                    . 'resort, perjalanan/jasa transport, komunikasi, hiburan, voucher belanja, dll) '
                    . 'diluar ketentuan',
            ],
            [
                'Pungutan Liar',
                'Petugas pelayanan/sistem pelayanan online pada unit layanan ini tidak pernah '
                    . 'melakukan praktik pungli (pungutan liar)? (pertanyaan ini disampaikan untuk '
                    . 'mengetahui apakah ada pungli dalam pelayanan yaitu permintaan pembayaran atas '
                    . 'pelayanan yang diterima pengguna layanan diluar tarif resmi - pungli dapat '
                    . 'dikamuflasekan melalui istilah seperti "uang administrasi", "uang rokok", '
                    . '"uang terima kasih")',
            ],
            [
                'Percaloan',
                'Tidak pernah ada praktik percaloan pada unit layanan ini baik yang dilakukan '
                    . 'oknum petugas maupun pihak luar? (pertanyaan ini disampaikan untuk mengetahui '
                    . 'apakah ada praktik percaloan - pihak yang melakukan percaloan dapat berasal '
                    . 'dari oknum pegawai pada unit layanan ini, maupun pihak luar yang memiliki '
                    . 'atau tidak memiliki hubungan dengan oknum pegawai)',
            ],
        ];

        foreach ($antiKorupsi as $i => [$label, $help]) {
            $this->likert(
                $section3,
                $i + 1,
                $label,
                1,
                6,
                'Sangat Tidak Sesuai',
                'Sangat Sesuai',
                $help
            );
        }

        // ============================================================
        // SECTION 4 - SURVEI PERSEPSI KUALITAS PELAYANAN (SKALA 1-6)
        // ============================================================
        $section4 = $survey->sections()->create([
            'title'       => 'Survei Persepsi Kualitas Pelayanan',
            'description' => 'Pada bagian ini, kami meminta pendapat Anda mengenai beberapa hal '
                . 'terkait kualitas pemberian pelayanan pada unit layanan ini. Semakin besar nilai '
                . 'menunjukkan unit layanan ini memiliki performa yang baik dalam pelayanannya.',
            'order'       => 4,
        ]);

        $kualitasPelayanan = [
            [
                'Informasi Pelayanan',
                'Informasi pelayanan tersedia melalui media elektronik maupun non elektronik? '
                    . '(pertanyaan bertujuan melihat apakah sistem informasi pelayanan selalu '
                    . 'tersedia, menjawab kebutuhan pengguna layanan, mudah digunakan, memiliki '
                    . 'fasilitas interaktif, dan FAQ)',
            ],
            [
                'Persyaratan',
                'Persyaratan pelayanan yang diinformasikan sesuai dengan persyaratan yang telah '
                    . 'diterapkan? (bertujuan melihat apakah informasi persyaratan pelayanan dapat '
                    . 'dipahami dengan jelas, sesuai untuk jenis/produk layanan, dan diterapkan '
                    . 'sesuai dengan yang diinformasikan)',
            ],
            [
                'Prosedur / Alur',
                'Prosedur/alur pelayanan yang ditetapkan mudah diikuti/dilakukan? (bertujuan '
                    . 'melihat apakah informasi prosedur/alur layanan dapat dipahami dengan jelas, '
                    . 'sesuai untuk jenis/produk layanan, dan diterapkan sesuai dengan informasi '
                    . 'prosedur/alur layanan)',
            ],
            [
                'Jangka Waktu Pelayanan',
                'Jangka waktu penyelesaian pelayanan yang Bapak/Ibu terima sesuai dengan yang '
                    . 'ditetapkan? (bertujuan melihat apakah informasi jangka waktu penyelesaian '
                    . 'pelayanan dapat dipahami dengan jelas, jangka waktu pelayanan tersebut wajar, '
                    . 'dan sesuai dengan yang diinformasikan)',
            ],
            [
                'Tarif / Biaya',
                'Tarif/biaya pelayanan yang dibayarkan pada unit layanan ini sesuai dengan '
                    . 'tarif/biaya yang ditetapkan? (bertujuan melihat apakah informasi biaya '
                    . 'pelayanan dapat dipahami dengan jelas, serta memastikan apakah biaya '
                    . 'pelayanan yang dibayarkan telah sesuai dengan yang diinformasikan, termasuk '
                    . 'apakah jika biaya pelayanan gratis memang benar tidak dilakukan pembayaran)',
            ],
            [
                'Sarana Prasarana',
                'Sarana prasarana pendukung pelayanan/sistem pelayanan online yang disediakan '
                    . 'unit layanan ini memberikan kenyamanan dan mudah digunakan? (bertujuan melihat '
                    . 'apakah sarana prasarana pendukung pelayanan/sistem pelayanan online sudah '
                    . 'mempermudah proses pelayanan, meringkas waktu, dan menghemat biaya)',
            ],
            [
                'Perilaku Petugas',
                'Petugas pelayanan/sistem pelayanan online pada unit layanan ini merespon '
                    . 'kebutuhan/keperluan Anda dengan cepat? (bertujuan melihat apakah petugas '
                    . 'memberikan respon pelayanan dengan cepat, mudah dikenali - memakai seragam, '
                    . 'tanda pengenal, dll - dan melayani dengan ramah, senyum, salam, sapa, sopan, '
                    . 'dan santun)',
            ],
            [
                'Layanan Pengaduan',
                'Layanan konsultasi dan pengaduan yang disediakan unit layanan ini mudah '
                    . 'digunakan/diakses? (bertujuan melihat apakah sarana layanan konsultasi dan '
                    . 'pengaduan telah tersedia secara beragam - tempat konsultasi dan pengaduan, '
                    . 'hotline, call center, media online - serta apakah prosedurnya mudah dan '
                    . 'responnya cepat dan jelas)',
            ],
        ];

        foreach ($kualitasPelayanan as $i => [$label, $help]) {
            $this->likert(
                $section4,
                $i + 1,
                $label,
                1,
                6,
                'Sangat Tidak Sesuai',
                'Sangat Sesuai',
                $help
            );
        }

        // ============================================================
        // SECTION 5 - LAINNYA
        // ============================================================
        $section5 = $survey->sections()->create([
            'title' => 'Lainnya',
            'order' => 5,
        ]);

        $this->question(
            $section5,
            1,
            'text',
            'Nama Petugas Pemberi Pelayanan',
            false
        );

        $this->question(
            $section5,
            2,
            'textarea',
            'Saran',
            false,
            'Masukan, saran, komentar, pertanyaan, atau keluhan Anda merupakan hal berharga '
                . 'bagi kami dalam rangka membangun pelayanan lebih baik lagi.'
        );
    }

    /**
     * Helper membuat satu pertanyaan pilihan (select/radio/checkbox) beserta opsinya.
     */
    private function question(
        SkmSection $section,
        int $order,
        string $type,
        string $label,
        bool $required,
        ?string $helpText = null,
        array $options = []
    ): SkmQuestion {
        $question = $section->questions()->create([
            'type'        => $type,
            'label'       => $label,
            'help_text'   => $helpText,
            'is_required' => $required,
            'order'       => $order,
        ]);

        foreach ($options as $i => $option) {
            if (is_array($option)) {
                SkmQuestionOption::create([
                    'skm_question_id' => $question->id,
                    'label'           => $option['label'],
                    'value'           => $option['label'],
                    'allow_other'     => $option['allow_other'] ?? false,
                    'order'           => $i + 1,
                ]);
            } else {
                SkmQuestionOption::create([
                    'skm_question_id' => $question->id,
                    'label'           => $option,
                    'value'           => $option,
                    'allow_other'     => false,
                    'order'           => $i + 1,
                ]);
            }
        }

        return $question;
    }

    /**
     * Helper membuat satu pertanyaan skala likert.
     */
    private function likert(
        SkmSection $section,
        int $order,
        string $label,
        int $min,
        int $max,
        string $minLabel,
        string $maxLabel,
        ?string $helpText = null
    ): SkmQuestion {
        return $section->questions()->create([
            'type'        => 'likert',
            'label'       => $label,
            'help_text'   => $helpText,
            'config'      => [
                'scale_min' => $min,
                'scale_max' => $max,
                'min_label' => $minLabel,
                'max_label' => $maxLabel,
            ],
            'is_required' => true,
            'order'       => $order,
        ]);
    }
}
