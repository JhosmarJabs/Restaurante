<?php
include_once 'Modelo/clsconexion.php';

class clsReportes extends clsconexion{

	
    public function filtrarBitacoraPorFechaYTabla($fecha, $tabla ) {
		$sql = "CALL filtrarBitacoraPorFechaYTabla('$fecha', '$tabla');";
		$resultado = $this->conectar->query($sql);
		return $resultado;
    }
}


?>
