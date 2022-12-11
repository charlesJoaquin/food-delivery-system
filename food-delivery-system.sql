-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2022 at 10:49 AM
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
(1000000005, 'amiel', '123', 'Amiel Christian Mala-ay', '22 Adante St., Malabon City', 9114389726),
(1000000006, 'anya', '123', 'Anya Oliwa', '43 Tanglaw St., Quezon City', 933217563),
(1000000007, 'charles', '123', 'Charles Ansbert', '45 Padre Noval St., Manila', 9478624495);

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
(1000000005, '25 Adante St., Malabon City', 'Amiel Christian Mala-ay', 9114389726, 33, '2022-12-11 11:30:10', 800, 'Hawaiian Pizza x2'),
(1000000005, '25 Adante St., Malabon City', 'Amiel Christian Mala-ay', 9114389726, 34, '2022-12-11 11:30:50', 500, 'Meat Lovers\' Pizza x1'),
(1000000007, '45 Padre Noval St., Manila', 'Charles Ansbert', 9478624495, 36, '2022-12-11 12:37:21', 1000, 'Meat Lovers\' Pizza x2'),
(1000000006, '43 Tanglaw St., Quezon City', 'Anya Oliwa', 933217563, 38, '2022-12-11 13:40:41', 1000, 'Meat Lovers\' Pizza x2'),
(999999999, '43 Novilla St., Marikina City', 'Beatrice Laus', 933217565, 50, '2022-12-11 15:53:56', 300, 'Spaghetti x1'),
(999999999, '31 Leap St., Valenzuela City', 'Charles Ansbert', 9342158675, 51, '2022-12-11 16:02:03', 1600, 'Hawaiian Pizza x4'),
(1000000005, '22 Adante St., Malabon City', 'Amiel Christian Mala-ay', 9114389726, 53, '2022-12-11 16:17:24', 1000, 'Meat Lovers\' Pizza x2'),
(1000000005, '26 Adante St., Malabon City', 'Amiel Christian Mala-ay', 9114389726, 56, '2022-12-11 16:54:15', 2500, '1.5L Soda x25'),
(1000000005, '22 Adante St., Malabon City', 'Amiel Christian Mala-ay', 9114389726, 57, '2022-12-11 17:25:15', 1850, 'Meat Lovers\' Pizza x2,Buffalo Wings x1'),
(1000000005, '25 Adante St., Malabon City', 'Amiel Christian Mala-ay', 9114389726, 58, '2022-12-11 17:25:38', 1700, 'Buffalo Wings x2');

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
  MODIFY `CUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000008;

--
-- AUTO_INCREMENT for table `cus_order`
--
ALTER TABLE `cus_order`
  MODIFY `ORDER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

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
