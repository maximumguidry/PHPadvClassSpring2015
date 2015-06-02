Advanced PHP Project Proposal

1.  Team members:  Beau Guidry

2.  Project idea:  A database-driven tracker of recently-visited restaurants with reviews and comments on individual dishes.  Users should be able to manipulate records for two tables - one for the restaurants and one for individual dishes.

3.  List of tasks:

-Set up database (30 m)
-Create views
	-restaurant display view (1 hr)
	-individual dish display view (1 hr)
-Create models
	-Restaurant
		*DAO (2 hrs)
		*DO (2 hrs)
		*Interfaces (1 hr)
		*Services (2 hrs)
	-Dishes
		*DAO (2 hrs)
		*DO (2 hrs)
		*Interfaces (1 hr)
		*Services (2 hrs)
-Create controllers
	-Restaurant (2 hrs)
	-Dishes (2 hrs) 
-Create login (1 hr)
-Create and use namespace (30 m)
-Testing (2 hrs)

Total Time:  24 hours

4.  Task assignments:  All to Beau Guidry

5.  Task time estimates:  See task list

----------------DATABASE CREATE--------------------
-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2015 at 01:15 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpadvclassspring2015`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`itemid` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rating` int(10) unsigned NOT NULL,
  `comments` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'None',
  `beverage` tinyint(4) NOT NULL,
  `spicy` tinyint(4) NOT NULL,
  `restaurantid` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemid`, `name`, `type`, `rating`, `comments`, `beverage`, `spicy`, `restaurantid`) VALUES
(1, 'Spicy Bad Girl Roll', 'Japanese', 4, 'Spicy and bad in a good way', 0, 1, 1),
(2, 'Avacado Burger', 'American', 4, 'Standard burger, but the salsa takes it to the next level', 0, 0, 2),
(3, 'Chicken Fajita', 'Tex-Mex', 4, 'Nothing spectacular, but fajitas are always delicious', 0, 1, 1),
(4, 'Dante''s Omellete', 'Breakfast', 2, 'Not enough food                        ', 0, 0, 4),
(5, 'Tuna Roll', 'Japanese', 5, 'Excellent quality                        ', 0, 0, 1),
(6, 'Burrito Bowl', 'Mexican', 3, 'Good, but too much rice.  I would recommend it.', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE IF NOT EXISTS `restaurants` (
`restaurantid` int(10) unsigned NOT NULL,
  `restaurant_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`restaurantid`, `restaurant_name`, `location`) VALUES
(1, 'Raku Sakura', '258 Main Street, East Greenwich RI 02818'),
(2, 'Fat Belly''s', '255 Main Street, East Greenwich RI 02818'),
(3, 'Chilis', '1276 Bald Hill Rd, Warwick, RI 02886'),
(4, 'Dante''s', '257 Main Street, East Greenwich RI 02818'),
(5, 'Chipotle', 'Garden City');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE IF NOT EXISTS `signup` (
`id` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `email`, `password`, `created`, `active`) VALUES
(17, 'beau@yahoo.com', '$2y$10$vCTWjWt7HEAZSI629BF9Nu/B5rNScT9r0IFr3VSUORXs.fTbKWXGG', '2015-06-01 14:19:41', 1),
(18, 'something@yahoo.com', '$2y$10$ePnZ3pfLybb5uatI/gnR2etAG1eXLXJjLijERcww5ByoYOxrVkdhu', '2015-06-01 16:46:30', 1),
(19, 'alexandrea@gmail.com', '$2y$10$UV/THDlkcdPp0/tj/qnpueTkRQYl5yWZWY2BM04vCZhhz1UHchLJy', '2015-06-02 17:17:49', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`itemid`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
 ADD PRIMARY KEY (`restaurantid`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
MODIFY `itemid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
MODIFY `restaurantid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
