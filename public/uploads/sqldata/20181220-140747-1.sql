-- -----------------------------
-- Think MySQL Data Transfer 
-- 
-- Host     : 
-- Port     : 
-- Database : 
-- 
-- Part : #1
-- Date : 2018-12-20 14:07:47
-- -----------------------------

SET FOREIGN_KEY_CHECKS = 0;


-- -----------------------------
-- Table structure for `sp_admin_log`
-- -----------------------------
DROP TABLE IF EXISTS `sp_admin_log`;
CREATE TABLE `sp_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `logintime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_admin_log`
-- -----------------------------
INSERT INTO `sp_admin_log` VALUES ('1', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-11-16 13:40:08');
INSERT INTO `sp_admin_log` VALUES ('2', '127.0.0.1', 'perry', '0|0|0|内网IP|内网IP', '2018-11-16 14:17:09');
INSERT INTO `sp_admin_log` VALUES ('3', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-11-16 14:17:30');
INSERT INTO `sp_admin_log` VALUES ('4', '127.0.0.1', 'perry', '0|0|0|内网IP|内网IP', '2018-11-16 16:38:58');
INSERT INTO `sp_admin_log` VALUES ('5', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-11-19 10:14:31');
INSERT INTO `sp_admin_log` VALUES ('6', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-11-20 11:44:19');
INSERT INTO `sp_admin_log` VALUES ('7', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-11-21 08:37:30');
INSERT INTO `sp_admin_log` VALUES ('8', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-11-22 09:39:20');
INSERT INTO `sp_admin_log` VALUES ('9', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-11-22 14:52:47');
INSERT INTO `sp_admin_log` VALUES ('10', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-11-27 09:16:38');
INSERT INTO `sp_admin_log` VALUES ('11', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-11-27 14:20:16');
INSERT INTO `sp_admin_log` VALUES ('12', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-11-28 09:16:53');
INSERT INTO `sp_admin_log` VALUES ('13', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-11-28 09:57:58');
INSERT INTO `sp_admin_log` VALUES ('14', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-11-29 11:50:50');
INSERT INTO `sp_admin_log` VALUES ('15', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-11-30 16:43:13');
INSERT INTO `sp_admin_log` VALUES ('16', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-03 09:08:34');
INSERT INTO `sp_admin_log` VALUES ('17', '127.0.0.1', '周工', '0|0|0|内网IP|内网IP', '2018-12-03 15:59:03');
INSERT INTO `sp_admin_log` VALUES ('18', '119.98.217.221', 'admin', '中国|0|湖北省|武汉市|电信', '2018-12-03 18:08:13');
INSERT INTO `sp_admin_log` VALUES ('19', '27.18.85.127', 'admin', '中国|0|湖北省|武汉市|电信', '2018-12-04 10:00:30');
INSERT INTO `sp_admin_log` VALUES ('20', '27.18.85.127', 'admin', '中国|0|湖北省|武汉市|电信', '2018-12-04 10:01:30');
INSERT INTO `sp_admin_log` VALUES ('21', '27.18.85.127', 'admin', '中国|0|湖北省|武汉市|电信', '2018-12-04 11:54:33');
INSERT INTO `sp_admin_log` VALUES ('22', '27.18.85.127', 'admin', '中国|0|湖北省|武汉市|电信', '2018-12-04 13:46:00');
INSERT INTO `sp_admin_log` VALUES ('23', '27.18.85.127', 'admin', '中国|0|湖北省|武汉市|电信', '2018-12-04 14:38:48');
INSERT INTO `sp_admin_log` VALUES ('24', '119.98.217.221', 'admin', '中国|0|湖北省|武汉市|电信', '2018-12-04 14:42:43');
INSERT INTO `sp_admin_log` VALUES ('25', '27.18.85.127', 'admin', '中国|0|湖北省|武汉市|电信', '2018-12-04 15:38:36');
INSERT INTO `sp_admin_log` VALUES ('26', '27.18.85.127', 'admin', '中国|0|湖北省|武汉市|电信', '2018-12-05 13:55:06');
INSERT INTO `sp_admin_log` VALUES ('27', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-05 15:05:13');
INSERT INTO `sp_admin_log` VALUES ('28', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-05 15:07:54');
INSERT INTO `sp_admin_log` VALUES ('29', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-05 15:38:07');
INSERT INTO `sp_admin_log` VALUES ('30', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-07 10:57:51');
INSERT INTO `sp_admin_log` VALUES ('31', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-07 11:20:24');
INSERT INTO `sp_admin_log` VALUES ('32', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-10 11:36:10');
INSERT INTO `sp_admin_log` VALUES ('33', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-11 17:19:40');
INSERT INTO `sp_admin_log` VALUES ('34', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-17 11:03:01');
INSERT INTO `sp_admin_log` VALUES ('35', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-17 12:01:01');
INSERT INTO `sp_admin_log` VALUES ('36', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-17 12:10:55');
INSERT INTO `sp_admin_log` VALUES ('37', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-17 16:45:24');
INSERT INTO `sp_admin_log` VALUES ('38', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-17 19:28:25');
INSERT INTO `sp_admin_log` VALUES ('39', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-18 18:33:46');
INSERT INTO `sp_admin_log` VALUES ('40', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-19 10:46:41');
INSERT INTO `sp_admin_log` VALUES ('41', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-19 11:38:10');
INSERT INTO `sp_admin_log` VALUES ('42', '127.0.0.1', 'admin', '0|0|0|内网IP|内网IP', '2018-12-19 15:57:26');

-- -----------------------------
-- Table structure for `sp_admin_node`
-- -----------------------------
DROP TABLE IF EXISTS `sp_admin_node`;
CREATE TABLE `sp_admin_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `desc` varchar(255) NOT NULL DEFAULT '',
  `parentid` int(11) NOT NULL DEFAULT '0',
  `controller` varchar(50) NOT NULL DEFAULT '',
  `action` varchar(50) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '节点类型，【1一级菜单，2二级菜单，3面板按钮】',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序号，越小越前',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，1正常，2禁用',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `addid` int(11) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updateid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COMMENT='后台权限节点表';

-- -----------------------------
-- Records of `sp_admin_node`
-- -----------------------------
INSERT INTO `sp_admin_node` VALUES ('1', '商品中心', '', '0', '', '', '1', '1', '1', '2018-08-21 11:03:59', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('2', '商品管理', '', '1', 'Goods', 'goods_list', '2', '1', '1', '2018-08-21 11:34:09', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('3', '商品添加', '', '2', 'Goods', 'goods_add', '3', '1', '1', '2018-08-21 11:34:25', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('4', '商品编辑', '', '2', 'Goods', 'goods_edit', '3', '2', '1', '2018-08-21 11:34:41', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('5', '商品设置（新品热销限量设置）', '', '2', 'Goods', '5', '3', '4', '1', '2018-08-21 11:35:07', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('6', '商品删除', '', '2', 'Goods', 'goods_del', '3', '3', '1', '2018-08-21 11:36:06', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('7', '商品处理（上下架）', '', '2', 'Goods', 'goods_deal', '3', '5', '1', '2018-08-21 11:37:19', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('8', '订单中心', '', '0', '', '', '1', '2', '1', '2018-08-21 11:38:22', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('9', '订单管理', '', '8', 'Order', 'order_list', '2', '1', '1', '2018-08-21 11:38:43', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('10', '订单详情', '', '9', 'Order', 'order_detail', '3', '2', '1', '2018-08-21 11:39:06', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('11', '订单发货', '', '9', 'Order', '2', '3', '3', '1', '2018-08-21 11:40:22', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('12', '组织管理', '', '0', '', '', '1', '5', '1', '2018-08-21 11:42:01', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('13', '节点管理', '', '12', 'Rbac', 'node_list', '2', '1', '1', '2018-08-21 11:42:18', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('14', '角色管理', '', '12', 'Rbac', 'role_list', '2', '2', '1', '2018-08-21 11:43:21', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('15', '管理员管理', '', '12', 'Rbac', 'admin_list', '2', '3', '1', '2018-08-21 11:43:47', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('16', '节点添加', '', '13', 'Rbac', 'node_add', '3', '1', '1', '2018-08-21 11:44:10', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('17', '节点排序', '', '13', 'Rbac', 'node_sort', '3', '3', '1', '2018-08-21 11:44:31', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('18', '节点编辑', '', '13', 'Rbac', 'node_edit', '3', '2', '1', '2018-08-21 11:44:55', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('19', '节点删除', '', '13', 'Rbac', 'node_del', '3', '4', '1', '2018-08-21 11:45:49', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('20', '角色添加', '', '14', 'Rbac', 'role_add', '3', '1', '1', '2018-08-21 11:46:34', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('21', '角色编辑', '', '14', 'Rbac', 'role_edit', '3', '2', '1', '2018-08-21 11:46:56', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('22', '角色删除', '', '14', 'Rbac', 'node_del', '3', '3', '1', '2018-08-21 11:47:16', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('23', '管理员添加', '', '15', 'Rbac', 'admin_add', '3', '1', '1', '2018-08-21 11:47:38', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('24', '管理员编辑', '', '15', 'Rbac', 'admin_edit', '3', '2', '1', '2018-08-21 11:47:58', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('25', '管理员删除', '', '15', 'Rbac', 'admin_del', '3', '3', '1', '2018-08-21 11:48:20', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('26', '用户中心', '', '0', '', '', '1', '3', '1', '2018-08-21 11:49:30', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('27', '用户管理', '', '26', 'Member', 'user_list', '2', '1', '1', '2018-08-21 11:50:25', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('28', '用户升级为团长', '', '27', 'Member', 'user_upgrade', '3', '1', '1', '2018-08-21 11:51:05', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('29', '修改用户的团长', '', '27', 'Member', 'user_change', '3', '2', '1', '2018-08-21 11:51:28', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('30', '团长管理', '', '26', 'Member', 'grouper_list', '2', '2', '1', '2018-08-21 11:51:52', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('31', '团长降级', '', '30', 'Member', 'grouper_down', '3', '1', '1', '2018-08-21 11:52:11', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('32', '内容管理', '', '0', '', '', '1', '4', '1', '2018-08-21 11:52:42', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('33', '团长公告', '', '32', 'Message', 'notice_list', '2', '1', '1', '2018-08-21 11:53:28', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('34', '公告添加', '', '33', 'Message', '1', '3', '1', '1', '2018-08-21 11:54:00', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('35', '公告编辑', '', '33', 'Message', 'notice_edit', '3', '2', '1', '2018-08-21 11:54:24', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('36', '公告删除', '', '33', 'Message', 'notice_del', '3', '3', '1', '2018-08-21 11:55:05', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('37', '系统管理', '', '0', '', '', '1', '6', '1', '2018-08-21 11:55:19', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('64', '小区编辑', '', '62', 'System', 'area_edit', '3', '2', '1', '2018-11-29 17:59:29', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('61', '日志管理', '', '37', 'System', 'config_log', '2', '5', '1', '2018-11-16 13:47:19', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('42', '系统配置', '', '37', 'System', 'config_list', '2', '3', '1', '2018-08-21 11:57:16', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('43', '文件管理', '', '37', 'File', 'choose', '2', '4', '1', '2018-08-21 11:58:00', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('44', '分类管理', '', '1', 'Goods', 'category_list', '2', '2', '1', '2018-08-21 12:04:43', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('45', '分类添加', '', '44', 'Goods', 'category_add', '3', '1', '1', '2018-08-21 12:05:21', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('46', '分类编辑', '', '44', 'Goods', 'category_edit', '3', '2', '1', '2018-08-21 12:05:45', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('47', '分类排序', '', '44', 'Goods', 'category_sort', '3', '3', '1', '2018-08-21 12:06:20', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('48', '分类删除', '', '44', 'Goods', 'category_del', '3', '4', '1', '2018-08-21 12:06:46', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('49', '团长结算', '', '30', 'Member', 'grouper_bill', '3', '2', '1', '2018-08-31 09:33:46', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('50', '团长佣金明细', '', '30', 'Member', 'grouper_income', '3', '3', '1', '2018-08-31 09:34:10', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('51', '订单导出', '', '9', 'Order', 'order_export', '3', '3', '1', '2018-09-04 10:39:20', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('52', '数据统计', '', '37', 'Count', 'count_index', '2', '1', '1', '2018-09-05 11:24:15', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('53', '日销售额统计', '', '52', 'Count', 'count_sale', '3', '1', '1', '2018-09-05 11:32:11', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('54', '商品销量统计', '', '52', 'Count', 'count_goods', '3', '2', '1', '2018-09-05 20:48:06', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('55', '内容中心', '', '0', '', '', '1', '4', '1', '2018-11-14 15:54:54', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('56', '轮播管理', '', '55', 'Content', 'swiper_list', '2', '1', '1', '2018-11-14 15:55:30', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('57', '轮播添加', '', '56', 'Content', 'swiper_add', '3', '2', '1', '2018-11-14 15:56:24', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('58', '轮播编辑', '', '56', 'Content', 'swiper_edit', '3', '3', '1', '2018-11-14 15:56:44', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('59', '轮播删除', '', '56', 'Content', 'swiper_del', '3', '4', '1', '2018-11-14 15:57:07', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('60', '积分管理', '', '26', 'Member', 'user_point', '2', '3', '1', '2018-11-15 14:23:45', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('63', '小区添加', '', '62', 'System', 'area_add', '3', '1', '1', '2018-11-29 17:59:12', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('62', '小区管理', '', '26', 'System', 'area_list', '2', '3', '1', '2018-11-29 17:58:06', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('65', '小区开启，禁用', '', '62', 'System', 'area_deal', '3', '3', '1', '2018-11-29 17:59:46', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('66', '数据备份', '', '37', 'Tools', 'index_list', '2', '6', '1', '2018-12-07 11:06:32', '1', '2018-12-07 11:06:56', '1');
INSERT INTO `sp_admin_node` VALUES ('67', '数据恢复', '', '37', 'Tools', 'restore_list', '2', '7', '1', '2018-12-07 11:07:43', '1', '2018-12-07 11:07:43', '1');

-- -----------------------------
-- Table structure for `sp_admin_right`
-- -----------------------------
DROP TABLE IF EXISTS `sp_admin_right`;
CREATE TABLE `sp_admin_right` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleid` int(11) NOT NULL DEFAULT '0',
  `nodeid` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `addid` int(11) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=471 DEFAULT CHARSET=utf8 COMMENT='后台权限节点、角色关联表';

-- -----------------------------
-- Records of `sp_admin_right`
-- -----------------------------
INSERT INTO `sp_admin_right` VALUES ('328', '1', '54', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('327', '1', '53', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('326', '1', '52', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('325', '1', '37', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('324', '1', '25', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('323', '1', '24', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('322', '1', '23', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('321', '1', '15', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('320', '1', '22', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('319', '1', '21', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('318', '1', '20', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('317', '1', '14', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('316', '1', '19', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('315', '1', '17', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('314', '1', '18', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('313', '1', '16', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('312', '1', '13', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('311', '1', '12', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('310', '1', '36', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('309', '1', '35', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('308', '1', '34', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('307', '1', '33', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('306', '1', '32', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('410', '2', '1', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('422', '2', '8', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('412', '2', '3', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('437', '2', '64', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('439', '2', '60', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('458', '3', '7', '1', '2018-12-19 16:03:10', '1', '2018-12-19 16:03:10', '1');
INSERT INTO `sp_admin_right` VALUES ('418', '2', '45', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('424', '2', '10', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('436', '2', '63', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('416', '2', '7', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('427', '2', '26', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('457', '3', '5', '1', '2018-12-19 16:03:10', '1', '2018-12-19 16:03:10', '1');
INSERT INTO `sp_admin_right` VALUES ('420', '2', '47', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('456', '3', '6', '1', '2018-12-19 16:03:10', '1', '2018-12-19 16:03:10', '1');
INSERT INTO `sp_admin_right` VALUES ('429', '2', '28', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('426', '2', '11', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('430', '2', '29', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('425', '2', '51', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('413', '2', '4', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('305', '1', '50', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('304', '1', '49', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('303', '1', '31', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('302', '1', '30', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('301', '1', '29', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('300', '1', '28', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('299', '1', '27', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('298', '1', '26', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('297', '1', '11', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('296', '1', '51', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('295', '1', '10', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('294', '1', '9', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('293', '1', '8', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('292', '1', '48', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('291', '1', '47', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('290', '1', '46', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('289', '1', '45', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('288', '1', '44', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('287', '1', '7', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('286', '1', '5', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('285', '1', '6', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('284', '1', '4', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('283', '1', '3', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('282', '1', '2', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('281', '1', '1', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('329', '1', '38', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('330', '1', '39', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('331', '1', '40', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('332', '1', '41', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('333', '1', '42', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('334', '1', '43', '1', '2018-11-15 11:45:44', '1', '2018-11-15 11:45:44', '1');
INSERT INTO `sp_admin_right` VALUES ('455', '3', '4', '1', '2018-12-19 16:03:10', '1', '2018-12-19 16:03:10', '1');
INSERT INTO `sp_admin_right` VALUES ('419', '2', '46', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('431', '2', '30', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('454', '3', '3', '1', '2018-12-19 16:03:10', '1', '2018-12-19 16:03:10', '1');
INSERT INTO `sp_admin_right` VALUES ('453', '3', '2', '1', '2018-12-19 16:03:10', '1', '2018-12-19 16:03:10', '1');
INSERT INTO `sp_admin_right` VALUES ('434', '2', '50', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('433', '2', '49', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('438', '2', '65', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('452', '3', '1', '1', '2018-12-19 16:03:10', '1', '2018-12-19 16:03:10', '1');
INSERT INTO `sp_admin_right` VALUES ('435', '2', '62', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('411', '2', '2', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('414', '2', '6', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('417', '2', '44', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('428', '2', '27', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('432', '2', '31', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('415', '2', '5', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('423', '2', '9', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_right` VALUES ('421', '2', '48', '1', '2018-12-03 16:00:11', '1', '2018-12-03 16:00:11', '1');

-- -----------------------------
-- Table structure for `sp_admin_role`
-- -----------------------------
DROP TABLE IF EXISTS `sp_admin_role`;
CREATE TABLE `sp_admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `desc` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1正常，2禁用',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `addid` int(11) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='后台权限角色表';

-- -----------------------------
-- Records of `sp_admin_role`
-- -----------------------------
INSERT INTO `sp_admin_role` VALUES ('1', '客服', '', '1', '2018-09-10 13:30:57', '1', '2018-09-10 13:30:57', '1');
INSERT INTO `sp_admin_role` VALUES ('2', '管理员', '', '1', '2018-11-14 15:14:48', '1', '2018-12-03 16:00:11', '1');
INSERT INTO `sp_admin_role` VALUES ('3', '超级管理员', '', '1', '2018-11-16 16:38:02', '1', '2018-12-19 16:03:10', '1');

-- -----------------------------
-- Table structure for `sp_admin_user`
-- -----------------------------
DROP TABLE IF EXISTS `sp_admin_user`;
CREATE TABLE `sp_admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `nickname` varchar(20) NOT NULL DEFAULT '',
  `sex` tinyint(1) NOT NULL DEFAULT '1',
  `roleid` int(11) NOT NULL DEFAULT '0',
  `lastlogin` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `addid` int(11) NOT NULL DEFAULT '0',
  `mobile` varchar(11) NOT NULL DEFAULT '',
  `groupid` int(11) NOT NULL DEFAULT '0' COMMENT '绑定团长ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='后台用户表';

-- -----------------------------
-- Records of `sp_admin_user`
-- -----------------------------
INSERT INTO `sp_admin_user` VALUES ('1', 'admin', '0192023a7bbd73250516f069df18b500', 'admin', '1', '0', '2018-12-19 15:57:26', '1', '2018-11-14 15:16:16', '3', '2017-01-01 00:00:00', '0', '15952585858', '0');
INSERT INTO `sp_admin_user` VALUES ('3', 'perry', 'e10adc3949ba59abbe56e057f20f883e', '123456', '1', '3', '2018-11-16 16:38:58', '1', '2018-11-16 16:38:33', '1', '2018-11-14 15:15:10', '1', '13888888888', '0');
INSERT INTO `sp_admin_user` VALUES ('5', 'admin1', 'e10adc3949ba59abbe56e057f20f883e', '111111', '1', '1', '2018-12-19 11:38:33', '1', '2018-12-19 11:38:33', '1', '2018-12-19 11:38:33', '1', '15685858585', '1');

-- -----------------------------
-- Table structure for `sp_area`
-- -----------------------------
DROP TABLE IF EXISTS `sp_area`;
CREATE TABLE `sp_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '小区名称',
  `address` varchar(200) NOT NULL DEFAULT '' COMMENT '详细地址',
  `lat` varchar(40) NOT NULL DEFAULT '' COMMENT '纬度',
  `lng` varchar(40) NOT NULL DEFAULT '' COMMENT '经度',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `addid` int(11) NOT NULL DEFAULT '0',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_area`
-- -----------------------------
INSERT INTO `sp_area` VALUES ('1', '万科魅力之城', '高新四路万科魅力之城', '30.449395', '114.438636', '1', '1', '2018-09-30 21:29:46', '1', '2018-11-22 09:47:02');
INSERT INTO `sp_area` VALUES ('2', '金地意境', '中芯一路金地艺境', '30.443864', '114.436169', '1', '1', '2018-10-01 10:10:06', '1', '2018-11-22 09:48:05');
INSERT INTO `sp_area` VALUES ('3', '锦绣龙城', '龙城路锦绣龙城', '30.465302', '114.385958', '1', '1', '2018-10-08 10:02:50', '1', '2018-11-22 09:49:01');
INSERT INTO `sp_area` VALUES ('4', '名湖豪庭', '天际路名湖豪庭', '30.456776', '114.378941', '1', '1', '2018-10-08 10:20:45', '1', '2018-11-22 09:50:00');
INSERT INTO `sp_area` VALUES ('5', '保利时代', '关山大道保利时代', '30.490628', '114.410226', '1', '1', '2018-10-08 10:22:24', '1', '2018-11-22 09:50:55');
INSERT INTO `sp_area` VALUES ('6', '凯乐花园', '武珞路凯乐花园', '30.539057', '114.323936', '1', '1', '2018-10-08 10:23:50', '1', '2018-11-22 09:52:16');
INSERT INTO `sp_area` VALUES ('7', '凤凰花园', '湖北省武汉市江夏区光谷大道与高新六路交叉口东北角', '30.438160', '114.425090', '1', '1', '2018-10-08 10:25:23', '1', '2018-11-22 09:52:56');
INSERT INTO `sp_area` VALUES ('8', '金地雄楚1号', '湖北省武汉市洪山区雄楚1号购物广场', '30.497183', '114.389552', '1', '1', '2018-10-08 10:45:02', '1', '2018-11-22 09:54:55');
INSERT INTO `sp_area` VALUES ('9', '当代国际花园', '光谷大道光谷国际花园', '30.462557', '114.414581', '2', '1', '2018-11-14 17:42:19', '1', '2018-12-10 15:40:31');
INSERT INTO `sp_area` VALUES ('10', '清江山水', '湖北省武汉市洪山区软件园中路与软件园路交汇处西侧', '30.472834', '114.400545', '2', '1', '2018-11-28 17:38:12', '1', '2018-12-10 15:34:40');

-- -----------------------------
-- Table structure for `sp_attr`
-- -----------------------------
DROP TABLE IF EXISTS `sp_attr`;
CREATE TABLE `sp_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `addid` int(11) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='属性表';


-- -----------------------------
-- Table structure for `sp_attr_value`
-- -----------------------------
DROP TABLE IF EXISTS `sp_attr_value`;
CREATE TABLE `sp_attr_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attrid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `addid` int(11) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品属性值表';


-- -----------------------------
-- Table structure for `sp_cart`
-- -----------------------------
DROP TABLE IF EXISTS `sp_cart`;
CREATE TABLE `sp_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) NOT NULL DEFAULT '0' COMMENT '用户id',
  `goodsid` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `skuid` int(11) NOT NULL DEFAULT '0',
  `num` int(11) NOT NULL DEFAULT '1' COMMENT '购物车数量',
  `fromid` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，1正常，2删除',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_cart`
-- -----------------------------
INSERT INTO `sp_cart` VALUES ('1', '12', '1', '0', '1', '0', '2', '2018-10-01 12:37:51');
INSERT INTO `sp_cart` VALUES ('2', '4', '2', '0', '13', '0', '2', '2018-10-01 13:00:40');
INSERT INTO `sp_cart` VALUES ('3', '3', '3', '0', '2', '0', '1', '2018-10-01 14:55:55');
INSERT INTO `sp_cart` VALUES ('4', '19', '2', '0', '1', '0', '1', '2018-10-01 18:05:23');
INSERT INTO `sp_cart` VALUES ('5', '4', '2', '0', '1', '0', '2', '2018-10-02 12:42:49');
INSERT INTO `sp_cart` VALUES ('6', '15', '1', '0', '1', '0', '1', '2018-10-02 19:06:34');
INSERT INTO `sp_cart` VALUES ('7', '12', '1', '0', '1', '0', '2', '2018-10-04 13:00:08');
INSERT INTO `sp_cart` VALUES ('8', '36', '6', '0', '2', '0', '1', '2018-10-06 14:32:47');
INSERT INTO `sp_cart` VALUES ('9', '36', '5', '0', '2', '0', '1', '2018-10-06 14:32:50');
INSERT INTO `sp_cart` VALUES ('10', '37', '1', '0', '1', '0', '1', '2018-10-06 14:43:04');
INSERT INTO `sp_cart` VALUES ('11', '40', '6', '0', '1', '0', '1', '2018-10-07 09:45:47');
INSERT INTO `sp_cart` VALUES ('12', '1', '6', '0', '1', '0', '2', '2018-10-07 15:29:03');
INSERT INTO `sp_cart` VALUES ('13', '1', '6', '0', '1', '0', '2', '2018-10-07 15:29:54');
INSERT INTO `sp_cart` VALUES ('14', '4', '1', '0', '1', '0', '2', '2018-10-07 17:06:34');
INSERT INTO `sp_cart` VALUES ('15', '45', '5', '0', '1', '0', '2', '2018-10-08 09:52:53');
INSERT INTO `sp_cart` VALUES ('16', '50', '10', '0', '1', '0', '2', '2018-10-09 08:13:57');
INSERT INTO `sp_cart` VALUES ('17', '19', '11', '0', '1', '0', '1', '2018-10-10 09:45:19');
INSERT INTO `sp_cart` VALUES ('18', '67', '12', '0', '1', '0', '1', '2018-10-10 14:21:03');
INSERT INTO `sp_cart` VALUES ('19', '68', '8', '0', '1', '0', '1', '2018-10-10 14:23:34');
INSERT INTO `sp_cart` VALUES ('20', '1', '12', '0', '1', '0', '2', '2018-10-10 16:45:48');
INSERT INTO `sp_cart` VALUES ('21', '1', '13', '0', '1', '0', '2', '2018-10-10 16:46:15');
INSERT INTO `sp_cart` VALUES ('22', '72', '8', '0', '1', '0', '2', '2018-10-22 22:02:17');
INSERT INTO `sp_cart` VALUES ('23', '72', '12', '0', '1', '0', '2', '2018-11-03 12:23:14');
INSERT INTO `sp_cart` VALUES ('24', '72', '13', '0', '1', '0', '2', '2018-11-03 12:23:18');
INSERT INTO `sp_cart` VALUES ('25', '73', '12', '0', '2', '0', '2', '2018-11-16 17:15:43');
INSERT INTO `sp_cart` VALUES ('26', '73', '12', '0', '1', '0', '1', '2018-11-26 19:14:34');
INSERT INTO `sp_cart` VALUES ('27', '73', '13', '0', '1', '0', '1', '2018-11-26 19:14:36');
INSERT INTO `sp_cart` VALUES ('28', '80', '12', '0', '2', '0', '2', '2018-11-28 14:14:42');
INSERT INTO `sp_cart` VALUES ('29', '80', '13', '0', '7', '0', '2', '2018-11-28 14:14:49');
INSERT INTO `sp_cart` VALUES ('30', '80', '2', '0', '6', '0', '2', '2018-11-28 14:15:16');
INSERT INTO `sp_cart` VALUES ('31', '78', '12', '0', '1', '0', '2', '2018-11-28 17:25:20');
INSERT INTO `sp_cart` VALUES ('32', '81', '4', '0', '1', '0', '2', '2018-11-29 08:56:39');
INSERT INTO `sp_cart` VALUES ('33', '78', '13', '0', '7', '0', '2', '2018-11-29 10:52:06');
INSERT INTO `sp_cart` VALUES ('34', '78', '14', '0', '3', '0', '2', '2018-11-29 10:52:10');
INSERT INTO `sp_cart` VALUES ('35', '80', '14', '0', '1', '0', '2', '2018-11-29 11:23:46');
INSERT INTO `sp_cart` VALUES ('36', '80', '11', '0', '1', '0', '2', '2018-11-29 11:23:50');
INSERT INTO `sp_cart` VALUES ('37', '80', '1', '0', '12', '0', '2', '2018-11-29 11:23:55');
INSERT INTO `sp_cart` VALUES ('38', '78', '2', '0', '7', '0', '2', '2018-11-29 17:42:08');
INSERT INTO `sp_cart` VALUES ('39', '78', '1', '0', '2', '0', '2', '2018-11-29 17:45:19');
INSERT INTO `sp_cart` VALUES ('40', '78', '6', '0', '1', '0', '2', '2018-11-29 17:45:53');
INSERT INTO `sp_cart` VALUES ('41', '80', '12', '0', '2', '0', '2', '2018-11-30 15:47:16');
INSERT INTO `sp_cart` VALUES ('42', '80', '13', '0', '1', '0', '2', '2018-11-30 15:47:19');
INSERT INTO `sp_cart` VALUES ('43', '80', '2', '0', '1', '0', '2', '2018-11-30 15:47:48');
INSERT INTO `sp_cart` VALUES ('44', '80', '6', '0', '1', '0', '2', '2018-11-30 15:47:51');
INSERT INTO `sp_cart` VALUES ('45', '80', '7', '0', '1', '0', '2', '2018-11-30 15:47:54');
INSERT INTO `sp_cart` VALUES ('46', '80', '12', '0', '2', '0', '2', '2018-11-30 17:39:46');
INSERT INTO `sp_cart` VALUES ('47', '78', '13', '0', '1', '0', '2', '2018-12-04 09:14:35');
INSERT INTO `sp_cart` VALUES ('48', '78', '12', '0', '4', '0', '2', '2018-12-04 09:56:18');
INSERT INTO `sp_cart` VALUES ('49', '83', '12', '0', '1', '0', '1', '2018-12-04 15:04:10');
INSERT INTO `sp_cart` VALUES ('50', '78', '2', '0', '1', '0', '1', '2018-12-05 08:55:47');
INSERT INTO `sp_cart` VALUES ('51', '80', '10', '0', '1', '0', '1', '2018-12-05 11:39:25');
INSERT INTO `sp_cart` VALUES ('52', '81', '13', '0', '1', '0', '2', '2018-12-06 18:57:29');

-- -----------------------------
-- Table structure for `sp_category`
-- -----------------------------
DROP TABLE IF EXISTS `sp_category`;
CREATE TABLE `sp_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sign` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `entitle` varchar(255) NOT NULL DEFAULT '',
  `desc` text,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序，越大排的越后',
  `level` tinyint(2) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `addid` int(11) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='商品分类表';

-- -----------------------------
-- Records of `sp_category`
-- -----------------------------
INSERT INTO `sp_category` VALUES ('1', '!d@ee6mnf@qqt&0m~r&p', '酒水饮料', '', '', '0', '3', '1', '1', '2018-10-02 12:38:11', '1', '2018-12-10 15:56:24', '1');
INSERT INTO `sp_category` VALUES ('2', 'utrxkci8rt#vd2p@$^ir', '水果', '', '', '0', '1', '1', '1', '2018-11-16 09:05:16', '1', '2018-12-10 15:56:24', '1');
INSERT INTO `sp_category` VALUES ('4', '58873570twhx0v75&ok8', '家用日化', '', '', '0', '3', '1', '1', '2018-11-16 09:06:14', '1', '2018-12-10 15:56:24', '1');
INSERT INTO `sp_category` VALUES ('5', 't-z&y&w%--nd1jf!^-~2', '绿植', '', '', '0', '4', '1', '1', '2018-11-16 09:06:39', '1', '2018-12-10 15:56:24', '1');
INSERT INTO `sp_category` VALUES ('3', '$4q1!t*1kyqkekctykw@', '休闲副食', '', '', '0', '2', '1', '1', '2018-11-16 09:05:59', '1', '2018-12-10 15:56:24', '1');
INSERT INTO `sp_category` VALUES ('6', 'tuxywfvlztsn!f0q$&~m', '一二三四五六', '', '', '0', '0', '1', '1', '2018-12-10 11:42:42', '1', '2018-12-10 15:56:24', '1');

-- -----------------------------
-- Table structure for `sp_company`
-- -----------------------------
DROP TABLE IF EXISTS `sp_company`;
CREATE TABLE `sp_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `sign` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `sp_config`
-- -----------------------------
DROP TABLE IF EXISTS `sp_config`;
CREATE TABLE `sp_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `sign` varchar(50) NOT NULL DEFAULT '' COMMENT '标识',
  `key` varchar(50) NOT NULL DEFAULT '',
  `params` varchar(255) NOT NULL DEFAULT '' COMMENT '参数',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `addid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='平台配置';

-- -----------------------------
-- Records of `sp_config`
-- -----------------------------
INSERT INTO `sp_config` VALUES ('1', '', 'system', 'sendTime', '3', '2018-10-01 13:16:23', '1', '2018-10-01 11:34:09', '1');
INSERT INTO `sp_config` VALUES ('2', '', 'system', 'shareTitle', '国庆特价7天 浏览', '2018-12-20 11:42:15', '1', '2018-10-01 11:34:09', '1');
INSERT INTO `sp_config` VALUES ('3', '', 'system', 'shareImage', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', '2018-12-20 11:42:15', '1', '2018-10-01 11:34:09', '1');
INSERT INTO `sp_config` VALUES ('4', '', 'system', 'text', '大家好，我们的特价活动马上开始了！', '2018-11-30 12:04:31', '1', '2018-10-01 11:34:09', '1');
INSERT INTO `sp_config` VALUES ('5', '', 'system', 'mobile', '0278877644', '2018-12-20 11:42:15', '1', '2018-10-07 09:39:33', '1');
INSERT INTO `sp_config` VALUES ('6', '', 'system', 'sharemobile', '19918055030', '2018-11-30 12:04:31', '1', '2018-11-03 12:21:49', '1');

-- -----------------------------
-- Table structure for `sp_file_group`
-- -----------------------------
DROP TABLE IF EXISTS `sp_file_group`;
CREATE TABLE `sp_file_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `parentid` int(11) NOT NULL DEFAULT '0',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `addid` int(11) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_file_group`
-- -----------------------------
INSERT INTO `sp_file_group` VALUES ('13', '泡泡干', '1', '0', '2018-10-08 12:42:51', '1', '2018-10-08 12:42:57', '1');
INSERT INTO `sp_file_group` VALUES ('14', '柚子', '1', '0', '2018-10-08 13:02:46', '1', '2018-10-08 13:02:49', '1');
INSERT INTO `sp_file_group` VALUES ('15', '火龙果', '1', '0', '2018-10-08 13:15:05', '1', '2018-10-08 13:15:10', '1');

-- -----------------------------
-- Table structure for `sp_file_resource`
-- -----------------------------
DROP TABLE IF EXISTS `sp_file_resource`;
CREATE TABLE `sp_file_resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL DEFAULT '0' COMMENT 'upload表id',
  `filekey` varchar(100) NOT NULL DEFAULT '' COMMENT '文件访问key',
  `sign` varchar(32) NOT NULL DEFAULT '' COMMENT '标记',
  `field` varchar(32) NOT NULL DEFAULT '' COMMENT '字段',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=528 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_file_resource`
-- -----------------------------
INSERT INTO `sp_file_resource` VALUES ('466', '136', '/uploads/images/20181114/070f585b3e7c060691bfdff018610f02.png', '9vo3n6e5uhi5$c#1pq9p', 'single');
INSERT INTO `sp_file_resource` VALUES ('438', '139', '/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', 'rfxux&xxge~rrf9v2jfm', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('428', '139', '/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', 'o^t9cq#7np&@bf891yc3', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('432', '138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', 'moorexu45&4@%8ndp^vi', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('436', '135', '/uploads/images/20181114/28cc933564973acc756d44eafcec7da3.png', 'm-l2xefnb$2xs@!l8&qk', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('420', '138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', '!d!jr@fnu7o1iu4opn6p', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('442', '139', '/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', '4w#78hqrw$i@5--fp8j*', 'single');
INSERT INTO `sp_file_resource` VALUES ('452', '139', '/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', '$8^z#ng^k5yp5g&zuwfw', 'single');
INSERT INTO `sp_file_resource` VALUES ('446', '138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', '4w#78hqrw$i@5--fp8j*', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('443', '138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', '4w#78hqrw$i@5--fp8j*', 'single');
INSERT INTO `sp_file_resource` VALUES ('422', '137', '/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', 'nyz8&#q6~n10vmoz1xee', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('437', '139', '/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', 'rfxux&xxge~rrf9v2jfm', 'single');
INSERT INTO `sp_file_resource` VALUES ('429', '135', '/uploads/images/20181114/28cc933564973acc756d44eafcec7da3.png', 'h1uc&2o5qi#kdtu-yz!v', 'single');
INSERT INTO `sp_file_resource` VALUES ('421', '137', '/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', 'nyz8&#q6~n10vmoz1xee', 'single');
INSERT INTO `sp_file_resource` VALUES ('441', '136', '/uploads/images/20181114/070f585b3e7c060691bfdff018610f02.png', '3bhwhdg$5sb^0mq38020', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('444', '135', '/uploads/images/20181114/28cc933564973acc756d44eafcec7da3.png', '4w#78hqrw$i@5--fp8j*', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('277', '138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', 'yz2f#iy1^gxzdk8hiive', 'single');
INSERT INTO `sp_file_resource` VALUES ('439', '137', '/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '3bhwhdg$5sb^0mq38020', 'single');
INSERT INTO `sp_file_resource` VALUES ('434', '136', '/uploads/images/20181114/070f585b3e7c060691bfdff018610f02.png', 'bl*!8p*6q8ugyrmp%rz^', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('455', '138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', 'iw&wvxn8@tuzqd@3fp4e', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('453', '139', '/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', '$8^z#ng^k5yp5g&zuwfw', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('467', '136', '/uploads/images/20181114/070f585b3e7c060691bfdff018610f02.png', '9vo3n6e5uhi5$c#1pq9p', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('445', '136', '/uploads/images/20181114/070f585b3e7c060691bfdff018610f02.png', '4w#78hqrw$i@5--fp8j*', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('427', '139', '/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', 'o^t9cq#7np&@bf891yc3', 'single');
INSERT INTO `sp_file_resource` VALUES ('454', '138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', 'iw&wvxn8@tuzqd@3fp4e', 'single');
INSERT INTO `sp_file_resource` VALUES ('527', '138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', 'f2@fgox$l$5v6*dequvg', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('526', '138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', 'f2@fgox$l$5v6*dequvg', 'single');
INSERT INTO `sp_file_resource` VALUES ('519', '138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', '~995-i4rjuq$$n8x2pnc', 'single');
INSERT INTO `sp_file_resource` VALUES ('399', '135', '/uploads/images/20181114/28cc933564973acc756d44eafcec7da3.png', 't-dv8%u69frb1qv1$u~~', 'single');
INSERT INTO `sp_file_resource` VALUES ('419', '138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', '!d!jr@fnu7o1iu4opn6p', 'single');
INSERT INTO `sp_file_resource` VALUES ('431', '138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', 'moorexu45&4@%8ndp^vi', 'single');
INSERT INTO `sp_file_resource` VALUES ('433', '136', '/uploads/images/20181114/070f585b3e7c060691bfdff018610f02.png', 'bl*!8p*6q8ugyrmp%rz^', 'single');
INSERT INTO `sp_file_resource` VALUES ('430', '135', '/uploads/images/20181114/28cc933564973acc756d44eafcec7da3.png', 'h1uc&2o5qi#kdtu-yz!v', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('435', '135', '/uploads/images/20181114/28cc933564973acc756d44eafcec7da3.png', 'm-l2xefnb$2xs@!l8&qk', 'single');
INSERT INTO `sp_file_resource` VALUES ('440', '136', '/uploads/images/20181114/070f585b3e7c060691bfdff018610f02.png', '3bhwhdg$5sb^0mq38020', 'single');
INSERT INTO `sp_file_resource` VALUES ('493', '139', '/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', 'k5h^gj7z1oi4pqyk^5#7', 'single');
INSERT INTO `sp_file_resource` VALUES ('494', '137', '/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', 'k5h^gj7z1oi4pqyk^5#7', 'atlas');
INSERT INTO `sp_file_resource` VALUES ('515', '137', '/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '-&&tb45ftf6^$0f#4@-6', 'single');
INSERT INTO `sp_file_resource` VALUES ('516', '139', '/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', '@o%7ei~dh&!3~2n*#pm8', 'single');
INSERT INTO `sp_file_resource` VALUES ('517', '139', '/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', 'e$c7&l#sjmsnk2$0in9j', 'single');
INSERT INTO `sp_file_resource` VALUES ('518', '138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', '$d!q0y91u%i#qb!xlsnq', 'single');

-- -----------------------------
-- Table structure for `sp_file_upload`
-- -----------------------------
DROP TABLE IF EXISTS `sp_file_upload`;
CREATE TABLE `sp_file_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filekey` varchar(100) NOT NULL DEFAULT '',
  `groupid` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(200) NOT NULL DEFAULT '',
  `filesize` varchar(20) NOT NULL DEFAULT '',
  `filetype` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `addid` int(11) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_filekey` (`filekey`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_file_upload`
-- -----------------------------
INSERT INTO `sp_file_upload` VALUES ('137', '/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '0', '2018-11-12_171441.png', '102002', 'image/png', '1', '2018-11-14 15:20:41', '1', '2018-11-14 15:20:41', '0');
INSERT INTO `sp_file_upload` VALUES ('135', '/uploads/images/20181114/28cc933564973acc756d44eafcec7da3.png', '0', 'a2.png', '273286', 'image/png', '1', '2018-11-14 15:20:36', '1', '2018-11-14 15:20:36', '0');
INSERT INTO `sp_file_upload` VALUES ('140', '/uploads/images/20181204/10b3d33bd075c71509e41c504593a12b.png', '0', 'B752F2FB-935A-44d8-9B21-85B110F453A9.png', '185148', 'image/png', '1', '2018-12-04 15:42:38', '1', '2018-12-04 15:42:38', '0');
INSERT INTO `sp_file_upload` VALUES ('141', '/uploads/images/20181205/f6384c12ab1bd5e5505aec46861bbb0f.jpg', '13', '吃.jpg', '147652', 'image/jpeg', '1', '2018-12-05 13:57:52', '1', '2018-12-05 13:57:52', '0');
INSERT INTO `sp_file_upload` VALUES ('142', '/uploads/images/20181205/4157655fe33d1c8b088f6963dd72d761.jpg', '13', '东湖绿道游玩手册.jpg', '76133', 'image/jpeg', '1', '2018-12-05 13:57:58', '1', '2018-12-05 13:57:58', '0');
INSERT INTO `sp_file_upload` VALUES ('138', '/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', '0', 'a3.png', '436760', 'image/png', '1', '2018-11-14 15:20:43', '1', '2018-11-14 15:20:43', '0');
INSERT INTO `sp_file_upload` VALUES ('139', '/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', '0', 'a4.png', '194877', 'image/png', '1', '2018-11-14 15:20:46', '1', '2018-11-14 15:20:46', '0');
INSERT INTO `sp_file_upload` VALUES ('136', '/uploads/images/20181114/070f585b3e7c060691bfdff018610f02.png', '0', 'a1.png', '266102', 'image/png', '1', '2018-11-14 15:20:39', '1', '2018-11-14 15:20:39', '0');

-- -----------------------------
-- Table structure for `sp_goods`
-- -----------------------------
DROP TABLE IF EXISTS `sp_goods`;
CREATE TABLE `sp_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsno` varchar(32) NOT NULL DEFAULT '' COMMENT '商品货号',
  `sign` varchar(32) NOT NULL DEFAULT '',
  `title` varchar(200) NOT NULL DEFAULT '',
  `entitle` varchar(200) NOT NULL DEFAULT '',
  `desc` longtext,
  `brandid` int(11) NOT NULL DEFAULT '0' COMMENT '品牌id',
  `price` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `saleprice` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价，展示用',
  `salenum` int(11) NOT NULL DEFAULT '0' COMMENT '总销量',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '总库存',
  `leftnum` int(11) NOT NULL DEFAULT '0' COMMENT '剩余库存',
  `scannum` int(11) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `commentnum` int(11) NOT NULL DEFAULT '0' COMMENT '评价次数',
  `goodcomment` int(11) NOT NULL DEFAULT '0' COMMENT '好评次数',
  `weight` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '重量，单位千克',
  `ispostage` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否包邮，1是2否',
  `isnew` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否新品',
  `isquality` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否精品',
  `ishot` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否热销',
  `issale` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否预售',
  `isstockout` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否缺货，1是2否',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1下架，2上架',
  `salestart` datetime NOT NULL DEFAULT '2018-09-01 00:00:00' COMMENT '预售开始时间',
  `saleend` datetime NOT NULL DEFAULT '2018-09-01 00:00:00' COMMENT '预售结束时间',
  `send` datetime NOT NULL DEFAULT '2018-09-01 00:00:00' COMMENT '配送时间',
  `scale` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '佣金比例',
  `sort` int(11) NOT NULL DEFAULT '0',
  `uptime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00' COMMENT '上架时间',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `addid` int(11) NOT NULL,
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  `gift` int(11) NOT NULL DEFAULT '0' COMMENT '赠送积分',
  `down` int(11) NOT NULL DEFAULT '0' COMMENT '消耗积分',
  `cash` int(11) NOT NULL DEFAULT '0' COMMENT '抵扣现金',
  `isopen` smallint(2) NOT NULL DEFAULT '0' COMMENT '积分规则是否开启 0否 1是',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '商品关注数（点击次数）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- -----------------------------
-- Records of `sp_goods`
-- -----------------------------
INSERT INTO `sp_goods` VALUES ('1', '', '9vo3n6e5uhi5$c#1pq9p', '米小可微醺米酒350ml', '', '', '0', '18', '28', '0', '100', '99', '0', '0', '0', '0', '2', '1', '2', '2', '2', '2', '2', '2018-09-01 00:00:00', '2018-12-29 00:00:00', '2018-12-30 00:00:00', '0', '6', '2017-01-01 00:00:00', '2018-10-01 10:06:54', '1', '2018-11-30 15:49:59', '1', '0', '15', '3', '1', '8');
INSERT INTO `sp_goods` VALUES ('2', '', 'nyz8&#q6~n10vmoz1xee', '日清合味道方便面整箱10口味6杯公仔面泡面海鲜速食面桶装整箱装', '', '', '0', '26.8', '59.8', '0', '100', '100', '0', '0', '0', '0', '2', '1', '2', '2', '2', '2', '2', '2018-09-01 00:00:00', '2018-12-29 00:00:00', '2018-12-30 00:00:00', '0', '7', '2017-01-01 00:00:00', '2018-10-01 12:16:14', '1', '2018-11-29 15:47:08', '1', '0', '0', '0', '0', '17');
INSERT INTO `sp_goods` VALUES ('3', '', 'm-l2xefnb$2xs@!l8&qk', '好照头黄金渔翅鱼刺湖南特产香辣好兆头洞庭湖鱼尾鱼排小吃零食', '', '', '0', '35', '89.9', '0', '200', '200', '0', '0', '0', '0', '2', '1', '2', '2', '2', '2', '2', '2018-09-01 00:00:00', '2018-12-05 00:00:00', '2018-12-10 00:00:00', '0', '4', '2017-01-01 00:00:00', '2018-10-01 12:59:00', '1', '2018-11-29 15:49:36', '1', '0', '0', '0', '0', '3');
INSERT INTO `sp_goods` VALUES ('4', '', '4w#78hqrw$i@5--fp8j*', 'HOLD LIVE小辣椒南瓜色口红哑光丝绒雾面脏橘土橘砖红豆沙色唇膏', '', '', '0', '19', '38', '0', '200', '199', '0', '0', '0', '0', '2', '1', '2', '1', '2', '2', '2', '2018-09-01 00:00:00', '2018-12-25 00:00:00', '2018-12-26 00:00:00', '0', '0', '2017-01-01 00:00:00', '2018-10-02 14:18:01', '1', '2018-11-29 15:50:40', '1', '0', '0', '0', '0', '10');
INSERT INTO `sp_goods` VALUES ('5', '', '3bhwhdg$5sb^0mq38020', '盼盼手撕面包早餐整箱 营养早餐蛋糕全麦面包批发网红小零食(25个左右)', '', '', '0', '31.8', '79.9', '0', '500', '499', '0', '0', '0', '0', '2', '1', '2', '2', '2', '2', '2', '2018-09-01 00:00:00', '2018-12-08 00:00:00', '2018-12-10 00:00:00', '0', '3', '2017-01-01 00:00:00', '2018-10-03 11:41:35', '1', '2018-11-29 15:50:23', '1', '0', '0', '0', '0', '4');
INSERT INTO `sp_goods` VALUES ('6', '', 'o^t9cq#7np&@bf891yc3', '智力燕麦片1500g冲饮即食无糖原味麦片健康膳食纤维营养早餐代餐', '', '', '0', '24.9', '54.8', '0', '200', '199', '0', '0', '0', '0', '2', '1', '2', '2', '2', '2', '2', '2018-09-01 00:00:00', '2018-12-29 00:00:00', '2018-12-30 11:44:42', '5', '5', '2017-01-01 00:00:00', '2018-10-03 11:44:30', '1', '2018-11-29 15:48:10', '1', '0', '0', '0', '0', '0');
INSERT INTO `sp_goods` VALUES ('7', '', 'bl*!8p*6q8ugyrmp%rz^', '绝艺鸭脖子小包装小吃肉食大礼包', '', '', '0', '39.9', '18.8', '0', '200', '200', '0', '0', '0', '0', '2', '1', '2', '2', '2', '2', '2', '2018-09-01 00:00:00', '2018-12-20 00:00:00', '2018-12-25 00:00:00', '0', '4', '2017-01-01 00:00:00', '2018-10-08 12:11:14', '1', '2018-11-29 15:49:15', '1', '0', '0', '0', '0', '2');
INSERT INTO `sp_goods` VALUES ('8', '', 'h1uc&2o5qi#kdtu-yz!v', '鱼庄主手撕素肉豆干素牛排8090怀旧零食麻辣湖南特产网红小吃辣条 50包', '', '', '0', '19.9', '39.9', '0', '200', '200', '0', '0', '0', '0', '2', '1', '2', '2', '2', '2', '2', '2018-09-01 00:00:00', '2018-12-01 00:00:00', '2018-12-14 00:00:00', '0', '5', '2017-01-01 00:00:00', '2018-10-08 12:19:29', '1', '2018-11-29 15:48:25', '1', '0', '0', '0', '0', '2');
INSERT INTO `sp_goods` VALUES ('9', '', 'moorexu45&4@%8ndp^vi', '湘山红纯鱿鱼麻辣即食袋装鱿鱼须即食鱿鱼丝湖南特产网红零食小吃18包', '', '', '0', '38.8', '15.8', '0', '200', '200', '0', '0', '0', '0', '2', '2', '2', '2', '2', '2', '2', '2018-09-01 00:00:00', '2018-12-01 00:00:00', '2018-12-05 00:00:00', '0', '4', '2017-01-01 00:00:00', '2018-10-08 12:26:48', '1', '2018-11-29 15:48:46', '1', '0', '0', '0', '0', '0');
INSERT INTO `sp_goods` VALUES ('10', '', 'rfxux&xxge~rrf9v2jfm', '湖南特产手撕香辣酱板鱼一包（108g）', '', '', '0', '39.9', '18.8', '0', '200', '200', '0', '0', '0', '0', '2', '2', '2', '2', '2', '2', '2', '2018-09-01 00:00:00', '2018-12-10 00:00:00', '2018-12-15 00:00:00', '0', '3', '2017-01-01 00:00:00', '2018-10-08 12:33:50', '1', '2018-11-29 15:49:59', '1', '0', '0', '0', '0', '0');
INSERT INTO `sp_goods` VALUES ('11', '', '!d!jr@fnu7o1iu4opn6p', '儿时手工泡泡皮干小吃70g*3包', '', '', '0', '15.8', '39.9', '0', '200', '199', '0', '0', '0', '0', '2', '2', '2', '2', '2', '2', '2', '2018-09-01 00:00:00', '2018-12-29 00:00:00', '2018-12-30 00:00:00', '0', '9', '2017-01-01 00:00:00', '2018-10-08 12:43:23', '1', '2018-11-29 15:46:49', '1', '0', '0', '0', '0', '7');
INSERT INTO `sp_goods` VALUES ('12', '', 'f2@fgox$l$5v6*dequvg', '红心文旦柚1份（7-8斤/份）', '高营养 低脂肪高营养 低', '', '0', '0.01', '72', '0', '200', '191', '0', '0', '0', '0', '2', '2', '2', '1', '1', '2', '2', '2018-11-01 09:00:00', '2018-12-29 20:00:00', '2018-12-30 00:00:00', '0', '12', '2017-01-01 00:00:00', '2018-10-08 13:07:58', '1', '2018-12-19 16:20:47', '1', '0', '0', '0', '0', '334');
INSERT INTO `sp_goods` VALUES ('13', '', '$8^z#ng^k5yp5g&zuwfw', '海南金都一号红心火龙果一份（3斤±2两）', '清香细滑 入口即化 口感绵密', '', '0', '18.8', '29.9', '0', '500', '497', '0', '0', '0', '0', '2', '2', '2', '2', '1', '2', '2', '2018-09-01 00:00:00', '2018-12-29 00:00:00', '2018-12-30 00:00:00', '0', '11', '2017-01-01 00:00:00', '2018-10-08 13:15:43', '1', '2018-11-30 09:21:48', '1', '0', '0', '0', '0', '22');
INSERT INTO `sp_goods` VALUES ('14', '', 'iw&wvxn8@tuzqd@3fp4e', '葡萄', '高营养 低脂肪 清香细滑 入口即化 口感绵密', '', '0', '10', '20', '0', '10000', '10000', '0', '0', '0', '0', '2', '1', '2', '2', '1', '2', '2', '2018-11-29 15:46:13', '2018-12-29 15:46:17', '2018-12-30 00:00:00', '0', '9', '2017-01-01 00:00:00', '2018-11-20 11:46:46', '1', '2018-11-30 09:22:07', '1', '0', '0', '0', '0', '17');

-- -----------------------------
-- Table structure for `sp_goods_attr`
-- -----------------------------
DROP TABLE IF EXISTS `sp_goods_attr`;
CREATE TABLE `sp_goods_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsid` int(11) NOT NULL DEFAULT '0',
  `attrid` int(11) NOT NULL DEFAULT '0' COMMENT '商品属性id',
  `attrvalueid` int(11) NOT NULL DEFAULT '0' COMMENT '商品属性值id',
  `skuid` int(11) NOT NULL DEFAULT '0' COMMENT 'SKUid',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品-属性值对应表';


-- -----------------------------
-- Table structure for `sp_goods_category`
-- -----------------------------
DROP TABLE IF EXISTS `sp_goods_category`;
CREATE TABLE `sp_goods_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsid` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `categoryid` int(11) NOT NULL DEFAULT '0' COMMENT '分类id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_goods_category`
-- -----------------------------
INSERT INTO `sp_goods_category` VALUES ('45', '9', '3');
INSERT INTO `sp_goods_category` VALUES ('46', '7', '3');
INSERT INTO `sp_goods_category` VALUES ('53', '14', '2');
INSERT INTO `sp_goods_category` VALUES ('39', '11', '3');
INSERT INTO `sp_goods_category` VALUES ('44', '8', '3');
INSERT INTO `sp_goods_category` VALUES ('50', '4', '4');
INSERT INTO `sp_goods_category` VALUES ('49', '5', '3');
INSERT INTO `sp_goods_category` VALUES ('47', '3', '3');
INSERT INTO `sp_goods_category` VALUES ('40', '2', '3');
INSERT INTO `sp_goods_category` VALUES ('48', '10', '3');
INSERT INTO `sp_goods_category` VALUES ('56', '1', '1');
INSERT INTO `sp_goods_category` VALUES ('43', '6', '3');
INSERT INTO `sp_goods_category` VALUES ('52', '13', '2');
INSERT INTO `sp_goods_category` VALUES ('71', '12', '2');

-- -----------------------------
-- Table structure for `sp_goods_sku`
-- -----------------------------
DROP TABLE IF EXISTS `sp_goods_sku`;
CREATE TABLE `sp_goods_sku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsid` int(11) NOT NULL DEFAULT '0',
  `goodsno` varchar(32) NOT NULL DEFAULT '' COMMENT '商品货号',
  `skuno` varchar(32) NOT NULL DEFAULT '' COMMENT 'sku货号',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '总库存',
  `leftnum` int(11) NOT NULL DEFAULT '0' COMMENT '剩余库存',
  `price` double(11,2) NOT NULL DEFAULT '0.00',
  `saleprice` double(11,2) NOT NULL DEFAULT '0.00',
  `weight` double(11,2) NOT NULL DEFAULT '0.00' COMMENT '重量，单位千克',
  `status` tinyint(11) NOT NULL DEFAULT '1',
  `uptime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00' COMMENT '上架时间',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `addid` int(11) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `sp_jobs`
-- -----------------------------
DROP TABLE IF EXISTS `sp_jobs`;
CREATE TABLE `sp_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_jobs`
-- -----------------------------
INSERT INTO `sp_jobs` VALUES ('1', 'default', '{\"job\":\"CancelOrderJob\",\"data\":\"35\"}', '0', '0', '', '1544095664', '1544093863');

-- -----------------------------
-- Table structure for `sp_message`
-- -----------------------------
DROP TABLE IF EXISTS `sp_message`;
CREATE TABLE `sp_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '标题',
  `content` varchar(1000) NOT NULL DEFAULT '' COMMENT '内容',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '类型：1团长公告',
  `fromid` int(11) NOT NULL DEFAULT '0' COMMENT '来自谁，系统通知填0',
  `istime` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否开启时间段，1是2否',
  `start` datetime NOT NULL DEFAULT '2018-01-01 00:00:00' COMMENT '时间段开始时间',
  `endt` datetime NOT NULL DEFAULT '2018-01-01 00:00:00' COMMENT '时间段结束时间',
  `addtime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00' COMMENT '添加时间',
  `updatetime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00' COMMENT ' 更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='消息表';

-- -----------------------------
-- Records of `sp_message`
-- -----------------------------
INSERT INTO `sp_message` VALUES ('1', '准备上线', '大家好，我们准备上线了！\n', '1', '0', '2', '2018-01-01 00:00:00', '2018-01-01 00:00:00', '2018-10-01 11:30:56', '2018-10-01 11:30:56');
INSERT INTO `sp_message` VALUES ('2', '测试', '嵯峨山上石', '1', '0', '2', '2018-01-01 00:00:00', '2018-01-01 00:00:00', '2018-12-10 14:04:53', '2018-12-10 14:04:53');

-- -----------------------------
-- Table structure for `sp_order`
-- -----------------------------
DROP TABLE IF EXISTS `sp_order`;
CREATE TABLE `sp_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderno` varchar(32) NOT NULL DEFAULT '' COMMENT '订单号',
  `payno` varchar(100) NOT NULL DEFAULT '' COMMENT '支付号',
  `transid` varchar(100) NOT NULL DEFAULT '' COMMENT '交易订单号',
  `transcompany` varchar(20) NOT NULL DEFAULT '' COMMENT '物流公司',
  `transno` varchar(200) NOT NULL DEFAULT '' COMMENT '运单号',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `orderfee` double(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '订单金额1【1=2+3+5-4】',
  `transfee` double(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '运费2',
  `goodsfee` double(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品金额3',
  `goodsnum` int(11) NOT NULL DEFAULT '0',
  `downpoint` int(11) NOT NULL DEFAULT '0' COMMENT '抵扣积分',
  `couponfee` double(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '优惠金额4',
  `invoicefee` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '税率金额5',
  `invoicescale` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '发票税率',
  `incomefee` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '团长收入',
  `payment` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付方式,1微信，2支付宝，3银联，4转账',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '收货人手机号',
  `mark` varchar(200) NOT NULL DEFAULT '' COMMENT '备注',
  `groupername` varchar(50) NOT NULL DEFAULT '' COMMENT '团长姓名',
  `groupermobile` varchar(20) NOT NULL DEFAULT '' COMMENT '团长手机号',
  `grouparea` varchar(200) NOT NULL DEFAULT '' COMMENT '提货门店',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '收货地址',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1待付款未发货，2已付款未发货，3已付款已发货，4已收货，5已评价，6未评价售后，7已评价售后',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `siteid` tinyint(2) NOT NULL DEFAULT '1',
  `isdel` tinyint(1) NOT NULL DEFAULT '2' COMMENT '删除标识，1是2否',
  `fromid` int(11) NOT NULL DEFAULT '0' COMMENT '团长用户id',
  `giftpoint` int(11) NOT NULL DEFAULT '0' COMMENT '赠送积分',
  `refundid` int(11) NOT NULL DEFAULT '0' COMMENT '退款订单ID',
  `refundstate` smallint(2) NOT NULL DEFAULT '0' COMMENT '退款状态 0未处理 1成功 2失败',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_orderno` (`orderno`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- -----------------------------
-- Records of `sp_order`
-- -----------------------------
INSERT INTO `sp_order` VALUES ('2', 'sp_20181130155556304622', '', '', '', '', '80', '368', '0', '386', '18', '90', '18', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '', '光谷大道光谷国际花园', '1', '1', '2018-11-30 15:55:56', '2018-11-30 17:41:22', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('3', 'sp_20181130163627520073', '', '', '', '', '80', '29.8', '0', '29.8', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '', '光谷大道光谷国际花园', '1', '1', '2018-11-30 16:36:27', '2018-11-30 17:39:22', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('4', 'sp_20181130174001731179', '', '', '', '', '80', '49.6', '0', '59.6', '2', '40', '10', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '', '光谷大道光谷国际花园', '1', '1', '2018-11-30 17:40:01', '2018-11-30 17:41:55', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('11', 'sp_20181203180211395922', '', '', '', '', '80', '18.8', '0', '18.8', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '', '光谷大道光谷国际花园', '1', '-1', '2018-12-03 18:02:11', '2018-12-04 12:06:51', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('12', 'sp_20181203180709414326', 'wx03180709446456b931317e922394932176', '', '', '', '80', '24.8', '0', '29.8', '1', '20', '5', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '', '光谷大道光谷国际花园', '1', '-1', '2018-12-03 18:07:09', '2018-12-04 12:06:52', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('13', 'sp_20181203180857540558', 'wx03180858123148fc2d3c35190841302630', '', '', '', '80', '24.8', '0', '29.8', '1', '20', '5', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '', '光谷大道光谷国际花园', '1', '-1', '2018-12-03 18:08:57', '2018-12-04 12:06:52', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('14', 'sp_20181203181038575298', 'wx0318103869302202634f5ed01498919516', '', '', '', '80', '0.01', '0', '0.01', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '', '光谷大道光谷国际花园', '1', '-1', '2018-12-03 18:09:41', '2018-12-04 12:06:52', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('15', 'sp_20181203181903671110', 'wx0318190374360861ca13fd0f0839366844', '4200000224201812037761974009', '', '', '80', '0.01', '0', '0.01', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '', '光谷大道光谷国际花园', '1', '2', '2018-12-03 18:19:03', '2018-12-03 18:19:21', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('16', 'sp_20181204085319214697', 'wx040853200435988dd3610d840160222565', '4200000233201812046672518231', '', '', '80', '0.01', '0', '0.01', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '', '光谷大道光谷国际花园', '1', '2', '2018-12-04 08:53:19', '2018-12-06 17:58:29', '1', '2', '80', '0', '1', '1');
INSERT INTO `sp_order` VALUES ('17', 'sp_20181204085607309015', 'wx040856076214416acf6638e21692527644', '4200000209201812048252222267', '', '', '80', '0.01', '0', '0.01', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '', '光谷大道光谷国际花园', '1', '4', '2018-12-04 08:56:07', '2018-12-04 08:56:25', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('18', 'sp_20181204085711142987', 'wx04085711662045bc3334d1f32665643271', '4200000216201812041821427213', '', '', '80', '0.01', '0', '0.01', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '', '光谷大道光谷国际花园', '1', '5', '2018-12-04 08:57:11', '2018-12-04 10:38:53', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('19', 'sp_20181204095600220114', 'wx0409560099263632cc51c1991331445869', '', '', '', '78', '217.6', '0', '217.6', '10', '0', '0', '0', '0', '0', '1', '哇咔咔', '18771377007', '嘎嘎嘎嘎嘎', '罗威', '19918055030', '', '湖北省武汉市江夏区光谷大道与高新六路交叉口东北角', '1', '-1', '2018-12-04 09:12:31', '2018-12-04 12:06:52', '1', '2', '4', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('20', 'sp_20181204094829967807', 'wx04094830056699c6a0ce10bc1320401500', '', '', '', '78', '18.8', '0', '18.8', '1', '0', '0', '0', '0', '0', '1', '哇咔咔', '18771377007', '111', '罗威', '19918055030', '', '湖北省武汉市江夏区光谷大道与高新六路交叉口东北角', '1', '-1', '2018-12-04 09:23:56', '2018-12-04 12:06:52', '1', '2', '4', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('21', 'sp_20181204095446707446', 'wx04095446346838b8095572a23750545080', '', '', '', '80', '0.01', '0', '0.01', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '', '光谷大道光谷国际花园', '1', '-1', '2018-12-04 09:54:46', '2018-12-04 12:06:52', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('22', 'sp_20181204101317812351', 'wx04101317372107c8c539c0632439561144', '', '', '', '80', '0.01', '0', '0.01', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '当代国际花园', '光谷大道光谷国际花园', '1', '-1', '2018-12-04 10:13:16', '2018-12-04 12:06:52', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('23', 'sp_20181204104342845621', 'wx04104342355094f81a6dc05d0189124701', '4200000237201812042559913874', '', '', '80', '0.01', '0', '0.01', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '当代国际花园', '光谷大道光谷国际花园', '1', '4', '2018-12-04 10:43:42', '2018-12-04 10:45:26', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('24', 'sp_20181204104908707767', 'wx04104908689690a7688ceb193882649114', '4200000226201812049027305496', '', '', '80', '0.01', '0', '0.01', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '当代国际花园', '光谷大道光谷国际花园', '1', '5', '2018-12-04 10:49:07', '2018-12-04 15:29:17', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('25', 'sp_20181204105034864000', 'wx04105035120266ba08497a9d1909936956', '', '', '', '80', '0.01', '0', '0.01', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '当代国际花园', '光谷大道光谷国际花园', '1', '5', '2018-12-04 10:50:34', '2018-12-04 15:29:13', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('26', 'sp_20181204120729130204', 'wx04120729778156f9d8833eb12143057053', '', '', '', '80', '0.01', '0', '0.01', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '当代国际花园', '光谷大道光谷国际花园', '1', '-1', '2018-12-04 12:07:29', '2018-12-04 12:37:30', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('27', 'sp_20181204133925974598', 'wx04133925624680b088207e273997084617', '', '', '', '80', '10', '0', '10', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '当代国际花园', '光谷大道光谷国际花园', '1', '-1', '2018-12-04 13:39:25', '2018-12-04 14:44:14', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('28', 'sp_20181204135735707945', 'wx04135735580478993084a24f2204002940', '', '', '', '80', '15.8', '0', '15.8', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '当代国际花园', '光谷大道光谷国际花园', '1', '-1', '2018-12-04 13:57:35', '2018-12-04 14:04:10', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('29', 'sp_20181204144746301215', 'wx041447469664219eccf6f9331196690968', '', '', '', '80', '31.8', '0', '31.8', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '当代国际花园', '光谷大道光谷国际花园', '1', '-1', '2018-12-04 14:47:46', '2018-12-04 14:50:47', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('30', 'sp_20181204145539176013', 'wx04145539786594dfb43d159d4044420358', '', '', '', '80', '31.8', '0', '31.8', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '当代国际花园', '光谷大道光谷国际花园', '1', '-1', '2018-12-04 14:55:39', '2018-12-04 14:58:40', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('31', 'sp_20181204150620384387', 'wx041506205552425d0f52c0242696174830', '4200000216201812043567264790', '', '', '83', '0.01', '0', '0.01', '1', '0', '0', '0', '0', '0', '1', '刘淦', '13164674715', '你们', '测试', '15927653253', '当代国际花园', '光谷大道光谷国际花园', '1', '4', '2018-12-04 15:06:20', '2018-12-04 15:07:25', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('32', 'sp_20181204210538620539', 'wx04210538813952e2d9d51a6f2736641797', '', '', '', '78', '0.04', '0', '0.04', '4', '0', '0', '0', '0', '0', '1', '哇咔咔', '18771377007', '', '罗威', '19918055030', '凤凰花园', '湖北省武汉市江夏区光谷大道与高新六路交叉口东北角', '1', '-1', '2018-12-04 21:04:06', '2018-12-04 21:34:08', '1', '2', '4', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('33', 'sp_20181205085133485240', 'wx05085133567126ef5375d1961392565829', '', '', '', '78', '0.01', '0', '0.01', '1', '0', '0', '0', '0', '0', '1', '哇咔咔', '18771377007', '', '罗威', '19918055030', '凤凰花园', '湖北省武汉市江夏区光谷大道与高新六路交叉口东北角', '1', '-1', '2018-12-05 08:51:33', '2018-12-05 09:21:36', '1', '2', '4', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('34', 'sp_20181205114141253222', 'wx051141421476075385b4c2300511209691', '', '', '', '80', '19', '0', '19', '1', '0', '0', '0', '0', '0', '1', 'Class2⃣ 0⃣ 1⃣ 8⃣', '15927653253', '', '测试', '15927653253', '当代国际花园', '光谷大道光谷国际花园', '1', '-1', '2018-12-05 11:41:41', '2018-12-05 12:11:43', '1', '2', '80', '0', '0', '0');
INSERT INTO `sp_order` VALUES ('35', 'sp_20181206185743845806', 'wx061857504492785e6d9680ee1960568666', '', '', '', '81', '37.8', '0', '37.8', '2', '0', '0', '0', '0', '0', '1', '徐超人不會飛', '15271878520', '', '罗威', '19918055030', '凤凰花园', '湖北省武汉市江夏区光谷大道与高新六路交叉口东北角', '1', '3', '2018-12-06 18:57:43', '2018-12-10 14:27:21', '1', '2', '4', '0', '0', '0');

-- -----------------------------
-- Table structure for `sp_order_goods`
-- -----------------------------
DROP TABLE IF EXISTS `sp_order_goods`;
CREATE TABLE `sp_order_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL DEFAULT '0',
  `orderno` varchar(32) NOT NULL DEFAULT '',
  `goodsid` int(11) NOT NULL DEFAULT '0',
  `goodsno` varchar(32) NOT NULL DEFAULT '' COMMENT '商品货号',
  `skuid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '商品标题',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '商品图片',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `price` double(11,2) NOT NULL DEFAULT '0.00' COMMENT '单价',
  `totalprice` double(11,2) NOT NULL DEFAULT '0.00' COMMENT '总价',
  `attrs` varchar(255) NOT NULL DEFAULT '' COMMENT 'sku属性，存json{"颜色":"红色","尺码":"L"}',
  `weight` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '重量，单位千克',
  `totalweight` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品总重量',
  `fromid` int(11) NOT NULL DEFAULT '0',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '赠送积分',
  `downpoint` int(11) NOT NULL DEFAULT '0' COMMENT '单件可以抵扣积分',
  `couponfee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '优惠金额',
  `coupontotal` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总优惠金额',
  `pointtotal` int(11) NOT NULL DEFAULT '0' COMMENT ' 总共抵扣积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='订单商品表';

-- -----------------------------
-- Records of `sp_order_goods`
-- -----------------------------
INSERT INTO `sp_order_goods` VALUES ('7', '2', 'sp_20181130155556304622', '1', '', '0', '米小可微醺米酒350ml', 'http://192.168.2.102:8000/uploads/images/20181114/070f585b3e7c060691bfdff018610f02.png', '12', '18', '216', '[]', '0', '0', '0', '0', '15', '3.00', '0.00', '90');
INSERT INTO `sp_order_goods` VALUES ('8', '2', 'sp_20181130155556304622', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'http://192.168.2.102:8000/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '2', '29.8', '59.6', '[]', '0', '0', '0', '20', '20', '5.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('9', '2', 'sp_20181130155556304622', '13', '', '0', '海南金都一号红心火龙果一份（3斤±2两）', 'http://192.168.2.102:8000/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', '1', '18.8', '18.8', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('10', '2', 'sp_20181130155556304622', '2', '', '0', '日清合味道方便面整箱10口味6杯公仔面泡面海鲜速食面桶装整箱装', 'http://192.168.2.102:8000/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '26.8', '26.8', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('11', '2', 'sp_20181130155556304622', '6', '', '0', '智力燕麦片1500g冲饮即食无糖原味麦片健康膳食纤维营养早餐代餐', 'http://192.168.2.102:8000/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', '1', '24.9', '24.9', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('12', '2', 'sp_20181130155556304622', '7', '', '0', '绝艺鸭脖子小包装小吃肉食大礼包', 'http://192.168.2.102:8000/uploads/images/20181114/070f585b3e7c060691bfdff018610f02.png', '1', '39.9', '39.9', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('13', '3', 'sp_20181130163627520073', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'http://192.168.2.102:8000/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '29.8', '29.8', '[]', '0', '0', '0', '20', '20', '5.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('14', '4', 'sp_20181130174001731179', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'http://192.168.2.102:8000/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '2', '29.8', '59.6', '[]', '0', '0', '0', '5', '20', '5.00', '0.00', '40');
INSERT INTO `sp_order_goods` VALUES ('15', '11', 'sp_20181203180211395922', '13', '', '0', '海南金都一号红心火龙果一份（3斤±2两）', 'http://192.168.2.102:8000/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', '1', '18.8', '18.8', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('16', '12', 'sp_20181203180709638563', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'http://192.168.2.102:8000/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '29.8', '29.8', '[]', '0', '0', '0', '5', '20', '5.00', '0.00', '20');
INSERT INTO `sp_order_goods` VALUES ('17', '13', 'sp_20181203180857836394', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'http://192.168.2.102:8000/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '29.8', '29.8', '[]', '0', '0', '0', '5', '20', '5.00', '0.00', '20');
INSERT INTO `sp_order_goods` VALUES ('18', '14', 'sp_20181203180941506179', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'http://192.168.2.102:8000/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '0.01', '0.01', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('19', '15', 'sp_20181203181903829580', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'http://192.168.2.102:8000/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '0.01', '0.01', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('20', '16', 'sp_20181204085319215457', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'http://192.168.2.102:8000/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '0.01', '0.01', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('21', '17', 'sp_20181204085607784242', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'http://192.168.2.102:8000/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '0.01', '0.01', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('22', '18', 'sp_20181204085711690735', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'http://192.168.2.102:8000/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '0.01', '0.01', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('23', '19', 'sp_20181204091231370701', '14', '', '0', '葡萄', 'http://192.168.2.102:8000/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', '3', '10', '30', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('24', '19', 'sp_20181204091231370701', '2', '', '0', '日清合味道方便面整箱10口味6杯公仔面泡面海鲜速食面桶装整箱装', 'http://192.168.2.102:8000/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '7', '26.8', '187.6', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('25', '20', 'sp_20181204092356176461', '13', '', '0', '海南金都一号红心火龙果一份（3斤±2两）', 'http://192.168.2.102:8000/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', '1', '18.8', '18.8', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('26', '21', 'sp_20181204095446445491', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'http://192.168.2.102:8000/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '0.01', '0.01', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('27', '22', 'sp_20181204101316936362', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'https://mprogram.jetsum.com/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '0.01', '0.01', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('28', '23', 'sp_20181204104342483858', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'https://mprogram.jetsum.com/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '0.01', '0.01', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('29', '24', 'sp_20181204104907250036', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'https://mprogram.jetsum.com/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '0.01', '0.01', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('30', '25', 'sp_20181204105034712547', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'https://mprogram.jetsum.com/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '0.01', '0.01', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('31', '26', 'sp_20181204120729730164', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'https://mprogram.jetsum.com/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '0.01', '0.01', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('32', '27', 'sp_20181204133925420586', '14', '', '0', '葡萄', 'https://mprogram.jetsum.com/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', '1', '10', '10', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('33', '28', 'sp_20181204135735843088', '11', '', '0', '儿时手工泡泡皮干小吃70g*3包', 'https://mprogram.jetsum.com/uploads/images/20181114/4102faec3cc8c0a31217b6ec086e30a0.png', '1', '15.8', '15.8', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('34', '29', 'sp_20181204144746556637', '5', '', '0', '盼盼手撕面包早餐整箱 营养早餐蛋糕全麦面包批发网红小零食(25个左右)', 'https://mprogram.jetsum.com/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '31.8', '31.8', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('35', '30', 'sp_20181204145539875798', '5', '', '0', '盼盼手撕面包早餐整箱 营养早餐蛋糕全麦面包批发网红小零食(25个左右)', 'https://mprogram.jetsum.com/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '31.8', '31.8', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('36', '31', 'sp_20181204150620849321', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'https://mprogram.jetsum.com/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '0.01', '0.01', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('37', '32', 'sp_20181204210406562821', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'https://mprogram.jetsum.com/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '4', '0.01', '0.04', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('38', '33', 'sp_20181205085133742560', '12', '', '0', '红心文旦柚1份（7-8斤/份）', 'https://mprogram.jetsum.com/uploads/images/20181114/aa9685d5c66114ae2744e69d7efa6960.png', '1', '0.01', '0.01', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('39', '34', 'sp_20181205114141429108', '4', '', '0', 'HOLD LIVE小辣椒南瓜色口红哑光丝绒雾面脏橘土橘砖红豆沙色唇膏', 'https://mprogram.jetsum.com/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', '1', '19', '19', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('40', '35', 'sp_20181206185743936499', '4', '', '0', 'HOLD LIVE小辣椒南瓜色口红哑光丝绒雾面脏橘土橘砖红豆沙色唇膏', 'https://mprogram.jetsum.com/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', '1', '19', '19', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');
INSERT INTO `sp_order_goods` VALUES ('41', '35', 'sp_20181206185743936499', '13', '', '0', '海南金都一号红心火龙果一份（3斤±2两）', 'https://mprogram.jetsum.com/uploads/images/20181114/48c45a47c6683ae296aa31d51af90dea.png', '1', '18.8', '18.8', '[]', '0', '0', '0', '0', '0', '0.00', '0.00', '0');

-- -----------------------------
-- Table structure for `sp_order_refund`
-- -----------------------------
DROP TABLE IF EXISTS `sp_order_refund`;
CREATE TABLE `sp_order_refund` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '退款表',
  `orderno` varchar(200) NOT NULL COMMENT '退款编号',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `title` varchar(200) NOT NULL COMMENT '退款说明',
  `addtime` int(10) NOT NULL COMMENT '申请时间',
  `orderid` varchar(200) NOT NULL COMMENT '订单id',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '退款金额',
  `status` smallint(2) NOT NULL DEFAULT '0' COMMENT '0申请中 1成功 2失败',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_order_refund`
-- -----------------------------
INSERT INTO `sp_order_refund` VALUES ('1', 'RW2018120617582935935', '80', '取消订单退款', '1544090309', '16', '0.01', '0');

-- -----------------------------
-- Table structure for `sp_order_temp`
-- -----------------------------
DROP TABLE IF EXISTS `sp_order_temp`;
CREATE TABLE `sp_order_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `cartid` varchar(200) NOT NULL DEFAULT '',
  `addressid` int(11) NOT NULL DEFAULT '0',
  `guds` text NOT NULL,
  `fromid` int(11) NOT NULL DEFAULT '0',
  `addtime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_order_temp`
-- -----------------------------
INSERT INTO `sp_order_temp` VALUES ('1', '6', '', '0', '[{\"goodsid\":1,\"skuid\":0,\"num\":1}]', '4', '2018-10-01 10:38:03');
INSERT INTO `sp_order_temp` VALUES ('2', '12', '1', '0', '[{\"goodsid\":\"1\",\"skuid\":\"0\",\"num\":\"1\"}]', '4', '2018-10-01 12:37:55');
INSERT INTO `sp_order_temp` VALUES ('3', '4', '', '0', '[{\"goodsid\":2,\"skuid\":0,\"num\":1}]', '4', '2018-10-01 13:00:33');
INSERT INTO `sp_order_temp` VALUES ('4', '4', '2', '0', '[{\"goodsid\":\"2\",\"skuid\":\"0\",\"num\":\"13\"}]', '4', '2018-10-01 13:00:48');
INSERT INTO `sp_order_temp` VALUES ('5', '4', '', '0', '[{\"goodsid\":2,\"skuid\":0,\"num\":1}]', '4', '2018-10-01 13:16:57');
INSERT INTO `sp_order_temp` VALUES ('6', '3', '3', '0', '[{\"goodsid\":\"3\",\"skuid\":\"0\",\"num\":\"1\"}]', '4', '2018-10-01 14:56:15');
INSERT INTO `sp_order_temp` VALUES ('7', '4', '5', '0', '[{\"goodsid\":\"2\",\"skuid\":\"0\",\"num\":\"1\"}]', '4', '2018-10-02 12:42:53');
INSERT INTO `sp_order_temp` VALUES ('8', '15', '6', '0', '[{\"goodsid\":\"1\",\"skuid\":\"0\",\"num\":\"1\"}]', '4', '2018-10-02 19:06:38');
INSERT INTO `sp_order_temp` VALUES ('9', '12', '7', '0', '[{\"goodsid\":\"1\",\"skuid\":\"0\",\"num\":\"1\"}]', '4', '2018-10-04 13:00:11');
INSERT INTO `sp_order_temp` VALUES ('10', '37', '10', '0', '[{\"goodsid\":\"1\",\"skuid\":\"0\",\"num\":\"1\"}]', '4', '2018-10-06 14:43:06');
INSERT INTO `sp_order_temp` VALUES ('11', '40', '', '0', '[{\"goodsid\":6,\"skuid\":0,\"num\":1}]', '4', '2018-10-07 09:45:50');
INSERT INTO `sp_order_temp` VALUES ('12', '40', '11', '0', '[{\"goodsid\":\"6\",\"skuid\":\"0\",\"num\":\"1\"}]', '4', '2018-10-07 09:46:03');
INSERT INTO `sp_order_temp` VALUES ('13', '1', '12', '0', '[{\"goodsid\":\"6\",\"skuid\":\"0\",\"num\":\"1\"}]', '4', '2018-10-07 15:29:07');
INSERT INTO `sp_order_temp` VALUES ('14', '1', '13', '0', '[{\"goodsid\":\"6\",\"skuid\":\"0\",\"num\":\"1\"}]', '4', '2018-10-07 15:29:59');
INSERT INTO `sp_order_temp` VALUES ('15', '4', '14', '0', '[{\"goodsid\":\"1\",\"skuid\":\"0\",\"num\":\"1\"}]', '4', '2018-10-07 17:06:36');
INSERT INTO `sp_order_temp` VALUES ('16', '45', '15', '0', '[{\"goodsid\":\"5\",\"skuid\":\"0\",\"num\":\"1\"}]', '4', '2018-10-08 09:52:57');
INSERT INTO `sp_order_temp` VALUES ('17', '48', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '15', '2018-10-08 20:14:27');
INSERT INTO `sp_order_temp` VALUES ('18', '46', '', '0', '[{\"goodsid\":13,\"skuid\":0,\"num\":1}]', '15', '2018-10-09 14:03:38');
INSERT INTO `sp_order_temp` VALUES ('19', '19', '17', '0', '[{\"goodsid\":\"11\",\"skuid\":\"0\",\"num\":\"1\"}]', '4', '2018-10-10 09:45:25');
INSERT INTO `sp_order_temp` VALUES ('20', '67', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '15', '2018-10-10 14:21:08');
INSERT INTO `sp_order_temp` VALUES ('21', '69', '', '0', '[{\"goodsid\":6,\"skuid\":0,\"num\":1}]', '15', '2018-10-10 14:26:34');
INSERT INTO `sp_order_temp` VALUES ('22', '55', '', '0', '[{\"goodsid\":1,\"skuid\":0,\"num\":1}]', '4', '2018-10-10 16:21:29');
INSERT INTO `sp_order_temp` VALUES ('23', '1', '20,21', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1},{\"goodsid\":13,\"skuid\":0,\"num\":1}]', '4', '2018-10-10 16:46:20');
INSERT INTO `sp_order_temp` VALUES ('24', '72', '22', '0', '[{\"goodsid\":8,\"skuid\":0,\"num\":1}]', '4', '2018-10-22 22:02:21');
INSERT INTO `sp_order_temp` VALUES ('25', '72', '23,24', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1},{\"goodsid\":13,\"skuid\":0,\"num\":1}]', '4', '2018-11-03 12:23:22');
INSERT INTO `sp_order_temp` VALUES ('26', '2', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '15', '2018-11-14 17:59:12');
INSERT INTO `sp_order_temp` VALUES ('27', '73', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '1', '2018-11-16 15:01:53');
INSERT INTO `sp_order_temp` VALUES ('28', '73', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '1', '2018-11-16 15:07:16');
INSERT INTO `sp_order_temp` VALUES ('29', '73', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '1', '2018-11-16 16:53:09');
INSERT INTO `sp_order_temp` VALUES ('30', '73', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '73', '2018-11-19 15:24:20');
INSERT INTO `sp_order_temp` VALUES ('31', '73', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '73', '2018-11-21 10:21:35');
INSERT INTO `sp_order_temp` VALUES ('32', '73', '', '0', '[{\"goodsid\":13,\"skuid\":0,\"num\":1}]', '73', '2018-11-21 10:33:07');
INSERT INTO `sp_order_temp` VALUES ('33', '73', '', '0', '[{\"goodsid\":11,\"skuid\":0,\"num\":1}]', '73', '2018-11-21 10:33:34');
INSERT INTO `sp_order_temp` VALUES ('34', '73', '', '0', '[{\"goodsid\":14,\"skuid\":0,\"num\":1}]', '73', '2018-11-21 15:17:48');
INSERT INTO `sp_order_temp` VALUES ('35', '73', '', '0', '[{\"goodsid\":4,\"skuid\":0,\"num\":1}]', '73', '2018-11-21 16:02:51');
INSERT INTO `sp_order_temp` VALUES ('36', '73', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '60', '2018-11-22 11:22:38');
INSERT INTO `sp_order_temp` VALUES ('37', '73', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '60', '2018-11-22 11:26:07');
INSERT INTO `sp_order_temp` VALUES ('38', '73', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '60', '2018-11-22 11:27:29');
INSERT INTO `sp_order_temp` VALUES ('39', '73', '', '0', '[{\"goodsid\":13,\"skuid\":0,\"num\":1}]', '60', '2018-11-22 11:27:51');
INSERT INTO `sp_order_temp` VALUES ('40', '73', '', '0', '[{\"goodsid\":8,\"skuid\":0,\"num\":1}]', '60', '2018-11-22 11:36:32');
INSERT INTO `sp_order_temp` VALUES ('41', '73', '', '0', '[{\"goodsid\":7,\"skuid\":0,\"num\":1}]', '60', '2018-11-22 11:55:18');
INSERT INTO `sp_order_temp` VALUES ('42', '73', '', '0', '[{\"goodsid\":5,\"skuid\":0,\"num\":1}]', '60', '2018-11-22 12:03:22');
INSERT INTO `sp_order_temp` VALUES ('43', '73', '', '0', '[{\"goodsid\":4,\"skuid\":0,\"num\":1}]', '60', '2018-11-22 13:52:08');
INSERT INTO `sp_order_temp` VALUES ('44', '73', '', '0', '[{\"goodsid\":4,\"skuid\":0,\"num\":1}]', '60', '2018-11-22 13:55:11');
INSERT INTO `sp_order_temp` VALUES ('45', '73', '', '0', '[{\"goodsid\":4,\"skuid\":0,\"num\":1}]', '60', '2018-11-22 13:57:37');
INSERT INTO `sp_order_temp` VALUES ('46', '73', '', '0', '[{\"goodsid\":4,\"skuid\":0,\"num\":1}]', '60', '2018-11-22 14:01:46');
INSERT INTO `sp_order_temp` VALUES ('47', '73', '', '0', '[{\"goodsid\":4,\"skuid\":0,\"num\":1}]', '60', '2018-11-22 15:11:12');
INSERT INTO `sp_order_temp` VALUES ('48', '73', '', '0', '[{\"goodsid\":5,\"skuid\":0,\"num\":1}]', '60', '2018-11-22 15:15:02');
INSERT INTO `sp_order_temp` VALUES ('49', '73', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '60', '2018-11-26 18:34:22');
INSERT INTO `sp_order_temp` VALUES ('50', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '60', '2018-11-28 17:05:37');
INSERT INTO `sp_order_temp` VALUES ('51', '78', '31,33,34', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1},{\"goodsid\":13,\"skuid\":0,\"num\":4},{\"goodsid\":14,\"skuid\":0,\"num\":1}]', '64', '2018-11-29 14:57:11');
INSERT INTO `sp_order_temp` VALUES ('52', '81', '32', '0', '[{\"goodsid\":4,\"skuid\":0,\"num\":1}]', '60', '2018-11-29 15:27:00');
INSERT INTO `sp_order_temp` VALUES ('53', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:13:07');
INSERT INTO `sp_order_temp` VALUES ('54', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:13:17');
INSERT INTO `sp_order_temp` VALUES ('55', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:15:04');
INSERT INTO `sp_order_temp` VALUES ('56', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:15:22');
INSERT INTO `sp_order_temp` VALUES ('57', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:15:41');
INSERT INTO `sp_order_temp` VALUES ('58', '80', '', '0', '[{\"goodsid\":13,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:15:47');
INSERT INTO `sp_order_temp` VALUES ('59', '80', '', '0', '[{\"goodsid\":14,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:16:08');
INSERT INTO `sp_order_temp` VALUES ('60', '80', '37', '0', '[{\"goodsid\":1,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:16:30');
INSERT INTO `sp_order_temp` VALUES ('61', '80', '37', '0', '[{\"goodsid\":1,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:16:50');
INSERT INTO `sp_order_temp` VALUES ('62', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:21:21');
INSERT INTO `sp_order_temp` VALUES ('63', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:25:05');
INSERT INTO `sp_order_temp` VALUES ('64', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:31:52');
INSERT INTO `sp_order_temp` VALUES ('65', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:38:28');
INSERT INTO `sp_order_temp` VALUES ('66', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:40:56');
INSERT INTO `sp_order_temp` VALUES ('67', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:42:10');
INSERT INTO `sp_order_temp` VALUES ('68', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:43:46');
INSERT INTO `sp_order_temp` VALUES ('69', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:44:21');
INSERT INTO `sp_order_temp` VALUES ('70', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:45:22');
INSERT INTO `sp_order_temp` VALUES ('71', '80', '', '0', '[{\"goodsid\":13,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:45:37');
INSERT INTO `sp_order_temp` VALUES ('72', '80', '', '0', '[{\"goodsid\":13,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:47:06');
INSERT INTO `sp_order_temp` VALUES ('73', '80', '37,41,42', '0', '[{\"goodsid\":1,\"skuid\":0,\"num\":1},{\"goodsid\":12,\"skuid\":0,\"num\":2},{\"goodsid\":13,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:47:29');
INSERT INTO `sp_order_temp` VALUES ('74', '80', '37,41,42,43,44,45', '0', '[{\"goodsid\":1,\"skuid\":0,\"num\":1},{\"goodsid\":12,\"skuid\":0,\"num\":2},{\"goodsid\":13,\"skuid\":0,\"num\":1},{\"goodsid\":2,\"skuid\":0,\"num\":1},{\"goodsid\":6,\"skuid\":0,\"num\":1},{\"goodsid\":7,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:48:00');
INSERT INTO `sp_order_temp` VALUES ('75', '80', '37,41,42,43,44,45', '0', '[{\"goodsid\":1,\"skuid\":0,\"num\":1},{\"goodsid\":12,\"skuid\":0,\"num\":2},{\"goodsid\":13,\"skuid\":0,\"num\":1},{\"goodsid\":2,\"skuid\":0,\"num\":1},{\"goodsid\":6,\"skuid\":0,\"num\":1},{\"goodsid\":7,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:48:50');
INSERT INTO `sp_order_temp` VALUES ('76', '80', '37,41,42,43,44,45', '0', '[{\"goodsid\":1,\"skuid\":0,\"num\":1},{\"goodsid\":12,\"skuid\":0,\"num\":2},{\"goodsid\":13,\"skuid\":0,\"num\":1},{\"goodsid\":2,\"skuid\":0,\"num\":1},{\"goodsid\":6,\"skuid\":0,\"num\":1},{\"goodsid\":7,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:49:09');
INSERT INTO `sp_order_temp` VALUES ('77', '80', '37,41,42,43,44,45', '0', '[{\"goodsid\":1,\"skuid\":0,\"num\":1},{\"goodsid\":12,\"skuid\":0,\"num\":2},{\"goodsid\":13,\"skuid\":0,\"num\":1},{\"goodsid\":2,\"skuid\":0,\"num\":1},{\"goodsid\":6,\"skuid\":0,\"num\":1},{\"goodsid\":7,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:50:03');
INSERT INTO `sp_order_temp` VALUES ('78', '80', '37,41,42,43,44,45', '0', '[{\"goodsid\":1,\"skuid\":0,\"num\":12},{\"goodsid\":12,\"skuid\":0,\"num\":2},{\"goodsid\":13,\"skuid\":0,\"num\":1},{\"goodsid\":2,\"skuid\":0,\"num\":1},{\"goodsid\":6,\"skuid\":0,\"num\":1},{\"goodsid\":7,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 15:50:14');
INSERT INTO `sp_order_temp` VALUES ('79', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-11-30 16:36:24');
INSERT INTO `sp_order_temp` VALUES ('80', '80', '46', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":2}]', '80', '2018-11-30 17:39:52');
INSERT INTO `sp_order_temp` VALUES ('81', '78', '34,38,39', '0', '[{\"goodsid\":14,\"skuid\":0,\"num\":3},{\"goodsid\":2,\"skuid\":0,\"num\":7},{\"goodsid\":1,\"skuid\":0,\"num\":2}]', '4', '2018-12-03 17:53:53');
INSERT INTO `sp_order_temp` VALUES ('82', '78', '34,38,39', '0', '[{\"goodsid\":14,\"skuid\":0,\"num\":3},{\"goodsid\":2,\"skuid\":0,\"num\":7},{\"goodsid\":1,\"skuid\":0,\"num\":2}]', '4', '2018-12-03 17:54:09');
INSERT INTO `sp_order_temp` VALUES ('83', '78', '34,38,39', '0', '[{\"goodsid\":14,\"skuid\":0,\"num\":3},{\"goodsid\":2,\"skuid\":0,\"num\":7},{\"goodsid\":1,\"skuid\":0,\"num\":2}]', '4', '2018-12-03 17:54:15');
INSERT INTO `sp_order_temp` VALUES ('84', '80', '', '0', '[{\"goodsid\":13,\"skuid\":0,\"num\":1}]', '80', '2018-12-03 18:02:08');
INSERT INTO `sp_order_temp` VALUES ('85', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-03 18:07:06');
INSERT INTO `sp_order_temp` VALUES ('86', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-03 18:08:54');
INSERT INTO `sp_order_temp` VALUES ('87', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-03 18:09:38');
INSERT INTO `sp_order_temp` VALUES ('88', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-03 18:19:01');
INSERT INTO `sp_order_temp` VALUES ('89', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 08:53:16');
INSERT INTO `sp_order_temp` VALUES ('90', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 08:54:44');
INSERT INTO `sp_order_temp` VALUES ('91', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 08:56:04');
INSERT INTO `sp_order_temp` VALUES ('92', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 08:57:08');
INSERT INTO `sp_order_temp` VALUES ('93', '78', '34,38', '0', '[{\"goodsid\":14,\"skuid\":0,\"num\":3},{\"goodsid\":2,\"skuid\":0,\"num\":7}]', '4', '2018-12-04 09:12:13');
INSERT INTO `sp_order_temp` VALUES ('94', '78', '47', '0', '[{\"goodsid\":13,\"skuid\":0,\"num\":1}]', '4', '2018-12-04 09:23:45');
INSERT INTO `sp_order_temp` VALUES ('95', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 09:54:42');
INSERT INTO `sp_order_temp` VALUES ('96', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 10:13:12');
INSERT INTO `sp_order_temp` VALUES ('97', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 10:43:38');
INSERT INTO `sp_order_temp` VALUES ('98', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 10:49:04');
INSERT INTO `sp_order_temp` VALUES ('99', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 10:50:32');
INSERT INTO `sp_order_temp` VALUES ('100', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 12:07:26');
INSERT INTO `sp_order_temp` VALUES ('101', '80', '', '0', '[{\"goodsid\":14,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 13:39:23');
INSERT INTO `sp_order_temp` VALUES ('102', '80', '', '0', '[{\"goodsid\":11,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 13:57:32');
INSERT INTO `sp_order_temp` VALUES ('103', '80', '', '0', '[{\"goodsid\":5,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 14:47:40');
INSERT INTO `sp_order_temp` VALUES ('104', '80', '', '0', '[{\"goodsid\":5,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 14:55:33');
INSERT INTO `sp_order_temp` VALUES ('105', '83', '49', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 15:04:42');
INSERT INTO `sp_order_temp` VALUES ('106', '83', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 15:05:55');
INSERT INTO `sp_order_temp` VALUES ('107', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 15:12:44');
INSERT INTO `sp_order_temp` VALUES ('108', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-04 15:56:40');
INSERT INTO `sp_order_temp` VALUES ('109', '78', '48', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":4}]', '4', '2018-12-04 21:03:52');
INSERT INTO `sp_order_temp` VALUES ('110', '78', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '4', '2018-12-05 08:51:24');
INSERT INTO `sp_order_temp` VALUES ('111', '80', '', '0', '[{\"goodsid\":4,\"skuid\":0,\"num\":1}]', '80', '2018-12-05 11:41:37');
INSERT INTO `sp_order_temp` VALUES ('112', '81', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '4', '2018-12-06 18:57:04');
INSERT INTO `sp_order_temp` VALUES ('113', '81', '32,52', '0', '[{\"goodsid\":4,\"skuid\":0,\"num\":1},{\"goodsid\":13,\"skuid\":0,\"num\":1}]', '4', '2018-12-06 18:57:36');
INSERT INTO `sp_order_temp` VALUES ('114', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-10 15:36:11');
INSERT INTO `sp_order_temp` VALUES ('115', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-10 15:36:43');
INSERT INTO `sp_order_temp` VALUES ('116', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-10 15:37:50');
INSERT INTO `sp_order_temp` VALUES ('117', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-10 15:38:07');
INSERT INTO `sp_order_temp` VALUES ('118', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-10 15:40:14');
INSERT INTO `sp_order_temp` VALUES ('119', '80', '', '0', '[{\"goodsid\":12,\"skuid\":0,\"num\":1}]', '80', '2018-12-10 15:40:36');
INSERT INTO `sp_order_temp` VALUES ('120', '78', '50', '0', '[{\"goodsid\":2,\"skuid\":0,\"num\":1}]', '78', '2018-12-12 09:16:33');

-- -----------------------------
-- Table structure for `sp_swiper`
-- -----------------------------
DROP TABLE IF EXISTS `sp_swiper`;
CREATE TABLE `sp_swiper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sign` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `params` int(11) NOT NULL DEFAULT '0',
  `dot` tinyint(1) NOT NULL DEFAULT '1',
  `loop` tinyint(1) NOT NULL DEFAULT '1',
  `addid` int(11) NOT NULL DEFAULT '0',
  `addtime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_swiper`
-- -----------------------------
INSERT INTO `sp_swiper` VALUES ('1', '~995-i4rjuq$$n8x2pnc', '1', '1', '1', '1', '1', '1', '2018-11-14 14:46:38', '1', '2018-12-10 17:23:08');
INSERT INTO `sp_swiper` VALUES ('2', 'yz2f#iy1^gxzdk8hiive', '测试', '1', '2', '1', '1', '1', '2018-11-14 15:58:18', '1', '2018-11-14 15:58:18');
INSERT INTO `sp_swiper` VALUES ('9', '46kvg8$2zuf5qx7wxt7v', '的333', '1', '0', '1', '1', '1', '2018-12-10 17:32:41', '1', '2018-12-10 17:32:41');

-- -----------------------------
-- Table structure for `sp_user`
-- -----------------------------
DROP TABLE IF EXISTS `sp_user`;
CREATE TABLE `sp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `nickname` varchar(100) NOT NULL DEFAULT '' COMMENT '昵称',
  `realname` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1男2女',
  `mobile` varchar(20) NOT NULL DEFAULT '0' COMMENT '手机号',
  `email` varchar(100) NOT NULL DEFAULT '',
  `headpic` varchar(200) NOT NULL DEFAULT '' COMMENT '头像',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `fromid` int(11) NOT NULL DEFAULT '0' COMMENT '分享人',
  `sharenum` int(11) NOT NULL DEFAULT '0' COMMENT '分享带来注册用户数',
  `addtime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00' COMMENT '注册时间',
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '取货码',
  `codetime` int(10) NOT NULL COMMENT '取货码更新时间',
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '小区名称',
  `address` varchar(200) NOT NULL DEFAULT '' COMMENT '详细地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- -----------------------------
-- Records of `sp_user`
-- -----------------------------
INSERT INTO `sp_user` VALUES ('1', '', '心', '测试', '', '1', '15925653525', '', 'http://ress.brother66.com/FjwfK3FVpbrzcZAEz-qFlf-XpMAn', '2', '0', '0', '2018-09-30 21:23:48', '', '0', '', '');
INSERT INTO `sp_user` VALUES ('2', '', '呼延灼', '测试呼延灼', '', '0', '15956856523', '', 'http://ress.brother66.com/FgrntubNLMYfxSO7mpwZvdYZGccX', '2', '0', '0', '2018-09-30 21:34:18', '', '0', '', '');
INSERT INTO `sp_user` VALUES ('3', '', '秦明', '', '', '0', '0', '', 'http://ress.brother66.com/FgrntubNLMYfxSO7mpwZvdYZGccX', '1', '0', '0', '2018-09-30 22:09:48', '', '0', '', '');
INSERT INTO `sp_user` VALUES ('4', '', 'Dr.罗', '罗威', '', '1', '19918055030', '32609956@qq.com', 'http://ress.brother66.com/FhY3q0qVRt_mzaR4eIk4yltz0OEt', '2', '0', '0', '2018-09-30 22:44:17', '', '0', '', '');
INSERT INTO `sp_user` VALUES ('78', '', '', 'lifangfang', '', '2', '18771377007', '', 'https://wx.qlogo.cn/mmopen/vi_32/KaMPh1LsPIH8skUPxoWOAbYlOwxHLvK0LLYZSrHAXXHV48iccpqiaR0g72oWlzIWcmiavyZt2KYeicLCBlFr98bN6g/132', '2', '4', '0', '2018-11-28 10:08:29', '652291', '1543971384', '', '');
INSERT INTO `sp_user` VALUES ('81', '', '徐超人不會飛', '', '', '1', '15271878520', '', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKR9NYYLxeE63mtrNmmgjhukp7K9jWHHjgMqQFuuuxAC7CstbIKKDiaQgJNvqepYEyM8FegJP5fAbA/132', '1', '4', '0', '2018-11-28 16:34:16', '776346', '1543988468', '', '');
INSERT INTO `sp_user` VALUES ('82', '', '优客工厂', '', '', '1', '0', '', 'https://wx.qlogo.cn/mmopen/vi_32/xpZicGEhX8ciaFCp6glX9W1qkuDyeBGKAibM2H5mBzQNQuEqMSTW0Oic9Qw8CZ5nGlaZEwUUU7jAIVAETlHKeUDutA/132', '1', '0', '0', '2018-12-04 15:00:17', '', '0', '', '');
INSERT INTO `sp_user` VALUES ('83', '', '.           ', '', '', '1', '13164674715', '', 'https://wx.qlogo.cn/mmopen/vi_32/0LwxIFSf6VW6nbv1WRcNvRvP11DeDdIz8qs5Kibp1RcRhda6BqT8J4Mj7O0icOnfdVIm1zhkeQib0FUDrKu63AhXQ/132', '1', '80', '0', '2018-12-04 15:03:08', '946895', '1543907436', '', '');
INSERT INTO `sp_user` VALUES ('84', '', '测试', '', '', '0', '0', '', '', '1', '80', '0', '2018-12-05 13:47:22', '', '0', '', '');
INSERT INTO `sp_user` VALUES ('85', '', '佩佩', '', '', '2', '15827463684', '', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erOkTI3iakiaZ4eLiaSPlwDhdzSM0orAOZzwwqcWe1Dpw4iapbw7YHlv8PpR7y0BBJ3qib2g9uswMlIDvg/132', '1', '80', '0', '2018-12-05 13:48:49', '', '0', '', '');
INSERT INTO `sp_user` VALUES ('97', '', 'Class2⃣ 0⃣ 1⃣ 8⃣', '', '', '1', '0', '', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTILsAECF9QvhYrO2oM8PQKXeTqt1AVXQ0lXNkmCRHL6edZibu39z9bmfzfXibqXDjgp4Z3wRHAfgY4w/132', '1', '0', '0', '2018-12-18 16:54:39', '', '0', '', '');

-- -----------------------------
-- Table structure for `sp_user_account`
-- -----------------------------
DROP TABLE IF EXISTS `sp_user_account`;
CREATE TABLE `sp_user_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '团长id',
  `orderid` int(11) NOT NULL DEFAULT '0' COMMENT '订单id',
  `orderfee` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单金额',
  `scale` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '分成比例',
  `scalefee` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '收益',
  `fromid` int(11) NOT NULL DEFAULT '0' COMMENT '下单人',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `addtime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_user_account`
-- -----------------------------
INSERT INTO `sp_user_account` VALUES ('1', '80', '15', '0.01', '0', '0', '80', '1', '2018-12-03 18:19:21');
INSERT INTO `sp_user_account` VALUES ('2', '80', '16', '0.01', '0', '0', '80', '1', '2018-12-04 08:53:42');
INSERT INTO `sp_user_account` VALUES ('3', '80', '17', '0.01', '0', '0', '80', '1', '2018-12-04 08:56:25');
INSERT INTO `sp_user_account` VALUES ('4', '80', '18', '0.01', '0', '1', '80', '1', '2018-12-04 08:57:28');
INSERT INTO `sp_user_account` VALUES ('5', '80', '23', '0.01', '0', '1', '80', '1', '2018-12-04 10:45:09');
INSERT INTO `sp_user_account` VALUES ('6', '80', '24', '0.01', '0', '1', '80', '1', '2018-12-04 10:49:14');
INSERT INTO `sp_user_account` VALUES ('7', '80', '31', '0.01', '0', '1', '83', '1', '2018-12-04 15:06:27');
INSERT INTO `sp_user_account` VALUES ('8', '80', '0', '0', '0', '2', '0', '2', '2018-12-17 19:28:33');

-- -----------------------------
-- Table structure for `sp_user_area`
-- -----------------------------
DROP TABLE IF EXISTS `sp_user_area`;
CREATE TABLE `sp_user_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `areaid` int(11) NOT NULL DEFAULT '0',
  `ext` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_user_area`
-- -----------------------------
INSERT INTO `sp_user_area` VALUES ('2', '4', '7', '');
INSERT INTO `sp_user_area` VALUES ('4', '2', '2', '');
INSERT INTO `sp_user_area` VALUES ('1', '80', '9', '');
INSERT INTO `sp_user_area` VALUES ('3', '1', '1', '');
INSERT INTO `sp_user_area` VALUES ('5', '78', '5', '');

-- -----------------------------
-- Table structure for `sp_user_message`
-- -----------------------------
DROP TABLE IF EXISTS `sp_user_message`;
CREATE TABLE `sp_user_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `messageid` int(11) NOT NULL DEFAULT '0' COMMENT '消息id',
  `isread` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否已读',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1正常，2删除',
  `addtime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00' COMMENT '添加时间',
  `updatetime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00' COMMENT ' 更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户消息表';

-- -----------------------------
-- Records of `sp_user_message`
-- -----------------------------
INSERT INTO `sp_user_message` VALUES ('1', '73', '1', '1', '1', '2018-11-16 17:22:56', '2018-11-16 17:22:56');

-- -----------------------------
-- Table structure for `sp_user_platform`
-- -----------------------------
DROP TABLE IF EXISTS `sp_user_platform`;
CREATE TABLE `sp_user_platform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `unionid` varchar(100) NOT NULL DEFAULT '',
  `openid` varchar(100) NOT NULL DEFAULT '',
  `site` tinyint(2) NOT NULL DEFAULT '1' COMMENT '终端，1安卓APP，2iosAPP，3公众号，4wap，5web，6小游戏',
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_openid` (`openid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_user_platform`
-- -----------------------------
INSERT INTO `sp_user_platform` VALUES ('1', '1', '', 'oittG473DCR450y-PnB-KwcY2mMs', '7');
INSERT INTO `sp_user_platform` VALUES ('2', '2', '', 'oittG44DzLmVSFN6YAFemtOCNN2M', '7');
INSERT INTO `sp_user_platform` VALUES ('3', '3', '', 'oittG45hJxU8TcuWdMFGLSZKkmjw', '7');
INSERT INTO `sp_user_platform` VALUES ('4', '4', '', 'oittG40H0uW0lqwIi6pTBYDW78gc', '7');
INSERT INTO `sp_user_platform` VALUES ('6', '6', '', 'oittG46rvOI5nLTlRsquo8ov5VKc', '7');
INSERT INTO `sp_user_platform` VALUES ('8', '8', '', 'oittG4-1k90q3SX2HHKDa10jUoAo', '7');
INSERT INTO `sp_user_platform` VALUES ('9', '9', '', 'oittG4yrgtDc7bczSRTVfv9HzvrI', '7');
INSERT INTO `sp_user_platform` VALUES ('10', '10', '', 'oittG49pjpVpUV3gCddj0YheOAdk', '7');
INSERT INTO `sp_user_platform` VALUES ('12', '12', '', 'oittG4-DkKwh76GoWmVTE465BuH4', '7');
INSERT INTO `sp_user_platform` VALUES ('14', '14', '', 'oittG4xg20wk_ewPOEJ00eGNYBJI', '7');
INSERT INTO `sp_user_platform` VALUES ('15', '15', '', 'oittG4627h8Bwp_4JAcHx3qzez6U', '7');
INSERT INTO `sp_user_platform` VALUES ('16', '16', '', 'oittG4y4HYZKqfjxUt4hM8xx1vdk', '7');
INSERT INTO `sp_user_platform` VALUES ('17', '17', '', 'oittG4zcgvaBd_UTENWhvSRaTl6E', '7');
INSERT INTO `sp_user_platform` VALUES ('18', '18', '', 'oittG48NeDAuJag8So8-i3rBj-iU', '7');
INSERT INTO `sp_user_platform` VALUES ('19', '19', '', 'oittG49litrWHpcWAXPzD74kmBs8', '7');
INSERT INTO `sp_user_platform` VALUES ('20', '20', '', 'oittG496b7TpfHWXCC9PEr3AFKaQ', '7');
INSERT INTO `sp_user_platform` VALUES ('22', '22', '', 'oittG42NYB73c6ivgOQH5zQGG4IU', '7');
INSERT INTO `sp_user_platform` VALUES ('23', '23', '', 'oittG44sZA4y1wcy6BvnPfqtpDP4', '7');
INSERT INTO `sp_user_platform` VALUES ('24', '24', '', 'oittG44Munf7OnER6ilmewovvMwE', '7');
INSERT INTO `sp_user_platform` VALUES ('26', '26', '', 'oittG46mLFoF3cuZ5Z9NZHWzUbGE', '7');
INSERT INTO `sp_user_platform` VALUES ('27', '27', '', 'oittG43AwGMBRlei-9RgGB63oRHg', '7');
INSERT INTO `sp_user_platform` VALUES ('28', '28', '', 'oittG44Q_FrZtQ5WSeTu53Unepc4', '7');
INSERT INTO `sp_user_platform` VALUES ('29', '29', '', 'oittG4z3jnvaPCqlnSqVO1PljFjg', '7');
INSERT INTO `sp_user_platform` VALUES ('30', '30', '', 'oittG40tfGJEYjngiIogmZDLxHzE', '7');
INSERT INTO `sp_user_platform` VALUES ('31', '31', '', 'oittG47I64dpTXiL4VdixsOTXat4', '7');
INSERT INTO `sp_user_platform` VALUES ('33', '33', '', 'oittG4yM6U6yJun6da0j1ABQ6pmY', '7');
INSERT INTO `sp_user_platform` VALUES ('34', '34', '', 'oittG495bnMR8PuKgeFhmkCN_zPk', '7');
INSERT INTO `sp_user_platform` VALUES ('35', '35', '', 'oittG4457TrGrXx8wZNtuEg1TdgU', '7');
INSERT INTO `sp_user_platform` VALUES ('36', '36', '', 'oittG450yP6WSfVPNpenTKYsBhPY', '7');
INSERT INTO `sp_user_platform` VALUES ('37', '37', '', 'oittG4xr9OVsdWhuxp7OHijNdXGg', '7');
INSERT INTO `sp_user_platform` VALUES ('38', '38', '', 'oittG40RRmYzWzPI7_HCNKaHwV8U', '7');
INSERT INTO `sp_user_platform` VALUES ('40', '40', '', 'oittG44z6U8itbWOL3n39IeJ-Lf4', '7');
INSERT INTO `sp_user_platform` VALUES ('41', '41', '', 'oittG47M2PZz-S3pSCFpgXm0eV_M', '7');
INSERT INTO `sp_user_platform` VALUES ('42', '42', '', 'oittG4-KQ9mx08ei7DwUpjiimgU8', '7');
INSERT INTO `sp_user_platform` VALUES ('43', '43', '', 'oittG41J6QBSXFK0xrY5hJAUnLFk', '7');
INSERT INTO `sp_user_platform` VALUES ('45', '45', '', 'oittG488KLgcrT2_cq43Fa3ma21M', '7');
INSERT INTO `sp_user_platform` VALUES ('46', '46', '', 'oittG4yoFZfKWxxMPqCsvYwnxdlY', '7');
INSERT INTO `sp_user_platform` VALUES ('47', '47', '', 'oittG47MlsxobrzPVf_roXmJdhM4', '7');
INSERT INTO `sp_user_platform` VALUES ('48', '48', '', 'oittG4x7xkOStY5kn0T0zxX_0LxU', '7');
INSERT INTO `sp_user_platform` VALUES ('50', '50', '', 'oittG4zTYAk3JNfD6r5PEKHLXnGE', '7');
INSERT INTO `sp_user_platform` VALUES ('53', '53', '', 'oittG4y4y_lj8UrSO4f-ijDTuiz4', '7');
INSERT INTO `sp_user_platform` VALUES ('54', '54', '', 'oittG4w-8Tx_JndB6cwyodXvWIeo', '7');
INSERT INTO `sp_user_platform` VALUES ('55', '55', '', 'oittG43jGWuPEuv3YY4ZOLM2FvYw', '7');
INSERT INTO `sp_user_platform` VALUES ('57', '57', '', 'oittG40ce5RDjrSihX4rA6CFXUl8', '7');
INSERT INTO `sp_user_platform` VALUES ('58', '58', '', 'oittG44lKSoIaexzZg7_eI_nwih0', '7');
INSERT INTO `sp_user_platform` VALUES ('59', '59', '', 'oittG48-0YqbGbuK6opRKH4-6ol4', '7');
INSERT INTO `sp_user_platform` VALUES ('60', '60', '', 'oittG43vKkMDR9_QNndNRpFUNYxU', '7');
INSERT INTO `sp_user_platform` VALUES ('61', '61', '', 'oittG42LGrGnD2HpO3fH4lK-00pw', '7');
INSERT INTO `sp_user_platform` VALUES ('62', '62', '', 'oittG48gwJw6zh178cJyGjpD6R74', '7');
INSERT INTO `sp_user_platform` VALUES ('64', '64', '', 'oittG41-NVmuqNzebgpZvj6dQ2i8', '7');
INSERT INTO `sp_user_platform` VALUES ('66', '66', '', 'oittG49VAN3a4RlyY0-XuU1CyzTE', '7');
INSERT INTO `sp_user_platform` VALUES ('67', '67', '', 'oittG46k3EsUXq9DNQ6JgTuyk1rI', '7');
INSERT INTO `sp_user_platform` VALUES ('68', '68', '', 'oittG43KhGPdgVT54pfirjTp-kJU', '7');
INSERT INTO `sp_user_platform` VALUES ('69', '69', '', 'oittG4xBhEYqkKdidcqHeQBEOINM', '7');
INSERT INTO `sp_user_platform` VALUES ('71', '71', '', 'oittG4__EmMh9qV9QFCnuDQlTk0s', '7');
INSERT INTO `sp_user_platform` VALUES ('72', '72', '', 'o3Pxc5cZEfBasAwUwV71LdYy8PhE', '7');
INSERT INTO `sp_user_platform` VALUES ('78', '78', '', 'oE4oc5N2FGKl_Voq4PX7XiZmZLzg', '7');
INSERT INTO `sp_user_platform` VALUES ('81', '81', '', 'oE4oc5NSctJVsnXep46VyNn8_2Rs', '7');
INSERT INTO `sp_user_platform` VALUES ('82', '82', '', 'oE4oc5JH6kaQhVAQ_3xrrCVi5mws', '7');
INSERT INTO `sp_user_platform` VALUES ('83', '83', '', 'oE4oc5OZXeWfTRPfWUElDnnPgY04', '7');
INSERT INTO `sp_user_platform` VALUES ('84', '84', '', 'oE4oc5MNNvRGx8tXV8FsymR45sJ8', '7');
INSERT INTO `sp_user_platform` VALUES ('85', '85', '', 'oE4oc5PyupD4jPn3J9RFzmBRPmfI', '7');
INSERT INTO `sp_user_platform` VALUES ('94', '97', '', 'oE4oc5NEVekbdPQPbWKdfnKjdvYI', '7');

-- -----------------------------
-- Table structure for `sp_user_point`
-- -----------------------------
DROP TABLE IF EXISTS `sp_user_point`;
CREATE TABLE `sp_user_point` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL COMMENT '积分说明',
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '积分数量',
  `addtime` int(10) NOT NULL COMMENT '获取时间',
  `total` int(11) NOT NULL COMMENT '最终积分',
  `content` text COMMENT '购买商品\r\n赠送积分详情 订单号 商品 数量 积分数\r\n抵扣积分详情 订单号 商品 数量 积分数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `sp_user_point`
-- -----------------------------
INSERT INTO `sp_user_point` VALUES ('1', '测试', '1', '150', '1542087035', '150', '');
INSERT INTO `sp_user_point` VALUES ('2', '系统减少', '1', '-100', '1542260335', '50', '');
INSERT INTO `sp_user_point` VALUES ('3', '系统修改', '73', '11', '1542273377', '11', '');
INSERT INTO `sp_user_point` VALUES ('4', '系统修改', '73', '-6', '1542273472', '5', '');
INSERT INTO `sp_user_point` VALUES ('5', '系统修改', '73', '495', '1542273495', '500', '');
INSERT INTO `sp_user_point` VALUES ('6', '系统修改', '73', '-100', '1542274894', '400', '');
INSERT INTO `sp_user_point` VALUES ('7', '系统修改', '73', '-400', '1542274920', '0', '');
INSERT INTO `sp_user_point` VALUES ('8', '系统修改', '73', '555', '1542274970', '555', '');
INSERT INTO `sp_user_point` VALUES ('9', '系统修改', '80', '100', '1543556854', '100', '');
INSERT INTO `sp_user_point` VALUES ('10', '积分抵钱-订单号：sp_20181130155556304622', '80', '-90', '1543564556', '10', '积分抵钱-订单号：sp_20181130155556304622-商品：米小可微醺米酒350ml-数量：12-抵扣积分：15商品：红心文旦柚1份（7-8斤/份）-数量：2-抵扣积分：20商品：海南金都一号红心火龙果一份（3斤±2两）-数量：1-抵扣积分：0商品：日清合味道方便面整箱10口味6杯公仔面泡面海鲜速食面桶装整箱装-数量：1-抵扣积分：0商品：智力燕麦片1500g冲饮即食无糖原味麦片健康膳食纤维营养早餐代餐-数量：1-抵扣积分：0商品：绝艺鸭脖子小包装小吃肉食大礼包-数量：1-抵扣积分：0');
INSERT INTO `sp_user_point` VALUES ('11', '积分抵钱-订单号：sp_20181130163627520073', '80', '0', '1543566987', '10', '积分抵钱-订单号：sp_20181130163627520073-商品：红心文旦柚1份（7-8斤/份）-数量：1-抵扣积分：20');
INSERT INTO `sp_user_point` VALUES ('12', '取消订单退换积分，订单号：sp_20181130155556304622', '80', '90', '1543567816', '100', '取消订单退换积分，订单号：sp_20181130155556304622');
INSERT INTO `sp_user_point` VALUES ('13', '积分抵钱-订单号：sp_20181130174001731179', '80', '-40', '1543570801', '60', '积分抵钱-订单号：sp_20181130174001731179-商品：红心文旦柚1份（7-8斤/份）-数量：2-抵扣积分：20');
INSERT INTO `sp_user_point` VALUES ('14', '购物赠送积分-订单号：sp_20181130174001731179', '80', '10', '1543570915', '70', '购物赠送积分-订单号：sp_20181130174001731179');
INSERT INTO `sp_user_point` VALUES ('15', '积分抵钱-订单号：sp_20181203180709638563', '80', '-20', '1543831629', '50', '积分抵钱-订单号：sp_20181203180709638563-商品：红心文旦柚1份（7-8斤/份）-数量：1-抵扣积分：20');
INSERT INTO `sp_user_point` VALUES ('16', '积分抵钱-订单号：sp_20181203180857836394', '80', '-20', '1543831737', '30', '积分抵钱-订单号：sp_20181203180857836394-商品：红心文旦柚1份（7-8斤/份）-数量：1-抵扣积分：20');
INSERT INTO `sp_user_point` VALUES ('17', '取消订单退还积分，订单号：sp_20181203180709414326', '80', '20', '1543896412', '50', '取消订单退换积分，订单号：sp_20181203180709414326');
INSERT INTO `sp_user_point` VALUES ('18', '取消订单退还积分，订单号：sp_20181203180857540558', '80', '20', '1543896412', '70', '取消订单退换积分，订单号：sp_20181203180857540558');
INSERT INTO `sp_user_point` VALUES ('19', '系统修改', '80', '-70', '1544161586', '0', '');

-- -----------------------------
-- Table structure for `sp_user_session`
-- -----------------------------
DROP TABLE IF EXISTS `sp_user_session`;
CREATE TABLE `sp_user_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `sessionkey` varchar(100) NOT NULL DEFAULT '',
  `addtime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `updatetime` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `k_sessionkey` (`sessionkey`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COMMENT='用户session表';

-- -----------------------------
-- Records of `sp_user_session`
-- -----------------------------
INSERT INTO `sp_user_session` VALUES ('1', '1', 'sess_gr9ynvg1ggw2r7q22czrk4g9kl2sos8t', '2018-09-30 21:23:48', '2018-09-30 21:23:48');
INSERT INTO `sp_user_session` VALUES ('2', '2', 'sess_bghb64nro3dsi16izkrhbipwbxpijvjk', '2018-09-30 21:34:18', '2018-09-30 21:34:18');
INSERT INTO `sp_user_session` VALUES ('3', '3', 'sess_kbeul5dyn0im6pym318lqkmcddp9ukd4', '2018-09-30 22:09:49', '2018-09-30 22:09:49');
INSERT INTO `sp_user_session` VALUES ('4', '4', 'sess_wmgcj3u8wzqig6lgxxuj1h3ejqqpmw18', '2018-09-30 22:44:17', '2018-09-30 22:44:17');
INSERT INTO `sp_user_session` VALUES ('5', '6', 'sess_4lw7ob58l72uefffvotb6kl2y7p4ppoi', '2018-10-01 10:37:49', '2018-10-01 10:37:49');
INSERT INTO `sp_user_session` VALUES ('6', '8', 'sess_6vhwb9d2dj8h81shxvguwu7jvslqbph7', '2018-10-01 10:57:30', '2018-10-01 10:57:30');
INSERT INTO `sp_user_session` VALUES ('7', '9', 'sess_54bszqlf6zmvzpz1n2chu9fs9hco3vyw', '2018-10-01 11:43:48', '2018-10-01 11:43:48');
INSERT INTO `sp_user_session` VALUES ('8', '10', 'sess_skf4oz9elbp0zcdp8zdcxt7gjnpmj612', '2018-10-01 11:47:38', '2018-10-01 11:47:38');
INSERT INTO `sp_user_session` VALUES ('9', '12', 'sess_l0qtn56v1wn6r9pcsb7dd1mgxbhk3kue', '2018-10-01 12:22:09', '2018-10-01 12:22:09');
INSERT INTO `sp_user_session` VALUES ('10', '14', 'sess_vyet6g8x1vkfkojp5rp0cb4cloomb87v', '2018-10-01 12:35:55', '2018-10-01 12:35:55');
INSERT INTO `sp_user_session` VALUES ('11', '15', 'sess_udhczs306i1p4e5qn5n9uwdr43hnl855', '2018-10-01 13:31:52', '2018-10-01 13:31:52');
INSERT INTO `sp_user_session` VALUES ('12', '16', 'sess_m2cn62ps2b2tjmm7vx5z33otr46puob6', '2018-10-01 14:06:15', '2018-10-01 14:06:15');
INSERT INTO `sp_user_session` VALUES ('13', '17', 'sess_dyv7nygixppgz9j37hvp65bthkkh5z17', '2018-10-01 14:18:18', '2018-10-01 14:18:18');
INSERT INTO `sp_user_session` VALUES ('14', '18', 'sess_9dgbcpoilyqjq206g2jsjufut11ogxwf', '2018-10-01 14:59:46', '2018-10-01 14:59:46');
INSERT INTO `sp_user_session` VALUES ('15', '19', 'sess_siy7ve5ey4zbt0vybn1onf3zhsjyqcz9', '2018-10-01 18:04:37', '2018-10-01 18:04:37');
INSERT INTO `sp_user_session` VALUES ('16', '20', 'sess_u4f1mop2pe1xqvr8lpc4ci5x8ukb0kqt', '2018-10-01 18:25:14', '2018-10-01 18:25:14');
INSERT INTO `sp_user_session` VALUES ('17', '22', 'sess_qkn7djlxxmt3n34gqn1ex4bjj5qltnf9', '2018-10-01 19:00:59', '2018-10-01 19:00:59');
INSERT INTO `sp_user_session` VALUES ('18', '23', 'sess_fjqppx8f8z45cmjup1w63hhp2muoo7pt', '2018-10-01 20:00:03', '2018-10-01 20:00:03');
INSERT INTO `sp_user_session` VALUES ('19', '24', 'sess_t0rzz9chz67b5h4thbo55nipsnigsr0b', '2018-10-01 20:07:32', '2018-10-01 20:07:32');
INSERT INTO `sp_user_session` VALUES ('20', '26', 'sess_9mp1x9fc6uucpsw8oln84vsydx8lpdlo', '2018-10-01 22:04:46', '2018-10-01 22:04:46');
INSERT INTO `sp_user_session` VALUES ('21', '27', 'sess_u85i85ljusif1q74f0pfh936nfk74c7o', '2018-10-02 15:16:57', '2018-10-02 15:16:57');
INSERT INTO `sp_user_session` VALUES ('22', '28', 'sess_oqwm07m9g2sjn2xlq4yhzyphhu0e1udf', '2018-10-02 18:49:35', '2018-10-02 18:49:35');
INSERT INTO `sp_user_session` VALUES ('23', '29', 'sess_c90fv8qb01pnqtoe2qxtdjzhq4z9kflm', '2018-10-05 10:24:08', '2018-10-05 10:24:08');
INSERT INTO `sp_user_session` VALUES ('24', '30', 'sess_qw25qudgspomnlnptcyfmvbv2rm0bnjr', '2018-10-05 14:39:37', '2018-10-05 14:39:37');
INSERT INTO `sp_user_session` VALUES ('25', '31', 'sess_4er1ifl7t4cp18sytls495tkfwtse8h8', '2018-10-05 16:29:41', '2018-10-05 16:29:41');
INSERT INTO `sp_user_session` VALUES ('26', '33', 'sess_22dhn0w9prlb2pbhhk2rbl2q4rng0b22', '2018-10-05 20:49:23', '2018-10-05 20:49:23');
INSERT INTO `sp_user_session` VALUES ('27', '34', 'sess_t93yvlhzinwjbks4iwg047r8gyvznbi6', '2018-10-05 21:01:43', '2018-10-05 21:01:43');
INSERT INTO `sp_user_session` VALUES ('28', '35', 'sess_clm6rl4yz7cb2lz14ktp220bur5lg6rh', '2018-10-06 14:30:27', '2018-10-06 14:30:27');
INSERT INTO `sp_user_session` VALUES ('29', '36', 'sess_u4wflrpqm7xr1ze5voxozs8lch15bvqv', '2018-10-06 14:31:56', '2018-10-06 14:31:56');
INSERT INTO `sp_user_session` VALUES ('30', '37', 'sess_cwvsqlqzq2cscrhjn6p9090w5fbh88v9', '2018-10-06 14:35:39', '2018-10-06 14:35:39');
INSERT INTO `sp_user_session` VALUES ('31', '38', 'sess_v2s9yzokfd9ofbcf407b5b7jlhvpsj5e', '2018-10-07 09:35:48', '2018-10-07 09:35:48');
INSERT INTO `sp_user_session` VALUES ('32', '40', 'sess_ltfgxfmvd8twf0ww7ltuc9jjvg4esnv3', '2018-10-07 09:45:22', '2018-10-07 09:45:22');
INSERT INTO `sp_user_session` VALUES ('33', '41', 'sess_b3ygrj64jezjej4p9d9c92fecdq9g2yg', '2018-10-07 10:28:37', '2018-10-07 10:28:37');
INSERT INTO `sp_user_session` VALUES ('34', '42', 'sess_ld1bf3idugs0h8ergvxp4qxndoqd0hvl', '2018-10-07 20:06:28', '2018-10-07 20:06:28');
INSERT INTO `sp_user_session` VALUES ('35', '43', 'sess_vf3dp217eegwrkfun6idgu4lyg6tv2dh', '2018-10-07 23:57:21', '2018-10-07 23:57:21');
INSERT INTO `sp_user_session` VALUES ('36', '45', 'sess_39ytqbtro28o2j4mvpooo3tytdrlkqpc', '2018-10-08 09:50:54', '2018-10-08 09:50:54');
INSERT INTO `sp_user_session` VALUES ('37', '46', 'sess_w6u9njvwq3z33qd4onjku76ws6qticv4', '2018-10-08 14:43:07', '2018-10-08 14:43:07');
INSERT INTO `sp_user_session` VALUES ('38', '47', 'sess_yx96jonsiqsushv7g1odkbb522pps5dh', '2018-10-08 16:09:14', '2018-10-08 16:09:14');
INSERT INTO `sp_user_session` VALUES ('39', '48', 'sess_q7btxqf5to0krb15esfyq2m65skpg2cv', '2018-10-08 20:12:25', '2018-10-08 20:12:25');
INSERT INTO `sp_user_session` VALUES ('40', '50', 'sess_7ugopw7xxsquwj49wz23km1k0ry0rnun', '2018-10-08 22:48:54', '2018-10-08 22:48:54');
INSERT INTO `sp_user_session` VALUES ('41', '53', 'sess_zr15pkk7n1nyrogbsf8i6zwtb7rqdwt3', '2018-10-09 09:12:07', '2018-10-09 09:12:07');
INSERT INTO `sp_user_session` VALUES ('42', '54', 'sess_6dzcsmm4vbg3q1mscxgezj04ebm4he9c', '2018-10-09 09:59:24', '2018-10-09 09:59:24');
INSERT INTO `sp_user_session` VALUES ('43', '55', 'sess_1rj1n1gqmyip858q1mmne7qjwu7rv1hl', '2018-10-09 09:59:50', '2018-10-09 09:59:50');
INSERT INTO `sp_user_session` VALUES ('44', '57', 'sess_3s66thzzlx2rl5fkkx5zlivz79fjsxlk', '2018-10-09 10:01:12', '2018-10-09 10:01:12');
INSERT INTO `sp_user_session` VALUES ('45', '58', 'sess_pc517ixdi7odn2mjffylnmgy0iiv2pbg', '2018-10-09 11:09:35', '2018-10-09 11:09:35');
INSERT INTO `sp_user_session` VALUES ('46', '59', 'sess_5k5y2ee76gsthx5z701uecyjdwtwyqus', '2018-10-09 14:03:55', '2018-10-09 14:03:55');
INSERT INTO `sp_user_session` VALUES ('47', '60', 'sess_du80tcjcytm4zrsdm614b6vbgwldsllu', '2018-10-09 16:33:49', '2018-10-09 16:33:49');
INSERT INTO `sp_user_session` VALUES ('48', '61', 'sess_bh5bpdwgrwl8rikt2y4hsg9d603yy45z', '2018-10-10 09:05:59', '2018-10-10 09:05:59');
INSERT INTO `sp_user_session` VALUES ('49', '62', 'sess_99x49prwjmmjbcx2ni0ldf1gty0wr0ip', '2018-10-10 10:59:03', '2018-10-10 10:59:03');
INSERT INTO `sp_user_session` VALUES ('50', '64', 'sess_oydw262dw4c1bzpe1fcsupgmmfuhsjy6', '2018-10-10 13:58:33', '2018-10-10 13:58:33');
INSERT INTO `sp_user_session` VALUES ('51', '66', 'sess_o0lekoum1nengox9fmlj8ne52w1fkcdy', '2018-10-10 13:59:25', '2018-10-10 13:59:25');
INSERT INTO `sp_user_session` VALUES ('52', '67', 'sess_fcv32qn2nlezymmvwtt4tpu374nc9zne', '2018-10-10 14:20:06', '2018-10-10 14:20:06');
INSERT INTO `sp_user_session` VALUES ('53', '68', 'sess_shkk7oni3178x7dom4p7hs3sstzbp838', '2018-10-10 14:23:13', '2018-10-10 14:23:13');
INSERT INTO `sp_user_session` VALUES ('54', '69', 'sess_c72zoh4rch9qlmgsv2c1lbqrejg3dmze', '2018-10-10 14:23:30', '2018-10-10 14:23:30');
INSERT INTO `sp_user_session` VALUES ('55', '71', 'sess_qvvihlnrnpfo46zuhmd6c71gotoiw69d', '2018-10-10 14:25:29', '2018-10-10 14:25:29');
INSERT INTO `sp_user_session` VALUES ('56', '72', 'sess_8upbbv3nt3toiteglwrlsqg6b3drvczi', '2018-10-22 22:02:06', '2018-10-22 22:02:06');
INSERT INTO `sp_user_session` VALUES ('57', '73', 'sess_4s8np4wklbycmldyhb3e7542mquxm1xr', '2018-11-12 17:49:05', '2018-11-12 17:49:05');
INSERT INTO `sp_user_session` VALUES ('58', '87', 'sess_jlo4kxpl5epds1rhwuhlep9fuf39h9pv', '2018-11-12 18:38:39', '2018-11-12 18:38:39');
INSERT INTO `sp_user_session` VALUES ('59', '74', 'sess_1279riuu9zif2yzd0f6hpky4d67ircgd', '2018-11-16 10:25:39', '2018-11-16 10:25:39');
INSERT INTO `sp_user_session` VALUES ('60', '75', 'sess_ehgzdpl4y5cryml98i20lzxizw5zvgws', '2018-11-22 10:53:23', '2018-11-22 10:53:23');
INSERT INTO `sp_user_session` VALUES ('61', '76', 'sess_l1ttby9d27vjj89pqbw10zgw4zfg31zp', '2018-11-27 14:46:58', '2018-11-27 14:46:58');
INSERT INTO `sp_user_session` VALUES ('62', '77', 'sess_f6u8dcdwzw9e6vowc63og0yv0r3snxi8', '2018-11-27 14:48:45', '2018-11-27 14:48:45');
INSERT INTO `sp_user_session` VALUES ('63', '78', 'sess_s7khdkk2welp6ogz5wyt5jbko5bjg54r', '2018-11-28 10:08:29', '2018-11-28 10:08:29');
INSERT INTO `sp_user_session` VALUES ('64', '79', 'sess_1fc1r66erivdm7iv3fkettj9neytqxst', '2018-11-28 10:30:32', '2018-11-28 10:30:32');
INSERT INTO `sp_user_session` VALUES ('65', '80', 'sess_ho76sr6hwodqzyz3sfr9pg4n34883cej', '2018-11-28 10:41:45', '2018-11-28 10:41:45');
INSERT INTO `sp_user_session` VALUES ('66', '81', 'sess_v3l3mv6t38pqgkdnphkn3dfl9vbosc7y', '2018-11-28 16:34:16', '2018-11-28 16:34:16');
INSERT INTO `sp_user_session` VALUES ('67', '82', 'sess_3kuq35yotuq3xp2z08vwg1b6jkop4i3v', '2018-12-04 15:00:17', '2018-12-04 15:00:17');
INSERT INTO `sp_user_session` VALUES ('68', '83', 'sess_5jyxpy7xzh5q0hx36uv33i3pdb282xmw', '2018-12-04 15:03:08', '2018-12-04 15:03:08');
INSERT INTO `sp_user_session` VALUES ('69', '84', 'sess_kyorgpwvsvy8qvv0gsun80ed2npqf99o', '2018-12-05 13:47:22', '2018-12-05 13:47:22');
INSERT INTO `sp_user_session` VALUES ('70', '85', 'sess_8mlb0hz3fb9ox5p5qdop32mfq5lf47w2', '2018-12-05 13:48:49', '2018-12-05 13:48:49');
INSERT INTO `sp_user_session` VALUES ('72', '97', 'sess_4yrhv8hod5xoof9cewz95nmmzxzysn0c', '2018-12-18 16:54:39', '2018-12-18 16:54:39');

-- -----------------------------
-- Table structure for `sp_user_wechat`
-- -----------------------------
DROP TABLE IF EXISTS `sp_user_wechat`;
CREATE TABLE `sp_user_wechat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(100) NOT NULL DEFAULT '',
  `subscribe` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否关注，1是2否',
  `subtime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00' COMMENT '关注时间',
  `scene` varchar(100) NOT NULL DEFAULT '' COMMENT '关注来源',
  `qrscene` int(11) NOT NULL DEFAULT '0' COMMENT '扫码场景',
  `qrscenestr` varchar(100) NOT NULL DEFAULT '' COMMENT '扫码场景描述',
  `addtime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户关注公众号信息';


-- -----------------------------
-- Table structure for `sp_wechat_article`
-- -----------------------------
DROP TABLE IF EXISTS `sp_wechat_article`;
CREATE TABLE `sp_wechat_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `author` varchar(100) NOT NULL DEFAULT '' COMMENT '作者',
  `digest` varchar(200) NOT NULL DEFAULT '' COMMENT '摘要',
  `content` longtext NOT NULL COMMENT '内容',
  `sourceurl` varchar(200) NOT NULL DEFAULT '' COMMENT '阅读原文地址',
  `shoucover` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示封面，1是2否',
  `thumbid` int(11) NOT NULL DEFAULT '0' COMMENT '封面图素材',
  `addid` int(11) NOT NULL DEFAULT '0',
  `addtime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- -----------------------------
-- Table structure for `sp_wechat_material`
-- -----------------------------
DROP TABLE IF EXISTS `sp_wechat_material`;
CREATE TABLE `sp_wechat_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题，没啥用，就是用来标识的，怕不记得哪个是哪个了',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '类型，1图片，2语音，3视频，4图文',
  `forever` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1永久素材，2临时素材',
  `mediaid` varchar(100) NOT NULL DEFAULT '' COMMENT '微信的media_id',
  `params` varchar(200) NOT NULL DEFAULT '' COMMENT '扩展参数，图文消息存article表id,其余的存本地路径',
  `addid` int(11) NOT NULL,
  `addtime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00',
  `updateid` int(11) NOT NULL,
  `updatetime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信素材管理';


-- -----------------------------
-- Table structure for `sp_wechat_menu`
-- -----------------------------
DROP TABLE IF EXISTS `sp_wechat_menu`;
CREATE TABLE `sp_wechat_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '类型，',
  `msgtype` tinyint(1) NOT NULL DEFAULT '1' COMMENT '消息类型',
  `appid` varchar(100) NOT NULL DEFAULT '' COMMENT '小程序的appid',
  `params` varchar(1000) NOT NULL DEFAULT '' COMMENT '参数',
  `parentid` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序号',
  `addid` int(11) NOT NULL DEFAULT '0',
  `addtime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00',
  `updateid` int(11) NOT NULL DEFAULT '0',
  `updatetime` datetime NOT NULL DEFAULT '2018-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

