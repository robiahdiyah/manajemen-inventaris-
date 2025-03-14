-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 09:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `id` int(11) NOT NULL,
  `kode_barang_id` int(11) DEFAULT NULL,
  `jml_barangkeluar` int(11) DEFAULT NULL,
  `jml_barangmasuk` int(11) DEFAULT NULL,
  `safety_stock` int(11) DEFAULT NULL,
  `net_requirements` int(11) DEFAULT NULL,
  `tanggal_input_mrp` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mrp`
--

INSERT INTO `mrp` (`id`, `kode_barang_id`, `jml_barangkeluar`, `jml_barangmasuk`, `safety_stock`, `net_requirements`, `tanggal_input_mrp`) VALUES
(1, 1, 12, 0, 10, 0, '2025-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `jumlah_pinjam` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
('', 'MJC301', ' ROCKING CHAIR', '2025-02-22', 'sarah', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_masukbarang`
--

CREATE TABLE `tbl_masukbarang` (
  `id_masukbarang` varchar(11) NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jumlah_masuk` int(8) NOT NULL,
  `kode_supplier` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_masukbarang`
--

INSERT INTO `tbl_masukbarang` (`id_masukbarang`, `kode_barang`, `nama_barang`, `tgl_masuk`, `jumlah_masuk`, `kode_supplier`) VALUES
('BMSK002', 'MJC301', ' ROCKING CHAIR', '2025-02-10', 2, 'SP003'),
('BMSK003', 'MJC304', 'STACKING CHAIR', '2025-02-10', 10, 'SP001'),
('BMSK004', 'MJC301', ' ROCKING CHAIR', '2025-02-10', 10, 'SP003'),
('BMSK005', 'MJC302', 'RECLINER', '2025-02-10', 12, 'SP003'),
('BMSK006', 'MJC304', 'STACKING CHAIR', '2025-02-11', 1, 'SP002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `nomor_pinjam` varchar(8) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `jumlah_pinjam` int(7) NOT NULL,
  `peminjam` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
('PMJN010', '2025-02-22', 'MJC301', ' ROCKING CHAIR', 10, 'sarah');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stok`
--

CREATE TABLE `tbl_stok` (
  `id_stok` int(11) NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `jml_barangmasuk` int(7) NOT NULL,
  `jml_barangkeluar` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_stok`
--

INSERT INTO `tbl_stok` (`id_stok`, `kode_barang`, `nama_barang`, `jml_barangmasuk`, `jml_barangkeluar`) VALUES
(1, 'MJC302', 'RECLINER', 12, 3),
(2, 'MJC301', 'ROCKING CHAIR', 355, 18),
(3, 'MJC304', 'STACKING CHAIR', 1, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  ADD KEY `kode_barang_id` (`kode_barang_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_stok`
--
ALTER TABLE `tbl_stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mrp`
--
ALTER TABLE `mrp`
  ADD CONSTRAINT `mrp_ibfk_1` FOREIGN KEY (`kode_barang_id`) REFERENCES `tbl_stok` (`id_stok`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
