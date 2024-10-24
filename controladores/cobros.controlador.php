<?php

    class ControladorCobro{
    /*=============================================
    MOSTRAR COBRO
    =============================================*/
    static public function ctrMostrarCobro($item, $valor) {
        $tabla = "cobro_base";
        $respuesta = ModeloCobro::mdlMostrarCobro($tabla, $item, $valor);

        // Asegúrate de que siempre devuelva un array, incluso si está vacío
        return $respuesta ? $respuesta : [];
    
    }

    static public function ctrMostrarCobroP($item, $valor) {
        $tabla = "cobro_base";
        $respuesta = ModeloCobro::mdlMostrarCobroP($tabla, $item, $valor);

        // Asegúrate de que siempre devuelva un array, incluso si está vacío
        return $respuesta ? $respuesta : [];
    
    }

    /*=============================================
    MOSTRAR COBROS BASE CON FILTROS
    =============================================*/
    static public function ctrMostrarCobrosBaseF($item, $valor, $fecha_inicio = null, $fecha_fin = null, $estado = 'todos', $tipo_cobro = 'todos') {
    $tabla = "cobro_base";

    // Pasar los parámetros al modelo para filtrar
    $respuesta = ModeloCobro::mdlMostrarCobrosBaseF($tabla, $item, $valor, $fecha_inicio, $fecha_fin, $estado, $tipo_cobro);
    
    return $respuesta;
}



    /*=============================================
    CREAR COBRO BASE
    =============================================*/
    static public function ctrCrearCobroBase() {

    if (isset($_POST["nuevoMontoB"])) {

        // Validar los campos del formulario
        if (preg_match('/^[0-9]+(?:\.[0-9]{1,2})?$/', $_POST["nuevoMontoB"]) &&
            in_array($_POST["nuevoTipoCobro"], ['mensual', 'anual', 'unico']) &&
            preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["nuevaFechaCobro"])) {

            $tabla = "cobro_base";

            // Verificar si el checkbox "Cobrar a todos" está marcado
            if (isset($_POST["cobrarTodos"]) && $_POST["cobrarTodos"] == 1) {

                // Obtener todos los usuarios del sistema
                $usuarios = ControladorAsignacion::ctrMostrarAsignacion(null, null);

                // Iterar sobre cada usuario y crear el cobro para cada uno
                foreach ($usuarios as $usuario) {

                    // Recoger los datos del formulario para cada usuario
                    $datos = array(
                        "idusuario_contador" => $usuario["idusuario_contador"],
                        "fecha_cobro" => $_POST["nuevaFechaCobro"],
                        "monto_base" => $_POST["nuevoMontoB"],
                        "estado_cobro" => 'pendiente',  // Cobro inicial en estado pendiente
                        "tipo_cobro" => $_POST["nuevoTipoCobro"],
                        "detalle" => $_POST["nuevoDetalle"],  // Detalle obtenido de la tarifa seleccionada
                        "idtarifa" => $_POST["nuevoTarifaA"]
                    );

                    // Llamar al modelo para insertar el cobro base para cada usuario
                    $respuesta = ModeloCobro::mdlIngresarCobro($tabla, $datos);

                    // Comprobar si hubo un error al insertar el cobro
                    if ($respuesta != "ok") {
                        echo '<script>
                            swal({
                                type: "error",
                                title: "¡Error al crear el cobro para el usuario ' . $usuario["nombres"] . '!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "crear-cobros";
                                }
                            });
                        </script>';
                        return; // Salir del bucle si ocurre un error
                    }
                }

                // Mensaje de éxito si todos los cobros se crearon correctamente
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡Los cobros han sido creados correctamente para todos los usuarios!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "crear-cobros";
                        }
                    });
                </script>';

            } else {
                // Si no se seleccionó el checkbox "Cobrar a todos", crear cobro para un solo usuario
                $datos = array(
                    "idusuario_contador" => $_POST["nuevoUsuarioC"],
                    "fecha_cobro" => $_POST["nuevaFechaCobro"],
                    "monto_base" => $_POST["nuevoMontoB"],
                    "estado_cobro" => 'pendiente',  // Cobro inicial en estado pendiente
                    "tipo_cobro" => $_POST["nuevoTipoCobro"],
                    "detalle" => $_POST["nuevoDetalle"],  // Detalle obtenido de la tarifa seleccionada
                    "idtarifa" => $_POST["nuevoTarifaA"]
                );

                // Llamar al modelo para insertar el cobro base
                $respuesta = ModeloCobro::mdlIngresarCobro($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡El cobro ha sido creado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "crear-cobros";
                            }
                        });
                    </script>';
                } else {
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡Error al crear el cobro!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "crear-cobros";
                            }
                        });
                    </script>';
                }
            }
        } else {
            // Mostrar mensaje de error si los datos no son válidos
            echo '<script>
                swal({
                    type: "error",
                    title: "¡Los datos ingresados no son válidos!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
                        window.location = "crear-cobros";
                    }
                });
            </script>';
        }
    }
}

    /* EDITAR COBROS */
    static public function ctrEditarCobroBase() {

        // Verificar si se ha enviado el formulario para editar el cobro
        if (isset($_POST["idcobro_base"])) {
    
            // Validar los campos del formulario
            if (preg_match('/^[0-9]+(?:\.[0-9]{1,2})?$/', $_POST["editarMontoB"]) &&
                in_array($_POST["editarTipoCobro"], ['mensual', 'anual', 'unico']) &&
                preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["editarFechaCobro"])) {
    
                $tabla = "cobro_base";
    
                // Recoger los datos del formulario en un array
                $datos = array(
                    "idcobro_base" => $_POST["idcobro_base"],
                    "idusuario_contador" => $_POST["editarUsuarioC"],  // Mantener aunque no cambie
                    "fecha_cobro" => $_POST["editarFechaCobro"],
                    "monto_base" => $_POST["editarMontoB"],
                    
                    "tipo_cobro" => $_POST["editarTipoCobro"],
                    "detalle" => $_POST["editarDetalle"],
                    "idtarifa" => $_POST["editarTarifaA"]
                );
    
                // Llamar al modelo para actualizar el cobro base
                $respuesta = ModeloCobro::mdlEditarCobro($tabla, $datos);
    
                // Verificar la respuesta del modelo y actuar en consecuencia
                if ($respuesta == "ok") {
                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡El cobro ha sido editado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "crear-cobros";
                            }
                        });
                    </script>';
                } else {
                    // Mostrar mensaje de error si la actualización falla
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡Error al editar el cobro!",
                            text: "' . $respuesta . '",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "crear-cobros";
                            }
                        });
                    </script>';
                }
            } else {
                // Mostrar mensaje de error si los datos no son válidos
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡Los datos ingresados no son válidos!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "crear-cobros";
                        }
                    });
                </script>';
            }
        }
    }
    
    /*=============================================
    BORRAR COBRO BASE
    =============================================*/
    static public function ctrBorrarCobroBase(){

    if(isset($_GET["idCobro"])){

        $tabla = "cobro_base";
        $datos = $_GET["idCobro"];

        // Llamar al modelo para borrar el cobro base
        $respuesta = ModeloCobro::mdlBorrarCobroBase($tabla, $datos);

        if($respuesta == "ok"){

            echo'<script>
            swal({
                  type: "success",
                  title: "El cobro base ha sido borrado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                        if (result.value) {
                            window.location = "crear-cobros";
                        }
                    })
            </script>';

        } elseif($respuesta == "error_estado_pendiente"){

            echo'<script>
            swal({
                  type: "error",
                  title: "No se puede borrar el cobro base ya que está en estado pendiente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                        if (result.value) {
                            window.location = "crear-cobros";
                        }
                    })
            </script>';

        } else {

            echo'<script>
            swal({
                  type: "error",
                  title: "Ha ocurrido un error al intentar borrar el cobro base",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                        if (result.value) {
                            window.location = "crear-cobros";
                        }
                    })
            </script>';
        }

    }
}

    
}



?>