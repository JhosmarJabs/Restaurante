<div class="flex-columna-alto-min">
    <main class="contenido-principal">
        <div class="contenedor-pestanas">
            <div class="lista-pestanas">
                <button class="pestana activa" data-valor="empleados">Empleados</button>
                <button class="pestana" data-valor="zonas">Zonas</button>
                <button class="pestana" data-valor="mesas">Mesas</button>
                <button class="pestana" data-valor="postres">Postres</button>
                <button class="pestana" data-valor="comidas">Comidas</button>
                <button class="pestana" data-valor="bebidas">Bebidas</button>
            </div>
            <div class="contenido-pestana activa" data-valor="empleados">
                <div class="cabecera-seccion">
                <h2 class="titulo-seccion">Empleados</h2>
                <button class="boton-accion" onclick="mostrarFormulario('empleados')">
                    <svg class="icono-margen-derecho" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                    </svg>
                    Añadir Empleados
                </button>
                </div>
                <div id="formulario-empleados" class="formulario-oculto">
                <form action="/restaurante/index?clase=controladoradministrador&metodo=altaempleado" method="POST" class="formularioAltas">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="txtnombre" required pattern="^[a-zA-Z\s]+$" title="El nombre solo debe contener letras y espacios.">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="txtapellidos" required pattern="^[a-zA-Z\s]+$" title="El apellido solo debe contener letras y espacios.">
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="txtcorreo" required title="Por favor ingrese un correo válido.">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="txttelefono" required pattern="^\d{10}$" title="El número de teléfono debe contener 10 dígitos.">
                    <label for="clave">Clave:</label>
                    <input type="password" id="clave" name="txtclave" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula y un número.">
                    <button type="submit">Guardar</button>
                </form>
                </div>
                <div class="tarjeta">
                <table class="tabla">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Clave</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <?php
                        if (isset($Empleados) && $Empleados !== null) {
                            while ($allEmpleado = $Empleados->fetch_object()) {
                                // echo '<pre>';
                                // print_r($allEmpleado);
                                // echo '</pre>';
                                echo '<form class="form" action="/restaurante/index?clase=controladoradministrador&metodo=EliminaActualizaEmpleado" method="POST">';
                                echo '<tr>';
                                echo '<input type="hidden" name="txtIdEmpleado" value="' . $allEmpleado->idUsuario . '">';
                                echo '<td> <input type="text" name="txtNombreC" value="' . $allEmpleado->vchNombre . '" > </td>';
                                echo '<td> <input type="text" name="txtApC" value="' . $allEmpleado->vchApellidos . '" ></td>';
                                echo '<td> <input type="text" name="txtEmC" value="' . $allEmpleado->vchEmail . '" ></td>';
                                echo '<td> <input type="text" name="txtTelC" value="' . $allEmpleado->vchNotelefono . '" ></td>';
                                echo '<td width=150>';
                                echo '<button type="submit" class="recuperar" name="btnrecuperar" value="btnRecuperar" class="submit-button">Recuperar</button>';
                                echo '</td>';
                                echo '<td width=210>';
                                echo '<button type="submit" class="eliminar" name="btnEliminar" value="btnEliminar" class="submit-button">Eliminar</button>';
                                echo '&nbsp;';
                                echo '<button type="submit" class="actualizar" name="btnActualizar" value="btnActualizar" class="submit-button">Actualizar</button>';
                                echo '</td>';
                                echo '</tr>';
                                echo '</form>';
                            }
                        } else {
                            echo 'No se encontraron empleados.';
                        }
                    ?>
                </table>
                </div>
            </div>
            
            <div class="contenido-pestana" data-valor="zonas">
                <div class="cabecera-seccion">
                    <h2 class="titulo-seccion">Zonas</h2>
                    <button class="boton-accion" onclick="mostrarFormulario('zonas')">
                        <svg class="icono-margen-derecho" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        Añadir Zona
                    </button>
                </div>
                <div id="formulario-zonas" class="formulario-oculto">
                <form action="/restaurante/index?clase=controladoradministrador&metodo=altazona" method="POST" enctype="multipart/form-data" class="formularioAltas">
                    <label for="nombre-zona">Nombre:</label>
                    <input type="text" id="nombre-zona" name="txtnombre-zona" required pattern="^[a-zA-Z\s]+$" title="El nombre solo debe contener letras y espacios.">
        
                    <label for="imagen-zona">Imagen:</label>
                    <input type="file" id="imagen-zona" name="txtimagen-zona" accept="image/*" required title="Seleccione un archivo de imagen válido.">
        
                    <button type="submit">Guardar</button>
                </form>
                </div>
                <div class="tarjeta">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($zonas) && $zonas !== null) {
                            while ($zona = $zonas->fetch_object()) {
                                echo '<form class="form" action="/restaurante/index?clase=controladoradministrador&metodo=EliminaActualizaZona" method="POST">';
                                echo '<input type="hidden" name="txtIdZona" value="' . $zona->IdZona . '">';
                                echo '<tr>';
                                echo '<td> <input type="text" name="txtNombreZona" value="' . $zona->vchUbicacion . '"> </td>';
                                echo '<td> <img src="img/Zonas/' . $zona->vchImagen . '" alt="Imagen de la ' . $zona->vchUbicacion . '" width="150"> </td>';
                                echo '<td width=210>';
                                echo '<button type="submit" class="eliminar" name="btnEliminar" value="btnEliminar" class="submit-button">Eliminar</button>';
                                echo '&nbsp;';
                                echo '<button type="submit" class="actualizar" name="btnActualizar" value="btnActualizar" class="submit-button">Actualizar</button>';
                                echo '</td>';
                                echo '</tr>';
                                echo '</form>';
                            }
                        } else {
                            echo 'No se encontraron zonas.';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="contenido-pestana" data-valor="mesas">
                <div class="cabecera-seccion">
                    <h2 class="titulo-seccion">Mesas</h2>
                    <button class="boton-accion" onclick="mostrarFormulario('mesas')">
                        <svg class="icono-margen-derecho" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        Añadir Mesas
                    </button>
                </div>
                <div id="formulario-mesas" class="formulario-oculto">
                    <form action="/restaurante/index?clase=controladoradministrador&metodo=altamesa" method="POST" class="formularioAltas" enctype="multipart/form-data">
                        <label for="numero-mesa">Clave de Mesa:</label>
                        <input type="text" id="numero-mesa" name="txtClaveMesa" required pattern="^[a-zA-Z0-9\s]+$" title="La clave de mesa solo debe contener letras, números y espacios.">
                        <label for="capacidad-mesa">Capacidad:</label>
                        <input type="number" id="capacidad-mesa" name="txtCapacidadMesa" required min="1" title="Ingrese una capacidad válida.">
                        <label for="zona-mesa">Zona:</label>
                        <select id="zona-mesa" name="txtZonaMesa" required>
                            <option value="" disabled selected>Selecciona una zona</option>
                            <?php
                            if (isset($zonasC) && $zonasC !== null) {
                                while ($zonaC = $zonasC->fetch_object()) {
                                    echo '<option value="' . $zonaC->IdZona . '">' . $zonaC->vchUbicacion . '</option>';
                                }
                            } else {
                                echo '<option value="">No hay zonas disponibles</option>';
                            }
                            ?>
                        </select>
                        <label for="costo-mesa">Costo:</label>
                        <input type="number" id="costo-mesa" name="txtCostoMesa" required min="0" step="0.01" title="Ingrese un costo válido.">
                        
                        <label for="imagen-mesa">Imagen:</label>
                        <input type="file" id="imagen-mesa" name="txtImagenMesa" required accept="image/*" title="Seleccione un archivo de imagen válido.">
                        
                        <button type="submit">Guardar</button>
                    </form>
                </div>
                <div class="tarjeta">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Clave de Mesa</th>
                                <th>Capacidad</th>
                                <th>Zona</th>
                                <th>Costo</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($mesas) && $mesas !== null) {
                            while ($mesa = $mesas->fetch_object()) {
                                echo '<form class="form" action="/restaurante/index?clase=controladoradministrador&metodo=EliminaActualizaMesa" method="POST">';
                                echo '<input type="hidden" name="txtIdMesa" value="' . $mesa->IdMesa . '">';
                                echo '<tr>';
                                echo '<td> <input type="text" name="txtClaveMesa" value="' . $mesa->ClaveMesa . '" readonly> </td>';
                                echo '<td> <input type="text" name="txtCapasidad" value="' . $mesa->Capasidad . '" ></td>';
                                echo '<td> <input type="text" name="txtZona" value="' . $mesa->vchUbicacion . '" ></td>';
                                echo '<td> <input type="text" name="txtCosto" value="' . $mesa->costo . '" ></td>';
                                echo '<td> <img src="img/Mesas/' . $mesa->vchImagen . '" alt="Imagen de la Mesa" width="150"> </td>';
                                echo '<td width=210>';
                                echo '<button type="submit" class="eliminar" name="btnEliminar" value="btnEliminar" class="submit-button">Eliminar</button>';
                                echo '&nbsp;';
                                echo '<button type="submit" class="actualizar" name="btnActualizar" value="btnActualizar" class="submit-button">Actualizar</button>';
                                echo '</td>';
                                echo '</tr>';
                                echo '</form>';
                            }
                        } else {
                            echo 'No se encontraron mesas.';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="contenido-pestana" data-valor="postres">
                <div class="cabecera-seccion">
                    <h2 class="titulo-seccion">Postres</h2>
                    <button class="boton-accion" onclick="mostrarFormulario('postres')">
                        <svg class="icono-margen-derecho" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        Añadir Postres
                    </button>
                </div>
                <div id="formulario-postres" class="formulario-oculto">
                <form action="/restaurante/index?clase=controladoradministrador&metodo=altapostre" method="POST" class="formularioAltas" enctype="multipart/form-data">
                <label for="nombre-postre">Nombre:</label>
                <input type="text" id="nombre-postre" name="txtnombre-postre" required pattern="^[a-zA-Z\s]+$" title="El nombre solo debe contener letras y espacios.">
                <label for="descripcion-postre">Descripción:</label>
                <input type="text" id="descripcion-postre" name="txtdescripcion-postre" required pattern="^[a-zA-Z0-9\s]+$" title="La descripción solo debe contener letras, números y espacios.">
                <label for="costo-postre">Costo:</label>
                <input type="number" id="costo-postre" name="txtcosto-postre" required min="0" step="0.01" title="Ingrese un costo válido.">
                <label for="imagen-postre">Imagen:</label>
                <input type="file" id="imagen-postre" name="txtimagenpostre" required accept="image/*" title="Seleccione un archivo de imagen válido.">
                <button type="submit">Guardar</button>
            </form>

                </div>
                <div class="tarjeta">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Costo</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($postres) && $postres !== null) {
                            while ($postre = $postres->fetch_object()) {
                                echo '<form class="form" action="/restaurante/index?clase=controladoradministrador&metodo=EliminaActualizaPostre" method="POST">';
                                echo '<input type="hidden" name="txtIdPostre" value="' . $postre->idPostre . '">';
                                echo '<tr>';
                                echo '<td> <input type="text" name="txtNombrePostre" value="' . $postre->vchnombre . '" readonly> </td>';
                                echo '<td> <input type="text" name="txtDescripcionPostre" value="' . $postre->vchDescripcion . '" ></td>';
                                echo '<td> <input type="text" name="txtCostoPostre" value="' . $postre->fltPrecio . '" ></td>';
                                echo '<td> <img src="img/Postres/' . $postre->vchImagen . '" alt="Imagen del Postre" width="150"> </td>';
                                echo '<td width=210>';
                                echo '<button type="submit" class="eliminar" name="btnEliminar" value="btnEliminar" class="submit-button">Eliminar</button>';
                                echo '&nbsp;';
                                echo '<button type="submit" class="actualizar" name="btnActualizar" value="btnActualizar" class="submit-button">Actualizar</button>';
                                echo '</td>';
                                echo '</tr>';
                                echo '</form>';
                            }
                        } else {
                            echo 'No se encontraron postres.';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="contenido-pestana" data-valor="comidas">
                <div class="cabecera-seccion">
                    <h2 class="titulo-seccion">Comidas</h2>
                    <button class="boton-accion" onclick="mostrarFormulario('comidas')">
                        <svg class="icono-margen-derecho" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        Añadir Comidas
                    </button>
                </div>
                <div id="formulario-comidas" class="formulario-oculto">
                <form action="/restaurante/index?clase=controladoradministrador&metodo=altacomida" method="POST" class="formularioAltas" enctype="multipart/form-data">
                    <label for="nombre-comida">Nombre:</label>
                    <input type="text" id="nombre-comida" name="txtnombre-comida" required pattern="^[a-zA-Z\s]+$" title="El nombre solo debe contener letras y espacios.">
                    <label for="descripcion-comida">Descripción:</label>
                    <input type="text" id="descripcion-comida" name="txtdescripcion-comida" required pattern="^[a-zA-Z0-9\s]+$" title="La descripción solo debe contener letras, números y espacios.">
                    <label for="costo-comida">Costo:</label>
                    <input type="number" id="costo-comida" name="txtcosto-comida" required min="0" step="0.01" title="Ingrese un costo válido.">
                    <label for="imagen-comida">Imagen:</label>
                    <input type="file" id="imagen-comida" name="txtimagen-comida" required accept="image/*" title="Seleccione un archivo de imagen válido.">
                    <button type="submit">Guardar</button>
                    </form>
                </div>
                <div class="tarjeta">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Costo</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($comidas) && $comidas !== null) {
                                while ($comida = $comidas->fetch_object()) {
                                    echo '<form class="form" action="/restaurante/index?clase=controladoradministrador&metodo=EliminaActualizaComida" method="POST">';
                                    echo '<input type="hidden" name="txtidComida" value="' . $comida->idComida . '">';
                                    echo '<tr>';
                                    echo '<td> <input type="text" name="txtNombreComida" value="' . $comida->vchNombre . '" readonly> </td>';
                                    echo '<td> <input type="text" name="txtDescripcionComida" value="' . $comida->vchDescripcion . '" ></td>';
                                    echo '<td> <input type="text" name="txtCostoComida" value="' . $comida->fltPrecio . '" ></td>';
                                    echo '<td> <img src="img/Comidas/' . $comida->vchImagen . '" alt="Imagen de la Comida" width="150"> </td>';
                                    echo '<td width=210>';
                                    echo '<button type="submit" class="eliminar" name="btnEliminar" value="btnEliminar" class="submit-button">Eliminar</button>';
                                    echo '&nbsp;';
                                    echo '<button type="submit" class="actualizar" name="btnActualizar" value="btnActualizar" class="submit-button">Actualizar</button>';
                                    echo '</td>';
                                    echo '</tr>';
                                    echo '</form>';
                                }
                            } else {
                                echo 'No se encontraron comidas.';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="contenido-pestana" data-valor="bebidas">
                <div class="cabecera-seccion">
                    <h2 class="titulo-seccion">Bebidas</h2>
                    <button class="boton-accion" onclick="mostrarFormulario('bebidas')">
                        <svg class="icono-margen-derecho" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        Añadir Bebidas
                    </button>
                </div>
                <div id="formulario-bebidas" class="formulario-oculto">
                <form action="/restaurante/index?clase=controladoradministrador&metodo=altabebida" method="POST" class="formularioAltas" enctype="multipart/form-data">
                    <label for="nombre-bebida">Nombre:</label>
                    <input type="text" id="nombre-bebida" name="txtnombre-bebida" required pattern="^[a-zA-Z\s]+$" title="El nombre solo debe contener letras y espacios.">
        
                    <label for="descripcion-bebida">Descripción:</label>
                    <input type="text" id="descripcion-bebida" name="txtdescripcion-bebida" required pattern="^[a-zA-Z0-9\s]+$" title="La descripción solo debe contener letras, números y espacios.">
        
                    <label for="costo-bebida">Costo:</label>
                    <input type="number" id="costo-bebida" name="txtcosto-bebida" required min="0" step="0.01" title="Ingrese un costo válido.">
        
                    <label for="imagen-bebida">Imagen:</label>
                    <input type="file" id="imagen-bebida" name="txtimagen-bebida" required accept="image/*" title="Seleccione un archivo de imagen válido.">
        
                    <button type="submit">Guardar</button>
                </form>
                </div>
                <div class="tarjeta">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Costo</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($bebidas) && $bebidas !== null) {
                            while ($bebida = $bebidas->fetch_object()) {
                                echo '<form class="form" action="/restaurante/index?clase=controladoradministrador&metodo=EliminaActualizaBebida" method="POST">';
                                echo '<input type="hidden" name="txtIdBebida" value="' . $bebida->idBebida . '">';
                                echo '<tr>';
                                echo '<td> <input type="text" name="txtNombreBebida" value="' . $bebida->vchnombre . '" readonly> </td>';
                                echo '<td> <input type="text" name="txtDescripcionBebida" value="' . $bebida->vchDescripcion . '" ></td>';
                                echo '<td> <input type="text" name="txtCostoBebida" value="' . $bebida->fltPrecio . '" ></td>';
                                echo '<td> <img src="img/Bebidas/' . $bebida->vchImagen . '" alt="Imagen de la Bebida" width="150"> </td>';
                                echo '<td width=210>';
                                echo '<button type="submit" class="eliminar" name="btnEliminar" value="btnEliminar" class="submit-button">Eliminar</button>';
                                echo '&nbsp;';
                                echo '<button type="submit" class="actualizar" name="btnActualizar" value="btnActualizar" class="submit-button">Actualizar</button>';
                                echo '</td>';
                                echo '</tr>';
                                echo '</form>';
                            }
                        } else {
                            echo 'No se encontraron bebidas.';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Toggle dropdown visibility
            document.querySelectorAll('.desplegable-trigger').forEach(button => {
                button.addEventListener('click', () => {
                    button.nextElementSibling.classList.toggle('oculto');
                });
            });
            // Toggle tab visibility
            document.querySelectorAll('.pestana').forEach(tab => {
                tab.addEventListener('click', () => {
                    const valor = tab.getAttribute('data-valor');
                    document.querySelectorAll('.pestana').forEach(t => t.classList.remove('activa'));
                    document.querySelectorAll('.contenido-pestana').forEach(content => {
                        content.classList.remove('activa');
                        if (content.getAttribute('data-valor') === valor) {
                            content.classList.add('activa');
                        }
                    });
                    tab.classList.add('activa');
                });
            });
        });

        // Show form when add button is clicked
        function mostrarFormulario(tipo) {
            const formularioId = `formulario-${tipo}`;
            const formulario = document.getElementById(formularioId);
            if (formulario) {
                formulario.classList.toggle('formulario-activo');
            }
        }
    </script>
</div>