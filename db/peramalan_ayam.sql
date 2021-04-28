-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Apr 2021 pada 19.03
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peramalan_ayam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` enum('superadmin','admin') NOT NULL,
  `waktu_login` timestamp NULL DEFAULT NULL,
  `waktu_logout` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `nama`, `username`, `password`, `level`, `waktu_login`, `waktu_logout`) VALUES
(1, 'darlan', 'darlan', 'rahasia', 'admin', '2021-04-27 17:24:16', '2021-04-27 17:24:03'),
(2, 'ahmad', 'ahmad', 'rahasia', 'superadmin', '2021-04-16 16:59:35', '2021-04-16 16:59:35'),
(3, 'bima', 'bima', 'rahasia', 'admin', '0000-00-00 00:00:00', '2021-04-27 17:16:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ayam`
--

CREATE TABLE `ayam` (
  `id` int(11) NOT NULL,
  `nama_ayam` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ayam`
--

INSERT INTO `ayam` (`id`, `nama_ayam`) VALUES
(3, 'ayam 30pp'),
(6, 'ayam 4'),
(7, 'ayam bag');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kandang`
--

CREATE TABLE `kandang` (
  `id` int(11) NOT NULL,
  `kandang` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kandang`
--

INSERT INTO `kandang` (`id`, `kandang`) VALUES
(1, 'kandang 1'),
(2, 'kandang 2'),
(3, 'kandang 3'),
(4, 'kandang 4'),
(5, 'kandang 5'),
(6, 'kandang 6'),
(7, 'kandang 7'),
(8, 'kandang 8');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap`
--

CREATE TABLE `rekap` (
  `id` int(11) NOT NULL,
  `ayam_id` int(11) NOT NULL,
  `kandang_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rekap`
--

INSERT INTO `rekap` (`id`, `ayam_id`, `kandang_id`, `tanggal`, `jumlah`) VALUES
(8, 6, 1, '2021-04-01', 12),
(9, 7, 1, '2021-01-01', 1),
(10, 6, 2, '2019-01-01', 12),
(11, 6, 6, '2016-06-06', 6),
(12, 7, 7, '2021-01-07', 77),
(14, 7, 1, '2021-01-03', 90),
(15, 7, 2, '2021-01-11', 12),
(16, 7, 1, '2019-01-01', 100),
(17, 3, 3, '2021-04-07', 10),
(18, 7, 6, '2021-04-06', 10),
(19, 6, 4, '2021-04-13', 10),
(20, 3, 2, '2021-04-11', 10);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ayam`
--
ALTER TABLE `ayam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kandang`
--
ALTER TABLE `kandang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekap`
--
ALTER TABLE `rekap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ayam_id` (`ayam_id`),
  ADD KEY `kandang_id` (`kandang_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ayam`
--
ALTER TABLE `ayam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kandang`
--
ALTER TABLE `kandang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `rekap`
--
ALTER TABLE `rekap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `rekap`
--
ALTER TABLE `rekap`
  ADD CONSTRAINT `rekap_ibfk_1` FOREIGN KEY (`ayam_id`) REFERENCES `ayam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekap_ibfk_2` FOREIGN KEY (`kandang_id`) REFERENCES `kandang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
