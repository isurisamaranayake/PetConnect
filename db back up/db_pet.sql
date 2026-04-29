-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2026 at 06:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pet`
--

-- --------------------------------------------------------

--
-- Table structure for table `consultation_tbl`
--

CREATE TABLE `consultation_tbl` (
  `id` int(11) NOT NULL,
  `c_pet_id` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `document` varchar(300) NOT NULL,
  `status` varchar(15) NOT NULL,
  `answer` varchar(600) NOT NULL,
  `answerBy` int(11) NOT NULL,
  `cBy` int(11) DEFAULT NULL,
  `priority` varchar(20) DEFAULT NULL,
  `c_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultation_tbl`
--

INSERT INTO `consultation_tbl` (`id`, `c_pet_id`, `description`, `document`, `status`, `answer`, `answerBy`, `cBy`, `priority`, `c_date`) VALUES
(1, 21, 'Parrot does not eat', '', 'answered', 'dijjcd', 2, 4, 'high', '2026-04-27 09:34:54'),
(2, 21, 'Pet choked on a toy', 'Upload/question_documents/2.petevet2.jpeg', 'answered', 'give fluids', 2, 4, 'urgent', '2026-04-27 09:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `events_tbl`
--

CREATE TABLE `events_tbl` (
  `event_id` int(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `location` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL,
  `event_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events_tbl`
--

INSERT INTO `events_tbl` (`event_id`, `title`, `description`, `event_date`, `event_time`, `location`, `image`, `event_status`) VALUES
(1, 'Pets Day Out', 'Fun day for pets', '2026-04-30', '23:20:00', 'Bokundara', 'Upload/events/1.peteventposter1.jpeg', ''),
(2, 'Pets Day Out', 'Fun day for pets', '2026-04-30', '23:20:00', 'Bokundara', 'Upload/events/2.peteventposter1.jpeg', ''),
(3, 'Pets Day Out', 'Fun day for pets', '2026-04-30', '23:20:00', 'Bokundara', 'Upload/events/3.peteventposter1.jpeg', 'ongoing'),
(4, 'Hello pets', 'Bring all pets for games', '2026-04-30', '14:20:00', 'Piliyandala', 'Upload/events/4.petevet2.jpeg', 'ongoing'),
(5, 'Pet Show', 'Bring all your pets for a show', '2026-04-30', '12:00:00', 'Ninewells', 'Upload/events/5.pet event 3.jpeg', 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `interest_tbl`
--

CREATE TABLE `interest_tbl` (
  `id` int(11) NOT NULL,
  `i_pet_id` int(11) NOT NULL,
  `i_status` varchar(15) NOT NULL,
  `cBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interest_tbl`
--

INSERT INTO `interest_tbl` (`id`, `i_pet_id`, `i_status`, `cBy`) VALUES
(1, 7, 'interested', 4),
(7, 20, 'interested', 16);

-- --------------------------------------------------------

--
-- Table structure for table `login_tbl`
--

CREATE TABLE `login_tbl` (
  `id` int(11) NOT NULL,
  `login_email` varchar(150) NOT NULL,
  `login_password` varchar(150) NOT NULL,
  `login_type` varchar(8) NOT NULL,
  `login_status` varchar(10) NOT NULL,
  `d_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_tbl`
--

INSERT INTO `login_tbl` (`id`, `login_email`, `login_password`, `login_type`, `login_status`, `d_status`) VALUES
(1, 'Isuri1@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Vet', 'Active', 0),
(2, 'Isuri2@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', 'Vet', 'Active', 0),
(3, 'Isuri3@gmail.com', '202cb962ac59075b964b07152d234b70', 'Adopter', 'Deactive', 0),
(4, 'Isuri4@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Adopter', 'Active', 0),
(5, 'Isuri6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Active', 0),
(6, 'Isuri7@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Adopter', 'Active', 0),
(7, 'Isuri8@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Adopter', 'Active', 0),
(8, 'Isuri9@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Vet', 'Active', 0),
(9, 'Isuri10@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Vet', 'Active', 0),
(10, 'Isuri11@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Vet', 'Active', 0),
(11, 'Isuri55@gmail.com', '6512bd43d9caa6e02c990b0a82652dca', 'Vet', 'Active', 0),
(12, 'Isuri57@gmail.com', '72b32a1f754ba1c09b3695e0cb6cde7f', 'Adopter', 'Active', 0),
(13, 'Ann@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Vet', 'Active', 0),
(14, 'isusam@gmail.com', '6512bd43d9caa6e02c990b0a82652dca', 'Vet', 'Active', 0),
(15, 'ben@gmail.com', '7fe4771c008a22eb763df47d19e2c6aa', 'Adopter', 'Active', 0),
(16, 'cassy@gmail.com', '3c90ff35a887584a05041fee797dc741', 'Adopter', 'Active', 0),
(17, 'david@gmail.com', '172522ec1028ab781d9dfd17eaca4427', 'Adopter', 'Active', 0),
(18, 'evan@gmail.com', '98cc7d37dc7b90c14a59ef0c5caa8995', 'Adopter', 'Active', 0),
(500, 'isuri100@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Staff', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pet_tbl`
--

CREATE TABLE `pet_tbl` (
  `pet_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `breed` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `pet_age` varchar(20) NOT NULL,
  `pet_size` varchar(20) NOT NULL,
  `pet_color` varchar(20) NOT NULL,
  `pet_location` varchar(20) NOT NULL,
  `otherdetails` varchar(300) NOT NULL,
  `image` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL,
  `cDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cBy` int(8) NOT NULL,
  `adoptedDate` date NOT NULL,
  `d_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_tbl`
--

INSERT INTO `pet_tbl` (`pet_id`, `type`, `breed`, `name`, `gender`, `pet_age`, `pet_size`, `pet_color`, `pet_location`, `otherdetails`, `image`, `status`, `cDate`, `cBy`, `adoptedDate`, `d_status`) VALUES
(1, 'Dog', 'Labrador', 'logan', 'Male', 'Young', 'Medium', 'Brown', 'Mullaitivu', 'kokokokk', 'Upload/pets/1.download (1).jpeg', 'approved', '2026-04-15 10:51:37', 5, '0000-00-00', 0),
(2, 'Dog', 'Labrador', 'logan', 'Male', 'Young', 'Large', 'Brown', '', 'Friendly', 'uploadpets/2.', 'approved', '2026-04-11 08:27:50', 5, '0000-00-00', 1),
(3, 'Dog', 'Labrador', 'logan', 'Male', 'Young', 'Large', 'Brown', 'Mannar', 'Friendly', 'Uploadpets/3.', 'rejected', '2026-04-11 08:27:58', 5, '0000-00-00', 1),
(4, 'Dog', 'Labrador', 'logan', 'Male', 'Young', 'Large', 'Brown', '', 'Friendly', 'Uploadpets/4.', 'approved', '2026-04-11 08:28:06', 5, '0000-00-00', 1),
(5, 'Dog', 'Labrador', 'logan', 'Male', 'Young', 'Large', 'Brown', 'Vavuniya', 'Friendly', 'Upload/pets/5.parrot (3).jpeg', 'approved', '2026-04-15 10:51:31', 5, '0000-00-00', 0),
(6, 'Dog', 'Labrador', 'logan', 'Male', 'Young', 'Large', 'Brown', '', 'Friendly', 'Upload/pets/6.download.jpeg', 'rejected', '2026-04-04 06:08:12', 5, '0000-00-00', 0),
(7, 'Dog', 'Labrador', 'Lily', 'Female', 'Young', 'Large', 'Mixed', '', 'ffddfdfdf', 'Upload/pets/7.download.jpeg', 'approved', '2026-04-06 18:40:49', 5, '0000-00-00', 0),
(8, 'Rabbit', 'Netherland Dwarf', 'bunny', 'Female', 'Baby', 'Small', 'White', 'Colombo', 'Friendly', 'Upload/pets/8.download (1).jpeg', 'approved', '2026-04-11 11:09:30', 5, '0000-00-00', 0),
(9, 'Cat', 'Street / stray cat', 'Kitty', 'Male', 'Baby', 'Small', 'Golden', '', 'Friendly', 'Upload/pets/9.download (2).jpeg', 'approved', '2026-04-06 18:40:54', 5, '0000-00-00', 0),
(10, 'Rabbit', 'Lionhead', 'Bunny', 'Female', 'Young', 'Small', 'White', 'Colombo', 'Cute', 'Upload/pets/10.download (1).jpeg', 'approved', '2026-04-11 11:10:05', 8, '0000-00-00', 0),
(11, 'Bird', 'Parrot', 'Birdy', 'Female', 'Young', 'Small', 'Mixed', '', 'Healthy', 'Upload/pets/11.parrot (3).jpeg', 'approved', '2026-04-08 19:06:35', 4, '0000-00-00', 1),
(12, 'Bird', 'Parrot', 'Parrot', 'Female', 'Baby', 'Small', 'Mixed', '', 'Friendly', 'Upload/pets/12.parrot (3).jpeg', 'approved', '2026-04-20 12:35:11', 5, '0000-00-00', 1),
(13, 'Dog', 'Labrador', 'Luna', 'Male', 'Young', 'Small', 'Black', '', 'kokoko', 'Upload/pets/13.download (2).jpeg', 'pending', '2026-04-08 19:10:49', 4, '0000-00-00', 1),
(14, 'Bird', 'Parrot', 'fefe', 'Female', 'Baby', 'Small', 'White', 'Trincomalee', 'csds', 'Upload/pets/14.download (1).jpeg', 'approved', '2026-04-20 12:36:58', 4, '0000-00-00', 1),
(15, 'Cat', 'Maine Coon', 'okok', 'Female', 'Adult', 'Medium', 'Brown', 'Mannar', 'kokokoko', 'Upload/pets/15.petfood5.jpeg', 'rejected', '2026-04-26 02:45:14', 4, '0000-00-00', 1),
(16, 'Dog', 'German Shepherd', 'kkok', 'Female', 'Young', 'Medium', 'Brown', 'Mannar', 'pp', 'Upload/pets/16.petfood1.jpeg', 'rejected', '2026-04-11 08:28:29', 4, '0000-00-00', 0),
(17, 'Dog', 'German Shepherd', 'kkok', 'Female', 'Young', 'Medium', 'Golden', 'Hambantota', 'pp', 'Upload/pets/17.lab.jpeg', 'updated', '2026-04-26 02:45:45', 4, '0000-00-00', 0),
(18, 'Dog', 'Golden Retriever', 'logan', 'Female', 'Young', 'Medium', 'Golden', 'Vavuniya', 'kokok', 'Upload/pets/18.petfood5.jpeg', 'rejected', '2026-04-11 08:28:50', 4, '0000-00-00', 0),
(19, 'Bird', 'Lovebird', 'love', 'Female', 'Baby', 'Small', 'White', 'Puttalam', 'Small bird', 'Upload/pets/19.OIP.jpeg', 'approved', '2026-04-15 10:53:06', 5, '0000-00-00', 0),
(20, 'Cat', 'Persian', 'Kai', 'Male', 'Baby', 'Small', 'White', 'Ampara', 'Cute', 'Upload/pets/20.cat3.jpeg', 'approved', '2026-04-23 02:48:26', 15, '0000-00-00', 0),
(21, 'Bird', 'Parrot', 'Tweety', 'Female', 'Young', 'Small', 'Mixed', 'Mullaitivu', 'Pretty', 'Upload/pets/21.bird2.jpeg', 'adopted', '2026-04-26 02:36:41', 4, '0000-00-00', 0),
(22, 'Rabbit', 'Mini Rex', 'Hop', 'Male', 'Young', 'Small', 'White', 'Hambantota', 'Adorable', 'Upload/pets/22.rabbit1.jpeg', 'adoptedapproved', '2026-04-23 18:08:21', 16, '0000-00-00', 0),
(23, 'Dog', 'Labrador', 'Browny', 'Male', 'Young', 'Medium', 'Golden', 'Colombo', 'Healthy', 'Upload/pets/23.Lab2.jpeg', 'adopted', '2026-04-23 18:13:34', 15, '0000-00-00', 0),
(24, 'Dog', 'Doberman', 'Lexi', 'Female', 'Adult', 'Medium', 'Black', 'Colombo', 'Strong,fast ', 'Upload/pets/24.doberman1.jpeg', 'mypet', '2026-04-23 08:36:40', 16, '0000-00-00', 0),
(25, 'Bird', 'Parrot', 'Skie', 'Male', 'Young', 'Small', 'Mixed', 'Galle', 'Many colours', 'Upload/pets/25.parrot.jpeg', 'mypet', '2026-04-23 10:02:37', 16, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pet_tracker_tbl`
--

CREATE TABLE `pet_tracker_tbl` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` varchar(1000) NOT NULL,
  `cDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_tracker_tbl`
--

INSERT INTO `pet_tracker_tbl` (`id`, `pet_id`, `date`, `time`, `description`, `cDate`) VALUES
(2, 21, '2026-04-26', '13:18:00', 'feed pet', '2026-04-26 19:14:42'),
(3, 21, '2026-04-26', '23:18:00', 'give medicine', '2026-04-26 19:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` decimal(50,0) NOT NULL,
  `cost_price` decimal(50,0) NOT NULL,
  `stock_quantity` int(20) NOT NULL,
  `product_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`product_id`, `product_name`, `description`, `price`, `cost_price`, `stock_quantity`, `product_image`) VALUES
(2, 'Pedigree', 'For Adult Dogs', 1000, 500, 20, 'Upload/products/1.petfood1.jpeg'),
(3, 'Classic Pets', 'For adult dogs', 1200, 600, 20, 'Upload/products/3.petfood2.jpeg'),
(4, 'Moochie', 'For Small Pets', 600, 420, 30, 'Upload/products/4.petfood3.jpeg'),
(5, 'Whiskas', 'For all cats', 600, 200, 30, 'Upload/products/5.petfood4.jpeg'),
(6, 'Peckish', 'For parrots', 800, 500, 30, 'Upload/products/6.petfood5.jpeg'),
(7, 'Goldfish Flakes', 'For goldfish', 500, 200, 30, 'Upload/products/7.petfood6.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `staff_tbl`
--

CREATE TABLE `staff_tbl` (
  `id` int(5) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `userid` varchar(6) NOT NULL,
  `role` varchar(6) NOT NULL,
  `cDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `d_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_tbl`
--

INSERT INTO `staff_tbl` (`id`, `full_name`, `email`, `phone`, `userid`, `role`, `cDate`, `d_status`) VALUES
(500, 'isuri', 'isuri100@gmail.com', '1234567893', '1010', 'Staff', '2026-03-31 07:12:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_tbl`
--

CREATE TABLE `transfer_tbl` (
  `id` int(11) NOT NULL,
  `t_pet_id` int(11) NOT NULL,
  `pet_from` int(11) NOT NULL,
  `pet_to` int(11) NOT NULL,
  `transfer_note` varchar(1000) NOT NULL,
  `document` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer_tbl`
--

INSERT INTO `transfer_tbl` (`id`, `t_pet_id`, `pet_from`, `pet_to`, `transfer_note`, `document`) VALUES
(1, 0, 0, 0, '', ''),
(2, 0, 0, 0, '', ''),
(7, 23, 16, 15, 'likes bones', 'Upload/documents/3.Lab2.jpeg'),
(8, 23, 0, 15, 'likes bones', 'Upload/documents/8.Lab2.jpeg'),
(9, 21, 15, 4, 'she likes bird food', 'Upload/documents/9.petevet2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `userName` varchar(200) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `userType` varchar(10) NOT NULL,
  `cDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `d_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `email`, `userName`, `phone`, `userType`, `cDate`, `d_status`) VALUES
(1, 'Isuri1@gmail.com', 'Isuri1', '0111111111', 'Vet', '2026-03-07 04:01:27', 0),
(2, 'Isuri2@gmail.com', 'Isuri2', '0222222222', 'Vet', '2026-02-26 10:17:10', 0),
(3, 'Isuri3@gmail.com', 'Isuri3', '0333333333', 'Adopter', '2026-02-26 10:17:42', 0),
(4, 'Isuri4@gmail.com', 'Isuri4', '0444444444', 'Adopter', '2026-02-27 16:30:15', 0),
(5, 'Isuri6@gmail.com', 'Isuri6', '0666666666', 'Admin', '2026-03-10 03:04:18', 0),
(6, 'Isuri7@gmail.com', 'Isuri7', '0777777777', 'Admin', '2026-03-10 03:03:54', 0),
(7, 'Isuri8@gmail.com', 'Isuri7', '0777777777', 'Adopter', '2026-02-27 16:40:40', 0),
(8, 'Isuri9@gmail.com', 'Isuri9', '0999999999', 'Vet', '2026-02-27 16:46:50', 0),
(9, 'Isuri10@gmail.com', 'Isuri9', '0999999999', 'Vet', '2026-02-27 16:47:15', 0),
(10, 'Isuri11@gmail.com', 'Isuri9', '0999999999', 'Vet', '2026-02-27 16:49:42', 0),
(11, 'Isuri55@gmail.com', 'Isuri55', '1111111111', 'Vet', '2026-02-28 03:22:27', 0),
(12, 'Isuri57@gmail.com', 'Isuri57', '0323333333', 'Adopter', '2026-02-28 04:39:06', 0),
(13, 'Ann@gmail.com', 'Ann', '0111111111', 'Admin', '2026-03-07 04:02:31', 0),
(14, 'isusam@gmail.com', 'rr', '1111111111', 'Vet', '2026-03-11 17:27:02', 0),
(15, 'ben@gmail.com', 'ben', '0777749832', 'Adopter', '2026-04-22 14:54:38', 0),
(16, 'cassy@gmail.com', 'cassy', '0779853154', 'Adopter', '2026-04-22 14:55:25', 0),
(17, 'david@gmail.com', 'david', '0779348521', 'Adopter', '2026-04-22 14:55:54', 0),
(18, 'evan@gmail.com', 'evan', '0776541236', 'Adopter', '2026-04-28 16:27:14', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consultation_tbl`
--
ALTER TABLE `consultation_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_tbl`
--
ALTER TABLE `events_tbl`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `interest_tbl`
--
ALTER TABLE `interest_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_tbl`
--
ALTER TABLE `login_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_tbl`
--
ALTER TABLE `pet_tbl`
  ADD PRIMARY KEY (`pet_id`);

--
-- Indexes for table `pet_tracker_tbl`
--
ALTER TABLE `pet_tracker_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pet_tracker_pet` (`pet_id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_tbl`
--
ALTER TABLE `transfer_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consultation_tbl`
--
ALTER TABLE `consultation_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events_tbl`
--
ALTER TABLE `events_tbl`
  MODIFY `event_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `interest_tbl`
--
ALTER TABLE `interest_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login_tbl`
--
ALTER TABLE `login_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

--
-- AUTO_INCREMENT for table `pet_tbl`
--
ALTER TABLE `pet_tbl`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pet_tracker_tbl`
--
ALTER TABLE `pet_tracker_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

--
-- AUTO_INCREMENT for table `transfer_tbl`
--
ALTER TABLE `transfer_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_tracker_tbl`
--
ALTER TABLE `pet_tracker_tbl`
  ADD CONSTRAINT `fk_pet_tracker_pet` FOREIGN KEY (`pet_id`) REFERENCES `pet_tbl` (`pet_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
