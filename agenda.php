<?php

session_start();

if(!isset($_SESSION['usuario'])){
  header("location: inicioSesion.php");
  session_destroy();
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva TEC</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.js'></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            width: 100%;
        }
        .sidebar {
            width: 250px;
            background: #fff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar h2 {
            font-size: 18px;
            color: #333;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar li {
            margin: 10px 0;
        }
        .sidebar span {
            margin-left: 10px;
        }
        .calendar-container {
            flex-grow: 1;
            padding: 20px;
            background: #fafafa;
        }
        .back-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }
        #calendar {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .auditorio { color: purple }  /* Naranja */
    .centro { color: rgb(212, 212, 38) }     /* Verde */
    .aula { color: rgb(48, 201, 48) }       /* Azul */
    .cafeteria { color: red }  /* Rosa */
    .lobby { color: #FF8C33; }      /* Naranja claro */

    span {
        display: inline-flex;
        align-items: center;
    }

    span img {
        margin-left: 8px; /* Ajusta el espacio entre el texto y la imagen */
        width: 30px; /* Ajusta el tamaño de la imagen */
        height: 30px; /* Ajusta el tamaño de la imagen */
    }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <a href="home page.php"><button class="back-btn">&#8592;</button></a>
            <h2>Seleccionar espacio</h2>
            <ul>
                <li><input type="radio" name="space" value="auditorio"> <span class="auditorio">Auditorio <img src="imagenes/auditorio-ico.png" alt=""></span></li>
                <li><input type="radio" name="space" value="centro_computo"> <span class="centro">Centro de Cómputo <img src="imagenes/pantalla-de-computadora.png" alt=""></span></li>
                <li><input type="radio" name="space" value="aula_a1"> <span class="aula">Aula A1 <img src="imagenes/aula.png" alt=""></span></li>
                <li><input type="radio" name="space" value="cafeteria"> <span class="cafeteria">Cafetería <img src="imagenes/mesa-de-cafe.png" alt=""></span></li>
                <li><input type="radio" name="space" value="lobby"> <span class="lobby">Lobby <img src="imagenes/lobby-ico.png" alt=""></span></li>
            </ul>
        </aside>
        <main class="calendar-container">
            <div id="calendar"></div>
        </main>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
            });
            calendar.render();
        });
    </script>
</body>
</html>