<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;

/**
 * Penyaring HTML berbasis daftar putih untuk isi editor.
 * Membuang script, atribut on*, URL javascript:, iframe dari domain tak dikenal, dst.
 * Tag/atribut yang aman (judul, daftar, tabel, link, gambar, video YouTube) dipertahankan.
 */
class HtmlSanitizer
{
    private const ALLOWED_TAGS = [
        'p', 'br', 'hr', 'div', 'span', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
        'strong', 'b', 'em', 'i', 'u', 's', 'strike', 'del', 'ins', 'sub', 'sup', 'small', 'mark',
        'blockquote', 'pre', 'code', 'ul', 'ol', 'li', 'dl', 'dt', 'dd',
        'a', 'img', 'figure', 'figcaption',
        'table', 'thead', 'tbody', 'tfoot', 'tr', 'th', 'td', 'caption', 'colgroup', 'col',
        'iframe', 'video', 'source',
    ];

    /** Tag berbahaya: dibuang beserta isinya. */
    private const DROP_TAGS = [
        'script', 'style', 'object', 'embed', 'applet', 'form', 'input', 'button', 'textarea', 'select',
        'option', 'link', 'meta', 'base', 'svg', 'math', 'noscript', 'template', 'frame', 'frameset',
        'head', 'title', 'xml',
    ];

    private const GLOBAL_ATTRS = ['class', 'style', 'title', 'dir', 'lang'];

    private const TAG_ATTRS = [
        'a' => ['href', 'target', 'rel', 'name'],
        'img' => ['src', 'alt', 'width', 'height'],
        'td' => ['colspan', 'rowspan', 'width', 'height', 'align', 'valign'],
        'th' => ['colspan', 'rowspan', 'width', 'height', 'align', 'valign', 'scope'],
        'table' => ['border', 'cellpadding', 'cellspacing', 'width', 'align'],
        'col' => ['span', 'width'],
        'colgroup' => ['span', 'width'],
        'ol' => ['type', 'start'],
        'ul' => ['type'],
        'iframe' => ['src', 'width', 'height', 'frameborder', 'allowfullscreen', 'title'],
        'video' => ['src', 'controls', 'width', 'height', 'poster'],
        'source' => ['src', 'type'],
    ];

    private const SAFE_CSS = [
        'color', 'background-color', 'font-size', 'font-weight', 'font-style', 'font-family',
        'text-align', 'text-decoration', 'text-indent', 'line-height', 'letter-spacing',
        'width', 'height', 'max-width', 'min-width', 'margin', 'margin-left', 'margin-right',
        'margin-top', 'margin-bottom', 'padding', 'padding-left', 'padding-right', 'padding-top',
        'padding-bottom', 'float', 'display', 'vertical-align', 'border', 'border-collapse',
        'border-color', 'border-style', 'border-width', 'list-style-type', 'white-space',
    ];

    private const IFRAME_HOSTS = [
        'www.youtube.com', 'youtube.com', 'www.youtube-nocookie.com', 'player.vimeo.com', 'www.google.com',
    ];

    public static function clean(?string $html): string
    {
        $html = (string) $html;
        if (trim($html) === '') {
            return '';
        }

        $previous = libxml_use_internal_errors(true);

        try {
            $dom = new DOMDocument('1.0', 'UTF-8');
            $loaded = $dom->loadHTML(
                '<?xml encoding="UTF-8"><div id="__sanitizer_root">' . $html . '</div>',
                LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING
            );

            $root = $loaded ? $dom->getElementsByTagName('div')->item(0) : null;
            if (! $root) {
                return self::fallback($html);
            }

            self::cleanChildren($root);

            $out = '';
            foreach (iterator_to_array($root->childNodes) as $child) {
                $out .= $dom->saveHTML($child);
            }

            // libxml kadang menulis karakter non-ASCII sebagai &#8211;; kembalikan ke UTF-8
            $out = mb_decode_numericentity($out, [0x80, 0x10FFFF, 0, 0x1FFFFF], 'UTF-8');

            return trim($out);
        } catch (\Throwable $e) {
            return self::fallback($html);
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
        }
    }

    /** Bila parsing gagal: simpan sebagai teks polos yang aman. */
    private static function fallback(string $html): string
    {
        return nl2br(e(strip_tags($html)));
    }

    private static function cleanChildren(DOMNode $parent): void
    {
        foreach (iterator_to_array($parent->childNodes) as $node) {
            if ($node instanceof DOMElement) {
                self::cleanElement($node);
            } elseif ($node->nodeType === XML_COMMENT_NODE || $node->nodeType === XML_PI_NODE
                || $node->nodeType === XML_CDATA_SECTION_NODE) {
                $parent->removeChild($node);
            }
        }
    }

    private static function cleanElement(DOMElement $el): void
    {
        $tag = strtolower($el->tagName);

        if (in_array($tag, self::DROP_TAGS, true)) {
            $el->parentNode->removeChild($el);
            return;
        }

        if (! in_array($tag, self::ALLOWED_TAGS, true)) {
            // tag tak dikenal: buang tagnya, pertahankan isinya
            self::cleanChildren($el);
            while ($el->firstChild) {
                $el->parentNode->insertBefore($el->firstChild, $el);
            }
            $el->parentNode->removeChild($el);
            return;
        }

        self::cleanAttributes($el, $tag);

        if ($tag === 'iframe' && ! self::iframeAllowed($el)) {
            $el->parentNode->removeChild($el);
            return;
        }
        if ($tag === 'a' && strtolower((string) $el->getAttribute('target')) === '_blank') {
            $el->setAttribute('rel', 'noopener noreferrer');
        }

        self::cleanChildren($el);
    }

    private static function cleanAttributes(DOMElement $el, string $tag): void
    {
        $allowed = array_merge(self::GLOBAL_ATTRS, self::TAG_ATTRS[$tag] ?? []);

        foreach (iterator_to_array($el->attributes) as $attr) {
            $name = strtolower($attr->name);

            if (! in_array($name, $allowed, true)) {
                $el->removeAttribute($attr->name);
                continue;
            }

            $value = (string) $attr->value;

            if ($name === 'href' && ! self::safeUrl($value, ['http', 'https', 'mailto', 'tel'], false)) {
                $el->removeAttribute($attr->name);
            } elseif (in_array($name, ['src', 'poster'], true)) {
                $dataImage = ($tag === 'img');
                if (! self::safeUrl($value, ['http', 'https'], $dataImage)) {
                    $el->removeAttribute($attr->name);
                }
            } elseif ($name === 'style') {
                $css = self::cleanStyle($value);
                if ($css === '') {
                    $el->removeAttribute($attr->name);
                } else {
                    $el->setAttribute('style', $css);
                }
            } elseif ($name === 'target' && ! in_array(strtolower($value), ['_blank', '_self'], true)) {
                $el->removeAttribute($attr->name);
            }
        }
    }

    private static function safeUrl(string $url, array $schemes, bool $allowDataImage): bool
    {
        $url = trim(preg_replace('/[\x00-\x20\x7F]+/', '', $url) ?? '');
        if ($url === '') {
            return false;
        }
        if ($url[0] === '/' || $url[0] === '#' || $url[0] === '?') {
            return true;
        }
        if (! preg_match('/^([a-z][a-z0-9+.\-]*):/i', $url, $m)) {
            return true; // URL relatif
        }

        $scheme = strtolower($m[1]);
        if (in_array($scheme, $schemes, true)) {
            return true;
        }

        return $allowDataImage
            && (bool) preg_match('#^data:image/(png|jpe?g|gif|webp);base64,#i', $url);
    }

    private static function cleanStyle(string $style): string
    {
        $clean = [];

        foreach (explode(';', $style) as $decl) {
            if (strpos($decl, ':') === false) {
                continue;
            }
            [$prop, $val] = array_map('trim', explode(':', $decl, 2));
            $prop = strtolower($prop);

            if (! in_array($prop, self::SAFE_CSS, true) || $val === '') {
                continue;
            }
            if (preg_match('/url\s*\(|expression|javascript|@import|behavior|binding|\\\\|<|>/i', $val)) {
                continue;
            }
            $clean[] = $prop . ': ' . $val;
        }

        return implode('; ', $clean);
    }

    private static function iframeAllowed(DOMElement $el): bool
    {
        $src = trim((string) $el->getAttribute('src'));
        $parts = parse_url($src);
        if (! $parts || ($parts['scheme'] ?? '') !== 'https' || empty($parts['host'])) {
            return false;
        }

        $host = strtolower($parts['host']);
        $path = $parts['path'] ?? '';

        if (! in_array($host, self::IFRAME_HOSTS, true)) {
            return false;
        }
        if ($host === 'www.google.com') {
            return str_starts_with($path, '/maps/embed');
        }
        if (str_contains($host, 'youtube')) {
            return str_starts_with($path, '/embed/');
        }

        return str_starts_with($path, '/video/');
    }
}
