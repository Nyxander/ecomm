-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2022 at 10:13 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forgot_pass_tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `userId` INT(10) NOT NULL AUTO_INCREMENT,
                         `uName` VARCHAR(200) NOT NULL,
                         `mail` VARCHAR(200) NOT NULL,
                         `password` VARCHAR(200) NOT NULL,
                         `activation` VARCHAR(100) NOT NULL,
                         `profile_photo` VARCHAR(255) DEFAULT NULL,  -- This will store the file path or URL
                         PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `uName`, `mail`, `password`, `activation`) VALUES
(1, 'jmuriithi', 'muriithijohnit@gmail.com', '$2y$10$evnrDlTAiTV2zaaZxwN5E.P8C./tPBfK1tWaFGSqpEJmx4xoL8K6y', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `profile_picture` VARCHAR(255) DEFAULT 'image/default.jpg';





/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
