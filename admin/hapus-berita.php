
<?php
session_start();

// Pastikan hanya admin yang sudah login dapat menghapus berita
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../config/koneksi.php';

// Penghapusan hanya boleh melalui metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: dashboard.php");
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    header("Location: dashboard.php?status=id-tidak-valid");
    exit;
}

// Ambil nama gambar berita
$stmt = mysqli_prepare($koneksi, "SELECT gambar FROM berita WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$berita = mysqli_fetch_assoc($result);

if (!$berita) {
    header("Location: dashboard.php?status=berita-tidak-ditemukan");
    exit;
}

// Hapus data berita dari database
$hapus = mysqli_prepare($koneksi, "DELETE FROM berita WHERE id = ?");
mysqli_stmt_bind_param($hapus, "i", $id);

if (mysqli_stmt_execute($hapus)) {
    // Hapus file gambar jika berada di folder gambar berita
    $namaGambar = basename($berita['gambar'] ?? '');
    $lokasiGambar = __DIR__ . '/../assets/images/' . $namaGambar;

    if (
        $namaGambar !== '' &&
        is_file($lokasiGambar) &&
        realpath(dirname($lokasiGambar)) === realpath(__DIR__ . '/../assets/images')
    ) {
        unlink($lokasiGambar);
    }

    header("Location: dashboard.php?status=hapus-berhasil");
    exit;
}

header("Location: dashboard.php?status=hapus-gagal");
exit;
