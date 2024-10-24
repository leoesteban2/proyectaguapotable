<?php
require_once "../controladores/usuariosproyecto.controlador.php";
require_once "../modelos/usuariosproyecto.modelo.php";

class AjaxUsuariosProyecto{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	 public $idUsuarioProyecto;

	public function ajaxEditarUsuarioProyecto(){

		$item = "idusuario";
		$valor = $this->idUsuarioProyecto;

		$respuesta = ControladorUsuariosProyecto::ctrMostrarUsuariosProyecto($item, $valor);

		echo json_encode($respuesta);

	}


     }

     /*=============================================
EDITAR USUARIO DEL PROYECTO
=============================================*/
if(isset($_POST["idUsuarioProyecto"])){

	$editar = new AjaxUsuariosProyecto();
	$editar -> idUsuarioProyecto = $_POST["idUsuarioProyecto"];
	$editar -> ajaxEditarUsuarioProyecto();

}

?>