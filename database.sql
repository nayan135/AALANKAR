-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 04:19 PM
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
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `audio_table`
--

CREATE TABLE `audio_table` (
  `id` int(11) NOT NULL,
  `audio_path` varchar(255) DEFAULT NULL,
  `audio_type` varchar(50) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audio_table`
--

INSERT INTO `audio_table` (`id`, `audio_path`, `audio_type`, `image_path`, `image_type`, `upload_time`) VALUES
(1, 'audio_uploads/Sapana Ko Mayalu--The Elements.mp3', 'audio/mpeg', 'image_uploads/WhatsApp Image 2023-11-15 at 12.28.58_f0f87e3a.jpg', 'image/jpeg', '2023-11-12 05:42:20'),
(2, 'audio_uploads\\Ranga--Rockheads.mp3', 'audio/mp3', 'image_uploads\\1.jpg', 'image/jpeg', '2023-11-16 19:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `location` varchar(255) DEFAULT NULL,
  `dname` varchar(255) DEFAULT NULL,
  `timestamp_column` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`location`, `dname`, `timestamp_column`) VALUES
('27.684883107114825,83.43233757389484', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36', '2024-01-05 11:53:22'),
('27.684883107114825,83.43233757389484', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36', '2024-01-05 11:53:22'),
('27.685044290804253,83.43241745121229', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36', '2024-01-05 11:53:45'),
('27.685068701122066,83.43247075076505', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', '2024-01-05 11:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `image_table`
--

CREATE TABLE `image_table` (
  `id` int(11) NOT NULL,
  `song_name` varchar(100) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_table`
--

INSERT INTO `image_table` (`id`, `song_name`, `image_path`, `image_type`) VALUES
(1, 'Sapana Ko Mayalu', 'image_uploads/WhatsApp Image 2023-11-15 at 12.28.58_f0f87e3a.jpg', 'image/jpeg'),
(2, 'Ranga', 'image_uploads\\1.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `song_name` varchar(255) NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `song_path` varchar(255) NOT NULL,
  `uploaded_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `audio_type` varchar(50) NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `image_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `song_name`, `artist_name`, `song_path`, `uploaded_time`, `audio_type`, `image_path`, `image_type`) VALUES
(1, 'Ranga', 'Rockheads', 'uploads/Ranga.mp3', '2023-11-24 15:22:06', 'mp3', 'image_uploads/sap.jpg', 'image/jpeg'),
(2, 'Sapana Ko Mayalu', 'The Elements', 'uploads/Sapana Ko Mayalu.mp3', '2023-11-24 15:53:17', 'mp3', 'image_uploads/WhatsApp Image 2023-11-15 at 12.28.58_f0f87e3a.jpg', 'image/jpeg'),
(4, 'A Thousand Years', 'Christina Perri', 'uploads/A Thousand Years.mp3', '2023-11-25 04:10:43', 'mp3', NULL, NULL),
(5, 'Maya Sasto', 'Neetesh Jung Kunwar', 'uploads/Maya Sasto.mp3', '2023-11-25 04:20:58', 'mp3', NULL, NULL),
(8, 'Saath', 'Tuna Bell Thapa', 'uploads/Saath.mp3', '2023-12-18 17:27:14', 'mp3', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audio_table`
--
ALTER TABLE `audio_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_table`
--
ALTER TABLE `image_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audio_table`
--
ALTER TABLE `audio_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `image_table`
--
ALTER TABLE `image_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
