-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 18 Μάη 2020 στις 17:30:32
-- Έκδοση διακομιστή: 10.4.11-MariaDB
-- Έκδοση PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `eshop`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `product_name` varchar(40) DEFAULT NULL,
  `product_code` varchar(20) DEFAULT NULL,
  `quantity` varchar(535) DEFAULT NULL,
  `product_price` float DEFAULT NULL,
  `fullname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `address` varchar(40) NOT NULL,
  `payment` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `user_id`, `datetime`, `product_name`, `product_code`, `quantity`, `product_price`, `fullname`, `email`, `country`, `city`, `address`, `payment`) VALUES
(1, 2, '2020-05-18 17:18:34', 'Nikon D3500', '12casd3', '1', 534, 'George Kainos', 'georgek@gmail.com', 'Greece', 'Athens', 'Botsari 37', 'cash'),
(2, 2, '2020-05-18 17:20:13', 'Luxury Ultra thin Wrist Watch', 'wristWear03', '2', 220, 'George Kainos', 'georgek@gmail.com', 'Greece', 'Athens', 'Botsari 37', 'bank'),
(3, 3, '2020-05-18 17:22:01', 'Asus Zen', '378op9', '1', 1200, 'Ismail Voutsani', 'ismail@gmail.com', 'India', 'New Delhi', 'Gatsbi 12', 'cash'),
(4, 3, '2020-05-18 17:22:01', 'EXP Portable Hard Drive', 'USB02', '1', 74, 'Ismail Voutsani', 'ismail@gmail.com', 'India', 'New Delhi', 'Gatsbi 12', 'cash'),
(5, 3, '2020-05-18 17:22:01', 'FinePix Pro2 3D Camera', '3DcAM01', '2', 1500, 'Ismail Voutsani', 'ismail@gmail.com', 'India', 'New Delhi', 'Gatsbi 12', 'cash'),
(7, 7, '2020-05-18 17:27:22', 'EXP Portable Hard Drive', 'USB02', '2', 74, 'Vaggelis Viglakis', 'vag@gmail.com', 'Greece', 'Salonika', 'Iktinou 9', 'bank');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `products`
--

CREATE TABLE `products` (
  `id` int(8) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `category` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `image` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `category`, `image`, `price`) VALUES
(1, 'FinePix Pro2 3D Camera', '3DcAM01', 'Camera', 'images/camera.jpg', 1500.00),
(2, 'EXP Portable Hard Drive', 'USB02', 'Disk Drive', 'images/external-hard-drive.jpg', 74.00),
(3, 'Luxury Ultra thin Wrist Watch', 'wristWear03', 'Smart Watch', 'images/watch.jpg', 220.00),
(4, 'XP 1155 Intel Core Laptop', 'LPN45', 'Desktop & Laptop', 'images/laptop.jpg', 800.00),
(5, 'Asus Zen', '378op9', 'Desktop & Laptop', 'images/laptop2.jpg', 1200.00),
(6, 'Nikon D3500', '12casd3', 'Camera', 'images/camera2.jpg', 534.00);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `role`) VALUES
(1, 'Admin', '1111', 'admin@gmail.com', 'admin'),
(2, 'George K.', '3333', 'georgek@gmail.com', ''),
(3, 'ismail', '1234', 'ismail@gmail.com', ''),
(4, 'leo', '12345', 'leo@gmail.com', ''),
(5, 'makis', '3333', 'makis@gmail.com', ''),
(6, 'kwst', '1', 'kwst@gmail.com', ''),
(7, 'Vaggelis V.', 'yo55', 'vag@gmail.com', '');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Ευρετήρια για πίνακα `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT για πίνακα `products`
--
ALTER TABLE `products`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
