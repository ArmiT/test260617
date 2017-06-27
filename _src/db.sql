-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema twins_practice
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema twins_practice
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `twins_practice` DEFAULT CHARACTER SET utf8 ;
USE `twins_practice` ;

-- -----------------------------------------------------
-- Table `twins_practice`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `twins_practice`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL COMMENT 'Имя',
  `mail` VARCHAR(255) NOT NULL COMMENT 'Почта',
  `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Время первого появления',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `mail_UNIQUE` (`mail` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `twins_practice`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `twins_practice`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `users_id` INT NOT NULL,
  `msg` VARCHAR(512) NOT NULL COMMENT 'Сообщение пользователя',
  `approved` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Статус',
  `timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Время добавления',
  PRIMARY KEY (`id`, `users_id`),
  INDEX `fk_comments_users_idx` (`users_id` ASC),
  CONSTRAINT `fk_comments_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `twins_practice`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
