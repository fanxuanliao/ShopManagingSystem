-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2019 年 06 月 12 日 05:55
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
-- 資料庫： `web_final`
--

-- --------------------------------------------------------

--
-- 資料表結構 `commodity`
--

CREATE TABLE `commodity` (
  `name` varchar(10) CHARACTER SET utf8 NOT NULL,
  `cost` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `factory` varchar(100) CHARACTER SET utf8 NOT NULL,
  `category` varchar(32) CHARACTER SET utf8 NOT NULL,
  `user` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `commodity`
--

INSERT INTO `commodity` (`name`, `cost`, `price`, `factory`, `category`, `user`) VALUES
('紅茶', 10, 25, '統一', '食品', 'yihsiu'),
('綠茶', 10, 25, '味全', '食品', 'yihsiu'),
('耳機', 50, 500, '燦坤', '家電', 'yihsiu');

-- --------------------------------------------------------

--
-- 資料表結構 `employee`
--

CREATE TABLE `employee` (
  `address` varchar(100) CHARACTER SET utf8 NOT NULL,
  `birthday` date NOT NULL,
  `phonenum` varchar(10) CHARACTER SET utf8 NOT NULL,
  `hours` int(255) NOT NULL,
  `ID` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `position` varchar(10) CHARACTER SET utf8 NOT NULL,
  `user` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `employee`
--

INSERT INTO `employee` (`address`, `birthday`, `phonenum`, `hours`, `ID`, `name`, `position`, `user`) VALUES
('政大資科', '1999-07-07', '0123456789', 28, 1, '邱奕修', '員工', 'yihsiu'),
('NCCUCS', '1998-12-31', '1234567890', 35, 3, 'Kevin', '員工', 'test'),
('政大', '2000-01-01', '0000000000', 14, 6, 'Mike', '員工', 'yihsiu');

-- --------------------------------------------------------

--
-- 資料表結構 `factory`
--

CREATE TABLE `factory` (
  `phonenum` varchar(10) NOT NULL,
  `primary_contact` varchar(10) CHARACTER SET utf8 NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `factory`
--

INSERT INTO `factory` (`phonenum`, `primary_contact`, `address`, `name`, `user`) VALUES
('8888888888', 'Gina', '指南路二段', '味全', 'yihsiu'),
('7891234560', 'Eason', '新光路口', '燦坤', 'yihsiu'),
('7777777777', 'Andy', '7-11', '統一', 'yihsiu');

-- --------------------------------------------------------

--
-- 資料表結構 `inventory`
--

CREATE TABLE `inventory` (
  `serial_num` varchar(10) CHARACTER SET utf8 NOT NULL,
  `EXP` date NOT NULL,
  `sold` int(11) NOT NULL,
  `factory` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name` varchar(10) CHARACTER SET utf8 NOT NULL,
  `sold_time` date DEFAULT NULL,
  `user` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `inventory`
--

INSERT INTO `inventory` (`serial_num`, `EXP`, `sold`, `factory`, `name`, `sold_time`, `user`) VALUES
('0000', '2019-06-30', 0, '統一', '紅茶', NULL, 'yihsiu'),
('0001', '2019-06-09', 0, '統一', '紅茶', NULL, 'yihsiu'),
('0002', '2019-07-01', 0, '味全', '綠茶', NULL, 'yihsiu'),
('0003', '2019-07-01', 0, '味全', '綠茶', NULL, 'yihsiu'),
('0004', '2019-07-01', 1, '味全', '綠茶', '2019-06-10', 'yihsiu'),
('0005', '2019-07-01', 0, '統一', '紅茶', NULL, 'yihsiu'),
('0006', '2019-07-02', 1, '味全', '綠茶', '2019-06-12', 'yihsiu'),
('1000', '2020-08-08', 1, '燦坤', '耳機', '2019-06-12', 'yihsiu');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `account` varchar(32) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `storename` varchar(16) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `account`, `pwd`, `storename`) VALUES
(1, 'test', '0000', '測試'),
(2, 'yihsiu', '106703017', 'chiu');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `commodity`
--
ALTER TABLE `commodity`
  ADD PRIMARY KEY (`name`,`factory`,`user`) USING BTREE;

--
-- 資料表索引 `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`,`user`) USING BTREE;

--
-- 資料表索引 `factory`
--
ALTER TABLE `factory`
  ADD PRIMARY KEY (`name`,`user`) USING BTREE;

--
-- 資料表索引 `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`serial_num`,`user`) USING BTREE;

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `employee`
--
ALTER TABLE `employee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
