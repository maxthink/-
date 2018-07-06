/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : 127.0.0.1:3306
Source Database       : cai

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2018-07-06 20:01:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin_group`
-- ----------------------------
DROP TABLE IF EXISTS `admin_group`;
CREATE TABLE `admin_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `powerid` varchar(200) DEFAULT NULL COMMENT '权限id',
  `order` int(2) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '是否可以用1，是；0，不',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='分组';

-- ----------------------------
-- Records of admin_group
-- ----------------------------
INSERT INTO `admin_group` VALUES ('1', '总平台管理员', '1,8,9,2,11,12,13,14,15,16,29,32,34,47,48,49,50,51,52,6,37,38,39,41,42,43,44,45,46,10,53', '0', '1');
INSERT INTO `admin_group` VALUES ('2', '总平台副管理员', '2,6,10,53', '0', '1');
INSERT INTO `admin_group` VALUES ('3', '站长', '1,8,9,54,53,2,11,12,13,14,15,16,17,33,28,31,47,48,49,50,51,52,10', '0', '1');
INSERT INTO `admin_group` VALUES ('4', '副站长', '1,2,12,13,14,29,6,10,53', '0', '1');

-- ----------------------------
-- Table structure for `admin_module`
-- ----------------------------
DROP TABLE IF EXISTS `admin_module`;
CREATE TABLE `admin_module` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `level` tinyint(1) unsigned NOT NULL COMMENT '权限类型: 0:顶部导航: 1:模块; 2:模块列表',
  `p_id` tinyint(4) unsigned NOT NULL,
  `order` tinyint(3) unsigned NOT NULL COMMENT '同等级内排序',
  `action` varchar(32) NOT NULL,
  `option` varchar(32) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否可用',
  `show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示: 0:不显示; 1:显示;',
  PRIMARY KEY (`id`),
  KEY `action` (`action`,`option`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COMMENT='后台权限表';

-- ----------------------------
-- Records of admin_module
-- ----------------------------
INSERT INTO `admin_module` VALUES ('1', '首页', '0', '0', '0', '', '', '0', '0');
INSERT INTO `admin_module` VALUES ('2', '微信', '0', '0', '0', '', '', '1', '0');
INSERT INTO `admin_module` VALUES ('3', '菜管理', '0', '0', '0', '', '', '1', '1');
INSERT INTO `admin_module` VALUES ('4', '用户', '0', '0', '4', '', '', '0', '0');
INSERT INTO `admin_module` VALUES ('5', '权限', '0', '0', '5', '', '', '0', '0');
INSERT INTO `admin_module` VALUES ('6', '系统', '0', '0', '6', '', '', '1', '1');
INSERT INTO `admin_module` VALUES ('7', '数据库', '0', '0', '7', '', '', '0', '1');
INSERT INTO `admin_module` VALUES ('8', '首页', '1', '1', '8', 'Home', '', '1', '1');
INSERT INTO `admin_module` VALUES ('9', '系统环境状态', '2', '8', '0', 'Home', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('10', '网站运行状态', '0', '0', '0', 'Home', 'net', '0', '0');
INSERT INTO `admin_module` VALUES ('11', '新闻', '1', '2', '0', 'News', '', '0', '0');
INSERT INTO `admin_module` VALUES ('12', '列表', '2', '11', '0', 'News', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('13', '添加', '2', '11', '0', 'News', 'add', '1', '1');
INSERT INTO `admin_module` VALUES ('14', '删除', '2', '11', '0', 'News', 'delete', '1', '0');
INSERT INTO `admin_module` VALUES ('15', '编辑', '2', '11', '0', 'News', 'edit', '1', '0');
INSERT INTO `admin_module` VALUES ('16', '状态', '2', '11', '0', 'News', 'status', '1', '0');
INSERT INTO `admin_module` VALUES ('17', '查看', '2', '11', '0', 'News', 'view', '1', '0');
INSERT INTO `admin_module` VALUES ('18', '产品', '1', '2', '0', 'Product', '', '0', '1');
INSERT INTO `admin_module` VALUES ('19', '列表', '2', '18', '0', 'Product', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('20', '添加', '2', '18', '0', 'Product', 'add', '1', '1');
INSERT INTO `admin_module` VALUES ('21', '编辑', '2', '18', '0', 'Product', 'edit', '1', '0');
INSERT INTO `admin_module` VALUES ('22', '删除', '2', '18', '0', 'Product', 'delete', '1', '0');
INSERT INTO `admin_module` VALUES ('23', '状态', '2', '18', '0', 'Product', 'status', '1', '0');
INSERT INTO `admin_module` VALUES ('24', '产品列表', '1', '3', '0', 'Cai', 'Index', '1', '1');
INSERT INTO `admin_module` VALUES ('25', '列表', '2', '24', '0', 'Product', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('26', '删除', '2', '24', '0', 'Article', 'remove', '1', '0');
INSERT INTO `admin_module` VALUES ('27', '编辑', '2', '24', '0', 'Article', 'Modify', '1', '0');
INSERT INTO `admin_module` VALUES ('28', '列表', '2', '33', '0', 'Advert', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('29', '类别管理', '1', '2', '0', 'category', '', '0', '0');
INSERT INTO `admin_module` VALUES ('31', '添加广告', '2', '33', '0', 'Advert', 'add', '1', '1');
INSERT INTO `admin_module` VALUES ('32', '添加类别', '2', '29', '2', 'Category', 'add', '1', '1');
INSERT INTO `admin_module` VALUES ('33', '广告管理', '1', '2', '0', 'Advert', '', '0', '0');
INSERT INTO `admin_module` VALUES ('34', '列表', '2', '29', '1', 'category', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('35', '数据库操作', '1', '7', '1', 'Database', '', '1', '1');
INSERT INTO `admin_module` VALUES ('36', '数据库操作', '2', '35', '1', 'Database	', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('37', '系统模块管理', '1', '6', '1', 'Module', '', '1', '1');
INSERT INTO `admin_module` VALUES ('38', '列表', '2', '37', '1', 'Module', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('39', '删除', '2', '37', '0', 'Module', 'delete', '1', '0');
INSERT INTO `admin_module` VALUES ('40', '编辑', '2', '37', '0', 'Module', 'modify', '1', '0');
INSERT INTO `admin_module` VALUES ('41', '账号管理', '1', '6', '0', 'Manager', '', '1', '1');
INSERT INTO `admin_module` VALUES ('42', '账号列表', '2', '41', '0', 'Manager', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('43', '账号添加', '2', '41', '0', 'Manager', 'add', '1', '1');
INSERT INTO `admin_module` VALUES ('44', '权限管理', '1', '6', '0', '', '', '1', '1');
INSERT INTO `admin_module` VALUES ('45', '权限列表', '2', '44', '0', 'agroup', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('46', '权限添加', '2', '44', '0', 'agroup', 'add', '1', '1');
INSERT INTO `admin_module` VALUES ('47', '商家', '1', '2', '0', 'Businesses', '', '0', '0');
INSERT INTO `admin_module` VALUES ('48', '列表', '2', '47', '0', 'Businesses', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('49', '添加', '2', '47', '0', 'Businesses', 'add', '1', '1');
INSERT INTO `admin_module` VALUES ('50', '信息', '1', '2', '0', 'Info', '', '0', '0');
INSERT INTO `admin_module` VALUES ('51', '列表', '2', '50', '0', 'Info', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('52', '添加', '2', '50', '0', 'Info', 'add', '1', '1');
INSERT INTO `admin_module` VALUES ('53', '网站列表', '2', '54', '0', 'config', 'index', '0', '0');
INSERT INTO `admin_module` VALUES ('54', '网站设置', '1', '1', '0', '', '', '0', '0');
INSERT INTO `admin_module` VALUES ('55', '添加网站', '2', '54', '0', 'config', 'add', '0', '0');
INSERT INTO `admin_module` VALUES ('56', '借款管理', '1', '2', '0', 'Borrow', '', '0', '0');
INSERT INTO `admin_module` VALUES ('57', '借款信息', '2', '56', '0', 'Borrow', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('58', '借款编辑', '2', '56', '0', 'Borrow', 'modify', '1', '0');
INSERT INTO `admin_module` VALUES ('59', '借款删除', '2', '56', '0', 'Borrow', 'delete', '1', '0');
INSERT INTO `admin_module` VALUES ('60', '版本管理', '1', '2', '0', 'Version', '', '0', '0');
INSERT INTO `admin_module` VALUES ('61', '版本列表', '2', '60', '0', 'Version', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('62', '放款编辑', '2', '60', '0', 'Loan', 'modify', '1', '0');
INSERT INTO `admin_module` VALUES ('63', '放款删除', '2', '60', '0', 'Loan', 'delete', '1', '0');
INSERT INTO `admin_module` VALUES ('64', '状态修改', '2', '60', '0', 'Loan', 'status', '1', '0');
INSERT INTO `admin_module` VALUES ('65', '借款添加', '2', '56', '0', 'Borrow', 'add', '1', '1');
INSERT INTO `admin_module` VALUES ('66', '版本添加', '2', '60', '0', 'Version', 'modify', '1', '1');
INSERT INTO `admin_module` VALUES ('67', '文章页', '1', '2', '0', 'Article', '', '0', '0');
INSERT INTO `admin_module` VALUES ('68', '文章列表', '2', '67', '0', 'Article', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('69', '文章添加', '2', '67', '0', 'Article', 'add', '1', '1');
INSERT INTO `admin_module` VALUES ('70', '文章分类', '1', '2', '0', 'Acategory', '', '0', '0');
INSERT INTO `admin_module` VALUES ('71', '分类管理', '2', '70', '0', 'Acategory', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('72', '添加分类', '2', '70', '0', 'Acategory', 'add', '1', '0');
INSERT INTO `admin_module` VALUES ('73', '分类编辑', '2', '70', '0', 'Acategory', 'modify', '1', '0');
INSERT INTO `admin_module` VALUES ('74', '文章修改', '2', '67', '0', 'Article', 'modify', '1', '0');
INSERT INTO `admin_module` VALUES ('75', '提现管理', '1', '2', '0', 'Money', '', '0', '0');
INSERT INTO `admin_module` VALUES ('76', '提现列表', '2', '75', '0', 'Money', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('77', '提现状态修改', '2', '75', '0', 'Money', 'modify', '1', '0');
INSERT INTO `admin_module` VALUES ('93', '添加', '2', '24', '0', 'Article', 'Add', '1', '1');
INSERT INTO `admin_module` VALUES ('94', '功能', '1', '2', '0', 'Wxplugin', '', '1', '1');
INSERT INTO `admin_module` VALUES ('95', '关注自动回复', '2', '94', '0', 'Wxsubscribe', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('96', '群发功能', '2', '94', '0', 'Wxmessend', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('97', '自定义菜单', '2', '94', '0', 'Wxmenu', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('98', '产品订单', '1', '3', '0', 'Order', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('99', '订单列表', '2', '98', '0', 'Order', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('100', '分类编辑', '2', '98', '0', 'Atype', 'modify', '1', '0');
INSERT INTO `admin_module` VALUES ('101', '分类删除', '2', '98', '0', 'Atype', 'remove', '1', '0');
INSERT INTO `admin_module` VALUES ('102', '管理', '1', '2', '0', 'Wxmanage', '', '1', '1');
INSERT INTO `admin_module` VALUES ('103', '消息管理', '2', '102', '0', 'Wxmsg', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('104', '用户管理', '2', '102', '0', 'Wxuser', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('105', '素材管理', '2', '102', '0', 'Wxmedia', 'index', '1', '1');
INSERT INTO `admin_module` VALUES ('106', '二维码', '2', '102', '0', 'Wxqrcode', 'index', '1', '1');

-- ----------------------------
-- Table structure for `admin_power`
-- ----------------------------
DROP TABLE IF EXISTS `admin_power`;
CREATE TABLE `admin_power` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `level` tinyint(1) unsigned NOT NULL COMMENT '权限类型: 0:顶部导航: 1:模块; 2:模块列表',
  `p_id` tinyint(4) unsigned NOT NULL,
  `order` tinyint(3) unsigned NOT NULL COMMENT '同等级内排序',
  `action` varchar(32) NOT NULL,
  `option` varchar(32) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否可用',
  `show` tinyint(1) unsigned NOT NULL COMMENT '是否显示: 0:不显示; 1:显示;',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='后台权限表';

-- ----------------------------
-- Records of admin_power
-- ----------------------------
INSERT INTO `admin_power` VALUES ('1', '首页', '0', '0', '1', '', '', '1', '0');
INSERT INTO `admin_power` VALUES ('2', '内容发布', '0', '0', '2', '', '', '1', '0');
INSERT INTO `admin_power` VALUES ('3', '客户留言', '0', '0', '3', '', '', '1', '0');
INSERT INTO `admin_power` VALUES ('4', '用户', '0', '0', '4', '', '', '0', '0');
INSERT INTO `admin_power` VALUES ('5', '权限', '0', '0', '5', '', '', '0', '0');
INSERT INTO `admin_power` VALUES ('6', '系统', '0', '0', '6', '', '', '0', '0');
INSERT INTO `admin_power` VALUES ('7', '数据库', '0', '0', '7', '', '', '0', '0');
INSERT INTO `admin_power` VALUES ('8', '首页', '1', '1', '8', 'Home', '', '1', '1');
INSERT INTO `admin_power` VALUES ('9', '系统环境状态', '2', '8', '8', 'Home', 'index', '1', '1');
INSERT INTO `admin_power` VALUES ('10', '网站运行状态', '2', '8', '8', 'Home', 'net', '1', '1');
INSERT INTO `admin_power` VALUES ('11', '新闻', '1', '2', '0', 'News', '', '1', '1');
INSERT INTO `admin_power` VALUES ('12', '列表', '2', '11', '0', 'News', 'index', '1', '1');
INSERT INTO `admin_power` VALUES ('13', '添加', '2', '11', '0', 'News', 'add', '1', '1');
INSERT INTO `admin_power` VALUES ('14', '删除', '2', '11', '0', 'News', 'delete', '1', '0');
INSERT INTO `admin_power` VALUES ('15', '编辑', '2', '11', '0', 'News', 'edit', '1', '0');
INSERT INTO `admin_power` VALUES ('16', '状态', '2', '11', '0', 'News', 'status', '1', '0');
INSERT INTO `admin_power` VALUES ('17', '查看', '2', '11', '0', 'News', 'view', '1', '0');
INSERT INTO `admin_power` VALUES ('18', '产品', '1', '2', '0', 'Product', '', '1', '1');
INSERT INTO `admin_power` VALUES ('19', '列表', '2', '18', '0', 'Product', 'index', '1', '1');
INSERT INTO `admin_power` VALUES ('20', '添加', '2', '18', '0', 'Product', 'add', '1', '1');
INSERT INTO `admin_power` VALUES ('21', '编辑', '2', '18', '0', 'Product', 'edit', '1', '0');
INSERT INTO `admin_power` VALUES ('22', '删除', '2', '18', '0', 'Product', 'delete', '1', '0');
INSERT INTO `admin_power` VALUES ('23', '状态', '2', '18', '0', 'Product', 'status', '1', '0');
INSERT INTO `admin_power` VALUES ('24', '客户留言', '1', '3', '0', 'Message', '', '1', '1');
INSERT INTO `admin_power` VALUES ('25', '列表', '2', '24', '0', 'Message', 'index', '1', '1');
INSERT INTO `admin_power` VALUES ('26', '删除', '2', '24', '0', 'Message', 'delete', '1', '0');
INSERT INTO `admin_power` VALUES ('27', '回复', '2', '24', '0', 'Message', 'reply', '1', '0');
INSERT INTO `admin_power` VALUES ('28', '列表', '2', '33', '0', 'partner', 'index', '1', '1');
INSERT INTO `admin_power` VALUES ('29', '类别管理', '1', '2', '0', 'category', '', '1', '1');
INSERT INTO `admin_power` VALUES ('31', '添加伙伴', '2', '33', '0', 'Partner', 'add', '1', '1');
INSERT INTO `admin_power` VALUES ('32', '添加类别', '2', '29', '0', 'Category', 'add', '1', '1');
INSERT INTO `admin_power` VALUES ('33', '全球播映伙伴', '1', '2', '0', 'Partner', '', '1', '1');
INSERT INTO `admin_power` VALUES ('34', '列表', '2', '29', '0', 'category', 'index', '1', '1');

-- ----------------------------
-- Table structure for `admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `group` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('1', 'admin', '1111', '0');

-- ----------------------------
-- Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL COMMENT '产品名称',
  `title` varchar(64) NOT NULL COMMENT '产品标题',
  `cover` varchar(255) NOT NULL COMMENT '封面',
  `img` varchar(255) DEFAULT NULL COMMENT '图片详情',
  `priceunit` varchar(32) NOT NULL COMMENT '计量单位：公斤，筐，箱 等等',
  `price` float(4,2) NOT NULL,
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '0: 没问题的。',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='产品菜品列表';

-- ----------------------------
-- Records of product
-- ----------------------------

-- ----------------------------
-- Table structure for `shoppingcart`
-- ----------------------------
DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE `shoppingcart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `num` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shoppingcart
-- ----------------------------
