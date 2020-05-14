-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2014 at 04:16 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php_social_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `comment_date` int(50) NOT NULL,
  `comment` varchar(200) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `member_id`, `comment_date`, `comment`) VALUES
(1, 8, 1, 1410777943, 'Wow! Nice post'),
(2, 8, 1, 1410778417, 'How are you bro!'),
(3, 7, 1, 1410778774, 'Nice pic, '),
(4, 7, 1, 1410778787, 'Wow!'),
(5, 8, 1, 1411141957, 'I like this');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(100) NOT NULL,
  `file_type` varchar(10) NOT NULL,
  `file_size` int(100) NOT NULL,
  `member_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `file_name`, `file_type`, `file_size`, `member_id`, `post_id`) VALUES
(1, '10329781_356462304501028_3461479134724376580_o.jpg', 'image/jpeg', 142, 1, 2),
(2, 'Koala.jpg', 'image/jpeg', 763, 1, 3),
(3, 'Penguins.jpg', 'image/jpeg', 760, 1, 7),
(4, 'Tulips.jpg', 'image/jpeg', 606, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `friends_ID` int(11) NOT NULL AUTO_INCREMENT,
  `requestedMemberID` int(11) NOT NULL,
  `toMemberID` int(11) NOT NULL,
  `RequestedDate` int(50) NOT NULL,
  `Status` varchar(20) NOT NULL,
  PRIMARY KEY (`friends_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friends_ID`, `requestedMemberID`, `toMemberID`, `RequestedDate`, `Status`) VALUES
(2, 2, 1, 1410841338, 'Accepted'),
(3, 1, 3, 1410956497, 'Accepted'),
(4, 2, 3, 1410953839, 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `like_post`
--

CREATE TABLE IF NOT EXISTS `like_post` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `status` varchar(5) NOT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `like_post`
--

INSERT INTO `like_post` (`like_id`, `post_id`, `member_id`, `friend_id`, `status`) VALUES
(1, 8, 1, 1, 'True'),
(2, 8, 1, 1, 'True'),
(3, 8, 1, 1, 'True');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message_text` varchar(100) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `message_date` int(100) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `from_user_id`, `to_user_id`, `message_text`, `Status`, `message_date`) VALUES
(1, 1, 2, 'salam', 'Read', 1411198949),
(2, 1, 2, 'how are you?', 'Read', 1411199017),
(3, 1, 2, 'salam', 'Read', 1411205797),
(4, 1, 2, 'how do u do?', 'Read', 1411205824),
(5, 1, 2, 'are you there?', 'Read', 1411205830),
(6, 1, 2, 'yes?', 'Read', 1411205833),
(7, 1, 2, 'salam', 'Read', 1411228673),
(8, 1, 2, 'how are you dear?', 'Read', 1411228695),
(9, 2, 1, 'hello dear', 'Read', 1411229566),
(10, 2, 1, 'test', 'Read', 1411229788),
(11, 1, 2, 'hi', 'Read', 1411229852),
(12, 1, 2, 'alklkasdf', 'Read', 1411229958),
(13, 2, 1, 'hello', 'Read', 1411230003),
(14, 1, 2, 'hi', 'Read', 1411230007),
(15, 1, 2, 'what', 'Read', 1411230011),
(16, 1, 2, 'hi', 'Read', 1411230091),
(17, 2, 1, 'oo!', 'Read', 1411230104),
(18, 1, 2, 'hello!', 'Read', 1411230157),
(19, 1, 2, 'salam', 'Read', 1411230207),
(20, 2, 1, 'alikom salam', 'Read', 1411230214),
(21, 2, 1, 'hello!', 'Read', 1411230234),
(22, 1, 2, 'hi', 'Read', 1411230309),
(23, 1, 2, 'helllo', 'Read', 1411230318),
(24, 1, 2, 'a;lsdj', 'Read', 1411230320),
(25, 1, 2, 'a;lskdjf', 'Read', 1411230327),
(26, 1, 2, 'jfasldkjf', 'Read', 1411230330),
(27, 1, 2, 'a;lskdjf', 'Read', 1411230331),
(28, 1, 2, ';alksdjf', 'Read', 1411230332),
(29, 1, 2, 'l;aksdjf', 'Read', 1411230332),
(30, 1, 2, 'a;lksjdf', 'Read', 1411230333),
(31, 1, 2, ';laksjdf', 'Read', 1411230334),
(32, 1, 2, ';lakjdsf', 'Read', 1411230334),
(33, 1, 2, 'a;lksjdf', 'Read', 1411230335),
(34, 1, 2, ';laksjd', 'Read', 1411230335),
(35, 1, 2, ';laksjdf', 'Read', 1411230336),
(36, 1, 2, 'a;lskdjf', 'Read', 1411230336),
(37, 1, 2, 'alskdjf', 'Read', 1411230337),
(38, 1, 2, 'slkdjf', 'Read', 1411230337),
(39, 1, 2, 'sd;lkfja;lskdfja;sldkjf', 'Read', 1411230339),
(40, 1, 2, 'a;lsdkjf', 'Read', 1411230339),
(41, 1, 2, 'sdf;lakjsdf', 'Read', 1411230340),
(42, 1, 2, 'sd', 'Read', 1411230340),
(43, 1, 2, 'as', 'Read', 1411230340),
(44, 1, 2, 'a', 'Read', 1411230341),
(45, 1, 2, 'fa', 'Read', 1411230341),
(46, 1, 2, 'f', 'Read', 1411230341),
(47, 1, 2, 'f', 'Read', 1411230342),
(48, 1, 2, '', 'Read', 1411230342),
(49, 1, 2, 'f', 'Read', 1411230342),
(50, 1, 2, 'f', 'Read', 1411230342),
(51, 1, 2, 'asd', 'Read', 1411230343),
(52, 1, 2, 'asdf', 'Read', 1411230343),
(53, 1, 2, 'asd', 'Read', 1411230343),
(54, 1, 2, 'asd', 'Read', 1411230343),
(55, 1, 2, 'asd', 'Read', 1411230344),
(56, 1, 2, 's', 'Read', 1411230346),
(57, 1, 2, 'kaslkds', 'Read', 1411230352),
(58, 1, 2, 'kdkd', 'Read', 1411230354),
(59, 1, 2, 'slsls', 'Read', 1411230356),
(60, 1, 2, 'lsls', 'Read', 1411230357),
(61, 1, 2, 'ddkdkd', 'Read', 1411230359),
(62, 1, 2, 'hello!', 'Read', 1411230451),
(63, 1, 2, 'how are you?', 'Read', 1411230455);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `photo_id` int(20) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `photo_name` varchar(100) NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `album_id`, `status`, `photo_name`) VALUES
(3, 3, 'Public', '1_1411133511.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `photo_album`
--

CREATE TABLE IF NOT EXISTS `photo_album` (
  `photo_album_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_title` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cover_photo` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`photo_album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `photo_album`
--

INSERT INTO `photo_album` (`photo_album_id`, `album_title`, `user_id`, `cover_photo`, `status`) VALUES
(2, 'Flowers2', 1, '1_1411136566.jpg', 'Public'),
(3, 'Flowers', 1, '1_1411133497.jpg', 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `post_time` int(100) NOT NULL,
  `post_content` text NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `member_id`, `post_time`, `post_content`) VALUES
(1, 1, 1410348453, 'test'),
(2, 1, 1410348716, 'This is a test post'),
(3, 1, 1410350512, 'This is a lazy animal.\r\nLolzzz'),
(4, 1, 1410373901, 'Welcome to my profile.'),
(5, 1, 1410411556, 'Hello guys this is my new profile. Hope you guys like it.\r\nAnd also see other''s friends also.'),
(6, 3, 1410420548, 'Hello Guys I''m knew in facebook+ please guide me...'),
(7, 1, 1410431234, 'Hello all, how are you doing'),
(8, 1, 1410522722, 'Hi, guys this a post where I''m checking for errors and see weather its accepting long sentences. Hi, guys this a post where I''m checking for errors and see weather its accepting long sentences. Hi, guys this a post where I''m checking for errors and see weather its accepting long sentences. Hi, guys this a post where I''m checking for errors and see weather its accepting long sentences.'),
(9, 1, 1411227036, 'This is a test post'),
(10, 2, 1411227146, 'This is a test post');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `profile_photo` varchar(100) NOT NULL,
  `registration_date` int(100) NOT NULL,
  `activation_date` int(100) NOT NULL,
  `activation_code` varchar(20) NOT NULL,
  `user_status` varchar(10) NOT NULL,
  `LastOnline` int(100) NOT NULL,
  PRIMARY KEY (`user_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `first_name`, `last_name`, `email`, `phone`, `password`, `gender`, `dob`, `profile_photo`, `registration_date`, `activation_date`, `activation_code`, `user_status`, `LastOnline`) VALUES
(1, 'Mohammad Naim', 'Faizy', 'mnaim.faizy@gmail.com', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'Male', '1989-09-14', 'Lighthouse.jpg', 0, 0, '', 'Active', 1411230466),
(2, 'Ali', 'Abdullah', 'ali@yahoo.com', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'Male', '2014-08-02', 'male_user_profile_photo.jpg', 0, 0, '', 'Active', 1411230467),
(3, 'Ahmad Salim', 'Malikyar', 'salim.malikyar@gmail.com', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'Male', '1989-05-10', 'male_user_profile_photo.jpg', 0, 0, '', 'Active', 1410954859),
(4, 'Fahim', 'Pohmal', 'fahim.pohmal@yahoo.com', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'Male', '12-09-1990', 'male_user_profile_photo.jpg', 0, 0, '', 'Active', 0),
(5, 'Abdullah', 'Shiryar', 'abdullah-shiryar@gmail.com', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'Male', '20-10-1990', 'male_user_profile_photo.jpg', 0, 0, '', 'Active', 0),
(6, 'Sediqullah', 'Afghan', 'sediqullah@gmail.com', '', '5f4dcc3b5aa765d61d8327deb882cf99', 'Male', '13-09-1990', 'male_user_profile_photo.jpg', 0, 0, '', 'Active', 0);
