-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2026 at 12:06 PM
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
-- Database: `businessdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `background` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstName`, `lastName`, `email`, `password`, `contact`, `reg_date`, `background`) VALUES
(2, 'oronya', 'innocent', 'oronyai@gmail.com', '$2y$10$nQQo1w.N9sk5mir8MCH.RuAy2kJ2/o/173SZqQkuD7x', '0777989869', '2026-06-01 21:00:00', 'background_img.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `cover` varchar(250) NOT NULL,
  `book_id` varchar(50) NOT NULL,
  `acquired` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `cover`, `book_id`, `acquired`) VALUES
(48, '1781030320_How-to-Invest-Money.pdf', '1781030320_How to invest money.bmp', 'Finance', '2026-06-08 21:00:00'),
(64, '1781800263_Healing-Her-Heart.pdf', '1781800263_Healing her heart.png', 'Love Story', '2026-06-17 21:00:00'),
(69, '1781800734_Hidden-City.pdf', '1781800734_Hidden City.png', 'Fiction', '2026-06-17 21:00:00'),
(74, '1781801751_The-Aliens.pdf', '1781801751_The Aliens.png', 'Fiction', '2026-06-17 21:00:00'),
(75, '1781801843_The-Asteroid-Heist.pdf', '1781801843_The Asteroid Heist.png', 'Fiction', '2026-06-17 21:00:00'),
(76, '1781801953_The-Billionaires-Secret-Heart.pdf', '1781801953_The Billionaires Secret Heart.png', 'Finance', '2026-06-17 21:00:00'),
(79, '1781803216_Sam-Says-NO.pdf', '1781803216_Sam-Says-NO.png', 'Children', '2026-06-17 21:00:00'),
(85, '1782371535_Binary.pdf', '1782371535_Binary.jpg', 'Technology', '2026-06-24 21:00:00'),
(86, '1782371606_Brain-Twister.pdf', '1782371606_Brain Twister.jpg', 'Story', '2026-06-24 21:00:00'),
(87, '1782371806_The-Bible.pdf', '1782371806_king-james-bible-holy-bible-kjv-annotated-1.jpg', 'Religious', '2026-06-24 21:00:00'),
(88, '1782371841_Abraham-Lincoln.pdf', '1782371841_Abraham Lincolm.jpg', 'Biography', '2026-06-24 21:00:00'),
(89, '1782371911_The-River-War.pdf', '1782371911_River War.jpg', 'History', '2026-06-24 21:00:00'),
(90, '1782371970_The-Machine-Stops.pdf', '1782371970_The Machine Stops.jpg', 'Technology', '2026-06-24 21:00:00'),
(91, '1782461244_The-Imitation-of-Christ.pdf', '1782461244_The Imitation of Christ.jpg', 'Religious', '2026-06-25 21:00:00'),
(92, '1782461325_The-Invisible-Man.pdf', '1782461325_The invisible Man.jpg', 'Fiction', '2026-06-25 21:00:00'),
(93, '1782461358_Applied-Psychology-Making-Your-Own-Worl', '1782461358_Applied Psychology.jpg', 'Education', '2026-06-25 21:00:00'),
(94, '1782461404_Sowing-and-Reaping.pdf', '1782461404_Sowing and Reaping.jpg', 'Religion', '2026-06-25 21:00:00'),
(95, '1782461443_Hymns-and-Hymnwriters-of-Denmark.pdf', '1782461443_Hymns and Hymn Writers of Denmark.jpg', 'Religion', '2026-06-25 21:00:00'),
(96, '1782461480_One-Thousand-Secrets-of-Wise-and-Rich-M', '1782461480_One Thousand Secrets of Wise and Rich Revealed.jpg', 'Finance', '2026-06-25 21:00:00'),
(97, '1782461527_For-the-Win.pdf', '1782461527_For the Win.jpg', 'Story', '2026-06-25 21:00:00'),
(98, '1782461572_Living-History.pdf', '1782461572_Living History.jpg', 'Biography', '2026-06-25 21:00:00'),
(99, '1782461662_The-Adventure-of-the-Bruce-Partington-P', '1782461662_The adventure of Bruce Partingnon Plans.jpg', 'Story', '2026-06-25 21:00:00'),
(100, '1782461713_The-Age-of-Invention.pdf', '1782461713_The age of Invention.jpg', 'Technology', '2026-06-25 21:00:00'),
(101, '1782461767_The-Book-of-Business-Etiquette.pdf', '1782461767_The Book of Business Etiquette.jpg', 'Finance', '2026-06-25 21:00:00'),
(102, '1782461845_The-Edge-of-the-Knife.pdf', '1782461845_The edge of the Knife.jpg', 'Story', '2026-06-25 21:00:00'),
(103, '1782546458_Beauty-and-the-Beast.pdf', '1782546458_Beauty and the Beast.jpg', 'Story', '2026-06-26 21:00:00'),
(104, '1782546698_Agent-to-the-Stars.pdf', '1782546698_Agent to the Stars.jpg', 'Fiction', '2026-06-26 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing`
--

CREATE TABLE `borrowing` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `book_title` varchar(50) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `borrow_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowing`
--

INSERT INTO `borrowing` (`id`, `username`, `book_title`, `cover`, `status`, `borrow_date`, `due_date`) VALUES
(29, 'oronya', '1782461713_The-Age-of-Invention.pdf', '1782461713_The age of Invention.jpg', 'approved', '2026-06-25 21:00:00', '2026-07-26'),
(30, 'oronya', '1782461480_One-Thousand-Secrets-of-Wise-and-Rich-M', '1782461480_One Thousand Secrets of Wise and Rich Revealed.jpg', 'approved', '2026-06-25 21:00:00', '2026-07-26'),
(31, 'oronya', '1781801751_The-Aliens.pdf', '1781801751_The Aliens.png', 'pending', '2026-06-25 21:00:00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `enrolment` varchar(50) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','read') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `enrolment`, `comment`, `date`, `status`) VALUES
(10, '25/2/TU/229/BITX', 'Hey, it&#39;s my first project at Team University, I hope this makes sense and proves that at least some knowledge has been obtained&#13;&#10;&#13;&#10;Regards', '2026-06-26 13:50:39', 'pending'),
(11, '25/2/TU/229/BITX', 'Secondly, I have a feeling that some of these projects need to be shared so that we learn from each other.&#13;&#10;I believe someone has a better approach than mine.&#13;&#10;I hope this isn&#39;t too much to ask', '2026-06-26 13:52:16', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `username`, `comment`, `time`, `role`) VALUES
(9, 'innocent', 'Correct! I say we call ourselves the ancestors of this platform                ', '2026-06-28 02:04:28', ''),
(14, 'innocent', ' Hehelolo               ', '2026-06-28 03:17:54', 'ADMIN'),
(15, 'innocent', 'We have to test                ', '2026-06-28 05:37:36', 'ADMIN'),
(16, 'innocent', 'Create more posts on the forum                ', '2026-06-28 05:38:15', 'ADMIN'),
(27, 'ORONYA', ' All along, I thought you weren&#39;t working        ', '2026-06-29 17:56:13', ''),
(28, 'ORONYA', ' Did that post get in?               ', '2026-06-29 18:03:13', ''),
(29, 'ORONYA', ' Okay, let us work out all these things together. We can&#39;t fail. It has to work. We need to work harder and consult with AI whenever necessary               ', '2026-06-29 18:36:57', ''),
(30, 'ORONYA', '  Post2              ', '2026-06-29 19:34:54', ''),
(31, 'ORONYA', 'Men never have to give uo', '2026-06-29 19:40:41', ''),
(32, 'ORONYA', 'Right, right?', '2026-06-29 19:42:21', ''),
(33, 'ORONYA', 'Goal', '2026-06-29 19:44:57', ''),
(34, 'ORONYA', 'Alright', '2026-06-29 19:51:17', ''),
(35, 'ORONYA', 'Okay', '2026-06-29 19:51:53', ''),
(36, 'ORONYA', 'Nana', '2026-06-29 19:52:18', ''),
(38, 'ORONYA', 'Alright                ', '2026-06-30 14:36:33', ''),
(39, 'innocent', 'You mean anyone can post?                ', '2026-06-30 14:39:20', ''),
(40, 'ORONYA', '  Been a while              ', '2026-07-16 21:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE `noticeboard` (
  `id` int(11) NOT NULL,
  `notice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `noticeboard`
--

INSERT INTO `noticeboard` (`id`, `notice`) VALUES
(7, 'This is just another            '),
(8, ' Notice 2           '),
(9, 'Notice 3            ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `sem` varchar(3) NOT NULL,
  `enrol` varchar(50) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `background` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `contact`, `sem`, `enrol`, `profile`, `background`, `status`, `reg_date`) VALUES
(47, 'ORONYA', 'oronyai@gmail.com', '$2y$10$..DUQf53sYNzzQT18pK1nuwkdDfS0Gp4gkYBVfm67Oan5AdmEzmW2', '0777989869', '2/1', '25/2/TU/229/BITX', '1782545255_Profile pic.png', 'duvet-cover-set-blue-twin.jpg', 'approved', '2026-06-25 21:00:00'),
(48, 'innocent', 'oronyai@gmail.com', '$2y$10$N.6wLq0c90ayeN2k9Z586ejA741a3Tdsj/9RwOZPvXt0S8F3HoKbe', '0777989869', '2/1', '25/2/TU/229/BITX2', '1782487714_Profile pic.png', '', 'approved', '2026-06-25 21:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noticeboard`
--
ALTER TABLE `noticeboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `borrowing`
--
ALTER TABLE `borrowing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `noticeboard`
--
ALTER TABLE `noticeboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
