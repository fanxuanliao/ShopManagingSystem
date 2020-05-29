-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2020 年 05 月 29 日 11:21
-- 伺服器版本： 10.3.15-MariaDB
-- PHP 版本： 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `db_final`
--

-- --------------------------------------------------------

--
-- 資料表結構 `commodity`
--

CREATE TABLE `commodity` (
  `commodity_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `category` varchar(16) CHARACTER SET utf8 NOT NULL,
  `cost` int(10) NOT NULL,
  `sell_price` int(10) NOT NULL,
  `factory_tax_id` int(8) NOT NULL,
  `user_ID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `commodity`
--

INSERT INTO `commodity` (`commodity_name`, `category`, `cost`, `sell_price`, `factory_tax_id`, `user_ID`) VALUES
('紅茶', '食品', 10, 25, 87654321, 32345678),
('耳機', '家電', 150, 300, 87654231, 12345678),
('耳機', '家電', 150, 300, 87654231, 32345678),
('草莓', '食品', 30, 50, 87654321, 12345678),
('草莓', '食品', 30, 50, 87654321, 22345678),
('菜刀', '生活雜物', 200, 500, 81234567, 12345678),
('菜刀', '生活雜物', 200, 500, 81234567, 22345678),
('蘋果', '食品', 10, 20, 87654321, 12345678),
('蘋果', '食品', 10, 20, 87654321, 22345678),
('蘋果', '食品', 10, 20, 87654321, 32345678),
('電擊棒', '家電', 200, 400, 87654231, 22345678),
('電擊棒', '家電', 200, 400, 87654231, 32345678),
('電風扇', '家電', 500, 700, 87654231, 12345678);

-- --------------------------------------------------------

--
-- 資料表結構 `cooperate`
--

CREATE TABLE `cooperate` (
  `user_ID` int(8) NOT NULL,
  `factory_ID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `cooperate`
--

INSERT INTO `cooperate` (`user_ID`, `factory_ID`) VALUES
(12345678, 81234567),
(12345678, 87654231),
(12345678, 87654321),
(22345678, 81234567),
(22345678, 87654231),
(22345678, 87654321),
(32345678, 81234567),
(32345678, 87654231),
(32345678, 87654321);

-- --------------------------------------------------------

--
-- 資料表結構 `customer_order`
--

CREATE TABLE `customer_order` (
  `order_number` int(8) NOT NULL,
  `customer_name` varchar(10) CHARACTER SET utf8 NOT NULL,
  `customer_phone` varchar(12) NOT NULL,
  `customer_address` varchar(100) CHARACTER SET utf8 NOT NULL,
  `accept_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `user_ID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `customer_order`
--

INSERT INTO `customer_order` (`order_number`, `customer_name`, `customer_phone`, `customer_address`, `accept_date`, `status`, `user_ID`) VALUES
(1, '客人A', '0987654321', '台北市xx區oo路1號', '2020-05-26', 0, 12345678),
(2, '客人B', '0978563412', '台北市xx區oo路2號', '2020-05-26', 0, 12345678),
(3, '客人C', '0935263718', '台北市xx區oo路3號', '2020-05-26', 0, 22345678),
(4, '客人D', '0983647124', '台北市xx區oo路4號', '2020-05-26', 0, 22345678),
(5, '客人E', '0957254717', '台北市xx區oo路5號', '2020-05-26', 0, 22345678),
(6, '客人F', '0917463811', '台北市xx區oo路6號', '2020-05-26', 0, 32345678),
(7, '客人G', '0975642325', '台北市xx區oo路7號', '2020-05-26', 0, 32345678);

-- --------------------------------------------------------

--
-- 資料表結構 `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `birthdate` date NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 NOT NULL,
  `position` varchar(10) CHARACTER SET utf8 NOT NULL,
  `user_ID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `employee`
--

INSERT INTO `employee` (`employee_id`, `name`, `birthdate`, `phone_number`, `address`, `position`, `user_ID`) VALUES
(1, '店員E', '1997-07-07', '0911234567', '台北市文山區oo路3號', '店員', 22345678),
(2, '店員C', '1993-03-03', '0912345678', '台北市文山區oo路5號', '店員', 32345678),
(3, '店員A', '1999-01-01', '0920123456', '台北市文山區oo路1號', '店員', 12345678),
(4, '店員Ｂ', '1990-01-01', '0930123456', '台北市文山區oo路4號', '店員', 22345678),
(5, '店員D', '1995-05-05', '0935124678', '台北市文山區oo路2號', '店長', 12345678);

-- --------------------------------------------------------

--
-- 資料表結構 `factory`
--

CREATE TABLE `factory` (
  `factory_tax_id` int(8) NOT NULL,
  `factory_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 NOT NULL,
  `contact_name` varchar(10) CHARACTER SET utf8 NOT NULL,
  `contact_phone` varchar(12) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `factory`
--

INSERT INTO `factory` (`factory_tax_id`, `factory_name`, `address`, `contact_name`, `contact_phone`) VALUES
(81234567, '上游C', '新北市xx區oo路3號', '聯絡人C', '0924135678'),
(87654231, '上游B', '新北市xx區oo路2號', '聯絡人B', '(02)87654321'),
(87654321, '上游A', '新北市xx區oo路1號', '聯絡人A', '0900345678');

-- --------------------------------------------------------

--
-- 資料表結構 `order_include`
--

CREATE TABLE `order_include` (
  `user_ID` int(8) NOT NULL,
  `order_number` int(8) NOT NULL,
  `com_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `order_include`
--

INSERT INTO `order_include` (`user_ID`, `order_number`, `com_name`, `amount`) VALUES
(32345678, 7, '紅茶', 30),
(12345678, 1, '草莓', 20),
(22345678, 3, '草莓', 10),
(22345678, 5, '草莓', 40),
(12345678, 1, '菜刀', 1),
(22345678, 4, '菜刀', 2),
(12345678, 1, '蘋果', 10),
(22345678, 3, '蘋果', 20),
(32345678, 7, '蘋果', 20),
(22345678, 4, '電擊棒', 1),
(12345678, 2, '電風扇', 3);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `tax_id` int(8) NOT NULL,
  `shop_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`tax_id`, `shop_name`, `password`) VALUES
(12345678, 'shop1', '4a7d1ed414474e4033ac29ccb8653d9b'),
(22345678, 'shop2', '4a7d1ed414474e4033ac29ccb8653d9b'),
(32345678, 'shop3', '4a7d1ed414474e4033ac29ccb8653d9b');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `commodity`
--
ALTER TABLE `commodity`
  ADD PRIMARY KEY (`commodity_name`,`factory_tax_id`,`user_ID`) USING BTREE,
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `factory_tax_id` (`factory_tax_id`);

--
-- 資料表索引 `cooperate`
--
ALTER TABLE `cooperate`
  ADD PRIMARY KEY (`user_ID`,`factory_ID`),
  ADD KEY `cooperate_ibfk_2` (`factory_ID`);

--
-- 資料表索引 `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`order_number`,`user_ID`) USING BTREE,
  ADD KEY `user_ID` (`user_ID`);

--
-- 資料表索引 `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`,`user_ID`) USING BTREE,
  ADD KEY `employee_ibfk_1` (`user_ID`);

--
-- 資料表索引 `factory`
--
ALTER TABLE `factory`
  ADD PRIMARY KEY (`factory_tax_id`);

--
-- 資料表索引 `order_include`
--
ALTER TABLE `order_include`
  ADD PRIMARY KEY (`com_name`,`user_ID`,`order_number`) USING BTREE,
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `order_number` (`order_number`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`tax_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `order_number` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `commodity`
--
ALTER TABLE `commodity`
  ADD CONSTRAINT `commodity_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`tax_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commodity_ibfk_2` FOREIGN KEY (`factory_tax_id`) REFERENCES `cooperate` (`factory_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `cooperate`
--
ALTER TABLE `cooperate`
  ADD CONSTRAINT `cooperate_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`tax_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cooperate_ibfk_2` FOREIGN KEY (`factory_ID`) REFERENCES `factory` (`factory_tax_id`) ON UPDATE CASCADE;

--
-- 資料表的限制式 `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`tax_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`tax_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `order_include`
--
ALTER TABLE `order_include`
  ADD CONSTRAINT `order_include_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`tax_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_include_ibfk_2` FOREIGN KEY (`order_number`) REFERENCES `customer_order` (`order_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_include_ibfk_3` FOREIGN KEY (`com_name`) REFERENCES `commodity` (`commodity_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
