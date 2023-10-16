-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2023 at 11:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_film`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adminregistration`
--

CREATE TABLE `tbl_adminregistration` (
  `adminregistration_id` int(11) NOT NULL,
  `adminregistration_name` varchar(50) NOT NULL,
  `adminregistration_email` varchar(50) NOT NULL,
  `adminregistration_contact` varchar(50) NOT NULL,
  `adminregistration_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_adminregistration`
--

INSERT INTO `tbl_adminregistration` (`adminregistration_id`, `adminregistration_name`, `adminregistration_email`, `adminregistration_contact`, `adminregistration_password`) VALUES
(1, 'Administrator', 'admin@gmail.com', '8289667451', 'admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_title` varchar(50) NOT NULL,
  `complaint_content` varchar(50) NOT NULL,
  `complaint_status` int(11) NOT NULL DEFAULT 0,
  `complaint_reply` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(50) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_content` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hiringteam`
--

CREATE TABLE `tbl_hiringteam` (
  `hiring_id` int(11) NOT NULL,
  `hiring_name` varchar(50) NOT NULL,
  `hiring_contact` varchar(50) NOT NULL,
  `hiring_email` varchar(50) NOT NULL,
  `place_id` int(50) NOT NULL,
  `hiring_type` varchar(50) NOT NULL,
  `hiring_photo` varchar(500) NOT NULL,
  `hiring_proof` varchar(500) NOT NULL,
  `hiring_address` varchar(50) NOT NULL,
  `hiring_password` varchar(50) NOT NULL,
  `hiring_vstatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locationbooking`
--

CREATE TABLE `tbl_locationbooking` (
  `booking_id` int(11) NOT NULL,
  `hiring_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `booking_adv_amt` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `booking_startdate` varchar(30) NOT NULL,
  `booking_enddate` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locationdetails`
--

CREATE TABLE `tbl_locationdetails` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(50) NOT NULL,
  `location_address` varchar(50) NOT NULL,
  `place_id` int(11) NOT NULL,
  `location_image` varchar(500) NOT NULL,
  `lender_id` int(11) NOT NULL,
  `location_details` varchar(50) NOT NULL,
  `location_rent` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locationlender`
--

CREATE TABLE `tbl_locationlender` (
  `lender_id` int(11) NOT NULL,
  `lender_name` varchar(50) NOT NULL,
  `lender_contact` varchar(50) NOT NULL,
  `lender_address` varchar(50) NOT NULL,
  `lender_email` varchar(50) NOT NULL,
  `place_id` int(50) NOT NULL,
  `lender_photo` varchar(500) NOT NULL,
  `lender_proof` varchar(500) NOT NULL,
  `lender_password` varchar(50) NOT NULL,
  `lender_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(50) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_previouswork`
--

CREATE TABLE `tbl_previouswork` (
  `work_id` int(11) NOT NULL,
  `work_details` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `work_image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projectapplication`
--

CREATE TABLE `tbl_projectapplication` (
  `application_id` int(11) NOT NULL,
  `application_details` varchar(50) NOT NULL,
  `application_file` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `application_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projectdetails`
--

CREATE TABLE `tbl_projectdetails` (
  `project_id` int(11) NOT NULL,
  `project_title` varchar(50) NOT NULL,
  `project_details` varchar(50) NOT NULL,
  `project_image` varchar(500) NOT NULL,
  `hiring_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userregistration`
--

CREATE TABLE `tbl_userregistration` (
  `user_id` int(11) NOT NULL,
  `userreg_name` varchar(50) NOT NULL,
  `userreg_contact` varchar(50) NOT NULL,
  `userreg_email` varchar(50) NOT NULL,
  `userreg_address` varchar(50) NOT NULL,
  `place_id` int(11) NOT NULL,
  `userreg_photo` varchar(500) NOT NULL,
  `userreg_proof` varchar(500) NOT NULL,
  `usertype_id` int(50) NOT NULL,
  `userreg_password` varchar(50) NOT NULL,
  `userreg_gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usertype`
--

CREATE TABLE `tbl_usertype` (
  `usertype_id` int(11) NOT NULL,
  `usertype_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_adminregistration`
--
ALTER TABLE `tbl_adminregistration`
  ADD PRIMARY KEY (`adminregistration_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_hiringteam`
--
ALTER TABLE `tbl_hiringteam`
  ADD PRIMARY KEY (`hiring_id`);

--
-- Indexes for table `tbl_locationbooking`
--
ALTER TABLE `tbl_locationbooking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_locationdetails`
--
ALTER TABLE `tbl_locationdetails`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `tbl_locationlender`
--
ALTER TABLE `tbl_locationlender`
  ADD PRIMARY KEY (`lender_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_previouswork`
--
ALTER TABLE `tbl_previouswork`
  ADD PRIMARY KEY (`work_id`);

--
-- Indexes for table `tbl_projectapplication`
--
ALTER TABLE `tbl_projectapplication`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `tbl_projectdetails`
--
ALTER TABLE `tbl_projectdetails`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_userregistration`
--
ALTER TABLE `tbl_userregistration`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_usertype`
--
ALTER TABLE `tbl_usertype`
  ADD PRIMARY KEY (`usertype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_adminregistration`
--
ALTER TABLE `tbl_adminregistration`
  MODIFY `adminregistration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_hiringteam`
--
ALTER TABLE `tbl_hiringteam`
  MODIFY `hiring_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_locationbooking`
--
ALTER TABLE `tbl_locationbooking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_locationdetails`
--
ALTER TABLE `tbl_locationdetails`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_locationlender`
--
ALTER TABLE `tbl_locationlender`
  MODIFY `lender_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_previouswork`
--
ALTER TABLE `tbl_previouswork`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_projectapplication`
--
ALTER TABLE `tbl_projectapplication`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_projectdetails`
--
ALTER TABLE `tbl_projectdetails`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_userregistration`
--
ALTER TABLE `tbl_userregistration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_usertype`
--
ALTER TABLE `tbl_usertype`
  MODIFY `usertype_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
