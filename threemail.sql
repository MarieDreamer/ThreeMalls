/*
MySQL Data Transfer
Source Host: 59.110.142.107
Source Database: threemail
Target Host: 59.110.142.107
Target Database: threemail
Date: 2018/10/15 22:49:24
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mall_id` int(10) NOT NULL COMMENT '商城id 1food 2kuose 3smoke',
  `userid` int(10) NOT NULL COMMENT '用户id',
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `phone` varchar(255) NOT NULL COMMENT '手机号',
  `province` varchar(255) NOT NULL COMMENT '省市区街',
  `address` varchar(255) NOT NULL COMMENT '详细地址楼牌',
  `default` int(10) NOT NULL DEFAULT '0' COMMENT '是否是默认地址',
  `status_delete` int(10) NOT NULL COMMENT '逻辑删除',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for broadcastimg
-- ----------------------------
DROP TABLE IF EXISTS `broadcastimg`;
CREATE TABLE `broadcastimg` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `img` text NOT NULL COMMENT '图片',
  `url` text,
  `class` int(10) DEFAULT NULL COMMENT '类型',
  `status_delete` int(1) NOT NULL COMMENT '逻辑删除',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `modify_time` int(10) DEFAULT NULL COMMENT '最后·修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mall_id` int(10) NOT NULL COMMENT '商城id',
  `user_id` int(10) NOT NULL,
  `commodity_id` int(10) NOT NULL,
  `size_id` int(10) DEFAULT NULL,
  `type_id` int(10) DEFAULT NULL COMMENT '类型',
  `num` int(10) NOT NULL,
  `status_delete` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8 COMMENT='购物车';

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mall_id` int(10) NOT NULL COMMENT '商城id',
  `pid` int(10) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '商品类别名称',
  `category_img` text CHARACTER SET utf8 NOT NULL COMMENT '类别图片',
  `introduce` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '商品类别介绍',
  `status_delete` int(1) NOT NULL DEFAULT '1' COMMENT '逻辑删除',
  `time` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for commodity
-- ----------------------------
DROP TABLE IF EXISTS `commodity`;
CREATE TABLE `commodity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mall_id` tinyint(1) NOT NULL COMMENT '商城id',
  `pid` int(10) unsigned NOT NULL COMMENT '父类',
  `shop_name` varchar(255) NOT NULL COMMENT '商品名称',
  `shop_id` varchar(255) NOT NULL COMMENT '商品编号',
  `shop_index_image` text NOT NULL COMMENT '商品主图',
  `shop_image` text NOT NULL COMMENT '商品图片',
  `main_class` int(10) NOT NULL COMMENT '商品主类',
  `shop_type` int(10) NOT NULL COMMENT '商品类别',
  `shop_num` int(10) DEFAULT NULL COMMENT '库存',
  `shop_sale` int(10) NOT NULL DEFAULT '0' COMMENT '已销售商品数',
  `shop_introduce` varchar(255) NOT NULL COMMENT '商品介绍',
  `original_price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '原价',
  `shop_price` float(10,2) DEFAULT NULL COMMENT '商品价格',
  `is_spell_group` tinyint(1) DEFAULT '0' COMMENT '否是拼团',
  `hot` int(10) NOT NULL DEFAULT '0' COMMENT '热卖',
  `recommend` int(10) NOT NULL DEFAULT '0' COMMENT '推荐',
  `quantity` int(10) NOT NULL DEFAULT '0' COMMENT '限量秒杀',
  `status_delete` tinyint(1) NOT NULL DEFAULT '1' COMMENT '逻辑删除',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for coupon
-- ----------------------------
DROP TABLE IF EXISTS `coupon`;
CREATE TABLE `coupon` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mall_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `discount` int(10) NOT NULL COMMENT '扣折金额',
  `condition` int(10) NOT NULL COMMENT '满多少',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '底部描述',
  `valid_time` int(10) NOT NULL COMMENT '有效时间（天）',
  `status_delete` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for coupon_user
-- ----------------------------
DROP TABLE IF EXISTS `coupon_user`;
CREATE TABLE `coupon_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mall_id` tinyint(1) NOT NULL,
  `coupon_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未使用1已使用2已过期',
  `start_time` int(10) NOT NULL,
  `end_time` int(10) NOT NULL,
  `status_delete` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for distributor
-- ----------------------------
DROP TABLE IF EXISTS `distributor`;
CREATE TABLE `distributor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mall_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0申请中1成功2失败',
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for employee_system
-- ----------------------------
DROP TABLE IF EXISTS `employee_system`;
CREATE TABLE `employee_system` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `status` int(10) unsigned NOT NULL DEFAULT '1',
  `create_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统员工信息';

-- ----------------------------
-- Table structure for evaluation
-- ----------------------------
DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE `evaluation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `commodity_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `user_name` varchar(10) NOT NULL,
  `content` text,
  `image` text,
  `star_level` tinyint(1) NOT NULL,
  `star_num` tinyint(1) NOT NULL,
  `buy_time` int(10) NOT NULL,
  `create_time` int(10) NOT NULL,
  `status_delete` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评价表';

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mall_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `group_id` int(10) DEFAULT NULL COMMENT '拼团id',
  `order_size` int(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0待付款1待发货2待收货3已完成4拼团失败',
  `address` text NOT NULL,
  `message` varchar(255) DEFAULT NULL COMMENT '留言',
  `coupon_id` int(10) DEFAULT NULL,
  `discount` float(10,2) DEFAULT NULL COMMENT '优惠券金额',
  `total_num` int(10) NOT NULL COMMENT '商品件数',
  `total_fee` float(10,2) NOT NULL,
  `final_fee` float(10,2) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for order_detail
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL,
  `commodity_id` int(10) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT '类型',
  `num` int(10) NOT NULL,
  `single_price` float(10,2) NOT NULL COMMENT '单价',
  `price` float(10,2) NOT NULL COMMENT '价单*数量',
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for size
-- ----------------------------
DROP TABLE IF EXISTS `size`;
CREATE TABLE `size` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `commodity_id` int(10) NOT NULL COMMENT '商品id',
  `img` text COMMENT '图片',
  `color` varchar(255) DEFAULT NULL COMMENT '颜色',
  `size` varchar(255) DEFAULT NULL COMMENT '0xs 1s 2m 3l 4xl 5均码',
  `type` varchar(255) DEFAULT NULL COMMENT '型类',
  `price` decimal(10,2) DEFAULT NULL,
  `num` int(10) NOT NULL COMMENT '库存',
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for spell_group
-- ----------------------------
DROP TABLE IF EXISTS `spell_group`;
CREATE TABLE `spell_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `commodity_id` int(10) NOT NULL COMMENT '商品id',
  `order_size` int(10) NOT NULL DEFAULT '2' COMMENT '拼团人数',
  `start_time` int(10) NOT NULL COMMENT '活动开始时间',
  `end_time` int(10) NOT NULL COMMENT '活动结束时间',
  `group_price` decimal(10,2) NOT NULL COMMENT '拼团价格',
  `group_num` int(10) NOT NULL DEFAULT '0' COMMENT '拼团成功次数',
  `status_delete` tinyint(1) NOT NULL DEFAULT '1' COMMENT '逻辑删除',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for spell_group_code
-- ----------------------------
DROP TABLE IF EXISTS `spell_group_code`;
CREATE TABLE `spell_group_code` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) DEFAULT NULL,
  `group_user_id` int(10) DEFAULT NULL COMMENT '开团人',
  `mall_id` int(10) DEFAULT NULL COMMENT '商城id',
  `group_code` varchar(20) DEFAULT NULL COMMENT '拼团码',
  `group_id` int(10) DEFAULT NULL COMMENT '拼团id',
  `group_num` int(10) DEFAULT NULL COMMENT '已拼团人数',
  `group_status` tinyint(1) DEFAULT NULL COMMENT '拼团状态（0已删除，1正在拼团，2拼团成功，3拼团失败）',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wechat_user_cloth
-- ----------------------------
DROP TABLE IF EXISTS `wechat_user_cloth`;
CREATE TABLE `wechat_user_cloth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `pid` int(10) DEFAULT NULL COMMENT '父id',
  `openid` varchar(50) NOT NULL COMMENT 'openid',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `realname` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `phone` varchar(255) DEFAULT NULL COMMENT '手机号',
  `balance` float(10,2) unsigned DEFAULT '0.00' COMMENT '余额',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `present_account` varchar(255) DEFAULT NULL COMMENT '提现账户',
  `imageurl` varchar(200) DEFAULT NULL COMMENT '头像路径',
  `gender` tinyint(1) unsigned DEFAULT NULL COMMENT '性别',
  `city` varchar(50) DEFAULT NULL COMMENT '城市',
  `province` varchar(50) DEFAULT NULL COMMENT '省份',
  `country` varchar(50) DEFAULT NULL COMMENT '国家',
  `login_time` int(10) unsigned DEFAULT NULL COMMENT '上次登录时间',
  `invite_code` varchar(255) DEFAULT NULL COMMENT '邀请码',
  `coupon` varchar(50) DEFAULT NULL COMMENT '优惠券',
  `status_delete` tinyint(10) unsigned NOT NULL COMMENT '逻辑删除',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for wechat_user_food
-- ----------------------------
DROP TABLE IF EXISTS `wechat_user_food`;
CREATE TABLE `wechat_user_food` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `pid` int(10) DEFAULT NULL COMMENT '父id',
  `openid` varchar(50) NOT NULL COMMENT 'openid',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `realname` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `phone` varchar(255) DEFAULT NULL COMMENT '手机号',
  `balance` float(10,2) unsigned DEFAULT '0.00' COMMENT '余额',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `present_account` varchar(255) DEFAULT NULL COMMENT '提现账户',
  `imageurl` varchar(200) DEFAULT NULL COMMENT '头像路径',
  `gender` tinyint(1) unsigned DEFAULT NULL COMMENT '性别',
  `city` varchar(50) DEFAULT NULL COMMENT '城市',
  `province` varchar(50) DEFAULT NULL COMMENT '省份',
  `country` varchar(50) DEFAULT NULL COMMENT '国家',
  `login_time` int(10) unsigned DEFAULT NULL COMMENT '上次登录时间',
  `invite_code` varchar(255) DEFAULT NULL COMMENT '邀请码',
  `coupon` varchar(50) DEFAULT NULL COMMENT '优惠券',
  `status_delete` tinyint(10) unsigned NOT NULL COMMENT '逻辑删除',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for wechat_user_smoke
-- ----------------------------
DROP TABLE IF EXISTS `wechat_user_smoke`;
CREATE TABLE `wechat_user_smoke` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `pid` int(10) DEFAULT NULL COMMENT '上级id',
  `openid` varchar(50) NOT NULL COMMENT 'openid',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `realname` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `phone` varchar(255) DEFAULT NULL COMMENT '手机号',
  `balance` float(10,2) unsigned DEFAULT '0.00' COMMENT '余额',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `present_account` varchar(255) DEFAULT NULL COMMENT '提现账户',
  `imageurl` varchar(200) DEFAULT NULL COMMENT '头像路径',
  `gender` tinyint(1) unsigned DEFAULT NULL COMMENT '性别',
  `city` varchar(50) DEFAULT NULL COMMENT '城市',
  `province` varchar(50) DEFAULT NULL COMMENT '省份',
  `country` varchar(50) DEFAULT NULL COMMENT '国家',
  `login_time` int(10) unsigned DEFAULT NULL COMMENT '上次登录时间',
  `invite_code` varchar(255) DEFAULT NULL COMMENT '邀请码',
  `coupon` varchar(50) DEFAULT NULL COMMENT '优惠券',
  `status_delete` tinyint(10) unsigned NOT NULL COMMENT '逻辑删除',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `address` VALUES ('1', '1', '1', '克里斯', '13088886666', '1浙江省杭州市江干区太平门直街与景昙路交汇处', 'XX单元XX号', '0', '1', '1531974972');
INSERT INTO `address` VALUES ('24', '2', '47', '哈哈哈', '18208350499', '河北省 石家庄市 新华区', '1幢1单元', '0', '0', '1531974972');
INSERT INTO `address` VALUES ('25', '3', '48', '五五开', '15868152877', '浙江省杭州市江干区东亚新干线', '15幢815', '0', '0', '1531974972');
INSERT INTO `address` VALUES ('26', '3', '48', 'PDD', '15868154862', '浙江省得剪卡深刻的内容发你看', 'DEIKKSMDKA', '0', '0', '1531974972');
INSERT INTO `address` VALUES ('27', '1', '47', '马飞飞', '15164665648', '大师毒瓦斯年的艰苦金卡是哦对我拉开', '扽分今年开始开发两款', '0', '1', '1531974972');
INSERT INTO `address` VALUES ('28', '2', '49', '托马斯', '15486561254', '第三代ask打卡时间的卡健身房 ', '多少年多看书 ', '0', '0', '1531974972');
INSERT INTO `address` VALUES ('29', '2', '47', '啦啦啦', '12222223333', '河北省 石家庄市 长安区   ', '1单元222号', '0', '1', '1531974972');
INSERT INTO `address` VALUES ('30', '2', '47', '嚯嚯嚯', '12345678900', '浙江省 杭州市 市辖区  ', '2幢2楼222号', '1', '1', '1535526786');
INSERT INTO `address` VALUES ('34', '2', '47', '111', '111', '天津市 市辖区 和平区', '111', '0', '0', '1535595938');
INSERT INTO `address` VALUES ('35', '2', '47', '123', '123', '河北省 石家庄市 市辖区', '123', '0', '0', '1535596001');
INSERT INTO `address` VALUES ('36', '2', '47', '111', '123', '上海市 市辖区 黄浦区', '123', '0', '0', '1535596055');
INSERT INTO `address` VALUES ('37', '2', '49', '虚伪佳绩多久啊时间', '1586848565456', '吉林省 白山市 靖宇县', '的手机大奖啊就是看大家', '0', '0', '1535596406');
INSERT INTO `address` VALUES ('38', '2', '49', '花花', '17826839632', '河南省 郑州市 市辖区', '1幢1单元', '0', '1', '1535597564');
INSERT INTO `address` VALUES ('39', '2', '49', '华华', '12298793422', '甘肃省 兰州市 永登县 ', '1幢3单元', '0', '0', '1535597594');
INSERT INTO `address` VALUES ('40', '2', '48', '阿三', '15868158888', '山西省 晋城市 泽州县 ', '夫吸街道8-454', '0', '1', '1535599389');
INSERT INTO `address` VALUES ('41', '2', '49', '哈哈', '15868452873', '北京市 市辖区 门头沟区  ', '八幢401', '0', '1', '1535613073');
INSERT INTO `address` VALUES ('42', '2', '48', 'haha', '1586455876', '北京市 市辖区 东城区', '八幢401', '0', '1', '1535613124');
INSERT INTO `address` VALUES ('43', '2', '48', '222', '1234554321', '河北省 石家庄市 长安区', 'oooo', '0', '1', '1535614397');
INSERT INTO `address` VALUES ('44', '3', '48', '小猪先生', '13866666981', '辽宁省 辽阳市 灯塔市 ', '翰墨香霖35-804', '0', '0', '1535614829');
INSERT INTO `address` VALUES ('45', '2', '48', '你', '0987654321', '山西省 太原市 迎泽区 ', '8-2-2', '0', '1', '1535706242');
INSERT INTO `address` VALUES ('46', '3', '49', '飞天小女警', '124343232', '云南省 文山壮族苗族自治州 富宁县 ', '89-22', '0', '1', '1535706634');
INSERT INTO `address` VALUES ('47', '3', '50', '123', '123412341234', '北京市 市辖区 西城区', '123334', '0', '1', '1535942825');
INSERT INTO `address` VALUES ('48', '3', '50', '123123', '1231233', '北京市 市辖区 西城区 ', '123123', '0', '1', '1535943075');
INSERT INTO `address` VALUES ('49', '3', '50', '123123', '123123', '北京市 市辖区 怀柔区', '123', '0', '0', '1535943131');
INSERT INTO `address` VALUES ('50', '2', '50', '123', '123123', '北京市 市辖区 朝阳区 ', '123', '0', '1', '1535945403');
INSERT INTO `address` VALUES ('51', '2', '49', '宝宝', '12345678909', '安徽省 淮北市 濉溪县', '78弄', '0', '0', '1535945554');
INSERT INTO `address` VALUES ('52', '3', '48', 'xuweijia', '15864521845', '天津市 县 蓟县', '78栋', '0', '1', '1535946245');
INSERT INTO `address` VALUES ('53', '3', '48', '周总', '158666666987', '辽宁省 抚顺市 望花区', '翰墨香霖35幢701', '0', '1', '1535955752');
INSERT INTO `address` VALUES ('54', '1', '46', '森先生', '19922224444', '浙江省 杭州市 江干区', '1231232312323', '0', '1', '1536026874');
INSERT INTO `address` VALUES ('55', '2', '50', '偶奇偶', '1211111111', '吉林省 白城市 大安市', '9-221', '0', '1', '1536110404');
INSERT INTO `address` VALUES ('56', '1', '48', '222', '2778999', '天津市 县 宁河县', '3311', '0', '1', '1536111528');
INSERT INTO `address` VALUES ('57', '1', '49', '三十三', '12222222', '河南省 郑州市 二七区', '春雨小区 1栋1号', '0', '1', '1536392959');
INSERT INTO `broadcastimg` VALUES ('9', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/14\\/5b723b7ed84d4.jpg\",\"\\/Uploads\\/Tmps\\/2018\\/08\\/14\\/5b723b7edf692.jpg\"]', '123', '4466', '0', '1534212147', '1534212993');
INSERT INTO `broadcastimg` VALUES ('10', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7bdbc8196ee.jpg\",\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7bdbd384681.jpg\"]', '', '0', '0', '1534747605', '1534843863');
INSERT INTO `broadcastimg` VALUES ('11', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/24\\/5b7fa3c4c64aa.jpg\"]', null, null, '0', '1535091654', null);
INSERT INTO `broadcastimg` VALUES ('12', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/24\\/5b7fa4991e2f8.jpg\"]', null, null, '0', '1535091868', null);
INSERT INTO `broadcastimg` VALUES ('13', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/24\\/5b7fabbf14b41.jpg\"]', '', '1', '0', '1535092421', '1535093700');
INSERT INTO `broadcastimg` VALUES ('14', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/31\\/5b889f263cf90\"]', 'yanjiushouyelunbo', '5', '1', '1535680296', null);
INSERT INTO `broadcastimg` VALUES ('15', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/31\\/5b88aa2f46fab.jpg\"]', 'yejiushouyelunbo2', '5', '1', '1535683120', null);
INSERT INTO `broadcastimg` VALUES ('16', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f3302b5e97.JPG\"]', '', '1', '1', '1536111363', null);
INSERT INTO `broadcastimg` VALUES ('17', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f3310c958b.JPG\"]', '', '1', '1', '1536111378', null);
INSERT INTO `broadcastimg` VALUES ('18', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f331b475d4.JPG\"]', '', '1', '1', '1536111388', null);
INSERT INTO `broadcastimg` VALUES ('19', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f39713d49d.png\"]', '', '3', '1', '1536113009', null);
INSERT INTO `broadcastimg` VALUES ('20', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f3984dbacd.png\"]', '', '3', '1', '1536113029', null);
INSERT INTO `broadcastimg` VALUES ('21', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f398e77ebd.png\"]', '', '3', '1', '1536113039', null);
INSERT INTO `broadcastimg` VALUES ('22', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f39996ab7e.png\"]', '', '3', '1', '1536113050', null);
INSERT INTO `broadcastimg` VALUES ('23', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f3d267a04e.png\"]', 'gopartner', '4', '1', '1536113960', null);
INSERT INTO `broadcastimg` VALUES ('24', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f3d70be2e0.png\"]', 'gopintuan', '4', '1', '1536114034', null);
INSERT INTO `broadcastimg` VALUES ('25', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f3d9036b6a.png\"]', 'gomiaosha', '4', '1', '1536114065', null);
INSERT INTO `broadcastimg` VALUES ('26', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f3db667bc3.png\"]', 'gofree', '4', '1', '1536114103', null);
INSERT INTO `broadcastimg` VALUES ('27', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f3de5e3671.png\"]', 'goxinpin', '4', '1', '1536114150', null);
INSERT INTO `cart` VALUES ('117', '1', '48', '39', null, '1', '2', '1', '1536200820');
INSERT INTO `cart` VALUES ('118', '1', '48', '36', null, '1', '3', '1', '1536200894');
INSERT INTO `cart` VALUES ('119', '1', '48', '35', null, '1', '2', '1', '1536200929');
INSERT INTO `cart` VALUES ('120', '1', '48', '20', null, '1', '2', '1', '1536200952');
INSERT INTO `cart` VALUES ('121', '1', '48', '21', null, '1', '3', '1', '1536200961');
INSERT INTO `cart` VALUES ('122', '1', '48', '30', null, '1', '3', '1', '1536200966');
INSERT INTO `cart` VALUES ('129', '2', '50', '23', '0', '1', '2', '1', '1536201148');
INSERT INTO `cart` VALUES ('130', '2', '50', '22', '0', '1', '2', '1', '1536201163');
INSERT INTO `cart` VALUES ('131', '2', '50', '23', '0', '11', '1', '1', '1536201228');
INSERT INTO `cart` VALUES ('132', '2', '50', '23', '0', '1', '1', '1', '1536201236');
INSERT INTO `cart` VALUES ('133', '2', '50', '22', '0', '1', '3', '1', '1536201252');
INSERT INTO `cart` VALUES ('134', '2', '50', '22', '0', '11', '2', '1', '1536201268');
INSERT INTO `cart` VALUES ('143', '2', '49', '23', '0', '1', '4', '1', '1536213082');
INSERT INTO `cart` VALUES ('144', '2', '49', '23', '0', '1', '1', '1', '1536213311');
INSERT INTO `cart` VALUES ('145', '1', '47', '39', null, '1', '3', '1', '1536213451');
INSERT INTO `cart` VALUES ('146', '1', '47', '36', null, '1', '1', '1', '1536213464');
INSERT INTO `cart` VALUES ('149', '3', '49', '34', null, '1', '2', '1', '1536278044');
INSERT INTO `cart` VALUES ('150', '1', '48', '74', null, '1', '2', '1', '1536312680');
INSERT INTO `cart` VALUES ('160', '3', '49', '41', null, null, '2', '1', '1536383574');
INSERT INTO `cart` VALUES ('168', '2', '47', '23', null, '11', '1', '1', '1536407831');
INSERT INTO `cart` VALUES ('170', '2', '47', '22', null, '1', '2', '1', '1536410739');
INSERT INTO `cart` VALUES ('173', '1', '49', '74', null, '75', '2', '1', '1536543633');
INSERT INTO `cart` VALUES ('176', '3', '48', '25', null, '8', '7', '1', '1536566394');
INSERT INTO `cart` VALUES ('178', '3', '48', '41', null, '25', '2', '1', '1536812619');
INSERT INTO `category` VALUES ('25', '1', '0', '水果', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/28\\/5b84ee32e0c18.jpg\"]', '水果', '1', '1534816456');
INSERT INTO `category` VALUES ('26', '1', '25', '热带水果', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7b717d86410.jpg\"]', '热带水果', '1', '1534816639');
INSERT INTO `category` VALUES ('27', '1', '25', '西瓜', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7b7b9f8cb21.jpg\"]', '大西瓜', '0', '1534819242');
INSERT INTO `category` VALUES ('28', '2', '0', '衣裤', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7b7c1e6cd75.jpg\"]', '穿的', '0', '1534819360');
INSERT INTO `category` VALUES ('29', '1', '0', '冷冻食品', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/28\\/5b8508b0e0321.jpg\"]', '冷藏生鲜', '1', '1535445169');
INSERT INTO `category` VALUES ('30', '2', '0', '天湖', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/28\\/5b850d7d17505.jpg\"]', '好东西', '0', '1535446398');
INSERT INTO `category` VALUES ('32', '2', '0', '女装', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/03\\/5b8c941d367eb.jpg\"]', '女士服装', '0', '1535939614');
INSERT INTO `category` VALUES ('33', '2', '0', '上衣', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/03\\/5b8ccb51af80a.png\"]', '上衣', '1', '1535946661');
INSERT INTO `category` VALUES ('34', '2', '0', '裙子', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/03\\/5b8ccb669751d.png\"]', '裙子', '1', '1535946679');
INSERT INTO `category` VALUES ('35', '2', '0', '外套', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/03\\/5b8ccb734c68f.png\"]', '外套', '1', '1535946730');
INSERT INTO `category` VALUES ('36', '2', '0', '鞋子', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/03\\/5b8ccb7e195b3.png\"]', '鞋子', '1', '1535946766');
INSERT INTO `category` VALUES ('37', '2', '0', '帽子', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/03\\/5b8ccb8998295.png\"]', '帽子', '1', '1535946793');
INSERT INTO `category` VALUES ('38', '2', '0', '裤子', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/03\\/5b8ccb944cff7.png\"]', '裤子', '1', '1535946831');
INSERT INTO `category` VALUES ('39', '3', '0', '万宝路', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f7a7db7c7e.jpg\"]', '进口烟', '1', '1536129664');
INSERT INTO `commodity` VALUES ('20', '1', '25', '菠萝', '2312313', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7b738094ca5.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7b7386efb11.jpg\"]', '0', '25', '1002', '5', '水晶菠萝', '0.00', '30.00', '1', '0', '1', '0', '1', '1534817212');
INSERT INTO `commodity` VALUES ('21', '1', '25', '哈密瓜', '2116545', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7b760841a26.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7b760b68f23.jpg\"]', '0', '25', '98', '10', '可口哈密瓜', '0.00', '50.00', '0', '1', '0', '1', '1', '1534817988');
INSERT INTO `commodity` VALUES ('22', '2', '25', '2018阔色夏季新款韩版女装短袖', '14121', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7bbe6f02ae9.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7bbe7321be6.jpg\",\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7bbe733ca05.jpg\",\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7bbe73623c5.jpg\"]', '33', '33', '497', '19', '短袖', '0.00', '85.00', '1', '0', '0', '0', '1', '1534836344');
INSERT INTO `commodity` VALUES ('23', '2', '25', '长袖', '15125', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7bbfa6d9529.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7bbfac5ff8b.jpg\",\"\\/Uploads\\/Tmps\\/2018\\/08\\/21\\/5b7bbfac765d0.jpg\"]', '33', '33', '489', '20', '创新创效', '0.00', '94.00', '0', '0', '0', '0', '1', '1534836666');
INSERT INTO `commodity` VALUES ('25', '3', '14', '中华1', '123123321', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/04\\/5b8e3e3ada72c\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/04\\/5b8e3e5d9a1b4\"]', '31', '31', '1896', '116', '温和不刺激，清爽不粘fu', '0.00', '40.00', '1', '0', '0', '0', '1', '1534517212');
INSERT INTO `commodity` VALUES ('30', '1', '25', '【三只松鼠】夏威夷果500g', '123213', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/24\\/5b7fcf013e09f.jpg\",\"\\/Uploads\\/Tmps\\/2018\\/08\\/24\\/5b7fcf0159ed9.jpg\",\"\\/Uploads\\/Tmps\\/2018\\/08\\/24\\/5b7fcf016fe31.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/24\\/5b7fcf013e09f.jpg\",\"\\/Uploads\\/Tmps\\/2018\\/08\\/24\\/5b7fcf0159ed9.jpg\",\"\\/Uploads\\/Tmps\\/2018\\/08\\/24\\/5b7fcf016fe31.jpg\"]', '0', '26', '59', '22', '夏威夷果', '0.00', '26.90', '1', '0', '0', '0', '1', '1535102733');
INSERT INTO `commodity` VALUES ('32', '1', '25', '好东西', '1', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/28\\/5b8508358d79a.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/28\\/5b850839ecd9d.jpg\"]', '0', '26', '999', '222', '滴滴滴滴滴滴', '0.00', '888.00', '0', '0', '0', '0', '1', '1535445237');
INSERT INTO `commodity` VALUES ('33', '2', '30', 'sad', '9', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/28\\/5b850da924433.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/28\\/5b850daec9dcd.jpg\"]', '0', '0', '999', '111', '希瓦娜', '0.00', '666.00', '0', '0', '0', '0', '1', '1535446453');
INSERT INTO `commodity` VALUES ('35', '1', '0', '桃子', '21213', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b87536394795.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b8753676b308.jpg\"]', '0', '25', '294', '0', '水蜜桃', '0.00', '30.00', '0', '0', '0', '0', '1', '1535595403');
INSERT INTO `commodity` VALUES ('36', '1', '0', '西瓜', '23162164', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b87670114119.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b8767035d6cf.jpg\"]', '0', '25', '96', '30', '大西瓜', '0.00', '50.00', '0', '0', '0', '0', '1', '1535600482');
INSERT INTO `commodity` VALUES ('37', '1', '0', '香蕉', '544545121', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b8768c6b484c.png\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b8768c9a8559.png\"]', '0', '26', '100', '10', '香蕉香蕉', '0.00', '25.00', '0', '0', '0', '0', '1', '1535600859');
INSERT INTO `commodity` VALUES ('38', '1', '0', '【三只松鼠】休闲零食草莓干', '34353', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b87856e20cc9.jpg\",\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b87856e31171.jpg\",\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b87856e555e1.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b87856e20cc9.jpg\",\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b87856e31171.jpg\",\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b87856e555e1.jpg\"]', '0', '26', '87', '2', '草莓干', '0.00', '22.90', '0', '0', '0', '0', '1', '1535608183');
INSERT INTO `commodity` VALUES ('39', '1', '0', '榴莲', '11445', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b87a9a26a3a6.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/08\\/30\\/5b87a9a9af724.jpg\"]', '25', '26', '91', '82', '榴莲榴莲榴莲', '0.00', '70.00', '0', '0', '0', '0', '1', '1535617460');
INSERT INTO `commodity` VALUES ('40', '2', '0', '绿色裙子', '111111', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/03\\/5b8c94f764dca.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/03\\/5b8c94f9ba7c4.jpg\"]', '32', '32', '100', '0', '测试', '0.00', '50.00', '0', '0', '0', '0', '1', '1535939835');
INSERT INTO `commodity` VALUES ('41', '3', '0', '利群', '15465', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f788f48c15\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8f789b58b68\"]', '31', '31', '9', '19', '利群牌香烟', '0.00', '45.00', '0', '0', '1', '0', '1', '1536129191');
INSERT INTO `commodity` VALUES ('42', '2', '0', '32让人', '12131', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8fa8612ee59.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/05\\/5b8fa8683d33a.jpg\"]', '37', '37', '123', '11', '666', '0.00', '10.00', '0', '0', '0', '0', '1', '1536141431');
INSERT INTO `commodity` VALUES ('43', '1', '0', '测试', '1536199124849725', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b9089471fe69.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b90894a022a2.jpg\"]', '29', '29', '100', '0', '测试测试测试', '0.00', '10000.00', '0', '0', '0', '0', '1', '1536199124');
INSERT INTO `commodity` VALUES ('44', '1', '0', '测试', '1536220791699672', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b90de6e2174f.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b90de718c644.jpg\"]', '29', '29', '20', '0', '测试测试', '0.00', '100.00', '0', '0', '0', '0', '1', '1536220791');
INSERT INTO `commodity` VALUES ('45', '2', '0', '1', '1536221857557743', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b90e2823d149.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b90e28579beb.jpg\"]', '34', '34', '1', '1', '1', '0.00', '1.00', '0', '0', '0', '0', '0', '1536221857');
INSERT INTO `commodity` VALUES ('46', '2', '0', '11', '1536222122349748', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b90e39fa3569.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b90e3a329a4f.jpg\"]', '34', '34', '11', '11', '11', '0.00', '11.00', '0', '0', '0', '0', '1', '1536222122');
INSERT INTO `commodity` VALUES ('47', '1', '0', '测试', '1536222532554395', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b90e538ac909.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b90e53b62770.jpg\"]', '29', '29', '100', '0', '12', '0.00', '12.00', '0', '0', '0', '0', '0', '1536222532');
INSERT INTO `commodity` VALUES ('48', '1', '0', '测试', '1536222580797869', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b90e56d3a211.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b90e57015e30.jpg\"]', '29', '29', '100', '10', '123', '0.00', '123.00', '0', '0', '0', '0', '0', '1536222580');
INSERT INTO `commodity` VALUES ('49', '1', '0', '测试0001', '1536223574245911', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b90e9453f564.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/06\\/5b90e9482c2ce.jpg\"]', '29', '29', '8', '0', '10', '0.00', '10.00', '0', '0', '0', '0', '0', '1536223574');
INSERT INTO `commodity` VALUES ('65', '2', '0', '1325132', '1536301270892982', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b92174b28204.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b92174da412d.jpg\"]', '33', '33', '34', '0', '12', '0.00', '0.00', '0', '0', '0', '0', '0', '1536301270');
INSERT INTO `commodity` VALUES ('66', '2', '0', '1325132', '1536301392341714', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b92174b28204.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b92174da412d.jpg\"]', '33', '33', '34', '0', '12', '0.00', '2.00', '0', '0', '0', '0', '0', '1536301392');
INSERT INTO `commodity` VALUES ('68', '2', '0', '11', '1536301822545752', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b921a9ad0a27.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b921aa28ef42.jpg\"]', '37', '37', '33', '1', '11', '0.00', '68.00', '0', '0', '0', '0', '1', '1536301822');
INSERT INTO `commodity` VALUES ('70', '2', '0', '1325132', '1536301945217962', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b92174b28204.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b92174da412d.jpg\"]', '33', '33', '34', '0', '12', '0.00', '12.00', '0', '0', '0', '0', '0', '1536301945');
INSERT INTO `commodity` VALUES ('71', '2', '0', 'ceshi', '1536303263944729', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b922098c7590.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b92209bdd2bc.jpg\"]', '33', '33', '6', '0', 'ces', '0.00', '1.00', '0', '0', '0', '0', '0', '1536303263');
INSERT INTO `commodity` VALUES ('72', '2', '0', 'cesssss', '1536308709498629', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b9235d4bcd15.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b9235d70f403.jpg\"]', '33', '33', '3', '0', 'xxx', '0.00', '1.00', '0', '0', '0', '0', '0', '1536308709');
INSERT INTO `commodity` VALUES ('73', '2', '0', '完整测试01', '1536309002525681', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b9236fb7857e.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b9236fe1adef.jpg\"]', '33', '33', '128', '0', '完整测试01完整测试01完整测试01', '0.00', '9.00', '0', '0', '0', '0', '1', '1536309002');
INSERT INTO `commodity` VALUES ('74', '1', '0', '吃的', '1536312247883635', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b92435d1eeac.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b9243aea2a6d.jpg\"]', '29', '29', '537', '63', '66663', '0.00', '10.00', '0', '0', '0', '0', '1', '1536312247');
INSERT INTO `commodity` VALUES ('75', '2', '0', '穿的', '1536313626194471', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b924908aca8c.jpg\"]', '[\"\\/Uploads\\/Tmps\\/2018\\/09\\/07\\/5b924909d9a58.jpg\"]', '33', '33', '888', '0', '好东西', '0.00', '123.00', '0', '0', '0', '0', '1', '1536313626');
INSERT INTO `coupon` VALUES ('1', '1', '三只松鼠优惠券', '10', '59', '全部商品可用', '3', '1', '1234567890');
INSERT INTO `coupon` VALUES ('2', '1', '三只松鼠优惠券', '180', '299', '全部商品可用', '3', '1', '1234567890');
INSERT INTO `coupon_user` VALUES ('5', '1', '1', '49', '0', '1535686425', '1535945625', '1', '1535686425');
INSERT INTO `coupon_user` VALUES ('6', '1', '2', '49', '0', '1535686438', '1535945638', '1', '1535686438');
INSERT INTO `coupon_user` VALUES ('7', '1', '1', '46', '0', '1535703748', '1535962948', '1', '1535703748');
INSERT INTO `coupon_user` VALUES ('8', '1', '2', '46', '0', '1535703748', '1535962948', '1', '1535703748');
INSERT INTO `coupon_user` VALUES ('9', '1', '1', '48', '0', '1535704730', '1535963930', '1', '1535704730');
INSERT INTO `coupon_user` VALUES ('10', '1', '2', '48', '0', '1535704748', '1535963948', '1', '1535704748');
INSERT INTO `coupon_user` VALUES ('11', '1', '2', '50', '0', '1535944909', '1536204109', '1', '1535944909');
INSERT INTO `coupon_user` VALUES ('12', '1', '1', '50', '0', '1535944911', '1536204111', '1', '1535944911');
INSERT INTO `coupon_user` VALUES ('13', '1', '1', '47', '0', '1536040297', '1536299497', '1', '1536040297');
INSERT INTO `coupon_user` VALUES ('14', '1', '2', '47', '0', '1536040298', '1536299498', '1', '1536040298');
INSERT INTO `distributor` VALUES ('1', '1', '50', '12312341234', '0', '1534747193');
INSERT INTO `employee_system` VALUES ('2', 'root02', '224cf2b695a5e8ecaecfb9015161fa4b', 'admin', '0', '1', '1500865568');
INSERT INTO `order` VALUES ('1', '1', '1', '9', '20', '3', '1', '1', '1', '1.00', '1', '1.00', '1.00', '1');
INSERT INTO `order` VALUES ('2', '1', '1', '9', '20', '3', '1', '1', '1', '1.00', '1', '1.00', '1.00', '1');
INSERT INTO `order` VALUES ('47', '2', '47', '1', '2', '3', '浙江省杭州市江干区 1幢1单元 曾诗雨 18208350495', '', null, null, '1', '55.00', '55.00', '1535094833');
INSERT INTO `order` VALUES ('48', '2', '47', '1', '2', '3', '浙江省杭州市江干区 1幢1单元 曾诗雨 18208350495', '', null, null, '1', '55.00', '55.00', '1535096033');
INSERT INTO `order` VALUES ('49', '2', '47', '1', '2', '3', '浙江省杭州市江干区 1幢1单元 曾诗雨 18208350495', '', null, null, '1', '55.00', '55.00', '1535097132');
INSERT INTO `order` VALUES ('52', '3', '48', '21', '20', '0', '浙江省杭州市江干区东亚新干线 15幢815 五五开 15868152877', '', null, null, '2', '80.00', '80.00', '1535340837');
INSERT INTO `order` VALUES ('54', '3', '48', '21', '20', '0', '浙江省杭州市江干区东亚新干线 15幢815 五五开 15868152877', '', null, null, '3', '120.00', '120.00', '1535348964');
INSERT INTO `order` VALUES ('55', '1', '47', '23', '3', '0', '浙江省得剪卡深刻的内容发你看 DEIKKSMDKA PDD 15868154862', '', null, null, '2', '32.00', '32.00', '1535354512');
INSERT INTO `order` VALUES ('56', '2', '49', '1', '2', '0', '第三代ask打卡时间的卡健身房  多少年多看书  托马斯 15486561254', '', null, null, '1', '55.00', '55.00', '1535355856');
INSERT INTO `order` VALUES ('57', '2', '47', '1', '2', '1', '浙江省杭州市江干区 1幢1单元 曾诗雨 18208350495', '', null, null, '1', '55.00', '55.00', '1535379571');
INSERT INTO `order` VALUES ('58', '2', '47', '1', '2', '0', '浙江省杭州市江干区 1幢1单元 曾诗雨 18208350495', 'hhh', null, null, '1', '55.00', '55.00', '1535428323');
INSERT INTO `order` VALUES ('59', '2', '47', '1', '2', '0', '浙江省杭州市江干区 1幢1单元 曾诗雨 18208350495', 'xxx', null, null, '1', '55.00', '55.00', '1535435987');
INSERT INTO `order` VALUES ('60', '1', '47', null, null, '0', '浙江省得剪卡深刻的内容发你看 DEIKKSMDKA PDD 15868154862', '', null, null, '3', '48.00', '48.00', '1535447463');
INSERT INTO `order` VALUES ('72', '3', '48', null, null, '0', '辽宁省 辽阳市 灯塔市  翰墨香霖35-804 小猪先生 13866666981', 'undefined', null, null, '3', '120.00', '120.00', '1535743588');
INSERT INTO `order` VALUES ('73', '3', '48', null, null, '0', '辽宁省 辽阳市 灯塔市  翰墨香霖35-804 小猪先生 13866666981', 'undefined', null, null, '3', '120.00', '120.00', '1535941755');
INSERT INTO `order` VALUES ('74', '3', '50', null, null, '0', '北京市 市辖区 西城区  123123 123123 1231233', 'undefined', null, null, '1', '40.00', '40.00', '1535943810');
INSERT INTO `order` VALUES ('75', '3', '50', null, null, '0', '北京市 市辖区 西城区  123123 123123 1231233', 'undefined', null, null, '1', '40.00', '40.00', '1535943816');
INSERT INTO `order` VALUES ('81', '1', '49', null, null, '1', '甘肃省 兰州市 永登县  1幢3单元 华华 12298793422', '', null, null, '9', '234.10', '234.10', '1535963752');
INSERT INTO `order` VALUES ('82', '3', '48', null, null, '0', '天津市 县 蓟县 78栋 xuweijia 15864521845', 'undefined', null, null, '1', '40.00', '40.00', '1536027689');
INSERT INTO `order` VALUES ('83', '3', '48', null, null, '0', '天津市 县 蓟县 78栋 xuweijia 15864521845', 'undefined', null, null, '1', '40.00', '40.00', '1536027689');
INSERT INTO `order` VALUES ('84', '3', '48', null, null, '0', '天津市 县 蓟县 78栋 xuweijia 15864521845', 'undefined', null, null, '1', '40.00', '40.00', '1536027689');
INSERT INTO `order` VALUES ('85', '2', '50', null, null, '0', '北京市 市辖区 朝阳区 123 123 123123', '222 ', null, null, '1', '94.00', '94.00', '1536109387');
INSERT INTO `order` VALUES ('86', '2', '50', '1', '2', '0', '北京市 市辖区 朝阳区 123 123 123123', '', null, null, '1', '55.00', '55.00', '1536109486');
INSERT INTO `order` VALUES ('87', '2', '50', null, null, '0', '北京市 市辖区 东城区 9-9999999999 啊啊啊啊啊  2121212121212', '', null, null, '1', '94.00', '94.00', '1536110554');
INSERT INTO `order` VALUES ('88', '1', '48', null, null, '0', '山西省 晋城市 泽州县 夫吸街道8-454 阿三 15868158888', '', null, null, '2', '140.00', '140.00', '1536110712');
INSERT INTO `order` VALUES ('89', '1', '48', null, null, '0', '山西省 晋城市 泽州县 夫吸街道8-454 阿三 15868158888', '666', null, null, '4', '120.00', '120.00', '1536110933');
INSERT INTO `order` VALUES ('90', '1', '48', '23', '3', '0', '山西省 晋城市 泽州县 夫吸街道8-454 阿三 15868158888', '', null, null, '3', '48.00', '48.00', '1536111229');
INSERT INTO `order` VALUES ('91', '2', '47', null, null, '3', '浙江省 杭州市 市辖区 2幢2楼222号 嚯嚯嚯 12345678900', '', null, null, '2', '188.00', '188.00', '1536140855');
INSERT INTO `order` VALUES ('92', '2', '50', null, null, '0', '北京市 市辖区 朝阳区  1幢1单元', '', null, null, '5', '470.00', '470.00', '1536196957');
INSERT INTO `order` VALUES ('93', '1', '48', null, null, '0', '山西省 晋城市 泽州县  夫吸街道8-454 阿三 15868158888', '', null, null, '2', '140.00', '140.00', '1536200836');
INSERT INTO `order` VALUES ('94', '1', '48', null, null, '0', '山西省 晋城市 泽州县  夫吸街道8-454 阿三 15868158888', '', null, null, '2', '20.00', '20.00', '1536309470');
INSERT INTO `order` VALUES ('95', '3', '49', null, null, '0', '云南省 文山壮族苗族自治州 富宁县  89-22 飞天小女警 124343232', 'undefined', null, null, '2', '100.00', '100.00', '1536314304');
INSERT INTO `order` VALUES ('96', '3', '49', null, null, '0', '云南省 文山壮族苗族自治州 富宁县  89-22 飞天小女警 124343232', 'undefined', null, null, '2', '100.00', '100.00', '1536314457');
INSERT INTO `order` VALUES ('100', '1', '49', null, null, '1', '河南省 郑州市 市辖区 1幢1单元 花花 17826839632', '', null, null, '3', '40.00', '40.00', '1536389507');
INSERT INTO `order` VALUES ('105', '1', '49', null, null, '0', '河南省 郑州市 二七区 春雨小区 1栋1号 三十三 12222222', '', null, null, '3', '30.00', '30.00', '1536393128');
INSERT INTO `order` VALUES ('106', '1', '49', null, null, '0', '河南省 郑州市 二七区 春雨小区 1栋1号 三十三 12222222', '', null, null, '3', '45.00', '45.00', '1536393247');
INSERT INTO `order` VALUES ('107', '1', '49', '23', '3', '0', '河南省 郑州市 二七区 春雨小区 1栋1号 三十三 12222222', '', null, null, '2', '32.00', '32.00', '1536397471');
INSERT INTO `order` VALUES ('109', '2', '47', null, null, '0', '河北省 石家庄市 长安区    1单元222号 啦啦啦 12222223333', '', null, null, '1', '94.00', '94.00', '1536410011');
INSERT INTO `order` VALUES ('110', '2', '47', null, null, '1', '浙江省 杭州市 市辖区   2幢2楼222号 嚯嚯嚯 12345678900', '', null, null, '2', '196.00', '196.00', '1536410562');
INSERT INTO `order` VALUES ('111', '2', '47', '1', '2', '0', '浙江省 杭州市 市辖区   2幢2楼222号 嚯嚯嚯 12345678900', '', null, null, '2', '110.00', '110.00', '1536414025');
INSERT INTO `order` VALUES ('112', '3', '48', null, null, '0', '辽宁省 抚顺市 望花区 翰墨香霖35幢701 周总 158666666987', 'undefined', null, null, '0', '0.00', '0.00', '1536542661');
INSERT INTO `order` VALUES ('113', '3', '48', null, null, '0', '辽宁省 抚顺市 望花区 翰墨香霖35幢701 周总 158666666987', 'undefined', null, null, '0', '0.00', '0.00', '1536542963');
INSERT INTO `order` VALUES ('114', '3', '48', null, null, '0', '辽宁省 抚顺市 望花区 翰墨香霖35幢701 周总 158666666987', 'undefined', null, null, '0', '0.00', '0.00', '1536543048');
INSERT INTO `order` VALUES ('115', '3', '48', null, null, '0', '辽宁省 抚顺市 望花区 翰墨香霖35幢701 周总 158666666987', 'undefined', null, null, '0', '0.00', '0.00', '1536543133');
INSERT INTO `order` VALUES ('116', '2', '48', null, null, '0', '山西省 太原市 迎泽区  8-2-2 你 0987654321', '', null, null, '1', '98.00', '98.00', '1536831527');
INSERT INTO `order_detail` VALUES ('41', '47', '22', 'xl', '蓝色', null, '1', '55.00', '55.00', '1535094833');
INSERT INTO `order_detail` VALUES ('42', '48', '22', 'm', '黄色', null, '1', '55.00', '55.00', '1535096033');
INSERT INTO `order_detail` VALUES ('43', '49', '22', 'xl', '蓝色', null, '1', '55.00', '55.00', '1535097132');
INSERT INTO `order_detail` VALUES ('46', '52', '25', '软壳', 'undefined', null, '2', '40.00', '80.00', '1535340837');
INSERT INTO `order_detail` VALUES ('48', '54', '25', '软壳', 'undefined', null, '3', '40.00', '120.00', '1535348964');
INSERT INTO `order_detail` VALUES ('49', '55', '30', 'undefined', 'undefined', null, '2', '16.00', '32.00', '1535354512');
INSERT INTO `order_detail` VALUES ('50', '56', '22', 'xs', '蓝色', null, '1', '55.00', '55.00', '1535355856');
INSERT INTO `order_detail` VALUES ('51', '57', '22', 'l', '蓝色', null, '1', '55.00', '55.00', '1535379571');
INSERT INTO `order_detail` VALUES ('52', '58', '22', 'l', '蓝色', null, '1', '55.00', '55.00', '1535428323');
INSERT INTO `order_detail` VALUES ('53', '59', '22', 'l', '蓝色', null, '1', '55.00', '55.00', '1535435987');
INSERT INTO `order_detail` VALUES ('54', '60', '30', 'undefined', 'undefined', null, '3', '48.00', '144.00', '1535447463');
INSERT INTO `order_detail` VALUES ('65', '72', '25', '硬壳', 'undefined', null, '3', '120.00', '360.00', '1535743588');
INSERT INTO `order_detail` VALUES ('66', '73', '25', null, 'undefined', null, '3', '120.00', '360.00', '1535941755');
INSERT INTO `order_detail` VALUES ('67', '74', '25', null, 'undefined', null, '1', '40.00', '40.00', '1535943810');
INSERT INTO `order_detail` VALUES ('68', '75', '25', null, 'undefined', null, '1', '40.00', '40.00', '1535943816');
INSERT INTO `order_detail` VALUES ('69', '81', '30', null, null, '1', '7', '26.90', '188.30', '1535963752');
INSERT INTO `order_detail` VALUES ('70', '81', '38', null, null, null, '2', '22.90', '45.80', '1535963752');
INSERT INTO `order_detail` VALUES ('71', '82', '25', null, 'undefined', null, '1', '40.00', '40.00', '1536027689');
INSERT INTO `order_detail` VALUES ('72', '83', '25', null, 'undefined', null, '1', '40.00', '40.00', '1536027689');
INSERT INTO `order_detail` VALUES ('73', '84', '25', null, 'undefined', null, '1', '40.00', '40.00', '1536027689');
INSERT INTO `order_detail` VALUES ('74', '85', '23', 'l', '紫色', null, '1', '94.00', '94.00', '1536109387');
INSERT INTO `order_detail` VALUES ('75', '86', '22', 'xs', '蓝色', null, '1', '55.00', '55.00', '1536109486');
INSERT INTO `order_detail` VALUES ('76', '87', '23', 'l', '紫色', null, '1', '94.00', '94.00', '1536110554');
INSERT INTO `order_detail` VALUES ('77', '88', '39', null, null, null, '2', '70.00', '140.00', '1536110712');
INSERT INTO `order_detail` VALUES ('78', '89', '35', null, null, null, '4', '30.00', '120.00', '1536110933');
INSERT INTO `order_detail` VALUES ('79', '90', '30', null, null, '1', '3', '16.00', '48.00', '1536111229');
INSERT INTO `order_detail` VALUES ('80', '91', '23', 'm', '绿色', null, '2', '94.00', '188.00', '1536140855');
INSERT INTO `order_detail` VALUES ('81', '92', '23', 'm', '绿色', null, '5', '94.00', '470.00', '1536196957');
INSERT INTO `order_detail` VALUES ('82', '93', '39', null, null, null, '2', '70.00', '140.00', '1536200836');
INSERT INTO `order_detail` VALUES ('83', '94', '49', null, null, '2', '2', '10.00', '20.00', '1536309470');
INSERT INTO `order_detail` VALUES ('84', '95', '41', '黑利', 'undefined', null, '2', '100.00', '200.00', '1536314304');
INSERT INTO `order_detail` VALUES ('85', '96', '41', '黑利', 'undefined', null, '2', '100.00', '200.00', '1536314457');
INSERT INTO `order_detail` VALUES ('88', '100', '74', null, null, '鲜辣', '2', '15.00', '30.00', '1536389507');
INSERT INTO `order_detail` VALUES ('89', '100', '74', null, null, '葱香', '1', '10.00', '10.00', '1536389507');
INSERT INTO `order_detail` VALUES ('90', '105', '74', null, null, '葱香', '3', '10.00', '30.00', '1536393128');
INSERT INTO `order_detail` VALUES ('91', '106', '74', null, null, '鲜辣', '3', '15.00', '45.00', '1536393247');
INSERT INTO `order_detail` VALUES ('92', '107', '30', null, null, '奶油味', '2', '16.00', '32.00', '1536397471');
INSERT INTO `order_detail` VALUES ('94', '109', '23', 'm', '紫色', null, '1', '94.00', '94.00', '1536410011');
INSERT INTO `order_detail` VALUES ('95', '110', '23', 'm', '绿色', null, '2', '98.00', '196.00', '1536410562');
INSERT INTO `order_detail` VALUES ('96', '111', '22', 'l', '蓝色', null, '2', '55.00', '110.00', '1536414025');
INSERT INTO `order_detail` VALUES ('97', '112', '41', null, 'undefined', null, '1', '45.00', '45.00', '1536542661');
INSERT INTO `order_detail` VALUES ('98', '113', '41', null, 'undefined', null, '4', '200.00', '800.00', '1536542963');
INSERT INTO `order_detail` VALUES ('99', '114', '41', null, 'undefined', null, '2', '90.00', '180.00', '1536543048');
INSERT INTO `order_detail` VALUES ('100', '115', '25', '软壳', 'undefined', null, '1', '40.00', '40.00', '1536543133');
INSERT INTO `order_detail` VALUES ('101', '116', '23', 'm', '绿色', null, '1', '98.00', '98.00', '1536831527');
INSERT INTO `size` VALUES ('1', '22', null, '蓝色', 'xs', null, '85.00', '100', '1234');
INSERT INTO `size` VALUES ('2', '22', null, '蓝色', 's', null, '85.00', '99', '1234');
INSERT INTO `size` VALUES ('3', '22', null, '红色', 'm', null, '85.00', '98', '1234');
INSERT INTO `size` VALUES ('4', '22', null, '红色', 's', null, '85.00', '99', '1234');
INSERT INTO `size` VALUES ('5', '22', null, '黄色', 'm', null, '85.00', '97', '1234');
INSERT INTO `size` VALUES ('6', '22', null, '蓝色', 'l', null, '85.00', '96', '0');
INSERT INTO `size` VALUES ('7', '22', null, '蓝色', 'xl', null, '85.00', '100', '1234');
INSERT INTO `size` VALUES ('8', '25', null, null, null, '硬壳', '78.00', '84', '111');
INSERT INTO `size` VALUES ('10', '23', null, '紫色', 'm', null, '94.00', '91', '1234');
INSERT INTO `size` VALUES ('11', '23', null, '紫色', 'l', null, '94.00', '95', '1234');
INSERT INTO `size` VALUES ('12', '23', null, '绿色', 'm', null, '98.00', '97', '123');
INSERT INTO `size` VALUES ('13', '30', null, null, null, '原味', '26.90', '61', '1234');
INSERT INTO `size` VALUES ('14', '30', null, null, null, '奶油味', '26.90', '96', '1234');
INSERT INTO `size` VALUES ('15', '40', null, null, 's', null, '100.00', '100', '11111');
INSERT INTO `size` VALUES ('16', '40', null, null, 'm', null, '100.00', '98', '0');
INSERT INTO `size` VALUES ('17', '40', null, null, 'l', null, '100.00', '100', '1');
INSERT INTO `size` VALUES ('18', '49', null, '1', null, '1', '1.00', '1', '1536223574');
INSERT INTO `size` VALUES ('19', '49', null, '2', null, '2', '2.00', '0', '1536223574');
INSERT INTO `size` VALUES ('22', '51', null, '2', null, '2', '2.00', '2', '1536226537');
INSERT INTO `size` VALUES ('23', '51', null, '1', null, '1', '1.00', '1', '1536226537');
INSERT INTO `size` VALUES ('24', '41', null, null, null, '黑利', '50.00', '47', '1565');
INSERT INTO `size` VALUES ('25', '41', null, null, null, '红利', '45.00', '48', '1565');
INSERT INTO `size` VALUES ('26', '52', null, '1', '1', null, '1.00', '1', '1536289198');
INSERT INTO `size` VALUES ('27', '52', null, '2', '2', null, '2.00', '2', '1536289198');
INSERT INTO `size` VALUES ('28', '53', null, '1', '1', null, '1.00', '1', '1536289338');
INSERT INTO `size` VALUES ('29', '53', null, '2', '2', null, '2.00', '2', '1536289338');
INSERT INTO `size` VALUES ('30', '54', '/Uploads/Tmps/2018/09/07/5b91eabe73284.jpg', '1', '1', null, '1.00', '1', '1536289489');
INSERT INTO `size` VALUES ('31', '54', '/Uploads/Tmps/2018/09/07/5b91eac0e606b.jpg', '2', '2', null, '2.00', '2', '1536289489');
INSERT INTO `size` VALUES ('32', '55', '/Uploads/Tmps/2018/09/07/5b920e981b33b.jpg', 'koko', '222', null, '111.00', '333', '1536298717');
INSERT INTO `size` VALUES ('33', '55', '/Uploads/Tmps/2018/09/07/5b920ea11aec7.jpg', 'dd', '33', null, '333.00', '111', '1536298717');
INSERT INTO `size` VALUES ('34', '56', '/Uploads/Tmps/2018/09/07/5b9213e5d3746.jpg', '红', 'XL', null, '10.00', '110', '1536300030');
INSERT INTO `size` VALUES ('35', '56', '/Uploads/Tmps/2018/09/07/5b9213e95211d.jpg', '白', 'XL', null, '20.00', '100', '1536300030');
INSERT INTO `size` VALUES ('36', '57', '/Uploads/Tmps/2018/09/07/5b9214a6af2fb.jpg', '红', 'xl', null, '10.00', '200', '1536300213');
INSERT INTO `size` VALUES ('37', '57', '/Uploads/Tmps/2018/09/07/5b9214a88f079.jpg', '黄', 'XL', null, '20.00', '200', '1536300213');
INSERT INTO `size` VALUES ('38', '58', '/Uploads/Tmps/2018/09/07/5b9215cc26ebc.jpg', '红', 'x', null, '10.00', '12', '1536300517');
INSERT INTO `size` VALUES ('39', '58', '/Uploads/Tmps/2018/09/07/5b9215ce8a966.jpg', 'y', 'x', null, '11.00', '24', '1536300517');
INSERT INTO `size` VALUES ('40', '59', '/Uploads/Tmps/2018/09/07/5b92161ac332f.jpg', 'y', 'x', null, '20.00', '1', '1536300587');
INSERT INTO `size` VALUES ('41', '59', '/Uploads/Tmps/2018/09/07/5b92162189ac3.jpg', 'x', 'x', null, '10.00', '2', '1536300587');
INSERT INTO `size` VALUES ('42', '60', '/Uploads/Tmps/2018/09/07/5b9216bf550b5.jpg', 'y', 'x', null, '123.00', '12', '1536300757');
INSERT INTO `size` VALUES ('43', '60', '/Uploads/Tmps/2018/09/07/5b9216c2cf4ac.jpg', 'x', 'x', null, '12.00', '111', '1536300757');
INSERT INTO `size` VALUES ('44', '61', '/Uploads/Tmps/2018/09/07/5b9217440e46b.jpg', '1', 'x', null, '12.00', '12', '1536300882');
INSERT INTO `size` VALUES ('45', '61', '/Uploads/Tmps/2018/09/07/5b9217460047c.jpg', '2', 'x', null, '10.00', '22', '1536300882');
INSERT INTO `size` VALUES ('46', '62', '/Uploads/Tmps/2018/09/07/5b9217440e46b.jpg', '1', 'x', null, '12.00', '12', '1536301155');
INSERT INTO `size` VALUES ('47', '62', '/Uploads/Tmps/2018/09/07/5b9217460047c.jpg', '2', 'x', null, '10.00', '22', '1536301155');
INSERT INTO `size` VALUES ('48', '63', '/Uploads/Tmps/2018/09/07/5b9217440e46b.jpg', '1', 'x', null, '12.00', '12', '1536301195');
INSERT INTO `size` VALUES ('49', '63', '/Uploads/Tmps/2018/09/07/5b9217460047c.jpg', '2', 'x', null, '10.00', '22', '1536301195');
INSERT INTO `size` VALUES ('50', '64', '/Uploads/Tmps/2018/09/07/5b9217440e46b.jpg', '1', 'x', null, '12.00', '12', '1536301209');
INSERT INTO `size` VALUES ('51', '64', '/Uploads/Tmps/2018/09/07/5b9217460047c.jpg', '2', 'x', null, '10.00', '22', '1536301209');
INSERT INTO `size` VALUES ('52', '65', '/Uploads/Tmps/2018/09/07/5b9217440e46b.jpg', '1', 'x', null, '12.00', '12', '1536301270');
INSERT INTO `size` VALUES ('53', '65', '/Uploads/Tmps/2018/09/07/5b9217460047c.jpg', '2', 'x', null, '10.00', '22', '1536301270');
INSERT INTO `size` VALUES ('54', '66', '/Uploads/Tmps/2018/09/07/5b9217440e46b.jpg', '1', 'x', null, '12.00', '12', '1536301392');
INSERT INTO `size` VALUES ('55', '66', '/Uploads/Tmps/2018/09/07/5b9217460047c.jpg', '2', 'x', null, '10.00', '22', '1536301392');
INSERT INTO `size` VALUES ('58', '68', '/Uploads/Tmps/2018/09/07/5b921a831af1e.jpg', '11', '11', null, '11.00', '11', '1536301822');
INSERT INTO `size` VALUES ('59', '68', '/Uploads/Tmps/2018/09/07/5b921a92e4434.jpg', '22', '22', null, '22.00', '22', '1536301822');
INSERT INTO `size` VALUES ('60', '69', '/Uploads/Tmps/2018/09/07/5b9217440e46b.jpg', '1', 'x', null, '12.00', '12', '1536301884');
INSERT INTO `size` VALUES ('61', '69', '/Uploads/Tmps/2018/09/07/5b9217460047c.jpg', '2', 'x', null, '10.00', '22', '1536301884');
INSERT INTO `size` VALUES ('62', '70', '/Uploads/Tmps/2018/09/07/5b9217440e46b.jpg', '1', 'x', null, '12.00', '12', '1536301945');
INSERT INTO `size` VALUES ('63', '70', '/Uploads/Tmps/2018/09/07/5b9217460047c.jpg', '2', 'x', null, '10.00', '22', '1536301945');
INSERT INTO `size` VALUES ('64', '71', '/Uploads/Tmps/2018/09/07/5b922090c0608.jpg', '1', '1', null, '1.00', '1', '1536303263');
INSERT INTO `size` VALUES ('65', '71', '/Uploads/Tmps/2018/09/07/5b9220929408a.jpg', '2', '2', '', '2.00', '4', '1536303263');
INSERT INTO `size` VALUES ('69', '71', '/Uploads/Tmps/2018/09/07/5b92303e765a8.jpg', '1', '1', null, '1.00', '1', '1536308507');
INSERT INTO `size` VALUES ('70', '72', '/Uploads/Tmps/2018/09/07/5b9235cbca5f5.jpg', '1', '1', null, '1.00', '1', '1536308709');
INSERT INTO `size` VALUES ('71', '72', '/Uploads/Tmps/2018/09/07/5b9235e20ebbb.jpg', '2', '2', null, '2.00', '2', '1536308709');
INSERT INTO `size` VALUES ('72', '73', '/Uploads/Tmps/2018/09/07/5b9236d572e9a.jpg', '蓝', 'X', '', '9.00', '9', '1536309002');
INSERT INTO `size` VALUES ('73', '73', '/Uploads/Tmps/2018/09/07/5b9236db807eb.jpg', '红', 'X', '', '20.00', '19', '1536309002');
INSERT INTO `size` VALUES ('74', '73', '/Uploads/Tmps/2018/09/07/5b923767135a8.jpg', '白', '2', null, '100.00', '100', '1536309095');
INSERT INTO `size` VALUES ('75', '74', '/Uploads/Tmps/2018/09/07/5b92432fb559b.jpg', '红', null, '葱香', '10.00', '217', '1536312247');
INSERT INTO `size` VALUES ('76', '74', '/Uploads/Tmps/2018/09/07/5b92434ae97d0.jpg', '绿', null, '鲜辣', '15.00', '324', '1536312247');
INSERT INTO `size` VALUES ('77', '75', '/Uploads/Tmps/2018/09/07/5b9248e8eb923.jpg', '红', 'man', null, '123.00', '333', '1536313626');
INSERT INTO `size` VALUES ('78', '75', '/Uploads/Tmps/2018/09/07/5b9248ee09489.jpg', '橙', 'iioioi', null, '100.00', '555', '1536313626');
INSERT INTO `spell_group` VALUES ('1', '22', '2', '1535137200', '1535389200', '55.00', '10', '1', '11111');
INSERT INTO `spell_group` VALUES ('9', '25', '20', '1535137200', '1535389200', '50.00', '0', '1', '1535005472');
INSERT INTO `spell_group` VALUES ('22', '20', '30', '1535137200', '1535479200', '30.00', '0', '1', '1535096275');
INSERT INTO `spell_group` VALUES ('23', '30', '3', '1535137200', '1535389200', '16.00', '0', '1', '1111111');
INSERT INTO `spell_group_code` VALUES ('1', null, null, '1', '254242', '9', '1', '3', '1535005472');
INSERT INTO `spell_group_code` VALUES ('2', null, null, '1', '43253453', '1', '1', '1', '1535005472');
INSERT INTO `spell_group_code` VALUES ('9', '47', '47', '2', 'D1383F2AC5', '1', '1', '1', '1535094833');
INSERT INTO `spell_group_code` VALUES ('10', '48', '47', '2', '02EDD74B3F', '1', '1', '1', '1535096033');
INSERT INTO `spell_group_code` VALUES ('11', '49', '47', '2', '66EAA9FD3C', '1', '1', '1', '1535097132');
INSERT INTO `spell_group_code` VALUES ('12', '51', '49', '1', '3255FBEB3A', '23', '1', '1', '1535340576');
INSERT INTO `spell_group_code` VALUES ('13', '52', '48', '3', '7F42DF9043', '21', '1', '1', '1535340837');
INSERT INTO `spell_group_code` VALUES ('14', '53', '49', '1', 'F1AE265310', '23', '1', '1', '1535348853');
INSERT INTO `spell_group_code` VALUES ('15', '54', '48', '3', 'F52EEF5CE2', '21', '1', '1', '1535348964');
INSERT INTO `spell_group_code` VALUES ('16', '55', '47', '1', 'AF9DD490E2', '23', '1', '1', '1535354512');
INSERT INTO `spell_group_code` VALUES ('17', '56', '49', '2', '923FA5C5D5', '1', '1', '1', '1535355856');
INSERT INTO `spell_group_code` VALUES ('18', '57', '47', '2', '9B161E67CC', '1', '1', '1', '1535379571');
INSERT INTO `spell_group_code` VALUES ('19', '58', '47', '2', '73A484642F', '1', '1', '1', '1535428323');
INSERT INTO `spell_group_code` VALUES ('20', '66', '49', '1', '86A0DBE711', '23', '1', '1', '1535621828');
INSERT INTO `spell_group_code` VALUES ('21', '86', '50', '2', '65A362E4B1', '1', '1', '1', '1536109486');
INSERT INTO `spell_group_code` VALUES ('22', '90', '48', '1', '3E5E2B762A', '23', '1', '1', '1536111229');
INSERT INTO `spell_group_code` VALUES ('23', '107', '49', '1', '2F90C07A06', '23', '1', '1', '1536397471');
INSERT INTO `spell_group_code` VALUES ('24', '111', '47', '2', 'C22D3AAE17', '1', '1', '1', '1536414025');
INSERT INTO `wechat_user_cloth` VALUES ('47', null, 'o9JDS5A8idkjn3iMpkNyYPjlVNbU', '止水', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLj7r4eb4gD8z8qnFmjZOYa2RhPMrml1MIawwibUFyQuogrBce7sdv2h7X1OWkvWbdLnl4tJZFDbRg/132', '1', '杭州', '浙江', '中国', '1536737520', null, null, '1', '1534817141');
INSERT INTO `wechat_user_cloth` VALUES ('48', null, 'o9JDS5Okzree-2pZ07EJByo1zL4k', 'AM 3:00', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKGnWWwAdicbKmX3WNsMMOuUhm1ibOYDfkdHL3S6eapJrr74NFfYpLIOrVWx2vABWctWeAmRNKLficog/132', '1', '', '维也纳', '奥地利', '1536827334', null, null, '1', '1534831944');
INSERT INTO `wechat_user_cloth` VALUES ('49', null, 'o9JDS5NI9KUN0LYHCRxBDGXyDf5Y', '梦想十八块腹肌', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKCYY5U2ibQkB8NvXhtrTIYqtvkCMGKEeZysgHa4ESUate61hoAViaW2JsvYmtl0oMsfp05BXAGLr8g/132', '1', '杭州', '浙江', '中国', '1539610504', null, null, '1', '1534838216');
INSERT INTO `wechat_user_cloth` VALUES ('50', null, 'o9JDS5OyN-0J2PScXEJ6Otq1I-Js', '二狗子', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/FUKRt3cj3ibpKBic2gakNBaoUaFjicBekOic13YAG1sIn2E1Zg8A7a4g8GVAqgiaMg4X4OZH1ZJYibrGC4III93HAEfg/132', '1', '绍兴', '浙江', '中国', '1536543014', null, null, '1', '1535075896');
INSERT INTO `wechat_user_cloth` VALUES ('51', null, 'o9JDS5P5-IessGVr6UwNvtRa2_cQ', '醉..兔子..', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLgibn8eGsvJyRRj1yxXEdAvLnvRJBYxoztk5ibqkdopCNZ8vZfEsrObpnQ8lyJefdgrgg3AiaXicvNfg/132', '1', '杭州', '浙江', '中国', '1538127858', null, null, '1', '1535417802');
INSERT INTO `wechat_user_food` VALUES ('46', null, 'o9JDS5Okzree-2pZ07EJByo1zL4k', 'AM 3:00', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKGnWWwAdicbKmX3WNsMMOuUhm1ibOYDfkdHL3S6eapJrr74NFfYpLIOrVWx2vABWctWeAmRNKLficog/132', '1', '', '维也纳', '奥地利', '1536827335', null, null, '1', '1534814934');
INSERT INTO `wechat_user_food` VALUES ('47', null, 'o9JDS5NI9KUN0LYHCRxBDGXyDf5Y', '梦想十八块腹肌', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKCYY5U2ibQkB8NvXhtrTIYqtvkCMGKEeZysgHa4ESUate61hoAViaW2JsvYmtl0oMsfp05BXAGLr8g/132', '1', '杭州', '浙江', '中国', '1539591361', null, null, '1', '1535010237');
INSERT INTO `wechat_user_food` VALUES ('48', null, 'o9JDS5OyN-0J2PScXEJ6Otq1I-Js', '二狗子', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/FUKRt3cj3ibpKBic2gakNBaoUaFjicBekOic13YAG1sIn2E1Zg8A7a4g8GVAqgiaMg4X4OZH1ZJYibrGC4III93HAEfg/132', '1', '绍兴', '浙江', '中国', '1536542862', null, null, '1', '1535075801');
INSERT INTO `wechat_user_food` VALUES ('49', null, 'o9JDS5A8idkjn3iMpkNyYPjlVNbU', '止水', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLj7r4eb4gD8z8qnFmjZOYa2RhPMrml1MIawwibUFyQuogrBce7sdv2h7X1OWkvWbdLnl4tJZFDbRg/132', '1', '杭州', '浙江', '中国', '1536595506', null, null, '1', '1535077444');
INSERT INTO `wechat_user_food` VALUES ('50', null, 'o9JDS5P5-IessGVr6UwNvtRa2_cQ', '醉..兔子..', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLgibn8eGsvJyRRj1yxXEdAvLnvRJBYxoztk5ibqkdopCNZ8vZfEsrObpnQ8lyJefdgrgg3AiaXicvNfg/132', '1', '杭州', '浙江', '中国', '1536111163', null, null, '1', '1535420646');
INSERT INTO `wechat_user_smoke` VALUES ('46', null, 'o9JDS5Okzree-2pZ07EJByo1zL4k', 'AM 3:00', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKGnWWwAdicbKmX3WNsMMOuUhm1ibOYDfkdHL3S6eapJrr74NFfYpLIOrVWx2vABWctWeAmRNKLficog/132', '1', '', '维也纳', '奥地利', '1536140713', null, null, '1', '1534840676');
INSERT INTO `wechat_user_smoke` VALUES ('47', null, 'o9JDS5A8idkjn3iMpkNyYPjlVNbU', '止水', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLj7r4eb4gD8z8qnFmjZOYa2RhPMrml1MIawwibUFyQuogrBce7sdv2h7X1OWkvWbdLnl4tJZFDbRg/132', '1', '杭州', '浙江', '中国', '1536595542', null, null, '1', '1534845294');
INSERT INTO `wechat_user_smoke` VALUES ('48', null, 'o9JDS5NI9KUN0LYHCRxBDGXyDf5Y', '梦想十八块腹肌', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKCYY5U2ibQkB8NvXhtrTIYqtvkCMGKEeZysgHa4ESUate61hoAViaW2JsvYmtl0oMsfp05BXAGLr8g/132', '1', '杭州', '浙江', '中国', '1539589298', null, null, '1', '1534845731');
INSERT INTO `wechat_user_smoke` VALUES ('49', null, 'o9JDS5OyN-0J2PScXEJ6Otq1I-Js', '二狗子', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/FUKRt3cj3ibpKBic2gakNBaoUaFjicBekOic13YAG1sIn2E1Zg8A7a4g8GVAqgiaMg4X4OZH1ZJYibrGC4III93HAEfg/132', '1', '绍兴', '浙江', '中国', '1536417445', null, null, '1', '1535075803');
INSERT INTO `wechat_user_smoke` VALUES ('50', null, 'o9JDS5P5-IessGVr6UwNvtRa2_cQ', '醉..兔子..', null, null, '0.00', null, null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLgibn8eGsvJyRRj1yxXEdAvLnvRJBYxoztk5ibqkdopCNZ8vZfEsrObpnQ8lyJefdgrgg3AiaXicvNfg/132', '1', '杭州', '浙江', '中国', '1538127942', null, null, '1', '1535418860');
