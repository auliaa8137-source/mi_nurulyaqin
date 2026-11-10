
<?php
$base = (strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../' : '';
?>

<style>
.header-utama {
    background: #104c32;
    border-bottom: 4px solid #d8ae52;
    padding: 12px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.identitas-sekolah {
    display: flex;
    align-items: center;
    gap: 12px;
}

.identitas-sekolah img {
    width: 58px;
    height: 58px;
    object-fit: contain;
    background: white;
    border-radius: 50%;
    padding: 4px;
}

.identitas-sekolah h2 {
    color: white;
    font-size: 17px;
    margin: 0;
}

.identitas-sekolah p {
    color: #f5d47b;
    font-size: 12px;
    margin: 5px 0 0;
}

/* MENU NAVIGASI */
.menu-utama {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 20px;
}

.menu-utama a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 14px;
    transition: 0.3s;
}

.menu-utama a:hover {
    color: #f5d47b;
}

/* TOMBOL HAMBURGER */
.menu-toggle {
    display: none;
    background: transparent;
    border: 1px solid #f5d47b;
    color: white;
    font-size: 25px;
    padding: 4px 12px;
    border-radius: 5px;
    cursor: pointer;
}

/* TAMPILAN HP */
@media (max-width: 700px) {
    .header-utama {
        justify-content: space-between;
        padding: 12px 18px;
    }

    .menu-toggle {
        display: block;
    }

    .menu-utama {
        display: none;
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
        gap: 0;
    }

    .menu-utama.active {
        display: flex;
    }

    .menu-utama a {
        width: 100%;
        padding: 12px 5px;
        border-top: 1px solid #ffffff25;
    }
}
</style>

<div class="header-utama">

    <div class="identitas-sekolah">
        <img src="<?= $base ?>assets/images/LOGO.jpeg"
             alt="Logo MI Nurul Yaqin">

        <div>
            <h2>MI Nurul Yaqin Tampumia</h2>
            <p>Madrasah Ibtidaiyah</p>
        </div>
    </div>

    <button class="menu-toggle"
            id="menuToggle"
            type="button"
            aria-label="Buka menu navigasi"
            aria-expanded="false">
        ☰
    </button>

    <nav class="menu-utama" id="menuUtama">
        <a href="<?= $base ?>index.php">Beranda</a>
        <a href="<?= $base ?>pages/profil.php">Profil</a>
        <a href="<?= $base ?>pages/berita.php">Berita</a>
        <a href="<?= $base ?>pages/galeri.php">Galeri</a>
        <a href="<?= $base ?>pages/visi-misi.php">Visi Misi</a>
        <a href="<?= $base ?>pages/kontak.php">Kontak</a>
    </nav>

</div>

<script src="<?= $base ?>assets/js/script.js" defer></script>
