<!-- Autenticacion -->
<?php
    if (!isset($_SESSION['id'])) {
    header("Location: index.php"); 
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="Estilos/principalhtml.css">
    <link rel="stylesheet" href="Estilos/navbar.css">
    <link rel="stylesheet" href="Estilos/footer.css">
    <link rel="stylesheet" href="Estilos/altas.css">
    <!-- <link rel="stylesheet" href="Estilos/menu.css"> -->
    <link rel="stylesheet" href="Estilos/reservas.css">
    <!-- <link rel="stylesheet" href="Estilos/principal.css"> -->
    <title>Huejutla Sabores</title>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo"><a class="amarillo" href="#">Huejutla Sabores</a></div>
            <a class="amarillo"><?php echo 'Bienvenido '.$_SESSION['nombre'].' Administrador' ?></a>
            <ul class="links">
                <li class="link-navbar"><a class="amarillo" href="/restaurante/index?clase=controladoradministrador&metodo=vistareportes">Reportes de eliminacion</a></li>
                <!-- <li class="link-navbar"><a class="amarillo" href="/restaurante/index?clase=controladoradministrador&metodo=menu">Menu</a></li> -->
                <!-- <li class="link-navbar"><a class="amarillo" href="/restaurante/index?clase=controladoradministrador&metodo=altas">Altas</a></li> -->
                <!-- <li class="link-navbar"><a class="amarillo" href="">Contactanos</a></li> -->
            </ul>
            <a href="/restaurante/index?clase=controladoradministrador&metodo=cerrar" class="action_btn">Cerrar Sesion</a>
            <div class="toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="dropdown_menu">
            <li class="link-navbar"><a class="amarillo" href="/restaurante/index?clase=controladoradministrador&metodo=vistareportes">Reportes de eliminacion</a></li>
            <!-- <li class="link-navbar"><a class="amarillo" href="/restaurante/index?clase=controladoradministrador&metodo=menu">Menu</a></li> -->
            <!-- <li class="link-navbar"><a class="amarillo" href="#services">Reserva</a></li> -->
            <!-- <li class="link-navbar"><a class="amarillo" href="/restaurante/index?clase=controladoradministrador&metodo=altas">Altas</a></li> -->
            <li class="link-navbar"><a class="amarillo" href="/restaurante/index?clase=controladoradministrador&metodo=cerrar" class="action_btn">Cerrar Sesion</a></li>
        </div>
    </header>
    <main>
        <?php include_once($vista); ?> 
    </main>

    <footer class="pie-pagina">
            <p>&copy; 2024 Restaurante Gourmet. Pagina desarrollada por alumnos de la uthh con fines educativos.</p>
            <nav class="navegacion-pie-pagina">
                <a href="#">Política de Privacidad</a>
                <a href="#">Términos y Condiciones</a>
            </nav>
        </footer>
    
    <script>
        const toggleBtn = document.querySelector('.toggle_btn');
        const toggleBtnIcon = document.querySelector('.toggle_btn i');
        const dropDownMenu = document.querySelector('.dropdown_menu');

        toggleBtn.onclick = function () {
        dropDownMenu.classList.toggle('open');
        const isOpen = dropDownMenu.classList.contains('open');
        
        toggleBtnIcon.classList = isOpen 
        ? 'fa-solid fa-xmark' 
        : 'fa-solid fa-bars';
        }
    </script>
</body>
</html>

