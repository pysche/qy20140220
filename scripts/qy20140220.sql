-- MySQL dump 10.14  Distrib 5.5.36-MariaDB, for osx10.9 (i386)
--
-- Host: localhost    Database: qy20140220
-- ------------------------------------------------------
-- Server version	5.5.36-MariaDB

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
-- Table structure for table `Bc_Agent`
--

DROP TABLE IF EXISTS `Bc_Agent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Agent` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `Memo` text NOT NULL,
  `Contactor` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Agent`
--

LOCK TABLES `Bc_Agent` WRITE;
/*!40000 ALTER TABLE `Bc_Agent` DISABLE KEYS */;
/*!40000 ALTER TABLE `Bc_Agent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_Announce`
--

DROP TABLE IF EXISTS `Bc_Announce`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Announce` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(200) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `Content` text NOT NULL,
  `Uid` int(8) NOT NULL,
  `Deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `Status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `Views` int(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Announce`
--

LOCK TABLES `Bc_Announce` WRITE;
/*!40000 ALTER TABLE `Bc_Announce` DISABLE KEYS */;
INSERT INTO `Bc_Announce` VALUES (1,'adf','2014-03-01 21:51:12','adfadfadfqerqwer',1,1,1,0),(2,'测试公告','2014-03-02 20:30:04','测试内容',1,0,1,0);
/*!40000 ALTER TABLE `Bc_Announce` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_Attachment`
--

DROP TABLE IF EXISTS `Bc_Attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Attachment` (
  `id` char(32) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `MimeType` varchar(40) NOT NULL,
  `Size` int(8) unsigned NOT NULL DEFAULT '0',
  `Uid` int(8) unsigned NOT NULL,
  `Uname` varchar(50) NOT NULL,
  `Hash` char(32) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Width` int(8) unsigned NOT NULL,
  `Height` int(8) unsigned NOT NULL,
  `CreateTime` datetime NOT NULL,
  `OrderNo` smallint(4) unsigned NOT NULL DEFAULT '9999',
  `Ext` varchar(20) NOT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Attachment`
--

LOCK TABLES `Bc_Attachment` WRITE;
/*!40000 ALTER TABLE `Bc_Attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `Bc_Attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_Bargains`
--

DROP TABLE IF EXISTS `Bc_Bargains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Bargains` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Uid` int(8) unsigned NOT NULL DEFAULT '0',
  `CreateTime` datetime NOT NULL,
  `Deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Deleted` (`Deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Bargains`
--

LOCK TABLES `Bc_Bargains` WRITE;
/*!40000 ALTER TABLE `Bc_Bargains` DISABLE KEYS */;
/*!40000 ALTER TABLE `Bc_Bargains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_Directories`
--

DROP TABLE IF EXISTS `Bc_Directories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Directories` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `medicine_id` int(8) unsigned NOT NULL DEFAULT '0',
  `org_id` int(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `medicine_id` (`medicine_id`,`org_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Directories`
--

LOCK TABLES `Bc_Directories` WRITE;
/*!40000 ALTER TABLE `Bc_Directories` DISABLE KEYS */;
INSERT INTO `Bc_Directories` VALUES (2,1,1);
/*!40000 ALTER TABLE `Bc_Directories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_Logs`
--

DROP TABLE IF EXISTS `Bc_Logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Logs` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Uid` int(8) unsigned NOT NULL,
  `CreateTime` datetime NOT NULL,
  `Ip` varchar(15) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Uname` varchar(50) NOT NULL,
  `Memo` text NOT NULL,
  `Content` text NOT NULL,
  `Actor` varchar(200) NOT NULL,
  `Deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Deleted` (`Deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='系统日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Logs`
--

LOCK TABLES `Bc_Logs` WRITE;
/*!40000 ALTER TABLE `Bc_Logs` DISABLE KEYS */;
INSERT INTO `Bc_Logs` VALUES (1,1,'2014-03-02 20:54:51','127.0.0.1','修改密码','','','--','管理员',0),(2,1,'2014-03-03 21:29:26','127.0.0.1','修改密码','','','--','管理员',0);
/*!40000 ALTER TABLE `Bc_Logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_Medicines`
--

DROP TABLE IF EXISTS `Bc_Medicines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Medicines` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Code` varchar(50) NOT NULL DEFAULT '',
  `Name` varchar(200) NOT NULL,
  `ProdName` varchar(200) NOT NULL DEFAULT '',
  `DosageForm` varchar(50) NOT NULL DEFAULT '',
  `Spec` varchar(50) NOT NULL DEFAULT '',
  `Unit` varchar(20) NOT NULL DEFAULT '',
  `OriginPlace` varchar(50) NOT NULL DEFAULT '',
  `ImportPrice` float NOT NULL DEFAULT '0',
  `Usage` varchar(200) NOT NULL,
  `IsBasic` tinyint(1) NOT NULL DEFAULT '0',
  `IsLevel2Basic` tinyint(1) NOT NULL DEFAULT '0',
  `Deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IsBasic` (`IsBasic`,`IsLevel2Basic`),
  KEY `Deleted` (`Deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Medicines`
--

LOCK TABLES `Bc_Medicines` WRITE;
/*!40000 ALTER TABLE `Bc_Medicines` DISABLE KEYS */;
INSERT INTO `Bc_Medicines` VALUES (1,'','Test','aad','adf','','','',0,'',1,0,0);
/*!40000 ALTER TABLE `Bc_Medicines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_News`
--

DROP TABLE IF EXISTS `Bc_News`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_News` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(200) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `Category` int(8) unsigned NOT NULL,
  `Content` text NOT NULL,
  `PubFlag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `SortNum` smallint(4) unsigned zerofill NOT NULL DEFAULT '9999',
  `Tags` varchar(200) NOT NULL,
  `Uid` int(8) unsigned NOT NULL,
  `Uname` varchar(50) NOT NULL,
  `FirstAttach` char(32) DEFAULT '',
  `Hash` char(32) NOT NULL,
  `Deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `SiteId` int(8) unsigned NOT NULL DEFAULT '0',
  `Views` int(8) unsigned NOT NULL DEFAULT '0',
  `UpdateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `SortNum` (`SortNum`),
  KEY `PubFlag` (`SiteId`,`Deleted`,`PubFlag`),
  KEY `Views` (`Views`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文章';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_News`
--

LOCK TABLES `Bc_News` WRITE;
/*!40000 ALTER TABLE `Bc_News` DISABLE KEYS */;
INSERT INTO `Bc_News` VALUES (1,'111','2013-12-11 21:18:43',0,'',1,0000,'',1,'','a86107ed9f157b73ae6e9fc6306c4add','42707637f2f3a2d0ce2b2015ca3c39d6',0,1,0,NULL),(2,'222','2013-12-11 21:18:54',0,'',1,0000,'',1,'','7476527583053f98bbb30dfe605f9437','e2195652d7d67e1decfd694129cba78a',0,1,0,NULL);
/*!40000 ALTER TABLE `Bc_News` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_Orders`
--

DROP TABLE IF EXISTS `Bc_Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Orders` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Code` varchar(50) NOT NULL,
  `Uid` int(8) unsigned NOT NULL,
  `CreateTime` datetime NOT NULL,
  `Deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Orders`
--

LOCK TABLES `Bc_Orders` WRITE;
/*!40000 ALTER TABLE `Bc_Orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `Bc_Orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_Organization`
--

DROP TABLE IF EXISTS `Bc_Organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Organization` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Code` varchar(50) NOT NULL DEFAULT '',
  `Name` varchar(100) NOT NULL DEFAULT '',
  `ShortName` varchar(20) NOT NULL DEFAULT '',
  `Address` varchar(200) NOT NULL DEFAULT '',
  `Zipcode` int(6) unsigned zerofill NOT NULL DEFAULT '000000',
  `Fax` varchar(50) NOT NULL DEFAULT '',
  `Tel` varchar(50) NOT NULL DEFAULT '',
  `Contactor` varchar(20) NOT NULL DEFAULT '',
  `ContactorTel` varchar(20) NOT NULL DEFAULT '',
  `Type` varchar(20) NOT NULL DEFAULT '',
  `CreateTime` datetime NOT NULL,
  `Uid` int(8) unsigned NOT NULL DEFAULT '0',
  `Status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `Memo` text NOT NULL,
  `Website` varchar(200) NOT NULL DEFAULT '',
  `Level` int(4) unsigned NOT NULL DEFAULT '0',
  `Category` int(4) unsigned NOT NULL DEFAULT '0',
  `Deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `Email` varchar(100) NOT NULL DEFAULT '',
  `RegionId` int(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Status` (`Status`),
  KEY `Deleted` (`Deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Organization`
--

LOCK TABLES `Bc_Organization` WRITE;
/*!40000 ALTER TABLE `Bc_Organization` DISABLE KEYS */;
INSERT INTO `Bc_Organization` VALUES (1,'eixkeixk','医院A','','',000000,'','','','','buy','2014-02-26 22:06:29',1,1,'','',20,20,0,'',4);
/*!40000 ALTER TABLE `Bc_Organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_Product`
--

DROP TABLE IF EXISTS `Bc_Product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Product` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(200) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `Category` int(8) unsigned NOT NULL,
  `Content` text NOT NULL,
  `PubFlag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `SortNum` smallint(4) unsigned zerofill NOT NULL DEFAULT '9999',
  `Tags` varchar(200) NOT NULL,
  `Uid` int(8) unsigned NOT NULL,
  `Uname` varchar(50) NOT NULL,
  `FirstAttach` char(32) DEFAULT '',
  `Hash` char(32) NOT NULL,
  `Deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `SiteId` int(8) unsigned NOT NULL DEFAULT '0',
  `Views` int(8) unsigned NOT NULL DEFAULT '0',
  `UpdateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `SortNum` (`SortNum`),
  KEY `PubFlag` (`SiteId`,`Deleted`,`PubFlag`),
  KEY `Views` (`Views`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='文章';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Product`
--

LOCK TABLES `Bc_Product` WRITE;
/*!40000 ALTER TABLE `Bc_Product` DISABLE KEYS */;
INSERT INTO `Bc_Product` VALUES (1,'企业网站建设','2013-12-11 21:37:09',2,'<p>介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍</p>',1,0000,'',1,'','2e581d2a17ec9c6028b4d874cd8a2acb','fb8f9f3f6f57c73face0be86c54dc971',0,1,0,NULL),(2,'企业UI设计','2013-12-11 21:38:17',2,'<p>介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍</p>',1,0000,'',1,'','2f24e1faa1775cc101953176c71ed74d','be55117cb68f019bdf59cc14fbea0e87',0,1,0,NULL),(5,'afasdf','2013-12-11 21:50:22',0,'<p>asfaf<br/></p>',0,0000,'',1,'','5ef114c153f63a19e0ae8b74b24253ac','4bc719cecf16aa17eac5f1b541a8401e',1,1,0,NULL);
/*!40000 ALTER TABLE `Bc_Product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_Productcategory`
--

DROP TABLE IF EXISTS `Bc_Productcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Productcategory` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `PubFlag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `SortNum` smallint(4) unsigned zerofill NOT NULL DEFAULT '9999',
  `Uid` int(8) unsigned NOT NULL,
  `Uname` varchar(50) NOT NULL,
  `Deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `SiteId` int(8) unsigned NOT NULL DEFAULT '0',
  `UpdateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PubFlag` (`PubFlag`),
  KEY `SortNum` (`SortNum`),
  KEY `Deleted` (`Deleted`),
  KEY `SiteId` (`SiteId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文章';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Productcategory`
--

LOCK TABLES `Bc_Productcategory` WRITE;
/*!40000 ALTER TABLE `Bc_Productcategory` DISABLE KEYS */;
INSERT INTO `Bc_Productcategory` VALUES (1,'Test','2013-12-07 20:53:26',1,0111,1,'',1,1,NULL),(2,'默认分类','2013-12-07 21:02:28',1,9999,1,'',0,1,NULL);
/*!40000 ALTER TABLE `Bc_Productcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_Projects`
--

DROP TABLE IF EXISTS `Bc_Projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Projects` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Code` varchar(100) NOT NULL DEFAULT '',
  `Name` varchar(200) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `Uid` int(8) unsigned NOT NULL DEFAULT '0',
  `Deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Deleted` (`Deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Projects`
--

LOCK TABLES `Bc_Projects` WRITE;
/*!40000 ALTER TABLE `Bc_Projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `Bc_Projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_Regions`
--

DROP TABLE IF EXISTS `Bc_Regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Regions` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Sort` smallint(4) unsigned zerofill NOT NULL DEFAULT '9999',
  `Uid` int(8) unsigned NOT NULL DEFAULT '0',
  `CreateTime` datetime NOT NULL,
  `ParentId` int(8) unsigned NOT NULL DEFAULT '0',
  `Deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Deleted` (`Deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Regions`
--

LOCK TABLES `Bc_Regions` WRITE;
/*!40000 ALTER TABLE `Bc_Regions` DISABLE KEYS */;
INSERT INTO `Bc_Regions` VALUES (1,'江苏省',4444,1,'2014-03-03 22:43:31',0,1),(2,'浙江省',3333,1,'2014-03-03 22:54:38',0,0),(3,'aaa',0000,1,'2014-03-03 23:03:17',2,0),(4,'hahaha',0000,1,'2014-03-03 23:10:01',3,0);
/*!40000 ALTER TABLE `Bc_Regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bc_Users`
--

DROP TABLE IF EXISTS `Bc_Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bc_Users` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Password` char(32) NOT NULL,
  `Realname` varchar(20) NOT NULL,
  `LastLogin` datetime DEFAULT NULL,
  `AuthMask` text,
  `Uid` int(8) unsigned NOT NULL,
  `Uname` varchar(50) NOT NULL,
  `Display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `Super` tinyint(1) NOT NULL DEFAULT '0',
  `Deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `Email` varchar(200) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `Status` smallint(2) unsigned NOT NULL,
  `Remark` varchar(200) NOT NULL,
  `Role` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `Display` (`Display`),
  KEY `Deleted` (`Deleted`),
  KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='系统用户';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bc_Users`
--

LOCK TABLES `Bc_Users` WRITE;
/*!40000 ALTER TABLE `Bc_Users` DISABLE KEYS */;
INSERT INTO `Bc_Users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','管理员','2014-03-04 19:02:04',NULL,0,'',1,1,0,'pysche@ipbfans.org','2013-12-19 22:05:46',NULL,1,'adfasdf','admin'),(3,'test','098f6bcd4621d373cade4e832627b4f6','测试号',NULL,NULL,1,'',1,0,1,'adf@lad.com','2014-02-26 21:36:45',NULL,0,'','admin'),(6,'buyer','5093b0ecbefed9907361c7ce0aec6907','aal','2014-03-02 21:20:46',NULL,1,'',1,0,0,'dkdi@lkjadf.com','2014-02-26 21:38:03',NULL,1,'','buyer'),(7,'seller','5093b0ecbefed9907361c7ce0aec6907','卖方','2014-03-02 21:24:58',NULL,1,'',1,0,0,'akd@lk.cm','2014-02-27 21:34:26',NULL,1,'','seller'),(8,'trans','5093b0ecbefed9907361c7ce0aec6907','测试配送','2014-03-02 21:27:23',NULL,1,'',1,0,0,'iekx@jzcf.com','2014-02-27 21:34:53',NULL,1,'','trans');
/*!40000 ALTER TABLE `Bc_Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-03-04 20:32:42
