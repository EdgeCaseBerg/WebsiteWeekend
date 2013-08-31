-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2013 at 12:05 PM
-- Server version: 5.1.67-rel14.3-log
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `slimdown_cscrew`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account_Info`
--

CREATE TABLE IF NOT EXISTS `Account_Info` (
  `uvm_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'uvm net id',
  `username` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'display name',
  `password` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'password to login',
  `priv_level` int(11) NOT NULL COMMENT 'privelege level',
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`uvm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='account info for a forum or website member';

--
-- Dumping data for table `Account_Info`
--

INSERT INTO `Account_Info` (`uvm_id`, `username`, `password`, `priv_level`, `email`) VALUES
('jdicker1', 'josh', '_MÌ;Z§eÖƒ''Þ¸‚Ï™', 1, 'jdicker1@uvm.edu'),
('wmacewan', 'wmacewan', '¿mæ^Ñ	j©}&`ê°', 1, 'wmacewan@uvm.edu'),
('joshua.dickerson', 'joshd', '_MÌ;Z§eÖƒ''Þ¸‚Ï™', 1, 'joshua.dickerson@uvm.edu'),
('', '', '', 1, '@uvm.edu'),
('test', 'test', '_MÌ;Z§eÖƒ''Þ¸‚Ï™', 1, 'test@uvm.edu');

-- --------------------------------------------------------

--
-- Table structure for table `Account_Profile`
--

CREATE TABLE IF NOT EXISTS `Account_Profile` (
  `uvm_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `first_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `personal_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `about_me` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `img_url` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`uvm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Account_Profile`
--

INSERT INTO `Account_Profile` (`uvm_id`, `username`, `first_name`, `last_name`, `personal_url`, `about_me`, `img_url`) VALUES
('jdicker1', 'null', 'Josh', 'Dickerson', 'http://www.joshuadickerson.com', 'Skills: JQuery, HTML/CSS, PHP, Java, MATLAB, Python <br /><br /> I also ride bikes !! blahhh', 'noprofile.png');

-- --------------------------------------------------------

--
-- Table structure for table `Forum_Comments`
--

CREATE TABLE IF NOT EXISTS `Forum_Comments` (
  `uvm_id` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `parent_uvm_id` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `comment_text` text COLLATE utf8_general_ci NOT NULL,
  `comment_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `timestamp` varchar(60) COLLATE utf8_general_ci NOT NULL,
  `last_updated` varchar(60) COLLATE utf8_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Forum_Comments`
--

INSERT INTO `Forum_Comments` (`uvm_id`, `parent_uvm_id`, `comment_text`, `comment_id`, `parent_id`, `timestamp`, `last_updated`) VALUES
('', '', '22222222222', 0, 1347911718, '', ''),
('jdicker1', '', 'comment', 0, 1351119879, '', ''),
('jdicker1', '', 'ffffffffffffffffff', 0, 1347912482, '', ''),
('jdicker1', '', 'ffffffffffffffffff', 0, 1347912482, '', ''),
('jdicker1', '', 'try shit', 0, 1347912482, '', ''),
('jdicker1', '', 'new try', 1351121089, 1347912482, '1351121089', ''),
('jdicker1', '', 'asdasfaf', 1351122522, 1347912482, '1351122522', ''),
('jdicker1', '', 'hshgxfgh', 1351728629, 1347912482, '1351728629', ''),
('', '', '', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `Forum_Posts`
--

CREATE TABLE IF NOT EXISTS `Forum_Posts` (
  `post_title` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `post_text` text COLLATE utf8_general_ci NOT NULL,
  `uvm_id` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `timestamp` varchar(60) COLLATE utf8_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Forum_Posts`
--

INSERT INTO `Forum_Posts` (`post_title`, `post_text`, `uvm_id`, `timestamp`) VALUES
('another test', 'this is starting to work', 'jdicker1', '1347912482');

-- --------------------------------------------------------

--
-- Table structure for table `login_class`
--

CREATE TABLE IF NOT EXISTS `login_class` (
  `pkNumber` varchar(3) NOT NULL DEFAULT '000' COMMENT 'cs course number',
  `ClassName` varchar(255) NOT NULL DEFAULT 'STUDY' COMMENT 'cs class name',
  `Instructor` varchar(255) NOT NULL DEFAULT 'SELF' COMMENT 'instructors name',
  `Semester` varchar(6) NOT NULL DEFAULT '0' COMMENT 'semester',
  PRIMARY KEY (`pkNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Table to hold classes displayed on the log-in screen';

--
-- Dumping data for table `login_class`
--

INSERT INTO `login_class` (`pkNumber`, `ClassName`, `Instructor`, `Semester`) VALUES
('491', 'Doctoral Dissertation Research', 'Indra Neil Sarkar', 'Summer'),
('394', 'Predictive Casual Query Proces', 'Byung  Lee', 'Summer'),
('391', 'Pred causal mod over datastrms', 'Byung  Lee', 'Summer'),
('142', 'Advanced Web Design', 'Robert M. Erickson', 'Summer'),
('021', 'Computer Programming I: MATLAB', 'Jackie Lynn Horton', 'Summer'),
('020', 'Programming for Engineers', 'Jackie Lynn Horton', 'Summer'),
('014', 'Visual Basic Programming', 'Jackie Lynn Horton', 'Summer'),
('008', 'Introduction: WWW Design', 'Robert M. Erickson', 'Summer');

-- --------------------------------------------------------

--
-- Table structure for table `Member_Logins`
--

CREATE TABLE IF NOT EXISTS `Member_Logins` (
  `fkUserID` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `IP` varchar(12) NOT NULL COMMENT 'ip address',
  `Login_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Member_Logins`
--

INSERT INTO `Member_Logins` (`fkUserID`, `IP`, `Login_Time`) VALUES
('ejeldrid', '1.56.181.5', '2012-07-03 00:00:06'),
('ejeldrid', '132.198.40.9', '2012-07-03 00:48:48'),
('ejeldrid', '132.198.40.9', '2012-07-03 00:49:36'),
('ejeldrid', '132.198.40.9', '2012-07-03 00:52:35'),
('ejeldrid', '132.198.40.9', '2012-07-03 00:55:06'),
('ejeldrid', '127.0.0.1', '2012-07-17 19:07:55'),
('ejeldrid', '127.0.0.1', '2012-07-17 19:08:06'),
('ejeldrid', '127.0.0.1', '2012-07-17 19:09:01'),
('ejeldrid', '127.0.0.1', '2012-07-17 19:09:10'),
('ejeldrid', '127.0.0.1', '2012-07-17 20:10:57'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:16:14'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:20:50'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:27:05'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:27:23'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:27:34'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:28:08'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:28:28'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:29:51'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:31:24'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:32:44'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:35:01'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:37:09'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:41:27'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:41:43'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:44:00'),
('ejeldrid', '127.0.0.1', '2012-08-27 22:45:53'),
('ejeldrid', '132.198.10.8', '2012-08-27 22:49:41'),
('ejeldrid', '132.198.10.8', '2012-08-27 22:50:01'),
('ejeldrid', '132.198.10.8', '2012-08-27 22:51:41'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:19:28'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:20:04'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:20:29'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:20:54'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:21:17'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:21:28'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:22:05'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:22:13'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:24:58'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:25:33'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:26:11'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:27:37'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:27:56'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:28:17'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:28:30'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:29:42'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:29:54'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:30:12'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:30:27'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:30:35'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:31:05'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:31:28'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:31:52'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:32:26'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:32:37'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:32:55'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:33:12'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:33:23'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:34:14'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:35:38'),
('ejeldrid', '127.0.0.1', '2012-08-27 23:37:29'),
('ejeldrid', '132.198.10.8', '2012-08-27 23:39:21'),
('ejeldrid', '132.198.10.8', '2012-08-27 23:40:46'),
('ejeldrid', '127.0.0.1', '2012-08-28 13:08:35'),
('ejeldrid', '132.198.10.8', '2012-08-28 14:29:10'),
('ejeldrid', '132.198.10.8', '2012-08-28 14:41:52'),
('ejeldrid', '132.198.10.8', '2012-08-28 14:48:16'),
('ejeldrid', '132.198.10.8', '2012-08-28 16:28:27'),
('ejeldrid', '127.0.0.1', '2012-08-28 17:08:23'),
('ejeldrid', '127.0.0.1', '2012-08-28 17:09:01'),
('ejeldrid', '127.0.0.1', '2012-08-28 17:09:25'),
('jdicker1', '127.0.0.1', '2012-08-29 14:08:49'),
('jdicker1', '127.0.0.1', '2012-08-29 19:41:15'),
('jdicker1', '127.0.0.1', '2012-08-29 21:27:23'),
('jdicker1', '127.0.0.1', '2012-08-31 15:23:54'),
('jdicker1', '127.0.0.1', '2012-08-31 16:19:29'),
('jdicker1', '127.0.0.1', '2012-08-31 18:49:45'),
('jdicker1', '127.0.0.1', '2012-08-31 19:01:32'),
('jdicker1', '127.0.0.1', '2012-08-31 19:02:03'),
('jdicker1', '127.0.0.1', '2012-08-31 19:04:51'),
('jdicker1', '127.0.0.1', '2012-08-31 19:11:09'),
('jdicker1', '127.0.0.1', '2012-08-31 19:15:50'),
('jdicker1', '127.0.0.1', '2012-08-31 19:16:45'),
('jdicker1', '127.0.0.1', '2012-08-31 19:17:26'),
('jdicker1', '127.0.0.1', '2012-08-31 19:18:17'),
('jdicker1', '127.0.0.1', '2012-08-31 19:18:41'),
('jdicker1', '127.0.0.1', '2012-08-31 19:43:54'),
('jdicker1', '127.0.0.1', '2012-08-31 19:48:53'),
('jdicker1', '127.0.0.1', '2012-08-31 20:44:27'),
('jdicker1', '132.198.10.8', '2012-08-31 21:00:48'),
('jdicker1', '127.0.0.1', '2012-09-01 15:09:39'),
('jdicker1', '127.0.0.1', '2012-09-01 21:05:24'),
('jdicker1', '127.0.0.1', '2012-09-01 21:19:44'),
('jdicker1', '127.0.0.1', '2012-09-01 21:25:35'),
('jdicker1', '127.0.0.1', '2012-09-01 23:00:50'),
('jdicker1', '127.0.0.1', '2012-09-02 01:56:29'),
('jdicker1', '132.198.10.8', '2012-09-04 18:51:08'),
('jdicker1', '132.198.10.8', '2012-09-04 18:54:58'),
('jdicker1', '132.198.10.8', '2012-09-05 13:56:01'),
('jdicker1', '127.0.0.1', '2012-09-05 14:27:20'),
('jdicker1', '127.0.0.1', '2012-09-05 15:36:07'),
('jdicker1', '132.198.10.8', '2012-09-05 16:10:46'),
('jdicker1', '127.0.0.1', '2012-09-05 18:26:55'),
('jdicker1', '127.0.0.1', '2012-09-05 20:52:43'),
('jdicker1', '127.0.0.1', '2012-09-05 20:52:59'),
('jdicker1', '132.198.10.8', '2012-09-05 23:32:14'),
('jdicker1', '127.0.0.1', '2012-09-05 23:56:54'),
('jdicker1', '127.0.0.1', '2012-09-06 00:04:54'),
('jdicker1', '132.198.10.8', '2012-09-06 00:34:36'),
('jdicker1', '127.0.0.1', '2012-09-06 00:57:46'),
('jdicker1', '127.0.0.1', '2012-09-06 01:44:56'),
('jdicker1', '127.0.0.1', '2012-09-06 02:46:55'),
('jdicker1', '127.0.0.1', '2012-09-13 01:46:24'),
('jdicker1', '127.0.0.1', '2012-09-14 14:49:54'),
('jdicker1', '127.0.0.1', '2012-09-17 15:11:08'),
('jdicker1', '127.0.0.1', '2012-09-17 19:40:14'),
('jdicker1', '127.0.0.1', '2012-09-17 21:17:35'),
('jdicker1', '127.0.0.1', '2012-09-18 13:29:37'),
('jdicker1', '127.0.0.1', '2012-09-18 14:13:50'),
('jdicker1', '127.0.0.1', '2012-09-18 14:16:08'),
('jdicker1', '127.0.0.1', '2012-09-18 14:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `News`
--

CREATE TABLE IF NOT EXISTS `News` (
  `pkID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(42) NOT NULL,
  `date_posted` date NOT NULL,
  `picture_url` varchar(50) DEFAULT NULL,
  `picture_caption` varchar(250) NOT NULL,
  `story_url` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `toID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`pkID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Table to hold information for news post. using urls for cont' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `R332_Hours`
--

CREATE TABLE IF NOT EXISTS `R332_Hours` (
  `fkMemberID` varchar(10) NOT NULL,
  `DayOfWeek` enum('M','T','W','R','F','S','Su') NOT NULL,
  `Semester` varchar(15) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `R332_Hours`
--

INSERT INTO `R332_Hours` (`fkMemberID`, `DayOfWeek`, `Semester`, `StartTime`, `EndTime`) VALUES
('pkiripol', 'M', 'Spring2011', '10:30:00', '11:30:00'),
('pkiripol', 'W', 'Spring2011', '10:30:00', '11:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `R332_Languages`
--

CREATE TABLE IF NOT EXISTS `R332_Languages` (
  `pkLanguageID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'index of language',
  `Language` varchar(40) NOT NULL COMMENT 'language known',
  PRIMARY KEY (`pkLanguageID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='This table has all the languages known by cs crew members' AUTO_INCREMENT=28 ;

--
-- Dumping data for table `R332_Languages`
--

INSERT INTO `R332_Languages` (`pkLanguageID`, `Language`) VALUES
(1, 'C'),
(2, 'JAVA'),
(3, 'Python'),
(4, 'xHTML'),
(5, 'XML'),
(6, 'PHP'),
(7, 'ASP'),
(8, 'C++'),
(9, 'C#'),
(10, 'Visual Basic'),
(11, 'Matlab'),
(12, 'MySQL'),
(13, 'MsSQL'),
(14, 'Javascript/jQuery'),
(15, 'AJAX'),
(16, 'LaTeX'),
(17, 'Scheme'),
(18, 'Prolog'),
(19, 'LISP'),
(20, 'MAC'),
(21, 'Ruby'),
(22, 'OCaml'),
(23, 'CSS'),
(24, 'Combinatorics'),
(25, 'CS 064'),
(26, 'CS 121'),
(27, 'CS 032');

-- --------------------------------------------------------

--
-- Table structure for table `R332_MemberLanguage`
--

CREATE TABLE IF NOT EXISTS `R332_MemberLanguage` (
  `fkLanguageID` int(10) unsigned NOT NULL,
  `fkMemberID` varchar(10) NOT NULL,
  PRIMARY KEY (`fkLanguageID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Contains which languages members know';

-- --------------------------------------------------------

--
-- Table structure for table `R332_Members`
--

CREATE TABLE IF NOT EXISTS `R332_Members` (
  `pkMemberID` varchar(10) NOT NULL,
  `FirstName` varchar(32) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Grade` varchar(15) DEFAULT NULL COMMENT 'Class Standing',
  `Bio` text,
  `Projects` text,
  `Website` varchar(255) DEFAULT NULL,
  `Picture` varchar(100) DEFAULT NULL,
  `Active` binary(1) NOT NULL,
  PRIMARY KEY (`pkMemberID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='A Crew Member';

--
-- Dumping data for table `R332_Members`
--

INSERT INTO `R332_Members` (`pkMemberID`, `FirstName`, `LastName`, `Grade`, `Bio`, `Projects`, `Website`, `Picture`, `Active`) VALUES
('ejeldrid', 'Ethan', 'Eldridge', 'Senior', 'I''m interested in Software Development, server-side coding and elegant coding. I''m the UPE Chapter President and a member of the Crew Triumvirate', 'The CS Crew Website Rehaul\r\nWiimote Smartboard Project', 'http://www.uvm.edu/~ejeldrid', NULL, '1'),
('gfritz', 'Garth', 'Fritz', 'Senior', NULL, 'Wiimote Smart Board', NULL, NULL, '1'),
('wmacewan', 'Scott', 'MacEwan', 'Senior', NULL, NULL, NULL, NULL, '1'),
('ahebib1', 'Ammar', 'Hebib', 'Senior', NULL, NULL, NULL, NULL, '1'),
('scperkin', 'Sean', 'Perkins', 'Senior', NULL, NULL, NULL, NULL, '1'),
('pkiripol', 'Paul', 'Kiripolsky', 'Sophomore', NULL, 'Robots!', NULL, NULL, '1'),
('jdicker1', 'Josh', 'Dickerson', 'Sophomore', NULL, NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `R332_Purpose`
--

CREATE TABLE IF NOT EXISTS `R332_Purpose` (
  `pkPurposeID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'integer key for purpose',
  `Purpose` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'purpose string',
  PRIMARY KEY (`pkPurposeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=ucs2 COMMENT='used for login purpose and generating reports' AUTO_INCREMENT=9 ;

--
-- Dumping data for table `R332_Purpose`
--

INSERT INTO `R332_Purpose` (`pkPurposeID`, `Purpose`) VALUES
(1, 'Study'),
(2, 'Help Hours'),
(3, 'Get Help'),
(4, 'Work on Project'),
(5, 'CSCrew Project'),
(6, 'Personal Project'),
(7, 'Meeting'),
(8, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `R332_Usage`
--

CREATE TABLE IF NOT EXISTS `R332_Usage` (
  `pkLogID` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'unique id for each login',
  `fkPersonID` varchar(10) NOT NULL COMMENT 'uvm login',
  `fkPurposeID` int(11) DEFAULT NULL COMMENT 'corresponds to R332_Purpose',
  `StartTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'time logged in',
  `Description` varchar(255) DEFAULT NULL COMMENT 'why are you here',
  `Class` varchar(3) NOT NULL DEFAULT '000' COMMENT 'cs course digits',
  PRIMARY KEY (`pkLogID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Used for reports for sign ins and such' AUTO_INCREMENT=16 ;

--
-- Dumping data for table `R332_Usage`
--

INSERT INTO `R332_Usage` (`pkLogID`, `fkPersonID`, `fkPurposeID`, `StartTime`, `Description`, `Class`) VALUES
(15, 'ejeldrid', 1, '2012-05-28 17:11:05', 'doing stuff!', '000'),
(14, 'ejeldrid', 1, '0000-00-00 00:00:00', 'doing stuff!', '000');

-- --------------------------------------------------------

--
-- Table structure for table `Social_Networks`
--

CREATE TABLE IF NOT EXISTS `Social_Networks` (
  `uvm_id` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `twitter` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `facebook` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tumblr` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `blogger` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `google` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `rss` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pintrest` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `reddit` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `myspace` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `git` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `linkedin` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`uvm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Social_Networks`
--

INSERT INTO `Social_Networks` (`uvm_id`, `twitter`, `facebook`, `tumblr`, `blogger`, `google`, `rss`, `pintrest`, `reddit`, `myspace`, `git`, `linkedin`) VALUES
('jdicker1', 'JoshuaDickerson', '', '', '', '', '', 'null', 'null', 'null', 'JoshuaDickerson', ''),
('', 'zzzzz', 'faceeee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
