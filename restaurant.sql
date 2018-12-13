-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2018 at 05:05 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--
CREATE DATABASE IF NOT EXISTS `restaurant` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `restaurant`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(1000) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `pass`, `status`) VALUES
(1, 'admin', 'd56b699830e77ba53855679cb1d252da', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `feed_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feed_id` int(10) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feed_id`, `restaurant_id`, `user_id`, `feedback`, `date`) VALUES
(1, 4, 4, 'boleto gazab!', '2018-12-09 00:13:30'),
(2, 4, 4, 'boleto gazab!', '2018-12-09 00:16:07'),
(3, 4, 4, 'keher \r\n\r\nand \r\n\r\nkiller', '2018-12-09 00:16:27'),
(4, 4, 4, 'oye hoye', '2018-12-10 22:51:39'),
(5, 3, 6, 'tabadtod', '2018-12-10 23:22:10');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `restaurant_id`, `user_id`, `rating`) VALUES
(2, 1, 11, 3),
(3, 4, 12, 3),
(4, 4, 1, 3),
(12, 3, 1, 3),
(13, 2, 1, 2),
(14, 1, 1, 4),
(15, 4, 2, 1),
(16, 3, 2, 1),
(17, 2, 2, 1),
(18, 1, 2, 1),
(19, 2, 3, 3),
(20, 1, 4, 4),
(21, 2, 4, 5),
(22, 4, 4, 5),
(23, 3, 4, 5),
(24, 3, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `restaurant_name` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `opening_hr` varchar(10) NOT NULL,
  `closing_hr` varchar(10) NOT NULL,
  `img_path` varchar(100) NOT NULL,
  `reg_date` datetime NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `restaurant_name`, `city`, `address`, `pincode`, `description`, `opening_hr`, `closing_hr`, `img_path`, `reg_date`, `status`) VALUES
(1, ' MARIO', 'Raipur', 'Shop No. 4, Multi-Function Complex, Platform No. 1, Near Reservation Counter, Railway Station, Chhattisgarh ', '492001', 'Night hunger than must visit mario awesome taste .. speciallly that  all sandwiches....quite costly bt taste worthy.....they are increasing their price ay by day', '1 AM', '11 PM', '1539976095.jpg', '2018-10-20 00:38:15', 'on'),
(2, ' Girnar Restaurant', 'Raipur', 'Jaistambh GE Road, Raipur, Chhattisgarh ', '492001', 'Open since 1971, a standard Indian and Chinese restaurant with a function room also offering thalis', '1 AM', '6 PM', '1539976150.jpeg', '2018-10-20 00:39:10', 'on'),
(3, ' Manju Mamta Restaurant', 'Raipur', 'Mahatma Gandhi Road, Jawahar Nagar, Raipur, Chhattisgarh ', '492001', 'Manju mamta is among the oldest and the best fast food joints.. still maintaining its old charm.. Try Chhole Bhature, Hot Coffee, Pav Bhaji and Dosas among several other things.. ... Manju mamta is one of the oldest hotel in raipur serving south n north indian dishes.', '8 AM', '10 PM', '1539976226.jpg', '2018-10-20 00:40:26', 'on'),
(4, ' Barbeque Nation', 'Raipur ', 'Unit Shop 02-03, 2nd Floor, Magneto The Mall, GE Rd, Labhandi', '492001', 'Open since 1971, a standard Indian and Chinese restaurant with a function room also offering thalis.', '12 AM', '12 PM', '1539976372.jpg', '2018-10-20 00:42:52', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mob` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `doc` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `gender`, `dob`, `email`, `mob`, `pass`, `doc`, `date`, `status`) VALUES
(1, 'user', 'male', '2018-12-31', 'user@gmail.com', '8109128856', 'bfd8b4d4727b703e0dd2967713968540', '', '0000-00-00 00:00:00', 'on'),
(2, 'shringiraj dewangan', 'male', '2018-01-01', 'shringiraj@gmail.com', '8109128856', 'bfd8b4d4727b703e0dd2967713968540', '', '0000-00-00 00:00:00', 'on'),
(3, 'anup', 'female', '2018-11-08', 'anup6510@gmail.com', '8109128856', 'bfd8b4d4727b703e0dd2967713968540', '', '0000-00-00 00:00:00', 'on'),
(4, 'aditya', 'male', '2018-12-31', 'ashtikar.aditya97@gmail.com', '8871877665', 'e80b5017098950fc58aad83c8c14978e', '', '0000-00-00 00:00:00', 'on'),
(6, 'chandresh', 'male', '2018-12-11', 'chandresh1497@gmail.com', '8982513104', 'e10adc3949ba59abbe56e057f20f883e', '', '2018-12-11 04:45:12', 'on');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`feed_id`),
  ADD UNIQUE KEY `feed_id` (`feed_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feed_id`),
  ADD UNIQUE KEY `feed_id` (`feed_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `feed_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feed_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
