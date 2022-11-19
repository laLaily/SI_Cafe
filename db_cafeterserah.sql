-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2022 at 05:51 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cafeterserah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `username`, `password`) VALUES
(1, 'mitha', '123'),
(2, 'laily', '456'),
(3, 'satya', '789');

-- --------------------------------------------------------

--
-- Table structure for table `detail_dineintransaction`
--

CREATE TABLE `detail_dineintransaction` (
  `dtrxid` int(11) NOT NULL,
  `dpid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dineintransaction`
--

CREATE TABLE `dineintransaction` (
  `dntrxid` int(11) NOT NULL,
  `dntrxdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dnsid` int(11) DEFAULT NULL,
  `dncustomername` varchar(50) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `dnadminid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pcategory` enum('Makanan','Minuman','Dessert') DEFAULT NULL,
  `pstock` int(11) NOT NULL,
  `pprice` int(11) NOT NULL,
  `ppath` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `pcategory`, `pstock`, `pprice`, `ppath`) VALUES
(1, 'Strip Steak', 'Makanan', 50, 48700, './assets/Menu Images/Strip Steak.png'),
(2, 'Spanish Fried Eggs', 'Makanan', 50, 42300, './assets/Menu Images/Spanish Fried Eggs.png'),
(3, 'Red Pepper Pasta', 'Makanan', 50, 45800, './assets/Menu Images/Red Pepper Pasta.png'),
(4, 'Strawberry Juice', 'Minuman', 50, 20000, './assets/Menu Images/Strawberry Juice.png'),
(5, 'Matcha Boba', 'Minuman', 50, 22500, './assets/Menu Images/Matcha Boba.png'),
(6, 'Coffee Latte', 'Minuman', 50, 20500, './assets/Menu Images/Coffee Latte.png'),
(7, 'Dalgona Coffee', 'Minuman', 50, 21500, './assets/Menu Images/Dalgona Coffee.png'),
(8, 'Cookie Milkshake', 'Minuman', 50, 20500, './assets/Menu Images/Cookie Milkshake.png'),
(9, 'Baked French Fries', 'Dessert', 50, 21000, './assets/Menu Images/Baked French Fries.png'),
(10, 'Mac and Cheese', 'Dessert', 50, 25000, './assets/Menu Images/Mac and Cheese.png'),
(11, 'Bluberry Pie', 'Dessert', 50, 18000, './assets/Menu Images/Bluberry Pie.png'),
(12, 'Berries Puding', 'Dessert', 50, 17500, './assets/Menu Images/Berries Puding.png'),
(13, 'Red Velvet Cake', 'Dessert', 50, 24700, './assets/Menu Images/Red Velvet Cake.png'),
(14, 'Mango Smoothie', 'Dessert', 50, 23400, './assets/Menu Images/Mango Smoothie.png'),
(15, 'Chocolate Macarons', 'Dessert', 50, 21400, './assets/Menu Images/Chocolate Macarons.png'),
(16, 'Passion Fruit Souffles', 'Dessert', 50, 21000, './assets/Menu Images/Passion Fruit Souffles.png'),
(17, 'Choco Ice  Cream', 'Dessert', 50, 18000, './assets/Menu Images/Choco Ice Cream.png'),
(18, 'Mocha Ice Cream', 'Dessert', 50, 18000, './assets/Menu Images/Mocha Ice Cream.png');

-- --------------------------------------------------------

--
-- Table structure for table `reservationtransaction`
--

CREATE TABLE `reservationtransaction` (
  `rtrxid` int(11) NOT NULL,
  `rname` varchar(100) NOT NULL,
  `rdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rnotelp` varchar(14) NOT NULL,
  `rdtrxid` int(11) DEFAULT NULL,
  `rstatus` enum('reserved','used','done') NOT NULL DEFAULT 'reserved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `sid` int(11) NOT NULL,
  `snumber` int(11) NOT NULL,
  `stype` varchar(20) NOT NULL,
  `sstatus` enum('available','unavailable') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`sid`, `snumber`, `stype`, `sstatus`) VALUES
(1, 101, '2 seat', 'available'),
(2, 102, '2 seat', 'available'),
(3, 103, '2 seat', 'available'),
(4, 104, '2 seat', 'available'),
(5, 105, '2 seat', 'available'),
(6, 201, '2 seat', 'available'),
(7, 202, '2 seat', 'available'),
(8, 203, '2 seat', 'available'),
(9, 204, '2 seat', 'available'),
(10, 205, '2 seat', 'available'),
(11, 106, '4 seat', 'available'),
(12, 107, '4 seat', 'available'),
(13, 108, '4 seat', 'available'),
(14, 109, '4 seat', 'available'),
(15, 110, '4 seat', 'available'),
(16, 206, '4 seat', 'available'),
(17, 207, '4 seat', 'available'),
(18, 208, '4 seat', 'available'),
(19, 209, '4 seat', 'available'),
(20, 210, '4 seat', 'available'),
(21, 111, '10 seat', 'available'),
(22, 112, '10 seat', 'available'),
(23, 113, '10 seat', 'available'),
(24, 211, '10 seat', 'available'),
(25, 212, '10 seat', 'available'),
(26, 213, '10 seat', 'available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `detail_dineintransaction`
--
ALTER TABLE `detail_dineintransaction`
  ADD KEY `fk_dpid` (`dpid`),
  ADD KEY `fk_dtrxid` (`dtrxid`);

--
-- Indexes for table `dineintransaction`
--
ALTER TABLE `dineintransaction`
  ADD PRIMARY KEY (`dntrxid`),
  ADD KEY `fk_admin_id` (`dnadminid`),
  ADD KEY `fk_dnsid` (`dnsid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `reservationtransaction`
--
ALTER TABLE `reservationtransaction`
  ADD PRIMARY KEY (`rtrxid`),
  ADD KEY `fk_rdtrxid` (`rdtrxid`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dineintransaction`
--
ALTER TABLE `dineintransaction`
  MODIFY `dntrxid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reservationtransaction`
--
ALTER TABLE `reservationtransaction`
  MODIFY `rtrxid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_dineintransaction`
--
ALTER TABLE `detail_dineintransaction`
  ADD CONSTRAINT `fk_dpid` FOREIGN KEY (`dpid`) REFERENCES `products` (`pid`),
  ADD CONSTRAINT `fk_dtrxid` FOREIGN KEY (`dtrxid`) REFERENCES `dineintransaction` (`dntrxid`);

--
-- Constraints for table `dineintransaction`
--
ALTER TABLE `dineintransaction`
  ADD CONSTRAINT `fk_admin_id` FOREIGN KEY (`dnadminid`) REFERENCES `admin` (`aid`),
  ADD CONSTRAINT `fk_dnsid` FOREIGN KEY (`dnsid`) REFERENCES `seat` (`sid`);

--
-- Constraints for table `reservationtransaction`
--
ALTER TABLE `reservationtransaction`
  ADD CONSTRAINT `fk_rdtrxid` FOREIGN KEY (`rdtrxid`) REFERENCES `reservationtransaction` (`rtrxid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
