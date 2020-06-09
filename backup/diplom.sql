-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: diplom
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `facultyId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Автоматическое управление',1),(2,'Программная инженерия',1),(3,'Информационная безопасность',1),(4,'Кафедра кыргызского языка',2);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `educationplans`
--

DROP TABLE IF EXISTS `educationplans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `educationplans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `authorId` int(11) unsigned NOT NULL,
  `facultyId` tinyint(3) unsigned NOT NULL,
  `departmentId` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `educationplans`
--

LOCK TABLES `educationplans` WRITE;
/*!40000 ALTER TABLE `educationplans` DISABLE KEYS */;
/*!40000 ALTER TABLE `educationplans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculties`
--

DROP TABLE IF EXISTS `faculties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculties` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculties`
--

LOCK TABLES `faculties` WRITE;
/*!40000 ALTER TABLE `faculties` DISABLE KEYS */;
INSERT INTO `faculties` VALUES (1,'Информационные технологии'),(2,'Технологический факультет');
/*!40000 ALTER TABLE `faculties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forumsections`
--

DROP TABLE IF EXISTS `forumsections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forumsections` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `facultyId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forumsections`
--

LOCK TABLES `forumsections` WRITE;
/*!40000 ALTER TABLE `forumsections` DISABLE KEYS */;
INSERT INTO `forumsections` VALUES (4,'C++',1);
/*!40000 ALTER TABLE `forumsections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `facultyId` int(11) NOT NULL,
  `departmentId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'УТС-1-16',1,1),(2,'Пи-1-16',1,2);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `publicationDate` datetime NOT NULL DEFAULT current_timestamp(),
  `facultyId` int(10) unsigned DEFAULT NULL,
  `departmentId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (27,'Объявлена дата приема дипломных работ','Дипломные проекты будут приниматься 25.06.2020','2020-05-23 16:03:26',1,1),(31,'ФИТ ПИ','т','2020-05-30 17:24:07',1,2),(32,'ФИТ','т','2020-05-30 17:34:45',1,0),(33,'ФИТ УТС','т','2020-05-30 17:35:20',1,1),(34,'КГТУ','т','2020-05-30 17:35:46',0,0),(35,'ТФ КЯ','т','2020-05-30 17:38:05',2,4),(36,'ТФ','т','2020-05-30 17:38:19',2,0);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planstages`
--

DROP TABLE IF EXISTS `planstages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planstages` (
  `planId` int(11) unsigned NOT NULL,
  `orderNumber` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planstages`
--

LOCK TABLES `planstages` WRITE;
/*!40000 ALTER TABLE `planstages` DISABLE KEYS */;
/*!40000 ALTER TABLE `planstages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roleName` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (4,'test'),(3,'Администратор'),(1,'Преподаватель'),(2,'Студент');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `facultyId` int(11) NOT NULL,
  `departmentId` int(11) NOT NULL,
  `semester` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'Теория автоматического управления 1',1,1,5),(2,'Интеллектуальные системы управления',1,1,7),(3,'Программирование в системе MATLAB',1,1,2),(6,'Логика и теория алгоритмов',1,2,2),(7,'Информационно-управляющие системы',1,1,7),(8,'	\r\nОптимальные и адаптивные системы',1,1,7);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjectsusers`
--

DROP TABLE IF EXISTS `subjectsusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjectsusers` (
  `userId` int(11) NOT NULL,
  `subjectId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjectsusers`
--

LOCK TABLES `subjectsusers` WRITE;
/*!40000 ALTER TABLE `subjectsusers` DISABLE KEYS */;
INSERT INTO `subjectsusers` VALUES (2,2),(2,7),(2,2),(2,7),(2,2),(2,7),(2,2);
/*!40000 ALTER TABLE `subjectsusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacherdocs`
--

DROP TABLE IF EXISTS `teacherdocs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacherdocs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `altLink` varchar(255) DEFAULT NULL,
  `description` varchar(1255) NOT NULL,
  `hashName` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `pages` smallint(6) NOT NULL,
  `year` char(8) NOT NULL,
  `subjectId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacherdocs`
--

LOCK TABLES `teacherdocs` WRITE;
/*!40000 ALTER TABLE `teacherdocs` DISABLE KEYS */;
INSERT INTO `teacherdocs` VALUES (70,'Методичка Matlab',113,'http://torrent.kg/forum/download.php?id=357106','s','','s',12,'12',3),(72,'ТАУ',1,'ыфв','ads','','sad',12,'12',1),(73,'JS',1,'','js','5edce211dfe05.pdf','s',300,'2018',1),(74,'di',1,'ыфв','s','5edce25b07917.docx','s',300,'2018',2);
/*!40000 ALTER TABLE `teacherdocs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `authorId` int(11) unsigned NOT NULL,
  `text` text NOT NULL,
  `publicationDate` datetime NOT NULL,
  `sectionId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `patronymic` varchar(100) DEFAULT NULL,
  `roleId` tinyint(3) NOT NULL,
  `facultyId` int(10) unsigned NOT NULL,
  `departmentId` int(10) unsigned NOT NULL,
  `avatar_name` char(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `groupId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Batyr','test3@mail.ru','Жениш','Батырканов','Исакунович',1,1,1,'','$2y$10$vrF4bQ9qF/qx8fxSI5FqLe.XF5khnJZdcqXscf4Ud4TAOPhEfc/Ci',0),(2,'student','test2@mail.ru','','',NULL,2,1,1,NULL,'$2y$10$vrF4bQ9qF/qx8fxSI5FqLe.XF5khnJZdcqXscf4Ud4TAOPhEfc/Ci',0),(102,'admin','test@mail.ru1','','',NULL,3,0,0,'5ed38eaa89d5d.png','$2y$10$WC.zz00OG9au4CmpYmMFx.p.jZMxlFFxBVUdaWqLNtNfC6kSTkjTC',0),(103,'test','test@mail.ru','Том','',NULL,1,2,4,'5ec12764be36b.jpeg','$2y$10$JE56y.vAIo6ZNOMrh7N4xeeBqzzaCrgQXG/OnF3yH.Qy1sTtYZhie',0),(113,'Gulida','test5@mail.ru','Гулида','Кудакеева','Маданбековна',1,1,1,NULL,'$2y$10$Mh19YjKA2q4BsuoA2orjUuKsrQ38DfbckxH6iPlvrAuAeE4N1Tcx2',0),(117,'studentPI','zloy@mail.com','Томми','Вермиллион','Злобный',2,1,2,NULL,'$2y$10$418d.t8Nw9rPJVSTwfhatefK.EK6F8wg6NOpG6WXshxGkyKEyzTc2',2);
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

-- Dump completed on 2020-06-12 19:07:39
