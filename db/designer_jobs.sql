# SQL Manager Lite for MySQL 5.3.1.3
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : designer_jobs


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

SET FOREIGN_KEY_CHECKS=0;

DROP DATABASE IF EXISTS `designer_jobs`;

CREATE DATABASE `my_db`
    CHARACTER SET 'utf8'
    COLLATE 'utf8_general_ci';

USE `my_db`;

#
# Structure for the `roles` table : 
#

CREATE TABLE `roles` (
  `id` INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(32) COLLATE utf8_general_ci NOT NULL,
  `description` VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`id`) ,
  UNIQUE INDEX `uniq_name` USING BTREE (`name`) 
)ENGINE=InnoDB
AUTO_INCREMENT=3 AVG_ROW_LENGTH=8192 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `users` table : 
#

CREATE TABLE `users` (
  `id` INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(254) COLLATE utf8_general_ci NOT NULL,
  `username` VARCHAR(32) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` VARCHAR(64) COLLATE utf8_general_ci NOT NULL,
  `logins` INTEGER(10) UNSIGNED NOT NULL DEFAULT 0,
  `last_login` INTEGER(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`) ,
  UNIQUE INDEX `uniq_username` USING BTREE (`username`) ,
  UNIQUE INDEX `uniq_email` USING BTREE (`email`) 
)ENGINE=InnoDB
AUTO_INCREMENT=8 AVG_ROW_LENGTH=5461 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `roles_users` table : 
#

CREATE TABLE `roles_users` (
  `user_id` INTEGER(10) UNSIGNED NOT NULL,
  `role_id` INTEGER(10) UNSIGNED NOT NULL,
  PRIMARY KEY USING BTREE (`user_id`, `role_id`) ,
   INDEX `fk_role_id` USING BTREE (`role_id`) ,
  CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AVG_ROW_LENGTH=2730 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

# Structure for the `user_datas` table : 
#

CREATE TABLE `user_datas` (
  `id` INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INTEGER(11) UNSIGNED NOT NULL,
  `firstname` VARCHAR(30) COLLATE utf8_general_ci DEFAULT NULL,
  `lastname` VARCHAR(30) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`) ,
  UNIQUE INDEX `id` USING BTREE (`id`) ,
   INDEX `user_id` USING BTREE (`user_id`) ,
  CONSTRAINT `user_datas_fk1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=7 AVG_ROW_LENGTH=5461 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `user_tokens` table : 
#

CREATE TABLE `user_tokens` (
  `id` INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INTEGER(11) UNSIGNED NOT NULL,
  `user_agent` VARCHAR(40) COLLATE utf8_general_ci NOT NULL,
  `token` VARCHAR(40) COLLATE utf8_general_ci NOT NULL,
  `type` VARCHAR(100) COLLATE utf8_general_ci NOT NULL,
  `created` INTEGER(10) UNSIGNED NOT NULL,
  `expires` INTEGER(10) UNSIGNED NOT NULL,
  PRIMARY KEY USING BTREE (`id`) ,
  UNIQUE INDEX `uniq_token` USING BTREE (`token`) ,
   INDEX `fk_user_id` USING BTREE (`user_id`) ,
  CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Data for the `roles` table  (LIMIT -497,500)
#

INSERT INTO `roles` (`id`, `name`, `description`) VALUES

  (1,'login','Login privileges, granted after account confirmation'),
  (2,'admin','Administrative user, has access to everything.');
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
