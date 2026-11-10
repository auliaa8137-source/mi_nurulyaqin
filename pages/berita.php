<?php
require_once __DIR__ . '/../config/koneksi.php';

// AMBIL DATA BERITA
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM berita ORDER BY tanggal DESC, id DESC"
);

if (!$query) {
    die("Gagal mengambil berita: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Berita - MI Nurul Yaqin Tampumia</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f8f3;
            color: #333;
        }

        /* BANNER BERITA */
        .header-berita {
    min-height: 400px;
    padding: 90px 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;

    background:
        linear-gradient(
            rgba(16, 76, 50, 0.70),
            rgba(16, 76, 50, 0.70)
        ),
        url("../assets/images/foto8.jpeg");

    background-size: cover;
    background-position: center;
    color: white;
    border-bottom: 5px solid #d8ae52;
}

        /* KONTEN */
        .container {
            max-width: 1150px;
            margin: 40px auto;
            padding: 20px;
        }

        .container h2 {
            color: #176b45;
            margin-bottom: 20px;
        }

        /* FORM TAMBAH BERITA */
        .form-berita {
            background: white;
            padding: 28px;
            border-radius: 15px;
            box-shadow: 0 5px 18px rgba(0,0,0,0.08);
            border-top: 4px solid #d8ae52;
            margin-bottom: 45px;
        }

        .form-berita label {
            display: block;
            margin-top: 17px;
            margin-bottom: 8px;
            font-weight: bold;
            color: #176b45;
        }

        .form-berita input,
        .form-berita textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #d5dfd5;
            border-radius: 8px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .form-berita input:focus,
        .form-berita textarea:focus {
            outline: none;
            border-color: #176b45;
        }

        .form-berita button {
            margin-top: 22px;
            padding: 13px 25px;
            background: #176b45;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .form-berita button:hover {
            background: #104c32;
        }

        /* DAFTAR BERITA */
        .daftar-berita {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .kartu-berita {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 18px rgba(0,0,0,0.08);
            border-bottom: 4px solid #d8ae52;
            transition: 0.3s;
            overflow-wrap: anywhere;
        }

        .kartu-berita:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 22px rgba(0,0,0,0.13);
        }

        .gambar-berita {
            width: 100%;
            height: 210px;
            object-fit: cover;
            border-radius: 10px;
        }

        .kartu-berita h3 {
            color: #176b45;
            font-size: 20px;
            line-height: 1.5;
        }

        .kartu-berita p {
            line-height: 1.8;
            font-size: 14px;
            text-align: justify;
        }

        .tanggal {
            color: #98752c;
            font-size: 13px !important;
            font-weight: bold;
        }

        /* TOMBOL EDIT DAN HAPUS */
        .tombol-edit,
        .tombol-hapus {
            display: inline-block;
            margin-top: 10px;
            margin-right: 5px;
            padding: 10px 13px;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
        }

        .tombol-edit {
            background: #176b45;
        }

        .tombol-hapus {
            background: #b83a3a;
        }

        .tombol-edit:hover,
        .tombol-hapus:hover {
            opacity: 0.85;
        }

        /* TOMBOL KEMBALI */
        .kembali {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 22px;
            background: #176b45;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        /* RESPONSIVE */
        @media (max-width: 750px) {
            .daftar-berita {
                grid-template-columns: repeat(2, 1fr);
            }

            .header-berita {
                min-height: 200px;
            }
        }

        @media (max-width: 500px) {
            .daftar-berita {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 15px;
            }

    
        }
    </style>
</head>

<body>

<?php include __DIR__ . '/../components/header.php'; ?>

<section class="header-berita">
    <h1>Berita Madrasah</h1>
    <p>Informasi dan Dokumentasi Kegiatan</p>
    <p>MI Nurul Yaqin Tampumia</p>
</section>
<main class="container">


    <h2>Berita Terbaru</h2>

    <div class="daftar-berita">

        <?php if (mysqli_num_rows($query) > 0): ?>

            <?php while ($berita = mysqli_fetch_assoc($query)): ?>

                <article class="kartu-berita">

                    <?php if (!empty($berita['gambar'])): ?>
                        <img
                            class="gambar-berita"
                            src="../assets/images/<?= htmlspecialchars($berita['gambar']); ?>"
                            alt="<?= htmlspecialchars($berita['judul']); ?>"
                        >
                    <?php endif; ?>

                    <p class="tanggal">
                        <?= htmlspecialchars($berita['tanggal']); ?>
                    </p>

                    <h3>
                        <?= htmlspecialchars($berita['judul']); ?>
                    </h3>

                    <p>
                        <?= nl2br(htmlspecialchars($berita['isi'])); ?>
                    </p>

                </article>

            <?php endwhile; ?>

        <?php else: ?>

            <p>Belum ada berita yang tersedia.</p>

        <?php endif; ?>

    </div>

    <a href="../index.php" class="kembali">
        Kembali ke Beranda
    </a>

</main>

<?php include __DIR__ . '/../components/footer.php'; ?>

</body>
</html>