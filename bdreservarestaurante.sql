/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - bdreservarestaurante
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bdreservarestaurante` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE=utf8mb4_general_ci */;

USE `bdreservarestaurante`;

/*Table structure for table `tblagenda` */

DROP TABLE IF EXISTS `tblagenda`;

CREATE TABLE `tblagenda` (
  `IdAgenda` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date DEFAULT NULL,
  `HoraInicio` time DEFAULT NULL,
  `HoraFinal` time DEFAULT NULL,
  `Mesa` int(11) DEFAULT NULL,
  `IdReserva` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdAgenda`),
  KEY `FK_Agenda_Reserva` (`IdReserva`),
  CONSTRAINT `FK_Agenda_Reserva` FOREIGN KEY (`IdReserva`) REFERENCES `tblreserva` (`IdReserva`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblagenda` */

insert  into `tblagenda`(`IdAgenda`,`Fecha`,`HoraInicio`,`HoraFinal`,`Mesa`,`IdReserva`) values 
(1,'2024-07-22','15:00:00','17:00:00',4,1);

/*Table structure for table `tblcliente` */

DROP TABLE IF EXISTS `tblcliente`;

CREATE TABLE `tblcliente` (
  `IdCliente` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  `ApellidoPaterno` varchar(50) DEFAULT NULL,
  `ApellidoMaterno` varchar(50) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `CorreoElectronico` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblcliente` */

insert  into `tblcliente`(`IdCliente`,`Nombre`,`ApellidoPaterno`,`ApellidoMaterno`,`Telefono`,`CorreoElectronico`) values 
(1,'Josmar','Bautista','Saavedra','+5217712194196','20230026@uthh.edu.mx'),
(2,'Diana','Palacios','Hernandez','+5217715563522','20230082@uthh.edu.mx'),
(3,'Alexander','Hernandez','Meza','+5217712170532','20230106@uthh.edu.mx'),
(4,'Abigail','Torres','Badillo','+5217712174809','20230098@uthh.edu.mx');

/*Table structure for table `tblmesa` */

DROP TABLE IF EXISTS `tblmesa`;

CREATE TABLE `tblmesa` (
  `IdMesa` int(11) NOT NULL AUTO_INCREMENT,
  `NumeroDeComensales` int(11) DEFAULT NULL,
  `Costo` decimal(10,2) DEFAULT NULL,
  `IdZona` int(11) DEFAULT NULL,
  `vchImagen` varchar(100) NOT NULL,
  PRIMARY KEY (`IdMesa`),
  KEY `FK_Mesa_Zona` (`IdZona`),
  CONSTRAINT `FK_Mesa_Zona` FOREIGN KEY (`IdZona`) REFERENCES `tblzona` (`IdZona`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblmesa` */

insert  into `tblmesa`(`IdMesa`,`NumeroDeComensales`,`Costo`,`IdZona`,`vchImagen`) values 
(1,4,300.00,1,'img1.png'),
(2,4,300.00,4,'mesa1.png'),
(4,6,450.00,1,'mesa3.png'),
(5,8,600.00,4,'mesa4.png');

/*Table structure for table `tblpago` */

DROP TABLE IF EXISTS `tblpago`;

CREATE TABLE `tblpago` (
  `IdPago` int(11) NOT NULL AUTO_INCREMENT,
  `Monto` decimal(10,2) DEFAULT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `IdReserva` int(11) DEFAULT NULL,
  `FechaPago` date DEFAULT NULL,
  `MetodoPago` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdPago`),
  KEY `IdCliente` (`IdCliente`),
  KEY `IdReserva` (`IdReserva`),
  CONSTRAINT `tblPago_ibfk_1` FOREIGN KEY (`IdCliente`) REFERENCES `tblcliente` (`IdCliente`),
  CONSTRAINT `tblPago_ibfk_2` FOREIGN KEY (`IdReserva`) REFERENCES `tblreserva` (`IdReserva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblpago` */

/*Table structure for table `tblreserva` */

DROP TABLE IF EXISTS `tblreserva`;

CREATE TABLE `tblreserva` (
  `IdReserva` int(11) NOT NULL AUTO_INCREMENT,
  `FechaDeLaReserva` date DEFAULT NULL,
  `HoraDeLaReserva` time DEFAULT NULL,
  `NoPersonas` int(11) DEFAULT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `IdMesa` int(11) DEFAULT NULL,
  `fltMonto` float(10,2) NOT NULL,
  `EstadoReserva` enum('Disponible','Ocupado') NOT NULL,
  PRIMARY KEY (`IdReserva`),
  KEY `FK_Reserva_Cliente` (`IdCliente`),
  KEY `FK_Reserva_Mesa` (`IdMesa`),
  CONSTRAINT `FK_Reserva_Cliente` FOREIGN KEY (`IdCliente`) REFERENCES `tblcliente` (`IdCliente`),
  CONSTRAINT `FK_Reserva_Mesa` FOREIGN KEY (`IdMesa`) REFERENCES `tblmesa` (`IdMesa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblreserva` */

insert  into `tblreserva`(`IdReserva`,`FechaDeLaReserva`,`HoraDeLaReserva`,`NoPersonas`,`IdCliente`,`IdMesa`,`fltMonto`,`EstadoReserva`) values 
(1,'2024-07-22','15:00:00',5,1,4,300.00,'Ocupado');

/*Table structure for table `tblreservadetalle` */

DROP TABLE IF EXISTS `tblreservadetalle`;

CREATE TABLE `tblreservadetalle` (
  `IdDetalleReserva` int(11) NOT NULL AUTO_INCREMENT,
  `IdReserva` int(11) DEFAULT NULL,
  `IdMesa` int(11) DEFAULT NULL,
  `idZona` int(11) DEFAULT NULL,
  `EstadoDetalle` varchar(50) DEFAULT NULL,
  `NoPersonas` int(11) NOT NULL,
  PRIMARY KEY (`IdDetalleReserva`),
  KEY `FK_ReservaDetalle_Mesa` (`IdMesa`),
  KEY `FK_ReservaDetalle_Reserva` (`IdReserva`),
  KEY `FK_ReservaDetalle_Zona` (`idZona`),
  CONSTRAINT `FK_ReservaDetalle_Mesa` FOREIGN KEY (`IdMesa`) REFERENCES `tblmesa` (`IdMesa`),
  CONSTRAINT `FK_ReservaDetalle_Reserva` FOREIGN KEY (`IdReserva`) REFERENCES `tblreserva` (`IdReserva`),
  CONSTRAINT `FK_ReservaDetalle_Zona` FOREIGN KEY (`idZona`) REFERENCES `tblzona` (`IdZona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblreservadetalle` */

/*Table structure for table `tblbebida` */

DROP TABLE IF EXISTS `tblbebida`;

CREATE TABLE `tblbebida` (
  `idBebida` int(11) NOT NULL AUTO_INCREMENT,
  `vchNombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idBebida`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblbebida` */

insert  into `tblbebida`(`idBebida`,`vchNombre`) values 
(1,'Coca Cola'),
(2,'Pepsi'),
(3,'Agua Mineral'),
(4,'Jugo de Naranja'),
(5,'Cerveza');

/*Table structure for table `tblcomida` */

DROP TABLE IF EXISTS `tblcomida`;

CREATE TABLE `tblcomida` (
  `idComida` int(11) NOT NULL AUTO_INCREMENT,
  `vchNombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idComida`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblcomida` */

insert  into `tblcomida`(`idComida`,`vchNombre`) values 
(1,'Pizza'),
(2,'Hamburguesa'),
(3,'Ensalada'),
(4,'Pasta'),
(5,'Tacos');

/*Table structure for table `tblmenu` */

DROP TABLE IF EXISTS `tblmenu`;

CREATE TABLE `tblmenu` (
  `idMenu` int(11) NOT NULL AUTO_INCREMENT,
  `idComida` int(11) DEFAULT NULL,
  `idBebida` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idMenu`),
  KEY `idComida` (`idComida`),
  KEY `idBebida` (`idBebida`),
  CONSTRAINT `tblmenu_ibfk_1` FOREIGN KEY (`idComida`) REFERENCES `tblcomida` (`idComida`),
  CONSTRAINT `tblmenu_ibfk_2` FOREIGN KEY (`idBebida`) REFERENCES `tblbebida` (`idBebida`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblmenu` */

insert  into `tblmenu`(`idMenu`,`idComida`,`idBebida`,`precio`) values 
(1,1,NULL,141.99),
(2,2,NULL,129.99),
(3,3,NULL,80.50),
(4,4,NULL,70.75),
(5,5,NULL,90.00),
(6,NULL,1,15.99),
(7,NULL,2,13.99),
(8,NULL,3,12.50),
(9,NULL,4,14.75),
(10,NULL,5,16.00);

/*Table structure for table `tblusuarios` */

DROP TABLE IF EXISTS `tblusuarios`;

CREATE TABLE `tblusuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `vchUsuario` varchar(150) DEFAULT NULL,
  `vchPassword` varchar(500) DEFAULT NULL,
  `vchNoTelefono` varchar(12) DEFAULT NULL,
  `vchEmailAlternativo` varchar(150) DEFAULT NULL,
  `TipoUsuario` enum('Cliente','Empleado') DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblusuarios` */

insert  into `tblusuarios`(`idUsuario`,`vchUsuario`,`vchPassword`,`vchNoTelefono`,`vchEmailAlternativo`,`TipoUsuario`) values 
(1,'Josmar','4fc0dff8cd76a365bce38a5c5e9a39f7','7712194196','20230026@uthh.edu.mx','Cliente');

/*Table structure for table `tblzona` */

DROP TABLE IF EXISTS `tblzona`;

CREATE TABLE `tblzona` (
  `IdZona` int(11) NOT NULL AUTO_INCREMENT,
  `Ubicacion` varchar(100) DEFAULT NULL,
  `vchImagen` varchar(100) NOT NULL,
  PRIMARY KEY (`IdZona`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblzona` */

insert  into `tblzona`(`IdZona`,`Ubicacion`,`vchImagen`) values 
(1,'Terrasa VIp','TerrasaVIP.png'),
(2,'Terrasa','Terrasa.png'),
(3,'ZonaVIp','ZonaVIP.png'),
(4,'ZonaComun','ZonaComun.png');

/* Procedure structure for procedure `spInsertarUsuarios` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarUsuarios` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`Josmar`@`%` PROCEDURE `spInsertarUsuarios`(
    IN usuario VARCHAR(150),
    IN pass VARCHAR(500),
    IN tel VARCHAR(12),
    IN emailA VARCHAR(150),
    IN tipoU ENUM('Cliente', 'Empleado')
)
BEGIN
    INSERT INTO tblusuarios (vchUsuario, vchPassword, vchNoTelefono, vchEmailAlternativo, TipoUsuario)
    VALUES (usuario, MD5(pass), tel, emailA, tipoU);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spCrearReserva` */

/*!50003 DROP PROCEDURE IF EXISTS  `spCrearReserva` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spCrearReserva`(
    IN Fecha DATE,
    IN Hora TIME,
    IN NumPersonas INT,
    IN IdCliente INT,
    IN IdMesa INT,
    IN Monto DECIMAL(10,2),
    IN EstadoReserva ENUM('Disponible', 'Ocupado')
)
BEGIN
    INSERT INTO tblreserva (FechaDeLaReserva, HoraDeLaReserva, NoPersonas, IdCliente, IdMesa, fltMonto, EstadoReserva)
    VALUES (Fecha, Hora, NumPersonas, IdCliente, IdMesa, Monto, EstadoReserva);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spCrearZona` */

/*!50003 DROP PROCEDURE IF EXISTS  `spCrearZona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spCrearZona`(
    IN Ubi VARCHAR(100),
    IN Imagen VARCHAR(100)
)
BEGIN
    INSERT INTO tblzona (Ubicacion, vchImagen)
    VALUES (Ubi, Imagen);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spInsertarCliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarCliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarCliente`(
    IN ClNombre VARCHAR(50),
    IN APaterno VARCHAR(50),
    IN AMaterno VARCHAR(50),
    IN NumTelefono VARCHAR(15),
    IN Email VARCHAR(100)
)
BEGIN
    INSERT INTO tblcliente (Nombre, ApellidoPaterno, ApellidoMaterno, Telefono, CorreoElectronico)
    VALUES (ClNombre, APaterno, AMaterno, NumTelefono, Email);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spInsertarCrearMesa` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarCrearMesa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarCrearMesa`(
    IN NumeroComensales INT,
    IN Precio DECIMAL(10,2),
    IN Zona INT,
    IN Imag VARCHAR(100)
)
BEGIN
    INSERT INTO tblmesa (NumeroDeComensales, Costo, IdZona, vchImagen)
    VALUES (NumeroComensales, Precio, Zona, Imag);
END */$$
DELIMITER ;

/*Table structure for table `vwmenuxcomidaxbebida` */

DROP TABLE IF EXISTS `vwmenuxcomidaxbebida`;

/*!50001 DROP VIEW IF EXISTS `vwmenuxcomidaxbebida` */;
/*!50001 DROP TABLE IF EXISTS `vwmenuxcomidaxbebida` */;

/*!50001 CREATE TABLE  `vwmenuxcomidaxbebida`(
 `idMenu` int(11) ,
 `idConsumible` varchar(510) ,
 `precio` decimal(10,2) 
)*/;

/*View structure for view vwmenuxcomidaxbebida */

/*!50001 DROP TABLE IF EXISTS `vwmenuxcomidaxbebida` */;
/*!50001 DROP VIEW IF EXISTS `vwmenuxcomidaxbebida` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`Josmar`@`%` SQL SECURITY DEFINER VIEW `vwmenuxcomidaxbebida` AS select `m`.`idMenu` AS `idMenu`,concat(ifnull(cast(`c`.`vchNombre` as char charset utf8),''),ifnull(cast(`b`.`vchNombre` as char charset utf8),'')) AS `idConsumible`,`m`.`precio` AS `precio` from ((`tblmenu` `m` left join `tblcomida` `c` on(`m`.`idComida` = `c`.`idComida`)) left join `tblbebida` `b` on(`m`.`idBebida` = `b`.`idBebida`)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
