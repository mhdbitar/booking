-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2018 at 11:31 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `room` int(11) NOT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `customer`, `room`, `seen`) VALUES
(11, 'Admin', 1, 1),
(12, 'Admin', 1, 1),
(13, 'Admin', 1, 1),
(14, 'Admin', 1, 1),
(15, 'Admin', 0, 1),
(16, 'Admin', 0, 1),
(17, 'Admin', 5, 1),
(18, 'Admin', 52, 1),
(19, 'Admin', 52, 1),
(20, 'Admin', 1, 1),
(21, 'Admin', 1, 1),
(22, 'Admin', 1, 1),
(23, 'Admin', 1, 1),
(24, 'Admin', 1, 1),
(25, 'Admin', 1, 1),
(26, 'Admin', 1, 1),
(27, 'Admin', 1, 1),
(28, 'Admin', 1, 1),
(29, 'Admin', 1, 1),
(30, 'Admin', 1, 1),
(31, 'Admin', 1, 1),
(32, 'Admin', 1, 1),
(33, 'Admin', 1, 1),
(34, 'Admin', 1, 1),
(35, 'Admin', 1, 1),
(36, 'Admin', 1, 1),
(37, 'Admin', 1, 1),
(38, 'Admin', 1, 1),
(39, 'Admin', 1, 1),
(40, 'Admin', 1, 1),
(41, 'Admin', 1, 1),
(42, 'Admin', 1, 1),
(43, 'Admin', 1, 1),
(44, 'Admin', 1, 1),
(45, 'Admin', 1, 1),
(46, 'Admin', 52, 0),
(47, 'Admin', 52, 0),
(48, 'Admin', 52, 0),
(49, 'Admin', 52, 0),
(50, 'Admin', 52, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `from_time` int(11) NOT NULL,
  `to_time` int(11) NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  `room_price` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `room_id`, `user_id`, `reservation_date`, `from_time`, `to_time`, `approved`, `room_price`) VALUES
(16, 11, 9, '2018-05-12', 9, 13, 0, 0),
(17, 11, 9, '2018-06-16', 9, 13, 0, 0),
(18, 11, 9, '2018-07-21', 9, 13, 0, 0),
(19, 11, 9, '2018-08-25', 9, 13, 0, 0),
(20, 11, 9, '2018-09-29', 9, 13, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_number` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `room_number`, `description`, `image`, `price`) VALUES
(1, 'Royal room', 1, 'Royal room', '', 0),
(11, 'Test room 1', 5, 'kasdjkasj dkjsak', '', 0),
(12, 'Test room 2', 52, 'Test Room', 'room.jpg', 0),
(13, 'another test room', 30, 'test set', 'rooms-hotel-tbilisi-S-02-r-1.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `phonenumber`, `address`, `gender`, `email`, `password`, `is_admin`, `salt`) VALUES
(9, 'Admin', '0653521215', 'admin', 1, 'admin@admin.com', '$2y$10$D14Cgups2gzz/FQvOYUcROhra0o3I.baKxyMJGjOv.QpBu2vB16YC', 1, '2wHyDUCQOZ'),
(10, 'Sara Bitar', '0653521215', 'test', 1, 'sara@test.com', '$2y$10$Ym.wCxYG9xX0/pzpTJ0YWOF8g/Qg3O3sxzyAvJymET10dEaZx/NT2', 0, '2HngCzQ2Ky');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
