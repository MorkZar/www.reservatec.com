<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="css/estilosR.css">
</head>
<body>
    <div class="container">
        <h1 class="titulo">Reportes</h1>

        <!-- Paso 2: Fechas -->
        <div id="paso2" class="seccion activa">
            <h2>Seleccione los días que abarcará su reporte:</h2>
            <form action="reportes1.php" method="POST" onsubmit="return validarFechas()">
        <div class="fechas">
            <label for="desde">Desde:</label>
            <input type="date" id="desde" name="desde">
            <br><br>
            <label for="hasta">Hasta:</label>
            <input type="date" id="hasta" name="hasta">
            <br><br>
            <button class="btn" type="submit">Enviar</button>
        </div>
    </form>
        </div>
    </div>

    <script>
function validarFechas() {
    const desde = document.getElementById('desde').value;
    const hasta = document.getElementById('hasta').value;

    if (!desde || !hasta) {
        alert('Por favor seleccione ambas fechas.');
        return false;
    }

    if (hasta < desde) {
        alert('La fecha "Hasta" no puede ser anterior a la fecha "Desde".');
        return false;
    }

    return true; // Permite el envío
}
</script>

</body>
</html>
