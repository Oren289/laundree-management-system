-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2022 at 01:08 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_laundry`
--

CREATE TABLE `data_laundry` (
  `id_transaksi` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `jumlah_cucian` int(10) NOT NULL,
  `ket_cucian` text NOT NULL,
  `berat_total` int(11) NOT NULL,
  `harga_total` decimal(11,0) NOT NULL,
  `proses_cucian` varchar(50) NOT NULL,
  `status_pengembalian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_laundry`
--

INSERT INTO `data_laundry` (`id_transaksi`, `username`, `tanggal_transaksi`, `jumlah_cucian`, `ket_cucian`, `berat_total`, `harga_total`, `proses_cucian`, `status_pengembalian`) VALUES
(1, 'Suci', '2022-03-30', 10, '5 kaos, 5 rok panjang', 4, '20000', 'done', 'returned'),
(3, 'Suci', '2022-03-31', 5, '3 kaos, 2 jeans', 3, '15000', 'done', 'returned'),
(6, 'Suci', '2022-04-01', 4, '4 jeans', 4, '20000', 'done', 'returned'),
(7, 'Ilhan', '2022-04-02', 5, '5 kaos', 3, '15000', 'done', 'returned'),
(8, 'Ilhan', '2022-04-04', 5, '3 kaos, 2 celana', 3, '15000', 'done', 'returned'),
(10, 'Suci', '2022-04-01', 4, '4 jeans', 4, '20000', 'on process', 'not returned'),
(12, 'Ilhan', '2022-04-19', 7, '4 kaos, 3 kemeja', 5, '25000', 'on process', 'not returned'),
(14, 'Suci', '2022-04-19', 6, '3 kaos, 3 jeans', 5, '25000', 'on process', 'not returned'),
(15, 'Kimi', '2022-06-12', 8, '8 kaos kucing', 4, '20000', 'on process', 'not returned');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `no_telp` char(20) NOT NULL,
  `alamat` text NOT NULL,
  `status` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`username`, `email`, `password`, `no_telp`, `alamat`, `status`) VALUES
('Admin', 'thegrimblog@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '085214567823', 'Jl. Kebangsaan', 'admin'),
('Admin2', 'thegrim@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '087645673456', 'Jl. Mawar', 'admin'),
('Ilhan', 'ilhanmahardikap@gmail.com', '5edb99940ce112ef8b561e8e11e837d3', '087645673456', 'Jl. Pattimura Raya 2', 'user'),
('Kimi', 'kimilucu@gmail.com', 'aacfa66c7af573977f10b74a0d950c99', '080628292829', 'Jl. Kucing Merdeka', 'user'),
('Romi', 'romi@gmail.com', '910b6c78a8482033b971116f02441ce4', '085228292829', 'Jl. Wisma Pink', 'user'),
('Suci', 'sucifdwiforessa@gmail.com', '1cc6545f956f39a79c80b05f65df3c0a', '082928292829', 'Jl. Kota Lama Indah', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `request_jemput`
--

CREATE TABLE `request_jemput` (
  `id_request` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `tanggal_request` date NOT NULL,
  `alamat_request` text NOT NULL,
  `tanggal_jemput` date NOT NULL,
  `status_request` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_jemput`
--

INSERT INTO `request_jemput` (`id_request`, `username`, `tanggal_request`, `alamat_request`, `tanggal_jemput`, `status_request`) VALUES
(5, 'Suci', '2022-06-03', 'Jl. Kota Lama Indah', '2022-06-07', 'selesai'),
(6, 'Romi', '2022-06-07', 'Jl. Wisma Pink', '2022-06-07', 'selesai'),
(7, 'Ilhan', '2022-06-07', 'Jl. Pattimura Raya', '0000-00-00', 'belum selesai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_laundry`
--
ALTER TABLE `data_laundry`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `request_jemput`
--
ALTER TABLE `request_jemput`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_laundry`
--
ALTER TABLE `data_laundry`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `request_jemput`
--
ALTER TABLE `request_jemput`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request_jemput`
--
ALTER TABLE `request_jemput`
  ADD CONSTRAINT `request_jemput_ibfk_1` FOREIGN KEY (`username`) REFERENCES `data_user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
