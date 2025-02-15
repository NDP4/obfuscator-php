# PHP Code Obfuscator

Aplikasi web untuk mengamankan kode PHP melalui teknik obfuscation dan enkripsi. Dibuat dengan Laravel dan Tailwind CSS.

![PHP Obfuscator Screenshot](public/images/screenshot.png)

## Fitur

- 🔒 Pengacakan nama fungsi
- 🎯 Pengacakan nama variabel
- 🔐 Enkripsi string dengan AES-256-CBC
- 📦 Minifikasi kode
- 🚀 Antarmuka modern dan responsif
- 📋 Fitur salin & tempel kode
- 🌐 Mendukung semua versi PHP modern

## Teknologi

- Laravel 11.x
- Tailwind CSS
- PHP 8.4
- JavaScript (Vanilla)

## Instalasi

1. Clone repositori
```bash
git clone https://github.com/yourusername/php-obfuscator.git
cd php-obfuscator
```

2. Install dependensi
```bash
composer install
npm install
```

3. Siapkan environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Konfigurasi database di .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=obfuscator
DB_USERNAME=root
DB_PASSWORD=
```

5. Tambahkan OBFUSCATOR_KEY di .env (32 karakter)
```
OBFUSCATOR_KEY=your-secret-key-must-be-32-chars-long
```

6. Jalankan migrasi
```bash
php artisan migrate
```

7. Build assets
```bash
npm run build
```

8. Jalankan server
```bash
php artisan serve
```

## Penggunaan

1. Buka aplikasi di browser
2. Tempel kode PHP yang ingin diobfuscate
3. Pilih opsi pengacakan yang diinginkan
4. Klik tombol "Acak Kode"
5. Salin hasil pengacakan

## Keamanan

- Menggunakan AES-256-CBC untuk enkripsi string
- Mengacak nama fungsi dan variabel
- Menghapus komentar dan whitespace
- Menyembunyikan logika program

## Author

NDP © 2024

## Lisensi

Aplikasi ini dilisensikan di bawah [MIT License](LICENSE).
