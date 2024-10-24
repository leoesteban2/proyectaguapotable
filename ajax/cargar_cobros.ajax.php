<?php
require_once "../controladores/cobros.controlador.php";
require_once "../modelos/cobros.modelo.php";
require_once "../controladores/exceso.controlador.php";
require_once "../modelos/exceso.modelo.php";

if (isset($_POST["idUsuarioContador"])) {
    $item = "idusuario_contador";
    $valor = $_POST["idUsuarioContador"];

    // Obtener cobros base pendientes
    $cobrosPendientes = ControladorCobro::ctrMostrarCobroP($item, $valor);
    // Obtener excesos pendientes
    $excesosPendientes = ControladorExceso::ctrMostrarExcesoP($item, $valor);

    // Verificar si hay cobros base pendientes
    if (is_array($cobrosPendientes) && count($cobrosPendientes) > 0) {
        foreach ($cobrosPendientes as $cobro) {
            if (isset($cobro["estado_cobro"]) && $cobro["estado_cobro"] === "pendiente") {
                $detalle = htmlspecialchars($cobro["detalle"]) . ' - Q' . number_format($cobro["monto_base"], 2);
                $idcobro = $cobro["idcobro_base"];
                $monto = $cobro["monto_base"];
                // Validar que el campo tipo_cobro esté presente
                $tipo = isset($cobro["tipo_cobro"]) ? $cobro["tipo_cobro"] : 'desconocido';

                echo '<div class="checkbox">';
                echo '<label>';
                // Añadir un atributo "data-tipo-cobro" para enviar el tipo de cobro
                echo '<input type="checkbox" name="cobros[]" value="' . $idcobro . '" data-monto="' . $monto . '" data-type="base" data-tipo-cobro="' . $tipo . '" data-detalle="' . htmlspecialchars($cobro["detalle"]) . '" onchange="actualizarMonto()"> ' . $detalle;
                echo '</label>';
                echo '</div>';
            }
        }
    }

    // Verificar si hay excesos pendientes
    if (is_array($excesosPendientes) && count($excesosPendientes) > 0) {
        foreach ($excesosPendientes as $exceso) {
            if (isset($exceso["estado_cobro"]) && $exceso["estado_cobro"] === "pendiente") {
                $detalle = htmlspecialchars($exceso["detalle"]) . ' - Q' . number_format($exceso["total_a_pagar"], 2);
                $idcobro = $exceso["idcobro"];
                $monto = $exceso["total_a_pagar"];
                // Validar que el campo tipo_cobro esté presente
                $tipo = isset($exceso["tipo_cobro"]) ? $exceso["tipo_cobro"] : 'desconocido';

                echo '<div class="checkbox">';
                echo '<label>';
                // Añadir un atributo "data-tipo-cobro" para enviar el tipo de cobro
                echo '<input type="checkbox" name="cobros[]" value="' . $idcobro . '" data-monto="' . $monto . '" data-type="servicio" data-tipo-cobro="' . $tipo . '" data-detalle="' . htmlspecialchars($exceso["detalle"]) . '" onchange="actualizarMonto()"> ' . $detalle;
                echo '</label>';
                echo '</div>';
            }
        }
    }

    // Si no hay cobros ni excesos pendientes, mostrar un mensaje
    if (empty($cobrosPendientes) && empty($excesosPendientes)) {
        echo '<p>No hay cobros pendientes</p>';
    }
}
?>
