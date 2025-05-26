<?php
session_start();

if(!isset($_SESSION['usuario'])){
  header("location: inicioSesion1.php");
  session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/peticiones2.css">
    <title>Peticiones</title>
</head>

<!-- Alerta de éxito -->
<?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == "success") { ?>
<div class="alerta-exito">
    <p>✅ Solicitud enviada, espere respuesta en los próximos días</p>
</div>
<?php } ?>

<!-- Alerta de hora incorrecta -->
<?php if (isset($_GET['mensaje1']) && $_GET['mensaje1'] == "back") { ?>
<div class="alerta-fracaso">
    <p>🚫 La hora de inicio debe ser menor que la hora de finalización.</p>
</div>
<?php } ?>

<!-- Alerta de hora fuera de horario -->
<?php if (isset($_GET['mensaje3']) && $_GET['mensaje3'] == "fechaPasada") { ?>
<div class="alerta-fracaso">
    <p>🚫 La fecha ingresada ya ha pasado.</p>
</div>
<?php } ?>

<!-- Alerta de fecha con anticipacion -->
<?php if (isset($_GET['mensaje4']) && $_GET['mensaje4'] == "anticipacionInsuficiente") { ?>
<div class="alerta-fracaso">
    <p>🚫 Debes reseservar con 3 dias de anticipación.</p>
</div>
<?php } ?>

<!-- Alerta de fecha incorrecta -->
<?php if (isset($_GET['mensaje2']) && $_GET['mensaje2'] == "back1") { ?>
<div class="alerta-fracaso">
    <p>🚫 Los horarios permitidos son de las 7:00am-8:00pm.</p>
</div>
<?php } ?>

<!-- Alerta de fecha incorrecta -->
<?php if (isset($_GET['mensaje5']) && $_GET['mensaje5'] == "ocupado") { ?>
<div class="alerta-fracaso">
    <p>🚫 El espacio no está disponible en la fecha seleccionada. Por favor, elija otra fecha </p>
</div>
<?php } ?>

<!-- Alerta de fin de semana -->
<?php if (isset($_GET['mensaje7']) && $_GET['mensaje7'] == "finDeSemana") { ?>
<div class="alerta-fracaso">
    <p>🚫 No se puede reservar en fines de semana. </p>
</div>
<?php } ?>

<!-- Alerta de fin de semana -->
<?php if (isset($_GET['mensaje6']) && $_GET['mensaje6'] == "fechaNoLaborable") { ?>
<div class="alerta-fracaso">
    <p>🚫 Dia no Laboral. </p>
</div>
<?php } ?>

<body>


<div class="titulo">
<a href="mainpage.php"><button class="back-btn">&#8592;</button></a>
    <h1>Solicitud de Reservación</h1>
</div>

        <form  action="registrarPeticiones.php" method="POST" class="formulario" id="formulario">
            <table border="1">
                <tr>
                    <td>
                        <label for="solicitante" >Solicitante: 🫏</label>

                        <?php
                        include "conexionBD.php";
                        $usuario = $_SESSION['usuario']; 
                        $query1 = "SELECT nombre, ap_paterno, ap_materno FROM usuarios WHERE correo = '$usuario'"; 
                        $result1 = $conexion->query($query1);

                        if ($result1 && $result1->num_rows > 0) {
                            $row = $result1->fetch_assoc();
                            echo "<p>{$row['nombre']} {$row['ap_paterno']} {$row['ap_materno']}</p>";
                        } else {
                            echo "<p>No se encontró el solicitante</p>";
                        }
                        ?>

                        <label for="espacio">Espacio:</label>
                        <?php
                        include "conexionBD.php";
                        $query = "SELECT id_espacio, nombre_espacio FROM espacios";
                        $result = $conexion->query($query);
                        ?>

                        <div class="selectTipo">
                            <select id="espacio" name="espacio" required oninvalid="validarCampo(this, 'Falta seleccionar espacio')"
                            oninput="this.setCustomValidity('')">
                                <option value="" selected></option>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id_espacio'] . "'>" . $row['nombre_espacio'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <label for="nombreEvento">Nombre Evento:</label>
                        <input type="text" id="nombreEvento" name="nombreEvento" required oninvalid="validarCampo(this, 'Falta ingresar nombre del evento')"
                        oninput="this.setCustomValidity('')">

                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" required oninvalid="validarCampo(this, 'Falta seleccionar fecha')"
                        oninput="this.setCustomValidity('')">
                        
                        <label for="horai">Hora Inicio:</label>
                        <input type="time" id="horai" name="horai" required oninvalid="validarCampo(this, 'Falta seleccionar hora')"
                        oninput="this.setCustomValidity('')">

                        <label for="horaf">Hora Final:</label>
                        <input type="time" id="horaf" name="horaf" required oninvalid="validarCampo(this, 'Falta seleccionar hora')"
                        oninput="this.setCustomValidity('')">
                    </td>
                    <td class="detalles-con-fondo">
                        <label for="comentarios">Detalles:</label>
                        <textarea id="detalles" name="detalles" required maxlength="300" oninvalid="validarCampo(this, 'Falta ingresar detalles')"
                        oninput="this.setCustomValidity('')"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type="submit">Enviar Solicitud</button>
                    </td>
                </tr>
            </table>
        </form>
</body>

<script>
function validarCampo(input, mensajeVacio, mensajeInvalido) {
    if (input.validity.valueMissing) {
        input.setCustomValidity(mensajeVacio);
    } else if (input.validity.patternMismatch || input.validity.typeMismatch) {
        input.setCustomValidity(mensajeInvalido);
    } else {
        input.setCustomValidity('');
    }
}
</script>
</html>