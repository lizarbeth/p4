-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2022 at 07:09 AM
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
(10, 'blueberry21', 'ME TOO!!!!', 1, '04:26:45', '2022-11-23'),
(1, 'sharkgirl', 'cool. thanks for sharing.', 2, '00:00:00', '2022-11-23');

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
('lizarbeth', 'blueberry21'),
('sharkgirl', 'lizarbeth');

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
(16, 'blueberry21', 1),
(16, 'lizarbeth', 2),
(10, 'blueberry21', 3),
(10, 'hydrobro1995', 4),
(10, 'lizarbeth', 5),
(10, 'sharkgirl', 6),
(4, 'lizarbeth', 7),
(15, 'sharkgirl', 8),
(1, 'lizarbeth', 9),
(1, 'lizarbeth', 10);

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
('This is my first post.', 'lizarbeth', '2022-11-12', '09:08:45', 1, 1, 1),
('Status update: currently at work (for once)', 'blueberry21', '2022-11-16', '03:13:19', 2, 0, 0),
('hello', 'lizarbeth', '2022-11-16', '10:37:04', 3, 0, 0),
('I\'m available to chat :-)', 'lizarbeth', '2022-11-16', '10:39:16', 4, 1, 0),
('I LOVE WATER!!!!!!!!', 'hydrobro1995', '2022-11-17', '12:48:25', 10, 4, 1),
('I love posting on here', 'lizarbeth', '2022-11-17', '07:48:58', 11, 0, 0),
('this is another test post :-)', 'lizarbeth', '2022-11-17', '07:54:24', 14, 0, 0),
('this is another test post :-)', 'lizarbeth', '2022-11-17', '07:54:44', 15, 1, 0),
('Hi, I\'m new here my name is Shark Girl', 'sharkgirl', '2022-11-17', '05:29:56', 16, 2, 0),
('test post', 'lizarbeth', '2022-11-23', '00:00:00', 17, 0, 0);

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
  `pic` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `firstName`, `lastName`, `password`, `email`, `count`, `pic`) VALUES
('lizarbeth', 'Elisabeth', 'McMichael', 'LiZarBeth123!!', 'c00432278@louisiana.edu', 1, 'pp2.jpg'),
('blueberry21', 'Lavender', 'Gooms', 'blackANDtan', 'lg21@gmail.com', 2, 'pp4.jpg'),
('hydrobro1995', 'Ruben', 'Gold', 'iLoveWater!!$', 'rubengold1995@yahoo.com', 3, 'pp1.jpg'),
('sharkgirl', 'Janet', 'Planet', 'lavaBOY', 'shkgrl@gmail.com', 4, 'pp3.jpg');

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
  MODIFY `commentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `count` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
