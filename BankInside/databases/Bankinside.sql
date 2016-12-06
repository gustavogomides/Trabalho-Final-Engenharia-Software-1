-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema bankinside
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bankinside
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bankinside` DEFAULT CHARACTER SET utf8 ;
USE `bankinside` ;

-- -----------------------------------------------------
-- Table `bankinside`.`bnk_user`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `bankinside`.`bnk_user` (
  `id_user` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(30) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` CHAR(128) NOT NULL,
  `salt` CHAR(128) NOT NULL,
  `role` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_user`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB;

INSERT INTO `bnk_user` (`id_user`, `username`, `email`, `password`, `salt`, `role`) VALUES
(1, 'Gustavo', 'gustavo@bankinside.com.br', '0331125cafe709af7350c0adb76ddea9bea18ab2cd77555f29ea60d30e07574aaa8ee0e873b41df9bcfb223ab7a9ac3bf621398692ac308a8e80946f802635e5', 'dc122e6033a9929186771233d8394e2ef983993a141dd109c77e149fe36aca803149faf69013705c3fa006c158f2c4d25dd33c398654982524b62162e7e3be85', 1),
(2, 'Teste', 'teste@bankinside.com.br', '953154b23e293492b94dd5d0182b9b42a83a9546987f33b219476a06a05a9ab61486f85c05d8562e2fd7b09c05f4dc3aa9e9d95621ab3b0d78eb63e6fcb378da', 'dd3b6a1fa1ce4c0b7654f74bc4ea89b913a9d898f5f6977401866fce4ffe09581b97b8b3673b9c6b507c8bb678b888e0d1089bdbf330b8fe7cd18ba2ea2166fd', 0),
(3, 'Elaine', 'elaine@bankinside.com.br', '4523e47107b2385e2bb85d03f3914b206534377588b6db650245b228adf1feffd2dbb38ebc481b228835bc8c2a6cd2a47cd066cffc50bd92a1a3670bf1c165d0', 'fb3c22185e15ab65b45406d1fcdfb60be732514bd989c3a9bfc712f2731847b23e39b027de2951065c862adb6e8c87c59201256fdeacc82aa4a7b936745eebc4', 0);

-- -----------------------------------------------------
-- Table `bankinside`.`bnk_login_attemps`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bankinside`.`bnk_login_attempts` (
  `user_id` INT NOT NULL,
  `time` VARCHAR(30) NOT NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bankinside`.`manager`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bankinside`.`manager` (
  `idManager` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `gender` CHAR(1) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `documentId` VARCHAR(20) NOT NULL,
  `id_user` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idManager`),
  INDEX `fk_manager_user_idx` (`id_user` ASC),
  CONSTRAINT `fk_manager_user`
    FOREIGN KEY (`id_user`)
    REFERENCES `bankinside`.`bnk_user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `manager` (`idManager`, `name`, `gender`, `address`, `documentId`, `id_user`) VALUES
(1, 'Gustavo', 'M', 'Rua Oscar Renno', '123456789', 1),
(3, 'teste', 'F', 'asdf', '234', 3);

-- -----------------------------------------------------
-- Table `bankinside`.`customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bankinside`.`customer` (
  `idCustomer` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `gender` CHAR(1) NOT NULL,
  `birthday` DATE NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `documentId` VARCHAR(20) NOT NULL,
  `id_user` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idCustomer`),
  INDEX `fk_customer_user_idx` (`id_user` ASC),
  CONSTRAINT `fk_customer_user`
    FOREIGN KEY (`id_user`)
    REFERENCES `bankinside`.`bnk_user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `customer` (`idCustomer`, `name`, `gender`, `birthday`, `address`, `documentId`, `id_user`) VALUES
(1, 'Gustavo', 'M', '1996-06-24', 'Rua Oscar Renno', '123', 2),
(5, 'Elaine', 'F', '1999-04-19', 'Rua RR', '12345', 3);

-- -----------------------------------------------------
-- Table `bankinside`.`account`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bankinside`.`account` (
  `idAccount` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NOT NULL,
  `balance` FLOAT NOT NULL,
  `creationDate` DATE NOT NULL,
  `idCustomer` INT UNSIGNED NOT NULL,
  `counter` INT UNSIGNED DEFAULT 0,
  `lastUpdate` DATE NOT NULL,
  PRIMARY KEY (`idAccount`),
  UNIQUE INDEX `id_user_UNIQUE` (`idCustomer` ASC),
  CONSTRAINT `fk_account_customer`
    FOREIGN KEY (`idCustomer`)
    REFERENCES `bankinside`.`customer` (`idCustomer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `account` (`idAccount`, `type`, `balance`, `creationDate`, `idCustomer`, `counter`, `lastUpdate`) VALUES
(1, 'Proprietaria', 1000, '2015-11-14', 1, 4, '2015-11-14'),
(2, 'Conjunta', 400, '2015-11-03', 5, 2, '2015-11-11');

-- -----------------------------------------------------
-- Table `bankinside`.`payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bankinside`.`payment` (
  `idPayment` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `value` FLOAT UNSIGNED NOT NULL,
  `documentNumber` VARCHAR(45) NOT NULL,
  `barcode` VARCHAR(45) NOT NULL,
  `paymentDate` DATE NOT NULL,
  `idAccount` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idPayment`),
  INDEX `fk_payment_account_idx` (`idAccount` ASC),
  CONSTRAINT `fk_payment_account`
    FOREIGN KEY (`idAccount`)
    REFERENCES `bankinside`.`account` (`idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `payment` (`idPayment`, `value`, `documentNumber`, `barcode`, `paymentDate`, `idAccount`) VALUES
(1, 400, '12145489', '56489712', '2015-11-14', 1),
(2, 500, '5645123789', '7894511', '2015-11-18', 2);

-- -----------------------------------------------------
-- Table `bankinside`.`card`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bankinside`.`card` (
  `idCard` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `numberCard` VARCHAR(16) NOT NULL,
  `goodThru` DATE NOT NULL,
  `flag` VARCHAR(20) NOT NULL,
  `limitCard` FLOAT NOT NULL,
  `idAccount` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idCard`),
  UNIQUE INDEX `numberCard_UNIQUE` (`numberCard` ASC),
  INDEX `fk_card_account_idx` (`idAccount` ASC),
  CONSTRAINT `fk_card_account`
    FOREIGN KEY (`idAccount`)
    REFERENCES `bankinside`.`account` (`idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `card` (`idCard`, `numberCard`, `goodThru`, `flag`, `limitCard`, `idAccount`) VALUES
(1, '5456478123', '2016-01-20', 'Visa', 15000, 1),
(2, '56455179', '2016-05-18', 'MasterCard', 20000, 2);

-- -----------------------------------------------------
-- Table `bankinside`.`buy`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bankinside`.`buy` (
  `idBuy` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `transaction` VARCHAR(45) NOT NULL,
  `buyDate` DATE NOT NULL,
  `value` FLOAT UNSIGNED NOT NULL,
  `idCard` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idBuy`),
  INDEX `fk_buy_card_idx` (`idCard` ASC),
  CONSTRAINT `fk_buy_card`
    FOREIGN KEY (`idCard`)
    REFERENCES `bankinside`.`card` (`idCard`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `buy` (`idBuy`, `transaction`, `buyDate`, `value`, `idCard`) VALUES
(1, 'Loja A', '2015-11-13', 100, 1);


-- -----------------------------------------------------
-- Table `bankinside`.`transference`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bankinside`.`transference` (
  `idTransference` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(255) NOT NULL,
  `value` INT UNSIGNED NOT NULL,
  `dateTransfer` DATE NOT NULL,
  `idAccount` INT UNSIGNED NOT NULL,
  `bank` VARCHAR(255) NOT NULL,
  `accountDestin` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idTransference`),
  INDEX `fk_transference_account_idx` (`idAccount` ASC),
  CONSTRAINT `fk_transference_account`
    FOREIGN KEY (`idAccount`)
    REFERENCES `bankinside`.`account` (`idAccount`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  
ENGINE = InnoDB;


INSERT INTO `transference` (`idTransference`, `type`, `value`, `dateTransfer`, `idAccount`, `bank`, `accountDestin`) VALUES
(1, 'TED', 1000, '2015-11-15', 1, 'BankInside', 2),
(2, 'DOC', 500, '2015-11-17', 2, 'Banco do Brasil', 548);

-- -----------------------------------------------------
-- Table `bankinside`.`invoice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bankinside`.`invoice` (
  `idInvoice` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `period` DATE NOT NULL,
  `totalValue` FLOAT UNSIGNED NOT NULL,
  `creationDate` DATE NOT NULL,
  `idCard` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idInvoice`),
  INDEX `fk_invoice_card_idx` (`idCard` ASC),
  CONSTRAINT `fk_invoice_card`
    FOREIGN KEY (`idCard`)
    REFERENCES `bankinside`.`card` (`idCard`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `invoice` (`idInvoice`, `period`, `totalValue`, `creationDate`, `idCard`) VALUES
(1, '2015-11-14', 500, '2015-11-01', 1),
(2, '2015-11-14', 400, '2015-11-01', 2);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
