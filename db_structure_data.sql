/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : osmichas

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2014-03-04 02:59:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for image
-- ----------------------------
DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` longblob NOT NULL,
  `mime` varchar(100) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `size` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of image
-- ----------------------------

-- ----------------------------
-- Table structure for image_label
-- ----------------------------
DROP TABLE IF EXISTS `image_label`;
CREATE TABLE `image_label` (
  `image_id` bigint(20) NOT NULL,
  `label_id` bigint(20) NOT NULL,
  PRIMARY KEY (`label_id`,`image_id`),
  KEY `fk_tag_label_label_1` (`image_id`),
  CONSTRAINT `fk_image_label_label_1` FOREIGN KEY (`label_id`) REFERENCES `label` (`id`),
  CONSTRAINT `fk_tag_label_label_1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of image_label
-- ----------------------------

-- ----------------------------
-- Table structure for label
-- ----------------------------
DROP TABLE IF EXISTS `label`;
CREATE TABLE `label` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT NULL,
  `text` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `test` (`text`),
  CONSTRAINT `parent_label` FOREIGN KEY (`parent_id`) REFERENCES `label` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of label
-- ----------------------------
INSERT INTO `label` VALUES ('1', null, 'Начален курс ( 1-12 клас )');
INSERT INTO `label` VALUES ('2', '1', '1 клас');
INSERT INTO `label` VALUES ('3', '1', '2 клас');
INSERT INTO `label` VALUES ('4', '1', '3 клас');
INSERT INTO `label` VALUES ('5', '1', '4 клас');
INSERT INTO `label` VALUES ('6', '1', '5 клас');
INSERT INTO `label` VALUES ('7', '1', '6 клас');
INSERT INTO `label` VALUES ('8', '1', '7 клас');
INSERT INTO `label` VALUES ('9', '1', '8 клас');
INSERT INTO `label` VALUES ('10', '1', '9 клас');
INSERT INTO `label` VALUES ('11', '1', '10 клас');
INSERT INTO `label` VALUES ('12', '1', '11 клас');
INSERT INTO `label` VALUES ('13', '1', '12 клас');
INSERT INTO `label` VALUES ('14', null, 'Общообразователни предмети');
INSERT INTO `label` VALUES ('15', '14', 'Български език и литература');
INSERT INTO `label` VALUES ('16', '14', 'Математика');
INSERT INTO `label` VALUES ('17', '16', 'Алгебра');
INSERT INTO `label` VALUES ('18', '14', 'Информатика');
INSERT INTO `label` VALUES ('19', '14', 'Информационни технологии');
INSERT INTO `label` VALUES ('20', '14', 'Физика');
INSERT INTO `label` VALUES ('21', '14', 'Химия');
INSERT INTO `label` VALUES ('22', '14', 'История');
INSERT INTO `label` VALUES ('23', '14', 'География');
INSERT INTO `label` VALUES ('24', '14', 'Свят и личност');
INSERT INTO `label` VALUES ('25', '14', 'Философия');
INSERT INTO `label` VALUES ('26', '14', 'Психология');
INSERT INTO `label` VALUES ('27', '14', 'Етика');
INSERT INTO `label` VALUES ('28', '14', 'Музика');
INSERT INTO `label` VALUES ('29', '14', 'Изобразително изкуство');
INSERT INTO `label` VALUES ('30', '14', 'Труд и техника');
INSERT INTO `label` VALUES ('31', '14', 'ФВС');
INSERT INTO `label` VALUES ('32', null, 'Чужди езици');
INSERT INTO `label` VALUES ('33', '32', 'Английски');
INSERT INTO `label` VALUES ('34', '32', 'Немски');
INSERT INTO `label` VALUES ('35', '32', 'Френски');
INSERT INTO `label` VALUES ('36', '32', 'Руски');
INSERT INTO `label` VALUES ('37', '32', 'Испански');
INSERT INTO `label` VALUES ('38', '32', 'Японски');
INSERT INTO `label` VALUES ('39', '16', 'Геометрия');
INSERT INTO `label` VALUES ('40', '16', 'Тригонометрия');
INSERT INTO `label` VALUES ('41', '16', 'Стереометрия');
INSERT INTO `label` VALUES ('42', '16', 'Математическа логика');
INSERT INTO `label` VALUES ('43', '16', 'Висша математика');

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `image_id` bigint(20) NOT NULL,
  `label` text CHARACTER SET utf8,
  `start_x` int(100) DEFAULT '0',
  `start_y` int(100) DEFAULT '0',
  `end_x` int(100) DEFAULT '0',
  `end_y` int(100) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`),
  FULLTEXT KEY `label` (`label`),
  CONSTRAINT `image` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tag
-- ----------------------------
