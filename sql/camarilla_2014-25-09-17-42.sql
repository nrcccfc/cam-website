-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2014 at 11:41 PM
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
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `completed` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `member_id`, `role_id`, `domain_id`, `created`, `modified`, `completed`) VALUES
(2, 33, 2, 6, '2014-09-21 19:45:38', '2014-09-25 21:09:04', '0000-00-00 00:00:00');

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
  `allow_members` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `domain_types`
--

INSERT INTO `domain_types` (`id`, `parent_id`, `lft`, `rght`, `affiliate_id`, `name`, `allow_members`, `created`, `modified`) VALUES
(1, NULL, 1, 6, NULL, 'Prime', 0, '2014-09-20 06:52:03', '2014-09-20 06:52:03'),
(2, 1, 2, 5, 1, 'National', 0, '2014-09-20 06:52:13', '2014-09-20 16:42:39'),
(3, 2, 3, 4, 1, 'Local', 1, '2014-09-20 06:52:47', '2014-09-25 21:16:05'),
(4, 1, 0, 0, 2, 'National', 0, '2014-09-20 23:26:27', '2014-09-20 23:26:27'),
(5, 4, 0, 0, 2, 'Regional', 0, '2014-09-20 23:26:52', '2014-09-20 23:26:52'),
(6, 5, 0, 0, 2, 'Local', 1, '2014-09-20 23:27:08', '2014-09-20 23:27:08');

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

INSERT INTO `members` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `email_temp`, `code`, `code_timestamp`, `role`, `is_active`, `created`, `modified`) VALUES
(33, 'McGaiser', '$2y$10$b6gXNzPlOS2gDr.cJ.YYcupI76f1JuORtumViMfnhu4F.xka.G2Fu', 'Michael', 'Gaiser', 'mjgaiser@gmail.com', NULL, NULL, NULL, 'admin', 1, '2014-09-18 01:36:17', '2014-09-25 21:19:38');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `allow` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
(1, 'White Wolf Publishing', 'www.white-wolf.com', '2014-09-22 01:26:00', '2014-09-25 21:21:49'),
(2, 'By Night Studios', 'www.bynightstudios.com', '2014-09-22 17:00:58', '2014-09-22 17:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `alias` int(11) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `allow_multiple` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `parent_id`, `lft`, `rght`, `affiliate_id`, `name`, `description`, `allow_multiple`, `created`, `modified`) VALUES
(1, NULL, 1, 2, 0, 'Admin', 'This is the admin Role, they can do anything.', 0, '2014-09-18 01:46:08', '0000-00-00 00:00:00'),
(2, NULL, 3, 8, 1, 'Storyteller', 'This is the main Storyteller Role.', 0, '2014-09-18 03:40:59', '0000-00-00 00:00:00'),
(4, 2, 6, 7, 1, 'Assistant Storyteller', 'They help a little bit.', 1, '2014-09-18 04:51:27', '2014-09-25 21:26:15');

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
