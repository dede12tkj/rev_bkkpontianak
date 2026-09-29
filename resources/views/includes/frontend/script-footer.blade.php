{{--
    Script akhir halaman yang dipakai bersama oleh layouts app, detail, dan ppid.
    Menggantikan blok yang sebelumnya diduplikasi di masing-masing layout
    (jQuery 3.6.0 kedua, Bootstrap 5.3.0-alpha1 kedua, DataTables yang selalu dimuat).
    Parameter opsional: 'accessibility' => true untuk memuat widget aksesibilitas CookieYes.
--}}
<script>
    (function() {
        function ready(fn) {
            if (document.readyState !== 'loading') {
                fn();
            } else {
                document.addEventListener('DOMContentLoaded', fn);
            }
        }

        function loadScript(src, onload) {
            var s = document.createElement('script');
            s.src = src;
            s.async = true;
            if (onload) s.onload = onload;
            document.body.appendChild(s);
        }

        // Popup maklumat pelayanan (hanya jika markup modalnya ada di layout)
        ready(function() {
            var modal = document.getElementById('announcementModal');
            if (modal && window.bootstrap) {
                bootstrap.Modal.getOrCreateInstance(modal).show();
            }
        });

        // DataTables: dimuat hanya di halaman yang benar-benar punya tabel #dataTable
        ready(function() {
            if (!document.getElementById('dataTable') || !window.jQuery) return;

            var css = document.createElement('link');
            css.rel = 'stylesheet';
            css.href = 'https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css';
            document.head.appendChild(css);

            loadScript('https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js', function() {
                window.jQuery('#dataTable').DataTable();
            });
        });

        // Widget pihak ketiga: dimuat setelah halaman selesai, tidak menghambat tampilan awal
        window.addEventListener('load', function() {
            // Curator.io: hanya bila kontainer feed-nya ada di halaman
            if (document.getElementById('curator-feed-default-feed-layout')) {
                loadScript('https://cdn.curator.io/published/a39ac412-2454-437d-b5f6-c00577ed26bb.js');
            }

            @if (!empty($accessibility))
                // Widget aksesibilitas CookieYes
                window._cyA11yConfig = {
                    iconId: 'default',
                    position: {
                        mobile: 'bottom-left',
                        desktop: 'bottom-left'
                    },
                    language: {
                        default: 'id',
                        selected: []
                    }
                };
                loadScript('https://cdn-cookieyes.com/widgets/accessibility.js?id=36f0a873-5bf8-489e-be57-93c20d7c392c');
            @endif
        });
    })();
</script>
