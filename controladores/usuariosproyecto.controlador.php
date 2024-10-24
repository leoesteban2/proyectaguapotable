<?php

class ControladorUsuariosProyecto {

    /*=============================================
    CREAR USUARIOS DEL PROYECTO
    =============================================*/

    static public function ctrCrearUsuarioProyecto() {

        if(isset($_POST["nuevoOrden"])){

			if(preg_match('/^[1-9][0-9]{0,2}+$/', $_POST["nuevoOrden"]) &&
               preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreProyecto"]) &&
               preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellidoProyecto"]) &&
               preg_match('/^[0-9]+$/', $_POST["nuevoTelefono"]) &&
               preg_match('/^[0-9]{13}$/',$_POST["nuevoDPI"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ#.,\- ]{1,100}$/', $_POST["nuevoDireccion"])){

				$tabla = "usuario";

				$datos = array("no_orden" => $_POST["nuevoOrden"],
					            "nombres" => $_POST["nuevoNombreProyecto"],
					            "apellidos" => $_POST["nuevoApellidoProyecto"],
                                "telefono" => $_POST["nuevoTelefono"],
                                "dpi" => $_POST["nuevoDPI"],
					            "direccion" => $_POST["nuevoDireccion"]);

				$respuesta = ModeloUsuariosProyecto::mdlIngresarUsuarioProyecto($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario del Proyecto ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuariosproyecto";

						}

					});
				

					</script>';


				}	

			   }else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuariosproyecto";

						}

					});
				

				</script>';

			}


		}
}


	/*=============================================
	MOSTRAR USUARIOS DEL PROYECTO
	=============================================*/

	static public function ctrMostrarUsuariosProyecto($item, $valor){

		$tabla = "usuario";

		$respuesta = ModeloUsuariosProyecto::MdlMostrarUsuariosProyecto($tabla, $item, $valor);

		return $respuesta;
	}


		/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuarioProyecto() {

        if(isset($_POST["editarOrden"])){

			if(preg_match('/^[1-9][0-9]{0,2}+$/', $_POST["editarOrden"]) &&
               preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreProyecto"]) &&
               preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidoProyecto"]) &&
               preg_match('/^[0-9]+$/', $_POST["editarTelefono"]) &&
               preg_match('/^[0-9]{13}$/',$_POST["editarDPI"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ#.,\- ]{1,100}$/', $_POST["editarDireccion"])){

				$tabla = "usuario";

				$datos = array("no_orden" => $_POST["editarOrden"],
					            "nombres" => $_POST["editarNombreProyecto"],
					            "apellidos" => $_POST["editarApellidoProyecto"],
                                "telefono" => $_POST["editarTelefono"],
                                "dpi" => $_POST["editarDPI"],
					            "direccion" => $_POST["editarDireccion"],
								"estado" => $_POST["editarEstado"],
								"idusuario" => $_POST["idusuario"]);

				$respuesta = ModeloUsuariosProyecto::mdlEditarUsuarioProyecto($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario del Proyecto ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuariosproyecto";

						}

					});
				

					</script>';


				}	

			   }else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuariosproyecto";

						}

					});
				

				</script>';

			}


		}

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarUsuarioProyecto(){

		if(isset($_GET["idUsuarioProyecto"])){

			$tabla ="usuario";
			$datos = $_GET["idUsuarioProyecto"];

			$respuesta = ModeloUsuariosProyecto::mdlBorrarUsuarioProyecto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El usuario del proyecto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "usuariosproyecto";

								}
							})

				</script>';

			}		

		}

	}


	/*=============================================
    MOSTRAR TOTAL USUARIOS
    =============================================*/

    static public function ctrContarUsuarios() {
        $tabla = "usuario"; // Cambia esto según la tabla que uses para almacenar los usuarios
        $respuesta = ModeloUsuariosProyecto::mdlContarUsuarios($tabla);

        return $respuesta;
    }








}

?>
