-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2014 at 02:02 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hazu_pecani`
--

-- --------------------------------------------------------

--
-- Table structure for table `acme_users`
--

CREATE TABLE IF NOT EXISTS `acme_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_55884A7F85E0677` (`username`),
  UNIQUE KEY `UNIQ_55884A7E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mk_category`
--

CREATE TABLE IF NOT EXISTS `mk_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mk_category`
--

INSERT INTO `mk_category` (`id`, `name`) VALUES
(1, 'Áo Khoác Nữ'),
(2, 'Đầm ngủ nữ'),
(3, 'Giày Dép'),
(4, 'Áo Khoác nam'),
(5, 'đầm đẹp 222222'),
(6, 'đầm đẹp');

-- --------------------------------------------------------

--
-- Table structure for table `mk_language`
--

CREATE TABLE IF NOT EXISTS `mk_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `excerpt` longtext COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_default_frontend` tinyint(1) NOT NULL,
  `is_default_backend` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mk_language`
--

INSERT INTO `mk_language` (`id`, `excerpt`, `content`, `is_default_frontend`, `is_default_backend`) VALUES
(1, 'viet nam', 'vi', 0, 0),
(2, 'english', 'en', 0, 0),
(3, 'franch', 'fr', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mk_product`
--

CREATE TABLE IF NOT EXISTS `mk_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `excerpt` longtext COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `discount` double NOT NULL,
  `old_price` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DB85C27612469DE2` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `mk_product`
--

INSERT INTO `mk_product` (`id`, `excerpt`, `content`, `price`, `discount`, `old_price`, `title`, `image`, `category_id`) VALUES
(17, 'Đầm Ngủ Ren Lưng TÍM', 'Đầm Ngủ Ren Lưng TÍM', 75000, 0, 199, 'Đầm Ngủ Ren Lưng TÍM', '545a6e39a2bd2.JPG', 2),
(19, 'Áo khoác Dù NAM 2 mặt cao cấp', 'Áo khoác Dù NAM 2 mặt cao cấp', 300000, 12, 471, 'Áo khoác Dù NAM 2 mặt cao cấp', '545a6dabc56fe.JPG', 4),
(20, 'fdsfa', 'da', 160000, 12, 121212, 'asdfasdf', '545a6a9a40add.jpg', 4),
(21, 'Đầm Ngủ Lưới Đen Phối Ren Đỏ', 'Đầm Ngủ Lưới Đen Phối Ren Đỏ', 125000, 0, 125000, 'Đầm Ngủ Lưới Đen Phối Ren Đỏ', '545a6e5fe7709.JPG', 2),
(22, 'GIÀY CAO GÓT HAZU NHUNG MŨI NHỌN', 'GIÀY CAO GÓT HAZU NHUNG MŨI NHỌN', 360000, 0, 360000, 'GIÀY CAO GÓT HAZU NHUNG MŨI NHỌN', '545a6e8ce195d.JPG', 3),
(23, 'GIÀY ĐẾ THẤP HAZU KIM TUYẾN', 'GIÀY ĐẾ THẤP HAZU KIM TUYẾN', 320000, 0, 320000, 'GIÀY ĐẾ THẤP HAZU KIM TUYẾN', '545a6eb7e3d0c.JPG', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mk_product_color`
--

CREATE TABLE IF NOT EXISTS `mk_product_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `string` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mk_product_color`
--

INSERT INTO `mk_product_color` (`id`, `string`, `color`) VALUES
(2, 'Xanh Dương', '#8d3b3b'),
(4, 'Đen', '#000000'),
(5, 'Đỏ', '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `mk_product_product_color`
--

CREATE TABLE IF NOT EXISTS `mk_product_product_color` (
  `product_id` int(11) NOT NULL,
  `productcolor_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`productcolor_id`),
  KEY `IDX_D356FD904584665A` (`product_id`),
  KEY `IDX_D356FD90DF4BE578` (`productcolor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mk_product_product_color`
--

INSERT INTO `mk_product_product_color` (`product_id`, `productcolor_id`) VALUES
(17, 5),
(19, 4),
(20, 2),
(20, 5),
(21, 5),
(22, 4),
(23, 5);

-- --------------------------------------------------------

--
-- Table structure for table `mk_users`
--

CREATE TABLE IF NOT EXISTS `mk_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_supper_admin` tinyint(1) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_88049ACAF85E0677` (`username`),
  UNIQUE KEY `UNIQ_88049ACAE7927C74` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mk_users`
--

INSERT INTO `mk_users` (`id`, `username`, `password`, `email`, `is_active`, `salt`, `is_supper_admin`, `is_admin`, `first_name`, `last_name`) VALUES
(5, 'admin', '5603221e07f010c62dbd04efc25bcce2f895a61f', 'admin@admin.com', 1, '041c09398e83d40af430f1e8b9b188a6', 1, NULL, 'ab', 'cd');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mk_product`
--
ALTER TABLE `mk_product`
  ADD CONSTRAINT `FK_DB85C27612469DE2` FOREIGN KEY (`category_id`) REFERENCES `mk_category` (`id`);

--
-- Constraints for table `mk_product_product_color`
--
ALTER TABLE `mk_product_product_color`
  ADD CONSTRAINT `FK_D356FD904584665A` FOREIGN KEY (`product_id`) REFERENCES `mk_product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D356FD90DF4BE578` FOREIGN KEY (`productcolor_id`) REFERENCES `mk_product_color` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
