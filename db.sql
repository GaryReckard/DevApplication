-- MySQL dump 10.16  Distrib 10.1.14-MariaDB, for osx10.11 (x86_64)
--
-- Host: localhost    Database: vjs_assessment
-- ------------------------------------------------------
-- Server version	10.1.14-MariaDB

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
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` enum('NO','YES') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assessments`
--

DROP TABLE IF EXISTS `assessments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assessments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assessments`
--

LOCK TABLES `assessments` WRITE;
/*!40000 ALTER TABLE `assessments` DISABLE KEYS */;
INSERT INTO `assessments` VALUES (1,'Learning Styles Inventory');
/*!40000 ALTER TABLE `assessments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `assessment_id` int(11) unsigned NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `question` varchar(255) NOT NULL DEFAULT '',
  `style` enum('Visual','Auditory','Kinesthetic') NOT NULL DEFAULT 'Visual',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,1,1,'I prefer watch a video to reading.','Visual');
INSERT INTO `questions` VALUES (2,1,2,'When I sing along with my CDs or the radio, I know the words to the songs.','Auditory');
INSERT INTO `questions` VALUES (3,1,3,'I have athletic ability','Kinesthetic');
INSERT INTO `questions` VALUES (4,1,4,'I can picture the setting of a story I am reading.','Visual');
INSERT INTO `questions` VALUES (5,1,5,'I study better with music in the background.','Auditory');
INSERT INTO `questions` VALUES (6,1,6,'I enjoy hands on learning.','Kinesthetic');
INSERT INTO `questions` VALUES (7,1,7,'I\'d rather play sports than watch someone play them.','Kinesthetic');
INSERT INTO `questions` VALUES (8,1,8,'Reading aloud helps me remember.','Auditory');
INSERT INTO `questions` VALUES (9,1,9,'I prefer watching someon perform a skill or a task before I actually try it.','Visual');
INSERT INTO `questions` VALUES (10,1,10,'I color-coordinate my clothes.','Visual');
INSERT INTO `questions` VALUES (11,1,11,'I\'m good at rhyming and rapping','Auditory');
INSERT INTO `questions` VALUES (12,1,12,'Use phrases like: \"I\'ve got a handle on it\", \"I’m up against the wall\", or \"I have a feeling that …\"','Kinesthetic');
INSERT INTO `questions` VALUES (13,1,13,'I need to look at something several times before I understand it.','Visual');
INSERT INTO `questions` VALUES (14,1,14,'I prefer having instructors give oral directions that written ones.','Auditory');
INSERT INTO `questions` VALUES (15,1,15,'I have difficulty being still for long periods of time.','Kinesthetic');
INSERT INTO `questions` VALUES (16,1,16,'I use phrases like \"I see what you\'re saying\", \"That looks good\", or \"That\'s clear to me\"','Visual');
INSERT INTO `questions` VALUES (17,1,17,'I\'m good at figuring out how something works.','Kinesthetic');
INSERT INTO `questions` VALUES (18,1,18,'I can understand a taped lecture.','Auditory');
INSERT INTO `questions` VALUES (19,1,19,'It\'s easy for me to replay scenes from movies in my head.','Visual');
INSERT INTO `questions` VALUES (20,1,20,'I enjoy studying foreign languages.','Auditory');
INSERT INTO `questions` VALUES (21,1,21,'I would rather conduct my own science experiment than watch someone else do it.','Kinesthetic');
INSERT INTO `questions` VALUES (22,1,22,'I would rather paint a house than a picture.','Kinesthetic');
INSERT INTO `questions` VALUES (23,1,23,'I enjoy studying in groups.','Auditory');
INSERT INTO `questions` VALUES (24,1,24,'I prefer to have written directions to someone\'s home.','Visual');
INSERT INTO `questions` VALUES (25,1,25,'I can look at an object and remember it when I close my eyes.','Visual');
INSERT INTO `questions` VALUES (26,1,26,'I have musical ability.','Auditory');
INSERT INTO `questions` VALUES (27,1,27,'When I study new vocabulary, writing the words several times helps me learn.','Kinesthetic');
INSERT INTO `questions` VALUES (28,1,28,'I can imagine myself doing something before I actually do it.','Visual');
INSERT INTO `questions` VALUES (29,1,29,'I use phrases like \"That rings a bell\", \"I hear you\", or \"That sounds good\"','Auditory');
INSERT INTO `questions` VALUES (30,1,30,'I enjoy building things and working with tools.','Kinesthetic');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'username','$2y$10$UuyEymj85chiuMtQ8tCWS.o6rc9eBCKT2Pbq9fxoj3otH.8nPlEQy');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-20 15:22:46
