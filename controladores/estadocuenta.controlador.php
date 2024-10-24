<?php

class ControladorEstadoCuenta {
    static public function ctrMostrarEstadoCuenta($noOrden) {
        $tabla = "estado_cuenta";
        $respuesta = ModeloEstadoCuenta::mdlMostrarEstadoCuenta($tabla, $noOrden);
        return $respuesta;
    }
}
?>
