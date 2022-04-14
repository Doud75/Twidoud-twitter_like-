CREATE DATABASE IF NOT EXISTS `db_twitter_doud` 
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

use db_twitter_doud;

CREATE TABLE IF NOT EXISTS `user` (
        `user_id` INT NOT NULL AUTO_INCREMENT,
        `mail` VARCHAR(255) NOT NULL,
        `mdp` VARCHAR(256) NOT NULL,
        `pseudo` VARCHAR(255),
        PRIMARY KEY (`user_id`)
    ) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `tweet` (
        `tweet_id` INT NOT NULL AUTO_INCREMENT,
        `pseudo` VARCHAR(255),
        `data` TEXT,
        `date` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `image` VARCHAR(255),
        `user_id` INT NOT NULL,
        PRIMARY KEY (`tweet_id`),
        FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
    ) ENGINE=InnoDB;