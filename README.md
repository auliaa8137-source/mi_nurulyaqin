import pypandoc

markdown = """# Website MI Nurul Yaqin Tampumia

Website profil sekolah **MI Nurul Yaqin Tampumia** dibuat menggunakan PHP dan MySQL. Website ini digunakan untuk menyampaikan informasi madrasah kepada pengunjung, seperti profil, berita, galeri, visi dan misi, serta informasi kontak.

## 1. Teknologi yang Digunakan

- PHP
- MySQL
- HTML
- CSS
- JavaScript
- XAMPP (Apache dan MySQL)
- Visual Studio Code

## 2. Struktur Folder Proyek

```text
MI_NURULYAQIN/
├── admin/
│   ├── dashboard.php
│   ├── edit-berita.php
│   ├── hapus-berita.php
│   ├── login.php
│   ├── logout.php
│   └── tambah-berita.php
│
├── assets/
│   ├── images/
│   └── js/
│       └── script.js
│
├── components/
│   ├── footer.php
│   └── header.php
│
├── config/
│   └── koneksi.php
│
├── databases/
│   └── mi_nurulyaqin.sql
│
├── pages/
│   ├── berita.php
│   ├── galeri.php
│   ├── kontak.php
│   ├── profil.php
│   ├── proses_kontak.php
│   └── visi-misi.php
│
├── index.php
└── tes-koneksi.php
```

## 3. Fungsi Folder dan File

| Folder/File | Fungsi |
|---|---|
| `admin/` | Menyimpan halaman pengelolaan berita dan autentikasi admin. |
| `admin/login.php` | Halaman login administrator. |
| `admin/dashboard.php` | Halaman utama dashboard admin untuk mengelola berita. |
| `admin/tambah-berita.php` | Form untuk menambahkan berita. |
| `admin/edit-berita.php` | Halaman untuk mengubah berita. |
| `admin/hapus-berita.php` | Proses penghapusan berita. |
| `admin/logout.php` | Mengakhiri sesi administrator. |
| `assets/images/` | Menyimpan foto, logo, dan gambar yang digunakan website. |
| `assets/js/` | Menyimpan file JavaScript. |
| `components/` | Menyimpan komponen yang digunakan berulang, seperti header dan footer. |
| `config/koneksi.php` | Mengatur koneksi PHP dengan database MySQL. |
| `databases/mi_nurulyaqin.sql` | File ekspor database untuk diimpor melalui phpMyAdmin. |
| `pages/` | Menyimpan halaman informasi website. |
| `index.php` | Halaman utama website. |
| `tes-koneksi.php` | File untuk menguji koneksi database. |

## 4. Fitur Website

### Halaman Pengunjung

- **Beranda:** halaman utama website MI Nurul Yaqin Tampumia.
- **Profil:** menampilkan informasi dan sejarah madrasah, informasi pendidikan, sambutan kepala madrasah, serta data tenaga pendidik yang diambil dari database.
- **Berita:** menampilkan informasi dan berita terbaru madrasah.
- **Galeri:** menampilkan dokumentasi kegiatan dan lingkungan madrasah.
- **Visi dan Misi:** menampilkan visi serta misi madrasah.
- **Kontak:** menampilkan informasi kontak dan formulir pesan.

### Halaman Administrator

- Login administrator.
- Dashboard pengelolaan.
- Menambahkan berita.
- Mengedit berita.
- Menghapus berita.
- Logout administrator.

Pengunjung umum dapat membaca berita, sedangkan pengelolaan berita dilakukan melalui halaman administrator.

## 5. Cara Menjalankan Website

1. Pastikan XAMPP sudah terpasang di komputer.
2. Salin folder proyek `MI_NURULYAQIN` ke dalam folder `htdocs`.
3. Jalankan **Apache** dan **MySQL** melalui XAMPP Control Panel.
4. Buka phpMyAdmin melalui alamat `http://localhost/phpmyadmin`.
5. Buat database dengan nama `mi_nurulyaqin`.
6. Pilih database tersebut, lalu impor file `databases/mi_nurulyaqin.sql`.
7. Buka file `config/koneksi.php` dan sesuaikan host, username, password, serta nama database dengan pengaturan MySQL di komputer.
8. Buka website melalui browser dengan alamat:

   `http://localhost/mi_nurulyaqin/`

## 6. Pengaturan Koneksi Database

Pastikan konfigurasi di `config/koneksi.php` sesuai dengan pengaturan MySQL lokal. Contoh konfigurasi umum XAMPP:

```php
<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "mi_nurulyaqin";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
```

Jika isi file koneksi yang sudah digunakan berbeda, pertahankan konfigurasi proyek yang berjalan dan sesuaikan hanya bagian yang diperlukan.

## 7. Catatan Pengembangan

- Simpan seluruh gambar website di folder `assets/images/`.
- Pastikan nama file gambar yang dipanggil di kode sama dengan nama file yang tersimpan.
- Sebelum mengubah kode halaman yang sudah berjalan, buat salinan cadangan terlebih dahulu.
- Jangan membagikan password administrator atau kredensial database.
- File `tes-koneksi.php` sebaiknya dihapus atau dinonaktifkan setelah tidak diperlukan lagi.
- Pastikan data guru dan berita sudah tersedia di database agar dapat ditampilkan pada halaman website.

## 8. Identitas Proyek

- **Nama proyek:** Website MI Nurul Yaqin Tampumia
- **Jenis proyek:** Website profil madrasah
- **Bahasa pemrograman:** PHP
- **Database:** MySQL
- **Lingkungan pengembangan:** XAMPP dan Visual Studio Code
"""

output_path = "/mnt/data/README.md"
pypandoc.convert_text(
    markdown,
    "md",
    format="md",
    outputfile=output_path,
    extra_args=["--standalone"]
)
print(output_path)
