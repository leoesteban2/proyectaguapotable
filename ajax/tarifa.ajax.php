<?php
require_once "../controladores/tarifas.controlador.php";
require_once "../modelos/tarifas.modelo.php";

class AjaxTarifa {

	/*=============================================
	EDITAR Tarifa
	=============================================*/	

	public $idTarifa;

	public function ajaxEditarTarifa(){

		$item = "idtarifa";
		$valor = $this->idTarifa;

		$respuesta = ControladorTarifa::ctrMostrarTarifa($item, $valor);

		echo json_encode($respuesta);

	}


     }

     /*=============================================
        EDITAR Tarifa
        =============================================*/
if(isset($_POST["idTarifa"])){

	$editar = new AjaxTarifa();
	$editar -> idTarifa = $_POST["idTarifa"];
	$editar -> ajaxEditarTarifa();

}

?>