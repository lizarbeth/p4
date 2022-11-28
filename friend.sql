-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 05:14 AM
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
-- Database: `friend`
--
CREATE DATABASE friend;
-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `postID` int(50) NOT NULL,
  `commenter` varchar(50) NOT NULL,
  `commentText` text NOT NULL,
  `commentID` int(10) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`postID`, `commenter`, `commentText`, `commentID`, `time`, `date`) VALUES
(19, 'lizarbeth', 'this is my first comment!', 1, '10:20:01', '2022-11-26'),
(20, 'blueberry21', 'stop blowing up my feed >:-(((', 2, '10:36:25', '2022-11-26'),
(20, 'sharkgirl', 'that was rude @blueberry21.', 3, '02:15:35', '2022-11-27'),
(28, 'iLoveWater2000', 'can I text you about non-shark-related things too?', 4, '04:15:49', '2022-11-23'),
(26, 'blueberry21', 'hey @sharkgirl', 7, '05:20:22', '2022-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `user1` varchar(50) NOT NULL,
  `user2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`user1`, `user2`) VALUES
('blueberry21', 'hydrobro1995'),
('blueberry21', 'sharkgirl'),
('hydrobro1995', 'iLoveWater2000'),
('iLoveWater2000', 'lizarbeth'),
('lizarbeth', 'blueberry21'),
('lizarbeth', 'hydrobro1995'),
('lizarbeth', 'sharkgirl'),
('sharkgirl', 'iLoveWater2000');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `postID` int(50) NOT NULL,
  `liker` varchar(100) NOT NULL,
  `likeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`postID`, `liker`, `likeID`) VALUES
(19, 'iLoveWater2000', 5),
(19, 'lizarbeth', 1),
(20, 'blueberry21', 3),
(20, 'lizarbeth', 2),
(21, 'blueberry21', 4),
(22, 'iLoveWater2000', 7),
(24, 'lizarbeth', 10),
(29, 'blueberry21', 9);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postText` longtext NOT NULL,
  `user` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `postID` int(50) NOT NULL,
  `likeCount` int(11) NOT NULL DEFAULT 0,
  `commentCount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postText`, `user`, `date`, `time`, `postID`, `likeCount`, `commentCount`) VALUES
('i wish people would post more...', 'lizarbeth', '2022-11-25', '04:48:46', 19, 1, 1),
('this is my third post!!', 'lizarbeth', '2022-11-27', '04:49:46', 20, 2, 3),
('I\'m finally at work for once...', 'blueberry21', '2022-11-27', '04:53:05', 21, 1, 0),
('I LOVE WATER!!!!!!!!!!', 'iLoveWater2000', '2022-11-27', '05:54:28', 22, 1, 0),
('Did I mention I love water?', 'iLoveWater2000', '2022-11-27', '05:54:42', 23, 0, 0),
('I really like that I connect to my friends here', 'iLoveWater2000', '2022-11-27', '05:57:39', 24, 1, 0),
('does anyone know where I can buy a bottle of water?', 'hydrobro1995', '2022-11-24', '08:10:45', 25, 0, 0),
('hi :-)', 'sharkgirl', '2022-11-10', '06:19:35', 26, 0, 1),
('i am the first poster!!', 'lizarbeth', '2022-11-14', '10:35:28', 27, 0, 0),
('if anyone else likes sharks like me text me: 337-555-1904', 'sharkgirl', '2022-11-22', '03:45:00', 28, 0, 1),
('i saw someone post about sharks earlier...don\'t they know this site is for water and not animals? \r\nwhatever. i unfriended them so it doesn\'t matter anymore.', 'hydrobro1995', '2022-11-25', '20:43:53', 29, 1, 0),
('YOU GUYS.\r\nTHESE SQUIGGLES ~~~~ LOOK LIKE WATER\r\nOMG  ~~~\r\n~~~~~', 'iLoveWater2000', '2022-11-18', '12:13:04', 30, 0, 0),
('yo mama', 'lizarbeth', '2022-11-27', '09:39:09', 31, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(70) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `count` int(20) NOT NULL,
  `pic` tinytext NOT NULL,
  `joined` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `firstName`, `lastName`, `password`, `email`, `count`, `pic`, `joined`) VALUES
('lizarbeth', 'Elisabeth', 'McMichael', '$2y$10$nxK2JMAkpa8I0cmYikNbgOmmnfyI5n6M0OAlT2oGnJa/HDaul7kdi', 'elisabeth.mcmichael41@gmail.com', 1, 'pp2.jpg', '2022-11-08'),
('blueberry21', 'Lavender', 'Gooms', '$2y$10$T7b2qq39hL76nKnkGJTv7exKRoFsUxJBI45xMtmKPAOz96xUPlGFq', 'gus@gmail.com', 2, 'pp1.jpg', '2022-11-09'),
('sharkgirl', 'Janet', 'Planet', '$2y$10$582c/mJV58dBqa0joXlnquAOFWl.vN2m5BhoGGjQMqNAyVUZjKGzm', 'shkgrl@hotmail.com', 3, 'pp1.jpg', '2022-11-09'),
('hydrobro1995', 'Chris', 'Christopher', '$2y$10$S8haznbG6Yc0VYrn9wI.iuk//AZwegX5mwrJskL.AuNzn.olWLIUe', 'ccheese@aol.com', 4, 'pp4.jpg', '2022-11-16'),
('iLoveWater2000', 'Sam', 'Hamm', '$2y$10$O.DGSEgZGupa4RGZor3cQ.gBUtIKRqFXGlVJt/sDuMfovia/yXZS.', 'sammyhammy@gmail.com', 5, 'pp4.jpg', '2022-11-13'),
('test', 'test', 'test', '$2y$10$comaojStUFwl.0Q1EXZQz.BylnD0fKT5IMoT0.FsxwKDT9b11wCGW', 'test@gmail.com', 6, 'pp4.jpg', '2022-11-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `commenter` (`commenter`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`user1`,`user2`),
  ADD KEY `FK2` (`user2`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeID`),
  ADD UNIQUE KEY `postID_2` (`postID`,`liker`),
  ADD KEY `fk3` (`liker`),
  ADD KEY `postID` (`postID`,`liker`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `FK` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`count`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `count` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`commenter`) REFERENCES `users` (`username`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`user1`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `FK2` FOREIGN KEY (`user2`) REFERENCES `users` (`username`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk3` FOREIGN KEY (`liker`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK` FOREIGN KEY (`user`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
