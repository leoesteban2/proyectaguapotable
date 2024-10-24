<?php
require('../extensiones/fpdf/fpdf.php');
require_once "../controladores/lectura.controlador.php";
require_once "../modelos/lectura.modelo.php";

// Obtener parámetros GET para el filtro
$fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : null;
$fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : null;

// Llamar al controlador para obtener los datos filtrados
$lecturas = ControladorLectura::ctrMostrarLecturasF(null, null, $fecha_inicio, $fecha_fin);

// Crear clase PDF personalizada
class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        $this->Image('../extensiones/logo-proyecto.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Reporte de Lecturas'), 0, 1, 'C');
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
if (!empty($lecturas)) {
    // Encabezado de la tabla
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(20, 7, 'No Lectura', 1);
    $pdf->Cell(18, 7, 'No Orden', 1);
    $pdf->Cell(73, 7, 'Nombre Usuario', 1);
    $pdf->Cell(30, 7, 'No Contador', 1);
    $pdf->Cell(30, 7, 'Lectura Anterior', 1);
    $pdf->Cell(30, 7, 'Lectura Actual', 1);
    $pdf->Cell(20, 7, 'Consumo', 1);
    $pdf->Cell(26, 7, 'Fecha Lectura', 1);
    $pdf->Ln();


// Cuerpo de la tabla
$pdf->SetFont('Arial', '', 9);
foreach ($lecturas as $row) {
    $pdf->Cell(20, 7, $row['idlectura'], 1);
    $pdf->Cell(18, 7, $row['no_orden'], 1);
    $pdf->Cell(73, 7, utf8_decode($row['nombre_usuario']), 1);
    $pdf->Cell(30, 7, $row['no_contador'], 1);
    $pdf->Cell(30, 7, $row['lectura_anterior'], 1); // Formato de lectura anterior
    $pdf->Cell(30, 7, $row['lectura_actual'], 1);  // Formato de lectura actual
    $pdf->Cell(20, 7, $row['consumo'], 1);         // Formato de consumo
    $pdf->Cell(26, 7, date('d/m/Y', strtotime($row['fecha_lectura'])), 1);
    $pdf->Ln();
}
} else {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'No se encontraron resultados para los filtros aplicados.', 0, 1, 'C');
}

// Salida del PDF
$pdf->Output();
?>
