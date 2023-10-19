-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 05:01 AM
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
-- Database: `wma_forms`
--

-- --------------------------------------------------------

--
-- Table structure for table `j1_visa`
--

CREATE TABLE `j1_visa` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `full_address` varchar(255) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `date_submitted` date DEFAULT curdate(),
  `file` varchar(255) DEFAULT NULL,
  `login_method` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `j1_visa`
--

INSERT INTO `j1_visa` (`id`, `first_name`, `last_name`, `full_address`, `country`, `phone_number`, `email_address`, `profession`, `date_submitted`, `file`, `login_method`) VALUES
(1, 'Mc Ray', 'Escoto', 'dyan lang', 'Afghanistan', '09614781582', 'mcde.escoto.up@phinmaed.com', 'Au Pair/Educare', '2023-10-15', 'mcde.escoto.up@phinmaed.com', 'google_login'),
(2, 'Mc Ray', 'Escoto', '#105 Sitio Guibang, Pantal, Dagupan City, Pangasinan', 'Djibouti', '09614781582', 'mcrayescoto@gmail.com', 'Student: College/University', '2023-10-15', 'mcrayescoto@gmail.com', 'standard_login');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `j1_visa`
--
ALTER TABLE `j1_visa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `j1_visa`
--
ALTER TABLE `j1_visa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
