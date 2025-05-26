<?php
include 'conexionBD.php';
session_start();

$usuario = $_SESSION['usuario']; 
if (!isset($_SESSION['usuario'])) {
    header("location: inicioSesion1.php");
    session_destroy();
    exit;
}

// Obtener el id_usuario del correo
$query3 = "SELECT id_usuario FROM usuarios WHERE correo = '$usuario'"; 
$result3 = $conexion->query($query3);

if ($result3 && $result3->num_rows > 0) {
    $row = $result3->fetch_assoc();
    $id_usuario = $row['id_usuario']; 
} else {
    echo "<p>No se encontró el solicitante</p>";
    exit;
}

// Obtener datos del formulario
$idespacio = $_POST['espacio'];
$nombreEvento = $_POST['nombreEvento'];
$fecha = $_POST['fecha'];
$horai = $_POST['horai'];
$horaf = $_POST['horaf'];
$detalles = $_POST['detalles'];

// Validaciones de hora (antes de insertar)
$horaInicio = strtotime($horai);
$horaFin = strtotime($horaf);
$horaMinima = strtotime("07:00");
$horaMaxima = strtotime("20:00");

if ($horaInicio >= $horaFin) {
    header("Location: peticiones.php?mensaje1=back");
  exit;
}

if (
    $horaInicio < $horaMinima || $horaInicio > $horaMaxima ||
    $horaFin < $horaMinima || $horaFin > $horaMaxima
) {
  header("Location: peticiones.php?mensaje2=back1");
  exit;
}

// Validar que la fecha no sea pasada
$fechaActual = date("Y-m-d");

if ($fecha < $fechaActual) {
    header("Location: peticiones.php?mensaje3=fechaPasada");
    exit;
}

// Validar que se reserve con al menos 3 días de anticipación
$fechaLimite = date("Y-m-d", strtotime($fechaActual . " +3 days"));
if ($fecha < $fechaLimite) {
    header("Location: peticiones.php?mensaje4=anticipacionInsuficiente");
    exit;
}

$queryValidacion = "
    SELECT * FROM peticiones 
    WHERE id_espacio = '$idespacio' 
      AND fecha = '$fecha' 
      AND estado_peticion = 'Aceptada'
      AND (
            (hora_inicio < '$horaf' AND hora_fin > '$horai')
          )
";

$resultValidacion = mysqli_query($conexion, $queryValidacion);

if (mysqli_num_rows($resultValidacion) > 0) {
    // Ya hay una reserva aceptada que choca con este horario
    header("Location: peticiones.php?mensaje5=ocupado");
    exit;
}

// Validar si la fecha es sábado (6) o domingo (7)
$diaSemana = date('N', strtotime($fecha));

if ($diaSemana == 6 || $diaSemana == 7) {
    header("Location: peticiones.php?mensaje7=finDeSemana");
    exit;
}

// ✅ Días no laborales fijos (solo día y mes, ignorando el año)
$diasNoLaborables = [
    '02-03', // Constitucion Mexicana
    '03-17', // Natalicio de Benito Juarez
    '09-16', // Independencia
    '05-01', // Día del Trabajo
    '05-05', // Batalla de Puebla
    '05-15', //Dia del Maestro
    '09-16', //Dia de la Independencia 
    '11-17', //Dia de la Revolucion
    '04-14', //Vacaciones Semana Santa
    '04-15', //Vacaciones Semana Santa
    '04-16', //Vacaciones Semana Santa
    '04-17', //Vacaciones Semana Santa
    '04-18', //Vacaciones Semana Santa
    '04-21', //Vacaciones Semana Santa
    '04-22', //Vacaciones Semana Santa
    '04-23', //Vacaciones Semana Santa
    '04-24', //Vacaciones Semana Santa
    '04-25', //Vacaciones Semana Santa
    '12-14', //Vacaciones Invierno
    '12-15', //Vacaciones Invierno
    '12-16', //Vacaciones Invierno
    '12-17', //Vacaciones Invierno
    '12-18', //Vacaciones Invierno
    '12-19', //Vacaciones Invierno
    '12-20', //Vacaciones Invierno
    '12-21', //Vacaciones Invierno
    '12-22', //Vacaciones Invierno
    '12-23', //Vacaciones Invierno
    '12-24', //Vacaciones Invierno
    '12-25', //Vacaciones Invierno
    '12-26', //Vacaciones Invierno
    '12-27', //Vacaciones Invierno
    '12-28', //Vacaciones Invierno
    '12-29', //Vacaciones Invierno
    '12-30', //Vacaciones Invierno
    '12-31', //Vacaciones Invierno
    '01-01', //Vacaciones Invierno
    '01-02', //Vacaciones Invierno
    '01-03', //Vacaciones Invierno
    '01-04', //Vacaciones Invierno
    '01-05', //Vacaciones Invierno
    '01-06', //Vacaciones Invierno
    '01-07', //Vacaciones Invierno
    '01-08', //Vacaciones Invierno
    '01-09', //Vacaciones Invierno
    '01-10', //Vacaciones Invierno
    '01-11', //Vacaciones Invierno
    '01-12', //Vacaciones Invierno
    '01-13', //Vacaciones Invierno
    '01-14', //Vacaciones Invierno
    '01-15', //Vacaciones Invierno
    '01-16', //Vacaciones Invierno
    '01-17', //Vacaciones Invierno
    '01-18', //Vacaciones Invierno
    '01-19', //Vacaciones Invierno
    '01-20', //Vacaciones Invierno
    '01-21', //Vacaciones Invierno
    '01-22', //Vacaciones Invierno
    '01-23', //Vacaciones Invierno
    '01-24', //Vacaciones Invierno
    '01-25', //Vacaciones Invierno   
];

// Obtener solo el día y mes de la fecha ingresada
$fechaIngresada = date("m-d", strtotime($fecha));

// Verificar si la fecha ingresada es no laborable
if (in_array($fechaIngresada, $diasNoLaborables)) {
    header("Location: peticiones.php?mensaje6=fechaNoLaborable");
    exit;
}

// ✅ Validar si la fecha está dentro de junio o julio y es de lunes a viernes
$mes = date("m", strtotime($fecha));  // Extraer mes de la fecha

// Validar si el mes es junio (06) o julio (07) y si es entre lunes (1) y viernes (5)
if (($mes == "06" || $mes == "07")) {
    // La fecha está en junio o julio y es entre lunes y viernes (no laboral)
    header("Location: peticiones.php?mensaje6=fechaNoLaborable");
    exit;
}

// Iniciar la transacción
mysqli_begin_transaction($conexion);
try {
    $query1 = "INSERT INTO peticiones (id_espacio, id_usuario, nombreevento, fecha, hora_inicio, hora_fin, peticion)
               VALUES ('$idespacio', '$id_usuario','$nombreEvento', '$fecha', '$horai', '$horaf', '$detalles')";

    if (!mysqli_query($conexion, $query1)) {
        throw new Exception("Error al realizar la petición.");
    }

    // Confirmar la transacción
    mysqli_commit($conexion);

    // Redirigir si la inserción fue exitosa
    header("Location: peticiones.php?mensaje=success");
    exit;
} catch (Exception $e) {
    // Revertir los cambios si ocurre un error
    mysqli_rollback($conexion);

    // Mostrar el error
    echo '
    <script>
    alert("Error: ' . $e->getMessage() . '");
    window.history.back();
    </script>
    ';
}

// Cerrar la conexión
mysqli_close($conexion);
?>
