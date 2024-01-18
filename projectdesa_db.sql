-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jan 2024 pada 17.29
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdesa_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_berita`
--

CREATE TABLE `tbl_berita` (
  `id_berita` int(11) NOT NULL,
  `nama_judul` varchar(255) NOT NULL,
  `deskripsi_judul` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal_berita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_berita`
--

INSERT INTO `tbl_berita` (`id_berita`, `nama_judul`, `deskripsi_judul`, `gambar`, `tanggal_berita`) VALUES
(7, 'Acara Silaturahmi Makan-Makan Bersama', 'Selamat datang di acara silaturahmi makan-makan bersama Desa Pagadungan! Suasana hangat dan keakraban akan menyambut setiap tamu yang hadir dalam acara ini. Bertempat di lingkungan yang nyaman dan penuh keindahan, acara silaturahmi ini menjadi momen yang istimewa untuk mempererat tali persaudaraan di antara warga Desa Pagadungan.  Acara ini dirancang dengan penuh keceriaan dan kehangatan, di mana setiap detiknya diisi dengan senyuman, tawa, dan kebersamaan. Bersama-sama, kita akan menikmati hidangan lezat yang disajikan dengan cinta dan keramahan khas Desa Pagadungan. Mulai dari hidangan tradisional yang menggugah selera hingga variasi makanan modern yang memikat lidah, acara ini mengundang selera dan kepuasan bagi semua tamu undangan.  Tidak hanya tentang santapan lezat, acara ini juga memberikan kesempatan bagi setiap warga Desa Pagadungan untuk berbagi cerita, pengalaman, dan harapan. Momen silaturahmi ini menjadi ajang untuk memperkuat solidaritas antarwarga, merayakan keberagaman, dan menguatkan semangat gotong royong.  Di tengah gemerlap cahaya lampu hias yang menyala, suasana hangat malam ini akan terpenuhi oleh keakraban dan kegembiraan. Masing-masing meja dan sudut tempat duduk dihiasi dengan indah, menciptakan atmosfer yang penuh kebersamaan. Musik mengalun lembut di latar belakang, menambahkan nuansa meriah pada acara yang istimewa ini.  Kami mengundang seluruh warga Desa Pagadungan untuk bergabung dalam acara silaturahmi makan-makan bersama ini. Mari kita rayakan kebersamaan, nikmati kelezatan hidangan, dan jalin hubungan yang erat di bawah cahaya bulan Desa Pagadungan yang begitu indah. Acara ini adalah bukti nyata bahwa dalam kebersamaan, kita menemukan kekuatan dan kebahagiaan. Terima kasih atas partisipasi dan kehadiran Anda dalam acara ini!', 'Template Makan-makan bersama.jpg', '2024-01-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_h_pendatang`
--

CREATE TABLE `tbl_h_pendatang` (
  `id_datang` int(11) NOT NULL,
  `nik_pendatang` varchar(100) NOT NULL,
  `nama_pendatang` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_datang` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_h_pendatang`
--

INSERT INTO `tbl_h_pendatang` (`id_datang`, `nik_pendatang`, `nama_pendatang`, `jenis_kelamin`, `tanggal_datang`) VALUES
(28, '3215367', 'Azhar', 'Perempuan', '2024-01-11'),
(29, '323362', 'Putri', 'Perempuan', '2024-01-11'),
(30, '424114', 'Tryo', 'Laki-laki', '2024-01-12'),
(31, '442431', 'Ridwan', 'Laki-laki', '2024-01-12'),
(32, '3214152', 'Arul', 'Laki-laki', '2024-01-12'),
(33, '32900', 'Ridwan', 'Laki-laki', '2024-01-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelahiran`
--

CREATE TABLE `tbl_kelahiran` (
  `id_lahir` int(11) NOT NULL,
  `namabayi` varchar(225) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `id_kk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kelahiran`
--

INSERT INTO `tbl_kelahiran` (`id_lahir`, `namabayi`, `tanggal_lahir`, `jenis_kelamin`, `id_kk`) VALUES
(41, 'Rizki', '2024-01-17', 'Laki-laki', 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kk`
--

CREATE TABLE `tbl_kk` (
  `id_kk` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `rt` varchar(50) NOT NULL,
  `rw` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kk`
--

INSERT INTO `tbl_kk` (`id_kk`, `nik`, `nama`, `alamat`, `rt`, `rw`) VALUES
(20, 11000, 'Aldy', 'Pagadungan', '02', '27'),
(21, 12000, 'Ridwan', 'Galuh', '04', '12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meninggal`
--

CREATE TABLE `tbl_meninggal` (
  `id_meninggal` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `tanggal_meninggal` date NOT NULL,
  `sebab` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_meninggal`
--

INSERT INTO `tbl_meninggal` (`id_meninggal`, `id_penduduk`, `tanggal_meninggal`, `sebab`) VALUES
(21, 192536482, '2024-01-17', 'Kebacok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pendatang`
--

CREATE TABLE `tbl_pendatang` (
  `id_datang` int(11) NOT NULL,
  `nik_pendatang` varchar(100) NOT NULL,
  `nama_pendatang` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_datang` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pendatang`
--

INSERT INTO `tbl_pendatang` (`id_datang`, `nik_pendatang`, `nama_pendatang`, `jenis_kelamin`, `tanggal_datang`) VALUES
(33, '32900', 'Dedy', 'Laki-laki', '2024-01-17');

--
-- Trigger `tbl_pendatang`
--
DELIMITER $$
CREATE TRIGGER `trg_insert_histori_pendatang` AFTER INSERT ON `tbl_pendatang` FOR EACH ROW BEGIN
    INSERT INTO tbl_h_pendatang
    (
        id_datang, 
        nik_pendatang, 
        nama_pendatang, 
        jenis_kelamin, 
        tanggal_datang
    )
    VALUES
    (
        NEW.id_datang, 
        NEW.nik_pendatang, 
        NEW.nama_pendatang, 
        NEW.jenis_kelamin, 
        NEW.tanggal_datang
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penduduk`
--

CREATE TABLE `tbl_penduduk` (
  `id_penduduk` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `agama` varchar(20) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `rt` varchar(50) NOT NULL,
  `rw` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `status` enum('Sudah','Belum','Cerai Mati','Cerai Hidup') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_penduduk`
--

INSERT INTO `tbl_penduduk` (`id_penduduk`, `nik`, `nama`, `alamat`, `tanggal`, `agama`, `jenis_kelamin`, `rt`, `rw`, `pekerjaan`, `status`) VALUES
(192536482, 32100, 'Aldy', 'Pagadungan', '2024-01-17', 'Islam', 'Laki-laki', '02', '27', 'Mahasiswa', 'Belum'),
(192536483, 32200, 'Ridwan', 'Pagadungan', '2024-01-17', 'Islam', 'Laki-laki', '04', '12', 'Karyawan Swasta', 'Sudah'),
(192536484, 32300, 'Dedy', 'Pagadungan', '2024-01-10', 'Kristen', 'Laki-laki', '01', '11', 'Guru', 'Belum'),
(192536485, 32400, 'Cinta', 'Pagadungan', '2024-01-09', 'Kristen', 'Perempuan', '02', '13', 'Nelayan', 'Belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('super admin','admin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id_admin`, `nama`, `jabatan`, `alamat`, `no_hp`, `email`, `role`, `password`, `created_at`, `update_at`) VALUES
(4, 'Muhammad Ridwan Ripaldi', 'Wakil Desa', 'Galuh', '089519279274', 'ridwan@gmail.com', 'admin', '$2y$10$TLwErAGVYOul/36dI1mruusrKB1.fqoS1I8aFAaUcv2vq0f0YOjFa', '2023-12-21 10:24:46', NULL),
(8, 'Ahmad Dedy Iskandar', 'Staff', 'Tempuran', '081283291384', 'dedy@gmail.com', 'admin', '$2y$10$xKW1wpekr6.oYSM4un8pG.agNJxwwyJJYJLDMyPjTqQHTqAFEW6jy', '2024-01-17 12:56:20', NULL),
(12, 'M. Aldy Saputra', 'Kepala Desa', 'Pagadungan', '08986279967', 'aldy@gmail.com', 'super admin', '$2y$10$xM3au0BgKOIcVwZvQxovj.rEJcxyCWnsfyNRBSjRmSqAIMyoovsYC', '2024-01-17 15:30:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pindah`
--

CREATE TABLE `tbl_pindah` (
  `id_pindah` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `tanggal_pindah` date NOT NULL,
  `alasan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pindah`
--

INSERT INTO `tbl_pindah` (`id_pindah`, `id_penduduk`, `tanggal_pindah`, `alasan`) VALUES
(16, 192536483, '2024-01-17', 'Nyari Kerja');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vw_user_activity`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vw_user_activity` (
`jumlah_penduduk` bigint(21)
,`jumlah_kk` bigint(21)
,`jumlah_laki_laki` bigint(21)
,`jumlah_perempuan` bigint(21)
,`jumlah_kelahiran` bigint(21)
,`jumlah_kematian` bigint(21)
,`jumlah_pendatang` bigint(21)
,`jumlah_pindah` bigint(21)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_user_activity`
--
DROP TABLE IF EXISTS `vw_user_activity`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_user_activity`  AS SELECT (select count(`tbl_penduduk`.`id_penduduk`) from `tbl_penduduk`) AS `jumlah_penduduk`, (select count(`tbl_kk`.`id_kk`) from `tbl_kk`) AS `jumlah_kk`, (select count(`tbl_penduduk`.`id_penduduk`) from `tbl_penduduk` where `tbl_penduduk`.`jenis_kelamin` = 'Laki-laki') AS `jumlah_laki_laki`, (select count(`tbl_penduduk`.`id_penduduk`) from `tbl_penduduk` where `tbl_penduduk`.`jenis_kelamin` = 'Perempuan') AS `jumlah_perempuan`, (select count(`tbl_kelahiran`.`id_lahir`) from `tbl_kelahiran`) AS `jumlah_kelahiran`, (select count(`tbl_meninggal`.`id_meninggal`) from `tbl_meninggal`) AS `jumlah_kematian`, (select count(`tbl_pendatang`.`id_datang`) from `tbl_pendatang`) AS `jumlah_pendatang`, (select count(`tbl_pindah`.`id_pindah`) from `tbl_pindah`) AS `jumlah_pindah` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_berita`
--
ALTER TABLE `tbl_berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `tbl_kelahiran`
--
ALTER TABLE `tbl_kelahiran`
  ADD PRIMARY KEY (`id_lahir`),
  ADD KEY `id_kk` (`id_kk`);

--
-- Indeks untuk tabel `tbl_kk`
--
ALTER TABLE `tbl_kk`
  ADD PRIMARY KEY (`id_kk`);

--
-- Indeks untuk tabel `tbl_meninggal`
--
ALTER TABLE `tbl_meninggal`
  ADD PRIMARY KEY (`id_meninggal`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indeks untuk tabel `tbl_pendatang`
--
ALTER TABLE `tbl_pendatang`
  ADD PRIMARY KEY (`id_datang`);

--
-- Indeks untuk tabel `tbl_penduduk`
--
ALTER TABLE `tbl_penduduk`
  ADD PRIMARY KEY (`id_penduduk`);

--
-- Indeks untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tbl_pindah`
--
ALTER TABLE `tbl_pindah`
  ADD PRIMARY KEY (`id_pindah`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_berita`
--
ALTER TABLE `tbl_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_kelahiran`
--
ALTER TABLE `tbl_kelahiran`
  MODIFY `id_lahir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tbl_kk`
--
ALTER TABLE `tbl_kk`
  MODIFY `id_kk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tbl_meninggal`
--
ALTER TABLE `tbl_meninggal`
  MODIFY `id_meninggal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tbl_pendatang`
--
ALTER TABLE `tbl_pendatang`
  MODIFY `id_datang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tbl_penduduk`
--
ALTER TABLE `tbl_penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192536486;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_pindah`
--
ALTER TABLE `tbl_pindah`
  MODIFY `id_pindah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_kelahiran`
--
ALTER TABLE `tbl_kelahiran`
  ADD CONSTRAINT `tbl_kelahiran_ibfk_1` FOREIGN KEY (`id_kk`) REFERENCES `tbl_kk` (`id_kk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_meninggal`
--
ALTER TABLE `tbl_meninggal`
  ADD CONSTRAINT `tbl_meninggal_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`);

--
-- Ketidakleluasaan untuk tabel `tbl_pindah`
--
ALTER TABLE `tbl_pindah`
  ADD CONSTRAINT `tbl_pindah_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
