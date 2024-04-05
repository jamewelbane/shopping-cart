-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 09:57 AM
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
-- Database: `userdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `image_url`) VALUES
(1, 'Lenovo ThinkPad', 'Laptop', 19899.00, '../images/lenovo-1.jpg'),
(2, 'Office Chair', 'Chair', 1199.00, '../images/chair-2.jpg'),
(3, 'RTX 2060', 'GPU', 21299.00, '../images/gpu-3.jpg'),
(4, 'Onikuma Headset', 'Headset', 1999.00, '../images/headset-04.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_id`, `fullname`, `gender`, `email`, `password`, `username`) VALUES
(3294, 'Lazarena Pinote', 2, 'rena0410@gmail.com', '$2y$10$tbzInZQhbU.LvjzwYvw6IOqbFxkCMqAdIBiApFlgkPS8XmY3b2Tj2', 'rena0410'),
(4877, 'Luna Sumba', 2, 'luna24@gmail.com', '$2y$10$DvGJPMeaS78jP7WbEVWizO//FDCKNtKjI78hf.mGLLkepOgn/OgOe', 'luna24'),
(5531, 'Margelyn Librodo', 2, 'margelyn26@gmail.com', '$2y$10$V5hlmmACL4lzUPw4e243F.vQfSkJC56fq7ts80Xs.ATC2U81BdCTS', 'librodo26'),
(5900, 'Daniel Seget', 1, 'dan7824@gcs.cow', '$2y$10$mlGjai6.1YU46ZprQ.nn8eTG0m62Rg8E2R1XJzJ44PyPqEXWm1Jqq', 'dan241'),
(6045, 'asf', 1, 'saf@example.com', '$2y$10$7Eny/OCqNan0Q0xz1HoGOOGAqxbgTDPK0mqfM2MowxiOwqFUccThi', 'saf'),
(11072, 'Jamewel Bane', 1, 'bjamewel29@gmail.com', '$2y$10$WpMigK7r7n53aLhbQovo.uqPJzBhpT.yAEiHjv8eID8F.8Mn.7gou', 'jame29'),
(11459, 'Bryan Bane', 1, 'bryan12@gmail.com', '$2y$10$GlYF4oQ4xMzBhnJ5jUHQy.AkFCHTgIwfsrgicOuUG8jh9a4LBeOPu', 'bryan12'),
(16953, 'Rogean Full', 2, 'rogean24@gmail.com', '$2y$10$SdUcxf/ZkBDJVUlhEEHp0.fHuacKoIsolD9wVwn0ih6DFLsOeg8SG', 'rogean24'),
(18549, 'Roger Goldys', 2, 'rogergold21251@gmail.coms', '$2y$10$xjwM1LWn7h8sZyhFHfJE2.n6VCwqGIsh0HS/60mexqQGBSmAvhB6e', 'rogergold21251'),
(27376, 'Andrew Gulapa', 3, 'gulaps254@gmail.com', '$2y$10$KHnX5J1j1t/hrNZho3qwkOsOKgXnapHT5ADWpfr0FZAJExEXXhWxG', 'gulaps254'),
(30503, 'Carlo Lopes', 1, 'carlol666@gmail.com', '$2y$10$HS5.aKkJCgmJOGmBHvQwOOM.OsGneNoYI.OnAvk152poZF6s2Uu96', 'carlol666'),
(44371, 'Miley Cyrus', 3, 'miley23@gmail.com', '$2y$10$ZZ9sqRRWQeDfG7RA4GjVFOr8pwW6AM2sFHjiyUqdO.6CvJxTYXju2', 'miley23'),
(73363, 'Dereck Korpuz', 3, 'dereck000@gmail.com', '$2y$10$46yL4v25EbTMgSquLAT08.qAbiXCwtNO1pnB55T/2k7nKkDn/HZiy', 'dereck000'),
(76249, 'Dandan Sold', 1, 'dandansoy24@gmail.com', '$2y$10$Xbvw7OTLge8RhEJPROkvNuyj/f8WQwoqRQH/V/z82Y/OJXWz6OFDG', 'dandansoy24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_cart_product` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76250;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_account` (`user_id`),
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
