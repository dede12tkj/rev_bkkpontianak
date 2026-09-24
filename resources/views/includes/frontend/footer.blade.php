<style>
    .bkk-footer {
        --f-bg: var(--dark-gradient, #0d1f1e);
        --f-soft: rgba(255, 255, 255, .06);
        --f-teal: #00838a;
        --f-gold: #f6c90e;
        --f-text: #d5e2e0;
        --f-muted: #93aaa7;
        background: var(--f-bg);
        color: var(--f-text);
        border-top: 4px solid var(--f-teal);
        margin-top: 3rem;
        text-align: justify;
    }
    .bkk-footer .footer-main { padding: 3.5rem 0 2.5rem; }

    .bkk-footer .brand-link {
        display: flex; align-items: center; gap: 14px;
        text-decoration: none; margin-bottom: 1.25rem;
    }
    .bkk-footer .brand-link img { height: 84px; width: auto; }
    .bkk-footer .brand-link span { color: #fff; font-size: 1.25rem; font-weight: 600; line-height: 1.25; }
    .bkk-footer .brand-desc { color: var(--f-muted); font-size: .95rem; line-height: 1.7; max-width: 38ch; margin: 0; }

    .bkk-footer .footer-title {
        color: #fff; font-size: 1.15rem; font-weight: 600;
        margin-bottom: 1.5rem; padding-bottom: .75rem; position: relative;
    }
    .bkk-footer .footer-title::after {
        content: ""; position: absolute; left: 0; bottom: 0;
        width: 44px; height: 3px; border-radius: 2px;
        background: linear-gradient(90deg, var(--f-teal) 70%, var(--f-gold) 70%);
    }

    .bkk-footer .contact-item {
        display: flex; gap: 14px; align-items: flex-start;
        color: var(--f-text); text-decoration: none;
        margin-bottom: 1.1rem; font-size: .95rem; line-height: 1.55;
    }
    .bkk-footer a.contact-item:hover { color: #fff; }
    .bkk-footer .contact-item .ico {
        flex: 0 0 38px; height: 38px; border-radius: 10px;
        display: grid; place-items: center;
        background: var(--f-soft); color: var(--f-gold); font-size: 1rem;
    }
    .bkk-footer .contact-item .txt { padding-top: 7px; word-break: break-word; }

    .bkk-footer .social { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 1.5rem; }
    .bkk-footer .social a {
        width: 40px; height: 40px; border-radius: 10px;
        display: grid; place-items: center;
        background: var(--f-soft); color: #fff; text-decoration: none;
        transition: background .2s;
    }
    .bkk-footer .social a:hover { background: var(--f-teal); }
    .bkk-footer .social a:focus-visible,
    .bkk-footer .contact-item:focus-visible { outline: 2px solid var(--f-gold); outline-offset: 3px; }

    .bkk-footer .map-wrap {
        border-radius: 14px; overflow: hidden; line-height: 0;
        border: 1px solid rgba(255, 255, 255, .08);
    }
    .bkk-footer .map-wrap iframe { width: 100%; height: 250px; border: 0; }

    .bkk-footer .footer-bottom {
        background: #051614;
        padding: 1.1rem 0; text-align: center;
        color: #EDF7F5; font-size: .875rem;
    }

    @media (max-width: 991.98px) {
        .bkk-footer .footer-main { padding: 2.5rem 0 1.5rem; }
        .bkk-footer .brand-desc { max-width: none; }
    }
</style>

<footer class="bkk-footer">
    <div class="container footer-main">
        <div class="row gy-5 gx-lg-5">

            <div class="col-lg-4 col-md-12">
                <a href="#navbar" class="brand-link">
                    <img src="{{ asset('frontend/img/logokarantina.png') }}" alt="Logo BKK Kelas I Pontianak">
                    <span>BKK Kelas I<br>Pontianak</span>
                </a>
                <p class="brand-desc">{{ $footer->text }}</p>
            </div>

            <div class="col-lg-4 col-md-6">
                <h3 class="footer-title">Kontak Kami</h3>

                <div class="contact-item">
                    <span class="ico"><i class="bi bi-geo-alt"></i></span>
                    <span class="txt">{{ $footer->alamat }}</span>
                </div>

                <a class="contact-item" href="mailto:{{ $footer->email }}">
                    <span class="ico"><i class="bi bi-envelope-open"></i></span>
                    <span class="txt">{{ $footer->email }}</span>
                </a>

                <a class="contact-item" href="tel:{{ preg_replace('/[^0-9+]/', '', $footer->no_telp) }}">
                    <span class="ico"><i class="bi bi-telephone"></i></span>
                    <span class="txt">{{ $footer->no_telp }}</span>
                </a>

                <div class="social">
                    <a href="{{ $sosmed->ig }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $sosmed->tiktok }}" target="_blank" rel="noopener" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    <a href="{{ $sosmed->twitter }}" target="_blank" rel="noopener" aria-label="X (Twitter)"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $sosmed->fb }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $sosmed->yt }}" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="{{ $sosmed->wa }}" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <h3 class="footer-title">Lokasi Kami</h3>
                <div class="map-wrap">
                    <iframe
                        title="Peta lokasi BKK Kelas I Pontianak"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7979.615126851328!2d109.39814519357907!3d-0.1330469999999918!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d50235e926d8f%3A0xb360d28cf24e43ac!2sBalai%20Kekarantinaan%20Kesehatan%20Kelas%20I%20Pontianak!5e0!3m2!1sid!2sid!4v1764179846444!5m2!1sid!2sid"
                        allowfullscreen loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            &copy; {{ date('Y') }} Balai Kekarantinaan Kesehatan Kelas I Pontianak
        </div>
    </div>
</footer>