-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 23-08-22 07:40
-- 서버 버전: 10.4.28-MariaDB
-- PHP 버전: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `abcmall`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `admins`
--

CREATE TABLE `admins` (
  `idx` int(11) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `passwd` varchar(200) NOT NULL,
  `regdate` datetime NOT NULL,
  `level` int(4) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `end_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `admins`
--

INSERT INTO `admins` (`idx`, `userid`, `email`, `username`, `passwd`, `regdate`, `level`, `last_login`, `end_login`) VALUES
(1, 'admin', 'admin@shop.com', '관리자', '33275a8aa48ea918bd53a9181aa975f15ab0d0645398f5918a006d08675c1cb27d5c645dbd084eee56e675e25ba4019f2ecea37ca9e2995b49fcb12c096a032e', '2023-01-01 17:12:32', 100, '2023-08-22 08:57:50', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `category`
--

CREATE TABLE `category` (
  `cid` int(11) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `pcode` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `step` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `category`
--

INSERT INTO `category` (`cid`, `code`, `pcode`, `name`, `step`) VALUES
(1, 'A0001', NULL, '컴퓨터', 1),
(2, 'B0001', 'A0001', '노트북', 2),
(3, 'C0001', 'B0001', '게임용', 3),
(4, 'A0002', '', '맥북', 1),
(5, 'A0003', '', '갤럭시북', 1),
(6, 'B00002', 'A0002', '아이패드', 2),
(7, 'B00003', 'A0002', '아이맥', 2),
(8, 'C00002', 'B00002', '아이패드1', 3),
(9, 'C00003', 'B00002', '아이패드2', 3),
(10, 'C00004', 'B00002', '아이패드3', 3),
(11, 'C00005', 'B00003', '아이맥1', 3),
(12, 'B00004', 'A0003', '갤럭시짱짱맨', 2),
(13, 'B00005', 'A0003', '이재용만세', 2),
(14, 'C00007', 'B00004', '플립짱', 3),
(15, 'C00008', 'B00004', '폴드짱', 3),
(16, 'C00009', 'B00005', '이건희만세', 3);

-- --------------------------------------------------------

--
-- 테이블 구조 `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `cate` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `thumbnail` varchar(100) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `sale_price` double DEFAULT NULL,
  `sale_ratio` double DEFAULT NULL,
  `cnt` int(11) DEFAULT NULL,
  `sale_cnt` int(11) DEFAULT NULL,
  `isnew` tinyint(4) DEFAULT NULL,
  `isbest` tinyint(4) DEFAULT NULL,
  `isrecom` tinyint(4) DEFAULT NULL,
  `ismain` tinyint(4) DEFAULT NULL,
  `locate` tinyint(4) DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `sale_end_date` datetime DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `delivery_fee` double DEFAULT NULL,
  `file_table_id` varchar(50) DEFAULT NULL,
  `option_id` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `products`
--

INSERT INTO `products` (`pid`, `name`, `cate`, `content`, `thumbnail`, `price`, `sale_price`, `sale_ratio`, `cnt`, `sale_cnt`, `isnew`, `isbest`, `isrecom`, `ismain`, `locate`, `userid`, `sale_end_date`, `reg_date`, `status`, `delivery_fee`, `file_table_id`, `option_id`) VALUES
(19, 'test', 'A0002B00002C00002', '<p>dddd</p>', '/abcmall/pdata/20230821051525146565.png', 10000, 0, 2, 0, 0, 0, 0, 0, 1, 2, 'admin', '2024-02-21 00:00:00', '2023-08-21 12:15:25', 0, 0, '67', ''),
(16, '상품명 테스트1', 'A0001B0001C0001', '<h2>상품명 테스트1</h2>\n<p>상품명 테스트1입니다</p>', '/abcmall/pdata/20230818043453132649.png', 10000, 0, 1, 0, 0, 0, 0, 0, 0, 1, 'admin', '2024-02-18 00:00:00', '2023-08-18 11:34:53', -1, 0, '60,61,62', ''),
(15, 'ㅇㅇㅇ', 'A0001B0001C0001', '<p>ㅇㅁㄴㅁㄴㅇㄴㅁㅇ</p>', '/abcmall/pdata/20230817084520109117.png', 10000, 0, 1, 0, 0, 0, 0, 0, 0, 1, 'admin', '2024-02-17 00:00:00', '2023-08-17 15:45:20', 1, 0, '58,59', ''),
(17, '맥북테스트1', 'A0002B00002C00002', '<h2>맥북테스트1</h2>\n<p>맥테스트1</p>', '/abcmall/pdata/20230818080439195234.png', 40000, 0, 2, 0, 0, 0, 0, 0, 0, 2, 'admin', '2024-02-22 00:00:00', '2023-08-18 15:04:39', 0, 0, '64,65', ''),
(18, '맥북테스트2', 'A0002B00003C00005', '<h2>맥북테스트2</h2>\n<p>맥테스트2</p>', '/abcmall/pdata/20230818080516117793.png', 80000, 0, 1, 0, 0, 0, 0, 0, 0, 1, 'admin', '2024-02-18 00:00:00', '2023-08-18 15:05:16', -1, 0, '66', ''),
(20, '', '', '<p><br></p>', '', 10000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'admin', '2024-02-21 00:00:00', '2023-08-21 14:36:04', 0, 0, '', ''),
(21, '', '', '', '', 10000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'admin', '2024-02-21 00:00:00', '2023-08-21 14:43:49', 0, 0, '', ''),
(22, '', '', '', '', 10000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'admin', '2024-02-21 00:00:00', '2023-08-21 14:44:02', 0, 0, '', ''),
(23, '', '', '', '', 10000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'admin', '2024-02-21 00:00:00', '2023-08-21 14:44:36', 0, 0, '', ''),
(24, '', '', '', '', 10000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'admin', '2024-02-21 00:00:00', '2023-08-21 14:46:17', 0, 0, '', ''),
(25, 'fsdafsf', 'A0001B0001C0001', '<p><br></p>', '/abcmall/pdata/20230821084054810976.png', 10000, 0, 1, 0, 0, 1, 0, 0, 1, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 15:40:54', 0, 0, '68', ''),
(26, 'fsdafsf', 'A0001', '<p><br></p>', '/abcmall/pdata/20230821084216719737.png', 10000, 0, 1, 0, 0, 1, 0, 0, 1, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 15:42:16', 0, 0, '', ''),
(27, 'fsdafsfsf', 'A0001B0001C0001', '<p>fsdafsdfasf</p>', '/abcmall/pdata/20230821102043104981.png', 30000, 0, 1, 0, 0, 1, 1, 0, 0, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 17:20:43', 0, 0, '70,71', ''),
(28, 'fsdafsfsf', 'A0001', '<p>ㄹㅇㄴㄻㄹㄴ</p>', '/abcmall/pdata/20230821104047155345.png', 30000, 0, 1, 0, 0, 1, 1, 0, 0, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 17:40:47', 0, 0, '', ''),
(29, '김다훈', 'A0002B00002C00002', '<p>fffff</p>', '/abcmall/pdata/20230821104138754174.png', 30000, 0, 1, 0, 0, 1, 1, 0, 0, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 17:41:38', 0, 0, '72', ''),
(30, '김다훈', 'A0002B00002C00002', '<p>fffff</p>', '/abcmall/pdata/20230821104748106882.png', 30000, 0, 1, 0, 0, 1, 1, 0, 0, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 17:47:48', 0, 0, '72', ''),
(31, '김다훈', 'A0002B00002C00002', '<p>fffff</p>', '/abcmall/pdata/20230821104750138238.png', 30000, 0, 1, 0, 0, 1, 1, 0, 0, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 17:47:50', 0, 0, '72', ''),
(32, '김다훈ㅎㅎㅎ', 'A0001B0001C0001', '<p>ㅎㅎㅎㅎ</p>', '/abcmall/pdata/20230821104803156865.png', 30000, 0, 1, 0, 0, 1, 1, 0, 0, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 17:48:03', 0, 0, '', ''),
(33, 'ㄹㄴㅇㄻㄴㅇㄹㄴㄹ', 'A0001B0001C0001', '<p>fdsfafs</p>', '/abcmall/pdata/20230821104842808005.png', 30000, 0, 1, 0, 0, 0, 1, 1, 0, 1, 'admin', '2024-02-21 00:00:00', '2023-08-21 17:48:42', 0, 0, '73', ''),
(34, '제품상세보기를 해보자', 'A0001B0001C0001', '<p>제품상세보기를 해보겠습니다</p>', '/abcmall/pdata/20230822042223158009.png', 30000, 0, 1, 0, 0, 1, 0, 0, 1, 1, 'admin', '2024-02-06 00:00:00', '2023-08-22 11:22:23', 0, 0, '74,75', ''),
(35, '찐막ㅋㅋ', 'A0001B0001C0001', '<p>찐찐막ㅋㅋ</p>', '/abcmall/pdata/20230822050754148135.png', 30000, 0, 1, 0, 0, 0, 1, 1, 0, 1, 'admin', '2024-02-22 00:00:00', '2023-08-22 12:07:54', 0, 0, '76,77', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `product_image_table`
--

CREATE TABLE `product_image_table` (
  `imgid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `regdate` datetime DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `product_image_table`
--

INSERT INTO `product_image_table` (`imgid`, `pid`, `userid`, `filename`, `regdate`, `status`) VALUES
(1, NULL, 'admin', '20230817033739148719.png', '2023-08-17 10:37:39', 1),
(2, NULL, 'admin', '20230817033752364591.png', '2023-08-17 10:37:52', 1),
(3, NULL, 'admin', '20230817033807121052.png', '2023-08-17 10:38:07', 1),
(4, NULL, 'admin', '20230817034148563021.png', '2023-08-17 10:41:48', 1),
(5, NULL, 'admin', '20230817034228194603.png', '2023-08-17 10:42:28', 1),
(6, NULL, 'admin', '20230817034252654948.png', '2023-08-17 10:42:52', 1),
(7, NULL, 'admin', '20230817034254177001.png', '2023-08-17 10:42:54', 1),
(8, NULL, 'admin', '20230817034257172818.png', '2023-08-17 10:42:57', 1),
(9, NULL, 'admin', '20230817034314794079.png', '2023-08-17 10:43:14', 1),
(10, NULL, 'admin', '20230817034326927683.png', '2023-08-17 10:43:26', 1),
(11, NULL, 'admin', '20230817034330795164.png', '2023-08-17 10:43:30', 1),
(12, NULL, 'admin', '20230817034435203633.jpg', '2023-08-17 10:44:35', 1),
(13, NULL, 'admin', '20230817034513189585.jpg', '2023-08-17 10:45:13', 1),
(14, NULL, 'admin', '20230817034534525111.png', '2023-08-17 10:45:34', 1),
(15, NULL, 'admin', '20230817034539600223.png', '2023-08-17 10:45:39', 1),
(16, NULL, 'admin', '20230817034542130071.png', '2023-08-17 10:45:42', 1),
(17, NULL, 'admin', '20230817035551917315.png', '2023-08-17 10:55:51', 1),
(18, NULL, 'admin', '20230817035554649107.png', '2023-08-17 10:55:54', 1),
(19, NULL, 'admin', '20230817035600201914.png', '2023-08-17 10:56:00', 1),
(20, NULL, 'admin', '20230817035749106112.png', '2023-08-17 10:57:49', 1),
(21, NULL, 'admin', '20230817035751843764.png', '2023-08-17 10:57:51', 1),
(22, NULL, 'admin', '20230817035753627511.png', '2023-08-17 10:57:53', 1),
(23, NULL, 'admin', '20230817035755181472.jpg', '2023-08-17 10:57:55', 1),
(24, NULL, 'admin', '20230817035758224827.jpg', '2023-08-17 10:57:58', 1),
(25, NULL, 'admin', '20230817035800194387.jpg', '2023-08-17 10:58:00', 1),
(26, NULL, 'admin', '20230817035804108565.png', '2023-08-17 10:58:04', 1),
(27, NULL, 'admin', '20230817035807206326.png', '2023-08-17 10:58:07', 1),
(28, NULL, 'admin', '20230817035811330069.png', '2023-08-17 10:58:11', 1),
(29, NULL, 'admin', '20230817035853137520.png', '2023-08-17 10:58:53', 1),
(30, NULL, 'admin', '20230817035855339061.png', '2023-08-17 10:58:55', 1),
(31, NULL, 'admin', '20230817040003762135.png', '2023-08-17 11:00:03', 1),
(32, NULL, 'admin', '20230817044137673504.png', '2023-08-17 11:41:37', 1),
(33, NULL, 'admin', '20230817044257811966.png', '2023-08-17 11:42:57', 1),
(34, NULL, 'admin', '20230817044433617097.png', '2023-08-17 11:44:33', 1),
(35, NULL, 'admin', '20230817044456100179.png', '2023-08-17 11:44:56', 1),
(36, NULL, 'admin', '20230817045141210298.png', '2023-08-17 11:51:41', 1),
(37, NULL, 'admin', '20230817050133146163.png', '2023-08-17 12:01:33', 1),
(38, NULL, 'admin', '20230817050204791850.png', '2023-08-17 12:02:04', 1),
(39, NULL, 'admin', '20230817050305142516.png', '2023-08-17 12:03:05', 1),
(40, NULL, 'admin', '20230817050510147995.png', '2023-08-17 12:05:10', 1),
(41, NULL, 'admin', '20230817051552205603.png', '2023-08-17 12:15:52', 1),
(42, NULL, 'admin', '20230817051701114147.png', '2023-08-17 12:17:01', 1),
(43, NULL, 'admin', '20230817051820117041.png', '2023-08-17 12:18:20', 1),
(44, NULL, 'admin', '20230817052131971189.png', '2023-08-17 12:21:31', 0),
(45, NULL, 'admin', '20230817055816192977.png', '2023-08-17 12:58:16', 1),
(46, NULL, 'admin', '20230817060410111500.png', '2023-08-17 13:04:10', 1),
(47, NULL, 'admin', '20230817060412893966.png', '2023-08-17 13:04:12', 1),
(48, NULL, 'admin', '20230817060414471581.jpg', '2023-08-17 13:04:14', 1),
(49, NULL, 'admin', '20230817060514203669.png', '2023-08-17 13:05:14', 1),
(50, NULL, 'admin', '20230817060517169095.jpg', '2023-08-17 13:05:17', 1),
(51, NULL, 'admin', '20230817060531199470.png', '2023-08-17 13:05:31', 1),
(52, NULL, 'admin', '20230817062128148671.png', '2023-08-17 13:21:28', 1),
(53, NULL, 'admin', '20230817081306158790.png', '2023-08-17 15:13:06', 1),
(54, NULL, 'admin', '20230817081308185513.jpg', '2023-08-17 15:13:08', 1),
(55, NULL, 'admin', '20230817082121118204.png', '2023-08-17 15:21:21', 1),
(56, NULL, 'admin', '20230817082121188430.jpg', '2023-08-17 15:21:21', 1),
(57, NULL, 'admin', '20230817082121162518.jpg', '2023-08-17 15:21:21', 1),
(58, NULL, 'admin', '20230817084516181624.png', '2023-08-17 15:45:16', 1),
(59, NULL, 'admin', '20230817084516277282.png', '2023-08-17 15:45:16', 1),
(60, NULL, 'admin', '20230818043451125435.png', '2023-08-18 11:34:51', 1),
(61, NULL, 'admin', '20230818043451490578.png', '2023-08-18 11:34:51', 1),
(62, NULL, 'admin', '20230818043451412388.png', '2023-08-18 11:34:51', 1),
(63, NULL, 'admin', '20230818044225190321.png', '2023-08-18 11:42:25', 1),
(64, NULL, 'admin', '20230818080438425941.png', '2023-08-18 15:04:38', 1),
(65, NULL, 'admin', '20230818080438143257.png', '2023-08-18 15:04:38', 1),
(66, NULL, 'admin', '20230818080515159394.png', '2023-08-18 15:05:15', 1),
(67, NULL, 'admin', '20230821051514165705.png', '2023-08-21 12:15:14', 1),
(68, 25, 'admin', '20230821084048518003.jpg', '2023-08-21 15:40:48', 1),
(69, NULL, 'admin', '20230821101940840932.jpg', '2023-08-21 17:19:40', 1),
(70, 27, 'admin', '20230821102028101003.png', '2023-08-21 17:20:28', 1),
(71, 27, 'admin', '20230821102028934496.png', '2023-08-21 17:20:28', 1),
(72, 31, 'admin', '20230821104127128758.png', '2023-08-21 17:41:27', 1),
(73, 33, 'admin', '20230821104824183805.png', '2023-08-21 17:48:24', 1),
(74, 34, 'admin', '20230822042141107838.png', '2023-08-22 11:21:41', 1),
(75, 34, 'admin', '20230822042141161655.png', '2023-08-22 11:21:41', 1),
(76, 35, 'admin', '20230822050715557239.png', '2023-08-22 12:07:15', 1),
(77, 35, 'admin', '20230822050715143534.png', '2023-08-22 12:07:15', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `product_options`
--

CREATE TABLE `product_options` (
  `poid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `cate` varchar(100) DEFAULT NULL,
  `option_name` varchar(100) DEFAULT NULL,
  `option_cnt` int(11) DEFAULT NULL,
  `option_price` int(11) DEFAULT NULL,
  `image_url` varchar(300) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `product_options`
--

INSERT INTO `product_options` (`poid`, `pid`, `cate`, `option_name`, `option_cnt`, `option_price`, `image_url`, `status`) VALUES
(10, 30, '컬러', 'ddd', 20, 4000, '/abcmall/pdata/option/20230821104748795796.png', 1),
(11, 31, '컬러', 'ddd', 20, 4000, '/abcmall/pdata/option/20230821104750209812.png', 1),
(12, 32, '컬러', 'ddd', 20, 4000, '/abcmall/pdata/option/20230821104803132033.png', 1),
(13, 33, '컬러', '옵션테스트', 44, 4000, '/abcmall/pdata/option/20230821104842143069.png', 1),
(14, 33, '컬러', 'ddd', 11, 1111, '/abcmall/pdata/option/20230821104842197205.png', 1),
(15, 34, '사이즈', '대', 10, 10000, '/abcmall/pdata/option/20230822042223561747.png', 1),
(16, 34, '사이즈', '중', 20, 2000, '/abcmall/pdata/option/20230822042223209436.png', 1),
(17, 34, '사이즈', '소', 30, 300, '/abcmall/pdata/option/20230822042223702975.png', 1),
(18, 34, '사이즈', '특대', 1, 30000, '/abcmall/pdata/option/20230822042223182216.png', 1),
(19, 35, '사이즈', '대', 20, 3000, '/abcmall/pdata/option/20230822050754519076.png', 1),
(20, 35, '사이즈', '중', 30, 4000, '/abcmall/pdata/option/20230822050754163726.png', 1),
(21, 35, '사이즈', '소', 40, 500, '/abcmall/pdata/option/20230822050754355762.png', 1);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- 테이블의 인덱스 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- 테이블의 인덱스 `product_image_table`
--
ALTER TABLE `product_image_table`
  ADD PRIMARY KEY (`imgid`);

--
-- 테이블의 인덱스 `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`poid`),
  ADD KEY `newtable_pid_IDX` (`pid`) USING BTREE;

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 테이블의 AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- 테이블의 AUTO_INCREMENT `product_image_table`
--
ALTER TABLE `product_image_table`
  MODIFY `imgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- 테이블의 AUTO_INCREMENT `product_options`
--
ALTER TABLE `product_options`
  MODIFY `poid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
