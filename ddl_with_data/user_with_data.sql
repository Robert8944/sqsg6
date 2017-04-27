-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cs499
-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.14.04.1

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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `Password` varchar(64) NOT NULL,
  `level` int(11) DEFAULT '3',
  `gender` varchar(6) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  PRIMARY KEY (`UID`),
  UNIQUE KEY `UID` (`UID`),
  UNIQUE KEY `Email` (`Email`(54))
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (6,'test','test@test.com','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3',3,'Male','1993-11-29'),(8,'John Doe','johndoe@example.com','f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b',5,'Male','0199-11-29'),(12,'Hank Hill','hank@example.com','f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b',2,'Male','1993-11-29'),(17,'Babe Ruth','test3@example.com','f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b',3,'Male','1993-11-29'),(18,'Robinson Crueso','test4@example.com','f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b',3,'Male','1993-11-29'),(19,'Peter the Great','test5@example.com','f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b',3,'Male','1993-11-29'),(20,'Carl the Great','test6@example.com','f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b',3,'Male','1993-11-29'),(23,'Alfred the Great','test7@example.com','f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b',3,'Male','1993-11-29'),(27,'William Conqueror','test8@example.com','f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b',3,'Male','1993-11-29'),(28,'King Kong','test10@example.com','f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b',5,'Male','1993-11-29'),(29,'Queen Kong','test11@example.com','f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b',3,'Female','1993-11-29'),(30,'Duke Kong','test12@example.com','f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b',3,'Male','1993-11-29'),(31,'Prince Buster','princebuster@example.com','f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b',4,'Male','1994-11-29');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-26 20:28:56
