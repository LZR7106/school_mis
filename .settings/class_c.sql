-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-12-16 13:55:13
-- 服务器版本： 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `class_b`
--

-- --------------------------------------------------------

--
-- 表的结构 `class_c`
--

CREATE TABLE IF NOT EXISTS `class_c` (
  `id` int(11) NOT NULL,
  `row` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `place` varchar(256) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `class_c`
--

INSERT INTO `class_c` (`id`, `row`, `name`, `place`) VALUES
(1, 1, '计算机操作系统', 'H0424'),
(2, 2, '数据库原理', 'H0423'),
(3, 3, 'UML', 'B0217'),
(4, 4, '电影势力', 'B0222'),
(5, 5, '计算机网络', 'B0218'),
(6, 6, '嵌入式系统基础', 'Z2040'),
(7, 7, '软件工程', 'B0218'),
(8, 8, '计算机专业英语', 'H0424');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_c`
--
ALTER TABLE `class_c`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_c`
--
ALTER TABLE `class_c`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
