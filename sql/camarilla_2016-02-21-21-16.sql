-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2016 at 06:15 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `camarilla`
--

-- --------------------------------------------------------

--
-- Table structure for table `membership_classes_roles`
--

CREATE TABLE IF NOT EXISTS `membership_classes_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_class_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=17 ;

--
-- Dumping data for table `membership_classes_roles`
--

INSERT INTO `membership_classes_roles` (`id`, `membership_class_id`, `role_id`, `created`, `modified`) VALUES
(3, 1, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 3, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 4, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 5, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 6, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 7, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 8, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 9, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 10, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 11, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 12, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 13, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 14, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
