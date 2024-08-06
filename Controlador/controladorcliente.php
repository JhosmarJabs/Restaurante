<?php
session_start();
include_once 'Modelo/clsregistros.php';

class controladorcliente
{
	private $vista;
	
	public function inicio()
	{		
        $registroZonas = new clsregistros();
        $zonas = $registroZonas->ConsultaZona();    

        $registroMesas = new clsregistros();
        $mesas = $registroMesas->ConsultaMesas();   

		$vista="Vistas/Cliente/frmcontenidocliente.php";
        include_once("Vistas/frmCliente.php");
	}

	public function cerrar()
	{		
		session_destroy();
		header('location:index.php');
	}

    public function menu()
	{	
        $registroComida = new clsregistros();
        $Comidas = $registroComida->ConsultaComidas(); 
        $registroBebidas = new clsregistros();
        $Bebidas = $registroBebidas->ConsultaBebidas(); 
        $registroPostres = new clsregistros();
        $Postres = $registroPostres->ConsultaPostres(); 
		$vista="Vistas/Publica/frmmenu.php";
        include_once("Vistas/frmCliente.php");
    }
	
    public function reservas()
	{	
        $ConsultaClient = new clsregistros;
        $ConsultaCli = new clsregistros;
        $IDZONAS = new clsregistros;
        $idOcaciones = new clsregistros;

        if (empty($_POST)){
            $IdCliente= isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
            $datos = $ConsultaClient->ConsultaClientes($IdCliente);
            $datos1 = $ConsultaCli->ConsultaClientes($IdCliente);
            $idOca = $idOcaciones->ConsultaOcaciones();
            $datosZonas = $IDZONAS->ConsultaZona();
            $vista="Vistas/Cliente/frmreserva.php";
            include_once("Vistas/frmCliente.php");    
        }
    }
    public function SolicitarReservar() {
        $registroReservas = new clsregistros();
        $CostoBD = new clsregistros;
        $BusqReserva = new clsregistros;
        $Pago = new clsregistros;
        if (isset($_POST['btnSolicitar'])) {
            $IdCliente= isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $apellidos = isset($_POST['apellido']) ? $_POST['apellido'] : NULL;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : NULL;

            $fechaReservacion = isset($_POST['fecha']) ? $_POST['fecha'] : NULL;
            $horaInicio = isset($_POST['hora-inicio']) ? $_POST['hora-inicio'] : NULL;
            $horaFinal = isset($_POST['hora-final']) ? $_POST['hora-final'] : NULL;
            $ocasion = isset($_POST['ocasion']) ? $_POST['ocasion'] : NULL;
            $invitados = isset($_POST['invitados']) ? $_POST['invitados'] : NULL;
            $zonaPreferencia = isset($_POST['zona-preferencia']) ? $_POST['zona-preferencia'] : NULL;
            
            $altaReservaExitosa = $registroReservas->Solisitar($nombre, $apellidos, $telefono, $fechaReservacion, $horaInicio, $horaFinal, $ocasion, $invitados, $zonaPreferencia);

            $idres = $BusqReserva->BuscarReserva($IdCliente);
            $Costo = $CostoBD->ConsultaCosto($idres);
            $costo = isset($_POST['costo']) ? $_POST['costo'] : NULL;
        } else {
            $vista="Vistas/Cliente/frmreserva.php";
            include_once("Vistas/frmCliente.php");  
        }

        if (isset($_POST['btnReservar'])) {
            // Datos de entrad
            $IdCliente= isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
            $anticipo = isset($_POST['anticipo']) ? $_POST['anticipo'] : NULL;
            $total = isset($_POST['total']) ? $_POST['total'] : NULL;
            $pagoFinal= $pago -> PagoReserva($IdCliente,$anticipo, $total);
        } else {
            $vista="Vistas/Cliente/frmreserva.php";
            include_once("Vistas/frmCliente.php");  
        }
    }
}


