/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - bdreservarestaurante
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bdreservarestaurante` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

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

/*Table structure for table `tblbebidas` */

DROP TABLE IF EXISTS `tblbebidas`;

CREATE TABLE `tblbebidas` (
  `idBebida` int(11) NOT NULL AUTO_INCREMENT,
  `vchNombre` varchar(50) DEFAULT NULL,
  `fltPrecio` decimal(10,2) DEFAULT NULL,
  `vchDescripcion` varchar(255) DEFAULT NULL,
  `vchImagen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idBebida`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblbebidas` */

insert  into `tblbebidas`(`idBebida`,`vchNombre`,`fltPrecio`,`vchDescripcion`,`vchImagen`) values 
(1,'Coca Cola',NULL,NULL,NULL),
(2,'Pepsi',NULL,NULL,NULL),
(3,'Agua Mineral',NULL,NULL,NULL),
(4,'Jugo de Naranja',NULL,NULL,NULL),
(5,'Cerveza',NULL,NULL,NULL);

/*Table structure for table `tblcliente` */

DROP TABLE IF EXISTS `tblcliente`;

CREATE TABLE `tblcliente` (
  `IdCliente` int(11) NOT NULL AUTO_INCREMENT,
  `vchNombre` varchar(50) DEFAULT NULL,
  `vchApellidos` varchar(50) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `CorreoElectronico` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblcliente` */

insert  into `tblcliente`(`IdCliente`,`vchNombre`,`vchApellidos`,`Telefono`,`CorreoElectronico`) values 
(1,'Bautista','Saavedra','+5217712194196','20230026@uthh.edu.mx'),
(2,'Palacios','Hernandez','+5217715563522','20230082@uthh.edu.mx'),
(3,'Hernandez','Meza','+5217712170532','20230106@uthh.edu.mx'),
(4,'Torres','Badillo','+5217712174809','20230098@uthh.edu.mx');

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

/*Table structure for table `tblcomidas` */

DROP TABLE IF EXISTS `tblcomidas`;

CREATE TABLE `tblcomidas` (
  `idComida` int(11) NOT NULL AUTO_INCREMENT,
  `vchNombre` varchar(20) DEFAULT NULL,
  `fltPrecio` decimal(10,2) DEFAULT NULL,
  `vchDescripcion` varchar(200) DEFAULT NULL,
  `vchImagen` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idComida`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblcomidas` */

insert  into `tblcomidas`(`idComida`,`vchNombre`,`fltPrecio`,`vchDescripcion`,`vchImagen`) values 
(1,'Pizza',141.00,'Masa crujiente, salsa de tomate deliciosa y queso derretido que te hará sonreír.','PizzaMediana.jpeg'),
(2,'Hamburguesa',NULL,NULL,NULL),
(3,'Ensalada',NULL,NULL,NULL),
(4,'Pasta',NULL,NULL,NULL),
(5,'Tacos',NULL,NULL,NULL);

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
  CONSTRAINT `tblmenu_ibfk_1` FOREIGN KEY (`idComida`) REFERENCES `tblcomidas` (`idComida`),
  CONSTRAINT `tblmenu_ibfk_2` FOREIGN KEY (`idBebida`) REFERENCES `tblbebidas` (`idBebida`)
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

/*Table structure for table `tblmesa` */

DROP TABLE IF EXISTS `tblmesa`;

CREATE TABLE `tblmesa` (
  `IdMesa` int(11) NOT NULL AUTO_INCREMENT,
  `ClaveMesa` varchar(10) DEFAULT NULL,
  `Capasidad` int(11) DEFAULT NULL,
  `Costo` decimal(10,2) DEFAULT NULL,
  `IdZona` int(11) DEFAULT NULL,
  `vchImagen` varchar(100) NOT NULL,
  PRIMARY KEY (`IdMesa`),
  KEY `FK_Mesa_Zona` (`IdZona`),
  CONSTRAINT `FK_Mesa_Zona` FOREIGN KEY (`IdZona`) REFERENCES `tblzona` (`IdZona`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblmesa` */

insert  into `tblmesa`(`IdMesa`,`ClaveMesa`,`Capasidad`,`Costo`,`IdZona`,`vchImagen`) values 
(1,'T1',4,300.00,1,'img1.png'),
(2,'T2',4,300.00,1,'mesal1.png'),
(3,'T3',6,450.00,1,'mesa3.png'),
(4,'T4',8,600.00,1,'mesa4.png'),
(5,'T5',4,300.00,1,'mesa5.png'),
(6,'TV1',4,300.00,2,'img1.png'),
(7,'TV2',4,300.00,2,'mesal1.png'),
(8,'TV3',6,450.00,2,'mesa3.png'),
(9,'TV4',8,600.00,2,'mesa4.png'),
(10,'TV5',4,300.00,2,'mesa5.png'),
(11,'ZV1',4,300.00,3,'img1.png'),
(12,'ZV2',4,300.00,3,'mesal1.png'),
(13,'ZV3',6,450.00,3,'mesa3.png'),
(14,'ZV4',8,600.00,3,'mesa4.png'),
(15,'ZV5',4,300.00,3,'mesa5.png'),
(16,'ZC1',4,300.00,4,'img1.png'),
(17,'ZC2',4,300.00,4,'mesal1.png'),
(18,'ZC3',6,450.00,4,'mesa3.png'),
(19,'ZC4',8,600.00,4,'mesa4.png'),
(20,'ZC5',4,300.00,4,'mesa5.png');

/*Table structure for table `tblpago` */

DROP TABLE IF EXISTS `tblpago`;

CREATE TABLE `tblpago` (
  `IdPago` int(11) NOT NULL AUTO_INCREMENT,
  `IdCliente` int(11) DEFAULT NULL,
  `IdReserva` int(11) DEFAULT NULL,
  `Monto` decimal(10,2) DEFAULT NULL,
  `FechaPago` date DEFAULT NULL,
  `MetodoPago` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdPago`),
  KEY `IdCliente` (`IdCliente`),
  KEY `IdReserva` (`IdReserva`),
  CONSTRAINT `tblPago_ibfk_1` FOREIGN KEY (`IdCliente`) REFERENCES `tblcliente` (`IdCliente`),
  CONSTRAINT `tblPago_ibfk_2` FOREIGN KEY (`IdReserva`) REFERENCES `tblreserva` (`IdReserva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblpago` */

/*Table structure for table `tblpostres` */

DROP TABLE IF EXISTS `tblpostres`;

CREATE TABLE `tblpostres` (
  `idPostre` int(11) NOT NULL AUTO_INCREMENT,
  `vchNombre` varchar(50) DEFAULT NULL,
  `fltPrecio` decimal(10,2) DEFAULT NULL,
  `vchDescripcion` varchar(255) DEFAULT NULL,
  `vchImagen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idPostre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblpostres` */

/*Table structure for table `tblreserva` */

DROP TABLE IF EXISTS `tblreserva`;

CREATE TABLE `tblreserva` (
  `IdReserva` int(11) NOT NULL AUTO_INCREMENT,
  `IdCliente` int(11) DEFAULT NULL,
  `dtFecha` date DEFAULT NULL,
  `HoraInicio` time DEFAULT NULL,
  `HoraFinal` time DEFAULT NULL,
  `vchOcacion` varchar(100) DEFAULT NULL,
  `NoPersonas` int(11) DEFAULT NULL,
  `Idzona` int(11) DEFAULT NULL,
  `EstadoReserva` enum('Disponible','Ocupado') NOT NULL,
  PRIMARY KEY (`IdReserva`),
  KEY `FK_Reserva_Cliente` (`IdCliente`),
  CONSTRAINT `FK_Reserva_Cliente` FOREIGN KEY (`IdCliente`) REFERENCES `tblcliente` (`IdCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblreserva` */

insert  into `tblreserva`(`IdReserva`,`IdCliente`,`dtFecha`,`HoraInicio`,`HoraFinal`,`vchOcacion`,`NoPersonas`,`Idzona`,`EstadoReserva`) values 
(1,1,'2024-07-22','15:00:00',NULL,NULL,5,NULL,'Ocupado');

/*Table structure for table `tblreservadetalle` */

DROP TABLE IF EXISTS `tblreservadetalle`;

CREATE TABLE `tblreservadetalle` (
  `IdDetalleReserva` int(11) NOT NULL AUTO_INCREMENT,
  `IdReserva` int(11) DEFAULT NULL,
  `idMesaAsignada` int(11) DEFAULT NULL,
  `fltCosto` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`IdDetalleReserva`),
  KEY `FK_ReservaDetalle_Mesa` (`idMesaAsignada`),
  KEY `FK_ReservaDetalle_Reserva` (`IdReserva`),
  CONSTRAINT `FK_ReservaDetalle_Mesa` FOREIGN KEY (`idMesaAsignada`) REFERENCES `tblmesa` (`IdMesa`),
  CONSTRAINT `FK_ReservaDetalle_Reserva` FOREIGN KEY (`IdReserva`) REFERENCES `tblreserva` (`IdReserva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblreservadetalle` */

/*Table structure for table `tblusuarios` */

DROP TABLE IF EXISTS `tblusuarios`;

CREATE TABLE `tblusuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `vchNombre` varchar(20) DEFAULT NULL,
  `vchApellidos` varchar(20) DEFAULT NULL,
  `vchNoTelefono` varchar(13) DEFAULT NULL,
  `vchEmail` varchar(150) DEFAULT NULL,
  `vchPassword` varchar(300) DEFAULT NULL,
  `TipoUsuario` enum('Cliente','Empleado','Administrador') DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblusuarios` */

insert  into `tblusuarios`(`idUsuario`,`vchNombre`,`vchApellidos`,`vchNoTelefono`,`vchEmail`,`vchPassword`,`TipoUsuario`) values 
(1,'Josmar',NULL,'7712194196','20230026@uthh.edu.mx','4fc0dff8cd76a365bce38a5c5e9a39f7','Cliente'),
(2,'Aldair',NULL,'4831290696','josmar050116@gmail.com','4fc0dff8cd76a365bce38a5c5e9a39f7','Cliente'),
(3,'Josmar Aldair','Bautista Saavedra','4831290696','josmar050110@gmail.com','c30d2d6dfe8c5ae3a3e9b9cef0d36f59','Administrador'),
(14,'JABS','Meraz','','Jabs@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','Empleado'),
(17,'Diana','Palacios','','Diana@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','Empleado'),
(25,'JABSALDAIR','SAAVEDRA','1234567890','JABSALDAIR@gmail.com','e1d5be1c7f2f456670de3d53c7b54f4a','Empleado'),
(26,'12345687901234567890','12345687901234567890','1234568790123','12345687901234567890123@gmail.com','e1d5be1c7f2f456670de3d53c7b54f4a','Empleado'),
(27,'12345687901234567890','12345687901234567890','1234568790123','12345687901234567890123@gmail.com','e1d5be1c7f2f456670de3d53c7b54f4a','Empleado');

/*Table structure for table `tblzona` */

DROP TABLE IF EXISTS `tblzona`;

CREATE TABLE `tblzona` (
  `IdZona` int(11) NOT NULL AUTO_INCREMENT,
  `vchUbicacion` varchar(100) DEFAULT NULL,
  `vchImagen` varchar(100) NOT NULL,
  PRIMARY KEY (`IdZona`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tblzona` */

insert  into `tblzona`(`IdZona`,`vchUbicacion`,`vchImagen`) values 
(1,'Terrasa VIp','TerrasaVIP.png'),
(2,'Terrasa','Terrasa.webp'),
(3,'ZonaVIp','ZonaVIP.webp'),
(4,'ZonaComun','ZonaComun.webp');

/* Trigger structure for table `tblreserva` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `designacionMesas` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `designacionMesas` AFTER INSERT ON `tblreserva` FOR EACH ROW 
BEGIN
    DECLARE totalComensales INT DEFAULT 0;
    DECLARE mesasAsignadas TEXT DEFAULT '';
    DECLARE done INT DEFAULT 0;
    
    -- Variables para almacenar los valores de cada fila
    DECLARE vIdMesa INT;
    DECLARE vNumeroDeComensales INT;
    DECLARE vCosto DECIMAL(10,2);

    -- Cursor para seleccionar las mesas de la zona especificada ordenadas por capacidad de comensales
    DECLARE cursorMesas CURSOR FOR 
    SELECT IdMesa, NumeroDeComensales, Costo 
    FROM tblMesa
    WHERE IdZona = NEW.IdZona 
    ORDER BY NumeroDeComensales ASC;

    -- Handlers para el cursor
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- Abrir el cursor
    OPEN cursorMesas;

    read_loop: LOOP
        FETCH cursorMesas INTO vIdMesa, vNumeroDeComensales, vCosto;
        IF done THEN
            LEAVE read_loop;
        END IF;
        
        IF totalComensales < NEW.NoPersonas THEN
            SET totalComensales = totalComensales + vNumeroDeComensales;
            SET mesasAsignadas = CONCAT(mesasAsignadas, vIdMesa, ',');
        END IF;
    END LOOP;

    -- Cerrar el cursor
    CLOSE cursorMesas;

    -- Eliminar la última coma
    IF LENGTH(mesasAsignadas) > 0 THEN
        SET mesasAsignadas = LEFT(mesasAsignadas, LENGTH(mesasAsignadas) - 1);
    END IF;

    -- Verificar si se han asignado suficientes mesas
    IF totalComensales >= NEW.NoPersonas THEN
        -- Insertar las mesas asignadas en tblDetalleReserva
        WHILE LENGTH(mesasAsignadas) > 0 DO
            SET vIdMesa = SUBSTRING_INDEX(mesasAsignadas, ',', 1);
            INSERT INTO tblDetalleReserva (IdReserva, idMesaAsignada) VALUES (NEW.IdReserva, vIdMesa);
            SET mesasAsignadas = SUBSTRING(mesasAsignadas, LENGTH(vIdMesa) + 2);
        END WHILE;
    ELSE
        -- Manejo de error si no hay suficientes mesas
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No hay suficientes mesas disponibles para cumplir con la reserva.';
    END IF;
END */$$


DELIMITER ;

/* Procedure structure for procedure `spActualizarBebida` */

/*!50003 DROP PROCEDURE IF EXISTS  `spActualizarBebida` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarBebida`(
    IN pIdBebida INT,
    IN pNombre VARCHAR(255),
    IN pDescripcion TEXT,
    IN pPrecio FLOAT,
    IN pImagen VARCHAR(255)
)
BEGIN
    UPDATE tblbebidas
    SET 
        vchNombre = pNombre,
        vchDescripcion = pDescripcion,
        fltPrecio = pPrecio,
        vchImagen = pImagen
    WHERE 
        IdBebida = pIdBebida;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spActualizarCliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `spActualizarCliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarCliente`(
    IN pIdCliente INT,
    IN pNombre VARCHAR(255),
    IN pApellidos VARCHAR(255),
    IN pTelefono VARCHAR(20),
    IN pEmail VARCHAR(255)
)
BEGIN
    UPDATE tblclientes
    SET 
        vchNombre = pNombre,
        vchApellidos = pApellidos,
        vchTelefono = pTelefono,
        vchEmail = pEmail
    WHERE 
        IdCliente = pIdCliente;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spActualizarComida` */

/*!50003 DROP PROCEDURE IF EXISTS  `spActualizarComida` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarComida`(
    IN pIdComida INT,
    IN pNombre VARCHAR(20),
    IN pDescripcion TEXT,
    IN pPrecio FLOAT,
    IN pImagen VARCHAR(255)
)
BEGIN
    UPDATE tblcomidas
    SET 
        vchNombre = pNombre,
        vchDescripcion = pDescripcion,
        fltPrecio = pPrecio,
        vchImagen = pImagen
    WHERE 
        IdComida = pIdComida;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spActualizarMesa` */

/*!50003 DROP PROCEDURE IF EXISTS  `spActualizarMesa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarMesa`(
    IN pIdMesa INT,
    IN pClaveMesa VARCHAR(255),
    IN pCapacidad INT,
    IN pCosto FLOAT,
    IN pIdZona INT,
    IN pImagen VARCHAR(255)
)
BEGIN
    UPDATE tblmesa
    SET 
        ClaveMesa = pClaveMesa,
        Capacidad = pCapacidad,
        Costo = pCosto,
        IdZona = pIdZona,
        vchImagen = pImagen
    WHERE 
        IdMesa = pIdMesa;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spActualizarPostre` */

/*!50003 DROP PROCEDURE IF EXISTS  `spActualizarPostre` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarPostre`(
    IN pIdPostre INT,
    IN pNombre VARCHAR(255),
    IN pDescripcion TEXT,
    IN pPrecio FLOAT,
    IN pImagen VARCHAR(255)
)
BEGIN
    UPDATE tblpostres
    SET 
        vchNombre = pNombre,
        vchDescripcion = pDescripcion,
        fltPrecio = pPrecio,
        vchImagen = pImagen
    WHERE 
        IdPostre = pIdPostre;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spActualizarZona` */

/*!50003 DROP PROCEDURE IF EXISTS  `spActualizarZona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarZona`(
    IN pIdZona INT,
    IN pUbicacion VARCHAR(255),
    IN pImagen VARCHAR(255)
)
BEGIN
    UPDATE tblzona
    SET 
        vchUbicacion = pUbicacion,
        vchImagen = pImagen
    WHERE 
        IdZona = pIdZona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spAsignarMesas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spAsignarMesas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spAsignarMesas`(
    IN numeroPersonas INT,
    IN zona INT
)
BEGIN
    -- Declaración de variables
    DECLARE totalComensales INT DEFAULT 0;
    DECLARE costoTotal DECIMAL(10,2) DEFAULT 0.00;
    DECLARE mesasAsignadas TEXT DEFAULT '';
    DECLARE done INT DEFAULT 0;

    -- Variables para almacenar los valores de cada fila
    DECLARE vIdMesa INT;
    DECLARE vNumeroDeComensales INT;
    DECLARE vCosto DECIMAL(10,2);
    
    -- Cursor para seleccionar las mesas de la zona especificada ordenadas por capacidad de comensales
    DECLARE cursorMesas CURSOR FOR 
    SELECT IdMesa, NumeroDeComensales, Costo 
    FROM tblMesa
    WHERE IdZona = zona 
    ORDER BY NumeroDeComensales ASC;
    
    -- Handlers para el cursor
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- Abrir el cursor
    OPEN cursorMesas;
    
    read_loop: LOOP
        FETCH cursorMesas INTO vIdMesa, vNumeroDeComensales, vCosto;
        IF done THEN
            LEAVE read_loop;
        END IF;
        
        IF totalComensales < numeroPersonas THEN
            SET totalComensales = totalComensales + vNumeroDeComensales;
            SET costoTotal = costoTotal + vCosto;
            SET mesasAsignadas = CONCAT(mesasAsignadas, vIdMesa, ',');
        END IF;
    END LOOP;
    
    -- Cerrar el cursor
    CLOSE cursorMesas;
    
    -- Eliminar la última coma
    IF LENGTH(mesasAsignadas) > 0 THEN
        SET mesasAsignadas = LEFT(mesasAsignadas, LENGTH(mesasAsignadas) - 1);
    END IF;
    
    -- Verificar si se han asignado suficientes mesas
    IF totalComensales >= numeroPersonas THEN
        SELECT mesasAsignadas AS MesasAsignadas, costoTotal AS CostoTotal;
    ELSE
        SELECT 'No hay suficientes mesas disponibles para cumplir con la reserva.' AS Error;
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spCalcularCosto` */

/*!50003 DROP PROCEDURE IF EXISTS  `spCalcularCosto` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spCalcularCosto`(
    IN nombreCliente VARCHAR(150)
)
BEGIN
    DECLARE IdUltimaReserva INT;
    DECLARE costoTotal DECIMAL(10,2) DEFAULT 0.00;

    -- Buscar Id del cliente
    DECLARE IdCliente INT;
    SELECT IdCliente
    INTO IdCliente
    FROM tblcliente
    WHERE vchNombre = nombreCliente;

    -- Obtener la Id de la última reserva del cliente
    SELECT IdReserva
    INTO IdUltimaReserva
    FROM tblreserva
    WHERE IdCliente = IdCliente
    ORDER BY FechaDeLaReserva DESC, HoraInicio DESC
    LIMIT 1;

    -- Calcular el costo total de las mesas asignadas a esa reserva
    SELECT SUM(m.Costo)
    INTO costoTotal
    FROM tblDetalleReserva dr
    JOIN tblMesas m ON dr.idMesaAsignada = m.IdMesa
    WHERE dr.IdReserva = IdUltimaReserva;

    -- Devolver el Id de la última reserva y el costo total
    SELECT IdUltimaReserva AS Reserva, costoTotal AS CostoTotal;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spConsultarBebidas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarBebidas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarBebidas`()
BEGIN
	SELECT idBebida, vchnombre, fltPrecio,vchDescripcion, vchImagen
	FROM tblbebidas;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spConsultarComidas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarComidas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarComidas`()
BEGIN
	SELECT idComida, vchNombre, fltPrecio,vchDescripcion, vchImagen
	FROM tblcomidas;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spConsultarDatos` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarDatos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarDatos`(IN email VARCHAR(200))
BEGIN
		SELECT idUsuario, vchNombre, TipoUsuario FROM tblusuarios
		WHERE vchEmail = email;

END */$$
DELIMITER ;

/* Procedure structure for procedure `spConsultarEmpleados` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarEmpleados` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarEmpleados`()
BEGIN
	SELECT idUsuario, vchNombre, vchApellidos, vchNotelefono, vchEmail
	FROM tblusuarios
	WHERE TipoUsuario = 'Empleado';
END */$$
DELIMITER ;

/* Procedure structure for procedure `spConsultarMesas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarMesas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarMesas`()
BEGIN
	SELECT M.IdMesa, M.ClaveMesa, M.Capasidad, M.costo, Z.vchUbicacion, M.vchImagen
	FROM tblmesa M, tblzona Z 
	where M.idzona = Z.IdZona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spConsultarPostres` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarPostres` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarPostres`()
BEGIN
	SELECT idPostre, vchnombre, fltPrecio,vchDescripcion, vchImagen
	FROM tblpostres;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spConsultarZona` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarZona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarZona`()
BEGIN
	SELECT IdZona, vchUbicacion, vchImagen
	FROM tblzona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spCrearReserva` */

/*!50003 DROP PROCEDURE IF EXISTS  `spCrearReserva` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spCrearReserva`(
    IN nombre VARCHAR(150),
    IN Apellidos VARCHAR(150),
    IN Fecha DATE,
    IN HoraI TIME,
    IN HoraF TIME,
    IN Ocacion VARCHAR(50),
    IN NumPersonas INT,
    IN Zona INT,
    IN EstadoReserva ENUM('Disponible', 'Ocupado')
)
BEGIN
    DECLARE IdC INT;
    DECLARE IdZ INT;

    -- Buscar Id del cliente
    SELECT IdCliente
    INTO IdC
    FROM tblcliente
    WHERE vchNombre = nombre;

    -- Buscar Id de la zona
    SELECT IdZona
    INTO IdZ
    FROM tblZona
    WHERE Ubicacion = Zona;

    -- Crear la reserva
    INSERT INTO tblreserva (IdCliente, dtFecha, HoraInicio, HoraFinal, vchOcacion, NoPersonas, IdZona, EstadoReserva)
    VALUES (IdC, Fecha, HoraI, HoraF, Ocacion, NumPersonas, IdZ, EstadoReserva);
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

/* Procedure structure for procedure `spEliminarBebida` */

/*!50003 DROP PROCEDURE IF EXISTS  `spEliminarBebida` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarBebida`(
    IN pIdBebida INT
)
BEGIN
    DELETE FROM tblbebidas
    WHERE 
        IdBebida = pIdBebida;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spEliminarCliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `spEliminarCliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarCliente`(
    IN pIdCliente INT
)
BEGIN
    DELETE FROM tblclientes
    WHERE 
        IdCliente = pIdCliente;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spEliminarComida` */

/*!50003 DROP PROCEDURE IF EXISTS  `spEliminarComida` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarComida`(
    IN pIdComida INT
)
BEGIN
    DELETE FROM tblcomidas
    WHERE 
        IdComida = pIdComida;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spEliminarMesa` */

/*!50003 DROP PROCEDURE IF EXISTS  `spEliminarMesa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarMesa`(
    IN pIdMesa INT
)
BEGIN
    DELETE FROM tblmesa
    WHERE 
        IdMesa = pIdMesa;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spEliminarPostre` */

/*!50003 DROP PROCEDURE IF EXISTS  `spEliminarPostre` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarPostre`(
    IN pIdPostre INT
)
BEGIN
    DELETE FROM tblpostres
    WHERE 
        IdPostre = pIdPostre;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spEliminarZona` */

/*!50003 DROP PROCEDURE IF EXISTS  `spEliminarZona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarZona`(
    IN pIdZona INT
)
BEGIN
    DELETE FROM tblzona
    WHERE 
        IdZona = pIdZona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spInsertarBebida` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarBebida` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarBebida`(
    IN Nombre VARCHAR(50),
    IN Precio DECIMAL(10,2),
    IN Imagen VARCHAR(255)
)
BEGIN

    INSERT INTO tblBebidas (vchNombre, fltPrecio, vchImagen)
    VALUES (Nombre, Precio, Imagen);

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

/* Procedure structure for procedure `spInsertarComida` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarComida` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarComida`(
    IN Nombre VARCHAR(20),
    IN Precio DECIMAL(10,2),
    IN Imagen VARCHAR(255)
)
BEGIN

    INSERT INTO tblComidas (vchNombre, fltPrecio, vchImagen)
    VALUES (Nombre, Precio, Imagen);

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

/* Procedure structure for procedure `spInsertarPago` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarPago` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarPago`(
    IN Cliente VARCHAR(100),
    IN pMonto DECIMAL(10,2),
    IN pFechaPago DATE,
    IN pMetodoPago VARCHAR(50)
)
BEGIN
    DECLARE pIdCliente INT;
    DECLARE pIdReserva INT;

    SELECT IdCliente
    INTO pIdCliente
    FROM tblcliente
    WHERE vchNombre = Cliente;

    SELECT IdReserva
    INTO pIdReserva
    FROM tblreserva
    WHERE IdCliente = pIdCliente
    ORDER BY dtFecha DESC, HoraInicio DESC
    LIMIT 1;

    -- Insertar el pago en la tabla tblPago
    INSERT INTO tblPago (IdCliente, IdReserva, Monto, FechaPago, MetodoPago)
    VALUES (pIdCliente, pIdReserva, pMonto, pFechaPago, pMetodoPago);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spInsertarPostre` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarPostre` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarPostre`(
    IN Nombre VARCHAR(50),
    IN Precio DECIMAL(10,2),
    IN Imagen VARCHAR(255)
)
BEGIN

    INSERT INTO tblPostres (Nombre, fltPrecio, vchImagen)
    VALUES (Nombre, Precio, Imagen);

END */$$
DELIMITER ;

/* Procedure structure for procedure `spInsertarUsuarios` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarUsuarios` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarUsuarios`(
    IN nombre VARCHAR(20),
    IN apellido VARCHAR(20),
    IN tel VARCHAR(13),
    IN email VARCHAR(150),
    IN pass VARCHAR(500),
    IN tipoU ENUM('Cliente', 'Empleado')
)
BEGIN
    INSERT INTO tblusuarios (vchNombre, vchApellidos, vchNoTelefono, vchEmail, vchPassword,  TipoUsuario)
    VALUES (nombre, apellido, tel, email, MD5(pass), tipoU);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spInsertarZona` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarZona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarZona`(
    IN Ubi VARCHAR(100),
    IN Imagen VARCHAR(100)
)
BEGIN
    INSERT INTO tblzona (vchUbicacion, vchImagen)
    VALUES (Ubi, Imagen);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spLogin` */

/*!50003 DROP PROCEDURE IF EXISTS  `spLogin` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spLogin`(IN email VARCHAR(200), IN pass VARCHAR(200), OUT respuesta bool)
BEGIN
	IF EXISTS  (SELECT vchEmail,vchPassword FROM tblusuarios
		WHERE vchEmail= email AND vchPassword = mD5(pass)) THEN
		SET respuesta = TRUE;
	ELSE
		SET respuesta= FALSE;
	END IF;
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
