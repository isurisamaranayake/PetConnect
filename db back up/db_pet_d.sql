-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 30, 2026 at 02:45 AM
-- Server version: 9.1.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pet_d`
--

-- --------------------------------------------------------

--
-- Table structure for table `consultation_tbl`
--

DROP TABLE IF EXISTS `consultation_tbl`;
CREATE TABLE IF NOT EXISTS `consultation_tbl` (
  `id` int NOT NULL AUTO_INCREMENT,
  `c_pet_id` int NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `document` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `answer` varchar(600) COLLATE utf8mb4_general_ci NOT NULL,
  `answerBy` int NOT NULL,
  `cBy` int DEFAULT NULL,
  `priority` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultation_tbl`
--

INSERT INTO `consultation_tbl` (`id`, `c_pet_id`, `description`, `document`, `status`, `answer`, `answerBy`, `cBy`, `priority`, `c_date`) VALUES
(3, 34, 'question 1', 'Upload/question_documents/1.Porcupine-fish-Diodon-hystox.webp', 'answered', 'weqwewdsdscsdc cds dsf sdfdsfd fdsfdsfs', 1, 4, 'high', '2026-04-29 19:07:59'),
(4, 34, 'thtrhtrh', '', 'pending', '', 0, 4, 'low', '2026-04-29 20:03:43'),
(5, 34, 'iiii', '', 'answered', 'uiuiuiuiui', 1, 4, 'high', '2026-04-29 20:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `events_tbl`
--

DROP TABLE IF EXISTS `events_tbl`;
CREATE TABLE IF NOT EXISTS `events_tbl` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `location` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `event_status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events_tbl`
--

INSERT INTO `events_tbl` (`event_id`, `title`, `description`, `event_date`, `event_time`, `location`, `image`, `event_status`) VALUES
(2, 'Pets Day Out', 'Fun day for pets', '2026-04-30', '23:20:00', 'Bokundara', 'Upload/events/2.peteventposter1.jpeg', ''),
(3, 'Pets Day Out 1', 'Fun day for pets', '2026-04-14', '23:20:00', 'Bokundara', 'Upload/events/3.2.petevet2.jpeg', 'ongoing'),
(4, 'Hello pets', 'Bring all pets for games', '2026-04-30', '14:20:00', 'Piliyandala', 'Upload/events/4.petevet2.jpeg', 'ongoing'),
(5, 'Pet Show', 'Bring all your pets for a show', '2026-04-30', '12:00:00', 'Ninewells', 'Upload/events/5.pet event 3.jpeg', 'ongoing'),
(6, 'dog run', 'dog run event follow the cats', '2026-05-02', '21:55:00', 'makuluduwa', 'Upload/events/6.images.jfif', 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `interest_tbl`
--

DROP TABLE IF EXISTS `interest_tbl`;
CREATE TABLE IF NOT EXISTS `interest_tbl` (
  `id` int NOT NULL AUTO_INCREMENT,
  `i_pet_id` int NOT NULL,
  `i_status` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `cBy` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

DROP TABLE IF EXISTS `login_tbl`;
CREATE TABLE IF NOT EXISTS `login_tbl` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login_email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `login_password` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `login_type` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `login_status` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `d_status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=501 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_tbl`
--

INSERT INTO `login_tbl` (`id`, `login_email`, `login_password`, `login_type`, `login_status`, `d_status`) VALUES
(1, 'Isuri1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Vet', 'Active', 0),
(2, 'Isuri2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Vet', 'Active', 0),
(3, 'Isuri@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Adopter', 'Active', 0),
(4, 'sanduni@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Adopter', 'Active', 0),
(5, 'sachith@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL,
  `customer_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `district` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_method` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bank_ref` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Cby` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `phone`, `address`, `district`, `payment_method`, `bank_ref`, `total_amount`, `status`, `created_at`, `Cby`) VALUES
(1, 'Sachith Supunthaka Wedasingha', '0710458089', 'Pamunuwaththa, Pahalakadugnnwa', 'Colombo', 'bank', 'Upload/slips/1.ChatGPT Image Apr 27, 2026, 11_47_31 PM.png', 3200.00, 'pending', '2026-04-29 19:36:59', 3),
(2, 'Sachith Supunthaka Wedasingha', '0710458089', 'Pamunuwaththa, Pahalakadugnnwa', 'Colombo', 'cod', '', 1800.00, 'Delivered', '2026-04-29 20:10:36', 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `product_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qty` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `qty`) VALUES
(1, 1, 2, 'Pedigree', 1000.00, 2),
(2, 1, 3, 'Classic Pets', 1200.00, 1),
(3, 2, 4, 'Moochie', 600.00, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pet_tbl`
--

DROP TABLE IF EXISTS `pet_tbl`;
CREATE TABLE IF NOT EXISTS `pet_tbl` (
  `pet_id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `breed` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `pet_age` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `pet_size` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `pet_color` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `pet_location` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `otherdetails` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `cDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cBy` int NOT NULL,
  `adoptedDate` date NOT NULL,
  `d_status` int NOT NULL,
  PRIMARY KEY (`pet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_tbl`
--

INSERT INTO `pet_tbl` (`pet_id`, `type`, `breed`, `name`, `gender`, `pet_age`, `pet_size`, `pet_color`, `pet_location`, `otherdetails`, `image`, `status`, `cDate`, `cBy`, `adoptedDate`, `d_status`) VALUES
(30, 'Dog', 'Labrador', 'logan x', 'Male', 'Young', 'Medium', 'Brown', 'Colombo', 'xxxx xxxxxxxxxxxxxxxx xxxxxxxxx', 'Upload/pets/1.7.download.jpeg', 'adopted', '2026-04-29 13:28:52', 3, '0000-00-00', 0),
(31, 'Bird', 'Parrot', 'kuku', 'Female', 'Young', 'Small', 'Mixed', 'Mannar', 'y yyyyyyyy yyyyyyyyyyyy', 'Upload/pets/31.21.bird2.jpeg', 'pending', '2026-04-29 12:12:08', 5, '0000-00-00', 0),
(32, 'Fish', 'Betta', 'fish', 'Male', 'Young', 'Medium', 'Mixed', 'Ampara', 'zzzzzzzzzzzzzzzz zzzzzzz', 'Upload/pets/32.images (2).webp', 'pending', '2026-04-29 12:13:15', 5, '0000-00-00', 0),
(33, 'Rabbit', 'Mini Rex', 'bob', 'Male', 'Baby', 'Small', 'White', 'Ampara', 'ttttttt tttttttttttttttt ttttttttttttttt', 'Upload/pets/33.18.download (1).jpeg', 'approved', '2026-04-29 12:58:07', 3, '0000-00-00', 0),
(34, 'Dog', 'German Shepherd', 'tomy', 'Male', 'Young', 'Medium', 'Brown', 'Ampara', 'yyyy yyyyyyyyyyyyyy uuuuuuuuuuuu', 'Upload/pets/34.8.Lab2.jpeg', 'adopted', '2026-04-29 13:24:48', 4, '0000-00-00', 0),
(35, 'Cat', 'Siamese', 'kiti', 'Male', 'Young', 'Small', 'Cream', 'Trincomalee', 'yyy', 'Upload/pets/35.20.cat3.jpeg', 'mypet', '2026-04-29 12:57:31', 3, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pet_tracker_tbl`
--

DROP TABLE IF EXISTS `pet_tracker_tbl`;
CREATE TABLE IF NOT EXISTS `pet_tracker_tbl` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pet_id` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `cDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_pet_tracker_pet` (`pet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_tracker_tbl`
--

INSERT INTO `pet_tracker_tbl` (`id`, `pet_id`, `date`, `time`, `description`, `cDate`) VALUES
(4, 34, '2026-04-29', '19:06:00', 'vacsin V2', '2026-04-29 19:07:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

DROP TABLE IF EXISTS `product_tbl`;
CREATE TABLE IF NOT EXISTS `product_tbl` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(50,0) NOT NULL,
  `cost_price` decimal(50,0) NOT NULL,
  `stock_quantity` int NOT NULL,
  `product_image` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `d_status` int NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`product_id`, `product_name`, `description`, `price`, `cost_price`, `stock_quantity`, `product_image`, `d_status`) VALUES
(2, 'Pedigree2', 'For Adult Dogs', 1000, 500, 18, 'Upload/products/1.petfood1.jpeg', 0),
(3, 'Classic Pets', 'For adult dogs', 1200, 600, 19, 'Upload/products/3.petfood2.jpeg', 0),
(4, 'Moochie', 'For Small Pets', 600, 420, 27, 'Upload/products/4.petfood3.jpeg', 0),
(5, 'Whiskas', 'For all cats', 600, 200, 30, 'Upload/products/5.petfood4.jpeg', 0),
(6, 'Peckish', 'For parrots', 800, 500, 30, 'Upload/products/6.petfood5.jpeg', 0),
(7, 'Goldfish Flakes', 'For goldfish', 500, 200, 30, 'Upload/products/7.petfood6.jpeg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_tbl`
--

DROP TABLE IF EXISTS `transfer_tbl`;
CREATE TABLE IF NOT EXISTS `transfer_tbl` (
  `id` int NOT NULL AUTO_INCREMENT,
  `t_pet_id` int NOT NULL,
  `pet_from` int NOT NULL,
  `pet_to` int NOT NULL,
  `transfer_note` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `document` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer_tbl`
--

INSERT INTO `transfer_tbl` (`id`, `t_pet_id`, `pet_from`, `pet_to`, `transfer_note`, `document`) VALUES
(11, 30, 5, 3, 'thrhtrh', 'Upload/documents/11.15.petfood5.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

DROP TABLE IF EXISTS `user_tbl`;
CREATE TABLE IF NOT EXISTS `user_tbl` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `userName` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `userType` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `cDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `d_status` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `email`, `userName`, `phone`, `userType`, `cDate`, `d_status`) VALUES
(1, 'Isuri1@gmail.com', 'Isuri10', '0111111111', 'Vet', '2026-04-29 19:06:18', 0),
(2, 'Isuri2@gmail.com', 'Isuri2', '0222222222', 'Vet', '2026-02-26 10:17:10', 0),
(3, 'Isuri@gmail.com', 'Isuri3', '0333333333', 'Adopter', '2026-04-29 12:17:13', 0),
(4, 'sanduni@gmail.com', 'Isuri4', '0444444444', 'Adopter', '2026-04-29 13:35:03', 0),
(5, 'sachith@gmail.com', 'Isuri6', '0666666666', 'Admin', '2026-04-29 12:17:01', 0);

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
