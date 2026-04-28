-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2026 at 11:06 AM
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
(1, 7, 'interested', 4);

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
(15, 'Cat', 'Maine Coon', 'okok', 'Female', 'Adult', 'Medium', 'Brown', 'Mannar', 'kokokoko', 'Upload/pets/15.petfood5.jpeg', 'rejected', '2026-04-11 08:28:44', 4, '0000-00-00', 0),
(16, 'Dog', 'German Shepherd', 'kkok', 'Female', 'Young', 'Medium', 'Brown', 'Mannar', 'pp', 'Upload/pets/16.petfood1.jpeg', 'rejected', '2026-04-11 08:28:29', 4, '0000-00-00', 0),
(17, 'Dog', 'German Shepherd', 'kkok', 'Female', 'Young', 'Medium', 'Golden', '', 'pp', 'Upload/pets/17.petfood1.jpeg', 'rejected', '2026-04-11 08:28:38', 4, '0000-00-00', 0),
(18, 'Dog', 'Golden Retriever', 'logan', 'Female', 'Young', 'Medium', 'Golden', 'Vavuniya', 'kokok', 'Upload/pets/18.petfood5.jpeg', 'rejected', '2026-04-11 08:28:50', 4, '0000-00-00', 0),
(19, 'Bird', 'Lovebird', 'love', 'Female', 'Baby', 'Small', 'White', 'Puttalam', 'Small bird', 'Upload/pets/19.OIP.jpeg', 'approved', '2026-04-15 10:53:06', 5, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_tbl`
--

CREATE TABLE `post_tbl` (
  `post_id` int(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(400) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `location` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL,
  `post_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(14, 'isusam@gmail.com', 'rr', '1111111111', 'Vet', '2026-03-11 17:27:02', 0);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `post_tbl`
--
ALTER TABLE `post_tbl`
  ADD PRIMARY KEY (`post_id`);

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
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `interest_tbl`
--
ALTER TABLE `interest_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_tbl`
--
ALTER TABLE `login_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

--
-- AUTO_INCREMENT for table `pet_tbl`
--
ALTER TABLE `pet_tbl`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `post_tbl`
--
ALTER TABLE `post_tbl`
  MODIFY `post_id` int(20) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
