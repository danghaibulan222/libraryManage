-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-12-01 21:07:18
-- 服务器版本： 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CIstart`
--

-- --------------------------------------------------------

--
-- 表的结构 `lib_books`
--

CREATE TABLE `lib_books` (
  `bookid` int(11) NOT NULL,
  `bookname` varchar(20) CHARACTER SET utf8 NOT NULL,
  `booknum` int(10) NOT NULL,
  `pubhouse` varchar(20) CHARACTER SET utf8 NOT NULL,
  `pubtime` int(10) NOT NULL,
  `writer` varchar(20) CHARACTER SET utf8 NOT NULL,
  `introduction` char(20) CHARACTER SET utf8 NOT NULL,
  `cover` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'uploads/cover/default/',
  `canborrow` int(1) NOT NULL DEFAULT '1',
  `amount` int(4) NOT NULL DEFAULT '1',
  `borrowamount` int(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `lib_books`
--

INSERT INTO `lib_books` (`bookid`, `bookname`, `booknum`, `pubhouse`, `pubtime`, `writer`, `introduction`, `cover`, `canborrow`, `amount`, `borrowamount`) VALUES
(1, '线性代数', 1000, '人民出版社', 201006, '啦啦啦', '就是一本数学书', 'uploads/cover/default/', 1, 1, 0),
(2, '高数', 1001, '人民出版社', 201105, '啦啦啦', '英语教材', 'uploads/cover/default/', 1, 5, 0),
(3, '英语', 1002, '人民出版社', 201105, '啦啦啦', '英语教材', 'uploads/cover/default/', 1, 2, 0),
(4, '大雾', 2000, '四川大学', 201709, '当还不蓝', '没啥', 'uploads/cover/default/', 1, 1, 0),
(5, 'C语言', 1003, '人民出版社', 201106, '啦啦啦', '计算机教材', 'uploads/cover/default/', 1, 1, 0),
(7, '呐喊', 1004, '人民出版社', 201412, '鲁迅', '批判`', 'uploads/cover/default/', 1, 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `lib_borrowlist`
--

CREATE TABLE `lib_borrowlist` (
  `orderid` int(11) NOT NULL,
  `bookid` int(10) NOT NULL,
  `id` int(11) NOT NULL,
  `borrowtime` int(10) NOT NULL,
  `returntime` int(10) DEFAULT NULL,
  `hasreturn` int(1) NOT NULL DEFAULT '0',
  `keeptime` int(2) NOT NULL DEFAULT '30',
  `isovertime` int(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `lib_users`
--

CREATE TABLE `lib_users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `usertype` tinyint(3) NOT NULL DEFAULT '0',
  `salt` char(6) NOT NULL,
  `studentnum` bigint(13) DEFAULT NULL,
  `sex` tinyint(3) DEFAULT NULL,
  `grade` int(4) DEFAULT NULL,
  `college` char(6) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT 'uploads/avatar/default/',
  `regtime` int(10) DEFAULT NULL,
  `lastlogin` int(10) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `other` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lib_books`
--
ALTER TABLE `lib_books`
  ADD PRIMARY KEY (`bookid`),
  ADD UNIQUE KEY `booknum` (`booknum`);

--
-- Indexes for table `lib_borrowlist`
--
ALTER TABLE `lib_borrowlist`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `FK_bookid` (`bookid`),
  ADD KEY `FK_id` (`id`);

--
-- Indexes for table `lib_users`
--
ALTER TABLE `lib_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `studentnum` (`studentnum`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `lib_books`
--
ALTER TABLE `lib_books`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `lib_borrowlist`
--
ALTER TABLE `lib_borrowlist`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `lib_users`
--
ALTER TABLE `lib_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 限制导出的表
--

--
-- 限制表 `lib_borrowlist`
--
ALTER TABLE `lib_borrowlist`
  ADD CONSTRAINT `FK_bookid` FOREIGN KEY (`bookid`) REFERENCES `lib_books` (`bookid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id` FOREIGN KEY (`id`) REFERENCES `lib_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
