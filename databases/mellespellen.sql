-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2024 at 05:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mellespellen`
--
CREATE DATABASE IF NOT EXISTS `mellespellen` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mellespellen`;

-- --------------------------------------------------------

--
-- Table structure for table `consoles`
--

CREATE TABLE `consoles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consoles`
--

INSERT INTO `consoles` (`id`, `name`) VALUES
(1, 'PlayStation'),
(2, 'XBOX'),
(3, 'Nintendo Switch');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `consoleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `image`, `description`, `price`, `consoleId`) VALUES
(1, 'Doom Eternal\r\n', 'doometernal.png', '', 30, 1),
(2, 'Red Dead Redemption II', 'reddead2.png', '', 50, 1),
(3, 'Call of Duty Black Ops 6', 'blackops6.png', '', 70, 1),
(4, 'Bloodborne', 'bloodborne.png', '', 30, 1),
(5, 'Marvel\'s Spider-Man 2', 'spiderman2.png', '', 70, 1),
(6, 'Elden Ring', 'eldenring.png', '', 60, 1),
(7, 'EA Sports FC 25', 'fc25.png', '', 80, 2),
(8, 'Hogwarts Legacy', 'hogwarts.png', '', 70, 2),
(9, 'Warhammer 40K: Space Marine', 'warhammer.png', '', 70, 2),
(10, 'Forza Horizon 5', 'forza.png', '', 50, 2),
(11, 'Halo Infinite', 'halo.png', '', 40, 2),
(12, 'S.T.A.L.K.E.R. 2: Heart of Chernobyl', 'stalker.png', '', 70, 2),
(13, 'The Legend of Zelda Breath of the Wild', 'botw.png', '', 60, 3),
(14, 'Super Mario Odyssey', 'marioodyssey.png', '', 40, 3),
(15, 'Super Smash Bros. Ultimate', 'smash.png', '', 40, 3),
(16, 'Mario Kart 8 Deluxe', 'mariokart.png', '', 60, 3),
(17, 'Fire Emblem Three Houses', 'fireemblem.png', '', 30, 3),
(18, 'Splatoon 3', 'splatoon.png', '', 40, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consoles`
--
ALTER TABLE `consoles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consoles`
--
ALTER TABLE `consoles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15416;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
