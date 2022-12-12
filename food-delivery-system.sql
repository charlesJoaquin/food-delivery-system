-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2022 at 01:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-delivery-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_UNAME` varchar(20) NOT NULL,
  `ADMIN_PASSWORD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_UNAME`, `ADMIN_PASSWORD`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CUS_ID` int(11) NOT NULL,
  `CUS_UNAME` varchar(20) NOT NULL,
  `CUS_PASSWORD` varchar(50) NOT NULL,
  `CUS_NAME` varchar(50) NOT NULL,
  `CUS_ADDRESS` varchar(100) NOT NULL,
  `CUS_CONTACT_NO` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CUS_ID`, `CUS_UNAME`, `CUS_PASSWORD`, `CUS_NAME`, `CUS_ADDRESS`, `CUS_CONTACT_NO`) VALUES
(999999999, 'guest', 'guest', 'guest', 'none', 0),
(1000000005, 'amiel', '123', 'Amiel Christian Malaay', '22 Adante St., Malabon City', 9114389726),
(1000000007, 'charles', '123', 'Charles Ansbert', '45 Padre Noval St., Manila', 9478624495),
(1000000010, 'astark', 'abc', 'Arya Stark', 'Winterfell', 9324356578),
(1000000012, 'sstark', 'abc', 'Sansa Stark', 'Winterfell', 9324356578);

-- --------------------------------------------------------

--
-- Table structure for table `cus_order`
--

CREATE TABLE `cus_order` (
  `CUS_ID` int(11) NOT NULL,
  `CUS_ADDRESS` varchar(100) NOT NULL,
  `CUS_NAME` varchar(50) NOT NULL,
  `CUS_CONTACT_NO` bigint(20) NOT NULL,
  `ORDER_ID` int(11) NOT NULL,
  `ORDER_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `ORDER_COST` int(11) NOT NULL,
  `ORDER_DETAILS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cus_order`
--

INSERT INTO `cus_order` (`CUS_ID`, `CUS_ADDRESS`, `CUS_NAME`, `CUS_CONTACT_NO`, `ORDER_ID`, `ORDER_TIME`, `ORDER_COST`, `ORDER_DETAILS`) VALUES
(1000000005, '22 Adante St., Malabon City', 'Amiel Christian Malaay', 9114389726, 77, '2022-12-12 07:24:02', 3350, 'Meat Lovers\' Pizza x5,Buffalo Wings x1'),
(999999999, 'Winterfell', 'Arya Stark', 9324356578, 81, '2022-12-12 08:20:53', 1900, 'Ham and Cheese Pizza x2,Meat Lovers\' Pizza x2'),
(999999999, 'Winterfell', 'Arya Stark', 9324356578, 82, '2022-12-12 08:23:04', 800, 'Hawaiian Pizza x2');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EMP_ID` int(11) NOT NULL,
  `EMP_NAME` varchar(50) NOT NULL,
  `EMP_UNAME` varchar(20) NOT NULL,
  `EMP_PASSWORD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EMP_ID`, `EMP_NAME`, `EMP_UNAME`, `EMP_PASSWORD`) VALUES
(5000, 'Jeremy Llose', 'jllose', '123'),
(5013, 'Amiel Christian Malaay', 'acmalaay', 'abc'),
(5014, 'Lancelot Bulan', 'lbulan', 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `MENU_ID` int(11) NOT NULL,
  `MENU_NAME` varchar(50) NOT NULL,
  `MENU_PRICE` int(11) NOT NULL,
  `MENU_TYPE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`MENU_ID`, `MENU_NAME`, `MENU_PRICE`, `MENU_TYPE`) VALUES
(1, 'Hawaiian Pizza', 400, 'PIZZA'),
(2, 'Ham and Cheese Pizza', 450, 'PIZZA'),
(3, 'Meat Lovers\' Pizza', 500, 'PIZZA'),
(4, 'Spaghetti', 300, 'PASTA'),
(5, 'Lasagna', 450, 'PASTA'),
(6, 'Carbonara', 400, 'PASTA'),
(7, 'Pepper Steak with Rice', 690, 'MEAL'),
(8, 'Buffalo Wings', 850, 'SIDE'),
(9, 'Chicken Strips', 500, 'SIDE'),
(10, 'Mozzarella Sticks', 300, 'SIDE'),
(11, '1.5L Soda', 100, 'BEVERAGE'),
(12, 'Ice Cream Float', 100, 'BEVERAGE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_UNAME`),
  ADD UNIQUE KEY `ADMIN_UNAME` (`ADMIN_UNAME`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CUS_ID`),
  ADD UNIQUE KEY `CUS_UNAME` (`CUS_UNAME`);

--
-- Indexes for table `cus_order`
--
ALTER TABLE `cus_order`
  ADD PRIMARY KEY (`ORDER_ID`,`CUS_ID`),
  ADD KEY `CUS_ID` (`CUS_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EMP_ID`),
  ADD UNIQUE KEY `EMP_NAME` (`EMP_UNAME`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`MENU_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000013;

--
-- AUTO_INCREMENT for table `cus_order`
--
ALTER TABLE `cus_order`
  MODIFY `ORDER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EMP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5016;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cus_order`
--
ALTER TABLE `cus_order`
  ADD CONSTRAINT `cus_order_ibfk_1` FOREIGN KEY (`CUS_ID`) REFERENCES `customer` (`CUS_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
