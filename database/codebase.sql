-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 07, 2013 at 04:14 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `codebase`
--

-- --------------------------------------------------------

--
-- Table structure for table `cb_area`
--

CREATE TABLE `cb_area` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `city_id` int(5) NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `status` enum('active','inactive','disabled') collate latin1_general_ci NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `cb_area`
--

INSERT INTO `cb_area` (`id`, `name`, `city_id`, `created_date`, `updated_date`, `status`) VALUES
(1, 'Miramar', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(2, 'Market', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(5, 'Bus-stand', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(4, 'Kala Academy', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(10, 'market', 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(13, 'Bus stand', 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(12, 'Bhailee Petha', 35, '2012-10-27 19:02:11', '2012-10-27 19:02:11', 'active'),
(15, 'Market', 38, '2012-10-27 21:03:01', '2012-10-27 21:03:01', 'active'),
(16, 'Devool Wada', 38, '2012-10-27 21:03:11', '2012-10-27 21:03:11', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cb_category`
--

CREATE TABLE `cb_category` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `status` enum('active','inactive') collate latin1_general_ci NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `cb_category`
--

INSERT INTO `cb_category` (`id`, `name`, `created_date`, `updated_date`, `status`) VALUES
(1, 'Automobiles', '2012-10-27 15:09:53', '2012-10-27 15:09:53', 'active'),
(2, 'Electronics', '2012-08-25 17:56:25', '0000-00-00 00:00:00', 'active'),
(3, 'Real Estatess', '2012-12-04 17:31:13', '2012-12-04 17:31:13', 'active'),
(4, 'Events', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(5, 'Jobs', '2012-12-04 17:31:04', '2012-12-04 17:31:04', 'active'),
(6, 'Education', '2012-12-04 17:31:09', '2012-12-04 17:31:09', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cb_city`
--

CREATE TABLE `cb_city` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `state_id` int(5) NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `status` enum('active','inactive','disabled') collate latin1_general_ci NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=45 ;

--
-- Dumping data for table `cb_city`
--

INSERT INTO `cb_city` (`id`, `name`, `state_id`, `created_date`, `updated_date`, `status`) VALUES
(35, 'Bicholim', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(2, 'Margao', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(3, 'Mapusa', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(36, 'Vasco', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(1, 'Panjim', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(38, 'St Cruz', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(39, 'Ponda', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(40, 'Dona-Paula', 1, '2012-10-27 17:54:26', '2012-10-27 17:54:26', 'active'),
(42, 'New york street', 10, '2012-08-05 20:38:13', '0000-00-00 00:00:00', 'active'),
(43, 'Dallas', 11, '2012-08-05 20:38:13', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cb_country`
--

CREATE TABLE `cb_country` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `status` enum('active','inactive','disabled') collate latin1_general_ci NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cb_country`
--

INSERT INTO `cb_country` (`id`, `name`, `created_date`, `updated_date`, `status`) VALUES
(1, 'India', '2012-10-27 17:59:47', '2012-10-27 17:59:47', 'active'),
(2, 'US', '2012-10-27 16:01:32', '2012-10-27 16:01:32', 'inactive'),
(3, 'Japan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(7, 'Britan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cb_state`
--

CREATE TABLE `cb_state` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `country_id` int(5) NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `status` enum('active','inactive','disabled') collate latin1_general_ci NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `cb_state`
--

INSERT INTO `cb_state` (`id`, `name`, `country_id`, `created_date`, `updated_date`, `status`) VALUES
(1, 'Goa', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(8, 'Rajastan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(3, 'Assam', 1, '2012-10-27 21:04:27', '2012-10-27 21:04:27', 'active'),
(7, 'Maha', 1, '2012-10-21 07:34:46', '2012-10-21 07:34:46', 'active'),
(5, 'west bengal', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(6, 'Kerala', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(10, 'New York', 2, '2012-08-05 20:37:23', '0000-00-00 00:00:00', 'active'),
(11, 'Texa', 2, '2012-08-05 20:37:23', '0000-00-00 00:00:00', 'active'),
(12, 'Gujarat', 1, '2012-10-21 07:34:31', '2012-10-21 07:34:31', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cb_sub_category`
--

CREATE TABLE `cb_sub_category` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `priority_number` int(10) NOT NULL,
  `category_id` int(5) NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `status` enum('active','inactive') collate latin1_general_ci NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=40 ;

--
-- Dumping data for table `cb_sub_category`
--

INSERT INTO `cb_sub_category` (`id`, `name`, `priority_number`, `category_id`, `created_date`, `updated_date`, `status`) VALUES
(2, 'Four Wheelers', 2, 1, '2012-09-03 14:14:07', '0000-00-00 00:00:00', 'active'),
(3, 'Other Vehicles', 3, 1, '2012-09-03 14:14:07', '0000-00-00 00:00:00', 'active'),
(35, 'Hardware', 0, 5, '2012-12-07 11:08:13', '2012-12-07 11:08:13', 'active'),
(36, 'Marketting', 0, 5, '2012-12-07 11:08:18', '2012-12-07 11:08:18', 'active'),
(33, 'Exhibitions', 0, 4, '2012-12-07 11:07:56', '2012-12-07 11:07:56', 'active'),
(34, 'Software', 0, 5, '2012-12-07 11:08:08', '2012-12-07 11:08:08', 'active'),
(10, 'Two Wheelers', 10, 1, '2012-12-07 11:07:24', '2012-12-07 11:07:24', 'active'),
(32, 'Seminars', 0, 4, '2012-12-07 11:07:47', '2012-12-07 11:07:47', 'active'),
(31, 'Cultural', 0, 4, '2012-12-07 11:07:40', '2012-12-07 11:07:40', 'active'),
(13, 'Camera', 0, 2, '2012-12-07 11:06:27', '2012-12-07 11:06:27', 'active'),
(14, 'Mobiles', 0, 2, '2012-09-30 20:02:53', '2012-09-30 20:02:53', 'active'),
(15, 'TeleVision', 0, 2, '2012-09-30 20:03:17', '2012-09-30 20:03:17', 'active'),
(38, 'House', 0, 3, '2012-12-07 11:09:11', '2012-12-07 11:09:11', 'active'),
(37, 'Bunglows', 0, 3, '2012-12-07 11:08:44', '2012-12-07 11:08:44', 'active'),
(17, 'a-one-subcate', 0, 12, '2012-10-03 08:26:38', '2012-10-03 08:26:38', 'active'),
(18, 'Flats', 0, 3, '2012-12-07 11:08:30', '2012-12-07 11:08:30', 'active'),
(19, 'Row Houses', 0, 3, '2012-12-07 11:08:38', '2012-12-07 11:08:38', 'active'),
(20, 'a-sub-cate', 0, 13, '2012-10-20 19:07:26', '2012-10-20 19:07:26', 'active'),
(22, 'Primary school', 0, 6, '2012-10-27 11:21:45', '2012-10-27 11:21:45', 'active'),
(23, 'Higher Secondary', 0, 6, '2012-10-27 11:21:33', '2012-10-27 11:21:33', 'active'),
(39, 'PG', 0, 3, '2012-12-07 11:09:24', '2012-12-07 11:09:24', 'active'),
(27, 'a1-new--edit-subcat', 0, 19, '2012-10-27 15:30:05', '2012-10-27 15:30:05', 'active'),
(28, 'a1-subcat2', 0, 19, '2012-10-27 15:30:24', '2012-10-27 15:30:24', 'active'),
(29, 'a1-subcat3', 0, 19, '2012-10-27 15:30:34', '2012-10-27 15:30:34', 'active'),
(30, 'a1-subcat4', 0, 19, '2012-10-27 15:30:41', '2012-10-27 15:30:41', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cb_sub_category_type`
--

CREATE TABLE `cb_sub_category_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) collate latin1_general_ci NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `priority_number` int(11) NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `status` enum('active','inactive') collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `cb_sub_category_type`
--

INSERT INTO `cb_sub_category_type` (`id`, `name`, `sub_category_id`, `priority_number`, `created_date`, `updated_date`, `status`) VALUES
(5, 'Bike', 10, 0, '2012-10-20 15:56:28', '2012-10-20 15:56:28', 'active'),
(25, '2 BHK', 18, 0, '2012-12-07 11:14:44', '2012-12-07 11:14:44', 'active'),
(6, 'Scooter', 10, 0, '2012-10-20 15:56:37', '2012-10-20 15:56:37', 'active'),
(7, 'Bicycle', 10, 0, '2012-10-27 21:11:56', '2012-10-27 21:11:56', 'active'),
(8, 'Flat', 19, 0, '2012-10-20 19:05:59', '2012-10-20 19:05:59', 'active'),
(9, 'House', 19, 0, '2012-10-20 19:06:07', '2012-10-20 19:06:07', 'active'),
(10, 'type', 20, 0, '2012-10-20 19:08:17', '2012-10-20 19:08:17', 'active'),
(24, '1 BHK', 18, 0, '2012-12-07 11:14:30', '2012-12-07 11:14:30', 'active'),
(12, 'bike', 1, 0, '2012-10-20 22:22:32', '2012-10-20 22:22:32', 'active'),
(13, 'scooter', 1, 0, '2012-10-20 22:22:40', '2012-10-20 22:22:40', 'active'),
(14, 'cycle', 1, 0, '2012-10-20 22:22:47', '2012-10-20 22:22:47', 'active'),
(17, 'new itme', 26, 0, '2012-10-27 13:10:19', '2012-10-27 13:10:19', 'active'),
(18, 'erere-edit', 26, 0, '2012-10-27 13:10:38', '2012-10-27 13:10:38', 'active'),
(19, 'a-new', 26, 0, '2012-10-27 13:10:50', '2012-10-27 13:10:50', 'active'),
(20, 'a1-type1-edit', 27, 0, '2012-10-27 15:31:17', '2012-10-27 15:31:17', 'active'),
(21, 'a1-type2', 27, 0, '2012-10-27 15:31:27', '2012-10-27 15:31:27', 'active'),
(22, 'a1-type3', 27, 0, '2012-10-27 15:31:37', '2012-10-27 15:31:37', 'active'),
(23, 'a1-type-4', 27, 0, '2012-10-27 15:31:45', '2012-10-27 15:31:45', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cb_user`
--

CREATE TABLE `cb_user` (
  `id` int(11) NOT NULL auto_increment,
  `user_type` enum('superadmin','admin','user') collate latin1_general_ci NOT NULL default 'user',
  `email` varchar(100) collate latin1_general_ci NOT NULL,
  `password` varchar(250) collate latin1_general_ci NOT NULL,
  `facebook_id` varchar(50) collate latin1_general_ci NOT NULL,
  `first_name` varchar(50) collate latin1_general_ci NOT NULL,
  `last_name` varchar(50) collate latin1_general_ci NOT NULL,
  `display_name` varchar(30) collate latin1_general_ci NOT NULL,
  `gender` enum('male','female') collate latin1_general_ci NOT NULL,
  `birth_date` date NOT NULL,
  `profile_image_filename` varchar(50) collate latin1_general_ci NOT NULL,
  `address` varchar(200) collate latin1_general_ci default NULL,
  `landmark` varchar(100) collate latin1_general_ci default NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) default NULL,
  `area_id` int(11) default NULL,
  `pincode` int(6) default NULL,
  `phone` varchar(50) collate latin1_general_ci default NULL,
  `created_date` timestamp NULL default CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `last_login_date` date NOT NULL,
  `status` enum('active','inactive','disabled','abused') collate latin1_general_ci NOT NULL default 'active',
  `log_details` text collate latin1_general_ci,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email_2` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `cb_user`
--

INSERT INTO `cb_user` (`id`, `user_type`, `email`, `password`, `facebook_id`, `first_name`, `last_name`, `display_name`, `gender`, `birth_date`, `profile_image_filename`, `address`, `landmark`, `country_id`, `state_id`, `city_id`, `area_id`, `pincode`, `phone`, `created_date`, `updated_date`, `last_login_date`, `status`, `log_details`) VALUES
(6, 'superadmin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 'Admin', 'Admin', 'Adminstrator', 'male', '0000-00-00', '0', 'La-campala colony', 'near red rosary school', 1, 1, 1, 1, 403001, '9822984664', '2012-10-27 21:10:49', '0000-00-00 00:00:00', '0000-00-00', 'active', NULL),
(13, 'user', 'san@deep.com', 'san', '', 'Sandeep', 'Raul', 'Sandeep', 'male', '0000-00-00', '0', 'SK Residency', 'Near Temple', 1, 1, 38, 15, 400105, '90909090', '2012-10-27 21:10:03', '0000-00-00 00:00:00', '0000-00-00', 'active', NULL);
