-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 04:36 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classid` int(11) NOT NULL,
  `class_name` varchar(50) DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `class_capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classid`, `class_name`, `teacherid`, `class_capacity`) VALUES
(1, 'class 1', 4, 0),
(2, 'class 2 ', 5, 0),
(3, 'class 3 ', 6, 0),
(4, 'class 4 ', 7, 0),
(5, 'class 5 ', 8, 0),
(6, 'class 6', 9, 0),
(7, 'class 7', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `libary`
--

CREATE TABLE `libary` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `pupil_id` int(11) DEFAULT NULL,
  `hand_in` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `libary`
--

INSERT INTO `libary` (`book_id`, `book_name`, `pupil_id`, `hand_in`) VALUES
(4, 'To Kill a Mockingbird', NULL, NULL),
(5, '1984', NULL, NULL),
(6, 'The Lord Of The Rings', NULL, NULL),
(7, 'Batman: The Killing Joke', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medical infomation`
--

CREATE TABLE `medical infomation` (
  `medical_id` int(11) NOT NULL,
  `pupil_id` int(11) NOT NULL,
  `medical_info` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `money`
--

CREATE TABLE `money` (
  `dinner_id` int(11) NOT NULL,
  `pupil_id` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `money`
--

INSERT INTO `money` (`dinner_id`, `pupil_id`, `amount`) VALUES
(10, NULL, NULL),
(11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `Parent_id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `pupil_id` int(11) DEFAULT NULL,
  `parent_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pupils`
--

CREATE TABLE `pupils` (
  `pupil_id` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `dinner_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `medical_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ta`
--

CREATE TABLE `ta` (
  `ta_id` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ta`
--

INSERT INTO `ta` (`ta_id`, `fname`, `lname`, `address`, `salary`, `phone`) VALUES
(1, 'Jurrien', 'Timber', '595 New Street, YORK, YO5 4LZ', 18, '07564758765'),
(2, 'Jakup', 'Kiwior', '21 Chester Road,STEVENAGE,SG45 6HS', 19, '65467586970'),
(3, 'Charles', 'Sagoe Jr', '344 Queens Road,WESTERN CENTRAL LONDON,WC46 9NJ', 17, '08764759375');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacherid` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `ta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacherid`, `fname`, `lname`, `address`, `phone`, `salary`, `ta_id`) VALUES
(4, 'Bukyo ', 'Saka ', '71 Church Street, NEWCASTLE UPON TYNE, NE77 2GJ', '75625274859', 30, 1),
(5, 'Aaron', 'Ramsdale', '27 The Drive, BOLTON, BL63 4AJ', '0953658683', 27, 2),
(6, 'Leandro', 'Trossard', '39 Albert Road, BLACKBURN, BB71 4RZ', '09862657485', 29, 3),
(7, 'Ben', 'White', '998 Main Road,WEST LONDON,W8 1TX', '07863546593', 31, NULL),
(8, 'Fabio', 'Viera', '44 New Road,INVERNESS,IV32 0UA', '0551358583', 41, NULL),
(9, 'Martin', 'Odegaard', '998 Main Road,WEST LONDON, W8 1TX', '07536584756', 47, NULL),
(10, 'Oleksandr', 'Zinchenko', '3 Kingsway,SOUTH WEST LONDON, SW21 1SA', '07653476859', 34, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classid`),
  ADD KEY `teacherid` (`teacherid`);

--
-- Indexes for table `libary`
--
ALTER TABLE `libary`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `pupil_id` (`pupil_id`);

--
-- Indexes for table `medical infomation`
--
ALTER TABLE `medical infomation`
  ADD PRIMARY KEY (`medical_id`);

--
-- Indexes for table `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`dinner_id`),
  ADD KEY `pupil_id` (`pupil_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`Parent_id`),
  ADD KEY `pupil_id` (`pupil_id`);

--
-- Indexes for table `pupils`
--
ALTER TABLE `pupils`
  ADD PRIMARY KEY (`pupil_id`),
  ADD KEY `dinner_id` (`dinner_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `classes_FK_1` (`classid`),
  ADD KEY `meical_id` (`medical_id`);

--
-- Indexes for table `ta`
--
ALTER TABLE `ta`
  ADD PRIMARY KEY (`ta_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacherid`),
  ADD KEY `ta_id` (`ta_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `classid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `libary`
--
ALTER TABLE `libary`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `medical infomation`
--
ALTER TABLE `medical infomation`
  MODIFY `medical_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `money`
--
ALTER TABLE `money`
  MODIFY `dinner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `Parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pupils`
--
ALTER TABLE `pupils`
  MODIFY `pupil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ta`
--
ALTER TABLE `ta`
  MODIFY `ta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacherid`) REFERENCES `teachers` (`teacherid`);

--
-- Constraints for table `libary`
--
ALTER TABLE `libary`
  ADD CONSTRAINT `libary_ibfk_1` FOREIGN KEY (`pupil_id`) REFERENCES `pupils` (`pupil_id`);

--
-- Constraints for table `money`
--
ALTER TABLE `money`
  ADD CONSTRAINT `money_ibfk_1` FOREIGN KEY (`pupil_id`) REFERENCES `pupils` (`pupil_id`);

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `parents_ibfk_1` FOREIGN KEY (`pupil_id`) REFERENCES `pupils` (`pupil_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
