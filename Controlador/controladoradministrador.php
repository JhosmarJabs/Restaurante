<?php
include_once 'Modelo/clsregistros.php';

session_start();

class controladoradministrador
{
	private $vista;
	
    public function inicio()
    {
        $registroEmpleados = new clsregistros();
        $Empleados = $registroEmpleados->ConsultaEmpleados();
        $registroZonas = new clsregistros();
        $zonas = $registroZonas->ConsultaZona();
        $registroMesas = new clsregistros();
        $mesas = $registroMesas->ConsultaMesas();
        $registroPostres = new clsregistros();
        $postres = $registroPostres->ConsultaPostres();
        $registroComidas = new clsregistros();
        $comidas = $registroComidas->ConsultaComidas();
        $registroBebidas = new clsregistros();
        $bebidas = $registroBebidas->ConsultaBebidas();
        //vistas
        $vista = "Vistas/Administrador/frmAltas.php";
        include_once("Vistas/frmadministrador.php");
    }
    // Altas
    public function altaempleado() {
        $registroEmpleados = new clsregistros();
        if (empty($_POST)) {
            $vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        } else {
            // Datos de entrada
            $nombre = isset($_POST['txtnombre']) ? $_POST['txtnombre'] : NULL;
            $apellidos = isset($_POST['txtapellidos']) ? $_POST['txtapellidos'] : NULL;
            $telefono = isset($_POST['txttelefono']) ? $_POST['txttelefono'] : NULL;
            $email = isset($_POST['txtcorreo']) ? $_POST['txtcorreo'] : NULL;
            $password = isset($_POST['txtclave']) ? $_POST['txtclave'] : NULL;
            // Registro
            $altaEmpleadoExitoso = $registroEmpleados->AltaEmpleado($nombre, $apellidos, $noTelefono, $email, $password);
            // Actualizacion
            if ($altaEmpleadoExitoso) {
                $Empleados = $registroEmpleados->ConsultaEmpleados();
            } else {
                $Empleados = null; // O manejar el error de alguna otra manera
            }
            $vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        }
    }
    public function altaZona() {
        $registroZonas = new clsregistros();
        if(empty($_POST)) {
            $vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        } else {
            // Datos de entrada
            $Zona = isset($_POST['txtnombre-zona']) ? $_POST['txtnombre-zona'] : '' ;
            $ZonaImg = isset($_FILES['txtimagen-zona']) ? $_FILES['txtimagen-zona'] : '';
            // Manejo de la subida de la imagen
            $carpeta = "img/Zonas/";
            $nombreimagen = basename($ZonaImg["name"]);
            $tipoiamgen = strtolower(pathinfo($nombreimagen, PATHINFO_EXTENSION));
            move_uploaded_file($ZonaImg["tmp_name"], $carpeta.$nombreimagen);
            // Registro
            $AltaZonaExitoso = $registroZonas->AltaZona($Zona, $nombreimagen);
            // Actualizacion
            if ($AltaZonaExitoso) {
                $zona = $registroZonas->ConsultaZona();
            } else {
                $zona = null; // O manejar el error de alguna otra manera
            }
            $vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        }
    }
    public function altamesa() {
        $registroMesas = new clsregistros();
        if (empty($_POST)) {
            $vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        } else {
            // Datos de entrada
            $claveMesa = isset($_POST['txtnumero-mesa']) ? $_POST['txtnumero-mesa'] : NULL;
            $capacidad = isset($_POST['txtcapacidad-mesa']) ? $_POST['txtcapacidad-mesa'] : NULL;
            $zona = isset($_POST['txtzona-mesa']) ? $_POST['txtzona-mesa'] : NULL;
            $costo = isset($_POST['txtcosto-mesa']) ? $_POST['txtcosto-mesa'] : NULL;
            $imagen = isset($_FILES['txtimagen-mesa']) ? $_FILES['txtimagen-mesa'] : null;
            // Verificar si se proporcionó una imagen
            if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
                // Manejo de la subida de la imagen
                $carpeta = "img/Mesas/";
                $nombreimagen = basename($imagen["name"]);
                $rutaImagen = $carpeta . $nombreimagen;
    
                if (move_uploaded_file($imagen["tmp_name"], $rutaImagen)) {
                    // Registro
                    $altaMesaExitosa = $registroMesas->AltaMesa($claveMesa, $capacidad, $zona, $costo, $nombreimagen);
                } else {
                    $altaMesaExitosa = false;
                }
            } else {
                $altaMesaExitosa = false;
            }
            // Actualización
            if ($altaMesaExitosa) {
                $mesas = $registroMesas->ConsultaMesas();
            } else {
                $mesas = null; // O manejar el error de alguna otra manera
            }
            $vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        }
    }
    public function altapostre() {
        $registroPostres = new clsregistros();
        if (empty($_POST)) {
            $vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        } else {
            // Datos de entrada
            $nombre = isset($_POST['txtnombre-postre']) ? $_POST['txtnombre-postre'] : NULL;
            $descripcion = isset($_POST['txtdescripcion-postre']) ? $_POST['txtdescripcion-postre'] : NULL;
            $costo = isset($_POST['txtcosto-postre']) ? $_POST['txtcosto-postre'] : NULL;
            $imagen = isset($_FILES['txtimagen-postre']) ? $_FILES['txtimagen-postre'] : null;
    
            // Verificar si se proporcionó una imagen
            if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
                // Manejo de la subida de la imagen
                $carpeta = "img/Postres/";
                $nombreimagen = basename($imagen["name"]);
                $rutaImagen = $carpeta . $nombreimagen;
    
                if (move_uploaded_file($imagen["tmp_name"], $rutaImagen)) {
                    // Registro
                    $altaPostreExitosa = $registroPostres->AltaPostre($nombre, $descripcion, $costo, $nombreimagen);
                } else {
                    $altaPostreExitosa = false;
                }
            } else {
                $altaPostreExitosa = false;
            }
    
            // Actualización
            if ($altaPostreExitosa) {
                $postres = $registroPostres->ConsultaPostres();
            } else {
                $postres = null; // O manejar el error de alguna otra manera
            }
            $vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        }
    }
    public function altacomida() {
        $registroComidas = new clsregistros();
        if (empty($_POST)) {
            $vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        } else {
            // Datos de entrada
            $nombre = isset($_POST['txtnombre-comida']) ? $_POST['txtnombre-comida'] : NULL;
            $descripcion = isset($_POST['txtdescripcion-comida']) ? $_POST['txtdescripcion-comida'] : NULL;
            $costo = isset($_POST['txtcosto-comida']) ? $_POST['txtcosto-comida'] : NULL;
            $imagen = isset($_FILES['txtimagen-comida']) ? $_FILES['txtimagen-comida'] : null;
            // Verificar si se proporcionó una imagen
            if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
                // Manejo de la subida de la imagen
                $carpeta = "img/Comidas/";
                $nombreimagen = basename($imagen["name"]);
                $rutaImagen = $carpeta . $nombreimagen;
    
                if (move_uploaded_file($imagen["tmp_name"], $rutaImagen)) {
                    // Registro
                    $altaComidaExitosa = $registroComidas->AltaComida($nombre, $descripcion, $costo, $nombreimagen);
                } else {
                    $altaComidaExitosa = false;
                }
            } else {
                $altaComidaExitosa = false;
            }
            // Actualización
            if ($altaComidaExitosa) {
                $comidas = $registroComidas->ConsultaComidas();
            } else {
                $comidas = null; // O manejar el error de alguna otra manera
            }
            $vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        }
    }
    public function altabebida() {
        $registroBebidas = new clsregistros();
        if (empty($_POST)) {
            $vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        } else {
            // Datos de entrada
            $nombre = isset($_POST['txtnombre-bebida']) ? $_POST['txtnombre-bebida'] : NULL;
            $descripcion = isset($_POST['txtdescripcion-bebida']) ? $_POST['txtdescripcion-bebida'] : NULL;
            $costo = isset($_POST['txtcosto-bebida']) ? $_POST['txtcosto-bebida'] : NULL;
            $imagen = isset($_FILES['txtimagen-bebida']) ? $_FILES['txtimagen-bebida'] : null;
    
            // Verificar si se proporcionó una imagen
            if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
                // Manejo de la subida de la imagen
                $carpeta = "img/Bebidas/";
                $nombreimagen = basename($imagen["name"]);
                $rutaImagen = $carpeta . $nombreimagen;
    
                if (move_uploaded_file($imagen["tmp_name"], $rutaImagen)) {
                    // Registro
                    $altaBebidaExitosa = $registroBebidas->AltaBebida($nombre, $descripcion, $costo, $nombreimagen);
                } else {
                    $altaBebidaExitosa = false;
                }
            } else {
                $altaBebidaExitosa = false;
            }
    
            // Actualización
            if ($altaBebidaExitosa) {
                $bebidas = $registroBebidas->ConsultaBebidas();
            } else {
                $bebidas = null; // O manejar el error de alguna otra manera
            }
            $vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        }
    }
    
    public function EliminaActualizaEmpleado() {
        $registro = new clsregistros();
        if (isset($_POST['btnEliminar'])) {

            $id = $_POST['txtIdCliente'];

            $registro->EliminarCliente($id);

            $Consulta = $registro->ConsultaEmpleados();
            $vista = "Vistas/Catalogos/frmClientes.php";
            include_once("Vistas/frmplantillaprivada.php");
        } else if (isset($_POST['btnActualizar'])) {
            $id = $_POST['txtIdEmpleado'];
            $nombre = $_POST['txtNombreC'];
            $apellidos = $_POST['txtApC'];
            $telefono = $_POST['txtTelC'];
            $email = $_POST['txtEmC'];
            // $clave = $_POST['txtClave'];
            $registro->ActualizarCliente($id, $nombre, $apellidos, $telefono, $email);
            $Consulta = $registro->ConsultaEmpleados();
            $vista = "Vistas/Catalogos/frmClientes.php";
            include_once("Vistas/frmplantillaprivada.php");
        }
    }
    public function EliminaActualizaZona() {
        $registro = new clsregistros();
        if (isset($_POST['btnEliminar'])) {
            $id = $_POST['txtIdZona'];
            $registro->EliminarZona($id);
            $Consulta = $registro->ConsultaZona();
            $vista = "Vistas/Catalogos/frmZonas.php";
            include_once("Vistas/frmplantillaprivada.php");
        } else if (isset($_POST['btnActualizar'])) {
            $id = $_POST['txtIdZona'];
            $ubicacion = $_POST['txtUbicacion'];
            $imagen = $_POST['txtImagen'];
            $registro->ActualizarZona($id, $ubicacion, $imagen);
            $Consulta = $registro->ConsultaZona();
            $vista = "Vistas/Catalogos/frmZonas.php";
            include_once("Vistas/frmplantillaprivada.php");
        }
    }
    public function EliminaActualizaMesa() {
        $registro = new clsregistros();
        if (isset($_POST['btnEliminar'])) {
            $id = $_POST['txtIdMesa'];
            $registro->EliminarMesa($id);
            $Consulta = $registro->ConsultaMesas();
            $vista = "Vistas/Catalogos/frmMesas.php";
            include_once("Vistas/frmplantillaprivada.php");
        } else if (isset($_POST['btnActualizar'])) {
            $id = $_POST['txtIdMesa'];
            $claveMesa = $_POST['txtClaveMesa'];
            $capacidad = $_POST['txtCapacidad'];
            $costo = $_POST['txtCosto'];
            $idZona = $_POST['txtIdZona'];
            $imagen = $_POST['txtImagen'];
            $registro->ActualizarMesa($id, $claveMesa, $capacidad, $costo, $idZona, $imagen);
            $Consulta = $registro->ConsultaMesas();
            $vista = "Vistas/Catalogos/frmMesas.php";
            include_once("Vistas/frmplantillaprivada.php");
        }
    }
    public function EliminaActualizaPostre() {
        $registro = new clsregistros();
        if (isset($_POST['btnEliminar'])) {
            $id = $_POST['txtIdPostre'];
            $registro->EliminarPostre($id);
            $Consulta = $registro->ConsultaPostres();
            $vista = "Vistas/Catalogos/frmPostres.php";
            include_once("Vistas/frmplantillaprivada.php");
        } else if (isset($_POST['btnActualizar'])) {
            $id = $_POST['txtIdPostre'];
            $nombre = $_POST['txtNombre'];
            $descripcion = $_POST['txtDescripcion'];
            $precio = $_POST['txtPrecio'];
            $imagen = $_POST['txtImagen'];
            $registro->ActualizarPostre($id, $nombre, $descripcion, $precio, $imagen);
            $Consulta = $registro->ConsultaPostres();
            $vista = "Vistas/Catalogos/frmPostres.php";
            include_once("Vistas/frmplantillaprivada.php");
        }
    }
    public function EliminaActualizaComida() {
        $registro = new clsregistros();
        if (isset($_POST['btnEliminar'])) {
            $id = $_POST['txtIdComida'];
            $registro->EliminarComida($id);
            $Consulta = $registro->ConsultaComidas();
            $vista = "Vistas/Catalogos/frmComidas.php";
            include_once("Vistas/frmplantillaprivada.php");
        } else if (isset($_POST['btnActualizar'])) {
            $id = $_POST['txtIdComida'];
            $nombre = $_POST['txtNombre'];
            $descripcion = $_POST['txtDescripcion'];
            $precio = $_POST['txtPrecio'];
            $imagen = $_POST['txtImagen'];
            $registro->ActualizarComida($id, $nombre, $descripcion, $precio, $imagen);
            $Consulta = $registro->ConsultaComidas();
            $vista = "Vistas/Catalogos/frmComidas.php";
            include_once("Vistas/frmplantillaprivada.php");
        }
    }
    public function EliminaActualizaBebida() {
        $registro = new clsregistros();
        if (isset($_POST['btnEliminar'])) {
            $id = $_POST['txtIdBebida'];
            $registro->EliminarBebida($id);
            $Consulta = $registro->ConsultaBebidas();
            $vista = "Vistas/Catalogos/frmBebidas.php";
            include_once("Vistas/frmplantillaprivada.php");
        } else if (isset($_POST['btnActualizar'])) {
            $id = $_POST['txtIdBebida'];
            $nombre = $_POST['txtNombre'];
            $descripcion = $_POST['txtDescripcion'];
            $precio = $_POST['txtPrecio'];
            $imagen = $_POST['txtImagen'];
            $registro->ActualizarBebida($id, $nombre, $descripcion, $precio, $imagen);
            $Consulta = $registro->ConsultaBebidas();
            $vista = "Vistas/Catalogos/frmBebidas.php";
            include_once("Vistas/frmplantillaprivada.php");
        }
    }                        

    public function cerrar()
	{		
		session_destroy();
		header('location:index.php');
	}
}