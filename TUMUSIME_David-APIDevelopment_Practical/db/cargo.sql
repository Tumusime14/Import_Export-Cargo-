-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 10:49 AM
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
-- Database: `cargo`
--

-- --------------------------------------------------------

--
-- Table structure for table `exports`
--

CREATE TABLE `exports` (
  `furniture_id` varchar(30) NOT NULL,
  `export_date` date DEFAULT NULL,
  `quantity` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exports`
--

INSERT INTO `exports` (`furniture_id`, `export_date`, `quantity`) VALUES
('1', '2024-04-12', '2');

-- --------------------------------------------------------

--
-- Table structure for table `furnitures`
--

CREATE TABLE `furnitures` (
  `furniture_id` varchar(30) NOT NULL,
  `furniture_name` varchar(50) NOT NULL,
  `furniture_owner_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furnitures`
--

INSERT INTO `furnitures` (`furniture_id`, `furniture_name`, `furniture_owner_name`) VALUES
('', 'Desktop and Tables', 'Kigali in-house Design Ltd'),
('0', 'Desktop', 'Kigali in-house Design Ltd'),
('1', 'Table and Chairs', 'John'),
('KBZ001', 'Dining Table', 'Alice Smith'),
('KBZ002', 'Leather Sofa', 'John Doe'),
('KBZ003', 'Queen Bed', 'Mary Johnson'),
('KBZ004', 'Office Desk', 'Robert Brown'),
('KBZ005', 'Bookshelf', 'Linda Miller'),
('KBZ006', 'Coffee Table', 'Michael Wilson'),
('KBZ007', 'Armchair', 'Karen Davis'),
('KBZ008', 'Kitchen Cabinet', 'James Martinez'),
('KBZ009', 'Wardrobe', 'Patricia Anderson'),
('KBZ010', 'Recliner', 'Charles Thomas'),
('TP004', 'Cleaners materials', 'Clear Industries');

-- --------------------------------------------------------

--
-- Table structure for table `imports`
--

CREATE TABLE `imports` (
  `furniture_id` varchar(30) NOT NULL,
  `import_date` date DEFAULT NULL,
  `quantity` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `imports`
--

INSERT INTO `imports` (`furniture_id`, `import_date`, `quantity`) VALUES
('1', '2024-04-12', '5');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `manager_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`manager_id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'david', '172522ec1028ab781d9dfd17eaca4427'),
(4, 'tumusime', '16884df0c8f2acbe9e2bae7f16e6f0c7'),
(5, '2musime', 'f88e517f9ae6d4228288ce06632b74f8'),
(6, 'keza', '944ce13aca2ed8b2e1d86374f727ff97');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exports`
--
ALTER TABLE `exports`
  ADD KEY `exports_ibfk_1` (`furniture_id`);

--
-- Indexes for table `furnitures`
--
ALTER TABLE `furnitures`
  ADD PRIMARY KEY (`furniture_id`);

--
-- Indexes for table `imports`
--
ALTER TABLE `imports`
  ADD KEY `imports_ibfk_1` (`furniture_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_id`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exports`
--
ALTER TABLE `exports`
  ADD CONSTRAINT `exports_ibfk_1` FOREIGN KEY (`furniture_id`) REFERENCES `furnitures` (`furniture_id`);

--
-- Constraints for table `imports`
--
ALTER TABLE `imports`
  ADD CONSTRAINT `imports_ibfk_1` FOREIGN KEY (`furniture_id`) REFERENCES `furnitures` (`furniture_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
