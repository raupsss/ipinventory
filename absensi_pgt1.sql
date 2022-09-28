-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2022 at 04:37 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_pgt1`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `idabsen` int(11) NOT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `absenmasuk` datetime DEFAULT NULL,
  `absenout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`idabsen`, `nim`, `tanggal`, `absenmasuk`, `absenout`) VALUES
(1, '2002007', '2022-03-28', '2022-03-28 07:30:00', '2022-03-28 16:00:00'),
(2, '2002007', '2022-03-27', '2022-03-28 06:30:00', '2022-03-28 16:00:00'),
(3, '2002007', '2022-03-26', '2022-03-28 10:30:19', '2022-03-28 10:30:20'),
(4, '2002007', '2022-03-25', NULL, '2022-03-28 16:00:00'),
(5, '2002007', '2022-03-24', '2022-03-28 06:34:38', NULL),
(6, NULL, '2022-03-28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `absensi_mhs`
--

CREATE TABLE `absensi_mhs` (
  `nama` varchar(50) NOT NULL,
  `nim` int(50) NOT NULL,
  `Prodi` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi_mhs`
--

INSERT INTO `absensi_mhs` (`nama`, `nim`, `Prodi`, `phone`, `pass`) VALUES
('FAKHRI SADEWO', 7, 'TEKNIK ELEKTRONIKA', '0813185467745', 'aku'),
('FAKHRI SADEWA', 2002007, 'TEKNIK ELEKTRONIKA', '0813185863998', 'ada_di'),
('GILANG ', 2002010, 'TEKNIK ELEKTRONIKA', '0813185467745', 'poltek');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `foto` varchar(50) NOT NULL,
  `id_gudang` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`, `nama_lengkap`, `level`, `blokir`, `foto`, `id_gudang`) VALUES
('a', '0cc175b9c0f1b6a831c399e269772661', 'aaaa', '03', 'N', 'c_bb2.jpg', 1),
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', '01', 'N', 'ayah_profile.jpg', NULL),
('b', '92eb5ffee6ae2fec3ad71c777531578f', 'bb', '03', 'N', '', 2),
('deddy', 'bbf56d5b9d8b7fc1b86783f2d3cd01ed', 'Deddy Rusdiansyah,S.Kom', '02', 'N', 'ayah_profile.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` char(15) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` char(10) NOT NULL,
  `harga_beli` bigint(20) NOT NULL,
  `harga_jual` bigint(20) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `id_gudang` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `satuan`, `harga_beli`, `harga_jual`, `stok_awal`, `id_gudang`) VALUES
('123456', 'Sprite Kaleng', 'PCS', 5000, 5500, 6, 1),
('B001', 'Hardisk 40Gb', 'PCS', 230000, 250000, 1, 1),
('B002', 'Hardisk 60Gb', 'BOX', 240000, 260000, 4, 0),
('B003', 'Hardisk 80Gb', 'PCS', 250000, 270000, 17, 0),
('B005', 'Keyboard PS2', 'PCS', 35000, 45000, 70, 0),
('B006', 'Mouse PS2', 'PCS', 25000, 30000, 0, 0),
('B007', 'Processor Dual Core', 'PCS', 1200000, 1400000, 10, 0),
('B008', 'Prosesor Core 2 Duo', 'PCS', 1500000, 1720000, 5, 0),
('B009', 'Sampurna Mild', 'PCS', 10000, 12000, 5, 0),
('B010', 'Dji Sam Soe', 'PCS', 9000, 11000, 5, 0),
('B011', 'Kopi Kapal Api', 'PCS', 450, 500, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('04574a491a31593795148e9d2b2f8814', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 1664332375, 'a:7:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";s:13:\"aingLoginYeuh\";s:8:\"username\";s:5:\"admin\";s:12:\"nama_lengkap\";s:13:\"Administrator\";s:4:\"foto\";s:16:\"ayah_profile.jpg\";s:5:\"level\";s:11:\"Super Admin\";s:6:\"gudang\";N;}');

-- --------------------------------------------------------

--
-- Table structure for table `d_beli`
--

CREATE TABLE `d_beli` (
  `idbeli` smallint(6) NOT NULL,
  `kodebeli` char(15) NOT NULL,
  `kode_barang` char(15) NOT NULL,
  `jmlbeli` int(11) NOT NULL,
  `hargabeli` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_beli`
--

INSERT INTO `d_beli` (`idbeli`, `kodebeli`, `kode_barang`, `jmlbeli`, `hargabeli`) VALUES
(2, 'BL00002', 'B002', 2, 240000),
(3, 'BL00003', 'B005', 2, 35000),
(4, 'BL00003', 'B009', 1, 10000),
(5, 'BL00004', 'B007', 2, 1200000),
(6, 'BL00004', 'B010', 2, 9000),
(7, 'BL00005', 'B006', 2, 25000),
(8, 'BL00005', 'B008', 1, 1500000),
(12, 'BL00006', 'B003', 2, 250000),
(13, 'BL00006', 'B010', 3, 9000),
(14, 'BL00007', 'B007', 2, 1200000),
(16, 'BL00007', 'B003', 2, 250000),
(17, 'BL00008', '123456', 2, 5000),
(18, 'BL00008', 'B009', 2, 10000),
(19, 'BL00006', 'B005', 2, 35000),
(20, 'BL00006', 'B009', 5, 10000),
(21, 'BL00004', 'B005', 10, 35000),
(31, 'BL00001', '123456', 5, 5000),
(32, 'BL00001', 'B006', 5, 25000),
(36, 'BL00009', 'B001', 20, 230000),
(40, 'BL00010', '123456', 20, 5000),
(41, 'BL00011', 'B002', 100, 240000),
(42, 'BL00013', '123456', 2, 5000),
(43, 'BL00014', 'B002', 10, 240000);

-- --------------------------------------------------------

--
-- Table structure for table `d_jual`
--

CREATE TABLE `d_jual` (
  `idjual` smallint(6) NOT NULL,
  `kodejual` char(15) NOT NULL,
  `kode_barang` char(15) NOT NULL,
  `jmljual` int(11) NOT NULL,
  `hargajual` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_jual`
--

INSERT INTO `d_jual` (`idjual`, `kodejual`, `kode_barang`, `jmljual`, `hargajual`) VALUES
(2, 'JL00001', 'B001', 2, 230000),
(3, 'JL00001', 'B002', 2, 240000),
(5, 'JL00002', 'B005', 10, 35000),
(6, 'JL00003', 'B006', 2, 25000),
(7, 'JL00004', 'B007', 2, 1200000),
(8, 'JL00004', 'B009', 5, 10000),
(9, 'JL00004', 'B011', 2, 450),
(10, 'JL00005', 'B001', 3, 230000),
(11, 'JL00005', 'B002', 2, 240000),
(12, 'JL00006', 'B001', 2, 230000),
(13, 'JL00006', 'B002', 2, 240000),
(14, 'JL00006', '123456', 2, 5000),
(15, 'JL00007', 'B001', 10, 230000),
(16, 'JL00007', 'B002', 10, 240000),
(17, 'JL00008', 'B002', 2, 240000),
(18, 'JL00008', 'B001', 2, 230000),
(19, 'JL00009', 'B003', 2, 270000),
(20, 'JL00009', 'B002', 10, 260000),
(21, 'JL00010', 'B001', 2, 230000),
(22, 'JL00012', '123456', 2, 5500),
(23, 'JL00013', 'B003', 5, 270000);

-- --------------------------------------------------------

--
-- Table structure for table `d_pesan`
--

CREATE TABLE `d_pesan` (
  `kode_pesan` char(10) NOT NULL DEFAULT '',
  `kode_barang` char(15) NOT NULL DEFAULT '',
  `jml_pesan` int(11) DEFAULT NULL,
  `harga_pesan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_pesan`
--

INSERT INTO `d_pesan` (`kode_pesan`, `kode_barang`, `jml_pesan`, `harga_pesan`) VALUES
('PS00001', 'B001', 10, 230000),
('PS00002', 'B001', 1, 230000),
('PS00003', '123456', 20, 5000),
('PS00003', 'B001', 10, 230000);

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` smallint(6) NOT NULL,
  `gudang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `gudang`) VALUES
(1, 'Gudang A'),
(2, 'Gudang B'),
(3, 'Gudang C');

-- --------------------------------------------------------

--
-- Table structure for table `h_beli`
--

CREATE TABLE `h_beli` (
  `kodebeli` char(15) NOT NULL,
  `tglbeli` date NOT NULL,
  `kode_supplier` char(5) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_beli`
--

INSERT INTO `h_beli` (`kodebeli`, `tglbeli`, `kode_supplier`, `username`) VALUES
('BL00001', '2012-08-27', 'SP001', 'admin'),
('BL00002', '2012-08-27', 'SP004', 'admin'),
('BL00003', '2012-08-27', 'SP005', 'admin'),
('BL00004', '2012-08-27', 'SP004', 'admin'),
('BL00005', '2012-08-27', 'SP007', 'admin'),
('BL00006', '2012-08-27', 'SP009', 'admin'),
('BL00007', '2012-08-27', 'SP007', 'admin'),
('BL00008', '2012-08-26', 'SP004', 'admin'),
('BL00009', '2013-04-09', 'SP001', 'admin'),
('BL00010', '2013-04-09', 'SP002', 'admin'),
('BL00011', '2013-04-09', 'SP006', 'admin'),
('BL00012', '2013-06-10', 'SP003', 'admin'),
('BL00013', '2013-07-14', 'SP001', 'a'),
('BL00014', '2013-07-16', 'SP002', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `h_jual`
--

CREATE TABLE `h_jual` (
  `kodejual` char(15) NOT NULL,
  `tgljual` date NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_jual`
--

INSERT INTO `h_jual` (`kodejual`, `tgljual`, `username`) VALUES
('JL00001', '2012-08-27', 'admin'),
('JL00002', '2012-08-27', 'admin'),
('JL00003', '2012-08-27', 'admin'),
('JL00004', '2012-08-30', 'admin'),
('JL00005', '2012-08-30', 'admin'),
('JL00006', '2013-04-09', 'admin'),
('JL00007', '2013-04-09', 'admin'),
('JL00008', '2013-04-09', 'admin'),
('JL00009', '2013-04-10', 'admin'),
('JL00010', '2013-05-21', 'admin'),
('JL00011', '2013-06-10', 'admin'),
('JL00012', '2013-07-14', 'a'),
('JL00013', '2013-07-16', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `h_pesan`
--

CREATE TABLE `h_pesan` (
  `kode_pesan` char(10) NOT NULL DEFAULT '',
  `tgl_pesan` date DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `id_gudang` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_pesan`
--

INSERT INTO `h_pesan` (`kode_pesan`, `tgl_pesan`, `username`, `id_gudang`) VALUES
('PS00001', '2013-07-14', 'a', NULL),
('PS00002', '2013-07-17', 'a', NULL),
('PS00003', '2013-07-17', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` char(2) NOT NULL,
  `level` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `level`) VALUES
('01', 'Super Admin'),
('02', 'Admin'),
('03', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kode_supplier` char(5) NOT NULL DEFAULT '',
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kode_supplier`, `nama_supplier`, `alamat`) VALUES
('SP001', 'Maju Terus,CV.', 'A.Yani 30 tes ssa'),
('SP002', 'Maju Mundur,CV.', 'A.Yani 31'),
('SP003', 'Maju Lambat,PT.', 'A.Yani 32'),
('SP004', 'Deddy', 'Cimuncang Sidomuncul'),
('SP005', 'Jangan Dihapus', 'Makannya jangan diedit kebanayakalasdkal '),
('SP006', 'Bantex', 'Dimana aja boleh'),
('SP007', 'Coba lagi dong', 'biar mantap'),
('SP008', 'Kapal Api', 'Jalan Mana Saja'),
('SP009', 'ITB Piksi Input', 'Serang'),
('SP010', 'Edifier', 'Serang'),
('SP011', 'Font Arial', 'Jakarta'),
('SP012', 'Font Verdana', 'Jakarta Selatan'),
('SP013', 'Tes', 'tes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`idabsen`);

--
-- Indexes for table `absensi_mhs`
--
ALTER TABLE `absensi_mhs`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `d_beli`
--
ALTER TABLE `d_beli`
  ADD PRIMARY KEY (`idbeli`),
  ADD KEY `kodebeli` (`kodebeli`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `d_jual`
--
ALTER TABLE `d_jual`
  ADD PRIMARY KEY (`idjual`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kodejual` (`kodejual`);

--
-- Indexes for table `d_pesan`
--
ALTER TABLE `d_pesan`
  ADD PRIMARY KEY (`kode_pesan`,`kode_barang`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`);

--
-- Indexes for table `h_beli`
--
ALTER TABLE `h_beli`
  ADD PRIMARY KEY (`kodebeli`),
  ADD KEY `kode_supplier` (`kode_supplier`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `h_jual`
--
ALTER TABLE `h_jual`
  ADD PRIMARY KEY (`kodejual`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `h_pesan`
--
ALTER TABLE `h_pesan`
  ADD PRIMARY KEY (`kode_pesan`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `idabsen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `d_beli`
--
ALTER TABLE `d_beli`
  MODIFY `idbeli` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `d_jual`
--
ALTER TABLE `d_jual`
  MODIFY `idjual` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_gudang` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `d_beli`
--
ALTER TABLE `d_beli`
  ADD CONSTRAINT `d_beli_ibfk_1` FOREIGN KEY (`kodebeli`) REFERENCES `h_beli` (`kodebeli`),
  ADD CONSTRAINT `d_beli_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`);

--
-- Constraints for table `d_jual`
--
ALTER TABLE `d_jual`
  ADD CONSTRAINT `d_jual_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`),
  ADD CONSTRAINT `d_jual_ibfk_2` FOREIGN KEY (`kodejual`) REFERENCES `h_jual` (`kodejual`);

--
-- Constraints for table `h_beli`
--
ALTER TABLE `h_beli`
  ADD CONSTRAINT `h_beli_ibfk_1` FOREIGN KEY (`kode_supplier`) REFERENCES `supplier` (`kode_supplier`),
  ADD CONSTRAINT `h_beli_ibfk_2` FOREIGN KEY (`username`) REFERENCES `admins` (`username`);

--
-- Constraints for table `h_jual`
--
ALTER TABLE `h_jual`
  ADD CONSTRAINT `h_jual_ibfk_1` FOREIGN KEY (`username`) REFERENCES `admins` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
