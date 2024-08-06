<div class="contenedor-reserva">
        <div class="rejilla-reserva">
            <form class="datos-formulario-reserva" action="/restaurante/index?clase=controladorcliente&metodo=SolicitarReservar" method="POST">
                <h1 class="titulo-reserva">Formulario de reservacion</h1>
                <div class="espacio-vertical-reserva">
                    <label for="nombre" class="etiqueta-reserva">Nombre del cliente</label>
                    <div class="rejilla-reserva columnas-2-reserva gap-pequeno-reserva">
                    <?php
                        if (isset($datos) && $datos !== null) {
                            while ($dat = $datos->fetch_object()) {
                                echo '<div id="1">';
                                echo '<input class="input-reserva etiqueta-reserva" type="text" placeholder="Nombre(s)" value="'.$dat->vchNombre.'"readonly>';
                                echo '</div>';
                                echo '<div id="1">';
                                echo '<input class="input-reserva etiqueta-reserva" type="text" placeholder="Apellido(s)" value="'.$dat->vchApellidos.'"readonly>';
                                echo '</div>';
                            }
                        } else {
                            echo '<div>';
                            echo '<input value="No hay datos">';
                            echo '</div>';
                            echo '<div id="1">';
                            echo '<input value="No hay datos">';
                            echo '</div>';
                        }
                    ?>
                    </div>
                    <div id="2">
                        <label for="telefono" class="etiqueta-reserva">Numero de telefono</label>
                        <input class="input-reserva max-reserva" type="number">
                    </div>
                    <div id="3">
                        <label for="fecha" class="etiqueta-reserva">Fecha de reservacion</label>
                        <input class="input-reserva max-reserva" type="date">
                    </div>
                    <div class="rejilla-reserva columnas-2-reserva gap-pequeno-reserva">
                        <div id="4">
                            <label for="hora-inicio" class="etiqueta-reserva">Hora de Inicio</label>
                            <input class="input-reserva" type="time">
                        </div>
                        <div id="5">
                            <label for="hora-final" class="etiqueta-reserva">Hora de Final</label>
                            <input class="input-reserva" type="time">
                        </div>
                    </div>
                    <div id="6">
                        <label for="ocasion" class="etiqueta-reserva">Ocacion</label>

                        <select class="input-reserva max-reserva" id="Ocacion" name="txtOcacion" required>
                            <option  value="" disabled selected>Selecciona una zona</option>
                            <?php
                            if (isset($idOca) && $idOca !== null) {
                                while ($Ocacion = $idOca->fetch_object()) {
                                    echo '<option value="' . $Ocacion->IdOcasiones . '">' . $Ocacion->vchNombreOcasiones . '</option>';
                                }
                            } else {
                                echo '<option value="">No hay zonas disponibles</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div id="7">
                        <label for="invitados" class="etiqueta-reserva">Numero de comensales</label>
                        <select id="invitados" name="invitados" class="input-reserva maximo-reserva">
                        <option value="" disabled selected></option>
                        </select>
                    </div>
                    <div id="8">
                        <label for="zona-preferencia" class="etiqueta-reserva">Zona de preferencia</label>
                        <select class="input-reserva max-reserva" id="zona-reserva" name="txtZonaReserva" required>
                            <option  value="" disabled selected>Selecciona una zona</option>
                            <?php
                            if (isset($datosZonas) && $datosZonas !== null) {
                                while ($zonaRes = $datosZonas->fetch_object()) {
                                    echo '<option value="' . $zonaRes->IdZona . '">' . $zonaRes->vchUbicacion . '</option>';
                                }
                            } else {
                                echo '<option value="">No hay zonas disponibles</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <button class="input-reserva centrado-reserva boton-reserva maximo-reserva" value="btnSolicitar">Solicitar</button>
                    <div class="rejilla-reserva columnas-3-reserva gap-pequeno-reserva">
                    <div id="9">
                        <label for="costo" class="etiqueta-reserva">Costo</label>
                        <?php
                        if (isset($Costo) && $Costo !== null) {
                            while ($CostoT = $Costo->fetch_object()) {
                                echo '<input id="txtCosto" name="txtCosto" class="input-reserva med-reserva" type="number" value="' . $CostoT->Costo . '" step="0.01" readonly>';
                            }
                        } else {
                            echo '<input id="txtCosto" name="txtCosto" class="input-reserva med-reserva" type="number" value="0" step="0.01">';
                        }
                        ?>
                    </div>
                    <div id="10">
                        <label for="anticipo" class="etiqueta-reserva">Anticipo</label>
                        <input id="txtAnticipo" name="txtAnticipo" class="input-reserva med-reserva" type="number" value="0" step="0.01">
                    </div>
                    <div id="11">
                        <label for="total" class="etiqueta-reserva">Total</label>
                        <input id="txtTotal" name="txtTotal" class="input-reserva med-reserva" type="number" value="0" step="0.01" readonly>
                    </div>
                </div>
                <script>
                    function calcularTotal() {
                        var costo = parseFloat(document.getElementById('txtCosto').value) || 0;
                        var anticipo = parseFloat(document.getElementById('txtAnticipo').value) || 0;
                        var total = costo - anticipo;
                        document.getElementById('txtTotal').value = total.toFixed(2);
                    }
                    // Configurar los eventos para recalcular cuando los valores cambian
                    document.getElementById('txtCosto').addEventListener('input', calcularTotal);
                    document.getElementById('txtAnticipo').addEventListener('input', calcularTotal);
                    // Ejecutar cálculo inicial si ya hay un costo predefinido
                    calcularTotal();
                </script>
                    <button class="input-reserva centrado-reserva boton-reserva maximo-reserva" value="btnReservar">Reservar</button>
                </div>
                <script>
                    const selectElement = document.getElementById('invitados');
                    for (let i = 2; i <= 15; i++) {
                        const option = document.createElement('option');
                        option.value = i;
                        option.textContent = i;
                        selectElement.appendChild(option);
                    }
                </script>
            </form>
            <!-- <div class="datos-reservas-reserva">
                <h2 class="subtitulo-reserva">Reservaciones Realizadas</h2>
                <div>
                    <table class="tabla-reserva">
                    <tr>
                        <th>Numero de reservacion</th>
                        <th>Fecha de solicitud</th>
                        <th>Estado</th>
                        <th>Movimiento</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button class="input-reserva centrado-reserva boton-reserva maximo-reserva">Reservar</button></td>
                    </tr>
                    </table>
                </div>
            </div> -->
        </div>
    </div>

    <!-- <script>
        const selectElement = document.getElementById('invitados');
        const numberWords = [
        "Uno", "Dos", "Tres", "Cuatro", "Cinco", "Seis", "Siete", "Ocho", "Nueve", "Diez",
        "Once", "Doce", "Trece", "Catorce", "Quince", "Dieciséis", "Diecisiete", "Dieciocho", "Diecinueve", "Veinte"
        ];

        numberWords.forEach((word, index) => {
        const option = document.createElement('option');
        option.value = index + 1;
        option.textContent = word;
        selectElement.appendChild(option);
        });
    </script> -->