-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 04:36 AM
-- Server version: 10.4.32-MariaDB
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
(22, 'jisu3', 'dd', 0);

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
(74, 'tasdasdasdasdasd', 'teaasdasdsdasdst@gmail.com', '09692870485', 0, 'asdasdasds', '2024-10-23'),
(75, 'john', 'j@gmail.com', '09636541784', 0, 'mancilang, madridejos, cebu', '2024-10-30'),
(76, 'chingfu', 'chingfu@gmail.com', '09489937567', 0, 'mancilang', '2024-10-30'),
(77, 'ching', 'chingfu@gmail.com', '09096391158', 0, 'Poblacion', '2024-10-30'),
(78, 'Hershey Sedurifa', 'chingfu@gmail.com', '09096391168', 0, 'Poblacion, Madridejos, Cebu', '2024-10-31'),
(79, 'Ching Fu', 'chingfujizz@gmail.com', '09489938678', 0, 'Fujisan Sitio Japan', '2024-10-31'),
(80, 'Micheble', 'michped@gmail.com', '09996391168', 0, 'Sillon', '2024-10-31'),
(81, 'Kungkuro', 'kaguran@gmail.com', '09102131231', 0, 'Ari ra dire dapit kilids dahan', '2024-10-31');

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
(106, 78, '45833', 'INV-995724', '22500', '2024-10-31', 'Cash Payment', 6),
(107, 79, '29236', 'INV-701827', '75000', '2024-10-31', 'Cash Payment', 6),
(108, 80, '58691', 'INV-806802', '15000', '2024-10-31', 'Cash Payment', 6),
(109, 81, '71479', 'INV-631978', '15000', '2024-10-31', 'Cash Payment', 6);

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
(89, 61, 36, '15000', '1'),
(90, 62, 37, '15000', '1'),
(91, 62, 38, '15000', '1'),
(92, 63, 37, '15000', '1'),
(93, 64, 40, '15000', '1'),
(94, 65, 40, '15000', '1'),
(95, 66, 38, '15000', '1'),
(96, 67, 38, '15000', '0'),
(97, 68, 37, '15000', '1'),
(98, 69, 38, '15000', '1'),
(99, 70, 40, '15000', '1'),
(100, 71, 38, '15000', '1'),
(101, 72, 38, '15000', '1'),
(102, 73, 40, '15000', '2'),
(103, 74, 40, '15000', '1'),
(104, 75, 40, '15000', '1'),
(105, 76, 37, '15000', '1'),
(106, 77, 37, '15000', '1'),
(107, 78, 37, '15000', '1'),
(108, 79, 37, '15000', '1'),
(109, 80, 37, '15000', '1'),
(110, 81, 38, '15000', '1'),
(111, 82, 38, '15000', '1'),
(112, 83, 37, '15000', '1'),
(113, 84, 40, '15000', '1'),
(114, 85, 41, '40000', '1'),
(115, 86, 41, '40000', '1'),
(116, 87, 41, '40000', '1'),
(117, 88, 43, '59000', '1'),
(118, 89, 42, '40000', '1'),
(119, 90, 40, '15000', '1'),
(120, 91, 40, '15000', '1'),
(121, 92, 40, '15000', '1'),
(122, 93, 40, '15000', '1'),
(123, 94, 40, '15000', '1'),
(124, 95, 40, '15000', '1'),
(125, 96, 40, '15000', '1'),
(126, 97, 45, '2323', '1'),
(127, 98, 45, '2323', '1'),
(128, 99, 45, '2323', '1'),
(129, 100, 45, '15000', '1'),
(130, 101, 45, '15000', '1'),
(131, 102, 45, '15000', '1'),
(132, 103, 47, '75000', '1'),
(133, 104, 47, '75000', '1'),
(134, 105, 47, '75000', '1'),
(135, 106, 46, '22500', '1'),
(136, 107, 47, '75000', '1'),
(137, 108, 45, '15000', '1'),
(138, 109, 45, '15000', '1');

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
(45, 20, 'JISU SPIKE X EBIKE', '▪️BATTERY : 48v20ah\r\n▪️MOTOR : 600 watts\r\n▪️SPEED : 30-40 kph\r\n▪️CAPACITY : 200 kg \r\n▪️DISTANCE : 30-40 km\r\n▪️CHARGING TIME : 6-8 hours', 15000, 5, 'assets/uploads/products/1730256862.jpg', 0, '2024-10-23'),
(46, 20, 'SKELLY 3 EBIKE', '▪️BATTERY : 48v20ah\r\n▪️MOTOR : 600 watts\r\n▪️SPEED : 30-40 kph\r\n▪️CAPACITY : 200 kg \r\n▪️DISTANCE : 30-40 km\r\n▪️CHARGING TIME : 6-8 hours\r\n/With charger\r\n/With raincoat (freebie)\r\n/With one month free check-up for unit\r\n/With 3 months warranty for battery', 22500, 5, 'assets/uploads/products/1730257112.jpg', 0, '2024-10-30'),
(47, 20, 'CLASSY PRO', '4 wheels, 5 seaters ebike\r\n/AVAILABLE COLOR : PURPLE GRAY, WHITE AND RED\r\n/With free tire\r\n/1 month free unit check-up\r\n/3 months warranty of batteries', 75000, 5, 'assets/uploads/products/1730257271.jpg', 0, '2024-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'ching', 'sedurifa', 'user@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b'),
(2, 'ching', 'sedurifa', 'chingfu@gmail.com', '26ffcef53c44522efbfe7fef964a4058'),
(3, 'Mich', 'Pedroza', 'michped@gmail.com', '26ffcef53c44522efbfe7fef964a4058'),
(4, 'johnril', 'rosello', 'janjan@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b'),
(5, 'Hershey', 'Sedurifa', 'ching@gmail.com', 'b8c37e33defde51cf91e1e03e51657da'),
(8, 'johnril', 'rosello', 'capstone@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
