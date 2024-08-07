<div class="contenedor-reserva" style="height: 70.7vh;">
    <div class="rejilla-reserva">
        <form class="datos-formulario-reserva" action="/restaurante/index?clase=controladoradministrador&metodo=reporteReservas" method="POST"">
        <h2 style="color:wheat">REPORTES DE RESERVAS</h2>
            <div class="rejilla-reserva columnas-2-reserva gap-pequeno-reserva">
                <div id="10">
                    <label for="anticipo" class="etiqueta-reserva">Fecha de eliminacion</label>
                    <input id="txtfecha" name="txtfechaR" class="input-reserva med-reserva" type="date" value="0" step="0.01" style="width: 56.0vh;">
                </div>
            </div>
            <br>
            <button class="input-reserva centrado-reserva boton-reserva maximo-reserva" style="width: 125vh;">Generar el reporte</button>
        </form>
        <form class="datos-formulario-reserva" action="/restaurante/index?clase=controladoradministrador&metodo=reporteEliminacion" method="POST"">
        <h2 style="color:wheat">REPORTES DE ELIMINACION</h2>
            <div class="rejilla-reserva columnas-2-reserva gap-pequeno-reserva">
                <div>
                <label for="anticipo" class="etiqueta-reserva">Tabla de eliminacion</label>
                <select name="txttabla" id="" class="input-reserva max-reserva">
                <?php
                    if (isset($TablasR) && $TablasR !== null) {
                        while ($Tab = $TablasR->fetch_object()) {
                            echo '<option value="' . $Tab->tabla . '">' . $Tab->tabla . '</option>';
                        }
                    } else {
                        echo '<option value="">No hay zonas disponibles</option>';
                    }
                    ?>
                </select>
                </div>
                <div id="10">
                    <label for="anticipo" class="etiqueta-reserva">Fecha de eliminacion</label>
                    <input id="txtfecha" name="txtfecha" class="input-reserva med-reserva" type="date" value="0" step="0.01" style="width: 56.0vh;">
                </div>
            </div>
            <br>
            <button class="input-reserva centrado-reserva boton-reserva maximo-reserva" style="width: 125vh;">Generar el reporte</button>
        </form>
    </div>
</div>