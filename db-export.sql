-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: pwebpj_dev
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20201018101058','2020-11-13 17:54:36',47),('DoctrineMigrations\\Version20201019063038','2020-11-13 17:54:36',14),('DoctrineMigrations\\Version20201019070015','2020-11-13 17:54:36',12),('DoctrineMigrations\\Version20201031135356','2020-11-13 17:54:36',18),('DoctrineMigrations\\Version20201113070334','2020-11-13 17:54:36',11),('DoctrineMigrations\\Version20201113165116','2020-11-13 17:54:36',58);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_entreprise` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jean@jean.fr','[]','$argon2id$v=19$m=65536,t=4,p=1$OASKdL0AGBlE3pg0ecaZ6w$NspXe6ZPZkqeRtoP3AYMr1TYmMr5xb2v6ETp/J8qb7w','Tuxedo Corp'),(2,'anicet@nougaret.fr','[]','$argon2id$v=19$m=65536,t=4,p=1$gdR4aTy/lXzQlTINio7a4g$nnWGdvlek56heGMfX2yHAdw4NT0t2l91DKhUu95oNUQ','Best Cars ltd'),(3,'eee@eee.ee','[]','$argon2id$v=19$m=65536,t=4,p=1$dKKh0KU0J3enpSS5NI3LMg$g65+xAXQdS3Jp8sTkdV7Jpj8HAeWkQO0ezRrewa29Bo','-E- vehicles'),(4,'hubert@gmail.tx','[]','$argon2id$v=19$m=65536,t=4,p=1$kpu1OaVz5Hf2nErcWXqKcA$hBShPs5qf2Qga2wmJtD2fsjyDpi7LdML6Z4IMEWaTSM','Hubert Corp'),(5,'anicet.nougaret@etu.u-paris.fr','[]','$argon2id$v=19$m=65536,t=4,p=1$zyjDqG6aG5JOkFBh100bkQ$UYWWWQXJnVNuQMF8oe23VrwpVEEaj77L4c8wi40PQkc','Mon Entreprise');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL,
  `characs_json` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_status` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1FCE69FAA76ED395` (`user_id`),
  CONSTRAINT `FK_1FCE69FAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,'Papamobil Mama mia',64,'{\r\n	\"weight\": 45,\r\n	\"brand\":\"Toyota\",\r\n	\"year\": 2004,\r\n	\"country\":\"ITALIA\"\r\n}','available','5d96733df1db3-papa-mobile-1158531-5faef4c7e9989453562905.jpg','2020-11-13 22:04:07',1),(2,'Fast Papamobil',1,'{\r\n	\"how fast?\":\"very fast\",\r\n	\"price\":\"1,980,917€\",\r\n	\"why this expensive?\":\"The pope used it\",\r\n	\"year\":2002\r\n}','unavailable','774533-71825539066-840212-5faef656a7839188740640.jpg','2020-11-13 22:10:46',2),(3,'Papamobil spicy',0,'{\r\n	\"rarity\":\"epic\",\r\n	\"format\":\"xxl\",\r\n	\"phone\":\"+459197101723\"\r\n}','unavailable','938827-5faef6afa131b037681195.webp','2020-11-13 22:12:15',2),(4,'Subaru forester',76,'{\r\n	\"how flat?\":\"very flat\"\r\n}','available','maxresdefault-5faef7127ce3e374250733.jpg','2020-11-13 22:13:54',3),(5,'Smoll Skrügr',0,'{\r\n	\"how smoll?\":\"very smoll\",\r\n	\"country\":\"sweden\"\r\n}','unavailable','images-5faef74acf07d303644616.jpeg','2020-11-13 22:14:50',3),(6,'Renault Alpine',31,'{\r\n	\"Fun fact\":\"Very cool\",\r\n	\"color\":\"blue\"\r\n}','available','renault-alpine-a310-00-5faef785efa29377817100.jpg','2020-11-13 22:15:49',3),(7,'Qebec Car',183917120,'{\r\n	\"How many?\":\"Too many\"\r\n}','available','screen-shot-2013-05-24-at-11-57.17-5faef7eb66ac8172570647.png','2020-11-13 22:17:31',4),(8,'Idk whose car it is but buy it anyway',1,'{}','available','img-0385-5faef81714474967578049.jpg','2020-11-13 22:18:15',4);
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-13 23:17:11
