-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 11:23 AM
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
(4, 'To Kill a Mockingbird', 43, '2024-04-01'),
(5, '1984', 39, '2024-06-14'),
(6, 'The Lord Of The Rings', 36, '2024-04-13'),
(7, 'Batman: The Killing Joke', 34, '2024-01-29');

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
(2, 33, 'Alergic to egg'),
(3, 34, 'Alergic to Gluten'),
(4, 35, 'N/A'),
(5, 36, 'alergic to Dairy'),
(6, 37, 'N/A'),
(7, 38, 'N/A'),
(8, 39, 'Alergic to Gluten'),
(9, 40, 'Alergic to Peanuts'),
(10, 41, 'alergic to Dairy'),
(11, 42, 'N/A'),
(12, 43, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `money`
--

CREATE TABLE `money` (
  `dinner_id` int(11) NOT NULL,
  `pupil_id` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `money`
--

INSERT INTO `money` (`dinner_id`, `pupil_id`, `amount`) VALUES
(12, 43, 5.32),
(13, 42, 1.23),
(14, 41, 3.34),
(15, 40, 9.5),
(16, 39, 0.5),
(17, 38, 2.95),
(18, 37, 3.38),
(19, 36, 5.44),
(20, 35, 2.12),
(21, 34, 4.55),
(22, 33, 6.6);

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

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`Parent_id`, `fname`, `lname`, `phone`, `pupil_id`) VALUES
(4, 'Emily ', 'Turner', '07700123456', 40),
(5, 'Daniel', 'Harris', '07812345678', 33),
(6, 'Rebecca', ' Patel', '07923456789', 34),
(7, ' Andrew ', 'Robinson', '07654321987', 34),
(8, 'Sarah', ' Green', '07890234567', 42),
(9, 'Matthew', ' Green', '07543210876', 42),
(10, 'Samantha ', 'Ward', '07789543210', 35),
(11, 'James ', 'Clarke', '07987654321', 39),
(12, 'Lauren', ' King', '07678901234', 39),
(13, 'Ryan ', 'Lewis', '07876543210', 36),
(14, 'Olivia', ' Mitchell', '07711223344', 33);

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
(33, 7, 'Aiden ', 'Clark', '19 Oak Close, Belfast, BT1 4NN', 22, NULL, '2011-11-07', 1, 2),
(34, 1, 'Grace ', 'Lewis', '5 Birch Lane, Cardiff, CF10 1DS', 21, 7, '2019-01-14', 2, 3),
(35, 2, 'Jack ', 'Evans', '8 Willow Crescent, Edinburgh, EH3 7TY', 20, NULL, '2017-05-16', 1, 4),
(36, 3, 'Mia ', 'Walker', '10 Holly Road, Sheffield, S2 2BG', 19, 6, '2016-03-18', 1, 5),
(37, 7, 'Mason ', 'Green', '14 Pine Close, Liverpool, L3 9PU', 18, NULL, '2012-04-05', 0, 6),
(38, 7, 'Isabella ', ' White', '7 Birch Grove, Bristol, BS4 6FJ', 17, NULL, '2011-05-01', 0, 7),
(39, 2, ' Jack', 'Clarke', '19 Oak Close, Belfast, BT1 4NN', 16, 5, '2017-11-07', 2, 8),
(40, 3, ' Jack', 'Turner', '23 Beech Lane, Newcastle, NE1 6QW', 15, NULL, '2016-12-30', 2, 9),
(41, 4, 'Mia ', 'Lewis', '56 Cedar Street, Leeds, LS1 4DP', 14, NULL, '2015-08-14', 0, 10),
(42, 5, 'Noah ', 'Green', ' 14 Pine Close, Liverpool, L3 9PU', 13, NULL, '2015-08-14', 2, 11),
(43, 6, 'Ruby', 'White', '7 Birch Grove, Bristol, BS4 6FJ', 12, 4, '2014-08-14', 0, 12);

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(3, 't', 't', 'student'),
(4, 'test', 'test', 'admin');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `medical_information`
--
ALTER TABLE `medical_information`
  MODIFY `medical_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `money`
--
ALTER TABLE `money`
  MODIFY `dinner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `Parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pupils`
--
ALTER TABLE `pupils`
  MODIFY `pupil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
