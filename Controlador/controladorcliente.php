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
        $CostoBD = new clsregistros();
        $BusqReserva = new clsregistros();
        $Pago = new clsregistros();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $IdCliente = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
            $nombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : NULL;
            $apellidos = isset($_POST['txtApellido']) ? $_POST['txtApellido'] : NULL;
            $telefono = isset($_POST['txtNomeroTelefonico']) ? $_POST['txtNomeroTelefonico'] : NULL;

            $fechaReservacion = isset($_POST['txtFecha']) ? $_POST['txtFecha'] : NULL;
            $horaInicio = isset($_POST['txtHoraI']) ? $_POST['txtHoraI'] : NULL;
            $horaFinal = isset($_POST['txtHoraF']) ? $_POST['txtHoraF'] : NULL;
            $ocasion = isset($_POST['txtOcacion']) ? $_POST['txtOcacion'] : NULL;
            $invitados = isset($_POST['txtinvitados']) ? $_POST['txtinvitados'] : NULL;
            $zonaPreferencia = isset($_POST['txtZonaReserva']) ? $_POST['txtZonaReserva'] : NULL;
            
            // Solicitar la reserva
            $altaReservaExitosa = $registroReservas->Solisitar($nombre, $apellidos, $telefono, $fechaReservacion, $horaInicio, $horaFinal, $ocasion, $invitados, $zonaPreferencia);

            if ($altaReservaExitosa) {
                // Obtener la última reserva del cliente
                $idres = $BusqReserva->BuscarReserva($IdCliente);
                $Costo = $CostoBD->ConsultaCosto($idres);
                
                // Mostrar datos para depuración
            } else {
                echo "Error al solicitar la reserva.";
            }
        } else {
            echo "Método de solicitud no válido.";
        }
    }

    
}


