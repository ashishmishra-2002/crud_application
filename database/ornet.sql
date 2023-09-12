-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 02, 2023 at 05:40 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ornet`
--

-- --------------------------------------------------------

--
-- Table structure for table `ortask`
--

DROP TABLE IF EXISTS `ortask`;
CREATE TABLE IF NOT EXISTS `ortask` (
  `User_ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `MobileNo` varchar(10) NOT NULL,
  `Password` varchar(16) NOT NULL,
  `IsActive` int NOT NULL DEFAULT '1',
  `DeletedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `MobileNo` (`MobileNo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ortask`
--

INSERT INTO `ortask` (`User_ID`, `Name`, `MobileNo`, `Password`, `IsActive`, `DeletedOn`) VALUES
(1, 'Ashishkumar Mishra', '8104578546', 'Ashish@123', 1, NULL),
(3, 'Ashish Mishra', '9117180738', 'Ashish@123', 0, '2023-09-02 09:47:13'),
(4, 'Amit Mishra', '9867103217', 'Amit@123', 0, '2023-09-02 09:56:47'),
(5, 'Ayush Kumar', '9899999999', 'Ayush@123', 1, NULL),
(6, 'Ram Kumar', '8111111111', 'Ram@1234', 1, NULL),
(7, 'Dilip Mishra', '8222222222', 'Dilip@123', 1, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
