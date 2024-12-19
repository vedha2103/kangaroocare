-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 10:24 AM
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
-- Database: `kangaroocare`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','customer') DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(2, 'khor', 'ci230085@student.uthm.edu.my', '$2y$10$RE8yUL2WzzOZQZBC.aKvWOiQZq5fsJOuKnURaFYVUgdHq8GeXYQLa', 'admin'),
(3, 'khor2', 'ci230086@student.uthm.edu.my', '$2y$10$4yvxFjrEjFglLFOo0A1HOu8n2BZOxgHJLHlSQ8F8hiirk8OIP24I2', 'admin'),
(4, 'khor', 'ci123@gmail.com', '$2y$10$ElRyDzNnp8RMk/ct2Zrc2eX6RHVbxofxr75ojh7DN7WtoesQaGEse', ''),
(7, 'khor5', '123@gmail.com', '$2y$10$KSn1t53Rm3PFSP3I1vpzDeR9EWChVsJcTA2SX2He9jAIIjgoUpgUy', ''),
(8, 'khor6', '1234@gmail.com', '$2y$10$sjDuEzAfzFPrGolfeZKVPu4xu9nLhZDidLFHCkx0CR07M3ULbjtDC', ''),
(9, 'khor9', '12345@gmail.com', '$2y$10$fvf0Idr96CyWgUHzNXlv.ORCaDFfkX8ulmbIGMVyLiviCqjBNlKHa', ''),
(10, 'khor10', '123456@gmail.com', '$2y$10$JMgcOfi1c9DEsYbvxNcLiepDtP.i2s9i/Mwrm3t4euUfrXdZNTJpO', 'admin'),
(11, 'khor11', '1234567@gmail.com', '$2y$10$bWUeJ5Lzsc7v2WX0JD7f2.FbNBCqyhUpY2zHq5KW0agPQTuv.QqT2', 'admin'),
(12, 'khor12', 'q@gamail.com', '$2y$10$ghOJELjms4DjgyMNpFptVejVusXQ0IhkEmf3Sas9zom5xtzk6b66S', 'staff'),
(13, 'khor13', 'w@gmail.com', '$2y$10$bNUXpqQJxTnLH.wBFf.FYeceY5hVz2eqyeV72MvHpc3cfdebfZuha', 'customer');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
