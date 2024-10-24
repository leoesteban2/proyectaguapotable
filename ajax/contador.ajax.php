<?php
require_once "../controladores/contadores.controlador.php";
require_once "../modelos/contadores.modelo.php";

class AjaxContador {

	/*=============================================
	EDITAR CONTADOR
	=============================================*/	

	public $idContador;

	public function ajaxEditarContador(){

		$item = "idcontador";
		$valor = $this->idContador;

		$respuesta = ControladorContador::ctrMostrarContador($item, $valor);

		echo json_encode($respuesta);

	}


     }

     /*=============================================
        EDITAR Contador
        =============================================*/
if(isset($_POST["idContador"])){

	$editar = new AjaxContador();
	$editar -> idContador = $_POST["idContador"];
	$editar -> ajaxEditarContador();

}

?>