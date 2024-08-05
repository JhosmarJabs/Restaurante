<?php
include_once 'Modelo/clsconexion.php';

class clsReportes extends clsconexion{

	
	public function ConsultaBitacora()
	{
		$sql = "CALL spConsultarEliminaciones();";
		$resultado = $this->conectar->query($sql);
		return $resultado;
	}
}


?>
