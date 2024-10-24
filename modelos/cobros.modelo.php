<?php
require_once "conexion.php";

class ModeloCobro {


        /*=============================================
            MOSTRAR Cobro Base
        =============================================*/
        static public function mdlMostrarCobro($tabla, $item, $valor) {
    
            if ($item != null) {
                // Consulta para un registro específico
                $stmt = Conexion::conectar()->prepare("
                    SELECT 
                        cb.idcobro_base,
                        uc.idusuario_contador, /* Relación con usuario_contador */
                        u.nombres,
                        u.apellidos,
                        c.no_contador,
                        cb.detalle,
                        cb.monto_base,
                        cb.tipo_cobro,
                        cb.fecha_cobro,
                        cb.estado_cobro,
                        cb.idtarifa,  /* Seleccionar idtarifa */
                        t.descripcion AS tarifa_descripcion,  /* Relación con tarifa */
                        t.tarifa_metro_cubico
                    FROM 
                        $tabla cb
                    INNER JOIN 
                        usuario_contador uc ON cb.idusuario_contador = uc.idusuario_contador
                    INNER JOIN 
                        usuario u ON uc.idusuario = u.idusuario
                    INNER JOIN 
                        contador c ON uc.idcontador = c.idcontador
                    LEFT JOIN 
                        tarifa t ON cb.idtarifa = t.idtarifa /* Relacionamos con la tabla tarifa */
                    WHERE cb.$item = :$item
                ");
    
                // Vinculamos el parámetro con el valor
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
    
                $stmt->execute();
    
                return $stmt->fetch(PDO::FETCH_ASSOC);
    
            } else {
                // Consulta para obtener todos los registros de cobro base
                $stmt = Conexion::conectar()->prepare("
                    SELECT 
                        cb.idcobro_base,
                        uc.idusuario_contador, /* Relación con usuario_contador */
                        u.nombres,
                        u.apellidos,
                        c.no_contador,
                        cb.detalle,
                        cb.monto_base,
                        cb.tipo_cobro,
                        cb.fecha_cobro,
                        cb.estado_cobro,
                        cb.idtarifa,  /* Seleccionar idtarifa */
                        t.descripcion AS tarifa_descripcion,  /* Relación con tarifa */
                        t.tarifa_metro_cubico
                    FROM 
                        $tabla cb
                    INNER JOIN 
                        usuario_contador uc ON cb.idusuario_contador = uc.idusuario_contador
                    INNER JOIN 
                        usuario u ON uc.idusuario = u.idusuario
                    INNER JOIN 
                        contador c ON uc.idcontador = c.idcontador
                    LEFT JOIN 
                        tarifa t ON cb.idtarifa = t.idtarifa /* Relacionamos con la tabla tarifa */
                ");
    
                $stmt->execute();
    
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
    
            $stmt = null;
        }
    




    /*=============================================
    INGRESAR COBRO BASE
    =============================================*/
    static public function mdlIngresarCobro($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
            idusuario_contador, fecha_cobro, monto_base, estado_cobro, tipo_cobro, detalle, idtarifa) 
            VALUES (:idusuario_contador, :fecha_cobro, :monto_base, :estado_cobro, :tipo_cobro, :detalle, :idtarifa)");

        // Vincular parámetros con los valores del arreglo $datos
        $stmt->bindParam(":idusuario_contador", $datos["idusuario_contador"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_cobro", $datos["fecha_cobro"], PDO::PARAM_STR);
        $stmt->bindParam(":monto_base", $datos["monto_base"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_cobro", $datos["estado_cobro"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_cobro", $datos["tipo_cobro"], PDO::PARAM_STR);
        $stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
        $stmt->bindParam(":idtarifa", $datos["idtarifa"], PDO::PARAM_INT);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        // Cerrar la consulta
        $stmt->close();
        $stmt = null;
    }

    static public function mdlEditarCobro($tabla, $datos) {

        // Conexión a la base de datos
        $pdo = Conexion::conectar();
    
        try {
            // Verificar si el idusuario_contador existe en la tabla usuario_contador
            $verificarUsuario = $pdo->prepare("SELECT COUNT(*) FROM usuario_contador WHERE idusuario_contador = :idusuario_contador");
            $verificarUsuario->bindParam(":idusuario_contador", $datos["idusuario_contador"], PDO::PARAM_INT);
            $verificarUsuario->execute();
            
            $usuarioExiste = $verificarUsuario->fetchColumn();
            
            if ($usuarioExiste == 0) {
                // Si no existe el usuario, devolver error
                return "error: usuario no encontrado";
            }
    
            // Proceder con la actualización si el idusuario_contador existe
            $stmt = $pdo->prepare("UPDATE $tabla 
                SET 
                    idusuario_contador = :idusuario_contador, 
                    fecha_cobro = :fecha_cobro, 
                    monto_base = :monto_base, 
                    tipo_cobro = :tipo_cobro, 
                    detalle = :detalle, 
                    idtarifa = :idtarifa 
                WHERE idcobro_base = :idcobro_base");
    
            // Vincular los parámetros
            $stmt->bindParam(":idcobro_base", $datos["idcobro_base"], PDO::PARAM_INT);
            $stmt->bindParam(":idusuario_contador", $datos["idusuario_contador"], PDO::PARAM_INT);
            $stmt->bindParam(":fecha_cobro", $datos["fecha_cobro"], PDO::PARAM_STR);
            $stmt->bindParam(":monto_base", $datos["monto_base"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo_cobro", $datos["tipo_cobro"], PDO::PARAM_STR);
            $stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
            $stmt->bindParam(":idtarifa", $datos["idtarifa"], PDO::PARAM_INT);
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Comprobar si se actualizaron registros
                if ($stmt->rowCount() > 0) {
                    return "ok";  // Actualización exitosa
                } else {
                    return "error: no se actualizó ningún registro";
                }
            } else {
                // Obtener información del error y devolver mensaje
                $errorInfo = $stmt->errorInfo();
                return "error: " . $errorInfo[2];
            }
    
        } catch (Exception $e) {
            // Devolver el mensaje de excepción si ocurre un error
            return "error: " . $e->getMessage();
        } finally {
            // Cerrar la consulta y la conexión a la base de datos
            $stmt = null;
            $pdo = null;
        }
    }
    
    /*=============================================
        BORRAR COBRO
    =============================================*/
    static public function mdlBorrarCobroBase($tabla, $datos) {

        try {
            // Conexión a la base de datos
            $db = Conexion::conectar();
    
            // Verificar el estado del cobro antes de eliminar
            $stmt = $db->prepare("SELECT estado_cobro, monto_base, idusuario_contador FROM $tabla WHERE idcobro_base = :idcobro_base");
            $stmt->bindParam(":idcobro_base", $datos, PDO::PARAM_INT);
            $stmt->execute();
            $cobro = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Si no se encuentra el registro o su estado es 'pendiente', evitar la eliminación
            if ($cobro && $cobro['estado_cobro'] === 'pendiente') {
                return "error_estado_pendiente"; // Cobro pendiente, no se puede eliminar
            }
    
            // Eliminar el registro de cobro_base si no es 'pendiente'
            $stmtDelete = $db->prepare("DELETE FROM $tabla WHERE idcobro_base = :idcobro_base");
            $stmtDelete->bindParam(":idcobro_base", $datos, PDO::PARAM_INT);
    
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
    



    static public function mdlMostrarCobroP($tabla, $item, $valor) {
        try {
            if ($item != null) {
                $stmt = Conexion::conectar()->prepare("
                    SELECT 
                        cb.idcobro_base,
                        uc.idusuario_contador, 
                        u.nombres,
                        u.apellidos,
                        c.no_contador,
                        cb.detalle,
                        cb.monto_base,
                        cb.tipo_cobro,
                        cb.fecha_cobro,
                        cb.estado_cobro,
                        cb.idtarifa,  
                        t.descripcion AS tarifa_descripcion,  
                        t.tarifa_metro_cubico
                    FROM 
                        $tabla cb
                    INNER JOIN 
                        usuario_contador uc ON cb.idusuario_contador = uc.idusuario_contador
                    INNER JOIN 
                        usuario u ON uc.idusuario = u.idusuario
                    INNER JOIN 
                        contador c ON uc.idcontador = c.idcontador
                    LEFT JOIN 
                        tarifa t ON cb.idtarifa = t.idtarifa 
                    WHERE cb.$item = :$item
                ");
    
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
                $stmt->execute();
    
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (empty($result)) {
                    echo "Consulta ejecutada pero no hay resultados.";
                }
    
                return $result;
            } else {
                return [];
            }
        } catch (Exception $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return [];
        }
    }
    
/*=============================================
MOSTRAR COBROS BASE CON FILTROS
=============================================*/
public static function mdlMostrarCobrosBaseF($tabla, $item, $valor, $fecha_inicio = null, $fecha_fin = null, $estado = 'todos', $tipo_cobro = 'todos') {
    $sql = "SELECT 
                cb.idcobro_base, 
                CONCAT(u.nombres, ' ', u.apellidos) AS nombre_usuario, 
                c.no_contador, 
                cb.detalle, 
                cb.monto_base, 
                cb.tipo_cobro, 
                cb.fecha_cobro, 
                cb.estado_cobro 
            FROM $tabla cb
            JOIN usuario_contador uc ON cb.idusuario_contador = uc.idusuario_contador
            JOIN usuario u ON uc.idusuario = u.idusuario
            JOIN contador c ON uc.idcontador = c.idcontador
            WHERE 1=1"; // Condición inicial para evitar errores

    // Filtros adicionales
    if ($item != null) {
        $sql .= " AND $item = :$item";
    }

    if ($fecha_inicio && $fecha_fin) {
        $sql .= " AND cb.fecha_cobro BETWEEN :fecha_inicio AND :fecha_fin";
    }

    if ($estado != 'todos') {
        $sql .= " AND cb.estado_cobro = :estado";
    }

    // Filtro para el tipo de cobro
    if ($tipo_cobro != 'todos') {
        $sql .= " AND cb.tipo_cobro = :tipo_cobro";
    }

    // Ordenar por fecha de cobro ascendente
    $sql .= " ORDER BY cb.fecha_cobro ASC";

    $stmt = Conexion::conectar()->prepare($sql);

    // Asignar valores a los parámetros
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

    // Asignar valor al parámetro tipo_cobro
    if ($tipo_cobro != 'todos') {
        $stmt->bindParam(":tipo_cobro", $tipo_cobro, PDO::PARAM_STR);
    }

    $stmt->execute();

    return $stmt->fetchAll();
}












    
    

}

?>