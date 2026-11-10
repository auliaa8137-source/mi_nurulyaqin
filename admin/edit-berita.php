
<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../config/koneksi.php';

// Memastikan ID berita tersedia
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID berita tidak ditemukan.");
}

$id = (int) $_GET['id'];

// Mengambil data berita
$stmt = mysqli_prepare($koneksi, "SELECT * FROM berita WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$berita = mysqli_fetch_assoc($result);

if (!$berita) {
    die("Berita tidak ditemukan.");
}

$pesan = "";

// Proses menyimpan perubahan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $isi = trim($_POST['isi'] ?? '');
    $tanggal = $_POST['tanggal'] ?? '';

    if ($judul === '' || $isi === '' || $tanggal === '') {
        $pesan = "Semua kolom wajib diisi.";
    } else {
        $update = mysqli_prepare(
            $koneksi,
            "UPDATE berita SET judul = ?, isi = ?, tanggal = ? WHERE id = ?"
        );

        mysqli_stmt_bind_param(
            $update,
            "sssi",
            $judul,
            $isi,
            $tanggal,
            $id
        );

        if (mysqli_stmt_execute($update)) {
            header("Location: dashboard.php?status=edit-berhasil");
            exit;
        } else {
            $pesan = "Berita gagal diperbarui.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Admin</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px 20px;
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: radial-gradient(circle at top left, #dcefe3, transparent 40%),
                        linear-gradient(135deg, #f3f8f4, #e8f0e9);
            color: #26382e;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 40px;
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 15px 45px rgba(13,74,43,.12);
            border: 1px solid #e5eee7;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 7px;
            background: linear-gradient(90deg, #075b38, #d9ad42);
        }

        h2 {
            color: #075b38;
            font-size: 28px;
            margin: 5px 0 10px;
        }

        .container > p {
            color: #7b8b80;
            font-size: 14px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin: 22px 0 9px;
            font-size: 14px;
            font-weight: 700;
            color: #175d3d;
        }

        input, textarea {
            width: 100%;
            padding: 15px 16px;
            border: 1px solid #dce7df;
            border-radius: 11px;
            background: #fbfdfb;
            font-family: inherit;
            font-size: 14px;
            color: #34483b;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #168052;
            box-shadow: 0 0 0 4px rgba(22,128,82,.10);
        }

        textarea {
            min-height: 190px;
            resize: vertical;
            line-height: 1.7;
        }

        button {
            width: 100%;
            margin-top: 30px;
            padding: 16px;
            border: none;
            border-radius: 11px;
            background: linear-gradient(135deg, #087344, #075532);
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
        }

        button:hover {
            background: #064b2e;
        }

        .kembali {
            display: inline-block;
            margin-top: 25px;
            color: #087344;
            text-decoration: none;
            font-size: 14px;
            font-weight: 650;
        }

        .pesan {
            padding: 14px 16px;
            margin-bottom: 20px;
            background: #fff4e8;
            color: #9b421b;
            border-left: 4px solid #d9ad42;
            border-radius: 8px;
            font-size: 14px;
        }

        @media(max-width: 600px) {
            body {
                padding: 15px;
            }

            .container {
                padding: 25px 20px;
            }

            h2 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Edit Berita Madrasah</h2>
    <p>Perbarui informasi berita MI Nurul Yaqin Tampumia.</p>

    <?php if ($pesan !== ''): ?>
        <div class="pesan">
            <?= htmlspecialchars($pesan) ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label>Judul Berita</label>
        <input
            type="text"
            name="judul"
            value="<?= htmlspecialchars($berita['judul']) ?>"
            required
        >

        <label>Isi Berita</label>
        <textarea name="isi" required><?= htmlspecialchars($berita['isi']) ?></textarea>

        <label>Tanggal Berita</label>
        <input
            type="date"
            name="tanggal"
            value="<?= htmlspecialchars($berita['tanggal']) ?>"
            required
        >

        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="dashboard.php" class="kembali">← Kembali ke Dashboard</a>
</div>

</body>
</html>
