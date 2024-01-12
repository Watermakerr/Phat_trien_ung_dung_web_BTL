-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 12, 2024 at 04:58 AM
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
(3, 'Apple', 'active', '2024-01-06 07:14:50', '2024-01-06 07:14:50'),
(4, 'Oppo  ', 'active', '2024-01-12 03:43:47', '2024-01-12 03:48:24'),
(5, 'Samsung   ', 'active', '2024-01-12 03:49:18', '2024-01-12 04:34:33');

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

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0. Đang chờ xác nhận 1. Đã xác nhận 2. Đang giao hàng 3. Đã giao hàng 4. Đã huỷ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `create_at`, `update_at`, `status`) VALUES
(6, 16, '2024-01-07 08:58:39', '2024-01-07 08:59:07', 4),
(7, 16, '2024-01-07 08:58:45', '2024-01-07 08:59:11', 1),
(8, 16, '2024-01-07 08:58:53', '2024-01-07 08:58:53', 0);

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
(11, 'phone 32', '5ce1c93d3ca9b4a2425d369b59d05fee.jpg', 3, 1000000000, '<p><strong>Thương hiệu</strong>: Apple</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-08 15:30:37', '2024-01-12 03:36:36'),
(12, 'iphone 5', '8-plus-1616692326040.jpg', 3, 4000000, '<p><strong>Thương hiệu</strong>: Apple</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 8GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: 5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-08 15:36:42', '2024-01-12 03:41:46'),
(13, 'phone 13 promax', '359362701_665572625615117_1068142181357036148_n-1689827198-684-width1024height1024.jpg', 3, 16000000, '<p><strong>Thương hiệu</strong>: Apple</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-11 13:29:19', '2024-01-12 03:41:06'),
(14, 'phone 14 promax', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 3, 19000000, '<p><strong>Thương hiệu</strong>: Apple</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-11 13:29:25', '2024-01-12 03:40:32'),
(15, 'phone 11', 'apple-iphone-11-pro-max-1-sim-256gb-cu-99-ll-11688962088.jpg', 3, 17000000, '<p><strong>Thương hiệu</strong>: Apple</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-11 13:29:27', '2024-01-12 03:40:04'),
(16, 'iphone X', '1691807161_10055895-dien-thoai-samsung-galaxy-z-fold-5-5g-12g.jpg', 3, 13000000, '<p><strong>Thương hiệu</strong>: Apple</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-11 13:29:28', '2024-01-12 03:39:38'),
(17, 'phone 6', '6529654cv13d.jpg', 3, 1, '<p><strong>Thương hiệu</strong>: Apple</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-11 13:29:29', '2024-01-12 03:38:52'),
(18, 'phone 8', '359362701_665572625615117_1068142181357036148_n-1689827198-684-width1024height1024.jpg', 3, 10000000, '<p><strong>Thương hiệu</strong>: Apple</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 32GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-11 13:29:31', '2024-01-12 03:39:04'),
(29, 'iphone 12', '6529654cv13d.jpg', 3, 4000000, '<p><strong>Thương hiệu</strong>: Apple</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-12 03:42:29', '2024-01-12 03:42:29'),
(30, 'iphone 12', 'badmin.jpg', 3, 4000000, '<p><strong>Thương hiệu</strong>: Apple</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-12 03:43:02', '2024-01-12 03:43:02'),
(31, 'iphone 16', '6529654cv13d.jpg', 3, 4000000, '<p><strong>Thương hiệu</strong>: Apple</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-12 03:43:33', '2024-01-12 03:43:33'),
(32, 'Oppo A32', '5ce1c93d3ca9b4a2425d369b59d05fee.jpg', 3, 7000000, '<p><strong>Thương hiệu</strong>: Oppo</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-12 03:50:40', '2024-01-12 03:51:43'),
(33, 'Oppo A45', '1691807161_10055895-dien-thoai-samsung-galaxy-z-fold-5-5g-12g.jpg', 4, 5000000, '<p><strong>Thương hiệu</strong>: Oppo</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-12 03:52:28', '2024-01-12 03:52:28'),
(34, 'Oppo A46', '6529654cv13d.jpg', 4, 5000000, '<p><strong>Thương hiệu</strong>: Oppo</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-12 03:53:19', '2024-01-12 03:53:19'),
(35, 'Oppo S12', 'a93-8gb128gb_main_618_1020.png.webp', 4, 5000000, '<p><strong>Thương hiệu</strong>: Oppo</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-12 03:53:38', '2024-01-12 03:53:38'),
(36, 'Oppo S4', 'apple-iphone-11-pro-max-1-sim-256gb-cu-99-ll-11688962088.jpg', 4, 5000000, '<p><strong>Thương hiệu</strong>: Oppo</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-12 03:53:57', '2024-01-12 03:53:57'),
(37, 'Samsung S12', '600_samsung_galaxy_s22_chinh_hang_den_1.webp', 5, 12000000, '<p><strong>Thương hiệu</strong>: Samsung</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-12 03:55:28', '2024-01-12 03:55:28'),
(38, 'Samsung S12', '1684210858832-ly-do-nen-lua-chon-iphone-11-cu-o-thoi-diem-hien-tai.jpg', 4, 12000000, '<p><strong>Thương hiệu</strong>: Samsung</p>\r\n\r\n<p><strong>Bộ nhớ</strong>: 64GB</p>\r\n\r\n<p><strong>Vi xử l&yacute;</strong>: A5</p>\r\n\r\n<p><strong>Ram</strong>: 8GB</p>\r\n', '2024-01-12 03:56:24', '2024-01-12 03:56:24');

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
(16, 'admin', 'admin 2', 'tranchonh2000@gmail.com', '$2y$10$Z3UR2K6BJVpKfGdghcT4keRkq4gWjdzu2T6Vyh.SeZA/2qRF8a7tG', 1, '2024-01-07 08:57:57', '2024-01-07 08:58:18');

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
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

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
