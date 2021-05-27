-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Bulan Mei 2021 pada 18.25
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aset`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `action`
--

CREATE TABLE `action` (
  `id_action` int(11) NOT NULL,
  `nama_action` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `action`
--

INSERT INTO `action` (`id_action`, `nama_action`) VALUES
(1, 'tambah'),
(2, 'pinjam'),
(3, 'kembalikan'),
(4, 'rusak'),
(5, 'hapus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` text NOT NULL,
  `id_satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangrusak`
--

CREATE TABLE `barangrusak` (
  `id_barangRusak` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_transaksi`
--

CREATE TABLE `log_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `action` int(11) NOT NULL,
  `action_datetime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam_barang`
--

CREATE TABLE `pinjam_barang` (
  `id_pinjamBarang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `qty` int(11) NOT NULL,
  `status_peminjaman` int(1) NOT NULL,
  `alasan_pinjam` text NOT NULL,
  `deskripsi_acc` text NOT NULL,
  `action_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(64) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `active` int(1) NOT NULL,
  `level` int(1) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id_action`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `barang_ibfk_1` (`id_satuan`);

--
-- Indeks untuk tabel `barangrusak`
--
ALTER TABLE `barangrusak`
  ADD PRIMARY KEY (`id_barangRusak`),
  ADD KEY `barangrusak_ibfk_1` (`id_transaksi`);

--
-- Indeks untuk tabel `log_transaksi`
--
ALTER TABLE `log_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `log_transaksi_ibfk_1` (`id_barang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `action` (`action`);

--
-- Indeks untuk tabel `pinjam_barang`
--
ALTER TABLE `pinjam_barang`
  ADD PRIMARY KEY (`id_pinjamBarang`),
  ADD KEY `pinjam_barang_ibfk_1` (`id_barang`),
  ADD KEY `pinjam_barang_ibfk_2` (`id_user`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `stok_ibfk_1` (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `action`
--
ALTER TABLE `action`
  MODIFY `id_action` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `barangrusak`
--
ALTER TABLE `barangrusak`
  MODIFY `id_barangRusak` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `log_transaksi`
--
ALTER TABLE `log_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pinjam_barang`
--
ALTER TABLE `pinjam_barang`
  MODIFY `id_pinjamBarang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barangrusak`
--
ALTER TABLE `barangrusak`
  ADD CONSTRAINT `barangrusak_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `log_transaksi` (`id_transaksi`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_transaksi`
--
ALTER TABLE `log_transaksi`
  ADD CONSTRAINT `log_transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `log_transaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `log_transaksi_ibfk_3` FOREIGN KEY (`action`) REFERENCES `action` (`id_action`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pinjam_barang`
--
ALTER TABLE `pinjam_barang`
  ADD CONSTRAINT `pinjam_barang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pinjam_barang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `log_transaksi` (`id_transaksi`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
