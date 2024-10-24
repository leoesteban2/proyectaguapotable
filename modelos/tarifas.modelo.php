<?php
require_once "conexion.php";

class ModeloTarifa{

     /*=============================================
	CREAR TARIFAS
	=============================================*/

    static public function mdlIngresarTarifa($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
        descripcion,rango_consumo_min, rango_consumo_max, tarifa_metro_cubico, fecha_inicio, fecha_fin) VALUES
         (:descripcion,:rango_consumo_min, :rango_consumo_max, :tarifa_metro_cubico, :fecha_inicio, :fecha_fin)");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":rango_consumo_min", $datos["rango_consumo_min"], PDO::PARAM_STR);
		$stmt->bindParam(":rango_consumo_max", $datos["rango_consumo_max"], PDO::PARAM_STR);
        $stmt->bindParam(":tarifa_metro_cubico", $datos["tarifa_metro_cubico"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	MOSTRAR TARIFA
	=============================================*/

	static public function mdlMostrarTarifa($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

 /*=============================================
	EDITAR TARIFAS
	=============================================*/

	static public function mdlEditarTarifa($tabla, $datos){

		try {
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla 
				SET descripcion = :descripcion, 
					rango_consumo_min = :rango_consumo_min, 
					rango_consumo_max = :rango_consumo_max, 
					tarifa_metro_cubico = :tarifa_metro_cubico, 
					fecha_inicio = :fecha_inicio, 
					fecha_fin = :fecha_fin 
				WHERE idtarifa = :idtarifa");
	
			// Bind de parámetros
			$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
			$stmt->bindParam(":rango_consumo_min", $datos["rango_consumo_min"], PDO::PARAM_STR);
			$stmt->bindParam(":rango_consumo_max", $datos["rango_consumo_max"], PDO::PARAM_STR);
			$stmt->bindParam(":tarifa_metro_cubico", $datos["tarifa_metro_cubico"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
			$stmt->bindParam(":idtarifa", $datos["idtarifa"], PDO::PARAM_INT);
	
			// Ejecutar la consulta
			if($stmt->execute()){
				return "ok";	
			}else{
				return "error";
			}
	
		} catch (PDOException $e) {
			// Manejo de error
			error_log("Error al editar la tarifa: " . $e->getMessage());
			return "error";
		} finally {
			// Liberar el statement
			$stmt = null;
		}
	}
	
	/*=============================================
	BORRAR TARIFA
	=============================================*/

	static public function mdlBorrarTarifa($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idtarifa = :idtarifa");

		$stmt -> bindParam(":idtarifa", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}







}
?>