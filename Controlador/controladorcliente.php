<?php
session_start();
include_once 'Modelo/clsregistros.php';

class controladorcliente
{
	private $vista;
	
	public function inicio()
	{		
		$registroZonas = new clsregistros();
        $zonas = $registroZonas->ConsultaZona();   
		$vista="Vistas/Publica/frmcontenidopublico.php";
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