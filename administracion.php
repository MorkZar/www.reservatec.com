<?php
?>
   
   <!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Reservaciones</title>
  <link rel="stylesheet" href="css/admin.css">
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.js'></script>
</head>
<body>
  <div class="contenedor-principal">
    <header>
      <h1><span class="icono">⚙</span> Gestión de Reservaciones</h1>
    </header>

    <div class="botones">
      <button class="aprobadas">Aprobadas</button>
      <button class="pendientes" onclick="location.href='reservacionespendientes.php'">Pendientes</button>
      <button class="canceladas">Canceladas</button>
      <button class="reportes" onclick="location.href='reportes.html'">Reportes</button>
    </div>
     <main class="calendar-container">
            <div id="calendar"></div>
        </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',

                events: 'obtenerEventos2.php',

                eventClick: function(info) {
    // Concatenar toda la información del evento en un solo mensaje
    var mensaje = 'Evento: ' + info.event.title + '\n' +
                  'Fecha de inicio: ' + info.event.start + '\n' +
                  'Fecha de fin: ' + info.event.end + '\n' +
                  'Descripción: ' + info.event.extendedProps.descripcion;

    // Mostrar la información del evento en un solo alert
    alert(mensaje);
  }
            });
            calendar.render();
        });
    </script>
  </div>

</body>
</html>