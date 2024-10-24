<?php
require_once "../controladores/pagos.controlador.php";
require_once "../modelos/pagos.modelo.php";

class AjaxPago {

	/*=============================================
	EDITAR PAGOS
	=============================================*/	

	public $idPago;

	public function ajaxEditarPago(){

		$item = "idpago";
		$valor = $this->idPago;

		$respuesta = ControladorPagos::ctrMostrarPagos($item, $valor);

		echo json_encode($respuesta);

	}


     }

     /*=============================================
        EDITAR PAGOS
        =============================================*/
if(isset($_POST["idPago"])){

	$editar = new AjaxPago();
	$editar -> idPago = $_POST["idPago"];
	$editar -> ajaxEditarPago();

}

?>