<?php
include_once 'Modelo/clsregistros.php';
include_once 'LibreriaFPDF/fpdf.php';
include_once 'Modelo/clsreportes.php';

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
        $registroZonasC = new clsregistros();
        $zonasC = $registroZonasC->ConsultaZona();
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
        } else {
            // Datos de entrada
            $nombre = isset($_POST['txtnombre']) ? $_POST['txtnombre'] : NULL;
            $apellidos = isset($_POST['txtapellidos']) ? $_POST['txtapellidos'] : NULL;
            $noTelefono = isset($_POST['txttelefono']) ? $_POST['txttelefono'] : NULL;
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
        }
        header('Location: /restaurante/index?clase=controladoradministrador&metodo=inicio');
        exit();
    }
    public function altaZona() {
        $registroZonas = new clsregistros();
        if(empty($_POST)) {
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
        }
        header('Location: /restaurante/index?clase=controladoradministrador&metodo=inicio');
        exit();
    }
    public function altamesa() {
        $registroMesas = new clsregistros();
        if (!empty($_POST)) {
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
        }
        header('Location: /restaurante/index?clase=controladoradministrador&metodo=inicio');
        exit();
    }
    
    public function altapostre() {
        $registroPostres = new clsregistros();
        if (empty($_POST)) {
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
        }
        header('Location: /restaurante/index?clase=controladoradministrador&metodo=inicio');
        exit();
    }
    public function altacomida() {
        $registroComidas = new clsregistros();
        if (empty($_POST)) {
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
        }
        header('Location: /restaurante/index?clase=controladoradministrador&metodo=inicio');
        exit();
    }
    public function altabebida() {
        $registroBebidas = new clsregistros();
        if (empty($_POST)) {
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
        }
        header('Location: /restaurante/index?clase=controladoradministrador&metodo=inicio');
        exit();
    }
    public function EliminaActualizaEmpleado() {
        $registro = new clsregistros();
        if (isset($_POST['btnEliminar'])) {
            $id = $_POST['txtIdEmpleado'];
            $registro->EliminarEmpleado($id);
            $Consulta = $registro->ConsultaEmpleados();
        } else if (isset($_POST['btnActualizar'])) {
            $id = $_POST['txtIdEmpleado'];
            $nombre = $_POST['txtNombreC'];
            $apellidos = $_POST['txtApC'];
            $telefono = $_POST['txtTelC'];
            $email = $_POST['txtEmC'];
            // $clave = $_POST['txtClave'];
            $registro->ActualizarEmpleado($id, $nombre, $apellidos, $telefono, $email);
            $Consulta = $registro->ConsultaEmpleados();
        }
        header('Location: /restaurante/index?clase=controladoradministrador&metodo=inicio');
        exit();
    }
    public function EliminaActualizaZona() {
        $registro = new clsregistros();
        if (isset($_POST['btnEliminar'])) {
            $id = $_POST['txtIdZona'];
            $registro->EliminarZona($id);
            $Consulta = $registro->ConsultaZona();
        } else if (isset($_POST['btnActualizar'])) {
            $id = $_POST['txtIdZona'];
            $ubicacion = $_POST['txtNombreZona'];
            $registro->ActualizarZona($id, $ubicacion);
            $Consulta = $registro->ConsultaZona();
        }
        header('Location: /restaurante/index?clase=controladoradministrador&metodo=inicio');
        exit();
    }
    public function EliminaActualizaMesa() {
        $registro = new clsregistros();
        if (isset($_POST['btnEliminar'])) {
            $id = $_POST['txtIdMesa'];
            $registro->EliminarMesa($id);
            $Consulta = $registro->ConsultaMesas();
        } else if (isset($_POST['btnActualizar'])) {
            $id = $_POST['txtIdMesa'];
            $claveMesa = $_POST['txtClaveMesa'];
            $capacidad = $_POST['txtCapacidad'];
            $costo = $_POST['txtCosto'];
            $registro->ActualizarMesa($id, $claveMesa, $capacidad, $costo); // Solo se pasan los cuatro parámetros disponibles
            $Consulta = $registro->ConsultaMesas();
        }
        header('Location: /restaurante/index?clase=controladoradministrador&metodo=inicio');
        exit();
    }    
    public function EliminaActualizaPostre() {
        $registro = new clsregistros();
        if (isset($_POST['btnEliminar'])) {
            $id = $_POST['txtIdPostre'];
            $registro->EliminarPostre($id);
            $Consulta = $registro->ConsultaPostres();
        } else if (isset($_POST['btnActualizar'])) {
            $id = $_POST['txtIdPostre'];
            $nombre = $_POST['txtNombrePostre'];
            $descripcion = $_POST['txtDescripcionPostre'];
            $precio = $_POST['txtCostoPostre'];
            $registro->ActualizarPostre($id, $nombre, $descripcion, $precio);
            $Consulta = $registro->ConsultaPostres();
        }
        header('Location: /restaurante/index?clase=controladoradministrador&metodo=inicio');
        exit();
    }
    public function EliminaActualizaComida() {
        $registro = new clsregistros();
        if (isset($_POST['btnEliminar'])) {
            $id = $_POST['txtIdComida'];
            $registro->EliminarComida($id);
            $Consulta = $registro->ConsultaComidas();
        } else if (isset($_POST['btnActualizar'])) {
            $id = $_POST['txtidComida'];
            $nombre = $_POST['txtNombreComida'];
            $descripcion = $_POST['txtDescripcionComida'];
            $precio = $_POST['txtCostoComida'];
            $registro->ActualizarComida($id, $nombre, $descripcion, $precio);
            $Consulta = $registro->ConsultaComidas();
        }
        header('Location: /restaurante/index?clase=controladoradministrador&metodo=inicio');
        exit();
    }
    public function EliminaActualizaBebida() {
        $registro = new clsregistros();
        if (isset($_POST['btnEliminar'])) {
            $id = $_POST['txtIdBebida'];
            $registro->EliminarBebida($id);
            $Consulta = $registro->ConsultaBebidas();
        } else if (isset($_POST['btnActualizar'])) {
            $id = $_POST['txtIdBebida'];
            $nombre = $_POST['txtNombreBebida'];
            $descripcion = $_POST['txtDescripcionBebida'];
            $precio = $_POST['txtCostoBebida'];
            $registro->ActualizarBebida($id, $nombre, $descripcion, $precio);
            $Consulta = $registro->ConsultaBebidas();
        }
        header('Location: /restaurante/index?clase=controladoradministrador&metodo=inicio');
        exit();
    }                        

    public function reportes()
    {
        $reporte=new clsReportes();//clase que esta en el modelo
        if(!empty($_POST))
        {
            // Crear el objeto FPDF
            $pdf = new FPDF();
            
            // Agregar una página
            $pdf->AddPage();
            // $pdf->Cell(190,30,$pdf->Image('./img/becas.png',130,12,60,30),0,1,'R');
            // Establecer la fuente y el tamaño del título
            $pdf->SetFont('Arial', 'B', 20);
            
            $pdf->Cell(0, 20,utf8_decode('Reporte de eliminaciones '), 0, 1, 'C');

            // Consulta a la base de datos
            $Consulta=$reporte->ConsultaBitacora();  
            
            //Centrar la tabla
            $pdf->SetLeftMargin(10);
            if ($Consulta->num_rows > 0) {
                
                // Establecer la fuente y el tamaño del encabezado de la tabla
                $pdf->SetFont('Arial', 'B', 10);

                // Imprimir los encabezados de la tabla
                $pdf->Cell(20, 10, 'ID', 1, 0, 'C');
                $pdf->Cell(30, 10, 'Tabla', 1, 0, 'C');
                $pdf->Cell(40, 10, 'Infiormacion', 1, 0, 'C');
                $pdf->Cell(40, 10, 'Tipo de acicon', 1, 0, 'C');
                $pdf->Cell(20, 10, 'Fecha de accion', 1, 0, 'C');
            
                // Establecer la fuente y el tamaño del contenido de la tabla
                $pdf->SetFont('Arial', '', 10);

                // Imprimir los datos de la tabla
                while ($row = $Consulta->fetch_assoc()) {
                    $pdf->Cell(20, 10, $row["idBitacora"], 1, 0, 'L');
                    $pdf->Cell(30, 10, $row["tabla"], 1, 0, 'L');
                    $pdf->Cell(40, 10, $row["informacion_eliminada"], 1, 0, 'C');
                    $pdf->Cell(40, 10, $row["tipo_accion"], 1, 0, 'C');
                    $pdf->Cell(20, 10, $row["fecha_accion"], 1, 0, 'C');
                }

                // Salto de línea después de la tabla
                $pdf->Ln(10);

                $reporte->conectar->close();
                // Mostrar el PDF
                $pdf->Output();
            } else {
                echo "No se encontraron registros.";
            }

            //******************    
            
        }else
        {
            $vista="Vistas//.php";
            include_once("Vistas/frmadministrador.php");
        }

    }

    public function cerrar()
	{		
		session_destroy();
		header('location:index.php');
	}
}