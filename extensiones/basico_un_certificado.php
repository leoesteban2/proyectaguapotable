<?php
// Definimos la función AddText
function AddText($pdf, $text, $x, $y, $align, $font, $style, $size, $r = 0, $g = 0, $b = 0, $border = 0, $lineHeight = 10) {
    // Establecemos la posición del texto
    $pdf->SetXY($x, $y);
    // Establecemos el color
    $pdf->SetTextColor($r, $g, $b);
    // Establecemos la fuente
    $pdf->SetFont($font, $style, $size);
    // Agregamos el texto
    $pdf->MultiCell(0, $lineHeight, $text, $border, $align);
}

// Incluimos la librería para generar el PDF
require('../extensiones/fpdf/fpdf.php');
require_once "../controladores/certificado.controlador.php";
require_once "../modelos/certificado.modelo.php";

// Obtener el idTitulo de la URL
$idTitulo = isset($_GET['idTitulo']) ? $_GET['idTitulo'] : null;

// Llamar a la función para obtener los datos del certificado
$certificadoData = ModeloCertificado::mdlMostrarCertificado('titulo_propiedad', 'idtitulo', $idTitulo);

// Verificar si se obtuvieron datos
if ($certificadoData) {
    // Crear la hoja A4 para el certificado
    $pdf = new FPDF('P', 'mm', 'Letter');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetCreator('Milor');
    
    // Agregar la imagen de fondo a PDF
    $pdf->Image('../extensiones/1.png', 0, 0, 215.9, 279.4); 

    
// Nombre del beneficiario
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetXY(25, 60);
$pdf->Cell(25, 10, "Nombre:", 0, 0, 'L');
$pdf->SetFont('Arial', '', 15);
$pdf->Cell(50, 10, strtoupper($certificadoData['nombres'] . ' ' . $certificadoData['apellidos']), 0, 1, 'L');

// Título No.
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetXY(135, 70);
$pdf->Cell(40, 10, "TITULO No.", 0, 0, 'R');
$pdf->SetTextColor(255, 0, 0); // Color rojo para el número
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(25, 10, $certificadoData['no_titulo'], 0, 1, 'L');
$pdf->SetTextColor(0, 0, 0); // Volver al color negro

// DPI
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetXY(25, 80);
$pdf->Cell(14, 10, "DPI:", 0, 0, 'L');
$pdf->SetFont('Arial', '', 15);
$pdf->Cell(130, 10, $certificadoData['dpi'], 0, 1, 'L');

// Fecha
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetXY(120, 80);
$pdf->Cell(40, 10, "Fecha:", 0, 0, 'R');
$pdf->SetFont('Arial', '', 15);
$pdf->Cell(25, 10, date('d/M/Y', strtotime($certificadoData['fecha'])), 0, 1, 'L');

// Segunda página
$pdf->AddPage();
    
// Agregar la imagen de fondo a la segunda página (si es necesario)
$pdf->Image('../extensiones/2.png', 0, 0, 215.9, 279.4); 



    // Salida del PDF
    $pdf->Output();
} else {
    echo "No se encontraron datos para el certificado.";
}
?>
