--
-- Table structure for table `registered_users`
--

CREATE TABLE `registered_users` (
  `id` int(8) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `opt_adm` int(1) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registered_users`
--

INSERT INTO `registered_users` (`id`, `user_name`, `display_name`, `password`, `email`, `opt_adm`) VALUES
(1, 'DefaultUser', 'User Orig Name', 'MD5 PASSW', 'your@mail.com', '1'); -- Change to Your own sensitive datas. OPT_ADM = 1 Create an admin permisssioned user --

--
-- Indexes for table `registered_users`
--
ALTER TABLE `registered_users`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT for table `registered_users`
--
ALTER TABLE `registered_users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;





--
-- Table structure for table `registered_cameras
--

CREATE TABLE `registered_cameras` (
  `c_id` int(8) NOT NULL,
  `display_camname` varchar(255) NOT NULL,
  `cam_path` varchar(255) NOT NULL,
  `cam_owner` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registered_cameras`
--

INSERT INTO `registered_cameras` (`c_id`, `display_camname`, `cam_path`, `cam_owner`) VALUES
(1, 'DefaultCAM', '/DATAS/CMS/', 1); -- Change to Your own camera datas --

--
-- Indexes for table `registered_cameras
--
ALTER TABLE `registered_cameras`
  ADD PRIMARY KEY (`c_id`);


--
-- AUTO_INCREMENT for table `registered_cameras
--
ALTER TABLE `registered_cameras`
  MODIFY `c_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;