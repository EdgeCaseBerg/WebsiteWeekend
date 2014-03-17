-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: webdb.uvm.edu
-- Generation Time: Aug 31, 2013 at 01:19 PM
-- Server version: 5.5.32-31.0-log
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `CSCREW_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblContactEmails`
--

CREATE TABLE IF NOT EXISTS `tblContactEmails` (
  `pkID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(35) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`pkID`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='This table defines who should be receiving emails from the c' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblContactEmails`
--

INSERT INTO `tblContactEmails` (`pkID`, `email`) VALUES
(1, 'uvm.cscrew@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblExpertise`
--

CREATE TABLE IF NOT EXISTS `tblExpertise` (
  `fkUserID` int(11) NOT NULL,
  `fkLangID` int(11) NOT NULL,
  PRIMARY KEY (`fkUserID`,`fkLangID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Defines which members know which languages';

--
-- Dumping data for table `tblExpertise`
--

INSERT INTO `tblExpertise` (`fkUserID`, `fkLangID`) VALUES
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(14, 6),
(14, 7),
(14, 9),
(14, 10),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(15, 7),
(15, 9),
(15, 10),
(29, 4),
(30, 4),
(33, 1),
(33, 2),
(33, 3),
(33, 4),
(33, 5),
(33, 6),
(33, 7),
(33, 9),
(33, 10),
(34, 1),
(34, 2),
(34, 3),
(34, 4),
(34, 7),
(34, 9),
(34, 10),
(35, 1),
(35, 2),
(35, 4),
(35, 6),
(35, 9),
(35, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tblFrontPageImages`
--

CREATE TABLE IF NOT EXISTS `tblFrontPageImages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(100) NOT NULL,
  `description` varchar(400) NOT NULL,
  `title` varchar(150) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblFrontPageImages`
--

INSERT INTO `tblFrontPageImages` (`id`, `path`, `description`, `title`, `sort_order`) VALUES
(1, '1.jpg', 'Some picture of stuff', 'Some thing', 1),
(2, '2.jpg', 'Some picture of other stuff', 'Other thing', 2),
(3, '3.jpg', 'Again, just some picture of some stuff', 'Other other thing', 3),
(4, '4.jpg', 'ONCE AGAIN ITS A FUCKING PICTURE', 'JEBUS STRIKES AGAIN', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblHours`
--

CREATE TABLE IF NOT EXISTS `tblHours` (
  `fkCrewID` int(11) NOT NULL,
  `day` varchar(6) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Mon,Tues,Wednes,Thurs,Fri',
  `hour` time NOT NULL,
  `endHour` time NOT NULL,
  KEY `fkCrewID` (`fkCrewID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblHours`
--

INSERT INTO `tblHours` (`fkCrewID`, `day`, `hour`, `endHour`) VALUES
(12, 'Wednes', '00:09:09', '00:00:00'),
(12, 'Tues', '00:13:01', '00:00:00'),
(15, 'Tues', '00:10:30', '00:00:00'),
(14, 'Mon', '00:10:40', '00:24:00'),
(14, 'Mon', '00:10:40', '00:00:00'),
(14, 'Fri', '00:12:30', '00:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `tblLanguages`
--

CREATE TABLE IF NOT EXISTS `tblLanguages` (
  `pkID` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`pkID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tblLanguages`
--

INSERT INTO `tblLanguages` (`pkID`, `language`) VALUES
(1, 'PHP'),
(2, 'Java'),
(3, 'Matlab'),
(4, 'Python'),
(5, 'C'),
(6, 'C++'),
(7, 'C#'),
(8, 'Objective-C'),
(9, 'HTML/CSS/JS'),
(10, 'MySQL');

-- --------------------------------------------------------

--
-- Table structure for table `tblNews`
--

CREATE TABLE IF NOT EXISTS `tblNews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `path` varchar(120) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `image` varchar(100) NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `tblNews`
--

INSERT INTO `tblNews` (`id`, `title`, `created_at`, `path`, `image`, `is_published`) VALUES
(2, 'Test Story 2', '2012-04-30 00:00:00', 'test_story_2', '', 0),
(28, 'Computer Science Students Take HackVT for the Win', '2012-10-31 19:19:18', 'Computer_Science_Students_Take_HackVT_for_the_Win_1', 'Computer_Science_Students_Take_HackVT_for_the_Win_1.jpg', 1),
(29, 'Peer To Peer Advising Night', '2012-04-30 19:22:47', 'Peer_To_Peer_Advising_Night_1', 'Peer_To_Peer_Advising_Night_1_image.jpg', 1),
(33, 'CSCrew Creates A Site In a Weekend', '2013-04-11 20:51:31', 'CSCrew_Creates_A_Site_In_a_Weekend_1', '', 1),
(34, 'A New Post', '2013-05-08 18:33:45', 'A_New_Post_1', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblProjects`
--

CREATE TABLE IF NOT EXISTS `tblProjects` (
  `pkID` int(10) NOT NULL AUTO_INCREMENT,
  `team` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `projName` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`pkID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tblProjects`
--

INSERT INTO `tblProjects` (`pkID`, `team`, `projName`, `url`, `status`, `description`) VALUES
(1, 'CS Crew', 'CS Crew Website 3.0', 'https://github.com/EJEHardenberg/WebsiteWeekend/commits/master.atom', 'Active', 'We are refactoring and recreating the CS Crews website '),
(2, 'Collateral Dama', 'Green Bean', 'https://github.com/the-hobbes/HackVT/commits/master.atom', 'Complete', 'Hack VT Winning Competition'),
(10, 'Justins', 'Digital Systems', 'https://github.com/justcadams/Digital-Design/commits/master.atom', 'Active', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblPurpose`
--

CREATE TABLE IF NOT EXISTS `tblPurpose` (
  `pkId` int(10) NOT NULL AUTO_INCREMENT,
  `purpose` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Text displayed on login website',
  PRIMARY KEY (`pkId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='defines the list of purposes displayed on the login screen' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tblPurpose`
--

INSERT INTO `tblPurpose` (`pkId`, `purpose`) VALUES
(1, 'Get Help'),
(2, 'Study'),
(3, 'Project Night'),
(4, 'Provide Help'),
(5, 'Meeting/Presentation'),
(6, 'Personal Project');

-- --------------------------------------------------------

--
-- Table structure for table `tblRoomUsage`
--

CREATE TABLE IF NOT EXISTS `tblRoomUsage` (
  `pkID` int(10) NOT NULL AUTO_INCREMENT,
  `uvmID` varchar(8) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fkPurpose` int(10) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `visitDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `classYear` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`pkID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Logs the usage of room 332' AUTO_INCREMENT=159 ;

--
-- Dumping data for table `tblRoomUsage`
--

INSERT INTO `tblRoomUsage` (`pkID`, `uvmID`, `fkPurpose`, `description`, `visitDate`, `classYear`) VALUES
(16, 'ejeldrid', 2, 'I''m doing stuff', '2013-04-08 02:35:13', 'Senior'),
(17, 'ejeldrid', 3, '', '2013-04-08 02:35:22', 'Senior'),
(18, 'jdicker1', 4, '', '2013-04-08 02:35:30', 'Junior'),
(19, 'ejeldrid', 1, '', '2013-04-08 02:35:35', 'Senior'),
(20, 'ejeldrid', 1, '', '2013-04-08 02:35:37', 'Senior'),
(21, 'ejeldrid', 1, '', '2013-04-08 02:35:39', 'Senior'),
(22, 'ejeldrid', 1, '', '2013-04-08 02:35:40', 'Senior'),
(23, 'ejeldrid', 1, '', '2013-04-08 02:35:42', 'Senior'),
(24, 'jdicker1', 6, 'nuthin', '2013-04-08 18:15:05', 'Junior'),
(25, 'gfritz', 6, 'IOUG conference on my computer', '2013-04-08 18:15:32', 'Senior'),
(26, 'pvendevi', 6, 'class programming', '2013-04-08 18:18:25', 'Senior'),
(27, 'ajlarson', 2, '', '2013-04-08 18:27:36', 'First Year'),
(28, 'pkiripol', 2, '', '2013-04-08 18:50:59', 'Junior'),
(29, 'dsteimke', 2, '', '2013-04-08 19:00:53', 'Senior'),
(30, 'dleach', 2, '', '2013-04-08 19:56:53', 'Senior'),
(31, 'nmai', 2, '', '2013-04-08 19:58:26', 'First Year'),
(32, 'ahebib1', 2, '', '2013-04-08 20:01:09', 'Senior'),
(33, 'jadams7', 1, '', '2013-04-08 20:01:22', 'Senior'),
(34, 'jpdee', 1, 'Code fo determine the forces in a member of a structure.\r\n', '2013-04-08 20:02:17', 'Junior'),
(35, 'nmai', 2, '', '2013-04-08 22:26:44', 'First Year'),
(36, 'wmacewan', 2, '', '2013-04-09 00:34:27', 'Senior'),
(37, 'nmai', 2, '', '2013-04-09 13:45:28', 'First Year'),
(38, 'jdicker1', 2, '206 homework\r\n', '2013-04-09 13:57:59', 'Junior'),
(39, 'wmacewan', 2, '', '2013-04-09 15:20:50', 'Senior'),
(40, 'pvendevi', 2, 'Working on stuff', '2013-04-09 15:30:49', 'Senior'),
(41, 'dwilding', 2, '', '2013-04-09 16:25:32', 'Senior'),
(42, 'ejeldrid', 2, '', '2013-04-09 16:44:21', 'Senior'),
(43, 'adunkija', 1, 'CS 21 Lab', '2013-04-09 16:47:16', 'Junior'),
(44, 'jclemons', 1, 'matlab\r\n', '2013-04-09 16:58:51', 'Sophomore'),
(45, 'cabishop', 1, 'cs 21', '2013-04-09 17:33:20', 'Sophomore'),
(46, 'wmacewan', 2, '', '2013-04-09 19:26:36', 'Senior'),
(47, 'gfritz', 2, 'data mining presentation', '2013-04-09 19:26:50', 'Senior'),
(48, 'msulli17', 2, '', '2013-04-09 19:29:36', 'Senior'),
(49, 'rcnorton', 2, '', '2013-04-09 20:09:31', 'Junior'),
(50, 'nmai', 2, '', '2013-04-10 01:06:55', 'First Year'),
(51, 'alebeau', 6, '', '2013-04-10 15:41:34', 'Sophomore'),
(52, 'pbush', 6, '', '2013-04-10 15:41:55', 'Sophomore'),
(53, 'nmai', 1, '', '2013-04-10 16:40:53', 'First Year'),
(54, 'nmai', 2, '', '2013-04-10 20:03:42', 'First Year'),
(55, 'wmacewan', 2, '', '2013-04-10 22:09:11', 'Senior'),
(56, 'rcnorton', 2, '', '2013-04-10 22:15:56', 'Junior'),
(57, 'pkiripol', 2, '', '2013-04-11 13:54:51', 'Junior'),
(58, 'pvendevi', 2, '', '2013-04-11 15:47:22', 'Senior'),
(59, 'wmacewan', 2, '', '2013-04-11 19:58:56', 'Senior'),
(60, 'wmacewan', 4, '', '2013-04-11 20:09:00', 'Senior'),
(61, 'fhazlehu', 2, '', '2013-04-11 20:14:41', 'First Year'),
(62, 'gfritz', 2, '', '2013-04-11 21:09:46', 'Senior'),
(63, 'dpsander', 3, '', '2013-04-11 22:09:29', 'Junior'),
(64, 'gfritz', 3, 'cs crew website work', '2013-04-11 22:47:30', 'Senior'),
(65, 'ejeldrid', 3, 'Project Night!', '2013-04-11 22:47:45', 'Senior'),
(66, 'fhazlehu', 2, '', '2013-04-11 22:48:49', 'First Year'),
(67, 'pmleblan', 3, '', '2013-04-11 22:57:20', 'Junior'),
(68, 'nmai', 2, '', '2013-04-12 01:39:52', 'First Year'),
(69, 'dpsander', 3, '', '2013-04-12 14:19:37', 'Junior'),
(70, 'nmai', 2, '', '2013-04-12 14:22:01', 'First Year'),
(71, 'dwilding', 2, '', '2013-04-12 14:31:03', 'Senior'),
(72, 'nmai', 2, '', '2013-04-12 22:43:14', 'First Year'),
(73, 'ejeldrid', 6, 'CS Crew Website', '2013-04-13 03:28:06', 'Senior'),
(74, 'wmacewan', 6, 'Cs Crew website', '2013-04-13 03:28:38', 'Senior'),
(75, 'jdicker1', 6, 'cscrew website', '2013-04-13 03:28:56', 'Junior'),
(76, 'nmai', 2, '', '2013-04-13 15:43:04', 'First Year'),
(77, 'gfritz', 4, 'learning coop cs drop in hour', '2013-04-14 16:06:47', 'Senior'),
(78, 'ejeldrid', 6, 'CS Crew Website', '2013-04-18 01:44:19', 'Senior'),
(79, 'gdragoon', 2, 'blah', '2013-04-18 14:16:59', 'Junior'),
(80, 'wmacewan', 2, '', '2013-04-18 15:21:32', 'Senior'),
(81, 'ahebib1', 4, 'cs 08', '2013-04-18 15:25:36', 'Senior'),
(82, 'pvendevi', 2, 'workworkworkworkworkwork', '2013-04-18 15:33:35', 'Senior'),
(83, 'ejeldrid', 2, '', '2013-04-18 17:08:24', 'Senior'),
(84, 'pjglenno', 6, 'FIND MY CHARGER. FIND ITTTTTT\r\n', '2013-04-18 17:08:53', 'Senior'),
(85, 'mksargen', 2, 'MATLAB', '2013-04-18 17:36:41', 'First Year'),
(86, 'pmleblan', 3, '', '2013-04-18 19:17:51', 'Junior'),
(87, 'pvendevi', 2, 'se final project', '2013-04-18 19:40:19', 'Senior'),
(88, 'ejeldrid', 3, 'Working on CS Crew Website', '2013-04-18 22:47:02', 'Senior'),
(89, 'dleach', 2, '', '2013-04-19 00:06:40', 'Senior'),
(90, 'dpsander', 5, '', '2013-04-19 14:22:54', 'Junior'),
(91, 'pkiripol', 2, '', '2013-04-19 15:38:04', 'Junior'),
(92, 'dleach', 2, '', '2013-04-20 15:04:42', 'Senior'),
(93, 'ejeldrid', 5, 'Software Engineering final Project', '2013-04-21 14:52:58', 'Senior'),
(94, 'pvendevi', 2, 'rat cat !!!', '2013-04-21 15:58:50', 'Senior'),
(95, 'gfritz', 4, 'drop-in cs hour for learning co-op', '2013-04-21 16:14:38', 'Senior'),
(96, 'wmacewan', 2, '', '2013-04-22 01:21:58', 'Senior'),
(97, 'ahebib1', 2, 'cs 206 project', '2013-04-22 01:22:22', 'Senior'),
(98, 'pkiripol', 2, 'Ugh.', '2013-04-22 01:22:30', 'Junior'),
(99, 'pmleblan', 3, 'debugging yo', '2013-04-22 01:23:22', 'Junior'),
(100, 'jadams7', 2, 'EE 231 & EE184 & CS 395', '2013-04-22 01:24:12', 'Senior'),
(101, 'wmacewan', 2, '', '2013-04-22 14:37:31', 'Senior'),
(102, 'pvendevi', 2, '', '2013-04-22 15:30:27', 'Senior'),
(103, 'gfritz', 2, 'cs 142 final project work', '2013-04-22 17:54:01', 'Senior'),
(104, 'gfritz', 2, 'cs 142 final project work', '2013-04-22 20:01:32', 'Senior'),
(105, 'pvendevi', 2, '', '2013-04-23 15:32:05', 'Senior'),
(106, 'cdewitt', 6, '', '2013-04-23 15:38:12', 'Senior'),
(107, 'ahebib1', 4, '', '2013-04-23 15:38:37', 'Senior'),
(108, 'ejeldrid', 2, 'sitting around before algorithms', '2013-04-23 16:39:29', 'Senior'),
(109, 'jclemons', 1, 'matlab', '2013-04-23 17:17:25', 'Sophomore'),
(110, 'mftoth', 6, '206 ', '2013-04-23 17:26:35', 'Junior'),
(111, 'pkiripol', 2, 'RIBITS!\r\n', '2013-04-23 18:28:38', 'Junior'),
(112, 'ahebib1', 2, '', '2013-04-23 18:29:04', 'Senior'),
(113, 'msulli17', 2, '', '2013-04-23 20:57:01', 'Senior'),
(114, 'ejeldrid', 2, '', '2013-04-23 21:03:12', 'Senior'),
(115, 'dpsander', 1, '', '2013-04-23 22:17:55', 'Junior'),
(116, 'ejeldrid', 2, '', '2013-04-23 22:34:37', 'Senior'),
(117, 'gfritz', 2, 'cs142 final site', '2013-04-23 22:35:15', 'Senior'),
(118, 'amille34', 3, 'solidworks model\r\n', '2013-04-23 23:00:35', 'Sophomore'),
(119, 'rjtemple', 2, 'CS 125/124', '2013-04-23 23:21:24', 'Sophomore'),
(120, 'kjwoodwa', 2, '', '2013-04-23 23:45:02', 'Sophomore'),
(121, 'mharri11', 2, 'Stuff (124)', '2013-04-23 23:56:59', 'Junior'),
(122, 'rcary', 2, '124 related stuff', '2013-04-23 23:57:15', 'Junior'),
(123, 'solson1', 2, 'cs124\r\n', '2013-04-23 23:57:40', 'Sophomore'),
(124, 'mharri11', 2, 'Bioloy - I mean, CS', '2013-04-24 14:18:51', 'Junior'),
(125, 'jaswasey', 2, '', '2013-04-24 16:33:32', 'Senior'),
(126, 'ejeldrid', 2, '', '2013-04-24 16:48:05', 'Senior'),
(127, 'ejeldrid', 2, '', '2013-04-24 18:41:53', 'Senior'),
(128, 'cdewitt', 2, '', '2013-04-24 19:37:56', 'Senior'),
(129, 'dleach', 2, '', '2013-04-24 20:18:15', 'Senior'),
(130, 'ejeldrid', 6, 'Learning from Udacity', '2013-04-24 21:42:48', 'Senior'),
(131, 'ahebib1', 2, 'cs 206', '2013-04-25 00:43:50', 'Senior'),
(132, 'wmacewan', 2, '', '2013-04-25 00:55:35', 'Senior'),
(133, 'ejeldrid', 5, 'Working with scott on 224 and 226', '2013-04-25 03:14:16', 'Senior'),
(134, 'mftoth', 6, '206', '2013-04-25 03:20:03', 'Junior'),
(135, 'ejeldrid', 2, '', '2013-04-25 16:34:34', 'Senior'),
(136, 'cdewitt', 2, '', '2013-04-25 17:12:17', 'Senior'),
(137, 'mharri11', 2, 'CS125', '2013-04-25 19:42:50', 'Junior'),
(138, 'dpsander', 6, '', '2013-04-25 21:38:41', 'Junior'),
(139, 'easher', 3, 'euler problem', '2013-04-25 22:51:10', 'Sophomore'),
(140, 'jmaslow', 3, 'various web projects\r\n', '2013-04-25 22:51:35', 'Sophomore'),
(141, 'wmacewan', 3, '', '2013-04-25 22:51:46', 'Senior'),
(142, 'ejeldrid', 3, 'YAY!', '2013-04-25 22:52:26', 'Senior'),
(143, 'jadams7', 3, 'Projects!', '2013-04-25 22:52:38', 'Senior'),
(144, 'dwilding', 2, '', '2013-04-26 14:30:01', 'Senior'),
(145, 'solson1', 2, 'cs125 turing machine', '2013-04-26 16:07:11', 'Sophomore'),
(146, 'mharri11', 2, 'CS 124 125', '2013-04-26 16:44:25', 'Junior'),
(147, 'kjwoodwa', 2, '', '2013-04-26 17:24:43', 'Sophomore'),
(148, 'rjtemple', 2, 'CS 125/124', '2013-04-26 17:39:08', 'Sophomore'),
(149, 'jpsheeha', 2, '', '2013-04-26 17:49:27', 'Sophomore'),
(150, 'ejeldrid', 2, '', '2013-04-26 20:35:07', 'Senior'),
(151, 'rcary', 2, 'CS124, 125, and 195', '2013-04-27 14:53:15', 'Junior'),
(152, 'rjtemple', 2, 'CS 125/124/195', '2013-04-27 15:06:26', 'Sophomore'),
(153, 'ejeldrid', 2, '', '2013-04-27 15:17:49', 'Senior'),
(154, 'dleach', 2, '', '2013-04-27 20:43:07', 'Senior'),
(155, 'ejeldrid', 2, '', '2013-04-28 17:08:12', 'Senior'),
(156, 'jdicker1', 6, 'site', '2013-04-28 17:08:35', 'Junior'),
(157, 'wmacewan', 6, '', '2013-04-28 18:03:55', 'Senior'),
(158, 'dleach', 2, '', '2013-04-28 18:21:26', 'Senior');

-- --------------------------------------------------------

--
-- Table structure for table `tblTutorials`
--

CREATE TABLE IF NOT EXISTS `tblTutorials` (
  `pkTutorialId` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldURL` varchar(400) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldTitle` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldCategory` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'No Category',
  `fldPublished` binary(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkTutorialId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblTutorials`
--

INSERT INTO `tblTutorials` (`pkTutorialId`, `fldURL`, `fldTitle`, `fldCategory`, `fldPublished`) VALUES
('1366337779', 'http%3A%2F%2Fwww.uvm.edu%2F%7Eejeldrid', 'Ethan Eldridges Website', 'Personals', '1'),
('1366337799', 'www.google.com', 'Google', 'No Category', '1'),
('1366346911', 'www.facebook.com', 'The god awful Facebook', 'No Category', '1'),
('1366939445', 'www.vhfa.org', 'VHFA', 'Jobs', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tblUserAccount`
--

CREATE TABLE IF NOT EXISTS `tblUserAccount` (
  `pkUserID` int(11) NOT NULL AUTO_INCREMENT,
  `fldUsername` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldPassword` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldAuth` int(11) NOT NULL,
  `fldEmail` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `fldLostPasswordHash` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`pkUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `tblUserAccount`
--

INSERT INTO `tblUserAccount` (`pkUserID`, `fldUsername`, `fldPassword`, `fldAuth`, `fldEmail`, `active`, `fldLostPasswordHash`) VALUES
(13, 'test', '$2a$15$7t9OYT9qRGLQbhdlBaoMhOhPTgFhPdMpSlDW1MeGDksCJTcRtxKrm', 1, '', 1, ''),
(14, 'Ethan', '$2a$15$Xt2Hnv1H9nEpNCvnOYJ2Y.tS8WvNEc6C1HbuJFJ0H4F.2RnxfVsZS', 3, 'ejeldrid@uvm.edu', 1, ''),
(19, 'Garth', '$2a$15$q8XXelcdSLqRX8TTmwsgxeui6MoSZYgn4ph45H02i0mqJCeEvy4jC', 1, '', 1, ''),
(20, 'Dillan', '$2a$15$px8/r4xxV7o/HHDNsAcIHeGXHg0dioQ3fMSBX8jyLBJGb2bCDbpoi', -1, '', 1, ''),
(21, 'Danielle', '$2a$15$WD72DFOs3ew.UGNkuZutQu1oB7DA8iDuO0GxKgU2my61cDhuJmzFu', 1, '', 1, ''),
(27, 'neat', '$2a$15$/Qh7TwZnJed5WJPVEdXQY.Bcn3jNKxtYFQLinSYmHqQQAOffp0cJ6', -1, '', 0, ''),
(29, 'pheven', '$2a$15$jrkh3QtYS7MWLGdpf7no9uUBanTC8RwbbCbkAjSfF5XdZFQet13lK', 1, '', 0, ''),
(30, 'gggggg', '$2a$15$azUlqW81rqQ0/HCeOs.ABu6Llx8MvGLeR9lL4x.AK6.kLcUMr9Bfe', 1, '', 0, ''),
(31, 'homer', '$2a$15$wkUSa4iBWFNwXCCBrSZD4O6zaingpAw5lD/CgjNZKeRTOp.68TC8i', 1, '', 0, ''),
(32, '', '$2a$15$ge3.R8SfGMluc4ea4NIliOb7moSSWKUeGhEYfj4ckfvcJOskI0BTu', 3, 'joshuajdickerson@gmail.com', 1, 'WmJpY6Jprbfz3chLYbWn'),
(34, '', '$2a$15$1v5c9kDkcRVyZr74Azbj3eqXGREsY9WBtnm5cmx3c5ntYhuLChhtS', 3, 'wsmacewan101@gmail.com', 0, ''),
(35, '', '$2a$15$XP.37azt8ZcNdCNvXLaUWePNijD9o070CBj4FNQyfYFjZ1e/saP22', 1, 'Ammar.Hebib@gmail.com', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblUserProfile`
--

CREATE TABLE IF NOT EXISTS `tblUserProfile` (
  `fkUserID` int(11) NOT NULL,
  `fldProfileImage` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldFirstName` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldLastName` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldPersonalURL` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldAboutMe` text NOT NULL,
  `fldGitURL` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldTwitterURL` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldFacebookURL` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldTumblrURL` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldLinkedinURL` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldGoogleURL` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldClassStanding` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fldMajor` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`fkUserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblUserProfile`
--

INSERT INTO `tblUserProfile` (`fkUserID`, `fldProfileImage`, `fldFirstName`, `fldLastName`, `fldPersonalURL`, `fldAboutMe`, `fldGitURL`, `fldTwitterURL`, `fldFacebookURL`, `fldTumblrURL`, `fldLinkedinURL`, `fldGoogleURL`, `fldClassStanding`, `fldMajor`) VALUES
(13, '', 'test', 'test', '', '', '', '', '', '', '', '', '', ''),
(14, '', 'Ethan', 'Eldridge', 'http://www.uvm.edu/~ejeldrid', 'Avid coder. Patient Scientist.', '', '', '', '', '', '', '', ''),
(15, '', 'Scott', 'MacEwan', 'http:/', 'I am a Senior at UVM getting a BS in CS and a BA in Math. Currently I have an internship at Blue House Group a web design firm in Richmond Vermont.', 'smacewan101', '', '', '', '', '', '', ''),
(16, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(17, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(19, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(20, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(21, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(22, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(23, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(24, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(25, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(26, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(27, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(28, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(29, 'user_id_29.jpg', 'Phelan', 'Vendeville', 'uvm.edu/~pvendevi', 'I am pretty ok I guess.', '', '', '', '', '', '', '', ''),
(30, '', 'dfgsdgsdfg', 'vgyvfyvvgy', '', '', '', '', '', '', '', '', '', ''),
(31, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(32, 'user_id_32.jpg', 'Josh', 'Dickerson', 'http://www.joshuadickerson.com', 'I am an Iraq combat veteran, web-developer, and former industrial generator technician. ', 'https://github.com/JoshuaDickerson/', 'https://twitter.com/JoshuaDickerson', 'https://www.facebook.com/joshua.dickerson.543', '', 'http://www.linkedin.com/profile/view?id=183647006', 'https://plus.google.com/u/0/105133887961507598097/posts', 'Senior', 'BS-CSIS'),
(33, '', 'Amy', 'Hardenberg', 'www.uvm.edu/~ejeldrid', 'Ethan''s alt profile so that he can test things because he forget his password.', 'https://github.com/EJEHardenberg', 'https://twitter.com/EthanJEldridge', '', '', '', '', '', ''),
(34, '', 'Scott', 'MacEwan', '', 'I rock', '', '', '', '', '', '', '', ''),
(35, '', '', '', '', '', '', '', '', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
