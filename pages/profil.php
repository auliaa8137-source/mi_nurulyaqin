
<?php
require_once __DIR__ . '/../config/koneksi.php';
include __DIR__ . '/../components/header.php';

$query = mysqli_query($koneksi, "SELECT * FROM profil LIMIT 1");

if (!$query) {
    die("Gagal mengambil data profil: " . mysqli_error($koneksi));
}

$profil = mysqli_fetch_assoc($query) ?? [];
// Mengambil data guru dari database
$queryGuru = mysqli_query(
    $koneksi,
    "SELECT * FROM guru ORDER BY id ASC"
);

if (!$queryGuru) {
    die("Gagal mengambil data guru: " . mysqli_error($koneksi));
}

$sejarahDefault = "MI Nurul Yaqin Tampumia merupakan lembaga pendidikan Islam tingkat dasar yang hadir sebagai tempat belajar dan pembinaan generasi muda di lingkungan masyarakat Tampumia.";

// Fungsi untuk menampilkan teks menjadi paragraf
$tampilkanParagraf = function ($teks) {
    $paragraf = preg_split('/\r\n|\r|\n/', $teks);

    foreach ($paragraf as $isi) {
        if (trim($isi) !== '') {
            echo '<p>' . nl2br(htmlspecialchars(trim($isi))) . '</p>';
        }
    }
};

// Mengambil foto kepala dari database
$fotoKepala = trim($profil['foto_kepala'] ?? '');

if ($fotoKepala !== '' &&
    !preg_match('/^(https?:\/\/|\/|\.\.\/)/i', $fotoKepala)) {
    $fotoKepala = '../assets/images/' . $fotoKepala;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil MI Nurul Yaqin Tampumia</title>

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

.profil-hero {
    background: linear-gradient(135deg, #104c32, #176b45);
    color: white;
    text-align: center;
    padding: 55px 20px;
    border-bottom: 5px solid #d8ae52;
}

.profil-hero h1 {
    margin: 0 0 12px;
    font-size: 32px;
}

.profil-hero p {
    color: #f5d47b;
}

.profil-container {
    max-width: 1150px;
    margin: 50px auto;
    padding: 0 20px;
}

.profil-card {
    display: grid;
    grid-template-columns: 0.9fr 1.3fr;
    background: white;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,.10);
    margin-bottom: 30px;
}

.profil-foto {
    min-height: 400px;
    background: #e5f2e7;
}

.profil-foto img {
    width: 100%;
    height: 100%;
    min-height: 400px;
    object-fit: cover;
    display: block;
}

.profil-info {
    padding: 35px;
}

.profil-info h2,
.section-title {
    color: #176b45;
    font-size: 27px;
}

.garis-emas {
    width: 65px;
    height: 4px;
    background: #d8ae52;
    margin-bottom: 22px;
    border-radius: 5px;
}

.profil-info p,
.pendidikan-card p,
.sambutan-card p {
    line-height: 1.9;
    font-size: 15px;
    text-align: justify;
}

.profil-alamat {
    margin-top: 22px;
    padding: 15px;
    background: #edf6ef;
    border-left: 4px solid #d8ae52;
    border-radius: 8px;
}

.profil-motto {
    text-align: center;
    background: #fff8e7;
    border-radius: 15px;
    padding: 25px;
    margin-top: 30px;
    color: #104c32;
    line-height: 1.8;
}

/* Tentang Pendidikan */
.pendidikan-card {
    background: white;
    padding: 35px;
    border-radius: 18px;
    margin-bottom: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,.08);
}

.pendidikan-card h2 {
    color: #176b45;
}

/* Sambutan Kepala Madrasah */
.sambutan-card {
    display: grid;
    grid-template-columns: 280px 1fr;
    background: white;
    border-radius: 18px;
    overflow: hidden;
    margin-bottom: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,.08);
}

.sambutan-foto {
    background: #e5f2e7;
    min-height: 350px;
}

.sambutan-foto img {
    width: 100%;
    height: 100%;
    min-height: 350px;
    object-fit: cover;
}

.sambutan-info {
    padding: 35px;
}

.sambutan-info h2 {
    color: #176b45;
}

.sambutan-info h3 {
    color: #104c32;
    margin-bottom: 5px;
}

.jabatan {
    color: #a47a25;
    font-weight: bold;
    margin-top: 0;
}

/* DATA GURU */
.guru-section {
    margin-bottom: 30px;
}

.guru-section h2 {
    color: #176b45;
    text-align: center;
    font-size: 27px;
}

.guru-section .garis-emas {
    margin: 0 auto 25px;
}

.guru-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
}

.guru-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0,0,0,.08);
    padding-bottom: 20px;
}

.guru-card img {
    width: 100%;
    height: 300px;
    object-fit: contain;
    object-position: center;
    display: block;
    background: white;
}

.guru-foto-kosong {
    height: 230px;
    background: #e5f2e7;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #176b45;
}

.guru-card h3 {
    color: #176b45;
    margin: 18px 10px 8px;
    font-size: 17px;
}

.guru-card p {
    color: #a47a25;
    font-weight: bold;
    margin: 0 10px;
}

@media(max-width:700px) {
    .guru-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width:450px) {
    .guru-grid {
        grid-template-columns: 1fr;
    }
}
@media(max-width:700px) {
    .profil-card,
    .sambutan-card {
        grid-template-columns: 1fr;
    }

    .profil-foto,
    .profil-foto img {
        min-height: 250px;
        height: 250px;
    }

    .sambutan-foto,
    .sambutan-foto img {
        min-height: 280px;
        height: 280px;
    }

    .profil-info,
    .pendidikan-card,
    .sambutan-info {
        padding: 25px;
    }

    .profil-hero h1 {
        font-size: 25px;
    }
}
</style>
</head>

<body>

<section class="profil-hero">
    <h1>Profil Madrasah</h1>
    <p>Mengenal Lebih Dekat MI Nurul Yaqin Tampumia</p>
</section>

<main class="profil-container">

    <!-- SEJARAH MADRASAH -->
    <div class="profil-card">

        <div class="profil-foto">
            <img
                src="../assets/images/foto3 (3).jpeg"
                alt="Foto MI Nurul Yaqin Tampumia"
            >
        </div>

        <div class="profil-info">

            <h2>
                <?= htmlspecialchars($profil['nama_sekolah'] ?? 'MI Nurul Yaqin Tampumia'); ?>
            </h2>

            <div class="garis-emas"></div>

            <h3>Sejarah Singkat Madrasah</h3>

            <?php
            $sejarah = !empty($profil['sejarah'])
                ? $profil['sejarah']
                : $sejarahDefault;

            $tampilkanParagraf($sejarah);
            ?>

            <div class="profil-alamat">
                <strong>Alamat Madrasah</strong><br>
                <?= htmlspecialchars($profil['alamat'] ?? 'Tampumia'); ?>
            </div>

        </div>
    </div>

    <!-- SAMBUTAN KEPALA MADRASAH -->
    <section class="sambutan-card">

        <div class="sambutan-foto">

            <?php if (!empty($fotoKepala)): ?>

                <img
                    src="<?= htmlspecialchars($fotoKepala); ?>"
                    alt="Foto Kepala Madrasah"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                >

                <div class="foto-kosong" style="display:none;">
                    Foto kepala madrasah tidak ditemukan.
                </div>

            <?php else: ?>

                <div class="foto-kosong">
                    Foto kepala madrasah belum tersedia.
                </div>

            <?php endif; ?>

        </div>

        <div class="sambutan-info">

            <h2>Sambutan Kepala Madrasah</h2>
            <div class="garis-emas"></div>

            <h3>
                <?= htmlspecialchars($profil['nama_kepala'] ?? 'Kepala Madrasah'); ?>
            </h3>

            <p class="jabatan">
                <?= htmlspecialchars($profil['jabatan_kepala'] ?? 'Kepala MI Nurul Yaqin Tampumia'); ?>
            </p>

            <?php if (!empty($profil['sambutan_kepala'])): ?>

                <?php $tampilkanParagraf($profil['sambutan_kepala']); ?>

            <?php else: ?>

                <p>Sambutan kepala madrasah belum tersedia.</p>

            <?php endif; ?>

        </div>

    </section>
        <!-- DATA GURU -->
    <section class="guru-section">

        <h2>Tenaga Pendidik dan Kependidikan</h2>
        <div class="garis-emas"></div>

        <div class="guru-grid">

            <?php if (mysqli_num_rows($queryGuru) > 0): ?>

                <?php while ($guru = mysqli_fetch_assoc($queryGuru)): ?>

                    <div class="guru-card">

                        <?php if (!empty($guru['foto'])): ?>

                            <img
                                src="../assets/images/<?= htmlspecialchars($guru['foto']); ?>"
                                alt="<?= htmlspecialchars($guru['nama_guru']); ?>"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                            >

                            <div class="guru-foto-kosong" style="display:none;">
                                Foto guru tidak ditemukan.
                            </div>

                        <?php else: ?>

                            <div class="guru-foto-kosong">
                                Foto guru belum tersedia.
                            </div>

                        <?php endif; ?>

                        <h3>
                            <?= htmlspecialchars($guru['nama_guru']); ?>
                        </h3>

                        <p>
                            <?= htmlspecialchars($guru['jabatan']); ?>
                        </p>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <p>Data guru belum tersedia.</p>

            <?php endif; ?>

        </div>

    </section>

    <!-- MOTTO -->
    <div class="profil-motto">
        <h3>Tumbuh Bersama dalam Ilmu dan Akhlak</h3>
        <p>
            Mewujudkan generasi yang beriman, berilmu,
            berakhlak mulia, mandiri, dan berprestasi.
        </p>
    </div>

</main>

<?php include __DIR__ . '/../components/footer.php'; ?>

</body>
</html>
