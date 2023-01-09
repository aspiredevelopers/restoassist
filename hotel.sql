-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 09, 2023 at 05:25 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_desgs`
--

DROP TABLE IF EXISTS `tbl_desgs`;
CREATE TABLE IF NOT EXISTS `tbl_desgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desg` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_desgs`
--

INSERT INTO `tbl_desgs` (`id`, `desg`) VALUES
(1, 'Waiter'),
(2, 'Cashier');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

DROP TABLE IF EXISTS `tbl_items`;
CREATE TABLE IF NOT EXISTS `tbl_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `price` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`id`, `title`, `price`) VALUES
(2, 'Parotta', '10'),
(3, 'Chappathi', '12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

DROP TABLE IF EXISTS `tbl_orders`;
CREATE TABLE IF NOT EXISTS `tbl_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `place` text NOT NULL,
  `order_table` text NOT NULL,
  `subtotal` float NOT NULL,
  `discount` float NOT NULL,
  `grandtotal` float NOT NULL,
  `date` date NOT NULL,
  `staff` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `name`, `phone`, `place`, `order_table`, `subtotal`, `discount`, `grandtotal`, `date`, `staff`) VALUES
(2, 'Muhammed Aslam', '9526960627', '', 'Table 1', 80, 5, 75, '2023-01-09', 'aslamvrtly');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

DROP TABLE IF EXISTS `tbl_order_details`;
CREATE TABLE IF NOT EXISTS `tbl_order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` text NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staffs`
--

DROP TABLE IF EXISTS `tbl_staffs`;
CREATE TABLE IF NOT EXISTS `tbl_staffs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` text NOT NULL,
  `img` text NOT NULL,
  `name` text NOT NULL,
  `desg` text NOT NULL,
  `phone` text NOT NULL,
  `mail` text NOT NULL,
  `dob` text NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `user_type` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_staffs`
--

INSERT INTO `tbl_staffs` (`id`, `staff_id`, `img`, `name`, `desg`, `phone`, `mail`, `dob`, `user`, `pass`, `user_type`, `date`) VALUES
(2, 'RA-0056', 'Muhammed Aslam1pexels-pixabay-262047.jpg', 'Muhammed Aslam1', 'Cashier', '95269606271', 'aslam@trickydot.com1', '2022-12-15', 'aslamvrtly', '8d23cf6c86e834a7aa6eded54c26ce2bb2e74903538c61bdd5d2197997ab2f72', 'staff', '2023-01-09 20:15:50'),
(3, '', '', 'Admin', '', '', '', '', 'admin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'admin', '2023-01-09 20:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tables`
--

DROP TABLE IF EXISTS `tbl_tables`;
CREATE TABLE IF NOT EXISTS `tbl_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `seats` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tables`
--

INSERT INTO `tbl_tables` (`id`, `title`, `seats`) VALUES
(3, 'Table 1', 6),
(4, 'Table 2', 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
