-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2022 at 05:44 PM
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
  `CUS_CONTACT_NO` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CUS_ID`, `CUS_UNAME`, `CUS_PASSWORD`, `CUS_NAME`, `CUS_ADDRESS`, `CUS_CONTACT_NO`) VALUES
(1000000000, 'amiel', '123', 'Amiel Christian Mala-ay', 'Caloocan City', '09114389726');

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

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `ORDER_ID` int(11) NOT NULL,
  `CUS_ID` int(11) NOT NULL,
  `ORDER_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `ORDER_COST` int(11) NOT NULL,
  `RIDER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rider`
--

CREATE TABLE `rider` (
  `RIDER_ID` int(11) NOT NULL,
  `RIDER_NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CUS_ID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`MENU_ID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`ORDER_ID`,`RIDER_ID`,`CUS_ID`) USING BTREE,
  ADD KEY `RIDER_ID` (`RIDER_ID`),
  ADD KEY `CUS_ID` (`CUS_ID`);

--
-- Indexes for table `rider`
--
ALTER TABLE `rider`
  ADD PRIMARY KEY (`RIDER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000001;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `ORDER_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rider`
--
ALTER TABLE `rider`
  MODIFY `RIDER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=500;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `CUS_ID` FOREIGN KEY (`CUS_ID`) REFERENCES `customer` (`CUS_ID`),
  ADD CONSTRAINT `RIDER_ID` FOREIGN KEY (`RIDER_ID`) REFERENCES `rider` (`RIDER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
