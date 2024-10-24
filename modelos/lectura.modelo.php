<?php
require_once "conexion.php";

class ModeloLectura {

    /*=============================================
    MOSTRAR Lectura
    =============================================*/
    static public function mdlMostrarLectura($tabla, $item, $valor) {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("
                SELECT 
                    l.idlectura,
                    l.idusuario_contador,
                    u.idusuario, 
                    u.nombres, 
                    u.apellidos, 
                    u.telefono, 
                    u.no_orden,
                    c.no_contador, 
                    uc.fecha_asignacion,
                    l.lectura_actual,
                    l.lectura_anterior,
                    l.consumo,
                    l.fecha_lectura
                FROM 
                    lectura l
                INNER JOIN 
                    usuario_contador uc ON l.idusuario_contador = uc.idusuario_contador
                INNER JOIN 
                    usuario u ON uc.idusuario = u.idusuario
                INNER JOIN 
                    contador c ON uc.idcontador = c.idcontador
                WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("
                SELECT 
                    l.idlectura,
                    l.idusuario_contador,
                    u.idusuario, 
                    u.nombres, 
                    u.apellidos, 
                    u.telefono, 
                    u.no_orden,
                    c.no_contador, 
                    uc.fecha_asignacion,
                    l.lectura_actual,
                    l.lectura_anterior,
                    l.consumo,
                    l.fecha_lectura
                FROM 
                    lectura l
                INNER JOIN 
                    usuario_contador uc ON l.idusuario_contador = uc.idusuario_contador
                INNER JOIN 
                    usuario u ON uc.idusuario = u.idusuario
                INNER JOIN 
                    contador c ON uc.idcontador = c.idcontador
            ");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /*=============================================
    ASIGNAR LECTURA
    =============================================*/
    static public function mdlIngresarLectura($tabla, $datos) {
        // Imprimir datos para verificar su contenido
        echo "<pre>";
        print_r($datos);
        echo "</pre>";
    
        // Preparar la consulta de inserción
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idusuario_contador, fecha_lectura, 
            lectura_actual, lectura_anterior) 
            VALUES (:idusuario_contador, :fecha_lectura, :lectura_actual, :lectura_anterior)");
    
        // Vincular los parámetros con los valores correspondientes
        $stmt->bindParam(":idusuario_contador", $datos["idusuario_contador"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_lectura", $datos["fecha_lectura"], PDO::PARAM_STR);
        $stmt->bindParam(":lectura_actual", $datos["lectura_actual"], PDO::PARAM_STR);
        $stmt->bindParam(":lectura_anterior", $datos["lectura_anterior"], PDO::PARAM_STR);
    
        // Ejecutar la consulta de inserción
        if ($stmt->execute()) {
            return "ok"; // Inserción exitosa
        } else {
            // Mostrar error detallado en caso de fallo
            echo "<pre>";
            print_r($stmt->errorInfo());
            echo "</pre>";
            return "error"; // Error en la inserción
        }
    
        // Cerrar la conexión del statement
        $stmt = null;
    }
    
    
    
        /*=============================================
	BORRAR LECTURA
=============================================*/

static public function mdlBorrarLectura($tabla, $datos){

	// Primero eliminamos los registros asociados en cobro_servicio
	$stmt1 = Conexion::conectar()->prepare("DELETE FROM cobro_servicio WHERE idlectura = :idlectura");
	$stmt1 -> bindParam(":idlectura", $datos, PDO::PARAM_INT);

	if($stmt1 -> execute()){

		// Luego eliminamos la lectura en la tabla lectura
		$stmt2 = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idlectura = :idlectura");
		$stmt2 -> bindParam(":idlectura", $datos, PDO::PARAM_INT);

		if($stmt2 -> execute()){
			return "ok";
		} else {
			return "error";
		}

		$stmt2 -> close();
		$stmt2 = null;

	} else {
		return "error";
	}

	$stmt1 -> close();
	$stmt1 = null;
}


/*=============================================
MOSTRAR LECTURAS CON FILTROS
=============================================*/
static public function mdlMostrarLecturasF($tabla, $item, $valor, $fecha_inicio = null, $fecha_fin = null) {
    $sql = "SELECT 
                l.idlectura, 
                u.no_orden,
                CONCAT(u.nombres, ' ', u.apellidos) AS nombre_usuario, 
                c.no_contador, 
                l.lectura_anterior, 
                l.lectura_actual, 
                l.consumo, 
                l.fecha_lectura 
            FROM $tabla l
            JOIN usuario_contador uc ON l.idusuario_contador = uc.idusuario_contador
            JOIN usuario u ON uc.idusuario = u.idusuario
            JOIN contador c ON uc.idcontador = c.idcontador
            WHERE 1=1";

    // Filtros adicionales
    if ($item != null) {
        $sql .= " AND $item = :$item";
    }

    if ($fecha_inicio && $fecha_fin) {
        $sql .= " AND l.fecha_lectura BETWEEN :fecha_inicio AND :fecha_fin";
    }

    // Agregar orden por fecha de lectura ascendente
    $sql .= " ORDER BY l.fecha_lectura ASC";

    $stmt = Conexion::conectar()->prepare($sql);

    if ($item != null) {
        $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
    }

    if ($fecha_inicio && $fecha_fin) {
        $stmt->bindParam(":fecha_inicio", $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $fecha_fin, PDO::PARAM_STR);
    }

    $stmt->execute();

    return $stmt->fetchAll();
}

/* MOSTRAR EL TOTAL DE LAS LECTURAS */
static public function mdlContarLecturas(){
    $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM lectura");
    $stmt->execute();
    return $stmt->fetch();
}

/* MOSTRAR CONSUMO POR MES */
public static function mdlObtenerLecturasPorMes() {
    $stmt = Conexion::conectar()->prepare(
        "SELECT DATE_FORMAT(fecha_lectura, '%Y-%m') as mes, SUM(consumo) as total_consumo 
         FROM lectura 
         GROUP BY mes 
         ORDER BY mes ASC"
    );
    $stmt->execute();
    return $stmt->fetchAll();
}





    
    
    
}
?>