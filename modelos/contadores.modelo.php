<?php
require_once "conexion.php";

class ModeloContador{
    /*=============================================
	CREAR CONTADORES
	=============================================*/

	static public function mdlIngresarContador($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(no_contador,descripcion, fecha_instalacion, 
        ultimo_mantenimiento, lectura_actual) VALUES
         (:no_contador, :descripcion, :fecha_instalacion, :ultimo_mantenimiento, :lectura_actual)");

		$stmt->bindParam(":no_contador", $datos["no_contador"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_instalacion", $datos["fecha_instalacion"], PDO::PARAM_STR);
		$stmt->bindParam(":ultimo_mantenimiento", $datos["ultimo_mantenimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":lectura_actual", $datos["lectura_actual"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

    /*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarContador($tabla, $item, $valor){

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
	EDITAR CONTADOR
	=============================================*/

	static public function mdlEditarContador($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET no_contador = :no_contador, descripcion = :descripcion, fecha_instalacion = :fecha_instalacion, 
        ultimo_mantenimiento = :ultimo_mantenimiento, lectura_actual = :lectura_actual, estado = :estado
		  WHERE idcontador = :idcontador ");

		$stmt->bindParam(":no_contador", $datos["no_contador"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_instalacion", $datos["fecha_instalacion"], PDO::PARAM_STR);
		$stmt->bindParam(":ultimo_mantenimiento", $datos["ultimo_mantenimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":lectura_actual", $datos["lectura_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":idcontador", $datos["idcontador"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

    /*=============================================
	BORRAR CONTADOR
	=============================================*/

	static public function mdlBorrarContador($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idcontador = :idcontador");

		$stmt -> bindParam(":idcontador", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

	/* MOSTRAR EL TOTAL DE CONTADORES */
	public static function mdlContarContadores() {
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(idcontador) AS total FROM contador");
        $stmt->execute();
        return $stmt->fetch();
    }












}

?>