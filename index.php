<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/usuariosproyecto.controlador.php";
require_once "controladores/contadores.controlador.php";
require_once "controladores/asignarcontador.controlador.php";
require_once "controladores/certificado.controlador.php";
require_once "controladores/reportecontador.controlador.php";
require_once "controladores/lectura.controlador.php";
require_once "controladores/tarifas.controlador.php";
require_once "controladores/exceso.controlador.php";
require_once "controladores/cobros.controlador.php";
require_once "controladores/pagos.controlador.php";
require_once "controladores/estadocuenta.controlador.php";





require_once "modelos/usuarios.modelo.php";
require_once "modelos/usuariosproyecto.modelo.php";
require_once "modelos/contadores.modelo.php";
require_once "modelos/asignarcontador.modelo.php";
require_once "modelos/certificado.modelo.php";
require_once "modelos/reportecontador.modelo.php";
require_once "modelos/lectura.modelo.php";
require_once "modelos/tarifas.modelo.php";
require_once "modelos/exceso.modelo.php";
require_once "modelos/cobros.modelo.php";
require_once "modelos/pagos.modelo.php";
require_once "modelos/estadocuenta.modelo.php";





/* 

require_once "controladores/usuariosproyecto.controlador.php";
require_once "controladores/certificado.controlador.php";
require_once "controladores/contadores.controlador.php";
require_once "controladores/cobros.controlador.php";



require_once "modelos/certificado.modelo.php";
require_once "modelos/contadores.modelo.php";
require_once "modelos/cobros.modelo.php";
*/

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();