# ZioneHub

ZioneHub adalah website portofolio pribadi berbasis Laravel. Pengunjung dapat melihat profil, keahlian, pendidikan, pengalaman, proyek, sertifikat, testimoni, dan artikel. Konten dikelola melalui panel admin Filament.

## Fitur

- Landing page portofolio yang mengambil konten dari database.
- Halaman detail artikel berdasarkan slug.
- Formulir kontak yang menyimpan pesan ke database, dilengkapi validasi dan pembatasan 5 kiriman per menit.
- Panel admin Filament untuk mengelola profil, pengaturan situs, keahlian, pendidikan, pengalaman, proyek, sertifikat, kategori dan artikel blog, tautan sosial, testimoni, serta pesan masuk.
- Unggah foto, berkas CV, gambar proyek, dan gambar artikel melalui panel admin.

## Teknologi

- PHP 8.3+
- Laravel 13
- Filament 3
- Vite, Tailwind CSS 4, dan JavaScript
- Database yang didukung Laravel, misalnya SQLite atau MySQL

Versi dependensi PHP dan JavaScript tercatat di `composer.lock` dan `package-lock.json`.

## Persyaratan

- PHP 8.3 atau lebih baru beserta ekstensi Laravel yang dibutuhkan.
- Composer.
- Node.js dan npm.
- SQLite atau server database lain yang dikonfigurasi di `.env`.

## Instalasi lokal

1. Pasang dependensi:

   ```bash
   composer install
   npm install
   ```

2. Siapkan konfigurasi lingkungan dan application key:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Pada Windows, salin `.env.example` menjadi `.env` menggunakan File Explorer atau PowerShell.

3. Atur koneksi database di `.env`. Konfigurasi contoh menggunakan SQLite. Pastikan file database tersedia, lalu jalankan migrasi:

   ```bash
   php artisan migrate
   ```

   Untuk SQLite, buat file `database/database.sqlite` jika belum tersedia. Untuk MySQL, isi `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` sesuai server.

4. Buat tautan penyimpanan publik agar foto dan berkas yang diunggah dapat diakses:

   ```bash
   php artisan storage:link
   ```

5. Buat akun admin:

   ```bash
   php artisan make:filament-user
   ```

6. Kompilasi aset frontend dan jalankan server:

   ```bash
   npm run build
   php artisan serve
   ```

   Buka alamat yang ditampilkan oleh Artisan (secara default `http://localhost:8000`). Untuk pengembangan frontend dengan hot reload, jalankan `npm run dev` di terminal terpisah.

## Penggunaan

- Halaman portofolio tersedia di `/`.
- Detail artikel tersedia di `/blog/{slug}`.
- Panel admin tersedia di `/admin`. Masuk menggunakan akun yang dibuat pada langkah instalasi.
- Isi profil dan pengaturan situs terlebih dahulu, lalu tambahkan konten lain dari menu panel admin.
- Pesan dari formulir kontak disimpan sebagai pesan masuk untuk ditinjau di panel admin.

## Struktur penting

| Lokasi | Keterangan |
| --- | --- |
| `app/Http/Controllers/LandingController.php` | Menyiapkan data untuk landing page dan detail artikel. |
| `app/Models/` | Model konten dan pengaturan situs. |
| `app/Filament/` | Panel admin, halaman pengaturan, dan resource pengelolaan konten. |
| `resources/views/landing.blade.php` | Tampilan utama portofolio. |
| `resources/views/` | Tampilan Blade lain, termasuk detail blog dan komponen. |
| `public/assets/` | Aset statis landing page. |
| `database/migrations/` | Skema tabel aplikasi. |
| `routes/web.php` | Rute halaman publik dan pengiriman formulir kontak. |

## Perintah pengembangan

```bash
php artisan serve
npm run dev
```

Jalankan kedua perintah di terminal terpisah. Untuk mengompilasi aset produksi, gunakan `npm run build`.

## Pengujian

Jalankan rangkaian pengujian dengan:

```bash
php artisan test
```

