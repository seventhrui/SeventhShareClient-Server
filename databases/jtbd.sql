/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : jtbd

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2014-06-26 17:32:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `pass` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `uptime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of admin
-- ----------------------------

-- ----------------------------
-- Table structure for blog
-- ----------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `content` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `commentcount` int(11) DEFAULT '0',
  `uptime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of blog
-- ----------------------------
INSERT INTO `blog` VALUES ('1', '5', 'titile1', 'titlecontentttttttttt', '0', '2014-06-26 07:09:09');
INSERT INTO `blog` VALUES ('2', '5', 'abctitle', 'abccontent', '0', '2014-06-26 08:34:27');
INSERT INTO `blog` VALUES ('3', '5', '你好', '13465', '0', '2014-06-26 08:45:40');
INSERT INTO `blog` VALUES ('4', '5', '???', '???', '0', '2014-06-26 09:07:20');
INSERT INTO `blog` VALUES ('5', '5', '???', '???', '0', '2014-06-26 09:09:47');
INSERT INTO `blog` VALUES ('6', '5', '????', '????', '0', '2014-06-26 09:14:20');
INSERT INTO `blog` VALUES ('7', '5', '????', '????', '0', '2014-06-26 09:16:53');
INSERT INTO `blog` VALUES ('8', '5', 'abc', 'abc', '0', '2014-06-26 09:25:08');
INSERT INTO `blog` VALUES ('9', '5', '1234567990', '1234567990', '0', '2014-06-26 09:26:45');
INSERT INTO `blog` VALUES ('10', '5', '123456789', '123456789', '0', '2014-06-26 09:30:34');

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `qq` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `uptime` timestamp NULL DEFAULT NULL,
  `salt` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('5', 'a', 'frDM0FBuHeEGeskALvyCD39B3WEyYzE0NDZmZGRl', 'a', 'a', 'a', null, '2c1446fdde');
INSERT INTO `customer` VALUES ('6', 'b', 'doMm7WcuqhXl+jbaRA4chrMMHQdlNmFhNmFlYWRk', '15588666999', '422555555@qq.com', '455669663', null, 'e6aa6aeadd');
INSERT INTO `customer` VALUES ('7', 'g', '+SbO0+pTT/ZdOMWxoy3ghlE5faRmYWM0MTk5ZGNh', '3', '4', '5', null, 'fac4199dca');
INSERT INTO `customer` VALUES ('9', 'lisi', 'LUO0jwtr5hp2haimPynws8J+usNhZGZjZDBiOGRj', '1', '2', '3', null, 'adfcd0b8dc');
INSERT INTO `customer` VALUES ('10', 'wangwu', '7oHY60XzY36gl15Qtt414hPihMQ1MmFiNTExMTQ5', '15555555555', '888888888@qq.com', '888888888', null, '52ab511149');
INSERT INTO `customer` VALUES ('11', 'q', 'dIVsS1pUXt/Cl+/WXq5Wm4W8/+8yM2JmZDhhMjZm', 'q', 'q', 'q', null, '23bfd8a26f');

-- ----------------------------
-- Table structure for drinks
-- ----------------------------
DROP TABLE IF EXISTS `drinks`;
CREATE TABLE `drinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `specs` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `picid` int(11) NOT NULL,
  `uptime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of drinks
-- ----------------------------

-- ----------------------------
-- Table structure for foods
-- ----------------------------
DROP TABLE IF EXISTS `foods`;
CREATE TABLE `foods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `specs` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `picid` int(11) NOT NULL,
  `uptime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of foods
-- ----------------------------

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `uptime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of menu
-- ----------------------------

-- ----------------------------
-- Table structure for pics
-- ----------------------------
DROP TABLE IF EXISTS `pics`;
CREATE TABLE `pics` (
  `picid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `uptime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`picid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of pics
-- ----------------------------

-- ----------------------------
-- Table structure for store
-- ----------------------------
DROP TABLE IF EXISTS `store`;
CREATE TABLE `store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `uptime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of store
-- ----------------------------
