-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 16, 2024 at 03:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nhom10-project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `bill_status` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_phone` varchar(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `category_id`) VALUES
(1, 'Iphone', '2024-11-13 03:03:33', 1),
(2, 'Samsung', '2024-11-13 03:03:33', 1),
(3, 'Xiaomi', '2024-11-13 03:03:33', 1),
(4, 'OPPO', '2024-11-13 03:03:33', 1),
(5, 'Vivo', '2024-11-13 03:03:33', 1),
(6, 'Realme', '2024-11-13 03:03:33', 1),
(7, 'ASUS', '2024-11-13 03:03:33', 1),
(8, 'TECHNO', '2024-11-13 03:03:33', 1),
(9, 'Nokia', '2024-11-13 03:03:33', 1),
(10, 'Infinix', '2024-11-13 03:03:33', 1),
(11, 'Oneplus', '2024-11-13 03:03:33', 1),
(12, 'Xem tất cả', '2024-11-13 03:03:33', 1),
(13, 'Macbook', '2024-11-13 03:03:33', 2),
(14, 'Asus', '2024-11-13 03:03:33', 2),
(15, 'MSI', '2024-11-13 03:03:33', 2),
(16, 'Lenovo', '2024-11-13 03:03:33', 2),
(17, 'HP', '2024-11-13 03:03:33', 2),
(18, 'Acer', '2024-11-13 03:03:33', 2),
(19, 'Dell', '2024-11-13 03:03:33', 2),
(20, 'Huawei', '2024-11-13 03:03:33', 2),
(21, 'Gigabyte', '2024-11-13 03:03:33', 2),
(22, 'Surface', '2024-11-13 03:03:33', 2),
(23, 'Xem tất cả', '2024-11-13 03:03:33', 2),
(24, 'iPad 10.2 2021', '2024-11-13 03:03:33', 3),
(25, 'Tab S9', '2024-11-13 03:03:33', 3),
(26, 'iPad Air', '2024-11-13 03:03:33', 3),
(27, 'iPad Pro', '2024-11-13 03:03:33', 3),
(28, 'Samsung', '2024-11-13 03:03:33', 3),
(29, 'TCL', '2024-11-13 03:03:33', 3),
(30, 'Lenovo', '2024-11-13 03:03:33', 3),
(31, 'Xiaomi', '2024-11-13 03:03:33', 3),
(32, 'Xem tất cả', '2024-11-13 03:03:33', 3);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `icon_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon_name`) VALUES
(1, 'Điện thoại  ', 'fa-mobile'),
(2, 'Laptop', 'fa-laptop'),
(3, 'Tablet', 'fa-tablet'),
(4, 'Đồng hồ,camera', 'fa-camera'),
(5, 'Gia dụng, Smarthome', 'fa-house-signal'),
(6, 'Âm thanh', 'fa-headphones'),
(7, 'PC, Màn hình, Máy in', 'fa-desktop'),
(8, 'Tivi', 'fa-tv'),
(9, 'Thu cũ đổi mới', 'fa-comments-dollar'),
(10, 'Tin tức công nghệ', 'fa-newspaper');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `color_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sale_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `brand_id`, `price`, `discount`, `image`, `view_count`, `description`, `content`, `created_at`, `updated_at`, `sale_price`) VALUES
(1, 1, 'iPhone 15 Pro Max 256GB | Chính hãng VN/A', 1, 15000000, 17, 'img/1731725775-iphone-15-pro-max_3.webp', 0, 'iPhone 15 Pro Max thu hút với màn hình Super Retina XDR 6.7 inch sắc nét, mặt lưng titanium bền bỉ và thiết kế viền mỏng tinh tế. Được trang bị chip A17 Pro mạnh mẽ, iPhone 15 Pro Max mang lại hiệu suất vượt trội cho mọi tác vụ nặng. Điểm nhấn của thiết bị là cổng sạc USB-C và tính năng sạc nhanh hiện đại. Phiên bản này có 4 màu đẳng cấp: titan tự nhiên, titan xanh, titan đen và titan trắng. Xem thêm các thông tin chi tiết khác về iPhone 15 Pro Max ngay sau đây!', 'Trải nghiệm đỉnh cao với hiệu năng mạnh mẽ từ vi xử lý tân tiến, kết hợp cùng RAM 12GB cho khả năng đa nhiệm mượt mà.\r\nLưu trữ thoải mái mọi ứng dụng, hình ảnh và video với bộ nhớ trong 256GB.\r\nNâng tầm nhiếp ảnh di động với hệ thống camera tiên tiến, cho ra đời những bức ảnh và video chất lượng chuyên nghiệp.', '2024-11-13 03:25:50', '2024-11-15 20:56:25', 13000000),
(2, 2, 'Apple Macbook Air M2 2022 8GB 256GB I Chính hãng Apple Việt Nam', 13, 20000000, 23, 'img/macbook_air_m2_1_1.webp', 0, 'iPhone 15 Plus được đánh giá cao bởi màn hình Dynamic Island 6.7 inch với mặt kính lưng pha màu  ấn tượng, chip A16 Bionic  mạnh mẽ cùng cổng sạc USB-C  cho khả năng sạc đầy nhanh chóng. Ngoài ra, phiên bản Plus thuộc series iPhone 15 còn sở hữu 5 phiên bản màu pastel  thanh lịch phù hợp với nhiều đối tượng khách hàng: hồng, vàng, xanh lá, xanh dương, đen. Xem thêm các thông tin hữu ích khác về điện thoại iPhone 15 Plus sau đây!', 'Trải nghiệm đỉnh cao với hiệu năng mạnh mẽ từ vi xử lý tân tiến, kết hợp cùng RAM 12GB cho khả năng đa nhiệm mượt mà.\r\nLưu trữ thoải mái mọi ứng dụng, hình ảnh và video với bộ nhớ trong 256GB.\r\nNâng tầm nhiếp ảnh di động với hệ thống camera tiên tiến, cho ra đời những bức ảnh và video chất lượng chuyên nghiệp.', '2024-11-14 08:55:06', '2024-11-14 08:55:06', 18000000),
(3, 3, 'iPad Gen 10 10.9 inch 2022 Wifi 64GB I Chính hãng Apple Việt Nam', 26, 1500000, 17, 'img/ipad-10-9-inch-2022.webp', 0, 'iPhone 15 Plus được đánh giá cao bởi màn hình Dynamic Island 6.7 inch với mặt kính lưng pha màu  ấn tượng, chip A16 Bionic  mạnh mẽ cùng cổng sạc USB-C  cho khả năng sạc đầy nhanh chóng. Ngoài ra, phiên bản Plus thuộc series iPhone 15 còn sở hữu 5 phiên bản màu pastel  thanh lịch phù hợp với nhiều đối tượng khách hàng: hồng, vàng, xanh lá, xanh dương, đen. Xem thêm các thông tin hữu ích khác về điện thoại iPhone 15 Plus sau đây!', 'Trải nghiệm đỉnh cao với hiệu năng mạnh mẽ từ vi xử lý tân tiến, kết hợp cùng RAM 12GB cho khả năng đa nhiệm mượt mà.\r\nLưu trữ thoải mái mọi ứng dụng, hình ảnh và video với bộ nhớ trong 256GB.\r\nNâng tầm nhiếp ảnh di động với hệ thống camera tiên tiến, cho ra đời những bức ảnh và video chất lượng chuyên nghiệp.', '2024-11-14 08:55:06', '2024-11-14 08:55:06', 13000000),
(4, 1, 'iPhone 14 128GB  | Chính hãng VN/A', 1, 15000000, 10, 'img/1731608844-iphone-15-plus_1__1.webp', 0, 'iPhone 15 Pro Max thu hút với màn hình Super Retina XDR 6.7 inch sắc nét, mặt lưng titanium bền bỉ và thiết kế viền mỏng tinh tế. Được trang bị chip A17 Pro mạnh mẽ, iPhone 15 Pro Max mang lại hiệu suất vượt trội cho mọi tác vụ nặng. Điểm nhấn của thiết bị là cổng sạc USB-C và tính năng sạc nhanh hiện đại. Phiên bản này có 4 màu đẳng cấp: titan tự nhiên, titan xanh, titan đen và titan trắng. Xem thêm các thông tin chi tiết khác về iPhone 15 Pro Max ngay sau đây!', 'Trải nghiệm đỉnh cao với hiệu năng mạnh mẽ từ vi xử lý tân tiến, kết hợp cùng RAM 12GB cho khả năng đa nhiệm mượt mà.\r\nLưu trữ thoải mái mọi ứng dụng, hình ảnh và video với bộ nhớ trong 256GB.\r\nNâng tầm nhiếp ảnh di động với hệ thống camera tiên tiến, cho ra đời những bức ảnh và video chất lượng chuyên nghiệp.', '2024-11-14 18:27:24', '2024-11-14 18:27:24', 12000000),
(5, 1, 'iPhone 14 128GB  | Chính hãng VN/A', 1, 15000000, 10, 'img/1731641547-iphone-15-pro-max_3.webp', 0, 'kncnciqncqwc', 'cjwcjwqbcwjqicnqw', '2024-11-15 03:32:27', '2024-11-15 03:32:27', 12000000);

-- --------------------------------------------------------

--
-- Table structure for table `riviews`
--

CREATE TABLE `riviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL COMMENT '1 đến 5',
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'client'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `size_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img_slider` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thumbnail`
--

CREATE TABLE `thumbnail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `role_id`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Hoàn', 'hoan@gmail.com', '123456', NULL, 1, '', '0344487493', '2024-11-08 08:52:38', '2024-11-08 14:58:26'),
(4, 'Quốc Hoàn', 'hoan1@gmail.com', '12345678', 'users/1731159513-cat-1.jpg', 2, '', '0344487493', '2024-11-08 16:32:21', '2024-11-08 18:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE `variant` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `variant_price` int(11) NOT NULL,
  `variant_img` varchar(255) NOT NULL,
  `variant_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_brands_categories` (`category_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `riviews`
--
ALTER TABLE `riviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `thumbnail`
--
ALTER TABLE `thumbnail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `variant`
--
ALTER TABLE `variant`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `size_id` (`size_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `riviews`
--
ALTER TABLE `riviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thumbnail`
--
ALTER TABLE `thumbnail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD CONSTRAINT `bill_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `bill_detail_ibfk_2` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`);

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `FK_brands_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);

--
-- Constraints for table `riviews`
--
ALTER TABLE `riviews`
  ADD CONSTRAINT `riviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `riviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `thumbnail`
--
ALTER TABLE `thumbnail`
  ADD CONSTRAINT `thumbnail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Constraints for table `variant`
--
ALTER TABLE `variant`
  ADD CONSTRAINT `variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `variant_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
  ADD CONSTRAINT `variant_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
