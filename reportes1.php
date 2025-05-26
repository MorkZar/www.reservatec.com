<?php
ob_start();
require('fpdf/fpdf.php');
require('conexionBD.php');

// Recibir fechas desde formulario
$desde = mysqli_real_escape_string($conexion, $_POST['desde']);
$hasta = mysqli_real_escape_string($conexion, $_POST['hasta']);

// Clase extendida de FPDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->Image('imagenes/logotecnm.png', 10, 8, 33);
        $this->Image('imagenes/logoits.png', 167, 8, 20);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(55);
        $this->Cell(80, 10, 'Reporte de Eventos', 1, 0, 'C');
        $this->Ln(20);

        // Encabezado de la tabla
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(20, 10, 'Id Reserva', 1, 0, 'C');
        $this->Cell(30, 10, 'Lugar', 1, 0, 'C');
        $this->Cell(40, 10, 'Evento', 1, 0, 'C');
        $this->Cell(22, 10, 'Fecha', 1, 0, 'C');
        $this->Cell(20, 10, 'Hora Inicio', 1, 0, 'C');
        $this->Cell(22, 10, 'Hora Fin', 1, 0, 'C');
        $this->Cell(36, 10, 'Detalles', 1, 1, 'C');
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Consulta
$consulta = "SELECT id_peticion, id_espacio, id_usuario, nombreEvento, fecha, hora_inicio, hora_fin, peticion
             FROM peticiones
             WHERE estado_peticion = 'Aceptada'
             AND fecha BETWEEN '$desde' AND '$hasta'";

$resultado = $conexion->query($consulta);
// Verificar si hay resultados antes de generar el PDF
if ($resultado->num_rows === 0) {
    echo "<script>alert('No se encontraron registros en el periodo seleccionado.'); window.history.back();</script>";
    exit;
}

// Crear PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);

while ($row = $resultado->fetch_assoc()) {
    $idEspacio = $row['id_espacio'];
    $nombreEspacio = 'Desconocido';

    $espacioQuery = $conexion->query("SELECT nombre_espacio FROM espacios WHERE id_espacio = $idEspacio");
    if ($espacio = $espacioQuery->fetch_assoc()) {
        $nombreEspacio = $espacio['nombre_espacio'];
    }

    $fecha = date("d/m/Y", strtotime($row['fecha']));
    $horaInicio = date("H:i", strtotime($row['hora_inicio']));
    $horaFin = date("H:i", strtotime($row['hora_fin']));

    // Guarda posición Y inicial
    $y = $pdf->GetY();
    $startX = $pdf->GetX();

    $pdf->Cell(20, 10, $row['id_peticion'], 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_decode($nombreEspacio), 1, 0, 'L');
    $pdf->Cell(40, 10, utf8_decode($row['nombreEvento']), 1, 0, 'L');
    $pdf->Cell(22, 10, $fecha, 1, 0, 'C');
    $pdf->Cell(20, 10, $horaInicio, 1, 0, 'C');
    $pdf->Cell(22, 10, $horaFin, 1, 0, 'C');

    // Multicell para detalles
    $x = $pdf->GetX();
    $yBefore = $pdf->GetY();
    $pdf->MultiCell(36, 5, utf8_decode($row['peticion']), 1, 'L');

    // Ajustar altura en caso de salto de línea
    $yAfter = $pdf->GetY();
    $diff = $yAfter - $yBefore;
    if ($diff < 10) {
        $pdf->SetXY($x + 36, $y);
    }
}

// Cerrar y enviar PDF
ob_end_clean();
$pdf->Output();
exit;
?>

