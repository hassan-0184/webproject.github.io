-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2022 at 07:48 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `m_username` varchar(50) NOT NULL,
  `m_password` varchar(50) NOT NULL,
  `m_role` varchar(50) NOT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`m_id`, `m_name`, `m_username`, `m_password`, `m_role`, `team_id`) VALUES
(1, 'Hassan Ashas', 'hassanashas', '123', 'Team Lead', 1),
(2, 'Talha Ayub', 'talha', '123', 'Junior Developer', 1),
(5, 'Noman Khan', 'noman', '123', 'Team Lead', 2),
(10, 'hassan shahzad', 'hassan', '123', 'Team Lead', 4),
(18, 'Talha', 'talha123', '123', 'Junior Developer', 1),
(19, 'Ashas', 'ashas', '123', 'Junior Developer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE `tbl_project` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_about` varchar(500) NOT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`p_id`, `p_name`, `p_about`, `team_id`) VALUES
(1, 'Flex Management System', 'Development of a online platform for easier communication between students and teachers', 1),
(3, 'Project 3', 'Related to Backend development', 1),
(4, 'School Management System', 'Creating a School management system', 2),
(5, 'FYP Management System', 'A platform for FYPs', 1),
(6, 'XYZ', 'Nothing really', 2),
(7, 'ABC', 'Details', 1),
(8, 'CCD', 'Details', 2),
(9, 'Test Project', 'Test Description', 1),
(10, 'web-programming', 'my course project', 4),
(11, 'web-programming', 'my course project', 1),
(12, ' web development course', 'my course project', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(100) NOT NULL,
  `t_description` varchar(500) NOT NULL,
  `project_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'todo',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`t_id`, `t_name`, `t_description`, `project_id`, `member_id`, `status`, `last_update`) VALUES
(1, 'Admin Portal Creation', 'Creating a portal in which admin will be able to manage teachers and students in the Flex', 1, 1, 'todo', '2021-08-06 21:28:53'),
(2, 'Teacher Portal Creation', 'Creating teacher\'s portal for management', 1, 1, 'doing', '2021-08-06 21:29:00'),
(3, 'Attendance System', 'Creating a system of attendance with which teacher can take attendance of students', 1, 2, 'done', '2021-08-06 21:12:20'),
(4, 'Hello', 'None', 1, 2, 'done', '2021-08-06 21:18:40'),
(6, 'Email Verification', 'Confirming Email verification ', 1, 1, 'testing', '2021-08-06 21:30:50'),
(7, 'Phone Verification', 'etc.', 1, 2, 'completed', '2021-08-05 10:58:17'),
(8, 'Phone Verification #2', 'etc.', 1, 2, 'todo', '2021-08-06 21:31:07'),
(14, 'email validation', 'check on Gmail', 12, 1, 'doing', '2022-05-23 07:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team`
--

CREATE TABLE `tbl_team` (
  `team_id` int(11) NOT NULL,
  `t_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_team`
--

INSERT INTO `tbl_team` (`team_id`, `t_name`) VALUES
(1, 'Backend'),
(2, 'Designers'),
(4, 'Frontend'),
(11, 'graphics desginer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `member-project` (`team_id`);

--
-- Indexes for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `project-team` (`team_id`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `task-member` (`member_id`),
  ADD KEY `task-project` (`project_id`);

--
-- Indexes for table `tbl_team`
--
ALTER TABLE `tbl_team`
  ADD PRIMARY KEY (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_project`
--
ALTER TABLE `tbl_project`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_team`
--
ALTER TABLE `tbl_team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD CONSTRAINT `member-project` FOREIGN KEY (`team_id`) REFERENCES `tbl_team` (`team_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD CONSTRAINT `project-team` FOREIGN KEY (`team_id`) REFERENCES `tbl_team` (`team_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD CONSTRAINT `task-member` FOREIGN KEY (`member_id`) REFERENCES `tbl_member` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task-project` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
