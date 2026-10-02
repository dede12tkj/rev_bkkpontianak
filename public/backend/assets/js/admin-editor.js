/*!
 * Perilaku bersama dashboard admin (editor, upload gambar, konfirmasi hapus, anti dobel-klik).
 * Dimuat SEKALI di layouts/back.blade.php, sesudah jQuery dan Summernote.
 * View tidak perlu lagi memuat jQuery / Summernote sendiri.
 */
(function (window, document, $) {
    'use strict';

    if (!$ || !$.fn || !$.fn.summernote) {
        if (window.console) { console.warn('[admin-editor] jQuery/Summernote belum dimuat.'); }
        return;
    }

    var CFG = window.ADMIN_CONFIG || {};
    var MAX_IMAGE_MB = 4;
    var IMAGE_TYPES = /^image\/(png|jpe?g|gif|webp)$/i;

    function notify(icon, title, text) {
        if (window.Swal) {
            window.Swal.fire({ icon: icon, title: title, text: text || '' });
        } else {
            window.alert(title + (text ? '\n' + text : ''));
        }
    }

    /* ------------------------------------------------------------------
     * 1. Upload gambar ke server (bukan base64 di database)
     * ---------------------------------------------------------------- */
    function uploadImage(file, $note, url) {
        if (!IMAGE_TYPES.test(file.type)) {
            notify('warning', 'Format tidak didukung', 'Gunakan gambar JPG, PNG, GIF, atau WebP.');
            return;
        }
        if (file.size > MAX_IMAGE_MB * 1024 * 1024) {
            notify('warning', 'Gambar terlalu besar', 'Ukuran maksimal ' + MAX_IMAGE_MB + ' MB.');
            return;
        }

        var data = new FormData();
        data.append('file', file);
        data.append('_token', CFG.csrf || '');

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            success: function (res) {
                if (res && res.url) {
                    $note.summernote('insertImage', res.url);
                } else {
                    notify('error', 'Gagal mengunggah', 'Respons server tidak valid.');
                }
            },
            error: function (xhr) {
                var json = xhr.responseJSON || {};
                notify('error', 'Gagal mengunggah', json.message || json.error || 'Gambar gagal diunggah.');
            }
        });
    }

    /* ------------------------------------------------------------------
     * 2. Bersihkan HTML hasil paste (Word / Google Docs / halaman web)
     * ---------------------------------------------------------------- */
    var DROP_TAGS = 'style,script,meta,link,title,xml,head,object,embed,iframe,form,input,button,textarea,select';
    var KEEP_ATTRS = { href: 1, src: 1, alt: 1, colspan: 1, rowspan: 1, target: 1 };

    function each(list, fn) { Array.prototype.forEach.call(list, fn); }

    function cleanPastedHtml(html) {
        var doc = document.implementation.createHTMLDocument('');
        var box = doc.createElement('div');
        box.innerHTML = html;

        each(box.querySelectorAll(DROP_TAGS), function (n) {
            if (n.parentNode) { n.parentNode.removeChild(n); }
        });
        // gambar base64 / file lokal dari clipboard tidak boleh masuk database
        each(box.querySelectorAll('img'), function (n) {
            var src = (n.getAttribute('src') || '').toLowerCase();
            if (src.indexOf('data:') === 0 || src.indexOf('file:') === 0) { n.parentNode.removeChild(n); }
        });
        each(box.querySelectorAll('span,font'), function (n) {
            if (!n.parentNode) { return; }
            while (n.firstChild) { n.parentNode.insertBefore(n.firstChild, n); }
            n.parentNode.removeChild(n);
        });
        each(box.querySelectorAll('*'), function (n) {
            each(Array.prototype.slice.call(n.attributes), function (a) {
                if (!KEEP_ATTRS[a.name.toLowerCase()]) { n.removeAttribute(a.name); }
            });
        });
        return box.innerHTML;
    }

    /* ------------------------------------------------------------------
     * 3. Default Summernote untuk SEMUA view
     *    (opsi per view tetap menang; callback digabung, bukan diganti)
     * ---------------------------------------------------------------- */
    var DEFAULT_CALLBACKS = {
        onInit: function () {
            // textarea ber-"required" disembunyikan Summernote, sehingga browser
            // memblok submit tanpa pesan. Validasi dipindah ke handler submit di bawah.
            var $ta = $(this);
            if ($ta.prop('required')) {
                $ta.prop('required', false).attr('data-editor-required', '1');
            }
        },
        onImageUpload: function (files) {
            var $note = $(this);
            var url = $note.attr('data-upload-url') || CFG.uploadUrl;
            each(files, function (f) { uploadImage(f, $note, url); });
        },
        onPaste: function (e) {
            var ev = e.originalEvent || e;
            var cd = ev.clipboardData || window.clipboardData;
            if (!cd) { return; }
            var html = cd.getData('text/html');
            if (!html) { return; }
            e.preventDefault();
            document.execCommand('insertHTML', false, cleanPastedHtml(html));
        }
    };

    var DEFAULTS = { height: 300 };
    var originalSummernote = $.fn.summernote;

    $.fn.summernote = function (arg) {
        var isInit = arg === undefined || $.isPlainObject(arg);
        if (!isInit) {
            return originalSummernote.apply(this, arguments);   // pemanggilan metode: 'code', 'insertImage', dst.
        }

        var user = arg || {};
        var opts = $.extend({}, DEFAULTS, user);
        var cb = $.extend({}, DEFAULT_CALLBACKS, user.callbacks || {});

        if (user.callbacks && user.callbacks.onInit) {
            cb.onInit = function () {
                DEFAULT_CALLBACKS.onInit.apply(this, arguments);
                return user.callbacks.onInit.apply(this, arguments);
            };
        }
        opts.callbacks = cb;
        return originalSummernote.call(this, opts);
    };

    /* ------------------------------------------------------------------
     * 4. Submit: validasi isi editor -> konfirmasi -> kunci tombol
     * ---------------------------------------------------------------- */
    function lockForm(form) {
        if (form.target === '_blank' || form.hasAttribute('data-no-lock')) { return; }
        var $btns = $(form).find('button[type=submit], button:not([type]), input[type=submit]');
        $btns.prop('disabled', true);
        // jaga-jaga untuk form yang menghasilkan unduhan (halaman tidak berpindah)
        setTimeout(function () { $btns.prop('disabled', false); }, 20000);
    }

    // (a) editor wajib diisi
    document.addEventListener('submit', function (e) {
        var form = e.target;
        if (!(form instanceof HTMLFormElement)) { return; }

        var empty = null;
        $(form).find('textarea[data-editor-required]').each(function () {
            if (!$(this).next('.note-editor').length) { return; }
            if ($(this).summernote('isEmpty')) { empty = this; return false; }
        });

        if (empty) {
            e.preventDefault();
            e.stopImmediatePropagation();
            notify('warning', 'Isi belum diisi', 'Kolom isi tidak boleh kosong.');
            $(empty).summernote('focus');
        }
    }, true);

    // (b) konfirmasi: form DELETE otomatis, atau elemen ber-atribut data-confirm="pesan"
    document.addEventListener('submit', function (e) {
        var form = e.target;
        if (!(form instanceof HTMLFormElement) || e.defaultPrevented) { return; }
        if (form.getAttribute('data-confirmed') === '1') { return; }

        var submitter = e.submitter || null;
        var msg = (submitter && submitter.getAttribute('data-confirm')) || form.getAttribute('data-confirm');

        if (!msg) {
            var method = form.querySelector('input[name="_method"]');
            if (method && String(method.value).toUpperCase() === 'DELETE') {
                msg = 'Data yang dihapus tidak bisa dikembalikan.';
            }
        }
        if (!msg || msg === 'false' || !window.Swal) { return; }

        e.preventDefault();
        e.stopImmediatePropagation();

        window.Swal.fire({
            title: 'Yakin?',
            text: msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, lanjutkan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc3545',
            reverseButtons: true
        }).then(function (r) {
            if (r.isConfirmed) {
                form.setAttribute('data-confirmed', '1');
                lockForm(form);
                HTMLFormElement.prototype.submit.call(form);
            }
        });
    }, true);

    // (c) cegah dobel-klik (setelah semua handler lain berjalan)
    document.addEventListener('submit', function (e) {
        var form = e.target;
        if (!(form instanceof HTMLFormElement)) { return; }
        setTimeout(function () {
            if (!e.defaultPrevented) { lockForm(form); }
        }, 0);
    });

    window.addEventListener('pageshow', function (ev) {
        if (ev.persisted) { $('form button:disabled').prop('disabled', false); }
    });

})(window, document, window.jQuery);
