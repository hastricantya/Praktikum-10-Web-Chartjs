-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2021 at 01:38 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_covid`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_covid19`
--

CREATE TABLE `tb_covid19` (
  `id_covid` int(11) NOT NULL,
  `id_country` int(11) NOT NULL,
  `newcases` int(20) NOT NULL,
  `totaldeaths` int(20) NOT NULL,
  `newdeaths` int(20) DEFAULT NULL,
  `totalrecovered` int(20) DEFAULT NULL,
  `activecase` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_covid19`
--

INSERT INTO `tb_covid19` (`id_covid`, `id_country`, `newcases`, `totaldeaths`, `newdeaths`, `totalrecovered`, `activecase`) VALUES
(1, 1, 0, 600147, NULL, 27136020, 5979784),
(2, 2, 538, 274411, NULL, 21174076, 3516976),
(3, 3, 0, 435823, NULL, 14097287, 1094365),
(4, 4, 0, 107616, NULL, 5116705, 653466),
(5, 5, 0, 44760, NULL, 4947256, 125358),
(6, 6, 9328, 116211, 340, 4563254, 270108),
(7, 7, 0, 127679, NULL, 4277207, 45891),
(8, 8, 0, 124156, NULL, 3706084, 328882),
(9, 9, 0, 79339, NULL, 3297340, 228120),
(10, 10, 0, 86731, NULL, 3300700, 215508);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
