-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2025-01-01 06:19:02
-- 服务器版本： 10.4.32-MariaDB
-- PHP 版本： 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `kangaroocare_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `ladies`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `ladies`
--

INSERT INTO `ladies` (`id`, `name`, `package_type`, `package_details`, `experience`, `age`, `photo_url`, `specialty`, `bio`, `contact_info`, `password`) VALUES
(1, 'Ooi Chew Hong', 'Basic', '5 days confinement, meals, postpartum care.', 7, 43, 'Ooi Chew Hong.jpeg', 'Lactation', 'Caring and professional', '012-55112354', '12345'),
(2, 'Lim San Yok', 'Basic', '6 days confinement, meals, light housework assistance.', 6, 49, 'Lim San Yok.jpg', 'Postpartum', 'Loving and attentive', '013-2340671', ''),
(3, 'See Phaik Lan', 'Basic', '7 days confinement, meals, daily checkups, light chores.', 4, 53, 'See Phaik Lan.jpg', 'Postpartum', 'Friendly and supportive', '017-1239876', ''),
(4, 'Ang Siew Chan', 'Premium', '10 days confinement, meals, lactation support, full care.', 7, 50, 'Ang Siew Chan.jpg', 'Lactation', 'Loving and experienced', '011-8894635', ''),
(5, 'Tan Siew Ling', 'Premium', '12 days confinement, meals, 24/7 support, full care.', 8, 47, 'Tan Siew Ling.jpg', 'Postpartum', 'Caring and compassionate', '019-4638593', ''),
(6, 'Lim Yee Leng', 'Premium', '14 days confinement, meals, postpartum support, housework.', 6, 50, 'Lim Yee Leng.jpg', 'Postpartum', 'Friendly and reliable', '016-4719473', '');

--
-- 转储表的索引
--

--
-- 表的索引 `ladies`
--
ALTER TABLE `ladies`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ladies`
--
ALTER TABLE `ladies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
