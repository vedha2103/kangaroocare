-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2024 at 06:50 AM
-- Server version: 10.6.7-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kangaroocare_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `username`, `feedback`, `created_at`) VALUES
(1, 'khor', 'hahaha', '2024-12-29 05:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `ladies`
--

CREATE TABLE `ladies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `package_type` enum('Basic','Premium') NOT NULL,
  `package_details` text NOT NULL,
  `experience` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `specialty` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ladies`
--

INSERT INTO `ladies` (`id`, `name`, `package_type`, `package_details`, `experience`, `age`, `photo_url`, `specialty`, `bio`, `contact_info`, `password`) VALUES
(1, 'Ooi Chew Hong', 'Basic', '5 days confinement, meals, postpartum care.', 7, 43, 'Ooi Chew Hong.jpeg', 'Lactation', 'Caring and professional', '012-55112354', '12345'),
(2, 'Lim San Yok', 'Basic', '6 days confinement, meals, light housework assistance.', 6, 49, 'Lim San Yok.jpg', 'Postpartum', 'Loving and attentive', '013-2340671', ''),
(3, 'See Phaik Lan', 'Basic', '7 days confinement, meals, daily checkups, light chores.', 4, 53, 'See Phaik Lan.jpg', 'Postpartum', 'Friendly and supportive', '017-1239876', ''),
(4, 'Ang Siew Chan', 'Premium', '10 days confinement, meals, lactation support, full care.', 7, 50, 'Ang Siew Chan.jpg', 'Lactation', 'Loving and experienced', '011-8894635', ''),
(5, 'Tan Siew Ling', 'Premium', '12 days confinement, meals, 24/7 support, full care.', 8, 47, 'Tan Siew Ling.jpg', 'Postpartum', 'Caring and compassionate', '019-4638593', ''),
(6, 'Lim Yee Leng', 'Premium', '14 days confinement, meals, postpartum support, housework.', 6, 50, 'Lim Yee Leng.jpg', 'Postpartum', 'Friendly and reliable', '016-4719473', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','customer') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'khor', 'ci230085@student.uthm.edu.my', '$2y$10$NlgN8S5VHBlROtjuSaPZRubXtnblygjZ0Q78yuYt2OFJX3f7.KQqy', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ladies`
--
ALTER TABLE `ladies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ladies`
--
ALTER TABLE `ladies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
