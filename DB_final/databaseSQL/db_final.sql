-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.4

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
('Android充電線', '生活雜物', 100, 200, 87654231, 22345678),
('iPhone充電線', '生活雜物', 300, 370, 87654231, 22345678),
('type-C充電線', '生活雜物', 150, 230, 87654231, 22345678),
('剪刀', '生活雜物', 30, 33, 56274696, 12345678),
('剪刀', '生活雜物', 35, 40, 81234567, 22345678),
('剪刀', '生活雜物', 35, 40, 81234567, 32345678),
('原味洋芋片', '食品', 30, 40, 56382067, 32345678),
('奶油餅乾', '食品', 50, 55, 56382067, 22345678),
('奶油餅乾', '食品', 45, 55, 56382067, 32345678),
('床墊', '生活雜物', 500, 600, 81234567, 32345678),
('彩色筆', '生活雜物', 200, 230, 56274696, 12345678),
('彩色筆', '生活雜物', 200, 260, 56274696, 32345678),
('檯燈', '家電', 500, 700, 81234567, 22345678),
('檯燈', '家電', 500, 650, 81234567, 32345678),
('水果乾', '食品', 40, 45, 87654321, 12345678),
('水果乾', '食品', 40, 60, 87654321, 22345678),
('水果刀', '生活雜物', 200, 300, 81234567, 12345678),
('水果刀', '生活雜物', 200, 270, 81234567, 22345678),
('海苔洋芋片', '食品', 30, 40, 56382067, 32345678),
('熨斗', '家電', 600, 700, 81234567, 12345678),
('熨斗', '家電', 600, 800, 81234567, 32345678),
('瓶裝水果茶', '食品', 25, 33, 68274927, 12345678),
('瓶裝水果茶', '食品', 30, 35, 68274927, 22345678),
('瓶裝烏龍茶', '食品', 23, 30, 68274927, 12345678),
('瓶裝紅茶', '食品', 23, 30, 68274927, 12345678),
('瓶裝紅茶', '食品', 23, 30, 87654231, 22345678),
('瓶裝綠茶', '食品', 23, 30, 68274927, 12345678),
('瓶裝綠茶', '食品', 23, 30, 68274927, 22345678),
('筆記本', '生活雜物', 40, 45, 56274696, 12345678),
('筆記本', '生活雜物', 40, 45, 56274696, 32345678),
('紅茶茶包', '食品', 300, 350, 68274927, 22345678),
('素描本', '生活雜物', 150, 170, 56274696, 32345678),
('綠色乖乖', '食品', 25, 30, 56382067, 22345678),
('綠色乖乖', '食品', 25, 30, 56382067, 32345678),
('綠茶茶包', '食品', 300, 350, 68274927, 22345678),
('美工刀', '生活雜物', 30, 33, 56274696, 12345678),
('美工刀', '生活雜物', 35, 40, 81234567, 32345678),
('耳機', '家電', 350, 400, 87654231, 12345678),
('耳機', '家電', 350, 450, 87654231, 22345678),
('耳機', '家電', 350, 420, 87654231, 32345678),
('肥皂', '生活雜物', 30, 40, 81234567, 12345678),
('肥皂', '生活雜物', 30, 35, 81234567, 32345678),
('芒果/盒', '食品', 350, 420, 87654321, 12345678),
('草莓/盒', '食品', 350, 420, 87654321, 12345678),
('蘋果/盒', '食品', 300, 350, 87654321, 12345678),
('蘋果/盒', '食品', 300, 400, 87654321, 22345678),
('電擊棒', '家電', 200, 400, 87654231, 22345678),
('電擊棒', '家電', 200, 400, 87654231, 32345678),
('電風扇', '家電', 500, 700, 87654231, 12345678),
('電風扇', '家電', 500, 600, 87654231, 22345678);

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
(12345678, 56274696),
(12345678, 68274927),
(12345678, 81234567),
(12345678, 87654231),
(12345678, 87654321),
(22345678, 56382067),
(22345678, 68274927),
(22345678, 81234567),
(22345678, 87654231),
(22345678, 87654321),
(32345678, 56274696),
(32345678, 56382067),
(32345678, 81234567),
(32345678, 87654231);

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
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `user_ID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `customer_order`
--

INSERT INTO `customer_order` (`order_number`, `customer_name`, `customer_phone`, `customer_address`, `accept_date`, `status`, `user_ID`) VALUES
(1, '客人A', '0987654321', '台北市xx區oo路1號', '2020-05-26', 0, 12345678),
(2, '客人B', '0978563412', '台北市xx區oo路2號', '2020-05-26', 0, 12345678),
(4, '客人D', '0983647124', '台北市xx區oo路4號', '2020-05-26', 0, 22345678),
(9, '客人C', '0986754217', '台北市xx區oo路7號', '2020-06-20', 0, 12345678),
(10, '客人Y', '0938572645', '台北市xx區oo路87號', '2020-06-03', 0, 12345678),
(12, '村民A', '0964725174', '台北市xx區oo路35號', '2020-06-10', 0, 22345678),
(13, '村民A', '0987384683', '台北市xx區oo路35號', '2020-06-14', 0, 22345678),
(14, '路人A', '0978472838', '台北市XX區YY路1號', '2020-06-20', 0, 32345678),
(15, '路人B', '0947336527', '新北市YY區XX路9號', '2020-06-05', 0, 32345678),
(16, '路人C', '0973856283', '新北市YZ區XY路9號', '2020-06-03', 0, 32345678),
(17, '村民F', '0936582648', '台北市YY區XX路9號', '2020-06-20', 0, 22345678),
(18, '路人C', '0947385628', '台北市YR區ZX路7號', '2020-06-18', 0, 22345678),
(19, '村民A', '0948567234', '新北市YY區XX路9號', '2020-06-16', 0, 12345678),
(20, '路人D', '0987654286', '台北市YX區XR路7號', '2020-06-20', 0, 32345678);

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
(5, '店員D', '1995-05-05', '0935124678', '台北市文山區oo路2號', '店長', 12345678),
(6, '店員F', '1997-06-20', '0974532167', '台北市中正區OO路', '店員', 12345678);

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
(56274696, 'D文具用品批發', '新北市xx區oo路4號', '聯絡人D', '(02)87004320'),
(56382067, 'F牌零食製造', '新北市xx區oo路6號', '聯絡人F', '(02)87496720'),
(68274927, 'E牌茶飲', '新北市xx區oo路5號', '聯絡人E', '(02)86980043'),
(81234567, 'C生活用品店', '新北市xx區oo路3號', '聯絡人C', '0924135678'),
(87654231, 'B牌電子用品', '新北市xx區oo路2號', '聯絡人B', '(02)87654321'),
(87654321, 'A水果店', '新北市xx區oo路1號', '聯絡人A', '0900345678');

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
(22345678, 12, 'Android充電線', 1),
(22345678, 12, 'iPhone充電線', 1),
(22345678, 12, 'type-C充電線', 1),
(32345678, 16, '原味洋芋片', 2),
(32345678, 20, '原味洋芋片', 3),
(32345678, 20, '奶油餅乾', 2),
(32345678, 15, '床墊', 1),
(32345678, 14, '彩色筆', 1),
(22345678, 13, '檯燈', 1),
(32345678, 15, '檯燈', 1),
(22345678, 17, '水果乾', 10),
(12345678, 1, '水果刀', 1),
(22345678, 4, '水果刀', 2),
(32345678, 16, '海苔洋芋片', 2),
(32345678, 20, '海苔洋芋片', 3),
(12345678, 19, '熨斗', 1),
(32345678, 15, '熨斗', 1),
(12345678, 9, '筆記本', 5),
(32345678, 14, '筆記本', 4),
(22345678, 18, '紅茶茶包', 1),
(32345678, 16, '綠色乖乖', 3),
(22345678, 18, '綠茶茶包', 2),
(12345678, 9, '美工刀', 1),
(12345678, 19, '肥皂', 5),
(12345678, 10, '草莓/盒', 2),
(12345678, 10, '蘋果/盒', 2),
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
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `order_number` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 已傾印資料表的限制(constraint)
--

--
-- 資料表的限制(constraint) `commodity`
--
ALTER TABLE `commodity`
  ADD CONSTRAINT `commodity_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`tax_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commodity_ibfk_2` FOREIGN KEY (`factory_tax_id`) REFERENCES `cooperate` (`factory_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制(constraint) `cooperate`
--
ALTER TABLE `cooperate`
  ADD CONSTRAINT `cooperate_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`tax_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cooperate_ibfk_2` FOREIGN KEY (`factory_ID`) REFERENCES `factory` (`factory_tax_id`) ON UPDATE CASCADE;

--
-- 資料表的限制(constraint) `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`tax_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制(constraint) `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`tax_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制(constraint) `order_include`
--
ALTER TABLE `order_include`
  ADD CONSTRAINT `order_include_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`tax_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_include_ibfk_2` FOREIGN KEY (`order_number`) REFERENCES `customer_order` (`order_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_include_ibfk_3` FOREIGN KEY (`com_name`) REFERENCES `commodity` (`commodity_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
