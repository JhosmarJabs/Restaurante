<?php
session_start();


class controladorcliente
{
	private $vista;
	
	public function inicio()
	{		
		$vista="Vistas/cliente/frmcontenidocliente.php";
        include_once("Vistas/frmCliente.php");
	}

	public function cerrar()
	{		
		session_destroy();
		header('location:index.php');
	}

	public function menu()
	{	
		$vista="Vistas/Publica/frmmenu.php";
        include_once("Vistas/frmCliente.php");
    }
	
    public function reservas()
	{	
		$vista="Vistas/Cliente/frmreserva.php";
        include_once("Vistas/frmCliente.php");
    }
}