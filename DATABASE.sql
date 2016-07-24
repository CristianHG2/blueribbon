-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 24, 2016 at 05:17 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `safe`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastactive` int(255) NOT NULL,
  `rank` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `likedPosts` text NOT NULL,
  `motto` varchar(60) NOT NULL DEFAULT 'I love Blue Ribbon!',
  `blocked` varchar(255) NOT NULL DEFAULT '[]',
  `hiddenPosts` varchar(255) NOT NULL DEFAULT '[]',
  `prefix` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE IF NOT EXISTS `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `time` int(255) NOT NULL,
  `text` text NOT NULL,
  `author` int(255) NOT NULL,
  `cachedIMG` text NOT NULL,
  `cachedName` varchar(255) NOT NULL,
  `cachedCat` varchar(255) NOT NULL,
  `cachedPrefix` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `author` int(255) NOT NULL,
  `content` text NOT NULL,
  `postid` int(255) NOT NULL,
  `created` int(255) NOT NULL,
  `userIMG` text NOT NULL,
  `userName` varchar(255) NOT NULL,
  `cachedPrefix` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `destination` int(255) NOT NULL,
  `seen` enum('0','1') NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;


-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `author` int(255) NOT NULL,
  `content` text NOT NULL,
  `date_created` int(255) NOT NULL,
  `lastactive` int(255) NOT NULL,
  `cachedName` varchar(255) NOT NULL,
  `cachedComments` int(255) NOT NULL,
  `cachedLikes` int(255) NOT NULL,
  `cachedIMG` varchar(255) NOT NULL,
  `locked` enum('0','1') NOT NULL,
  `cachedPrefix` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

-- --------------------------------------------------------

--
-- Table structure for table `sitevars`
--

CREATE TABLE IF NOT EXISTS `sitevars` (
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sitevars`
--

INSERT INTO `sitevars` (`name`, `value`) VALUES
('site_name', 'Blue Ribbon'),
('site_resources', 'https://theblueribbon.net/resources'),
('site_url', 'https://theblueribbon.net/'),
('sys_resources', 'https://theblueribbon.net/resources/system');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
