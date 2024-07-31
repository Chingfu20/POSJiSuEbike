-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2024 at 07:15 AM
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
(6, 'Ching_fu', 'admin@gmail.com', '$2y$10$T5/rFI5c95EItfLiIWoyk.N1CwokaehS/WMUwYLwANKb1uT55Mc8e', '09489937567', 0, '2024-07-22');

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
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `status`, `created_at`) VALUES
(22, 'ching sedurifa', 'chingfu@gmail.com', '09489937567', 0, '2024-07-19'),
(23, 'johnyy', 'ved@gmail.com', '09506203861', 0, '2024-07-20'),
(27, 'Mich Pedroza', 'michped@gmail.com', '09096391158', 0, '2024-07-21'),
(28, 'Jessa Mae', 'jess10@gmail.com', '09987867564', 0, '2024-07-21'),
(29, 'johnril rosello', 'john@gmail.com', '09506203859', 0, '2024-07-28'),
(30, 'johnril rosello', 'john@gmail.com', '13300011', 0, '2024-07-28'),
(31, 'johnril rosello', 'john@gmail.com', '09222222222222222', 0, '2024-07-28'),
(32, 'ohaha', 'ved@gmail.com', '98766161564', 0, '2024-07-28'),
(33, 'ved', 'ved0@gmail.com', '15315316465', 0, '2024-07-28'),
(34, 'Admin', 'admin@gmail.com', '16165615615', 0, '2024-07-28'),
(35, 'Henry', 'djdrix@gmail.com', '9096391158', 0, '2024-07-30'),
(36, 'kungfu', 'pro@gmail.com', '9643356585', 0, '2024-07-30');

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
  `order_status` varchar(100) DEFAULT NULL,
  `payment_mode` varchar(100) NOT NULL COMMENT 'cash, online',
  `order_placed_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `tracking_no`, `invoice_no`, `total_amount`, `order_date`, `order_status`, `payment_mode`, `order_placed_by_id`) VALUES
(62, 22, '26227', 'INV-804925', '30000', '2024-07-22', 'booked', 'Cash Payment', 4),
(63, 29, '26201', 'INV-826554', '15000', '2024-07-27', 'booked', 'Cash Payment', 0),
(65, 27, '14415', 'INV-996424', '15000', '2024-07-27', 'booked', 'Online Payment', 0),
(68, 22, '35968', 'INV-243095', '15000', '2024-07-27', 'booked', 'Online Payment', 0),
(69, 27, '84793', 'INV-390382', '15000', '2024-07-28', 'booked', 'Online Payment', 0),
(70, 27, '39142', 'INV-543082', '15000', '2024-07-28', 'booked', 'Cash Payment', 0),
(71, 29, '99933', 'INV-215999', '15000', '2024-07-28', 'booked', 'Online Payment', 0),
(72, 22, '14095', 'INV-641577', '15000', '2024-07-28', 'booked', 'Online Payment', 0),
(73, 27, '85864', 'INV-773979', '30000', '2024-07-28', 'booked', 'Cash Payment', 0),
(74, 22, '43004', 'INV-835018', '15000', '2024-07-28', 'booked', 'Cash Payment', 0),
(75, 31, '52412', 'INV-796727', '15000', '2024-07-28', 'booked', 'Cash Payment', 0),
(76, 22, '32509', 'INV-525604', '15000', '2024-07-28', 'booked', 'Cash Payment', 0),
(77, 32, '23855', 'INV-350374', '15000', '2024-07-28', 'booked', 'Cash Payment', 0),
(78, 33, '40620', 'INV-707118', '15000', '2024-07-28', 'booked', 'Cash Payment', 0),
(79, 34, '66058', 'INV-243617', '15000', '2024-07-28', 'booked', 'Online Payment', 0),
(80, 22, '14983', 'INV-876098', '15000', '2024-07-28', 'booked', 'Cash Payment', 0),
(81, 27, '11382', 'INV-400949', '15000', '2024-07-29', 'booked', 'Online Payment', 6),
(82, 27, '88674', 'INV-231210', '15000', '2024-07-29', 'booked', 'Cash Payment', 6),
(86, 35, '87212', 'INV-825712', '40000', '2024-07-30', 'booked', 'Online Payment', 6),
(87, 35, '38818', 'INV-962029', '40000', '2024-07-30', 'booked', 'Cash Payment', 6),
(88, 35, '28683', 'INV-355736', '59000', '2024-07-30', 'booked', 'Online Payment', 6),
(89, 35, '39734', 'INV-526701', '40000', '2024-07-30', 'booked', 'Cash Payment', 6),
(90, 35, '98947', 'INV-950077', '15000', '2024-07-30', 'booked', 'Cash Payment', 6),
(91, 35, '11138', 'INV-973562', '15000', '2024-07-30', 'booked', 'Cash Payment', 6),
(92, 35, '25697', 'INV-732192', '15000', '2024-07-30', 'booked', 'Online Payment', 6),
(93, 35, '91883', 'INV-551745', '15000', '2024-07-30', 'booked', 'Cash Payment', 6),
(94, 36, '58058', 'INV-722830', '15000', '2024-07-30', 'booked', 'Cash Payment', 6),
(95, 32, '17578', 'INV-132777', '15000', '2024-07-30', 'booked', 'Online Payment', 6),
(96, 23, '64790', 'INV-310883', '15000', '2024-07-31', 'booked', 'Cash Payment', 6);

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
(39, 24, 2, '15000', '1'),
(40, 24, 6, '11000', '1'),
(41, 25, 2, '15000', '1'),
(42, 25, 6, '11000', '1'),
(43, 26, 2, '15000', '1'),
(44, 26, 6, '11000', '1'),
(45, 27, 2, '15000', '1'),
(46, 27, 6, '11000', '1'),
(47, 28, 2, '15000', '1'),
(48, 28, 6, '11000', '1'),
(49, 29, 2, '15000', '1'),
(50, 29, 6, '11000', '1'),
(51, 30, 2, '15000', '1'),
(52, 30, 6, '11000', '1'),
(53, 31, 2, '15000', '1'),
(54, 31, 6, '11000', '1'),
(55, 32, 2, '15000', '1'),
(56, 32, 6, '11000', '1'),
(57, 33, 2, '15000', '1'),
(58, 33, 6, '11000', '1'),
(59, 34, 2, '15000', '1'),
(60, 34, 6, '11000', '1'),
(61, 35, 6, '11000', '1'),
(62, 35, 9, '15000', '1'),
(63, 36, 6, '11000', '1'),
(64, 37, 10, '15000', '3'),
(65, 38, 11, '17000', '1'),
(66, 38, 10, '15000', '1'),
(67, 39, 11, '17000', '1'),
(68, 40, 11, '17000', '1'),
(69, 41, 10, '15000', '4'),
(70, 42, 13, '15', '1'),
(71, 43, 13, '15', '1'),
(72, 44, 14, '15', '1'),
(73, 45, 25, '44', '1'),
(74, 46, 23, '15', '1'),
(75, 47, 25, '15000', '1'),
(76, 48, 26, '15000', '1'),
(77, 49, 28, '15000', '3'),
(78, 50, 26, '15000', '1'),
(79, 51, 26, '15000', '2'),
(80, 52, 30, '15000', '2'),
(81, 53, 32, '15000', '3'),
(82, 54, 33, '15000', '1'),
(83, 55, 34, '11000', '2'),
(84, 56, 35, '11000', '3'),
(85, 57, 29, '11000', '1'),
(86, 58, 29, '11000', '1'),
(87, 59, 31, '11000', '1'),
(88, 60, 36, '15000', '2'),
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
(125, 96, 40, '15000', '1');

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
(40, 20, 'JiSu Ebike', 'Electric Bike, chargable, strong battery.', 15000, 5, 'assets/uploads/products/1722098132.jpg', 0, '2024-07-28'),
(41, 20, 'JISU MAJIKA EBIKE', 'UNIT SPECIFICATIONS\r\n▪️BATTERY : 60v20ah (5 pcs)\r\n▪️MOTOR : 650 watts\r\n▪️SPEED : 35 kph\r\n▪️DISTANCE : 60 km\r\n▪️INDICATOR : LCD display\r\n▪️LOADING CAPACITY : 200 kg\r\n▪️CHARGING TIME : 6-8 hours', 40000, 0, 'assets/uploads/products/1722265841.jpg', 0, '2024-07-29'),
(42, 20, 'JISU MAJIKA EBIKE', '(3 wheels, 3 seaters)\r\n\r\nUNIT SPECIFICATIONS\r\n▪️BATTERY : 60v20ah (5 pcs)\r\n▪️MOTOR : 650 watts\r\n▪️SPEED : 35 kph\r\n▪️DISTANCE : 60 km\r\n▪️INDICATOR : LCD display\r\n▪️LOADING CAPACITY : 200 kg\r\n▪️CHARGING TIME : 6-8 hours', 40000, 0, 'assets/uploads/products/1722265939.jpg', 0, '2024-07-29'),
(43, 20, 'ON THE WAY PRO', '(3 Wheels, 3 Seaters)\r\n\r\nUNIT SPECIFICATIONS\r\n▪️BATTERY : 72v20ah\r\n▪️MOTOR : 1000 watts\r\n▪️TOP SPEED : 45 kph\r\n▪️LOADING CAPACITY : 300 kg.\r\n▪️INDICATOR : LCD DISPLAY\r\n▪️CHARGING TIME : 8-10 hours\r\n\r\n▪️PROMO PRICE : Php59,000 (before Php67,000)\r\n\r\n📌Freebies\r\n✅Safety belt\r\n✅Rain cover', 59000, 0, 'assets/uploads/products/1722266025.jpg', 0, '2024-07-29'),
(44, 20, 'ON THE WAY PRO', '(3 Wheels, 3 Seaters)\r\n\r\nUNIT SPECIFICATIONS\r\n▪️BATTERY : 72v20ah\r\n▪️MOTOR : 1000 watts\r\n▪️TOP SPEED : 45 kph\r\n▪️LOADING CAPACITY : 300 kg.\r\n▪️INDICATOR : LCD DISPLAY\r\n▪️CHARGING TIME : 8-10 hours\r\n\r\n▪️PROMO PRICE : Php59,000 (before Php67,000)\r\n\r\n📌Freebies\r\n✅Safety belt\r\n✅Rain cover', 59000, 1, 'assets/uploads/products/1722266072.jpg', 0, '2024-07-29');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
