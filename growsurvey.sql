-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 05:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `growsurvey`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$YZeI.mwQwMEQt1DcEhodOOoh9resEHqQ0GPmifX0wbbWGyKn64iBG');

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `id_bayar` int(10) UNSIGNED NOT NULL,
  `id_owner` int(10) UNSIGNED NOT NULL,
  `id_survey` int(10) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `jenis_bayar` enum('pembelian','pengajuan') NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` enum('belum diverifikasi','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `id_harga` int(10) UNSIGNED NOT NULL,
  `jumlah_responden` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`id_harga`, `jumlah_responden`, `harga`) VALUES
(1, 50, 150000),
(2, 100, 225000),
(3, 200, 300000),
(4, 500, 400000);

-- --------------------------------------------------------

--
-- Table structure for table `kuisioner`
--

CREATE TABLE `kuisioner` (
  `id_kuisioner` int(10) UNSIGNED NOT NULL,
  `id_survey` int(10) UNSIGNED NOT NULL,
  `pertanyaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `id_owner` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `respon`
--

CREATE TABLE `respon` (
  `id_respon` int(10) UNSIGNED NOT NULL,
  `id_survey` int(10) UNSIGNED NOT NULL,
  `id_kuisioner` int(10) UNSIGNED NOT NULL,
  `jawaban` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id_survey` int(10) UNSIGNED NOT NULL,
  `id_owner` int(11) NOT NULL,
  `nama_survey` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah_responden` int(11) NOT NULL,
  `jenis` enum('public','private') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bayar`
--
ALTER TABLE `bayar`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `fk_bayar_owner` (`id_owner`),
  ADD KEY `fk_bayar_survey` (`id_survey`);

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indexes for table `kuisioner`
--
ALTER TABLE `kuisioner`
  ADD PRIMARY KEY (`id_kuisioner`),
  ADD KEY `fk_kuisioner_survey` (`id_survey`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id_owner`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `respon`
--
ALTER TABLE `respon`
  ADD PRIMARY KEY (`id_respon`),
  ADD KEY `fk_respon_kuisioner` (`id_kuisioner`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id_survey`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bayar`
--
ALTER TABLE `bayar`
  MODIFY `id_bayar` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `harga`
--
ALTER TABLE `harga`
  MODIFY `id_harga` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kuisioner`
--
ALTER TABLE `kuisioner`
  MODIFY `id_kuisioner` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `id_owner` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `respon`
--
ALTER TABLE `respon`
  MODIFY `id_respon` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1617;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id_survey` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bayar`
--
ALTER TABLE `bayar`
  ADD CONSTRAINT `fk_bayar_owner` FOREIGN KEY (`id_owner`) REFERENCES `owner` (`id_owner`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bayar_survey` FOREIGN KEY (`id_survey`) REFERENCES `survey` (`id_survey`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kuisioner`
--
ALTER TABLE `kuisioner`
  ADD CONSTRAINT `fk_kuisioner_survey` FOREIGN KEY (`id_survey`) REFERENCES `survey` (`id_survey`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `respon`
--
ALTER TABLE `respon`
  ADD CONSTRAINT `fk_respon_kuisioner` FOREIGN KEY (`id_kuisioner`) REFERENCES `kuisioner` (`id_kuisioner`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
