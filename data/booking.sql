-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2018 at 11:50 AM
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
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `from_time` varchar(255) NOT NULL,
  `to_time` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  `week` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `repeat_week` tinyint(4) NOT NULL DEFAULT '0',
  `repeat_month` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `room_id`, `reservation_date`, `from_time`, `to_time`, `name`, `notes`, `approved`, `week`, `month`, `repeat_week`, `repeat_month`) VALUES
(2, 1, '2018-03-22', '11:00AM', '07:00PM', 'Emma Watson', 'hdjshjfh sdjfhj hfjhsd j', 1, NULL, NULL, 0, 0),
(3, 11, '2018-04-28', '09:00AM', '08:00PM', '', '', 0, 6, NULL, 0, 0),
(4, 1, '2018-04-12', '09:00AM', '05:00PM', 'hdhsahsh', 'ksajdkj sakjdk sa', 0, 4, 4, 0, 0),
(5, 1, '2018-04-12', '09:00AM', '05:00PM', 'hdhsahsh', 'ksajdkj sakjdk sa', 1, 4, 4, 0, 0),
(6, 1, '2018-04-12', '09:00AM', '05:00PM', 'sdjha jsh', 'hfhdsjfhjd', 0, 4, 4, 0, 0),
(7, 1, '2018-04-12', '09:00AM', '05:00PM', 'sdjha jsh', 'hfhdsjfhjd', 1, 4, 4, 1, 1),
(8, 1, '2018-04-12', '09:00AM', '05:00PM', 'kjfksdjk', 'kjksjfkd', 0, 4, 4, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `description`, `image`) VALUES
(1, 1, 'Royal room', ''),
(11, 5, 'kasdjkasj dkjsak', ''),
(12, 52, 'Test Room', 'room.jpg');

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
  `is_admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `phonenumber`, `address`, `gender`, `email`, `password`, `is_admin`) VALUES
(1, 'Sara Malas', '0653521215', 'shdjhsaj', 1, 'sara@test.com', '098f6bcd4621d373cade4e832627b4f6', 0),
(2, 'Admin', '0653521215', 'sdhjsahj dhjsa', 0, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `room_id` (`room_id`);

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
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
