-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2021 at 06:38 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cedcab`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `distance` varchar(255) NOT NULL,
  `is_available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `name`, `distance`, `is_available`) VALUES
(1, 'Charbagh', '0', 1),
(2, 'Indiranagar', '10', 1),
(3, 'BBD', '30', 1),
(4, 'Barabanki', '60', 1),
(5, 'Faizabad', '100', 1),
(6, 'Basti', '150', 1),
(7, 'Gorakhpur', '210', 1),
(8, 'Etah', '270', 1),
(9, 'Aligarh', '340', 1),
(10, 'Etwah', '280', 0),
(11, '88', '88', 0),
(12, 'Farrukhabad', '345', 1),
(13, 'ddffd', '89', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ride`
--

CREATE TABLE `tbl_ride` (
  `ride_id` int(11) NOT NULL,
  `ride_date` date NOT NULL,
  `pickup` varchar(255) NOT NULL,
  `todrop` varchar(255) NOT NULL,
  `total_distance` varchar(255) NOT NULL,
  `luggage` varchar(255) NOT NULL,
  `total_fare` double NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `cab_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ride`
--

INSERT INTO `tbl_ride` (`ride_id`, `ride_date`, `pickup`, `todrop`, `total_distance`, `luggage`, `total_fare`, `status`, `user_id`, `cab_type`) VALUES
(14, '2021-02-25', '4', '7', '150', '15', 2053, 2, 2, 'CedMini'),
(15, '2021-02-25', '2', '6', '140', '15', 2421, 1, 2, 'CedSUV'),
(16, '2021-02-25', '7', '2', '200', '25', 2645, 2, 2, 'CedMini'),
(17, '2021-02-25', '6', '2', '140', '45', 2041, 0, 2, 'CedMini'),
(25, '2021-02-26', '7', '1', '210', '100', 3460, 0, 2, 'CedSUV'),
(26, '2021-03-01', '2', '4', '50', '11', 915, 0, 2, 'CedMini'),
(27, '2021-03-01', '7', '5', '110', '15', 1765, 1, 2, 'CedRoyal'),
(28, '2021-03-01', '4', '3', '30', '32', 1115, 1, 2, 'CedSUV'),
(29, '2021-03-01', '4', '5', '40', '', 545, 1, 2, 'CedMicro'),
(30, '2021-03-01', '4', '7', '150', '42', 2153, 1, 2, 'CedMini'),
(31, '2021-03-01', '8', '1', '270', '32', 3310, 2, 2, 'CedMini'),
(32, '2021-03-01', '8', '4', '210', '12', 3260, 2, 2, 'CedSUV'),
(33, '2021-03-01', '3', '8', '240', '12', 3215, 0, 2, 'CedRoyal'),
(34, '2021-03-01', '7', '8', '60', '25', 1565, 0, 2, 'CedSUV'),
(35, '2021-03-01', '6', '8', '120', '25', 1817, 2, 2, 'CedMini'),
(36, '2021-03-01', '2', '8', '260', '24', 3525, 0, 2, 'CedRoyal'),
(37, '2021-03-01', '1', '7', '210', '555', 3460, 0, 8, 'CedSUV'),
(38, '2021-03-01', '2', '3', '20', '99', 625, 0, 8, 'CedMini'),
(39, '2021-03-01', '9', '8', '70', '252', 1697, 0, 8, 'CedSUV'),
(40, '2021-03-01', '9', '5', '240', '15', 3215, 0, 8, 'CedRoyal'),
(41, '2021-03-01', '3', '12', '315', '35', 4667.5, 0, 8, 'CedSUV');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `File` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `email`, `name`, `date`, `mobile`, `status`, `is_admin`, `password`, `File`) VALUES
(1, 'admin@gmail.com', 'Admin', '2021-03-01', '+916394958264', 1, 1, 'c93ccd78b2076528346216b3b2f701e6', 'upload/1934009403.jpeg'),
(2, 'shauryap92@gmail.com', 'Shaurya Pratap', '2021-03-01', '+916394958264', 1, 0, '827ccb0eea8a706c4c34a16891f84e7b', 'upload/1934009403.jpeg'),
(6, 'chauhan@gmail.com', 'Jonu', '2021-03-01', '+919719426353', 1, 0, '827ccb0eea8a706c4c34a16891f84e7b', 'null'),
(7, 'shaurya@gmail.com', 'Aditya', '2021-03-01', '+919058574263', 0, 0, '827ccb0eea8a706c4c34a16891f84e7b', 'null'),
(8, 'sagar.expertdev@gmail.com', 'Sagar s Gupta', '2021-03-01', '9140545989', 1, 0, '827ccb0eea8a706c4c34a16891f84e7b', 'upload/1929826728.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD PRIMARY KEY (`ride_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  MODIFY `ride_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
