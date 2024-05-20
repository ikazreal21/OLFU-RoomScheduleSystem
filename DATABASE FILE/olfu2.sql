-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 10:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
-- Table structure for table `prof_schedule`
--

CREATE TABLE `prof_schedule` (
  `id` int(255) NOT NULL,
  `room_id` varchar(255) NOT NULL,
  `prof_id` varchar(255) NOT NULL,
  `prof_name` varchar(255) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `day_of_week` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `duration` varchar(255) NOT NULL,
  `is_online` varchar(255) NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prof_schedule`
--

INSERT INTO `prof_schedule` (`id`, `room_id`, `prof_id`, `prof_name`, `subject_name`, `room`, `day_of_week`, `time`, `duration`, `is_online`) VALUES
(13, '17', '3', 'TEST', 'TEST', 'SPCB - 101', 'Monday', '15:00:00', '2', '1');

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
(18, 'SPCB', '103', 'BSIT', 'assets/img/cars/1.jpg', ''),
(19, 'SPCB', 'AVR', 'ALL', 'assets/img/cars/1.jpg', ''),
(20, 'TEST', 'TEST', 'TEST', 'assets/img/cars/1.jpg', '');

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
  `day_of_week` varchar(255) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `booking_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `customer_username`, `car_id`, `booking_date`, `rent_start_date`, `day_of_week`, `time_start`, `time_end`, `event_name`, `booking_status`) VALUES
(574681372, 'customer', 19, '2024-05-20 00:00:00', '2024-05-21 00:00:00', 'Tuesday', '08:00:00', '10:00:00', 'TEST', 'approve'),
(574681373, 'faculty1', 18, '2024-05-20 00:00:00', '2024-05-21 00:00:00', 'Tuesday', '18:00:00', '20:00:00', '', 'pending'),
(574681378, 'faculty1', 18, '2024-05-20 00:00:00', '2024-05-21 00:00:00', 'Tuesday', '18:00:00', '20:00:00', '', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
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

INSERT INTO `users` (`user_id`, `customer_username`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `customer_password`, `status`, `id_image`, `role`) VALUES
(1, 'admin', '', '', '', '', 'adminadmin', '', '', 'admin'),
(2, 'admin1', 'Secretary', '0999999999999', 'admin1@gmail.com', 'Antipolo City', '123', 'approve', 'assets/img/users_id/1.jpg', 'dean'),
(3, 'faculty1', 'TEST', '111111111', 'test@test.com', '#55 TEST', '123', 'approve', '', 'faculty'),
(5, 'customer', 'Joaquin Zaki Soriano', '09695191665', 'joaquinzaki21@gmail.com', '#55 St. Therese St.', '123', 'approve', 'assets/img/users_id/photo_2024-01-03_19-05-06.jpg', 'customer'),
(6, 'depertmenthead', 'Joaquin Zaki Soriano', '09695191665', 'joaquinzaki21@gmail.com', '#55 St. Therese St.', '123', 'approve', 'assets/img/users_id/photo_2024-01-03_19-05-06.jpg', 'depthead'),
(7, 'secretary', 'Joaquin Zaki Soriano', '09695191665', 'joaquinzaki21@gmail.com', '#55 St. Therese St.', '123', 'approve', 'assets/img/users_id/photo_2024-01-03_19-05-06.jpg', 'secretary');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prof_schedule`
--
ALTER TABLE `prof_schedule`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prof_schedule`
--
ALTER TABLE `prof_schedule`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `car_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=574681379;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
