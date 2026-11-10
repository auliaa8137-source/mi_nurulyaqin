
<?php
require_once __DIR__ . '/../config/koneksi.php';
include __DIR__ . '/../components/header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kontak - MI Nurul Yaqin Tampumia</title>

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

.header-kontak {
    min-height: 400px;
    padding: 90px 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    background:
        linear-gradient(rgba(16,76,50,.70), rgba(16,76,50,.70)),
        url("../assets/images/foto8.jpeg");
    background-size: cover;
    background-position: center;
    color: white;
    border-bottom: 5px solid #d8ae52;
}

.header-kontak h1 {
    font-size: 38px;
    margin-bottom: 10px;
}

.container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 20px;
}

.kontak-box {
    background: white;
    padding: 28px;
    border-radius: 12px;
    box-shadow: 0 3px 12px rgba(0,0,0,.08);
    line-height: 1.8;
}

.kontak-box h2 {
    color: #176b3a;
    margin-top: 20px;
}

form {
    margin-top: 20px;
}

form label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
    color: #176b3a;
}

form input,
form textarea {
    width: 100%;
    padding: 12px;
    margin-top: 8px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-family: Arial, sans-serif;
    font-size: 15px;
}

form button {
    margin-top: 20px;
    padding: 13px 25px;
    background: #25D366;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
}

form button:hover {
    background: #128C7E;
}

.peta {
    width: 100%;
    height: 350px;
    border: 0;
    border-radius: 10px;
    margin-top: 15px;
}

.kembali {
    display: inline-block;
    margin-top: 25px;
    padding: 12px 20px;
    background: #176b3a;
    color: white;
    text-decoration: none;
    border-radius: 8px;
}

@media (max-width: 768px) {
    .header-kontak {
        min-height: 250px;
        padding: 60px 15px;
    }

    .header-kontak h1 {
        font-size: 28px;
    }

    .container {
        margin: 20px auto;
        padding: 15px;
    }

    .kontak-box {
        padding: 20px;
    }
}
</style>
</head>

<body>

<section class="header-kontak">
    <h1>Hubungi Kami</h1>
    <p>MI Nurul Yaqin Tampumia</p>
</section>

<main class="container">
<section class="kontak-box">

    <h2>Informasi Kontak</h2>

    <p><strong>Nama Madrasah:</strong> MI Nurul Yaqin Tampumia</p>
    <p><strong>Alamat:</strong> Tampumia, Indonesia</p>
    <p><strong>WhatsApp Madrasah:</strong> 081239059310</p>

    <h2>Kirim Pesan kepada Kami</h2>
    <p>Silakan isi formulir berikut untuk menghubungi pihak madrasah.</p>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'kosong'): ?>
        <p style="color:red;">Semua kolom wajib diisi.</p>
    <?php elseif (isset($_GET['status']) && $_GET['status'] == 'gagal'): ?>
        <p style="color:red;">Pesan gagal disimpan. Silakan coba kembali.</p>
    <?php endif; ?>

    <form action="proses_kontak.php" method="POST">

        <label>Nama Lengkap</label>
        <input type="text" name="nama"
               placeholder="Masukkan nama Anda" required>

        <label>Nomor WhatsApp</label>
        <input type="text" name="no_wa"
               placeholder="Masukkan nomor WhatsApp" required>

        <label>Pesan</label>
        <textarea name="pesan" rows="5"
                  placeholder="Tuliskan pesan Anda..." required></textarea>

        <button type="submit">Kirim Pesan ke WhatsApp</button>

    </form>

    <h2>Lokasi Madrasah</h2>
    <p>Peta berikut menampilkan area Tampumia. Lokasi tepat perlu disesuaikan dengan alamat resmi madrasah.</p>

    <iframe class="peta"
        src="https://www.google.com/maps?q=Tampumia&output=embed"
        loading="lazy">
    </iframe>

</section>

<a href="../index.php" class="kembali">Kembali ke Beranda</a>
</main>

<?php include __DIR__ . '/../components/footer.php'; ?>

</body>
</html>
