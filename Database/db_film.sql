-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 02:50 PM
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
(2, 'Harry', 'harry@gmail.com', '543443543', 'harry@1122'),
(3, 'Yaseen', 'ya@seen.com', '9562442920', 'qwerty'),
(4, 'Thrishal', 'thrish@al.com', '12345678899', 'qwerty');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat`
--

CREATE TABLE `tbl_chat` (
  `chat_id` int(11) NOT NULL,
  `chat_content` varchar(100) NOT NULL,
  `user_from_id` int(11) NOT NULL DEFAULT 0,
  `user_to_id` int(11) NOT NULL DEFAULT 0,
  `team_from_id` int(11) NOT NULL DEFAULT 0,
  `team_to_id` int(11) NOT NULL DEFAULT 0,
  `chat_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_title` varchar(50) NOT NULL,
  `complaint_content` varchar(150) NOT NULL,
  `complaint_status` int(11) NOT NULL DEFAULT 0,
  `complaint_reply` varchar(50) NOT NULL,
  `hiring_id` int(11) NOT NULL DEFAULT 0,
  `lender_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `complaint_from` varchar(50) NOT NULL
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

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`, `state_id`) VALUES
(1, 'Ernakulam', 1),
(2, 'Alappuzha', 1),
(3, 'Idukki', 1),
(4, 'Chennai', 2),
(5, 'Coimbatore', 2),
(12, 'Thiruvananthapuram', 1),
(13, 'Kannur', 1),
(14, 'Wayanad', 1),
(15, 'Kasargod', 1),
(16, 'Malappuram', 1),
(17, 'Kottayam', 1),
(18, 'Kollam', 1),
(22, 'Madurai', 2),
(23, 'Salem', 2),
(24, 'Guntur', 8),
(25, 'Nellore', 8),
(26, 'Visakhapatanam', 8),
(27, 'North Goa', 11),
(28, 'South Goa', 11),
(29, 'Bengaluru', 16),
(30, 'Udupi', 16),
(31, 'Kodagu', 16),
(32, 'Nizamabad', 24),
(33, 'Warangal', 24),
(34, 'Medak', 24);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_content` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hiring_id` int(11) NOT NULL,
  `lender_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `feedback_content`, `user_id`, `hiring_id`, `lender_id`) VALUES
(9, 'Although, i did not a job through this site, i had a very good experience', 45, 0, 0);

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

--
-- Dumping data for table `tbl_hiringteam`
--

INSERT INTO `tbl_hiringteam` (`hiring_id`, `hiring_name`, `hiring_contact`, `hiring_email`, `place_id`, `hiring_type`, `hiring_photo`, `hiring_proof`, `hiring_address`, `hiring_password`, `hiring_vstatus`) VALUES
(15, 'Aravind', '9678901234', 'ara@vind.com', 16, 'Producer', 'ara.jpg', 'proof.png', 'qwerty', 'qwerty', 1),
(16, 'Ashfaque', '9789012345', 'as@faque.com', 6, 'Director', 'ash.jpeg', 'proof.png', 'Ahsfaque Villa', 'qwerty', 1),
(17, 'Betsy', '9890123456', 'be@tsy.com', 12, 'Producer', 'be.jpg', 'proof.png', 'Betsy Villa', 'qwerty', 2),
(18, 'Hafiz', '9901234567', 'ha@fiz.com', 7, 'others', 'ha.avif', 'proof.png', 'Hafiz Villa', 'qwerty', 2),
(19, 'Muhammed Yaseen', '9633702159', 'nosawkid@gmail.com', 18, 'Director', 'yas.jpg', 'proof.png', 'Yaseen Villa', 'qwerty', 1);

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
  `booking_enddate` varchar(30) NOT NULL,
  `booking_balanceamt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_locationbooking`
--

INSERT INTO `tbl_locationbooking` (`booking_id`, `hiring_id`, `location_id`, `booking_status`, `booking_adv_amt`, `payment_status`, `booking_startdate`, `booking_enddate`, `booking_balanceamt`) VALUES
(45, 15, 26, 3, 18750, 1, '2023-10-19', '2023-10-24', '43750');

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
  `location_details` varchar(100) NOT NULL,
  `location_rent` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_locationdetails`
--

INSERT INTO `tbl_locationdetails` (`location_id`, `location_name`, `location_address`, `place_id`, `location_image`, `lender_id`, `location_details`, `location_rent`) VALUES
(26, 'Indira Gandhi College', 'Nellikkuzhi, Kothamangalam', 1, 'igca.webp', 14, 'One of the best campus in Nellikkuzhi Jn', '12500');

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

--
-- Dumping data for table `tbl_locationlender`
--

INSERT INTO `tbl_locationlender` (`lender_id`, `lender_name`, `lender_contact`, `lender_address`, `lender_email`, `place_id`, `lender_photo`, `lender_proof`, `lender_password`, `lender_status`) VALUES
(11, 'Nandana', '9112345678', 'Nandana Villa', 'nan@dana.com', 14, 'nan.jpeg', 'proof.png', 'qwerty', 2),
(12, 'Nazna', '9123456789', 'Bla Bla', 'na@zna.com', 7, 'na.jpg', 'proof.png', 'qwerty', 2),
(13, 'Nimisha', '9134567890', 'Bla ', 'ni@misha.com', 7, 'ni.jpg', 'proof.png', 'qwerty', 1),
(14, 'Shalu', '9142345678', 'Bla Bla', 'sha@lu.com', 6, 'sja.jpg', 'proof.png', 'qwerty', 1),
(15, 'Shiva Prasad', '9156789012345', 'Karunakaran VIlla', 'shi@va.com', 13, 'shi.jpeg', 'proof.png', 'qwerty', 1),
(16, 'Haleema Binu', '7510871648', 'Parayil Cottage', 'hal@eema.com', 18, 'female63.webp', 'proof.png', 'Haleema@123', 1),
(18, 'Dan Shiju', '9111111111', 'Kaloor,Kochi', 'dan@gmail.com', 1, 'dan.avif', 'proof.png', 'Qwerty@123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(50) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`) VALUES
(1, 'Kaloor', 1),
(6, 'Mavelikkara', 2),
(7, 'Moonnar', 3),
(10, 'Attingal', 12),
(11, 'Thalassery', 13),
(12, 'Mananthavadi', 14),
(13, 'Neeleshwaram', 15),
(14, 'Nilambur', 16),
(15, 'Changanaserry', 17),
(16, 'Kottarakkara', 18),
(17, 'Thevara', 1),
(18, 'Chunakkara', 2),
(19, 'Nedumbassery', 1),
(20, 'Anna Nagar', 4),
(21, 'Adyar', 4),
(22, 'T.Nagar', 4),
(23, 'Medur', 5),
(24, 'Kalapatti', 5),
(25, 'Melur', 22),
(26, 'Belur', 23),
(27, 'Amaravathi', 24),
(28, 'Kavali', 25),
(29, 'Vishakhapatanam', 26),
(30, 'Panaji', 27),
(31, 'Colva', 28),
(32, 'Electronic city', 29),
(33, 'Madikeri', 31),
(34, 'Pajaka', 30),
(35, 'Pangra', 32),
(36, 'Orugallu', 33),
(37, 'Medak', 34);

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

--
-- Dumping data for table `tbl_previouswork`
--

INSERT INTO `tbl_previouswork` (`work_id`, `work_details`, `user_id`, `work_image`) VALUES
(19, 'The Dreamscape Detective', 45, 'aw1.webp'),
(21, 'The Time traveler Paradox', 45, 'aw2.webp'),
(22, 'Last Man on Mars', 45, 'aw3.webp'),
(23, 'The Ember', 45, 'aw4.jpg'),
(24, 'The Flux', 45, 'aw5.jpg'),
(25, 'The Flying Spaghetti Monster', 46, 'ad1.jpg'),
(26, 'Zombie Apocalypse', 46, 'ad2.webp'),
(27, 'Robot Love Triangle', 46, 'ad3.webp'),
(28, 'The Dinosaur Who Couldnt Roar', 47, 'ak1.webp'),
(29, 'Pirate Water', 47, 'ak4.png'),
(30, 'Broken Time Machine', 47, 'ak5.jpg'),
(31, 'Monkey D Luffy', 48, 'al1.webp'),
(32, 'Blue Lotus', 48, 'al2.webp'),
(33, 'Vengeance', 48, 'al3.webp'),
(35, 'Looking for work for the first time', 49, '');

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

--
-- Dumping data for table `tbl_projectapplication`
--

INSERT INTO `tbl_projectapplication` (`application_id`, `application_details`, `application_file`, `user_id`, `project_id`, `application_status`) VALUES
(16, 'I have worked as an actor in several projects.', 'ad1.jpg', 45, 20, 2);

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

--
-- Dumping data for table `tbl_projectdetails`
--

INSERT INTO `tbl_projectdetails` (`project_id`, `project_title`, `project_details`, `project_image`, `hiring_id`) VALUES
(20, 'War and Love', 'Require young talents of age 10 - 15', 'arw1.jpeg', 15),
(25, 'Road To Lakshadweep', 'We need Editors. Lack of experience is acceptable', '', 16),
(26, 'Fly Down the Wall', 'We need someone who can manage the sets', '', 19);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`state_id`, `state_name`) VALUES
(1, 'Kerala'),
(2, 'Tamil Nadu'),
(8, 'Andhra Pradhesh'),
(11, 'Goa'),
(16, 'Karnataka'),
(24, 'Telangana');

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

--
-- Dumping data for table `tbl_userregistration`
--

INSERT INTO `tbl_userregistration` (`user_id`, `userreg_name`, `userreg_contact`, `userreg_email`, `userreg_address`, `place_id`, `userreg_photo`, `userreg_proof`, `usertype_id`, `userreg_password`, `userreg_gender`) VALUES
(45, 'Adish', '9123456789', 'ad@ish.com', 'Adish Villa TVM', 10, 'Adish.jpg', 'proof.png', 9, 'qwerty', 'male'),
(46, 'Adwaith', '9234567890', 'ad@waith.com', 'Adwaith VIlla', 1, 'adw.jpeg', 'proof.png', 11, 'qwerty', 'male'),
(47, 'Akhila', '9345678901', 'ak@hila.com', 'Akhila VIlla', 6, 'akhila.jpeg', 'proof.png', 8, 'qwerty', 'female'),
(48, 'Alphin', '9456789012', 'al@phin.com', 'Alphin Villa', 15, 'al.avif', 'proof.png', 8, 'qwerty', 'male'),
(49, 'Amal Raj', '9567812345', 'amal@gmail.com', 'Amal Villa', 12, 'am.jpeg', 'proof.png', 6, 'qwerty', 'male'),
(51, 'Raju Bhai', '9224466881', 'raj@ju.com', 'Andheri', 30, 'ak5.jpg', 'ak4.png', 8, 'Qwerty@123', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usertype`
--

CREATE TABLE `tbl_usertype` (
  `usertype_id` int(11) NOT NULL,
  `usertype_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_usertype`
--

INSERT INTO `tbl_usertype` (`usertype_id`, `usertype_name`) VALUES
(6, 'Editor'),
(8, 'Production Manager'),
(9, 'Actor'),
(10, 'Screenwriter'),
(11, 'Production Designer'),
(12, 'Costume Designer'),
(13, 'Sound Designer'),
(14, 'Makeup Artist'),
(15, 'Art Director'),
(16, 'Stunt Coordinator'),
(17, 'Assistant Director');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_adminregistration`
--
ALTER TABLE `tbl_adminregistration`
  ADD PRIMARY KEY (`adminregistration_id`);

--
-- Indexes for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  ADD PRIMARY KEY (`chat_id`);

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
  MODIFY `adminregistration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_hiringteam`
--
ALTER TABLE `tbl_hiringteam`
  MODIFY `hiring_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_locationbooking`
--
ALTER TABLE `tbl_locationbooking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_locationdetails`
--
ALTER TABLE `tbl_locationdetails`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_locationlender`
--
ALTER TABLE `tbl_locationlender`
  MODIFY `lender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_previouswork`
--
ALTER TABLE `tbl_previouswork`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_projectapplication`
--
ALTER TABLE `tbl_projectapplication`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_projectdetails`
--
ALTER TABLE `tbl_projectdetails`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_userregistration`
--
ALTER TABLE `tbl_userregistration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_usertype`
--
ALTER TABLE `tbl_usertype`
  MODIFY `usertype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
