-- MySQL Script generated by MySQL Workbench
-- 05/25/14 03:56:37
-- Model: New Model    Version: 1.0
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema comments
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `comments` ;
CREATE SCHEMA IF NOT EXISTS `comments` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `comments` ;

-- -----------------------------------------------------
-- Table `comments`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comments`.`comments` ;

CREATE TABLE IF NOT EXISTS `comments`.`comments` (
  `commentID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(50) NULL,
  `comment` TEXT NULL,
  PRIMARY KEY (`commentID`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
