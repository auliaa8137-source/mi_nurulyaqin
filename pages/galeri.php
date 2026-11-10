<?php
require_once __DIR__ . '/../config/koneksi.php';
include __DIR__ . '/../components/header.php';

$query = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");

if (!$query) {
    die("Gagal mengambil data galeri: " . mysqli_error($koneksi));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - MI Nurul Yaqin Tampumia</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f8f3;
            color: #26382b;
        }

        /* BANNER GALERI */
.header-galeri {
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
        url("../assets/images/foto11.jpeg");

    background-size: cover;
    background-position: center;
    color: white;
    border-bottom: 5px solid #d8ae52;
}

.header-galeri h1 {
    font-size: 42px;
    margin-bottom: 10px;
}

.header-galeri p {
    font-size: 18px;
}

        .container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 20px;
        }

        h2 {
            color: #176b3a;
            text-align: center;
            margin-bottom: 30px;
        }

        .galeri {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .foto {
            background: white;
            padding: 12px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #00000012;
        }

        .foto img {
            width: 100%;
            height: 210px;
            object-fit: cover;
            border-radius: 8px;
        }

        .foto p {
            text-align: center;
            font-weight: bold;
        }

        .kembali {
            display: inline-block;
            margin-top: 30px;
            background: #176b3a;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
        }

        @media (max-width: 700px) {
            .galeri {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 450px) {
            .galeri {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<section class="header-galeri">
    <h1>Galeri Madrasah</h1>
    <p>Dokumentasi Kegiatan MI Nurul Yaqin Tampumia</p>
</section>

<main class="container">
    <h2>Dokumentasi Kegiatan Madrasah</h2>

    <div class="galeri">

    <?php if (mysqli_num_rows($query) > 0): ?>

        <?php while ($foto = mysqli_fetch_assoc($query)): ?>

            <div class="foto">
                <img
                    src="../assets/images/<?= htmlspecialchars($foto['gambar']); ?>"
                    alt="<?= htmlspecialchars($foto['judul']); ?>"
                >

                <p><?= htmlspecialchars($foto['judul']); ?></p>

                <p><?= htmlspecialchars($foto['keterangan']); ?></p>
            </div>

        <?php endwhile; ?>

    <?php else: ?>

        <p>Belum ada foto galeri.</p>

    <?php endif; ?>

</div>

    <a href="../index.php" class="kembali">
        Kembali ke Beranda
    </a>

<?php include __DIR__ . '/../components/footer.php'; ?>

</body>
</html>