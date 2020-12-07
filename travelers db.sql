-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2020 at 08:30 AM
-- Server version: 5.1.54
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `travelers`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `admin`, `password`) VALUES
(1, 'admin', ''),
(2, 'Adam', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `blogid` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(50) NOT NULL,
  `text` varchar(7500) NOT NULL,
  PRIMARY KEY (`blogid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blogid`, `author`, `date`, `title`, `text`) VALUES
(1, 'Test', '2020-03-21', 'Hello', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor ornare ullamcorper. Duis sollicitudin fermentum fermentum. Mauris vitae turpis vehicula, vehicula lorem ut, imperdiet velit. Sed tristique velit mauris. Donec orci leo, vestibulum sed odio a, laoreet dignissim mi. Etiam mattis facilisis facilisis. Cras enim ex, consequat nec turpis id, faucibus venenatis sem.  Aenean in elementum erat, vel consectetur neque. Fusce sollicitudin vestibulum eros at mattis. Suspendisse potenti. Maecenas molestie ultricies odio eget semper. Curabitur quis est iaculis, semper massa vitae, ultrices leo. Curabitur nibh mauris, convallis vel imperdiet finibus, bibendum eu tortor. Praesent efficitur dui vitae purus dictum, nec mollis justo laoreet. Aenean nec ornare massa, sed fringilla mauris. Aliquam volutpat nec purus vitae elementum. Curabitur eget pulvinar sem. Curabitur a neque at lorem facilisis egestas. Integer aliquam ornare mauris vitae ultricies. Mauris mollis elit nec accumsan ullamcorper.'),
(2, 'Test 1 ', '2020-03-17', 'Test', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero''s De Finibus Bonorum et Malorum for use in a type specimen book.'),
(4, 'Test', '2020-03-30', 'Test 1', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero''s De Finibus Bonorum et Malorum for use in a type specimen book.'),
(5, 'Test', '2020-03-30', 'Web Page Administration &amp;amp; Development', 'hyfghbgfdhbfsxhfgh bllll'),
(6, 'Adam Ondrejkovic', '2020-05-04', 'Magical nature of Alaska', ' Alaska has the biggest, longest, highest, most and best of any destination. Of the nation''s 20 highest peaks, 17 are in Alaska. That includes the legendary Mt. McKinley, the tallest mountain in North America at 20,320 feet. Mt. McKinley is the tallest mountain in the world from base to peak. Alaska has 3 million lakes, over 3,000 rivers and more coastline (47,300 miles) than the entire continental United States. Alaska also has an estimated 100,000 glaciers, which cover almost 5 percent of the state. There are more active glaciers in Alaska than in the rest of the inhabited world. Alaska is also home to 80 percent of all the active volcanoes in the U.S. The largest known concentrations of bald eagles, over 3,000, converge near Haines from October through January to feed on late run salmon in the Chilkat River. And the nation''s two largest national forests are located in Alaska. The Tongass in Southeast includes 16.8 million acres, and the Chugach in Southcentral has 4.8 million acres. For some travelers, Alaska is wilderness, at least compared to what they may know from back home. Of Alaska''s 365 million acres only about one million of them are private. There are 16 national parks in Alaska, comprising more than 54 million acres. This is about 2/3 of the land in the entire National Park System. Glacier Bay and Denali (home of Mt. McKinley) may be two of the most recognized and visited National Parks and Preserves in Alaska, but all the park lands have something special to offer including wildlife viewing, camping, fishing, outdoor photography, rafting, kayaking, mountain climbing, cross-country skiing, flightseeing, day cruises, tours of historic and cultural monuments, hiking and nature walks. Alaska is also home to more than 130 parks, ranging from roadside campgrounds to large wilderness parks, spread over more than 3 million acres.'),
(7, 'Adam Ondrejkovic', '2020-05-03', 'Tokyo city of the future', 'Tokyo officially Tokyo Metropolis (???, T?ky?-to), is the capital of Japan and the most populous of the country''s 47 prefectures. Located at the head of Tokyo Bay, the prefecture forms part of the Kant? region on the central Pacific coast of Japan''s main island, Honshu. Tokyo is the political, economic, and cultural centre of Japan, and houses the seat of the Emperor and the national government. The Greater Tokyo Area, which includes several neighbouring prefectures, is the largest urban economy and the most populous metropolitan area in the world, with more than 38.1 million residents as of 2017.'),
(8, 'Jackie Chan', '2019-12-23', 'Paradise name Bora Bora', 'Bora Bora is a 30.55 km2 (12 sq mi) island group in the Leeward group in the western part of the Society Islands of French Polynesia, an overseas collectivity of the French Republic in the Pacific Ocean. The main island, located about 230 kilometres (143 miles) northwest of Papeete, is surrounded by a lagoon and a barrier reef. In the center of the island are the remnants of an extinct volcano rising to two peaks, Mount Pahia and Mount Otemanu, the highest point at 727 metres (2,385 feet). It is part of the commune of Bora-Bora, which also includes the atoll of T?pai.  Bora Bora is a major international tourist destination, famous for its aqua-centric luxury resorts. The major settlement, Vaitape, is on the western side of the main island, opposite the main channel into the lagoon. Produce of the island is mostly limited to what can be obtained from the sea and the plentiful coconut trees, which were historically of economic importance for copra.');

-- --------------------------------------------------------

--
-- Table structure for table `blogre`
--

CREATE TABLE IF NOT EXISTS `blogre` (
  `reid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `post_time` varchar(20) NOT NULL,
  PRIMARY KEY (`reid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `blogre`
--

INSERT INTO `blogre` (`reid`, `tid`, `name`, `comment`, `post_time`) VALUES
(11, 2, 'Test', 'Hi', '2020-03-19 22:18:22'),
(12, 2, 'Test 1', 'how are you', '2020-03-19 22:26:57'),
(13, 1, 'Test', 'hi', '2020-03-20 12:25:34'),
(14, 1, 'Test', 'hi', '2020-03-20 12:25:38'),
(15, 2, 'Test', 'Hello there', '2020-03-20 16:04:06'),
(18, 2, 'Test', 'gfdgfdg', '2020-04-02 17:42:56'),
(19, 2, 'Test', 'hALLO', '2020-04-20 14:00:47'),
(20, 6, 'Jane Doe', 'Beautiful place', '2020-05-04 20:35:29'),
(21, 6, 'Mark Boge', 'Really magical nature, recommended', '2020-05-04 20:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `birth` date NOT NULL,
  `tripId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `fname`, `email`, `phone`, `birth`, `tripId`) VALUES
(46, 'John', 'Doe', 'john@doe.com', 0, '1975-02-02', 1),
(47, 'Marie', 'Doe', 'marie@doe.com', 0, '1977-05-05', 1),
(48, 'Chris', 'Doe', 'john@doe.com', 0, '2010-05-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `title` varchar(50) NOT NULL,
  `text` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `answers` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `name`, `title`, `text`, `date`, `answers`) VALUES
(2, 'Test 1 ', 'Can you hear me ?', 'Hi', '2020-03-25', 0),
(3, 'Test', 'fsdfdsf', 'esadfef', '2020-04-02', 1),
(4, 'Adam ', 'Which destination is best for a couple ?', 'I am looking for a good relax destination with my other half. Where there is also if possible a lot of privacy.', '2020-05-06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `forumre`
--

CREATE TABLE IF NOT EXISTS `forumre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `post_time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `forumre`
--

INSERT INTO `forumre` (`id`, `tid`, `name`, `comment`, `post_time`) VALUES
(10, 3, 'fsdfdsf', 'fdsfsdfsd', '2020-04-02 17:43:41'),
(11, 4, 'Test', 'The amazing choice would be Croatia.', '2020-06-03 12:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE IF NOT EXISTS `help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `familyName` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `sector` varchar(30) NOT NULL,
  `info` varchar(300) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`id`, `name`, `familyName`, `email`, `sector`, `info`, `date`, `status`) VALUES
(6, 'b', 'fdfd', 'pievalie@ke.be', 'Trips', 'fggfd', '2020-03-31', 'Not Finished'),
(8, 'Test', 'fdfd', 'pievalie@ke.be', 'Other', 'rsdfdsfsd', '2020-03-31', 'Not Finished'),
(9, 'Test', 'fdfd', 'pievalie@ke.be', 'Other', 'rsdfdsfsd', '2020-03-31', 'Being processed'),
(10, 'b', 'fdfd', 'pievalie@ke.be', 'Trips', 'm mhuuiuhi', '2020-03-31', 'Not Finished'),
(11, 'b', 'fdfd', 'pievalie@ke.be', 'Trips', 'm mhuuiuhi', '2020-03-31', 'Not Finished'),
(12, 'b', 'fdfd', 'pievalie@ke.be', 'Trips', 'gyity', '2020-03-31', 'Not Finished'),
(13, 'b', 'fdfd', 'pievalie@ke.be', 'Trips', 'gyity', '2020-03-31', 'Not Finished'),
(14, 'b', 'fdfd', 'pievalie@ke.be', 'Trips', 'gyity', '2020-03-31', 'Not Finished'),
(15, 'b', 'fdfd', 'pievalie@ke.be', 'Trips', 'gyity', '2020-03-31', 'Not Finished'),
(16, 'Test', 'fdfd', 'pievalie@ke.be', 'Trips', 'oyuoiyi', '2020-03-31', 'Not Finished'),
(17, 'Test', 'fdfd', 'pievalie@ke.be', 'Trips', 'oyuoiyi', '2020-03-31', 'Done'),
(18, 'Adam', 'fdfd', 'pievalie@ke.be', 'Trips', 'kfki', '2020-03-31', 'Not Finished'),
(19, 'Adam', 'fdfd', 'pievalie@ke.be', 'Trips', 'kfki', '2020-03-31', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `familyName` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `active` int(1) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `name`, `familyName`, `email`, `birthday`, `active`, `date`) VALUES
(32, 'Adam', 'Ondrejkovic', 'adam.ondrejkovic@gmail.com', '06/01/2000', 1, '2020-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `pricemodel`
--

CREATE TABLE IF NOT EXISTS `pricemodel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tmid` int(11) NOT NULL,
  `adult` int(6) NOT NULL,
  `kid` int(6) NOT NULL,
  `flightS` int(6) NOT NULL,
  `flightB` int(6) NOT NULL,
  `hotel3` int(6) NOT NULL,
  `hotel4` int(6) NOT NULL,
  `hotel5` int(6) NOT NULL,
  `singleR` int(6) NOT NULL DEFAULT '2',
  `storno` int(6) NOT NULL,
  `flightI` int(6) NOT NULL,
  `insurance` int(6) NOT NULL,
  `insuranceP` int(6) NOT NULL,
  `administrationC` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `pricemodel`
--

INSERT INTO `pricemodel` (`id`, `tmid`, `adult`, `kid`, `flightS`, `flightB`, `hotel3`, `hotel4`, `hotel5`, `singleR`, `storno`, `flightI`, `insurance`, `insuranceP`, `administrationC`) VALUES
(1, 1, 2500, 1600, 400, 800, 30, 60, 100, 2, 200, 175, 100, 250, 325),
(2, 2, 1000, 450, 220, 400, 25, 50, 80, 2, 75, 100, 60, 120, 150),
(4, 4, 1800, 1200, 400, 750, 30, 55, 80, 2, 250, 185, 120, 190, 260),
(5, 5, 1500, 850, 200, 350, 40, 65, 90, 2, 190, 100, 100, 200, 170),
(6, 6, 2200, 1500, 385, 700, 25, 40, 65, 2, 100, 200, 150, 250, 260),
(7, 7, 2500, 1800, 300, 750, 40, 80, 120, 2, 250, 150, 180, 350, 300),
(8, 8, 3200, 2450, 350, 800, 80, 150, 200, 2, 350, 275, 200, 300, 300),
(9, 9, 2500, 1800, 250, 600, 50, 90, 130, 2, 200, 190, 150, 220, 180),
(10, 10, 3100, 2600, 420, 850, 60, 90, 150, 2, 300, 185, 130, 260, 140),
(11, 11, 1500, 850, 550, 1900, 40, 60, 75, 2, 150, 200, 150, 250, 140),
(12, 12, 2000, 1450, 1350, 1700, 60, 100, 140, 2, 100, 220, 250, 400, 320),
(13, 15, 2000, 1000, 900, 1700, 35, 50, 75, 2, 200, 150, 100, 200, 250);

-- --------------------------------------------------------

--
-- Table structure for table `tripplan`
--

CREATE TABLE IF NOT EXISTS `tripplan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tmid` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `info` varchar(1000) NOT NULL,
  `plan` varchar(3000) NOT NULL,
  `map` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tripplan`
--

INSERT INTO `tripplan` (`id`, `tmid`, `title`, `info`, `plan`, `map`) VALUES
(1, 1, 'Tokyo – Japan', 'Tokyo officially Tokyo Metropolis (???, T?ky?-to), is the capital of Japan and the most populous of the country''s 47 prefectures. Located at the head of Tokyo Bay, the prefecture forms part of the Kant? region on the central Pacific coast of Japan''s main island, Honshu. Tokyo is the political, economic, and cultural centre of Japan, and houses the seat of the Emperor and the national government. The Greater Tokyo Area, which includes several neighbouring prefectures, is the largest urban economy and the most populous metropolitan area in the world, with more than 38.1 million residents as of 2017.', '10 days luxurious trip. Japan is famous for their amazing history, Mt Fuji, unrivaled technology and Samurais. Many of those seem to have been touched on already, but current day Japan is becoming famous for many other things as well like Anime, Sushi, Sumo and Cherry Blossoms. You will be already amazed on the first day when arriving to Tokyo. Tokyo International Airport – Haneda is of latest architecture and style. Accommodation at The Prince Gallery Tokyo Kiochio – 5***** hotel is like a beautiful dream. The view of the hotel is something unforgettable. You will explore the greatest gems of Japan – Sensoji – the oldest and most significant Buddhist temple in Tokyo, Tokyo Skytree – the second highest building in the world and the highest building in Japan, the premier public art gallery in Japan specializing in art from the Western tradition including within the loaned collection will be Vincent van Gogh''s Sunflowers. Shopaholics will get their money´s worth at Futako Tamagawa Rise Shopping Center and you will taste the most delicious Japanese meals at Ise Sueyoshi Nishiazabu Restaurant.  Information about country:  The official name is Nihon or Nippon (Japan). Japan is located in Eastern Asia.  It is an island country with more than 6000 islands. Total area is about 377 973 km². Japan is densely populated, with over 126 244 000 inhabitants. Currency used in Japan is yen (¥). The capital of Japan is Tokyo. The official language spoken in Japan is Japanese.  In terms of system of government, the country is a constitutional monarchy. Time zone: JST (UTC+9). International code: JP/JPN. International registration number: J. Area code: +81.', 'src=''https://maphub.net/embed/92340?legend=1'''),
(2, 2, 'Can you hear me ?', 'hgfh', 'hfghfg', ''),
(3, 4, 'Test 1', 'test', 'test', '');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE IF NOT EXISTS `trips` (
  `tripId` int(11) NOT NULL AUTO_INCREMENT,
  `tmid` varchar(10) NOT NULL,
  `dateB` date NOT NULL,
  `dateE` date NOT NULL,
  `places` int(2) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Planned',
  `adult` int(6) NOT NULL,
  `kid` int(6) NOT NULL,
  `flightS` int(6) NOT NULL,
  `flightB` int(6) NOT NULL,
  `hotel3` int(6) NOT NULL,
  `hotel4` int(6) NOT NULL,
  `hotel5` int(6) NOT NULL,
  `singleR` int(11) NOT NULL DEFAULT '2',
  `storno` int(6) NOT NULL,
  `flightI` int(6) NOT NULL,
  `insurance` int(6) NOT NULL,
  `insuranceP` int(6) NOT NULL,
  `administrationC` int(6) NOT NULL,
  PRIMARY KEY (`tripId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`tripId`, `tmid`, `dateB`, `dateE`, `places`, `status`, `adult`, `kid`, `flightS`, `flightB`, `hotel3`, `hotel4`, `hotel5`, `singleR`, `storno`, `flightI`, `insurance`, `insuranceP`, `administrationC`) VALUES
(1, '1', '2020-04-20', '2020-05-02', 20, 'Planned', 1500, 800, 250, 400, 35, 50, 75, 2, 100, 150, 100, 200, 150),
(2, '1', '2020-06-22', '2020-07-04', 20, 'Planned', 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0),
(3, '2', '2020-06-05', '2020-06-10', 15, 'Planned', 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0),
(5, '4', '2020-08-12', '2020-08-17', 40, 'Planned', 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0),
(6, '4', '2020-08-06', '2020-08-11', 40, 'Planned', 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0),
(7, '7', '2020-07-07', '2020-07-19', 25, 'Planned', 1200, 450, 250, 400, 35, 50, 75, 2, 100, 150, 100, 200, 150);

-- --------------------------------------------------------

--
-- Table structure for table `tripsmodel`
--

CREATE TABLE IF NOT EXISTS `tripsmodel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `type` varchar(15) NOT NULL,
  `time` int(2) NOT NULL,
  `bprice` int(11) NOT NULL,
  `recommended` int(1) DEFAULT NULL,
  `top` int(1) DEFAULT NULL,
  `topco` int(1) DEFAULT NULL,
  `topfa` int(1) DEFAULT NULL,
  `topeco` int(1) DEFAULT NULL,
  `topde` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tripsmodel`
--

INSERT INTO `tripsmodel` (`id`, `name`, `type`, `time`, `bprice`, `recommended`, `top`, `topco`, `topfa`, `topeco`, `topde`) VALUES
(1, 'Japan', 'Deluxe', 12, 3685, 0, 0, NULL, 0, NULL, 1),
(2, 'London', 'Family', 5, 1200, 0, 0, NULL, 2, NULL, NULL),
(4, 'Brazil', 'Family', 7, 2200, 1, 0, NULL, NULL, NULL, NULL),
(5, 'Spain', 'Comfort', 6, 1500, 0, 1, NULL, NULL, NULL, NULL),
(6, 'Mexico', 'Comfort', 8, 2000, 0, 1, NULL, NULL, NULL, NULL),
(7, 'Madagascar', 'Comfort', 12, 3200, 0, 1, NULL, NULL, NULL, NULL),
(8, 'Bora Bora', 'Comfort', 8, 4000, 1, 0, NULL, NULL, NULL, NULL),
(9, 'Maldives', 'Comfort', 6, 3500, 1, 0, NULL, NULL, NULL, NULL),
(10, 'United Arab Emirates', 'Family', 7, 4200, 0, 0, NULL, 3, NULL, NULL),
(11, 'Safari Kenya', 'Family', 6, 2500, 1, 0, NULL, 4, NULL, NULL),
(12, 'Hawaii', 'Comfort', 5, 2000, 0, 1, 3, 0, 0, 0),
(15, 'Alaska', 'Eco Tourism', 12, 3670, NULL, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE IF NOT EXISTS `workers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `position` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `name`, `position`, `email`, `password`) VALUES
(1, 'Queen Elizabeth II', 'Manager', '', ''),
(2, 'Arnold Schwarzenegge', 'Back-office', '', ''),
(3, 'Mr. Bean', 'Sales', '', ''),
(4, 'Jackie Chan', 'Office Worker', 'jackie@travelers.com', 'JackieChan'),
(5, 'Owen Wilson', 'Office Worker ', '', ''),
(6, 'Angela Merkel', 'Human Resources', '', ''),
(7, 'Donald Trump', 'Secretary', '', ''),
(8, 'Marilyn Monroe', 'Back-office', '', '');
