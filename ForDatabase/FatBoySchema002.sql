-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2017 at 05:39 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FatBoy`
--

-- --------------------------------------------------------

--
-- Table structure for table `Address`
--

CREATE TABLE `Address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_type_code` int(2) NOT NULL,
  `street1` varchar(500) NOT NULL,
  `street2` varchar(500) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `country_code` varchar(2) NOT NULL,
  `phone` varchar(20) NOT NULL DEFAULT '(zZz-69-zZz)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Address`
--

INSERT INTO `Address` (`id`, `user_id`, `address_type_code`, `street1`, `street2`, `city`, `state`, `zip`, `country_code`, `phone`) VALUES
(8, 10, 1, '78 Monkhouse Rd', '', 'Markham', 'ON', 'L6E 1V5', 'CA', '(zZz-69-zZz)'),
(16, 15, 1, '16 Florence St', 'Merville Park Subd', 'Paranaque', 'Metro Manila', '1709', 'PH', ''),
(18, 8, 1, '105-50 Thorncliffe Park Dr', '', 'East York', 'ON', 'M4H 1K4', 'CA', ''),
(23, 8, 2, '105-50 Thorncliffe Park Dr', '', 'East York', 'ON', 'M4H 1K4', 'CA', '(zZz-69-zZz)');

-- --------------------------------------------------------

--
-- Table structure for table `CartItems`
--

CREATE TABLE `CartItems` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CartItems`
--

INSERT INTO `CartItems` (`id`, `cart_id`, `item_id`, `quantity`) VALUES
(97, 37, 5, 1),
(98, 37, 4, 1),
(99, 38, 2, 0),
(100, 38, 3, 0),
(101, 39, 3, 0),
(102, 40, 10, 1),
(103, 41, 4, 1),
(104, 42, 10, 1),
(105, 43, 18, 2),
(106, 44, 18, 2),
(107, 38, 9, 0),
(108, 38, 17, 1),
(109, 39, 2, 0),
(110, 39, 9, 0),
(111, 39, 17, 1),
(112, 38, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Country`
--

CREATE TABLE `Country` (
  `id` int(3) NOT NULL,
  `code` varchar(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Country`
--

INSERT INTO `Country` (`id`, `code`, `name`) VALUES
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
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Friendship`
--

INSERT INTO `Friendship` (`user_id`, `friend_id`) VALUES
(8, 9),
(8, 10),
(8, 15),
(9, 8),
(9, 10),
(9, 15),
(10, 8),
(10, 9),
(15, 8),
(15, 9);

-- --------------------------------------------------------

--
-- Table structure for table `FriendshipNotifications`
--

CREATE TABLE `FriendshipNotifications` (
  `notified_user_id` int(11) NOT NULL,
  `notifier_user_id` int(11) NOT NULL,
  `notification_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Invoice`
--

CREATE TABLE `Invoice` (
  `id` varchar(50) NOT NULL,
  `seller_user_id` int(11) NOT NULL,
  `buyer_user_id` int(11) NOT NULL,
  `ship_to_address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `InvoiceItem`
--

CREATE TABLE `InvoiceItem` (
  `id` int(12) NOT NULL,
  `invoice_id` varchar(50) NOT NULL,
  `store_item_id` int(11) NOT NULL,
  `invoice_item_status_record_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `InvoiceItemStatus`
--

CREATE TABLE `InvoiceItemStatus` (
  `id` int(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `InvoiceItemStatusRecord`
--

CREATE TABLE `InvoiceItemStatusRecord` (
  `id` int(12) NOT NULL,
  `invoice_item_id` int(12) NOT NULL,
  `invoice_item_status_id` int(2) NOT NULL,
  `status_start_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Likes`
--

CREATE TABLE `Likes` (
  `id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Likes`
--

INSERT INTO `Likes` (`id`, `name`) VALUES
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
(24, 'mangga'),
(25, 'bask'),
(26, 'crazy'),
(27, 'tae'),
(28, 'badminton'),
(29, 'laundry'),
(30, 'putangina'),
(31, 'gae'),
(32, 'fukc'),
(33, 'gh'),
(34, 'facebook'),
(35, 'x');

-- --------------------------------------------------------

--
-- Table structure for table `MyStoreItems`
--

CREATE TABLE `MyStoreItems` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(3000) NOT NULL,
  `photo_address` varchar(1000) NOT NULL,
  `quantity` int(11) NOT NULL,
  `mass` float DEFAULT NULL,
  `length` float DEFAULT NULL,
  `width` float DEFAULT NULL,
  `height` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `MyStoreItems`
--

INSERT INTO `MyStoreItems` (`id`, `user_id`, `name`, `price`, `description`, `photo_address`, `quantity`, `mass`, `length`, `width`, `height`) VALUES
(1, 8, 'ASUS Gaming PC', 1099.97, 'CPU: 4.4GHz Quad Core Intel Core i7 Devil\'s Canyon,\r\n\r\nMotherBoard: MSI Gaming 5 Series,\r\n\r\nMemory: 16GB Kingston HyperX,\r\n\r\nSDD: 512GB Samsung 850 Pro\r\n                                                                                                                                                                                                                                ', 'https://cdn2.pcadvisor.co.uk/cmsdata/reviews/3605095/ViBox_Wildfire_gaming_PC.jpg\r\n\r\n                                                                                                                                                    ', 0, 529.09, 24.88, 12, 24.14),
(2, 8, 'Home-Made Cute Shirt', 5.99, 'Anime-like shirt.<br>\r\n2 shirts for only $4.99.<br>\r\nNot only will you get an awesome shirt, but you\'ll also support me..<br>\r\nThank you so much :)                                                                                                                ', 'http://pre13.deviantart.net/8eb1/th/pre/f/2014/171/b/c/gumball_and_darwin_homemade_t_shirts_by_gumball28-d7n6iba.jpg                                                                                                ', 4, 3.53, 8, 6, 0.5),
(3, 8, 'File Cabinet Drawer', 21, 'Awesome file drawers.<br>\r\nSlightly worn out.<br>\r\nShips in 2 days...                ', 'http://nebula.wsimg.com/obj/N0E0RkZFMTdEMjI2NkY3REM0NDQ6MWRhZTkzZGQ3YTVmOWU1NWEzZmRjZGIzYjQxYjg0MjI6Ojo6OjA=                    ', 2, 1440, 40, 25, 55),
(4, 9, 'Pink HP Laptop', 430, '2-year old HP laptop.<br>\r\nMemory: 4GB<br>\r\nCPU: 2,7GHz Dual Core Intel Core i3<br>\r\nSSD: 512GB Corsair SSD                ', 'http://idg.bg/test/pcw/2014/9/30/23085-HP_Stream-1.jpg                ', 2, 64, 15, 11, 2),
(5, 9, '10 foot Teddy Bear', 99, '10 foot Teddy Bear. Fluffy.<br>\r\nCute<br>\r\nSuper huggable.<br>\r\nWho say\'s we need pillows to sleep?                                                                ', 'http://g02.a.alicdn.com/kf/HTB122WxKFXXXXcmXFXXq6xXFXXX9/stuffed-animal-80cm-cute-font-b-teddy-b-font-bear-stripes-design-a-pair-lovers-bear.jpg                                                               ', 1, 1120, 124, 30, 40),
(9, 8, 'Bose Headphones', 449.95, 'Good quiet comfort headphones.<br>\r\nYou\'ll definitely NOT miss out the world around you.<br>\r\n<a href=\'http://www.nba.com\'>Check it out</a>                                                                                \r\n<h2>The BOSE</h2>', 'http://bpc.h-cdn.co/assets/16/30/980x490/landscape-1469479026-bose-qc35-headphones-promo-2.jpg                                                                         ', 1, 5, 9, 7, 3),
(10, 10, 'Bucad-Javier Dawes Place Dental - Oral-B Toothbrush', 19.49, 'The predecessor of the toothbrush is the chew stick. Chew sticks were twigs with frayed ends used to brush the teeth while the other end was used as a toothpick. The earliest chew sticks were discovered in Babylonia in 3500 BC,[4] an Egyptian tomb dating from 3000 BC,[3] and mentioned in Chinese records dating from 1600 BC. The Greeks and Romans used toothpicks to clean their teeth and toothpick like twigs have been excavated in Qin Dynasty tombs.[4] Chew sticks remain common in Africa[5] the rural Southern United States[3] and in the Islamic world the use of chewing stick Miswak is considered a pious action and has been prescribed to be used before every prayer five times a day.[6] Miswaks have been used by Muslims since 7th century.                                                                ', 'http://thesweethome.com/wp-content/uploads/sites/3/2013/05/02-electric-toothbrushes1.jpg                                                                ', 15, 1, 8, 3, 2),
(16, 8, 'sdaf', 0.01, 'asdf', 'asdf', 1, 0.01, 0.01, 0.01, 0.01),
(17, 8, 'Sony PS4 Slim', 249.99, 'The PlayStation 4 (abbreviated as PS4) is a home video game console developed by Sony Computer Entertainment. Announced as the successor to the PlayStation 3 during a press conference on February 20, 2013, it was launched on November 15 in North America, November 29 in Europe, South America and Australia, and February 22, 2014, in Japan. It competes with Nintendo\'s Wii U and Microsoft\'s Xbox One, as part of the eighth generation of video game consoles.', 'https://cnet4.cbsistatic.com/img/TLqceBxnUV960hnSRwgD0R05vlA=/1170x0/2013/11/11/4b0cb750-6788-11e3-846b-14feb5ca9861/Sony_PS4_35618167_01.jpg        ', 2, 96, 15, 15, 6),
(18, 15, 'Nike Run', 109.49, 'Nike running shoes.', 'http://www.ladyfootlocker.com/ns/as/lflbp110616a-shoes.jpg', 7, 109, 12, 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `MyVideos`
--

CREATE TABLE `MyVideos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `embed_code` varchar(1000) NOT NULL,
  `rating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `MyVideos`
--

INSERT INTO `MyVideos` (`id`, `user_id`, `title`, `embed_code`, `rating`) VALUES
(1, 8, 'Hello - Adele Cover', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/Rn00vAlcnR4\" frameborder=\"0\" allowfullscreen></iframe>', 8),
(2, 8, 'Adele - Hello (Emblem3 Cover)', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/DDGdEp1fWQU\" frameborder=\"0\" allowfullscreen></iframe>', 7),
(3, 8, 'Kailan', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/ZUeLmDsLw5s\" frameborder=\"0\" allowfullscreen></iframe>', 0),
(4, 8, 'Hello by Leroy Sanchez', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/vlZ9kjCrGJw\" frameborder=\"0\" allowfullscreen></iframe>', 0),
(5, 8, 'When We Were Young - Adele Cover', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/ao7Et8ZqXfs\" frameborder=\"0\" allowfullscreen></iframe>', 0),
(6, 8, 'James Arthur - When we were young (Adele cover) live acoustic session', '<div style=\"position:relative;height:0;padding-bottom:56.25%\"><iframe src=\"https://www.youtube.com/embed/SJUPDs5VLsk?ecver=2\" width=\"640\" height=\"360\" frameborder=\"0\" style=\"position:absolute;width:100%;height:100%;left:0\" allowfullscreen></iframe></div>', 0),
(7, 8, 'Celtics vs Bulls - Game 1', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/7qV3tKtqrNk\" frameborder=\"0\" allowfullscreen></iframe>', 7),
(8, 8, 'Bulls vs Jazz 1998 NBA Finals', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/530z-_yjdlU\" frameborder=\"0\" allowfullscreen></iframe>', 7),
(9, 10, 'Cavs vs Pacers - Game 2 - Kyrie the Giant', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/R7Ui_FnOPh8\" frameborder=\"0\" allowfullscreen></iframe>', 7);

-- --------------------------------------------------------

--
-- Table structure for table `NotificationTypes`
--

CREATE TABLE `NotificationTypes` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `NotificationTypes`
--

INSERT INTO `NotificationTypes` (`id`, `name`) VALUES
(3, 'a post reply'),
(2, 'dub acceptance'),
(1, 'dub request');

-- --------------------------------------------------------

--
-- Table structure for table `StoreCart`
--

CREATE TABLE `StoreCart` (
  `cart_id` int(11) NOT NULL,
  `seller_user_id` int(11) NOT NULL,
  `buyer_user_id` int(11) NOT NULL,
  `is_complete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `StoreCart`
--

INSERT INTO `StoreCart` (`cart_id`, `seller_user_id`, `buyer_user_id`, `is_complete`) VALUES
(37, 9, 10, 0),
(38, 8, 10, 0),
(39, 8, 9, 0),
(40, 10, 9, 0),
(41, 9, 8, 0),
(42, 10, 8, 0),
(43, 15, 8, 0),
(44, 15, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `TimelinePostReplies`
--

CREATE TABLE `TimelinePostReplies` (
  `id` int(11) NOT NULL,
  `parent_post_id` int(11) NOT NULL,
  `owner_user_id` int(11) NOT NULL,
  `poster_user_id` int(11) NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TimelinePostReplies`
--

INSERT INTO `TimelinePostReplies` (`id`, `parent_post_id`, `owner_user_id`, `poster_user_id`, `date_posted`, `message`) VALUES
(1, 14, 8, 8, '2017-03-26 12:36:33', ''),
(2, 14, 8, 8, '2017-03-26 12:38:07', 'ok lang king jems.. kaw ngay?'),
(3, 14, 8, 8, '2017-03-26 13:03:36', 'Ok din ako.. Nagbabasketbol ka pa rin ba?'),
(4, 14, 8, 8, '2017-03-26 13:06:20', 'Bren sino to? Pinsan mo ba?'),
(5, 14, 8, 8, '2017-03-26 13:13:58', 'tae ka boi'),
(6, 14, 8, 8, '2017-03-26 13:14:59', 'ka ba?'),
(7, 14, 8, 8, '2017-03-26 14:04:13', 'lokohan ba to?'),
(8, 14, 8, 8, '2017-03-26 14:04:46', 'ok lang yan king...'),
(9, 14, 8, 8, '2017-03-26 14:13:31', 'taenaman'),
(10, 15, 8, 8, '2017-03-26 14:14:38', 'ayos na'),
(11, 15, 8, 8, '2017-03-26 14:27:24', 'thank u tol'),
(12, 15, 8, 8, '2017-03-26 15:32:38', 'ayos king'),
(13, 15, 8, 8, '2017-03-26 15:32:46', 'bilib talaga ako sayo'),
(14, 15, 8, 8, '2017-03-28 02:04:07', 'halla si kuya bren');

-- --------------------------------------------------------

--
-- Table structure for table `TimelinePosts`
--

CREATE TABLE `TimelinePosts` (
  `id` int(11) NOT NULL,
  `owner_user_id` int(6) NOT NULL,
  `poster_user_id` int(6) NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TimelinePosts`
--

INSERT INTO `TimelinePosts` (`id`, `owner_user_id`, `poster_user_id`, `date_posted`, `message`) VALUES
(14, 8, 8, '2017-03-26 02:48:12', 'kobe bwakaw'),
(15, 8, 8, '2017-03-26 02:56:08', 'ukinayo met\r\n'),
(16, 8, 8, '2017-03-26 03:15:30', 'I love reading books..'),
(17, 8, 8, '2017-03-26 03:15:46', 'hello kuya bren'),
(18, 8, 8, '2017-03-26 03:16:26', 'baket?'),
(19, 8, 8, '2017-03-26 04:13:38', 'mangga na nga lang kinakain ko, di pa rin ako pumapayat'),
(20, 8, 8, '2017-03-26 04:16:57', 'musta na bren.. tmac'),
(21, 8, 8, '2017-03-26 13:14:51', 'bakler'),
(22, 8, 8, '2017-03-28 02:01:27', 'hey'),
(23, 8, 8, '2017-03-28 10:50:48', 'bdnjdjjkf'),
(24, 8, 8, '2017-04-04 09:36:25', 'Shipping'),
(25, 8, 8, '2017-04-04 22:30:48', 'Hello ading bren ;('),
(26, 8, 8, '2017-04-13 20:37:47', 'mbvhb');

-- --------------------------------------------------------

--
-- Table structure for table `UserPayPalAccount`
--

CREATE TABLE `UserPayPalAccount` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paypal_client_id` varchar(1000) NOT NULL,
  `paypal_secret_id` varchar(1000) NOT NULL,
  `account_type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserPayPalAccount`
--

INSERT INTO `UserPayPalAccount` (`id`, `user_id`, `paypal_client_id`, `paypal_secret_id`, `account_type`) VALUES
(4, 8, 'AY9lIQxIKr5wKR8d0TrbmZvFJiVBvbt00OhKzDjSx7H8PisS1EvvjWLWl6rbc3o5wnHhUyR_WVzPjVH7', 'EEUY_Z8yup8UQIy6vEnAwntI9UsHC43KXTP3p12j6DUH7PAI-axB-gS552u4XD2-gvvcQOwMR3ArwIHf', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `user_type_id` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `user_name`, `hashed_password`, `user_type_id`) VALUES
(8, 'bren', '$2y$10$NUvesdcKf749dWYzg2Ll/Ok88DKAOoJF2gU5eUo3DHMgg55/CfBaW', 1),
(9, 'c', '$2y$10$K5SpUutbvfrIw2gmi5pDh.SjhfCIah2n.kgmK8W285vwwB/KL0q9.', 1),
(10, 'ye', '$2y$10$YJ4PuMoBFbjECsCouWi1/OXSM4E9adnyT47LcaXvgEvWOG0yO0VXS', 1),
(11, 'apesapes123', '$2y$10$aOgIUHN8sb30x7uKA14QMe5QPoqmnmjeKljmCTITY5.HedkxGYsW6', 1),
(12, 'kobekobe123', '$2y$10$sKJjEP.JlR3zUjs8VxwhiOlCGtiOyGV7S0LKs/WGl3psTHxpwSRkW', 1),
(13, 'johnjohn123', '$2y$10$6ieChkTpeDxadg03ebcrJeOtQaegjldDqYTGTjLGkbPX3xsUyp8Oi', 1),
(14, 'UserForOneTimeAddresses123', '$2y$10$R8nKvfFjh4oj5wMfqoMreePXh1VrgyZvxFMeeUG2ZJ2RgpgwIMD3a', 1),
(15, 'leilei123', '$2y$10$JcHTcbO94oJbaKdIkAf9J.5U9qXmh4lD/2fa7.Or9CXXqMNYWk.fu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `UsersAndLikes`
--

CREATE TABLE `UsersAndLikes` (
  `user_id` int(11) NOT NULL,
  `like_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UsersAndLikes`
--

INSERT INTO `UsersAndLikes` (`user_id`, `like_id`) VALUES
(8, 1),
(8, 3),
(8, 5),
(8, 19),
(8, 20),
(8, 21),
(8, 28),
(8, 29),
(9, 1),
(9, 12),
(9, 14),
(9, 15),
(9, 16),
(9, 17),
(9, 18),
(9, 24),
(10, 33),
(11, 34);

-- --------------------------------------------------------

--
-- Table structure for table `UserTypes`
--

CREATE TABLE `UserTypes` (
  `id` int(2) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserTypes`
--

INSERT INTO `UserTypes` (`id`, `type_name`) VALUES
(2, 'admin'),
(1, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  --ADD UNIQUE KEY `user_id_2` (`user_id`,`address_type_code`),
  ADD KEY `id_2` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `country_code` (`country_code`),
  ADD KEY `country_code_2` (`country_code`);

--
-- Indexes for table `CartItems`
--
ALTER TABLE `CartItems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_id_2` (`cart_id`,`item_id`),
  ADD KEY `id` (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `Country`
--
ALTER TABLE `Country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `code_2` (`code`),
  ADD KEY `id_2` (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `code_3` (`code`),
  ADD KEY `name_2` (`name`),
  ADD KEY `id_3` (`id`),
  ADD KEY `code_4` (`code`);

--
-- Indexes for table `Friendship`
--
ALTER TABLE `Friendship`
  ADD PRIMARY KEY (`user_id`,`friend_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`friend_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `FriendshipNotifications`
--
ALTER TABLE `FriendshipNotifications`
  ADD PRIMARY KEY (`notified_user_id`,`notifier_user_id`,`notification_type_id`),
  ADD UNIQUE KEY `notified_user_id` (`notified_user_id`,`notifier_user_id`,`notification_type_id`),
  ADD KEY `notifier_user_id` (`notifier_user_id`),
  ADD KEY `notification_type_id` (`notification_type_id`);

--
-- Indexes for table `Invoice`
--
ALTER TABLE `Invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `seller_user_id` (`seller_user_id`),
  ADD KEY `buyer_user_id` (`buyer_user_id`),
  ADD KEY `ship_to_address_id` (`ship_to_address_id`);

--
-- Indexes for table `InvoiceItem`
--
ALTER TABLE `InvoiceItem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `store_item_id` (`store_item_id`);

--
-- Indexes for table `InvoiceItemStatus`
--
ALTER TABLE `InvoiceItemStatus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `InvoiceItemStatusRecord`
--
ALTER TABLE `InvoiceItemStatusRecord`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `invoice_item_status_id` (`invoice_item_status_id`),
  ADD KEY `invoice_item_id` (`invoice_item_id`);

--
-- Indexes for table `Likes`
--
ALTER TABLE `Likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `MyStoreItems`
--
ALTER TABLE `MyStoreItems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `name` (`name`),
  ADD KEY `id_3` (`id`),
  ADD KEY `user_id_2` (`user_id`),
  ADD KEY `name_2` (`name`);

--
-- Indexes for table `MyVideos`
--
ALTER TABLE `MyVideos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `NotificationTypes`
--
ALTER TABLE `NotificationTypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `StoreCart`
--
ALTER TABLE `StoreCart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `seller_user_id` (`seller_user_id`),
  ADD KEY `buyer_user_id` (`buyer_user_id`);

--
-- Indexes for table `TimelinePostReplies`
--
ALTER TABLE `TimelinePostReplies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `parent_post_id` (`parent_post_id`),
  ADD KEY `owner_user_id` (`owner_user_id`),
  ADD KEY `poster_user_id` (`poster_user_id`);

--
-- Indexes for table `TimelinePosts`
--
ALTER TABLE `TimelinePosts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_user_id` (`owner_user_id`),
  ADD KEY `id` (`id`),
  ADD KEY `poster_user_id` (`poster_user_id`);

--
-- Indexes for table `UserPayPalAccount`
--
ALTER TABLE `UserPayPalAccount`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `UsersAndLikes`
--
ALTER TABLE `UsersAndLikes`
  ADD PRIMARY KEY (`user_id`,`like_id`),
  ADD KEY `like_id` (`like_id`);

--
-- Indexes for table `UserTypes`
--
ALTER TABLE `UserTypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_name` (`type_name`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Address`
--
ALTER TABLE `Address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `CartItems`
--
ALTER TABLE `CartItems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `Country`
--
ALTER TABLE `Country`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `InvoiceItem`
--
ALTER TABLE `InvoiceItem`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `InvoiceItemStatus`
--
ALTER TABLE `InvoiceItemStatus`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `InvoiceItemStatusRecord`
--
ALTER TABLE `InvoiceItemStatusRecord`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Likes`
--
ALTER TABLE `Likes`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `MyStoreItems`
--
ALTER TABLE `MyStoreItems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `MyVideos`
--
ALTER TABLE `MyVideos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `NotificationTypes`
--
ALTER TABLE `NotificationTypes`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `StoreCart`
--
ALTER TABLE `StoreCart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `TimelinePostReplies`
--
ALTER TABLE `TimelinePostReplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `TimelinePosts`
--
ALTER TABLE `TimelinePosts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `UserPayPalAccount`
--
ALTER TABLE `UserPayPalAccount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `UserTypes`
--
ALTER TABLE `UserTypes`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Address`
--
ALTER TABLE `Address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`country_code`) REFERENCES `Country` (`code`);

--
-- Constraints for table `CartItems`
--
ALTER TABLE `CartItems`
  ADD CONSTRAINT `cartitems_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `StoreCart` (`cart_id`),
  ADD CONSTRAINT `cartitems_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `MyStoreItems` (`id`);

--
-- Constraints for table `Friendship`
--
ALTER TABLE `Friendship`
  ADD CONSTRAINT `friendship_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `friendship_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `FriendshipNotifications`
--
ALTER TABLE `FriendshipNotifications`
  ADD CONSTRAINT `friendshipnotifications_ibfk_1` FOREIGN KEY (`notified_user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `friendshipnotifications_ibfk_2` FOREIGN KEY (`notifier_user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `friendshipnotifications_ibfk_3` FOREIGN KEY (`notification_type_id`) REFERENCES `NotificationTypes` (`id`);

--
-- Constraints for table `Invoice`
--
ALTER TABLE `Invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`seller_user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`buyer_user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `invoice_ibfk_3` FOREIGN KEY (`ship_to_address_id`) REFERENCES `Address` (`id`);

--
-- Constraints for table `InvoiceItem`
--
ALTER TABLE `InvoiceItem`
  ADD CONSTRAINT `invoiceitem_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `Invoice` (`id`),
  ADD CONSTRAINT `invoiceitem_ibfk_2` FOREIGN KEY (`store_item_id`) REFERENCES `MyStoreItems` (`id`);

--
-- Constraints for table `InvoiceItemStatusRecord`
--
ALTER TABLE `InvoiceItemStatusRecord`
  ADD CONSTRAINT `invoiceitemstatusrecord_ibfk_1` FOREIGN KEY (`invoice_item_status_id`) REFERENCES `InvoiceItemStatus` (`id`),
  ADD CONSTRAINT `invoiceitemstatusrecord_ibfk_2` FOREIGN KEY (`invoice_item_id`) REFERENCES `InvoiceItem` (`id`);

--
-- Constraints for table `MyStoreItems`
--
ALTER TABLE `MyStoreItems`
  ADD CONSTRAINT `mystoreitems_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `MyVideos`
--
ALTER TABLE `MyVideos`
  ADD CONSTRAINT `myvideos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `StoreCart`
--
ALTER TABLE `StoreCart`
  ADD CONSTRAINT `storecart_ibfk_1` FOREIGN KEY (`seller_user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `storecart_ibfk_2` FOREIGN KEY (`buyer_user_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `TimelinePostReplies`
--
ALTER TABLE `TimelinePostReplies`
  ADD CONSTRAINT `timelinepostreplies_ibfk_1` FOREIGN KEY (`parent_post_id`) REFERENCES `TimelinePosts` (`id`),
  ADD CONSTRAINT `timelinepostreplies_ibfk_2` FOREIGN KEY (`owner_user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `timelinepostreplies_ibfk_3` FOREIGN KEY (`poster_user_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `TimelinePosts`
--
ALTER TABLE `TimelinePosts`
  ADD CONSTRAINT `timelineposts_ibfk_1` FOREIGN KEY (`owner_user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `timelineposts_ibfk_2` FOREIGN KEY (`poster_user_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `UserPayPalAccount`
--
ALTER TABLE `UserPayPalAccount`
  ADD CONSTRAINT `userpaypalaccount_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `UserTypes` (`id`);

--
-- Constraints for table `UsersAndLikes`
--
ALTER TABLE `UsersAndLikes`
  ADD CONSTRAINT `usersandlikes_ibfk_1` FOREIGN KEY (`like_id`) REFERENCES `Likes` (`id`),
  ADD CONSTRAINT `usersandlikes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
