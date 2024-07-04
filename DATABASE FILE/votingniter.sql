-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2021 at 06:13 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votingniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `last_login`) VALUES
(1, 'Liam Moore', 'liam', 'd00f5d5217896fb7fd601412cb890830', '2021-06-13 23:13:17'),
(3, 'Kathryn Smith', 'kathryn', 'b1c7755394ed39edf2c9a6867ec619b9', '2021-06-13 22:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `ikut_kandidat`
--

CREATE TABLE `ikut_kandidat` (
  `id_ikut_kandidat` int(11) NOT NULL,
  `id_voting` int(11) DEFAULT NULL,
  `id_kandidat` int(11) DEFAULT NULL,
  `poin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ikut_kandidat`
--

INSERT INTO `ikut_kandidat` (`id_ikut_kandidat`, `id_voting`, `id_kandidat`, `poin`) VALUES
(3, 2, 1, 2),
(4, 2, 2, 0),
(5, 2, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `ikut_voting`
--

CREATE TABLE `ikut_voting` (
  `id_ikut` int(11) NOT NULL,
  `id_voting` int(11) DEFAULT NULL,
  `id_pemilih` int(11) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ikut_voting`
--

INSERT INTO `ikut_voting` (`id_ikut`, `id_voting`, `id_pemilih`, `waktu`) VALUES
(3, 2, 12, '2021-06-13 23:07:39'),
(4, 2, 3, '2021-06-13 23:08:17'),
(5, 2, 6, '2021-06-13 23:08:49'),
(6, 2, 8, '2021-06-13 23:09:15'),
(7, 2, 10, '2021-06-13 23:09:40'),
(8, 2, 11, '2021-06-13 23:10:09'),
(9, 2, 1, '2021-06-13 23:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE `kandidat` (
  `id_kandidat` int(11) NOT NULL,
  `nama_kandidat` varchar(50) NOT NULL DEFAULT '0',
  `keterangan` text,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`id_kandidat`, `nama_kandidat`, `keterangan`, `foto`) VALUES
(1, 'Will Williams', 'For the many, not the few', 'user-icn.png'),
(2, 'Jeremy Marte', 'Black Lives Matter', 'user.png'),
(3, 'Timothy Foster', 'Don\'t just hope for a better life, vote for it!', 'userav.png');

-- --------------------------------------------------------

--
-- Table structure for table `pemilih`
--

CREATE TABLE `pemilih` (
  `id_pemilih` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT '0',
  `username` varchar(15) DEFAULT '0',
  `password` varchar(32) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilih`
--

INSERT INTO `pemilih` (`id_pemilih`, `nama`, `username`, `password`) VALUES
(1, 'Richard Johnson', 'richard', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'Rodney Schulz', 'rodney', '5f4dcc3b5aa765d61d8327deb882cf99'),
(3, 'Frank Parker', 'parker', '5f4dcc3b5aa765d61d8327deb882cf99'),
(4, 'John Matthews', 'john', '527bd5b5d689e2c32ae974c6229ff785'),
(5, 'Bobby Ashley', 'bobby', 'a9c4cef5735770e657b7c25b9dcb807b'),
(6, 'Brenda Foster', 'foster', '5f4dcc3b5aa765d61d8327deb882cf99'),
(7, 'Jack Miller', 'jack', '4ff9fc6e4e5d5f590c4f2134a8cc96d1'),
(8, 'Thomas Miller', 'thomas', '5f4dcc3b5aa765d61d8327deb882cf99'),
(9, 'Kathy Osborne', 'kathy', '1140d2f6b47407a42490b9a20b20eb4f'),
(10, 'Ryan Smith', 'ryan', '5f4dcc3b5aa765d61d8327deb882cf99'),
(11, 'William Flin', 'william', '5f4dcc3b5aa765d61d8327deb882cf99'),
(12, 'Joe Nelson', 'joe', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id_voting` int(11) NOT NULL,
  `nama_voting` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`id_voting`, `nama_voting`) VALUES
(2, 'Voting For Demo Purpose');

--
-- Triggers `voting`
--
DELIMITER $$
CREATE TRIGGER `delete_voting` BEFORE DELETE ON `voting` FOR EACH ROW BEGIN
	DELETE FROM ikut_kandidat WHERE ikut_kandidat.id_voting=OLD.id_voting;
	DELETE FROM ikut_voting WHERE ikut_voting.id_voting=OLD.id_voting;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `ikut_kandidat`
--
ALTER TABLE `ikut_kandidat`
  ADD PRIMARY KEY (`id_ikut_kandidat`);

--
-- Indexes for table `ikut_voting`
--
ALTER TABLE `ikut_voting`
  ADD PRIMARY KEY (`id_ikut`);

--
-- Indexes for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id_kandidat`);

--
-- Indexes for table `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`id_pemilih`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id_voting`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ikut_kandidat`
--
ALTER TABLE `ikut_kandidat`
  MODIFY `id_ikut_kandidat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ikut_voting`
--
ALTER TABLE `ikut_voting`
  MODIFY `id_ikut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `kandidat`
--
ALTER TABLE `kandidat`
  MODIFY `id_kandidat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pemilih`
--
ALTER TABLE `pemilih`
  MODIFY `id_pemilih` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id_voting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
