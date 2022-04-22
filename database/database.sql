CREATE DATABASE IF NOT EXISTS `db_twitter_doud` 
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

use db_twitter_doud;

CREATE TABLE IF NOT EXISTS `user` (
        `user_id` INT NOT NULL AUTO_INCREMENT,
        `mail` VARCHAR(255) NOT NULL,
        `mdp` VARCHAR(256) NOT NULL,
        `pseudo` VARCHAR(255),
        `profil_picture` VARCHAR(255) DEFAULT "profile-default.jpeg",
        PRIMARY KEY (`user_id`)
    ) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `tweet` (
        `tweet_id` INT NOT NULL AUTO_INCREMENT,
        `pseudo` VARCHAR(255),
        `profil_picture` VARCHAR(255) DEFAULT "profile-default.jpeg",
        `data` TEXT,
        `date` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `image` VARCHAR(255),
        `like` BIGINT(20),
        `user_id` INT NOT NULL,
        PRIMARY KEY (`tweet_id`),
        FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `likes` (
        `like_id` INT NOT NULL AUTO_INCREMENT,
        `tweet_id` INT NOT NULL,
        `user_id` INT NOT NULL,
        PRIMARY KEY (`like_id`),
        FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE,
        FOREIGN KEY (`tweet_id`) REFERENCES `tweet`(`tweet_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB;