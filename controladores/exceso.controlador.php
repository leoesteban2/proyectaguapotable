<?php

Class ControladorExceso{

    /*=============================================
    MOSTRAR EXCESO
    =============================================*/
    static public function ctrMostrarExceso($item, $valor) {
        $tabla = "cobro_servicio";
        $respuesta = ModeloExceso::mdlMostrarExceso($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrMostrarExcesoP($item, $valor) {
        $respuesta = ModeloExceso::mdlMostrarExcesoP($item, $valor);
        return $respuesta ? $respuesta : [];
    }
    
     /*=============================================
    MOSTRAR EXCESO CON FILTROS
    =============================================*/
    static public function ctrMostrarExcesoF($item, $valor, $fecha_inicio = null, $fecha_fin = null, $estado = 'todos') {
        $tabla = "cobro_servicio";

        // Pasar los parámetros al modelo para filtrar
        $respuesta = ModeloExceso::mdlMostrarExcesoF($tabla, $item, $valor, $fecha_inicio, $fecha_fin, $estado);
        
        return $respuesta;
    }


    /*=============================================
	BORRAR USUARIO
	=============================================*/
    static public function ctrBorrarExceso(){

        if(isset($_GET["idCobro"])){
    
            $tabla = "cobro_servicio";
            $datos = $_GET["idCobro"];
    
            $respuesta = ModeloExceso::mdlBorrarExceso($tabla, $datos);
    
            if($respuesta == "ok"){
    
                echo'<script>
                swal({
                      type: "success",
                      title: "El exceso ha sido borrado correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                            if (result.value) {
                                window.location = "exceso";
                            }
                        })
                </script>';
    
            } elseif($respuesta == "error_estado_pendiente"){
    
                echo'<script>
                swal({
                      type: "error",
                      title: "No se puede borrar el exceso ya que está en estado pendiente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                            if (result.value) {
                                window.location = "exceso";
                            }
                        })
                </script>';
    
            } else {
    
                echo'<script>
                swal({
                      type: "error",
                      title: "Ha ocurrido un error al intentar borrar el exceso",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                            if (result.value) {
                                window.location = "exceso";
                            }
                        })
                </script>';
            }
    
        }
    }
    

}
?>