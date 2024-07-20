<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="Estilos/navbar.css">
    <link rel="stylesheet" href="Estilos/footer.css">
    <link rel="stylesheet" href="Estilos/menu.css">
    <link rel="stylesheet" href="Estilos/reservas.css">
    <link rel="stylesheet" href="Estilos/login.css">
    <link rel="stylesheet" href="Estilos/styles.css">
    <title>Huejutla Sabores</title>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo"><a class="amarillo" href="#">Huejutla Sabores</a></div>
            <ul class="links">
                <li class="link-navbar"><a class="amarillo" href="/restaurante/index?clase=controladorpublico&metodo=inicio">Inicio</a></li>
                <li class="link-navbar"><a class="amarillo" href="/restaurante/index?clase=controladorpublico&metodo=menu">Menu</a></li>
                <li class="link-navbar"><a class="amarillo" href="/restaurante/index?clase=controladorpublico&metodo=reservas">Reserva</a></li>
                <li class="link-navbar"><a class="amarillo" href="">Contactanos</a></li>
            </ul>
            <a href="/restaurante/index?clase=controladorpublico&metodo=login" class="action_btn">Iniciar Sesion</a>
            <div class="toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="dropdown_menu">
            <li class="link-navbar"><a class="amarillo" href="/restaurante/index?clase=controladorpublico&metodo=inicio">Inicio</a></li>
            <li class="link-navbar"><a class="amarillo" href="/restaurante/index?clase=controladorpublico&metodo=menu">Menu</a></li>
            <li class="link-navbar"><a class="amarillo" href="#services">Reserva</a></li>
            <li class="link-navbar"><a class="amarillo" href="">Contactanos</a></li>
            <li class="link-navbar"><a class="amarillo" href="/restaurante/index?clase=controladorpublico&metodo=login" class="action_btn">Iniciar Sesion</a></li>
        </div>
    </header>
    <main>
        <?php include_once($vista); ?> 
    </main>

    <footer>
        
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

