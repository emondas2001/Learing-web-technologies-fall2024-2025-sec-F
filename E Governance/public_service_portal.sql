-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 07:03 PM
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
-- Database: `public_service_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `email` varchar(250) NOT NULL,
  `bill_type` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`email`, `bill_type`, `amount`, `due_date`, `description`) VALUES
('mark@gmail.com', 'Electricity', 1000.00, '2024-12-18', 'paid'),
('ric@gmail.com', 'Water', 3000.00, '2025-01-01', 'send me a massege');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `class` varchar(25) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `problem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`name`, `email`, `class`, `subject`, `problem`) VALUES
('Upanta Chowdhury', 'mark@gmail.com', 'Undergraduate', 'Data Structure', 'I can&#039;t understand the Longest Common Subsequence Problem.'),
('ric das', 'ric@gmail.com', 'Undergraduate', 'Data Structure', 'stirg and array function');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_records`
--

CREATE TABLE `emergency_records` (
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `emergency_type` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_records`
--

INSERT INTO `emergency_records` (`email`, `full_name`, `contact_number`, `emergency_type`, `description`, `submission_date`) VALUES
('mark@gmail.com', 'Upanta Chowdhury', '01234567891', 'Fire', 'nikunja-2,road no-14', '2025-01-21 19:04:56');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `email` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`email`, `item_name`, `quantity`, `price`, `payment_method`, `total_cost`) VALUES
('mark@gmail.com', 'bike', 3, 350.00, 'Credit Card', 1050.00),
('ric@gmail.com', 'Bags', 6, 1200.00, 'Credit Card', 7200.00);

-- --------------------------------------------------------

--
-- Table structure for table `nid`
--

CREATE TABLE `nid` (
  `email` varchar(255) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `nid_number` varchar(250) NOT NULL,
  `dob` date NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nid`
--

INSERT INTO `nid` (`email`, `full_name`, `nid_number`, `dob`, `submission_date`) VALUES
('mark@gmail.com', 'Upanta Chowdhury', '12457896533254', '2025-01-22', '2025-01-21 18:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `Password`, `address`, `date_of_birth`) VALUES
('Dip Das', 'das@gmail.com', '321987', 'Uttara', '2001-05-07'),
('Upanta', 'mark@gmail.com', '123456', 'Nikunja', '2003-05-14'),
('omi', 'omi@gmai.com', '321456', 'khulna', '2002-02-21'),
('Omon Das', 'omon@gmail.com', '0123456', 'Cox\'s Bazar', '2001-01-01'),
('ric', 'ric@gmail.com', '654123', 'dhaka', '2002-01-15'),
('rocky', 'rocky@gmail.com', '784512', 'Uttara', '2001-01-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `emergency_records`
--
ALTER TABLE `emergency_records`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `nid`
--
ALTER TABLE `nid`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `UNIQUE` (`email`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `Password` (`Password`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
