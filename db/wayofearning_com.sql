-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 21, 2021 at 07:01 PM
-- Server version: 8.0.19
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wayofearning.com`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads_earning`
--

CREATE TABLE `ads_earning` (
  `ID` bigint NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `plan_id` bigint DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ads_earning`
--

INSERT INTO `ads_earning` (`ID`, `user_id`, `plan_id`, `date`) VALUES
(4, 1, 1, '2021-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `ID` bigint NOT NULL,
  `parent_user_id` bigint DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`ID`, `parent_user_id`, `user_id`, `code`) VALUES
(1, 1, 5, NULL),
(2, 1, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` bigint NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `picture` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `type` varchar(1) NOT NULL,
  `plan` int DEFAULT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT '0',
  `plan_tid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `referral_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `full_name`, `email`, `password`, `phone`, `picture`, `type`, `plan`, `verify`, `plan_tid`, `referral_code`) VALUES
(1, 'Tahir Mehmood', 'tahirg.shahid@gmail.com', 'admin', '00000000000', NULL, '2', 1, 1, NULL, '075747136872'),
(2, 'Tahir Mehmood', '1tahirg.shahid@gmail.com', 'admin', '00000000000', NULL, '2', NULL, 0, NULL, '904745151501'),
(3, 'Tahir Mehmood', '2tahirg.shahid@gmail.com', 'admin', '00000000000', NULL, '2', NULL, 0, NULL, '804442063497'),
(4, 'Tahir Mehmood', '3tahirg.shahid@gmail.com', 'admin', '00000000000', NULL, '2', NULL, 0, NULL, '257260753442'),
(5, 'Tahir Mehmood', '4tahirg.shahid@gmail.com', 'admin', '00000000000', NULL, '2', 1, 1, NULL, '333717998188'),
(6, 'Tahir Mehmood', '6tahirg.shahid@gmail.com', 'admin', '00000000000', NULL, '2', NULL, 0, NULL, '635244095020');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads_earning`
--
ALTER TABLE `ads_earning`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads_earning`
--
ALTER TABLE `ads_earning`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
