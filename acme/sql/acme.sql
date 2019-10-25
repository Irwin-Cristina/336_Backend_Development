-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2018 at 09:56 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acme`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Category classifications of inventory items';

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Cannon'),
(2, 'Explosive'),
(3, 'Misc'),
(4, 'Rocket'),
(5, 'Trap');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comments`) VALUES
(27, 'Cristina', 'Irwin', 'cristinaeirwin@gmail.com', '$2y$10$ZZEbaPBJTvD64o8TlxPb6.m7mC6CM/DJan1rhb8H.cjmK4Ov8s8t6', '1', ''),
(40, 'Admin', 'User', 'admin@cit336.net', '$2y$10$zYIDW2uJ5LaqZcXL74AWlOv8s9kGIc/NZj2VrWXYXWhPH1ioD68Ii', '3', ''),
(41, 'Simon', 'Simon', 'simon@yahoo.com', '$2y$10$zbbJBQVwluUA4hffcUytFeAcBbNFSd5nlj7Jot74qpvl/4VFKPJoe', '1', ''),
(42, 'Donald ', 'Duck', 'duck@duck.com', '$2y$10$h2kkGeGEFJXVQ0KU9UermuYy74OxKT4BHI5MQWjLyYj.UVBOEat.6', '1', ''),
(43, 'Isaac', 'Irwin', 'isaacscottirwin@gmail.com', '$2y$10$TRnSMmHOzH.ZkkFqaP3gKOUL.HKWqzfzBn8ZWDrVD7Et8T.RGRefC', '1', ''),
(44, 'Peter', 'Pan', 'Peter@pan.com', '$2y$10$OGqteoWRwN1i1QdyJryCueIfGIfDb1N4Yb48Zl7V1ZEY.bWx5.rha', '1', ''),
(45, 'Mickey', 'Mouse', 'disney@disney.com', '$2y$10$tcF5pALU.AvmY5/iSKzoKe15sJ0HlanMoH0pYVOuc8FJMlj8sDDeu', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`) VALUES
(23, 8, 'anvil.png', '/acme/images/products/anvil.png', '2018-07-02 22:46:57'),
(24, 8, 'anvil-tn.png', '/acme/images/products/anvil-tn.png', '2018-07-02 22:46:57'),
(25, 3, 'catapult.png', '/acme/images/products/catapult.png', '2018-07-02 22:47:19'),
(26, 3, 'catapult-tn.png', '/acme/images/products/catapult-tn.png', '2018-07-02 22:47:19'),
(27, 14, 'helmet.png', '/acme/images/products/helmet.png', '2018-07-02 22:48:59'),
(28, 14, 'helmet-tn.png', '/acme/images/products/helmet-tn.png', '2018-07-02 22:48:59'),
(29, 4, 'roadrunner.jpg', '/acme/images/products/roadrunner.jpg', '2018-07-02 22:51:16'),
(30, 4, 'roadrunner-tn.jpg', '/acme/images/products/roadrunner-tn.jpg', '2018-07-02 22:51:16'),
(31, 17, 'bomb.png', '/acme/images/products/bomb.png', '2018-07-02 22:51:57'),
(32, 17, 'bomb-tn.png', '/acme/images/products/bomb-tn.png', '2018-07-02 22:51:57'),
(33, 16, 'fence.png', '/acme/images/products/fence.png', '2018-07-02 22:52:15'),
(34, 16, 'fence-tn.png', '/acme/images/products/fence-tn.png', '2018-07-02 22:52:15'),
(35, 6, 'hole.png', '/acme/images/products/hole.png', '2018-07-02 22:52:48'),
(36, 6, 'hole-tn.png', '/acme/images/products/hole-tn.png', '2018-07-02 22:52:48'),
(37, 10, 'mallet.png', '/acme/images/products/mallet.png', '2018-07-02 22:53:07'),
(38, 10, 'mallet-tn.png', '/acme/images/products/mallet-tn.png', '2018-07-02 22:53:07'),
(39, 2, 'mortar.jpg', '/acme/images/products/mortar.jpg', '2018-07-02 22:53:26'),
(40, 2, 'mortar-tn.jpg', '/acme/images/products/mortar-tn.jpg', '2018-07-02 22:53:26'),
(41, 13, 'piano.jpg', '/acme/images/products/piano.jpg', '2018-07-02 22:53:49'),
(42, 13, 'piano-tn.jpg', '/acme/images/products/piano-tn.jpg', '2018-07-02 22:53:49'),
(43, 1, 'rocket.png', '/acme/images/products/rocket.png', '2018-07-02 22:54:14'),
(44, 1, 'rocket-tn.png', '/acme/images/products/rocket-tn.png', '2018-07-02 22:54:14'),
(45, 15, 'rope.jpg', '/acme/images/products/rope.jpg', '2018-07-02 22:54:29'),
(46, 15, 'rope-tn.jpg', '/acme/images/products/rope-tn.jpg', '2018-07-02 22:54:29'),
(47, 9, 'rubberband.jpg', '/acme/images/products/rubberband.jpg', '2018-07-02 22:54:48'),
(48, 9, 'rubberband-tn.jpg', '/acme/images/products/rubberband-tn.jpg', '2018-07-02 22:54:48'),
(49, 11, 'tnt.png', '/acme/images/products/tnt.png', '2018-07-02 22:55:21'),
(50, 11, 'tnt-tn.png', '/acme/images/products/tnt-tn.png', '2018-07-02 22:55:21'),
(51, 12, 'seed.jpg', '/acme/images/products/seed.jpg', '2018-07-02 22:55:47'),
(52, 12, 'seed-tn.jpg', '/acme/images/products/seed-tn.jpg', '2018-07-02 22:55:47'),
(53, 5, 'trap.jpg', '/acme/images/products/trap.jpg', '2018-07-02 22:56:09'),
(54, 5, 'trap-tn.jpg', '/acme/images/products/trap-tn.jpg', '2018-07-02 22:56:09'),
(61, 3, 'catapult2.jpg', '/acme/images/products/catapult2.jpg', '2018-07-06 02:05:04'),
(62, 3, 'catapult2-tn.jpg', '/acme/images/products/catapult2-tn.jpg', '2018-07-06 02:05:04'),
(63, 7, 'Keonigseggccx.jpg', '/acme/images/products/Keonigseggccx.jpg', '2018-07-17 21:10:13'),
(64, 7, 'Keonigseggccx-tn.jpg', '/acme/images/products/Keonigseggccx-tn.jpg', '2018-07-17 21:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invName` varchar(50) NOT NULL DEFAULT '',
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL DEFAULT '',
  `invThumbnail` varchar(50) NOT NULL DEFAULT '',
  `invPrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `invStock` smallint(6) NOT NULL DEFAULT '0',
  `invSize` smallint(6) NOT NULL DEFAULT '0',
  `invWeight` smallint(6) NOT NULL DEFAULT '0',
  `invLocation` varchar(35) NOT NULL DEFAULT '',
  `categoryId` int(10) UNSIGNED NOT NULL,
  `invVendor` varchar(20) NOT NULL DEFAULT '',
  `invStyle` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Acme Inc. Inventory Table';

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invName`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invSize`, `invWeight`, `invLocation`, `categoryId`, `invVendor`, `invStyle`) VALUES
(1, 'Rocket', 'Rocket for multiple purposes. This can be launched independently to deliver a payload or strapped on to help get you to where you want to be FAST!!! Really Fast! \r\n                            ', '/acme/images/products/rocket.png', '/acme/images/products/rocket-tn.png', '132000.00', 5, 60, 100, 'California', 4, 'Goddard', 'metal'),
(2, 'Mortar', 'Our Mortar is very powerful. This cannon can launch a projectile or bomb 3 miles. Made of solid steel and mounted on cement or metal stands [not included].', '/acme/images/products/mortar.jpg', '/acme/images/products/mortar-tn.jpg', '1500.00', 26, 250, 750, 'San Jose', 1, 'Smith & Wesson', 'Metal'),
(3, 'Catapult', 'Our best wooden catapult. Ideal for hurling objects for up to 1000 yards. Payloads of up to 300 lbs.', '/acme/images/products/catapult.png', '/acme/images/products/catapult-tn.png', '2500.00', 4, 1569, 400, 'Cedar Point, IO', 1, 'Wooden Creations', 'Wood'),
(4, 'Female RoadRunner Cutout', 'This carbon fiber backed cutout of a female roadrunner is sure to catch the eye of any male roadrunner.', '/acme/images/products/roadrunner.jpg', '/acme/images/products/roadrunner-tn.jpg', '20.00', 500, 27, 2, 'San Jose', 5, 'Picture Perfect', 'Carbon Fiber'),
(5, 'Giant Mouse Trap', 'Our big mouse trap. This trap is multifunctional. It can be used to catch dogs, mountain lions, road runners or even muskrats. Must be staked for larger varmints [stakes not included] and baited with approptiate bait [sold seperately].\r\n', '/acme/images/products/trap.jpg', '/acme/images/products/trap-tn.jpg', '20.00', 34, 470, 28, 'Cedar Point, IO', 5, 'Rodent Control', 'Wood'),
(6, 'Instant Hole', 'Instant hole - Wonderful for creating the appearance of openings.', '/acme/images/products/hole.png', '/acme/images/products/hole-tn.png', '25.00', 269, 24, 2, 'San Jose', 3, 'Hidden Valley', 'Ether'),
(7, 'Koenigsegg CCX', 'This high performance car is sure to get you where you are going fast. It holds the production car land speed record at an amazing 250mph. \r\n                             \r\n                            ', '/acme/images/products/Keonigseggccx.jpg', '/acme/images/products/Keonigseggccx-tn.jpg', '99999999.99', 1, 25000, 3000, 'San Jose', 3, 'Koenigsegg', 'Metal'),
(8, 'Anvil', 'The Anvil is a hard large metal item that can really hurt someone.                             \r\n                             \r\n                             \r\n                             \r\n                             \r\n                             \r\n                             \r\n                            ', '/acme/images/products/anvil.png', '/acme/images/products/anvil-tn.png', '99999999.99', 15, 70, 50, 'San Jose', 5, 'Steel Made', 'Metal'),
(9, 'Monster Rubber Band', 'These are not tiny rubber bands. These are MONSTERS! These bands can stop a train locamotive or be used as a slingshot for cows. Only the best materials are used!', '/acme/images/products/rubberband.jpg', '/acme/images/products/rubberband-tn.jpg', '4.00', 4589, 75, 1, 'Cedar Point, IO', 3, 'Rubbermaid', 'Rubber'),
(10, 'Mallet', 'Ten pound mallet for bonking roadrunners on the head. Can also be used for bunny rabbits.', '/acme/images/products/mallet.png', '/acme/images/products/mallet-tn.png', '25.00', 100, 36, 10, 'Cedar Point, IA', 3, 'Wooden Creations', 'Wood'),
(11, 'TNT', 'The biggest bang for your buck with our nitro-based TNT. Price is per stick.', '/acme/images/products/tnt.png', '/acme/images/products/tnt-tn.png', '10.00', 1000, 25, 2, 'San Jose', 2, 'Nobel Enterprises', 'Plastic'),
(12, 'Roadrunner Custom Bird Seed Mix', 'Our best varmint seed mix - varmints on two or four legs can\'t resist this mix. Contains meat, nuts, cereals and our own special ingredient. Guaranteed to bring them in. Can be used with our monster trap.', '/acme/images/products/seed.jpg', '/acme/images/products/seed-tn.jpg', '8.00', 150, 24, 3, 'San Jose', 5, 'Acme', 'Plastic'),
(13, 'Grand Piano', 'This grand piano is guaranteed to play well and smash anything beneath it if dropped from a height.', '/acme/images/products/piano.jpg', '/acme/images/products/piano-tn.jpg', '3500.00', 36, 500, 1200, 'Cedar Point, IA', 3, 'Wulitzer', 'Wood'),
(14, 'Crash Helmet', 'This carbon fiber and plastic helmet is the ultimate in protection for your head. Comes in assorted colors. \r\n                            ', '/acme/images/products/helmet.png', '/acme/images/products/helmet-tn.png', '10000.00', 25, 48, 9, 'San Jose', 3, 'Suzuki', 'Carbon Fiber'),
(15, 'Nylon Rope', 'This nylon rope is ideal for all uses. Each rope is the highest quality nylon and comes in 100 foot lengths.', '/acme/images/products/rope.jpg', '/acme/images/products/rope-tn.jpg', '15.00', 200, 200, 6, 'San Jose', 3, 'Marina Sales', 'Nylon'),
(16, 'Sticky Fence', 'This fence is covered with Gorilla Glue and is guaranteed to stick to anything that touches it and is sure to hold it tight.', '/acme/images/products/fence.png', '/acme/images/products/fence-tn.png', '75.00', 15, 48, 2, 'San Jose', 3, 'Acme', 'Nylon'),
(17, 'Small Bomb', 'Bomb with a fuse - A little old fashioned, but highly effective. This bomb has the ability to devistate anything within 30 feet.', '/acme/images/products/bomb.png', '/acme/images/products/bomb-tn.png', '275.00', 58, 30, 12, 'San Jose', 2, 'Nobel Enterprises', 'Metal');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(8, 'Use with care.', '2018-07-16 16:52:26', 11, 27),
(9, ' Here is another test               ', '2018-07-16 17:45:32', 11, 27),
(10, 'And  one more                ', '2018-07-16 17:46:31', 11, 27),
(11, 'One more test                ', '2018-07-16 17:49:11', 11, 27),
(12, ' This is first               ', '2018-07-16 18:07:11', 11, 27),
(13, ' First               ', '2018-07-16 18:08:20', 11, 27),
(14, 'First again               ', '2018-07-16 18:10:31', 11, 27),
(15, 'Dangerous  ', '2018-07-16 18:26:28', 17, 27),
(16, 'one more review               ', '2018-07-16 18:57:31', 2, 27),
(23, ' Here is my first review. This is Simon.  again.        ', '2018-07-17 20:55:39', 5, 41),
(30, 'I want to play this piano, not drop it.                ', '2018-07-17 20:56:31', 13, 41),
(31, '                ', '2018-07-17 20:56:38', 13, 41),
(32, '                ', '2018-07-17 20:57:53', 13, 41),
(33, '                ', '2018-07-17 20:58:12', 13, 41),
(38, '           ', '2018-07-20 23:27:40', 2, 42),
(40, 'Here is another review.', '2018-07-21 19:38:21', 5, 40),
(41, 'I want to write a review.', '2018-07-21 22:15:41', 2, 40),
(42, 'Hello :)', '2018-07-21 22:43:33', 2, 40),
(43, 'Hello, I hope you can hear after using this product.', '2018-07-22 19:50:20', 11, 40),
(44, 'This is a great product.', '2018-07-22 00:01:38', 2, 40),
(45, 'I am scared of this product.', '2018-07-21 22:58:57', 17, 40),
(46, 'This is a huge cannon.', '2018-07-21 23:50:28', 2, 40),
(48, 'How are you', '2018-07-21 23:19:42', 7, 40),
(49, 'What a great product.', '2018-07-21 23:50:00', 2, 40),
(50, 'This is a huge gigantic rocket.', '2018-07-22 00:04:05', 1, 43),
(51, 'This is a fast bird.', '2018-07-22 19:48:10', 4, 40),
(52, 'This is very loud.', '2018-07-22 19:49:19', 17, 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `invId` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `inventory` (`invId`),
  ADD KEY `clients` (`clientId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_image` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
