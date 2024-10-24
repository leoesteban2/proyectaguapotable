<?php
require_once "conexion.php";

class ModeloPagos {

    static public function mdlMostrarPagos($tabla, $item, $valor) {
        try {
            if (!is_null($item)) {
                // Consulta para un registro específico
                $stmt = Conexion::conectar()->prepare("
                    SELECT 
                        ps.idpago,                           -- ID PAGO
                        u.no_orden,                         -- No_Orden
                        u.nombres,                          -- Nombre
                        u.apellidos,                        -- Apellido
                        c.no_contador,                      -- No_Contador
                        CASE 
                            WHEN ps.idcobro IS NOT NULL THEN cs.detalle
                            WHEN ps.idcobro_base IS NOT NULL THEN cb.detalle
                            ELSE 'N/A'
                        END AS detalle,                    -- Detalle de cobro
                        ps.idcobro,                         -- No.Cobro por exceso
                        ps.idcobro_base,                    -- No.Cobro base
                        ps.monto_pagado,                    -- Monto Pagado
                        ps.fecha_pago,                      -- Fecha Pagado
                        ps.tipo_pago                        -- Tipo de Pago
                    FROM 
                        $tabla ps
                    LEFT JOIN 
                        cobro_servicio cs ON ps.idcobro = cs.idcobro
                    LEFT JOIN 
                        cobro_base cb ON ps.idcobro_base = cb.idcobro_base
                    INNER JOIN 
                        usuario_contador uc ON ps.idusuario_contador = uc.idusuario_contador
                    INNER JOIN 
                        usuario u ON uc.idusuario = u.idusuario
                    INNER JOIN 
                        contador c ON uc.idcontador = c.idcontador
                    WHERE ps.$item = :$item
                ");
    
                // Vinculamos el parámetro con el valor
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
    
                $stmt->execute();
    
                return $stmt->fetch(PDO::FETCH_ASSOC);
    
            } else {
                // Consulta para obtener todos los registros de pago_servicio
                $stmt = Conexion::conectar()->prepare("
                    SELECT 
                        ps.idpago,                           -- ID PAGO
                        u.no_orden,                         -- No_Orden
                        u.nombres, 
                        u.apellidos,                         -- Nombre
                        c.no_contador,                      -- No_Contador
                        CASE 
                            WHEN ps.idcobro IS NOT NULL THEN cs.detalle
                            WHEN ps.idcobro_base IS NOT NULL THEN cb.detalle
                            ELSE 'N/A'
                        END AS detalle,                    -- Detalle de cobro
                        ps.idcobro ,                        -- No.Cobro por exceso
                        ps.idcobro_base,                    -- No.Cobro base
                        ps.monto_pagado,                    -- Monto Pagado
                        ps.fecha_pago,                      -- Fecha Pagado
                        ps.tipo_pago                        -- Tipo de Pago
                    FROM 
                        $tabla ps
                    LEFT JOIN 
                        cobro_servicio cs ON ps.idcobro = cs.idcobro
                    LEFT JOIN 
                        cobro_base cb ON ps.idcobro_base = cb.idcobro_base
                    INNER JOIN 
                        usuario_contador uc ON ps.idusuario_contador = uc.idusuario_contador
                    INNER JOIN 
                        usuario u ON uc.idusuario = u.idusuario
                    INNER JOIN 
                        contador c ON uc.idcontador = c.idcontador
                ");
    
                $stmt->execute();
    
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
    
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
            return null;
        } finally {
            // Liberar recursos
            $stmt = null;
        }
    }

    static public function mdlIngresarPagos($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (idusuario_contador, idcobro, idcobro_base, fecha_pago, detalle, monto_pagado, tipo_pago) 
        VALUES (:idusuario_contador, :idcobro, :idcobro_base, :fecha_pago, :detalle, :monto_pagado, :tipo_pago)");
    
        $stmt->bindParam(":idusuario_contador", $datos["idusuario_contador"], PDO::PARAM_INT);
        $stmt->bindParam(":idcobro", $datos["idcobro"], PDO::PARAM_INT);
        $stmt->bindParam(":idcobro_base", $datos["idcobro_base"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_pago", $datos["fecha_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
        $stmt->bindParam(":monto_pagado", $datos["monto_pagado"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_pago", $datos["tipo_pago"], PDO::PARAM_STR);
    
        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    
        $stmt->close();
        $stmt = null;
    }
    
    static public function mdlEditarPagos($tabla, $datos){

        // Preparar la consulta SQL para actualizar solo tipo de pago y fecha de pago
        $stmt = Conexion::conectar()->prepare("
            UPDATE $tabla SET tipo_pago = :tipo_pago, fecha_pago = :fecha_pago 
            WHERE idpago = :idpago
        ");
    
        // Vincular los parámetros
        $stmt->bindParam(":tipo_pago", $datos["tipo_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_pago", $datos["fecha_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":idpago", $datos["idpago"], PDO::PARAM_INT);
    
        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    
        $stmt->close();
        $stmt = null;
    }
    
    /*=============================================
	BORRAR PAGOS
	=============================================*/

	static public function mdlBorrarPago($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idpago = :idpago");

		$stmt -> bindParam(":idpago", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

/*=============================================
MOSTRAR PAGOS CON FILTROS
=============================================*/
static public function mdlMostrarPagosF($tabla, $item, $valor, $fecha_inicio = null, $fecha_fin = null, $tipo_pago = 'todos') {
    $sql = "SELECT 
                ps.idpago, 
                CONCAT(u.nombres, ' ', u.apellidos) AS nombre_usuario, 
                c.no_contador, 
                ps.detalle,
                ps.idcobro,                       
                ps.idcobro_base,                    
                ps.monto_pagado, 
                ps.tipo_pago, 
                ps.fecha_pago 
            FROM $tabla ps
            JOIN usuario_contador uc ON ps.idusuario_contador = uc.idusuario_contador
            JOIN usuario u ON uc.idusuario = u.idusuario
            JOIN contador c ON uc.idcontador = c.idcontador
            WHERE 1=1";

    // Filtros adicionales
    if ($item != null) {
        $sql .= " AND $item = :$item";
    }

    if ($fecha_inicio && $fecha_fin) {
        $sql .= " AND ps.fecha_pago BETWEEN :fecha_inicio AND :fecha_fin";
    }

    if ($tipo_pago != 'todos') {
        $sql .= " AND ps.tipo_pago = :tipo_pago";
    }

    // Ordenar por fecha de pago ascendente
    $sql .= " ORDER BY ps.fecha_pago ASC";

    $stmt = Conexion::conectar()->prepare($sql);

    if ($item != null) {
        $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
    }

    if ($fecha_inicio && $fecha_fin) {
        $stmt->bindParam(":fecha_inicio", $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $fecha_fin, PDO::PARAM_STR);
    }

    if ($tipo_pago != 'todos') {
        $stmt->bindParam(":tipo_pago", $tipo_pago, PDO::PARAM_STR);
    }

    $stmt->execute();

    return $stmt->fetchAll();
}








}
?>
