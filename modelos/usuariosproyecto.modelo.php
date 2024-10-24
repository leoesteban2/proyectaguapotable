<?php
require_once "conexion.php";

class ModeloUsuariosProyecto{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuariosProyecto($tabla, $item, $valor){

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
	REGISTRO DE USUARIOS DEL PROYECTO
	=============================================*/

	static public function mdlIngresarUsuarioProyecto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(no_orden,nombres, apellidos, telefono, dpi, direccion) VALUES
         (:no_orden, :nombres, :apellidos, :telefono, :dpi, :direccion)");

		$stmt->bindParam(":no_orden", $datos["no_orden"], PDO::PARAM_STR);
		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":dpi", $datos["dpi"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	EDITAR USUARIOS DEL PROYECTO
	=============================================*/

	static public function mdlEditarUsuarioProyecto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET no_orden = :no_orden, nombres = :nombres, apellidos = :apellidos, telefono = :telefono,
		dpi = :dpi, direccion = :direccion, estado = :estado
		  WHERE idusuario = :idusuario ");

		$stmt->bindParam(":no_orden", $datos["no_orden"], PDO::PARAM_STR);
		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":dpi", $datos["dpi"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":idusuario", $datos["idusuario"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuarioProyecto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idusuario = :idusuario");

		$stmt -> bindParam(":idusuario", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}


	/*=============================================
    CONTAR USUARIOS
    =============================================*/
    static public function mdlContarUsuarios($tabla) {
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }





}

?>