
<?php
require_once __DIR__ . '/../config/koneksi.php';

// Memastikan formulir dikirim dengan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: kontak.php");
    exit;
}

// Mengambil data dari formulir
$nama  = trim($_POST['nama'] ?? '');
$no_wa = trim($_POST['no_wa'] ?? '');
$pesan = trim($_POST['pesan'] ?? '');

// Memeriksa data
if ($nama === '' || $no_wa === '' || $pesan === '') {
    header("Location: kontak.php?status=kosong");
    exit;
}

// Menyimpan pesan ke database
$query = mysqli_prepare(
    $koneksi,
    "INSERT INTO pesan_kontak (nama, no_wa, pesan)
     VALUES (?, ?, ?)"
);

if (!$query) {
    die("Gagal membuat query: " . mysqli_error($koneksi));
}

mysqli_stmt_bind_param($query, "sss", $nama, $no_wa, $pesan);

if (mysqli_stmt_execute($query)) {

   // Nomor WhatsApp madrasah
$nomorTujuan = "6281239059310";

    // Membuat isi pesan WhatsApp
    $isiPesan = "Pesan dari Website MI Nurul Yaqin Tampumia\n\n"
              . "Nama: " . $nama . "\n"
              . "Nomor WhatsApp: " . $no_wa . "\n"
              . "Pesan: " . $pesan;

    // Mengarahkan ke WhatsApp
    $linkWA = "https://wa.me/" . $nomorTujuan
            . "?text=" . urlencode($isiPesan);

    header("Location: " . $linkWA);
    exit;

} else {
    die("Pesan gagal disimpan: " . mysqli_stmt_error($query));
}
?>
