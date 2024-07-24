<?php
include_once 'Modelo/clsconexion.php';
// ver la forma de poder meter mas clases
class clsregistros extends clsconexion{


    public function RegistrarEmpleado($nombre, $apellidos, $noTelefono, $email, $password) {
        $sql1 = "CALL spInsertarCliente('$nombre', '$apellidos', '$noTelefono', '$email', '$password', 'Empleado');";
        $result1 = $this->conectar->query($sql1);
    }

}
?>