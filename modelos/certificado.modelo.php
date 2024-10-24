<?php
require_once "conexion.php";

Class ModeloCertificado{

    /*=============================================
	MOSTRAR TITULO DE PROPIEDAD
	=============================================*/

    static public function mdlMostrarCertificado($tabla, $item, $valor) {

        if ($item != null) {
            // Consulta para buscar un certificado específico basándose en un criterio
            $stmt = Conexion::conectar()->prepare("
                SELECT 
                    uc.idtitulo,
                    u.nombres, 
                    u.apellidos, 
                    u.dpi, 
                    c.no_contador, 
                    uc.no_titulo,
                    uc.fecha,
                    uc.estado
                FROM 
                    titulo_propiedad uc
                LEFT JOIN 
                    usuario_contador uc2 ON uc.idusuario_contador = uc2.idusuario_contador
                LEFT JOIN 
                    usuario u ON uc2.idusuario = u.idusuario
                LEFT JOIN 
                    contador c ON uc2.idcontador = c.idcontador
                WHERE $item = :$item
            ");
            // Vincular el parámetro con el valor recibido
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            // Consulta para obtener todos los certificados
            $stmt = Conexion::conectar()->prepare("
                SELECT 
                    uc.idtitulo,
                    u.nombres, 
                    u.apellidos, 
                    u.dpi, 
                    c.no_contador, 
                    uc.no_titulo,
                    uc.fecha,
                    uc.estado
                FROM 
                    titulo_propiedad uc
                LEFT JOIN 
                    usuario_contador uc2 ON uc.idusuario_contador = uc2.idusuario_contador
                LEFT JOIN 
                    usuario u ON uc2.idusuario = u.idusuario
                LEFT JOIN 
                    contador c ON uc2.idcontador = c.idcontador
            ");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    
        // Cerrar la conexión y liberar los recursos
        $stmt->close();
        $stmt = null;
    }
    

    /*=============================================
    EDITAR CERTIFICADO
    =============================================*/
    static public function mdlEditarCertificado($tabla, $datos) {
        try {
            // Iniciar la conexión a la base de datos y habilitar el modo de transacción
            $conexion = Conexion::conectar();
            if (!$conexion) {
                echo "Error en la conexión a la base de datos.";
                return "error";
            }
    
            // Obtener los valores actuales del registro en la tabla `titulo_propiedad`
            $stmt = $conexion->prepare("SELECT * FROM $tabla WHERE idtitulo = :idtitulo");
            $stmt->bindParam(":idtitulo", $datos["idtitulo"], PDO::PARAM_INT);
            $stmt->execute();
    
            $filaActual = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Comparar los valores actuales con los valores a actualizar (no_titulo, fecha, estado)
            if ($filaActual['no_titulo'] == $datos['no_titulo'] &&
                $filaActual['fecha'] == $datos['fecha'] &&
                $filaActual['estado'] == $datos['estado']) {
                echo "No hay cambios que realizar. Los valores son los mismos.";
                return "sin_cambios";  // Retorna una respuesta indicando que no hay cambios
            }
    
            // Proceder con la actualización solo si hay cambios
            $conexion->beginTransaction();
    
            $stmt1 = $conexion->prepare("UPDATE $tabla 
                                         SET no_titulo = :no_titulo, fecha = :fecha, estado = :estado 
                                         WHERE idtitulo = :idtitulo");
    
            // Vincular los nuevos valores a los parámetros
            $stmt1->bindParam(":no_titulo", $datos["no_titulo"], PDO::PARAM_STR);
            $stmt1->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
            $stmt1->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
            $stmt1->bindParam(":idtitulo", $datos["idtitulo"], PDO::PARAM_INT);
    
            // Ejecutar la consulta de actualización en `titulo_propiedad`
            if (!$stmt1->execute()) {
                print_r($stmt1->errorInfo());  // Imprimir detalles del error de la primera consulta
                $conexion->rollBack();  // Revertir la transacción en caso de error
                return "error";
            }
    
            $conexion->commit();
            return "ok";
        } catch (PDOException $e) {
            // Revertir la transacción en caso de excepción
            $conexion->rollBack();
            echo "Error en la transacción: " . $e->getMessage();
            return "error";
        }
    
        // Cerrar las conexiones
        $stmt1 = null;
    }
    
    static public function mdlBorrarCertificado($tabla, $idtitulo) {
        try {
            // Iniciar la conexión a la base de datos
            $conexion = Conexion::conectar();
    
            // Iniciar la transacción para asegurar consistencia en caso de error
            $conexion->beginTransaction();
    
            // Eliminar el certificado en la tabla `titulo_propiedad`
            $stmt1 = $conexion->prepare("DELETE FROM titulo_propiedad WHERE idtitulo = :idtitulo");
            $stmt1->bindParam(":idtitulo", $idtitulo, PDO::PARAM_INT);
            $stmt1->execute();
    
            // Eliminar el registro correspondiente en la tabla `usuario_contador`, si corresponde
            // Si no necesitas esta parte, puedes eliminarla o adaptarla
            $stmt2 = $conexion->prepare("DELETE FROM usuario_contador WHERE idusuario_contador = (SELECT idusuario_contador FROM titulo_propiedad WHERE idtitulo = :idtitulo)");
            $stmt2->bindParam(":idtitulo", $idtitulo, PDO::PARAM_INT);
    
            if ($stmt2->execute()) {
                // Si ambas eliminaciones fueron exitosas, confirmar la transacción
                $conexion->commit();
                return "ok";
            } else {
                // Si algo falla, revertir la transacción
                $conexion->rollBack();
                return "error";
            }
    
        } catch (PDOException $e) {
            // Revertir la transacción en caso de error
            $conexion->rollBack();
            echo "Error en la ejecución: " . $e->getMessage();
            return "error";
        }
    
        // Cerrar las conexiones
        $stmt1 = null;
        $stmt2 = null;
    }
    

    /*=============================================
    CONTAR TOTAL DE CERTIFICADOS
    =============================================*/
    static public function mdlContarCertificados($tabla) {
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE estado = 'ACTIVO'");
        $stmt->execute();
        return $stmt->fetch();
    }
    



}
?>