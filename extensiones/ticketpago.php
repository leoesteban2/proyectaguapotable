<?php

// Definimos la función AddText para agregar texto con mayor control
function AddText($pdf, $text, $x, $y, $align, $font, $style, $size, $r = 0, $g = 0, $b = 0, $border = 0, $lineHeight = 10) {
    $pdf->SetXY($x, $y);
    $pdf->SetTextColor($r, $g, $b);
    $pdf->SetFont($font, $style, $size);
    $pdf->MultiCell(0, $lineHeight, utf8_decode($text), $border, $align);
}

// Incluimos la librería FPDF y los controladores/modelos
require('../extensiones/fpdf/fpdf.php');
require_once "../controladores/pagos.controlador.php";
require_once "../modelos/pagos.modelo.php";

// Evitar salida antes de generar el PDF
ob_start();

// Obtener el idPago de la URL
$idPago = isset($_GET['idPago']) ? $_GET['idPago'] : null;

// Llamar a la función para obtener los datos del pago
$pagoData = ControladorPagos::ctrMostrarPagos('idpago', $idPago);

// Verificar si se obtuvieron datos
if ($pagoData) {
    // Crear el PDF para el ticket de pago en tamaño POS
    $pdf = new FPDF('P', 'mm', [80, 130]); // Ticket tamaño 80mm x 130mm
    $pdf->AddPage();
    $pdf->SetCreator('Sistema de Agua');

     // Agregar la imagen en la parte superior del ticket
     $pdf->Image('../extensiones/logo-proyecto.png', 10, 4, 50); // Cambia las coordenadas y el tamaño si es necesario

    // Encabezado con el nombre del consejo
    AddText($pdf, 'CONSEJO COMUNITARIO COCODE', 5, 10, 'C', 'Arial', 'B', 10);
    AddText($pdf, 'SECTOR #3', 5, 15, 'C', 'Arial', 'B', 9);
    AddText($pdf, 'BARRIO LA LIBERTAD', 5, 20, 'C', 'Arial', 'B', 9);
    AddText($pdf, 'JOYABAJ QUICHÉ.', 5, 25, 'C', 'Arial', 'B', 9);
    AddText($pdf, 'COMPROBANTE DE PAGO -', 5, 30, 'C', 'Arial', 'B', 9);
    AddText($pdf, 'SERVICIO DE AGUA POTABLE', 5, 35, 'C', 'Arial', 'B', 9);

    // FECHA
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 45);
    $pdf->Cell(12, 5, "Fecha:", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(10, 5,date('d/m/Y', strtotime($pagoData['fecha_pago'])), 0, 1, 'L');
    

    // No. Pago
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 50);
    $pdf->Cell(25, 5, "No. Pago:", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, $pagoData['idpago'], 0, 1, 'L');
    
    // No. Orden
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 55);
    $pdf->Cell(25, 5, "No. Orden:", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, $pagoData['no_orden'], 0, 1, 'L');

    // Nombre del usuario
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 60);
    $pdf->Cell(25, 5, "Nombre:", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, strtoupper($pagoData['nombres'] . ' ' . $pagoData['apellidos']), 0, 1, 'L');

    // No. Contador
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 65);
    $pdf->Cell(25, 5, "No. Contador:", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, $pagoData['no_contador'], 0, 1, 'L');

    // ID del cobro
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 70);
    $pdf->Cell(25, 5, "ID Cobro:", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, $pagoData['idcobro'] ? $pagoData['idcobro'] : $pagoData['idcobro_base'], 0, 1, 'L');

    // Descripción
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 75);
    $pdf->Cell(25, 5, utf8_decode("Pago por:"), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->MultiCell(0, 5, utf8_decode($pagoData['detalle']), 0, 'L'); // Uso de MultiCell para la descripción larga
    
    // Monto Pagado
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 91);
    $pdf->Cell(25, 5, "Monto Pagado:", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, "Q " . number_format($pagoData['monto_pagado'], 2), 0, 1, 'L');
    
    // Mensaje de agradecimiento
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetXY(5, 120);
    AddText($pdf, 'Gracias por su preferencia!', 5, 99, 'C', 'Arial', '', 10);
    
    // Limpiar el buffer antes de enviar el PDF
    ob_end_clean();

    // Salida del PDF
    $pdf->Output();
} else {
    echo "No se encontraron datos para el pago.";
}



?>
