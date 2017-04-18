--
-- Table structure for table `UserTypes`
--

CREATE TABLE `UserTypes` (
  `id` int(2) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





--
-- Indexes for table `UserTypes`
--
ALTER TABLE `UserTypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_name` (`type_name`),
  ADD KEY `id` (`id`);
  
  
  
  
  
-- AUTO_INCREMENT for table `UserTypes`
--
ALTER TABLE `UserTypes`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
  
  
  
  
  
--
-- Dumping data for table `UserTypes`
--

INSERT INTO `UserTypes` (`id`, `type_name`) VALUES
(2, 'admin'),
(1, 'user');










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
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD KEY `user_type_id` (`user_type_id`);
  
  
  
  
  
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
  
  
  
  
  
--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `user_name`, `hashed_password`, `user_type_id`) VALUES
(8, 'bren', '$2y$10$NUvesdcKf749dWYzg2Ll/Ok88DKAOoJF2gU5eUo3DHMgg55/CfBaW', 1),
(9, 'c', '$2y$10$K5SpUutbvfrIw2gmi5pDh.SjhfCIah2n.kgmK8W285vwwB/KL0q9.', 1),
(10, 'ye', '$2y$10$YJ4PuMoBFbjECsCouWi1/OXSM4E9adnyT47LcaXvgEvWOG0yO0VXS', 1),
(11, 'apesapes123', '$2y$10$aOgIUHN8sb30x7uKA14QMe5QPoqmnmjeKljmCTITY5.HedkxGYsW6', 1),
(12, 'kobekobe123', '$2y$10$sKJjEP.JlR3zUjs8VxwhiOlCGtiOyGV7S0LKs/WGl3psTHxpwSRkW', 1);

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
-- Indexes for table `TimelinePosts`
--
ALTER TABLE `TimelinePosts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_user_id` (`owner_user_id`),
  ADD KEY `id` (`id`),
  ADD KEY `poster_user_id` (`poster_user_id`);







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
  ADD CONSTRAINT `usersandlikes_ibfk_1` FOREIGN KEY (`like_id`) REFERENCES `Likes` (`id`),
  ADD CONSTRAINT `usersandlikes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);  
  
  
  
  
  
  
--
-- Dumping data for table `UsersAndLikes`
--

INSERT INTO `UsersAndLikes` (`user_id`, `like_id`) VALUES
(8, 1),
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
-- Indexes for table `MyVideos`
--
ALTER TABLE `MyVideos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`);
  
  
  
  
  
--
-- AUTO_INCREMENT for table `MyVideos`
--
ALTER TABLE `MyVideos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
  
  
  
  
  
-- Constraints for table `MyVideos`
--
ALTER TABLE `MyVideos`
  ADD CONSTRAINT `myvideos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);
  
  
  
  
  
--
-- Dumping data for table `MyVideos`
--

INSERT INTO `MyVideos` (`id`, `user_id`, `title`, `embed_code`, `rating`) VALUES
(1, 8, 'Hello - Adele Cover', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/Rn00vAlcnR4\" frameborder=\"0\" allowfullscreen></iframe>', 8),
(2, 8, 'Adele - Hello (Emblem3 Cover)', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/DDGdEp1fWQU\" frameborder=\"0\" allowfullscreen></iframe>', 7),
(3, 8, 'Kailan', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/ZUeLmDsLw5s\" frameborder=\"0\" allowfullscreen></iframe>', 0),
(4, 8, 'Hello by Leroy Sanchez', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/vlZ9kjCrGJw\" frameborder=\"0\" allowfullscreen></iframe>', 0),
(5, 8, 'When We Were Young - Adele Cover', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/ao7Et8ZqXfs\" frameborder=\"0\" allowfullscreen></iframe>', 0),
(6, 8, 'James Arthur - When we were young (Adele cover) live acoustic session', '<div style=\"position:relative;height:0;padding-bottom:56.25%\"><iframe src=\"https://www.youtube.com/embed/SJUPDs5VLsk?ecver=2\" width=\"640\" height=\"360\" frameborder=\"0\" style=\"position:absolute;width:100%;height:100%;left:0\" allowfullscreen></iframe></div>', 0);

-- --------------------------------------------------------  










--
-- Table structure for table `Friendship`
--

CREATE TABLE `Friendship` (
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





--
-- Indexes for table `Friendship`
--
ALTER TABLE `Friendship`
  ADD PRIMARY KEY (`user_id`,`friend_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`friend_id`),
  ADD KEY `friend_id` (`friend_id`);
  
  
  
  
  
  
--
-- Constraints for table `Friendship`
--
ALTER TABLE `Friendship`
  ADD CONSTRAINT `friendship_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `friendship_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `Users` (`user_id`);
  
  
  
  
  
  
  
  
  
  
--
-- Table structure for table `NotificationTypes`
--

CREATE TABLE `NotificationTypes` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;  





--
-- Indexes for table `NotificationTypes`
--
ALTER TABLE `NotificationTypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`);
  
  
  
  
  
-- AUTO_INCREMENT for table `NotificationTypes`
--
ALTER TABLE `NotificationTypes`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
  
  
  
  
  
--
-- Dumping data for table `NotificationTypes`
--

INSERT INTO `NotificationTypes` (`id`, `name`) VALUES
(3, 'a post reply'),
(2, 'dub acceptance'),
(1, 'dub request');

-- --------------------------------------------------------    
  
  
  
  
  
  
  
  
  
  
  
  
--
-- Table structure for table `FriendshipNotifications`
--

CREATE TABLE `FriendshipNotifications` (
  `notified_user_id` int(11) NOT NULL,
  `notifier_user_id` int(11) NOT NULL,
  `notification_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





--
-- Indexes for table `FriendshipNotifications`
--
ALTER TABLE `FriendshipNotifications`
  ADD PRIMARY KEY (`notified_user_id`,`notifier_user_id`,`notification_type_id`),
  ADD UNIQUE KEY `notified_user_id` (`notified_user_id`,`notifier_user_id`,`notification_type_id`),
  ADD KEY `notifier_user_id` (`notifier_user_id`),
  ADD KEY `notification_type_id` (`notification_type_id`);
  
  
  
  
  
--
-- Constraints for table `FriendshipNotifications`
--
ALTER TABLE `FriendshipNotifications`
  ADD CONSTRAINT `friendshipnotifications_ibfk_1` FOREIGN KEY (`notified_user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `friendshipnotifications_ibfk_2` FOREIGN KEY (`notifier_user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `friendshipnotifications_ibfk_3` FOREIGN KEY (`notification_type_id`) REFERENCES `NotificationTypes` (`id`);
  
  
  
  
  
  
  
  
  
  

  
  
  
  
  
  
  