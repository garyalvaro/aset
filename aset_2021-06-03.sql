-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2021 pada 10.40
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 7.2.2

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

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `Cek_availability` (`id` INT, `tgl_mulai` DATE, `tgl_akhir` DATE, `qty_pinjam` INT) RETURNS TINYINT(1) BEGIN
	DECLARE ans BOOLEAN;
	SET ans = 1;
	WHILE tgl_mulai<=tgl_akhir DO
		IF(qty_pinjam > Cek_stok(id, tgl_mulai)) THEN
			SET ans = 0;
		END IF;
		SELECT DATE_ADD(tgl_mulai, INTERVAL 1 DAY) INTO tgl_mulai;
	END WHILE;
	RETURN ans;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Cek_Pinjaman` (`id` INT, `tgl` DATE) RETURNS INT(8) BEGIN
	DECLARE stok INT;
	SELECT IFNULL(SUM(qty),0) INTO stok FROM pinjam_barang WHERE tgl_pinjam<=tgl AND tgl_pengembalian >= tgl AND id_barang=id AND status_peminjaman=1;
	RETURN stok;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Cek_Stok` (`id` INT, `tgl` DATE) RETURNS INT(8) BEGIN
	DECLARE stok INT;
	SELECT Cek_Stok_Action(id, 1)-Cek_Pinjaman(id, tgl)-Cek_Stok_Action(id, 4)-Cek_Stok_Action(id, 5) INTO stok;
	RETURN stok;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Cek_Stok_Action` (`id` INT, `act` INT) RETURNS INT(8) BEGIN
	DECLARE stok INT;
	SELECT IFNULL(SUM(qty),0) INTO stok FROM log_transaksi WHERE id_barang=id AND action=act;
	RETURN stok;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Cek_Stok_Hariini` (`id` INT) RETURNS INT(8) BEGIN
	DECLARE stok INT;
	DECLARE tgl DATE;
	SELECT CURDATE() INTO tgl;
	SELECT Cek_Stok_Action(id, 1)-Cek_Pinjaman(id, tgl)-Cek_Stok_Action(id, 4)-Cek_Stok_Action(id, 5) INTO stok;
	RETURN stok;
END$$

DELIMITER ;

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

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `deskripsi`, `foto`, `id_satuan`) VALUES
(7, 'Router', 'blue', '20210602_174201-.jpg', 1),
(8, 'pulpen', 'grey', '20210531_163845-.jpg', 1),
(9, 'pulpen', 'warna warni', '20210531_165716-.jpg', 1),
(10, 'kabel', 'koaksial', '20210601_073421-.jpg', 1),
(11, 'tinta', 'warna warni', '20210601_120234-.jpg', 1),
(12, 'nic', 'ini nic baru', '20210602_103731-.jpg', 2),
(13, 'Landcard', 'ini landcard baru', '20210602_101834-.jpg', 2),
(14, 'buku', 'warna warni', '20210602_173412-.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangrusak`
--

CREATE TABLE `barangrusak` (
  `id_barangRusak` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barangrusak`
--

INSERT INTO `barangrusak` (`id_barangRusak`, `deskripsi`, `id_transaksi`) VALUES
(1, 'pecah', 15),
(2, 'pecah', 23);

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

--
-- Dumping data untuk tabel `log_transaksi`
--

INSERT INTO `log_transaksi` (`id_transaksi`, `id_barang`, `id_user`, `qty`, `action`, `action_datetime`) VALUES
(11, 7, 1, 3, 1, '2021-05-30'),
(12, 8, 1, 4, 1, '2021-05-31'),
(13, 9, 1, 4, 1, '2021-05-31'),
(14, 10, 1, 9, 1, '2021-06-01'),
(15, 7, 1, 2, 4, '2021-06-01'),
(16, 7, 1, 2, 5, '2021-06-01'),
(18, 10, 1, 2, 2, '2021-06-01'),
(20, 11, 1, 4, 1, '2021-06-01'),
(21, 12, 1, 3, 1, '2021-06-02'),
(22, 12, 1, 4, 1, '2021-06-02'),
(23, 12, 1, 4, 4, '2021-06-02'),
(24, 13, 1, 3, 1, '2021-06-02'),
(25, 14, 1, 4, 1, '2021-06-02');

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

--
-- Dumping data untuk tabel `pinjam_barang`
--

INSERT INTO `pinjam_barang` (`id_pinjamBarang`, `id_user`, `id_barang`, `tgl_pinjam`, `tgl_pengembalian`, `qty`, `status_peminjaman`, `alasan_pinjam`, `deskripsi_acc`, `action_datetime`) VALUES
(1, 1, 10, '2021-06-01', '2021-06-09', 2, 1, 'aaaaa', 'aaaaaa', '2021-06-01 00:00:00'),
(2, 1, 7, '0000-00-00', '0000-00-00', 0, 0, '', '-', '2021-06-02 00:00:00'),
(3, 1, 7, '0000-00-00', '0000-00-00', 0, 0, '', '-', '2021-06-02 00:00:00'),
(4, 1, 7, '0000-00-00', '0000-00-00', 0, 0, '', '-', '2021-06-02 00:00:00'),
(5, 1, 7, '0000-00-00', '0000-00-00', 0, 0, '', '-', '2021-06-02 00:00:00'),
(6, 1, 7, '0000-00-00', '0000-00-00', 0, 0, '', '-', '2021-06-02 00:00:00'),
(7, 1, 7, '2021-06-03', '2021-06-09', 4, 0, 'gtu', '-', '2021-06-02 00:00:00'),
(8, 1, 7, '2021-06-02', '2021-06-10', 1, 0, 'gtu', '-', '2021-06-02 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `satuan`) VALUES
(1, 'biji'),
(2, 'buah');

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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `nama`, `nim`, `active`, `level`, `foto`) VALUES
(1, 'admin', 'aaa@gmail.com', 'admin', 'admin', '181402082', 1, 1, 'aaa.jpg');

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `barangrusak`
--
ALTER TABLE `barangrusak`
  MODIFY `id_barangRusak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `log_transaksi`
--
ALTER TABLE `log_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `pinjam_barang`
--
ALTER TABLE `pinjam_barang`
  MODIFY `id_pinjamBarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
