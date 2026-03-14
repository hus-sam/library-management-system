-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 31 ديسمبر 2025 الساعة 21:45
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library1`
--

-- --------------------------------------------------------

--
-- بنية الجدول `books`
--

CREATE TABLE `books` (
  `bnumber` int(11) NOT NULL,
  `bname` varchar(20) NOT NULL,
  `bwriter` varchar(20) NOT NULL,
  `bavailable` int(11) NOT NULL,
  `bimg` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `books`
--

INSERT INTO `books` (`bnumber`, `bname`, `bwriter`, `bavailable`, `bimg`) VALUES
(1, 'Atonement ', 'hussam', 11, 'img/16.webp'),
(3, 'To Kill a Mockingbir', 'Harper Lee', 32, 'img/11.jpg'),
(5, 'The Great Gatsby', 'F. Scott Fitzgerald', 12, 'img/12.jpg'),
(6, 'Pride and Prejudice', 'Jane Austen', 2, 'img/13.webp'),
(7, 'George Orwell', 'Eric Arthur Blair', 5, 'img/14.webp');

-- --------------------------------------------------------

--
-- بنية الجدول `metaphor1`
--

CREATE TABLE `metaphor1` (
  `mnumber` int(11) NOT NULL,
  `bnumber` int(11) NOT NULL,
  `msname` varchar(20) NOT NULL,
  `mbname` varchar(20) NOT NULL,
  `mtime` date NOT NULL,
  `snum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `metaphor1`
--

INSERT INTO `metaphor1` (`mnumber`, `bnumber`, `msname`, `mbname`, `mtime`, `snum`) VALUES
(25591, 0, 'hussam', 'The Great Gatsby', '2025-12-31', 50),
(41242, 0, 'hussam', 'Atonement ', '2025-12-31', 50),
(49722, 0, 'test', 'The Great Gatsby', '2025-12-31', 51),
(61618, 0, 'test', 'Pride and Prejudice', '2025-12-31', 51),
(71343, 0, 'test', 'George Orwell', '2025-12-31', 51),
(74817, 0, 'hussam', 'The Great Gatsby', '2025-12-31', 50);

-- --------------------------------------------------------

--
-- بنية الجدول `user`
--

CREATE TABLE `user` (
  `snum` int(11) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `simg` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `spass` varchar(255) DEFAULT NULL,
  `uname` varchar(20) NOT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `user`
--

INSERT INTO `user` (`snum`, `sname`, `simg`, `Email`, `spass`, `uname`, `role`) VALUES
(49, 'admin', '_47.jpg', '1@23', '$2y$10$eQ6D9un12KDSy5uI5dPD0OqXIBLKHXlx4.dzuRLis60xvQSMz0Szm', 'admin', 'admin'),
(50, 'hussam', '22c198e6ccbbbb9bfb42', '7uss5m2005@gmail.com', '$2y$10$qHbu/77W8b8C/WYM0xgB4.VBB6sVM4qfONd9NY4bTOyb3LJ41h6Ly', 'hussam', 'user'),
(51, 'test', '2895faba28f4fdd109b9', '202211796@std-zuj.ed', '$2y$10$Lgvn5wTBsoRIhZKpFoXErOBLTwni4S07xyGGMMuqGOYk2qgH6ukZy', 'test', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bnumber`);

--
-- Indexes for table `metaphor1`
--
ALTER TABLE `metaphor1`
  ADD PRIMARY KEY (`mnumber`),
  ADD KEY `fuser` (`snum`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`snum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bnumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `metaphor1`
--
ALTER TABLE `metaphor1`
  MODIFY `mnumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95441;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `snum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `metaphor1`
--
ALTER TABLE `metaphor1`
  ADD CONSTRAINT `fuser` FOREIGN KEY (`snum`) REFERENCES `user` (`snum`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
