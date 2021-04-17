-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Feb 2021 pada 22.17
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
-- Database: `bahan_pokok`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_pokok`
--

CREATE TABLE `bahan_pokok` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahan_pokok`
--

INSERT INTO `bahan_pokok` (`id`, `kategori_id`, `nama`) VALUES
(1, 1, 'beras mentik wangi 1'),
(2, 1, 'beras mentik wangi 2'),
(3, 1, 'beras'),
(4, 1, 'beras1'),
(7, 2, 'kategori222');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'beras'),
(2, 'daging'),
(3, 'tepung'),
(6, 'kategorii');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('superadmin','admin') NOT NULL,
  `waktu_login` timestamp NULL DEFAULT NULL,
  `waktu_logout` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `username`, `password`, `level`, `waktu_login`, `waktu_logout`) VALUES
(1, 'luqmen', 'luqmen', 'password', 'superadmin', '2021-02-28 21:10:17', '2021-02-28 21:11:38'),
(2, 'ajis1', 'ajis', 'password', 'superadmin', '2021-02-28 17:19:50', '2021-02-28 20:51:04'),
(4, 'ergan', 'ergan', 'password', 'admin', '2021-02-28 21:06:44', '2021-02-28 21:09:55'),
(5, 'bayu', 'bayu', 'password', 'admin', '2021-02-28 21:11:45', '2021-02-28 20:57:03'),
(6, 'candra', 'candra', 'password', 'superadmin', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap`
--

CREATE TABLE `rekap` (
  `id` int(11) NOT NULL,
  `bahan_pokok_id` int(11) NOT NULL,
  `tahun` int(4) NOT NULL,
  `bulan` enum('januari','febuari','maret','april','mei','juni','juli','agustus','septemper','oktober','november','desember') NOT NULL,
  `minggu` enum('I','II','III','IV','V') NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rekap`
--

INSERT INTO `rekap` (`id`, `bahan_pokok_id`, `tahun`, `bulan`, `minggu`, `harga`) VALUES
(2, 4, 2020, 'maret', 'II', 89000),
(3, 1, 2020, 'febuari', 'II', 10000),
(4, 2, 2021, 'januari', 'I', 12000),
(8, 3, 2021, 'januari', 'I', 80000),
(9, 3, 2021, 'mei', 'IV', 72000),
(10, 3, 2021, 'maret', 'I', 86000),
(11, 3, 2018, 'april', 'I', 98000),
(12, 3, 2021, 'febuari', 'I', 99000),
(13, 3, 2021, 'januari', 'II', 94000),
(14, 1, 2021, 'januari', 'I', 2424),
(21, 3, 2019, 'maret', 'IV', 71000),
(22, 3, 2021, 'januari', 'IV', 87000),
(23, 3, 2021, 'febuari', 'III', 98000),
(24, 3, 2021, 'febuari', 'IV', 80000),
(25, 3, 2021, 'febuari', 'V', 90000),
(26, 3, 2021, 'juni', 'II', 70000),
(27, 3, 2021, 'januari', 'III', 80000),
(28, 3, 2021, 'januari', 'V', 90000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan_pokok`
--
ALTER TABLE `bahan_pokok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekap`
--
ALTER TABLE `rekap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bahan_pokok_id` (`bahan_pokok_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan_pokok`
--
ALTER TABLE `bahan_pokok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `rekap`
--
ALTER TABLE `rekap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bahan_pokok`
--
ALTER TABLE `bahan_pokok`
  ADD CONSTRAINT `bahan_pokok_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekap`
--
ALTER TABLE `rekap`
  ADD CONSTRAINT `rekap_ibfk_1` FOREIGN KEY (`bahan_pokok_id`) REFERENCES `bahan_pokok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
