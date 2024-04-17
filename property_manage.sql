-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 09:40 AM
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
-- Database: `property_manage`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `book_phone` varchar(10) NOT NULL,
  `book_valid` varchar(12) NOT NULL,
  `property_book_id` int(11) NOT NULL,
  `booking_type` varchar(50) NOT NULL,
  `check_in_date` varchar(20) NOT NULL,
  `check_out_date` varchar(20) NOT NULL,
  `pay_total` varchar(20) NOT NULL,
  `pay_advance` varchar(20) NOT NULL,
  `pay_deposit` varchar(20) NOT NULL,
  `pay_remaining` varchar(20) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `referral_name` varchar(50) NOT NULL,
  `referral_number` varchar(50) NOT NULL,
  `biller_id` int(11) NOT NULL,
  `actual_booked_rooms` varchar(15) NOT NULL,
  `checkout_check` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `book_name`, `book_phone`, `book_valid`, `property_book_id`, `booking_type`, `check_in_date`, `check_out_date`, `pay_total`, `pay_advance`, `pay_deposit`, `pay_remaining`, `payment_type`, `referral_name`, `referral_number`, `biller_id`, `actual_booked_rooms`, `checkout_check`) VALUES
(1, 'test name', '8844388443', '', 3, '5BHK', '18-04-2024', '19-04-2024', '21000.00', '12993', '3000', '8007', 'gateway', 'None Provided', 'None Provided', 1, '3BHK', 'No'),
(2, 'name test test', '7766488774', '876566776675', 7, '7BHK', '13-04-2024', '16-04-2024', '67714.00', '15000', '12000', '52714', 'gateway', 'None Provided', 'None Provided', 1, '6BHK', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `ambience_rating` varchar(10) NOT NULL,
  `cleanliness_rating` varchar(10) NOT NULL,
  `food_quality_rating` varchar(10) NOT NULL,
  `service_rating` varchar(10) NOT NULL,
  `suggestions` text NOT NULL,
  `ref_name` varchar(10000) NOT NULL,
  `ref_phone` varchar(5000) NOT NULL,
  `submit_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `name`, `phone`, `email`, `city`, `ambience_rating`, `cleanliness_rating`, `food_quality_rating`, `service_rating`, `suggestions`, `ref_name`, `ref_phone`, `submit_date`) VALUES
(1, 'name', '8844388443', 'some@hh.c', 'CitySomething', '6', '2', '8', '4', 'no suggest maybe', 'oieuail,aksjgdjka,kjashaisu', '8822377442,9922730921,9988277332', '27-03-2024'),
(2, 'askjhd', '8844388553', 'aaaa@aa.c', 'kjahsdkja', '0', '5', '2', '7', 'asdadadalskdj', 'ajsdasdhkad,hsadjahdkasjh', '8824477332,9898173293', '27-03-2024'),
(4, 'andkjwakda', '9384994455', '', 'asdasdasdas', '0', '0', '0', '0', '', 'asdasdasdasd', '8877422338', '28-03-2024'),
(5, 'aksljalksjdalksjd', '8844388443', 'as@dd.c', 'laskdlasdjaskl', '6', '6', '4', '6', '', 'oisjdfsjfklsd', '9747399443', '29-03-2024'),
(6, 'Pall0', '8983738907', 'test@t.c', 'pune', '3', '4', '5', '4', '', 'Vishal', '9970377173', '12-04-2024');

-- --------------------------------------------------------

--
-- Table structure for table `login_data`
--

CREATE TABLE `login_data` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `profile_picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_data`
--

INSERT INTO `login_data` (`id`, `name`, `password`, `profile_picture`) VALUES
(1, 'admin', 'root', 'user_profile/Max-R_Headshot.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `property_data`
--

CREATE TABLE `property_data` (
  `id` int(11) NOT NULL,
  `property_type` varchar(30) NOT NULL,
  `property_name` varchar(50) NOT NULL,
  `location` varchar(30) NOT NULL,
  `room_type` varchar(30) NOT NULL,
  `propertyaddr` varchar(200) NOT NULL,
  `owner` varchar(80) NOT NULL,
  `owner_phone` varchar(10) NOT NULL,
  `owner_valid` varchar(60) NOT NULL,
  `manager_name` varchar(80) NOT NULL,
  `manage_phone` varchar(10) NOT NULL,
  `manage_valid` varchar(60) NOT NULL,
  `rent_price` varchar(15) NOT NULL,
  `amenities` varchar(120) NOT NULL,
  `location_url` varchar(500) NOT NULL,
  `deposit_amt` varchar(30) NOT NULL,
  `photos_url` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_data`
--

INSERT INTO `property_data` (`id`, `property_type`, `property_name`, `location`, `room_type`, `propertyaddr`, `owner`, `owner_phone`, `owner_valid`, `manager_name`, `manage_phone`, `manage_valid`, `rent_price`, `amenities`, `location_url`, `deposit_amt`, `photos_url`) VALUES
(1, 'Flat/Apartment', 'prop1', 'Goa', '5BHK', 'somewhere in goa', 'someone', '1231231233', '131231231231', 'manager1', '9457363534', '91879781278912', '50000', 'Array', 'https://www.some.com', '5000', ''),
(2, 'Flat/Apartment', 'aa', 'Karjat', '3BHK', 'aa', 'aa', '0', 'aaaa', 'aa', '0', 'aaa', '10000', 'Swimming Pool,Mini Garden,Kitchen Equipments,WiFi,Air Conditioning', 'https://somewhere.com', '2500', ''),
(3, 'Villa/Bungalow', 'prop1', 'Lonavala', '5BHK', 'lonavala', 'name', '9876565656', '', 'name2', '9876789876', '', '30000', 'Mini Garden,WiFi,Air Conditioning', 'https://someurl.com', '3000', ''),
(4, 'Villa/Bungalow', 'name na', 'Mavali', '2BHK', 'some daddess, ssd', 'owner oo', '7383223743', '', 'manager 11', '8726278364', '', '45000', 'Swimming Pool,Mini Garden,Air Conditioning', 'https://some.com', '8500', ''),
(7, 'Villa/Bungalow', 'Villa 112', 'Mahabaleshwar', '7BHK', 'Somewhere on a mountain', 'Name name', '8833299442', '', 'name part2', '9988377442', '', '65000', 'Mini Garden,Kitchen Equipments,WiFi,Air Conditioning', 'https://some.com', '12000', ''),
(8, 'Villa/Bungalow', 'Name name2', 'Goa', '4BHK', 'address in goa', 'owner 101', '8844399883', '774387342233', 'manager mn1', '9944388552', '', '70000', 'Swimming Pool,Mini Garden,WiFi,Air Conditioning', 'https://some.com', '22000', ''),
(9, 'Villa/Bungalow', 'namenama', 'Mavali', '5BHK', 'afasdsad', 'dasdasdas', '8585599884', '756494849484', 'ksjhfjashf', '9988344332', '', '43434', 'Mini Garden,Kitchen Equipments', 'https://some.com', '12123', ''),
(50, 'Flat/Apartment', 'kjahjkahsjkdhas', 'Karjat', '3BHK', 'kjasjkasjkdh', 'askjdjakshdjk', '8833299442', '', 'akjshdjkashdj', '9944388552', '', '34000', 'Swimming Pool,Kitchen Equipments,WiFi', 'https://some.com', '11000', '50/2021_SHO_RandomHouse_001.jpg,50/main.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `biller_id` (`biller_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `login_data`
--
ALTER TABLE `login_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_data`
--
ALTER TABLE `property_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login_data`
--
ALTER TABLE `login_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `property_data`
--
ALTER TABLE `property_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_login_id_log` FOREIGN KEY (`biller_id`) REFERENCES `login_data` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
