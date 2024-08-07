-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-08-2024 a las 19:55:39
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdreservarestaurante`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerUltimaReserva` (IN `idCliente` INT, OUT `idReserva` INT)   BEGIN
    -- Asegúrate de que el nombre de la columna en la cláusula ORDER BY es correcto
    SELECT idReserva
    FROM tblreserva
    WHERE idUsuario = idUsuario
    ORDER BY fecha_reserva DESC
    LIMIT 1;
    
    -- Asigna el resultado a la variable OUT
    SET idReserva = (SELECT idReserva FROM reservas WHERE idUsuario = idUsuario ORDER BY fecha_reserva DESC LIMIT 1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarBebida` (IN `pIdBebida` INT, IN `pNombre` VARCHAR(255), IN `pDescripcion` TEXT, IN `pPrecio` FLOAT)   BEGIN
    UPDATE tblbebidas
    SET 
        vchNombre = pNombre,
        fltPrecio = pPrecio,
        vchDescripcion = pDescripcion
    WHERE 
        IdBebida = pIdBebida;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarCliente` (IN `pIdCliente` INT, IN `pNombre` VARCHAR(255), IN `pApellidos` VARCHAR(255), IN `pTelefono` VARCHAR(20), IN `pEmail` VARCHAR(255))   BEGIN
    UPDATE tblclientes
    SET 
        vchNombre = pNombre,
        vchApellidos = pApellidos,
        vchTelefono = pTelefono,
        vchEmail = pEmail
    WHERE 
        IdCliente = pIdCliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarComida` (IN `pIdComida` INT, IN `pNombre` VARCHAR(20), IN `pDescripcion` TEXT, IN `pPrecio` FLOAT)   BEGIN
    UPDATE tblcomidas
    SET 
        vchNombre = pNombre,
        vchDescripcion = pDescripcion,
        fltPrecio = pPrecio
    WHERE 
        IdComida = pIdComida;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarEmpleado` (IN `pIdUsuario` INT, IN `pNombre` VARCHAR(255), IN `pApellidos` VARCHAR(255), IN `pTelefono` VARCHAR(20), IN `pEmail` VARCHAR(255))   BEGIN
    UPDATE tblusuarios
    SET 
        vchNombre = pNombre,
        vchApellidos = pApellidos,
        vchNoTelefono = pTelefono,
        vchEmail = pEmail
    WHERE 
        idUsuario = pIdUsuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarMesa` (IN `pIdMesa` INT, IN `pClaveMesa` VARCHAR(5), IN `pCapacidad` INT, IN `pCosto` FLOAT)   BEGIN
    -- Actualizar tabla tblmesa
    UPDATE tblmesa
    SET 
        ClaveMesa = pClaveMesa,
        Capasidad = pCapacidad,
        Costo = pCosto
    WHERE 
        IdMesa = pIdMesa;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarPostre` (IN `pIdPostre` INT, IN `pNombre` VARCHAR(255), IN `pDescripcion` TEXT, IN `pPrecio` FLOAT)   BEGIN
    UPDATE tblpostres
    SET 
        vchNombre = pNombre,
        vchDescripcion = pDescripcion,
        fltPrecio = pPrecio
    WHERE 
        IdPostre = pIdPostre;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spActualizarZona` (IN `pIdZona` INT, IN `pUbicacion` VARCHAR(255))   BEGIN
    UPDATE tblzona
    SET 
        vchUbicacion = pUbicacion
    WHERE 
        IdZona = pIdZona;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spAsignarMesas` (IN `numeroPersonas` INT, IN `zona` INT)   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spCalcularCosto` (IN `nombreCliente` VARCHAR(150))   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarBebidas` ()   BEGIN
	SELECT idBebida, vchnombre, fltPrecio,vchDescripcion, vchImagen
	FROM tblbebidas;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarClientes` (IN `IdCliente` INT)   BEGIN
	SELECT vchNombre, vchApellidos, vchNotelefono, vchEmail
	FROM tblusuarios
	WHERE idUsuario = IdCliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarComidas` ()   BEGIN
	SELECT idComida, vchNombre, fltPrecio,vchDescripcion, vchImagen
	FROM tblcomidas;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarDatos` (IN `email` VARCHAR(200))   BEGIN
		SELECT idUsuario, vchNombre, TipoUsuario FROM tblusuarios
		WHERE vchEmail = email;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarEliminaciones` ()   BEGIN
    SELECT 
        idBitacora,
        tabla,
        informacion_eliminada,
        tipo_accion,
        fecha_accion
    FROM 
        bitacora_eliminaciones;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarEmpleados` ()   BEGIN
	SELECT idUsuario, vchNombre, vchApellidos, vchNotelefono, vchEmail
	FROM tblusuarios
	WHERE TipoUsuario = 'Empleado';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarMesas` ()   BEGIN
	SELECT M.IdMesa, M.ClaveMesa, M.Capasidad, M.costo, Z.vchUbicacion, M.vchImagen
	FROM tblmesa M, tblzona Z 
	where M.idzona = Z.IdZona;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarOcaciones` ()   BEGIN
    SELECT IdOcasiones, vchNombreOcasiones
    FROM tblOcasiones;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarPostres` ()   BEGIN
	SELECT idPostre, vchNombre, fltPrecio,vchDescripcion, vchImagen
	FROM tblpostres;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarReservaciones` (IN `pIdCliente` INT)   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarReservas` (IN `pFechaReserva` DATE)   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarTblEliminadas` ()   BEGIN
    -- Seleccionar valores únicos de la columna 'tabla'
    SELECT DISTINCT tabla FROM bitacora_eliminaciones;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarZona` ()   BEGIN
	SELECT IdZona, vchUbicacion, vchImagen
	FROM tblzona;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spCrearReserva` (IN `idCliente` INT, IN `telefono` VARCHAR(20), IN `Fecha` DATE, IN `HoraI` TIME, IN `HoraF` TIME, IN `Ocacion` VARCHAR(100), IN `NumPersonas` INT, IN `Zona` INT)   BEGIN

    -- Crear la reserva
    INSERT INTO tblreserva (IdCliente, dtFecha, HoraInicio, HoraFinal, vchOcacion, NoPersonas, IdZona)
    VALUES (idCliente, Fecha, HoraI, HoraF, Ocacion, NumPersonas, Zona);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spCrearZona` (IN `Ubi` VARCHAR(100), IN `Imagen` VARCHAR(100))   BEGIN
    INSERT INTO tblzona (Ubicacion, vchImagen)
    VALUES (Ubi, Imagen);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarBebida` (IN `pIdBebida` INT)   BEGIN
    DELETE FROM tblbebidas
    WHERE 
        IdBebida = pIdBebida;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarCliente` (IN `pIdCliente` INT)   BEGIN
    DELETE FROM tblclientes
    WHERE 
        IdCliente = pIdCliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarComida` (IN `pIdComida` INT)   BEGIN
    DELETE FROM tblcomidas
    WHERE 
        IdComida = pIdComida;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarEmpleado` (IN `pIdUsuario` INT)   BEGIN
    DELETE FROM tblusuarios
    WHERE 
        idUsuario = pIdUsuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarMesa` (IN `pIdMesa` INT)   BEGIN
    DELETE FROM tblmesa
    WHERE 
        IdMesa = pIdMesa;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarPostre` (IN `pIdPostre` INT)   BEGIN
    DELETE FROM tblpostres
    WHERE 
        IdPostre = pIdPostre;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarZona` (IN `pIdZona` INT)   BEGIN
    DELETE FROM tblzona
    WHERE 
        IdZona = pIdZona;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spFiltroBitacora` (IN `p_fecha_accion` DATE, IN `p_tabla` VARCHAR(50))   BEGIN
    -- Filtrar la tabla bitacora_eliminaciones con base en la fecha_accion y la tabla proporcionadas
    SELECT * 
    FROM bitacora_eliminaciones
    WHERE DATE(fecha_accion) = p_fecha_accion
    AND tabla = p_tabla;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarBebida` (IN `Nombre` VARCHAR(50), IN `Precio` DECIMAL(10,2), IN `Descripcion` TEXT, IN `Imagen` VARCHAR(255))   BEGIN

    INSERT INTO tblBebidas (vchNombre,vchDescripcion, fltPrecio, vchImagen)
    VALUES (Nombre, Descripcion, Precio, Imagen);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarCliente` (IN `ClNombre` VARCHAR(50), IN `APaterno` VARCHAR(50), IN `AMaterno` VARCHAR(50), IN `NumTelefono` VARCHAR(15), IN `Email` VARCHAR(100))   BEGIN
    INSERT INTO tblcliente (Nombre, ApellidoPaterno, ApellidoMaterno, Telefono, CorreoElectronico)
    VALUES (ClNombre, APaterno, AMaterno, NumTelefono, Email);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarComida` (IN `Nombre` VARCHAR(20), IN `Precio` DECIMAL(10,2), IN `Descripcion` TEXT, IN `Imagen` VARCHAR(255))   BEGIN

    INSERT INTO tblComidas(vchNombre,vchDescripcion, fltPrecio, vchImagen)
    VALUES (Nombre, Descripcion, Precio, Imagen);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarMesa` (IN `Clave` VARCHAR(10), IN `capacidad` INT, IN `zona` INT, IN `costo` DECIMAL(10,2), IN `imagen` VARCHAR(100))   BEGIN
    INSERT INTO tblmesa (ClaveMesa, Capasidad, Costo, IdZona, vchImagen)
    VALUES (Clave, capacidad, costo, zona, imagen);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarPago` (IN `pIdCliente` VARCHAR(100), IN `pMonto` DECIMAL(10,2), IN `pRestante` DECIMAL(10,2))   BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarPostre` (IN `Nombre` VARCHAR(50), IN `Precio` DECIMAL(10,2), IN `Descripcion` TEXT, IN `Imagen` VARCHAR(255))   BEGIN

    INSERT INTO tblPostres (vchNombre,vchDescripcion, fltPrecio, vchImagen)
    VALUES (Nombre, Descripcion, Precio, Imagen);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarUsuarios` (IN `nombre` VARCHAR(20), IN `apellido` VARCHAR(20), IN `tel` VARCHAR(13), IN `email` VARCHAR(150), IN `pass` VARCHAR(500), IN `tipoU` ENUM('Cliente','Empleado'))   BEGIN
    INSERT INTO tblusuarios (vchNombre, vchApellidos, vchNoTelefono, vchEmail, vchPassword,  TipoUsuario)
    VALUES (nombre, apellido, tel, email, MD5(pass), tipoU);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarZona` (IN `Ubi` VARCHAR(100), IN `Imagen` VARCHAR(100))   BEGIN
    INSERT INTO tblzona (vchUbicacion, vchImagen)
    VALUES (Ubi, Imagen);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spLogin` (IN `email` VARCHAR(200), IN `pass` VARCHAR(200), OUT `respuesta` BOOL)   BEGIN
	IF EXISTS  (SELECT vchEmail,vchPassword FROM tblusuarios
		WHERE vchEmail= email AND vchPassword = mD5(pass)) THEN
		SET respuesta = TRUE;
	ELSE
		SET respuesta= FALSE;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SumaCostoUltimaReserva` (IN `pIdCliente` INT, OUT `pTotalCosto` DECIMAL(10,2))   BEGIN
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
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_eliminaciones`
--

CREATE TABLE `bitacora_eliminaciones` (
  `idBitacora` int(11) NOT NULL,
  `tabla` varchar(50) DEFAULT NULL,
  `informacion_eliminada` varchar(255) DEFAULT NULL,
  `tipo_accion` varchar(50) DEFAULT NULL,
  `fecha_accion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora_eliminaciones`
--

INSERT INTO `bitacora_eliminaciones` (`idBitacora`, `tabla`, `informacion_eliminada`, `tipo_accion`, `fecha_accion`) VALUES
(2, 'tblzona', 'ID: 19, Ubicación: pruevas, Imagen: images.png', 'DELETE', '2024-08-06'),
(3, 'tblzona', 'ID: 20, Ubicación: pruevas, Imagen: ZonaComun.webp', 'DELETE', '2024-08-06'),
(5, 'tblUsuarios', 'ID:30, Nombre:Juan, Email:juan.perez@example.com, Tipo:Empleado', 'DELETE', '2024-08-06'),
(6, 'tblpostres', 'ID: 11, Nombre: Pastel de Chocolate', 'DELETE', '2024-08-06'),
(7, 'tblbebidas', 'ID: 10, Nombre: Limonada', 'DELETE', '2024-08-06'),
(8, 'tblcomidas', 'ID: 9, Nombre: Tacos al Pastor', 'DELETE', '2024-08-06'),
(9, 'tblbebidas', 'ID: 11, Nombre: Limonada', 'DELETE', '2024-08-06'),
(10, 'tblcomidas', 'ID: 10, Nombre: Tacos al Pastor', 'DELETE', '2024-08-06'),
(11, 'tblpostres', 'ID: 12, Nombre: Pastel de Chocolate', 'DELETE', '2024-08-06'),
(12, 'tblzona', 'ID: 22, Ubicación: Zona A, Imagen: zona_a.jpg', 'DELETE', '2024-08-06'),
(13, 'tblzona', 'ID: 21, Ubicación: Zona A, Imagen: zona_a.jpg', 'DELETE', '2024-08-06'),
(14, 'tblUsuarios', 'ID:31, Nombre:Juan, Email:juan.perez@example.com, Tipo:Empleado', 'DELETE', '2024-08-06'),
(15, 'tblmesa', 'ID: 33, Clave: M3, Capacidad: 4, Costo: 500.00, Zona: 4, Imagen: mesa_001.jpg', 'DELETE', '2024-08-06'),
(16, 'tblmesa', 'ID: 36, Clave: j2, Capacidad: 8, Costo: 1234.00, Zona: 2, Imagen: images.png', 'DELETE', '2024-08-06'),
(17, 'tblmesa', 'ID: 37, Clave: j2, Capacidad: 8, Costo: 1234.00, Zona: 2, Imagen: images.png', 'DELETE', '2024-08-06'),
(18, 'tblmesa', 'ID: 38, Clave: j2, Capacidad: 8, Costo: 1234.00, Zona: 2, Imagen: images.png', 'DELETE', '2024-08-06'),
(19, 'tblmesa', 'ID: 35, Clave: M1, Capacidad: 4, Costo: 50.00, Zona: 4, Imagen: mesa_001.jpg', 'DELETE', '2024-08-06'),
(20, 'tblmesa', 'ID: 39, Clave: j2, Capacidad: 6, Costo: 1234.00, Zona: 2, Imagen: images.png', 'DELETE', '2024-08-06'),
(21, 'tblbebidas', 'ID: 12, Nombre: Limonad', 'DELETE', '2024-08-06'),
(22, 'tblUsuarios', 'ID:32, Nombre:Juan, Email:juan.perez@example.com, Tipo:Empleado', 'DELETE', '2024-08-06'),
(23, 'tblbebidas', 'ID: 13, Nombre: jabs', 'DELETE', '2024-08-06'),
(24, 'tblcomidas', 'ID: 11, Nombre: Tacos al Pastor', 'DELETE', '2024-08-06'),
(25, 'tblcomidas', 'ID: 12, Nombre: Jabs', 'DELETE', '2024-08-06'),
(26, 'tblpostres', 'ID: 14, Nombre: JABS', 'DELETE', '2024-08-06'),
(27, 'tblpostres', 'ID: 13, Nombre: Pastel de Chocolate', 'DELETE', '2024-08-06'),
(28, 'tblmesa', 'ID: 31, Clave: m1, Capacidad: 6, Costo: 300.00, Zona: 1, Imagen: mesa_001.jpg', 'DELETE', '2024-08-06'),
(29, 'tblmesa', 'ID: 40, Clave: j2, Capacidad: 8, Costo: 1234.00, Zona: 1, Imagen: images.png', 'DELETE', '2024-08-06'),
(30, 'tblzona', 'ID: 23, Ubicación: pruevas, Imagen: images.png', 'DELETE', '2024-08-06'),
(31, 'tblzona', 'ID: 24, Ubicación: Zona A, Imagen: zona_a.jpg', 'DELETE', '2024-08-06'),
(32, NULL, NULL, NULL, '2024-08-06'),
(33, 'tblUsuarios', 'ID:17, Nombre:Diana, Email:Diana@gmail.com, Tipo:Empleado', 'DELETE', '0000-00-00'),
(34, 'tblUsuarios', 'ID:25, Nombre:JABSALDAIR, Email:JABSALDAIR@gmail.com, Tipo:Empleado', 'DELETE', '0000-00-00'),
(35, 'tblUsuarios', 'ID:28, Nombre:Josmar, Email:Josmar1234567890@gmail.com, Tipo:Empleado', 'DELETE', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblbebidas`
--

CREATE TABLE `tblbebidas` (
  `idBebida` int(11) NOT NULL,
  `vchNombre` varchar(50) DEFAULT NULL,
  `fltPrecio` decimal(10,2) DEFAULT NULL,
  `vchDescripcion` varchar(255) DEFAULT NULL,
  `vchImagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblbebidas`
--

INSERT INTO `tblbebidas` (`idBebida`, `vchNombre`, `fltPrecio`, `vchDescripcion`, `vchImagen`) VALUES
(1, 'Coca Cola', '25.00', 'Deliciosa coca cola fria, refresca tu paladar', 'cocacola.jpeg'),
(2, 'Pepsi', '20.00', 'Pepsi super fria, disfruta de nuestro sabor', 'pepsi.jpg'),
(3, 'Agua Mineral', '15.00', 'Refrescate y disfruta con Agua mineral', 'aguamineral.jpg'),
(4, 'Jugo de Naranja', '27.00', 'Jugo de naranja recien hecho, del arbol a tu paladar', 'jugodenaranja.jpg'),
(5, 'Cerveza', '40.00', 'Delicisa cerveza fria,especialidad a escoger', 'cerveza.webp'),
(6, 'Limonada', '35.00', 'Refrescante limonada recien hecha super fria', 'limonada.jpeg'),
(7, 'Piña Colada', '70.00', 'Deliciosa piña colada,con fruta natural,con y sin alcohol', 'piñacolada.jpg'),
(9, 'Mojito', '64.00', 'Refrescante mojito,tequila a escoger con rodajas de limon y hojas menta', 'mojito.jpg');

--
-- Disparadores `tblbebidas`
--
DELIMITER $$
CREATE TRIGGER `after_delete_bebida` AFTER DELETE ON `tblbebidas` FOR EACH ROW BEGIN
    INSERT INTO bitacora_eliminaciones (tabla, informacion_eliminada, tipo_accion) 
    VALUES ('tblbebidas', CONCAT('ID: ', OLD.idBebida, ', Nombre: ', OLD.vchNombre), 'DELETE');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcliente`
--

CREATE TABLE `tblcliente` (
  `IdCliente` int(11) NOT NULL,
  `vchNombre` varchar(50) DEFAULT NULL,
  `vchApellidos` varchar(50) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `CorreoElectronico` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblcliente`
--

INSERT INTO `tblcliente` (`IdCliente`, `vchNombre`, `vchApellidos`, `Telefono`, `CorreoElectronico`) VALUES
(1, 'Bautista', 'Saavedra', '+5217712194196', '20230026@uthh.edu.mx'),
(2, 'Palacios', 'Hernandez', '+5217715563522', '20230082@uthh.edu.mx'),
(3, 'Hernandez', 'Meza', '+5217712170532', '20230106@uthh.edu.mx'),
(4, 'Torres', 'Badillo', '+5217712174809', '20230098@uthh.edu.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcomidas`
--

CREATE TABLE `tblcomidas` (
  `idComida` int(11) NOT NULL,
  `vchNombre` varchar(20) DEFAULT NULL,
  `fltPrecio` decimal(10,2) DEFAULT NULL,
  `vchDescripcion` varchar(200) DEFAULT NULL,
  `vchImagen` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblcomidas`
--

INSERT INTO `tblcomidas` (`idComida`, `vchNombre`, `fltPrecio`, `vchDescripcion`, `vchImagen`) VALUES
(1, 'Pizza', '141.00', 'Masa crujiente, salsa de tomate deliciosa y queso derretido que te hará sonreír.', 'PizzaMediana.jpeg'),
(2, 'Hamburguesa', '90.00', 'Pan,carne deliciosa,queso amarillo derretido,jamon,tomate´,aguacate y capsu a su gusto', 'Hamburguesa.jpg'),
(3, 'Ensalada', '85.00', 'Lechuga fresca,rodajas de fresa,fajitas de pollo,nuez,pepino y pan tostado', 'ensalada.jpeg'),
(4, 'Pasta', '120.00', 'Pasta recien hecha,salsa a escoger,queso mozarella y un toque de peregil', 'pasta.jpg'),
(5, 'Tacos', '75.00', 'Tortilla recien hecha, salsa a escoger, especialidades', 'tacos.webp'),
(6, 'pulpo en crema', '350.00', 'Delicioso pulpo a la braza en una crema de chipotle', 'pulpoencrema.jpg'),
(7, 'Sushi', '350.00', 'Distintas presentaciones de sushis a escoger', 'sushi.webp'),
(8, 'Corte', '401.00', 'Corte de carne a la braza, acompañada de esparragos y papas a la francesa', 'corte.webp');

--
-- Disparadores `tblcomidas`
--
DELIMITER $$
CREATE TRIGGER `after_delete_comida` AFTER DELETE ON `tblcomidas` FOR EACH ROW BEGIN
    INSERT INTO bitacora_eliminaciones (tabla, informacion_eliminada, tipo_accion) 
    VALUES ('tblcomidas', CONCAT('ID: ', OLD.idComida, ', Nombre: ', OLD.vchNombre), 'DELETE');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmenu`
--

CREATE TABLE `tblmenu` (
  `idMenu` int(11) NOT NULL,
  `idComida` int(11) DEFAULT NULL,
  `idBebida` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblmenu`
--

INSERT INTO `tblmenu` (`idMenu`, `idComida`, `idBebida`, `precio`) VALUES
(1, 1, NULL, '141.99'),
(2, 2, NULL, '129.99'),
(3, 3, NULL, '80.50'),
(4, 4, NULL, '70.75'),
(5, 5, NULL, '90.00'),
(6, NULL, 1, '15.99'),
(7, NULL, 2, '13.99'),
(8, NULL, 3, '12.50'),
(9, NULL, 4, '14.75'),
(10, NULL, 5, '16.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmesa`
--

CREATE TABLE `tblmesa` (
  `IdMesa` int(11) NOT NULL,
  `ClaveMesa` varchar(10) DEFAULT NULL,
  `Capasidad` int(11) DEFAULT NULL,
  `Costo` decimal(10,2) DEFAULT NULL,
  `IdZona` int(11) DEFAULT NULL,
  `vchImagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblmesa`
--

INSERT INTO `tblmesa` (`IdMesa`, `ClaveMesa`, `Capasidad`, `Costo`, `IdZona`, `vchImagen`) VALUES
(1, 'T1', 4, '300.00', 1, 'mesa1.webp'),
(2, 'T2', 4, '300.00', 1, 'mesa2.jpg'),
(3, 'T3', 6, '450.00', 1, 'mesa3.jpg'),
(4, 'T4', 8, '600.00', 1, 'mesa4.jpg'),
(5, 'T5', 4, '300.00', 1, 'mesa5.jpg'),
(6, 'TV1', 4, '300.00', 2, 'mesa6.jpg'),
(7, 'TV2', 4, '300.00', 2, 'mesa7.jpg'),
(8, 'TV3', 6, '450.00', 2, 'mesa8.jpg'),
(9, 'TV4', 8, '600.00', 2, 'mesa9.jpg'),
(10, 'TV5', 4, '300.00', 2, 'mesa10.webp'),
(11, 'ZV1', 4, '300.00', 3, 'mesa11.webp'),
(12, 'ZV2', 4, '300.00', 3, 'mesa12.jpg'),
(13, 'ZV3', 6, '450.00', 3, 'mesa13.jpg'),
(14, 'ZV4', 8, '600.00', 3, 'mesa14.jpg'),
(15, 'ZV5', 4, '300.00', 3, 'mesa15.jpg'),
(16, 'ZC1', 4, '300.00', 4, 'mesa16.jpeg'),
(17, 'ZC2', 4, '300.00', 4, 'mesa17.jpg'),
(18, 'ZC3', 6, '450.00', 4, 'mesa8.jpg'),
(19, 'ZC4', 8, '600.00', 4, 'mesa3.jpg'),
(20, 'ZC5', 4, '300.00', 4, 'mesa6.jpg');

--
-- Disparadores `tblmesa`
--
DELIMITER $$
CREATE TRIGGER `after_delete_mesa` AFTER DELETE ON `tblmesa` FOR EACH ROW BEGIN
    INSERT INTO bitacora_eliminaciones (tabla, informacion_eliminada, tipo_accion) 
    VALUES ('tblmesa', CONCAT('ID: ', OLD.IdMesa, ', Clave: ', OLD.ClaveMesa, ', Capacidad: ', OLD.Capasidad, ', Costo: ', OLD.Costo, ', Zona: ', OLD.IdZona, ', Imagen: ', OLD.vchImagen), 'DELETE');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblocasiones`
--

CREATE TABLE `tblocasiones` (
  `IdOcasiones` int(11) NOT NULL,
  `vchNombreOcasiones` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblocasiones`
--

INSERT INTO `tblocasiones` (`IdOcasiones`, `vchNombreOcasiones`) VALUES
(1, 'Cumpleaños'),
(2, 'Aniversario'),
(3, 'Graduación'),
(4, 'Celebración de Trabajo'),
(5, 'Cena Romántica'),
(6, 'Reunión Familiar'),
(7, 'Despedida de Soltero(a)'),
(8, 'Agradecimiento'),
(9, 'Fiesta de Fin de Año');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpago`
--

CREATE TABLE `tblpago` (
  `IdPago` int(11) NOT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `IdReserva` int(11) DEFAULT NULL,
  `Monto` decimal(10,2) DEFAULT NULL,
  `Restante` decimal(10,2) DEFAULT NULL,
  `FechaPago` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblpago`
--

INSERT INTO `tblpago` (`IdPago`, `IdCliente`, `IdReserva`, `Monto`, `Restante`, `FechaPago`) VALUES
(1, 2, 1, '1000.00', '350.00', '2024-08-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpostres`
--

CREATE TABLE `tblpostres` (
  `idPostre` int(11) NOT NULL,
  `vchNombre` varchar(50) DEFAULT NULL,
  `fltPrecio` decimal(10,2) DEFAULT NULL,
  `vchDescripcion` varchar(255) DEFAULT NULL,
  `vchImagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblpostres`
--

INSERT INTO `tblpostres` (`idPostre`, `vchNombre`, `fltPrecio`, `vchDescripcion`, `vchImagen`) VALUES
(1, 'Pastel chocolate', '70.00', 'Pan esponjoso,glaciado delicioso de chocolate y cerezas', 'pastelchocolate.jpg'),
(2, 'Brownie', '50.00', 'Pan esponjoso,cubierta de chocolate y bola de helado a escoger', 'brownie.jpg'),
(3, 'Carlota', '60.00', 'Delicioso pan suave con frutos rojos frescos.', 'carlota.jpg'),
(4, 'Crepa', '65.00', 'Deliciosa crepa recien hecha, con fruta de temporada,untable a escoger ', 'crepa.jpg'),
(5, 'Flan Napolitano', '65.00', 'Pan cremoso y suave, con un glasiado de fresa deliciosa', 'flannapolitano.jpg'),
(7, 'Helado', '70.00', 'DEliciosos Sabores a escoger,variedad de toppings ', 'helado.jpg'),
(8, 'Pastel de tres leches', '75.00', 'Pan esponjoso,cubierta de chantilly y trozos de nuez', 'pasteltresleches.webp'),
(9, 'Pastel de zanahoria', '75.00', 'Delicioso Pan esponjoso recien horneado con nueces', 'pastelzanahoria.jpg'),
(10, 'Torreja', '71.00', 'Pan suave,canela espolvoreada y bola de helado a escoger', 'torreja.jpg');

--
-- Disparadores `tblpostres`
--
DELIMITER $$
CREATE TRIGGER `after_delete_postre` AFTER DELETE ON `tblpostres` FOR EACH ROW BEGIN
    INSERT INTO bitacora_eliminaciones (tabla, informacion_eliminada, tipo_accion) 
    VALUES ('tblpostres', CONCAT('ID: ', OLD.idPostre, ', Nombre: ', OLD.vchNombre), 'DELETE');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblreserva`
--

CREATE TABLE `tblreserva` (
  `IdReserva` int(11) NOT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `dtFecha` date DEFAULT NULL,
  `HoraInicio` time DEFAULT NULL,
  `HoraFinal` time DEFAULT NULL,
  `vchOcacion` varchar(100) DEFAULT NULL,
  `NoPersonas` int(11) DEFAULT NULL,
  `Idzona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblreserva`
--

INSERT INTO `tblreserva` (`IdReserva`, `IdCliente`, `dtFecha`, `HoraInicio`, `HoraFinal`, `vchOcacion`, `NoPersonas`, `Idzona`) VALUES
(1, 2, '2024-08-07', '13:00:00', '14:00:00', '1', 13, 1);

--
-- Disparadores `tblreserva`
--
DELIMITER $$
CREATE TRIGGER `designacionMesas` AFTER INSERT ON `tblreserva` FOR EACH ROW BEGIN
    DECLARE totalComensales INT DEFAULT 0;
    DECLARE mesasAsignadas TEXT DEFAULT '';
    DECLARE done INT DEFAULT 0;
    
    -- Variables para almacenar los valores de cada fila
    DECLARE vIdMesa INT;
    DECLARE vCapasidad INT;
    DECLARE vCosto DECIMAL(10,2);

    -- Cursor para seleccionar las mesas de la zona especificada ordenadas por capacidad de comensales
    DECLARE cursorMesas CURSOR FOR 
    SELECT IdMesa, Capasidad, Costo 
    FROM tblmesa
    WHERE IdZona = NEW.Idzona 
    ORDER BY Capasidad ASC;

    -- Handlers para el cursor
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- Abrir el cursor
    OPEN cursorMesas;

    read_loop: LOOP
        FETCH cursorMesas INTO vIdMesa, vCapasidad, vCosto;
        IF done THEN
            LEAVE read_loop;
        END IF;
        
        IF totalComensales < NEW.NoPersonas THEN
            SET totalComensales = totalComensales + vCapasidad;
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
        -- Insertar las mesas asignadas en tblreservadetalle
        WHILE LENGTH(mesasAsignadas) > 0 DO
            SET vIdMesa = SUBSTRING_INDEX(mesasAsignadas, ',', 1);
            INSERT INTO tblreservadetalle (IdReserva, idMesaAsignada, fltCosto) 
            VALUES (NEW.IdReserva, vIdMesa, (SELECT Costo FROM tblmesa WHERE IdMesa = vIdMesa));
            SET mesasAsignadas = SUBSTRING(mesasAsignadas, LENGTH(vIdMesa) + 2);
        END WHILE;
    ELSE
        -- Manejo de error si no hay suficientes mesas
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No hay suficientes mesas disponibles para cumplir con la reserva.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblreservadetalle`
--

CREATE TABLE `tblreservadetalle` (
  `IdDetalleReserva` int(11) NOT NULL,
  `IdReserva` int(11) DEFAULT NULL,
  `idMesaAsignada` int(11) DEFAULT NULL,
  `fltCosto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblreservadetalle`
--

INSERT INTO `tblreservadetalle` (`IdDetalleReserva`, `IdReserva`, `idMesaAsignada`, `fltCosto`) VALUES
(1, 1, 1, '300.00'),
(2, 1, 2, '300.00'),
(3, 1, 5, '300.00'),
(4, 1, 3, '450.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuarios`
--

CREATE TABLE `tblusuarios` (
  `idUsuario` int(11) NOT NULL,
  `vchNombre` varchar(20) DEFAULT NULL,
  `vchApellidos` varchar(20) DEFAULT NULL,
  `vchNoTelefono` varchar(13) DEFAULT NULL,
  `vchEmail` varchar(150) DEFAULT NULL,
  `vchPassword` varchar(300) DEFAULT NULL,
  `TipoUsuario` enum('Cliente','Empleado','Administrador') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblusuarios`
--

INSERT INTO `tblusuarios` (`idUsuario`, `vchNombre`, `vchApellidos`, `vchNoTelefono`, `vchEmail`, `vchPassword`, `TipoUsuario`) VALUES
(1, 'Josmar', 'Saavedra', '7712194196', '20230026@uthh.edu.mx', '4fc0dff8cd76a365bce38a5c5e9a39f7', 'Cliente'),
(2, 'Aldair', 'Bautista', '4831290696', 'josmar050116@gmail.com', '4fc0dff8cd76a365bce38a5c5e9a39f7', 'Cliente'),
(3, 'Josmar Aldair', 'Bautista Saavedra', '4831290696', 'josmar050110@gmail.com', 'c30d2d6dfe8c5ae3a3e9b9cef0d36f59', 'Administrador'),
(4, 'JABS', 'Meraz', '4431290696', 'Jabs@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Empleado');

--
-- Disparadores `tblusuarios`
--
DELIMITER $$
CREATE TRIGGER `after_delete_usuario` AFTER DELETE ON `tblusuarios` FOR EACH ROW BEGIN
    INSERT INTO bitacora_eliminaciones (tabla, informacion_eliminada, tipo_accion) 
    VALUES ('tblUsuarios', CONCAT('ID:', OLD.idUsuario, ', Nombre:', OLD.vchNombre,', Email:', OLD.vchEmail, ', Tipo:', OLD.TipoUsuario), 'DELETE');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblzona`
--

CREATE TABLE `tblzona` (
  `IdZona` int(11) NOT NULL,
  `vchUbicacion` varchar(100) DEFAULT NULL,
  `vchImagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblzona`
--

INSERT INTO `tblzona` (`IdZona`, `vchUbicacion`, `vchImagen`) VALUES
(1, 'Terrasa VIp', 'TerrasaVIP.png'),
(2, 'Terrasa', 'Terrasa.webp'),
(3, 'ZonaVIp', 'ZonaVIP.webp'),
(4, 'ZonaComun', 'ZonaComun.webp'),
(25, 'mi zona', 'ZonaComun.webp');

--
-- Disparadores `tblzona`
--
DELIMITER $$
CREATE TRIGGER `after_delete_zona` AFTER DELETE ON `tblzona` FOR EACH ROW BEGIN
    INSERT INTO bitacora_eliminaciones (tabla, informacion_eliminada, tipo_accion) 
    VALUES ('tblzona', CONCAT('ID: ', OLD.IdZona, ', Ubicación: ', OLD.vchUbicacion, ', Imagen: ', OLD.vchImagen), 'DELETE');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistaclientesconreservas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistaclientesconreservas` (
`IdCliente` int(11)
,`NombreCompletoCliente` varchar(41)
,`Telefono` varchar(13)
,`CorreoElectronico` varchar(150)
,`IdReserva` int(11)
,`FechaReserva` date
,`HoraInicio` time
,`HoraFinal` time
,`vchOcacion` varchar(100)
,`NoPersonas` int(11)
,`UbicacionZona` varchar(100)
,`Mesas` mediumtext
,`CostoTotalMesas` decimal(32,2)
,`Ocasiones` varchar(255)
,`Monto` decimal(10,2)
,`Restante` decimal(10,2)
,`FechaPago` date
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vistaclientesconreservas`
--
DROP TABLE IF EXISTS `vistaclientesconreservas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistaclientesconreservas`  AS SELECT `u`.`idUsuario` AS `IdCliente`, concat(`u`.`vchNombre`,' ',`u`.`vchApellidos`) AS `NombreCompletoCliente`, `u`.`vchNoTelefono` AS `Telefono`, `u`.`vchEmail` AS `CorreoElectronico`, `r`.`IdReserva` AS `IdReserva`, `r`.`dtFecha` AS `FechaReserva`, `r`.`HoraInicio` AS `HoraInicio`, `r`.`HoraFinal` AS `HoraFinal`, `r`.`vchOcacion` AS `vchOcacion`, `r`.`NoPersonas` AS `NoPersonas`, `z`.`vchUbicacion` AS `UbicacionZona`, group_concat(`m`.`ClaveMesa` order by `m`.`ClaveMesa` ASC separator ', ') AS `Mesas`, sum(`rd`.`fltCosto`) AS `CostoTotalMesas`, `o`.`vchNombreOcasiones` AS `Ocasiones`, `p`.`Monto` AS `Monto`, `p`.`Restante` AS `Restante`, `p`.`FechaPago` AS `FechaPago` FROM ((((((`tblusuarios` `u` left join `tblreserva` `r` on(`u`.`idUsuario` = `r`.`IdCliente`)) left join `tblreservadetalle` `rd` on(`r`.`IdReserva` = `rd`.`IdReserva`)) left join `tblmesa` `m` on(`rd`.`idMesaAsignada` = `m`.`IdMesa`)) left join `tblzona` `z` on(`r`.`Idzona` = `z`.`IdZona`)) left join `tblocasiones` `o` on(`r`.`vchOcacion` = `o`.`IdOcasiones`)) left join `tblpago` `p` on(`u`.`idUsuario` = `p`.`IdCliente` and `r`.`IdReserva` = `p`.`IdReserva`)) WHERE `u`.`TipoUsuario` = 'Cliente' GROUP BY `u`.`idUsuario`, `u`.`vchNombre`, `u`.`vchApellidos`, `u`.`vchNoTelefono`, `u`.`vchEmail`, `r`.`IdReserva`, `r`.`dtFecha`, `r`.`HoraInicio`, `r`.`HoraFinal`, `r`.`vchOcacion`, `r`.`NoPersonas`, `z`.`vchUbicacion`, `o`.`vchNombreOcasiones`, `p`.`Monto`, `p`.`Restante`, `p`.`FechaPago``FechaPago`  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora_eliminaciones`
--
ALTER TABLE `bitacora_eliminaciones`
  ADD PRIMARY KEY (`idBitacora`);

--
-- Indices de la tabla `tblbebidas`
--
ALTER TABLE `tblbebidas`
  ADD PRIMARY KEY (`idBebida`);

--
-- Indices de la tabla `tblcliente`
--
ALTER TABLE `tblcliente`
  ADD PRIMARY KEY (`IdCliente`);

--
-- Indices de la tabla `tblcomidas`
--
ALTER TABLE `tblcomidas`
  ADD PRIMARY KEY (`idComida`);

--
-- Indices de la tabla `tblmenu`
--
ALTER TABLE `tblmenu`
  ADD PRIMARY KEY (`idMenu`),
  ADD KEY `idComida` (`idComida`),
  ADD KEY `idBebida` (`idBebida`);

--
-- Indices de la tabla `tblmesa`
--
ALTER TABLE `tblmesa`
  ADD PRIMARY KEY (`IdMesa`),
  ADD KEY `FK_Mesa_Zona` (`IdZona`);

--
-- Indices de la tabla `tblocasiones`
--
ALTER TABLE `tblocasiones`
  ADD PRIMARY KEY (`IdOcasiones`);

--
-- Indices de la tabla `tblpago`
--
ALTER TABLE `tblpago`
  ADD PRIMARY KEY (`IdPago`),
  ADD KEY `IdCliente` (`IdCliente`),
  ADD KEY `IdReserva` (`IdReserva`);

--
-- Indices de la tabla `tblpostres`
--
ALTER TABLE `tblpostres`
  ADD PRIMARY KEY (`idPostre`);

--
-- Indices de la tabla `tblreserva`
--
ALTER TABLE `tblreserva`
  ADD PRIMARY KEY (`IdReserva`),
  ADD KEY `FK_Reserva_Cliente` (`IdCliente`);

--
-- Indices de la tabla `tblreservadetalle`
--
ALTER TABLE `tblreservadetalle`
  ADD PRIMARY KEY (`IdDetalleReserva`),
  ADD KEY `FK_ReservaDetalle_Mesa` (`idMesaAsignada`),
  ADD KEY `FK_ReservaDetalle_Reserva` (`IdReserva`);

--
-- Indices de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `tblzona`
--
ALTER TABLE `tblzona`
  ADD PRIMARY KEY (`IdZona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora_eliminaciones`
--
ALTER TABLE `bitacora_eliminaciones`
  MODIFY `idBitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `tblbebidas`
--
ALTER TABLE `tblbebidas`
  MODIFY `idBebida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tblcliente`
--
ALTER TABLE `tblcliente`
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tblcomidas`
--
ALTER TABLE `tblcomidas`
  MODIFY `idComida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tblmenu`
--
ALTER TABLE `tblmenu`
  MODIFY `idMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tblmesa`
--
ALTER TABLE `tblmesa`
  MODIFY `IdMesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `tblocasiones`
--
ALTER TABLE `tblocasiones`
  MODIFY `IdOcasiones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tblpago`
--
ALTER TABLE `tblpago`
  MODIFY `IdPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblpostres`
--
ALTER TABLE `tblpostres`
  MODIFY `idPostre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tblreserva`
--
ALTER TABLE `tblreserva`
  MODIFY `IdReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblreservadetalle`
--
ALTER TABLE `tblreservadetalle`
  MODIFY `IdDetalleReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `tblzona`
--
ALTER TABLE `tblzona`
  MODIFY `IdZona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tblmenu`
--
ALTER TABLE `tblmenu`
  ADD CONSTRAINT `tblmenu_ibfk_1` FOREIGN KEY (`idComida`) REFERENCES `tblcomidas` (`idComida`),
  ADD CONSTRAINT `tblmenu_ibfk_2` FOREIGN KEY (`idBebida`) REFERENCES `tblbebidas` (`idBebida`);

--
-- Filtros para la tabla `tblmesa`
--
ALTER TABLE `tblmesa`
  ADD CONSTRAINT `FK_Mesa_Zona` FOREIGN KEY (`IdZona`) REFERENCES `tblzona` (`IdZona`);

--
-- Filtros para la tabla `tblpago`
--
ALTER TABLE `tblpago`
  ADD CONSTRAINT `tblPago_ibfk_1` FOREIGN KEY (`IdCliente`) REFERENCES `tblcliente` (`IdCliente`),
  ADD CONSTRAINT `tblPago_ibfk_2` FOREIGN KEY (`IdReserva`) REFERENCES `tblreserva` (`IdReserva`);

--
-- Filtros para la tabla `tblreserva`
--
ALTER TABLE `tblreserva`
  ADD CONSTRAINT `FK_Reserva_Cliente` FOREIGN KEY (`IdCliente`) REFERENCES `tblcliente` (`IdCliente`);

--
-- Filtros para la tabla `tblreservadetalle`
--
ALTER TABLE `tblreservadetalle`
  ADD CONSTRAINT `FK_ReservaDetalle_Mesa` FOREIGN KEY (`idMesaAsignada`) REFERENCES `tblmesa` (`IdMesa`),
  ADD CONSTRAINT `FK_ReservaDetalle_Reserva` FOREIGN KEY (`IdReserva`) REFERENCES `tblreserva` (`IdReserva`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
