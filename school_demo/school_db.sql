-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 02:04 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `created_at`) VALUES
(1, 'class1', '2024-06-22 07:24:54'),
(2, 'class 2', '2024-06-22 07:33:08'),
(3, 'class 3', '2024-06-22 12:12:17'),
(15, 'class 4', '2024-06-23 13:56:43');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `class_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `email`, `address`, `class_id`, `created_at`, `image`) VALUES
(9, 'Khalid Rehmat22', 'abcd@gmail.com', 'jammu dcd saac', 1, '2024-06-23 06:09:48', 'IMG-20200902-WA0006.jpg'),
(13, 'Zuhaib Parvaiz Wani', 'zuhaib0001@gmail.com', 'HMT Srinagar', 3, '2024-06-23 05:39:06', 'IMG-20200523-WA0030.jpg'),
(14, 'Suhail Manzoor Dar', 'abcdd@gmail.com', 'Batamaloo', 1, '2024-06-23 06:05:36', 'IMG-20200524-WA0001.jpg'),
(16, 'Burhaan Nabi', 'dbjsv@gmail.com', 'Khanyar', 3, '2024-06-23 11:54:00', 'IMG-20200523-WA0026.jpg'),
(21, 'Basim', 'assd@gmail.com', 'Khanyar', 5, '2024-06-23 03:12:30', 'IMG-20190731-WA0001.jpg'),
(23, 'Irfan Raina', 'zuhjhjakkin@gmail.com', 'Lal Chowk DD', 3, '2024-06-23 11:53:32', '2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
