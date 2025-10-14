-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 22, 2025 at 11:07 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flowershop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `product_name`, `price`, `quantity`, `image`, `created_at`) VALUES
(14, 1, 'Lily Love', '270.00', 2, 'rosebouquet.jpg', '2025-03-22 10:17:10'),
(15, 1, 'Rose Bouquet', '270.00', 2, 'rosebouquet.jpg', '2025-03-22 10:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_name`, `quantity`, `price`, `image`, `payment_method`, `order_date`, `status`) VALUES
(1, 1, 'Blush Bouquet', 1, '400.00', 'rosebouquet.jpg', 'Cash on Delivery', '2025-03-22 14:14:33', 'Pending'),
(2, 1, 'Rose Bouquet', 2, '270.00', 'rosebouquet.jpg', 'Cash on Delivery', '2025-03-22 14:14:33', 'Pending'),
(3, 1, 'Romantic Roses', 1, '450.00', 'rosebouquet.jpg', 'Cash on Delivery', '2025-03-22 14:14:33', 'Pending'),
(4, 1, 'Lily Love', 1, '270.00', 'rosebouquet.jpg', 'Online Payment', '2025-03-22 14:17:26', 'Pending'),
(5, 1, 'Sunflower Joy', 1, '300.00', 'rosebouquet.jpg', 'Online Payment', '2025-03-22 14:17:26', 'Pending'),
(6, 1, 'Tulip Bunch', 1, '320.00', 'rosebouquet.jpg', 'Online Payment', '2025-03-22 14:29:34', 'Pending'),
(7, 1, 'Pastel Vase', 1, '620.00', 'rosebouquet.jpg', 'Online Payment', '2025-03-22 14:35:42', 'Pending'),
(8, 1, 'Lily Love', 1, '270.00', 'rosebouquet.jpg', 'Online Payment', '2025-03-22 14:51:34', 'Cancelled'),
(9, 1, 'Rose Mix', 1, '250.00', 'rosebouquet.jpg', 'Online Payment', '2025-03-22 14:51:34', 'Delivered'),
(10, 4, 'Rose Bouquet', 2, '270.00', 'rosebouquet.jpg', 'Online Payment', '2025-03-22 16:24:28', 'Shipped');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Khadeejath Farzana A', 'farzu502@gmail.com', '$2y$10$qtm8zHPf9T6.aqY7373cgOL5f2lBydLghfMbtOs6GqfQ1nbypVbiW'),
(2, 'abcd abcd', 'abcd@gmail.com', '$2y$10$SSP47gE3BvGQ1WUdcJfsNe5XSQa4fw2G7yoIFl3NyE.bf9t8mGMDW'),
(3, 'ashu', 'ash1232@gmail.com', '$2y$10$mh0xrtS/dqr/GObzCUkGFuFrY2yj4IJSjvZz0XqFPEWcOiq0PRfze'),
(4, 'zephyr', 'zephyr@gmail.com', '$2y$10$wA0U5wSAkp0H/z8MrJYXoOtW9nHo1nsAA01.Ou6WMFK3FusAJnecG');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
