-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2023 at 03:27 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `status`, `create_at`, `update_at`) VALUES
(1, 'Nokia', 'active', '2023-12-15 07:43:56', '2023-12-15 07:43:56'),
(2, 'Apple', 'active', '2023-12-15 08:23:00', '2023-12-15 08:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedback_id`, `message`, `user_id`, `product_id`, `create_at`, `update_at`) VALUES
(1, 'Sản phẩm rất tốt, tôi khuyên không nên mua', 9, 29, '2023-12-20 15:26:44', '2023-12-20 15:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0. Đơn hàng đang tiếp nhận 1. Đóng gói 2. Đang giao 3. Giao hàng thành công 4. Hủy'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(500) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) DEFAULT '0',
  `description` longtext NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `image`, `category_id`, `price`, `description`, `create_at`, `update_at`) VALUES
(11, 'phone 32', '5ce1c93d3ca9b4a2425d369b59d05fee.jpg', 2, 123, '111', '2023-12-20 09:39:44', '2023-12-20 09:39:44'),
(12, 'ádasd', '359362701_665572625615117_1068142181357036148_n-1689827198-684-width1024height1024.jpg', 2, 23143, '234234', '2023-12-20 09:54:59', '2023-12-20 09:54:59'),
(13, 'iphone 1', 'iphone-x.png', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:21:42', '2023-12-20 15:21:42'),
(14, 'iphone 2', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:21:55', '2023-12-20 15:21:55'),
(15, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:22:11', '2023-12-20 15:22:11'),
(16, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:22:14', '2023-12-20 15:22:14'),
(17, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:22:17', '2023-12-20 15:22:17'),
(18, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:22:20', '2023-12-20 15:22:20'),
(19, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:22:23', '2023-12-20 15:22:23'),
(20, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:23:03', '2023-12-20 15:23:03'),
(21, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:23:06', '2023-12-20 15:23:06'),
(22, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:23:09', '2023-12-20 15:23:09'),
(23, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:23:11', '2023-12-20 15:23:11'),
(24, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:23:13', '2023-12-20 15:23:13'),
(25, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:23:14', '2023-12-20 15:23:14'),
(26, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:23:16', '2023-12-20 15:23:16'),
(27, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:23:18', '2023-12-20 15:23:18'),
(28, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:23:19', '2023-12-20 15:23:19'),
(29, 'iphone 3', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 2, 1000000, 'Hàng chính hãng', '2023-12-20 15:23:21', '2023-12-20 15:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` char(25) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  `role_id` int(11) DEFAULT '2',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `fullname`, `email`, `password`, `role_id`, `create_at`, `update_at`) VALUES
(5, '1', 'Trần Quốc Chính', 'vuibigboy@gmail.com', '1', 1, '2023-12-15 07:34:42', '2023-12-15 07:52:09'),
(6, 'vuibigboy', 'Trần Quốc Chính', 'vuibigboy@gmail.com', '1', 2, '2023-12-15 07:35:17', '2023-12-15 07:35:17'),
(7, 'aa', 'Trần Quốc Chính', 'vuibigboy@gmail.com', '1', 2, '2023-12-15 09:10:02', '2023-12-15 09:10:02'),
(8, '2', '1', 'vuibigboy@gmail.com', '1', 2, '2023-12-15 13:10:34', '2023-12-15 13:10:34'),
(9, 'chinh', 'Trần Quốc Chính', 'vuibigboy@gmail.com', '$2y$10$DnB0aKlajFKc7DNPlZV3n.jqBpjdU5o.WFol2kZPIHFmPj6t9ZyBW', 1, '2023-12-16 10:07:31', '2023-12-20 08:23:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_iD` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedbacks_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
