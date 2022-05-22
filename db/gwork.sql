-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: group_one
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `group_members`
--

DROP TABLE IF EXISTS `group_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `class` text NOT NULL DEFAULT 'L6 IT Y2',
  `regno` varchar(10) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_members`
--

LOCK TABLES `group_members` WRITE;
/*!40000 ALTER TABLE `group_members` DISABLE KEYS */;
INSERT INTO `group_members` VALUES (40,20,'AKIMANA Leirbag','Gabriel','L6 IT Y2','20RP00932',20),(41,20,'TWAGIRAYESU','JMV','L6 IT Y2','20RP00ROE',22),(43,25,'AKIMANA Leirbag','Gabriel','L6 IT Y2','20RP00932',20),(44,27,'UWIHOREYE','Amina','L6 IT Y2','20RO347',21);
/*!40000 ALTER TABLE `group_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` varchar(90) NOT NULL,
  `vacc_code` varchar(30) NOT NULL,
  `regno` varchar(10) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `gender` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (20,'AKIMANA Leirbag','Gabriel','gabsonbill@yahoo.com','EXGMON4583','20RP00932','07825362','male','2022-05-02 19:55:32',20),(21,'UWIHOREYE','Amina','salima11@rdjfh.com','ECG0UFR7383','20RO347','08924362732','female','2022-05-02 19:56:12',20),(22,'TWAGIRAYESU','JMV','jmvsheke200@gmail.com','EXGMON4583','20RP00ROE','0781341752','male','2022-05-03 15:51:01',20),(23,'MPAYIMANA CYIZA','Landry','leibagdk','EXG00738UR-RO','20RP0089F','07823622736','female','2022-05-03 15:57:53',27);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `user_type` varchar(10) NOT NULL DEFAULT 'admin',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (20,'lambert','$2y$10$ptY3WIU1EbyiDqfPbvB4teuDCXLNXIc/xAUAFHYsPPo6qxz8avB1S','HARERIMANA','Lambert','guest',20,'2022-05-02 19:31:32'),(23,'salima','$2y$10$LV1Roh7MkYByaU.0CjkXUuPZLrTEa9KfAidvkPQhorN/O0IjVAaDW','UWIHOREYE','Amina','guest',20,'2022-05-02 19:56:28'),(25,'gtan','$2y$10$Cd5ovidheW3a7J.jzX8D.Oj/dkJT7OTxs/qwyqjPfnE/ctDs3XAq.','twagirayesu','jmv','guest',20,'2022-05-03 15:52:00'),(26,'salima','$2y$10$VTch..Xlkq7J0OfdT0rBKe5X79AFbry1zA4xL5N81S7ozxxzyV3Ca','UWIHOREYE','Amina','admin',25,'2022-05-03 15:54:00'),(27,'gaby','$2y$10$ZBTbg6tfYJxGfQwD4oHDjeJmqq16azpprNszbwMCc4kb4/WCzZDya','AKIMANA','Gabriel','admin',25,'2022-05-03 15:54:25'),(28,'salima','$2y$10$FxTqDRT8ditOPqRb3Wytje/rpL63C94I41NhuroejJVtcuYnHIPU6','UWIHOREYE','Amina','guest',27,'2022-05-03 16:00:37');
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

-- Dump completed on 2022-05-17 18:47:33
