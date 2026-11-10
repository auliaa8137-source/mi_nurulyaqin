
<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../config/koneksi.php';

$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $isi = trim($_POST['isi'] ?? '');
    $tanggal = $_POST['tanggal'] ?? '';
    $nama_gambar = '';

    if ($judul === '' || $isi === '' || $tanggal === '') {
        $pesan = "Judul, isi, dan tanggal wajib diisi.";
    } elseif (
        isset($_FILES['gambar']) &&
        $_FILES['gambar']['error'] === UPLOAD_ERR_OK
    ) {
        $folder = __DIR__ . '/../assets/images/';
        $tmp = $_FILES['gambar']['tmp_name'];
        $ukuran = $_FILES['gambar']['size'];
        $info = getimagesize($tmp);

        if (!$info || $ukuran > 2 * 1024 * 1024) {
            $pesan = "Foto tidak valid atau ukurannya melebihi 2 MB.";
        } else {
            $format = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp'
            ];

            $mime = $info['mime'];

            if (!isset($format[$mime])) {
                $pesan = "Gunakan foto JPG, PNG, atau WEBP.";
            } else {
                $nama_gambar = uniqid('berita_') . '.' . $format[$mime];

                if (move_uploaded_file($tmp, $folder . $nama_gambar)) {
                    $stmt = mysqli_prepare(
                        $koneksi,
                        "INSERT INTO berita (judul, isi, tanggal, gambar)
                         VALUES (?, ?, ?, ?)"
                    );

                    mysqli_stmt_bind_param(
                        $stmt,
                        "ssss",
                        $judul,
                        $isi,
                        $tanggal,
                        $nama_gambar
                    );

                    if (mysqli_stmt_execute($stmt)) {
                        header("Location: dashboard.php?status=berhasil");
                        exit;
                    } else {
                        unlink($folder . $nama_gambar);
                        $pesan = "Berita gagal disimpan.";
                    }
                } else {
                    $pesan = "Foto gagal diunggah.";
                }
            }
        }
    } else {
        $pesan = "Silakan pilih foto berita.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Berita Admin</title>

<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 40px 20px;
    min-height: 100vh;
    font-family: 'Segoe UI', Arial, sans-serif;
    background:
        radial-gradient(circle at top left, #dcefe3, transparent 40%),
        linear-gradient(135deg, #f3f8f4, #e8f0e9);
    color: #26382e;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 40px;
    background: #ffffff;
    border-radius: 22px;
    box-shadow: 0 15px 45px rgba(13, 74, 43, 0.12);
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
    font-weight: 750;
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

input,
textarea {
    width: 100%;
    padding: 15px 16px;
    border: 1px solid #dce7df;
    border-radius: 11px;
    background: #fbfdfb;
    font-family: inherit;
    font-size: 14px;
    color: #34483b;
    transition: .3s;
}

input:focus,
textarea:focus {
    outline: none;
    border-color: #168052;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(22, 128, 82, .10);
}

textarea {
    min-height: 190px;
    resize: vertical;
    line-height: 1.7;
}

input[type="file"] {
    background: #f5faf6;
    border: 1px dashed #a8c8b3;
    padding: 18px;
    cursor: pointer;
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
    box-shadow: 0 7px 18px rgba(7, 91, 56, .20);
    transition: .3s;
}

button:hover {
    transform: translateY(-2px);
    background: linear-gradient(135deg, #09623b, #043f27);
    box-shadow: 0 10px 22px rgba(7, 91, 56, .25);
}

.kembali {
    display: inline-block;
    margin-top: 25px;
    color: #087344;
    text-decoration: none;
    font-size: 14px;
    font-weight: 650;
}

.kembali:hover {
    color: #c2942d;
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

@media (max-width: 600px) {
    body {
        padding: 15px;
    }

    .container {
        padding: 25px 20px;
        margin: 10px auto;
    }

    h2 {
        font-size: 23px;
    }
}

</style>
</head>

<body>
<div class="container">
    <h2>Tambah Berita Madrasah</h2>
    <p>MI Nurul Yaqin Tampumia</p>

    <?php if ($pesan !== ''): ?>
        <div class="pesan">
            <?= htmlspecialchars($pesan) ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Judul Berita</label>
        <input type="text" name="judul" required>

        <label>Isi Berita</label>
        <textarea name="isi" required></textarea>

        <label>Tanggal Berita</label>
        <input type="date" name="tanggal" required>

        <label>Foto Berita</label>
        <input type="file" name="gambar"
               accept=".jpg,.jpeg,.png,.webp" required>

        <button type="submit">Simpan Berita</button>
    </form>

    <a class="kembali" href="dashboard.php">← Kembali ke Dashboard</a>
</div>
</body>
</html>
