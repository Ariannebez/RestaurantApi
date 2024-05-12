-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 12, 2024 at 06:24 PM
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
(71, 83, 'triq l mostaa', 2),
(74, 23, 'Triq vestru', 2),
(76, 8, 'triq triq triq triq', 2),
(77, 83, 'triq l xemx', 2),
(78, 8, 'triq triq triq triq', 2),
(79, 83, 'triq l juventus', 10),
(97, 83, 'Triq San Gorg', 5),
(100, 23, 'Triq l Gnien', 10);

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `tableNo` int(11) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `tableNo`, `location`) VALUES
(1, 1, 'Inside'),
(2, 11, 'Outside'),
(3, 2, 'Inside'),
(4, 3, 'Inside'),
(5, 4, 'Inside'),
(6, 5, 'Inside'),
(8, 24, 'insideeeee');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `numberOfpeople` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `userId` int(11) NOT NULL,
  `bookingIdStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `numberOfpeople`, `date`, `time`, `userId`, `bookingIdStatus`) VALUES
(3, 2, '2024-04-30', '21:00:00', 20, 3),
(4, 4, '2024-04-30', '14:20:30', 20, 3),
(15, 20, '2024-04-30', '20:00:00', 20, 3),
(16, 20, '2024-04-30', '20:00:00', 20, 3),
(17, 20, '2024-04-30', '20:00:00', 20, 3),
(21, 2000, '2024-04-30', '20:00:00', 20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bookingNote`
--

CREATE TABLE `bookingNote` (
  `id` int(11) NOT NULL,
  `note` varchar(200) NOT NULL,
  `bookingId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookingNote`
--

INSERT INTO `bookingNote` (`id`, `note`, `bookingId`) VALUES
(1, 'We need one bad high chair pls', 3),
(7, 'work work work', 15),
(8, '2 are kids so we will need the kids menu', 16),
(13, 'Work party', 21);

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
(3, 'Declined'),
(4, 'Booked No space');

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
(4, 'Malta'),
(5, 'Italy');

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

--
-- Dumping data for table `dailySpecial`
--

INSERT INTO `dailySpecial` (`id`, `img`, `item`, `des`, `price`, `categoryId`) VALUES
(1, 'includes/img/duck', 'duck', 'sdvfdfgbf', 23, 8);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `des` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `img`, `des`) VALUES
(1, 'includes/img/pizza.png', 'This is a pizza'),
(2, 'includes/img/meat.png', 'This is a meat plant');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `des` varchar(200) NOT NULL,
  `price` float(10,0) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `des`, `price`, `categoryId`) VALUES
(1, 'Bruschetta', '4, Tomato bruschetta with onions', 4, 1),
(3, 'Chicken pasta', 'Chicken, mushrooms, grail in white sauce', 8, 2),
(4, 'Rid eye', 'Rid eyeeeeee served with chips paper or mushroom suce', 23, 3),
(6, 'Beef pastaaaaaaaa', 'this pasta has beef', 8, 2);

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
(7, 'Drinks'),
(8, 'duck');

-- --------------------------------------------------------

--
-- Table structure for table `resLocation`
--

CREATE TABLE `resLocation` (
  `id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resLocation`
--

INSERT INTO `resLocation` (`id`, `address`) VALUES
(1, 'Triq Marsalforn l port');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `des` varchar(100) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `des`, `userId`) VALUES
(2, 'The food is good but the waiter was not so nice', 27),
(3, 'The food was amazing, and a nice location', 23),
(5, 'The food was amazing', 25);

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
(2, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `table`
--

CREATE TABLE `table` (
  `id` int(11) NOT NULL,
  `bookingStatusId` int(11) NOT NULL,
  `areaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table`
--

INSERT INTO `table` (`id`, `bookingStatusId`, `areaId`) VALUES
(1, 1, 2),
(2, 1, 3),
(4, 2, 4);

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

--
-- Dumping data for table `tableStatus`
--

INSERT INTO `tableStatus` (`id`, `status`, `tableNo`, `tableId`) VALUES
(1, 'Booked', 1, 1),
(3, 'not booked', 2, 2);

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
(2, 'Xaghra', 1),
(5, 'Rabat', 1),
(7, 'Mosta', 4),
(8, 'Rome', 5),
(9, 'Qala', 1),
(10, 'Nadur', 1),
(11, 'Xewkija', 1);

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
(20, 'amy@hotmail.ccom', '$2y$10$OTJbrCHfhZOe74F9joXiB.ed8PsXKrIrwS8CmKoC2EnPU/zmPJu5W', 'Amy', 'galea', '2006-11-09', 71, 2),
(23, 'maya@hotmail.ccom', '$2y$10$HSgstscPzzzLEzYGo6I33.32fDvv6ctK3dqz/3oukQpGhyO1w.dwq', 'maya', 'bezzina', '2001-07-09', 74, 1),
(24, 'creatingStaff@gmailcom', 'creatingStaff01', 'Staff01', 'Staff', '2013-03-04', 76, 2),
(25, 'mar@hotmail.ccom', '$2y$10$wQA9DJHMoRHdahh/sAXQtOwqYP1mToPG6HLuVkSTe1UrzNK9D.OwC', 'Maria', 'Galea', '1998-07-09', 77, 1),
(26, 'creatingStaff@gmailcom', '$2y$10$cC5/mqnVFQkFdEg1.cEy/.u198C/YaxRdRmooIocj38QwKqhyAio.', 'Staff01', 'Staff', '2013-03-04', 78, 2),
(27, 'markUpdate@hotmail.ccom', '$2y$10$Q20ZYJH.7OQH2T8Joj9uAup5RaKxMzFDwnx8ypxBAEaFKIRyxXJRK', 'Mark', 'Vella', '2003-03-04', 79, 1),
(37, 'markho@tmail.com', '$2y$10$MXxEH76AnQd0g7gix4Tr.OIL6EmLOMY88sdws7EPu9mSGDpzP.bWG', ' ', 'Galea', '2001-04-01', 97, 1),
(38, 'ella@gmail.com', '$2y$10$lediBLlyUWe8lbJoRDDN7u8mnUCNluUDspHTLgunBUG6g/k3sIulC', 'Ella', 'Galea', '2001-04-01', 100, 1);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `tableNo` (`tableNo`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`);

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
  ADD KEY `addressId` (`address`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `areaId` (`areaId`),
  ADD KEY `status` (`bookingStatusId`);

--
-- Indexes for table `tableStatus`
--
ALTER TABLE `tableStatus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tableId` (`tableId`),
  ADD KEY `tablestatus_ibfk_1` (`tableNo`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bookingNote`
--
ALTER TABLE `bookingNote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bookingStatus`
--
ALTER TABLE `bookingStatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dailySpecial`
--
ALTER TABLE `dailySpecial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menuCategory`
--
ALTER TABLE `menuCategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `resLocation`
--
ALTER TABLE `resLocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `table`
--
ALTER TABLE `table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tableStatus`
--
ALTER TABLE `tableStatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `town`
--
ALTER TABLE `town`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  ADD CONSTRAINT `UserBooking` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookingNote`
--
ALTER TABLE `bookingNote`
  ADD CONSTRAINT `Note` FOREIGN KEY (`bookingId`) REFERENCES `booking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dailySpecial`
--
ALTER TABLE `dailySpecial`
  ADD CONSTRAINT `dailyspecial_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `menuCategory` (`id`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `status` FOREIGN KEY (`bookingStatusId`) REFERENCES `bookingStatus` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tableStatus`
--
ALTER TABLE `tableStatus`
  ADD CONSTRAINT `tablestatus_ibfk_1` FOREIGN KEY (`tableNo`) REFERENCES `area` (`tableNo`),
  ADD CONSTRAINT `tablestatus_ibfk_2` FOREIGN KEY (`tableId`) REFERENCES `table` (`id`);

--
-- Constraints for table `town`
--
ALTER TABLE `town`
  ADD CONSTRAINT `town_ibfk_1` FOREIGN KEY (`countryId`) REFERENCES `country` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Address` FOREIGN KEY (`addressId`) REFERENCES `address` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Role` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
