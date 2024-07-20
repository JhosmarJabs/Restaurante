<?php
include_once 'Modelo/clsconexion.php';

class clslogin extends clsconexion{

	public function ConsultaUsuario($usuario,$password) {
        $result=$this->conectar->query("CALL spLogin('$usuario','$password',@respuesta);");
        $result=$this->conectar->query("Select @respuesta as respuesta");
        $resp=$result->fetch_assoc();
		return $resp;
	}

}
?>