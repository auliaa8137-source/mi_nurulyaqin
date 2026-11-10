<?php
require_once __DIR__ . '/../config/koneksi.php';
include __DIR__ . '/../components/header.php';


$query = mysqli_query($koneksi, "SELECT * FROM visi_misi ORDER BY id ASC");

if (!$query) {
    die("Gagal mengambil data visi misi: " . mysqli_error($koneksi));
}

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

$visi = !empty($data) ? $data[0]['visi'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi dan Misi - MI Nurul Yaqin Tampumia</title>

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

        /* BANNER VISI MISI */
.header-visimisi {
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
        url("../assets/images/foto12.jpeg");

    background-size: cover;
    background-position: center;
    color: white;
    border-bottom: 5px solid #d8ae52;
}

.header-visimisi h1 {
    margin: 0 0 12px;
    font-size: 42px;
}

.header-visimisi p {
    margin: 0;
    color: #f5dfaa;
    font-size: 18px;
}
        main {
            max-width: 950px;
            margin: 40px auto;
            padding: 20px;
        }

        .kartu {
            background: white;
            padding: 30px;
            margin-bottom: 25px;
            border-radius: 16px;
            box-shadow: 0 5px 20px #00000012;
            border-left: 6px solid #d8ae52;
        }

        .label {
            color: #b68b32;
            font-weight: bold;
            letter-spacing: 2px;
            font-size: 13px;
        }

        h2 {
            color: #176b45;
            margin: 10px 0 15px;
            font-size: 25px;
        }

        .isi-visi {
            font-size: 18px;
            line-height: 1.8;
        }

        .daftar-misi {
            display: grid;
            gap: 15px;
        }

        .item-misi {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            background: #f5faf5;
            padding: 18px;
            border-radius: 12px;
            line-height: 1.7;
        }

        .nomor {
            min-width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #176b45;
            color: white;
            border-radius: 50%;
            font-weight: bold;
        }

        .kembali {
            display: inline-block;
            background: #176b45;
            color: white;
            padding: 13px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .kembali:hover {
            background: #104c32;
        }

        footer {
            text-align: center;
            background: #104c32;
            color: white;
            padding: 20px;
            margin-top: 40px;
        }

        @media (max-width: 600px) {
            header h1 {
                font-size: 25px;
            }

            main {
                margin: 20px auto;
                padding: 15px;
            }

            .kartu {
                padding: 22px;
            }
        }
    </style>
</head>

<body>
<section class="header-visimisi">
    <h1>Visi dan Misi Madrasah</h1>
    <p>MI Nurul Yaqin Tampumia</p>
</section>
<main>

    <section class="kartu">
        <div class="label">ARAH DAN TUJUAN MADRASAH</div>
        <h2>Visi Madrasah</h2>

        <p class="isi-visi">
            <?= htmlspecialchars($visi); ?>
        </p>
    </section>

    <section class="kartu">
        <div class="label">LANGKAH UNTUK MENCAPAI VISI</div>
        <h2>Misi Madrasah</h2>

        <div class="daftar-misi">

            <?php
            $nomor = 1;
            foreach ($data as $item):
            ?>

                <div class="item-misi">
                    <div class="nomor"><?= $nomor++; ?></div>
                    <div><?= htmlspecialchars($item['misi']); ?></div>
                </div>

            <?php endforeach; ?>

            <?php if (empty($data)): ?>
                <p>Data visi dan misi belum tersedia.</p>
            <?php endif; ?>

        </div>
    </section>

    <a href="../index.php" class="kembali">
        ← Kembali ke Beranda
    </a>

</main>

<?php include __DIR__ . '/../components/footer.php'; ?>

</body>
</html>