<?php

class Aplicacion {
    private $clase;
    private $metodo;

    //Este constructor toma a traves de GET o la URL el nombre de la clase y el metodo o funcion a ejecutar
    public function __construct() {
        // Verificar y sanitizar las entradas
        $this->clase = isset($_GET['clase']) ? filter_input(INPUT_GET, 'clase', FILTER_SANITIZE_SPECIAL_CHARS) : 'controladorpublico';
        $this->metodo = isset($_GET['metodo']) ? filter_input(INPUT_GET, 'metodo', FILTER_SANITIZE_SPECIAL_CHARS) : 'inicio';
    }

    public function ejecutar() {
        $this->cargarControlador($this->clase, $this->metodo);
    }

    private function cargarControlador($clase, $metodo) {
        $rutaArchivo = "Controlador/" . $clase . ".php";

        if (file_exists($rutaArchivo)) {
            require_once $rutaArchivo;

            if (class_exists($clase)) {
                $objeto = new $clase();

                if (method_exists($objeto, $metodo)) {
                    $objeto->$metodo();
                } else {
                    $this->manejarError("El método '$metodo' no existe en la clase '$clase'.");
                }
            } else {
                $this->manejarError("La clase '$clase' no existe.");
            }
        } else {
            $this->manejarError("El archivo '$rutaArchivo' no se encuentra.");
        }
    }

    private function manejarError($mensaje) {
        echo "<p>Error: $mensaje</p>";
        // También podrías redirigir a una página de error personalizada o registrar el error en un archivo de log
    }
}

// Crear una instancia de la clase Aplicacion y ejecutar la aplicación
// Este es el codigo prinicipal que inicia cuando se carga el sitio
$aplicacion = new Aplicacion();// Se crea el objeto
$aplicacion->ejecutar();//A través del objeto se llama a la función ejecutar

?>
