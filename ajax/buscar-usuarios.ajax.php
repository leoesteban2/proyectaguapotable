<?php
require_once "../controladores/usuariosproyecto.controlador.php";
require_once "../modelos/usuariosproyecto.modelo.php";

if(isset($_GET['q'])) {
    $busqueda = $_GET['q'];
    $pagina = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limite = 30;
    $offset = ($pagina - 1) * $limite;

    $item = null;
    $valor = null;
    $usuarios = ControladorUsuariosProyecto::ctrMostrarUsuariosProyecto($item, $valor);

    // Filtrar y paginar resultados
    $filtrados = array_filter($usuarios, function($usuario) use ($busqueda) {
        return stripos($usuario['nombres'], $busqueda) !== false || 
               stripos($usuario['apellidos'], $busqueda) !== false ||
               stripos($usuario['no_orden'], $busqueda) !== false;
    });

    $total = count($filtrados);
    $paginados = array_slice($filtrados, $offset, $limite);

    $resultados = array(
        'items' => $paginados,
        'total_count' => $total
    );

    echo json_encode($resultados);
    exit;
}
?>