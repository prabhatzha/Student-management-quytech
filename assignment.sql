-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2024 at 01:54 AM
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
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `age`, `mobile`, `email`, `gender`, `address`, `status`) VALUES
(4, 'Rohit kumar', 33, '8796251718', 'rohit@gmail.com', 'Male', 'karol bagh,new delhi, 110096', 'Active'),
(5, 'shikha kumari', 24, '5634129856', 'shikha@gmail.com', 'Female', 'thane,mumbai,201529', 'Inactive'),
(6, 'Ayush', 45, '986899889', 'ayush@gmail.com', 'Male', 'abc apartmant, delhi, delhi, 10096', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'prabhat', 'root@g.com', '$2y$10$H2fGoRMOMaZ9PgVryxhRAu60jNxAabUhtGSFU.QvjUXpOuNDD32nu', '2024-10-02 12:21:30'),
(2, 'test', 'test@gmail.com', '$2y$10$IS8TiZZgfHX3Ze.yu68E0elvzxH/0TvqOr7tV./0XLnmWIAWKVknK', '2024-10-02 12:37:50'),
(3, 'test1', 'test1@gmail.com', '$2y$10$VAI2hBOPJn.A2N3F0Kl/9.8hkq2hVCXUXzQCq8heKm1h4RMzpdeFS', '2024-10-02 12:46:20'),
(4, 'sonu', 'sonu@gmail.com', '$2y$10$7i6Z3T7wBx5sBF.8h3H6VOITWnUgdrhFLY84C.WCcc8yAmw.43ix6', '2024-10-02 14:30:14'),
(5, 'Prabhat kumar', 'prabhat@gmail.com', '$2y$10$s1CGPUrElz1esQbWpJyaouocA.CZmeQv7Wh9Mt5IOiqQI93J3zEqW', '2024-10-02 23:14:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
