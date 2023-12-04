-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 06:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classid`, `class_name`, `teacherid`, `class_capacity`) VALUES
(1, 'Reception Year', 4, 3),
(2, 'Year 1', 5, 3),
(3, 'Year 2', 6, 3),
(4, 'Year 3', 7, 3),
(5, 'Year 4', 8, 3),
(6, 'Year 5', 9, 3),
(7, 'Year 6', 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `libary`
--

CREATE TABLE `libary` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `pupil_id` int(11) DEFAULT NULL,
  `hand_in` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `medical_information`
--

CREATE TABLE `medical_information` (
  `medical_id` int(11) NOT NULL,
  `pupil_id` int(11) DEFAULT NULL,
  `medical_info` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_information`
--

INSERT INTO `medical_information` (`medical_id`, `pupil_id`, `medical_info`) VALUES
(0, 31, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `money`
--

CREATE TABLE `money` (
  `dinner_id` int(11) NOT NULL,
  `pupil_id` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `Parent_id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `pupil_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `parent_count` int(11) NOT NULL,
  `medical_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pupils`
--

INSERT INTO `pupils` (`pupil_id`, `classid`, `fname`, `lname`, `address`, `dinner_id`, `book_id`, `birthday`, `parent_count`, `medical_id`) VALUES
(31, 1, 'Frank', 'Sharpe', '73 clifton road, ll29 9sp ', NULL, NULL, '2018-12-13', 0, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `medical_information`
--
ALTER TABLE `medical_information`
  ADD PRIMARY KEY (`medical_id`),
  ADD KEY `pupil_id` (`pupil_id`);

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
  ADD KEY `fk_pupils_medical` (`medical_id`);

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
  MODIFY `pupil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
-- Constraints for table `medical_information`
--
ALTER TABLE `medical_information`
  ADD CONSTRAINT `medical_information_ibfk_1` FOREIGN KEY (`pupil_id`) REFERENCES `pupils` (`pupil_id`);

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

--
-- Constraints for table `pupils`
--
ALTER TABLE `pupils`
  ADD CONSTRAINT `fk_pupils_medical` FOREIGN KEY (`medical_id`) REFERENCES `medical_information` (`medical_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
