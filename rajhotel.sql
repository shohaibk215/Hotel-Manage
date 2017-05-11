-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2017 at 11:55 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rajhotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(20) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `admin_name`, `admin_email`, `role`, `password`) VALUES
(1, 'admin', 'sabah@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'receptionist', 'receptionist@gmail.com', 'receptionist', 'e84d0dd71e85bfb91c530086572c638c');

-- --------------------------------------------------------

--
-- Table structure for table `foodorders`
--

CREATE TABLE `foodorders` (
  `id` int(11) NOT NULL,
  `ReservationID` varchar(200) DEFAULT NULL,
  `FoodID` varchar(200) DEFAULT NULL,
  `quantity` varchar(200) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foodorders`
--

INSERT INTO `foodorders` (`id`, `ReservationID`, `FoodID`, `quantity`, `price`, `datetime`) VALUES
(1, '1', '6', '1', 7, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `price` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `price`, `status`) VALUES
(1, 'Biryani', '5', '1'),
(3, 'Burger', '6', '1'),
(4, 'Apple Pie', '3', '1'),
(5, 'Spaghetti ', '9', '1'),
(6, 'Pasta', '7', '1'),
(7, 'Noodles', '5', '1');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telephone` varchar(200) NOT NULL,
  `number_people` varchar(200) NOT NULL,
  `roomid` varchar(200) NOT NULL,
  `card_details` varchar(500) NOT NULL,
  `checkin_date` varchar(200) NOT NULL,
  `checkout_date` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL,
  `history` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `name`, `address`, `email`, `telephone`, `number_people`, `roomid`, `card_details`, `checkin_date`, `checkout_date`, `status`, `history`) VALUES
(1, 'asdfas', 'asfas', 'asdfas@mail.com', '124325', '2', '1', '12432', '2017-05-02', '2017-05-04', '2', '0'),
(2, 'asfas', 'flat 7, longley road', 'lol@mail.com', '123214', '1', '11', '123124', '2017-05-02', '2017-05-25', '2', '0'),
(3, 'New Guest', 'new guest at guest lane', 'guest@mail.com', '1892', '2', '1', '124325', '2017-05-10', '2017-05-20', '1', '0'),
(4, 'random', 'tets at test street', 'test@email.com', '058569', '3', '1', '12432', '2017-04-03', '2017-04-05', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(200) NOT NULL,
  `room_number` varchar(200) NOT NULL,
  `category_id` int(200) NOT NULL,
  `capacity` varchar(200) NOT NULL,
  `bed` varchar(200) NOT NULL,
  `availability` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `category_id`, `capacity`, `bed`, `availability`) VALUES
(1, '400', 2, '3', 'single', 'no'),
(2, '450', 1, '4', 'double', 'no'),
(11, '123', 1, '1', 'single', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `room_categories`
--

CREATE TABLE `room_categories` (
  `id` int(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_categories`
--

INSERT INTO `room_categories` (`id`, `category`, `price`) VALUES
(1, 'Bussiness', 100),
(2, 'Economy', 200);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(200) NOT NULL,
  `reservation_id` int(200) NOT NULL,
  `total_amount` varchar(200) NOT NULL,
  `PaidAmount` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `reservation_id`, `total_amount`, `PaidAmount`, `datetime`) VALUES
(1, 1, '400', 100, '2017-05-02 02:19:59'),
(2, 2, '2300', 100, '2017-05-02 02:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `role_id` int(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `role_id`, `email`, `password`) VALUES
(1, 'sabah', 'sabah', 'din', 1, 'abc@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'recep', 'receptionist', 'randoom', 7, 'recep@gmail.com', 'f967eb4edcf249db60cb0353f00999a6');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(200) NOT NULL,
  `role` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'manager'),
(6, 'test'),
(7, 'receptionist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foodorders`
--
ALTER TABLE `foodorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_categories`
--
ALTER TABLE `room_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `foodorders`
--
ALTER TABLE `foodorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `room_categories`
--
ALTER TABLE `room_categories`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
