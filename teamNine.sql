-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: teamNine
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1-log

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
-- Table structure for table `Errors`
--

DROP TABLE IF EXISTS `Errors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Errors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idhash` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `error` text NOT NULL,
  `line` int(11) NOT NULL,
  `source` text NOT NULL,
  `method` char(255) DEFAULT 'None',
  `user` char(255) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `user_idhash` char(255) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `project_idhash` char(255) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `severity` smallint(6) DEFAULT '0',
  `comment` text,
  `resolved` tinyint(1) DEFAULT '0',
  `resolved_comment` text,
  `resolved_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `resolved_user` char(255) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idhash_unique` (`idhash`),
  KEY `user` (`user`),
  KEY `project_idhash` (`project_idhash`),
  KEY `resolved_user` (`resolved_user`),
  KEY `user_idhash` (`user_idhash`),
  CONSTRAINT `Errors_ibfk_1` FOREIGN KEY (`user`) REFERENCES `Users` (`user`),
  CONSTRAINT `Errors_ibfk_2` FOREIGN KEY (`project_idhash`) REFERENCES `Projects` (`project_idhash`),
  CONSTRAINT `Errors_ibfk_3` FOREIGN KEY (`resolved_user`) REFERENCES `Users` (`user`),
  CONSTRAINT `Errors_ibfk_4` FOREIGN KEY (`user_idhash`) REFERENCES `Users` (`idhash`)
) ENGINE=InnoDB AUTO_INCREMENT=726 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Errors`
--

LOCK TABLES `Errors` WRITE;
/*!40000 ALTER TABLE `Errors` DISABLE KEYS */;
INSERT INTO `Errors` VALUES (699,'SL5hfCrhrFyiw','2014-09-06 06:14:12','Uncaught SyntaxError: Unexpected token ;',71,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(700,'DwuaXBFhfL53c','2014-09-06 06:14:12','Uncaught ReferenceError: asdasda is not defined',81,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(701,'hUGsGITav0keg','2014-09-06 06:14:12','Uncaught ReferenceError: asdasda is not defined',81,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(702,'bHndsjgXy9ID.','2014-09-06 06:14:13','Uncaught ReferenceError: asdasda is not defined',81,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(703,'.iaSYqAz8j0UI','2014-09-06 06:14:14','Uncaught ReferenceError: myErrorFunc2 is not defined',92,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(704,'b5M.9AyHV0lT6','2014-09-06 06:14:14','Uncaught ReferenceError: myErrorFunc2 is not defined',92,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(705,'qz4wYJo3GAI8s','2014-09-06 06:14:14','Uncaught ReferenceError: myErrorFunc2 is not defined',92,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(706,'GtzT2j/2n/AcA','2014-09-06 06:14:14','Uncaught ReferenceError: myErrorFunc2 is not defined',92,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(707,'ABbZzHtzfhNLc','2014-09-06 06:14:44','Uncaught SyntaxError: Unexpected token ;',71,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(708,'CBA82olsqJZUg','2014-09-06 06:14:44','Uncaught ReferenceError: asdasda is not defined',81,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(709,'BvMgapw899KCw','2014-09-06 06:14:44','Uncaught ReferenceError: asdasda is not defined',81,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(710,'smPQNneRjTwvc','2014-09-06 06:14:45','Uncaught ReferenceError: asdasda is not defined',81,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(711,'kqF.371LPY0.6','2014-09-06 06:14:45','Uncaught ReferenceError: myErrorFunc3 is not defined',97,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(712,'6OHLFWglGcZuo','2014-09-06 06:14:45','Uncaught ReferenceError: myErrorFunc3 is not defined',97,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(713,'VTy4fzni3LYqI','2014-09-06 06:14:45','Uncaught ReferenceError: myErrorFunc3 is not defined',97,'http://192.241.238.37/testerror1',NULL,NULL,'u3rA5eAw8wQbM','oTU.DLpobSm6I',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(715,'5NwGhDFGgy62w','2014-09-08 10:02:46','Uncaught SyntaxError: Unexpected end of input',245,'http://104.131.195.50/',NULL,NULL,'LTm4QCWteNWY2','oXByPLGU1PFwI',1,'123234',0,NULL,'0000-00-00 00:00:00',NULL),(716,'ra9j0uTy5zhBc','2014-09-08 10:02:47','Uncaught SyntaxError: Unexpected end of input',245,'http://104.131.195.50/',NULL,NULL,'LTm4QCWteNWY2','oXByPLGU1PFwI',1,'123234',0,NULL,'0000-00-00 00:00:00',NULL),(718,'eDedWuFHGPda2','2014-09-08 10:02:48','Uncaught SyntaxError: Unexpected end of input',245,'http://104.131.195.50/',NULL,NULL,'LTm4QCWteNWY2','oXByPLGU1PFwI',1,'123234',0,NULL,'0000-00-00 00:00:00',NULL),(720,'UgQ5zh1tunsws','2014-09-08 10:03:05','Uncaught SyntaxError: Unexpected end of input',245,'http://104.131.195.50/',NULL,NULL,'LTm4QCWteNWY2','oXByPLGU1PFwI',1,'123234',0,NULL,'0000-00-00 00:00:00',NULL),(723,'zhRZLIUd39sZo','2014-09-08 10:03:05','Uncaught SyntaxError: Unexpected end of input',245,'http://104.131.195.50/',NULL,NULL,'LTm4QCWteNWY2','oXByPLGU1PFwI',1,'123234',0,NULL,'0000-00-00 00:00:00',NULL),(724,'01g2839DHlPYY','2014-09-08 10:05:27','Uncaught ReferenceError: testFunc is not defined',241,'http://104.131.195.50/',NULL,NULL,'LTm4QCWteNWY2','oXByPLGU1PFwI',0,NULL,0,NULL,'0000-00-00 00:00:00',NULL),(725,'eOO7ZJlWd7Dm2','2014-09-08 10:05:27','Uncaught SyntaxError: Unexpected end of input',245,'http://104.131.195.50/',NULL,NULL,'LTm4QCWteNWY2','oXByPLGU1PFwI',1,'123234',0,NULL,'0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `Errors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Project_Users`
--

DROP TABLE IF EXISTS `Project_Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Project_Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_idhash` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `user` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `user_idhash` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `project_idhash` (`project_idhash`),
  KEY `user_idhash` (`user_idhash`),
  CONSTRAINT `Project_Users_ibfk_1` FOREIGN KEY (`user`) REFERENCES `Users` (`user`),
  CONSTRAINT `Project_Users_ibfk_2` FOREIGN KEY (`project_idhash`) REFERENCES `Projects` (`project_idhash`),
  CONSTRAINT `Project_Users_ibfk_3` FOREIGN KEY (`user_idhash`) REFERENCES `Users` (`idhash`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Project_Users`
--

LOCK TABLES `Project_Users` WRITE;
/*!40000 ALTER TABLE `Project_Users` DISABLE KEYS */;
INSERT INTO `Project_Users` VALUES (7,'67890','newguy','t0vjQpo3Af8yE'),(8,'67890','childUser','8ggNFmdq3Waec'),(58,'Vs5VDCpLn5J5.','rmomoko','lnHnOLRvTt3bE'),(73,'ZL5telTwDVUPo','helloyou','JQnLaUsvFNhMs'),(105,'ANdC2NrbyyKIo','m12345','y4GZ8ePly3vP.'),(112,'Y9IL6rw8whS2Y','Rmomoko','YI2VKiZ33YOxE'),(114,'Y9IL6rw8whS2Y','rollos','Kg8ORCqb.O9rQ'),(116,'Y9IL6rw8whS2Y','thestruggle','uG.iKIlYWaD/c'),(132,'rLTGFKwEVLSt.','helloyu','UJGbdb/uLcSZg'),(133,'rLTGFKwEVLSt.','JackieChen','VCDcE4JZTzfgc'),(137,'fiHA/REkB3cEE','teamAdmin','Uo1h2uOPUIkew'),(166,'Oswi7JHMh0xwg','theFuzz','FvpjCj.m4IIL.'),(167,'Oswi7JHMh0xwg','richab','iV2AbCdkqKegQ'),(168,'g/Tu043uPvKYY','rlhagen','0wm4wKs8gy8uw'),(171,'Hy2WbVqgVnQlc','matt12','UY9oHOZD7BLyw'),(172,'zpBcndHEijmys','matt12','UY9oHOZD7BLyw'),(173,'4mBdA/hS30Er6','matt12','UY9oHOZD7BLyw'),(174,'rAEcx0ZWWRI86','matt12','UY9oHOZD7BLyw'),(175,'Gg/YK3buKGtLk','richab','iV2AbCdkqKegQ'),(176,'oTU.DLpobSm6I','developer1','u3rA5eAw8wQbM'),(177,'oXByPLGU1PFwI','maxlufs','LTm4QCWteNWY2');
/*!40000 ALTER TABLE `Project_Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Projects`
--

DROP TABLE IF EXISTS `Projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_idhash` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `owner` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `owner_idhash` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `name` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_idhash` (`project_idhash`),
  KEY `owner` (`owner`),
  KEY `owner_idhash` (`owner_idhash`),
  CONSTRAINT `Projects_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `Users` (`user`),
  CONSTRAINT `Projects_ibfk_2` FOREIGN KEY (`owner_idhash`) REFERENCES `Users` (`idhash`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Projects`
--

LOCK TABLES `Projects` WRITE;
/*!40000 ALTER TABLE `Projects` DISABLE KEYS */;
INSERT INTO `Projects` VALUES (2,'67890','newguy','t0vjQpo3Af8yE','Other Project'),(22,'Vs5VDCpLn5J5.','rmomoko','lnHnOLRvTt3bE','Testing'),(30,'ZL5telTwDVUPo','helloyou','JQnLaUsvFNhMs','Create a Project'),(40,'FjoILgC2zukrA','teamAdmin','Uo1h2uOPUIkew','Admin Demo Project'),(44,'ANdC2NrbyyKIo','m12345','y4GZ8ePly3vP.','p2'),(49,'Y9IL6rw8whS2Y','Rmomoko','YI2VKiZ33YOxE','Project R&F'),(50,'jcQDw6fdG/7UY','JackieChen','VCDcE4JZTzfgc','TryItOut'),(51,'fq4Ccsh8v0Q9.','helloyu','UJGbdb/uLcSZg','helloyousuckalotmore'),(56,'rLTGFKwEVLSt.','helloyu','UJGbdb/uLcSZg','helloyousuckalotmore'),(57,'f4Z2PzDh0OEiM','teamAdmin','Uo1h2uOPUIkew','test project'),(58,'fiHA/REkB3cEE','teamAdmin','Uo1h2uOPUIkew','testing onece more'),(79,'Oswi7JHMh0xwg','theFuzz','FvpjCj.m4IIL.','Demo Project'),(80,'g/Tu043uPvKYY','rlhagen','0wm4wKs8gy8uw','Web-tester'),(83,'Hy2WbVqgVnQlc','matt12','UY9oHOZD7BLyw','alert(&#39;team 16 here&#39;)'),(84,'zpBcndHEijmys','matt12','UY9oHOZD7BLyw','test&#39;); DROP TABLE projects; --'),(85,'4mBdA/hS30Er6','matt12','UY9oHOZD7BLyw','&#39;alert(&#39;test&#39;)'),(86,'rAEcx0ZWWRI86','matt12','UY9oHOZD7BLyw','&#39;&#39;alert(&#39;test&#39;)'),(87,'Gg/YK3buKGtLk','richab','iV2AbCdkqKegQ','Testing123'),(88,'oTU.DLpobSm6I','developer1','u3rA5eAw8wQbM','projtest'),(89,'oXByPLGU1PFwI','maxlufs','LTm4QCWteNWY2','cse135');
/*!40000 ALTER TABLE `Projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Recovery`
--

DROP TABLE IF EXISTS `Recovery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Recovery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recovery_hash` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `idhash` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `recovery_hash` (`recovery_hash`),
  UNIQUE KEY `idhash` (`idhash`),
  CONSTRAINT `Recovery_ibfk_1` FOREIGN KEY (`idhash`) REFERENCES `Users` (`idhash`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Recovery`
--

LOCK TABLES `Recovery` WRITE;
/*!40000 ALTER TABLE `Recovery` DISABLE KEYS */;
INSERT INTO `Recovery` VALUES (17,'$2a$10$NrjOAK1Il4QJGYKaSJuvu.ckSLGb0UBFnK0UZLldEDbTaYRZzN/Rq','t0vjQpo3Af8yE'),(22,'$2a$10$kgGkGSk8znqJNd5kxo6xMeYf0qo9ZI1xhqnZJoVqKXqvMyy3DH8pW','trXalZ7mzpFdg'),(23,'$2a$10$aVfg4FHITYB368mhM8efG.7WhuEZHwyCDXEbmdQJQ0l158MVZXJeO','JQnLaUsvFNhMs'),(24,'$2a$10$3V7ILsJi3cS7.iIxVlFC0uJrJlW12JvDhYOav.EzPussPfd8L4tXG','iV2AbCdkqKegQ'),(26,'$2a$10$D4WqMhss3z9lFGnwHmBoC.kkTJe65T7kObAAqvj5nL.PA7.0sNb/W','Tcy3yDq1vCmWU'),(28,'$2a$10$R7aB6Ln8FGVEHYAVI1RUkeH0n2bgeS/d9.ChsnEN2AvcM/G4XQvVi','sL69GLRr1.i6c');
/*!40000 ALTER TABLE `Recovery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Scripts`
--

DROP TABLE IF EXISTS `Scripts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Scripts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `script_idhash` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `project_idhash` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `owner` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `name` char(255) NOT NULL,
  `code` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `script_idhash` (`script_idhash`),
  KEY `owner` (`owner`),
  KEY `project_idhash` (`project_idhash`),
  CONSTRAINT `Scripts_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `Users` (`user`),
  CONSTRAINT `Scripts_ibfk_2` FOREIGN KEY (`project_idhash`) REFERENCES `Projects` (`project_idhash`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Scripts`
--

LOCK TABLES `Scripts` WRITE;
/*!40000 ALTER TABLE `Scripts` DISABLE KEYS */;
INSERT INTO `Scripts` VALUES (1,'abcdefg','67890','teamAdmin','Test Script','alert(\'testing123\');');
/*!40000 ALTER TABLE `Scripts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` int(11) NOT NULL,
  `email` varchar(80) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `user` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `hash` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `idhash` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `parent_idhash` char(255) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `fingerprint` char(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastlogin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `idhash` (`idhash`),
  KEY `parent_idhash` (`parent_idhash`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,0,'teamAdmin@teamNine.com','teamAdmin','$2a$10$4tPc02RX2qfXUID3PxLSIO8bS6LZ0AuL6Fd2a/8LkFSrAa3gEtceS','Uo1h2uOPUIkew',NULL,'',1,0,'2014-08-10 08:20:09','2014-09-12 17:46:41'),(2,2,'ta@teamNine.com','theFuzz','$2a$10$234kasdhNemlKy/HY/rEUewh2JmMeWh87Xu581co/7rGjjhBA/wDK','FvpjCj.m4IIL.',NULL,'',1,0,'2014-08-10 08:20:16','2014-09-12 17:47:10'),(5,0,'testing@1234.com','childUser','$2a$10$fCOlwnJHMZf/E5ZdV3r91e4egpHZNEIlRF7xkGm0xfuph7vDu1eWa','8ggNFmdq3Waec',NULL,'',1,0,'2014-08-27 21:36:29','0000-00-00 00:00:00'),(18,0,'newguy@newguy.com','newguy','$2a$10$3C6gWp3lNIGvmKjMNovc5O26pcqy/kxIGPu1v/fOkB8Xc9VpvlFMy','t0vjQpo3Af8yE',NULL,'',1,0,'2014-08-28 05:34:43','2014-08-30 05:40:26'),(19,0,'token@testing.com','testingTokens','$2a$10$iMMB2PUbkHrmFuts4C/iy.p/Qgsnce2uHj2hM5ZbRdpBr18p0XwMS','9YkACgonk0v3A',NULL,'',0,0,'2014-08-28 20:00:07','0000-00-00 00:00:00'),(20,0,'testing@things.org','itestthings','$2a$10$VaQcmwJVCCRGhMdh1l54veZjq6DNxPUyg8JBYQ4xhCDKvK6jj/Xr6','VsswTLmG/cpV.',NULL,'',0,0,'2014-08-29 02:01:03','0000-00-00 00:00:00'),(21,0,'things@things.com','thingsthings','$2a$10$/EzlzZFEqMgwhX.O5dmOE.dqPrzcy3WzooM4.JXM.H52matY6Inzy','245bPEJN06OPQ',NULL,'',0,0,'2014-08-29 02:02:48','0000-00-00 00:00:00'),(22,0,'weird@things.com','weirdthings','$2a$10$rQRi/7526YNj8G9jnRQ0oOqH2H4HB5f.UU6l2fzKtIDBVi1qN0Lfa','HHT0JyFqoqT32',NULL,'',0,0,'2014-08-29 03:08:19','0000-00-00 00:00:00'),(23,0,'teststhetest@com.com','moretest','$2a$10$N6fgPsjixVOrRyuo25tXeev0Z1GO3SbQz1i8aPLx/0jUO/3kiubD.','PaV5x1kANdNo.',NULL,'',0,0,'2014-08-29 03:24:43','0000-00-00 00:00:00'),(24,0,'asdf@asdf.com','asdf','$2a$10$/x7G.OIXjBqv19eWmeii9eLDdC.5ANk7s./nKpQUYdofhd6sijHdq','znxxJurDe7BKw',NULL,'',0,0,'2014-08-29 03:25:37','0000-00-00 00:00:00'),(25,0,'testor@123.com','Testor123','$2a$10$toFf.3nu5rABJ82qIiGhcuizoVDlko6w3gnDnwaYtgQCeJnHVCHXu','jcpUHdp5DoGvM',NULL,'',0,0,'2014-08-29 03:29:51','0000-00-00 00:00:00'),(26,0,'Bootysmashin@mohoes.com','BootySmasha_1','$2a$10$liPHlnliFETuxPPo42IzL.EDVk0FSxSzGt6iyQgxJibUWL32AByma','trXalZ7mzpFdg',NULL,'',1,0,'2014-08-29 03:30:02','2014-09-01 06:29:45'),(27,0,'testingErr@err.com','testingError','$2a$10$69QKvXM3b8Q3eJ5TPoAcrOwJlGxJofzqzQw7sJ9CsM8YTIvcZXmka','41k0KviRtzIFY',NULL,'',0,0,'2014-08-29 03:34:12','0000-00-00 00:00:00'),(28,0,'test9@nine.com','test9','$2a$10$Z/jKE.T9Z.XmKULAFt2d3eMCDgP.Gh2wDLNepR3bmVwpYPZ0M49yW','8s66J/2aRc.8k',NULL,'',0,0,'2014-08-29 03:36:53','0000-00-00 00:00:00'),(29,0,'test300@alpha.com','test300','$2a$10$3.Gfsum.DwsXDamqT9w/WeC.T2rIi6SRHQwebf48n7tww6PdDcPhC','YNvCNZkayeYKk',NULL,'',0,0,'2014-08-29 03:38:41','0000-00-00 00:00:00'),(30,0,'test301@123.com','test301','$2a$10$f0fuauuRlSX.rYnzt9SWmempjsuYNwGmjJmcUmNz3I79m7aEaP6TW','HFZCdRZr1ozSg',NULL,'',0,0,'2014-08-29 03:38:57','0000-00-00 00:00:00'),(31,0,'test307@g.com','test307','$2a$10$u3UoAlMfoyKrE6CX1bx0p.RK8SsOEWrpvHpEvp7YfpYkRedTV4Szu','bSW.PuuC3zEYQ',NULL,'',0,0,'2014-08-29 03:50:38','0000-00-00 00:00:00'),(32,0,'test308@g.com','test308','$2a$10$4ExNOJRl4ETgxHvZomue1.uOj.8SRx3r4SJu3D8zADwJFxF46tGnu','ZFgThkQQ/9q1s',NULL,'',0,0,'2014-08-29 03:52:06','0000-00-00 00:00:00'),(33,0,'ttt@err.com','testingERRS','$2a$10$c/q9bBynpct.K8Jq2Mww7OaPlhxtNgc9xE7nkVOwZfCEaMpx5Pd0.','iKP687LGB/x2M',NULL,'',0,0,'2014-08-29 03:55:54','0000-00-00 00:00:00'),(34,0,'asdsa@sdsd.com','asdasdsa','$2a$10$OfDTymcErcu5ggqT3qHpfew5l2iUogAIQY8W7R4xgDwEeKzj2uOoa','VKixJnjNp.AJw',NULL,'',0,0,'2014-08-29 20:38:11','0000-00-00 00:00:00'),(35,0,'sdafasdf@sadfasd.com','asdfasdf','$2a$10$Pb.TJjDy0BLWUW/e0VtnDeWXalMmeY80NjJr5nu.RWnKZor53Cwy.','x/eYqDPVh2pNE',NULL,'',0,0,'2014-08-29 22:23:38','0000-00-00 00:00:00'),(36,0,'roro@rolando.com','jvucow','$2a$10$/4/dWGa0BNlai7SxuMcoYeetueq6BDIbOUStEt0E3Ro05OboTKwqm','mGO8Xo3I6T0Q6',NULL,'',1,0,'2014-08-29 23:56:08','2014-08-29 20:57:38'),(37,0,'newUser@newUser.com','newUser','$2a$10$edxVNB5/n.bQIPCZ7EOnP.WWmfPJuMQ.5JcY4uqQSdsL3n6jp/NNO','y6xj50VhqBKzM',NULL,'',0,0,'2014-08-30 23:03:27','0000-00-00 00:00:00'),(38,0,'newUser@new.com','newuser2','$2a$10$OcDXAztN3uLU3BipvKYcrOGRMTpsUzLt.tNkcZ7Ypm86My1ZaTZkC','EWKuT8BKVEL0M',NULL,'',1,0,'2014-08-30 23:32:12','2014-08-30 20:32:51'),(39,0,'testified@testing.com','testingNewModal','$2a$10$w5zmdkAXkv5iTotEf9iK/el3HjSTv5kXgEuiHpv02Zf.47eGx5JkO','CLCl8H/WAgL4U',NULL,'',0,0,'2014-08-30 23:33:45','0000-00-00 00:00:00'),(40,0,'junk@junk.com','anotherJunkAccount','$2a$10$fr8oLJcVxfE5L.wBvR3hju8KeioGpWVqSwLv4qgB.LCvVc23ajNby','vGi.vlRXT0TCE',NULL,'',0,0,'2014-08-30 23:37:52','0000-00-00 00:00:00'),(41,0,'dollarBillYall@bs.com','DollaDollaBill','$2a$10$BR7VvuZbGMQk/e7Yz/mjNuKm/./vmWNVGdHSHK0yEBKdh9VBI148q','IuLu03MnkJEg2',NULL,'',1,0,'2014-09-01 00:23:42','2014-08-31 21:24:50'),(42,0,'bullshitemail@email.com','testAcct','$2a$10$9Lfh8BoxXJzsMNaLja2I/uhmSaAfqnbPxlg/YEO8fi6eL7M/jZlbS','Xipj0sXhnDcQU',NULL,'',1,0,'2014-09-01 00:27:25','2014-08-31 21:28:46'),(43,0,'slickrick909@gmail.com','skrk909','$2a$10$qGcSsvcNUVEeqiuwlBXrN.XlokRoNCls0XkUkne1Ad2VzXyPCQj6i','sL69GLRr1.i6c',NULL,'',1,0,'2014-09-01 01:28:50','2014-09-01 09:44:01'),(44,0,'jackiechenlollol@gmail.com','JackieChen','$2a$10$.Mhs7EfXhnfakrFAUIwH7OQjTmPDIAxIMjOyVLwr4rbgKXh9RCey2','VCDcE4JZTzfgc',NULL,'',1,0,'2014-09-01 01:39:43','2014-09-04 10:36:19'),(45,0,'timezone@test.com','timezonetest','$2a$10$HdyRNpSjM0Gmg6wDVH/I5OjdJgyK9gd33fkA/lwN4B3xLRdCZozga','lkT59WG5xiZIw',NULL,'',1,0,'2014-09-01 02:01:55','2014-09-01 02:02:42'),(46,0,'jvu715@yahoo.com','rmomoko','$2a$10$vHvwgONeYaVIgnc/9xNVeeExn2MopFBwodMJGsDpYyVrqaHKEgiD6','lnHnOLRvTt3bE',NULL,'',1,0,'2014-09-01 02:23:11','2014-09-01 02:24:21'),(47,0,'jackieChenlollollol@gmail.com','JackChen','$2a$10$GfeZB4XVgyWPzgUcxbuiLucDZ0/NuncPVnCUltSgslu09bFF8cxvy','oK5mVgCav4VsE',NULL,'',0,0,'2014-09-01 02:30:42','0000-00-00 00:00:00'),(48,0,'helloyousuckalot@gmail.com','helloyou','$2a$10$ZKjoJSgtkIr1VBM5rtuAxesi.0rY7uJ0YwGRYhwO3X7Bv0DuYGE..','JQnLaUsvFNhMs',NULL,'',1,0,'2014-09-01 02:35:49','2014-09-01 18:03:20'),(51,0,'richard.allan.b@gmail.com','richab','$2a$10$cXd62qpupwRQ0H3ueV6KpOVr5TYnPHATImh/PcoaCN0PU/meh5Ju.','iV2AbCdkqKegQ',NULL,'',1,0,'2014-09-01 02:45:00','2014-09-10 07:18:43'),(52,0,'helloyousuckalotmore@gmail.com','helloyu','$2a$10$G44I259EttyMWzXYYxCBcukShVtNlTjHoPfinLFFfUfWmzRZouPXu','UJGbdb/uLcSZg',NULL,'',1,0,'2014-09-01 04:50:30','2014-09-04 17:23:46'),(53,0,'jackChenlollol@gmail.com','jackChenlollol','$2a$10$cxcufJPFnzX4JkioUSP.KO.nGFi6XefXhvssiSPuGhgj0t5RpkAYy','Tcy3yDq1vCmWU',NULL,'',1,0,'2014-09-01 05:27:14','2014-09-01 05:28:02'),(54,0,'slickricK909@gmail.com','testing2','$2a$10$3ja0WR3rtvo3RAxPWv5DK.jpbpW8mG6SgEg5SPA8Cfik7ppdaNj7K','mVwx/kaVOwiGM',NULL,'',0,0,'2014-09-01 07:18:00','0000-00-00 00:00:00'),(55,0,'ummnowearenothacking@bangbros.com','nothackingyou','$2a$10$NSQfhQ6aprge.7PrdlthQOkNTNLjxi3sI0lGK0SF6KmpGuGJDkBnq','uQXBWyIi8KQ.c',NULL,'',0,0,'2014-09-02 04:04:55','0000-00-00 00:00:00'),(56,0,'cantlogin@pleasework.com','whycantwelogin','$2a$10$43Rzn7D6lSi07uJ/LWoim.SVyZj7pjCgVJp4BO.Oet.vDJBPrt5fq','1Jo7/duJyXst.',NULL,'',0,0,'2014-09-02 04:06:21','0000-00-00 00:00:00'),(57,0,'longbanana@gmail.com','dingus','$2a$10$OS1v2qbEWVkp2vDY1JkOTeFD5lkt5zLD3P/ksmaLSvrb8oog7WOvO','rl8gSUO5.GpR2',NULL,'',0,0,'2014-09-02 06:35:39','0000-00-00 00:00:00'),(58,0,'ceo@teamNine.com','rollos','$2a$10$wltyP4m.LJgvkW262eH51.zHB9N9fTssI0tQwHLXhaM/NDVWrM6RO','Kg8ORCqb.O9rQ',NULL,'',1,0,'2014-09-03 20:58:25','2014-09-12 17:47:03'),(59,0,'ucsd2014cse135@gmail.com','m12345','$2a$10$Y5CAz3QuJENFxtBlrpJKf.fxoaj.KmLX69P1BZm45n26K3wh2mB2C','y4GZ8ePly3vP.',NULL,'',1,0,'2014-09-03 21:17:02','2014-09-04 06:51:12'),(60,0,'rmomoko@teamNine.com','Rmomoko','$2a$10$UOWu2weWb6eIKo2RjiKd2e3zxjeJ3BqL3SLKDdpqEKnzmTTqhnZOi','YI2VKiZ33YOxE',NULL,'',1,0,'2014-09-04 03:44:10','2014-09-04 07:31:21'),(61,0,'haha@hotmail.com','asdf33','$2a$10$PnMf0vIC4U6CrSzqEQ3Zo.IVzOEW9FYFIayvLgFSdaD4WcXEbXFCu','LTRaTIsI.aH6c',NULL,'',0,0,'2014-09-04 06:00:56','0000-00-00 00:00:00'),(62,0,'ucsd2014cse135.2@gmail.com','mmmmmm','$2a$10$sdpPgkmcurtscr7N4bZco.ZCdCbc8lP.VBiqjUZuHB9uUfOjn.xEG','UcJ1KXghSP1m6',NULL,'',0,0,'2014-09-04 06:19:46','0000-00-00 00:00:00'),(63,0,'max@linux.com','maxlufs','$2a$10$95vbrc/p9.TuTZPfP2TzU.nAxg7qj7zyW8uVeK4J1jm4YZTVOAq7q','LTm4QCWteNWY2',NULL,'',1,0,'2014-09-04 06:23:38','2014-09-08 10:01:26'),(64,0,'thestruggle@teamNine.com','thestruggle','$2a$10$4hfOHRPZuQixNSPdYyPYleUByLpu6yABe5EElyAqtr0hfw50vfVsy','uG.iKIlYWaD/c',NULL,'',1,0,'2014-09-04 07:25:46','2014-09-04 09:38:21'),(65,0,'qq037+av5bm4fyx03bc@sharklasers.com','testingName','$2a$10$P4Cmq92/vSQC1ZjtKT95EeN8h2bUsvFoHLvxfGcO.jxFRtf6Zfc66','vFOnFs5MRb4cg',NULL,'',1,0,'2014-09-04 10:28:49','2014-09-04 12:02:28'),(66,0,'qq0pb+20jboh2jvlnkc@sharklasers.com','weinerDinner','$2a$10$WxtQflAnpUUOblb3amlChO4zDH6rdLUcLHQaFpzE/Z88s4uB5uEGi','VlcRhrmGlChqc',NULL,'',1,0,'2014-09-04 10:44:56','2014-09-05 22:37:25'),(67,0,'qq5ai+17haf5eq0rs8k@sharklasers.com','tastingAccount','$2a$10$f5zw0/PGQ5.h8TxzCaOTLuZP/MbIG/78O/odyUwX5fq3FT5zUEv9e','.6h3jecJDgD/w',NULL,'',1,0,'2014-09-04 12:42:24','2014-09-05 23:32:12'),(68,0,'black@guy.com','whiteguy','$2a$10$o3cLEBrmG/xq6rZj07QYy.Bb3A5xsUdil4LsIC50V3qNi.0OWTAe2','ocW54t4zlgqGc',NULL,'',0,0,'2014-09-05 22:26:42','0000-00-00 00:00:00'),(69,0,'a2302089@trbvm.com','niggaguy','$2a$10$bA437/qEbs2EL60cY59TX.kHKmNYkn3E9QUsH1X8ZsPlccZY8UyMm','7yzbGYoaOrN0Y',NULL,'',0,0,'2014-09-05 22:28:34','0000-00-00 00:00:00'),(70,0,'qsabh+952xx40cy63lg@sharklasers.com','testingSignup','$2a$10$T11gSDoEaliNaBiWmpjk3uTlHRyu67Qzh1IT1jxAA38jftJuWL2kG','eKo5Ng1Yxd.Ws',NULL,'',1,0,'2014-09-05 23:32:56','2014-09-05 23:35:30'),(71,0,'qsdnb+24gig3ad6rzwc@sharklasers.com','testingfirewall','$2a$10$HoMCSFrrg3yZGdTDVML0LO5F.U/L5vXrQzAqmiJQQAtl8BtTcnxzm','Vz86Ib1sW/SL6',NULL,'',1,0,'2014-09-06 01:46:26','2014-09-06 01:59:14'),(72,3,'none@nowhere.com','chickenShackAttack','$2a$10$rgBL.oKg4jdscB.CYFiCHOxWRt4CjslYC1t5WisTHcK12glGlepuC','/gAPPxhTsSeIU',NULL,'',1,0,'2014-09-06 03:04:45','2014-09-06 03:41:45'),(73,0,'maria@poop.com','nardecky','$2a$10$y5l1XqqTu677w48bJQqVF.M4zj416DplvcmD39V2lErcBKbALlTYy','g1VVkud0JFGHY',NULL,'',0,0,'2014-09-06 03:11:27','0000-00-00 00:00:00'),(74,0,'username@gmail.com','username','$2a$10$072idiAnjN2mVfSjwQfIwO87gQxgwA9MVLxVYrDn0d0Njo7LWouxG','Y.iKUUTh89N5g',NULL,'',0,0,'2014-09-06 03:14:45','0000-00-00 00:00:00'),(75,0,'username2@gmail.com','username2','$2a$10$i2s19o32WhmPD97k3RJlw.R3OKQoUwxhDHrSLUWFnhFLqNxhSOdVe','t0UFNz3bVKKDE',NULL,'',0,0,'2014-09-06 03:15:39','0000-00-00 00:00:00'),(76,0,'rlhagen@yahoo.com','rlhagen','$2a$10$uhMxJA02T0QC3xvfE7ftC.6w.Yd2OMofxAcTflf4Ugnfb6KgZoW2q','0wm4wKs8gy8uw',NULL,'',1,0,'2014-09-06 03:16:37','2014-09-06 03:17:25'),(77,0,'monkey@monkey.com','monkey','$2a$10$WKP8shIq3UurWJqF0LfLXe.C5N7JnoRzeiwELWP97wdNOTFmfIT5q','MgiDZrfL1rrEE',NULL,'',0,0,'2014-09-06 03:29:10','0000-00-00 00:00:00'),(78,0,'plf94@live.com','boo123','$2a$10$u3KfIOBYbPnsjtPksOxwpONO8nuyNTnk.6FBd1taHZQLXt5084/qu','OqDVxJNpabLWk',NULL,'',0,0,'2014-09-06 03:47:35','0000-00-00 00:00:00'),(79,0,'testing@gmail.com','testing','$2a$10$o3BACe2Pb83O3wWDwxhPpes2emK3HNr3nl7ArmK26NB5xvZRBigda','D68kBzm.qcjmY',NULL,'',0,0,'2014-09-06 04:03:07','0000-00-00 00:00:00'),(80,0,'mattasaro@gmail.com','matt12','$2a$10$dFRSe7.A5l3Hnu/Zm97Iwu6bCraaSlv7IOliEnXZF2TLTwQYyFovO','UY9oHOZD7BLyw',NULL,'',1,0,'2014-09-06 04:06:36','2014-09-06 04:07:25'),(81,0,'mmayers@yahoo.com','mmayers','$2a$10$cP4PIpIWv.eh3GVZQnDh7.wPshqRrmIitxZF9a10M9k2dqbEdNZI2','Daeaa9rgdT7N6',NULL,'',0,0,'2014-09-06 04:14:39','0000-00-00 00:00:00'),(82,0,'mmayers2@yahoo.com','mmayers2','$2a$10$C0mTC3ZpfNh9tFWIcjJUKelrBIeQfCcPFRCV.tP1Aken/zHW10TkS','LOGG7kTspeeCE',NULL,'',0,0,'2014-09-06 04:15:07','0000-00-00 00:00:00'),(83,0,'svange@ucsd.edu','hancholo','$2a$10$VR2fWAl987AZQOLST2Sx1uwbzOqkTeXK06fIyHwGM6pFXtrOIqm3G','QZcR3wwkoDRWM',NULL,'',0,0,'2014-09-06 04:16:59','0000-00-00 00:00:00'),(84,0,'poop@gmail.com','POOPPOOP','$2a$10$4sO1nV3rDlboOKwWOBvy5uVgeoVDkfMiNJbGdQY.jIXzeUoGapxVS','wj62ngkMxZmIg',NULL,'',0,0,'2014-09-06 04:17:14','0000-00-00 00:00:00'),(85,0,'friendlyuser@sharklasers.com','friendlyuser','$2a$10$KHySOsvvSwz2NCsAdMVFAumP.n6XZdYenXLpetpmG3XVPlgazhO66','li33a6kMvJeEA',NULL,'',1,0,'2014-09-06 04:35:04','2014-09-06 04:35:32'),(86,0,'rob@rob.com','robert','$2a$10$kAt/xIWppxn7PUe0cxREeeW0z1csHfWP9r1hMWjHZAKZeXURDJ02O','gKgrMNBnRVqIA',NULL,'',0,0,'2014-09-06 04:48:33','0000-00-00 00:00:00'),(87,0,'gasdf@gmail.com','thththththt','$2a$10$Va58hqfqQ5iq5jyuocPaSO4m2ZH/Je38EM0G03j42cs1fImfFIQhu','BHHhZYhaFmEqI',NULL,'',0,0,'2014-09-06 05:33:50','0000-00-00 00:00:00'),(88,0,'dev@mail.com','developer','$2a$10$iaQnolJuzkgR4VG1tHNz2uVw4DU/vpmZByzekj6v4WKl84NwOBo6S','th84H5f81jWQw',NULL,'',0,0,'2014-09-06 05:40:51','0000-00-00 00:00:00'),(89,0,'seanoh1989@gmail.com','developer1','$2a$10$ybkB5p4gj04lSGfaN2xcvuuaHOiUN50Wj8ioMj38GGLptO6IKy3/S','u3rA5eAw8wQbM',NULL,'',1,0,'2014-09-06 05:41:45','2014-09-06 05:46:59'),(90,0,'asdasd@asd.com','asdasdasdasd','$2a$10$hWAgBAnKQp4JFyQGnoZVoeuadsxWryrU3Gy4Y9xORVoLXoAfDRa7C','Z4nodFOBJ1DaY',NULL,'',0,0,'2014-09-06 05:46:38','0000-00-00 00:00:00'),(91,0,'asdf@gmall.com','asdf12','$2a$10$aFYNQq6do9bRhjh1eWXYw.EHs4U1wXUSMj5GyZewXqUG.ATomMhZi','H1gLr5b32jZKo',NULL,'',0,0,'2014-09-06 05:52:48','0000-00-00 00:00:00'),(93,0,'asfas@dsfa.com','testingUser','$2a$10$RH6fzUGMfcM53tzZwN1qn.lYJJp.KK8XTn8Ik8jdm2E9lVhrmT1zq','aoatbPux4Emso',NULL,'',0,0,'2014-09-06 07:54:49','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-14 20:40:18
