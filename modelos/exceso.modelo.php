<?php
require_once "conexion.php";

class ModeloExceso {

    /*=============================================
        MOSTRAR EXCESO
    =============================================*/
        static public function mdlMostrarExceso($tabla, $item, $valor) {
    
            if ($item != null) {
                // Aquí $item se refiere a la columna, no al nombre de la tabla
                $stmt = Conexion::conectar()->prepare("
                    SELECT 
                        cs.idcobro,
                        l.idlectura,
                        u.nombres,
                        u.apellidos,
                        c.no_contador,
                        cs.detalle,
                        cs.exceso_menor,
                        cs.exceso_mayor,
                        cs.total_exceso,
                        cs.total_a_pagar,
                        cs.tipo_cobro,
                        cs.fecha_cobro,
                        cs.estado_cobro
                    FROM 
                        $tabla cs
                    INNER JOIN 
                        lectura l ON cs.idlectura = l.idlectura
                    INNER JOIN 
                        usuario_contador uc ON l.idusuario_contador = uc.idusuario_contador
                    INNER JOIN 
                        usuario u ON uc.idusuario = u.idusuario
                    INNER JOIN 
                        contador c ON uc.idcontador = c.idcontador
                    WHERE cs.$item = :$item
                ");
    
                // Vinculamos el parámetro con el valor
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);  // Aquí usamos PDO::PARAM_INT porque es un ID
    
                $stmt->execute();
    
                return $stmt->fetch(PDO::FETCH_ASSOC);
    
            } else {
                // Si no se pasa un item, se obtienen todos los registros
                $stmt = Conexion::conectar()->prepare("
                    SELECT 
                        cs.idcobro,
                        l.idlectura,
                        u.nombres,
                        u.apellidos,
                        c.no_contador,
                        cs.detalle,
                        cs.exceso_menor,
                        cs.exceso_mayor,
                        cs.total_exceso,
                        cs.total_a_pagar,
                        cs.tipo_cobro,
                        cs.fecha_cobro,
                        cs.estado_cobro
                    FROM 
                        $tabla cs
                    INNER JOIN 
                        lectura l ON cs.idlectura = l.idlectura
                    INNER JOIN 
                        usuario_contador uc ON l.idusuario_contador = uc.idusuario_contador
                    INNER JOIN 
                        usuario u ON uc.idusuario = u.idusuario
                    INNER JOIN 
                        contador c ON uc.idcontador = c.idcontador
                ");
    
                $stmt->execute();
    
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
    
            $stmt = null;
        }
    
    

    /*=============================================
        BORRAR EXCESO
    =============================================*/
    static public function mdlBorrarExcesoP($tabla, $datos){

        try {
            // Conexión a la base de datos
            $db = Conexion::conectar();

            // Verificar el estado del cobro antes de eliminar
            $stmt = $db->prepare("SELECT estado_cobro, total_a_pagar, idusuario_contador FROM $tabla WHERE idcobro = :idcobro");
            $stmt->bindParam(":idcobro", $datos, PDO::PARAM_INT);
            $stmt->execute();
            $cobro = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si no se encuentra el registro o su estado es 'pendiente', evitar la eliminación
            if ($cobro && $cobro['estado_cobro'] === 'pendiente') {
                return "error_estado_pendiente"; // Cobro pendiente, no se puede eliminar
            }

            // Eliminar el registro de cobro
            $stmtDelete = $db->prepare("DELETE FROM $tabla WHERE idcobro = :idcobro");
            $stmtDelete->bindParam(":idcobro", $datos, PDO::PARAM_INT);

            if ($stmtDelete->execute()) {
                return "ok";
            } else {
                return "error_eliminacion";
            }

        } catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // Devolver el mensaje de error si ocurre alguna excepción
        }

        $stmt = null;
    }


    static public function mdlMostrarExcesoP($item, $valor) {
        try {
            $stmt = Conexion::conectar()->prepare("
                SELECT 
                    cs.idcobro,
                    l.idlectura,
                    u.nombres,
                    u.apellidos,
                    c.no_contador,
                    cs.detalle,
                    cs.exceso_menor,
                    cs.exceso_mayor,
                    cs.total_exceso,
                    cs.total_a_pagar,
                    cs.tipo_cobro,
                    cs.fecha_cobro,
                    cs.estado_cobro
                FROM 
                    cobro_servicio cs
                INNER JOIN 
                    lectura l ON cs.idlectura = l.idlectura
                INNER JOIN 
                    usuario_contador uc ON cs.idusuario_contador = uc.idusuario_contador
                INNER JOIN 
                    usuario u ON uc.idusuario = u.idusuario
                INNER JOIN 
                    contador c ON uc.idcontador = c.idcontador
                WHERE cs.$item = :$item
            ");
    
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return [];
        }
    }
    
    
    
/*=============================================
MOSTRAR EXCESO CON FILTROS
=============================================*/
static public function mdlMostrarExcesoF($tabla, $item, $valor, $fecha_inicio = null, $fecha_fin = null, $estado = 'todos') {
    $sql = "SELECT 
                cs.idlectura,
                cs.idcobro,
                CONCAT(u.nombres, ' ', u.apellidos) AS nombre_usuario,
                c.no_contador,
                cs.detalle,
                cs.exceso_menor,
                cs.exceso_mayor,
                cs.total_exceso,
                cs.total_a_pagar,
                cs.tipo_cobro,
                cs.fecha_cobro,
                cs.estado_cobro
            FROM cobro_servicio cs
            JOIN usuario_contador uc ON cs.idusuario_contador = uc.idusuario_contador
            JOIN usuario u ON uc.idusuario = u.idusuario
            JOIN contador c ON uc.idcontador = c.idcontador
            WHERE 1=1";

    // Filtros adicionales
    if ($item != null) {
        $sql .= " AND $item = :$item";
    }

    if ($fecha_inicio && $fecha_fin) {
        $sql .= " AND cs.fecha_cobro BETWEEN :fecha_inicio AND :fecha_fin";
    }

    if ($estado != 'todos') {
        $sql .= " AND cs.estado_cobro = :estado";
    }

    // Ordenar por fecha de cobro ascendente
    $sql .= " ORDER BY cs.fecha_cobro ASC";

    $stmt = Conexion::conectar()->prepare($sql);

    if ($item != null) {
        $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
    }

    if ($fecha_inicio && $fecha_fin) {
        $stmt->bindParam(":fecha_inicio", $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $fecha_fin, PDO::PARAM_STR);
    }

    if ($estado != 'todos') {
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
    }

    $stmt->execute();

    return $stmt->fetchAll();
}

}







?>
