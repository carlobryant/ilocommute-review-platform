CREATE DATABASE IF NOT EXISTS `ilocommute`;
USE `ilocommute`;

CREATE TABLE `user` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(40) NOT NULL,
    `password` VARCHAR(40) NOT NULL,
    `email` NVARCHAR(255) NOT NULL,
    `access` VARCHAR(10) NOT NULL
);

CREATE TABLE `person` (
    `user-id` INT,
    `fname` VARCHAR(40) NOT NULL,
    `lname` VARCHAR(40) NOT NULL,
    `age` INT NOT NULL,
    `gender` CHAR(1),
    `type` VARCHAR(15) NOT NULL,
    `id-url` NVARCHAR(2000),
    FOREIGN KEY(`user-id`) REFERENCES user(`id`)
);

CREATE TABLE `driver` (
    `person-id` INT,
    `plate-no` VARCHAR(5) NOT NULL,
    `brgy` VARCHAR(5) NOT NULL,
    `city` VARCHAR(5) NOT NULL,
    FOREIGN KEY(`person-id`) REFERENCES person(`id`)
);

CREATE TABLE `review` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user-id` INT,
    `rating` INT NOT NULL,
    `comment` TEXT NOT NULL,
    `id-url` NVARCHAR(2000),
    FOREIGN KEY(`user-id`) REFERENCES user(`id`)
);