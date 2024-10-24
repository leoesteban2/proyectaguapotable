<?php

class ControladorAsignacion{

	/*=============================================
	CREAR ASIGNACION
	=============================================*/

	static public function ctrCrearAsignacion(){

		if(isset($_POST["nuevoUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoUsuario"])){
                
                // Asignar las fechas directamente ya que vienen en formato yyyy-mm-dd
                $fechaAsignacion = $_POST["nuevofecha_Asignacion"];
                if (!empty($fechaAsignacion)) {
				$tabla = "usuario_contador";

                $datos = array(
                    "idusuario" => $_POST["nuevoUsuario"],
                    "idcontador" => $_POST["nuevoContador"],
                    "fecha_asignacion" => $fechaAsignacion  // Se usa directamente porque es yyyy-mm-dd
                );

				$respuesta = ModeloAsignacion::mdlIngresarAsignacion($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡El contador ha sido asignado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "asignarcontador";
                            }
                        });
                    </script>';
                } else {
                    // Mostrar mensaje de error en caso de fallo al guardar
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡Error al Asignar el contador!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "asignarcontador";
                            }
                        });
                    </script>';
                }
    
            } else {
                // Si las fechas están vacías
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡Las fechas no pueden estar vacías!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "asignarcontador";
                        }
                    });
                </script>';
            }
    
        } else {
            echo '<script>
                swal({
                    type: "error",
                    title: "¡El contador no puede ir vacío o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
                        window.location = "asignarcontador";
                    }
                });
            </script>';
        }
    }
}

    /*=============================================
	MOSTRAR CONTADORES 1
	=============================================*/

	static public function ctrMostrarAsignacion($item, $valor){

		$tabla = "usuario_contador";

		$respuesta = ModeloAsignacion::MdlMostrarAsignacion($tabla, $item, $valor);

		return $respuesta;
	}


    /*=============================================
    EDITAR ASIGNACION
    =============================================*/
    static public function ctrEditarAsignacion(){

    // Verificar que el método de la solicitud sea POST y que se envíen los datos esperados
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["editarUsuario"]) && isset($_POST["idusuario_contador"])) {

        // Validar que los datos sean correctos y no estén vacíos
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarUsuario"]) &&
            preg_match('/^[0-9]+$/', $_POST["idusuario_contador"]) &&  // Asegura que idusuario_contador sea numérico
            !empty($_POST["editarContador"]) && 
            !empty($_POST["editarfecha_Asignacion"])) {

            $tabla = "usuario_contador";

            $datos = array(
                "idusuario" => $_POST["editarUsuario"],
                "idcontador" => $_POST["editarContador"],
                "fecha_asignacion" => $_POST["editarfecha_Asignacion"],
                "idusuario_contador" => $_POST["idusuario_contador"] // Asegúrate de pasar este valor también
            );

            // Llamar a la función del modelo y enviar el arreglo con los datos correctos
            $respuesta = ModeloAsignacion::mdlEditarAsignacion($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡El contador ha sido asignado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "asignarcontador";
                        }
                    });
                </script>';
            } elseif ($respuesta == "sin_cambios") {
                echo '<script>
                    swal({
                        type: "info",
                        title: "No se realizaron cambios porque los valores son los mismos.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "asignarcontador";
                        }
                    });
                </script>';
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡Error al Asignar el contador!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "asignarcontador";
                        }
                    });
                </script>';
            }
        }
    }
}


    /*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarAsignacion(){

		if(isset($_GET["idUsuario_Contador"])){

			$tabla ="usuario_contador";
			$datos = $_GET["idUsuario_Contador"];

			$respuesta = ModeloAsignacion::mdlBorrarAsignacion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La asignacion ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "asignarcontador";

								}
							})

				</script>';

			}		

		}

	}


}





?>
