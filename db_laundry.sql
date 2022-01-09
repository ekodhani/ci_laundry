-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2022 pada 06.29
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `laundry`
--

CREATE TABLE `laundry` (
  `id_laundry` int(11) NOT NULL,
  `nama_konsumen` varchar(45) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `status` enum('masuk','keluar') DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `paket_id_paket` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laundry`
--

INSERT INTO `laundry` (`id_laundry`, `nama_konsumen`, `berat`, `status`, `bayar`, `tgl_masuk`, `tgl_keluar`, `paket_id_paket`) VALUES
(16, 'Huda', 3, 'keluar', 24000, '2022-01-06', '2022-01-07', 4),
(17, 'Ahmad R', 2, 'keluar', 12000, '2022-01-06', '2022-01-07', 3),
(18, 'Zainul M', 1, 'keluar', 6000, '2022-01-01', '2022-01-02', 3),
(22, 'Dwi Marhen', 10, 'keluar', 80000, '2021-12-31', '2022-01-01', 4),
(29, 'Hariyono', 2, 'masuk', 12000, '2022-01-07', NULL, 3),
(30, 'Nurrohman', 3, 'masuk', 24000, '2022-01-07', NULL, 4),
(31, 'Muhammad Hadi', 2, 'masuk', 16000, '2022-01-07', NULL, 4),
(32, 'Suparwati', 4, 'masuk', 32000, '2022-01-07', NULL, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(45) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `harga`) VALUES
(1, 'Cuci Kering', 4000),
(2, 'Cuci Setrika', 5000),
(3, 'Cuci Komplit', 6000),
(4, 'Express 4 Jam Selesai', 8000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama_usr` varchar(45) NOT NULL,
  `alamat` text NOT NULL,
  `universitas` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `level` enum('super','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_usr`, `alamat`, `universitas`, `foto`, `level`) VALUES
(3, 'admin', '01cfcd4f6b8770febfb40cb906715822', 'Wahidin', 'Kampung Bali No.41 Rt.007 Rw.002, Kecamatan Kalideres, Kelurahan Kalideres, Kota Jakarta Barat', 'Bina Sarana Informatika', '71feaba7211e4a9f46e8669e3ea9ae9b.jpg', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `laundry`
--
ALTER TABLE `laundry`
  ADD PRIMARY KEY (`id_laundry`),
  ADD KEY `fk_laundry_paket_idx` (`paket_id_paket`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `laundry`
--
ALTER TABLE `laundry`
  MODIFY `id_laundry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laundry`
--
ALTER TABLE `laundry`
  ADD CONSTRAINT `fk_laundry_paket` FOREIGN KEY (`paket_id_paket`) REFERENCES `paket` (`id_paket`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
