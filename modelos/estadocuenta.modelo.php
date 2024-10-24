<?php
require_once "conexion.php";

class ModeloEstadoCuenta {
    static public function mdlMostrarEstadoCuenta($tabla, $noOrden) {
        // Consulta SQL para obtener los datos de estado de cuenta con la información solicitada
        $stmt = Conexion::conectar()->prepare("
            SELECT 
                u.no_orden,                                 -- No. Orden del usuario
                CONCAT(u.nombres, ' ', u.apellidos) AS nombre, -- Nombre del usuario
                c.no_contador,                              -- No. Contador
                ec.fecha,                                   -- Fecha de registro en el estado de cuenta
                ec.id_documento_origen AS 'No.Documento',    -- No. Documento del cobro o pago
                ec.detalle,                                 -- Detalle del movimiento
                ec.cargo,                                   -- Cargo en la cuenta
                ec.abono,                                   -- Abono en la cuenta
                ec.saldo                                    -- Saldo en la cuenta
            FROM $tabla ec 
            INNER JOIN usuario_contador uc ON ec.idusuario_contador = uc.idusuario_contador
            INNER JOIN usuario u ON uc.idusuario = u.idusuario
            INNER JOIN contador c ON uc.idcontador = c.idcontador
            WHERE u.no_orden = :noOrden
        ");

        // Vincular el parámetro No. Orden con la consulta
        $stmt->bindParam(":noOrden", $noOrden, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Devolver los resultados
        return $stmt->fetchAll();
    }
}

?>
