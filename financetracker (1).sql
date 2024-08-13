-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 06:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `financetracker`
--

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `s.no` int(11) NOT NULL,
  `transaction` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`s.no`, `transaction`, `date`, `type`, `description`, `amount`) VALUES
(1, 'income', '2024-08-13', 'salary', '', 10000),
(2, 'savings', NULL, 'car', '10000', 1200);

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `s.no` int(255) NOT NULL,
  `name` text NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `mobile_no.` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `iname` varchar(255) DEFAULT NULL,
  `image` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`s.no`, `name`, `emailid`, `mobile_no.`, `password`, `city`, `state`, `username`, `iname`, `image`) VALUES
(15, 'news', 'news@gmail.com', 1234567890, 'news', 'news', 'Tamilnadu', 'news', NULL, NULL);
