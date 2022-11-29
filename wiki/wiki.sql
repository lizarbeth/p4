-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2022 at 07:35 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wiki`
--
CREATE DATABASE wiki;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `shortTitle` varchar(15) NOT NULL,
  `author` varchar(30) NOT NULL,
  `title` varchar(60) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`shortTitle`, `author`, `title`, `text`) VALUES
('Ocean', 'admin', 'Ocean Water', 'Ocean water can be found in all 7 world oceans and all participating Sonic locations.\r\nThe Earth\'s largest and deepest ocean is the Pacific Ocean. You can find the most ocean water there. This ocean makes up about 50% of all ocean water. This ocean is also the deepest which is kind of terrifying. I wouldn\'t drink from this source.\r\nThe Atlantic Ocean has about 29% of the Earth\'s water. Overall, this is the least interesting ocean in my opinion. I\'m sure it has some cool features, but nothing cool enough to make it into the article. This is the saltiest ocean so I wouldn\'t recommend drinking this water. \r\nThe Indian ocean is the third-largest ocean. This ocean is the warmest which makes it nice for swimming. I\'ve never been but I can assume. This is my favorite ocean because blue coelacanths live there. \r\nThe Southern (or Arctic) ocean is the smallest and shallowest ocean which is kind of lame. However, it is the coldest which raises this ocean\'s cool points by at least 10. \r\nThe Indian and Southern oceans are good contenders as sources for ocean water. However, they\'re both salty and one of them is way too cold to drink from so that\'s a hard pass from me.\r\nLastly is ocean water from Sonic. I\'ve had it a couple of times but honestly it\'s not my favorite. I really don\'t like coconut that much and that\'s the main flavor of the drink. The star of the show is sonic ice and I don\'t need to get an ocean water to enjoy the ice. Personally, I get a Coke from Sonic when I go. ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstName` char(20) NOT NULL,
  `lastName` char(30) NOT NULL,
  `email` varchar(45) NOT NULL,
  `birthday` date NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `firstName`, `lastName`, `email`, `birthday`, `ID`) VALUES
('admin', 'admin', 'admin', 'admin', 'admin', '2022-11-03', 1),
('Thomas', '$2y$10$U7Sq64zn2oKdYhWUh9nhW.zq1vMhKmn2YMYq9y5oL57VArfUJs2XS', 'Thomas', 'Billeaudeau', 'tb@gmail.com', '2022-11-03', 2),
('Test', '$2y$10$Ac17GDwxhwclS2iDowkYm.Jl.tvADFr7ihzteJ8XChkImv97JyZ/C', 'Test', 'Test', 'test@gmail.com', '2022-11-03', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`shortTitle`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
