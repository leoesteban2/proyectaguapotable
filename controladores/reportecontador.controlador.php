<?php

Class ControladorReporteContador {

    /*=============================================
	MOSTRAR CONTADORES 1
	=============================================*/

	static public function ctrMostrarReporteContador($item, $valor){

		$tabla = "usuario_contador_historial";

		$respuesta = ModeloReporteContador::mdlMostrarReporteContador($tabla, $item, $valor);

		return $respuesta;
	}




}

?>