CREATE DATABASE `feriate_db` /*!40100 DEFAULT CHARACTER SET latin1 */;


/* Por convencion los nombres de las columbas llevan la abreviacion del nombre de la tabla
guion bajo (_) y el nombre de la columna, para identificarlos con mayor facilidad. Por ejemplo :
  `comp_pr_id` : significa tabla compras - producto_id*/


CREATE TABLE `feriate_db`.`usuarios` (
  `us_id` INT NOT NULL AUTO_INCREMENT,
  `us_nombre` VARCHAR(45) NOT NULL,
  `us_apellido` VARCHAR(45) NOT NULL,
  `us_email` VARCHAR(45) NOT NULL,
  `us_pass` VARCHAR(100) NOT NULL,
  `us_tel` INT NULL,
  `us_direccion` VARCHAR(100) NULL,
  `us_localidad` VARCHAR(45) NULL,
  `us_pais` INT NOT NULL,
  `us_fecha_reg` DATETIME NULL,
  `us_intentos_log` INT NULL,
  `us_activo` TINYINT NULL,
  `us_notificaciones` TINYINT NULL,
  PRIMARY KEY (`us_id`));

  CREATE TABLE `feriate_db`.`ferias` (
  `fe_id` INT NOT NULL AUTO_INCREMENT,
  `fe_us_id` INT NOT NULL,
  `fe_desde` VARCHAR(45) NOT NULL,
  `fe_nombre` VARCHAR(100) NOT NULL,
  `fe_descripcion` LONGTEXT NOT NULL,
  `fe_hasta` DATE NOT NULL,
  `fe_fecha_creacion` DATE NOT NULL,
  `fe_activa` TINYINT NULL,
  `fe_baneado` TINYINT NULL,
  PRIMARY KEY (`fe_id`));

  CREATE TABLE `feriate_db`.`productos` (
  `pr_id` INT NOT NULL AUTO_INCREMENT,
  `pr_nombre` VARCHAR(45) NOT NULL,
  `pr_precio` DECIMAL NULL,
  `pr_cantidad` INT NULL,
  `pr_marca` VARCHAR(45) NULL,
  `pr_baneado` TINYINT NULL,
  `pr_destino` TINYINT NOT NULL,
  `pr_fe_id` INT NOT NULL,
  `pr_cat_id` INT NOT NULL,
  `pr_us_id` INT NOT NULL,
  PRIMARY KEY (`pr_id`));

CREATE TABLE `feriate_db`.`categorias` (
  `cat_id` INT NOT NULL AUTO_INCREMENT,
  `cat_nombre` VARCHAR(45) NOT NULL,
  `cat_descripcion` LONGTEXT NULL,
  PRIMARY KEY (`cat_id`));

  CREATE TABLE `feriate_db`.`imagenes` (
  `img_id` INT NOT NULL AUTO_INCREMENT,
  `img_pr_id` INT NULL,
  `img_fe_id` INT NULL,
  `img_nombre` VARCHAR(100) NOT NULL,
  `img_us_is` INT NULL,
  PRIMARY KEY (`img_id`));

  CREATE TABLE `feriate_db`.`compras` (
  `comp_id` INT NOT NULL AUTO_INCREMENT,
  `comp_pr_id` INT NOT NULL,
  `comp_us_id` INT NOT NULL,
  PRIMARY KEY (`comp_id`));

  CREATE TABLE `feriate_db`.`carrito` (
  `carr_id` INT NOT NULL AUTO_INCREMENT,
  `carr_pr_id` INT NOT NULL,
  `carr_us_id` INT NOT NULL,
  PRIMARY KEY (`carr_id`));

  CREATE TABLE `feriate_db`.`comentarios` (
  `com_id` INT NOT NULL AUTO_INCREMENT,
  `com_us_id` INT NOT NULL,
  `com_fe_id` INT NOT NULL,
  `com_texto` VARCHAR(200) NOT NULL,
  `com_date` DATETIME NOT NULL,
  `com_baneado` TINYINT NULL,
  PRIMARY KEY (`com_id`));


/*SE AGREGAN LAS FK DE LAS TABLAS CREADAS*/
  ALTER TABLE `feriate_db`.`ferias`
  ADD CONSTRAINT `fk_id_usuario`
    FOREIGN KEY (`fe_us_id`)
    REFERENCES `feriate_db`.`usuarios` (`us_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;


    ALTER TABLE `feriate_db`.`productos`
ADD CONSTRAINT `fkey_us_id`
  FOREIGN KEY (`pr_us_id`)
  REFERENCES `feriate_db`.`usuarios` (`us_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fkey_cat_id`
  FOREIGN KEY (`pr_cat_id`)
  REFERENCES `feriate_db`.`categorias` (`cat_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fkey_fe_id`
  FOREIGN KEY (`pr_fe_id`)
  REFERENCES `feriate_db`.`ferias` (`fe_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


  ALTER TABLE `feriate_db`.`imagenes`
  ADD CONSTRAINT `us_id`
    FOREIGN KEY (`img_us_is`)
    REFERENCES `feriate_db`.`usuarios` (`us_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  ADD CONSTRAINT `pr_id`
    FOREIGN KEY (`img_pr_id`)
    REFERENCES `feriate_db`.`productos` (`pr_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  ADD CONSTRAINT `fe_id`
    FOREIGN KEY (`img_fe_id`)
    REFERENCES `feriate_db`.`ferias` (`fe_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;

    ALTER TABLE `feriate_db`.`compras`
ADD CONSTRAINT `comp_us_id`
  FOREIGN KEY (`comp_us_id`)
  REFERENCES `feriate_db`.`usuarios` (`us_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `comp_pr_id`
  FOREIGN KEY (`comp_pr_id`)
  REFERENCES `feriate_db`.`productos` (`pr_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  ALTER TABLE `feriate_db`.`carrito`
ADD CONSTRAINT `carr_us_id`
  FOREIGN KEY (`carr_us_id`)
  REFERENCES `feriate_db`.`usuarios` (`us_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `carr_pr_id`
  FOREIGN KEY (`carr_pr_id`)
  REFERENCES `feriate_db`.`productos` (`pr_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  ALTER TABLE `feriate_db`.`comentarios`
ADD CONSTRAINT `com_us_id`
  FOREIGN KEY (`com_us_id`)
  REFERENCES `feriate_db`.`usuarios` (`us_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `com_fe_id`
  FOREIGN KEY (`com_fe_id`)
  REFERENCES `feriate_db`.`ferias` (`fe_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  ALTER TABLE `feriate_db`.`ferias`
ADD COLUMN `fe_ubicacion` VARCHAR(45) NOT NULL AFTER `fe_nombre`,
CHANGE COLUMN `fe_nombre` `fe_nombre` VARCHAR(100) NOT NULL AFTER `fe_us_id`,
CHANGE COLUMN `fe_hasta` `fe_hasta` VARCHAR(45) NOT NULL AFTER `fe_desde`;
