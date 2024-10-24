<?php
require_once "../controladores/usuariosproyecto.controlador.php";
require_once "../modelos/usuariosproyecto.modelo.php";

class TablaUsuariosProyecto {

    /*=============================================
     MOSTRAR LA TABLA DE USUARIOS DEL PROYECTO
    =============================================*/ 
    public function mostrarTablaUsuariosProyecto() {
        $item = null;
        $valor = null;

        // Obtener los datos de usuarios desde el controlador
        $UsuariosProyecto = ControladorUsuariosProyecto::ctrMostrarUsuariosProyecto($item, $valor);	

        // Verificar si se han obtenido los datos correctamente
        if (!$UsuariosProyecto) {
            $UsuariosProyecto = [];
        }

        // Crear array para almacenar los datos que se van a enviar
        $data = [];

        // Recorremos los usuarios y generamos las filas
        for ($i = 0; $i < count($UsuariosProyecto); $i++) {

            // Definimos los botones de acciones para cada usuario
            $botones = "<div class='btn-group'>
                                       <button class='btn btn-warning btnEditarUsuarioProyecto' idUsuarioProyecto='
                                       ".$UsuariosProyecto[$i]["idusuario"]."
                                         ' data-toggle='modal' data-target='#modaleditarUsuarioProyecto'>
                                        <i class='fa fa-pencil'></i></button>
                                       <button class='btn btn-danger btnEliminarUsuarioProyecto' 
                                       idUsuarioProyecto='".$UsuariosProyecto[$i]["idusuario"]."'>
                                        <i class='fa fa-times'></i></button>
                                         </div>"; 

            // Añadir datos de cada usuario en formato JSON al array $data
            $data[] = [
                $UsuariosProyecto[$i]["no_orden"],
                $UsuariosProyecto[$i]["nombres"],
                $UsuariosProyecto[$i]["apellidos"],
                $UsuariosProyecto[$i]["telefono"],
                $UsuariosProyecto[$i]["dpi"],
                $UsuariosProyecto[$i]["direccion"],
                $UsuariosProyecto[$i]["estado"],
                $botones
            ];
        }

        // Crear estructura final de JSON
        $datosJson = [
            "data" => $data
        ];

        // Especificar el tipo de contenido como JSON
        header('Content-Type: application/json');

        // Imprimir JSON de salida
        echo json_encode($datosJson, JSON_UNESCAPED_UNICODE);
    }
}

/*=============================================
ACTIVAR TABLA DE USUARIOS DEL PROYECTO
=============================================*/ 
$activarUsuariosProyecto = new TablaUsuariosProyecto();
$activarUsuariosProyecto->mostrarTablaUsuariosProyecto();
?>
