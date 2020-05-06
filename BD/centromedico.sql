-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema centromedico
-- -----------------------------------------------------
drop database centromedico;
create database centromedico;
-- -----------------------------------------------------
-- Schema centromedico
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `centromedico` DEFAULT CHARACTER SET latin1 ;
USE `centromedico` ;

-- -----------------------------------------------------
-- Table `centromedico`.`consultorios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `centromedico`.`consultorios` (
  `idConsultorio` INT(11) NOT NULL AUTO_INCREMENT,
  `conNombre` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`idConsultorio`),
  UNIQUE INDEX `conNombre` (`conNombre` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `centromedico`.`especialidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `centromedico`.`especialidades` (
  `idespecialidad` INT(11) NOT NULL AUTO_INCREMENT,
  `espNombre` CHAR(15) NOT NULL,
  PRIMARY KEY (`idespecialidad`),
  UNIQUE INDEX `espNombre` (`espNombre` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `centromedico`.`medicos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `centromedico`.`medicos` (
  `idMedico` INT(11) NOT NULL AUTO_INCREMENT,
  `medidentificacion` CHAR(13) NOT NULL,
  `mednombres` VARCHAR(50) NOT NULL,
  `medapellidos` VARCHAR(50) NOT NULL,
  `medEspecialidad` VARCHAR(50) NOT NULL,
  `medtelefono` CHAR(15) NOT NULL,
  `medcorreo` VARCHAR(50) NOT NULL,
  `especialidades_idespecialidad` INT(11) NOT NULL,
  PRIMARY KEY (`idMedico`),
  UNIQUE INDEX `medidentificacion` (`medidentificacion` ASC),
  INDEX `fk_medicos_especialidades1_idx` (`especialidades_idespecialidad` ASC),
  CONSTRAINT `fk_medicos_especialidades1`
    FOREIGN KEY (`especialidades_idespecialidad`)
    REFERENCES `centromedico`.`especialidades` (`idespecialidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `centromedico`.`pacientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `centromedico`.`pacientes` (
  `idPaciente` INT(11) NOT NULL AUTO_INCREMENT,
  `pacIdentificacion` CHAR(13) NOT NULL,
  `pacNombre` VARCHAR(50) NOT NULL,
  `pacApellidos` VARCHAR(50) NOT NULL,
  `pacFechaNacimiento` DATE NOT NULL,
  `pacSexo` ENUM('Femenino', 'Masculino') NOT NULL,
  `pacTelefono` CHAR(15) NOT NULL,
  `pacDireccion` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`idPaciente`),
  UNIQUE INDEX `pacIdentificacion` (`pacIdentificacion` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `centromedico`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `centromedico`.`usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(20) NOT NULL,
  `pass` VARCHAR(200) NOT NULL,
  `nombres` VARCHAR(50) NOT NULL,
  `apellidos` VARCHAR(50) NOT NULL,
  `Roll` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `usuario` (`usuario` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `centromedico`.`citas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `centromedico`.`citas` (
  `idcita` INT(11) NOT NULL AUTO_INCREMENT,
  `citfecha` DATE NOT NULL,
  `cithora` TIME NOT NULL,
  `citPaciente` VARCHAR(50) NOT NULL,
  `citMedico` VARCHAR(50) NOT NULL,
  `citConsultorio` VARCHAR(25) NOT NULL,
  `citestado` ENUM('Pendiente', 'Atendido') NOT NULL,
  `citobservaciones` TEXT NOT NULL,
  `consultorios_idConsultorio` INT(11) NOT NULL,
  `pacientes_idPaciente` INT(11) NOT NULL,
  `usuarios_id` INT(11) NOT NULL,
  `medicos_idMedico` INT(11) NOT NULL,
  PRIMARY KEY (`idcita`),
  INDEX `cithora` (`cithora` ASC) ,
  INDEX `idPaciente` (`citPaciente` ASC),
  INDEX `idMedico` (`citMedico` ASC) ,
  INDEX `idConsultorio` (`citConsultorio` ASC) ,
  INDEX `fk_citas_consultorios_idx` (`consultorios_idConsultorio` ASC) ,
  INDEX `fk_citas_pacientes1_idx` (`pacientes_idPaciente` ASC) ,
  INDEX `fk_citas_usuarios1_idx` (`usuarios_id` ASC) ,
  INDEX `fk_citas_medicos1_idx` (`medicos_idMedico` ASC) ,
  CONSTRAINT `fk_citas_consultorios`
    FOREIGN KEY (`consultorios_idConsultorio`)
    REFERENCES `centromedico`.`consultorios` (`idConsultorio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_citas_medicos1`
    FOREIGN KEY (`medicos_idMedico`)
    REFERENCES `centromedico`.`medicos` (`idMedico`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_citas_pacientes1`
    FOREIGN KEY (`pacientes_idPaciente`)
    REFERENCES `centromedico`.`pacientes` (`idPaciente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_citas_usuarios1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `centromedico`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 24
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `nombres`, `apellidos`, `Roll`) VALUES
(2, 'carlos', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'carlos', 'intriago', 'admin'),
(3, 'alex', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'alex', 'vasquez', 'admin');