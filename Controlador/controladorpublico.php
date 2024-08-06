<?php
include_once 'Modelo/clslogin.php';
include_once 'Modelo/clsregistros.php';

class controladorpublico
{
    private $vista;

    public function inicio()
    {
        $registroZonas = new clsregistros();
        $zonas = $registroZonas->ConsultaZona();    

        $registroMesas = new clsregistros();
        $mesas = $registroMesas->ConsultaMesas();   
            
        $vista = "Vistas/publica/frmcontenidopublico.php";
        include_once("Vistas/frmpublica.php");
    }    

    public function iniciarsesion(){
        $vista = "Vistas/Publica/frmlogin.php";
        include_once("Vistas/frmpublica.php");
    }

    public function login()
    {
        $acceso = new clslogin();
        if (!empty($_POST))
        {
            $email = isset($_POST['txtEmailI']) ? $_POST['txtEmailI'] : NULL;
            $password = isset($_POST['txtPasswordI']) ? $_POST['txtPasswordI'] : NULL;
            $result = $acceso->ConsultaUsuario($email, $password);
            $datos = $acceso->ConsultarDatos($email);
    
            if ($result !== null && $datos !== null) {
                $resultado = $result['respuesta'];
                $tipoUsuario = $datos['TipoUsuario'];
    
                // Comprobamos el tipo de usuario
                if ($tipoUsuario == 'Cliente') {
                    if ($resultado == true)
                    {
                        session_start();
                        $_SESSION['id'] = $datos['idUsuario'];
                        $_SESSION['nombre'] = $datos['vchNombre'];
                        header('Location: /restaurante/index?clase=controladorcliente&metodo=inicio');
                        exit();
                    }
                    else
                    {
                        $vista = "Vistas/Publica/frmlogin.php";
                        include_once("Vistas/frmpublica.php");
                    }
                } elseif ($tipoUsuario == 'Administrador') {
                    if ($resultado == true)
                    {
                        session_start();
                        $_SESSION['id'] = $datos['idUsuario'];
                        $_SESSION['nombre'] = $datos['vchNombre'];
                        header('Location: /restaurante/index?clase=controladoradministrador&metodo=inicio');
                        exit();
                    }
                    else
                    {
                        $vista = "Vistas/Publica/frmlogin.php";
                        include_once("Vistas/frmpublica.php");
                    }
                } else {
                    $vista = "Vistas/Publica/frmlogin.php";
                    include_once("Vistas/frmpublica.php");
                }
            } else {
                $vista = "Vistas/Publica/frmlogin.php";
                include_once("Vistas/frmpublica.php");
            }
        } else {
            $vista = "Vistas/Publica/frmlogin.php";
            include_once("Vistas/frmpublica.php");
        }
    }
    

    public function register() {
        $acceso = new clslogin();
        if (!empty($_POST)) {
            $nombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : NULL;
            $apellido = isset($_POST['txtApellido']) ? $_POST['txtApellido'] : NULL;
            $telefono = isset($_POST['txtTelefono']) ? $_POST['txtTelefono'] : NULL;
            $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : NULL;
            $password = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : NULL;
            $registro = $acceso->RegistrarUsuario($nombre, $apellido, $telefono, $email, $password);
            $result = $acceso->ConsultaUsuario($email, $password);
            $datos = $acceso->ConsultarDatos($email);

            $resultado =  $result['respuesta'];

            if ($resultado == true)
            {
                session_start();
                $_SESSION['id'] = $datos['idUsuario'];
                $_SESSION['nombre'] = $datos['vchNombre'];
                header('Location: /restaurante/index?clase=controladorcliente&metodo=inicio');
                exit();
            }
            else
            {
                $vista = "Vistas/Publica/frmlogin.php";
                include_once("Vistas/frmpublica.php");
            }
        } else {
            $vista = "Vistas/Publica/frmlogin.php";
            include_once("Vistas/frmpublica.php");
        }
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
        include_once("Vistas/frmpublica.php");
    }
}
?>
