-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 17, 2024 at 11:30 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurantApi`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `doorNo` int(11) NOT NULL,
  `street` varchar(100) NOT NULL,
  `townId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `doorNo`, `street`, `townId`) VALUES
(68, 22, 'Triq vestru', 2),
(69, 8, 'triq triq triq triq', 2);

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `tableNo` int(11) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `numberOfpeople` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` datetime NOT NULL,
  `userId` int(11) NOT NULL,
  `bookingIdStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bookingNote`
--

CREATE TABLE `bookingNote` (
  `id` int(11) NOT NULL,
  `note` varchar(200) NOT NULL,
  `bookingId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bookingStatus`
--

CREATE TABLE `bookingStatus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookingStatus`
--

INSERT INTO `bookingStatus` (`id`, `name`) VALUES
(1, 'Approved'),
(2, 'Pending'),
(3, 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Gozo'),
(2, 'Malta');

-- --------------------------------------------------------

--
-- Table structure for table `dailySpecial`
--

CREATE TABLE `dailySpecial` (
  `id` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `item` varchar(100) NOT NULL,
  `des` varchar(200) NOT NULL,
  `price` float(10,0) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `des` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `des` int(11) NOT NULL,
  `price` float(10,0) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menuCategory`
--

CREATE TABLE `menuCategory` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menuCategory`
--

INSERT INTO `menuCategory` (`id`, `category`) VALUES
(1, 'starters'),
(2, 'pasta '),
(3, 'meat dishes'),
(4, 'fish dishes'),
(5, 'kids menu'),
(6, 'Desserts'),
(7, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `resLocation`
--

CREATE TABLE `resLocation` (
  `id` int(11) NOT NULL,
  `addressId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'user'),
(2, 'worker');

-- --------------------------------------------------------

--
-- Table structure for table `table`
--

CREATE TABLE `table` (
  `id` int(11) NOT NULL,
  `bookingStatusId` int(11) NOT NULL,
  `areaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tableStatus`
--

CREATE TABLE `tableStatus` (
  `id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `tableNo` int(11) NOT NULL,
  `tableId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `town`
--

CREATE TABLE `town` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `countryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `town`
--

INSERT INTO `town` (`id`, `name`, `countryId`) VALUES
(1, 'Mosta', 2),
(2, 'Xaghra', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `addressId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `surname`, `dob`, `addressId`, `roleId`) VALUES
(18, 'creating1stClient@gmailcom', 'client01', 'Maria', 'Galea', '2013-03-04', 68, 1),
(19, 'creatingStaff@gmailcom', 'creatingStaff01', 'Staff01', 'Staff', '2013-03-04', 69, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `townId` (`townId`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookingIdStatus` (`bookingIdStatus`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `bookingNote`
--
ALTER TABLE `bookingNote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookingId` (`bookingId`);

--
-- Indexes for table `bookingStatus`
--
ALTER TABLE `bookingStatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailySpecial`
--
ALTER TABLE `dailySpecial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Category` (`categoryId`);

--
-- Indexes for table `menuCategory`
--
ALTER TABLE `menuCategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resLocation`
--
ALTER TABLE `resLocation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addressId` (`addressId`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table`
--
ALTER TABLE `table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areaId` (`areaId`);

--
-- Indexes for table `tableStatus`
--
ALTER TABLE `tableStatus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tableId` (`tableId`);

--
-- Indexes for table `town`
--
ALTER TABLE `town`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countryId` (`countryId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addressId` (`addressId`),
  ADD KEY `roleId` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookingNote`
--
ALTER TABLE `bookingNote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookingStatus`
--
ALTER TABLE `bookingStatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dailySpecial`
--
ALTER TABLE `dailySpecial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menuCategory`
--
ALTER TABLE `menuCategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resLocation`
--
ALTER TABLE `resLocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `table`
--
ALTER TABLE `table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tableStatus`
--
ALTER TABLE `tableStatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `town`
--
ALTER TABLE `town`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `Town` FOREIGN KEY (`townId`) REFERENCES `town` (`id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `BookingStatus` FOREIGN KEY (`bookingIdStatus`) REFERENCES `bookingStatus` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `UserBooking` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `bookingNote`
--
ALTER TABLE `bookingNote`
  ADD CONSTRAINT `Note` FOREIGN KEY (`bookingId`) REFERENCES `booking` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `Category` FOREIGN KEY (`categoryId`) REFERENCES `menuCategory` (`id`);

--
-- Constraints for table `table`
--
ALTER TABLE `table`
  ADD CONSTRAINT `Area` FOREIGN KEY (`areaId`) REFERENCES `area` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `status` FOREIGN KEY (`id`) REFERENCES `tableStatus` (`tableId`);

--
-- Constraints for table `town`
--
ALTER TABLE `town`
  ADD CONSTRAINT `Country` FOREIGN KEY (`countryId`) REFERENCES `country` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Address` FOREIGN KEY (`addressId`) REFERENCES `address` (`id`),
  ADD CONSTRAINT `Role` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
