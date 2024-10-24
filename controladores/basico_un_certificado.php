<?php
// Verificar si la librería FPDF existe
if (!file_exists('../vistas/plugins/fpdf/fpdf.php')) {
    die('La librería FPDF no se encuentra en la ruta especificada.');
}

// Incluir la librería FPDF
require('../vistas/plugins/fpdf/fpdf.php');

// Verificar si la imagen de fondo existe
if (!file_exists('../img/fondo.jpg')) {
    die('La imagen de fondo no se encuentra en la ruta especificada.');
}

function AddText($pdf, $text, $x, $y, $a, $f, $t, $s, $r, $g, $b) {
    $pdf->SetFont($f,$t,$s);	
    $pdf->SetXY($x,$y);
    $pdf->SetTextColor($r,$g,$b);
    $pdf->Cell(0,10,$text,0,0,$a);	
}

// Creamos la hoja A4 para el certificado
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetCreator('Milor');

// Agregamos la imagen de fondo a PDF
$pdf->Image('../img/fondo.jpg',0,0,0);	

// Agregamos nombre a los certificados dinámicos
AddText($pdf, ucwords('Dario Garza'), 0,80, 'C', 'Helvetica', 'B', 30, 3, 84, 156);

$pdf->Output();

?>