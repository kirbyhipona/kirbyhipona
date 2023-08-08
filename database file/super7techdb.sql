-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2023 at 01:15 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `super7techdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `position` varchar(150) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `first_name`, `last_name`, `position`, `create_date`) VALUES
(13, 'Kirby', 'hipona', 'Manager', '2023-08-08 10:51:42'),
(14, 'Kirby', 'Hipona', 'Web Designer', '2023-08-08 11:01:33'),
(15, 'John', 'Hipona', 'Web Designer', '2023-08-08 11:02:02'),
(16, 'John', 'Hipon', 'Web Developer', '2023-08-08 11:05:52'),
(17, 'John', 'Kirby', 'Web Developer', '2023-08-08 11:06:03'),
(19, 'kirby', 'Best', 'Web Developer', '2023-08-08 11:08:05');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(150) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `role`, `create_date`) VALUES
(1, 'webdesigner', '$2y$10$EgMrZ4SsXXaqvhSGUtznrOjXLRoM3w5EB/2WhhcFxg6jQmvU3RRHi', 'Kirby Hipona - Web Designer', 'Web Designer', '2023-08-08 09:53:35'),
(2, 'manager', '$2y$10$c.XpFD9EPnOe5MENnFoujuZgFDEENwt8og9l6wL6SsfTMYx.y4YpO', 'Kirby Hipona - Manager', 'Manager', '2023-08-08 09:54:02'),
(3, 'webdeveloper', '$2y$10$nC1T2HslfeLuOjLK6rh7BeQD3.FBVavEXLbUFxSjC4oVp117by/zu', 'Kirby Hipona - Web Developer', 'Web Developer', '2023-08-08 09:54:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
