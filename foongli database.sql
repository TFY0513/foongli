-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2022 at 10:12 AM
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
-- Database: `foongli`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `adminID` int(20) NOT NULL,
  `password` varchar(300) NOT NULL,
  `name` varchar(50) NOT NULL,
  `roleID` int(20) NOT NULL,
  `contactNum` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `salary` double(8,2) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`adminID`, `password`, `name`, `roleID`, `contactNum`, `email`, `salary`, `username`) VALUES
(2, 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'TFY', 1, '0167149488', 'shinktee34@gmail.com', 2000.00, 'admin'),
(3, '17521ce56ddee9351ca4c760173661e3cd2693161baacf7e5bfbdd09847105ba5670379431e5235bcb879a8f4640661d89fe94062b7d46bcec66f623af5fb026', 'SL', 2, '0167149488', 'shinewqeqktee34@gmail.com', 3000.00, 'admin22');

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `categoryID` int(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `categoryName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`categoryID`, `description`, `categoryName`) VALUES
(1, 'small portion of food generally eaten between meals', 'snack'),
(2, 'mass-produced food designed for commercial resale, with a strong priority placed on speed of service', 'fast food'),
(3, 'food or drink that stimulates the appetite and is usually served before a meal', 'appetizer');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_table`
--

CREATE TABLE `feedback_table` (
  `feedbackID` int(20) NOT NULL,
  `userID` int(20) NOT NULL,
  `contactNum` varchar(15) NOT NULL,
  `content` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail_table`
--

CREATE TABLE `orderdetail_table` (
  `orderDetailID` int(20) NOT NULL,
  `productID` int(20) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` double(8,2) NOT NULL,
  `totalPrice` double(8,2) NOT NULL,
  `orderID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `orderID` int(20) NOT NULL,
  `orderDate` date NOT NULL,
  `orderStatus` varchar(20) NOT NULL,
  `grandTotalPrice` double(8,2) NOT NULL,
  `userID` int(20) NOT NULL,
  `payment` varchar(20) NOT NULL,
  `address` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products_table`
--

CREATE TABLE `products_table` (
  `productID` int(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `categoryID` int(20) NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `image` longblob DEFAULT NULL,
  `extension` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role_table`
--

CREATE TABLE `role_table` (
  `roleID` int(20) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_table`
--

INSERT INTO `role_table` (`roleID`, `role`) VALUES
(1, 'staff'),
(2, 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `userID` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contactNum` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `verified` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`userID`, `username`, `password`, `email`, `contactNum`, `gender`, `address`, `name`, `verified`) VALUES
(4, 'client', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', 'shinktee34@gmail.com', '016-7149488', 'female', 'wqe', 'client', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`adminID`),
  ADD KEY `roleID` (`roleID`);

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `feedback_table`
--
ALTER TABLE `feedback_table`
  ADD PRIMARY KEY (`feedbackID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `orderdetail_table`
--
ALTER TABLE `orderdetail_table`
  ADD PRIMARY KEY (`orderDetailID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `products_table`
--
ALTER TABLE `products_table`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `role_table`
--
ALTER TABLE `role_table`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `adminID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `categoryID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback_table`
--
ALTER TABLE `feedback_table`
  MODIFY `feedbackID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderdetail_table`
--
ALTER TABLE `orderdetail_table`
  MODIFY `orderDetailID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `orderID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_table`
--
ALTER TABLE `products_table`
  MODIFY `productID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `role_table`
--
ALTER TABLE `role_table`
  MODIFY `roleID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `userID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD CONSTRAINT `admin_table_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `role_table` (`roleID`);

--
-- Constraints for table `feedback_table`
--
ALTER TABLE `feedback_table`
  ADD CONSTRAINT `feedback_table_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user_table` (`userID`);

--
-- Constraints for table `orderdetail_table`
--
ALTER TABLE `orderdetail_table`
  ADD CONSTRAINT `orderdetail_table_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `order_table` (`orderID`),
  ADD CONSTRAINT `orderdetail_table_ibfk_3` FOREIGN KEY (`productID`) REFERENCES `products_table` (`productID`);

--
-- Constraints for table `products_table`
--
ALTER TABLE `products_table`
  ADD CONSTRAINT `products_table_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category_table` (`categoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
