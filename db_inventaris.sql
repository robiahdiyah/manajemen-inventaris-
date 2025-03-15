-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2025 at 07:51 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `mrp`
--

CREATE TABLE `mrp` (
  `id` int NOT NULL,
  `kode_barang` varchar(8) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jml_barangkeluar` int DEFAULT NULL,
  `jml_barangmasuk` int DEFAULT NULL,
  `safety_stock` int DEFAULT NULL,
  `net_requirements` int DEFAULT NULL,
  `tanggal_input_mrp` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mrp`
--

INSERT INTO `mrp` (`id`, `kode_barang`, `jml_barangkeluar`, `jml_barangmasuk`, `safety_stock`, `net_requirements`, `tanggal_input_mrp`) VALUES
(2, 'MJC301', 28, 355, 327, 10, '2025-03-15'),
(3, 'MJC301', 43, 355, 312, 15, '2025-03-15'),
(4, 'MJC304', 50, 50, 0, 50, '2025-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`kode_barang`, `nama_barang`) VALUES
('MJC301', ' ROCKING CHAIR'),
('MJC302', 'RECLINER'),
('MJC304', 'STACKING CHAIR');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keluarbarang`
--

CREATE TABLE `tbl_keluarbarang` (
  `no_pinjam` varchar(8) NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `peminjam` varchar(35) NOT NULL,
  `jumlah_pinjam` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_keluarbarang`
--

INSERT INTO `tbl_keluarbarang` (`no_pinjam`, `kode_barang`, `nama_barang`, `tgl_pinjam`, `peminjam`, `jumlah_pinjam`) VALUES
('PMJN002', 'MJC302', 'RECLINER', '2025-02-10', 'keyla', 12),
('PMJN003', 'MJC301', ' ROCKING CHAIR', '2025-02-14', 'bugi', 2),
('PMJN003', 'MJC301', ' ROCKING CHAIR', '2025-02-14', 'bugi', 2),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-14', 'bugi', 2),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-14', 'bugi', 2),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-14', 'bugi', 2),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-14', 'bugi1', 2),
('PMJN003', 'MJC301', ' ROCKING CHAIR', '2025-02-14', 'bugi1', 2),
('PMJN003', 'MJC301', ' ROCKING CHAIR', '2025-02-14', 'bugi1', 2),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-14', 'bugi1', 2),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-14', 'bugi1', 2),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-14', 'bugi1', 2),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-14', 'bugi1', 2),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-13', 'sarah', 3),
('', 'MJC302', 'RECLINER', '2025-02-23', 'kelvin', 1),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-22', 'kelvin', 12),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-22', 'kelvin', 12),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-22', 'kelvin', 12),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-22', 'sarah', 10),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-22', 'sarah', 10),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-22', 'sarah', 10),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-22', 'sarah', 10),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-22', 'sarah', 10),
('', 'MJC301', ' ROCKING CHAIR', '2025-02-22', 'sarah', 10),
('PMJN011', 'MJC301', ' ROCKING CHAIR', '2025-03-14', 'deka', 10),
('PMJN012', 'MJC301', ' ROCKING CHAIR', '2025-03-14', 'deka', 10),
('PMJN013', 'MJC301', ' ROCKING CHAIR', '2025-03-15', 'aku', 15),
('PMJN014', 'MJC304', 'STACKING CHAIR', '2025-03-15', 'intan', 50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_masukbarang`
--

CREATE TABLE `tbl_masukbarang` (
  `id_masukbarang` varchar(11) NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jumlah_masuk` int NOT NULL,
  `kode_supplier` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_masukbarang`
--

INSERT INTO `tbl_masukbarang` (`id_masukbarang`, `kode_barang`, `nama_barang`, `tgl_masuk`, `jumlah_masuk`, `kode_supplier`) VALUES
('BMSK002', 'MJC301', ' ROCKING CHAIR', '2025-02-10', 2, 'SP003'),
('BMSK003', 'MJC304', 'STACKING CHAIR', '2025-02-10', 10, 'SP001'),
('BMSK004', 'MJC301', ' ROCKING CHAIR', '2025-02-10', 10, 'SP003'),
('BMSK005', 'MJC302', 'RECLINER', '2025-02-10', 12, 'SP003'),
('BMSK006', 'MJC304', 'STACKING CHAIR', '2025-02-11', 1, 'SP002'),
('BMSK007', 'MJC302', 'RECLINER', '2025-03-15', 100, 'SP003'),
('BMSK008', 'MJC302', 'RECLINER', '2025-03-15', 100, 'SP003'),
('BMSK009', 'MJC302', 'RECLINER', '2025-03-15', 100, 'SP003'),
('BMSK010', 'MJC304', 'STACKING CHAIR', '2025-03-15', 49, 'SP001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `nomor_pinjam` varchar(8) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `jumlah_pinjam` int NOT NULL,
  `peminjam` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`nomor_pinjam`, `tgl_pinjam`, `kode_barang`, `nama_barang`, `jumlah_pinjam`, `peminjam`) VALUES
('PMJN002', '2025-02-10', 'MJC302', 'RECLINER', 12, 'keyla'),
('PMJN003', '2025-02-14', 'MJC301', ' ROCKING CHAIR', 2, 'bugi1'),
('PMJN004', '2025-02-13', 'MJC301', ' ROCKING CHAIR', 3, 'sarah'),
('PMJN005', '2025-02-23', 'MJC302', 'RECLINER', 1, 'kelvin'),
('PMJN006', '2025-02-22', 'MJC301', ' ROCKING CHAIR', 12, 'kelvin'),
('PMJN007', '2025-02-22', 'MJC301', ' ROCKING CHAIR', 10, 'sarah'),
('PMJN008', '2025-02-22', 'MJC301', ' ROCKING CHAIR', 10, 'sarah'),
('PMJN009', '2025-02-22', 'MJC301', ' ROCKING CHAIR', 10, 'sarah'),
('PMJN010', '2025-02-22', 'MJC301', ' ROCKING CHAIR', 10, 'sarah'),
('PMJN011', '2025-03-14', 'MJC301', ' ROCKING CHAIR', 10, 'deka'),
('PMJN012', '2025-03-14', 'MJC301', ' ROCKING CHAIR', 10, 'deka'),
('PMJN013', '2025-03-15', 'MJC301', ' ROCKING CHAIR', 15, 'aku'),
('PMJN014', '2025-03-15', 'MJC304', 'STACKING CHAIR', 50, 'intan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stok`
--

CREATE TABLE `tbl_stok` (
  `id_stok` int NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `jml_barangmasuk` int NOT NULL,
  `jml_barangkeluar` int NOT NULL,
  `total_barang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stok`
--

INSERT INTO `tbl_stok` (`id_stok`, `kode_barang`, `nama_barang`, `jml_barangmasuk`, `jml_barangkeluar`, `total_barang`) VALUES
(1, 'MJC302', 'RECLINER', 212, 3, 209),
(2, 'MJC301', 'ROCKING CHAIR', 355, 43, 312),
(3, 'MJC304', 'STACKING CHAIR', 50, 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `kode_supplier` varchar(5) NOT NULL,
  `nama_supplier` varchar(35) NOT NULL,
  `alamat_supplier` varchar(50) NOT NULL,
  `telp_supplier` varchar(25) NOT NULL,
  `kota_supplier` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`kode_supplier`, `nama_supplier`, `alamat_supplier`, `telp_supplier`, `kota_supplier`) VALUES
('SP001', 'Gramedia', 'Jl. raya pajajaran No 37', '02518356341', 'Bogor'),
('SP002', 'Electronics Best', 'Jl. Gajah Mada No 55', '02518356341', 'Jakarta'),
('SP003', 'Furniture Indonesia', 'Jl. raya tamrin', '02513534764', 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` varchar(8) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`) VALUES
('001', 'admin', '4QrcOUm6Wau+VuBX8g+IPg==');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mrp`
--
ALTER TABLE `mrp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `tbl_masukbarang`
--
ALTER TABLE `tbl_masukbarang`
  ADD PRIMARY KEY (`id_masukbarang`);

--
-- Indexes for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD PRIMARY KEY (`nomor_pinjam`);

--
-- Indexes for table `tbl_stok`
--
ALTER TABLE `tbl_stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mrp`
--
ALTER TABLE `mrp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_stok`
--
ALTER TABLE `tbl_stok`
  MODIFY `id_stok` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
