-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 09:57 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk2024_fadilanugrah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_album`
--

CREATE TABLE `tb_album` (
  `AlbumID` int(11) NOT NULL,
  `NamaAlbum` varchar(25) NOT NULL,
  `Deskripsi` text NOT NULL,
  `TanggalDibuat` date NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_album`
--

INSERT INTO `tb_album` (`AlbumID`, `NamaAlbum`, `Deskripsi`, `TanggalDibuat`, `UserID`) VALUES
(14, 'Perjalanan', '', '0000-00-00', 0),
(15, 'Bawah Air', '', '0000-00-00', 0),
(16, 'Hewan Peliharaan', '', '0000-00-00', 0),
(17, 'Satwa Liar', '', '0000-00-00', 0),
(18, 'Makanan', '', '0000-00-00', 0),
(19, 'Olahraga', '', '0000-00-00', 0),
(20, 'Fashion', '', '0000-00-00', 0),
(21, 'Seni Rupa', '', '0000-00-00', 0),
(22, 'Dokumenter', '', '0000-00-00', 0),
(23, 'Arsitektur', '', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_foto`
--

CREATE TABLE `tb_foto` (
  `image_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `image_description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `image_status` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_foto`
--

INSERT INTO `tb_foto` (`image_id`, `category_id`, `category_name`, `admin_id`, `admin_name`, `image_name`, `image_description`, `image`, `image_status`, `date_created`) VALUES
(59, 22, 'Dokumenter', 5, 'Fadil', 'gedung', 'gedung aja gedung', 'foto1713897778.jpg', 1, '2024-04-23 18:42:58'),
(60, 23, 'Arsitektur', 5, 'Fadil', 'Gedung modern', 'bangunan modern', 'foto1713897859.jpg', 1, '2024-04-23 18:44:19'),
(61, 21, 'Seni Rupa', 5, 'Fadil', 'Face BUrn', 'gambaran lukkis wajah', 'foto1713897903.jpg', 1, '2024-04-23 18:45:03'),
(62, 23, 'Arsitektur', 2, 'fadil alexander 1', 'Makkah Arsitektur', 'Makkah', 'foto1713920432.jpg', 1, '2024-04-24 01:00:32'),
(63, 21, 'Seni Rupa', 2, 'fadil alexander 1', 'Lukisan', 'Lukisan wajah', 'foto1713920466.jpg', 1, '2024-04-24 01:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_komentarfoto`
--

CREATE TABLE `tb_komentarfoto` (
  `komentarID` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_komentarfoto`
--

INSERT INTO `tb_komentarfoto` (`komentarID`, `image_id`, `admin_id`, `admin_name`, `isi_komentar`, `tanggal_komentar`) VALUES
(19, 61, 5, 'Fadil', 'bagus', '2024-04-23 19:02:50'),
(20, 63, 5, 'Fadil', 'kerenn\r\n', '2024-04-24 01:19:01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_likefoto`
--

CREATE TABLE `tb_likefoto` (
  `like_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `tanggal_like` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_likefoto`
--

INSERT INTO `tb_likefoto` (`like_id`, `image_id`, `admin_id`, `admin_name`, `tanggal_like`) VALUES
(154, 63, 2, 'fadil alexander 1', '2024-04-24 01:51:52'),
(156, 59, 5, 'Fadil', '2024-04-24 01:54:08'),
(160, 61, 2, 'fadil alexander 1', '2024-04-24 01:54:41'),
(161, 61, 5, 'Fadil', '2024-04-24 02:01:27'),
(166, 60, 5, 'Fadil', '2024-04-24 02:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_telp` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`admin_id`, `admin_name`, `username`, `password`, `admin_telp`, `admin_email`, `admin_address`) VALUES
(2, 'fadil alexander 1', '12', '12', '98067765', 'fdsaass@gmail.com', 'cilongok'),
(5, 'Fadil', 'fadil', 'fadil123', '088923123', 'fadil@gmail.com', 'Jln Karang Uyy'),
(6, 'Alex', 'alex', 'alex123', '0813214882930', 'alexkelex@gmail.com', 'Jln.karang Aunt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_album`
--
ALTER TABLE `tb_album`
  ADD PRIMARY KEY (`AlbumID`),
  ADD KEY `category_id` (`AlbumID`);

--
-- Indexes for table `tb_foto`
--
ALTER TABLE `tb_foto`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `tb_komentarfoto`
--
ALTER TABLE `tb_komentarfoto`
  ADD PRIMARY KEY (`komentarID`),
  ADD KEY `image_id` (`image_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `admin_name` (`admin_name`);

--
-- Indexes for table `tb_likefoto`
--
ALTER TABLE `tb_likefoto`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `image_id` (`image_id`),
  ADD KEY `admin_name` (`admin_name`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_album`
--
ALTER TABLE `tb_album`
  MODIFY `AlbumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_foto`
--
ALTER TABLE `tb_foto`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tb_komentarfoto`
--
ALTER TABLE `tb_komentarfoto`
  MODIFY `komentarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_likefoto`
--
ALTER TABLE `tb_likefoto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_foto`
--
ALTER TABLE `tb_foto`
  ADD CONSTRAINT `tb_foto_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tb_album` (`AlbumID`),
  ADD CONSTRAINT `tb_foto_ibfk_3` FOREIGN KEY (`admin_id`) REFERENCES `tb_user` (`admin_id`);

--
-- Constraints for table `tb_komentarfoto`
--
ALTER TABLE `tb_komentarfoto`
  ADD CONSTRAINT `tb_komentarfoto_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `tb_foto` (`image_id`),
  ADD CONSTRAINT `tb_komentarfoto_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `tb_user` (`admin_id`);

--
-- Constraints for table `tb_likefoto`
--
ALTER TABLE `tb_likefoto`
  ADD CONSTRAINT `tb_likefoto_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `tb_foto` (`image_id`),
  ADD CONSTRAINT `tb_likefoto_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `tb_user` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
