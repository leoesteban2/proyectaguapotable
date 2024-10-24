<?php

class ControladorContador{

    /*=============================================
    CREAR CONTADORES
    =============================================*/

    static public function ctrCrearContador() {

        if (isset($_POST["nuevoNo_contador"])) {

            // Validar los campos de entrada
            if (preg_match('/^[a-zA-Z0-9]{8,20}$/', $_POST["nuevoNo_contador"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDescripcion"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoLecturaActual"])) {
        
                // Asignar las fechas directamente ya que vienen en formato yyyy-mm-dd
                $fechaInstalacion = $_POST["nuevoFecha_instalacion"];
                $ultimoMantenimiento = $_POST["nuevoUltimo_mantenimiento"];
        
                // Validar que las fechas no estén vacías y sean válidas (opcional)
                if (!empty($fechaInstalacion) && !empty($ultimoMantenimiento)) {
        
                    $tabla = "contador";
        
                    // Crear el array con los datos a insertar en la tabla
                    $datos = array(
                        "no_contador" => $_POST["nuevoNo_contador"],
                        "descripcion" => $_POST["nuevoDescripcion"],
                        "fecha_instalacion" => $fechaInstalacion,  // Se usa directamente porque es yyyy-mm-dd
                        "ultimo_mantenimiento" => $ultimoMantenimiento,  // Se usa directamente porque es yyyy-mm-dd
                        "lectura_actual" => $_POST["nuevoLecturaActual"]
                    );
        
                    // Llamar al modelo para insertar los datos
                    $respuesta = ModeloContador::mdlIngresarContador($tabla, $datos);
        
                    // Verificar si la inserción fue exitosa
                    if ($respuesta == "ok") {
                        echo '<script>
                            swal({
                                type: "success",
                                title: "¡El contador ha sido guardado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "contadores";
                                }
                            });
                        </script>';
                    } else {
                        // Mostrar mensaje de error en caso de fallo al guardar
                        echo '<script>
                            swal({
                                type: "error",
                                title: "¡Error al guardar el contador!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "contadores";
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
                                window.location = "contadores";
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
                            window.location = "contadores";
                        }
                    });
                </script>';
            }
        }
}

	/*=============================================
	MOSTRAR CONTADORES
	=============================================*/

	static public function ctrMostrarContador($item, $valor){

		$tabla = "contador";

		$respuesta = ModeloContador::MdlMostrarContador($tabla, $item, $valor);

		return $respuesta;
	}

    /*=============================================
    EDITAR CONTADORES
    =============================================*/
    static public function ctrEditarContador() {

    // Verificar si se ha enviado el formulario para editar un contador
    if (isset($_POST["editarNo_contador"])) {

        // Validar los campos de entrada
        if (preg_match('/^[a-zA-Z0-9]{8,20}$/', $_POST["editarNo_contador"]) &&
            preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
            preg_match('/^[0-9]+$/', $_POST["editarLecturaActual"])) {

            // Asignar las fechas directamente ya que vienen en formato yyyy-mm-dd desde el campo `date`
            $fechaInstalacion = $_POST["editarFecha_instalacion"];
            $ultimoMantenimiento = $_POST["editarUltimo_mantenimiento"];

            // Validar que las fechas no estén vacías y sean válidas (opcional)
            if (!empty($fechaInstalacion) && !empty($ultimoMantenimiento)) {

                $tabla = "contador";

                // Crear el array con los datos a actualizar en la tabla
                $datos = array(
                    "no_contador" => $_POST["editarNo_contador"],
                    "descripcion" => $_POST["editarDescripcion"],
                    "fecha_instalacion" => $fechaInstalacion,  // Se usa directamente porque es yyyy-mm-dd
                    "ultimo_mantenimiento" => $ultimoMantenimiento,  // Se usa directamente porque es yyyy-mm-dd
                    "lectura_actual" => $_POST["editarLecturaActual"],
                    "estado" => $_POST["editarEstado"],
                    "idcontador" => $_POST["idcontador"]
                );

                // Llamar al modelo para actualizar los datos
                $respuesta = ModeloContador::mdlEditarContador($tabla, $datos);

                // Verificar si la actualización fue exitosa
                if ($respuesta == "ok") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡El contador ha sido actualizado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "contadores";
                            }
                        });
                    </script>';
                } else {
                    // Mostrar mensaje de error en caso de fallo al actualizar
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡Error al actualizar el contador!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "contadores";
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
                            window.location = "contadores";
                        }
                    });
                </script>';
            }

        } else {
            // Si la validación de los campos falla
            echo '<script>
                swal({
                    type: "error",
                    title: "¡El número de contador debe tener entre 8 y 20 caracteres y puede incluir letras y números!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
                        window.location = "contadores";
                    }
                });
            </script>';
        }
    }
}


    /*=============================================
	BORRAR CONTADOR
	=============================================*/

	static public function ctrBorrarContador(){

		if(isset($_GET["idContador"])){

			$tabla ="contador";
			$datos = $_GET["idContador"];

			$respuesta = ModeloContador::mdlBorrarContador($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El contador ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "contadores";

								}
							})

				</script>';

			}		

		}

	}

    /* PARA EL CONTEO TAL DE LOS CONTADORES EN LA BASE DE DATOS */
    public static function ctrContarContadores() {
        return ModeloContador::mdlContarContadores();
    }


}
?>