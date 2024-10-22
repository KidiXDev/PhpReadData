-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Okt 2024 pada 11.55
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(10) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `harga` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `jumlah`, `harga`) VALUES
(1, 'Laptop', 10, 15000000),
(2, 'Kamera', 5, 8000000),
(3, 'Smartphone', 20, 5000000),
(4, 'Tablet', 15, 3000000),
(5, 'Headphone', 30, 1000000),
(6, 'Printer', 8, 2500000),
(7, 'Keyboard', 25, 500000),
(8, 'Mouse', 40, 300000),
(9, 'Monitor', 12, 4000000),
(10, 'Router', 18, 700000),
(11, 'Flashdisk 16GB', 50, 200000),
(12, 'Hard Disk 1TB', 25, 900000),
(13, 'SSD 256GB', 30, 1200000),
(14, 'Webcam', 22, 600000),
(15, 'Speaker', 15, 800000),
(16, 'Projector', 4, 20000000),
(17, 'Power Bank 10000mAh', 40, 300000),
(18, 'Charger Laptop', 35, 400000),
(19, 'Smartwatch', 14, 2000000),
(20, 'External DVD Drive', 10, 500000),
(21, 'Graphics Card', 7, 6000000),
(22, 'Motherboard', 6, 3000000),
(23, 'RAM 8GB', 15, 1000000),
(24, 'CPU Cooler', 20, 700000),
(25, 'Case PC', 12, 600000),
(26, 'Gaming Mouse', 18, 400000),
(27, 'Gaming Keyboard', 15, 750000),
(28, 'Wireless Mouse', 30, 350000),
(29, 'USB Hub', 50, 150000),
(30, 'Microphone', 8, 1200000),
(31, 'Laptop Stand', 25, 250000),
(32, 'Cable Organizer', 40, 100000),
(33, 'Laptop Bag', 15, 300000),
(34, 'HDMI Cable', 60, 100000),
(35, 'VGA Cable', 50, 80000),
(36, 'Ethernet Cable', 70, 150000),
(37, 'Surge Protector', 10, 400000),
(38, 'Screen Protector', 20, 200000),
(39, 'Wireless Adapter', 12, 500000),
(40, 'Bluetooth Speaker', 9, 1500000),
(41, 'Tablet Stand', 14, 150000),
(42, 'Portable Charger', 30, 350000),
(43, 'Camera Tripod', 8, 600000),
(44, 'Drone', 5, 2500000),
(45, 'Game Controller', 20, 300000),
(46, 'SD Card 64GB', 40, 250000),
(47, 'Virtual Reality Headset', 3, 3000000),
(48, 'Fitness Tracker', 12, 1500000),
(49, 'Photo Printer', 6, 4000000),
(50, 'Smart TV', 4, 8000000),
(51, 'Wired Headset', 25, 600000),
(52, 'Digital Camera', 7, 6000000),
(53, 'Portable Speaker', 18, 700000),
(54, 'Action Camera', 5, 2000000),
(55, 'Wireless Earbuds', 30, 800000),
(56, 'Bluetooth Adapter', 22, 250000),
(57, 'Game Console', 6, 4500000),
(58, 'Laser Printer', 4, 5000000),
(59, 'Color Printer', 3, 3500000),
(60, 'Photobook Printer', 2, 4500000),
(61, 'USB Microphone', 12, 750000),
(62, 'Ring Light', 15, 900000),
(63, 'Studio Headphones', 10, 1200000),
(64, 'Graphic Tablet', 8, 1800000),
(65, 'Laptop Cooling Pad', 20, 400000),
(66, 'Cable Management Box', 30, 250000),
(67, 'WiFi Extender', 14, 600000),
(68, 'Smart Light Bulb', 35, 150000),
(69, 'Smart Plug', 28, 200000),
(70, 'Action Figure', 50, 300000),
(71, 'Board Game', 22, 400000),
(72, 'Puzzle', 18, 200000),
(73, 'Card Game', 40, 100000),
(74, 'Drawing Pad', 25, 300000),
(75, 'Coloring Book', 30, 150000),
(76, 'Crayons', 50, 50000),
(77, 'Marker Set', 40, 300000),
(78, 'Sketchbook', 35, 150000),
(79, 'Paint Set', 18, 600000),
(80, 'Easel', 12, 1000000),
(81, 'Canvas', 20, 300000),
(82, 'Painting Brush', 25, 250000),
(83, 'Watercolor Set', 15, 700000),
(84, 'Acrylic Paint', 30, 800000),
(85, 'Oil Paint', 10, 1200000),
(86, 'Palettes', 40, 150000),
(87, 'Glitter', 25, 200000),
(88, 'Glue', 30, 50000),
(89, 'Tape', 50, 20000),
(90, 'Scissors', 45, 30000),
(91, 'Ruler', 55, 15000),
(92, 'Pencil Set', 60, 25000),
(93, 'Pen Set', 70, 50000),
(94, 'Notebook', 80, 100000),
(95, 'Sticky Notes', 90, 20000),
(96, 'Binder', 100, 50000),
(97, 'File Organizer', 40, 150000),
(98, 'Whiteboard', 30, 600000),
(99, 'Chalkboard', 20, 500000),
(100, 'Clock', 15, 250000),
(161, 'Corsair RM750', 8771, 2877000),
(411, 'Zotac GeForce RTX 4090', 411, 23999999),
(462, 'Samsung Evo 2TB', 3110, 2999999),
(918, 'Asrock z790 Steel Legend Wifi', 773, 9111000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=919;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
