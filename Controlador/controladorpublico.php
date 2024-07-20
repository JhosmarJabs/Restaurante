<?php
include_once 'Modelo/clslogin.php';

class controladorpublico
{
    private $vista;

    public function inicio()
    {        
        $vista = "Vistas/Inicio/frmcontenidopublico.php";
        include_once("Vistas/frmpublica.php");
    }    

    public function login()
    {
        $acceso = new clslogin();
        if (!empty($_POST))
        {
            $usuario = $_POST['txtUsuario'];
            $password = $_POST['txtPassword'];
            $result = $acceso->ConsultaUsuario($usuario, $password);
            if ($result == true)
            {
                session_start();
                $_SESSION['id'] = $result['idcliente'];
                $_SESSION['nombre'] = $result['vchnombre'];
                $vista = "Vistas/Inicio/frmcontenidocliente.php";
                include_once("Vistas/frmcliente.php");
            }
            else
            {
                header("Location: index.php");
            }
        }
        else
        {
            $vista = "Vistas/Usuario/login.php";
            include_once("Vistas/frmpublica.php");
        }
    }
    public function menu()
	{	
		$vista="Vistas/Publica/frmmenu.php";
        include_once("Vistas/frmpublica.php");
    }
    public function reservas()
	{	
		$vista="Vistas/Cliente/frmreserva.php";
        include_once("Vistas/frmpublica.php");
    }
}
?>
