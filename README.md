# Aplikasi Blog

Aplikasi Blog adalah sebuah aplikasi web yang memungkinkan pengguna untuk membuat, membaca, memperbarui, dan menghapus posting blog. Aplikasi ini dibangun dengan menggunakan Laravel, sebuah framework PHP yang kuat dan ekspresif.

## Fitur

-   Pengguna dapat mendaftar dan masuk ke akun mereka.
-   Pengguna dapat membuat, membaca, memperbarui, dan menghapus posting blog.
-   Fitur manajemen pengguna dengan peran (super-admin, admin, user).
-   Halaman admin untuk mengelola posting, kategori, dan pengguna.

## Persyaratan Sistem

-   PHP 8.1.6 atau versi yang lebih baru
-   NodeJS 19.4.0 atau versi yang lebih baru
-   Composer
-   Node Package Manager
-   Laravel 10

## Instalasi

1. Clone repositori ini ke direktori lokal Anda:

```bash
$ git clone https://github.com/HizkiaReppi/ptik21-blog.git
```

2. Masuk ke direktori proyek:

```bash
$ cd ptik21-blog
```

3. Install dependensi menggunakan Composer:

```bash
$ composer install
```

4. Install dependensi menggunakan NPM:

```bash
$ npm install
```

5. Salin file `.env-example` menjadi `.env`:

```bash
$ npm cp .env-example .env
```

6. Buat kunci aplikasi baru:

```bash
$ php artisan key:generate
```

7. Konfigurasikan koneksi database pada file `.env`:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=nama_pengguna
DB_PASSWORD=kata_sandi
```

8. Jalankan migrasi database dan pengisian data awal:

```bash
$ php artisan migrate --seed
```

9. Jalankan aplikasi:

```bash
$ php artisan serve

  dan

$ npm run dev
```

10. Akses aplikasi melalui browser dengan URL:

```bash
http://localhost:8000
```

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan ikuti langkah-langkah berikut:

1. Fork repositori ini.
2. Buat branch baru:

```bash
$ git checkout -b fitur-baru
```

3. Lakukan perubahan yang diinginkan.
4. Commit perubahan:

```bash
$ git commit -m 'Menambahkan Fitur baru'
```

5. Push ke branch yang Anda buat di repositori Anda:

```bash
$ git push origin fitur-baru
```

6. Buat pull request dari branch Anda ke branch master repositori ini.

#### Create with ❤️ by Hizkia Reppi
