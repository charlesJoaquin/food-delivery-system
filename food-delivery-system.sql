-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2022 at 07:05 AM
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
-- Database: `food-delivery-system`
--

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
  `CUS_CONTACT_NO` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CUS_ID`, `CUS_UNAME`, `CUS_PASSWORD`, `CUS_NAME`, `CUS_ADDRESS`, `CUS_CONTACT_NO`) VALUES
(1000000000, 'amiel', '123', 'Amiel Christian Mala-ay', '22 Adante St.', 2147483647),
(1000000001, 'aaaa', '123', 'Anya Oliwa', 'Warsaw', 949601960);

-- --------------------------------------------------------

--
-- Table structure for table `cus_order`
--

CREATE TABLE `cus_order` (
  `CUS_ID` int(11) NOT NULL,
  `CUS_ADDRESS` varchar(100) NOT NULL,
  `CUS_NAME` varchar(50) NOT NULL,
  `CUS_CONTACT_NO` int(20) NOT NULL,
  `ORDER_ID` int(11) NOT NULL,
  `ORDER_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `ORDER_COST` int(11) NOT NULL,
  `ORDER_DETAILS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cus_order`
--

INSERT INTO `cus_order` (`CUS_ID`, `CUS_ADDRESS`, `CUS_NAME`, `CUS_CONTACT_NO`, `ORDER_ID`, `ORDER_TIME`, `ORDER_COST`, `ORDER_DETAILS`) VALUES
(1000000000, '22 Adante St.', 'Amiel Christian Mala-ay', 2147483647, 1, '2022-12-10 13:12:33', 0, ''),
(1000000000, '22 Adante St.', 'Amiel Christian Mala-ay', 2147483647, 2, '2022-12-10 13:13:19', 0, ''),
(1000000001, 'Warsaw', 'Anya Oliwa', 949601960, 3, '2022-12-10 13:27:50', 0, ''),
(1000000001, 'Warsaw', 'Anya Oliwa', 949601960, 4, '2022-12-10 13:30:37', 0, ''),
(1000000001, 'Warsaw', 'Anya Oliwa', 949601960, 5, '2022-12-10 13:31:00', 0, ''),
(1000000001, 'Warsaw', 'Anya Oliwa', 949601960, 6, '2022-12-10 13:32:34', 0, ''),
(1000000001, 'Warsaw', 'Anya Oliwa', 949601960, 7, '2022-12-10 13:39:53', 4730, ''),
(1000000001, 'Warsaw', 'Anya Oliwa', 949601960, 8, '2022-12-10 13:44:38', 0, ''),
(1000000001, 'Warsaw', 'Anya Oliwa', 949601960, 9, '2022-12-10 13:46:33', 400, 'Carbonara x1'),
(1000000001, 'Warsaw', 'Anya Oliwa', 949601960, 10, '2022-12-10 13:46:55', 1700, 'Lasagna x2,Carbonara x2'),
(1000000001, 'Warsaw', 'Anya Oliwa', 949601960, 11, '2022-12-10 13:47:12', 2300, 'Spaghetti x2,Lasagna x2,Carbonara x2'),
(1000000001, 'Warsaw', 'Anya Oliwa', 949601960, 12, '2022-12-10 13:47:21', 5700, 'Spaghetti x2,Lasagna x2,Carbonara x2,Buffalo Wings x4'),
(1000000001, 'Warsaw', 'Anya Oliwa', 949601960, 13, '2022-12-10 13:56:36', 6700, 'Meat Lovers\' Pizza x2,Spaghetti x2,Lasagna x2,Carbonara x2,Buffalo Wings x4'),
(1000000001, 'Warsaw', 'Anya Oliwa', 949601960, 14, '2022-12-10 13:57:08', 5040, 'Hawaiian Pizza x1,Ham and Cheese Pizza x1,Meat Lovers\' Pizza x1,Spaghetti x1,Lasagna x1,Carbonara x1,Pepper Steak with Rice x1,Buffalo Wings x1,Chicken Strips x1,Mozzarella Sticks x1,1.5L Soda x1,Ice Cream Float x1');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `MENU_ID` int(11) NOT NULL,
  `MENU_NAME` varchar(50) NOT NULL,
  `MENU_PRICE` int(11) NOT NULL,
  `MENU_TYPE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `CUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000003;

--
-- AUTO_INCREMENT for table `cus_order`
--
ALTER TABLE `cus_order`
  MODIFY `ORDER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
