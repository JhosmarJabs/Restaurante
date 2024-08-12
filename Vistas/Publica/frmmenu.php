        <div class="nm-principal">
            <div class="nm-primario">
                <h1 class="nm-titulo">Menu</h1>
            </div>
            <section>
                <h2 class="nm-subtitulo">Comida</h2>
                <div class="nm-catalogo" id="entradas-catalogo">
                    <i class="fa-solid fa-angle-left" data-catalogo="entradas"></i>
                    <ul class="nm-grid" id="entradas-grid">
                    <?php
                        if (isset($Comidas) && $Comidas !== null) {
                            while ($allComida = $Comidas->fetch_object()) {
                                echo '<li class="nm-tarjeta">';
                                echo '<img class="nm-imagen-tarjeta" src="img/Comidas/' . $allComida->vchImagen . '" alt="Imagen de la ' . $allComida->vchImagen . '" onclick="window.location.href=\'/restaurante/index?clase=controladorpublico&metodo=Detalles&id=' . $allComida->idComida . '&Tipo=Comida\'" >';
                                echo '<h3 class="nm-nombre">'.$allComida->vchNombre.'</h3>';
                                echo '<p class="nm-descripcion">'.$allComida->vchDescripcion.'</p>';
                                echo '<p class="nm-precio"> $'.$allComida->fltPrecio.'</p>';
                                echo '</li>';
                            }
                        } else {
                            echo 'No se encontraron zonas.';
                        }
                    ?>
                    </ul>
                    <i class="fa-solid fa-angle-right" data-catalogo="entradas"></i>
                </div>
                <h2 class="nm-subtitulo">Bebidas</h2>
                <div class="nm-catalogo" id="principales-catalogo">
                    <i class="fa-solid fa-angle-left" data-catalogo="principales"></i>
                    <ul class="nm-grid" id="principales-grid">
                    <?php
                        if (isset($Bebidas) && $Bebidas !== null) {
                            while ($allBebidas = $Bebidas->fetch_object()) {
                                echo '<li class="nm-tarjeta">';
                                echo '<img class="nm-imagen-tarjeta" src="img/Bebidas/' . $allBebidas->vchImagen . '" alt="Imagen de la ' . $allBebidas->vchImagen . '" onclick="window.location.href=\'/restaurante/index?clase=controladorpublico&metodo=Detalles&id=' . $allBebidas->idBebida . '&Tipo=Bebida\'" >';
                                echo '<h3 class="nm-nombre">'.$allBebidas->vchNombre.'</h3>';
                                echo '<p class="nm-descripcion">'.$allBebidas->vchDescripcion.'</p>';
                                echo '<p class="nm-precio"> $'.$allBebidas->fltPrecio.'</p>';
                                echo '</li>';
                            }
                        } else {
                            echo 'No se encontraron zonas.';
                        }
                    ?>
                    </ul>
                    <i class="fa-solid fa-angle-right" data-catalogo="principales"></i>
                </div>
                <h2 class="nm-subtitulo">Postres</h2>
                <div class="nm-catalogo" id="postres-catalogo">
                    <i class="fa-solid fa-angle-left" data-catalogo="postres"></i>
                    <ul class="nm-grid" id="postres-grid">
                    <?php
                        if (isset($Postres) && $Postres !== null) {
                            while ($allPostres = $Postres->fetch_object()) {
                                echo '<li class="nm-tarjeta">';
                                echo '<img class="nm-imagen-tarjeta" src="img/Postres/' . $allPostres->vchImagen . '" alt="Imagen de la ' . $allPostres->vchImagen . '" onclick="window.location.href=\'/restaurante/index?clase=controladorpublico&metodo=Detalles&id=' . $allPostres->idPostre . '&Tipo=Postre\'" >';
                                echo '<h3 class="nm-nombre">'.$allPostres->vchNombre.'</h3>';
                                echo '<p class="nm-descripcion">'.$allPostres->vchDescripcion.'</p>';
                                echo '<p class="nm-precio"> $ '.$allPostres->fltPrecio.'</p>';
                                echo '</li>';
                            }
                        } else {
                            echo 'No se encontraron zonas.';
                        }
                    ?>
                    </ul>
                    <i class="fa-solid fa-angle-right" data-catalogo="postres"></i>
                </div>
            </section>
        </div>
        <script>
            document.querySelectorAll(".nm-catalogo").forEach(catalogo => {
            const grid = catalogo.querySelector(".nm-grid");
            const firstCardWidth = grid.querySelector(".nm-tarjeta").offsetWidth;
            const arrowBtns = catalogo.querySelectorAll("i");

            let isDragging = false, isAutoPlay = true, startX, startScrollLeft, timeoutId;

            let cardPerView = Math.round(grid.offsetWidth / firstCardWidth);

            const carouselChildrens = [...grid.children];

            // Inserta copias de las últimas tarjetas al principio del carrusel
            carouselChildrens.slice(-cardPerView).reverse().forEach(card => {
                grid.insertAdjacentHTML("afterbegin", card.outerHTML);
            });
        
            // Inserta copias de las primeras tarjetas al final del carrusel
            carouselChildrens.slice(0, cardPerView).forEach(card => {
                grid.insertAdjacentHTML("beforeend", card.outerHTML);
            });
        
            grid.classList.add("no-transition");
            grid.scrollLeft = grid.offsetWidth;
            grid.classList.remove("no-transition");
        
            arrowBtns.forEach(btn => {
                btn.addEventListener("click", () => {
                    const scrollAmount = btn.classList.contains("fa-angle-left") ? -firstCardWidth : firstCardWidth;
                    grid.scrollLeft += scrollAmount;
                    setTimeout(() => infiniteScroll(grid), 500);
                });
            });
        
            const dragStart = (e) => {
                isDragging = true;
                grid.classList.add("dragging");
                startX = e.pageX;
                startScrollLeft = grid.scrollLeft;
            }
        
            const dragging = (e) => {
                if (!isDragging) return;
                grid.scrollLeft = startScrollLeft - (e.pageX - startX);
            }
        
            const dragStop = () => {
                isDragging = false;
                grid.classList.remove("dragging");
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
                    grid.scrollLeft += firstCardWidth;
                    infiniteScroll(grid);
                }, 5500); // Cambiar el valor aquí para ajustar el tiempo de desplazamiento automático
            }
            autoPlay();
        
            grid.addEventListener("mousedown", dragStart);
            grid.addEventListener("mousemove", dragging);
            document.addEventListener("mouseup", dragStop);
            grid.addEventListener("scroll", () => infiniteScroll(grid));
            catalogo.addEventListener("mouseenter", () => clearTimeout(timeoutId));
            catalogo.addEventListener("mouseleave", autoPlay);
        });
        </script>