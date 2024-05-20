-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 05:59 PM
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
-- Database: `olfu`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientcars`
--

CREATE TABLE `clientcars` (
  `car_id` int(20) NOT NULL,
  `client_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `name` varchar(20) NOT NULL,
  `e_mail` varchar(30) NOT NULL,
  `message` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`name`, `e_mail`, `message`) VALUES
('Nikhil', 'nikhil@gmail.com', 'Hope this works.');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `car_id` int(20) NOT NULL,
  `car_name` varchar(50) NOT NULL,
  `car_nameplate` varchar(50) NOT NULL,
  `car_fare` varchar(255) NOT NULL,
  `car_img` varchar(50) DEFAULT 'NA',
  `car_availability` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`car_id`, `car_name`, `car_nameplate`, `car_fare`, `car_img`, `car_availability`) VALUES
(17, 'SPCB', '101', 'BSIT', 'assets/img/cars/1.jpg', ''),
(18, 'SPCB', '103', 'BSIT', 'assets/img/cars/1.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(100) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `car_id` int(20) NOT NULL,
  `booking_date` datetime NOT NULL,
  `rent_start_date` datetime NOT NULL,
  `rent_end_date` datetime NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `car_return_date` datetime DEFAULT NULL,
  `fare` double NOT NULL,
  `charge_type` varchar(25) NOT NULL DEFAULT 'days',
  `distance` double DEFAULT NULL,
  `no_of_days` int(50) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `return_status` varchar(10) NOT NULL,
  `booking_status` varchar(255) NOT NULL,
  `reciept_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `customer_username`, `car_id`, `booking_date`, `rent_start_date`, `rent_end_date`, `time_start`, `time_end`, `car_return_date`, `fare`, `charge_type`, `distance`, `no_of_days`, `total_amount`, `return_status`, `booking_status`, `reciept_image`) VALUES
(574681358, 'admin1', 17, '2024-05-11 00:00:00', '2024-05-12 00:00:00', '2024-05-12 00:00:00', '13:50:00', '16:50:00', NULL, 0, 'day', NULL, NULL, NULL, 'NR', 'approve', ''),
(574681359, 'admin1', 17, '2024-05-11 00:00:00', '2024-05-12 00:00:00', '2024-05-12 00:00:00', '13:50:00', '16:50:00', NULL, 0, 'day', NULL, NULL, NULL, 'NR', 'approve', ''),
(574681360, 'admin1', 17, '2024-05-11 00:00:00', '2024-05-12 00:00:00', '2024-05-12 00:00:00', '13:50:00', '16:50:00', NULL, 0, 'day', NULL, NULL, NULL, 'NR', 'approve', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `customer_username` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_email` varchar(25) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `customer_password` varchar(20) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`customer_username`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `customer_password`, `status`, `id_image`, `role`) VALUES
('admin', '', '', '', '', 'adminadmin', '', '', 'admin'),
('admin1', 'Secretary', '0999999999999', 'admin1@gmail.com', 'Antipolo City', '123', 'approve', 'assets/img/users_id/1.jpg', 'customer'),
('neth', 'neth', '0919292929292', 'neth@gmail.com', 'neth', '123', 'decline', 'assets/img/users_id/1.jpg', 'customer'),
('nonoy', 'nonoy', '1231321313', 'nonoy@gmail.com', 'Antipolo City', '123', 'decline', 'assets/img/users_id/1.jpg', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientcars`
--
ALTER TABLE `clientcars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`car_id`),
  ADD UNIQUE KEY `car_nameplate` (`car_nameplate`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`customer_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `car_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=574681361;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
