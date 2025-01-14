-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 01:41 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orbsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `floor_id` int(11) NOT NULL,
  `floor_code` varchar(255) NOT NULL,
  `floor_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`floor_id`, `floor_code`, `floor_name`, `description`) VALUES
(1, 'GF', 'GROUND FLOOR', 'WIDE and CLEAN'),
(2, 'FF', 'FIRST FLOOR', 'WIDE and CLEAN'),
(3, 'SF', 'SECOND FLOOR', 'WIDE, CLEAN, MABANGOW');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `guest_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `checkin` datetime NOT NULL,
  `days` int(11) NOT NULL,
  `checkout` datetime NOT NULL,
  `payment` int(11) NOT NULL,
  `receipt` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`guest_id`, `room_id`, `user_id`, `name`, `email`, `phone`, `checkin`, `days`, `checkout`, `payment`, `receipt`, `status`) VALUES
(1, 1, 0, 'Kevin', 'maranankevingabriel@gmail.com', '12345678910', '2024-06-24 02:05:00', 3, '2024-06-27 02:05:00', 45600, '', 2),
(2, 1, 4, 'dasdasd', 'maranankevingabriel@gmail.com', '123123543450', '2024-06-24 00:00:00', 2, '2024-06-26 00:00:00', 30400, '', 4),
(3, 5, 4, 'dasdasd', 'admin@gmail.com', '12324142324214', '2024-06-24 00:00:00', 12, '2024-07-06 00:00:00', 0, '', 4),
(4, 6, 4, 'sdfdsf', 'admin@gmail.com', '12312312312312', '2024-06-24 00:00:00', 12, '2024-07-06 00:00:00', 0, 'profile-user-icon-isolated-on-white-background-eps10-free-vector.jpg', 4),
(5, 1, 4, 'sdasdas', 'admin@gmail.com', '12312354355425', '2024-06-25 13:56:00', 3, '2024-06-28 13:56:00', 45600, 'leonardo-73523-160580005-516242.jpg', 3),
(6, 4, 4, 'kevjsjns', 'johnrusselldln@gmail.com', '1321315456465', '2024-06-25 19:26:00', 4, '2024-06-29 19:26:00', 0, '52374497269_005daba124_b.jpg', 3),
(7, 1, 0, 'hjsdh', 'testuser@gmail.com', '132131213121', '2024-06-23 13:29:00', 2, '2024-06-25 13:29:00', 30400, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `amenities` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `roomtype_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `amenities`, `price`, `roomtype_id`, `floor_id`, `status`, `image`) VALUES
(4, 'ROOM SKS - A', 'HINDI MABAHO', 0, 4, 3, '1', ''),
(5, 'ROOM SVS - A', 'MAY SABON', 0, 3, 3, '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `roomtype_id` int(11) NOT NULL,
  `roomtype_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`roomtype_id`, `roomtype_name`) VALUES
(1, 'Standard Room'),
(2, 'Deluxe Room'),
(3, 'View Suite'),
(4, 'King Suite');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `image`, `role`) VALUES
(4, 'Kevin Gabriel', 'Maranan', 'guest@gmail.com', '$2y$10$z8xYr1kO58/wJOVzDZ6zHu5TsIKEWnTmhx4LOF4d6pc.MVt/v3cjW', 'kevin.jpg', '1'),
(8, 'Kevin Gabriel', 'Maranan', 'maranankevingabriel@gmail.com', '$2y$10$E4G1dvqv4OpvYO0Lq5By.eZ2OWPkcw9KWMYjKBU40BSsn1Xb5sbQy', 'profile-user-icon-isolated-on-white-background-eps10-free-vector.jpg', '3'),
(9, 'Kevin Gabriel', 'Maranan', 'kevin@gmail.com', '$2y$10$rTNV12L0SoIiumz7cswv6.kDcb/n3p.BX0Uj1fYeXx9C6u5DZoxoa', 'profile-user-icon-isolated-on-white-background-eps10-free-vector1.jpg', '2'),
(10, 'Kevin Gabriel', 'Maranan', 'johnaeroljabat1018@gmail.com', '$2y$10$PpUfhnTnlPnokb6urbeAquj3Cpa3WcWXfvdoT9.tl3RMS0mBKy5yy', NULL, '3'),
(11, 'Kevin User 22', 'Gabriel', 'testuser@gmail.com', '$2y$10$sWeFZ6t.Is1.QMtVmVXVgumZEcC/FCFr5bX6xcgpy/Psfzvx1ICLe', 'profile-user-icon-isolated-on-white-background-eps10-free-vector2.jpg', '3'),
(12, 'Kevin User 22', 'user', 'admin@gmail.com', '$2y$10$UW4v6Z1x0u4O9oLf53QZxu96C4Irbs75sIwX5DB1vu4zOhfZ6gM0K', '52374497269_005daba124_b.jpg', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`floor_id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`roomtype_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `roomtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
