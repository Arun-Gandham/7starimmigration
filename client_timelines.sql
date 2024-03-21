-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2024 at 11:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seven_star`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_timelines`
--

CREATE TABLE `client_timelines` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `change` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `client_timelines`
--

INSERT INTO `client_timelines` (`id`, `user_id`, `client_id`, `change`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 'a:2:{s:4:\"type\";s:7:\"payment\";s:7:\"message\";s:20:\"12313 payment added.\";}', '2024-03-21 08:13:35', '2024-03-21 08:13:35'),
(2, 3, 3, 'a:4:{s:4:\"type\";s:7:\"details\";s:7:\"message\";s:15:\"Details updated\";s:3:\"old\";a:7:{s:4:\"name\";s:4:\"test\";s:7:\"comment\";N;s:14:\"file_submitted\";s:3:\"Yes\";s:10:\"enq_status\";s:7:\"Pending\";s:7:\"address\";s:8:\"tst24234\";s:6:\"amount\";s:6:\"234234\";s:10:\"country_id\";s:6:\"Canada\";}s:3:\"new\";a:7:{s:4:\"name\";s:4:\"test\";s:7:\"comment\";s:15:\"testing comment\";s:14:\"file_submitted\";s:3:\"Yes\";s:10:\"enq_status\";s:7:\"Pending\";s:7:\"address\";s:15:\"tst24234 123123\";s:6:\"amount\";s:6:\"234234\";s:10:\"country_id\";s:6:\"Canada\";}}', '2024-03-21 09:20:56', '2024-03-21 09:20:56'),
(3, 3, 3, 'a:4:{s:4:\"type\";s:7:\"details\";s:7:\"message\";s:15:\"Details updated\";s:3:\"old\";a:7:{s:4:\"name\";s:4:\"test\";s:7:\"comment\";s:15:\"testing comment\";s:14:\"file_submitted\";s:3:\"Yes\";s:10:\"enq_status\";s:7:\"Pending\";s:7:\"address\";s:15:\"tst24234 123123\";s:6:\"amount\";s:6:\"234234\";s:10:\"country_id\";s:6:\"Canada\";}s:3:\"new\";a:7:{s:4:\"name\";s:4:\"test\";s:7:\"comment\";s:15:\"testing comment\";s:14:\"file_submitted\";s:2:\"No\";s:10:\"enq_status\";s:7:\"Pending\";s:7:\"address\";s:15:\"tst24234 123123\";s:6:\"amount\";s:10:\"23423423e2\";s:10:\"country_id\";s:6:\"Canada\";}}', '2024-03-21 10:01:58', '2024-03-21 10:01:58'),
(4, 3, 3, 'a:3:{s:4:\"type\";s:7:\"payment\";s:7:\"message\";s:19:\"2000 payment added.\";s:6:\"amount\";s:4:\"2000\";}', '2024-03-21 10:27:12', '2024-03-21 10:27:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_timelines`
--
ALTER TABLE `client_timelines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_timelines`
--
ALTER TABLE `client_timelines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
