<div class="contenedor-reserva" style="height: 72.8vh;">
    <div class="rejilla-reserva">
        <form class="datos-formulario-reserva" action="/restaurante/index?clase=controladorcliente&metodo=Reservar" method="POST"">
            <div class="rejilla-reserva columnas-3-reserva gap-pequeno-reserva">
                <div>
                    <label for="anticipo" class="etiqueta-reserva">Costo</label>
                    <?php
                    if (isset($Costo) && $Costo !== null) {
                        while ($CostoT = $Costo->fetch_object()) {
                            echo '<input id="txtCosto" name="txtCosto" class="input-reserva med-reserva" type="number" value="' . htmlspecialchars($CostoT->TotalCosto, ENT_QUOTES, 'UTF-8') . '" step="0.01" readonly>';
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
            <br>
            <button class="input-reserva centrado-reserva boton-reserva maximo-reserva" value="btnReservar">Reservar</button>
        </form>
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