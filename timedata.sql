
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
DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `autor_id` bigint unsigned NOT NULL,
  `type_id` bigint unsigned NOT NULL,
  `item_id` bigint unsigned DEFAULT NULL,
  `week` smallint unsigned DEFAULT NULL,
  `year` smallint unsigned DEFAULT NULL,
  `isLocal` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (3,'YTP_2023-11-09_15-22.png','time_events/1/YTP_2023-11-09_15-22.png','2023-11-10 13:54:28','2023-11-10 13:54:28',1,3,1,NULL,NULL,1),(4,'qAK_Задание 3.Админка.png','teams/1/qAK_Задание 3.Админка.png','2023-11-10 13:55:48','2023-11-10 13:55:48',1,1,1,NULL,NULL,1),(7,'7s7_2023-11-09_15-22.png','users/3/7s7_2023-11-09_15-22.png','2023-11-11 11:46:10','2023-11-11 11:46:10',1,4,3,NULL,NULL,1),(8,'jjC_Контракт на разработку АИС ЛЮБА.doc','users/3/jjC_Контракт на разработку АИС ЛЮБА.doc','2023-11-11 11:46:45','2023-11-11 11:46:45',1,4,3,NULL,NULL,1),(9,'phpmyadmin','http://localhost/phpmyadmin/index.php?route=/sql&server=1&db=timedata&table=model_types&pos=0','2023-11-11 11:49:06','2023-11-11 11:49:06',1,3,5,NULL,NULL,0),(11,'YzA_wget-log','teams/5/YzA_wget-log','2023-11-11 11:52:03','2023-11-11 11:52:03',1,1,5,NULL,NULL,1),(12,'EOO_Тестовое задание Сервер.pdf','time_events/6/EOO_Тестовое задание Сервер.pdf','2023-11-11 11:53:30','2023-11-11 11:53:30',1,3,6,NULL,NULL,1),(13,'0vB_Тестовое задание Сервер.pdf','users/2/0vB_Тестовое задание Сервер.pdf','2023-11-11 11:54:11','2023-11-11 11:54:11',1,4,2,NULL,NULL,1),(14,'ype_Схема БД.png','time_events/5/ype_Схема БД.png','2023-11-12 02:34:16','2023-11-12 02:34:16',1,3,5,NULL,NULL,1),(15,'7z8_2023-11-09_15-22.png','users/6/7z8_2023-11-09_15-22.png','2023-11-12 06:59:46','2023-11-12 06:59:46',1,4,6,NULL,NULL,1),(16,'VvC_Тестовое задание Сервер.pdf','users/6/VvC_Тестовое задание Сервер.pdf','2023-11-12 07:00:00','2023-11-12 07:00:00',1,4,6,NULL,NULL,1),(18,'pBe_2022-12-15_16-42.png','teams/3/pBe_2022-12-15_16-42.png','2023-11-21 16:20:18','2023-11-21 16:20:18',1,1,3,NULL,NULL,1),(19,'09H_Тестовое задание Сервер.pdf','teams/3/09H_Тестовое задание Сервер.pdf','2023-11-21 16:20:48','2023-11-21 16:20:48',1,1,3,NULL,NULL,1),(20,'9e8_wget-log','time_events/76/9e8_wget-log','2023-11-21 16:50:46','2023-11-21 16:50:46',1,3,76,NULL,NULL,1),(24,'7kQ_Задание 3.Админка.png','time_events/58/7kQ_Задание 3.Админка.png','2023-11-21 16:56:31','2023-11-21 16:56:31',1,3,58,NULL,NULL,1),(25,'OQa_Контракт на разработку АИС ЛЮБА.doc','time_events/75/OQa_Контракт на разработку АИС ЛЮБА.doc','2023-11-21 16:59:00','2023-11-21 16:59:00',1,3,75,NULL,NULL,1),(27,'V3X_wget-log','teams/14/V3X_wget-log','2023-11-21 17:01:18','2023-11-21 17:01:18',1,1,14,NULL,NULL,1);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `information` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `autor_id` bigint unsigned NOT NULL,
  `type_id` bigint unsigned NOT NULL,
  `item_id` bigint unsigned DEFAULT NULL,
  `week` smallint unsigned DEFAULT NULL,
  `year` smallint unsigned DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `information` WRITE;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
INSERT INTO `information` VALUES (8,0,1,1,3,NULL,NULL,'Продумать удаление пользователя','2023-09-23 13:19:08','2023-09-23 13:19:08'),(14,0,1,1,5,NULL,NULL,'Примерно так всё будет выглядеть\nЕщё допиливаю загрузку файлов и штампую на неделю и все прочие сущности','2023-09-24 06:06:54','2023-09-24 06:06:54'),(26,0,1,1,1,NULL,NULL,'\n        Странно - но не все файлы загружаются.&nbsp;<div>Или загружаются через ошибку на linux\n    </div>','2023-10-04 11:52:19','2023-11-23 02:26:17'),(27,0,1,3,26,NULL,NULL,'Д31.pdf не грузится\n','2023-10-04 11:54:47','2023-10-04 11:54:47'),(29,0,1,3,26,NULL,NULL,'Сообщение об ошибке при загрузке файла ????','2023-10-04 11:56:00','2023-10-04 11:56:00'),(34,0,1,5,NULL,41,2023,'dfghsfghdfghdfghdfgh','2023-10-09 10:54:41','2023-10-09 10:54:41'),(35,0,1,5,NULL,41,2023,'dsfgsdfgsdfg\nsdfg\nsdf\ngsd\nfgsd\nfg','2023-10-09 10:54:50','2023-10-09 10:54:50'),(42,0,1,3,28,NULL,NULL,'Выполнено','2023-10-16 07:43:46','2023-10-16 07:43:46'),(43,0,1,3,33,NULL,NULL,'Выполнено','2023-10-16 07:44:39','2023-10-16 07:44:39'),(44,0,1,3,22,NULL,NULL,'Выполнено','2023-10-16 07:44:51','2023-10-16 07:44:51'),(49,0,1,3,53,NULL,NULL,'при добавлении нового события','2023-10-16 07:58:49','2023-10-16 07:58:49'),(51,0,1,3,57,NULL,NULL,'Сделано. database-migration','2023-10-17 12:54:11','2023-10-17 12:54:11'),(52,0,1,3,58,NULL,NULL,'Пока через экспорт-импорт в sql.zip','2023-10-17 13:25:20','2023-10-17 13:25:20'),(54,0,1,5,NULL,42,2023,'Адаптивный вид недельных заметок.','2023-10-18 05:55:15','2023-10-18 05:55:15'),(56,0,1,3,32,NULL,NULL,'Выполнено','2023-10-19 04:55:39','2023-10-19 04:55:39'),(57,0,1,3,53,NULL,NULL,'Пока сделано. + 1 час для end (нового или меньшего start)','2023-10-19 05:29:31','2023-10-19 05:29:31'),(58,0,1,3,31,NULL,NULL,'Добавлен каркас. + user-edit','2023-10-19 09:00:32','2023-10-19 09:00:32'),(59,0,1,3,62,NULL,NULL,'Добавлено редактирование и файлы','2023-10-31 08:22:17','2023-10-31 08:22:17'),(60,0,1,4,10,NULL,NULL,'sxdfhsdfhgsdfh','2023-11-08 04:16:06','2023-11-08 04:16:06'),(63,0,1,4,10,NULL,NULL,'zdfgsdfgsdfgsd','2023-11-08 04:16:18','2023-11-08 04:16:18'),(64,0,1,4,10,NULL,NULL,'asdasd\nas\ndas\ndas\nd','2023-11-08 05:45:16','2023-11-08 05:45:16'),(65,0,1,3,63,NULL,NULL,'Add Notes','2023-11-08 05:47:31','2023-11-08 05:47:31'),(66,0,1,3,65,NULL,NULL,'Есть место внизу с ?????.\nЕсли что убрать.','2023-11-09 07:23:53','2023-11-09 07:23:53'),(67,0,1,4,2,NULL,NULL,'негукегукег гкунрке\n ке\nр ке\nунр\nавер','2023-11-10 14:59:53','2023-11-10 14:59:53'),(72,0,1,3,60,NULL,NULL,'Сделано','2023-11-16 09:02:24','2023-11-16 09:02:24'),(74,0,1,3,66,NULL,NULL,'??? tooltip события на неделе показывает минус, если из группы удален участник ???','2023-11-17 14:06:58','2023-11-17 14:06:58'),(75,0,1,5,NULL,46,2023,'Добавлено две заметки','2023-11-17 14:42:56','2023-11-17 14:42:56'),(84,0,1,3,72,NULL,NULL,'Компонент добавлен.','2023-11-18 11:11:28','2023-11-18 11:11:28'),(85,0,1,3,75,NULL,NULL,'Сделано','2023-11-20 14:15:37','2023-11-20 14:15:37'),(86,0,1,1,3,NULL,NULL,'erytwertwertwet','2023-11-21 16:20:00','2023-11-21 16:20:00'),(87,0,1,1,3,NULL,NULL,'wergtwertwert','2023-11-21 16:20:03','2023-11-21 16:20:03'),(88,0,1,1,3,NULL,NULL,'\n        awegtwsd<div>sdfhgsdfgsd345345345</div><div>fasdfas\n    </div>','2023-11-21 16:21:15','2023-11-21 16:21:33'),(90,0,1,5,NULL,47,2023,'Презентация проведена','2023-11-21 16:28:29','2023-11-21 16:28:29'),(91,0,1,3,67,NULL,NULL,'Готово','2023-11-21 16:30:37','2023-11-21 16:30:37'),(93,0,1,4,1,NULL,NULL,'hmgfhkgf,jlkh','2023-11-21 16:45:53','2023-11-21 16:45:53'),(96,0,1,3,58,NULL,NULL,'mysqldump','2023-11-23 02:25:57','2023-11-23 02:25:57'),(97,0,1,3,61,NULL,NULL,'Из групп перенести в остальные модели.','2023-11-23 02:35:44','2023-11-23 02:35:44');
/*!40000 ALTER TABLE `information` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `operation_id` bigint unsigned NOT NULL,
  `autor_id` bigint unsigned NOT NULL,
  `model_type_id` bigint unsigned NOT NULL,
  `model_item_id` bigint unsigned DEFAULT NULL,
  `week` smallint unsigned DEFAULT NULL,
  `year` smallint unsigned DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,3,0,3,2,0,0,'Удалено событе 2 Второе занятие','2023-11-10 13:55:22','2023-11-10 13:55:22'),(2,3,0,3,3,0,0,'Удалено событе 3 Без темы','2023-11-10 15:19:18','2023-11-10 15:19:18'),(3,3,0,1,2,0,0,'Удалена группа cfhgjghj','2023-11-11 11:32:47','2023-11-11 11:32:47'),(4,3,0,1,4,0,0,'Удалена группа zdfhzsdfgsdfg','2023-11-11 11:44:59','2023-11-11 11:44:59'),(5,3,0,3,4,0,0,'Удалено событе 4 sdfbgsdfgsdfg','2023-11-11 11:45:02','2023-11-11 11:45:02'),(6,3,0,1,3,0,0,'Удалена группа sadgfasdfgasdfg','2023-11-11 11:45:02','2023-11-11 11:45:02'),(7,3,0,1,6,0,0,'Удалена группа 3rwerterw','2023-11-12 02:34:45','2023-11-12 02:34:45'),(8,3,0,1,7,0,0,'Удалена группа 45354345','2023-11-12 06:58:20','2023-11-12 06:58:20'),(9,3,0,4,7,0,0,'Удален пользователь 7 Тест удаления (Test udaleniya@6555cd3289cc7)','2023-11-16 08:52:37','2023-11-16 08:52:37'),(10,3,0,3,68,0,0,'Удалено событе 68 Без темы','2023-11-17 14:16:41','2023-11-17 14:16:41'),(11,3,0,3,69,0,0,'Удалено событе 69 Без темы','2023-11-17 14:20:34','2023-11-17 14:20:34'),(12,3,0,3,70,0,0,'Удалено событе 70 Без темы','2023-11-17 15:03:05','2023-11-17 15:03:05'),(13,3,0,3,71,0,0,'Удалено событе 71 Без темы','2023-11-17 15:04:12','2023-11-17 15:04:12'),(14,3,0,1,13,0,0,'Удалена группа Немецкий','2023-11-18 06:42:13','2023-11-18 06:42:13'),(15,3,0,3,77,0,0,'Удалено событе 77 Без темы','2023-11-23 02:33:16','2023-11-23 02:33:16');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `color_id` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'Задание на разработку','Тестирование возможностей',13,'2023-09-22 10:44:54','2023-09-30 08:33:03'),(3,'Удаление элементов','Тестирование удаления элементов',19,'2023-09-23 13:18:32','2023-10-17 13:18:23'),(5,'Английский','по восресеньям',9,'2023-09-24 06:04:54','2023-09-24 06:05:51'),(11,'TEST','Тест интерфейсов',5,'2023-10-15 07:47:37','2023-11-21 16:32:59'),(14,'Базовые компоненты','baseComponentsLw3',7,'2023-11-18 06:41:58','2023-11-18 06:42:30'),(15,'Figma',NULL,21,'2023-11-21 16:49:35','2023-11-21 16:49:35');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `teams_before_delete` BEFORE DELETE ON `teams` FOR EACH ROW BEGIN

DELETE FROM team_users WHERE team_users.team_id = OLD.id;

DELETE FROM time_events WHERE time_events.team_id = OLD.id;

DELETE FROM information WHERE (information.item_id = OLD.id AND information.type_id = 1);

DELETE FROM files WHERE (files.item_id = OLD.id AND files.type_id = 1);

SET @p0='DELETE'; SET @p1='teams'; SET @p2='0'; SET @p3=OLD.id; SET @p4='0'; SET @p5='0'; SET @p6=CONCAT('Удалена группа ',OLD.NAME); 

CALL `sendNotification`(@p0, @p1, @p2, @p3, @p4, @p5, @p6);

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
DROP TABLE IF EXISTS `team_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `team_users` WRITE;
/*!40000 ALTER TABLE `team_users` DISABLE KEYS */;
INSERT INTO `team_users` VALUES (2,1,3),(12,5,10),(13,5,3),(17,1,1),(23,3,1),(24,11,1),(26,11,9),(27,3,9),(28,14,1),(29,14,9),(30,15,6),(31,15,2);
/*!40000 ALTER TABLE `team_users` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `time_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `time_events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `day` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `team_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `time_events` WRITE;
/*!40000 ALTER TABLE `time_events` DISABLE KEYS */;
INSERT INTO `time_events` VALUES (22,'2023-10-01','16:30:00','17:30:00',1,1,'2023-09-29 14:07:21','2023-10-01 02:39:16','Каркас управления событиями'),(28,'2023-10-16','13:00:00','15:00:00',1,1,'2023-10-04 11:58:55','2023-10-16 07:50:58','Удаление событий'),(31,'2023-10-19','17:00:00','18:40:00',1,1,'2023-10-06 10:40:51','2023-10-18 05:52:58','Управление участником'),(32,'2023-10-18','17:00:00','18:00:00',1,1,'2023-10-06 10:41:27','2023-10-17 14:06:41','Статистика по элементам. Неделя'),(33,'2023-10-07','17:00:00','18:00:00',1,1,'2023-10-06 11:21:27','2023-10-06 11:21:27','Недельные заметки'),(34,'2023-11-27','18:00:00','19:00:00',1,1,'2023-10-06 11:26:00','2023-11-23 02:31:37','Фин. учет.'),(35,'2023-11-24','17:00:00','18:00:00',1,1,'2023-10-09 10:16:14','2023-11-23 02:30:42','Фильтр по Группе. (Список занятий, месяц, неделя (?))'),(53,'2023-10-19','14:58:00','15:58:00',11,1,'2023-10-16 06:59:04','2023-10-18 08:18:33','Автоматическое выставление времени'),(57,'2023-10-17','16:15:00','17:15:00',3,1,'2023-10-16 08:16:06','2023-10-17 11:56:23','Создание триггеров через laravel'),(58,'2023-11-23','16:00:00','17:00:00',11,1,'2023-10-16 08:17:39','2023-11-23 02:26:43','Синхронизация баз данных через laravel'),(60,'2023-11-16','17:00:00','18:00:00',3,1,'2023-10-17 14:06:02','2023-11-08 05:49:00','Удаление пользователя. Триггер + файлы +сообщение'),(61,'2023-11-21','16:00:00','17:00:00',11,1,'2023-10-19 04:55:16','2023-11-20 14:15:56','Редактирование заметок'),(62,'2023-10-31','10:00:00','16:00:00',1,1,'2023-10-19 09:02:15','2023-10-31 03:00:46','Info.User Доработка'),(63,'2023-11-08','11:00:00','16:00:00',1,1,'2023-10-31 08:24:45','2023-11-08 05:47:18','Info.User Доработка'),(64,'2023-11-24','11:00:00','15:00:00',1,1,'2023-10-31 08:26:23','2023-11-23 02:29:32','Копирование (тиражирование) события'),(65,'2023-11-09','12:00:00','16:00:00',1,1,'2023-11-09 07:21:56','2023-11-09 07:21:56','Info.User. Teams & UpcomingEvents'),(66,'2023-11-17','10:00:00','17:00:00',1,1,'2023-11-09 07:25:23','2023-11-17 13:54:52','WeekTable. Статистика за неделю'),(67,'2023-11-21','18:00:00','19:00:00',3,1,'2023-11-16 08:09:41','2023-11-20 14:18:35','Удаление группы. Триггер + файлы + сообщение'),(72,'2023-11-18','15:00:00','16:00:00',14,1,'2023-11-18 06:43:50','2023-11-18 06:43:50','x-tooltip.absolute-bottom'),(73,'2023-11-24','16:00:00','17:00:00',1,1,'2023-11-18 06:47:40','2023-11-23 02:27:43','Info.User Добавить кнопку добавления в группу без перехода на страницу группы.'),(74,'2023-11-23','10:00:00','15:00:00',14,1,'2023-11-20 14:14:20','2023-11-23 02:25:13','z-index sidebar.right & mx null'),(75,'2023-11-20','10:00:00','15:00:00',14,1,'2023-11-20 14:15:14','2023-11-20 14:15:14','add input-div-editable'),(76,'2023-11-25','12:00:00','13:00:00',15,1,'2023-11-21 16:50:06','2023-11-21 16:50:37','Адаптивность'),(78,'2023-11-24','10:00:00','11:00:00',1,1,'2023-11-23 02:38:20','2023-11-23 02:38:20','Info.Event Добавить переходы на табличные виды после кнопок Edit/del');
/*!40000 ALTER TABLE `time_events` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `before_delete_event` BEFORE DELETE ON `time_events` FOR EACH ROW BEGIN
    DELETE FROM information WHERE (information.item_id = OLD.id AND information.type_id = 3);

    DELETE FROM files WHERE (files.item_id = OLD.id AND files.type_id = 3);

    SET @p0='DELETE'; SET @p1='time_events'; SET @p2='0'; SET @p3=OLD.id; SET @p4='0'; SET @p5='0'; SET @p6=CONCAT('Удалено событе ',OLD.id,' ',coalesce(OLD.title,'Без темы')); 

    CALL `sendNotification`(@p0, @p1, @p2, @p3, @p4, @p5, @p6);
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patronymic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Сергей','eonvse@ya.ru',NULL,'$2y$10$CNdGO6yxgKcFG1/Tkwu15eFgDcg1oZw/yJUfzdfEmaz93ouWqCwN.',NULL,'2023-09-09 05:35:46','2023-09-09 09:04:38','Волков','Евгеньевич','1982-04-02'),(2,'546456','test@local',NULL,'$2y$10$R6Z7v116uTj2J6XJCtzh3.KNyda9K1cpVq8Oi/wOIBaWgTP6NDNDK',NULL,'2023-09-09 06:58:53','2023-11-08 03:36:19','sdfgsdfgsdfgsdfg','sdfgsdfasdfsdf','1983-10-31'),(3,'Пользователь Один','emty@local',NULL,'$2y$10$e1XOWX0GhvG87NSHOW8THeyDDu4/HJAt8ESKT/Dr6pjcPUgTLtraq',NULL,'2023-09-11 07:27:42','2023-09-24 06:04:13','Тестовый',NULL,NULL),(6,'вапвапвап','vapvapvap@local',NULL,'$2y$10$6GNsLpfhOrsTRKHPawFOHOrJJglbRmaFAAmF6GyhkzUMNOwGN.o1C',NULL,'2023-09-11 07:44:55','2023-09-11 07:44:55',NULL,NULL,NULL),(7,'ывапыва','yvapyva@local',NULL,'$2y$10$aE99KrUnVt2ny/R45L7SceVsjpSy1L/fkv2OoedGsnGjzWKBtaBSe',NULL,'2023-09-11 07:45:23','2023-09-11 07:45:23','аиывап','ывапва','2023-09-11'),(8,'Дмитрий','Dmitriy@64fec6a01128e',NULL,'$2y$10$giTAojwfWF/.A9A9jKlQOOL.Gz1B1F1ratW/eMywLN8eR0Pgtc2u6',NULL,'2023-09-11 07:49:52','2023-09-22 10:51:53','Волков ','Сергеевич','2023-09-22'),(9,'Пользователь','Polzovatel@650ee55b2bcec',NULL,'$2y$10$U0WyPZ.MwK1L4RF/76zqa.0NnGLeoiAsgCTVWh8ocRexURL1Ti4Va',NULL,'2023-09-23 13:17:15','2023-09-23 13:17:50','Тестовый','Patronymic','1996-12-07'),(10,'Пользователь Два','Polzovatel@650fcfce39189',NULL,'$2y$10$4.pMY1RS4Mc.BXUB7tx4gO/pSmF8g00d5wVGpjqN.NjAkKaIrtGFW',NULL,'2023-09-24 05:57:34','2023-09-24 06:04:24','Тестовый',NULL,'2023-09-24'),(11,'проверка','proverka@6517ebc79d84d',NULL,'$2y$10$eApwOPBP2tJkY4WRpaKwUeX/tQuCwCw66rWsIIF4kIW/Poyu7LHym',NULL,'2023-09-30 09:35:03','2023-09-30 09:35:03','триггер',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `addNullVisitNewUser` AFTER INSERT ON `users` FOR EACH ROW insert into visits (user_id, timeEvent_id, autor_id) VALUES(NEW.id,0,0) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
DROP TABLE IF EXISTS `visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `timeEvent_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `autor_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `visits` WRITE;
/*!40000 ALTER TABLE `visits` DISABLE KEYS */;
INSERT INTO `visits` VALUES (2,10,3,1,'2023-09-30 09:24:53','2023-09-30 09:24:53'),(3,0,3,1,'2023-09-30 09:27:33','2023-09-30 09:27:33'),(5,0,11,0,NULL,NULL),(6,0,1,0,'2023-09-30 11:51:44','2023-09-30 11:51:44'),(7,0,2,0,'2023-09-30 11:55:00','2023-09-30 11:55:00'),(8,0,5,0,'2023-09-30 11:55:00','2023-09-30 11:55:00'),(9,0,6,0,'2023-09-30 11:55:00','2023-09-30 11:55:00'),(10,0,7,0,'2023-09-30 11:55:00','2023-09-30 11:55:00'),(11,0,8,0,'2023-09-30 11:55:00','2023-09-30 11:55:00'),(12,0,9,0,'2023-09-30 11:55:00','2023-09-30 11:55:00'),(13,0,10,0,'2023-09-30 11:55:00','2023-09-30 11:55:00'),(20,11,8,1,'2023-10-01 05:35:53','2023-10-01 05:35:53'),(22,25,8,1,'2023-10-01 07:54:37','2023-10-01 07:54:37'),(23,25,3,1,'2023-10-01 07:54:38','2023-10-01 07:54:38'),(24,22,2,1,'2023-10-01 07:54:44','2023-10-01 07:54:44'),(26,26,1,1,'2023-10-04 11:57:02','2023-10-04 11:57:02'),(27,20,9,1,'2023-10-06 10:35:57','2023-10-06 10:35:57'),(28,23,9,1,'2023-10-06 10:36:51','2023-10-06 10:36:51'),(30,29,1,1,'2023-10-06 10:38:39','2023-10-06 10:38:39'),(31,11,2,1,'2023-10-06 11:09:57','2023-10-06 11:09:57'),(32,11,1,1,'2023-10-06 11:09:58','2023-10-06 11:09:58'),(33,11,3,1,'2023-10-06 11:09:58','2023-10-06 11:09:58'),(34,27,1,1,'2023-10-06 11:10:15','2023-10-06 11:10:15'),(35,27,3,1,'2023-10-06 11:10:15','2023-10-06 11:10:15'),(36,27,2,1,'2023-10-06 11:10:17','2023-10-06 11:10:17'),(37,10,1,1,'2023-10-06 11:10:31','2023-10-06 11:10:31'),(38,10,2,1,'2023-10-06 11:10:32','2023-10-06 11:10:32'),(39,22,1,1,'2023-10-06 11:10:35','2023-10-06 11:10:35'),(40,22,3,1,'2023-10-06 11:10:36','2023-10-06 11:10:36'),(42,33,2,1,'2023-10-06 11:21:31','2023-10-06 11:21:31'),(43,28,2,1,'2023-10-09 10:09:00','2023-10-09 10:09:00'),(44,33,1,1,'2023-10-10 01:36:09','2023-10-10 01:36:09'),(45,33,3,1,'2023-10-10 01:36:09','2023-10-10 01:36:09'),(46,29,2,1,'2023-10-10 01:36:17','2023-10-10 01:36:17'),(48,37,2,1,'2023-10-15 07:22:21','2023-10-15 07:22:21'),(49,37,5,1,'2023-10-15 07:22:21','2023-10-15 07:22:21'),(50,52,2,1,'2023-10-16 07:06:59','2023-10-16 07:06:59'),(51,28,1,1,'2023-10-16 07:13:31','2023-10-16 07:13:31'),(52,28,3,1,'2023-10-16 07:13:31','2023-10-16 07:13:31'),(53,32,2,1,'2023-10-16 07:53:37','2023-10-16 07:53:37'),(54,57,2,1,'2023-10-17 11:56:25','2023-10-17 11:56:25'),(55,57,1,1,'2023-10-17 12:53:38','2023-10-17 12:53:38'),(56,32,3,1,'2023-10-17 12:54:50','2023-10-17 12:54:50'),(57,32,1,1,'2023-10-19 04:55:32','2023-10-19 04:55:32'),(58,53,2,1,'2023-10-19 05:28:50','2023-10-19 05:28:50'),(59,31,2,1,'2023-10-19 08:59:50','2023-10-19 08:59:50'),(60,31,1,1,'2023-10-19 09:01:19','2023-10-19 09:01:19'),(61,31,3,1,'2023-10-19 09:01:21','2023-10-19 09:01:21'),(62,62,1,1,'2023-10-31 08:21:21','2023-10-31 08:21:21'),(63,62,3,1,'2023-10-31 08:21:22','2023-10-31 08:21:22'),(64,65,3,1,'2023-11-09 07:22:04','2023-11-09 07:22:04'),(65,65,1,1,'2023-11-09 07:23:59','2023-11-09 07:23:59'),(66,63,1,1,'2023-11-09 07:24:09','2023-11-09 07:24:09'),(67,63,3,1,'2023-11-09 07:24:09','2023-11-09 07:24:09'),(69,53,1,1,'2023-11-13 13:54:29','2023-11-13 13:54:29'),(70,53,9,1,'2023-11-13 13:54:29','2023-11-13 13:54:29'),(71,58,9,1,'2023-11-13 13:54:41','2023-11-13 13:54:41'),(72,61,9,1,'2023-11-13 13:54:45','2023-11-13 13:54:45'),(73,60,1,1,'2023-11-16 08:54:41','2023-11-16 08:54:41'),(74,60,9,1,'2023-11-16 08:54:42','2023-11-16 08:54:42'),(76,66,3,1,'2023-11-17 14:01:48','2023-11-17 14:01:48'),(77,70,1,1,'2023-11-17 14:44:06','2023-11-17 14:44:06'),(78,70,9,1,'2023-11-17 14:44:07','2023-11-17 14:44:07'),(79,71,1,1,'2023-11-17 15:03:51','2023-11-17 15:03:51'),(80,71,9,1,'2023-11-17 15:04:04','2023-11-17 15:04:04'),(84,72,9,1,'2023-11-18 11:10:09','2023-11-18 11:10:09'),(85,72,1,1,'2023-11-18 11:10:10','2023-11-18 11:10:10'),(86,75,1,1,'2023-11-20 14:15:19','2023-11-20 14:15:19'),(87,75,9,1,'2023-11-20 14:15:20','2023-11-20 14:15:20'),(89,67,1,1,'2023-11-21 16:30:30','2023-11-21 16:30:30'),(90,67,9,1,'2023-11-21 16:30:31','2023-11-21 16:30:31'),(91,66,1,1,'2023-11-21 17:12:43','2023-11-21 17:12:43');
/*!40000 ALTER TABLE `visits` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

