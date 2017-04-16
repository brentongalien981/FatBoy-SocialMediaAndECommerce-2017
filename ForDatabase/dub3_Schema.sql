-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 14, 2017 at 09:36 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dub3`
--

-- --------------------------------------------------------

--
-- Table structure for table `Address`
--

CREATE TABLE `Address` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `AddressTypeCode` int(2) NOT NULL,
  `Street1` varchar(500) NOT NULL,
  `Street2` varchar(500) DEFAULT NULL,
  `City` varchar(100) NOT NULL,
  `State` varchar(50) NOT NULL,
  `ZIP` varchar(10) NOT NULL,
  `CountryCode` varchar(2) NOT NULL,
  `Phone` varchar(20) NOT NULL DEFAULT '(zZz-69-zZz)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Address`
--

INSERT INTO `Address` (`Id`, `UserId`, `AddressTypeCode`, `Street1`, `Street2`, `City`, `State`, `ZIP`, `CountryCode`, `Phone`) VALUES
(8, 1, 1, '78 Monkhouse Rd', '', 'Markham', 'ON', 'L6E 1V5', 'CA', '(zZz-69-zZz)'),
(10, 8, 1, '16 Florence St', 'Merville Park Subdivision', 'Paranaque', 'Metro Manila', '1709', 'PH', '(zZz-69-zZz)');

-- --------------------------------------------------------

--
-- Table structure for table `CartItems`
--

CREATE TABLE `CartItems` (
  `Id` int(11) NOT NULL,
  `CartId` int(11) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CartItems`
--

INSERT INTO `CartItems` (`Id`, `CartId`, `ItemId`, `Quantity`) VALUES
(80, 28, 1, 1),
(81, 28, 10, 3),
(82, 28, 9, 1),
(83, 22, 4, 1),
(85, 22, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Country`
--

CREATE TABLE `Country` (
  `Id` int(3) NOT NULL,
  `Code` varchar(2) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Country`
--

INSERT INTO `Country` (`Id`, `Code`, `Name`) VALUES
(1, 'CA', 'Canada'),
(2, 'UA', 'Ukraine'),
(3, 'US', 'USA'),
(4, 'GB', 'United Kingdom'),
(5, 'CN', 'China'),
(6, 'JP', 'Japan'),
(7, 'PH', 'Philippines');

-- --------------------------------------------------------

--
-- Table structure for table `Friendship`
--

CREATE TABLE `Friendship` (
  `UserId` int(11) NOT NULL,
  `FriendId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Friendship`
--

INSERT INTO `Friendship` (`UserId`, `FriendId`) VALUES
(1, 7),
(1, 8),
(1, 9),
(1, 12),
(1, 14),
(4, 5),
(4, 6),
(5, 4),
(6, 4),
(7, 1),
(7, 8),
(7, 9),
(8, 1),
(8, 7),
(8, 9),
(9, 1),
(9, 7),
(9, 8),
(12, 1),
(14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `FriendshipNotifications`
--

CREATE TABLE `FriendshipNotifications` (
  `NotifiedUserId` int(11) NOT NULL,
  `NotifierUserId` int(11) NOT NULL,
  `NotificationTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FriendshipNotifications`
--

INSERT INTO `FriendshipNotifications` (`NotifiedUserId`, `NotifierUserId`, `NotificationTypeId`) VALUES
(1, 13, 1),
(4, 6, 2),
(4, 10, 1),
(7, 8, 2),
(8, 9, 2),
(12, 13, 1),
(12, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Likes`
--

CREATE TABLE `Likes` (
  `Id` int(3) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Likes`
--

INSERT INTO `Likes` (`Id`, `Name`) VALUES
(1, 'basketball'),
(2, 'pingpong'),
(3, 'computer'),
(4, 'soccer'),
(5, 'volley'),
(6, 'tv'),
(7, 'fb'),
(8, 'twitter'),
(9, 'puta'),
(10, 'cunt'),
(11, 'pussy'),
(12, 'cockY'),
(13, 'Karate'),
(14, 'PS4'),
(15, 'Call of Duty'),
(16, 'Xbox One'),
(17, 'Reading horror books'),
(18, 'munching candies'),
(19, 'Zen budhi zum'),
(20, 'mac'),
(21, 'windows'),
(22, 'v'),
(23, 'nothing'),
(24, 'mangga');

-- --------------------------------------------------------

--
-- Table structure for table `MessagePosts`
--

CREATE TABLE `MessagePosts` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `DatePosted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `MessagePosts`
--

INSERT INTO `MessagePosts` (`Id`, `UserId`, `DatePosted`, `Message`) VALUES
(1, 1, '2017-03-21 12:06:48', 'kjlkewjafljlejwkf'),
(2, 2, '2017-03-21 12:14:36', 'sdf'),
(4, 2, '2017-03-21 23:33:10', 'dfsbdfbssdfb'),
(5, 2, '2017-03-21 23:33:24', 'abcdefgh'),
(8, 2, '2017-03-22 01:39:57', 'putang'),
(9, 1, '2017-03-22 01:41:20', 'jhjk'),
(10, 1, '2017-03-22 01:41:37', 'bading'),
(11, 1, '2017-03-22 01:41:40', 'bading'),
(12, 1, '2017-03-22 01:44:18', 'yo kna'),
(13, 1, '2017-03-22 01:44:26', 'akala mo ha'),
(14, 2, '2017-03-22 01:55:33', 'bwisit na css'),
(15, 2, '2017-03-22 03:15:24', 'ibaka vs lopez'),
(16, 1, '2017-03-22 03:23:19', 'derozan ballin right now'),
(17, 1, '2017-03-22 04:05:02', 'sdf'),
(18, 1, '2017-03-22 04:05:17', 'Jonas Valanciunas'),
(19, 1, '2017-03-22 04:06:17', 'alloy'),
(20, 1, '2017-03-22 04:07:04', 'ukinam'),
(21, 1, '2017-03-22 04:07:23', 'ayoko ng ganitong life'),
(22, 1, '2017-03-22 09:06:40', 'putan talaga'),
(23, 1, '2017-03-22 09:19:05', 'fuck'),
(24, 2, '2017-03-22 22:40:52', 'putang netbeans'),
(25, 6, '2017-03-23 02:49:24', 'tang ina nyo muhaha'),
(26, 6, '2017-03-23 02:49:40', 'panalo kaya knicks?'),
(27, 1, '2017-03-24 00:00:05', 'ukina yo met'),
(28, 1, '2017-03-24 00:00:16', 'nurkic\r\n'),
(29, 1, '2017-03-24 01:20:34', 'irreplaceable!!'),
(30, 1, '2017-03-24 05:00:24', 'tae\r\nyou d\r\ndamn'),
(31, 9, '2017-03-24 05:55:52', 'oh ye ye ye'),
(32, 8, '2017-03-24 20:13:05', 'This is my very first post evah..! ;)'),
(33, 4, '2017-03-25 02:22:52', '13 rings..'),
(34, 1, '2017-03-25 11:39:25', 'kjhkhjhkhjhj'),
(35, 1, '2017-03-25 11:39:54', 'zcvzvzv'),
(36, 1, '2017-03-25 11:42:49', 'sdsdf');

-- --------------------------------------------------------

--
-- Table structure for table `MySettings`
--

CREATE TABLE `MySettings` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `DonationLink` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `MySettings`
--

INSERT INTO `MySettings` (`Id`, `UserId`, `DonationLink`) VALUES
(1, 1, 'paypal.me/BrenAllen');

-- --------------------------------------------------------

--
-- Table structure for table `MyStoreItems`
--

CREATE TABLE `MyStoreItems` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Description` varchar(3000) NOT NULL,
  `PhotoAddress` varchar(1000) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Mass` float DEFAULT NULL,
  `Length` float DEFAULT NULL,
  `Width` float DEFAULT NULL,
  `Height` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `MyStoreItems`
--

INSERT INTO `MyStoreItems` (`Id`, `UserId`, `Name`, `Price`, `Description`, `PhotoAddress`, `Quantity`, `Mass`, `Length`, `Width`, `Height`) VALUES
(1, 1, 'ASUS Gaming PC', 1099.97, 'CPU: 4.4GHz Quad Core Intel Core i7 Devil\'s Canyon,\r\n\r\nMotherBoard: MSI Gaming 5 Series,\r\n\r\nMemory: 16GB Kingston HyperX,\r\n\r\nSDD: 512GB Samsung 850 Pro\r\n                                                                                                                                                                                                                                ', 'https://cdn2.pcadvisor.co.uk/cmsdata/reviews/3605095/ViBox_Wildfire_gaming_PC.jpg\r\n\r\n                                                                                                                                                ', 0, 529.09, 24.88, 12, 24.14),
(2, 1, 'Home-Made Cute Shirt', 5.99, 'Anime-like shirt.<br>\r\n2 shirts for only $4.99.<br>\r\nNot only will you get an awesome shirt, but you\'ll also support me..<br>\r\nThank you so much :)                                                                                                                ', 'http://pre13.deviantart.net/8eb1/th/pre/f/2014/171/b/c/gumball_and_darwin_homemade_t_shirts_by_gumball28-d7n6iba.jpg                                                                                                ', 4, 3.53, 8, 6, 0.5),
(3, 1, 'File Cabinet Drawer', 20, 'Awesome file drawers.<br>\r\nSlightly worn out.<br>\r\nShips in 2 days...                ', 'http://nebula.wsimg.com/obj/N0E0RkZFMTdEMjI2NkY3REM0NDQ6MWRhZTkzZGQ3YTVmOWU1NWEzZmRjZGIzYjQxYjg0MjI6Ojo6OjA=                ', 2, 1440, 40, 25, 55),
(4, 8, 'Pink HP Laptop', 430, '2-year old HP laptop.<br>\r\nMemory: 4GB<br>\r\nCPU: 2,7GHz Dual Core Intel Core i3<br>\r\nSSD: 512GB Corsair SSD                ', 'http://idg.bg/test/pcw/2014/9/30/23085-HP_Stream-1.jpg                ', 2, 64, 15, 11, 2),
(5, 8, '10 foot Teddy Bear', 99, '10 foot Teddy Bear. Fluffy.<br>\r\nCute<br>\r\nSuper huggable.<br>\r\nWho say\'s we need pillows to sleep?                                                                ', 'http://g02.a.alicdn.com/kf/HTB122WxKFXXXXcmXFXXq6xXFXXX9/stuffed-animal-80cm-cute-font-b-teddy-b-font-bear-stripes-design-a-pair-lovers-bear.jpg                                                               ', 1, 1120, 124, 30, 40),
(9, 1, 'Bose Headphones', 449.95, 'Good quiet comfort headphones.<br>\r\nYou\'ll definitely NOT miss out the world around you.<br>\r\n<a href=\'http://www.nba.com\'>Check it out</a>                                                                                \r\n<h2>The BOSE</h2>', 'http://bpc.h-cdn.co/assets/16/30/980x490/landscape-1469479026-bose-qc35-headphones-promo-2.jpg                                                                         ', 1, 5, 9, 7, 3),
(10, 1, 'Bucad-Javier Dawes Place Dental - Oral-B Toothbrush', 19.49, 'The predecessor of the toothbrush is the chew stick. Chew sticks were twigs with frayed ends used to brush the teeth while the other end was used as a toothpick. The earliest chew sticks were discovered in Babylonia in 3500 BC,[4] an Egyptian tomb dating from 3000 BC,[3] and mentioned in Chinese records dating from 1600 BC. The Greeks and Romans used toothpicks to clean their teeth and toothpick like twigs have been excavated in Qin Dynasty tombs.[4] Chew sticks remain common in Africa[5] the rural Southern United States[3] and in the Islamic world the use of chewing stick Miswak is considered a pious action and has been prescribed to be used before every prayer five times a day.[6] Miswaks have been used by Muslims since 7th century.                                                                ', 'http://thesweethome.com/wp-content/uploads/sites/3/2013/05/02-electric-toothbrushes1.jpg                                                                ', 15, 1, 8, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `MyVideos`
--

CREATE TABLE `MyVideos` (
  `MyVideoId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `EmbedCode` varchar(1000) NOT NULL,
  `Rating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `MyVideos`
--

INSERT INTO `MyVideos` (`MyVideoId`, `UserId`, `Title`, `EmbedCode`, `Rating`) VALUES
(1, 1, 'Hello - Adele Cover', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/Rn00vAlcnR4\" frameborder=\"0\" allowfullscreen></iframe>', 8),
(2, 1, 'Adele - Hello (Emblem3 Cover)', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/DDGdEp1fWQU\" frameborder=\"0\" allowfullscreen></iframe>', 7),
(3, 1, 'Kailan', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/ZUeLmDsLw5s\" frameborder=\"0\" allowfullscreen></iframe>', 0),
(4, 8, 'Hello by Leroy Sanchez', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/vlZ9kjCrGJw\" frameborder=\"0\" allowfullscreen></iframe>', 0),
(5, 1, 'When We Were Young - Adele Cover', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/ao7Et8ZqXfs\" frameborder=\"0\" allowfullscreen></iframe>', 0),
(6, 8, 'James Arthur - When we were young (Adele cover) live acoustic session', '<div style=\"position:relative;height:0;padding-bottom:56.25%\"><iframe src=\"https://www.youtube.com/embed/SJUPDs5VLsk?ecver=2\" width=\"640\" height=\"360\" frameborder=\"0\" style=\"position:absolute;width:100%;height:100%;left:0\" allowfullscreen></iframe></div>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `NotificationTypes`
--

CREATE TABLE `NotificationTypes` (
  `Id` int(2) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `NotificationTypes`
--

INSERT INTO `NotificationTypes` (`Id`, `Name`) VALUES
(3, 'a post reply'),
(2, 'dub acceptance'),
(1, 'dub request');

-- --------------------------------------------------------

--
-- Table structure for table `StoreCart`
--

CREATE TABLE `StoreCart` (
  `CartId` int(11) NOT NULL,
  `SellerUserId` int(11) NOT NULL,
  `BuyerUserId` int(11) NOT NULL,
  `IsComplete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `StoreCart`
--

INSERT INTO `StoreCart` (`CartId`, `SellerUserId`, `BuyerUserId`, `IsComplete`) VALUES
(22, 8, 1, 0),
(23, 9, 1, 0),
(24, 1, 8, 1),
(25, 9, 8, 0),
(26, 1, 8, 1),
(27, 1, 8, 1),
(28, 1, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `TimelineNotifications`
--

CREATE TABLE `TimelineNotifications` (
  `Id` int(11) NOT NULL,
  `NotifiedUserId` int(11) NOT NULL,
  `NotifierUserId` int(11) NOT NULL,
  `NotificationTypeId` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TimelinePostReplies`
--

CREATE TABLE `TimelinePostReplies` (
  `Id` int(11) NOT NULL,
  `ParentPostId` int(11) NOT NULL,
  `OwnerUserId` int(11) NOT NULL,
  `PosterUserId` int(11) NOT NULL,
  `DatePosted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TimelinePostReplies`
--

INSERT INTO `TimelinePostReplies` (`Id`, `ParentPostId`, `OwnerUserId`, `PosterUserId`, `DatePosted`, `Message`) VALUES
(1, 7, 1, 1, '2017-03-26 12:36:33', ''),
(2, 7, 1, 1, '2017-03-26 12:38:07', 'ok lang king jems.. kaw ngay?'),
(3, 7, 1, 14, '2017-03-26 13:03:36', 'Ok din ako.. Nagbabasketbol ka pa rin ba?'),
(4, 4, 1, 14, '2017-03-26 13:06:20', 'Bren sino to? Pinsan mo ba?'),
(5, 2, 1, 1, '2017-03-26 13:13:58', 'tae ka boi'),
(6, 8, 1, 1, '2017-03-26 13:14:59', 'ka ba?'),
(7, 8, 1, 1, '2017-03-26 14:04:13', 'lokohan ba to?'),
(8, 6, 14, 1, '2017-03-26 14:04:46', 'ok lang yan king...'),
(9, 6, 14, 1, '2017-03-26 14:13:31', 'taenaman'),
(10, 6, 14, 1, '2017-03-26 14:14:38', 'ayos na'),
(11, 8, 1, 14, '2017-03-26 14:27:24', 'thank u tol'),
(12, 6, 14, 1, '2017-03-26 15:32:38', 'ayos king'),
(13, 6, 14, 1, '2017-03-26 15:32:46', 'bilib talaga ako sayo'),
(14, 4, 1, 8, '2017-03-28 02:04:07', 'halla si kuya bren');

-- --------------------------------------------------------

--
-- Table structure for table `TimelinePosts`
--

CREATE TABLE `TimelinePosts` (
  `Id` int(7) NOT NULL,
  `OwnerUserId` int(6) NOT NULL,
  `PosterUserId` int(6) NOT NULL,
  `DatePosted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TimelinePosts`
--

INSERT INTO `TimelinePosts` (`Id`, `OwnerUserId`, `PosterUserId`, `DatePosted`, `Message`) VALUES
(1, 1, 1, '2017-03-26 02:48:12', 'kobe bwakaw'),
(2, 1, 1, '2017-03-26 02:56:08', 'ukinayo met\r\n'),
(3, 8, 8, '2017-03-26 03:15:30', 'I love reading books..'),
(4, 1, 8, '2017-03-26 03:15:46', 'hello kuya bren'),
(5, 8, 1, '2017-03-26 03:16:26', 'baket?'),
(6, 14, 14, '2017-03-26 04:13:38', 'mangga na nga lang kinakain ko, di pa rin ako pumapayat'),
(7, 1, 14, '2017-03-26 04:16:57', 'musta na bren.. tmac'),
(8, 1, 1, '2017-03-26 13:14:51', 'bakler'),
(9, 8, 1, '2017-03-28 02:01:27', 'hey'),
(10, 1, 1, '2017-03-28 10:50:48', 'bdnjdjjkf'),
(11, 8, 8, '2017-04-04 09:36:25', 'Shipping'),
(12, 1, 8, '2017-04-04 22:30:48', 'Hello ading bren ;('),
(13, 1, 1, '2017-04-13 20:37:47', 'mbvhb');

-- --------------------------------------------------------

--
-- Table structure for table `UserPayPalAccount`
--

CREATE TABLE `UserPayPalAccount` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `PayPalClientId` varchar(1000) NOT NULL,
  `PayPalSecretId` varchar(1000) NOT NULL,
  `AccountType` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserPayPalAccount`
--

INSERT INTO `UserPayPalAccount` (`Id`, `UserId`, `PayPalClientId`, `PayPalSecretId`, `AccountType`) VALUES
(1, 1, 'AY9lIQxIKr5wKR8d0TrbmZvFJiVBvbt00OhKzDjSx7H8PisS1EvvjWLWl6rbc3o5wnHhUyR_WVzPjVH7', 'EEUY_Z8yup8UQIy6vEnAwntI9UsHC43KXTP3p12j6DUH7PAI-axB-gS552u4XD2-gvvcQOwMR3ArwIHf', 2),
(2, 8, 'hgkh', 'cg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserId` int(4) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `HashedPassword` varchar(200) NOT NULL,
  `UserTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserId`, `UserName`, `HashedPassword`, `UserTypeId`) VALUES
(1, 'bren', '$2y$10$NjFmYWU5YjA5NjY0ODI4YeimmMXyQrJ4m9Zw1Ne4AZktzqQGkOT8.', 1),
(2, 'b', '$2y$10$NGVjZGJhN2E5YWQwM2MzNe.3nG6zICjpTAwxUD88goDxYRNNiUcrq', 2),
(4, 'phil', '$2y$10$NmYyNDNmNjAxYzRlODFlO.B7BcLVecFEbHejTK9ZB5mfnJu1ItvsC', 2),
(5, 'dolan', '$2y$10$N2Y5ZTFmNzU4ZThhODIzNO8T8vU9puEUWocBkstfpGB0yudT9ry.i', 1),
(6, 'puta', '$2y$10$NDRhYjdhYTYzNTA4Njk2NuSvVF.vyOfLFfsqGYZEpvx6RlNxxQXjC', 1),
(7, 'cj', '$2y$10$NGUzY2FmZjc4ZWUzOGM2N.I82nDxtgVRyymEc8JJXF1CLAPfgcfTO', 3),
(8, 'kat', '$2y$10$NGJiMjk5ZDA2NjJjOGJlM.ACgj2Wf6MEiL1edREUE2F4e2MEdJnhS', 3),
(9, 'ye', '$2y$10$OWNiNWRiYTBkMjZiNjZiNeItp18C4/vDBMsyx2NePkDLIpwZrfkT.', 3),
(10, 'kobe', '$2y$10$MmY1NTBlZmZjMjBhOTM3Ne7HAQKVWCn44nhqRg1K3lnyn7DURsawq', 3),
(12, 'apes', '$2y$10$NDQ3OTg2NjFmODYxOGQxYeisynLWF2.1EvbNzScdKrv7IGOD97ppG', 3),
(13, 'lea', '$2y$10$ODA2OGExNTE4NGI2MGFkOOWIC2sXReQwn0fmylN69cxRTwYoB4Hiy', 3),
(14, 'king', '$2y$10$MTY1OWQwZWZiYTc2YWMxNOvIq.rKjBccYKwopB7ZDSzxfEd66c0.K', 3);

-- --------------------------------------------------------

--
-- Table structure for table `UsersAndLikes`
--

CREATE TABLE `UsersAndLikes` (
  `UserId` int(11) NOT NULL,
  `LikeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UsersAndLikes`
--

INSERT INTO `UsersAndLikes` (`UserId`, `LikeId`) VALUES
(1, 1),
(1, 3),
(1, 20),
(1, 21),
(2, 3),
(2, 5),
(2, 6),
(2, 7),
(4, 19),
(6, 12),
(8, 17),
(8, 18),
(9, 14),
(9, 15),
(9, 16),
(10, 1),
(14, 24);

-- --------------------------------------------------------

--
-- Table structure for table `UserTypes`
--

CREATE TABLE `UserTypes` (
  `Id` int(3) NOT NULL,
  `Type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserTypes`
--

INSERT INTO `UserTypes` (`Id`, `Type`) VALUES
(1, 'owner'),
(2, 'admin'),
(3, 'user'),
(4, 'coach'),
(5, 'player');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`),
  ADD UNIQUE KEY `UserId_2` (`UserId`),
  ADD KEY `Id_2` (`Id`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `CountryCode` (`CountryCode`),
  ADD KEY `CountryCode_2` (`CountryCode`);

--
-- Indexes for table `CartItems`
--
ALTER TABLE `CartItems`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `CartId_2` (`CartId`,`ItemId`),
  ADD KEY `Id` (`Id`),
  ADD KEY `CartId` (`CartId`),
  ADD KEY `ItemId` (`ItemId`);

--
-- Indexes for table `Country`
--
ALTER TABLE `Country`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`),
  ADD UNIQUE KEY `Code` (`Code`),
  ADD KEY `Code_2` (`Code`),
  ADD KEY `Id_2` (`Id`),
  ADD KEY `Name` (`Name`),
  ADD KEY `Code_3` (`Code`),
  ADD KEY `Name_2` (`Name`),
  ADD KEY `Id_3` (`Id`),
  ADD KEY `Code_4` (`Code`);

--
-- Indexes for table `Friendship`
--
ALTER TABLE `Friendship`
  ADD PRIMARY KEY (`UserId`,`FriendId`),
  ADD UNIQUE KEY `UserId` (`UserId`,`FriendId`),
  ADD KEY `FriendId` (`FriendId`);

--
-- Indexes for table `FriendshipNotifications`
--
ALTER TABLE `FriendshipNotifications`
  ADD PRIMARY KEY (`NotifiedUserId`,`NotifierUserId`,`NotificationTypeId`),
  ADD UNIQUE KEY `NotifiedUserId` (`NotifiedUserId`,`NotifierUserId`,`NotificationTypeId`),
  ADD KEY `NotifierUserId` (`NotifierUserId`),
  ADD KEY `NotificationTypeId` (`NotificationTypeId`);

--
-- Indexes for table `Likes`
--
ALTER TABLE `Likes`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `MessagePosts`
--
ALTER TABLE `MessagePosts`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `Id_2` (`Id`);

--
-- Indexes for table `MySettings`
--
ALTER TABLE `MySettings`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`),
  ADD UNIQUE KEY `UserId` (`UserId`),
  ADD KEY `Id_2` (`Id`),
  ADD KEY `UserId_2` (`UserId`);

--
-- Indexes for table `MyStoreItems`
--
ALTER TABLE `MyStoreItems`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`),
  ADD KEY `Id_2` (`Id`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `Name` (`Name`),
  ADD KEY `Id_3` (`Id`),
  ADD KEY `UserId_2` (`UserId`),
  ADD KEY `Name_2` (`Name`);

--
-- Indexes for table `MyVideos`
--
ALTER TABLE `MyVideos`
  ADD PRIMARY KEY (`MyVideoId`),
  ADD UNIQUE KEY `MyVideoId` (`MyVideoId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `NotificationTypes`
--
ALTER TABLE `NotificationTypes`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `StoreCart`
--
ALTER TABLE `StoreCart`
  ADD PRIMARY KEY (`CartId`),
  ADD KEY `CartId` (`CartId`),
  ADD KEY `SellerUserId` (`SellerUserId`),
  ADD KEY `BuyerUserId` (`BuyerUserId`);

--
-- Indexes for table `TimelineNotifications`
--
ALTER TABLE `TimelineNotifications`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`),
  ADD KEY `NotifiedUserId` (`NotifiedUserId`),
  ADD KEY `NotifierUserId` (`NotifierUserId`),
  ADD KEY `NotificationTypeId` (`NotificationTypeId`);

--
-- Indexes for table `TimelinePostReplies`
--
ALTER TABLE `TimelinePostReplies`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`),
  ADD KEY `ParentPostId` (`ParentPostId`),
  ADD KEY `OwnerUserId` (`OwnerUserId`),
  ADD KEY `PosterUserId` (`PosterUserId`);

--
-- Indexes for table `TimelinePosts`
--
ALTER TABLE `TimelinePosts`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OwnerUserId` (`OwnerUserId`),
  ADD KEY `Id` (`Id`),
  ADD KEY `PosterUserId` (`PosterUserId`);

--
-- Indexes for table `UserPayPalAccount`
--
ALTER TABLE `UserPayPalAccount`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`),
  ADD KEY `Id_2` (`Id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `Index_UserName` (`UserName`),
  ADD KEY `UserTypeId` (`UserTypeId`);

--
-- Indexes for table `UsersAndLikes`
--
ALTER TABLE `UsersAndLikes`
  ADD PRIMARY KEY (`UserId`,`LikeId`),
  ADD KEY `LikeId` (`LikeId`);

--
-- Indexes for table `UserTypes`
--
ALTER TABLE `UserTypes`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Address`
--
ALTER TABLE `Address`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `CartItems`
--
ALTER TABLE `CartItems`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `Country`
--
ALTER TABLE `Country`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Likes`
--
ALTER TABLE `Likes`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `MessagePosts`
--
ALTER TABLE `MessagePosts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `MySettings`
--
ALTER TABLE `MySettings`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `MyStoreItems`
--
ALTER TABLE `MyStoreItems`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `MyVideos`
--
ALTER TABLE `MyVideos`
  MODIFY `MyVideoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `NotificationTypes`
--
ALTER TABLE `NotificationTypes`
  MODIFY `Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `StoreCart`
--
ALTER TABLE `StoreCart`
  MODIFY `CartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `TimelineNotifications`
--
ALTER TABLE `TimelineNotifications`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `TimelinePostReplies`
--
ALTER TABLE `TimelinePostReplies`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `TimelinePosts`
--
ALTER TABLE `TimelinePosts`
  MODIFY `Id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `UserPayPalAccount`
--
ALTER TABLE `UserPayPalAccount`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `UserTypes`
--
ALTER TABLE `UserTypes`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Address`
--
ALTER TABLE `Address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `Users` (`UserId`),
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`CountryCode`) REFERENCES `Country` (`Code`);

--
-- Constraints for table `CartItems`
--
ALTER TABLE `CartItems`
  ADD CONSTRAINT `cartitems_ibfk_1` FOREIGN KEY (`CartId`) REFERENCES `StoreCart` (`CartId`),
  ADD CONSTRAINT `cartitems_ibfk_2` FOREIGN KEY (`ItemId`) REFERENCES `MyStoreItems` (`Id`);

--
-- Constraints for table `Friendship`
--
ALTER TABLE `Friendship`
  ADD CONSTRAINT `friendship_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `Users` (`UserId`),
  ADD CONSTRAINT `friendship_ibfk_2` FOREIGN KEY (`FriendId`) REFERENCES `Users` (`UserId`);

--
-- Constraints for table `FriendshipNotifications`
--
ALTER TABLE `FriendshipNotifications`
  ADD CONSTRAINT `friendshipnotifications_ibfk_1` FOREIGN KEY (`NotifiedUserId`) REFERENCES `Users` (`UserId`),
  ADD CONSTRAINT `friendshipnotifications_ibfk_2` FOREIGN KEY (`NotifierUserId`) REFERENCES `Users` (`UserId`),
  ADD CONSTRAINT `friendshipnotifications_ibfk_3` FOREIGN KEY (`NotificationTypeId`) REFERENCES `NotificationTypes` (`Id`);

--
-- Constraints for table `MessagePosts`
--
ALTER TABLE `MessagePosts`
  ADD CONSTRAINT `messageposts_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `Users` (`UserId`);

--
-- Constraints for table `MySettings`
--
ALTER TABLE `MySettings`
  ADD CONSTRAINT `mysettings_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `Users` (`UserId`);

--
-- Constraints for table `MyStoreItems`
--
ALTER TABLE `MyStoreItems`
  ADD CONSTRAINT `mystoreitems_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `Users` (`UserId`);

--
-- Constraints for table `MyVideos`
--
ALTER TABLE `MyVideos`
  ADD CONSTRAINT `myvideos_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `Users` (`UserId`);

--
-- Constraints for table `StoreCart`
--
ALTER TABLE `StoreCart`
  ADD CONSTRAINT `storecart_ibfk_1` FOREIGN KEY (`SellerUserId`) REFERENCES `Users` (`UserId`),
  ADD CONSTRAINT `storecart_ibfk_2` FOREIGN KEY (`BuyerUserId`) REFERENCES `Users` (`UserId`);

--
-- Constraints for table `TimelineNotifications`
--
ALTER TABLE `TimelineNotifications`
  ADD CONSTRAINT `timelinenotifications_ibfk_1` FOREIGN KEY (`NotificationTypeId`) REFERENCES `NotificationTypes` (`Id`),
  ADD CONSTRAINT `timelinenotifications_ibfk_2` FOREIGN KEY (`NotifiedUserId`) REFERENCES `Users` (`UserId`),
  ADD CONSTRAINT `timelinenotifications_ibfk_3` FOREIGN KEY (`NotifierUserId`) REFERENCES `Users` (`UserId`);

--
-- Constraints for table `TimelinePostReplies`
--
ALTER TABLE `TimelinePostReplies`
  ADD CONSTRAINT `timelinepostreplies_ibfk_1` FOREIGN KEY (`ParentPostId`) REFERENCES `TimelinePosts` (`Id`),
  ADD CONSTRAINT `timelinepostreplies_ibfk_2` FOREIGN KEY (`OwnerUserId`) REFERENCES `Users` (`UserId`),
  ADD CONSTRAINT `timelinepostreplies_ibfk_3` FOREIGN KEY (`PosterUserId`) REFERENCES `Users` (`UserId`);

--
-- Constraints for table `TimelinePosts`
--
ALTER TABLE `TimelinePosts`
  ADD CONSTRAINT `timelineposts_ibfk_1` FOREIGN KEY (`OwnerUserId`) REFERENCES `Users` (`UserId`),
  ADD CONSTRAINT `timelineposts_ibfk_2` FOREIGN KEY (`PosterUserId`) REFERENCES `Users` (`UserId`);

--
-- Constraints for table `UserPayPalAccount`
--
ALTER TABLE `UserPayPalAccount`
  ADD CONSTRAINT `userpaypalaccount_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `Users` (`UserId`);

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`UserTypeId`) REFERENCES `UserTypes` (`Id`);

--
-- Constraints for table `UsersAndLikes`
--
ALTER TABLE `UsersAndLikes`
  ADD CONSTRAINT `usersandlikes_ibfk_1` FOREIGN KEY (`LikeId`) REFERENCES `Likes` (`Id`),
  ADD CONSTRAINT `usersandlikes_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `Users` (`UserId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
