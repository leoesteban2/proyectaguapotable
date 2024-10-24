<?php
// Definimos la función AddText para agregar texto con mayor control
function AddText($pdf, $text, $x, $y, $align, $font, $style, $size, $r = 0, $g = 0, $b = 0, $border = 0, $lineHeight = 10) {
    $pdf->SetXY($x, $y);
    $pdf->SetTextColor($r, $g, $b);
    $pdf->SetFont($font, $style, $size);
    $pdf->MultiCell(0, $lineHeight, $text, $border, $align);
}

// Incluimos la librería FPDF y los controladores/modelos
require('../extensiones/fpdf/fpdf.php');
require_once "../controladores/cobros.controlador.php";
require_once "../modelos/cobros.modelo.php";

// Evitar salida antes de generar el PDF
ob_start();

// Obtener el idCobro de la URL
$idCobro = isset($_GET['idCobro']) ? $_GET['idCobro'] : null;

// Llamar a la función para obtener los datos del cobro
$cobroData = ControladorCobro::ctrMostrarCobro('idcobro_base', $idCobro);

// Verificar si se obtuvieron datos
if ($cobroData) {
    // Si obtenemos múltiples registros, seleccionamos el primero
    $cobro = is_array($cobroData) && isset($cobroData[0]) ? $cobroData[0] : $cobroData;

    // Crear el PDF para el ticket de cobro en tamaño POS
    $pdf = new FPDF('P', 'mm', [80, 100]); // Ticket tamaño 80mm x 100mm
    $pdf->AddPage();
    $pdf->SetCreator('Sistema de Agua');

    // Agregar la imagen en la parte superior del ticket
    $pdf->Image('../extensiones/logo-proyecto.png', 10, 4, 50); // Cambia las coordenadas y el tamaño si es necesario

    // Ajustar los márgenes y la alineación del texto
    $pdf->SetY(60); // Establece el margen vertical para que el texto quede debajo de la imagen
    $pdf->SetFont('Arial', 'B', 12);

    // Título del ticket dividido en dos líneas con letra grande
    AddText($pdf, 'TICKET DE COBRO', 5, 10, 'C', 'Arial', 'B', 10, 0, 0, 0);

    // Número del Cobro
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 25);
    $pdf->Cell(25, 5, "No. Cobro:", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, $cobro['idcobro_base'], 0, 1, 'L');

    // Nombre del usuario
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 30);
    $pdf->Cell(14, 5, "Nombre:", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(50, 5, strtoupper($cobro['nombres'] . ' ' . $cobro['apellidos']), 0, 1, 'L');

    // Detalle del cobro
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 35);
    $pdf->Cell(12, 5, "Cobro:", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(20, 5, utf8_decode($cobro['detalle']), 0, 1, 'L');

    // Monto a pagar
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 40);
    $pdf->Cell(25, 5, "Monto a pagar:", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, "Q " . number_format($cobro['monto_base'], 2), 0, 1, 'L');

    // Estado del cobro
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 45);
    $pdf->Cell(15, 5, "Estado:", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, ucfirst($cobro['estado_cobro']), 0, 1, 'L');

    // Fecha del cobro
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(5, 50);
    $pdf->Cell(23, 5, "Fecha cobro:", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, date('d/m/Y', strtotime($cobro['fecha_cobro'])), 0, 1, 'L');

    // Línea de agradecimiento
    $pdf->SetXY(5, 65);
    AddText($pdf, 'Gracias por su preferencia!', 5, 65, 'C', 'Arial', '', 10);
    // Limpiar el buffer antes de enviar el PDF
    ob_end_clean();

    // Salida del PDF
    $pdf->Output();
} else {
    echo "No se encontraron datos para el cobro.";
}

?>
