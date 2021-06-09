-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jun 08, 2021 at 04:09 AM
-- Server version: 8.0.25
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aset`
--

SET GLOBAL log_bin_trust_function_creators = 1;

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`%` FUNCTION `Cek_availability` (`id` INT, `tgl_mulai` DATE, `tgl_akhir` DATE, `qty_pinjam` INT) RETURNS TINYINT(1) BEGIN
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

CREATE DEFINER=`root`@`%` FUNCTION `Cek_Pinjaman` (`id` INT, `tgl` DATE) RETURNS INT BEGIN
	DECLARE stok INT;
	SELECT IFNULL(SUM(qty),0) INTO stok FROM pinjam_barang WHERE tgl_pinjam<=tgl AND tgl_pengembalian >= tgl AND id_barang=id AND status_peminjaman=1;
	RETURN stok;
END$$

CREATE DEFINER=`root`@`%` FUNCTION `Cek_Stok` (`id` INT, `tgl` DATE) RETURNS INT BEGIN
	DECLARE stok INT;
	SELECT Cek_Stok_Action(id, 1)-Cek_Pinjaman(id, tgl)-Cek_Stok_Action(id, 4)-Cek_Stok_Action(id, 5) INTO stok;
	RETURN stok;
END$$

CREATE DEFINER=`root`@`%` FUNCTION `Cek_Stok_Action` (`id` INT, `act` INT) RETURNS INT BEGIN
	DECLARE stok INT;
	SELECT IFNULL(SUM(qty),0) INTO stok FROM log_transaksi WHERE id_barang=id AND action=act;
	RETURN stok;
END$$

CREATE DEFINER=`root`@`%` FUNCTION `Cek_Stok_Hariini` (`id` INT) RETURNS INT BEGIN
	DECLARE stok INT;
	DECLARE tgl DATE;
	SELECT CURDATE() INTO tgl;
	SELECT Cek_Stok_Action(id, 1)-Cek_Pinjaman(id, tgl)-Cek_Stok_Action(id, 4)-Cek_Stok_Action(id, 5) INTO stok;
	RETURN stok;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `id_action` int NOT NULL,
  `nama_action` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id_action`, `nama_action`) VALUES
(1, 'tambah'),
(2, 'pinjam'),
(3, 'kembalikan'),
(4, 'rusak'),
(5, 'hapus');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` text NOT NULL,
  `id_satuan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `barangrusak`
--

CREATE TABLE `barangrusak` (
  `id_barangRusak` int NOT NULL,
  `deskripsi` text NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_pinjamBarang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_transaksi`
--

CREATE TABLE `log_transaksi` (
  `id_transaksi` int NOT NULL,
  `id_barang` int NOT NULL,
  `id_user` int NOT NULL,
  `qty` int NOT NULL,
  `action` int NOT NULL,
  `action_datetime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_barang`
--

CREATE TABLE `pinjam_barang` (
  `id_pinjamBarang` int NOT NULL,
  `id_user` int NOT NULL,
  `id_barang` int NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `qty` int NOT NULL,
  `status_peminjaman` int NOT NULL,
  `alasan_pinjam` text NOT NULL,
  `deskripsi_acc` text NOT NULL,
  `action_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `satuan`) VALUES
(1, 'Unit'),
(2, 'Ruang'),
(3, 'Pasang'),
(4, 'Lembar'),
(5, 'Dus'),
(6, 'Buah');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(64) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `active` int NOT NULL DEFAULT '1',
  `level` int NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id_action`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `barang_ibfk_1` (`id_satuan`);

--
-- Indexes for table `barangrusak`
--
ALTER TABLE `barangrusak`
  ADD PRIMARY KEY (`id_barangRusak`),
  ADD KEY `barangrusak_ibfk_1` (`id_transaksi`),
  ADD KEY `pinjamBarang` (`id_pinjamBarang`);

--
-- Indexes for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `log_transaksi_ibfk_1` (`id_barang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `action` (`action`);

--
-- Indexes for table `pinjam_barang`
--
ALTER TABLE `pinjam_barang`
  ADD PRIMARY KEY (`id_pinjamBarang`),
  ADD KEY `pinjam_barang_ibfk_1` (`id_barang`),
  ADD KEY `pinjam_barang_ibfk_2` (`id_user`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `stok_ibfk_1` (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
  MODIFY `id_action` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barangrusak`
--
ALTER TABLE `barangrusak`
  MODIFY `id_barangRusak` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pinjam_barang`
--
ALTER TABLE `pinjam_barang`
  MODIFY `id_pinjamBarang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`) ON UPDATE CASCADE;

--
-- Constraints for table `barangrusak`
--
ALTER TABLE `barangrusak`
  ADD CONSTRAINT `barangrusak_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `log_transaksi` (`id_transaksi`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pinjamBarang` FOREIGN KEY (`id_pinjamBarang`) REFERENCES `pinjam_barang` (`id_pinjamBarang`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  ADD CONSTRAINT `log_transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `log_transaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `log_transaksi_ibfk_3` FOREIGN KEY (`action`) REFERENCES `action` (`id_action`) ON UPDATE CASCADE;

--
-- Constraints for table `pinjam_barang`
--
ALTER TABLE `pinjam_barang`
  ADD CONSTRAINT `pinjam_barang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pinjam_barang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `log_transaksi` (`id_transaksi`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
