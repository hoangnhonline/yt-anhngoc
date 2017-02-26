-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2017 at 11:56 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manage_yt`
--

-- --------------------------------------------------------

--
-- Table structure for table `chu_de`
--

CREATE TABLE `chu_de` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fire_fox_dir`
--

CREATE TABLE `fire_fox_dir` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name_dir` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `link_video`
--

CREATE TABLE `link_video` (
  `id` int(11) NOT NULL,
  `stt` int(11) NOT NULL,
  `link` varchar(500) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `id_chude` int(11) NOT NULL,
  `str_id_thuoctinh` varchar(255) NOT NULL,
  `id_mail` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notes` text,
  `created_user` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mail_upload`
--

CREATE TABLE `mail_upload` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `thuoc_tinh_chu_de`
--

CREATE TABLE `thuoc_tinh_chu_de` (
  `id` int(11) NOT NULL,
  `id_chude` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL COMMENT '3 : superadmin 2 : admin : 1 user',
  `remarks` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `remarks`, `status`, `viewed`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@youtube.com', '$2y$10$/vF4N2AKvZub7jnhWpTaWeBoejGkbad5DOx9IRfBTvKqWkzgPuTX6', 3, NULL, 1, 0, 'qXXg4vi7Qk47HVLY3rCAsKzFOXIHLa6RvORrJE7R2s5FltAt4B9qmiQuq7SC', '0000-00-00 00:00:00', '2017-02-26 17:52:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chu_de`
--
ALTER TABLE `chu_de`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fire_fox_dir`
--
ALTER TABLE `fire_fox_dir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link_video`
--
ALTER TABLE `link_video`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stt` (`stt`);

--
-- Indexes for table `mail_upload`
--
ALTER TABLE `mail_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thuoc_tinh_chu_de`
--
ALTER TABLE `thuoc_tinh_chu_de`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chu_de`
--
ALTER TABLE `chu_de`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fire_fox_dir`
--
ALTER TABLE `fire_fox_dir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `link_video`
--
ALTER TABLE `link_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mail_upload`
--
ALTER TABLE `mail_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `thuoc_tinh_chu_de`
--
ALTER TABLE `thuoc_tinh_chu_de`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
