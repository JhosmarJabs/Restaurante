<?php
include_once 'Modelo/clsconexion.php';

class clslogin extends clsconexion{

	public function ConsultaUsuario($email,$password) {
        $result=$this->conectar->query("CALL spLogin('$email','$password',@respuesta);");
        $result=$this->conectar->query("Select @respuesta as respuesta");
        $resp=$result->fetch_assoc();
		return $resp;
	}

    public function ConsultarDatos($email) {
        $result=$this->conectar->query("CALL spConsultarDatos('$email')");
        $resp=$result->fetch_assoc();
        return $resp;
    }
    // clase registros

    public function RegistrarUsuario($nombre, $apellidos, $noTelefono, $email, $password) {
        $sql = "CALL spInsertarUsuarios('$nombre', '$apellidos', '$noTelefono', '$email', '$password', 'Cliente');";
        $result = $this->conectar->query($sql);
    }
}
?>