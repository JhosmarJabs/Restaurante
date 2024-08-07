<?php
include_once 'Modelo/clsconexion.php';

class clsReportes extends clsconexion{
    public function filtroBitacora($fecha, $tabla ) {
		$sql = "CALL spFiltroBitacora('$fecha', '$tabla');";
		$resultado = $this->conectar->query($sql);
		return $resultado;
    }
	public function ConsultaReservas($Fecha){
        $sql = "CALL spConsultarReservas('$Fecha');";
        $resultadoReservas = $this->conectar->query($sql);
        return $datos = $resultadoReservas ? $resultadoReservas : null;
    }
    public function ConsultaReservaciones($idCliente){
        $sql = "CALL spConsultarReservaciones($idCliente);";
        $resultadoReservaciones = $this->conectar->query($sql);
        return $datos = $resultadoReservaciones ? $resultadoReservaciones : null;
    }
}
?>
