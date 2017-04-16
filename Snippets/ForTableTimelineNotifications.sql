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
  
  
  