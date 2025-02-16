-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 12:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sit_in_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `STUD_NUM` int(11) NOT NULL,
  `IDNO` int(11) NOT NULL,
  `LAST_NAME` varchar(30) NOT NULL,
  `FIRST_NAME` varchar(30) NOT NULL,
  `MID_NAME` varchar(30) NOT NULL,
  `COURSE` enum('BS IN ACCOUNTANCY','BS IN BUSINESS ADMINISTRATION','BS IN CRIMINOLOGY','BS IN CUSTOMS ADMINISTRATION','BS IN INFORMATION TECHNOLOGY','BS IN COMPUTER SCIENCE','BS IN OFFICE ADMINISTRATION','BS IN SOCIAL WORK','BACHELOR OF SECONDARY EDUCATION','BACHELOR OF ELEMENTARY EDUCATION') NOT NULL,
  `YEAR_LEVEL` enum('1st Year','2nd Year','3rd Year','4th Year') NOT NULL,
  `USER_NAME` varchar(30) NOT NULL,
  `PASSWORD_HASH` varchar(255) NOT NULL,
  `UPLOAD_IMAGE` longblob NOT NULL,
  `EMAIL` varchar(30) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`STUD_NUM`, `IDNO`, `LAST_NAME`, `FIRST_NAME`, `MID_NAME`, `COURSE`, `YEAR_LEVEL`, `USER_NAME`, `PASSWORD_HASH`, `UPLOAD_IMAGE`, `EMAIL`, `ADDRESS`) VALUES
(4, 22680649, 'Sagaral', 'Alexus Sundae', 'Jamilo', 'BS IN INFORMATION TECHNOLOGY', '3rd Year', 'alexus123', '$2y$10$OoExJH85KhwImPjLCsuE9eeXcApegLuLgpGAPDhPZssfvSLbO/olK', '', NULL, '', ''),
(5, 12234141, 'Dinopol', 'Natasha', 'G', 'BS IN INFORMATION TECHNOLOGY', '3rd Year', 'natasha123', '$2y$10$vSxDAJ.FXrvYlkx5arfRIuHgDq7WMtpno9quOZ.Ht6GAGQF3NJYwi', '', NULL, '', ''),
(6, 32323232, 'Monreal', 'Jeff', 'B', 'BS IN INFORMATION TECHNOLOGY', '3rd Year', 'jeff123', '$2y$10$SqoZ16x9a8cZ5M0.eKO2b.nxi6ircMiu20BB1XCg4BIoU0GfLvWR6', '', NULL '', ''),
(7, 12131414, 'Cabunilas', 'Vince Bryant ', 'N', 'BS IN INFORMATION TECHNOLOGY', '3rd Year', 'vince123', '$2y$10$/SvHlZp/8cZ9vJ/ustIFfewqm742cJpVsD4ZV/vqx96d49tG3ZzzK', '', NULL, '', ''),
(8, 14343423, 'Sagaral', 'Niel', 'Jamilo', 'BS IN INFORMATION TECHNOLOGY', '2nd Year', 'niel123', '$2y$10$NtYWmiUtnayQZCztAPp4a.mHm3ycBMvEWwdl7ZpnxdGYcR9csmMIu', '', NULL, '', ''),
(9, 12113131, 'Catubig', 'Mark Dave ', 'C', 'BS IN BUSINESS ADMINISTRATION', '3rd Year', 'mark123', '$2y$10$Q8ehaTbzdqEQ4O4UyEQHKuOkUyxUMMQloymIXRGF3wQ62PdieW9zS', '', NULL, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`STUD_NUM`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `STUD_NUM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
