<?php
require('../extensiones/fpdf/fpdf.php');
require_once "../controladores/cobros.controlador.php";
require_once "../modelos/cobros.modelo.php";

// Obtener parámetros GET para el filtro
$fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : null;
$fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : null;
$estado = isset($_GET['estado']) ? $_GET['estado'] : 'todos';
$tipo_cobro = isset($_GET['tipo_cobro']) ? $_GET['tipo_cobro'] : 'todos';

// Llamar al controlador para obtener los datos filtrados
$cobros = ControladorCobro::ctrMostrarCobrosBaseF(null, null, $fecha_inicio, $fecha_fin, $estado, $tipo_cobro);

// Crear clase PDF personalizada
class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        $this->Image('../extensiones/logo-proyecto.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Reporte de Cobro Base'), 0, 1, 'C');
        $this->Ln(10);
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear el objeto PDF con orientación horizontal (landscape)
$pdf = new PDF('L', 'mm', 'A4'); // 'L' indica Landscape
$pdf->AddPage();

// Si hay datos, generar el PDF
if (!empty($cobros)) {
    // Encabezado de la tabla
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(20, 7, 'No Cobro', 1);
    $pdf->Cell(62, 7, 'Nombre Usuario', 1);
    $pdf->Cell(28, 7, 'No Contador', 1);
    $pdf->Cell(72, 7, 'Detalle', 1);
    $pdf->Cell(28, 7, 'Monto A Pagar', 1);
    $pdf->Cell(23, 7, 'Fecha Cobro', 1);
    $pdf->Cell(22, 7, 'Estado', 1);
    $pdf->Cell(22, 7, 'Tipo Cobro', 1);
    $pdf->Ln();

    // Cuerpo de la tabla
    $pdf->SetFont('Arial', '', 8);
    foreach ($cobros as $row) {
        $pdf->Cell(20, 7, $row['idcobro_base'], 1);
        $pdf->Cell(62, 7, utf8_decode($row['nombre_usuario']), 1);
        $pdf->Cell(28, 7, $row['no_contador'], 1);
        $pdf->Cell(72, 7, utf8_decode($row['detalle']), 1);
        $pdf->Cell(28, 7, 'Q' . number_format($row['monto_base'], 2), 1);
        $pdf->Cell(23, 7, date('d/m/Y', strtotime($row['fecha_cobro'])), 1);
        $pdf->Cell(22, 7, utf8_decode($row['estado_cobro']), 1);
        $pdf->Cell(22, 7, utf8_decode($row['tipo_cobro']), 1);
        $pdf->Ln();
    }
} else {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'No se encontraron resultados para los filtros aplicados.', 0, 1, 'C');
}

// Salida del PDF
$pdf->Output();
?>
