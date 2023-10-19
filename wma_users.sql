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
-- Database: `wma_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `wma_users_google`
--

CREATE TABLE `wma_users_google` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `first_name` varchar(50) NOT NULL DEFAULT '',
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `full_name` varchar(100) NOT NULL DEFAULT '',
  `picture` varchar(255) NOT NULL DEFAULT '',
  `verifiedEmail` int(11) NOT NULL DEFAULT 0,
  `token` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wma_users_google`
--

INSERT INTO `wma_users_google` (`id`, `email`, `first_name`, `last_name`, `full_name`, `picture`, `verifiedEmail`, `token`) VALUES
(1, 'mcrayescoto@gmail.com', 'Mc Ray', 'Escoto', 'Mc Ray Escoto', 'https://lh3.googleusercontent.com/a/ACg8ocIi5zA2gZ6cvb0wxInYCZtHuv3Y_pwvSJHtKEfmkiOg1w=s96-c', 1, '113197881321349328270'),
(2, 'mcde.escoto.up@phinmaed.com', 'Mc Ray  De Vera', 'Escoto', 'Mc Ray De Vera Escoto', 'https://lh3.googleusercontent.com/a/ACg8ocLi2H5ro2I8RWDq1iqC6T6mmixC_JFziJT12SDGfLMo6w=s96-c', 1, '105800892577414103365'),
(3, 'admin@westmigrationagency.us', 'Admin', 'Team', 'Admin Team', 'https://lh3.googleusercontent.com/a/ACg8ocJ2kDztD8_I7oPYchr6-Vg5vb6UdHRmyipUpzQHwGXE=s96-c', 1, '101992111026685910806'),
(4, 'jesiree00@gmail.com', 'Jesiree', 'Dioquino', 'Jesiree Dioquino', 'https://lh3.googleusercontent.com/a/ACg8ocKB-DRPidmqdYEz3k27FupfMh0bVstEnM0S406H2Uic=s96-c', 1, '114686097271937198380'),
(5, 'techteam@westmigrationagency.us', 'Mc Ray ', 'Escoto', 'Mc Ray Escoto', 'https://lh3.googleusercontent.com/a/ACg8ocKuQ_ykuLJOPJi-v9ZfojB4xd60mkNVqJffRShyDBU=s96-c', 1, '101619607252072060443');

-- --------------------------------------------------------

--
-- Table structure for table `wma_users_standard`
--

CREATE TABLE `wma_users_standard` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wma_users_standard`
--

INSERT INTO `wma_users_standard` (`id`, `first_name`, `last_name`, `phone_number`, `birth_date`, `email`, `password`, `profile_picture`) VALUES
(1, 'Mc Ray', 'Escoto', '09614781582', '2002-03-17', 'mcrayescoto@gmail.com', '$2y$10$6G2H98O6DSuac6MsVvIAFOl1i/ebs4.gNye.lYbWDtN0s1OakcBDC', '../Standard_Profile/Profile_Pictures/mcrayescoto@gmail.com/profile_picture.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wma_users_google`
--
ALTER TABLE `wma_users_google`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wma_users_standard`
--
ALTER TABLE `wma_users_standard`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wma_users_google`
--
ALTER TABLE `wma_users_google`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wma_users_standard`
--
ALTER TABLE `wma_users_standard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
