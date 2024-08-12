<div class="contenedor-reserva-unico" style="height: 72.8vh;">
    <div class="rejilla-reserva-unico">
        <form class="datos-formulario-reserva-unico" action="" method="POST">
            <div class="rejilla-reserva-unico columnas-2-reserva-unico gap-pequeno-reserva-unico">
                <?php
                    if (isset($producto) && $producto !== null) {
                        while ($allproductoC = $producto->fetch_object()) {
                            echo '<div class="rejilla-unico">';
                                echo '<img class="imagen-tarjeta-unico" src="img/' . ucfirst($tipo) . 's/' . $allproductoC->vchImagen . '" alt="Imagen de la ' . $allproductoC->vchNombre . '">';
                            echo '</div>';
                            echo '<div>';
                                echo '<li class="rejilla-unico">';
                                echo '<h3 class="titulo-tarjeta-unico">'.$allproductoC->vchNombre.'</h3>';
                                echo '<p class="descripcion-tarjeta-unico">'.$allproductoC->vchDescripcion.'</p>';
                                echo '<p class="precio-tarjeta-unico">$'.$allproductoC->fltPrecio.'</p>';
                                echo '</li>';
                            echo '</div>';
                        }
                    } else {
                        echo 'No se encontraron productos.';
                    }
                ?>  
            </div>
            <button class="input-reserva-unico centrado-reserva-unico boton-reserva-unico maximo-reserva-unico" >Regresar al inicio</button>
        </form>
    </div>
</div>
