<?php

class ControladorPagos{
    /*=============================================
        MOSTRAR PAGOS
        =============================================*/
        static public function ctrMostrarPagos($item, $valor) {
            $tabla = "pago_servicio";
            $respuesta = ModeloPagos::mdlMostrarPagos($tabla, $item, $valor);
            return $respuesta;
        }

    
        /*=============================================
        MOSTRAR PAGOS CON FILTROS
        =============================================*/
        static public function ctrMostrarPagosF($item, $valor, $fecha_inicio = null, $fecha_fin = null, $tipo_pago = 'todos') {
         $tabla = "pago_servicio";

          // Pasar los parámetros al modelo para filtrar
          $respuesta = ModeloPagos::mdlMostrarPagosF($tabla, $item, $valor, $fecha_inicio, $fecha_fin, $tipo_pago);
    
          return $respuesta;
        }


        static public function ctrCrearPagos() {
            if (isset($_POST["nuevoUsuarioP"])) {
        
                // Validar los campos de entrada
                if (preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $_POST["monto_pagado"]) &&  // Permitir decimales
                    preg_match('/^[0-9]+$/', $_POST["nuevoUsuarioP"]) &&
                    preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["tipoCobroSeleccionado"])) {
        
                    // Asignar la fecha directamente ya que viene en formato yyyy-mm-dd
                    $fechaPago = $_POST["fecha_pago"];
        
                    // Validar que la fecha no esté vacía
                    if (!empty($fechaPago)) {
        
                        $tabla = "pago_servicio";
        
                        // Validar si se recibió un cobro o un cobro base
                        $idCobro = isset($_POST["idcobro"]) && !empty($_POST["idcobro"]) ? $_POST["idcobro"] : NULL;
                        $idCobroBase = isset($_POST["idcobro_base"]) && !empty($_POST["idcobro_base"]) ? $_POST["idcobro_base"] : NULL;
        
                        // Si ambos son nulos, no se puede continuar
                        if ($idCobro === NULL && $idCobroBase === NULL) {
                            echo '<script>
                                swal({
                                    type: "error",
                                    title: "¡Debe seleccionar un cobro o un cobro base!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then(function(result){
                                    if (result.value) {
                                        window.location = "pagos";
                                    }
                                });
                            </script>';
                            return;
                        }
        
                        // Crear el array con los datos a insertar en la tabla
                        $datos = array(
                            "idusuario_contador" => $_POST["nuevoUsuarioP"],
                            "idcobro" => $idCobro,  // Solo si existe un cobro de servicio
                            "idcobro_base" => $idCobroBase,  // Solo si existe un cobro base
                            "fecha_pago" => $fechaPago,  // Se usa directamente porque es yyyy-mm-dd
                            "detalle" => $_POST["detalle_pago"],  // Detalle del pago
                            "monto_pagado" => $_POST["monto_pagado"],  // Monto que ahora puede ser decimal
                            "tipo_pago" => $_POST["tipoCobroSeleccionado"]
                        );
        
                        // Llamar al modelo para insertar los datos
                        $respuesta = ModeloPagos::mdlIngresarPagos($tabla, $datos);
        
                        // Verificar si la inserción fue exitosa
                        if ($respuesta == "ok") {
                            echo '<script>
                                swal({
                                    type: "success",
                                    title: "¡El pago ha sido registrado correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then(function(result){
                                    if (result.value) {
                                        window.location = "pagos";
                                    }
                                });
                            </script>';
                        } else {
                            // Mostrar mensaje de error en caso de fallo al guardar
                            echo '<script>
                                swal({
                                    type: "error",
                                    title: "¡Error al registrar el pago!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then(function(result){
                                    if (result.value) {
                                        window.location = "pagos";
                                    }
                                });
                            </script>';
                        }
        
                    } else {
                        // Si la fecha está vacía
                        echo '<script>
                            swal({
                                type: "error",
                                title: "¡La fecha de pago no puede estar vacía!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "pagos";
                                }
                            });
                        </script>';
                    }
        
                } else {
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡El monto del pago no puede estar vacío o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "pagos";
                            }
                        });
                    </script>';
                }
            }
        }


        static public function ctrEditarPagos() {

            if (isset($_POST["idpago"])) {  // Verifica si el ID del pago a editar está presente
        
                // Validar los campos de entrada para tipo de pago y fecha
                if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["tipo_pagoE"]) &&
                    preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["fecha_pagoE"])) {
        
                    // Asignar la fecha directamente ya que viene en formato yyyy-mm-dd
                    $fechaPago = $_POST["fecha_pagoE"];
                    $tipoPago = $_POST["tipo_pagoE"];
        
                    // Validar que la fecha no esté vacía
                    if (!empty($fechaPago)) {
        
                        $tabla = "pago_servicio";
        
                        // Crear el array con los datos a actualizar en la tabla
                        $datos = array(
                            "idpago" => $_POST["idpago"], // ID del pago que se va a editar
                            "fecha_pago" => $fechaPago,  // Fecha nueva
                            "tipo_pago" => $tipoPago    // Tipo de pago actualizado
                        );
        
                        // Llamar al modelo para actualizar los datos
                        $respuesta = ModeloPagos::mdlEditarPagos($tabla, $datos);
        
                        // Verificar si la actualización fue exitosa
                        if ($respuesta == "ok") {
                            echo '<script>
                                swal({
                                    type: "success",
                                    title: "¡El pago ha sido actualizado correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then(function(result){
                                    if (result.value) {
                                        window.location = "pagos";
                                    }
                                });
                            </script>';
                        } else {
                            // Mostrar mensaje de error en caso de fallo al actualizar
                            echo '<script>
                                swal({
                                    type: "error",
                                    title: "¡Error al actualizar el pago!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then(function(result){
                                    if (result.value) {
                                        window.location = "pagos";
                                    }
                                });
                            </script>';
                        }
        
                    } else {
                        // Si la fecha está vacía
                        echo '<script>
                            swal({
                                type: "error",
                                title: "¡La fecha de pago no puede estar vacía!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "pagos";
                                }
                            });
                        </script>';
                    }
        
                } else {
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡El tipo de pago o la fecha de pago no son válidos!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "pagos";
                            }
                        });
                    </script>';
                }
            }
        }
        
        
    /*=============================================
	BORRAR PAGO
	=============================================*/

	static public function ctrBorrarPago(){

		if(isset($_GET["idPago"])){

			$tabla ="pago_servicio";
			$datos = $_GET["idPago"];

			$respuesta = ModeloPagos::mdlBorrarPago($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El pago ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "pagos";

								}
							})

				</script>';

			}		

		}

	}
        

}

?>