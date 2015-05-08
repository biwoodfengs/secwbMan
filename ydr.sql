-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2014 年 06 月 16 日 06:05
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `ydr`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `cd_admin`
-- 

CREATE TABLE `cd_admin` (
  `id` tinyint(4) unsigned NOT NULL auto_increment COMMENT '管理员id',
  `name` varchar(32) collate utf8_unicode_ci NOT NULL COMMENT '名称',
  `realname` varchar(16) collate utf8_unicode_ci NOT NULL COMMENT '真实姓名',
  `password` varchar(32) collate utf8_unicode_ci NOT NULL COMMENT '密码',
  `lastip` varchar(15) collate utf8_unicode_ci NOT NULL COMMENT '最后登录ip',
  `dateline` timestamp NOT NULL default '0000-00-00 00:00:00' COMMENT '创建时间',
  `lasttime` timestamp NOT NULL default '0000-00-00 00:00:00' COMMENT '最后登录时间',
  `roleid` tinyint(4) NOT NULL default '0' COMMENT '角色id',
  `state` tinyint(4) NOT NULL default '1' COMMENT '状态',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `roleid` (`roleid`),
  KEY `state` (`state`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='管理员id' AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `cd_admin`
-- 

INSERT INTO `cd_admin` VALUES (1, 'admin', 'admin', 'b23cf2d0fb74b0ffa0cf4c70e6e04926', '', '2014-06-04 16:50:53', '2014-06-04 16:50:53', 1, 1);
INSERT INTO `cd_admin` VALUES (2, 'asd', 'asd', 'b23cf2d0fb74b0ffa0cf4c70e6e04926', '', '2014-06-09 12:43:42', '2014-06-09 12:43:42', 1, 1);
INSERT INTO `cd_admin` VALUES (3, 'asdasd', 'asdasd1', 'asdasdasd', '', '0000-00-00 00:00:00', '2014-06-11 16:55:01', 1, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `cd_func`
-- 

CREATE TABLE `cd_func` (
  `id` tinyint(4) unsigned NOT NULL auto_increment COMMENT '编号 ',
  `name` varchar(16) collate utf8_unicode_ci NOT NULL default '' COMMENT ' 功能名称',
  `pid` tinyint(4) NOT NULL default '0' COMMENT '所属父功能',
  `dateline` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT '创建时间',
  `authority` varchar(255) collate utf8_unicode_ci NOT NULL default '' COMMENT '代表权限值',
  `weight` tinyint(4) unsigned NOT NULL default '0' COMMENT '状态',
  `path` varchar(8) collate utf8_unicode_ci NOT NULL default '',
  `methods` varchar(32) collate utf8_unicode_ci NOT NULL default ' ',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `pid` (`pid`),
  KEY `path` (`path`),
  KEY `weight` (`weight`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

-- 
-- 导出表中的数据 `cd_func`
-- 

INSERT INTO `cd_func` VALUES (1, '管理员操作', 0, '2014-06-10 14:24:59', '1', 0, 'manager', ' ');
INSERT INTO `cd_func` VALUES (4, '用户管理', 1, '2014-06-10 14:25:27', '10', 1, 'manager', ' ');
INSERT INTO `cd_func` VALUES (5, '用户列表', 4, '2014-06-10 14:25:33', '100', 1, 'manager', 'admin/user/userlist');
INSERT INTO `cd_func` VALUES (6, '角色管理', 4, '2014-06-10 14:26:06', '1000', 2, 'manager', 'admin/role/rolelist');
INSERT INTO `cd_func` VALUES (7, '功能管理', 4, '2014-06-10 14:43:22', '10000', 3, 'manager', 'admin/func/funclist');
INSERT INTO `cd_func` VALUES (15, 'asd', 0, '2014-06-10 18:00:39', '1', 1, 'asd', '1');
INSERT INTO `cd_func` VALUES (16, 'asdasd', 15, '2014-06-11 12:33:15', '10', 2, 'asd', '2');
INSERT INTO `cd_func` VALUES (23, '111', 16, '2014-06-12 11:26:50', '100', 3, 'asd', '3');

-- --------------------------------------------------------

-- 
-- 表的结构 `cd_role`
-- 

CREATE TABLE `cd_role` (
  `id` int(4) NOT NULL auto_increment COMMENT '角色id',
  `name` varchar(15) collate utf8_unicode_ci NOT NULL COMMENT '角色名称',
  `dateline` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT '创建时间',
  `authority` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT '默认权限',
  `remarks` varchar(128) collate utf8_unicode_ci NOT NULL COMMENT '备注',
  `state` tinyint(4) NOT NULL default '1' COMMENT '状态',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `state` (`state`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `cd_role`
-- 

INSERT INTO `cd_role` VALUES (1, '系统管理员', '2014-06-09 13:34:24', 'manager:11111,asd:111,', '系统管理员', 1);
INSERT INTO `cd_role` VALUES (2, 'test', '2014-06-12 10:01:10', 'asd:111,', '', 1);
INSERT INTO `cd_role` VALUES (3, 'asds', '2014-06-12 14:55:49', 'manager:10000,asd:11,', '', 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `cd_sessions`
-- 

CREATE TABLE `cd_sessions` (
  `session_id` varchar(32) NOT NULL,
  `session_last_access` int(10) unsigned default NULL,
  `session_data` text,
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `cd_sessions`
-- 

INSERT INTO `cd_sessions` VALUES ('e1cdf56730973b11ea742961c4191c5e', 1402883344, 'sess_last_access|i:1402883344;sess_ip_address|s:9:"127.0.0.1";sess_useragent|s:50:"Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko";sess_last_regenerated|i:1402883343;userid|s:1:"1";name|s:5:"admin";roleid|s:1:"1";realname|s:5:"admin";dateline|s:19:"2014-06-04 16:50:53";lasttime|s:19:"2014-06-04 16:50:53";');
INSERT INTO `cd_sessions` VALUES ('d5bd70252de06c4c61e9da866aca21de', 1402653814, 'sess_last_access|i:1402653814;sess_ip_address|s:9:"127.0.0.1";sess_useragent|s:50:"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53";sess_last_regenerated|i:1402653527;userid|s:1:"1";name|s:5:"admin";roleid|s:1:"1";realname|s:5:"admin";dateline|s:19:"2014-06-04 16:50:53";lasttime|s:19:"2014-06-04 16:50:53";');
INSERT INTO `cd_sessions` VALUES ('c1b6d39bd34799effcc5144cb451129b', 1402630901, 'sess_last_access|i:1402630901;sess_ip_address|s:9:"127.0.0.1";sess_useragent|s:50:"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53";sess_last_regenerated|i:1402630653;userid|s:1:"1";name|s:5:"admin";roleid|s:1:"1";realname|s:5:"admin";dateline|s:19:"2014-06-04 16:50:53";lasttime|s:19:"2014-06-04 16:50:53";captcha|s:4:"7G6P";');
