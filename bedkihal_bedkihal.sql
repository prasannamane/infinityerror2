-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 12, 2020 at 08:44 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bedkihal_bedkihal`
--

-- --------------------------------------------------------

--
-- Table structure for table `quetions`
--

CREATE TABLE `quetions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `description` text,
  `vote` int(11) DEFAULT NULL,
  `view` int(11) DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quetions`
--

INSERT INTO `quetions` (`id`, `title`, `user_id`, `video`, `description`, `vote`, `view`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'common methods for loggin in Spring Boot', 1, NULL, NULL, 0, 0, 0, '2020-08-01 12:48:12', '2020-08-01 12:48:12'),
(2, 'common methods for loggin in Spring Boot', 1, NULL, NULL, 0, 0, 0, '2020-08-01 12:48:12', '2020-08-01 12:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `checkme` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `name`, `email`, `pwd`, `checkme`, `created_at`, `updated_at`) VALUES
(1, '0', '0', '0', '0', '2020-07-29 00:58:45', '2020-07-29 00:58:45'),
(2, '0', '0', '0', '0', '2020-07-30 09:57:19', '2020-07-30 09:57:19'),
(3, 'Prasanna Mane', 'prasannamane7@gmail.com', 'Prasanna@12', 'on', '2020-07-31 01:55:00', '2020-07-31 01:55:00'),
(4, 'Manjunat Vaidya', 'iasmanju@gmail.com', 'manju@123#', 'on', '2020-07-31 03:39:32', '2020-07-31 03:39:32'),
(5, 'priya test ', 'ahirepriya18995@gmail.com', 'loveupapa123', 'on', '2020-07-31 11:48:50', '2020-07-31 11:48:50'),
(6, 'Maybe ', 'izuomeni@yahoo.com', 'hgdargh2n6', 'on', '2020-08-02 07:13:27', '2020-08-02 07:13:27'),
(7, 'How ', 'megavakstudio@gmail.com', 'favour1987', 'on', '2020-08-02 07:14:50', '2020-08-02 07:14:50'),
(8, 'How', 'megavakstudio@gmail.com', 'favour1o87', 'on', '2020-08-02 07:15:25', '2020-08-02 07:15:25'),
(9, 'manju', 'iasmanju@gmail.com', 'manju@123#', 'on', '2020-08-03 13:28:56', '2020-08-03 13:28:56'),
(10, 'nilesh', 'nilesh@gmail.com', '123456', 'on', '2020-08-04 12:21:24', '2020-08-04 12:21:24');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'PHP', '2020-08-05 05:27:19', '2020-08-05 05:27:19'),
(2, 'HTML', '2020-08-05 05:27:41', '2020-08-05 05:27:41'),
(3, 'CSS', '2020-08-05 05:27:53', '2020-08-05 05:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `skill_id` int(11) DEFAULT NULL,
  `quetions_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `skill_id`, `quetions_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-08-05 05:28:15', '2020-08-05 05:28:15'),
(2, 2, 1, '2020-08-05 05:29:04', '2020-08-05 05:29:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quetions`
--
ALTER TABLE `quetions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skill_id` (`skill_id`,`quetions_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quetions`
--
ALTER TABLE `quetions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
