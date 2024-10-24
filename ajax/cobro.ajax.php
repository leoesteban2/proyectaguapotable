<?php
require_once "../controladores/cobros.controlador.php";
require_once "../modelos/cobros.modelo.php";

class AjaxCobro {

	/*=============================================
	EDITAR COBRO
	=============================================*/	

	public $idCobro;

	public function ajaxEditarCobro(){

		$item = "idcobro_base";
		$valor = $this->idCobro;

		$respuesta = ControladorCobro::ctrMostrarCobro($item, $valor);

		echo json_encode($respuesta);

	}


     }

     /*=============================================
        EDITAR COBRO
        =============================================*/
if(isset($_POST["idCobro"])){

	$editar = new AjaxCobro();
	$editar -> idCobro = $_POST["idCobro"];
	$editar -> ajaxEditarCobro();

}

?>