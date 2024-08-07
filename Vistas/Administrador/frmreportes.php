<div class="contenedor-reserva">
    <div class="rejilla-reserva">
        <form class="datos-formulario-reserva" action="/restaurante/index?clase=controladoradministrador&metodo=reportes" method="POST"">
        <h2>REPORTES DE ELIMINACION</h2>
        <div class="rejilla-reserva columnas-2-reserva gap-pequeno-reserva">
            <select name="txttabla" id="">
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
            
        <div id="10">
            <label for="anticipo" class="etiqueta-reserva">Fecha de eliminacion</label>
            <input id="txtfecha" name="txtfecha" class="input-reserva med-reserva" type="date" value="0" step="0.01">
        </div>
    </div>
    <button class="input-reserva centrado-reserva boton-reserva maximo-reserva">Generar el reporte</button>
    </form>
    </div>
</div>