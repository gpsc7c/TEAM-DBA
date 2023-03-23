#initial creation of database, drop is delete in this case, use states we're using it as the base database going forwards
DROP DATABASE IF EXISTS `scoreboard_dba`;
CREATE DATABASE `scoreboard_dba`;
USE `scoreboard_dba`;

#character sets
SET NAMES utf8mb4 ;
SET character_set_client = utf8mb4 ;

#creation of an actual table within the database, users is the database name
CREATE TABLE `users` (
#Variable/column name/ids and rules
#NOT NULL
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_rank` int NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_score` bigint,
  `digits` bigint,
  #`time_set` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `fractions` (
#Variable/column name/ids and rules
#NOT NULL
  `digits` varchar(9),
  `fraction` decimal(10,9) CHECK(fraction>0) CHECK(fraction<1),
  `divisor` int, 
  PRIMARY KEY (`digits`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
