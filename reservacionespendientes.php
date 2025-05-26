<?php
include 'conexionBD.php';
session_start();


$sql = "SELECT id_peticion,id_usuario, nombreEvento, fecha, id_espacio, hora_inicio, hora_fin, peticion, estado_peticion 
        FROM peticiones 
        WHERE estado_peticion = 'Procesando'";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reservaciones Pendientes</title>
  <link rel="stylesheet" href="css/reservacionesPen.css">
</head>
<body>
  <h1>Reservaciones Pendientes</h1>

  <table>
    <thead>
      <tr>
        <th>ID Reserva</th>
        <th>Reserva de:</th>
        <th>Fecha</th>
        <th>Nombre del Evento</th>
        <th>Lugar</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if ($resultado->num_rows === 0): ?>
        <tr>
          <td colspan="6" style="text-align:center; font-weight:bold;">No hay reservas pendientes</td>
        </tr>
      <?php else: 
      while ($row = $resultado->fetch_assoc()): ?>
      <?php
          // Consulta secundaria para obtener el nombre del espacio
          $idEspacio = $row['id_espacio'];
          $nombreEspacio = 'Desconocido';
          $espacioQuery = $conexion->query("SELECT nombre_espacio FROM espacios WHERE id_espacio = $idEspacio");
          if ($espacio = $espacioQuery->fetch_assoc()) {
            $nombreEspacio = $espacio['nombre_espacio'];
          }

          // Agregar nombre_espacio al array para mostrarlo con JS
          $row['nombre_espacio'] = $nombreEspacio;
          $info = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
        ?>
        <?php
          // Consulta secundaria para obtener el nombre del que hizo la reserva
          $idUsuario = $row['id_usuario'];
          $nombreUsuario = 'Desconocido';
          $usuarioQuery = $conexion->query("SELECT nombre,ap_paterno FROM usuarios WHERE id_usuario = $idUsuario");
          if ($usuario = $usuarioQuery->fetch_assoc()) {
            $nombreUsuario = $usuario['nombre'] . ' ' . $usuario['ap_paterno'];
          }

          // Agregar nombre_espacio al array para mostrarlo con JS
          $row['nombre'] = $nombreUsuario;
          $info = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
        ?>


        <tr onclick="mostrarInfo(this)" data-info='<?php echo json_encode($row); ?>'>
          <td><?php echo $row['id_peticion']; ?></td>
          <td><?php echo $row['nombre']; ?></td>
          <td><?php echo $row['fecha']; ?></td>
          <td><?php echo $row['nombreEvento']; ?></td>
          <td><?php echo $row['nombre_espacio']; ?></td>
          <td>
          <?php
  $fechaReserva = $row['fecha'];
  $fechaHoy = date('Y-m-d');
  $deshabilitarAceptar = ($fechaReserva < $fechaHoy);
?>
<button class="aceptar" onclick="cambiarEstado(event, <?php echo $row['id_peticion']; ?>, 'Aceptada')" <?php echo $deshabilitarAceptar ? 'disabled title="Fecha pasada"' : ''; ?>>Aceptar</button>

            <button class="rechazar" onclick="cambiarEstado(event, <?php echo $row['id_peticion']; ?>, 'Rechazada')">Rechazar</button>
          </td>
        </tr>
      <?php 
    endwhile;endif; ?>
    </tbody>
  </table>

  <div id="info"></div>

  <script>
    function mostrarInfo(row) {
      const data = JSON.parse(row.dataset.info);
      const div = document.getElementById('info');
      div.style.display = 'block';
      div.innerHTML = `
        <strong>ID Reserva:</strong> ${data.id_peticion}<br>
         <strong>Solicitante:</strong> ${data.nombre}<br>
        <strong>Nombre Evento:</strong> ${data.nombreEvento}<br>
        <strong>Fecha:</strong> ${data.fecha}<br>
        <strong>Hora Inicio:</strong> ${data.hora_inicio}<br>
        <strong>Hora Fin:</strong> ${data.hora_fin}<br>
        <strong>Espacio:</strong> ${data.nombre_espacio}<br>
        <strong>Detalles:</strong> ${data.peticion}<br>
      `;
    }

    function cambiarEstado(event, idPeticion, nuevoEstado) {
      event.stopPropagation(); // evita que se dispare el evento de mostrar info
      fetch('actualizar_estado.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id=${idPeticion}&estado=${nuevoEstado}`
      })
      .then(res => res.text())
      .then(msg => {
        alert(msg);
        location.reload(); // recarga tabla
      });
    }
  </script>
</body>
</html>
