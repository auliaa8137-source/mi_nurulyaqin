-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2026 at 04:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mi_nurulyaqin`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `tanggal`, `gambar`) VALUES
(2, 'Kegiatan Sekolah', 'Dokumentasi Kegiatan Sekolah', '2026-02-25', 'berita_6aeb1ebe92aa7.jpeg'),
(3, 'Kegiatan Siswa', 'Dokumentasi Kegiatan Siswa', '2026-08-16', 'berita_6aeb1fb5bcbee.jpeg'),
(4, 'Perayaan Gelar Baru Kepala MI', 'Dokumentasi Bersama Siswa - Siswi', '2026-09-29', 'berita_6aeb207025648.jpeg'),
(5, 'Aktivitas Madrasah', 'Dokumentasi Orang Tua Siswa', '2026-10-15', 'berita_6aeb2151b81e5.jpeg'),
(6, 'Lingkungan Madrasah', 'Dokumentasi Lingkungan Madrasah', '2026-09-14', 'berita_6aeb22563c16f.jpeg'),
(7, 'Kegiatan Akreditas Sekolah', 'Dokumentasi Bersama Pihak Akreditasi Sekolah', '2026-06-23', 'berita_6aeb234ed4f33.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `gambar`, `keterangan`) VALUES
(7, 'Kegiatan Sekolah', 'foto1 (2).jpeg', 'Dokemntasi Kegiatan Sekolah'),
(8, 'Kegiatan Siswa', 'foto2.jpeg', 'Dokumentasi Kegiatan Siswi'),
(9, 'Perayaan Gelar Baru Kepala MI', 'foto8.jpeg', 'Dokumentasi Bersama Siswa - Siswi'),
(10, 'Aktivitas Madrasah', 'berita_6aeb2151b81e5.jpeg', 'Dokumentasi Orang Tua Siswa'),
(11, 'Lingkungan Madrasah', 'berita_6aeb22563c16f.jpeg', 'Dokumentasi Lingkungan Sekolah'),
(12, 'Kegiatan Akreditas Sekolah', 'berita_6aeb234ed4f33.jpeg', 'Dokumentasi Foto Bersama');

-- --------------------------------------------------------

--
-- Table structure for table `pesan_kontak`
--

CREATE TABLE `pesan_kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal_kirim` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('baru','dibaca') DEFAULT 'baru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesan_kontak`
--

INSERT INTO `pesan_kontak` (`id`, `nama`, `no_wa`, `pesan`, `tanggal_kirim`, `status`) VALUES
(5, 'hasriani', '087750949333', 'kapan pendaftaran sekolahnya di buka yah', '2026-11-04 15:24:34', 'baru');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `nama_sekolah` varchar(200) NOT NULL,
  `alamat` text DEFAULT NULL,
  `sejarah` text DEFAULT NULL,
  `telepon` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tentang_pendidikan` text DEFAULT NULL,
  `nama_kepala` varchar(150) DEFAULT NULL,
  `jabatan_kepala` varchar(100) DEFAULT NULL,
  `foto_kepala` varchar(255) DEFAULT NULL,
  `sambutan_kepala` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `nama_sekolah`, `alamat`, `sejarah`, `telepon`, `email`, `tentang_pendidikan`, `nama_kepala`, `jabatan_kepala`, `foto_kepala`, `sambutan_kepala`) VALUES
(1, 'MI Nurul Yaqin Tampumia', 'Tampumia, kecamatan bua pondrang, kab luwu sulawesi selatan', 'MI Nurul Yaqin Tampumia merupakan lembaga pendidikan Islam tingkat dasar yang hadir sebagai tempat belajar dan pembinaan generasi muda di lingkungan masyarakat Tampumia.\r\n\r\nMadrasah ini memiliki peran penting dalam memberikan pendidikan dasar yang mengintegrasikan pengetahuan umum dengan nilai-nilai keislaman. Dalam menjalankan kegiatan pendidikan, MI Nurul Yaqin Tampumia berupaya menciptakan lingkungan belajar yang nyaman, aman, dan mendukung perkembangan peserta didik.\r\n\r\nProses pembelajaran tidak hanya berfokus pada peningkatan kemampuan akademik, tetapi juga pada pembentukan karakter, kedisiplinan, tanggung jawab, serta sikap saling menghormati. Peserta didik dibimbing untuk mengembangkan potensi diri agar mampu menjadi pribadi yang mandiri dan percaya diri.\r\n\r\n', '087750949333', 'Misnurulyaqin@gmail.com', NULL, 'RISMAWATI, S.Pd.I.GR', 'Kepala Sekolah', 'foto10.jpeg', 'Pendidikan merupakan kerja sama antara madrasah, keluarga, dan masyarakat. kami berharap MI NURUL YAQIN dapat terus menjadi lingkungan belajar yang mendukung perkembangan ilmu pengetahuan, karakter, dan akhlak mulia peserta didik.\r\nterima kasih atas kepercayaan dan dukungan semua pihak dalam mendampingi proses pendidikan anak - anak.');

-- --------------------------------------------------------

--
-- Table structure for table `visi_misi`
--

CREATE TABLE `visi_misi` (
  `id` int(11) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visi_misi`
--

INSERT INTO `visi_misi` (`id`, `visi`, `misi`) VALUES
(1, 'Terwujudnya peserta didik yang beriman, berilmu, berakhlak mulia, mandiri, dan berprestasi.', 'Menanamkan nilai-nilai keimanan dan ketakwaan kepada Allah SWT.'),
(2, 'Terwujudnya peserta didik yang beriman, berilmu, berakhlak mulia, mandiri, dan berprestasi.', 'Meningkatkan kualitas pembelajaran yang aktif dan kreatif.'),
(3, 'Terwujudnya peserta didik yang beriman, berilmu, berakhlak mulia, mandiri, dan berprestasi.', 'Membentuk peserta didik yang disiplin dan berakhlak mulia.'),
(4, 'Terwujudnya peserta didik yang beriman, berilmu, berakhlak mulia, mandiri, dan berprestasi.', 'Mengembangkan bakat dan minat peserta didik.'),
(5, 'Terwujudnya peserta didik yang beriman, berilmu, berakhlak mulia, mandiri, dan berprestasi.', 'Menciptakan lingkungan madrasah yang bersih, aman, dan nyaman.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan_kontak`
--
ALTER TABLE `pesan_kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visi_misi`
--
ALTER TABLE `visi_misi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pesan_kontak`
--
ALTER TABLE `pesan_kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visi_misi`
--
ALTER TABLE `visi_misi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
