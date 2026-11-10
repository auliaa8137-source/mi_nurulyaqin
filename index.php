<?php
require_once __DIR__ . '/config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - MI Nurul Yaqin Tampumia</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f7f2;
            color: #26382b;
        }

        .hero {
    min-height: 450px;
    padding: 90px 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;

    background:
        linear-gradient(
            rgba(16, 76, 50, 0.70),
            rgba(16, 76, 50, 0.70)
        ),
        url("assets/images/foto7.jpeg");

    background-size: cover;
    background-position: center;
    color: white;
}
.hero h1 {
    color: #ffffff;
    font-size: 42px;
    font-weight: 800;
    text-shadow: 2px 3px 6px #f5f0f0;
}

.hero p {
    color: #ffffff;
    font-size: 18px;
    font-weight: 600;
    text-shadow: 1px 2px 5px #000000;
}

        .hero-content {
            max-width: 800px;
        }

        .hero-label {
            display: inline-block;
            background: #d8ae52;
            color: #104c32;
            padding: 9px 18px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 13px;
        }

        .hero h1 {
            color: #104c32;
            font-size: 38px;
            line-height: 1.3;
            margin: 22px 0 15px;
        }

        .hero p {
            font-size: 17px;
            line-height: 1.8;
            color: #526456;
        }

        .tombol-profil {
            display: inline-block;
            margin-top: 20px;
            padding: 14px 25px;
            background: #176b45;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .tombol-profil:hover {
            background: #104c32;
        }

        .bagian-menu {
            max-width: 1100px;
            margin: 55px auto;
            padding: 20px;
        }

        .judul-bagian {
            text-align: center;
            color: #176b45;
            margin-bottom: 12px;
            font-size: 28px;
        }

        .deskripsi-bagian {
            text-align: center;
            color: #657568;
            margin-bottom: 30px;
            line-height: 1.7;
        }

        .daftar-menu {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .kartu-menu {
            background: white;
            padding: 28px 22px;
            text-align: center;
            border-radius: 15px;
            border-bottom: 5px solid #d8ae52;
            box-shadow: 0 4px 15px #00000010;
            text-decoration: none;
            color: #26382b;
            transition: 0.3s;
        }

        .kartu-menu:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px #00000018;
        }

        .ikon {
            font-size: 35px;
            margin-bottom: 12px;
        }

        .kartu-menu h3 {
            color: #176b45;
            margin: 8px 0;
        }

        .kartu-menu p {
            font-size: 14px;
            line-height: 1.7;
            color: #657568;
        }

        .sambutan {
            background: #104c32;
            color: white;
            text-align: center;
            padding: 45px 20px;
        }

        .sambutan h2 {
            color: #f5d47b;
        }

        .sambutan p {
            max-width: 750px;
            margin: auto;
            line-height: 1.8;
        }

        @media (max-width: 750px) {
            .daftar-menu {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero h1 {
                font-size: 29px;
            }
        }

        @media (max-width: 500px) {
            .daftar-menu {
                grid-template-columns: 1fr;
            }

            .hero {
                padding: 65px 18px;
            }
        }
    </style>
</head>

<body>

<?php include __DIR__ . '/components/header.php'; ?>

<section class="hero">
    <div class="hero-content">
        <span class="hero-label">SELAMAT DATANG</span>

        <h1>MI Nurul Yaqin Tampumia</h1>

        <p>
            Mewujudkan peserta didik yang beriman, berilmu,
            berakhlak mulia, mandiri, dan berprestasi.
        </p>

        <a href="pages/profil.php" class="tombol-profil">
            Kenali Madrasah Kami
        </a>
    </div>
</section>

<section class="bagian-menu">

    <h2 class="judul-bagian">Jelajahi Madrasah</h2>

    <p class="deskripsi-bagian">
        Temukan informasi mengenai MI Nurul Yaqin Tampumia
        melalui halaman berikut.
    </p>

    <div class="daftar-menu">

        <a href="pages/profil.php" class="kartu-menu">
            <div class="ikon">🏫</div>
            <h3>Profil Madrasah</h3>
            <p>Kenali sejarah dan informasi madrasah kami.</p>
        </a>

        <a href="pages/berita.php" class="kartu-menu">
            <div class="ikon">📰</div>
            <h3>Berita</h3>
            <p>Informasi dan kegiatan terbaru madrasah.</p>
        </a>

        <a href="pages/galeri.php" class="kartu-menu">
            <div class="ikon">📸</div>
            <h3>Galeri</h3>
            <p>Lihat dokumentasi kegiatan sekolah.</p>
        </a>

        <a href="pages/visi-misi.php" class="kartu-menu">
            <div class="ikon">🎯</div>
            <h3>Visi dan Misi</h3>
            <p>Kenali tujuan dan langkah madrasah.</p>
        </a>

        <a href="pages/kontak.php" class="kartu-menu">
            <div class="ikon">📍</div>
            <h3>Kontak</h3>
            <p>Temukan informasi kontak madrasah.</p>
        </a>

        <a href="pages/galeri.php" class="kartu-menu">
            <div class="ikon">🌿</div>
            <h3>Kegiatan Madrasah</h3>
            <p>Lihat berbagai aktivitas peserta didik.</p>
        </a>

    </div>
</section>

<section class="sambutan">
    <h2>Membangun Generasi Berakhlak Mulia</h2>
    <p>
        MI Nurul Yaqin Tampumia berupaya memberikan pendidikan
        dasar yang mendukung perkembangan ilmu pengetahuan,
        keimanan, karakter, dan prestasi peserta didik.
    </p>
</section>

<?php include __DIR__ . '/components/footer.php'; ?>

</body>
</html>