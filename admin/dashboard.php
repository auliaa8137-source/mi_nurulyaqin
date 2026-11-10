
<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../config/koneksi.php';

// Menghitung jumlah berita
$query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM berita");
$data = mysqli_fetch_assoc($query);
$total_berita = $data['total'] ?? 0;
// Mengambil daftar berita untuk ditampilkan di dashboard
$query_berita = mysqli_query(
    $koneksi,
    "SELECT id, judul, tanggal FROM berita ORDER BY tanggal DESC, id DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin | MI Nurul Yaqin</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'DM Sans', Arial, sans-serif;
    background: #f5f7f5;
    color: #26352d;
}

/* SIDEBAR */
.sidebar {
    width: 265px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    padding: 28px 20px;
    background: linear-gradient(180deg, #103e2b, #092e20);
    color: white;
    display: flex;
    flex-direction: column;
    z-index: 10;
}

.brand {
    text-align: center;
    padding-bottom: 28px;
    border-bottom: 1px solid rgba(255,255,255,.15);
}

.logo-sekolah {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 30px;
}

.logo-sekolah img {
    width: 55px;
    height: 55px;
    object-fit: contain;
    border-radius: 50%;
    background: white;
    padding: 3px;
}

.logo-sekolah h3 {
    margin: 0;
    font-size: 16px;
}

.logo-sekolah p {
    margin: 4px 0 0;
    font-size: 12px;
}
.brand h2 {
    font-family: 'Playfair Display', serif;
    font-size: 19px;
    line-height: 1.4;
}

.brand p {
    color: #d9bd72;
    font-size: 11px;
    letter-spacing: 2px;
    margin-top: 7px;
}

.menu-title {
    color: #a8c0b0;
    font-size: 10px;
    letter-spacing: 2px;
    margin: 30px 12px 13px;
}

.sidebar a {
    display: flex;
    align-items: center;
    gap: 13px;
    color: #dce8df;
    text-decoration: none;
    padding: 14px 15px;
    border-radius: 9px;
    margin-bottom: 8px;
    font-size: 13px;
    transition: .3s;
}

.sidebar a:hover,
.sidebar a.active {
    background: linear-gradient(90deg, #c9aa59, #e3cb88);
    color: #173b29;
}

.sidebar .logout {
    margin-top: auto;
    background: rgba(255,255,255,.08);
}

.sidebar .logout:hover {
    background: #a94442;
    color: white;
}

/* MAIN */
.main {
    margin-left: 265px;
    padding: 32px 38px;
}

.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    gap: 15px;
}

.topbar h1 {
    font-family: 'Playfair Display', serif;
    font-size: 30px;
    color: #174b32;
}

.topbar p {
    font-size: 13px;
    color: #829087;
    margin-top: 7px;
}

.admin-profile {
    background: white;
    padding: 11px 16px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,.04);
}

.avatar {
    width: 38px;
    height: 38px;
    background: #e9dfc3;
    color: #174b32;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
}

.admin-profile small {
    color: #8b958e;
    font-size: 11px;
}

/* WELCOME */
.welcome {
    padding: 32px;
    border-radius: 18px;
    background: linear-gradient(115deg, #155438, #236d49);
    color: white;
    position: relative;
    overflow: hidden;
    margin-bottom: 28px;
    box-shadow: 0 10px 25px rgba(21,84,56,.15);
}

.welcome:after {
    content: "✦";
    position: absolute;
    right: 45px;
    top: -35px;
    font-size: 190px;
    color: rgba(255,255,255,.07);
}

.welcome h2 {
    font-family: 'Playfair Display', serif;
    font-size: 27px;
    margin-bottom: 10px;
}

.welcome p {
    color: #e1eee5;
    font-size: 13px;
    line-height: 1.8;
    max-width: 570px;
}

.welcome span {
    color: #e7cb7b;
}

/* CARDS */
.section-title {
    font-family: 'Playfair Display', serif;
    color: #174b32;
    font-size: 21px;
    margin-bottom: 18px;
}

.cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 28px;
}

.card {
    background: white;
    padding: 24px;
    border-radius: 15px;
    box-shadow: 0 4px 18px rgba(0,0,0,.035);
    border: 1px solid #edf0ec;
}

.card-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
    background: #edf5ef;
    margin-bottom: 18px;
}

.card h3 {
    color: #849087;
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 9px;
}

.card strong {
    font-size: 30px;
    color: #174b32;
}

/* CONTENT */
.content-box {
    background: white;
    padding: 27px;
    border-radius: 15px;
    border: 1px solid #edf0ec;
    box-shadow: 0 4px 18px rgba(0,0,0,.035);
}

.content-box h3 {
    color: #174b32;
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    margin-bottom: 12px;
}

.content-box p {
    color: #7d8981;
    font-size: 13px;
    line-height: 1.8;
}
/* DAFTAR BERITA */
.tabel-berita {
    margin-top: 25px;
    overflow-x: auto;
}

.tabel-berita table {
    width: 100%;
    border-collapse: collapse;
}

.tabel-berita th,
.tabel-berita td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #edf0ec;
    font-size: 13px;
}

.tabel-berita th {
    background: #edf5ef;
    color: #174b32;
}

.tabel-berita td {
    color: #526258;
}

.btn-edit {
    display: inline-block;
    padding: 8px 15px;
    background: #17613e;
    color: white;
    text-decoration: none;
    border-radius: 7px;
    font-size: 12px;
}

.btn-edit:hover {
    background: #c5a453;
    color: #173b29;
}

.btn-hapus {
    display: inline-block;
    padding: 8px 15px;
    background: #a94442;
    color: white;
    border: none;
    border-radius: 7px;
    font-size: 12px;
    cursor: pointer;
}

.btn-hapus:hover {
    background: #823331;
}
.action {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 20px;
    background: #17613e;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-size: 13px;
    transition: .3s;
}

.action:hover {
    background: #c5a453;
    color: #173b29;
}

@media(max-width: 1000px) {
    .cards {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width: 700px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }

    .sidebar .logout {
        margin-top: 10px;
    }

    .main {
        margin-left: 0;
        padding: 22px;
    }

    .topbar {
        align-items: flex-start;
        flex-direction: column;
    }

    .cards {
        grid-template-columns: 1fr;
    }
}
</style>
</head>

<body>

<aside class="sidebar">

    <div class="logo-sekolah">
    <img src="../assets/images/LOGO.jpeg"
         alt="Logo MI Nurul Yaqin Tampumia">
    <div>
        <h3>MI Nurul Yaqin</h3>
        <p>Admin Panel</p>
    </div>
</div>

    <div class="menu-title">MENU UTAMA</div>

    <a href="dashboard.php" class="active">
        <span>⌂</span> Dashboard
    </a>

    <a href="tambah-berita.php">
        <span>▤</span> Tambah Berita
    </a>

    <a href="../pages/berita.php">
        <span>◎</span> Lihat Website
    </a>

    <a href="logout.php" class="logout"
       onclick="return confirm('Apakah kamu yakin ingin keluar?')">
        <span>↪</span> Keluar
    </a>

</aside>

<main class="main">

    <div class="topbar">
        <div>
            <h1>Dashboard</h1>
            <p>Panel pengelolaan website sekolah</p>
        </div>

        <div class="admin-profile">
            <div class="avatar">A</div>
            <div>
                <strong><?= htmlspecialchars($_SESSION['admin_username']); ?></strong>
                <br>
                <small>Administrator</small>
            </div>
        </div>
    </div>

    <section class="welcome">
        <h2>Selamat Datang, <span><?= htmlspecialchars($_SESSION['admin_username']); ?>!</span></h2>
        <p>
            Selamat datang di panel administrator MI Nurul Yaqin Tampumia.
            Kelola informasi, berita, dan publikasi sekolah melalui
            halaman dashboard ini dengan mudah.
        </p>
    </section>

    <h2 class="section-title">Ringkasan Website</h2>

    <section class="cards">

        <div class="card">
            <div class="card-icon">📰</div>
            <h3>Total Berita</h3>
            <strong><?= (int)$total_berita; ?></strong>
        </div>

        <div class="card">
            <div class="card-icon">🏫</div>
            <h3>Profil Sekolah</h3>
            <strong>Aktif</strong>
        </div>

        <div class="card">
            <div class="card-icon">🔐</div>
            <h3>Status Admin</h3>
            <strong>Online</strong>
        </div>

    </section>

    <section class="content-box">
        <h3>Pengelolaan Informasi Sekolah</h3>
        <p>
            Gunakan panel administrator untuk mengelola berita
            dan informasi terbaru MI Nurul Yaqin Tampumia.
            Informasi yang diterbitkan dapat dilihat oleh pengunjung
            melalui halaman website sekolah.
        </p>

        <a href="tambah-berita.php" class="action">
            + Kelola Berita
        </a>
    </section>
    
    <section class="content-box" style="margin-top:25px;">
        <h3>Daftar Berita Sekolah</h3>
        <p>Berikut berita yang telah diterbitkan. Kamu dapat mengubah berita melalui tombol Edit.</p>

        <div class="tabel-berita">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Berita</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;

                    if (mysqli_num_rows($query_berita) > 0):
                        while ($row = mysqli_fetch_assoc($query_berita)):
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['judul']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal']); ?></td>
                            <td>
                                <a class="btn-edit"
   href="edit-berita.php?id=<?= (int)$row['id']; ?>">
    Edit
</a>

<form action="hapus-berita.php" method="POST"
      style="display:inline;"
      onsubmit="return confirm('Yakin ingin menghapus berita ini?');">

    <input type="hidden" name="id"
           value="<?= (int)$row['id']; ?>">

    <button type="submit" class="btn-hapus">
        Hapus
    </button>
</form>
                            </td>
                        </tr>
                    <?php
                        endwhile;
                    else:
                    ?>
                        <tr>
                            <td colspan="4">Belum ada berita.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>


</main>

</body>
</html>
