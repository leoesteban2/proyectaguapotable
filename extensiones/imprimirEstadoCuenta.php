<?php
require('../extensiones/fpdf/fpdf.php');  // Asegúrate de que la ruta sea correcta
require_once "../controladores/estadocuenta.controlador.php";
require_once "../modelos/estadocuenta.modelo.php";

// Crear clase PDF personalizada
class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        // Agregar la imagen en la parte superior del ticket
        $this->Image('../extensiones/logo-proyecto.png', 10, 4, 50); // Ajusta las coordenadas y el tamaño según sea necesario
        
        // Encabezado con el nombre del consejo
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, utf8_decode('CONSEJO COMUNITARIO COCODE'), 0, 1, 'C');
        $this->Cell(0, 5, utf8_decode('SECTOR #3'), 0, 1, 'C');
        $this->Cell(0, 5, utf8_decode('BARRIO LA LIBERTAD'), 0, 1, 'C');
        $this->Cell(0, 5, utf8_decode('JOYABAJ QUICHÉ.'), 0, 1, 'C');
        $this->Cell(0, 10, utf8_decode('ESTADO DE CUENTA.'), 0, 1, 'C');
        $this->Ln(10); // Espacio entre el título y el contenido principal
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, '"Proyecto Agua Potable Sector III"', 0, 0, 'C');
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

// Crear el objeto PDF
$pdf = new PDF();
$pdf->AddPage();

// Obtener el No. Orden desde la URL
$noOrden = isset($_GET['noOrden']) ? $_GET['noOrden'] : null;

// Llamar al controlador para obtener el estado de cuenta
$estadoCuenta = ControladorEstadoCuenta::ctrMostrarEstadoCuenta($noOrden);

// Si se encuentra información, generar el contenido del PDF
if ($estadoCuenta) {
    // Información del encabezado del estado de cuenta
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 10, 'No. Orden: ' . $estadoCuenta[0]['no_orden']);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Nombre: ' . $estadoCuenta[0]['nombre']);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'No. Contador: ' . $estadoCuenta[0]['no_contador']);
    $pdf->Ln(10); // Espacio después de la información principal

    // Encabezado de la tabla
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(30, 7, 'Fecha', 1);
    $pdf->Cell(20, 7, 'Documento', 1);
    $pdf->Cell(80, 7, 'Detalle', 1);
    $pdf->Cell(22, 7, 'Cargo', 1);
    $pdf->Cell(22, 7, 'Abono', 1);
    $pdf->Cell(22, 7, 'Saldo', 1);
    $pdf->Ln();

    // Cuerpo de la tabla
    $pdf->SetFont('Arial', '', 9);
    foreach ($estadoCuenta as $row) {
        // Calcular la altura máxima de la fila
        $detalleHeight = $pdf->RowHeight(utf8_decode($row['detalle']), 80);
        $maxHeight = max($detalleHeight, 6);  // Al menos 6 de alto para las otras celdas

        // Imprimir cada celda con la misma altura máxima
        $pdf->Cell(30, $maxHeight, date('d/m/Y', strtotime($row['fecha'])), 1);
        $pdf->Cell(20, $maxHeight, $row['No.Documento'], 1);
        $x = $pdf->GetX();  // Guardar la posición x actual
        $y = $pdf->GetY();  // Guardar la posición y actual

        // Imprimir la celda de detalle con MultiCell
        $pdf->MultiCell(80, 6, utf8_decode($row['detalle']), 1);
        $pdf->SetXY($x + 80, $y);  // Ajustar la posición para el resto de las celdas

        $pdf->Cell(22, $maxHeight, 'Q ' . number_format($row['cargo'], 2), 1);
        $pdf->Cell(22, $maxHeight, 'Q ' . number_format($row['abono'], 2), 1);
        $pdf->Cell(22, $maxHeight, 'Q ' . number_format($row['saldo'], 2), 1);
        $pdf->Ln();
    }
} else {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'No se encontró el estado de cuenta para el No. Orden: ' . $noOrden, 0, 1, 'C');
}

// Salida del PDF
$pdf->Output();
