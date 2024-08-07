<?php
include_once 'Modelo/clsconexion.php';
// ver la forma de poder meter mas clases
class clsregistros extends clsconexion{

// Altas
    public function AltaEmpleado($nombre, $apellidos, $noTelefono, $email, $password) {
        $sql = "CALL spInsertarUsuarios('$nombre', '$apellidos', '$noTelefono', '$email', '$password', 'Empleado');";
        $resultado = $this->conectar->query($sql);
        return $resultado ? true : false;
    }
    public function AltaZona($Zona, $ZonaImg) {
        $sql = "CALL spInsertarZona('$Zona', '$ZonaImg');";
        $resultado = $this->conectar->query($sql);
        return $resultado ? true : false;
    }
    public function AltaMesa($claveMesa, $capacidad, $zona,$costo, $imagen) {
        $sql = "CALL spInsertarMesa('$claveMesa', $capacidad, $zona, $costo, '$imagen');";
        $resultadoMesas = $this->conectar->query($sql);
        return $resultadoMesas ? true : false;
    }
    public function AltaPostre($nombre, $descripcion, $costo, $imagen) {
        $sql = "CALL spInsertarPostre('$nombre', '$descripcion', '$costo', '$imagen');";
        $resultadoPostres = $this->conectar->query($sql);
        return $resultadoPostres ? true : false;
    }
    public function AltaComida($nombre, $descripcion, $costo, $imagen) {
        $sql = "CALL spInsertarComida('$nombre', '$descripcion', '$costo', '$imagen');";
        $resultadoComidas = $this->conectar->query($sql);
        return $resultadoComidas ? true : false;
    }
    public function AltaBebida($nombre, $descripcion, $costo, $imagen) {
        $sql = "CALL spInsertarBebida('$nombre', '$descripcion', '$costo', '$imagen');";
        $resultadoBebidas = $this->conectar->query($sql);
        return $resultadoBebidas ? true : false;
    }
// Consultas
    public function ConsultaEmpleados() {
        $sql = "CALL spConsultarEmpleados();";
        $resultadoEmpleados = $this->conectar->query($sql);
        return $resultadoEmpleados ? $resultadoEmpleados : null;
    }
    public function ConsultaZona() {
        $sql = "CALL spConsultarZona();";
        $resultadoZonas = $this->conectar->query($sql);
        return $resultadoZonas ? $resultadoZonas : null;
    }
    public function ConsultaMesas() {
        $sql = "CALL spConsultarMesas();";
        $resultadoMesas = $this->conectar->query($sql);
        return $resultadoMesas ? $resultadoMesas : null;
    }
    public function ConsultaPostres() {
        $sql = "CALL spConsultarPostres();";
        $resultadoPostres = $this->conectar->query($sql);
        return $resultadoPostres ? $resultadoPostres : null;
    }
    public function ConsultaComidas() {
        $sql = "CALL spConsultarComidas();";
        $resultadoComidas = $this->conectar->query($sql);
        return $resultadoComidas ? $resultadoComidas : null;
    }
    public function ConsultaBebidas() {
        $sql = "CALL spConsultarBebidas();";
        $resultadoBebidas = $this->conectar->query($sql);
        return $resultadoBebidas ? $resultadoBebidas : null;
    }
    // Consulta para clientes
    public function ConsultaClientes($IdCliente) {
        $sql = "CALL spConsultarClientes($IdCliente);";
        $resultadoClientes = $this->conectar->query($sql);
        return $datos = $resultadoClientes ? $resultadoClientes : null;
    }
    public function ConsultaOcaciones() {
        $sql = "CALL spConsultarOcaciones();";
        $resultadoClientes = $this->conectar->query($sql);
        return $datos = $resultadoClientes ? $resultadoClientes : null;
    }
    // AltaReservas vista cliente
    public function Solisitar($IdCliente, $telefono, $fechaReservacion, $horaInicio, $horaFinal, $ocasion, $invitados, $zonaPreferencia){
        $sql = "CALL spCrearReserva('$IdCliente', '$telefono', '$fechaReservacion', '$horaInicio', '$horaFinal', '$ocasion', $invitados, $zonaPreferencia);";
        $resultadoClientes = $this->conectar->query($sql);
        return $datos = $resultadoClientes ? $resultadoClientes : null;
    }
    public function ConsultaCosto($idres) {
        // Ejecutar ambas consultas
        $sql = "CALL SumaCostoUltimaReserva($idres, @TotalCosto);";
        if ($this->conectar->query($sql)) {
            $sql = "SELECT @TotalCosto AS TotalCosto;";
            $resultado = $this->conectar->query($sql);
            return $resultado ? $resultado : null;
        } else {
            return null;
        }
    }
    public function ConsultaTablas(){
        $sql = "CALL spConsultarTblEliminadas();";
        $resultadoTablas = $this->conectar->query($sql);
        return $datos = $resultadoTablas ? $resultadoTablas : null;
    }
    public function PagoReserva($IdCliente, $anticipo, $total){
        $sql = "CALL spInsertarPago($IdCliente, $anticipo, $total);";
        $resultadoClientes = $this->conectar->query($sql);
        return $datos = $resultadoClientes ? $resultadoClientes : null;
    }

// Actualizar
    public function ActualizarEmpleado($id, $nombre, $apellidos, $telefono, $email){
        $sql = "CALL spActualizarEmpleado($id, '$nombre', '$apellidos', '$telefono', '$email');";
        $this->conectar->query($sql);
    }
    public function ActualizarZona($id, $ubicacion) {
        $sql = "CALL spActualizarZona($id, '$ubicacion');";
        $this->conectar->query($sql);
    }
    public function ActualizarMesa($id, $claveMesa, $capasidad, $costo) {
        $sql = "CALL spActualizarMesa($id, '$claveMesa', $capasidad, $costo);";
        $this->conectar->query($sql);
    }   
    public function ActualizarPostre($id, $nombre, $descripcion, $precio) {
        $sql = "CALL spActualizarPostre($id, '$nombre', '$descripcion', $precio);";
        $this->conectar->query($sql);
    }
    public function ActualizarComida($id, $nombre, $descripcion, $precio) {
        $sql = "CALL spActualizarComida($id, '$nombre', '$descripcion', $precio);";
        $this->conectar->query($sql);
    }
    public function ActualizarBebida($id, $nombre, $descripcion, $precio) {
        $sql = "CALL spActualizarBebida($id, '$nombre', '$descripcion', $precio);";
        $this->conectar->query($sql);
    }
// Eliminar
    public function EliminarEmpleado($id) {
        $sql = "CALL spEliminarEmpleado($id);";
        $this->conectar->query($sql);
    }
    public function EliminarZona($id) {
        $sql = "CALL spEliminarZona($id);";
        $this->conectar->query($sql);
    }
    public function EliminarMesa($id) {
        $sql = "CALL spEliminarMesa($id);";
        $this->conectar->query($sql);
    }
    public function EliminarPostre($id) {
        $sql = "CALL spEliminarPostre($id);";
        $this->conectar->query($sql);
    }
    public function EliminarComida($id) {
        $sql = "CALL spEliminarComida($id);";
        $this->conectar->query($sql);
    }    
    public function EliminarBebida($id) {
        $sql = "CALL spEliminarBebida($id);";
        $this->conectar->query($sql);
    }   
}
?>