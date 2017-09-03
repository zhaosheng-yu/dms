-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2017-09-03 13:28:11
-- 服务器版本： 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `man`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_group`
--

CREATE TABLE `admin_group` (
  `group_id` int(3) NOT NULL,
  `group_name` varchar(10) DEFAULT NULL,
  `group_desc` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色组';

--
-- 转存表中的数据 `admin_group`
--

INSERT INTO `admin_group` (`group_id`, `group_name`, `group_desc`) VALUES
(1, '管理员', ''),
(2, '平台运营', ''),
(3, '测试组', ''),
(4, '产品组', '');

-- --------------------------------------------------------

--
-- 表的结构 `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(12) NOT NULL,
  `group_id` int(3) NOT NULL,
  `admin_user_name` varchar(16) DEFAULT NULL,
  `admin_pwd` varchar(32) DEFAULT NULL,
  `admin_real_name` varchar(30) DEFAULT NULL,
  `admin_phone` varchar(11) DEFAULT NULL,
  `admin_qq` varchar(15) DEFAULT NULL,
  `admin_weixin` varchar(15) NOT NULL,
  `admin_email` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员信息';

--
-- 转存表中的数据 `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `group_id`, `admin_user_name`, `admin_pwd`, `admin_real_name`, `admin_phone`, `admin_qq`, `admin_weixin`, `admin_email`) VALUES
(1, 1, 'admin', '14e1b600b1fd579f47433b88e8d85291', '超级管理员', '', '', 'fdasf', ''),
(251, 3, 'zhaosheng', '14e1b600b1fd579f47433b88e8d85291', 'yzs', '', '', '', ''),
(252, 4, 'test', '14e1b600b1fd579f47433b88e8d85291', 'test', '', '', '', ''),
(253, 1, 'test2', '14e1b600b1fd579f47433b88e8d85291', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `admin_log`
--

CREATE TABLE `admin_log` (
  `id` int(11) NOT NULL,
  `menu` varchar(8) NOT NULL COMMENT '管理',
  `oper` varchar(32) NOT NULL COMMENT '操作类型',
  `remark` varchar(1024) NOT NULL COMMENT '备注',
  `admin` varchar(32) NOT NULL COMMENT '管理员',
  `ip` varchar(15) NOT NULL,
  `uptime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作日志表';

--
-- 转存表中的数据 `admin_log`
--

INSERT INTO `admin_log` (`id`, `menu`, `oper`, `remark`, `admin`, `ip`, `uptime`) VALUES
(1, '菜单管理', '', '', '', '', '2017-08-31 13:27:49'),
(2, '登录', '登录成功', '', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 13:39:52'),
(3, '退出操作', '', '', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 13:47:01'),
(4, '登录操作', '登录成功', '', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 13:47:36'),
(5, '菜单管理', '更新操作', 'UPDATE menu_info SET `menu_name` = \'管理员列表\',`menu_link` = \'/admin/manager/admin.php\',`menu_level` = \'2\',`menu_par_id` = \'1\',`menu_order` = \'33\',`menu_show` = \'1\',`menu_system` = \'管理后台系统\',`menu_id` = \'3\' WHERE 1 AND `menu_id`=\'3\' ', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 14:25:05'),
(6, '菜单管理', '管理员列表-更新操作', 'UPDATE menu_info SET `menu_name` = \'管理员列表\',`menu_link` = \'/admin/manager/admin.php\',`menu_level` = \'2\',`menu_par_id` = \'1\',`menu_order` = \'3\',`menu_show` = \'1\',`menu_system` = \'管理后台系统\',`menu_id` = \'3\' WHERE 1 AND `menu_id`=\'3\' ', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 14:26:54'),
(7, '菜单管理', '权限管理-新增操作', 'INSERT INTO menu_info (`menu_name`,`menu_link`,`menu_level`,`menu_par_id`,`menu_order`,`menu_show`,`menu_system`) VALUES (\'权限管理\',\'admin/manager/auty.php\',\'2\',\'1\',\'0\',\'1\',\'管理后台系统\') ', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 14:33:08'),
(8, '管理员管理', 'zhaosheng-新增操作', 'INSERT INTO admin_info (`admin_user_name`,`admin_pwd`,`group_id`,`admin_real_name`,`admin_phone`,`admin_qq`,`admin_weixin`,`admin_email`) VALUES (\'zhaosheng\',\'14e1b600b1fd579f47433b88e8d85291\',\'3\',\'yzs\',\'\',\'\',\'\',\'\') ', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 14:35:05'),
(9, '菜单管理', '权限管理-更新操作', 'UPDATE menu_info SET `menu_name` = \'权限管理\',`menu_link` = \'admin/manager/auty_edit.php\',`menu_level` = \'2\',`menu_par_id` = \'1\',`menu_order` = \'0\',`menu_show` = \'1\',`menu_system` = \'管理后台系统\',`menu_id` = \'4\' WHERE 1 AND `menu_id`=\'4\' ', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 14:35:48'),
(10, '退出操作', '', '', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 14:47:28'),
(11, '登录操作', '登录成功', '', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 14:47:35'),
(12, '菜单管理', '角色管理-更新操作', 'UPDATE menu_info SET `menu_name` = \'角色管理\',`menu_link` = \'/admin/manager/admin.php\',`menu_level` = \'2\',`menu_par_id` = \'1\',`menu_order` = \'3\',`menu_show` = \'1\',`menu_system` = \'管理后台系统\',`menu_id` = \'3\' WHERE 1 AND `menu_id`=\'3\' ', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 14:58:47'),
(13, '菜单管理', '菜单管理-更新操作', 'UPDATE menu_info SET `menu_name` = \'菜单管理\',`menu_link` = \'/admin/manager/menu.php\',`menu_level` = \'2\',`menu_par_id` = \'1\',`menu_order` = \'999\',`menu_show` = \'1\',`menu_system` = \'管理后台\',`menu_id` = \'2\' WHERE 1 AND `menu_id`=\'2\' ', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 14:59:32'),
(14, '菜单管理', '菜单管理-更新操作', 'UPDATE menu_info SET `menu_name` = \'菜单管理\',`menu_link` = \'/admin/manager/menu.php\',`menu_level` = \'2\',`menu_par_id` = \'1\',`menu_order` = \'999\',`menu_show` = \'1\',`menu_system` = \'管理后台\',`menu_id` = \'2\' WHERE 1 AND `menu_id`=\'2\' ', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 14:59:36'),
(15, '菜单管理', '菜单管理-更新操作', 'UPDATE menu_info SET `menu_name` = \'菜单管理\',`menu_link` = \'/admin/manager/menu.php\',`menu_level` = \'2\',`menu_par_id` = \'1\',`menu_order` = \'999\',`menu_show` = \'1\',`menu_system` = \'管理后台\',`menu_id` = \'2\' WHERE 1 AND `menu_id`=\'2\' ', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 15:00:43'),
(16, '菜单管理', '操作日志-新增操作', 'INSERT INTO menu_info (`menu_name`,`menu_link`,`menu_level`,`menu_par_id`,`menu_order`,`menu_show`,`menu_system`) VALUES (\'操作日志\',\'/admin/manager/log.php\',\'2\',\'1\',\'0\',\'1\',\'管理后台系统\') ', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 15:01:43'),
(17, '菜单管理', '系统管理-更新操作', 'UPDATE menu_info SET `menu_name` = \'系统管理\',`menu_link` = \'\',`menu_level` = \'1\',`menu_par_id` = \'0\',`menu_order` = \'1\',`menu_show` = \'1\',`menu_system` = \'管理后台\',`menu_id` = \'1\' WHERE 1 AND `menu_id`=\'1\' ', 'admin[超级管理员]', '14.155.112.179', '2017-08-31 15:02:00'),
(18, '登录操作', '登录成功', '', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 10:35:05'),
(19, '管理员管理', 'test-新增操作', 'INSERT INTO admin_info (`admin_user_name`,`admin_pwd`,`group_id`,`admin_real_name`,`admin_phone`,`admin_qq`,`admin_weixin`,`admin_email`) VALUES (\'test\',\'14e1b600b1fd579f47433b88e8d85291\',\'4\',\'test\',\'\',\'\',\'\',\'\') ', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 10:39:17'),
(20, '菜单管理', '后台管理-新增操作', 'INSERT INTO menu_info (`menu_name`,`menu_link`,`menu_level`,`menu_par_id`,`menu_order`,`menu_show`,`menu_system`) VALUES (\'后台管理\',\'\',\'1\',\'0\',\'0\',\'1\',\'管理后台系统\') ', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 11:24:51'),
(21, '菜单管理', '角色管理-更新操作', 'UPDATE menu_info SET `menu_name` = \'角色管理\',`menu_link` = \'/admin/manager/admin.php\',`menu_level` = \'2\',`menu_par_id` = \'6\',`menu_order` = \'3\',`menu_show` = \'1\',`menu_system` = \'管理后台系统\',`menu_id` = \'3\' WHERE 1 AND `menu_id`=\'3\' ', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 11:25:02'),
(22, '管理员管理', '-更新操作', 'UPDATE admin_info SET `pers` = \'\' WHERE 1 AND `admin_id`=\'\' ', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 12:25:20'),
(23, '退出操作', '', '', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 13:43:21'),
(24, '登录操作', '登录成功', '', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 13:43:28'),
(25, '退出操作', '', '', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 13:52:30'),
(26, '登录操作', '登录成功', '', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 13:52:35'),
(27, '退出操作', '', '', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 14:24:22'),
(28, '登录操作', '登录成功', '', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 14:24:29'),
(29, '权限管理', '251', '{\"admin_id\":\"251\",\"action\":\"edit\",\"pers\":[\"4_1\"]}', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 14:52:37'),
(30, '权限管理', '251', '{\"admin_id\":\"251\",\"action\":\"edit\",\"pers\":[\"5_1\",\"4_1\"]}', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 14:53:03'),
(31, '权限管理', '251', '{\"admin_id\":\"251\",\"action\":\"edit\",\"pers\":[\"5_1\",\"4_1\"]}', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 14:53:22'),
(32, '权限管理', '251', '{\"admin_id\":\"251\",\"action\":\"edit\",\"pers\":[\"5_1\",\"4_1\"]}', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 14:54:04'),
(33, '权限管理', '251', '{\"admin_id\":\"251\",\"action\":\"edit\",\"pers\":[\"5_1\",\"4_1\"]}', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 14:54:35'),
(34, '权限管理', '251', '{\"admin_id\":\"251\",\"action\":\"edit\",\"pers\":[\"5_1\",\"4_1\"]}', 'admin[超级管理员]', '183.37.24.74', '2017-09-02 14:57:29'),
(35, '登录操作', '登录成功', '', 'admin[超级管理员]', '183.37.24.74', '2017-09-03 06:10:02'),
(36, '菜单管理', '操作日志-更新操作', 'UPDATE menu_info SET `menu_name` = \'操作日志\',`menu_link` = \'/admin/manager/adminlog.php\',`menu_level` = \'2\',`menu_par_id` = \'1\',`menu_order` = \'0\',`menu_show` = \'1\',`menu_system` = \'管理后台系统\',`menu_id` = \'5\' WHERE 1 AND `menu_id`=\'5\' ', 'admin[超级管理员]', '183.37.24.74', '2017-09-03 06:13:43'),
(37, '菜单管理', '其它业务-更新操作', 'UPDATE menu_info SET `menu_name` = \'其它业务\',`menu_link` = \'\',`menu_level` = \'1\',`menu_par_id` = \'0\',`menu_order` = \'0\',`menu_show` = \'1\',`menu_system` = \'管理后台系统\',`menu_id` = \'6\' WHERE 1 AND `menu_id`=\'6\' ', 'admin[超级管理员]', '183.37.24.74', '2017-09-03 12:57:59'),
(38, '菜单管理', '角色管理-更新操作', 'UPDATE menu_info SET `menu_name` = \'角色管理\',`menu_link` = \'/admin/manager/admin.php\',`menu_level` = \'2\',`menu_par_id` = \'1\',`menu_order` = \'3\',`menu_show` = \'1\',`menu_system` = \'管理后台系统\',`menu_id` = \'3\' WHERE 1 AND `menu_id`=\'3\' ', 'admin[超级管理员]', '183.37.24.74', '2017-09-03 12:58:09'),
(39, '菜单管理', '操作日志-更新操作', 'UPDATE menu_info SET `menu_name` = \'操作日志\',`menu_link` = \'/admin/manager/adminlog.php\',`menu_level` = \'2\',`menu_par_id` = \'6\',`menu_order` = \'0\',`menu_show` = \'1\',`menu_system` = \'管理后台系统\',`menu_id` = \'5\' WHERE 1 AND `menu_id`=\'5\' ', 'admin[超级管理员]', '183.37.24.74', '2017-09-03 12:58:25'),
(40, '菜单管理', 'test-新增操作', 'INSERT INTO menu_info (`menu_name`,`menu_link`,`menu_level`,`menu_par_id`,`menu_order`,`menu_show`,`menu_system`) VALUES (\'test\',\'\',\'1\',\'0\',\'0\',\'1\',\'管理后台系统\') ', 'admin[超级管理员]', '183.37.24.74', '2017-09-03 13:06:40'),
(41, '管理员管理', 'test2-新增操作', 'INSERT INTO admin_info (`admin_user_name`,`admin_pwd`,`group_id`,`admin_real_name`,`admin_phone`,`admin_qq`,`admin_weixin`,`admin_email`) VALUES (\'test2\',\'14e1b600b1fd579f47433b88e8d85291\',\'1\',\'\',\'\',\'\',\'\',\'\') ', 'admin[超级管理员]', '183.37.24.74', '2017-09-03 13:06:54'),
(42, '菜单管理', '7-删除操作', 'DELETE FROM menu_info WHERE 1 AND menu_id in (7) ', 'admin[超级管理员]', '183.37.24.74', '2017-09-03 13:07:20');

-- --------------------------------------------------------

--
-- 表的结构 `admin_menu`
--

CREATE TABLE `admin_menu` (
  `admin_id` int(12) NOT NULL,
  `menu_id` int(3) NOT NULL,
  `menu_power_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:查看 2:编辑'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员-后台功能关系';

--
-- 转存表中的数据 `admin_menu`
--

INSERT INTO `admin_menu` (`admin_id`, `menu_id`, `menu_power_type`) VALUES
(1, 2, 1),
(1, 2, 2),
(1, 3, 1),
(1, 3, 2),
(1, 4, 1),
(1, 4, 2),
(1, 5, 1),
(1, 5, 2),
(251, 4, 1),
(251, 5, 1);

-- --------------------------------------------------------

--
-- 表的结构 `menu_info`
--

CREATE TABLE `menu_info` (
  `menu_id` int(3) NOT NULL,
  `menu_name` varchar(30) DEFAULT NULL,
  `menu_link` varchar(64) DEFAULT NULL,
  `menu_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:显示 2:隐藏',
  `menu_level` tinyint(4) DEFAULT NULL,
  `menu_par_id` varchar(3) DEFAULT NULL,
  `menu_system` varchar(16) DEFAULT NULL COMMENT '系统',
  `menu_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台功能管理';

--
-- 转存表中的数据 `menu_info`
--

INSERT INTO `menu_info` (`menu_id`, `menu_name`, `menu_link`, `menu_show`, `menu_level`, `menu_par_id`, `menu_system`, `menu_order`) VALUES
(1, '系统管理', '', 1, 1, '0', '管理后台', 1),
(2, '菜单管理', '/admin/manager/menu.php', 1, 2, '1', '管理后台', 999),
(3, '角色管理', '/admin/manager/admin.php', 1, 2, '1', '管理后台系统', 3),
(4, '权限管理', 'admin/manager/auty_edit.php', 1, 2, '1', '管理后台系统', 0),
(5, '操作日志', '/admin/manager/adminlog.php', 1, 2, '6', '管理后台系统', 0),
(6, '其它业务', '', 1, 1, '0', '管理后台系统', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_group`
--
ALTER TABLE `admin_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_user_name` (`admin_user_name`),
  ADD KEY `FK_admin_group` (`group_id`);

--
-- Indexes for table `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu` (`menu`),
  ADD KEY `oper` (`oper`),
  ADD KEY `admin` (`admin`);

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD UNIQUE KEY `ad` (`admin_id`,`menu_id`,`menu_power_type`) USING BTREE;

--
-- Indexes for table `menu_info`
--
ALTER TABLE `menu_info`
  ADD PRIMARY KEY (`menu_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin_group`
--
ALTER TABLE `admin_group`
  MODIFY `group_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;
--
-- 使用表AUTO_INCREMENT `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- 使用表AUTO_INCREMENT `menu_info`
--
ALTER TABLE `menu_info`
  MODIFY `menu_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;
