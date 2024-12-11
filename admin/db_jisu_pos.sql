-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 09:00 AM
-- Server version: 10.4.32-MariaDBa
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jisu_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `is_ban` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not_ban,1=ban',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone`, `is_ban`, `created_at`) VALUES
(6, 'Admin', 'admin@gmail.com', '$2y$10$sJbPEvZBkXr.iPc.9OMI9exDaqxkqkeLii9rERM6Qgrgw85mbrIw2', '09489937567', 0, '2024-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`) VALUES
(20, 'Ebike', '(3 wheels, 3 seaters)\r\n\r\nUNIT SPECIFICATIONS\r\n▪️BATTERY : 60v20ah (5 pcs)\r\n▪️MOTOR : 650 watts\r\n▪️SPEED : 35 kph\r\n▪️DISTANCE : 60 km\r\n▪️INDICATOR : LCD display\r\n▪️LOADING CAPACITY : 200 kg\r\n▪️CHARGING TIME : 6-8 hours', 0),
(21, 'jisu2', 'ss', 0),
(22, 'jisu3', 'dd', 0),
(26, 'sample', 'sample', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden',
  `address` varchar(150) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `status`, `address`, `created_at`) VALUES
(86, 'jfghfgdfg', 'delacruz@gmail.com', '09564545454', 0, 'asdasdasd', '2024-11-02'),
(87, 'sample', 'sample@gmail.com', '09235345345', 0, 'sample', '2024-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tracking_no` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `payment_mode` varchar(100) NOT NULL COMMENT 'cash, online',
  `order_placed_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `tracking_no`, `invoice_no`, `total_amount`, `order_date`, `payment_mode`, `order_placed_by_id`) VALUES
(111, 86, '63547', 'INV-277686', '75000', '2024-11-02', 'Cash Payment', 6),
(112, 87, '48334', 'INV-861599', '15000', '2024-11-07', 'Cash Payment', 6),
(113, 87, '13025', 'INV-592766', '10000', '2024-11-07', 'Cash Payment', 6);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(146, 111, 47, '75000', '1'),
(147, 112, 50, '15000', '1'),
(148, 113, 51, '10000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hidden',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `quantity`, `image`, `status`, `created_at`) VALUES
(46, 20, 'SKELLY 3 EBIKE', '▪️BATTERY : 48v20ah\r\n▪️MOTOR : 600 watts\r\n▪️SPEED : 30-40 kph\r\n▪️CAPACITY : 200 kg \r\n▪️DISTANCE : 30-40 km\r\n▪️CHARGING TIME : 6-8 hours\r\n/With charger\r\n/With raincoat (freebie)\r\n/With one month free check-up for unit\r\n/With 3 months warranty for battery', 22500, 1, 'assets/uploads/products/1730257112.jpg', 0, '2024-10-30'),
(47, 20, 'CLASSY PRO', '4 wheels, 5 seaters ebike\r\n/AVAILABLE COLOR : PURPLE GRAY, WHITE AND RED\r\n/With free tire\r\n/1 month free unit check-up\r\n/3 months warranty of batteries', 75000, 1, 'assets/uploads/products/1730257271.jpg', 0, '2024-10-30'),
(50, 21, 'sample', '▪️BATTERY : 48v20ah\r\n▪️MOTOR : 600 watts\r\n▪️SPEED : 30-40 kph\r\n▪️CAPACITY : 200 kg \r\n▪️DISTANCE : 30-40 km\r\n▪️CHARGING TIME : 6-8 hours\r\n/With charger\r\n/With raincoat (freebie)\r\n/With one month free check-up for unit\r\n/With 3 months warranty for battery', 15000, 9, 'assets/uploads/products/1730792440.jpg', 0, '2024-11-05'),
(51, 26, 'sample', 'test', 10000, 1, 'assets/uploads/products/1730966824.jpg', 0, '2024-11-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
