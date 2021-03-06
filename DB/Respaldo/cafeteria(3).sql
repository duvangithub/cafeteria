-- MySQL Script generated by MySQL Workbench
-- Fri Jul 20 11:57:16 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema cafeteria
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cafeteria
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cafeteria` DEFAULT CHARACTER SET utf8 ;
USE `cafeteria` ;

-- -----------------------------------------------------
-- Table `cafeteria`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cafeteria`.`categorias` (
  `idCategorias` INT(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `Estado` TINYINT(4) NOT NULL,
  `Imagen` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `Eliminar` TINYINT(4) NOT NULL,
  PRIMARY KEY (`idCategorias`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `cafeteria`.`productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cafeteria`.`productos` (
  `idProductos` INT(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `Imagen` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `Precio` DECIMAL(5,2) NOT NULL,
  `Stock` INT(255) NOT NULL,
  `Estado` TINYINT(4) NOT NULL,
  `idCategorias` INT(11) NOT NULL,
  `Eliminar` TINYINT(4) NOT NULL,
  PRIMARY KEY (`idProductos`),
  INDEX `fk_productos_categorias1_idx` (`idCategorias` ASC),
  CONSTRAINT `fk_productos_categorias1`
    FOREIGN KEY (`idCategorias`)
    REFERENCES `cafeteria`.`categorias` (`idCategorias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `cafeteria`.`mesas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cafeteria`.`mesas` (
  `idMesas` INT(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `Eliminar` TINYINT(4) NOT NULL,
  PRIMARY KEY (`idMesas`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `cafeteria`.`orden`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cafeteria`.`orden` (
  `idOrden` INT(11) NOT NULL AUTO_INCREMENT,
  `Fecha` DATETIME NOT NULL,
  `idMesas` INT(11) NULL DEFAULT NULL,
  `Nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  PRIMARY KEY (`idOrden`),
  INDEX `fk_orden_mesas1_idx` (`idMesas` ASC),
  CONSTRAINT `fk_orden_mesas1`
    FOREIGN KEY (`idMesas`)
    REFERENCES `cafeteria`.`mesas` (`idMesas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `cafeteria`.`productosorden`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cafeteria`.`productosorden` (
  `idProductos` INT(11) NOT NULL,
  `idOrden` INT(11) NOT NULL,
  `Costo` DECIMAL(5,2) NOT NULL,
  `Cantidad` INT(255) NOT NULL,
  PRIMARY KEY (`idProductos`, `idOrden`),
  INDEX `fk_productos_has_orden_orden1_idx` (`idOrden` ASC),
  INDEX `fk_productos_has_orden_productos1_idx` (`idProductos` ASC),
  CONSTRAINT `fk_productos_has_orden_productos1`
    FOREIGN KEY (`idProductos`)
    REFERENCES `cafeteria`.`productos` (`idProductos`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_has_orden_orden1`
    FOREIGN KEY (`idOrden`)
    REFERENCES `cafeteria`.`orden` (`idOrden`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `cafeteria`.`detalleorden`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cafeteria`.`detalleorden` (
  `idDetalle` INT NOT NULL AUTO_INCREMENT,
  `idOrden` INT(11) NOT NULL,
  `Total` INT(255) NOT NULL,
  PRIMARY KEY (`idDetalle`),
  INDEX `fk_detalleorden_productosorden1_idx` (`idOrden` ASC),
  CONSTRAINT `fk_detalleorden_productosorden1`
    FOREIGN KEY (`idOrden`)
    REFERENCES `cafeteria`.`productosorden` (`idOrden`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `cafeteria`.`pago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cafeteria`.`pago` (
  `idPago` INT(11) NOT NULL AUTO_INCREMENT,
  `Pagado` DECIMAL(5,2) NOT NULL,
  `Cambio` DECIMAL(5,2) NOT NULL,
  `Estado` TINYINT(4) NOT NULL,
  `Tarjeta` INT(4) NOT NULL,
  `idDetalle` INT NOT NULL,
  PRIMARY KEY (`idPago`),
  INDEX `fk_pago_detalleorden1_idx` (`idDetalle` ASC),
  CONSTRAINT `fk_pago_detalleorden1`
    FOREIGN KEY (`idDetalle`)
    REFERENCES `cafeteria`.`detalleorden` (`idDetalle`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
