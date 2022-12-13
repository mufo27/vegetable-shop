-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2022 at 05:43 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vegetable_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL COMMENT 'รหัส',
  `user` varchar(50) NOT NULL COMMENT 'ีusername',
  `pass` varchar(50) NOT NULL COMMENT 'password',
  `pkname` varchar(50) NOT NULL COMMENT 'คำนำหน้า',
  `fname` varchar(250) NOT NULL COMMENT 'ชื่อ',
  `lname` varchar(250) NOT NULL COMMENT 'นามสกุล',
  `phone` varchar(10) DEFAULT NULL COMMENT 'เบอร์โทร',
  `email` varchar(250) DEFAULT NULL COMMENT 'อีเมล',
  `address` varchar(1000) DEFAULT NULL COMMENT 'ที่อยู่',
  `status` int(11) NOT NULL COMMENT 'สถานะ 0=admin 1=เกษตกร 2=ลูกค้า',
  `save_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาบันทึก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `user`, `pass`, `pkname`, `fname`, `lname`, `phone`, `email`, `address`, `status`, `save_time`) VALUES
(1, 'admin', '123', 'Mr', 'Super', 'Admin', NULL, NULL, NULL, 0, '2022-11-22 04:47:53'),
(3, 'ctm', '111', 'Mr', 'Cus', 'Tomer', NULL, NULL, NULL, 2, '2022-11-22 04:49:44'),
(4, 'farmer', '123', 'Mr', 'far', 'mer', NULL, NULL, NULL, 1, '2022-11-22 06:52:59'),
(6, 'udru', '111', 'นาย', 'Watcharapong', 'kaewphila', '0955845863', NULL, NULL, 2, '2022-11-22 08:42:47'),
(7, 'ss', '555', 'mr', 'fff', 'ccc', '0989193248', NULL, NULL, 1, '2022-11-22 08:43:52'),
(8, 'picha', '111', 'น.ส.', 'พิชา', 'มาตอย', '0854476649', 'picha@gmail.com', NULL, 1, '2022-11-23 06:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL COMMENT 'รหัส',
  `name` varchar(250) NOT NULL COMMENT 'หมวดหมู่',
  `img` varchar(250) NOT NULL COMMENT 'รูปภาพ',
  `save_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาที่บันทึก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `img`, `save_time`) VALUES
(4, 'ผักสด', 'ty_1669109796.png', '2022-11-22 07:13:07'),
(9, 'ผลไม้สด', 'ty_1669109665.png', '2022-11-22 09:34:24'),
(10, 'เนื้อสัตว์', 'ty_1669110021.png', '2022-11-22 09:40:20'),
(11, 'อาหารแห้ง', 'ty_1669110033.png', '2022-11-22 09:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'รหัส',
  `code` varchar(250) NOT NULL COMMENT 'โค้ด order',
  `account_id` int(11) NOT NULL COMMENT 'รหัส account',
  `total_price` float NOT NULL COMMENT 'ราคารวม',
  `payment_status` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะชำระเงิน',
  `send_status` int(11) NOT NULL COMMENT 'สถานะการจัดส่ง',
  `save_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาบันทึก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL COMMENT 'รหัส',
  `product_id` int(11) NOT NULL COMMENT 'รหัส product',
  `number` float NOT NULL COMMENT 'จำนวนสินค้า',
  `price` float NOT NULL COMMENT 'ราคาสินค้า',
  `save_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาบันทึก',
  `orders_id` int(11) NOT NULL COMMENT 'รหัส order'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `name` varchar(250) NOT NULL COMMENT 'ชื่อสินค้า',
  `qty` int(11) NOT NULL COMMENT 'จำนวนสินค้า',
  `unit` varchar(50) DEFAULT NULL COMMENT 'หน่วยนับ',
  `purchase_price` int(11) NOT NULL COMMENT 'ราคาซื้อสินค้า',
  `selling_price` int(11) NOT NULL COMMENT 'ราคาขายสินค้า',
  `img` varchar(250) DEFAULT NULL COMMENT 'รูปภาพ',
  `save_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาที่บันทึก',
  `category_id` int(11) NOT NULL COMMENT 'รหัส category'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `qty`, `unit`, `purchase_price`, `selling_price`, `img`, `save_time`, `category_id`) VALUES
(6, 'กระเจี๊ยบเขียว', 180, NULL, 5, 10, 'pr_1669104928.jpg', '2022-11-22 08:08:21', 4),
(8, 'ข้าวโพดดิบปอกเปลือก', 300, NULL, 20, 30, 'pr_1669104917.jpg', '2022-11-22 08:15:17', 4),
(9, 'ข้าวโพดอ่อนติดหมวก', 200, NULL, 10, 20, 'pr_1669104958.jpg', '2022-11-22 08:15:57', 4),
(10, 'ข้าวโพดอ่อนเปลือย', 150, NULL, 5, 10, 'pr_1669104981.jpg', '2022-11-22 08:16:21', 4),
(11, 'หมูบด A ปนมัน 5% ปลอดสาร', 10, NULL, 120, 150, 'pr_1669110130.jpg', '2022-11-22 09:42:10', 10),
(12, 'ปลานิลแดดเดียว 10 ตัวต่อ กก.', 10, NULL, 300, 350, 'pr_1669110199.jpg', '2022-11-22 09:43:18', 11),
(13, 'กล้วยไข่สุก 70% 13-18 ลูกต่อหวี', 100, NULL, 20, 50, 'pr_1669110243.jpg', '2022-11-22 09:44:02', 9),
(14, 'กล้วยน้ำว้าดิบ 13-18 ลูกต่อหวี', 40, NULL, 80, 120, 'pr_1669110265.jpg', '2022-11-22 09:44:24', 9),
(15, 'กล้วยหอมดิบ 12-16 ลูกต่อหวี', 150, NULL, 80, 100, 'pr_1669110287.jpg', '2022-11-22 09:44:47', 9),
(16, 'แก้วมังกร เนื้อสีขาว เบอร์-22', 140, NULL, 45, 80, 'pr_1669110307.jpg', '2022-11-22 09:45:07', 9),
(17, 'คอหมูสำหรับย่าง ยี่เอ้ง ตัดแต่ง ปลอดสาร', 150, NULL, 200, 250, 'pr_1669110433.jpg', '2022-11-22 09:47:12', 10),
(18, 'ซี่โครงหมูหั่นชิ้น', 300, NULL, 180, 250, 'pr_1669110469.jpg', '2022-11-22 09:47:48', 10),
(19, 'หมูสามชั้นแผ่นตัดแต่ง A ปลอดสาร', 200, NULL, 250, 300, 'pr_1669110506.jpg', '2022-11-22 09:48:26', 10),
(20, 'พริกขี้หนูแห้ง เด็ดก้าน', 300, NULL, 50, 80, 'pr_1669110610.jpg', '2022-11-22 09:50:10', 11),
(21, 'กุ้งแห้งเล็กใส่ส้มตำ-กิมฉุ่ยเล็ก', 250, NULL, 200, 300, 'pr_1669110649.jpg', '2022-11-22 09:50:49', 11),
(22, 'แคปหมูไร้มัน อย่างดี ห่อเล็ก', 500, NULL, 10, 20, 'pr_1669110686.jpg', '2022-11-22 09:51:25', 11);

-- --------------------------------------------------------

--
-- Table structure for table `product_img`
--

CREATE TABLE `product_img` (
  `id` int(11) NOT NULL,
  `img` varchar(250) NOT NULL,
  `pproduct_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_id` (`orders_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_img`
--
ALTER TABLE `product_img`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส';

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส';

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้า', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_img`
--
ALTER TABLE `product_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
