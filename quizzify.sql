-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: quizzify
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctor` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `FullName` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Education` varchar(200) DEFAULT NULL,
  `No_Exams` int DEFAULT '0',
  `Password` varchar(255) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `UserName` (`UserName`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (1,'mokk','mok mok','dsadas@gmail.com','Doctor','mok',0,'$2y$10$SPhnRCzkjhgfJGbA5.Y/tesqcdQBSw75sp66.kuhbHd8BZAfrVo9.','Avatar2.jpg'),(2,'mok1','mok mok','mok1@gmail.com','Doctor','mok1',0,'$2y$10$GwKRipEt3SdcbsgVMRg4rOV9tvdqP3LbrF1gVKpuHSuW/v1cicLIK','Avatar2.jpg'),(3,'mok1234','mok mok','mok16@gmail.com','Doctor','mokmok',0,'$2y$10$WcaFwqweNNFnNYLWGg1tEuRBNFdeKyZRg4W3p0e1fWFtp0pUtJ32G','Avatar3.avif'),(12,'mokmok1','mokmokm','mokmok12@gmail.com','Doctor','mokmok',0,'$2y$10$EiuZQBRUk1C6Qxt5oqsco.tq81Aw7CF9.DXvPoExCabTjE2rUdJzi','Avatar2.jpg'),(17,'mokmok213','mokmok','mokmok213@gmail.com','Doctor','Mokmok',0,'$2y$10$ZVMG6crhlJ3hLcZjUV.dBu3jIgFyVUI4nwzrIv0q1sb1FjPaIWa7.','Avatar3.avif'),(18,'seif1','seif seif','mok444@gmial.com','Doctor','mokmok',0,'$2y$10$VDZ44dsYj6lvAkkm821q5ebJfKmjUSBKey1tKZ2wsoUBc.g5Khje.','Avatar2.jpg'),(19,'Seif12','SEif Seiz','seif12@gmail.com','Doctor','Mokmok',0,'$2y$10$zEuuyhgK7FKQfSEO3nhuY.HLjC0EX5Z2lIX6eUG3yp1VvKN.JltAS','Avatar2.jpg');
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exam` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Subject` varchar(200) NOT NULL,
  `Grade` float DEFAULT '0',
  `Doctor_Id` int DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Doctor_Id` (`Doctor_Id`),
  CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`Doctor_Id`) REFERENCES `doctor` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam`
--

LOCK TABLES `exam` WRITE;
/*!40000 ALTER TABLE `exam` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Head` varchar(500) NOT NULL,
  `Body` text,
  `Answer` varchar(500) DEFAULT NULL,
  `Grade` float DEFAULT NULL,
  `Exam_Id` int DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Exam_Id` (`Exam_Id`),
  CONSTRAINT `question_ibfk_1` FOREIGN KEY (`Exam_Id`) REFERENCES `exam` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `FullName` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Role` varchar(50) DEFAULT NULL,
  `Education` varchar(200) DEFAULT NULL,
  `Score` float DEFAULT '0',
  `Password` varchar(255) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `UserName` (`UserName`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'mok12','mok mok','mok12@gmail.com','Student','mok12',0,'$2y$10$mwrwviGELovHi4MUmFMwFuNskzfgz52ePAfPXkTjG/phjcUXOpu6O','Avatar3.avif'),(2,'mokmok213','mokmok','mokmok12@gmail.com','Student','mokmok',0,'$2y$10$mgE7gDPftUCWycAlW3s9zeYGM11hLXsgg5FaW6qktPQTwzdLMJns6','Avatar3.avif');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_doctor`
--

DROP TABLE IF EXISTS `student_doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_doctor` (
  `Doctor_Id` int NOT NULL,
  `Student_Id` int NOT NULL,
  PRIMARY KEY (`Doctor_Id`,`Student_Id`),
  KEY `Student_Id` (`Student_Id`),
  CONSTRAINT `student_doctor_ibfk_1` FOREIGN KEY (`Doctor_Id`) REFERENCES `doctor` (`Id`),
  CONSTRAINT `student_doctor_ibfk_2` FOREIGN KEY (`Student_Id`) REFERENCES `student` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_doctor`
--

LOCK TABLES `student_doctor` WRITE;
/*!40000 ALTER TABLE `student_doctor` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_exam`
--

DROP TABLE IF EXISTS `student_exam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_exam` (
  `Student_Id` int NOT NULL,
  `Exam_Id` int NOT NULL,
  `Result` float DEFAULT NULL,
  PRIMARY KEY (`Student_Id`,`Exam_Id`),
  KEY `Exam_Id` (`Exam_Id`),
  CONSTRAINT `student_exam_ibfk_1` FOREIGN KEY (`Student_Id`) REFERENCES `student` (`Id`),
  CONSTRAINT `student_exam_ibfk_2` FOREIGN KEY (`Exam_Id`) REFERENCES `exam` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_exam`
--

LOCK TABLES `student_exam` WRITE;
/*!40000 ALTER TABLE `student_exam` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `UserName` (`UserName`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'mokk','dsadas@gmail.com','Doctor','$2y$10$SPhnRCzkjhgfJGbA5.Y/tesqcdQBSw75sp66.kuhbHd8BZAfrVo9.'),(2,'mok1','mok1@gmail.com','Doctor','$2y$10$GwKRipEt3SdcbsgVMRg4rOV9tvdqP3LbrF1gVKpuHSuW/v1cicLIK'),(3,'mok12','mok12@gmail.com','Student','$2y$10$mwrwviGELovHi4MUmFMwFuNskzfgz52ePAfPXkTjG/phjcUXOpu6O'),(4,'Seif12','seif12@gmail.com','Doctor','$2y$10$zEuuyhgK7FKQfSEO3nhuY.HLjC0EX5Z2lIX6eUG3yp1VvKN.JltAS'),(5,'mokmok213','mokmok12@gmail.com','Student','$2y$10$mgE7gDPftUCWycAlW3s9zeYGM11hLXsgg5FaW6qktPQTwzdLMJns6');
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

-- Dump completed on 2024-12-13 21:01:55
