<?php
require_once "conexion.php";

Class ModeloAsignacion{
 /*=============================================
	Asignar Contadores
	=============================================*/

	static public function mdlIngresarAsignacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idusuario, idcontador, fecha_asignacion) VALUES
         (:idusuario, :idcontador, :fecha_asignacion)");

		$stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_STR);
		$stmt->bindParam(":idcontador", $datos["idcontador"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_asignacion", $datos["fecha_asignacion"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	
    /*=============================================
	MOSTRAR Contadores y usarios
	=============================================*/

    static public function mdlMostrarAsignacion($tabla, $item, $valor){

        if($item != null){
    
            $stmt = Conexion::conectar()->prepare("
    SELECT 
        uc.idusuario_contador,
        u.idusuario, 
        u.nombres, 
        u.apellidos,
        u.no_orden, 
        u.telefono, 
        c.no_contador, 
        c.lectura_actual, 
        uc.fecha_asignacion
    FROM 
        usuario_contador uc
    INNER JOIN 
        usuario u ON uc.idusuario = u.idusuario
    INNER JOIN 
        contador c ON uc.idcontador = c.idcontador
    WHERE $item = :$item");
    
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
    
            $stmt -> execute();
    
            return $stmt -> fetch();
    
        }else{
    
            $stmt = Conexion::conectar()->prepare("
    SELECT 
        uc.idusuario_contador,
        u.idusuario, 
        u.nombres, 
        u.apellidos,
        u.no_orden, 
        u.telefono, 
        c.no_contador,
        c.lectura_actual, 
        uc.fecha_asignacion
    FROM 
        usuario_contador uc
    INNER JOIN 
        usuario u ON uc.idusuario = u.idusuario
    INNER JOIN 
        contador c ON uc.idcontador = c.idcontador
    ");
    
            $stmt -> execute();
    
            return $stmt -> fetchAll();
    
        }
        
    
        $stmt -> close();
    
        $stmt = null;
    
    }

    /*=============================================
	EDITAR ASIGNACION
	=============================================*/

    static public function mdlEditarAsignacion($tabla, $datos) {
        try {
            // Iniciar la conexión a la base de datos y habilitar el modo de transacción
            $conexion = Conexion::conectar();
            if (!$conexion) {
                echo "Error en la conexión a la base de datos.";
                return "error";
            }
    
            // Obtener los valores actuales del registro
            $stmt = $conexion->prepare("SELECT * FROM $tabla WHERE idusuario_contador = :idusuario_contador");
            $stmt->bindParam(":idusuario_contador", $datos["idusuario_contador"], PDO::PARAM_INT);
            $stmt->execute();
    
            $filaActual = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Comparar los valores actuales con los valores a actualizar
            if ($filaActual['idusuario'] == $datos['idusuario'] &&
                $filaActual['idcontador'] == $datos['idcontador'] &&
                $filaActual['fecha_asignacion'] == $datos['fecha_asignacion']) {
                echo "No hay cambios que realizar. Los valores son los mismos.";
                return "sin_cambios";  // Retorna una respuesta indicando que no hay cambios
            }
    
            // Proceder con la actualización solo si hay cambios
            $conexion->beginTransaction();
    
            $stmt1 = $conexion->prepare("UPDATE $tabla 
                                         SET idusuario = :idusuario, idcontador = :idcontador, fecha_asignacion = :fecha_asignacion 
                                         WHERE idusuario_contador = :idusuario_contador");
    
            $stmt1->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_INT);
            $stmt1->bindParam(":idcontador", $datos["idcontador"], PDO::PARAM_INT);
            $stmt1->bindParam(":fecha_asignacion", $datos["fecha_asignacion"], PDO::PARAM_STR);
            $stmt1->bindParam(":idusuario_contador", $datos["idusuario_contador"], PDO::PARAM_INT);
    
            // Ejecutar la consulta de actualización en `usuario_contador`
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
    
    
    

    /*=============================================
	BORRAR CONTADOR
	=============================================*/

	static public function mdlBorrarAsignacion($tabla, $datos) {
        try {
            $conexion = Conexion::conectar();
    
            // Eliminar las referencias en la tabla `titulo_propiedad`
            $stmt1 = $conexion->prepare("DELETE FROM titulo_propiedad WHERE idusuario_contador = :idusuario_contador");
            $stmt1->bindParam(":idusuario_contador", $datos, PDO::PARAM_INT);
            $stmt1->execute();
    
            // Ahora eliminar el registro en la tabla `usuario_contador`
            $stmt2 = $conexion->prepare("DELETE FROM $tabla WHERE idusuario_contador = :idusuario_contador");
            $stmt2->bindParam(":idusuario_contador", $datos, PDO::PARAM_INT);
            
            if ($stmt2->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            echo "Error en la ejecución: " . $e->getMessage();
            return "error";
        }
    
        $stmt1 = null;
        $stmt2 = null;
    }
    



}
?>