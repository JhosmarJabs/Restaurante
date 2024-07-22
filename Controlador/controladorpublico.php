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
            $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : NULL;
            $password = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : NULL;
            $result = $acceso->ConsultaUsuario($email, $password);
            $datos = $acceso->ConsultarDatos($email);


            // echo '<pre>';
            // print_r($result);
            // echo '</pre>';

            // if ($result == true) {
            // // Depurar el contenido de $result
            // echo '<pre>';
            // print_r('el resultado fue 1');
            // echo '</pre>';
            // }else{
            // // Depurar el contenido de $result
            // echo '<pre>';
            // print_r('El resultado fue 0');
            // echo '</pre>';
            // }



            if ($result == true)
            {
                session_start();
                $_SESSION['id'] = $datos['idUsuario'];
                $_SESSION['nombre'] = $datos['vchUsuario'];
                $vista = "Vistas/Inicio/frmcontenidocliente.php";
                include_once("Vistas/frmcliente.php");
            }
            else
            {
                $vista = "Vistas/Usuario/login.php";
                include_once("Vistas/frmpublica.php");
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
