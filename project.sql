-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 12, 2021 at 11:48 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gameid_fk` (`gameid`),
  KEY `userid_fk` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `gameid`, `userid`, `comment`, `rating`) VALUES
(16, 37, 6, 'this is another account', 4),
(17, 38, 6, 'firre demon', 4),
(25, 36, 7, '      fine fine      \r\n        ', 4),
(26, 37, 11, '            i am awsome      \r\n              \r\n        ', 2),
(46, 39, 11, '      trying      \r\n        ', 3),
(47, 38, 11, '      try      \r\n        ', 5),
(50, 28, 7, 'test123', 5),
(52, 38, 7, '                  demon\r\n      \r\n              \r\n              \r\n        ', 5),
(53, 33, 7, 'fire hell demon', 4);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `useridd` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `catagories` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `descripation` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `gameidd_fk` (`useridd`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `useridd`, `title`, `catagories`, `type`, `image`, `url`, `descripation`) VALUES
(28, NULL, 'chesss', 1, 'action', 'uploadd/indesgin.PNG', 'gamefolder/chess.apk', 'this is a chess game'),
(30, NULL, 'fruit12', 1, 'adventure', 'uploadd/adobe.PNG', 'gamefolder/fruit.apk', 'this is fruit ninja'),
(31, NULL, 'die', 0, 'puzzel', 'uploadd/adobe illustrator.PNG', 'gamefolder/die.apk', 'die in 100 ways game'),
(32, NULL, 'ludozz', 1, 'sport', 'uploadd/photoshop.PNG', 'gamefolder/ludo.apk', 'let play some ludo'),
(33, NULL, 'chess', 0, 'action', 'uploadd/save.PNG', 'gamefolder/chess.apk', 'this is power'),
(34, NULL, 'fruitninja', 1, 'arcade', 'uploadd/hiro.PNG', 'gamefolder/fruit.apk', 'xd'),
(35, NULL, 'newchess', 0, 'adventure', 'uploadd/hirkoki.PNG', 'gamefolder/ludo.apk', 'this is morden\r\n'),
(36, NULL, '100', 1, 'action', 'uploadd/smithee.PNG', 'gamefolder/die.apk', '100 way to die'),
(37, NULL, '100dead', 1, 'action', 'uploadd/hiro.PNG', 'gamefolder/die.apk', 'dieee'),
(38, NULL, 'ludo3d', 1, 'action', 'uploadd/hirkoki.PNG', 'gamefolder/ludo.apk', 'ludo is fun'),
(39, 7, 'hellfiredemon12', 1, 'adventure', 'uploadd/anime.jpg', 'gamefolder/chess.apk', 'trying again'),
(40, 8, 'ninjagame', 0, 'puzzel', 'uploadd/filmora.PNG', 'gamefolder/ludoninja.apk', 'trying');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(6, 'roshan', 'roshan@gmail.com', 'cc575874253b02683c3ffaf0694c725d'),
(7, 'fire', 'fire@gmail.com', 'ad6d24854487c31786be125b3eedcedc'),
(8, 'xd1', 'xd@gmail.com', '8bbda2157b0f8c86e219389f7b25a686'),
(10, 'try', 'try@gmail.com', 'f5b00093e6b18a2b0fe866c80fad0411'),
(11, 'a', 'a@gmail.com', '0cc175b9c0f1b6a831c399e269772661'),
(12, 'fakjfakldjfalfdal', 'ajkal@gmail.com', '9d570a3071b2539ccb19aebfabdb83df'),
(13, 'a', 'aabziaa@gmail.com', '0cc175b9c0f1b6a831c399e269772661'),
(14, '', 'ajkaal@gmail.com', '0cc175b9c0f1b6a831c399e269772661'),
(15, 'fire', 'firehell1@gmail.com', 'fire12'),
(16, 'firehell', 'abc@gmail.com', 'c01862df9cca1a691c088ba919cb78d5'),
(17, 'firedemon', 'hhell@gmail.com', '484c38da2678b320313bf867768dbe01'),
(18, 'demonooooo', 'demonon@gmail.com', 'f752e6c0500d48780e08c04b5c7abe98'),
(19, 'demonnnnn', 'demon@f.xom', '674b1bc85c6a9ce372f4f15d482d80c8'),
(20, 'celonimah', 'celoni@gmal.com', '3366f80fe90f4a674aeb608419f7c6e5'),
(21, 'demoooon', 'demoon@gmail.com', '8f4579a215ab94dd201afce2b6600afb'),
(22, 'firrrrrre', 'fireee@gmail.com', '5e2beea5a51e1ada6a20cc1e9f648ec5');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `gameid_fk` FOREIGN KEY (`gameid`) REFERENCES `game` (`id`),
  ADD CONSTRAINT `userid_fk` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `gameidd_fk` FOREIGN KEY (`useridd`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
