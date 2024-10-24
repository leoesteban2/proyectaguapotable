<?php
require_once "conexion.php";

class ModeloReporteContador {
    /*=============================================
    MOSTRAR
    =============================================*/
    static public function mdlMostrarReporteContador($tabla, $item, $valor) {
        $conexion = Conexion::conectar();

        $query = "
            SELECT 
                uc.idusuario_contador_historial, 
                u.nombres, 
                u.apellidos, 
                c.no_contador, 
                uc.fecha_asignacion,
                uc.fecha_cambio,
                uc.fecha_desasignacion,
                uc.estado
            FROM 
                usuario_contador_historial uc
            INNER JOIN 
                usuario u ON uc.idusuario = u.idusuario
            INNER JOIN 
                contador c ON uc.idcontador = c.idcontador
        ";

        if ($item !== null) {
            $query .= " WHERE $item = :$item";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(":$item", $valor, PDO::PARAM_STR);
        } else {
            $stmt = $conexion->prepare($query);
        }

        $stmt->execute();

        if ($item !== null) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $stmt->closeCursor();
        $conexion = null;

        return $result;
    }
}