-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2016 at 10:24 AM
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
-- Table structure for table `prestige_logs_membership_classes`
--

CREATE TABLE IF NOT EXISTS `prestige_logs_membership_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prestige_log_id` int(11) NOT NULL,
  `membership_class_id` int(11) NOT NULL,
  `officer_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=4 ;

--
-- Dumping data for table `prestige_logs_membership_classes`
--

INSERT INTO `prestige_logs_membership_classes` (`id`, `prestige_log_id`, `membership_class_id`, `officer_id`, `created`, `updated`) VALUES
(1, 1, 1, 0, '2016-02-25 00:49:22', '2016-02-25 00:49:22'),
(3, 1, 2, NULL, '2016-03-02 09:09:04', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
