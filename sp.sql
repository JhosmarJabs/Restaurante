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
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bdreservarestaurante` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `bdreservarestaurante`;

/* Procedure structure for procedure `ObtenerUltimaReserva` */

/*!50003 DROP PROCEDURE IF EXISTS  `ObtenerUltimaReserva` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerUltimaReserva`(IN idCliente INT, OUT idReserva INT)
BEGIN
    -- Asegúrate de que el nombre de la columna en la cláusula ORDER BY es correcto
    SELECT idReserva
    FROM tblreserva
    WHERE idUsuario = idUsuario
    ORDER BY fecha_reserva DESC
    LIMIT 1;
    
    -- Asigna el resultado a la variable OUT
    SET idReserva = (SELECT idReserva FROM reservas WHERE idUsuario = idUsuario ORDER BY fecha_reserva DESC LIMIT 1);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spActualizarBebida` */

/*!50003 DROP PROCEDURE IF EXISTS  `spActualizarBebida` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarBebida`(
    IN pIdBebida INT,
    IN pNombre VARCHAR(255),
    IN pDescripcion TEXT,
    IN pPrecio FLOAT
)
BEGIN
    UPDATE tblbebidas
    SET 
        vchNombre = pNombre,
        fltPrecio = pPrecio,
        vchDescripcion = pDescripcion
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
    IN pPrecio FLOAT
)
BEGIN
    UPDATE tblcomidas
    SET 
        vchNombre = pNombre,
        vchDescripcion = pDescripcion,
        fltPrecio = pPrecio
    WHERE 
        IdComida = pIdComida;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spActualizarEmpleado` */

/*!50003 DROP PROCEDURE IF EXISTS  `spActualizarEmpleado` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarEmpleado`(
    IN pIdUsuario INT,
    IN pNombre VARCHAR(255),
    IN pApellidos VARCHAR(255),
    IN pTelefono VARCHAR(20),
    IN pEmail VARCHAR(255)
)
BEGIN
    UPDATE tblusuarios
    SET 
        vchNombre = pNombre,
        vchApellidos = pApellidos,
        vchNoTelefono = pTelefono,
        vchEmail = pEmail
    WHERE 
        idUsuario = pIdUsuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spActualizarMesa` */

/*!50003 DROP PROCEDURE IF EXISTS  `spActualizarMesa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarMesa`(
    IN pIdMesa INT,
    IN pClaveMesa VARCHAR(5),
    IN pCapacidad INT,
    IN pCosto FLOAT
)
BEGIN
    -- Actualizar tabla tblmesa
    UPDATE tblmesa
    SET 
        ClaveMesa = pClaveMesa,
        Capasidad = pCapacidad,
        Costo = pCosto
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
    IN pPrecio FLOAT
)
BEGIN
    UPDATE tblpostres
    SET 
        vchNombre = pNombre,
        vchDescripcion = pDescripcion,
        fltPrecio = pPrecio
    WHERE 
        IdPostre = pIdPostre;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spActualizarZona` */

/*!50003 DROP PROCEDURE IF EXISTS  `spActualizarZona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarZona`(
    IN pIdZona INT,
    IN pUbicacion VARCHAR(255)
)
BEGIN
    UPDATE tblzona
    SET 
        vchUbicacion = pUbicacion
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

/* Procedure structure for procedure `spConsultarClientes` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarClientes` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarClientes`(in IdCliente int)
BEGIN
	SELECT vchNombre, vchApellidos, vchNotelefono, vchEmail
	FROM tblusuarios
	WHERE idUsuario = IdCliente;
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

/* Procedure structure for procedure `spConsultarEliminaciones` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarEliminaciones` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarEliminaciones`()
BEGIN
    SELECT 
        idBitacora,
        tabla,
        informacion_eliminada,
        tipo_accion,
        fecha_accion
    FROM 
        bitacora_eliminaciones;
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

/* Procedure structure for procedure `spConsultarOcaciones` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarOcaciones` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarOcaciones`()
BEGIN
    SELECT IdOcasiones, vchNombreOcasiones
    FROM tblOcasiones;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spConsultarPostres` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarPostres` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarPostres`()
BEGIN
	SELECT idPostre, vchNombre, fltPrecio,vchDescripcion, vchImagen
	FROM tblpostres;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spConsultarReservaciones` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarReservaciones` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarReservaciones`(
    IN pIdCliente INT
)
BEGIN
    SELECT 
        NombreCompletoCliente,
        Telefono,
        CorreoElectronico,
        IdReserva,
        FechaReserva,
        HoraInicio,
        HoraFinal,
        vchOcacion,
        NoPersonas,
        UbicacionZona,
        Mesas,
        CostoTotalMesas,
        Ocasiones,
        Monto,
        Restante,
        FechaPago
    FROM vistaClientesConReservas
    WHERE IdCliente = pIdCliente;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spConsultarReservas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarReservas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarReservas`(
    IN pFechaReserva DATE
)
BEGIN
    SELECT 
        IdCliente,
        NombreCompletoCliente,
        Telefono,
        CorreoElectronico,
        IdReserva,
        FechaReserva,
        HoraInicio,
        HoraFinal,
        vchOcacion,
        NoPersonas,
        UbicacionZona,
        Mesas,
        CostoTotalMesas,
        Ocasiones,
        Monto,
        Restante,
        FechaPago
    FROM vistaClientesConReservas
    WHERE FechaReserva = pFechaReserva;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spConsultarTblEliminadas` */

/*!50003 DROP PROCEDURE IF EXISTS  `spConsultarTblEliminadas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarTblEliminadas`()
BEGIN
    -- Seleccionar valores únicos de la columna 'tabla'
    SELECT DISTINCT tabla FROM bitacora_eliminaciones;
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
    in idCliente int,
    in telefono VARCHAR(20),
    IN Fecha DATE,
    IN HoraI TIME,
    IN HoraF TIME,
    IN Ocacion VARCHAR(100),
    IN NumPersonas INT,
    IN Zona INT
)
BEGIN

    -- Crear la reserva
    INSERT INTO tblreserva (IdCliente, dtFecha, HoraInicio, HoraFinal, vchOcacion, NoPersonas, IdZona)
    VALUES (idCliente, Fecha, HoraI, HoraF, Ocacion, NumPersonas, Zona);
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

/* Procedure structure for procedure `spEliminarEmpleado` */

/*!50003 DROP PROCEDURE IF EXISTS  `spEliminarEmpleado` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarEmpleado`(
    IN pIdUsuario INT
)
BEGIN
    DELETE FROM tblusuarios
    WHERE 
        idUsuario = pIdUsuario;
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

/* Procedure structure for procedure `spFiltroBitacora` */

/*!50003 DROP PROCEDURE IF EXISTS  `spFiltroBitacora` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spFiltroBitacora`(IN p_fecha_accion DATE, IN p_tabla VARCHAR(50))
BEGIN
    -- Filtrar la tabla bitacora_eliminaciones con base en la fecha_accion y la tabla proporcionadas
    SELECT * 
    FROM bitacora_eliminaciones
    WHERE DATE(fecha_accion) = p_fecha_accion
    AND tabla = p_tabla;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spInsertarBebida` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarBebida` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarBebida`(
    IN Nombre VARCHAR(50),
    IN Precio DECIMAL(10,2),
        IN Descripcion TEXT,
    IN Imagen VARCHAR(255)
)
BEGIN

    INSERT INTO tblBebidas (vchNombre,vchDescripcion, fltPrecio, vchImagen)
    VALUES (Nombre, Descripcion, Precio, Imagen);

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
            IN Descripcion TEXT,
    IN Imagen VARCHAR(255)
)
BEGIN

    INSERT INTO tblComidas(vchNombre,vchDescripcion, fltPrecio, vchImagen)
    VALUES (Nombre, Descripcion, Precio, Imagen);

END */$$
DELIMITER ;

/* Procedure structure for procedure `spInsertarMesa` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarMesa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarMesa`(
    IN Clave VARCHAR(10),
    IN capacidad INT,
    IN zona INT,
    IN costo DECIMAL(10,2),
    IN imagen VARCHAR(100)
)
BEGIN
    INSERT INTO tblmesa (ClaveMesa, Capasidad, Costo, IdZona, vchImagen)
    VALUES (Clave, capacidad, costo, zona, imagen);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spInsertarPago` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarPago` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarPago`(
    IN pIdCliente VARCHAR(100),
    IN pMonto DECIMAL(10,2),
    IN pRestante DECIMAL(10,2)
)
BEGIN
    DECLARE pIdReserva INT;

    -- Obtener el ID de la reserva más reciente del cliente
    SELECT IdReserva
    INTO pIdReserva
    FROM tblreserva
    WHERE IdCliente = pIdCliente
    ORDER BY dtFecha DESC, HoraInicio DESC
    LIMIT 1;  -- Asegura que solo se obtenga la reserva más reciente

    -- Insertar el pago en la tabla tblPago
    INSERT INTO tblPago (IdCliente, IdReserva, Monto, Restante, FechaPago)
    VALUES (pIdCliente, pIdReserva, pMonto, pRestante, CURDATE());
END */$$
DELIMITER ;

/* Procedure structure for procedure `spInsertarPostre` */

/*!50003 DROP PROCEDURE IF EXISTS  `spInsertarPostre` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarPostre`(
    IN Nombre VARCHAR(50),
    IN Precio DECIMAL(10,2),
            IN Descripcion TEXT,
    IN Imagen VARCHAR(255)
)
BEGIN

    INSERT INTO tblPostres (vchNombre,vchDescripcion, fltPrecio, vchImagen)
    VALUES (Nombre, Descripcion, Precio, Imagen);
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

/* Procedure structure for procedure `SumaCostoUltimaReserva` */

/*!50003 DROP PROCEDURE IF EXISTS  `SumaCostoUltimaReserva` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SumaCostoUltimaReserva`(
    IN pIdCliente INT,
    OUT pTotalCosto DECIMAL(10,2)
)
BEGIN
    DECLARE vUltimaReserva INT;

    -- Buscar el último IdReserva para el cliente especificado
    SELECT MAX(IdReserva) INTO vUltimaReserva
    FROM tblreserva
    WHERE IdCliente = pIdCliente;

    -- Si existe una reserva para el cliente, calcular el total de costos
    IF vUltimaReserva IS NOT NULL THEN
        SELECT COALESCE(SUM(fltCosto), 0) INTO pTotalCosto
        FROM tblreservadetalle
        WHERE IdReserva = vUltimaReserva;
    ELSE
        -- Si no hay reserva para el cliente, retornar 0
        SET pTotalCosto = 0;
    END IF;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
