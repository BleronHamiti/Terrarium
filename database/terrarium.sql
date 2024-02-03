-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2024 at 04:46 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `terrarium`
--

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `plant_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `species` varchar(255) DEFAULT NULL,
  `picture_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`plant_id`, `user_id`, `name`, `species`, `picture_path`, `created_at`, `updated_at`) VALUES
(34, 33, 'Plant', 'sdfgdfg', 'uploads/uploaded_65a3eb19deb95.PNG', '2024-01-14 14:09:29', '2024-01-14 14:09:29'),
(35, 33, 'LULJA', 'cactus', 'uploads/uploaded_65be485cc24f8.png', '2024-02-03 14:06:20', '2024-02-03 14:06:20'),
(36, 33, 'dfg', 'sdfgdfg', 'uploads/uploaded_65be4e9847f2b.png', '2024-02-03 14:32:56', '2024-02-03 14:32:56'),
(37, 33, 'dfg', 'sdfgdfg', 'uploads/uploaded_65be4ec153654.png', '2024-02-03 14:33:37', '2024-02-03 14:33:37'),
(38, 33, 'Cactus', 'Cactus', 'uploads/uploaded_65be5f9a954d0.png', '2024-02-03 15:45:30', '2024-02-03 15:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_surname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` varchar(255) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_surname`, `user_email`, `user_password`, `user_role`) VALUES
(32, 'd', 'd', 'behare.konjuvca@digitalschool.tech', '$2y$10$DOHYV4tnfVjRpVsqI/G4lu6URgBBWjbet92Bj/ZsfyNLlmcs67o3i', 'user'),
(33, 'behare123', 'konjuvca', 'konjuvcabehare1@gmail.com', '$2y$10$cEUYXOuB4KbUVfBvay/DUeTwqag4nEv9S34nTIauC5syB/OwbCEF6', 'user'),
(34, 'behare', 'konjuvca', 'konjuvcabehare23@gmail.com', '$2y$10$RSR.wJaxP9JjObQnY4SbkOFyK94EUlklLiK5dq.iPfcn1RdMaE5FK', 'user'),
(35, 'behare', 'konjuvca', 'konjuvcabehare111@gmail.com', '$2y$10$obSB9iDPwSCS44M6ZW/rmuxPIDUbVUP/2.Njdnt3bbuxL8k68Ul/6', 'user'),
(36, 'sdfg', 'dsfg', 'sdfgsdth@dfgh.sdfd', '$2y$10$JKxVD22Gc0colQzEAupgt.Xb.W/7z1xvRW4REPHAXNKVcrIVOR.VC', 'user'),
(37, 'behare', 'konjuvca', 'konjuvcabehare@gmail.com', '$2y$10$XyicZgiPRTsS9XpZuPBMh.rBTIuBmRJ5japuvyp2A8K1s7IYm5.i2', 'user'),
(38, 'w', 'w', 'w@lk.com', '$2y$10$XZcc41sk/IPXwrMh3Gdm3.lCeiBfgkxDvah0WKxXlXp5HuOm4HGTK', 'user'),
(39, 'q', 'q', 'konjuvcabehar11e@gmail.com', '$2y$10$/2ujfC0NtJEPeMiZrqcLi.ogOQm00AHTqdg2M0IFf7LM61c/cbueq', 'user'),
(40, 'behare', 'konjuvca', 'konjuvcabe1111hare@gmail.com', '$2y$10$dXHs0ru1yLGkqdqMRei.hOOv2s2d4R/YjpNG8IYEHKV16lUCdHXde', 'user'),
(41, 'behare', 'konjuvca', 'konjuv11111cabehare@gmail.com', '$2y$10$ogS6qa/.W9YQ/qYEjgthseg9Ue8DQ.XstZmc5j1o6ZETHAj25cj/.', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wateringneeds`
--

CREATE TABLE `wateringneeds` (
  `watering_id` int(11) NOT NULL,
  `plant_id` int(11) DEFAULT NULL,
  `watering_frequency` int(11) DEFAULT NULL,
  `last_watered_date` date DEFAULT NULL,
  `next_watering_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wateringneeds`
--

INSERT INTO `wateringneeds` (`watering_id`, `plant_id`, `watering_frequency`, `last_watered_date`, `next_watering_date`) VALUES
(64, 34, 2, '0000-00-00', '2024-01-16'),
(65, 34, 2, '0000-00-00', '2024-01-16'),
(66, 34, 2, '0000-00-00', '2024-01-16'),
(67, 34, 2, '0000-00-00', '2024-01-16'),
(68, 35, 7, '2024-02-01', '2024-02-08'),
(69, 35, 7, '2024-02-01', '2024-02-08'),
(70, 35, 7, '2024-02-01', '2024-02-08'),
(71, 35, 7, '2024-02-01', '2024-02-08'),
(72, 36, 2, '2024-01-31', '2024-02-02'),
(73, 36, 2, '2024-01-31', '2024-02-02'),
(74, 36, 2, '2024-01-31', '2024-02-02'),
(75, 36, 2, '2024-01-31', '2024-02-02'),
(76, 37, 2, '2024-02-01', '2024-02-03'),
(77, 37, 2, '2024-02-01', '2024-02-03'),
(78, 37, 2, '2024-02-01', '2024-02-03'),
(79, 37, 2, '2024-02-01', '2024-02-03'),
(80, 38, 10, '2024-02-03', '2024-02-13'),
(81, 38, 10, '2024-02-03', '2024-02-13'),
(82, 38, 10, '2024-02-03', '2024-02-13'),
(83, 38, 10, '2024-02-03', '2024-02-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`plant_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `wateringneeds`
--
ALTER TABLE `wateringneeds`
  ADD PRIMARY KEY (`watering_id`),
  ADD KEY `plant_id` (`plant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `plant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `wateringneeds`
--
ALTER TABLE `wateringneeds`
  MODIFY `watering_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `plants_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `wateringneeds`
--
ALTER TABLE `wateringneeds`
  ADD CONSTRAINT `wateringneeds_ibfk_1` FOREIGN KEY (`plant_id`) REFERENCES `plants` (`plant_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
