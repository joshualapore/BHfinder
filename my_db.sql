-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 28, 2019 at 04:38 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `rentalaccount`
--

CREATE TABLE `rentalaccount` (
  `id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `host_username` varchar(255) NOT NULL,
  `host_email` varchar(255) NOT NULL,
  `rental_name` varchar(255) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `citymunicipality` varchar(255) NOT NULL,
  `regionprov` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipcode` varchar(100) NOT NULL,
  `vacancytype` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `rentalspaceavail` int(11) NOT NULL,
  `rentalrentee` int(11) NOT NULL,
  `rental_imga` varchar(255) NOT NULL,
  `rental_imgb` varchar(255) NOT NULL,
  `rental_imgc` varchar(255) NOT NULL,
  `rental_imgd` varchar(255) NOT NULL,
  `active` tinyint(10) NOT NULL,
  `createdat` varchar(32) NOT NULL,
  `availability` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rentalaccount`
--

INSERT INTO `rentalaccount` (`id`, `host_id`, `host_username`, `host_email`, `rental_name`, `contact`, `barangay`, `street`, `citymunicipality`, `regionprov`, `country`, `zipcode`, `vacancytype`, `price`, `rentalspaceavail`, `rentalrentee`, `rental_imga`, `rental_imgb`, `rental_imgc`, `rental_imgd`, `active`, `createdat`, `availability`) VALUES
(28, 100, 'SampleAdmin', 'wongjie0930@gmail.com', 'Abc Dormitory ', '09191234567', 'Amado Tapuac', 'Rioferio Road Arellano Street', 'dagupan', 'pangassinan', 'Philippines', '2400', 'Apartment', 6600, 5, 2, '5c6973519c99c4.49987829.png', '', '', '', 1, '1550414673', 'Open'),
(30, 100, 'SampleAdmin', 'wongjie0930@gmail.com', 'Abc Dormitory ', '09191234567', 'Amado Tapuac', 'Rioferio Road Arellano Street', 'dagupan', 'pangassinan', 'Philippines', '2400', 'House', 500, 3, 2, '5c69765992d0d6.59441571.png', '', '', '', 1, '1550415449', 'Open'),
(31, 100, 'SampleAdmin', 'wongjie0930@gmail.com', 'Abc Dormito ', '091912345', 'Amado Tapuac', 'Rioferio Road Arellano Street', 'dagupan', 'pangassinan', 'Philippines', '2400', 'Studio Type', 5000, 5, 2, '5c7710fd3d3640.33813716.jpg', '', '', '', 0, '1551307005', 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `usermsg`
--

CREATE TABLE `usermsg` (
  `id` int(11) NOT NULL,
  `receiverusername` varchar(255) NOT NULL,
  `senderusername` varchar(255) NOT NULL,
  `typevacancy` varchar(255) NOT NULL,
  `msgto` varchar(255) NOT NULL,
  `msgdate` varchar(255) NOT NULL,
  `readmsg` varchar(255) NOT NULL,
  `msgcount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usermsg`
--

INSERT INTO `usermsg` (`id`, `receiverusername`, `senderusername`, `typevacancy`, `msgto`, `msgdate`, `readmsg`, `msgcount`) VALUES
(42, 'SampleAdmin', 'SampleAdmin', 'House', 'ggffg', '2019-02-27 13:58', 'yes', 0),
(43, 'SampleAdmin', 'SampleAdmin', 'House', 'rrr', '2019-02-27 14:28', 'yes', 0),
(44, 'SampleAdmin', 'SampleAdmin', 'House', 'asdsadsad', '2019-02-27 16:14', 'yes', 0),
(46, 'SampleAdmin', 'SampleUser', 'Apartment', 'hey is this, available\".?', '2019-02-27 23:20', 'yes', 0),
(47, 'SampleUser', 'SampleAdmin', 'Apartment', 'yes', '2019-02-27 23:23', 'yes', 0),
(48, 'SampleAdmin', 'SampleUser', 'Apartment', 'dsfdsfsd', '2019-02-27 23:43', 'yes', 0),
(50, 'SampleAdmin', 'SampleAdmin', 'Apartment', 'hjkhkjh', '2019-02-28 04:35', 'yes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` varchar(32) NOT NULL,
  `reset_code` char(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `userlevel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `image`, `created_at`, `reset_code`, `is_active`, `userlevel`) VALUES
(89, 'John Doe', 'cipherzip0gf001@gmail.com', 'SampleUser', '$2y$10$CAbPYgamz9oou2I2v8CZgOOCQuhe2rdTCtaasGEIuUM.2DImMSmmy', '', '1547262468', '', 1, 'user'),
(99, 'light jie', 'cipherzip0001@gmail.com', 'superadmin', '$2y$10$U4Ud7Kcg4FVcMK.oOnqYtOKqtac44tZ66b5t0gMVPxfbXJocvd3ia', '5c5edfbfad7476.75874267.jpg', '1549090056', '', 1, 'super'),
(100, 'Jane Doe', 'wongjie0930@gmail.com', 'SampleAdmin', '$2y$10$uZ0e8EnJvho4oiR7NkLyGOJSgqKAURNEL.g5bhWUOiC9gIGwZeW5K', '5c6e4181069b03.66811773.jpg', '1549897563', '', 1, 'admin'),
(101, 'Jhelmar Wong', 'cipherzisdsdp0001@gmail.com', 'wong', '$2y$10$tR.fn29z7O7IIzXhnqgOjuyhyL5Vhr9PClfYNm20/8G7bKmOULFTq', '', '1549952256', '', 1, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rentalaccount`
--
ALTER TABLE `rentalaccount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usermsg`
--
ALTER TABLE `usermsg`
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
-- AUTO_INCREMENT for table `rentalaccount`
--
ALTER TABLE `rentalaccount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `usermsg`
--
ALTER TABLE `usermsg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
