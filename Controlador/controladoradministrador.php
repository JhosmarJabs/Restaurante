<?php
include_once 'Modelo/clsregistros.php';

session_start();

class controladoradministrador
{
	private $vista;
	
	public function inicio()
	{		
		$vista="Vistas/Administrador/frmAltas.php";
        include_once("Vistas/frmadministrador.php");
	}

    public function altaempleado() {
        $acceso = new clsregistros();
        if (!empty($_POST)) {
            $nombre = isset($_POST['txtnombre']) ? $_POST['txtnombre'] : NULL;
            $apellido = isset($_POST['txtapellidos']) ? $_POST['txtapellidos'] : NULL;
            $telefono = isset($_POST['txtTelefono']) ? $_POST['txtTelefono'] : NULL;
            $email = isset($_POST['txtcorreo']) ? $_POST['txtcorreo'] : NULL;
            $password = isset($_POST['txtclave']) ? $_POST['txtclave'] : NULL;
            $registro = $acceso->RegistrarEmpleado($nombre, $apellido, $telefono, $email, $password);
			
            // echo '<pre>';
            // print_r($nombre, $apellido, $telefono, $email, $password);
            // echo '</pre>';
			$vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        } else {
            $vista = "Vistas/Administrador/frmAltas.php";
            include_once("Vistas/frmadministrador.php");
        }
    }
}