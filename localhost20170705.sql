-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-04-20 09:44:25
-- 服务器版本： 5.7.15-1
-- PHP Version: 7.0.12-2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alcms`
--
CREATE DATABASE IF NOT EXISTS `alcms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `alcms`;

-- --------------------------------------------------------

--
-- 表的结构 `al_access`
--

CREATE TABLE IF NOT EXISTS `al_access` (
  `role_id` smallint(6) UNSIGNED NOT NULL,
  `node_id` smallint(6) UNSIGNED NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `al_depart`
--

CREATE TABLE IF NOT EXISTS `al_depart` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `al_depart`
--

INSERT INTO `al_depart` (`id`, `name`, `pid`, `level`, `sort`, `status`) VALUES
(1, '商丘爱邻餐饮管理有限公司', 0, 0, 0, 1),
(2, '股东', 1, 0, 0, 1),
(3, '董事会', 1, 1, 0, 0),
(4, '监事', 1, 1, 0, 0),
(5, '总经理', 1, 1, 0, 0),
(6, '副总经理', 1, 1, 0, 0),
(7, '总部', 1, 1, 0, 0),
(8, '门店', 1, 1, 0, 0),
(9, '综合', 7, 0, 0, 0),
(10, '人力资源', 7, 0, 0, 0),
(11, '信息工程', 7, 0, 0, 1),
(12, '企划', 7, 0, 0, 0),
(13, '采购', 7, 0, 0, 0),
(14, '财务', 7, 0, 0, 0),
(15, '营运', 7, 0, 0, 0),
(16, '评估', 7, 0, 0, 0),
(17, '商丘花千代', 8, 0, 0, 0),
(18, '驻马店花千代', 8, 0, 0, 0),
(19, '有鱼新概念烤鱼', 8, 0, 0, 0),
(20, '肚来肚往涮牛肚火锅', 8, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `al_node`
--

CREATE TABLE IF NOT EXISTS `al_node` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) UNSIGNED DEFAULT NULL,
  `pid` smallint(6) UNSIGNED NOT NULL,
  `level` tinyint(1) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `al_node`
--

INSERT INTO `al_node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES
(1, 'admin', '后台应用', 1, NULL, 0, 0, 1),
(2, 'index', '首页', 1, NULL, 0, 1, 2),
(3, 'index', '首页', 1, NULL, 0, 2, 3),
(4, 'index', '前台应用', 1, NULL, 0, 0, 1),
(5, 'role', '角色管理', 1, NULL, 0, 1, 2),
(6, 'index', '角色列表', 1, NULL, 0, 5, 3),
(7, 'add', '添加角色', 1, NULL, 0, 5, 3),
(8, 'user', '用户管理', 1, NULL, 0, 1, 2),
(9, 'add', '添加用户', 1, NULL, 0, 8, 3),
(10, 'index', '用户列表', 1, NULL, 0, 8, 3),
(11, 'edit', '编辑角色', 1, NULL, 0, 5, 3),
(12, 'edit', '编辑用户', 1, NULL, 0, 8, 3),
(13, 'depart ', '部门管理', 1, NULL, 0, 1, 2),
(14, 'index', '部门列表', 1, NULL, 0, 13, 3),
(15, 'staff', '员工管理', 1, NULL, 0, 1, 2),
(16, 'index', '员工列表', 1, NULL, 0, 15, 3);

-- --------------------------------------------------------

--
-- 表的结构 `al_role`
--

CREATE TABLE IF NOT EXISTS `al_role` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) UNSIGNED DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `al_role`
--

INSERT INTO `al_role` (`id`, `name`, `pid`, `status`, `remark`) VALUES
(1, 'Manager', NULL, 1, '管理员'),
(2, 'Editor', NULL, 1, '编辑'),
(3, 'HR', NULL, 1, '人事');

-- --------------------------------------------------------

--
-- 表的结构 `al_role_user`
--

CREATE TABLE IF NOT EXISTS `al_role_user` (
  `role_id` mediumint(9) UNSIGNED DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `al_staff`
--

CREATE TABLE IF NOT EXISTS `al_staff` (
  `id` int(11) NOT NULL,
  `name` varchar(12) NOT NULL DEFAULT '',
  `alias` varchar(32) NOT NULL DEFAULT '' COMMENT '别名',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `telphone` varchar(11) NOT NULL DEFAULT '',
  `level` int(11) NOT NULL DEFAULT '1',
  `hiredate` int(11) DEFAULT NULL,
  `leavedate` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='员工基础表';

--
-- 转存表中的数据 `al_staff`
--

INSERT INTO `al_staff` (`id`, `name`, `alias`, `sex`, `telphone`, `level`, `hiredate`, `leavedate`, `status`) VALUES
(1, '张晓华', '', 1, '18538539999', 1, 1387555200, NULL, 0),
(2, '韩福永', '', 1, '13937032566', 1, 1387584000, NULL, 0),
(3, '孙玲玲', '', 0, '15639277256', 1, 1409500800, NULL, 0),
(4, '李霞', '', 0, '13460100628', 1, 1387584000, NULL, 0),
(5, '刘琳', '', 0, '15639281165', 1, 1404144000, NULL, 0),
(6, '马治理', '', 1, '18638108032', 1, 1409529600, NULL, 0),
(7, '弓志峰', '', 1, '13633855357', 1, 1387584000, NULL, 0),
(8, '朱宇', '', 0, '13462902670', 1, NULL, NULL, 0),
(9, '田亚萍', '肖彤', 0, '18637090945', 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `al_staff_depart`
--

CREATE TABLE IF NOT EXISTS `al_staff_depart` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL DEFAULT '0',
  `did` int(11) NOT NULL DEFAULT '0',
  `position` varchar(32) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `remove_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `al_staff_depart`
--

INSERT INTO `al_staff_depart` (`id`, `sid`, `did`, `position`, `status`, `add_time`, `remove_time`) VALUES
(43, 1, 3, '', 0, 0, 0),
(44, 1, 5, '', 0, 0, 0),
(5, 2, 2, '', 0, 0, 0),
(6, 3, 6, '', 0, 0, 0),
(7, 4, 14, '', 0, 0, 0),
(8, 5, 10, '', 0, 0, 0),
(9, 6, 11, '', 0, 0, 0),
(10, 7, 2, '', 0, 0, 0),
(11, 7, 4, '', 0, 0, 0),
(12, 3, 9, '', 0, 0, 0),
(13, 8, 14, '', 0, 0, 0),
(14, 9, 12, '', 0, 0, 0),
(15, 2, 3, '', 0, 0, 0),
(42, 1, 2, '', 0, 0, 0),
(45, 1, 15, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `al_staff_profile`
--

CREATE TABLE IF NOT EXISTS `al_staff_profile` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL DEFAULT '0',
  `photo` varchar(255) NOT NULL,
  `stature` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `vision` tinyint(1) NOT NULL DEFAULT '0',
  `volk` int(11) NOT NULL DEFAULT '0',
  `wedlock` tinyint(1) NOT NULL DEFAULT '0',
  `degree` tinyint(1) NOT NULL DEFAULT '0',
  `birthday` int(11) DEFAULT NULL,
  `identity_card` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `al_staff_profile`
--

INSERT INTO `al_staff_profile` (`id`, `sid`, `photo`, `stature`, `weight`, `vision`, `volk`, `wedlock`, `degree`, `birthday`, `identity_card`) VALUES
(1, 5, '', 168, 90, 1, 1, 0, 2, 647708400, ''),
(2, 3, '', 158, 0, 0, 1, 0, 0, 0, ''),
(3, 1, '', 0, 0, 0, 1, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `al_randcoupon`
--

CREATE TABLE IF NOT EXISTS `al_randcoupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `code` varchar(16) NOT NULL,
  `money` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `start_time` int(11) NOT NULL DEFAULT '0',
  `end_time` int(11) NOT NULL DEFAULT '0',
  `use_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='随机代金券' AUTO_INCREMENT=2409 ;

-- --------------------------------------------------------

--
-- 表的结构 `al_smslog`
--

CREATE TABLE IF NOT EXISTS `al_smslog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `cardno` varchar(13) NOT NULL DEFAULT '',
  `send_time` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `char` int(11) NOT NULL DEFAULT '0',
  `telphone` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='短信记录';

-- --------------------------------------------------------

--
-- 表的结构 `al_user`
--

CREATE TABLE IF NOT EXISTS `al_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `truename` varchar(32) NOT NULL DEFAULT '',
  `phone` varchar(11) NOT NULL,
  `last_ip` varchar(16) NOT NULL DEFAULT '',
  `last_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `al_user`
--

INSERT INTO `al_user` (`id`, `username`, `password`, `truename`, `phone`, `last_ip`, `last_time`) VALUES
(1, 'youyu', 'e82363b307a044464f5d316fdcadb455', '有鱼', '03703366888', '42.231.99.113', 1498975970),
(2, 'sqhqd', 'e10adc3949ba59abbe56e057f20f883e', '商丘花千代(大商店)', '03703237555', '42.231.98.112', 1499239299),
(3, 'dldw', '715495f764a690865177ceb16061b896', '肚来肚往', '03703673888', '42.235.12.18', 1498800053),
(4, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '超级管理员', '3366889', '42.231.98.112', 1499228520);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `al_access`
--
ALTER TABLE `al_access`
  ADD KEY `groupId` (`role_id`),
  ADD KEY `nodeId` (`node_id`);

--
-- Indexes for table `al_depart`
--
ALTER TABLE `al_depart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`pid`);

--
-- Indexes for table `al_node`
--
ALTER TABLE `al_node`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level` (`level`),
  ADD KEY `pid` (`pid`),
  ADD KEY `status` (`status`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `al_role`
--
ALTER TABLE `al_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `al_role_user`
--
ALTER TABLE `al_role_user`
  ADD KEY `group_id` (`role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `al_staff`
--
ALTER TABLE `al_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `al_staff_depart`
--
ALTER TABLE `al_staff_depart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sid` (`sid`,`did`,`position`);

--
-- Indexes for table `al_staff_profile`
--
ALTER TABLE `al_staff_profile`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `al_depart`
--
ALTER TABLE `al_depart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- 使用表AUTO_INCREMENT `al_node`
--
ALTER TABLE `al_node`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `al_role`
--
ALTER TABLE `al_role`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `al_staff`
--
ALTER TABLE `al_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `al_staff_depart`
--
ALTER TABLE `al_staff_depart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- 使用表AUTO_INCREMENT `al_staff_profile`
--
ALTER TABLE `al_staff_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
