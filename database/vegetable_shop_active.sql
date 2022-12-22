-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2022 at 11:26 AM
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
-- Database: `vegetable_shop_active`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL COMMENT 'รหัส',
  `phone` varchar(10) NOT NULL COMMENT 'เบอร์โทร',
  `user` varchar(50) NOT NULL COMMENT 'username',
  `pass` varchar(50) NOT NULL COMMENT 'password',
  `status` int(11) DEFAULT NULL COMMENT 'สถานะ 0=admin 1=เกษตกร 2=ลูกค้า',
  `pkname` varchar(50) DEFAULT NULL COMMENT 'คำนำหน้า',
  `fname` varchar(250) DEFAULT NULL COMMENT 'ชื่อ',
  `lname` varchar(250) DEFAULT NULL COMMENT 'นามสกุล',
  `email` varchar(250) DEFAULT NULL COMMENT 'อีเมล',
  `address` varchar(2500) DEFAULT NULL COMMENT 'ที่อยู่',
  `save_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาบันทึก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `phone`, `user`, `pass`, `status`, `pkname`, `fname`, `lname`, `email`, `address`, `save_time`) VALUES
(1, '0989195248', 'admin', '123', 0, 'นาย', 'ศักดา', 'เหล่าจันอัน', 'ning@gmail.com', 'อ.นากลาง จ.หนองบัวลำภู                                                                                                                                                   ', '2022-11-22 04:47:53'),
(6, '0955845863', 'ctm-1', '123', 2, 'นาย', 'วัชรพงศ์', 'แก้วพิลา', 'watcharapongmufo27@gmail.com', '105/12 บ้านสามพร้าว ตำบลสามพร้าว อำเภอเมือง จังหวัดอุดรธานี 41000', '2022-11-22 08:42:47'),
(8, '0854476649', 'frm', '123', 1, 'น.ส.', 'พิชา', 'มาตอย', 'picha@gmail.com', '64 ถนน ทหาร ตำบลหมากแข้ง เมือง อุดรธานี 41000', '2022-11-23 06:51:33'),
(65, '0645521996', 'ctm-2', '123', 2, 'นางสาว', 'ปิยฉัตร', 'โชติแท้', 'cherry@gmail.com', '12354', '2022-12-19 06:54:32');

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
(19, 'หัวราก', 'ctg_1671511371.png', '2022-12-20 04:42:50'),
(20, 'ผลักสลัด', 'ctg_1671511407.png', '2022-12-20 04:43:26'),
(21, 'เห็ด', 'ctg_1671511420.png', '2022-12-20 04:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'รหัส',
  `account_id` int(11) NOT NULL COMMENT 'รหัส account',
  `code` varchar(250) NOT NULL COMMENT 'โค้ด order',
  `total` float NOT NULL COMMENT 'ราคารวม',
  `save_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาบันทึก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `account_id`, `code`, `total`, `save_time`) VALUES
(1, 65, '741856341', 82500, '2022-12-20 07:09:11'),
(3, 6, '13456852', 20000, '2022-12-20 07:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `orders_buy`
--

CREATE TABLE `orders_buy` (
  `id` int(11) NOT NULL COMMENT 'รหัส',
  `account_id` int(11) NOT NULL COMMENT 'รหัส account',
  `code` varchar(250) NOT NULL COMMENT 'โค้ด order',
  `total` float NOT NULL COMMENT 'ราคารวม',
  `save_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาบันทึก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_buy`
--

INSERT INTO `orders_buy` (`id`, `account_id`, `code`, `total`, `save_time`) VALUES
(1, 65, '741856341', 82500, '2022-12-20 07:09:11'),
(3, 6, '13456852', 20000, '2022-12-20 07:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `order_buy_details`
--

CREATE TABLE `order_buy_details` (
  `id` int(11) NOT NULL COMMENT 'รหัส',
  `product_id` int(11) NOT NULL COMMENT 'รหัส product',
  `number` float NOT NULL COMMENT 'จำนวนสินค้า',
  `price` float NOT NULL COMMENT 'ราคาสินค้า',
  `save_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาบันทึก',
  `orders_buy_id` int(11) NOT NULL COMMENT 'รหัส orders_buy'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_buy_details`
--

INSERT INTO `order_buy_details` (`id`, `product_id`, `number`, `price`, `save_time`, `orders_buy_id`) VALUES
(1, 31, 200, 50, '2022-12-20 19:39:40', 3),
(2, 29, 100, 100, '2022-12-20 19:39:40', 3),
(6, 30, 250, 150, '2022-12-20 19:41:03', 1),
(7, 28, 200, 150, '2022-12-20 19:41:03', 1),
(8, 31, 300, 50, '2022-12-20 19:41:03', 1);

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

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `product_id`, `number`, `price`, `save_time`, `orders_id`) VALUES
(1, 31, 200, 50, '2022-12-20 19:39:40', 3),
(2, 29, 100, 100, '2022-12-20 19:39:40', 3),
(6, 30, 250, 150, '2022-12-20 19:41:03', 1),
(7, 28, 200, 150, '2022-12-20 19:41:03', 1),
(8, 31, 300, 50, '2022-12-20 19:41:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `code` varchar(250) NOT NULL,
  `status` enum('ยังไม่ชำระเงิน','ชำระเงินแล้ว') NOT NULL DEFAULT 'ยังไม่ชำระเงิน',
  `total` float DEFAULT NULL,
  `form` enum('-','เงินสด','พร้อมเพย์','โอนผ่านธนาคาร') NOT NULL DEFAULT '-',
  `img` varchar(2500) DEFAULT NULL,
  `save_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `confrim_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `orders_id`, `code`, `status`, `total`, `form`, `img`, `save_time`, `confrim_time`) VALUES
(1, 3, '85221263', 'ยังไม่ชำระเงิน', 88, '-', NULL, '2022-12-20 08:59:33', '2022-12-22 09:21:49'),
(2, 1, '45678912', 'ชำระเงินแล้ว', 1500, 'พร้อมเพย์', 'pay_1671700740.jpg', '2022-12-20 09:09:58', '2022-12-22 09:18:59');

-- --------------------------------------------------------

--
-- Table structure for table `payment_buy`
--

CREATE TABLE `payment_buy` (
  `id` int(11) NOT NULL,
  `orders_buy_id` int(11) NOT NULL,
  `code` varchar(250) NOT NULL,
  `status` enum('ยังไม่ชำระเงิน','ชำระเงินแล้ว') NOT NULL DEFAULT 'ยังไม่ชำระเงิน',
  `total` float DEFAULT NULL,
  `form` enum('-','เงินสด','พร้อมเพย์','โอนผ่านธนาคาร') NOT NULL DEFAULT '-',
  `img` varchar(2500) DEFAULT NULL,
  `save_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `confrim_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_buy`
--

INSERT INTO `payment_buy` (`id`, `orders_buy_id`, `code`, `status`, `total`, `form`, `img`, `save_time`, `confrim_time`) VALUES
(1, 3, '85221263', 'ยังไม่ชำระเงิน', NULL, '-', NULL, '2022-12-20 08:59:33', '2022-12-22 02:12:17'),
(2, 1, '45678912', 'ชำระเงินแล้ว', 1500, 'เงินสด', 'pay_1671700624.jpg', '2022-12-20 09:09:58', '2022-12-22 09:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `name` varchar(250) NOT NULL COMMENT 'ชื่อสินค้า',
  `category_id` int(11) NOT NULL COMMENT 'รหัส category',
  `detail` varchar(2500) NOT NULL,
  `qty` int(11) NOT NULL COMMENT 'จำนวนสินค้า',
  `unit` varchar(50) DEFAULT NULL COMMENT 'หน่วยนับ',
  `price_buy` float DEFAULT NULL,
  `price_sell` float DEFAULT NULL,
  `status_buy` enum('ปิด','เปิด') NOT NULL DEFAULT 'ปิด',
  `status_sell` enum('ปิด','เปิด') NOT NULL DEFAULT 'ปิด',
  `save_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาที่บันทึก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `detail`, `qty`, `unit`, `price_buy`, `price_sell`, `status_buy`, `status_sell`, `save_time`) VALUES
(28, 'หัวไชเท้า คละขนาด เจ๊หงส์ส่งผัก', 19, 'หัวไชเท้า คละขนาด เจ๊หงส์ส่งผัก', 10, 'แพ็ค', 100, 150, 'ปิด', 'ปิด', '2022-12-20 04:51:31'),
(29, 'มันฝรั่ง คละขนาด ขนาด 3-10 หัว/กก.', 19, 'มันฝรั่ง คละขนาด ขนาด 3-10 หัว/กก.', 50, 'แพ็ค', 50, 100, 'ปิด', 'เปิด', '2022-12-20 04:55:49'),
(30, 'หัวไชเท้า ขนาดกลาง คัดตัดแต่ง', 19, 'หัวไชเท้า ขนาดกลาง คัดตัดแต่ง', 20, 'หัว', 200, 250, 'ปิด', 'เปิด', '2022-12-20 04:59:04'),
(31, 'คอส คัดตัดแต่ง', 20, 'คอส คัดตัดแต่ง', 5, 'แพ็ค', 40, 50, 'ปิด', 'เปิด', '2022-12-20 06:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_img`
--

CREATE TABLE `product_img` (
  `id` int(11) NOT NULL,
  `img` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `product_id` int(11) NOT NULL,
  `save_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_img`
--

INSERT INTO `product_img` (`id`, `img`, `name`, `product_id`, `save_time`) VALUES
(8, 'img_1671512041.png', 'img-1', 28, '2022-12-20 04:52:56'),
(10, 'img_1671512070.png', 'img-2', 28, '2022-12-20 04:54:30'),
(11, 'img_1671512208.png', 'img-1', 29, '2022-12-20 04:56:47'),
(12, 'img_1671512220.png', 'img-2', 29, '2022-12-20 04:56:59'),
(13, 'img_1671515435.png', 'img-1', 30, '2022-12-20 05:50:35'),
(14, 'img_1671515445.png', 'img-2', 30, '2022-12-20 05:50:44'),
(15, 'img_1671517204.png', 'img-1', 31, '2022-12-20 06:20:04'),
(16, 'img_1671517213.png', 'img-2', 31, '2022-12-20 06:20:12'),
(17, 'img_1671517222.png', 'img-3', 31, '2022-12-20 06:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `send`
--

CREATE TABLE `send` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `code` varchar(250) NOT NULL,
  `status` enum('ยังไม่จัดส่ง','รอการจัดส่ง','จัดส่งแล้ว') NOT NULL DEFAULT 'ยังไม่จัดส่ง',
  `account_id` varchar(250) DEFAULT NULL,
  `save_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `send`
--

INSERT INTO `send` (`id`, `orders_id`, `code`, `status`, `account_id`, `save_time`, `update_time`) VALUES
(1, 3, '96378962', 'ยังไม่จัดส่ง', NULL, '2022-12-20 09:09:11', '2022-12-22 04:42:17'),
(2, 1, '21654985', 'ยังไม่จัดส่ง', '', '2022-12-20 16:45:00', '2022-12-22 08:45:14');

-- --------------------------------------------------------

--
-- Table structure for table `send_buy`
--

CREATE TABLE `send_buy` (
  `id` int(11) NOT NULL,
  `orders_buy_id` int(11) NOT NULL,
  `code` varchar(250) NOT NULL,
  `status` enum('ยังไม่จัดส่ง','รอการจัดส่ง','จัดส่งแล้ว') NOT NULL DEFAULT 'ยังไม่จัดส่ง',
  `account_id` varchar(250) DEFAULT NULL,
  `save_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `send_buy`
--

INSERT INTO `send_buy` (`id`, `orders_buy_id`, `code`, `status`, `account_id`, `save_time`, `update_time`) VALUES
(1, 3, '96378962', 'ยังไม่จัดส่ง', NULL, '2022-12-20 09:09:11', '2022-12-22 04:42:17'),
(2, 1, '21654985', 'รอการจัดส่ง', '65', '2022-12-20 16:45:00', '2022-12-22 08:42:43');

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
-- Indexes for table `orders_buy`
--
ALTER TABLE `orders_buy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `order_buy_details`
--
ALTER TABLE `order_buy_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`,`orders_buy_id`),
  ADD KEY `orders_buy_id` (`orders_buy_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_id` (`orders_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_id` (`orders_id`);

--
-- Indexes for table `payment_buy`
--
ALTER TABLE `payment_buy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_buy_id` (`orders_buy_id`),
  ADD KEY `orders_buy_id_2` (`orders_buy_id`);

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
-- Indexes for table `send`
--
ALTER TABLE `send`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_id` (`orders_id`);

--
-- Indexes for table `send_buy`
--
ALTER TABLE `send_buy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_buy_id` (`orders_buy_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders_buy`
--
ALTER TABLE `orders_buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_buy_details`
--
ALTER TABLE `order_buy_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_buy`
--
ALTER TABLE `payment_buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้า', AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_img`
--
ALTER TABLE `product_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `send`
--
ALTER TABLE `send`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `send_buy`
--
ALTER TABLE `send_buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `orders_buy`
--
ALTER TABLE `orders_buy`
  ADD CONSTRAINT `orders_buy_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `order_buy_details`
--
ALTER TABLE `order_buy_details`
  ADD CONSTRAINT `order_buy_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `order_buy_details_ibfk_2` FOREIGN KEY (`orders_buy_id`) REFERENCES `orders_buy` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `payment_buy`
--
ALTER TABLE `payment_buy`
  ADD CONSTRAINT `payment_buy_ibfk_1` FOREIGN KEY (`orders_buy_id`) REFERENCES `orders_buy` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `send`
--
ALTER TABLE `send`
  ADD CONSTRAINT `send_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `send_buy`
--
ALTER TABLE `send_buy`
  ADD CONSTRAINT `send_buy_ibfk_1` FOREIGN KEY (`orders_buy_id`) REFERENCES `orders_buy` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
