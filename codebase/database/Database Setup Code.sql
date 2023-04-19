#initial creation of database, drop is delete in this case, use states we're using it as the base database going forwards
# IMPORTANT: change database name to what the webserver gives you or comment the following 3 lines out if using on a webserver.
DROP DATABASE IF EXISTS `fractio3_dba`;
CREATE DATABASE `fractio3_dba`;
USE `fractio3_dba`;

#character sets
SET NAMES utf8mb4 ;
SET character_set_client = utf8mb4 ;

#creation of an actual table within the database, users is the database name
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
#Variable/column name/ids and rules
#NOT NULL
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_score` bigint,
  `password` varchar(50) NOT NULL,
  `digits` varchar(9),
  PRIMARY KEY (`user_id`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  
DROP TABLE IF EXISTS `fractions`;
CREATE TABLE `fractions` (
#Variable/column name/ids and rules
  `digits` varchar(9) PRIMARY KEY,
  `fraction` decimal(10,9) CHECK(fraction<1 && fraction>0),
  `divisor` int) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
