-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: localhost    Database: mto_crm
-- ------------------------------------------------------
-- Server version	5.7.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actions`
--

DROP TABLE IF EXISTS `actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actions` (
  `action_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(100) NOT NULL COMMENT '权限名称',
  `class` varchar(100) NOT NULL COMMENT '实现权限的类名称',
  `method` varchar(100) NOT NULL COMMENT '实现权限的方法名称',
  `action` varchar(100) NOT NULL COMMENT '权限关键字',
  `category_colunm_id` smallint(5) NOT NULL COMMENT '所属分类ID',
  PRIMARY KEY (`action_id`),
  UNIQUE KEY `action_UNIQUE` (`action`),
  KEY `name` (`name`),
  KEY `class` (`class`),
  KEY `category_colunm_id` (`category_colunm_id`),
  KEY `action` (`action`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actions`
--

LOCK TABLES `actions` WRITE;
/*!40000 ALTER TABLE `actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `black_list`
--

DROP TABLE IF EXISTS `black_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `black_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_phone` (`project_id`,`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `black_list`
--

LOCK TABLES `black_list` WRITE;
/*!40000 ALTER TABLE `black_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `black_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_reason`
--

DROP TABLE IF EXISTS `call_reason`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `call_reason` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent` int(11) DEFAULT '0',
  `level` int(11) DEFAULT '0',
  `description` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_reason`
--

LOCK TABLES `call_reason` WRITE;
/*!40000 ALTER TABLE `call_reason` DISABLE KEYS */;
/*!40000 ALTER TABLE `call_reason` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_column`
--

DROP TABLE IF EXISTS `category_column`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_column` (
  `category_colunm_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `name` varchar(100) NOT NULL COMMENT '分类名字',
  `order` tinyint(3) DEFAULT NULL COMMENT '排序，数字越小，排队越靠前',
  `parent` smallint(4) DEFAULT NULL COMMENT '父节点',
  `links` varchar(300) DEFAULT NULL COMMENT '链接内容',
  `level` smallint(2) NOT NULL COMMENT '目录级别，0为根目录',
  `display` tinyint(1) DEFAULT '1' COMMENT '是否显示0不显示，1显示，默认1',
  PRIMARY KEY (`category_colunm_id`),
  UNIQUE KEY `category_id_UNIQUE` (`category_colunm_id`),
  KEY `name` (`name`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_column`
--

LOCK TABLES `category_column` WRITE;
/*!40000 ALTER TABLE `category_column` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_column` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager_user_action`
--

DROP TABLE IF EXISTS `manager_user_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manager_user_action` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` smallint(5) unsigned NOT NULL COMMENT '权限ID',
  `manager_group_id` smallint(5) unsigned NOT NULL COMMENT '分组ID',
  PRIMARY KEY (`id`),
  KEY `action_group` (`action_id`,`manager_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=404 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager_user_action`
--

LOCK TABLES `manager_user_action` WRITE;
/*!40000 ALTER TABLE `manager_user_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `manager_user_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager_user_group`
--

DROP TABLE IF EXISTS `manager_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manager_user_group` (
  `manager_group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) NOT NULL COMMENT '管理员分组名称',
  `description` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`manager_group_id`),
  UNIQUE KEY `admin_group_id_UNIQUE` (`manager_group_id`),
  UNIQUE KEY `group_name_UNIQUE` (`group_name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager_user_group`
--

LOCK TABLES `manager_user_group` WRITE;
/*!40000 ALTER TABLE `manager_user_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `manager_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager_users`
--

DROP TABLE IF EXISTS `manager_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manager_users` (
  `manager_user_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员用户ID',
  `manager_user_name` varchar(60) NOT NULL COMMENT '管理员用户名称',
  `manager_group_id` int(11) NOT NULL COMMENT '管理员分组ID',
  `group_name` varchar(60) NOT NULL COMMENT '管理员分组名字(冗余字段)',
  `user_nick` varchar(60) NOT NULL COMMENT '管理员用户昵称',
  `mobile` varchar(60) NOT NULL COMMENT '手机号',
  `email` varchar(200) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1正常，2禁用',
  PRIMARY KEY (`manager_user_id`),
  UNIQUE KEY `admin_user_id_UNIQUE` (`manager_user_id`),
  UNIQUE KEY `admin_user_name_UNIQUE` (`manager_user_name`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `user_name` (`manager_user_name`) COMMENT '用户名称',
  KEY `mobile` (`mobile`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager_users`
--

LOCK TABLES `manager_users` WRITE;
/*!40000 ALTER TABLE `manager_users` DISABLE KEYS */;
INSERT INTO `manager_users` VALUES (1,'michael',1,'超级管理员','黄朝晖','15914216950','sydoor_ly@163.com','81e36113b51d7705a424e3e2e907ece2',1);
/*!40000 ALTER TABLE `manager_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_custom_field_setting`
--

DROP TABLE IF EXISTS `project_custom_field_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_custom_field_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `value_type` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `default_value` varchar(300) DEFAULT NULL,
  `null_able` int(11) DEFAULT NULL,
  `seq` int(11) DEFAULT NULL,
  `field_type` int(11) DEFAULT NULL COMMENT '1普通字段，2为Order字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_custom_field_setting`
--

LOCK TABLES `project_custom_field_setting` WRITE;
/*!40000 ALTER TABLE `project_custom_field_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_custom_field_setting` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-30 15:29:20
