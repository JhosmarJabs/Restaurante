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

        $registroMesas = new clsregistros();
        $mesas = $registroMesas->ConsultaMesas();   

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
        $registroComida = new clsregistros();
        $Comidas = $registroComida->ConsultaComidas(); 
        $registroBebidas = new clsregistros();
        $Bebidas = $registroBebidas->ConsultaBebidas(); 
        $registroPostres = new clsregistros();
        $Postres = $registroPostres->ConsultaPostres(); 
		$vista="Vistas/Publica/frmmenu.php";
        include_once("Vistas/frmCliente.php");
    }
	
    public function reservas()
	{	
		$vista="Vistas/Cliente/frmreserva.php";
        include_once("Vistas/frmCliente.php");
    }
}