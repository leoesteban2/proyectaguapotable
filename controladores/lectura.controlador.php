<?php
class ControladorLectura {

    /*=============================================
    MOSTRAR Lectura
    =============================================*/
    static public function ctrMostrarLectura($item, $valor) {
        $tabla = "lectura";
        $respuesta = ModeloLectura::mdlMostrarLectura($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    MOSTRAR LECTURAS CON FILTROS
    =============================================*/
    static public function ctrMostrarLecturasF($item, $valor, $fecha_inicio = null, $fecha_fin = null) {
        $tabla = "lectura";

        // Pasar los parámetros al modelo para filtrar
        $respuesta = ModeloLectura::mdlMostrarLecturasF($tabla, $item, $valor, $fecha_inicio, $fecha_fin);
    
       return $respuesta;
    }




    /*=============================================
    CREAR  LECTURA
    =============================================*/
    static public function ctrCrearLectura() {
        if (isset($_POST["nuevoUsuarioA"])) {
    
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuarioA"])) {
    
                $fechaLectura = $_POST["nuevoFecha_Lectura"];
                if (!empty($fechaLectura)) {
    
                    $tabla = "lectura";
                    $datos = array(
                        "idusuario_contador" => $_POST["nuevoUsuarioA"],
                        "lectura_actual" => $_POST["nuevoLecturaActual"],
                        "lectura_anterior" => $_POST["nuevoLecturaAnteriorA"],
                        "fecha_lectura" => $fechaLectura
                    );
    
                    $respuesta = ModeloLectura::mdlIngresarLectura($tabla, $datos);
    
                    if ($respuesta == "ok") {
                        echo '<script>
                            swal({
                                type: "success",
                                title: "¡La lectura se asignó correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "lectura";
                                }
                            });
                        </script>';
                    } elseif ($respuesta == "duplicate") {
                        echo '<script>
                            swal({
                                type: "error",
                                title: "¡Error! El usuario ya tiene una lectura asignada.",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "lectura";
                                }
                            });
                        </script>';
                    } else {
                        echo '<script>
                            swal({
                                type: "error",
                                title: "¡Error al asignar la lectura!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "lectura";
                                }
                            });
                        </script>';
                    }
                } else {
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡La fecha de lectura no puede estar vacía!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "lectura";
                            }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡La lectura no puede contener caracteres especiales o estar vacía!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "lectura";
                        }
                    });
                </script>';
            }
        }
    }
    
   /*=============================================
	BORRAR PAGO
=============================================*/

static public function ctrBorrarLectura(){

	if(isset($_GET["idLectura"])){

		$tabla = "lectura";
		$datos = $_GET["idLectura"];

		$respuesta = ModeloLectura::mdlBorrarLectura($tabla, $datos);

		if($respuesta == "ok"){

			echo'<script>

			swal({
				  type: "success",
				  title: "La lectura ha sido borrada correctamente",
				  showConfirmButton: true,
				  confirmButtonText: "Cerrar"
				  }).then(function(result){
							if (result.value) {
							window.location = "lectura";
							}
						})

			</script>';

		}		

	}

}


    /* CONTAR EL TOTAL DE LECTURA */
    static public function ctrContarLecturas(){
        return ModeloLectura::mdlContarLecturas();
    }
    

    /* PARA LA GRAFICA */
    public static function ctrObtenerLecturasPorMes() {
        return ModeloLectura::mdlObtenerLecturasPorMes();
    }
    
}
?>