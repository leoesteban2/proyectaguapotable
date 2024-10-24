<?php

Class ControladorTarifa{

    static public function ctrCrearTarifa() {

        if (isset($_POST["nuevoDescripcionTarifa"])) {

            // Validar los campos de entrada
            if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDescripcionTarifa"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoRangoConsumoMinimo"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoRangoConsumoMaximo"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoTarifaBase"])) {
        
                // Asignar las fechas directamente ya que vienen en formato yyyy-mm-dd
                $fechaInicio = $_POST["nuevoFechaInicio"];
                $fechaFin = $_POST["nuevoFechaFin"];
        
                // Validar que las fechas no estén vacías y sean válidas (opcional)
                if (!empty($fechaInicio) && !empty($fechaFin)) {
        
                    $tabla = "tarifa";
        
                    // Crear el array con los datos a insertar en la tabla
                    $datos = array(
                        "descripcion" => $_POST["nuevoDescripcionTarifa"],
                        "rango_consumo_min" => $_POST["nuevoRangoConsumoMinimo"],
                        "rango_consumo_max" => $_POST["nuevoRangoConsumoMaximo"],
                        "tarifa_metro_cubico" => $_POST["nuevoTarifaBase"],
                        "fecha_inicio" => $fechaInicio,  // Se usa directamente porque es yyyy-mm-dd
                        "fecha_fin" => $fechaFin  // Se usa directamente porque es yyyy-mm-dd
                        
                    );
        
                    // Llamar al modelo para insertar los datos
                    $respuesta = ModeloTarifa::mdlIngresarTarifa($tabla, $datos);
        
                    // Verificar si la inserción fue exitosa
                    if ($respuesta == "ok") {
                        echo '<script>
                            swal({
                                type: "success",
                                title: "¡La tarifa ha sido guardado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "tarifas";
                                }
                            });
                        </script>';
                    } else {
                        // Mostrar mensaje de error en caso de fallo al guardar
                        echo '<script>
                            swal({
                                type: "error",
                                title: "¡Error al guardar la tarifa!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "tarifas";
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
                                window.location = "tarifas";
                            }
                        });
                    </script>';
                }
        
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡La tarifa no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "tarifas";
                        }
                    });
                </script>';
            }
        }
}


	/*=============================================
	MOSTRAR TARIFA
	=============================================*/

	static public function ctrMostrarTarifa($item, $valor){

		$tabla = "tarifa";

		$respuesta = ModeloTarifa::MdlMostrarTarifa($tabla, $item, $valor);

		return $respuesta;
	}



    static public function ctrEditarTarifa() {

        if (isset($_POST["editarDescripcionTarifa"])) {

            // Validar los campos de entrada
            if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionTarifa"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarRangoConsumoMinimo"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarRangoConsumoMaximo"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarTarifaBase"])) {
        
                // Asignar las fechas directamente ya que vienen en formato yyyy-mm-dd
                $fechaInicio = $_POST["editarFechaInicio"];
                $fechaFin = $_POST["editarFechaFin"];
        
                // Validar que las fechas no estén vacías y sean válidas (opcional)
                if (!empty($fechaInicio) && !empty($fechaFin)) {
        
                    $tabla = "tarifa";
        
                    // Crear el array con los datos a insertar en la tabla
                    $datos = array(
                        "idtarifa" => $_POST["idtarifa"],
                        "descripcion" => $_POST["editarDescripcionTarifa"],
                        "rango_consumo_min" => $_POST["editarRangoConsumoMinimo"],
                        "rango_consumo_max" => $_POST["editarRangoConsumoMaximo"],
                        "tarifa_metro_cubico" => $_POST["editarTarifaBase"],
                        "fecha_inicio" => $fechaInicio,  // Se usa directamente porque es yyyy-mm-dd
                        "fecha_fin" => $fechaFin  // Se usa directamente porque es yyyy-mm-dd
                        
                    );
        
                    // Llamar al modelo para insertar los datos
                    $respuesta = ModeloTarifa::mdlEditarTarifa($tabla, $datos);
        
                    // Verificar si la inserción fue exitosa
                    if ($respuesta == "ok") {
                        echo '<script>
                            swal({
                                type: "success",
                                title: "¡La tarifa ha sido actualizado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "tarifas";
                                }
                            });
                        </script>';
                    } else {
                        // Mostrar mensaje de error en caso de fallo al guardar
                        echo '<script>
                            swal({
                                type: "error",
                                title: "¡Error al actualizar la tarifa!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "tarifas";
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
                                window.location = "tarifas";
                            }
                        });
                    </script>';
                }
        
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡La tarifa no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "tarifas";
                        }
                    });
                </script>';
            }
        }
}

/*=============================================
	BORRAR TARIFA
	=============================================*/

	static public function ctrBorrarTarifa(){

		if(isset($_GET["idTarifa"])){

			$tabla ="tarifa";
			$datos = $_GET["idTarifa"];

			$respuesta = ModeloTarifa::mdlBorrarTarifa($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La tarifa ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "tarifas";

								}
							})

				</script>';

			}		

		}

	}






}
?>