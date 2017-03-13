-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2017 at 09:20 AM
-- Server version: 5.7.17
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `npntraining`
--

-- --------------------------------------------------------

--
-- Table structure for table `hadoopinterviewqa`
--

CREATE TABLE `hadoopinterviewqa` (
  `questionid` mediumint(9) NOT NULL,
  `modulename` char(30) DEFAULT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hadoopinterviewqa`
--

INSERT INTO `hadoopinterviewqa` (`questionid`, `modulename`, `question`, `answer`) VALUES
(1, 'YARN', 'Question 01', 'Answer 01'),
(2, 'Pig', 'Question 02', 'Answer 02');

-- --------------------------------------------------------

--
-- Table structure for table `interview_category`
--

CREATE TABLE `interview_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `isactive` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interview_category`
--

INSERT INTO `interview_category` (`id`, `name`, `parent_id`, `isactive`) VALUES
(1, 'Hadoop', NULL, 1),
(2, 'Hadoop Core', 1, 1),
(3, 'YARN', 1, 1),
(4, 'Map Reduce Programming', 1, 1),
(5, 'Advance MapReduce Programming', 1, 1),
(6, 'Hive and HiveQL', 1, 1),
(7, 'Advance Hive', 1, 1),
(8, 'Pig Latin', 1, 1),
(9, 'No SQL and HBase', 1, 1),
(10, 'Sqoop', 1, 1),
(11, 'Pig', 1, 1),
(12, 'Java 1', NULL, 1),
(13, 'Core Java', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `interview_questions`
--

CREATE TABLE `interview_questions` (
  `id` mediumint(9) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interview_questions`
--

INSERT INTO `interview_questions` (`id`, `category_id`, `question`, `answer`) VALUES
(1, 3, 'Question 01', 'Answer 01'),
(2, 6, 'Question 02', 'Answer 02'),
(3, 6, ' alasdjflajfl 111', '<p>asldfjlas asfj lsdjfl 111</p>'),
(4, 4, 'Testing Question', '<p>Some information about the answer</p>\n<p>Result of the page</p>'),
(5, 2, 'Hadoop Question 2', '<p>Test answer</p>'),
(6, 6, 'New Question 007', '<p>Answer for new quest 007</p>'),
(7, 6, 'New Question 007', '<p>Answer for new question'),
(8, 4, 'Map Reduce new question 001', '<p>Map Reduce new question 001 and its answer</p>'),
(9, 4, 'Map Reduce new question 001', '<p>Map Reduce new question 001 and its answer 101</p>'),
(16, 10, 'One more question 111', '<p>And another answer 111</p>'),
(15, 10, 'One more question 111', '<p>And another answer 111</p>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hadoopinterviewqa`
--
ALTER TABLE `hadoopinterviewqa`
  ADD PRIMARY KEY (`questionid`);

--
-- Indexes for table `interview_category`
--
ALTER TABLE `interview_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interview_questions`
--
ALTER TABLE `interview_questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hadoopinterviewqa`
--
ALTER TABLE `hadoopinterviewqa`
  MODIFY `questionid` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `interview_category`
--
ALTER TABLE `interview_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `interview_questions`
--
ALTER TABLE `interview_questions`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
