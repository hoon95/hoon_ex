-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 23-08-19 06:11
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
-- 데이터베이스: `abcweb`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `employees`
--

CREATE TABLE `employees` (
  `emp_no` int(10) NOT NULL,
  `name` varchar(5) NOT NULL,
  `hire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `employees`
--

INSERT INTO `employees` (`emp_no`, `name`, `hire_date`) VALUES
(1, '김다훈', '2023-08-24'),
(4, 'test', '2023-08-19'),
(5, '김다훈', '2023-08-19'),
(6, '김다훈', '2023-08-19'),
(7, '김다훈', '2023-08-19'),
(8, 'test2', '2023-08-19'),
(9, '김다훈', '2023-08-24'),
(10, '김다훈', '2023-08-24'),
(11, '김다훈', '2023-08-24'),
(12, '김다훈', '2023-08-24'),
(17, '김다훈', '2023-08-30'),
(18, '김다훈', '2023-08-30'),
(20, '', '0000-00-00'),
(21, 'ㅋㅋㅋㅋㅋ', '2023-08-24'),
(22, 'ㅎㅎㅎㅎ', '0000-00-00'),
(23, 'ㅁㄴㅇㅀa', '2023-08-17'),
(24, 'test', '2023-08-31'),
(25, 'aaa', '2023-08-02');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_no`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
