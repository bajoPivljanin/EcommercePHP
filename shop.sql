-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2023 at 04:06 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `delivery_address`, `created_at`) VALUES
(12, 6, 'Bosna, Bosna, vlasenica, 24000, neka adresa', '2023-08-12');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_items_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`) VALUES
(33, 12, 1, '1'),
(34, 12, 2, '1'),
(35, 13, 3, '2'),
(36, 14, 8, '2'),
(37, 14, 8, '2');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'error.png',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `size`, `image`, `created_at`) VALUES
(1, 'Product A', '19.99', 'Medium', 'error.png', '2023-08-12 16:31:15'),
(2, 'Product B', '29.99', 'Large', 'error.png', '2023-08-12 16:31:15'),
(3, 'Product C', '9.99', 'Small', 'error.png', '2023-08-12 16:31:15'),
(4, 'Product D', '49.99', 'X-Large', 'error.png', '2023-08-12 16:31:15'),
(5, 'Product E', '59.99', 'Small', 'error.png', '2023-08-12 16:41:20'),
(7, 'Boss TShirt', '90', 'Medium', 'error.png', '2023-08-15 17:59:11'),
(22, 'kakcet dole', '25', 'Medium', 'website-icon-5.png', '2023-08-16 10:43:00'),
(23, 'eaeaaea', '50', 'Medium', 'logo-ig-instagram-icon-download-icons-12.png', '2023-08-16 10:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `is_admin`, `password`, `created_at`) VALUES
(2, 'bajo', 'bajoo', 'admin@admin.com', 0, '$2y$10$sR9lHL3zE6PcrIlxaxzAD.tOamx54ihb3uzDafChGjsYDE0Oyeg8e', '2023-08-11 17:39:48'),
(3, 'Marko Bajagic', 'marko_bajagic', 'random@random.com', 0, '$2y$10$5NtlJsqxOOUlCpLo0KRmuuNsxrDTAV5xk22Ds/ypQaB5KY08j7UwG', '2023-08-11 17:39:59'),
(4, 'devito', 'devitoo', 'devitoo@gmail.com', 0, '$2y$10$0vrEvXWrn3vCW2YZVPLY8.Gx/60zDfIDRN89dXqvv/7GdnQGUhNwu', '2023-08-11 17:40:45'),
(5, 'jala', 'jalabrat', 'jalabratina@gmail.com', 0, '$2y$10$JuTUitvTlYEieo3jOL0Q4Oud0t.KCZs23HPr5zrQtDo22xEHF0qT2', '2023-08-11 17:45:20'),
(6, 'marko', 'marko', 'marko@gmail.com', 0, '$2y$10$oOy2fc3HxCZHFaXiwbXGKODVBDbnzasU.E35muPB4spfKjWE3Zip6', '2023-08-11 18:32:12'),
(7, 'admin', 'admin', 'admin@admin.com', 1, '$2y$10$jyvPWtuh..DZZtdQd9XtEufNgrp8q.A.t54x2Krc9b5Mzt59GfRVW', '2023-08-13 16:46:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
