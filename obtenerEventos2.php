<?php
include 'conexionBD.php';
session_start();

$sql = "SELECT id_espacio, id_usuario, nombreEvento, fecha, hora_inicio, hora_fin, peticion, estado_peticion 
        FROM peticiones 
        WHERE estado_peticion = 'Aceptada'";


$query = $conexion->prepare($sql);
$query->execute();
$result = $query->get_result(); // necesario para usar fetch_assoc()
$resultado = [];
while ($row = $result->fetch_assoc()) {
    $resultado[] = $row;
}
$eventos = [];

foreach ($resultado as $row) {

// Asignar color según el id_espacio
switch ($row['id_espacio']) {
    case 1: // Auditorio
        $color = 'purple'; // Color morado
        break;
    case 2: // Centro de Cómputo
        $color = 'yellow'; // Color amarillo
        break;
    case 3: // Aula A1
        $color = 'green'; // Color verde
        break;
    case 4: // Cafetería
        $color = 'red'; // Color rojo
        break;
    case 5: // Lobby
        $color = 'orange'; // Color naranja
        break;
    default:
        $color = 'gray'; // Color por defecto si no coincide
        break;
}

$eventos[] = [
    'title' => $row['nombreEvento'],
    'start' => $row['fecha'] . 'T' . $row['hora_inicio'],
    'end' => $row['fecha'] . 'T' . $row['hora_fin'],
    'extendedProps' => [
        'descripcion' => $row['peticion']
    ],
    'color' => $color // Asignamos el color aquí
];
}


header('Content-Type: application/json');
echo json_encode($eventos);
?>