<?php
session_start();
include_once 'Modelo/clsregistros.php';
include_once 'LibreriaFPDF/fpdf.php';
include_once 'Modelo/clsreportes.php';

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
    public function Solicitar() {
        $registroReservas = new clsregistros();
        $CostoBD = new clsregistros();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recolectar los datos del formulario
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
            $altaReservaExitosa = $registroReservas->Solisitar($IdCliente, $telefono, $fechaReservacion, $horaInicio, $horaFinal, $ocasion, $invitados, $zonaPreferencia);
            if ($altaReservaExitosa) {
                // Asigna la vista para el formulario de pago
                header('Location: /restaurante/index?clase=controladorcliente&metodo=Reservar');
                exit();
            } else {
                echo "Error al solicitar la reserva.";
            }
        } else {
            echo "Método de solicitud no válido.";
        }
    }
    public function Reservar() {
        // Verifica si el cliente está definido en la sesión
        $IdCliente = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
        // Crea una instancia de clsregistros
        $CostoBD = new clsregistros();
        // Verifica si el cliente existe
        if ($IdCliente) {
            // Consulta el costo
            $Costo = $CostoBD->ConsultaCosto($IdCliente);
            // Verifica si la solicitud es POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Obtiene los valores de anticipo y total del formulario
                $Anticipo = isset($_POST['txtAnticipo']) ? $_POST['txtAnticipo'] : NULL;
                $total = isset($_POST['txtTotal']) ? $_POST['txtTotal'] : NULL;
                // Procesa el pago
                $Pago = $CostoBD->PagoReserva($IdCliente, $Anticipo, $total);
                // Verifica si el pago se realizó con éxito
                if ($Pago) {
                    // Redirige a la página de inicio después de realizar el pago
                    header('Location: /restaurante/index?clase=controladorcliente&metodo=inicio');
                    exit();
                } else {
                    echo "Error al procesar el pago.";
                }
            }
            // Incluye la vista para el formulario de pago
            $vista = "Vistas/Cliente/frmPago.php";
            include_once("Vistas/frmCliente.php");
        } else {
            echo "No se encontró una reserva para el cliente.";
        }
    }
    public function Historial()
	{	
		$vista="Vistas/cliente/frmReporte.php";
        include_once("Vistas/frmCliente.php");
    }
    public function reporteReservaciones(){
    $reporte = new clsReportes(); // Clase que está en el modelo
    if (empty($_POST)) {
        $idCliente = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
        $Consulta = $reporte->ConsultaReservaciones($idCliente);  
        // Crear el objeto FPDF
        $pdf = new FPDF('L', 'mm', 'A4'); // Agregar orientación horizontal
        // Agregar una página
        $pdf->AddPage();
        // $pdf->Cell(190,30,$pdf->Image('./img/becas.png',130,12,60,30),0,1,'R');
        // Establecer la fuente y el tamaño del título
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(0, 20, utf8_decode('Reporte de Reservaciones'), 0, 1, 'C');
        // Consulta a la base de datos
        // Centrar la tabla
        $pdf->SetLeftMargin(10);
        if ($Consulta->num_rows > 0) {
            // Establecer la fuente y el tamaño del encabezado de la tabla
            $pdf->SetFont('Arial', 'B', 7);
            // Imprimir los encabezados de la tabla
            $pdf->Cell(5, 8, 'ID', 1, 0, 'C');
            $pdf->Cell(25, 8, 'Nombre Cliente', 1, 0, 'C');
            $pdf->Cell(15, 8, 'Teléfono', 1, 0, 'C');
            $pdf->Cell(40, 8, 'Correo Electrónico', 1, 0, 'C');
            $pdf->Cell(15, 8, 'Fecha', 1, 0, 'C');
            $pdf->Cell(15, 8, 'Hora Inicio', 1, 0, 'C');
            $pdf->Cell(15, 8, 'Hora Final', 1, 0, 'C');
            $pdf->Cell(15, 8, 'Personas', 1, 0, 'C');
            $pdf->Cell(20, 8, 'Zona', 1, 0, 'C');
            $pdf->Cell(40, 8, 'Mesas', 1, 0, 'C');
            $pdf->Cell(20, 8, 'Ocasiones', 1, 0, 'C');
            $pdf->Cell(12, 8, 'Total', 1, 0, 'C');
            $pdf->Cell(12, 8, 'Resta', 1, 0, 'C');
            $pdf->Cell(12, 8, 'Monto', 1, 0, 'C');
            $pdf->Cell(15, 8, 'Fecha Pago', 1, 0, 'C');
            $pdf->Ln(); // Salto de línea después de los encabezados
            // Establecer la fuente y el tamaño del contenido de la tabla
            $pdf->SetFont('Arial', '', 7);
            // Imprimir los datos de la tabla
            while ($row = $Consulta->fetch_assoc()) {
                $pdf->Cell(5, 8, $row["IdReserva"], 1, 0, 'L');
                $pdf->Cell(25, 8, $row["NombreCompletoCliente"], 1, 0, 'L');
                $pdf->Cell(15, 8, $row["Telefono"], 1, 0, 'L');
                $pdf->Cell(40, 8, $row["CorreoElectronico"], 1, 0, 'L');
                $pdf->Cell(15, 8, $row["FechaReserva"], 1, 0, 'L');
                $pdf->Cell(15, 8, $row["HoraInicio"], 1, 0, 'L');
                $pdf->Cell(15, 8, $row["HoraFinal"], 1, 0, 'L');
                $pdf->Cell(15, 8, $row["NoPersonas"], 1, 0, 'L');
                $pdf->Cell(20, 8, $row["UbicacionZona"], 1, 0, 'L');
                $pdf->Cell(40, 8, $row["Mesas"], 1, 0, 'L');
                $pdf->Cell(20, 8, $row["Ocasiones"], 1, 0, 'L');
                $pdf->Cell(12, 8, $row["CostoTotalMesas"], 1, 0, 'L');
                $pdf->Cell(12 , 8, $row["Monto"], 1, 0, 'L');
                $pdf->Cell(12, 8, $row["Restante"], 1, 0, 'L');
                $pdf->Cell(15, 8, $row["FechaPago"], 1, 0, 'L');
                $pdf->Ln(); // Salto de línea después de cada fila
            }
            // Salto de línea después de la tabla
            $pdf->Ln(10);
            $reporte->conectar->close();
            // Mostrar el PDF
            $pdf->Output();
        } else {
            echo "No se encontraron registros.";
        }
    } else {
        header('Location: /restaurante/index?clase=controladorcliente&metodo=Historial');
        exit();
    }
}

}
?>


