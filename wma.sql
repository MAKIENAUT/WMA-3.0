-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 07:59 AM
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
-- Database: `wma`
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

-- --------------------------------------------------------

--
-- Table structure for table `school_partners_form`
--

CREATE TABLE `school_partners_form` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `school_district` varchar(255) NOT NULL,
  `full_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `time_frame` varchar(255) NOT NULL,
  `teacher_category` varchar(255) NOT NULL,
  `teacher_estimate` int(11) DEFAULT NULL,
  `reference_source` varchar(255) DEFAULT NULL,
  `login_method` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wma_admin`
--

CREATE TABLE `wma_admin` (
  `id` int(11) NOT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `access_credential` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wma_admin`
--

INSERT INTO `wma_admin` (`id`, `email_address`, `username`, `password`, `access_credential`, `last_login`, `last_logout`) VALUES
(1, 'techteam@westmigrationagency.us', 'Makienaut', '$2y$10$sClB2y16fp6Y.iwcBY4OPu302BEoWVQq5SrimER7wmaVfCHkzpDHy', 'admin', '2023-11-28 12:12:13', '2023-11-24 16:12:43'),
(2, 'techteam2@westmigrationagency.us', 'Sly', '$2y$10$T4m7KH/YUxqSELcR/KnRdelJwZr96e/RSKUvHmChR7uCLaXr1aMny', 'admin', '2023-11-04 06:24:47', '2023-11-04 06:24:37'),
(3, 'techteam3@westmigrationagency.us', 'Arvin', '$2y$10$OLJwBGapMQppPTXI1Kt2Y.K2g.YsYMAmVZ52vExGczrMZtohqxb26', 'admin', '2023-11-02 18:43:44', '2023-11-02 18:43:53');

-- --------------------------------------------------------

--
-- Table structure for table `wma_content`
--

CREATE TABLE `wma_content` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date_published` date DEFAULT NULL,
  `content` text DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `post_status` varchar(20) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `share_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wma_content`
--

INSERT INTO `wma_content` (`id`, `title`, `date_published`, `content`, `excerpt`, `post_status`, `category`, `share_count`) VALUES
(1, 'Addressing US Teacher Shortage: A Call to Action', '2023-11-27', 'The teacher shortage in the United States has been a significant concern, with various factors contributing to the situation. The U.S. Department of Education is actively working to address this issue through a comprehensive policy agenda aimed at recruiting, preparing, retaining, and supporting a diverse and well-prepared educator workforce. This initiative, &quot;Raise the Bar: Lead the World,&quot; involves collaboration with states, tribes, local educational agencies, and educator preparation programs, including minority-serving institutions, to eliminate educator shortages and diversify the education profession​​.\r\n\r\nThe shortage has been exacerbated by the COVID-19 pandemic, with factors such as low wages, high costs of educator preparation, poor working conditions, and inequitable funding practices contributing to a decline in new educators entering the field and high rates of attrition. Particularly impacted areas include special education, STEM education, career and  technical education, and bilingual education programs​​. To combat this, the Department of Education has outlined five key policy levers: increasing compensation, improving working conditions, expanding access to quality and affordable educator preparation, promoting career advancement opportunities, providing high-quality new teacher induction and ongoing professional learning, and increasing educator diversity​​.\r\n\r\n\r\nThe teacher shortage is not only a policy issue but also a matter of growing concern among educators themselves. According to the National Center for Education Statistics, 42% of all school principals in the U.S. expressed heightened concern about educators leaving the profession in the previous academic year​​. Moreover, 45% of U.S. public schools had at least one\r\nteacher vacancy by the end of October 2022​​. Factors contributing to these shortages include low salaries, tough working conditions, higher retirement rates, and a declining interest in teaching as\r\na profession​​.\r\n\r\n\r\nStatistics from &quot;We Are Teachers&quot; highlight the severity of the problem: 44% of teachers\r\nreported burnout, 55% indicated they were ready to leave the profession earlier than planned, and\r\n35% stated they were likely to quit within the next two years​​. Furthermore, 78% of educators see\r\nlow pay as a serious issue, and 84% spend their own money on basic classroom supplies​​. The\r\nlack of respect from the public, as perceived by 45% of teachers, adds to the challenges​​. Addressing this crisis requires a multifaceted approach, including competitive compensation, improved working conditions, simplified and enhanced teacher preparation programs, reduced administrative burden, and effective mentorship and support​​. These measures aim not only to fill the current vacancies but also to create a more sustainable and appealing teaching profession for future generations.\r\n\r\n\r\nIn addressing the teacher shortage crisis in the United States, West Migration Agency\r\nplays a pivotal role. We work directly with schools that are in urgent need of qualified educators.\r\nFor those interested in pursuing teaching opportunities in these schools, we provide detailed\r\ninformation about eligibility and qualification requirements on our website. Understanding the\r\nchallenges faced by schools and educators, our goal is to facilitate the placement of capable and\r\nmotivated teachers in environments where they are most needed.\r\n\r\nIf you have any questions or concerns regarding the process, eligibility, or other related\r\nmatters, please do not hesitate to reach out to us. We are committed to providing support and\r\nguidance throughout your journey. For more personalized assistance or to start the application\r\nprocess, contact us at admin@westmigrationagency.us. Our team is dedicated to helping alleviate the teacher shortage by connecting skilled educators with schools where they can make a significant impact.', 'Combating the US teacher shortage crisis. Join us in reshaping education! 🍎📚', 'featured', 'post', 3);

-- --------------------------------------------------------

--
-- Table structure for table `wma_google_content`
--

CREATE TABLE `wma_google_content` (
  `user_token` varchar(255) NOT NULL,
  `content_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wma_google_content`
--

INSERT INTO `wma_google_content` (`user_token`, `content_id`) VALUES
('113197881321349328270', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wma_standard_content`
--

CREATE TABLE `wma_standard_content` (
  `user_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `user_type` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wma_users_google`
--

INSERT INTO `wma_users_google` (`id`, `email`, `first_name`, `last_name`, `full_name`, `picture`, `verifiedEmail`, `user_type`, `token`) VALUES
(1, 'mcrayescoto@gmail.com', 'Mc Ray', 'Escoto', 'Mc Ray Escoto', 'https://lh3.googleusercontent.com/a/ACg8ocIi5zA2gZ6cvb0wxInYCZtHuv3Y_pwvSJHtKEfmkiOg1w=s96-c', 1, '', '113197881321349328270');

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
  `user_type` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `j1_visa`
--
ALTER TABLE `j1_visa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_partners_form`
--
ALTER TABLE `school_partners_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wma_admin`
--
ALTER TABLE `wma_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `wma_content`
--
ALTER TABLE `wma_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wma_google_content`
--
ALTER TABLE `wma_google_content`
  ADD PRIMARY KEY (`user_token`,`content_id`),
  ADD KEY `content_id` (`content_id`);

--
-- Indexes for table `wma_standard_content`
--
ALTER TABLE `wma_standard_content`
  ADD PRIMARY KEY (`user_id`,`content_id`),
  ADD KEY `content_id` (`content_id`);

--
-- Indexes for table `wma_users_google`
--
ALTER TABLE `wma_users_google`
  ADD PRIMARY KEY (`token`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wma_users_standard`
--
ALTER TABLE `wma_users_standard`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `j1_visa`
--
ALTER TABLE `j1_visa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_partners_form`
--
ALTER TABLE `school_partners_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wma_admin`
--
ALTER TABLE `wma_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wma_content`
--
ALTER TABLE `wma_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wma_users_google`
--
ALTER TABLE `wma_users_google`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wma_users_standard`
--
ALTER TABLE `wma_users_standard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wma_google_content`
--
ALTER TABLE `wma_google_content`
  ADD CONSTRAINT `wma_google_content_ibfk_2` FOREIGN KEY (`user_token`) REFERENCES `wma_users_google` (`token`),
  ADD CONSTRAINT `wma_google_content_ibfk_3` FOREIGN KEY (`content_id`) REFERENCES `wma_content` (`id`);

--
-- Constraints for table `wma_standard_content`
--
ALTER TABLE `wma_standard_content`
  ADD CONSTRAINT `wma_standard_content_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `wma_users_standard` (`id`),
  ADD CONSTRAINT `wma_standard_content_ibfk_3` FOREIGN KEY (`content_id`) REFERENCES `wma_content` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
