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
              <input type="text" id="nombre" name="txtnombre">
              <label for="apellidos">Apellidos:</label>
              <input type="text" id="apellidos" name="txtapellidos">
              <label for="correo">Correo:</label>
              <input type="email" id="correo" name="txtcorreo">
              <label for="telefono">Teléfono:</label>
              <input type="tel" id="telefono" name="txttelefono">
              <label for="clave">Clave:</label>
              <input type="password" id="clave" name="txtclave">
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
              <tbody>
                <tr>
                  <td>John Doe</td>
                  <td>Doe</td>
                  <td>john@example.com</td>
                  <td>1234567890</td>
                  <td>
                    <button class="boton">
                      <a href="#">Recuperala</a>
                    </button>
                  </td>
                  <td>
                    <button class="boton">
                      <a href="#">Eliminar</a>
                    </button>
                  </td>
                </tr>
              </tbody>
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
            <form action="" method="POST" class="formularioAltas">
              <label for="nombre-zona">Nombre:</label>
              <input type="text" id="nombre-zona" name="txtnombre-zona">
              <label for="descripcion-zona">Descripción:</label>
              <input type="text" id="descripcion-zona" name="txtdescripcion-zona">
              <label for="estado-zona">Estado:</label>
              <!-- <select id="estado-zona" name="txtestado-zona">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
              </select> -->
              <button type="submit">Guardar</button>
            </form>
          </div>
          <div class="tarjeta">
            <table class="tabla">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Main Dining Area</td>
                  <td>The main dining area of the restaurant</td>
                  <td>
                    <button class="boton">
                      <a href="#">Eliminar</a>
                    </button>
                  </td>
                </tr>
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
            <form action="" method="POST" class="formularioAltas">
              <label for="numero-mesa">Número:</label>
              <input type="text" id="numero-mesa" name="txtnumero-mesa">
              <label for="zona-mesa">Zona:</label>
              <input type="text" id="zona-mesa" name="txtzona-mesa">
              <label for="capacidad-mesa">Capacidad:</label>
              <input type="number" id="capacidad-mesa" name="txtcapacidad-mesa">
              <label for="estado-mesa">Estado:</label>
              <select id="estado-mesa" name="txtestado-mesa">
                <option value="disponible">Disponible</option>
                <option value="ocupado">Ocupado</option>
              </select>
              <button type="submit">Guardar</button>
            </form>
          </div>
          <div class="tarjeta">
            <table class="tabla">
              <thead>
                <tr>
                  <th>Número</th>
                  <th>Zona</th>
                  <th>Capacidad</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Main Dining Area</td>
                  <td>4</td>
                  <td><span class="etiqueta">Disponible</span></td>
                  <td>
                    <button class="boton">
                      <a href="#">Eliminar</a>
                    </button>
                  </td>
                </tr>
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
            <form action="" method="POST" class="formularioAltas">
              <label for="nombre-postre">Nombre:</label>
              <input type="text" id="nombre-postre" name="txtnombre-postre">
              <label for="descripcion-postre">Descripción:</label>
              <input type="text" id="descripcion-postre" name="txtdescripcion-postre">
              <label for="costo-postre">Costo:</label>
              <input type="number" id="costo-postre" name="txtcosto-postre">
              <label for="imagen-postre">Imagen:</label>
              <input type="file" id="imagen-postre" name="txtimagen-postre">
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
                <tr>
                  <td>Menú de Almuerzo</td>
                  <td>El menú de almuerzo del restaurante</td>
                  <td>$31</td>
                  <td><img src="ruta_de_la_imagen.jpg" alt="Descripción de la imagen"></td>
                  <td>
                    <button class="boton">
                      <a href="#">Eliminar</a>
                    </button>
                  </td>
                </tr>
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
            <form action="" method="POST" class="formularioAltas">
              <label for="nombre-comida">Nombre:</label>
              <input type="text" id="nombre-comida" name="txtnombre-comida">
              <label for="descripcion-comida">Descripción:</label>
              <input type="text" id="descripcion-comida" name="txtdescripcion-comida">
              <label for="costo-comida">Costo:</label>
              <input type="number" id="costo-comida" name="txtcosto-comida">
              <label for="imagen-comida">Imagen:</label>
              <input type="file" id="imagen-comida" name="txtimagen-comida">
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
                <tr>
                  <td>Menú de Almuerzo</td>
                  <td>El menú de almuerzo del restaurante</td>
                  <td>$31</td>
                  <td><img src="ruta_de_la_imagen.jpg" alt="Descripción de la imagen"></td>
                  <td>
                    <button class="boton">
                      <a href="#">Eliminar</a>
                    </button>
                  </td>
                </tr>
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
            <form action="" method="POST" class="formularioAltas">
              <label for="nombre-bebida">Nombre:</label>
              <input type="text" id="nombre-bebida" name="txtnombre-bebida">
              <label for="descripcion-bebida">Descripción:</label>
              <input type="text" id="descripcion-bebida" name="txtdescripcion-bebida">
              <label for="costo-bebida">Costo:</label>
              <input type="number" id="costo-bebida" name="txtcosto-bebida">
              <label for="imagen-bebida">Imagen:</label>
              <input type="file" id="imagen-bebida" name="txtimagen-bebida">
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
                <tr>
                  <td>Menú de Almuerzo</td>
                  <td>El menú de almuerzo del restaurante</td>
                  <td>$31</td>
                  <td><img src="ruta_de_la_imagen.jpg" alt="Descripción de la imagen"></td>
                  <td>
                    <button class="boton">
                      <a href="#">Eliminar</a>
                    </button>
                  </td>
                </tr>
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