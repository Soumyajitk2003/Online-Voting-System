-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 26, 2024 at 09:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `add_no` varchar(20) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `User_Pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`add_no`, `phone_no`, `User_Pass`) VALUES
('Admin 1', '9474595897', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `member_details`
--

CREATE TABLE `member_details` (
  `party` varchar(20) NOT NULL,
  `college_id` int(7) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `aadharNum` varchar(12) NOT NULL,
  `voterNum` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `User_Pass` varchar(50) NOT NULL,
  `votes` int(254) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_details`
--

INSERT INTO `member_details` (`party`, `college_id`, `phone_no`, `fullName`, `aadharNum`, `voterNum`, `Email`, `User_Pass`, `votes`) VALUES
('Party 1', 2132043, '9474595897', 'Soumyajit Kar', '497029511659', 'WIT2422080', 'soumyjitk41@gmail.com', '1234', 15),
('Party 2', 2132042, '9064635640', 'Rajiv', '23456789012', '1234567', 'rajibmahato89@gmail.com', '5678', 0),
('Party 3', 2132030, '7864947287', 'Thakurdas', '3456890123', 'wti889076', 'thakurdaslata87@gmail.com', '123456', 2),
('Party 4', 2132001, '7384624861', 'Anwesha', '123456789012', '1234567', 'anwesha06@gmail.com', '123478', 0);

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE `registered_users` (
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `aadher` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `is_verified` int(10) NOT NULL DEFAULT 0,
  `resettoken` varchar(255) DEFAULT NULL,
  `resettokenexpire` date DEFAULT NULL,
  `voting` tinyint(1) DEFAULT 0,
  `party` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registered_users`
--

INSERT INTO `registered_users` (`full_name`, `username`, `aadher`, `email`, `password`, `verification_code`, `is_verified`, `resettoken`, `resettokenexpire`, `voting`, `party`) VALUES
('Arijit Das', '2132002', '905478774124', 'iamarjdas05@gmail.com', '$2y$10$CLr.FKxqjFCjTst57wgruepBTcu9gwjCtT4Js7dhW3g549gkCqqaW', '56e91aa12eb7910e5c1b222ec2a0dbb5', 1, NULL, NULL, 0, 'Soumyajit'),
('Bankim Chandra Das', '2132004', '635269693212', 'bcdchannel990@gmail.com', '$2y$10$GZwCvWgSd0eYDMdaGX0mseHN39si4KbLIl17QSSQ4wyyvHTmt6t2W', 'e7d6e9f134bdaaa34d48ea212b4dfc96', 1, NULL, NULL, 1, 'Soumyajit'),
('Krishnendu gorai', '2132012', '123456789012', 'krishnendugorai17@gmail.com', '$2y$10$Kfgzi3uAN3UVsYS0R8VNLOG3LpE7pJg.DtbN2VzWBG8JM75gIlyC6', '606a7f6ae72352799e8278de356d523e', 1, NULL, NULL, 1, 'Soumyajit'),
('Souvik Gorai', '2132030', '1234567891234567', 'translatersouvik1@gmail.com', '$2y$10$D1C.aBQJdktbdcbK1tq6SuVqPTKVIDk3Nukt1rUvrgqtanvOBz6Fi', '4374386b6e8cb35254efb447af529fe2', 1, NULL, NULL, 1, 'Thakurdas'),
('Thakurdas laya', '2132036', '153215324896', 'layathakurdas@gmail.com', '$2y$10$XqhHPPliQ.yiURZKzpXw4OxgHVQUzFRYT/sqXIcqTTSUpkmtntVvS', '69dcec73900ccc004afc1fa412eb071c', 0, NULL, NULL, 0, NULL),
('Rajib mahato', '2132042', '255814703690', 'rrajibmahato7602@gmail.com', '$2y$10$jGu8XQ7Z7d49QSukpKpKVO7w8X1wU2X9fJUE2YlOJ6wLE/NE8RAne', '342cf8e97af347ee3dba1bdc25d0d6e3', 1, NULL, NULL, 1, 'Soumyajit'),
('Subhajeet paramanik ', '26272627', '78768779787648', 'subhajeetparamanik838@gmail.com', '$2y$10$2Rmf0lN.8DVActQVmNb4LOTaIXE/1hjFCTFfMyqIarJfwxl3Ro1Vi', '7f1070a40973c11703b13eb93f230a21', 1, NULL, NULL, 1, 'Soumyajit'),
('Shivam ', '7586648', '856975847856', 'shibamchandra911@gmail.com', '$2y$10$n5d0FCYDq4iVL7VXK6wOYelrmIWHHIyYyyMoTK9dTiTok2foz44iW', 'e15abe3c5c3a0e20c53d758c7bcdecc4', 1, NULL, NULL, 1, NULL),
('Megha ', '9842679', '963258763524', 'karmegha006@gmail.com', '$2y$10$GWLjI63piQ7OUY0duYoLjuuhRx9RWQF5Zvq7eCOQ0qiTG5Vw4vcWm', '', 1, NULL, NULL, 1, 'Soumyajit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`phone_no`),
  ADD UNIQUE KEY `administrator` (`add_no`);

--
-- Indexes for table `member_details`
--
ALTER TABLE `member_details`
  ADD PRIMARY KEY (`party`,`college_id`,`phone_no`,`aadharNum`);

--
-- Indexes for table `registered_users`
--
ALTER TABLE `registered_users`
  ADD PRIMARY KEY (`username`,`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
