-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 05:00 AM
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
-- Database: `wma_administrator`
--

-- --------------------------------------------------------

--
-- Table structure for table `wma_admin`
--

CREATE TABLE `wma_admin` (
  `id` int(11) NOT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `access_credential` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wma_admin`
--

INSERT INTO `wma_admin` (`id`, `email_address`, `username`, `password`, `access_credential`) VALUES
(1, 'techteam@westmigrationagency.us', 'Makienaut', '$2y$10$sClB2y16fp6Y.iwcBY4OPu302BEoWVQq5SrimER7wmaVfCHkzpDHy', 'super_admin'),
(2, 'techteam2@westmigrationagency.us', 'Sly', '$2y$10$ZGh.6KUou/JQkcXB4Dy8J.Zfpp/KgPXz4VxzCTIaGQ05kyEfs.7x2', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wma_admin`
--
ALTER TABLE `wma_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wma_admin`
--
ALTER TABLE `wma_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
