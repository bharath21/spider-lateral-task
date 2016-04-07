-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2016 at 05:19 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `moviebuff`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `m_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `casting` varchar(255) NOT NULL,
  `year_of_release` varchar(255) NOT NULL,
  `avg_rating` float NOT NULL,
  `poster` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`m_id`, `title`, `description`, `casting`, `year_of_release`, `avg_rating`, `poster`) VALUES
(1, 'batman', 'an awesome movie', 'bruce wayne', '2009', 4, ''),
(2, 'pirates of carribean', 'so so movie', 'captain jack', '2016', 2.16, ''),
(3, 'theri', 'therrific movie', 'vijay,samantha', '2016', 3.75, ''),
(4, 'sardaar gabbarsingh', 'much awaited movie', 'pawankalyan,kajal', '2016', 3.5, ''),
(5, 'minions', 'superb movie', 'animation', '2016', 0, ''),
(6, 'ironman', 'superb', 'ironman', '2014', 0, ''),
(7, 'batman vs superman', 'dawn of justice ', 'wayne,superman', '2016', 0, 'image1.jpg'),
(8, 'captain america', 'omg all superheroes', 'everyone', '2016', 2.5, ''),
(9, 'spiderman', 'spider', 'spiderman', '2016', 0, ''),
(10, 'antman', 'ants ', 'ants eveywhere ', '2014', 0, ''),
(11, 'fan', 'srk nevwe before', 'srk', '2016', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `personal_information`
--

CREATE TABLE IF NOT EXISTS `personal_information` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal_information`
--

INSERT INTO `personal_information` (`id`, `username`, `name`, `dob`) VALUES
(1, 'bharath', 'bharath kondapalli', '2016-04-21'),
(2, 'bharath', 'bharath kondapalli', '2016-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `r_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`r_id`, `m_id`, `id`, `rating`) VALUES
(32, 2, 1, 1.5),
(33, 1, 1, 5),
(34, 3, 1, 2.5),
(35, 4, 1, 3.5),
(36, 1, 3, 3),
(37, 2, 3, 2),
(38, 1, 5, 4),
(39, 2, 5, 3),
(40, 3, 5, 5),
(41, 8, 5, 2.5);

-- --------------------------------------------------------

--
-- Table structure for table `users1`
--

CREATE TABLE IF NOT EXISTS `users1` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `sign_up_date` date NOT NULL,
  `bio` text NOT NULL,
  `profile_pic` text NOT NULL,
  `user_photos` text NOT NULL,
  `bookmark_array` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users1`
--

INSERT INTO `users1` (`id`, `username`, `email`, `password`, `sign_up_date`, `bio`, `profile_pic`, `user_photos`, `bookmark_array`) VALUES
(1, 'bharath', 'kondapallibharth@gmail.com', '5e9d11a14ad1c8dd77e98ef9b53fd1ba', '2016-04-05', '', '', '', ''),
(2, 'kondapallibharath', 'fakeemail@gmail.com', 'password', '2016-04-06', '', '', '', ''),
(3, 'newuser', 'k@g.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2016-04-07', '', 'Maged0GAOs9SJpP/WIN_20150801_15_23_33_Pro.jpg', '', ''),
(4, 'surajprakash', 'gollasurajprakash@gmail.com', '9d3f6621a320d65872cb2f9c3327f384', '2016-04-07', '', '', '', ''),
(5, 'surajprakashg', 'k@gje.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2016-04-07', '', '2PCgJXnKsUHrLv4/super13.jpg', '', ''),
(6, 'bharathkumar', 'kk@gg.cc', '9036f4b7cc6f116218c8e27429db313b', '2016-04-07', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `personal_information`
--
ALTER TABLE `personal_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`r_id`), ADD KEY `m_id` (`m_id`), ADD KEY `id` (`id`);

--
-- Indexes for table `users1`
--
ALTER TABLE `users1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `personal_information`
--
ALTER TABLE `personal_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `users1`
--
ALTER TABLE `users1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
