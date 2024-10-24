<?php
require_once "../controladores/asignarcontador.controlador.php";
require_once "../modelos/asignarcontador.modelo.php";

class AjaxAsignacion {

	/*=============================================
	EDITAR CONTADOR
	=============================================*/	

	public $idUsuario_Contador;

	public function ajaxEditarAsignacion(){

		$item = "idusuario_contador";
		$valor = $this->idUsuario_Contador;

		$respuesta = ControladorAsignacion::ctrMostrarAsignacion($item, $valor);

		echo json_encode($respuesta);

	}


     }

     /*=============================================
        EDITAR Contador
        =============================================*/
if(isset($_POST["idUsuario_Contador"])){

	$editar = new AjaxAsignacion();
	$editar -> idUsuario_Contador = $_POST["idUsuario_Contador"];
	$editar -> ajaxEditarAsignacion();

}

?>