-- DouPHP v1.x SQL Dump Program
-- http://58.banyar.cn/
-- 
-- DATE : 2019-08-16 23:00:04
-- MYSQL SERVER VERSION : 5.5.57-log
-- PHP VERSION : 5.3.29
-- DouPHP VERSION : v1.5 Release 20190711

DROP TABLE IF EXISTS `58_product`;
CREATE TABLE `58_product` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '任务表 ',
  `cat_id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(150) NOT NULL DEFAULT '',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '工钱',
  `defined` text NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `add_time` int(50) DEFAULT NULL COMMENT '任务发布时间',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `max` int(8) NOT NULL COMMENT '人数',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0:平台发给工人 1：商户端发',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0：已发布 1：已完成 --针对商户端',
  `pay_time` datetime DEFAULT NULL COMMENT '针对商户端的第三方支付时间',
  `pay_status` int(11) NOT NULL DEFAULT '0' COMMENT '0:未支付 1：已支付  针对商户端的支付状态',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '发布任务的人',
  `bind_mobile` text COMMENT '指定工人手机号',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '分包任务绑定的商户任务id',
  `stop_time` datetime DEFAULT NULL COMMENT '报名截止时间',
  `start_time` datetime DEFAULT NULL COMMENT '报名开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '任务截止时间',
  `city` varchar(255) DEFAULT NULL COMMENT '服务城市',
  `zhouqi` varchar(255) DEFAULT NULL COMMENT '结算周期',
  `check_sta` text COMMENT '验收标准',
  `dic_form` varchar(255) DEFAULT NULL COMMENT '商户总包任务发放模板',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=utf8;

INSERT INTO 58_product VALUES('1','0','iPad平板电脑','3680.00','','啊啊宝宝尺寸自行车自行车','tuw5cdr.file','ipad,平板电脑','','1372244512','0','4','1','0','','0','63','15553513731,25698687','0','2019-08-16 10:42:42','2019-08-01 10:42:46','2019-08-15 10:42:52','北京,上海,','','','');
INSERT INTO 58_product VALUES('2','4','苹果iPhone 5手机','5300.00','','水电费水电费问题热熔管风格的双方各','sk358ym.file','iphone,苹果手机,智能手机','','1372253241','0','3','0','0','','0','0','15553513731,25698687,88888','1','2019-08-16 10:43:05','2019-08-08 10:43:08','2019-08-15 10:43:11','北京,上海,青岛','','','');
INSERT INTO 58_product VALUES('106','7','市场推广','14660.28','','','','市场推广','','1565746796','0','1','0','0','','0','0','15988195005','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('107','7','信息咨询','1930.00','','','','信息咨询','','1565746796','0','1','0','0','','0','0','18257766686','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('108','7','市场推广','7469.10','','','','市场推广','','1565746796','0','1','0','0','','0','0','15990076811','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('109','7','市场推广','1150.28','','','','市场推广','','1565746796','0','1','0','0','','0','0','18042423399','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('110','7','技术支持服务','9629.93','','','','技术支持服务','','1565746796','0','1','0','0','','0','0','13681704494','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('111','7','信息咨询','3242.40','','','','信息咨询','','1565746796','0','1','0','0','','0','0','13806680436','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('112','7','技术支持服务','3072.56','','','','技术支持服务','','1565746796','0','1','0','0','','0','0','13764414319','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('113','7','信息咨询','3183.54','','','','信息咨询','','1565746796','0','1','0','0','','0','0','13958011990','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('114','7','市场推广','6192.41','','','','市场推广','','1565746796','0','1','0','0','','0','0','13605810623','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('115','7','技术支持服务','1154.14','','','','技术支持服务','','1565746796','0','3','0','0','','0','0','13917039869,18321246917,15011393158','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('116','7','技术支持服务','1922.28','','','','技术支持服务','','1565746796','0','1','0','0','','0','0','18058848889','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('117','7','技术支持服务','6148.01','','','','技术支持服务','','1565746796','0','1','0','0','','0','0','15325504999','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('118','7','信息咨询','20120.64','','','','信息咨询','','1565746796','0','1','0','0','','0','0','13918418336','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('119','7','技术支持服务','575.14','','','','技术支持服务','','1565746796','0','1','0','0','','0','0','13516878976','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('120','7','技术支持服务','2501.28','','','','技术支持服务','','1565746796','0','1','0','0','','0','0','18658876299','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('121','7','市场推广','1347.14','','','','市场推广','','1565746796','0','2','0','0','','0','0','13396967778,18720849555','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('122','7','市场推广','5790.00','','','','市场推广','','1565746796','0','1','0','0','','0','0','13335816366','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('123','7','技术支持服务','2199.43','','','','技术支持服务','','1565746796','0','1','0','0','','0','0','13757778268','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('124','7','信息咨询','2026.50','','','','信息咨询','','1565746796','0','1','0','0','','0','0','13735625253','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('125','7','市场推广','3091.86','','','','市场推广','','1565746796','0','1','0','0','','0','0','13506790036','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('126','7','市场推广','26877.95','','','','市场推广','','1565746796','0','1','0','0','','0','0','15968190929','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('127','7','市场推广','15328.06','','','','市场推广','','1565746796','0','1','0','0','','0','0','18963212623','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('128','7','技术支持服务','768.14','','','','技术支持服务','','1565746796','0','2','0','0','','0','0','13801863808,13336911117','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('129','7','技术支持服务','7433.20','','','','技术支持服务','','1565746796','0','1','0','0','','0','0','13918890326','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('130','7','信息咨询','8106.00','','','','信息咨询','','1565746796','0','1','0','0','','0','0','13787014818','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('131','7','信息咨询','13151.99','','','','信息咨询','','1565746796','0','1','0','0','','0','0','15382311881','87','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('31','0','test2','45.00','','','','测试测试','','1565522535','0','50','1','0','','1','80','','0','2019-08-13 23:59:59','2019-08-12 00:00:00','2019-08-28 23:59:59','上海，深圳','23天','1、速度快放假\r\n2、水电费会计','');
INSERT INTO 58_product VALUES('32','4','test1-1','5.00','','','','','','1565523043','0','100','0','0','','0','0','','31','2019-08-21 23:59:59','2019-08-11 00:00:00','2019-08-30 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('33','0','市场推广任务1','500000.00','','','','','','1565537267','0','100','1','0','','1','81','','0','2019-08-15 23:59:59','2019-08-11 00:00:00','2019-08-31 23:59:59','上海','进度结算','1.拓展新的客户10户；\r\n2.成交1单业务；\r\n','');
INSERT INTO 58_product VALUES('34','0','市场推广','10000.00','','','','按时完成产品的市场推广任务','','1565537856','0','10','0','0','','0','0','13248160035,13382221163','33','2019-08-15 23:59:59','2019-08-11 00:00:00','2019-08-15 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('35','0','11111','23.00','','','','sdf','','1565569823','0','1','1','0','','0','72','sdf','0','2019-08-21 23:59:59','2019-08-12 00:00:00','2019-08-29 23:59:59','sdf','23','sdf','gfx6rtt.file');
INSERT INTO 58_product VALUES('36','0','aaa','2.00','','','','sd','','1565570900','0','2','1','0','','0','72','sadf','0','2019-08-21 23:59:59','2019-08-12 00:00:00','2019-08-28 23:59:59','s','2','2','h2sr5ce.file');
INSERT INTO 58_product VALUES('37','0','','60.00','','','','sdf','','1565569823','0','2','0','0','','0','0','','35','2019-08-21 23:59:59','2019-08-12 00:00:00','2019-08-29 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('87','0','上线任务','185640.00','','','','上线任务','','1565746796','0','30','1','0','','1','84','','0','2019-08-22 23:59:59','2019-08-13 00:00:00','2019-08-28 23:59:59','上海 北京','26','1、洒水\r\n2、三四十','lhkcuke.file');
INSERT INTO 58_product VALUES('96','2','市场推广','60.00','','','','sd','','1565570900','0','2','0','0','','0','0','132111111,133123456','36','2019-08-21 23:59:59','2019-08-12 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('97','4','市场推广','4.22','','','','sd','','1565570900','0','10','0','0','','0','0','152333666,18663829507','36','2019-08-21 23:59:59','2019-08-12 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('98','4','信息咨询','5.00','','','','sd','','1565570900','0','3','0','0','','0','0','134123456,135888888,147888888','36','2019-08-21 23:59:59','2019-08-12 00:00:00','2019-08-28 23:59:59','上海','','','');
INSERT INTO 58_product VALUES('99','4','技术支持服务','60.00','','','','sd','','1565570900','0','1','0','0','','0','0','13556895241','36','2019-08-21 23:59:59','2019-08-12 00:00:00','2019-08-28 23:59:59','上海','','','');

