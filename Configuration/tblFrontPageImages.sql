-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2013 at 12:51 PM
-- Server version: 5.5.32
-- PHP Version: 5.3.10-1ubuntu3.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `CSCREW_Website`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblFrontPageImages`
--

CREATE TABLE IF NOT EXISTS `tblFrontPageImages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblFrontPageImages`
--

INSERT INTO `tblFrontPageImages` (`id`, `path`, `description`, `title`, `sort_order`) VALUES
(1, '4.jpg', 'test', 'test', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

create table `tblNews` ( `id` int(11) NOT NULL AUTO_INCREMENT, `title` varchar(100) NOT NULL, `path` varchar(255) NOT NULL, `image` varchar(255) NOT NULL, `created_at` varchar(255) NOT NULL, `is_published` integer(1), PRIMARY KEY(`id`));