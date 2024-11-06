-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2024 at 04:42 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_read_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `nama_barang` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` int NOT NULL,
  `harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `jumlah`, `harga`) VALUES
(0, 'Keyboard', 25, 500000),
(0, 'Flashdisk 16GB', 50, 200000),
(0, 'Hard Disk 1TB', 25, 900000),
(0, 'SSD 256GB', 30, 1200000),
(0, 'Webcam', 22, 600000),
(0, 'Speaker', 15, 800000),
(0, 'Projector', 4, 20000000),
(0, 'Power Bank 10000mAh', 40, 300000),
(0, 'Smartwatch', 14, 2000000),
(0, 'External DVD Drive', 10, 500000),
(0, 'Graphics Card', 7, 6000000),
(0, 'Motherboard', 6, 3000000),
(0, 'RAM 8GB', 15, 1000000),
(0, 'CPU Cooler', 20, 700000),
(0, 'Case PC', 12, 600000),
(0, 'Gaming Mouse', 18, 400000),
(0, 'Gaming Keyboard', 15, 750000),
(0, 'Wireless Mouse', 30, 350000),
(0, 'USB Hub', 50, 150000),
(0, 'Microphone', 8, 1200000),
(0, 'Laptop Stand', 25, 250000),
(0, 'Cable Organizer', 40, 100000),
(0, 'Laptop Bag', 15, 300000),
(0, 'HDMI Cable', 60, 100000),
(0, 'VGA Cables', 50, 80000),
(0, 'Surge Protector', 10, 400000),
(0, 'Screen Protector', 20, 200000),
(0, 'Wireless Adapter', 12, 500000),
(0, 'Bluetooth Speaker', 9, 1500000),
(0, 'Tablet Stand', 14, 150000),
(0, 'Portable Charger', 30, 350000),
(0, 'Camera Tripod', 8, 600000),
(0, 'Game Controller', 20, 300000),
(0, 'SD Card 64GB', 40, 250000),
(0, 'Virtual Reality Headset', 3, 3000000),
(0, 'Fitness Tracker', 12, 1500000),
(0, 'Photo Printer', 6, 4000000),
(0, 'Smart TV', 4, 8000000),
(0, 'Wired Headset', 25, 600000),
(0, 'Digital Camera', 7, 6000000),
(0, 'Portable Speaker', 18, 700000),
(0, 'Action Camera', 5, 2000000),
(0, 'Wireless Earbuds', 30, 800000),
(0, 'Bluetooth Adapter', 22, 250000),
(0, 'Game Console', 6, 4500000),
(0, 'Laser Printer', 4, 5000000),
(0, 'Color Printer', 3, 3500000),
(0, 'Photobook Printer', 2, 4500000),
(0, 'USB Microphone', 12, 750000),
(0, 'Ring Light', 15, 900000),
(0, 'Studio Headphones', 10, 1200000),
(0, 'Graphic Tablet', 8, 1800000),
(0, 'Laptop Cooling Pad', 20, 400000),
(0, 'WiFi Extender', 14, 600000),
(0, 'Smart Light Bulb', 35, 150000),
(0, 'Smart Plug', 28, 200000),
(0, 'Action Figure', 50, 300000),
(0, 'Board Game', 22, 400000),
(0, 'Puzzle', 18, 200000),
(0, 'Card Game', 40, 100000),
(0, 'Drawing Pad', 25, 300000),
(0, 'Coloring Book', 30, 150000),
(0, 'Crayons', 50, 50000),
(0, 'Marker Set', 40, 300000),
(0, 'Sketchbook', 35, 150000),
(0, 'Paint Set', 18, 600000),
(0, 'Easel', 12, 1000000),
(0, 'Canvas', 20, 300000),
(0, 'Painting Brush', 25, 250000),
(0, 'Watercolor Set', 15, 700000),
(0, 'Acrylic Paint', 30, 800000),
(0, 'Oil Paint', 10, 1200000),
(0, 'Palettes', 40, 150000),
(0, 'Glitter', 25, 200000),
(0, 'Glue', 30, 50000),
(0, 'Tape', 50, 20000),
(0, 'Scissors', 45, 30000),
(0, 'Pencil Set', 60, 25000),
(0, 'Notebook', 80, 100000),
(0, 'Sticky Notes', 90, 20000),
(0, 'Binder', 100, 50000),
(0, 'File Organizer', 40, 150000),
(0, 'Whiteboard', 30, 600000),
(0, 'Chalkboard', 20, 500000),
(0, 'Clock', 15, 250000),
(0, 'Corsair RM750', 8771, 2877000),
(0, 'Zotac GeForce RTX 4090', 411, 23999999),
(0, 'Samsung Evo 2TB', 3110, 2999999),
(0, 'Asrock z790 Steel Legend Wifi', 773, 9111000),
(0, 'VGA Card High-End RTX 2080', 7322, 24999000);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Useradmin', '$2y$10$qRRibBMGw54cwpXVYcjjtOm.qQ5TSB.5zf7yE7a0LG5nTmLMzUETm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_id` (`session_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20017;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
