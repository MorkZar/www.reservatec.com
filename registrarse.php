<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Registro</title>
</head>
<body>
<div class="container-all">

  <div class="container-form">
    <img src="imagenes/logo ReservaTec (1).png" alt="" class="logo">
    <h1 class="title">Registro</h1>

    <form action="registrarUsuarios.php" method="POST">

    <label for="">Nombre</label>
    <input name=nombre id=nombre type="text" maxlength="30" required>
    <label for="">Apellido Paterno</label>
    <input name=ap_paterno id=ap_paterno type="text" maxlength="20" required>
    <label for="">Apellido Materno</label>
    <input name=ap_materno id=ap_materno type="text" maxlength="20" required>
    <label for="tipo">Tipo Usuario</label>
<?php
include "conexionBD.php";

$query = "SELECT id_tipousuario, tipo_usuario FROM tipousuario";
$result = $conexion->query($query);
?>

<div class="selectTipo">
<select id="tipo" name="tipo" required>
    <!--<option value="null" selected></option>-->

    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id_tipousuario'] . "'>" . $row['tipo_usuario'] . "</option>";
    }
    ?>
</select>
  </div>
        <div id="campoAdicional" style="display: none;">
            <label for="nombreAdicional">Especifique el nombre:</label>
            <input type="text" id="nombreAdicional" name="nombreAdicional">
        </div>
    <label for="">Correo Electrónico</label>
    <input name=correo id=correo type="email" maxlength="30" required>
    <label for="">Contraseña</label>
    <input name=pass id=pass type="password" maxlength="20" required>
    
    <button class="buttonin">Registrarse</button>

  </form>

  <script>
// Seleccionamos el elemento <select> y el div que contiene el campo adicional
const selectTipo = document.getElementById('tipo');
const campoAdicional = document.getElementById('campoAdicional');
const inputAdicional = document.getElementById('nombreAdicional');  // Seleccionamos el campo de texto dentro de 'campoAdicional'

// Escuchamos el evento 'change' en el <select>
selectTipo.addEventListener('change', function() {
    console.log("Seleccionado: " + selectTipo.value); // Para verificar que el valor cambia correctamente
    // Asegúrate de que los valores de 'empresa' y 'institucionExterna' coincidan exactamente con los valores en la base de datos.
    if (selectTipo.value === '3' || selectTipo.value === '4') {
        // Mostrar el campo adicional y hacerlo obligatorio
        campoAdicional.style.display = 'block';  
        inputAdicional.setAttribute('required', 'required');  // Hacer el campo adicional obligatorio
    } else {
        // Ocultar el campo adicional y quitar el obligatorio
        campoAdicional.style.display = 'none';  
        inputAdicional.removeAttribute('required');  // Quitar el atributo 'required'
    }
});
</script>

  <span class="text-footer">Ya tengo una cuenta  <a href="inicioSesion.php"> Iniciar Sesión</a></span>

  </div>

  <div class="container-image">
  <div class="capa"></div>
  </div>

</div>


</body>
<footer class="footer">
  <p class="information">2025 | Todos los derechos reservados </p>
</footer>
</html>