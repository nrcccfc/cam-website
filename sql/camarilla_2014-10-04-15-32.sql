-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2014 at 09:31 PM
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
-- Table structure for table `affiliates`
--

CREATE TABLE IF NOT EXISTS `affiliates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `affiliates`
--

INSERT INTO `affiliates` (`id`, `name`, `abbreviation`, `description`, `created`, `modified`) VALUES
(1, 'Canada at Midnight', 'CaM', 'The Canadian Affiliate.', '2014-09-19 00:55:31', '2014-09-25 21:07:22'),
(2, 'The Mind''s Eye Society', 'MES', 'The United States Affiliate', '2014-09-19 01:00:49', '2014-09-19 01:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `title`, `body`, `created`, `modified`) VALUES
(1, NULL, 'The title', 'This is the article body.', '2014-09-11 18:52:49', NULL),
(2, NULL, 'A title once again', 'And the article body follows.', '2014-09-11 18:52:50', NULL),
(3, NULL, 'Title strikes back', 'This is really exciting! Not.', '2014-09-11 18:52:50', NULL),
(4, NULL, 'Another cool title', 'And a rock''n hot body to go with it!', '2014-09-12 00:04:09', '2014-09-12 00:04:09'),
(6, 1, 'A Title yet again', 'It really is', '2014-09-12 03:23:38', '2014-09-12 03:23:38');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `completed` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `member_id`, `role_id`, `domain_id`, `venue_id`, `created`, `modified`, `completed`) VALUES
(2, 33, 2, 6, NULL, '2014-09-21 19:45:38', '2014-09-25 21:09:04', '0000-00-00 00:00:00'),
(3, 33, 2, 6, 1, '2014-09-29 13:58:09', '2014-09-29 13:58:09', '0000-00-00 00:00:00'),
(4, 33, 1, 1, NULL, '2014-09-30 01:08:38', '2014-09-30 01:08:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `website_link` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_link` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isbn` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `publisher_id`, `game_id`, `name`, `description`, `website_link`, `image_link`, `isbn`, `created`, `modified`) VALUES
(1, 2, 5, 'Minds Eye Theatre : Vampire the Masquerade', 'Mind''s Eye Theatre: Vampire The Masquerade is a new edition of a classic game that draws on more than two decades'' worth of material from the iconic World of Darkness setting. The rules are designed and adapted specifically for the Live Action Roleplay environment, while maintaining the fidelity of the original game. Whether you''re a veteran player or discovering live-action roleplaying for the first time, this book contains everything you need to create and play a vampire character or create your own live-action chronicle.', 'rpg.drivethrustuff.com/product/123666/', 'http://rpg.drivethrustuff.com/images/5147/123666-thumb140.jpg', '3402938420', '2014-09-22 17:42:03', '2014-09-25 21:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `continuities`
--

CREATE TABLE IF NOT EXISTS `continuities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `continuities`
--

INSERT INTO `continuities` (`id`, `start_date`, `end_date`, `created`, `modified`) VALUES
(1, '2014-09-23', '2018-02-23', '2014-09-23 03:38:22', '2014-09-25 06:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `continuities_games`
--

CREATE TABLE IF NOT EXISTS `continuities_games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `continuity_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `continuities_games`
--

INSERT INTO `continuities_games` (`id`, `continuity_id`, `game_id`, `created`, `modified`) VALUES
(5, 1, 2, '2014-09-25 06:10:40', '2014-09-25 06:10:40'),
(6, 1, 3, '2014-09-25 06:10:40', '2014-09-25 06:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE IF NOT EXISTS `domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `domain_type_id` int(11) DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `parent_id`, `lft`, `rght`, `domain_type_id`, `name`, `description`, `color`, `created`, `modified`) VALUES
(1, NULL, 1, 8, 1, 'Prime', 'This is the prime domain. All national domains will have this domain as a DomainType.', '', '2014-09-20 06:25:33', '2014-09-20 06:25:33'),
(5, 1, 2, 7, 2, 'Canada', 'This is the Canadian National Domain!', '#440088', '2014-09-21 03:22:38', '2014-09-21 04:01:00'),
(6, 5, 3, 4, 3, 'Montreal', 'This is the D15 Domain.', '#FF8800', '2014-09-21 03:31:17', '2014-09-25 21:14:36'),
(7, 5, 5, 6, 3, 'Vancouver', 'The Vancouver Domain', '#8800FF', '2014-09-21 03:39:02', '2014-09-21 03:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `domain_types`
--

CREATE TABLE IF NOT EXISTS `domain_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) NOT NULL,
  `rght` int(10) NOT NULL,
  `affiliate_id` int(11) DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `allow_members` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `domain_types`
--

INSERT INTO `domain_types` (`id`, `parent_id`, `lft`, `rght`, `affiliate_id`, `name`, `abbreviation`, `allow_members`, `created`, `modified`) VALUES
(1, NULL, 1, 6, NULL, 'Prime', 'M', 0, '2014-09-20 06:52:03', '2014-09-20 06:52:03'),
(2, 1, 2, 5, 1, 'National', 'N', 0, '2014-09-20 06:52:13', '2014-09-20 16:42:39'),
(3, 2, 3, 4, 1, 'Local', 'D', 1, '2014-09-20 06:52:47', '2014-09-25 21:16:05'),
(4, 1, 0, 0, 2, 'National', 'N', 0, '2014-09-20 23:26:27', '2014-09-20 23:26:27'),
(5, 4, 0, 0, 2, 'Regional', 'R', 0, '2014-09-20 23:26:52', '2014-09-20 23:26:52'),
(6, 5, 0, 0, 2, 'Local', 'D', 1, '2014-09-20 23:27:08', '2014-09-20 23:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `parent_id`, `lft`, `rght`, `name`, `abbreviation`, `description`, `created`, `modified`) VALUES
(1, NULL, 1, 6, 'World of Darkness (Old)', 'OWoD', 'The original Storyteller Series', '2014-09-21 22:13:18', '2014-09-21 22:13:18'),
(2, 1, 4, 5, 'Vampire: The Masquerade', 'VtM', 'Well... they are vampires...', '2014-09-21 22:19:43', '2014-09-21 23:56:58'),
(3, 1, 2, 3, 'Werewolf: The Apocalypse', 'WtA', 'They have lots of hair', '2014-09-21 22:45:53', '2014-09-21 22:45:53'),
(4, NULL, 7, 10, 'Mind''s Eye Theatre', 'MET', 'A Vampire game by BNS', '2014-09-22 16:55:52', '2014-09-25 21:17:41'),
(5, 4, 8, 9, 'Vampire: The Masquerade', 'BNS:VtM', 'The New BNS Game', '2014-09-22 16:57:51', '2014-09-22 18:43:18'),
(6, NULL, 11, 12, 'Hong Kong Action Theater', 'HKAT', 'cause blowing up is fun', '2014-09-23 04:03:02', '2014-09-23 04:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email_temp` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_timestamp` timestamp NULL DEFAULT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `domain_id`, `username`, `password`, `first_name`, `last_name`, `email`, `email_temp`, `code`, `code_timestamp`, `role`, `is_active`, `created`, `modified`) VALUES
(33, 6, 'McGaiser', '$2y$10$b6gXNzPlOS2gDr.cJ.YYcupI76f1JuORtumViMfnhu4F.xka.G2Fu', 'Michael', 'Gaiser', 'mjgaiser@gmail.com', NULL, NULL, NULL, 'admin', 1, '2014-09-18 01:36:17', '2014-09-25 21:19:38');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=221 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `resource_id`, `created`, `modified`) VALUES
(8, 4, 4, '2014-09-28 06:09:24', '2014-09-28 06:09:24'),
(9, 4, 6, '2014-09-28 06:09:24', '2014-09-28 06:09:24'),
(11, 4, 76, '2014-09-28 06:09:24', '2014-09-28 06:09:24'),
(12, 4, 77, '2014-09-28 06:09:24', '2014-09-28 06:09:24'),
(25, 1, 2, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(26, 1, 4, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(29, 1, 8, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(30, 1, 9, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(31, 1, 10, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(32, 1, 11, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(33, 1, 12, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(34, 1, 13, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(35, 1, 14, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(36, 1, 15, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(37, 1, 16, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(38, 1, 17, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(39, 1, 18, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(40, 1, 19, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(41, 1, 20, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(43, 1, 22, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(44, 1, 23, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(45, 1, 24, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(46, 1, 25, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(47, 1, 26, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(48, 1, 27, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(49, 1, 28, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(50, 1, 29, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(51, 1, 30, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(52, 1, 31, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(53, 1, 32, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(54, 1, 33, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(55, 1, 34, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(56, 1, 35, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(57, 1, 36, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(58, 1, 37, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(59, 1, 38, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(60, 1, 39, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(61, 1, 40, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(62, 1, 41, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(63, 1, 42, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(64, 1, 43, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(65, 1, 44, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(66, 1, 45, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(67, 1, 46, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(68, 1, 47, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(69, 1, 48, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(70, 1, 49, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(71, 1, 50, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(72, 1, 51, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(73, 1, 52, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(74, 1, 53, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(75, 1, 54, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(76, 1, 55, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(77, 1, 56, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(78, 1, 57, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(79, 1, 58, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(80, 1, 59, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(81, 1, 60, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(82, 1, 61, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(83, 1, 62, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(84, 1, 63, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(85, 1, 64, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(86, 1, 65, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(87, 1, 66, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(88, 1, 67, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(89, 1, 68, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(90, 1, 69, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(91, 1, 72, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(92, 1, 73, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(93, 1, 74, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(94, 1, 75, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(95, 1, 76, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(96, 1, 77, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(97, 1, 78, '2014-09-28 23:30:32', '2014-09-28 23:30:32'),
(102, 2, 62, '2014-09-29 18:13:43', '2014-09-29 18:13:43'),
(103, 2, 63, '2014-09-29 18:13:43', '2014-09-29 18:13:43'),
(104, 2, 64, '2014-09-29 18:13:44', '2014-09-29 18:13:44'),
(105, 2, 65, '2014-09-29 18:13:44', '2014-09-29 18:13:44'),
(107, 2, 4, '2014-09-29 21:52:14', '2014-09-29 21:52:14'),
(108, 2, 6, '2014-09-29 21:52:14', '2014-09-29 21:52:14'),
(109, 2, 7, '2014-09-29 21:52:14', '2014-09-29 21:52:14'),
(164, 2, 66, '2014-09-29 21:52:14', '2014-09-29 21:52:14'),
(165, 2, 67, '2014-09-29 21:52:14', '2014-09-29 21:52:14'),
(166, 2, 68, '2014-09-29 21:52:14', '2014-09-29 21:52:14'),
(167, 2, 69, '2014-09-29 21:52:14', '2014-09-29 21:52:14'),
(172, 2, 76, '2014-09-29 21:52:14', '2014-09-29 21:52:14'),
(173, 2, 77, '2014-09-29 21:52:14', '2014-09-29 21:52:14'),
(175, 2, 8, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(176, 2, 9, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(177, 2, 12, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(178, 2, 13, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(179, 2, 17, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(180, 2, 18, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(181, 2, 22, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(182, 2, 23, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(183, 2, 26, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(184, 2, 27, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(185, 2, 31, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(186, 2, 32, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(187, 2, 47, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(188, 2, 48, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(189, 2, 49, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(190, 2, 53, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(191, 2, 54, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(192, 2, 57, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(193, 2, 58, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(194, 2, 72, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(195, 2, 75, '2014-09-30 01:16:04', '2014-09-30 01:16:04'),
(197, 1, 80, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(198, 1, 81, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(199, 1, 82, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(200, 1, 83, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(201, 1, 84, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(202, 1, 85, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(203, 1, 86, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(204, 1, 87, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(205, 1, 88, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(206, 1, 89, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(207, 1, 90, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(208, 1, 91, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(209, 1, 92, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(210, 1, 93, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(211, 1, 94, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(212, 1, 95, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(213, 1, 96, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(214, 1, 97, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(215, 1, 98, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(216, 1, 99, '2014-10-01 01:43:42', '2014-10-01 01:43:42'),
(217, 1, 100, '2014-10-03 23:25:10', '2014-10-03 23:25:10'),
(218, 1, 101, '2014-10-03 23:25:10', '2014-10-03 23:25:10'),
(219, 1, 79, '2014-10-03 23:52:11', '2014-10-03 23:52:11'),
(220, 1, 6, '2014-10-04 00:28:27', '2014-10-04 00:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `prestige_categories`
--

CREATE TABLE IF NOT EXISTS `prestige_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `affiliate_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `monthly_limit` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `prestige_categories`
--

INSERT INTO `prestige_categories` (`id`, `affiliate_id`, `name`, `monthly_limit`, `description`, `created`, `modified`) VALUES
(1, 1, 'Administration', 80, 'The tables that follow cover almost everything for which coordinators award prestige. If something is not listed, there is also an “Exceptional Service” category at the end. It is important that coordinators award prestige consistently to ensure fairness to all members.\r\nIt is important to take the caps for each category into account, as awards in excess of these caps will be removed during the review process. If a member deserves more prestige points for their efforts above and beyond what is ordinary, they may be awarded points in the “Exceptional Service” category. These caps encourage members to participate in a variety of different activities instead of focusing upon one area of the club to the exclusion of all else.\r\nSeveral individual line items also have specific caps for the same reason. These line item caps apply to the awards given in any particular month (or event, in the case of the “Event Services” category). Thus, while a member cannot receive more than 30 prestige points for donations to a specific charitable cause during a given month, she may receive that award for the same cause during different months.', '2014-09-30 17:13:54', '2014-09-30 17:25:58'),
(2, 1, 'City Development', 20, '', '2014-09-30 17:26:30', '2014-09-30 17:26:30'),
(3, 1, 'Communication and Web Design', 50, 'As with officers, list moderators and IRC operators should receive awards in keeping with the amount of work performed relative to other list moderators and IRC ops. Only the lists with the highest volume should receive the maximum allowable award, while most should receive about half the maximum award. Prestige awards for web design are very subjective and amounts should be decided with care. Important to note is the complexity of the site, both in number of pages, quantity of information, and technical or dynamic elements of the page. Only extensive, highly complex, dynamic websites should receive the maximum allowable award.\r\nMost websites are local and result in awards of General prestige awarded by a DC or CC. The regional or national coordinators may request a website for regional or national consumption-any regional or national prestige awarded as a result must be granted by the RC or NC respectively.', '2014-09-30 17:37:41', '2014-09-30 17:38:08'),
(4, 1, 'Community Service', 70, 'Most charity drives are local and result in awards of General prestige awarded by a DC or CC. The regional or national coordinators may sponsor a regional or national drive-any regional or national prestige awarded as a result must be granted by the RC or NC respectively.', '2014-09-30 17:39:38', '2014-09-30 17:39:38'),
(5, 1, 'Publications and PR', 50, 'Most publications are local and result in awards of General prestige awarded by a domain or chapter coordinator. The regional or national coordinators may request a publication for regional or national distribution-any regional or national prestige awarded as a result must be granted by the RC or NC respectively. Web publications such as Domain/Chapter Newsletters for ease of distribution would be included in this award, not under Communications.', '2014-09-30 17:40:08', '2014-09-30 17:40:08');

-- --------------------------------------------------------

--
-- Table structure for table `prestige_items`
--

CREATE TABLE IF NOT EXISTS `prestige_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `affiliate_id` int(11) NOT NULL,
  `prestige_category_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `value_min` int(11) NOT NULL,
  `value_max` int(11) NOT NULL,
  `monthly_limit` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `prestige_items`
--

INSERT INTO `prestige_items` (`id`, `affiliate_id`, `prestige_category_id`, `name`, `value_min`, `value_max`, `monthly_limit`, `description`, `created`, `modified`) VALUES
(1, 1, 1, 'National or Global level principle officer/administrator', 0, 50, 0, 'Members of the Camarilla Council. Awarded by the Club Director. National prestige. The club director is a paid employee of White Wolf and does not receive prestige for the position. The finance director and conventions director are volunteers though appointed by White Wolf.', '2014-09-30 20:48:27', '2014-09-30 20:48:27'),
(2, 1, 1, 'Assistant to National or Global-level principle officer/administrator', 0, 50, 0, 'Any associate appointed by a member of the Camarilla Council who reports monthly, including Special Project Leads. Awarded by the appointing officer. National prestige. Prestige recommendations are to be included in the monthly report and will be awarded as recommended unless adjusted or denied by the national coordinator.', '2014-09-30 20:59:36', '2014-09-30 21:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `prestige_items_types`
--

CREATE TABLE IF NOT EXISTS `prestige_items_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prestige_item_id` int(11) NOT NULL,
  `prestige_type_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `prestige_items_types`
--

INSERT INTO `prestige_items_types` (`id`, `prestige_item_id`, `prestige_type_id`, `created`, `modified`) VALUES
(1, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `prestige_logs`
--

CREATE TABLE IF NOT EXISTS `prestige_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `prestige_logs`
--

INSERT INTO `prestige_logs` (`id`, `member_id`, `created`, `modified`) VALUES
(1, 33, '2014-10-01 01:21:39', '2014-10-01 01:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `prestige_logs_items`
--

CREATE TABLE IF NOT EXISTS `prestige_logs_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prestige_log_id` int(11) NOT NULL,
  `prestige_item_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prestige_types`
--

CREATE TABLE IF NOT EXISTS `prestige_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `prestige_types`
--

INSERT INTO `prestige_types` (`id`, `name`, `created`, `modified`) VALUES
(1, 'General', '2014-09-30 20:23:17', '2014-09-30 20:23:17'),
(2, 'Regional', '2014-09-30 20:27:49', '2014-09-30 20:27:49'),
(3, 'National', '2014-09-30 20:28:03', '2014-09-30 20:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE IF NOT EXISTS `publishers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `website`, `created`, `modified`) VALUES
(1, 'White Wolf Publishing', 'www.white-wolf.com', '2014-09-22 01:26:00', '2014-09-26 19:47:28'),
(2, 'By Night Studios', 'www.bynightstudios.com', '2014-09-22 17:00:58', '2014-09-22 17:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=102 ;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`) VALUES
(2, NULL, 1, 2, 'Articles:isAuthorized', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(4, NULL, 3, 4, 'Articles:view', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(6, NULL, 5, 6, 'Articles:edit', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(7, NULL, 7, 8, 'Articles:delete', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(8, NULL, 9, 10, 'Assignments:index', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(9, NULL, 11, 12, 'Assignments:view', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(10, NULL, 13, 14, 'Assignments:add', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(11, NULL, 15, 16, 'Assignments:edit', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(12, NULL, 17, 18, 'Books:index', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(13, NULL, 19, 20, 'Books:view', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(14, NULL, 21, 22, 'Books:add', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(15, NULL, 23, 24, 'Books:edit', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(16, NULL, 25, 26, 'Books:delete', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(17, NULL, 27, 28, 'Continuities:index', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(18, NULL, 29, 30, 'Continuities:view', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(19, NULL, 31, 32, 'Continuities:add', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(20, NULL, 33, 34, 'Continuities:edit', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(21, NULL, 35, 36, 'Continuities:delete', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(22, NULL, 37, 38, 'DomainTypes:index', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(23, NULL, 39, 40, 'DomainTypes:view', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(24, NULL, 41, 42, 'DomainTypes:add', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(25, NULL, 43, 44, 'DomainTypes:edit', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(26, NULL, 45, 46, 'Domains:index', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(27, NULL, 47, 48, 'Domains:view', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(28, NULL, 49, 50, 'Domains:add', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(29, NULL, 51, 52, 'Domains:edit', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(30, NULL, 53, 54, 'Domains:delete', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(31, NULL, 55, 56, 'Games:index', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(32, NULL, 57, 58, 'Games:view', '2014-09-26 21:01:39', '2014-09-26 21:01:39'),
(33, NULL, 59, 60, 'Games:add', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(34, NULL, 61, 62, 'Games:edit', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(35, NULL, 63, 64, 'Games:delete', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(36, NULL, 65, 66, 'Members:index', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(37, NULL, 67, 68, 'Members:view', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(38, NULL, 69, 70, 'Members:register', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(39, NULL, 71, 72, 'Members:edit', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(40, NULL, 73, 74, 'Members:editEmail', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(41, NULL, 75, 76, 'Members:resetEmail', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(42, NULL, 77, 78, 'Members:login', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(43, NULL, 79, 80, 'Members:logout', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(44, NULL, 81, 82, 'Members:activate', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(45, NULL, 83, 84, 'Members:forgotPassword', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(46, NULL, 85, 86, 'Members:resetPassword', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(47, NULL, 87, 88, 'Pages:display', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(48, NULL, 89, 90, 'Permissions:index', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(49, NULL, 91, 92, 'Permissions:view', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(50, NULL, 93, 94, 'Permissions:add', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(51, NULL, 95, 96, 'Permissions:edit', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(52, NULL, 97, 98, 'Permissions:delete', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(53, NULL, 99, 100, 'Publishers:index', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(54, NULL, 101, 102, 'Publishers:view', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(55, NULL, 103, 104, 'Publishers:add', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(56, NULL, 105, 106, 'Publishers:edit', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(57, NULL, 107, 108, 'Resources:index', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(58, NULL, 109, 110, 'Resources:view', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(59, NULL, 111, 112, 'Resources:add', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(60, NULL, 113, 114, 'Resources:edit', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(61, NULL, 115, 116, 'Resources:update', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(62, NULL, 117, 118, 'Roles:index', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(63, NULL, 119, 120, 'Roles:view', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(64, NULL, 121, 122, 'Roles:add', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(65, NULL, 123, 124, 'Roles:edit', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(66, NULL, 125, 126, 'Venues:index', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(67, NULL, 127, 128, 'Venues:view', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(68, NULL, 129, 130, 'Venues:add', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(69, NULL, 131, 132, 'Venues:edit', '2014-09-26 21:01:40', '2014-09-26 21:01:40'),
(72, NULL, 133, 134, 'Affiliates:view', '2014-09-26 21:05:00', '2014-09-26 21:05:00'),
(73, NULL, 135, 136, 'Affiliates:add', '2014-09-27 22:30:39', '2014-09-27 22:30:39'),
(74, NULL, 137, 138, 'Affiliates:edit', '2014-09-27 22:30:40', '2014-09-27 22:30:40'),
(75, NULL, 139, 140, 'Affiliates:index', '2014-09-27 22:30:40', '2014-09-27 22:30:40'),
(76, NULL, 141, 142, 'Articles:add', '2014-09-27 22:30:40', '2014-09-27 22:30:40'),
(77, NULL, 143, 144, 'Articles:index', '2014-09-27 22:30:40', '2014-09-27 22:30:40'),
(78, NULL, 145, 146, 'Resources:delete', '2014-09-27 22:30:40', '2014-09-27 22:30:40'),
(79, NULL, 147, 148, 'Assignments:delete', '2014-09-30 01:26:20', '2014-09-30 01:26:20'),
(80, NULL, 149, 150, 'PrestigeItems:add', '2014-09-30 20:19:19', '2014-09-30 20:19:19'),
(81, NULL, 151, 152, 'PrestigeItems:delete', '2014-10-01 01:26:26', '2014-10-01 01:26:26'),
(82, NULL, 153, 154, 'PrestigeItems:edit', '2014-10-01 01:28:34', '2014-10-01 01:28:34'),
(83, NULL, 155, 156, 'PrestigeItems:index', '2014-10-01 01:28:34', '2014-10-01 01:28:34'),
(84, NULL, 157, 158, 'PrestigeItems:view', '2014-10-01 01:28:34', '2014-10-01 01:28:34'),
(85, NULL, 159, 160, 'PrestigeLogs:add', '2014-10-01 01:28:34', '2014-10-01 01:28:34'),
(86, NULL, 161, 162, 'PrestigeLogs:delete', '2014-10-01 01:28:34', '2014-10-01 01:28:34'),
(87, NULL, 163, 164, 'PrestigeLogs:edit', '2014-10-01 01:28:34', '2014-10-01 01:28:34'),
(88, NULL, 165, 166, 'PrestigeLogs:index', '2014-10-01 01:28:34', '2014-10-01 01:28:34'),
(89, NULL, 167, 168, 'PrestigeLogs:view', '2014-10-01 01:28:34', '2014-10-01 01:28:34'),
(90, NULL, 169, 170, 'PrestigeTypes:add', '2014-10-01 01:28:34', '2014-10-01 01:28:34'),
(91, NULL, 171, 172, 'PrestigeTypes:delete', '2014-10-01 01:28:34', '2014-10-01 01:28:34'),
(92, NULL, 173, 174, 'PrestigeTypes:edit', '2014-10-01 01:28:34', '2014-10-01 01:28:34'),
(93, NULL, 175, 176, 'PrestigeTypes:index', '2014-10-01 01:28:35', '2014-10-01 01:28:35'),
(94, NULL, 177, 178, 'PrestigeTypes:view', '2014-10-01 01:28:35', '2014-10-01 01:28:35'),
(95, NULL, 179, 180, 'PrestigeCategories:add', '2014-10-01 01:40:17', '2014-10-01 01:40:17'),
(96, NULL, 181, 182, 'PrestigeCategories:delete', '2014-10-01 01:40:17', '2014-10-01 01:40:17'),
(97, NULL, 183, 184, 'PrestigeCategories:edit', '2014-10-01 01:40:17', '2014-10-01 01:40:17'),
(98, NULL, 185, 186, 'PrestigeCategories:index', '2014-10-01 01:40:17', '2014-10-01 01:40:17'),
(99, NULL, 187, 188, 'PrestigeCategories:view', '2014-10-01 01:40:17', '2014-10-01 01:40:17'),
(100, NULL, 189, 190, 'Members:add', '2014-10-03 23:24:51', '2014-10-03 23:24:51'),
(101, NULL, 191, 192, 'PrestigeLogs:addPrestige', '2014-10-03 23:24:51', '2014-10-03 23:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `affiliate_id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Use * as a wildcard',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `allow_multiple` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `parent_id`, `lft`, `rght`, `affiliate_id`, `name`, `abbreviation`, `description`, `allow_multiple`, `created`, `modified`) VALUES
(1, NULL, 1, 2, 1, 'Administrator', 'Admin', 'This is the admin Role, they can do anything.', 0, '2014-09-18 01:46:08', '2014-10-04 00:28:44'),
(2, NULL, 3, 8, 1, 'Storyteller', '*ST', 'This is the main Storyteller Role.', 0, '2014-09-18 03:40:59', '2014-09-30 01:16:04'),
(4, 2, 6, 7, 1, 'Assistant Storyteller', 'a*ST', 'They help a little bit.', 1, '2014-09-18 04:51:27', '2014-09-28 23:28:36'),
(5, NULL, 9, 10, 1, 'Coordinator', '*C', 'The less fun job', 0, '2014-09-28 23:32:42', '2014-09-28 23:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE IF NOT EXISTS `venues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain_id` int(11) NOT NULL,
  `continuity_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `domain_id`, `continuity_id`, `game_id`, `created`, `modified`) VALUES
(1, 6, 1, 2, '2014-09-25 06:44:58', '2014-09-25 21:28:22');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
