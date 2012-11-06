/*
SQLyog Enterprise - MySQL GUI v8.14 
MySQL - 5.5.16-log : Database - qq_firstapp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`qq_firstapp` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `qq_firstapp`;

/*Table structure for table `qfa_category` */

DROP TABLE IF EXISTS `qfa_category`;

CREATE TABLE `qfa_category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '类目id',
  `category_name` varchar(50) DEFAULT NULL,
  `ctime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `qfa_category` */

insert  into `qfa_category`(`category_id`,`category_name`,`ctime`) values (10,'美容/美妆',1352173492),(11,'母婴/家居',1352173511),(12,'数码/家电',1352173522);

/*Table structure for table `qfa_comment` */

DROP TABLE IF EXISTS `qfa_comment`;

CREATE TABLE `qfa_comment` (
  `comment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `item_id` bigint(20) unsigned NOT NULL COMMENT '试用品id',
  `comment_text` text,
  `comment_user_head` varchar(255) CHARACTER SET latin1 NOT NULL COMMENT '头像url',
  `comment_user_id` bigint(20) unsigned NOT NULL COMMENT '用户id',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `qfa_comment` */

insert  into `qfa_comment`(`comment_id`,`item_id`,`comment_text`,`comment_user_head`,`comment_user_id`) values (2,213,'f放到的随碟附送','3213',321);

/*Table structure for table `qfa_item` */

DROP TABLE IF EXISTS `qfa_item`;

CREATE TABLE `qfa_item` (
  `item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '试用id',
  `price` float unsigned NOT NULL DEFAULT '0' COMMENT '原价',
  `special_price` float unsigned NOT NULL DEFAULT '0' COMMENT '特价',
  `title` varchar(255) NOT NULL,
  `endtime` int(10) unsigned NOT NULL COMMENT '活动结束时间',
  `is_free` enum('1','2') CHARACTER SET latin1 NOT NULL DEFAULT '1' COMMENT '1为free,2为非free',
  `category_id` int(10) unsigned NOT NULL COMMENT '分类id',
  `pieces` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '件数',
  `description` text,
  `share_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分享次数',
  `fav_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏次数',
  `already_buy` int(10) unsigned DEFAULT '0' COMMENT '已购买人数',
  `photo` varchar(255) DEFAULT NULL,
  `is_top` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `qfa_item` */

insert  into `qfa_item`(`item_id`,`price`,`special_price`,`title`,`endtime`,`is_free`,`category_id`,`pieces`,`description`,`share_time`,`fav_time`,`already_buy`,`photo`,`is_top`) values (2,5.5,10.5,'标题fjsdlfj',123213,'1',10,0,'',0,0,0,'3213123',0),(3,0,0,'fdsf',123213,'1',10,0,'',0,0,0,'fdsdfsdaf',1);

/*Table structure for table `qfa_user` */

DROP TABLE IF EXISTS `qfa_user`;

CREATE TABLE `qfa_user` (
  `uid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `openid` char(32) CHARACTER SET latin1 NOT NULL COMMENT 'qq的openid',
  `nickname` varchar(255) DEFAULT NULL,
  `ctime` int(10) unsigned NOT NULL COMMENT '进入时间',
  `score` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `head` varchar(255) DEFAULT NULL,
  `share_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分享次数',
  `fav_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏次数',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别',
  `is_follow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否关注',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `openid` (`openid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='user表';

/*Data for the table `qfa_user` */

insert  into `qfa_user`(`uid`,`openid`,`nickname`,`ctime`,`score`,`head`,`share_time`,`fav_time`,`gender`,`is_follow`) values (9,'F43F3336D5C06A88AF709AA77AE9F630','lizhen_796ab',1352108241,0,'http://thirdapp3.qlogo.cn/qzopenapp/060b8477f7cddce47a38fdf155a691d7118ee962356781642de3965116bef898/50',0,0,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
