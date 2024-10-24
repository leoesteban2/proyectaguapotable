<?php
require_once "../controladores/certificado.controlador.php";
require_once "../modelos/certificado.modelo.php";

class AjaxCertificado {

	/*=============================================
	EDITAR CONTADOR
	=============================================*/	

	public $idTitulo;

	public function ajaxEditarCertificado(){

		$item = "idtitulo";
		$valor = $this->idTitulo;

		$respuesta = ControladorCertificado::ctrMostrarCertificado($item, $valor);

		echo json_encode($respuesta);

	}


     }

     /*=============================================
        EDITAR Contador
        =============================================*/
if(isset($_POST["idTitulo"])){

	$editar = new AjaxCertificado();
	$editar -> idTitulo = $_POST["idTitulo"];
	$editar -> ajaxEditarCertificado();

}

?>