<?php

namespace Tests\Unit;

use App\Support\HtmlSanitizer;
use PHPUnit\Framework\TestCase;

class HtmlSanitizerTest extends TestCase
{
    public function test_membuang_script_dan_event_handler(): void
    {
        $out = HtmlSanitizer::clean('<p onclick="x()">Halo</p><script>alert(1)</script><img src="/a.png" onerror="x()">');

        $this->assertStringNotContainsString('script', $out);
        $this->assertStringNotContainsString('onclick', $out);
        $this->assertStringNotContainsString('onerror', $out);
        $this->assertStringContainsString('Halo', $out);
        $this->assertStringContainsString('src="/a.png"', $out);
    }

    public function test_memblok_link_javascript(): void
    {
        $out = HtmlSanitizer::clean('<a href="javascript:alert(1)">klik</a> <a href=" JaVaScRiPt:alert(1)">klik2</a>');

        $this->assertStringNotContainsString('javascript', strtolower($out));
        $this->assertStringContainsString('klik', $out);
    }

    public function test_mempertahankan_struktur_dokumen(): void
    {
        $html = '<h3>Judul</h3><ol><li>Satu</li><li>Dua</li></ol>'
            . '<table class="table"><thead><tr><th>A</th></tr></thead><tbody><tr><td colspan="2">B</td></tr></tbody></table>';
        $out = HtmlSanitizer::clean($html);

        $this->assertStringContainsString('<h3>Judul</h3>', $out);
        $this->assertStringContainsString('<ol>', $out);
        $this->assertStringContainsString('<li>Dua</li>', $out);
        $this->assertStringContainsString('colspan="2"', $out);
        $this->assertStringContainsString('<th>A</th>', $out);
    }

    public function test_link_aman_dipertahankan_dan_target_blank_diberi_rel(): void
    {
        $out = HtmlSanitizer::clean('<a href="https://contoh.go.id/x" target="_blank">situs</a>');

        $this->assertStringContainsString('href="https://contoh.go.id/x"', $out);
        $this->assertStringContainsString('noopener', $out);
    }

    public function test_iframe_hanya_dari_domain_yang_diizinkan(): void
    {
        $ok = HtmlSanitizer::clean('<iframe src="https://www.youtube.com/embed/abc123"></iframe>');
        $bad = HtmlSanitizer::clean('<iframe src="https://situs-jahat.example/x"></iframe>');

        $this->assertStringContainsString('youtube.com/embed/abc123', $ok);
        $this->assertStringNotContainsString('iframe', $bad);
    }

    public function test_style_difilter(): void
    {
        $out = HtmlSanitizer::clean('<p style="text-align:center; background:url(javascript:x); color:red">x</p>');

        $this->assertStringContainsString('text-align: center', $out);
        $this->assertStringContainsString('color: red', $out);
        $this->assertStringNotContainsString('url(', $out);
    }

    public function test_teks_utf8_tidak_rusak(): void
    {
        $out = HtmlSanitizer::clean('<p>Kekarantinaan Kesehatan – Pontianak “resmi”</p>');

        $this->assertStringContainsString('Kekarantinaan Kesehatan', $out);
        $this->assertStringContainsString('Pontianak', html_entity_decode($out, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        $this->assertStringContainsString('“resmi”', html_entity_decode($out, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }

    public function test_hasil_stabil_bila_disaring_dua_kali(): void
    {
        $html = '<h4>Persyaratan</h4><ul><li>A &amp; B</li></ul><p><a href="/x">lihat</a></p>';
        $once = HtmlSanitizer::clean($html);

        $this->assertSame($once, HtmlSanitizer::clean($once));
    }

    public function test_string_kosong(): void
    {
        $this->assertSame('', HtmlSanitizer::clean(null));
        $this->assertSame('', HtmlSanitizer::clean('   '));
    }
}
