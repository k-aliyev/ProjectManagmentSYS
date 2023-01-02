-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 02, 2023 at 03:55 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newProject`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `city`, `district`, `address`) VALUES
(1, 9, 'Ankara', 'qwe', 'Universiteler');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `pid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`pid`, `user_id`, `comment`) VALUES
(10, 13, 'IMP');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `record_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`record_id`, `user_id`, `project_id`) VALUES
(19, 9, 2),
(21, 9, 3),
(22, 9, 1),
(24, 10, 1),
(26, 9, 6),
(33, 12, 10);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `requirements` text NOT NULL,
  `software` text NOT NULL,
  `hardware` text NOT NULL,
  `status` text NOT NULL,
  `year` int(11) NOT NULL,
  `semester` text NOT NULL,
  `advisor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `requirements`, `software`, `hardware`, `status`, `year`, `semester`, `advisor_id`) VALUES
(1, 'Backed Development Project', 'In a PHP backend development project, the developer is responsible for creating the code that powers the core functionality of the application, as well as maintaining and optimizing the codebase. This involves working closely with the frontend developer(s) to ensure that the frontend and backend of the application are seamlessly integrated.', 'A PHP backend development project involves the creation and maintenance of the server-side logic and functionality of a web application using the PHP programming language. This typically includes tasks such as:\r\n\r\n*Connecting to a database to retrieve and store data\r\n*Implementing user authentication and authorization\r\n*Handling form submissions and processing user input\r\n*Validating and sanitizing data to ensure security\r\n*Creating APIs to allow communication with the frontend of the application\r\n*Handling errors and exceptions', 'JavaScript;PHP;', 'Computer;Server;', 'rejected', 2022, 'Fall', -1),
(2, 'Android Development Project', 'Android development is the process of creating apps for the Android operating system, which is used on a variety of devices, including smartphones, tablets, and wearable devices. Android apps are typically written in the Java programming language and run on the Android platform, which is based on the Linux operating system.', 'Once your development environment is set up, you can start creating your app by designing its user interface, implementing its functionality, and testing it on a device or emulator. You can also use various tools and frameworks, such as Android libraries and APIs, to add features and functionality to your app.', 'Java;', 'Computer;', 'accepted', 2022, 'Fall', 10),
(3, 'test app', 'Application for testing PHP code', 'smart humans or aliens', 'JavaScript;', 'Computer;Server;', 'waiting', 2022, 'Fall', -1),
(6, 'Harry Potter Cinema', 'An application for harry potter cinema', 'IOS lab', 'Java;PHP;', 'abcComputer;Computer;', 'waiting', 2023, 'Fall', -1),
(10, 'Hp', 'An application that connects to Hp printers. ', 'Printer and things', 'Java;', 'Server;Computer;', 'accepted', 2023, 'Fall', 13);

-- --------------------------------------------------------

--
-- Table structure for table `project_files`
--

CREATE TABLE `project_files` (
  `record_id` int(11) NOT NULL,
  `filename` text NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `role`, `email`) VALUES
(9, 'firm', 'firm', 'firmo123', 'firm', 'qwe@qwe'),
(10, 'inst', 'inst', 'inst', 'instructor', 'inst@inst'),
(11, 'admin', 'admin', 'admin', 'admin', 'admin@admin'),
(12, 'std', 'std', 'Student', 'student', 'lolo@gmailcom'),
(13, 'k12', '123', 'Khaled', 'instructor', 'kk@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_files`
--
ALTER TABLE `project_files`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
