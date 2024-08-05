
<div class="fondo-blanco">
    <main class="contenido-principal">
        <h1 class="titulo-principal">HUEJUTLA SABORES</h1>
        <section class="seccion-heroe fondo-claro" style="background-image: url('/hero-image.jpg');">
            <div class="texto-heroe">
                <h2>Bienvenido a Restaurante Gourmet</h2>
                <p>Disfruta de una experiencia culinaria excepcional en un ambiente acogedor y elegante.</p>
                <a href="#" class="boton-reservar">Reservar una mesa</a>
            </div>
        </section>
        <div class="contenedor-rejilla">
            <h2 class="subtitulo-seccion">Nuestras Zonas</h2>
            <div class="contenedor-catalogo" id="catalogo-zonas">
                <i class="fa-solid fa-angle-left" data-catalogo="zonas"></i>
                <ul class="rejilla" id="rejilla-zonas">
                    <?php
                        if (isset($zonas) && $zonas !== null) {
                            while ($allzona = $zonas->fetch_object()) {
                                echo '<li class="tarjeta">';
                                echo '<img class="imagen-tarjeta" src="img/Zonas/' . $allzona->vchImagen . '" alt="Imagen de la ' . $allzona->vchUbicacion . '"  >';
                                echo '<h3 class="titulo-tarjeta">'.$allzona->vchUbicacion.'</h3>';
                                echo '</li>';
                            }
                        }else{
                            echo 'No se encontraron zonas.';
                        }
                    ?>
                </ul>
                <i class="fa-solid fa-angle-right" data-catalogo="zonas"></i>
            </div>
            <h2 class="subtitulo-seccion">Nuestras Mesas</h2>
            <div class="contenedor-catalogo" id="catalogo-mesas">
                <i class="fa-solid fa-angle-left" data-catalogo="mesas"></i>
                <ul class="rejilla" id="rejilla-mesas">
                <?php
                        if (isset($mesas) && $mesas !== null) {
                            while ($allMesas = $mesas->fetch_object()) {
                                echo '<li class="tarjeta">';
                                echo '<img class="imagen-tarjeta" src="img/Mesas/' . $allMesas->vchImagen . '" alt="Imagen de la ' . $allMesas->vchUbicacion . '"  >';
                                echo '<h3 class="titulo-tarjeta">'.$allMesas->ClaveMesa.'</h3>';
                                echo '<p class="descripcion-tarjeta">'.$allMesas->Capasidad.'</p>';
                                echo '<p class="precio-tarjeta">'.$allMesas->vchUbicacion.'</p>';
                                echo '</li>';
                            }
                        }else{
                            echo 'No se encontraron zonas.';
                        }
                    ?>
                </ul>
                </ul>
                <i class="fa-solid fa-angle-right" data-catalogo="mesas"></i>
            </div>
        </div>
    </main>
</div>
<div class="contenedor-principal">
    <div class="contenido-principal">
        <section class="seccion-visitanos fondo-claro2">
            <div class="contenido-visitanos">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d232.582301138686!2d-98.4203074!3d21.1397865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d7276a63c27753%3A0x87e639fc00ffcaaa!2sFrikeys%20Terraza!5e0!3m2!1sen!2smx!4v1721768973803!5m2!1sen!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div>
                    <h2>Visítanos</h2>
                    <p>Explora nuevos platillos deliciosos y llenos de creatividad que vienen desde el corazón de la huasteca.</p>
                    <h4>Horarios</h4>
                    <p>Lun - Sáb: 12:00 pm - 10:00 pm</p>
                    <br>
                    <a href="#" class="boton-ver-menu">Cómo llegar</a>
                </div>
            </div>
        </section>            
        <section class="seccion-contacto fondo-claro2">
            <div class="contenido-contacto">
                <div>
                    <h2>Contáctanos</h2>
                    <p>Si tienes alguna pregunta o quieres hacer una reserva, no dudes en comunicarte con nosotros.</p>
                    <form class="formulario-contacto">
                        <input type="text" placeholder="Nombre" class="input-texto" />
                        <input type="email" placeholder="Correo electrónico" class="input-email" />
                        <textarea placeholder="Mensaje" class="input-mensaje"></textarea>
                        <button type="submit" class="boton-enviar">Enviar</button>
                    </form>
                </div>
                <div class="mapa-ubicacion"></div>
            </div>
        </section>
    </div>
</div>
<script id="Carusel">
    document.querySelectorAll(".contenedor-catalogo").forEach(catalogo => {
        const rejilla = catalogo.querySelector(".rejilla");
        const firstCardWidth = rejilla.querySelector(".tarjeta").offsetWidth;
        const arrowBtns = catalogo.querySelectorAll("i");
        let isDragging = false, isAutoPlay = true, startX, startScrollLeft, timeoutId;
        let cardPerView = Math.round(rejilla.offsetWidth / firstCardWidth);
        const carouselChildrens = [...rejilla.children];
        // Inserta copias de las últimas tarjetas al principio del carrusel
        carouselChildrens.slice(-cardPerView).reverse().forEach(card => {
            rejilla.insertAdjacentHTML("afterbegin", card.outerHTML);
        });
        // Inserta copias de las primeras tarjetas al final del carrusel
        carouselChildrens.slice(0, cardPerView).forEach(card => {
            rejilla.insertAdjacentHTML("beforeend", card.outerHTML);
        });
        rejilla.classList.add("no-transition");
        rejilla.scrollLeft = rejilla.offsetWidth;
        rejilla.classList.remove("no-transition");
        arrowBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                const scrollAmount = btn.classList.contains("fa-angle-left") ? -firstCardWidth : firstCardWidth;
                rejilla.scrollLeft += scrollAmount;
                setTimeout(() => infiniteScroll(rejilla), 500);
            });
        });
        const dragStart = (e) => {
            isDragging = true;
            rejilla.classList.add("dragging");
            startX = e.pageX;
            startScrollLeft = rejilla.scrollLeft;
        }
        const dragging = (e) => {
            if (!isDragging) return;
            rejilla.scrollLeft = startScrollLeft - (e.pageX - startX);
        }
        const dragStop = () => {
            isDragging = false;
            rejilla.classList.remove("dragging");
        }
        const infiniteScroll = (carousel) => {
            if (carousel.scrollLeft <= 0) {
                carousel.classList.add("no-transition");
                carousel.scrollLeft = carousel.scrollWidth - (2 * carousel.offsetWidth);
                carousel.classList.remove("no-transition");
            } else if (Math.ceil(carousel.scrollLeft + carousel.offsetWidth) >= carousel.scrollWidth) {
                carousel.classList.add("no-transition");
                carousel.scrollLeft = carousel.offsetWidth;
                carousel.classList.remove("no-transition");
            }
            clearTimeout(timeoutId);
            if (!catalogo.matches(":hover")) autoPlay();
        }
        const autoPlay = () => {
            if (window.innerWidth < 800 || !isAutoPlay) return;
            timeoutId = setTimeout(() => {
                rejilla.scrollLeft += firstCardWidth;
                infiniteScroll(rejilla);
            }, 5500); // Cambiar el valor aquí para ajustar el tiempo de desplazamiento automático
        }
        autoPlay();
        rejilla.addEventListener("mousedown", dragStart);
        rejilla.addEventListener("mousemove", dragging);
        document.addEventListener("mouseup", dragStop);
        rejilla.addEventListener("scroll", () => infiniteScroll(rejilla));
        catalogo.addEventListener("mouseenter", () => clearTimeout(timeoutId));
        catalogo.addEventListener("mouseleave", autoPlay);
    });
</script>