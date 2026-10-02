# Perbaikan dashboard admin BKK Pontianak

## Pasang
1. Ekstrak zip ini ke root project (timpa file), atau: `git apply perubahan.patch`
2. Jalankan test dulu (PHP tidak tersedia saat saya menulis ini, jadi belum pernah dieksekusi):
   php artisan test --filter=HtmlSanitizerTest
3. Di server setelah git pull:
   php artisan optimize:clear
   php artisan standar-pelayanan:perbaiki --dry-run
   php artisan standar-pelayanan:perbaiki

## Rollback cepat
- Matikan penyaring HTML tanpa deploy ulang: tambahkan RICHTEXT_SANITIZE=false di .env, lalu php artisan config:clear
- Kembali total: git revert commit perbaikan ini.

## Ringkasan
- Bug htmlentities (ICV) + double-escape di survey diperbaiki.
- Upload gambar: semua endpoint kini divalidasi (hanya jpg/png/gif/webp, maks 4 MB).
- Penyaring HTML (config/richtext.php) berjalan otomatis saat menyimpan.
- jQuery/Summernote dimuat sekali di layout; konfirmasi hapus, anti dobel-klik, validasi editor kosong, dan bersihkan paste dari Word ada di public/backend/assets/js/admin-editor.js.
