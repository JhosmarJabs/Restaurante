<?php
    if (!isset($_SESSION['id'])) {
    header("Location: index.php"); 
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huejutla Sabores</title>
    <link rel="stylesheet" href="Estilos/styles.css">
</head>
<body class="screen bg-white">
    <header class="bg-black text-white">
        <nav class="nav">
            <a href="/restaurante/index?clase=controladorpublico&metodo=inicio" class="nav-link">Inicio</a>
            <a href="#" class="nav-link">Menu</a>
            <a href="#" class="nav-link">Quienes Somos</a>
            <a href="#" class="nav-link">Reservas</a>
            <a href="#" class="nav-link">Contacto</a>
            <a href="#" class="nav-link">Cerrar Sesion</a>
            <a href="#" class="nav-link">Entro con cliente</a>
        </nav>
    </header>
    <!-- Este es el cuerpo -->
    <?php include_once($vista); ?> 

</body>
</html>
