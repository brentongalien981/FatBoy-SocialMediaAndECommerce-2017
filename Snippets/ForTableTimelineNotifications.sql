-- AUTO_INCREMENT for table `TimelinePosts`
--
ALTER TABLE `TimelinePosts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
  
  
  -- Constraints for table `TimelinePosts`
--
ALTER TABLE `TimelinePosts`
  ADD CONSTRAINT `timelineposts_ibfk_1` FOREIGN KEY (`owner_user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `timelineposts_ibfk_2` FOREIGN KEY (`poster_user_id`) REFERENCES `Users` (`user_id`);
  
  
--
-- Dumping data for table `TimelinePosts`
--

INSERT INTO `TimelinePosts` (`id`, `owner_user_id`, `poster_user_id`, `date_posted`, `message`) VALUES
(NULL, 8, 8, '2017-03-26 02:48:12', 'kobe bwakaw'),
(NULL, 8, 8, '2017-03-26 02:56:08', 'ukinayo met\r\n'),
(NULL, 8, 8, '2017-03-26 03:15:30', 'I love reading books..'),
(NULL, 8, 8, '2017-03-26 03:15:46', 'hello kuya bren'),
(NULL, 8, 8, '2017-03-26 03:16:26', 'baket?'),
(NULL, 8, 8, '2017-03-26 04:13:38', 'mangga na nga lang kinakain ko, di pa rin ako pumapayat'),
(NULL, 8, 8, '2017-03-26 04:16:57', 'musta na bren.. tmac'),
(NULL, 8, 8, '2017-03-26 13:14:51', 'bakler'),
(NULL, 8, 8, '2017-03-28 02:01:27', 'hey'),
(NULL, 8, 8, '2017-03-28 10:50:48', 'bdnjdjjkf'),
(NULL, 8, 8, '2017-04-04 09:36:25', 'Shipping'),
(NULL, 8, 8, '2017-04-04 22:30:48', 'Hello ading bren ;('),
(NULL, 8, 8, '2017-04-13 20:37:47', 'mbvhb');  










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
-- Indexes for table `TimelinePostReplies`
--
ALTER TABLE `TimelinePostReplies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `parent_post_id` (`parent_post_id`),
  ADD KEY `owner_user_id` (`owner_user_id`),
  ADD KEY `poster_user_id` (`poster_user_id`);
  
  
  
--
-- AUTO_INCREMENT for table `TimelinePostReplies`
--
ALTER TABLE `TimelinePostReplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
  
  
  
--
-- Constraints for table `TimelinePostReplies`
--
ALTER TABLE `TimelinePostReplies`
  ADD CONSTRAINT `timelinepostreplies_ibfk_1` FOREIGN KEY (`parent_post_id`) REFERENCES `TimelinePosts` (`id`),
  ADD CONSTRAINT `timelinepostreplies_ibfk_2` FOREIGN KEY (`owner_user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `timelinepostreplies_ibfk_3` FOREIGN KEY (`poster_user_id`) REFERENCES `Users` (`user_id`);
  
  
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
-- Table structure for table `Country`
--

CREATE TABLE `Country` (
  `id` int(3) NOT NULL,
  `code` varchar(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;  





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
-- AUTO_INCREMENT for table `Country`
--
ALTER TABLE `Country`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;  






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
-- Indexes for table `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `country_code` (`country_code`),
  ADD KEY `country_code_2` (`country_code`);
  
  
  
  
  
  

-- AUTO_INCREMENT for table `Address`
--
ALTER TABLE `Address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
  
  
  
  
  
  
--
-- Constraints for table `Address`
--
ALTER TABLE `Address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`country_code`) REFERENCES `Country` (`code`);  
  
  




--
-- Dumping data for table `Address`
--

INSERT INTO `Address` (`id`, `user_id`, `address_type_code`, `street1`, `street2`, `city`, `state`, `zip`, `country_code`, `phone`) VALUES
(8, 9, 1, '78 Monkhouse Rd', '', 'Markham', 'ON', 'L6E 1V5', 'CA', '(zZz-69-zZz)'),
(10, 8, 1, '16 Florence St', 'Merville Park Subdivision', 'Paranaque', 'Metro Manila', '1709', 'PH', '(zZz-69-zZz)');









--
-- Table structure for table `Likes`
--

CREATE TABLE `Likes` (
  `id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





--
-- Indexes for table `Likes`
--
ALTER TABLE `Likes`
  ADD PRIMARY KEY (`id`);
  
  
  
  
  
-- AUTO_INCREMENT for table `Likes`
--
ALTER TABLE `Likes`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
  
  
  
  
  
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
(24, 'mangga');  





--
-- Table structure for table `UsersAndLikes`
--

CREATE TABLE `UsersAndLikes` (
  `user_id` int(11) NOT NULL,
  `like_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





--
-- Indexes for table `UsersAndLikes`
--
ALTER TABLE `UsersAndLikes`
  ADD PRIMARY KEY (`user_id`,`like_id`),
  ADD KEY `like_id` (`like_id`);
  
  
  
  
  
--
-- Constraints for table `UsersAndLikes`
--
ALTER TABLE `UsersAndLikes`
  ADD CONSTRAINT `usersandlikes_ibfk_1` FOREIGN KEY (`like_id`) REFERENCES `Likes` (`Id`),
  ADD CONSTRAINT `usersandlikes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);  
  
  
  
  
  
  
--
-- Dumping data for table `UsersAndLikes`
--

INSERT INTO `UsersAndLikes` (`user_id`, `like_id`) VALUES
(8, 1),
(8, 3),
(8, 20),
(8, 21),
(8, 3),
(8, 5),
(8, 6),
(8, 7),
(8, 19),
(9, 12),
(9, 17),
(9, 18),
(9, 14),
(9, 15),
(9, 16),
(9, 1),
(9, 24);  