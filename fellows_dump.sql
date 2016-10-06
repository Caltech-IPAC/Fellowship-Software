-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: fellows
-- ------------------------------------------------------
-- Server version	5.1.73

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
-- Table structure for table `fellows`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fellows` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `last` varchar(20) DEFAULT NULL,
  `first` varchar(20) DEFAULT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `zip` varchar(15) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phd_date` varchar(25) DEFAULT NULL,
  `phd_univ` varchar(50) DEFAULT NULL,
  `phd_title` varchar(150) DEFAULT NULL,
  `phd_advisor` varchar(30) DEFAULT NULL,
  `host1` varchar(120) DEFAULT NULL,
  `host1_advisor` varchar(30) DEFAULT NULL,
  `host2` varchar(120) DEFAULT NULL,
  `host2_advisor` varchar(30) DEFAULT NULL,
  `host3` varchar(120) DEFAULT NULL,
  `host3_advisor` varchar(30) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `abstract` text,
  `category` varchar(40) DEFAULT NULL,
  `ref1_name` varchar(40) DEFAULT NULL,
  `ref1_inst` varchar(50) DEFAULT NULL,
  `ref2_name` varchar(40) DEFAULT NULL,
  `ref2_inst` varchar(50) DEFAULT NULL,
  `ref3_name` varchar(40) DEFAULT NULL,
  `ref3_inst` varchar(50) DEFAULT NULL,
  `date_submitted` varchar(50) DEFAULT NULL,
  `dirname` varchar(100) DEFAULT NULL,
  `rev1` char(2) DEFAULT NULL,
  `rev2` char(2) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `alloc` varchar(5) DEFAULT NULL,
  `letter_status` varchar(15) DEFAULT NULL,
  `letter_orig` text,
  `letter_edit` text,
  `last_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_mod_by` varchar(6) DEFAULT NULL,
  `conflicts` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `letters`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `letters` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `app_last` varchar(25) DEFAULT NULL,
  `app_first` varchar(25) DEFAULT NULL,
  `app_email` varchar(50) DEFAULT NULL,
  `ref_last` varchar(25) DEFAULT NULL,
  `ref_first` varchar(25) DEFAULT NULL,
  `ref_email` varchar(50) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `filename` varchar(150) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`username`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-03 11:26:29
