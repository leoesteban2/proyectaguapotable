<?php

class ControladorCertificado{

/*=============================================
	MOSTRAR CONTADORES 1
	=============================================*/

	static public function ctrMostrarCertificado($item, $valor){

		$tabla = "titulo_propiedad";

		$respuesta = ModeloCertificado::MdlMostrarCertificado($tabla, $item, $valor);

		return $respuesta;
	}


/*=============================================
EDITAR CERTIFICADO
=============================================*/
static public function ctrEditarCertificado() {

    // Verificar que la solicitud sea POST y que se envíen los datos esperados
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["idtitulo"])) {

        // Validar que los datos sean correctos y no estén vacíos
        if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
            preg_match('/^[0-9]+$/', $_POST["idtitulo"]) &&  
            !empty($_POST["editarNo_titulo"]) && 
            !empty($_POST["editarFecha"]) && 
            !empty($_POST["editarEstado"])) {

            // Definir la tabla correcta, en este caso 'titulo_propiedad'
            $tabla = "titulo_propiedad";

            // Preparar el array de datos a actualizar
            $datos = array(
                "no_titulo" => $_POST["editarNo_titulo"], // Número de título
                "fecha" => $_POST["editarFecha"],  // Fecha del certificado
                "estado" => $_POST["editarEstado"], // Estado del certificado
                "idtitulo" => $_POST["idtitulo"]   // El ID del título
            );

            // Llamar a la función del modelo para actualizar
            $respuesta = ModeloCertificado::mdlEditarCertificado($tabla, $datos);

            // Mensaje según el resultado de la actualización
            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡El certificado ha sido actualizado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "certificado";
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
                            window.location = "certificado";
                        }
                    });
                </script>';
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡Error al actualizar el certificado!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "certificado";
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

	static public function ctrBorrarCertificado(){

		if(isset($_GET["idTitulo"])){

			$tabla ="titulo_propiedad";
			$datos = $_GET["idTitulo"];

			$respuesta = ModeloCertificado::mdlBorrarCertificado($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El certificado ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "certificado";

								}
							})

				</script>';

			}		

		}

	}

    /*=============================================
    CONTAR TOTAL DE CERTIFICADOS
    =============================================*/
    static public function ctrContarCertificados() {
        $tabla = "titulo_propiedad";
        $respuesta = ModeloCertificado::mdlContarCertificados($tabla);
        return $respuesta;
    }



}
?>