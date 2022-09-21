-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 12, 2022 at 04:31 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `PizzaDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `ACCOUNT`
--

CREATE TABLE `ACCOUNT` (
  `UserName` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `AccountType` int(11) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ACCOUNT`
--

INSERT INTO `ACCOUNT` (`UserName`, `Password`, `AccountType`, `Status`) VALUES
('admin', '123456', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ORDER`
--

CREATE TABLE `ORDER` (
  `OrderID` int(11) NOT NULL,
  `CustomerName` varchar(30) NOT NULL,
  `Phone` varchar(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `CreatedTime` datetime NOT NULL,
  `Status` varchar(10) NOT NULL,
  `ModifiedTime` datetime NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` float NOT NULL,
  `Amount` float NOT NULL,
  `Note` varchar(100) NOT NULL,
  `RegisterCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ORDER`
--

INSERT INTO `ORDER` (`OrderID`, `CustomerName`, `Phone`, `Address`, `CreatedTime`, `Status`, `ModifiedTime`, `ProductID`, `Quantity`, `Amount`, `Note`, `RegisterCode`) VALUES
(1, 'Nguyễn Văn A', '0912123123', '134 Nguyễn Thị Thập, Quận 7, Hồ Chí Minh', '2022-07-22 08:00:00', 'HOANTAT', '2022-07-22 08:00:00', 1, 2, 300000, 'Không cay', '83591356'),
(2, 'Nguyễn Hải Nam', '091341345', '123 Nguyễn Thị Thập, Quận 7, Hồ Chí Minh', '2022-08-10 14:44:34', 'HUY', '2022-08-10 15:44:34', 1, 2, 300000, ' nước ngọt Pepsi', '4853112940');

-- --------------------------------------------------------

--
-- Table structure for table `PIZZA`
--

CREATE TABLE `PIZZA` (
  `ProductID` int(11) NOT NULL,
  `ComboName` varchar(80) NOT NULL,
  `Description` varchar(80) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PIZZA`
--

INSERT INTO `PIZZA` (`ProductID`, `ComboName`, `Description`, `Price`) VALUES
(1, 'Combo 2 Pizza hải sản size vừa 6 miếng và nước uống', '', 150000),
(2, 'Combo 3 Pizza hải sản size vừa 6 miếng và nước uống', '', 200000),
(3, 'Combo 2 Pizza phô mai size vừa 6 miếng và nước uống', '', 180000),
(4, 'Combo 3 Pizza phô mai size vừa 6 miếng và nước uống', '', 240000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ORDER`
--
ALTER TABLE `ORDER`
  ADD PRIMARY KEY (`OrderID`),
  ADD UNIQUE KEY `RegisterCode` (`RegisterCode`);

--
-- Indexes for table `PIZZA`
--
ALTER TABLE `PIZZA`
  ADD PRIMARY KEY (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ORDER`
--
ALTER TABLE `ORDER`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `PIZZA`
--
ALTER TABLE `PIZZA`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
