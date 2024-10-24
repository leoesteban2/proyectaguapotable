<?php
require('../extensiones/fpdf/fpdf.php');
require_once "../controladores/exceso.controlador.php";
require_once "../modelos/exceso.modelo.php";

// Obtener parámetros GET para el filtro
$fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : null;
$fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : null;
$estado = isset($_GET['estado']) ? $_GET['estado'] : 'todos';

// Llamar al controlador para obtener los datos filtrados
$excesos = ControladorExceso::ctrMostrarExcesoF(null, null, $fecha_inicio, $fecha_fin, $estado);

// Crear clase PDF personalizada
class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        // Agregar un logo o título en el encabezado
        $this->Image('../extensiones/logo-proyecto.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Reporte de Cobros por Exceso'), 0, 1, 'C');
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
        return 6 * $nb;  // El alto por cada línea es 6 unidades
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
if (!empty($excesos)) {
    // Encabezado de la tabla
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(18, 7, 'No Exceso', 1);
    $pdf->Cell(55, 7, 'Nombre Usuario', 1);
    $pdf->Cell(30, 7, 'No Contador', 1);
    $pdf->Cell(70, 7, 'Detalle', 1);
    $pdf->Cell(25, 7, 'Total Exceso', 1);
    $pdf->Cell(27, 7, 'Total a Pagar', 1);
    $pdf->Cell(24, 7, 'Fecha Cobro', 1);
    $pdf->Cell(25, 7, 'Estado Cobro', 1);
    $pdf->Ln();

    // Cuerpo de la tabla
    $pdf->SetFont('Arial', '', 8);
    foreach ($excesos as $row) {
        // Calcular la altura máxima de la fila
        $detalleHeight = $pdf->RowHeight(utf8_decode($row['detalle']), 70);
        $nombreHeight = $pdf->RowHeight(utf8_decode($row['nombre_usuario']), 55);
        $maxHeight = max($detalleHeight, $nombreHeight, 6);  // Al menos 6 de alto para las otras celdas

        // Imprimir cada celda con la misma altura máxima
        $pdf->Cell(18, $maxHeight, $row['idcobro'], 1);
        $pdf->Cell(55, $maxHeight, utf8_decode($row['nombre_usuario']), 1);
        $pdf->Cell(30, $maxHeight, $row['no_contador'], 1);

        // Imprimir la celda de detalle con MultiCell
        $x = $pdf->GetX();  // Guardar la posición x actual
        $y = $pdf->GetY();  // Guardar la posición y actual
        $pdf->MultiCell(70, 6, utf8_decode($row['detalle']), 1);
        $pdf->SetXY($x + 70, $y);  // Ajustar la posición para el resto de las celdas

        $pdf->Cell(25, $maxHeight, $row['total_exceso'], 1);
        $pdf->Cell(27, $maxHeight, 'Q' . number_format($row['total_a_pagar'], 2), 1);
        $pdf->Cell(24, $maxHeight, date('d/m/Y', strtotime($row['fecha_cobro'])), 1);
        $pdf->Cell(25, $maxHeight, utf8_decode($row['estado_cobro']), 1);
        $pdf->Ln();
    }
} else {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'No se encontraron resultados para los filtros aplicados.', 0, 1, 'C');
}

// Salida del PDF
$pdf->Output();
?>
