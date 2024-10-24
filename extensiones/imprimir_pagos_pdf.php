<?php
require('../extensiones/fpdf/fpdf.php');
require_once "../controladores/pagos.controlador.php";
require_once "../modelos/pagos.modelo.php";

// Obtener parámetros GET para el filtro
$fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : null;
$fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : null;
$tipo_pago = isset($_GET['tipo_pago']) ? $_GET['tipo_pago'] : 'todos';

// Llamar al controlador para obtener los datos filtrados
$pagos = ControladorPagos::ctrMostrarPagosF(null, null, $fecha_inicio, $fecha_fin, $tipo_pago);

// Crear clase PDF personalizada
class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        $this->Image('../extensiones/logo-proyecto.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Reporte de Pagos'), 0, 1, 'C');
        $this->Ln(10);
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    // Función para calcular la altura de la celda más alta en una fila
    function RowHeight($text, $width) {
        $nb = $this->NbLines($width, $text);
        return 6 * $nb;  // El alto por cada línea es de 6 unidades
    }

    // Método para obtener el número de líneas que ocupará el texto
    function NbLines($width, $text) {
        $cw = &$this->CurrentFont['cw'];
        if ($width == 0) {
            $width = $this->w - $this->rMargin - $this->x;
        }
        $wmax = ($width - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $text);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] == "\n") {
            $nb--;
        }
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ') {
                $sep = $i;
            }
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j) {
                        $i++;
                    }
                } else {
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else {
                $i++;
            }
        }
        return $nl;
    }
}

// Crear el objeto PDF con orientación horizontal (landscape)
$pdf = new PDF('L', 'mm', 'A4'); // 'L' indica Landscape
$pdf->AddPage();

// Si hay datos, generar el PDF
if (!empty($pagos)) {
    // Encabezado de la tabla
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(15, 7, 'No Pago', 1);
    $pdf->Cell(55, 7, 'Nombre Usuario', 1);
    $pdf->Cell(28, 7, 'No Contador', 1);
    $pdf->Cell(20, 7, 'No. Exceso', 1);
    $pdf->Cell(19, 7, 'No. Cobro', 1);
    $pdf->Cell(72, 7, 'Detalle', 1);
    $pdf->Cell(28, 7, 'Monto Pagado', 1);
    $pdf->Cell(22, 7, 'Fecha Pago', 1);
    $pdf->Cell(22, 7, 'Tipo de Pago', 1);
    $pdf->Ln();

    // Cuerpo de la tabla
    $pdf->SetFont('Arial', '', 8);
    foreach ($pagos as $row) {
        // Calcular la altura máxima de la fila
        $detalleHeight = $pdf->RowHeight(utf8_decode($row['detalle']), 72); // Ajusta el ancho al de la celda "Detalle"
        $maxHeight = max($detalleHeight, 6);  // Al menos 6 de alto para las otras celdas

        // Imprimir cada celda con la misma altura máxima
        $pdf->Cell(15, $maxHeight, $row['idpago'], 1);
        $pdf->Cell(55, $maxHeight, utf8_decode($row['nombre_usuario']), 1);
        $pdf->Cell(28, $maxHeight, $row['no_contador'], 1);
        $pdf->Cell(20, $maxHeight, $row['idcobro'], 1);
        $pdf->Cell(19, $maxHeight, $row['idcobro_base'], 1);

        // Imprimir la celda de detalle con MultiCell para que ajuste su altura automáticamente
        $x = $pdf->GetX();  // Guardar la posición x actual
        $y = $pdf->GetY();  // Guardar la posición y actual
        $pdf->MultiCell(72, 6, utf8_decode($row['detalle']), 1);
        $pdf->SetXY($x + 72, $y);  // Ajustar la posición para el resto de las celdas

        $pdf->Cell(28, $maxHeight, 'Q' . number_format($row['monto_pagado'], 2), 1);
        $pdf->Cell(22, $maxHeight, date('d/m/Y', strtotime($row['fecha_pago'])), 1);
        $pdf->Cell(22, $maxHeight, utf8_decode($row['tipo_pago']), 1);
        $pdf->Ln();
    }
} else {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'No se encontraron resultados para los filtros aplicados.', 0, 1, 'C');
}

// Salida del PDF
$pdf->Output();
?>
