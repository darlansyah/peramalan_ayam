-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Apr 2021 pada 17.44
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
(1, 'darlan', 'darlan', 'rahasia', 'admin', '2021-04-15 16:59:35', '2021-04-15 16:59:35'),
(2, 'ahmad', 'ahmad', 'rahasia', 'superadmin', '2021-04-16 16:59:35', '2021-04-16 16:59:35'),
(3, 'bima', 'bima', 'password', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(1, 'ayam500'),
(2, 'ayam200'),
(3, 'ayam 300'),
(6, 'ayam 4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap`
--

CREATE TABLE `rekap` (
  `id` int(11) NOT NULL,
  `ayam_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rekap`
--

INSERT INTO `rekap` (`id`, `ayam_id`, `tanggal`, `jumlah`) VALUES
(3, 1, '2021-04-15', 87),
(4, 1, '2021-04-28', 99),
(5, 6, '2021-04-20', 10),
(6, 6, '2021-04-20', 100),
(7, 6, '2021-04-20', 201);

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
-- Indeks untuk tabel `rekap`
--
ALTER TABLE `rekap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ayam_id` (`ayam_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `rekap`
--
ALTER TABLE `rekap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `rekap`
--
ALTER TABLE `rekap`
  ADD CONSTRAINT `rekap_ibfk_1` FOREIGN KEY (`ayam_id`) REFERENCES `ayam` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
